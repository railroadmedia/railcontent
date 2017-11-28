<?php

return [
    'cache_duration' => 60 * 60 * 24 * 30,
    'database_connection_name' => 'mysql',
    'connection_mask_prefix' => 'railcontent_',
    'data_mode' => 'host',

    'table_prefix' => 'railcontent_',

    'brand' => 'drumeo',

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
        'course','course lesson'
    ],
    'comments_assignation' => [
        'course' => 1,
        'course lesson' => 2
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
    ]
];