<?php

namespace App\Actions\Users;

use App\Models\Permission;
use App\Actions\BaseAction;

class PermissionRestore extends BaseAction
{
    public function handle(Permission $model)
    {
        if($model->restore()) {
            // -- forget cache for select
            Permission::forgetForSelect();

            flash()->success(__('permissions.messages.restore-successful', ['name' => $model->name]));
        } else {
            flash()->error(__('permissions.messages.restore-unsuccessful', ['name' => $model->name]));
        }
    }
}
