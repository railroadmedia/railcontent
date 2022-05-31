<?php

return [
    'development_mode' => true,

    // database
    'database_connection_name' => 'musora_laravel_mysql_writer_only',
    'database_name' => env('DB_MUSORA_LARAVEL_MYSQL_DATABASE_NAME'),
    'database_user' => env('DB_MUSORA_LARAVEL_MYSQL_USER_NAME'),
    'database_password' => env('DB_MUSORA_LARAVEL_MYSQL_PASSWORD'),
    'database_host' => env('DB_MUSORA_LARAVEL_MYSQL_WRITE_HOST'),
    'database_driver' => 'pdo_mysql',
    'database_in_memory' => false,
    'enable_query_log' => false,

    // host does the db migrations, clients do not
    'data_mode' => 'client', // 'host' or 'client'

    // cache
    'redis_host' => env('REDIS_HOST', 'redis'),
    'redis_port' => env('REDIS_PORT', 6379),

    'entities' => [
        [
            'path' => __DIR__ . '/../src/Entities',
            'namespace' => 'Railroad\Usora\Entities',
        ],
    ],

    // users
    // todo - update default avatar url
    'default_profile_picture_url' => 'https://s3.amazonaws.com/pianote/defaults/avatar.png',
    'default_timezone' => 'America/Los_Angeles',

    // tables
    'tables' => [
        'users' => 'usora_users',
        'user_fields' => 'usora_user_fields',
        'password_resets' => 'usora_password_resets',
        'email_changes' => 'usora_email_changes',
        'remember_tokens' => 'usora_remember_tokens',
        'firebase_tokens' => 'usora_user_firebase_tokens',
        'user_topics' => 'usora_user_topics',
    ],

    // routes
    'autoload_all_routes' => false,
    'route_middleware_public_groups' => ['web'],
    'route_middleware_logged_in_groups' => ['web_authed'],
    'route_prefix' => 'usora',

    //middleware for API requests
    'route_middleware_app_logged_in_groups' => [

    ],

    // the system will authenticate on each of these domains after login
    // the verification token urls don't always follow the same pattern on other domains
    // so we must configure the usora url for the vt endpoint in manually
    'domains_to_authenticate_on_with_request_urls' => [
        'www.musora.com' => [
            'with-verification-token' => 'https://www.musora.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://www.musora.com/usora/authenticate/render-post-message-verification-token',
        ],
        'www.guitareo.com' => [
            'with-verification-token' => 'https://www.guitareo.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://www.guitareo.com/usora/authenticate/render-post-message-verification-token',
        ],
        'www.pianote.com' => [
            'with-verification-token' => 'https://www.pianote.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://www.pianote.com/usora/authenticate/render-post-message-verification-token',
        ],
        'www.singeo.com' => [
            'with-verification-token' => 'https://www.singeo.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://www.singeo.com/usora/authenticate/render-post-message-verification-token',
        ],
    ],

    // if the env variable APP_DEBUG is true, these domains will be authed instead (used for dev.domain.com, staging, etc)
    'dev_domains_to_authenticate_on_with_request_urls' => [
        'dev.musora.com' => [
            'with-verification-token' => 'https://dev.musora.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://dev.musora.com/usora/authenticate/render-post-message-verification-token',
        ],
        'dev.guitareo.com' => [
            'with-verification-token' => 'https://dev.guitareo.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://dev.guitareo.com/usora/authenticate/render-post-message-verification-token',
        ],
        'dev.pianote.com' => [
            'with-verification-token' => 'https://dev.pianote.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://dev.pianote.com/usora/authenticate/render-post-message-verification-token',
        ],
        'dev.singeo.com' => [
            'with-verification-token' => 'https://dev.singeo.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://dev.singeo.com/usora/authenticate/render-post-message-verification-token',
        ],
        'staging.musora.com' => [
            'with-verification-token' => 'https://staging.musora.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://staging.musora.com/usora/authenticate/render-post-message-verification-token',
        ],
        'staging.guitareo.com' => [
            'with-verification-token' => 'https://staging.guitareo.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://staging.guitareo.com/usora/authenticate/render-post-message-verification-token',
        ],
        'staging.pianote.com' => [
            'with-verification-token' => 'https://dev.pianote.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://staging.pianote.com/usora/authenticate/render-post-message-verification-token',
        ],
        'staging.singeo.com' => [
            'with-verification-token' => 'https://dev.singeo.com/usora/authenticate/set-authentication-cookie',
            'render-post-message-verification-token' => 'https://staging.singeo.com/usora/authenticate/render-post-message-verification-token',
        ],
    ],

    'post_verification_token_path' => 'usora/authenticate/render-post-message-verification-token',

    // authentication
    'login_page_path' => '/login',
    'login_success_redirect_path' => '/members',

    // how long until the remember tokens expire in seconds
    'remember_me_token_expiration_time' => 94608000, // 3 years
    'force_remember' => true,

    // password reset
    'password_reset_form_route_name' => 'members-area.reset-password',
    'password_reset_notification_class' => '',
    'password_reset_notification_channel' => 'mail',

    'email_change_notification_class' => '',
    'email_change_notification_channel' => 'mail',
    'email_change_token_ttl' => 24, // hours unit
    'email_change_confirmation_success_redirect_path' => 'members/settings/login-credentials',

    // file uploading
    'file_upload_aws_s3_access_key' => env('S3_KEY'),
    'file_upload_aws_s3_access_secret' => env('S3_SECRET'),
    'file_upload_aws_s3_region' => env('S3_REGION'),
    'file_upload_aws_s3_bucket' => env('S3_BUCKET'),
    'file_upload_aws_s3_bucket_cloud_front_url' => 'https://dzryyo1we6bm3.cloudfront.net',

    // the uploaded file URL will be injected in to the request with the 'file_' removed from the key
    // keys MUST start with 'file_', ex: 'file_my_profile_picture'
    'allowed_file_upload_request_keys' => [
        'profile_picture_url' => [
            'path' => '/avatars',
        ],
        'piano_gear_photo' => [
            'path' => '/gear-photos',
        ],
    ],

    'password_creation_rules' => 'confirmed|min:8|max:128', // also defined in ecommerce
];
