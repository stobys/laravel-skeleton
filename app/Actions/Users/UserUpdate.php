<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Actions\BaseAction;

class UserUpdate extends BaseAction
{
    public function handle(User $user, $request = null)
    {
        $request = $request ?? request();

        $user -> update($request->all());
        // $user -> changePassword( $request->get('password') );

        $user->roles()->sync($request->input('roles', []));

        flash()->info(__('users.messages.update-successful', ['username' => $user->username]));
    }
}
