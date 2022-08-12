<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\User;

use Closure;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // if (!app()->runningInConsole() && $user) {
        //     $roles            = Role::with('permissions')->remember(60*60)->get();
        //     $permissionsArray = [];

        //     foreach ($roles as $role) {
        //         foreach ($role->permissions as $permissions) {
        //             $permissionsArray[$permissions->name][] = $role->id;
        //         }
        //     }

        //     foreach ($permissionsArray as $name => $roles) {
        //         Gate::define($name, function (User $user) use ($roles) {
        //             return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
        //         });
        //     }
        // }

        return $next($request);
    }
}
