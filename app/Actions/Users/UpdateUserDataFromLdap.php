<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Actions\BaseAction;
use App\Ldap\User as LdapUser;
use Illuminate\Support\Facades\Storage;

class UpdateUserDataFromLdap extends BaseAction
{
    public function handle(User $dbUser)
    {
        // cn/samaccountname - atobyss                 -- Global ID
        // sn - Tobys                   -- Nazwisko
        // givenname - Sławomir         -- Imie
        // l - Swiebodzin               -- location?
        // street - ul. Zachodnia 78    -- ulica zakladu
        // title - IT Operator          -- Stanowisko
        // jcijobtitledescription
        // displayname - Sławomir Tobys -- Nazwa Wyswietlana
        // memberof - Array("CN=A-8014-U-MAP-ARCHIVE,OU=SecurityGroups,DC=autoexpr,DC=com")
        // co - Poland                  -- country?
        // department - Gracjan Krasinski   -- dzial
        // company - Adient Poland sp. z o.o. -- nazwa zakladu
        // mail - email adress
        // manager - "CN=akrasig,OU=Users,OU=8014-Poland-Swiebodzin,OU=Facilities,DC=autoexpr,DC=com"
        // mobile - "+48 660 767 498"
        // thumbnailphoto


        $ldapUser = LdapUser::where('cn', $dbUser->username)->get()->first();

        // -- throw 404 if no such user in AD found
        abort_unless($ldapUser, 404, 'User Not Found in ActiveDirectory');

        $data = [
            'email'         => $ldapUser->getFirstAttribute('mail'),
            'family_name'   => $ldapUser->getFirstAttribute('sn'),
            'given_name'    => $ldapUser->getFirstAttribute('givenname'),
            'title'         => $ldapUser->getFirstAttribute('title'),
        ];

        $filename = $dbUser->username . '.tmp';
        $thumbnail = $ldapUser->getFirstAttribute('thumbnailphoto');
        if ( !empty($thumbnail) && Storage::disk('avatars')->put($filename, $thumbnail) ) {
            $mime = Storage::disk('avatars')->mimeType($filename);

            $extention = match ($mime) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                default => 'jpg',
            };

            Storage::disk('avatars')->put($dbUser->username .'.'. $extention, $ldapUser->getFirstAttribute('thumbnailphoto'));
            $data['avatar'] = $dbUser->username .'.'. $extention;
        }

        // -- if set in AD, update mobile number
        if ( ! empty($ldapUser->getFirstAttribute('mobile')) )
        {
            $data['mobile'] = $ldapUser->getFirstAttribute('mobile');
        }


        // $managersUsername = Str::of($ldapUser->manager) -> lower()
        //                         -> explode(',')
        //                         -> filter(function ($value) {
        //                                 return Str::of($value)->startsWith('cn=');
        //                             })
        //                         -> map(function($value) {
        //                                 return Str::of($value)->after('cn=');
        //                             })
        //                         -> first();
        
        // dd($managersUsername);

        return $dbUser->update($data);
    }
}

// -- to add to database users table

