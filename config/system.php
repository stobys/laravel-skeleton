<?php

return [

    'users' => [
        // -- Core Users - cannot be deleted or edited and you cannot create new users with that username
        'core-users' => ['batch', 'backup', 'console', 'root', 'su', 'supervisor'],

        // -- Super Admins, admins without being in Admin group
        'super-admins' => ['root', 'supervisor', 'su', 'admin', 'atobyss'],
    ],

    'allow-multiple-user-sessions'        => false,
    'multiple-user-sessions-behaviour'    => 'logout',  // logout - logout other sessions, forbid - don't allow new session to login

];
