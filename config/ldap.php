<?php

use Illuminate\Support\Facades\Crypt;

return [
    // -- Default LDAP Connection Name
    'default' => env('LDAP_CONNECTION', 'default'),

    // -- LDAP Connections
    'connections' => [
        'default' => [
            'hosts' => [env('LDAP_HOST', '')],
            'base_dn' => env('LDAP_BASE_DN', ''),
            'username' => env('LDAP_USERNAME', ''),
            'password' => env('LDAP_PASSWORD', ''),
            'port' => env('LDAP_PORT', 636),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'use_ssl' => env('LDAP_SSL', false),
            'use_tls' => env('LDAP_TLS', true),
            'version' => 3,

            // -- Custom LDAP Options
            'options' => [
                // See: http://php.net/ldap_set_option
                LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_NEVER,
                // LDAP_OPT_X_TLS_CACERTFILE => env('LDAP_OPT_X_TLS_CACERTFILE', null),
                // LDAP_OPT_X_TLS_CACERTDIR => env('LDAP_OPT_X_TLS_CACERTDIR', null),
                // LDAP_OPT_X_TLS_CACERTFILE => env('LDAP_OPT_X_TLS_CACERTFILE', null),
                // LDAP_OPT_DEBUG_LEVEL => 7,
            ]
        ],
    ],

    // --LDAP Logging
    'logging' => env('LDAP_LOGGING', true),

    // -- LDAP Cache
    'cache' => [
        'enabled' => env('LDAP_CACHE', false),
        'driver' => env('CACHE_DRIVER', 'file'),
    ],

];
