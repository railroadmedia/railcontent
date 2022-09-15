<?php

return [
    // database
    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME'),

    'helpscout_credentials' => [
        'app_id' => env('HELPSCOUT_APP_ID'),
        'app_secret' => env('HELPSCOUT_APP_SECRET'),
    ],

    'helpscout_tracking_beacon_id' => env('HELPSCOUT_TRACKING_BEACON_ID'),
    'webhook_secret' => '0961023204554833aa34b4feca815a12',
];
