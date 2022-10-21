<?php

return [
    'filesystems' => [
        'default' => 'musora_web_platform_s3',
        'disks' => [
            'musora_web_platform_s3' => [
                'driver' => 's3',
                'key' => env('MWP_AWS_S3_ACCESS_KEY_ID'),
                'secret' => env('MWP_AWS_S3_SECRET_ACCESS_KEY'),
                'region' => env('MWP_AWS_S3_DEFAULT_REGION'),
                'bucket' => env('MWP_AWS_S3_BUCKET'),
            ],

            'local' => [
                'driver' => 'local',
                'root' => storage_path('app'),
            ],
        ]
    ],
];
