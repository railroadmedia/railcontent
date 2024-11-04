<?php

return [

    'disks' => [
        'musora_web_platform_s3' => [
            'driver' => 's3',
            'key' => env('MWP_AWS_S3_ACCESS_KEY_ID'),
            'secret' => env('MWP_AWS_S3_SECRET_ACCESS_KEY'),
            'region' => env('MWP_AWS_S3_DEFAULT_REGION'),
            'bucket' => env('MWP_AWS_S3_BUCKET'),
            'url' => null, // not needed
            'endpoint' => null,// not needed
            'use_path_style_endpoint' => env('MWP_AWS_S3_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',

            // used to access files in the bucket, should always end with /
            'cloudfront_access_url' => env('MWP_AWS_S3_CLOUDFRONT_ACCESS_URL'),
        ],

        'nova_s3' => [
            'driver' => 's3',
            'key' => env('NOVA_S3_KEY'),
            'secret' => env('NOVA_S3_SECRET'),
            'region' => env('NOVA_S3_REGION'),
            'bucket' => env('NOVA_S3_BUCKET', 'laravel-nova'),
            'url' => null,
            'endpoint' => null,
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'visibility' => 'public',
            'cloudfront_access_url' => env('MWP_AWS_S3_CLOUDFRONT_ACCESS_URL'),
            'throw' => false,
        ],

        'ecommerce_test_resources' => [
            'driver' => 'local',
            'root' => base_path('app/Modules/Ecommerce/tests/resources'),
        ],
        'content_test_resources' => [
            'driver' => 'local',
            'root' => base_path('app/Modules/Content/tests/Feature/resources'),
        ],
    ],

];
