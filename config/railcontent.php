<?php

return [
    // brands
    'brand' => 'brand',
    'available_brands' => ['brand'],

    // cache
    // ttl value in minutes
    'cache_duration' => 60 * 24 * 30,
    'cache_prefix' => 'railcontent',
    'cache_driver' => 'redis',

    // database
    'database_connection_name' => 'mysql',
    'connection_mask_prefix' => 'railcontent_',
    'data_mode' => 'host',
    'table_prefix' => 'railcontent_',

    // languages
    'default_language' => 'en-US',
    'available_languages' => [
        'en-US',
    ],

    // if you have any of these middleware classes in your global http kernel, they must be removed from this array
    'controller_middleware' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ],

    //middleware for API requests
    'api_middleware' => [
        \Tymon\JWTAuth\Http\Middleware\RefreshToken::class,
    ],

    // filter options limitation
    'field_option_list' => [
        'instructor',
        'topic',
        'difficulty',
        'bpm',
        'style',
        'artist',
    ],

    // comments
    'comment_likes_amount_of_users' => 3,
    'commentable_content_types' => [
        'course',
        'course lesson',
    ],
    'comment_assignation_owner_ids' => [
        102905,
        8,
        5,
        87011,
        5814,
        40641,
        98085,
        63599,
        70324,
        136145,
        7776,
    ],


    // validation
    'validation' => [],

    // aws integration
    'awsS3_remote_storage' => [
        'accessKey' => env('AWS_S3_REMOTE_STORAGE_ACCESS_KEY'),
        'accessSecret' => env('AWS_S3_REMOTE_STORAGE_ACCESS_SECRET'),
        'region' => env('AWS_S3_REMOTE_STORAGE_REGION'),
        'bucket' => env('AWS_S3_REMOTE_STORAGE_BUCKET'),
    ],
    'awsCloudFront' => 'd1923uyy6spedc.cloudfront.net',

    // search
    'searchable_content_types' => ['recordings', 'courses'],
    'search_index_values' => [
        'high_value' => [
            'content_attributes' => ['slug'],
            'field_keys' => ['title', 'instructor:name'],
            'data_keys' => [],
        ],
        'medium_value' => [
            'content_attributes' => [],
            'field_keys' => ['*'],
            'data_keys' => ['*'],
        ],
        'low_value' => [
            'content_attributes' => [],
            'field_keys' => ['*'],
            'data_keys' => ['description'],
        ],
    ],

    // progress bubbling
    'allowed_types_for_bubble_progress' => [
        'started' => [],
        'completed' => [],
    ],

    // video content sync
    'video_sync' => [
        'vimeo' => [
            'brand' => [
                'client_id' => env('VIMEO_CLIENT_ID'),
                'client_secret' => env('VIMEO_CLIENT_SECRET'),
                'access_token' => env('VIMEO_ACCESS_TOKEN'),
            ],
        ],
        'youtube' => [
            'key' => env('YOUTUBE_API_KEY'),
            'brand' => [
                'user' => env('YOUTUBE_USERNAME'),
            ],
        ],
    ],

    // middleware
    'all_routes_middleware' => [],
    'user_routes_middleware' => [],
    'administrator_routes_middleware' => [],

    // decorators
    'decorators' => [
        'content' => [
            \Railroad\Railcontent\Decorators\Hierarchy\ContentSlugHierarchyDecorator::class,
            \Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator::class,
        ],
        'comment' => [
            \Railroad\Railcontent\Decorators\Comments\CommentLikesDecorator::class,
            \Railroad\Railcontent\Decorators\Entity\CommentEntityDecorator::class,
        ],
    ],

    // use collections
    'use_collections' => true,

    // content hierarchy
    'content_hierarchy_max_depth' => 3,
    'content_hierarchy_decorator_allowed_types' => [
        'content-type',
        'content-type',
    ],

    // ecommerce integration
    'enable_ecommerce_integration' => true,
    'ecommerce_product_sku_to_content_permission_name_map' => [
        'SKU' => 'name',
    ],

    // event to job listeners/map
    'event_to_job_map' => [],

    #'commentable-content-types' => [],
];