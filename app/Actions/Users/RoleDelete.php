<?php

namespace App\Actions\Users;

use App\Actions\BaseAction;
use App\Models\Role;

class RoleDelete extends BaseAction
{
    public function handle(Role $model)
    {
        if($model->delete()) {
            // -- forget cache for select
            Role::forgetForSelect();

            flash()->success(__('roles.messages.delete-successful', ['name' => $model->name]));
        } else {
            flash()->error(__('roles.messages.delete-unsuccessful', ['name' => $model->name]));
        }

    }
}
