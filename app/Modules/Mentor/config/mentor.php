<?php

return [
    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME'),
    'default_active_student_max_count' => 5000,
    'route_prefix' => 'mentors',

    //Default mentor mailbox is the dev sandbox
    'helpscout_mailboxes' => explode(',', env('HELPSCOUT_MENTOR_MAILBOXES_TO_WATCH', '253239')),
];
