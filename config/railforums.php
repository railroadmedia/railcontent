<?php

/*
 * html_purifier_settings.settings.default array is passed directly in to HTMLPurifier_Config->loadArray()
 */

return [
    // brand
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
    'database_connection_name' => env('DB_MUSORA_LARAVEL_MYSQL_WRITER_ONLY', 'musora_laravel_mysql_writer_only'),

    // url
    // NOTE: this gets updated on the fly depending on the brand in the SetLastUsedBrandMiddleware
    'jump_to_post_url_prefix' => '/brand/forums/jump-to-post/',
    'jump_to_thread_url_prefix' => '/brand/forums/jump-to-thread/',
    'forums_index_page_url' => '/brand/forums',

    // host does the db migrations, clients do not
    'data_mode' => env('RAILFORUMS_DATA_MODE', 'host'),

    // cache
    'cache_driver' => 'array',
    'cache_key_prefix' => 'singeo_railforums_cache_',
    'cache_minutes' => 60,

    'table_prefix' => 'forum_',
    'tables' => [
        'categories' => 'categories',
        'threads' => 'threads',
        'thread_follows' => 'thread_follows',
        'thread_reads' => 'thread_reads',
        'posts' => 'posts',
        'post_likes' => 'post_likes',
        'post_reports' => 'post_reports',
        'post_replies' => 'post_replies',
        'search_indexes' => 'search_indexes',
        'user_signatures' => 'user_signatures',
    ],

    // middleware
    'controller_middleware' => [
        \Modules\UserManagementSystem\Middleware\AuthenticatedOnly::class,
        \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
        \App\Http\Middleware\SetContentPermissions::class,
//        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ],

    'author_database_connection' => 'musora_laravel_mysql_writer_only',
    'author_table_name' => 'usora_users',
    'author_table_id_column_name' => 'id',
    'author_table_display_name_column_name' => 'display_name',
    'author_table_avatar_column_name' => 'profile_picture_url',
    'author_default_avatar_url' => 'https://s3.amazonaws.com/singeo/defaults/avatar.png',

    'post_report_notification_class' => \Railroad\Railforums\Notifications\PostReport::class,
    'post_report_notification_channel' => 'mail',
    'post_report_notification_recipients' => ['julia@singeo.com'],
    'post_report_notification_view_post_route' => 'forums.jump-to-post', // laravel route name, eg: 'railforums.api.post.show' or 'forums.jump-to-post'

    'search' => [
        'high_value_multiplier' => 4,
        'medium_value_multiplier' => 2,
        'low_value_multiplier' => 1,
    ],

    'html_purifier_settings' => [
        'encoding' => 'UTF-8',
        'finalize' => true,
        'settings' => [
            'default' => [
                'HTML.Doctype' => 'XHTML 1.0 Strict',
                'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style|class],br,span[style|class],img[width|height|alt|src],blockquote',
                'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
                'AutoFormat.AutoParagraph' => true,
                'HTML.TargetBlank' => true,
                'AutoFormat.RemoveEmpty' => true,
            ],
        ],
    ],
    'excludedOldForumsIds' => [
        'drumeo' => [3, 14, 13, 8],
        'pianote' => [],
        'singeo' => [],
        'guitareo' => []
    ],
    'forum_rules_post_id' => [
        'drumeo' => 350741,
        'guitareo' => 45843,
        'singeo' => 48899,
        'pianote' => 129215
    ],
    'decorators' => [
        'posts' => [
            \App\Decorators\Forums\UserSignatureDecorator::class,
            \App\Decorators\Forums\PostUrlsDecorator::class
            ]
    ],
    'api_middleware' => [
        \Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,

        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,

        \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
        \App\Http\Middleware\SetContentPermissions::class,
    ],
];
