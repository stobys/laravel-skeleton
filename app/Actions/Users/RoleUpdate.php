<?php

namespace App\Actions\Users;

use App\Models\Role;
use App\Actions\BaseAction;

class RoleUpdate extends BaseAction
{
    public function handle(Role $model, $request = null)
    {
        $request = $request ?? request();

        $model->update($request->all());
        $model->syncPermissions($request->input('permissions', []));

        // -- forget cache for select
        Role::forgetForSelect();

        flash()->info(__('roles.messages.update-successful', ['name' => $model->name]));
    }
}
