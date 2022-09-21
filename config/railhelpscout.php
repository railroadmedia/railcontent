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
            'drumeo' => env('HELPSCOUT_TRACKING_BEACON_ID_DRUMEO', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
            'pianote' => env('HELPSCOUT_TRACKING_BEACON_ID_PIANOTE', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
            'guitareo' => env('HELPSCOUT_TRACKING_BEACON_ID_GUITAREO', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
            'singeo' => env('HELPSCOUT_TRACKING_BEACON_ID_SINGEO', '9f119028-29b4-4fcd-8b9d-03c86f3d2521'),
        ]
];
