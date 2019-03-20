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
    'data_mode' => 'host',
    'table_prefix' => 'railcontent_',

    // languages
    'default_language' => 'en-US',
    'available_languages' => [
        'en-US',
    ],

    'development_mode' => true,

    // database
    'database_name' => 'mydb',
    'database_user' => 'root',
    'database_password' => 'root',
    'database_host' => 'mysql',
    'database_driver' => 'pdo_mysql',
    'database_in_memory' => false,

    // cache
    'redis_host' => 'redis',
    'redis_port' => 6379,

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
        'sbtBpm',
        'style',
        'artist',
    ],

    // comments
    'comment_likes_amount_of_users' => 3,
    'commentable_content_types' => [
        'course',
        'course lesson',
    ],

    // validation
    'validation' => [
        'brand' => [
            'course' => [
                'scheduled' => [
                    'fields' => [
                        'title' => ['rules' => 'required|max:80'],
                    ]
                ],
                'published' => [
                    //'number_of_children' => 'numeric|min:1',
                    'fields' => [
                        'topic' => ['rules' => 'required', 'can_have_multiple' => true],
                       // 'instructor' => ['rules' => [$instructor_in_database, 'required'], 'can_have_multiple' => true],
                        'difficulty' => ['rules' => 'required|in:beginner,intermediate,advanced,all,1,2,3,4,5,6,7,8,9,10'],
                    ],
                    'data' => [
                        'resource_name' => ['rules' => 'max:40', 'can_have_multiple' => true],
                        'resource_url' => ['rules' => 'url', 'can_have_multiple' => true],
                      //  'thumbnail_url' => ['rules' => ['required', 'url', $file_extension_must_be_jpg_or_png]],
                        'description' => ['rules' => 'required|max:2500'],
                    ],
                ],
            ],
        ],
    ],

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
            'content_attributes' => ['slug','title'],
            'field_keys' => ['instructor:name'],
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
        'started' => [
            'course',
        ],
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

        ],
        'comment' => [
            \Railroad\Railcontent\Decorators\Comments\CommentLikesDecorator::class,
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
    'event_to_job_map' => [

    ],

    'entities' => [
        [
            'path' => __DIR__ . '/../src/Entities',
            'namespace' => 'Railroad\Railcontent\Entities',
        ],
    ],
];