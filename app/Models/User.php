<?php

namespace App\Models;

use Illuminate\Support\Arr;
use App\Traits\ModelUrlTrait;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelVersionable\Versionable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes, ModelUrlTrait;
    use Versionable;

	public $table = 'users';

    // -- version of those fields
    protected $versionable = [
        'username',
        'personal_no',
        'family_name',
        'given_name',
        'title',
        'email',
        'mobile',
        'avatar',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'personal_no',
        'family_name',
        'given_name',
        'title',
        'email',
        'mobile',
        'avatar',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
        'last_login_at',
        'last_seen_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
        'last_seen_at'      => 'datetime',
    ];

    /**
     * Hash password by default, if empty do nothing.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ( ! empty($value) ) {
            $this -> attributes['password'] = Hash::make($value);
            $this -> fireModelEvent('hashing');
        }
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'pivot_role_user', 'user_id', 'role_id');
    // }

    public function isSuperAdmin()
    {
        return in_array($this->username, config('system.users.super-admins', []));
    }

    public function isCoreUser()
    {
        return in_array($this->username, config('system.users.core-users', []));
    }

    public function isLogisticsSuperAdmin()
    {
        return in_array($this->username, config('system.users.logistics-super-admins', []));
    }

    public function deletable()
    {
        if ( $this->isCoreUser() || $this->isSuperAdmin() )
        {
            return false;
        }

        return auth()->check() && ! $this->trashed() && Gate::allows('users.delete');
    }

    public function restorable()
    {
        return auth() -> check() && $this -> trashed() && Gate::allows('users.restore');
    }

    public function editable()
    {
        if ($this->isCoreUser() ) {
            return false;
        }

        return auth() -> check() && Gate::allows('users.edit');
    }

    public function viewable()
    {
        return auth() -> check() && Gate::allows('users.show');
    }
	
    public function scopeWithoutCoreUsers($query)
    {
        $query -> whereNotIt('username', config('system.users.core-users'));

        return $query;
    }

    public function scopeFilter($query)
    {
        session()->forget('filters.users.isFiltered');

        if (request()->isMethod('POST')) {
            // -- check "default_query_string"
            if (request()->has('default_query_string') && trim(request()->get('default_query_string')) !== '') {
                session()->put('filters.users.default_query_string', request()->get('default_query_string'));
            } else {
                session()->forget('filters.users.default_query_string');
            }

            // -- check "username"
            if (request()->has('username') && trim(request()->get('username')) !== '') {
                session()->put('filters.users.username', request()->get('username'));
            } else {
                session()->forget('filters.users.username');
            }

            // -- check "family_name"
            if (request()->has('family_name') && trim(request()->get('family_name')) !== '') {
                session()->put('filters.users.family_name', request()->get('family_name'));
            } else {
                session()->forget('filters.users.family_name');
            }

            // -- check "given_name"
            if (request()->has('given_name') && trim(request()->get('given_name')) !== '') {
                session()->put('filters.users.given_name', request()->get('given_name'));
            } else {
                session()->forget('filters.users.given_name');
            }

            // -- check "email"
            if (request()->has('email') && trim(request()->get('email')) !== '') {
                session()->put('filters.users.email', request()->get('email'));
            } else {
                session()->forget('filters.users.email');
            }

            // -- check "roles"
            if (request()->has('roles') && is_array(request()->get('roles')) ) {
                session()->put('filters.users.roles', request()->get('roles'));
            } else {
                session()->forget('filters.users.roles');
            }
        }

        // -- filtrowanie kolekcji
        if (session()->has('filters.users.default_query_string')) {
            $query -> where(function ($q) {
                $like = '%'. session()->get('filters.users.default_query_string') .'%';

                $q -> where('username', 'LIKE', $like)
                    -> orWhere('family_name', 'LIKE', $like)
                    -> orWhere('given_name', 'LIKE', $like)
                    -> orWhere('email', 'LIKE', $like);
            });

            session()->put('filters.users.isFiltered', true);
        }

        if (session()->has('filters.users.username')) {
            $like = '%'. session()->get('filters.users.username') .'%';
            $query -> where('username', 'LIKE', $like);

            session()->put('filters.users.isFiltered', true);
        }

        if (session()->has('filters.users.family_name')) {
            $like = '%'. session()->get('filters.users.family_name') .'%';
            $query -> where('family_name', 'LIKE', $like);

            session()->put('filters.users.isFiltered', true);
        }

        if (session()->has('filters.users.given_name')) {
            $like = '%'. session()->get('filters.users.given_name') .'%';
            $query -> where('given_name', 'LIKE', $like);

            session()->put('filters.users.isFiltered', true);
        }

        if (session()->has('filters.users.email')) {
            $like = '%'. session()->get('filters.users.email') .'%';
            $query -> where('email', 'LIKE', $like);

            session()->put('filters.users.isFiltered', true);
        }

        if (session()->has('filters.users.roles')) {
            $query -> whereHas('roles', function($q) {
                $q -> whereIn('id', session()->get('filters.users.roles'));
            });
            
            session()->put('filters.users.isFiltered', true);
        }

        return $query;
    }
    
    public function setLastLogin()
    {
        $this -> last_login_at = now();
        $this -> save();
    }

    public function fullname()
    {
        return $this -> given_name .' '. $this -> family_name;
    }

    public function touchLastSeen()
    {
        $this->last_seen_at = now();
        $this->timestamps = false;
        $this->save();
    }

    public function getByPermission($permission)
    {
    }

    public function scopeFindByPermission($query, $permission)
    {
        $permission = Arr::wrap($permission);

        // -- all roles that has permission
        $rolesWithPerm = Role::whereHas('permissions', function ($permissions) use ($permission) {
            $permissions->whereIn('name', $permission);
        })->get();

        $query->whereHas('roles', function ($roles) use ($rolesWithPerm) {
            $roles->whereIn('id', $rolesWithPerm->pluck('id'));
        })->get();

        return $query;
    }

    public function scopeWithoutInternal($query)
    {
        $query -> whereNotIn('username', ['batch', 'admin']);
    }

    public function isDeleted()
    {
        return !is_null($this->deleted_at);
    }
}
