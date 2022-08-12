<?php

namespace App\Actions\Users;

use App\Actions\BaseAction;

class SetLastLogin extends BaseAction
{
    public function handle($user)
    {
        $user -> last_login_at = now();
        $user -> save();

        return true;
    }
}
