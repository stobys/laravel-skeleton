<?php

namespace App\Actions\Users;

use App\Models\Role;
use App\Actions\BaseAction;

class RoleRestore extends BaseAction
{
    public function handle(Role $model)
    {
        if ($model->restore()) {
            // -- forget cache for select
            Role::forgetForSelect();

            flash()->success(__('roles.messages.restore-successful', ['name' => $model->name]));
        } else {
            flash()->error(__('roles.messages.restore-unsuccessful', ['name' => $model->name]));
        }
    }
}
