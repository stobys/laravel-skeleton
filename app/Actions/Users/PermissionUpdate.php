<?php

namespace App\Actions\Users;

use App\Models\Permission;
use App\Actions\BaseAction;

class PermissionUpdate extends BaseAction
{
    public function handle(Permission $model, $request = null)
    {
        $request = $request ?? request();

        $model->update($request->all());
        Permission::forgetForSelect();

        flash()->info(__('permissions.messages.update-successful', ['name' => $model->name]));
    }
}
