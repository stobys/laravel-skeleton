<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Actions\BaseAction;

class UserRestore extends BaseAction
{
    public function handle(User $user)
    {
        if ($user->restore()) {
            flash()->success(__('users.messages.restore-successful', ['username' => $user->username]));
        } else {
            flash()->error(__('users.messages.restore-unsuccessful', ['username' => $user->username]));
        }
    }
}
