<?php

return [
    'cache_duration' => 60 * 60 * 24 * 30,
    'database_connection_name' => 'mysql',
    'connection_mask_prefix' => 'railcontent_',
    'data_mode' => 'host',

    'table_prefix' => 'railcontent_',

    'brand' => 'drumeo',

    'available_brands' => ['drumeo'],

    'default_language' => 'en-US',
    'available_languages' => [
        'en-US',
    ],

    'field_option_list' => [
        'instructor',
        'topic',
        'difficulty',
        'bpm',
        'style',
        'artist',
    ],
    'commentable_content_types' => [
        'course',
        'course lesson'
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
    'validation' => [
        'drumeo' => [
            'library-lesson' => [
                'slug' => 'required|max:64',
                'fields' => [
                    'title|string' => 'required|string|min:3|max:64',
                    'instructor|multiple' => 'required|exists:content,id'

                ],
                'datum' => [
                    'description|string' => 'required|max:1024'
                ]
            ]
        ]
    ],
    'awsS3_remote_storage' => [
        'accessKey' => env('AWS_S3_REMOTE_STORAGE_ACCESS_KEY'),
        'accessSecret' => env('AWS_S3_REMOTE_STORAGE_ACCESS_SECRET'),
        'region' => env('AWS_S3_REMOTE_STORAGE_REGION'),
        'bucket' => env('AWS_S3_REMOTE_STORAGE_BUCKET')
    ],
    'awsCloudFront' => 'd1923uyy6spedc.cloudfront.net',

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

    'allowed_types_for_bubble_progress' => [
        'started' => [],
        'completed' => [],
    ],

    'video_sync' => [
        'vimeo' => [
            'drumeo' => [
                'client_id' => env('VIMEO_CLIENT_ID_DRUMEO'),
                'client_secret' => env('VIMEO_CLIENT_SECRET_DRUMEO'),
                'access_token' => env('VIMEO_ACCESS_TOKEN_DRUMEO')
            ],
            'pianote' => [
                'client_id' => env('VIMEO_CLIENT_ID_PIANOTE'),
                'client_secret' => env('VIMEO_CLIENT_SECRET_PIANOTE'),
                'access_token' => env('VIMEO_ACCESS_TOKEN_PIANOTE')
            ],
            'guitareo' => [
                'client_id' => env('VIMEO_CLIENT_ID_GUITAREO'),
                'client_secret' => env('VIMEO_CLIENT_SECRET_GUITAREO'),
                'access_token' => env('VIMEO_ACCESS_TOKEN_GUITAREO')
            ]
        ],
        'youtube' => [
            'key' => 'AIzaSyA2Q0B77vr9FrThobCKt6cb1Mnj-QGZxUk',
            'drumeo' => [
                'user' => env('YOUTUBE_USERNAME_DRUMEO','drumlessonscom')
            ],
            'pianote' => [
                'user' => env('YOUTUBE_USERNAME_PIANOTE','PianoLessonscom')
            ],
            'guitareo' => [
                'user' => env('YOUTUBE_USERNAME_GUITAREO','guitarlessonscom')
            ],
        ]
    ],

    'all_routes_middleware' => [],

    'user_routes_middleware' => [],
    'administrator_routes_middleware' => [],
    
    'cache_prefix' =>'railcontent',
    'cache_driver' => 'redis'
];