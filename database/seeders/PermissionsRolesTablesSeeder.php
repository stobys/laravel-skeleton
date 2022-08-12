<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;

use Carbon\Carbon;

class PermissionsRolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'permissions'   => ['index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'roles'         => ['index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'users'         => ['index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
        ];

        $groups = collect(array_keys($permissions)) -> mapWithKeys(function($group){
            $pg = PermissionGroup::create(['name' => $group]);

            return [$group => $pg->id];
        });

        foreach( $permissions as $module => $names )
        {
            $list = [];

            foreach( $names as $name )
            {
                $list[] = [
                    'name'          => $module .'.'. $name,
                    'group_id'      => $groups[$module] ?? null,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ];
            }

            $inserted = Permission::insert($list);
        }

        $roles = [
            'supervisor' => [
                    'name'      => 'supervisor',
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ],
            'admin'  => [
                    'name'      => 'admin',
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ],
        ];

        $supervisor = Role::create($roles['supervisor']);
        $admin = Role::create($roles['admin']);

        $permissionsIds = Permission::pluck('id')->all();

        $admin -> permissions() -> sync($permissionsIds);
        $supervisor -> permissions() -> sync($permissionsIds);
    }
}
