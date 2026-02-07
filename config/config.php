<?php

return [
    'app' => [
        'name' => 'ClassTest Studio',
        'version' => '1.0.0',
        'timezone' => 'UTC'
    ],
    
    'database' => [
        'driver' => getenv('DB_DRIVER') ?: 'sqlite',
        'sqlite' => [
            'path' => __DIR__ . '/../storage/database.sqlite'
        ],
        'mysql' => [
            'host' => getenv('DB_HOST') ?: 'localhost',
            'port' => getenv('DB_PORT') ?: 3306,
            'database' => getenv('DB_NAME') ?: 'classtest',
            'username' => getenv('DB_USER') ?: 'root',
            'password' => getenv('DB_PASS') ?: '',
            'charset' => 'utf8mb4'
        ]
    ],
    
    'session' => [
        'lifetime' => 7200,
        'cookie_name' => 'classtest_session'
    ],
    
    'security' => [
        'password_min_length' => 8,
        'session_regenerate_interval' => 300
    ]
];
