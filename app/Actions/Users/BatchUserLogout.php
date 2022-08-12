<?php

namespace App\Actions\Users;

use App\Actions\BaseAction;

class BatchUserLogout extends BaseAction
{
    public function handle()
    {
        return auth()->logout();
    }
}
