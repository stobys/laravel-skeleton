<?php

use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;

Route::bind('user', function ($value) {
    return User::withTrashed()->whereId($value)->firstOrFail();
});

Route::bind('role', function ($value) {
    return Role::withTrashed()->whereId($value)->firstOrFail();
});

Route::group(['middleware' => ['auth']], function () {

    // -- Permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/',     [PermissionsController::class, 'index']) -> name('permissions.index');
        Route::post('/',    [PermissionsController::class, 'index']) -> name('permissions.index-filter');

        Route::get('trash', [PermissionsController::class, 'trash']) -> name('permissions.trash');
        Route::post('trash',[PermissionsController::class, 'trash']) -> name('permissions.trash-filter');

        Route::get('create',[PermissionsController::class, 'create']) -> name('permissions.create');
        Route::put('/',     [PermissionsController::class, 'store']) -> name('permissions.store');

        Route::delete('destroy', [PermissionsController::class, 'bulkDestroy']) -> name('permissions.bulkDestroy');
        Route::delete('restore', [PermissionsController::class, 'bulkRestore']) -> name('permissions.bulkRestore');

        Route::get('{permission}',   [PermissionsController::class, 'show']) -> name('permissions.show');
        Route::get('{permission}/edit',   [PermissionsController::class, 'edit']) -> name('permissions.edit');
        Route::patch('{permission}', [PermissionsController::class, 'update']) -> name('permissions.update');
        Route::delete('{permission}', [PermissionsController::class, 'destroy']) -> name('permissions.destroy');
        Route::delete('{permission}/restore', [PermissionsController::class, 'restore']) -> name('permissions.restore');
    });

    // -- Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/',         [RolesController::class, 'index']) -> name('roles.index');
        Route::post('/',        [RolesController::class, 'index']) -> name('roles.index-filter');

        Route::get('trash',     [RolesController::class, 'trash']) -> name('roles.trash');
        Route::post('trash',    [RolesController::class, 'trash']) -> name('roles.trash-filter');

        Route::get('create',    [RolesController::class, 'create']) -> name('roles.create');
        Route::put('/',         [RolesController::class, 'store']) -> name('roles.store');

        Route::delete('destroy', [RolesController::class, 'bulkDestroy']) -> name('roles.bulkDestroy');
        Route::delete('restore', [RolesController::class, 'bulkRestore']) -> name('roles.bulkRestore');

        Route::get('{role}',      [RolesController::class, 'show']) -> name('roles.show');
        Route::get('{role}/edit', [RolesController::class, 'edit']) -> name('roles.edit');
        Route::patch('{role}',    [RolesController::class, 'update']) -> name('roles.update');
        Route::delete('{role}',   [RolesController::class, 'destroy']) -> name('roles.destroy');
        Route::delete('{role}/restore', [RolesController::class, 'restore']) -> name('roles.restore');
    });

    // -- Users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/',     [UsersController::class, 'index']) -> name('users.index');
        Route::post('/',    [UsersController::class, 'index']) -> name('users.index-filter');

        Route::get('trash', [UsersController::class, 'trash']) -> name('users.trash');
        Route::post('trash',[UsersController::class, 'trash']) -> name('users.trash-filter');

        Route::get('create',[UsersController::class, 'create']) -> name('users.create');
        Route::put('/',     [UsersController::class, 'store']) -> name('users.store');

        Route::delete('destroy', [UsersController::class, 'bulkDestroy']) -> name('users.bulkDestroy');
        Route::delete('restore', [UsersController::class, 'bulkRestore']) -> name('users.bulkRestore');

        Route::get('{user}',   [UsersController::class, 'show']) -> name('users.show');
        Route::get('{user}/edit',   [UsersController::class, 'edit']) -> name('users.edit');
        Route::patch('{user}', [UsersController::class, 'update']) -> name('users.update');
        Route::delete('{user}', [UsersController::class, 'destroy']) -> name('users.destroy');
        Route::delete('{user}/restore', [UsersController::class, 'restore']) -> name('users.restore');

        Route::get('settings', [UsersController::class, 'settings'])->name('user-settings');
        Route::post('settings', [UsersController::class, 'settings'])->name('user-settings');

        Route::get('{user}/avatar', [UsersController::class, 'avatar'])->name('users-avatar');
        Route::get('{user}/badge', [UsersController::class, 'badge'])->name('users-badge');
        Route::get('{user}/versions', [UsersController::class, 'versions'])->name('user-versions');
    });
});

Route::get('profile', [UsersController::class, 'profile']) -> name('user-profile');
