<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Actions\BaseAction;
use App\Ldap\User as LdapUser;

class UpsertUserFromLdap extends BaseAction
{
    public function handle($username)
    {
        return true;
        
        $ldapUser = LdapUser::where('cn', $dbUser->username)->get()->first();

        // -- throw 404 if no such user in AD found
        abort_unless($ldapUser, 404, 'User Not Found in ActiveDirectory');

        $data = [
            'email'         => $ldapUser->mail,
            'family_name'   => $ldapUser->sn,
            'given_name'    => $ldapUser->givenname,

            'title'         => $ldapUser->title,
            'avatar'        => $ldapUser->thumbnailphoto,
        ];

        // -- if set in AD, update mobile number
        if ( ! empty($ldapUser->mobile) )
        {
            $data['mobile'] = $ldapUser->mobile;
        }

        $managersUsername = Str::of($ldapUser->manager) -> lower()
                                -> explode(',')
                                -> filter(function ($value) {
                                        return Str::of($value)->startsWith('cn=');
                                    })
                                -> map(function($value) {
                                        return Str::of($value)->after('cn=');
                                    })
                                -> first();

        
        dd($managersUsername);

        


        return $dbUser->update($data);
    }
}

// -- to add to database users table
title, avatar, mobile, manager_id,
