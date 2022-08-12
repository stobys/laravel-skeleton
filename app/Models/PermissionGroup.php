<?php

namespace App\Models;

use App\Traits\CacheForSelect;

class PermissionGroup extends Model
{
    use CacheForSelect;
    
    public $table = 'auth_permissions_groups';

    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }

    public function description()
    {
        return __('permissions.groups.descriptions.' . $this->name);
    }

    public function viewable()
    {
        return false;
    }

    public function editable()
    {
        return false;
    }

    public function deletable()
    {
        return false;
    }

    public function restorable()
    {
        return false;
    }

    public function scopeFilter($query)
    {
        return $query;
    }

}
