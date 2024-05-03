<?php

return [
    'global_is_active' => env('RAILTRACKER_ENABLED', true),

    'brand' => 'musora',

    // brand database connection names (each brand is on its own database for now)
    'brand_database_connection_names' => [
        'musora' => 'musora_laravel_mysql_writer_only',
        'drumeo' => 'drumeo_laravel_mysql_writer_only',
        'pianote' => 'pianote_laravel_mysql_writer_only',
        'guitareo' => 'guitareo_laravel_mysql_writer_only',
        'singeo' => 'singeo_laravel_mysql_writer_only',
    ],

    // database
    'database_connection_name' => 'musora_laravel_mysql_writer_only',
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
    'redis_connection_name' => 'railtracker',
    'cache_prefix' => 'mwp_railtracker_',
    'cache_duration' => 60 * 60 * 24 * 2, // 2 days
    'batch_prefix' => env('RAILTRACKER_BATCH_PREFIX', 'railtracker4_mwp_'),

    'exclusion_regex_paths' => [
        '/members\/live\-poll/',
        '/members\/user\-video\-session\/store/',
        '/railtracker\/media\-playback\-sessions*/',
        '/musora\-api\/v1\/media*/',
        '/members\/live\/are\-we\-live\-poll*/',
        '/menu\-api*/',
        '/members\/wp\-cron*/',
        '/members\/wp\-admin\/admin\-ajax*/',
    ],

    // route middleware group
    'route_middleware_logged_in_groups' => ['web_or_api_authenticated'],

    'ip_data_api_key' => env('IP_DATA_API_KEY', '3e2874cc4be1cd0bdb4c4197614c8dd9494fc50bc3c57e0485970413')
];
