<?php

return [
    // database
    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME','musora_laravel_mysql'),

    // endpoint middleware
    'all_routes_middleware' => [],

    // By default if a user id is passed to the service or controller functions it will be synced to all customers
    // using this custom attribute name. Typically this should refer to your users ID in your own database.
    'customer_attribute_name_for_user_id' => 'musora_user_id',

    // customer.io accounts configuration
    'accounts' => [
        'musora' => [
            'track_api_key' => env('MUSORA_CUSTOMER_IO_TRACK_API_KEY'),
            'app_api_key' => env('MUSORA_CUSTOMER_IO_APP_API_KEY'),
            'workspace_name' => env('MUSORA_CUSTOMER_IO_WORKSPACE_NAME'),
            'workspace_id' => env('MUSORA_CUSTOMER_IO_WORKSPACE_ID'),
            'site_id' => env('MUSORA_CUSTOMER_IO_SITE_ID'),
        ],
        'singeo' => [
            'track_api_key' => 'singeo_track_api_key_1',
            'app_api_key' => 'singeo_app_api_key_1',
            'workspace_name' => 'singeo_workspace_name_1',
            'workspace_id' => 'singeo_workspace_id_1',
            'site_id' => 'singeo_site_id_1',
        ],
    ],

    // form names and configuration
    'forms' => [
        'Example Form Name' => [
            'custom_attributes' => [
                'attribute_to_sync_1' => 'my attribute value 1',
                'attribute_to_sync_2' => 'my attribute value 2',
            ],
            'events' => [
                'event_to_sync_1',
                'event_to_sync_2',
            ],
            // can sync to multiple accounts using this
            'accounts_to_sync' => [
                'musora',
            ],
        ]
    ]
];
