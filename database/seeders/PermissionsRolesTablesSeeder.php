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
            'permissions'   => ['access', 'index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'roles'         => ['access', 'index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'users'         => ['access', 'index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'projects'      => ['access', 'index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'materials'     => ['access', 'index', 'trash', 'create', 'edit', 'show', 'delete', 'restore'],
            'inventories'   => ['access', 'index', 'trash', 'create', 'edit', 'show', 'delete', 'restore', 
                                'scanning', 'booking', 'storno-scanning', 'storno-booking',
                                'open', 'close'
                            ],
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
                    'created_at'    => Carbon::now() -> subHour(),
                    'updated_at'    => Carbon::now() -> subHour(),
                ];
            }

            $inserted = Permission::insert($list);
        }

        $roles = [
            'supervisor' => [
                    'name'      => 'supervisor',
                    'created_at'    => Carbon::now() -> subHour(),
                    'updated_at'    => Carbon::now() -> subHour(),
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
