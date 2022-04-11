<?php

return [
    'development_mode' => env('APP_DEBUG', false),

    // databases
    'database_connection_name' => env('USER_MANAGEMENT_SYSTEM_DATABASE_CONNECTION_NAME', 'musora_laravel_mysql'),
    'run_migrations' => true,

    // redis
    'redis_connection_name' => 'default',

    // users
    'default_profile_picture_url' => 'https://s3.amazonaws.com/pianote/defaults/avatar.png',
    'default_timezone' => 'America/Los_Angeles',

    // routes
    'route_prefix' => 'usora',
    'autoload_all_routes' => true,
    'route_middleware_public_groups' => ['web_public'],
    'route_middleware_logged_in_groups' => ['web_authenticated'],
    'login_page_path' => '/login',

    //middleware for API requests
    'route_middleware_app_logged_in_groups' => [
//        MobileAppTokenAuth::class,
//        \Railroad\Railtracker\Middleware\RailtrackerMiddleware::class,
//        \App\Http\Middleware\SetContentPermissions::class
    ],

    // remember tokens
    'remember_me_token_expiration_time' => 94608000, // 3 years
    'force_remember' => true,
];
