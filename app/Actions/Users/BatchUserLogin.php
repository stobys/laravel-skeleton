<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Actions\BaseAction;

class BatchUserLogin extends BaseAction
{
    public function handle()
    {
        $batch_id = User::select('id')->whereUsername('batch')->firstOrFail()->id;
        
        return auth()->loginUsingId($batch_id);
    }
}
