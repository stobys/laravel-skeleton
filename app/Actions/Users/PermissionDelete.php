<?php

namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\Permission;

class PermissionDelete extends BaseAction
{
    public function handle(Permission $model)
    {
        if($model->delete()) {
            // -- forget cache for select
            Permission::forgetForSelect();

            flash()->success(__('permissions.messages.delete-successful', ['name' => $model->name]));
        } else {
            flash()->error(__('permissions.messages.delete-unsuccessful', ['name' => $model->name]));
        }
    }
}
