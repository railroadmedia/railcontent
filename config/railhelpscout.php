<?php

return [
    // database
    'database_connection_name' => 'musora_mysql',
    'data_mode' => 'client', // 'host' or 'client', hosts do the db migrations, clients do not

    'helpscout_credentials' => [
        'app_id' => env('HELPSCOUT_APP_ID'),
        'app_secret' => env('HELPSCOUT_APP_SECRET'),
    ],

    'helpscout_tracking_beacon_id' =>
        [
            'drumeo' => env('DRUMEO_HELPSCOUT_TRACKING_BEACON_ID', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
            'pianote' => env('PIANOTE_HELPSCOUT_TRACKING_BEACON_ID', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
            'guitareo' => env('GUITAREO_HELPSCOUT_TRACKING_BEACON_ID', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
            'singeo' => env('SINGEO_HELPSCOUT_TRACKING_BEACON_ID', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
        ]
];
