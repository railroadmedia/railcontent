<?php

return [
    // database
    'database_connection_name' => env('DB_MUSORA_LARAVEL_MYSQL_WRITER_ONLY','musora_laravel_mysql_writer_only'),

    // cache
    // ttl value in minutes
    'cache_duration' => 60 * 24,
    'cache_prefix' => 'user_points',
    'cache_driver' => 'array',

    // host does the db migrations, clients do not
    'data_mode' => 'client', // 'host' or 'client'

    // brand
    'brand' => 'musora',

    // tables
    'tables' => [
        'user_points' => 'points_user_points',
    ],

    // mapping points to tiers
    'tier_default' => 'Drumeo Member',
    'tier_map' => [
        ['name' => 'Casual',                'start' => 0,         ],
        ['name' => 'Enthusiast I',          'start' => 100,       ],
        ['name' => 'Enthusiast II',         'start' => 250,       ],
        ['name' => 'Pro I',                 'start' => 500,       ],
        ['name' => 'Pro II',                'start' => 1000,      ],
        ['name' => 'Pro III',               'start' => 2500,      ],
        ['name' => 'Master I',              'start' => 10000,     ],
        ['name' => 'Master II',             'start' => 25000,     ],
        ['name' => 'Master III',            'start' => 100000,    ],
        ['name' => 'Drumeo Legend',         'start' => 250000,    ],
        ['name' => 'Legends: Starr',        'start' => 500000,    ],
        ['name' => 'Legends: Erskine',      'start' => 1000000,   ],
        ['name' => 'Legends: Cobham',       'start' => 1500000,   ],
        ['name' => 'Legends: Garibaldi',    'start' => 2000000,   ],
        ['name' => 'Legends: Peart',        'start' => 2500000,   ],
        ['name' => 'Legends: Bonham',       'start' => 3000000,   ],
        ['name' => 'Legends: Colaiuta',     'start' => 4000000,   ],
        ['name' => 'Legends: Gadd',         'start' => 5000000,   ],
        ['name' => 'Legends: Porcaro',      'start' => 75000000,  ],
        ['name' => 'Legends: Rich',         'start' => 100000000, ],
    ],
];
