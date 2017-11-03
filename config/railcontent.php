<?php

return [
    'cache_duration' => 60 * 60 * 24 * 30,
    'database_connection_name' => 'mysql',
    'table_prefix' => 'railcontent_',

    'brand' => 'drumeo',

    'default_language' => 'en-US',
    'available_languages' => [
        'es-US',
    ],

    'field_option_list' => [
        'instructor',
        'topic',
        'difficulty'
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
    'awsS3' => [
        'accessKey' => AWS_S3_ACCESS_KEY,
        'accessSecret' => AWS_S3_ACCESS_SECRET,
        'region' => AWS_S3_REGION,
        'bucket' => AWS_S3_BUCKET
    ],
    'awsCloudFront' => 'd1923uyy6spedc.cloudfront.net'
];