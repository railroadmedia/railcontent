<?php

return [
    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME'),
    'default_active_student_max_count' => 5000,
    'route_prefix' => 'mentor',
    'helpscout_converasation_auto_assign_user' => [
        'debug' => true, //disables final assign call to help scout
        'route' => 'https://703e-50-67-89-148.ngrok.io/mentor/helpscout/conversation/new'
    ]
];
