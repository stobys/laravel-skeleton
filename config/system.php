<?php

return [

    'users' => [
        // -- Core Users - cannot be deleted or edited and you cannot create new users with that username
        'core-users' => ['batch', 'backup', 'console', 'root', 'su'],

        // -- Super Admins, admins without being in Admin group
        'super-admins' => ['root', 'su', 'admin', 'atobyss'],

        // -- Logistics Super Admins, admins without being in Admin group for logistics modules
        'logistics-super-admins'    => ['root', 'atobyss', 'abarnapa'],
    ],

    'allow-multiple-scanner-session'        => false,
    'multiple-scanner-session-behaviour'    => 'logout',  // logout - logout other sessions, forbid - don't allow new session to login

];
