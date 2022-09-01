<?php

return [
    'global_is_active' => true,

    // database
    'database_connection_name' => env('USER_MANAGEMENT_SYSTEM_DATABASE_CONNECTION_NAME','musora_laravel_mysql_writer_only'),
    'database_name' => env('DB_MUSORA_LARAVEL_MYSQL_DATABASE_NAME'),
    'database_user' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME'),
    'database_password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD'),
    'database_host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
    'database_driver' => env('DB_MYSQL_DRIVER', 'pdo_mysql'),
    'database_in_memory' => env('DB_MYSQL_IN_MEMORY', false),
    'enable_query_log' => false,
    'enable_query_log_dumper' => false,
    'data_mode' => 'host', // 'host' or 'client' (host does the db migrations, clients do not)

    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_bin',

    'table_prefix' => 'railtracker4_',
    'table_prefix_media_playback_tracking' => 'railtracker_',
    'media_playback_types_table' => 'media_playback_types',
    'media_playback_sessions_table' => 'media_playback_sessions',

    // cache
//    'redis_host' => env('REDIS_HOST', 'redis'),
//    'redis_port' => env('REDIS_PORT', 6379),
    'cache_duration' => 60 * 60 * 24 * 2, // 2 days
    'batch_prefix' => env('RAILTRACKER_BATCH_PREFIX', 'railtracker4_drumeo_'),

    'exclusion_regex_paths'=> [
        '/members\/live\-poll/',
        '/members\/user\-video\-session\/store/',
        '/media\-playback\-tracking\/media\-playback\-sessions*/',
        '/members\/live\/are\-we\-live\-poll*/',
        '/menu\-api*/',
        '/members\/wp\-cron*/',
        '/members\/wp\-admin\/admin\-ajax*/',
    ],

    // route middleware group
    'route_middleware_logged_in_groups' => [],

    'ip_data_api_key' => env('IP_DATA_API_KEY', '3e2874cc4be1cd0bdb4c4197614c8dd9494fc50bc3c57e0485970413')
];
