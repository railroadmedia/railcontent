<?php

use Illuminate\Support\Str;

return [

    'connections' => [
        'musora_laravel_mysql' => [
            'driver' => 'mysql',
            'read' => [
                'host' => [
                    env('DB_MUSORA_LARAVEL_MYSQL_READ_HOST'),
                ],
            ],
            'write' => [
                'host' => [
                    env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
                ],
            ],
            'port' => env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306'),
            'database' => env('DB_MUSORA_LARAVEL_MYSQL_DATABASE_NAME', 'root'),
            'username' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root'),
            'password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ],

        'musora_laravel_mysql_writer_only' => [
            'driver' => 'mysql',
            'host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
            'port' => env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306'),
            'database' => env('DB_MUSORA_LARAVEL_MYSQL_DATABASE_NAME', 'musora_laravel'),
            'username' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root'),
            'password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ],

        'drumeo_laravel_mysql_writer_only' => [
            'driver' => 'mysql',
            'host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
            'port' => env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306'),
            'database' => env('DB_DRUMEO_LARAVEL_MYSQL_DATABASE_NAME', 'drumeo_laravel'),
            'username' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root'),
            'password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ],

        'pianote_laravel_mysql_writer_only' => [
            'driver' => 'mysql',
            'host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
            'port' => env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306'),
            'database' => env('DB_PIANOTE_LARAVEL_MYSQL_DATABASE_NAME', 'pianote_laravel'),
            'username' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root'),
            'password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ],

        'guitareo_laravel_mysql_writer_only' => [
            'driver' => 'mysql',
            'host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
            'port' => env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306'),
            'database' => env('DB_GUITAREO_LARAVEL_MYSQL_DATABASE_NAME', 'guitareo_laravel'),
            'username' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root'),
            'password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ],

        'singeo_laravel_mysql_writer_only' => [
            'driver' => 'mysql',
            'host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
            'port' => env('DB_MUSORA_LARAVEL_MYSQL_PORT', '3306'),
            'database' => env('DB_SINGEO_LARAVEL_MYSQL_DATABASE_NAME', 'singeo_laravel'),
            'username' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME', 'root'),
            'password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [],
        ],

        'snowflake_pdo' => [
            'driver' => 'snowflake_native',
            'account' => env('DB_SNOWFLAKE_ACCOUNT'),
            'username' => env('DB_SNOWFLAKE_USER_NAME'),
            'password' => env('DB_SNOWFLAKE_PASSWORD'),
            'database' => env('DB_SNOWFLAKE_DATABASE'),
        ],
    ],

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => false, // disable to preserve original behavior for existing applications
    ],

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

        'railtracker' => [
            'host' => env('REDIS_HOST', 'redis'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '0'),
        ],

        'session' => [
            'host' => env('SESSION_REDIS_HOST', env('REDIS_HOST', 'redis')),
            'password' => env('SESSION_REDIS_PASSWORD', env('REDIS_PASSWORD', null)),
            'port' => env('SESSION_REDIS_PORT', env('REDIS_PORT', '6379')),
            'database' => env('REDIS_CACHE_DB', '0'),
        ],

    ],

];
