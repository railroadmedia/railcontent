<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_DEFAULT_CONNECTION_NAME', 'musora_laravel_mysql_writer_only'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'musora_laravel_mysql_sqlite_testing' => [
            'driver'   => 'sqlite',
            'database' => database_path('testing.sqlite'),
            'prefix'   => '',
        ],

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
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => null,
        ],

        'default' => [
            'host' => env('REDIS_HOST', 'redis'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', 'redis'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '0'),
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
