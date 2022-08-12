<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\ModelUrlTrait;
use App\Traits\CacheForSelect;

// use SylveK\Traits\FilterableTrait;

use Watson\Rememberable\Rememberable;
use App\Traits\ModelValidationAtSaveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


class Role extends SpatieRole
{
    use Rememberable, SoftDeletes, ModelUrlTrait, ModelValidationAtSaveTrait;
    use CacheForSelect;

    public $table = 'auth_roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = ['permissions'];
    
    /**
     * Custom validation messages
     *
     * @var Array
     */
    protected $messages = [];

    public static function getSortOptions()
    {
        return [
            'default'   => 'Sortowanie Domyślne',
            'name,desc' => 'Nazwa malejąco',
            'name,asc'  => 'Nazwa rosnąco',
        ];
    }

    // -- Validation rules
    protected function rules()
    {
        $tableName = config('permission.table_names.roles');
        $rule = 'required|unique:%s,name,%s';

        return [
            'name' => sprintf($rule, $tableName, $this->id)
        ];
    }

    // /**
    //  * A role may be given various permissions.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'pivot_role_user', 'role_id', 'user_id');
    // }

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.permission'),
            config('permission.table_names.role_has_permissions'),
            config('permission.column_names.role_pivot_key'),
            config('permission.column_names.permission_pivot_key'),
        );
    }

    public function viewable()
    {
        return auth() -> check() && ! $this -> trashed() && auth()->user()->can('roles.access');
    }

    public function editable()
    {
        return auth() -> check() && ! $this -> trashed() && auth()->user()->can('roles.edit');
    }

    public function deletable()
    {
        return auth() -> check() && ! $this -> trashed() && auth()->user()->can('roles.delete');
    }

    public function restorable()
    {
        return auth() -> check() && $this -> trashed() && auth()->user()->can('roles.restore');
    }

    public function scopeFilter($query)
    {
        session()->forget('filters.roles.isFiltered');


        if (request()->isMethod('POST')) {
            // -- check "default_query_string"
            if (request()->has('default_query_string') && trim(request()->get('default_query_string')) !== '') {
                session()->put('filters.roles.default_query_string', request()->get('default_query_string'));
            } else {
                session()->forget('filters.roles.default_query_string');
            }
        }

        // -- filtrowanie kolekcji
        if (session()->has('filters.roles.default_query_string')) {
            $query -> where(function ($q) {
                $like = '%'. session()->get('filters.roles.default_query_string') .'%';

                $q -> where('name', 'LIKE', $like);
            });

            session()->put('filters.roles.isFiltered', true);
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

        // sort asc or desc by specific field
        switch ($field) {
            case 'name':
                return $query->orderBy('name', $order);
                break;
        }
    }
}
