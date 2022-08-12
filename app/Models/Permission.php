<?php

namespace App\Models;

use App\Traits\ModelUrlTrait;
use App\Traits\CacheForSelect;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\Gate;

use Watson\Rememberable\Rememberable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use Rememberable, SoftDeletes, ModelUrlTrait;
    use CacheForSelect;

    public $table = 'auth_permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'group_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getSortOptions()
    {
        return [
            'default'   => 'Sortowanie Domyślne',
            'name,desc' => 'Nazwa malejąco',
            'name,asc'  => 'Nazwa rosnąco',
        ];
    }
    
    public function description()
    {
        return __('permissions.descriptions.'. $this->name);
    }

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.role'),
            config('permission.table_names.role_has_permissions'),
            config('permission.column_names.permission_pivot_key'),
            config('permission.column_names.role_pivot_key'),
        );
    }

    public function viewable()
    {
        return auth() -> check() && ! $this -> trashed() && auth()->user()->can('permissions.access');
    }

    public function editable()
    {
        return auth()->user()->isSuperAdmin();
    }

    public function deletable()
    {
        return ! $this->trashed() && auth()->user()->isSuperAdmin();
    }

    public function restorable()
    {
        return $this -> trashed() && auth()->user()->isSuperAdmin();
    }

    public function scopeFilter($query)
    {
        session()->forget('filters.permissions.isFiltered');


        if (request()->isMethod('POST')) {
            // -- check "default_query_string"
            if (request()->has('default_query_string') && trim(request()->get('default_query_string')) !== '') {
                session()->put('filters.permissions.default_query_string', request()->get('default_query_string'));
            } else {
                session()->forget('filters.permissions.default_query_string');
            }

            // -- check "groups"
            if (request()->has('groups') && is_array(request()->get('groups'))) {
                session()->put('filters.permissions.groups', request()->get('groups'));
            } else {
                session()->forget('filters.permissions.groups');
            }
        }

        // -- filtrowanie kolekcji
        if (session()->has('filters.permissions.default_query_string')) {
            $query -> where(function ($q) {
                $like = '%'. session()->get('filters.permissions.default_query_string') .'%';

                $q -> where('name', 'LIKE', $like);
            });

            session()->put('filters.permissions.isFiltered', true);
        }

        if (session()->has('filters.permissions.groups')) {
            $query->whereIn('group_id', session()->get('filters.permissions.groups'));

            session()->put('filters.permissions.isFiltered', true);
        }

        return $query;
    }

    public function scopeOrder($query)
    {
        $sort = request()->get('sort', null);
        $availableOrders = ['asc', 'desc', 'rand'];

        if (is_null($sort) || empty($sort)) {
            return $query;
        }

        $sort = explode(',', $sort);
        $field = strtolower($sort[0] ?? null);
        $order = $sort[1] ?? null;

        $order = strtolower(in_array($order, $availableOrders) ? $order : 'asc');

        // -- in random order
        if ($order == 'rand') {
            return $query->inRandomOrder();
        }

        // -- sort asc or desc by specific field
        switch ($field) {
            case 'name':
                return $query->orderBy('name', $order);
            break;
        }
    }
}
