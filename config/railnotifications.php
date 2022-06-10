<?php

return [
    //the notifications will be broadcast on all the channels defined bellow
    'channels' => [
        'email' => \Railroad\Railnotifications\Channels\EmailChannel::class,
        'fcm' => \Railroad\Railnotifications\Channels\FcmChannel::class,
    ],

    // channel notification type settings, you can toggle notification broadcasts per type here
    // for example if you want to turn off only 'forum-reply' notification broadcasts to the fcm channel it can be done
    // here
    // if a channel or notification type is not set here, it will default to ON
    // current types are:
    /*
     * lesson comment liked
     *  lesson comment reply
     *  forum post reply
     *  forum post in followed thread
     *  forum post liked
     */
    'channel_notification_type_broadcast_toggles' => [
        'fcm' => [
            'lesson comment liked' => true,
            'lesson comment reply' => true,
            'forum post reply' => true,
            'forum post in followed thread' => true,
            'forum post liked' => true,
        ],
        'email' => [
            'lesson comment liked' => true,
            'lesson comment reply' => true,
            'forum post reply' => true,
            'forum post in followed thread' => true,
            'forum post liked' => true,
        ],
    ],

    // brand
    'brand' => 'musora',

    // cache
    'redis_host' => env('REDIS_HOST', 'redis'),
    'redis_port' => env('REDIS_PORT', 6379),

    'development_mode' => env('APP_DEBUG', false),

    // database
    'database_connection_name' => 'musora_mysql',
    'database_name' => 'musora_laravel',
    'database_user' => 'root',
    'database_password' => 'root',
    'database_host' => 'mysql8',
    'database_driver' => 'pdo_mysql',
    'database_in_memory' => false,
    'enable_query_log' => false,

    'data_mode' => 'client',

    // entities
    'entities' => [
        [
            'path' => __DIR__ . '/../src/Entities',
            'namespace' => 'Railroad\Railnotifications\Entities',
        ],
    ],

    // email details
    'email_address_from' => 'system@pianote.com',
    'email_brand_from' => 'Pianote',
    'email_reply_address' => 'suport@pianote.com',

    'mapping_types' => [
        'forum post in followed thread' => 'thread-reply',
        'forum post reply' => 'forum-reply',
        'lesson comment reply' => 'comment-reply',
        'lesson comment liked' => 'comment-like',
        'forum post liked' => 'forum-like',
    ],

    'api_middleware' => [
    ],

    'user_routes_middleware' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Modules\UserManagementSystem\Middleware\AuthenticatedOnly::class,
        \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
    ],

    'decorators' => [
        \App\Decorators\Notification\NotificationDecorator::class,
    ],

    // urls
    'app_notifications_deep_link_url' => 'https://www.pianote.com/api/profile',
];
