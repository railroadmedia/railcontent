<?php

return [
    // brand, this gets swapped dynamically based on the current domain and members area page
    'brand' => 'musora',

    // database
    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME', 'musora_laravel_mysql'),

    // endpoint middleware
    'all_routes_middleware' => [
        'web_public',
    ],

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
        'drumeo' => [
            'track_api_key' => env('DRUMEO_CUSTOMER_IO_TRACK_API_KEY'),
            'app_api_key' => env('DRUMEO_CUSTOMER_IO_APP_API_KEY'),
            'workspace_name' => env('DRUMEO_CUSTOMER_IO_WORKSPACE_NAME'),
            'workspace_id' => env('DRUMEO_CUSTOMER_IO_WORKSPACE_ID'),
            'site_id' => env('DRUMEO_CUSTOMER_IO_SITE_ID'),
        ],
        'pianote' => [
            'track_api_key' => env('PIANOTE_CUSTOMER_IO_TRACK_API_KEY'),
            'app_api_key' => env('PIANOTE_CUSTOMER_IO_APP_API_KEY'),
            'workspace_name' => env('PIANOTE_CUSTOMER_IO_WORKSPACE_NAME'),
            'workspace_id' => env('PIANOTE_CUSTOMER_IO_WORKSPACE_ID'),
            'site_id' => env('PIANOTE_CUSTOMER_IO_SITE_ID'),
        ],
        'guitareo' => [
            'track_api_key' => env('GUITAREO_CUSTOMER_IO_TRACK_API_KEY'),
            'app_api_key' => env('GUITAREO_CUSTOMER_IO_APP_API_KEY'),
            'workspace_name' => env('GUITAREO_CUSTOMER_IO_WORKSPACE_NAME'),
            'workspace_id' => env('GUITAREO_CUSTOMER_IO_WORKSPACE_ID'),
            'site_id' => env('GUITAREO_CUSTOMER_IO_SITE_ID'),
        ],
        'singeo' => [
            'track_api_key' => env('SINGEO_CUSTOMER_IO_TRACK_API_KEY'),
            'app_api_key' => env('SINGEO_CUSTOMER_IO_APP_API_KEY'),
            'workspace_name' => env('SINGEO_CUSTOMER_IO_WORKSPACE_NAME'),
            'workspace_id' => env('SINGEO_CUSTOMER_IO_WORKSPACE_ID'),
            'site_id' => env('SINGEO_CUSTOMER_IO_SITE_ID'),
        ],
    ],

    // form names and configuration
    'forms' => [
        'drumeo' => [
            'Kristinas Top 25' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_kristinas-top-25',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            '40 Songs' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_top-40-songs',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Fastest Way To Get Faster' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_fastest-way-to-get-faster',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Fastest Way To Get Faster - Facebook' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_fastest-way-to-get-faster',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Sucherman Sound' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_sucherman-sound',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'The Ultimate Drumming Toolbox' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_ultimate-toolbox',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Hand Technique' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_hand-technique',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Getting Started On The Drums' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_getting-started',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Getting Started On The Drums - Facebook' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_getting-started',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Getting Started On The Drums - Thrive' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_getting-started',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Must-Know Drum Grooves' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_must-know',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Grooves Of Michael Jackson' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_mj-grooves',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Drum Set Maintenance' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_drum-maintenence',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Linear Drumming' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_cooper-linear',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'COOP3RDRUMM3R - CC HTSPD - Lead Gen' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_cooper-htspd',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Gavins Grooves' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_gavins-grooves',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Free Play-Alongs' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_free-playalongs',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Metal Play-Alongs' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_metal-playalongs',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Grooves Of John Bonham' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_grooves-of-john-bonham',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Blog Signup' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_blog-sign-up',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            '2 Million Celebration' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_2-million',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Drumeo Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_giveaway',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Drumeo Drumset Giveaway' => [
                'custom_attributes' => [
                    'first_name' => 'required|string'
                ],
                'events' => [
                    'drumeo_prospect_drumset-giveaway-2023',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
                'attributes' => [
                    'first_name' => 'First Name',
                    'email' => 'Email'
                ],
            ],
            'Drumeo Giveaway Rafflepress' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_rafflepress-giveaway',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Drumeo Awards Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_awards-giveaway',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Drumeo Awards Giveaway 2' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_awards-giveaway-2023',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            '30 Day Drummer Waitlist' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_30dd-waitlist',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            '30 Day Chops Waitlist' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_30dc-waitlist',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
            'Alesis Waitlist' => [
                'custom_attributes' => [],
                'events' => [
                    'drumeo_prospect_alesis-waitlist',
                ],
                'accounts_to_sync' => [
                    'drumeo',
                ],
            ],
        ],
        'pianote' => [
            'Metronome Notice' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_metronome-notice',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Blues Piano Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_blues-piano-bootcamp',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Chord Hacks' => [
                'custom_attributes' => [
                    'first_name' => 'required|string'
                ],
                'events' => [
                    'pianote_prospect_chord-hacks',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
                'attributes' => [
                    'first_name' => 'First Name',
                    'email' => 'Email'
                ],
            ],
            'Chord Hacks - Facebook' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_chord-hacks',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Getting Started On The Piano' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_getting-started',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Getting Started On The Piano - Facebook' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_getting-started',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Sight Reading Made Simple' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_sight-reading-made-simple',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Learn 3 Songs On Piano' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_learn-3-songs',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'NPPSH Waitlist' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_nppsh-waitlist',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Easy Chords Waitlist' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_easy-chords-waitlist',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Beginner Piano Christmas Carols' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_christmas-carols',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Beautiful Christmas Classics' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_beautiful-christmas-classics',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Digital Chords And Scales' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_digital-chords-and-scales',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Blog Signup' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_blog-signup',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Easy Classical Songs' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_easy-classical-songs',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'F Sharp Minor' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_f-sharp-minor',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'The Minor Blues Made Easy' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_minor-blues',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pentatonic Scale' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_pentatonic-scale',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Practice Chord Inversions' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_chord-inversions',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Riffs And Fills' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_riffs-and-fills',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            '50 Chord Charts' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_50-free-chord-charts',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            '1 Million' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_1-million',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Classical Piano Quick Start' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_classical-piano',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Piano In 5 Days' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_piano-in-5-days',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Piano For Complete Beginners Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_complete-beginner-bootcamp',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Perfect Practice Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_perfect-practice-bootcamp',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Giveaway Form' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_giveaway',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'FP30 Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_giveaway-2023',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote Awards Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_awards-giveaway',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Osmose Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_osmose-giveaway',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            '7 Days To Sight Reading' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_7-days',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Waltz in A Minor' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_waltz-in-a-minor',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Personality Quiz Academic' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_personality-quiz-academic',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Personality Quiz Entertainer' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_personality-quiz-entertainer',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Personality Quiz Explorer' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_personality-quiz-explorer',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Personality Quiz Scientist' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_personality-quiz-scientist',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote Webinar' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_webinar-registrations',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote webinar Joined' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_webinar-joined',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote Webinar Watched' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_webinar-watched',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote Webinar Replay Watched' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_webinar-replay-watched',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote Webinar Missed' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_webinar-missed',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
            'Pianote Webinar Finished' => [
                'custom_attributes' => [],
                'events' => [
                    'pianote_prospect_webinar-finished',
                ],
                'accounts_to_sync' => [
                    'pianote',
                ],
            ],
        ],
        'guitareo' => [
            'The Guitarists Toolbox' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_toolbox',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Song Hour' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_song-hour',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Acoustic Guitar Jump Start' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_acoustic-jumpstart',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Guitar Chords for Hit Songs' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_guitar-chords-for-hit-songs',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Guitar Tricks' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_guitar-tricks',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'The Beginner Guitar Starter' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_starter-kit',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Blog Signup' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_blog-signup',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Guitareo Waitlist 2' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_waitlist_signup',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Fretboard Cheatsheet' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_fretboard-cheatsheet',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Solo In An Hour' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_solo-in-an-hour',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Getting Started On The Acoustic Guitar' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_getting-started-on-the-acoustic-guitar',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Getting Started On The Electric Guitar' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_getting-started-on-the-electric-guitar',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Live Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_live-bootcamp',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
            'Chord Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'guitareo_prospect_chord-bootcamp',
                ],
                'accounts_to_sync' => [
                    'guitareo',
                ],
            ],
        ],
        'singeo' => [
            'Improve Any Voice' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_improve-any-voice',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Holiday Karaoke' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_holiday-karaoke',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Singeo Waitlist' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_launch-waitlist',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Stop Hating Your Voice' => [
                'custom_attributes' => [],
                'events' => [
                    'singo_prospect_stop-hating_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Eikon Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'singo_prospect_eikon_giveaway_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Ultimate Giveaway' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_ultimate_giveaway_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Vocal Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_vocal-bootcamp_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Breath Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_breath-bootcamp_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Harmony Bootcamp' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_harmony-bootcamp_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
            'Blog Signup' => [
                'custom_attributes' => [],
                'events' => [
                    'singeo_prospect_blog_signup',
                ],
                'accounts_to_sync' => [
                    'singeo',
                ],
            ],
        ],
    ]
];
