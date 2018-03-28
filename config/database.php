<?php
return [
    
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => '192.168.100.218',
            'port' => env('DB_PORT', '3306'),
            'database' => 'newsystem_com',
            'username' => 'root',
            'password' => '123456',
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => 'op_',
            'strict' => true,
            'engine' => null,
        ],
    ],
];
