<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Actions\BaseAction;

class UserDelete extends BaseAction
{
    public function handle(User $user)
    {
        if($user->delete()) {
            flash()->success(__('users.messages.delete-successful', ['username' => $user->username]));
        } else {
            flash()->error(__('users.messages.delete-unsuccessful', ['username' => $user->username]));
        }
    }
}
