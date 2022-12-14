<?php

return [
    // brand
    'brand' => 'drumeo', // this is what will go in the brand column for requests to this project

    // database
    'database_connection_name' => 'musora_laravel_mysql',
    'data_mode' => 'host', // 'host' or 'client', hosts do the db migrations, clients do not
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_bin',

    // these are the urls/methods which should be captured by the middleware and processed by this package

    // the data map tells the middleware which input variables map to which attributes that are required
    // by the package
    'requests_to_capture' => [

        //--------------------------------------------------
        // drumeo
        // 40 Songs Customer IO
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => '40 Songs',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // COOP3RDRUMM3R
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'COOP3RDRUMM3R - CC HTSPD - Lead Gen',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Drum Set Maintenance
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Drum Set Maintenance',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Fastest Way To Get Faster
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Fastest Way To Get Faster',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],


        // Getting Started On The Drums
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Drums',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],



        // Hand Technique
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Hand Technique',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Linear Drumming
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Linear Drumming',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Michael Jackson Grooves
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Grooves Of Michael Jackson',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Must-Know Drum Grooves
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Must-Know Drum Grooves',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],


        // Sucherman Sound
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Sucherman Sound',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // The Ultimate Drumming Toolbox
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'The Ultimate Drumming Toolbox',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Fastest Way To Get Faster - Facebook
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Fastest Way To Get Faster - Facebook',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Getting Started On The Drums - Facebook
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Drums - Facebook',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Getting Started On The Drums - Thrive
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Drums - Thrive',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Gavins Grooves
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Gavins Grooves',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Free Play-Alongs
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Free Play-Alongs',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Metal Play-Alongs
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Metal Play-Alongs',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Grooves Of John Bonham
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Grooves Of John Bonham',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Blog Signup
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Blog Signup',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // 2 Million Celebration
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => '2 Million Celebration',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Drumeo Awards Giveaway
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Drumeo Awards Giveaway',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // 30 Day Drummer Waitlist
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => '30 Day Drummer Waitlist',
            'brand' => 'drumeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        //--------------------------------------------------
        // pianote
        // Chord Hacks - Facebook
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Chord Hacks - Facebook',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Chord Hacks
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Chord Hacks',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Getting Started On The Piano - Facebook
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Piano - Facebook',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Getting Started On The Piano
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Piano',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Learn 3 Songs On Piano
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Learn 3 Songs On Piano',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Beginner Piano Christmas Carols
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Beginner Piano Christmas Carols',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Learn 3 Songs On Piano
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => '50 Chord Charts',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Sight Reading Made Simple
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Sight Reading Made Simple',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Blog Signup
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Blog Signup',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Riffs And Fills
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Riffs And Fills',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // 1 Million
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => '1 Million',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Classical Piano Quick Start
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Classical Piano Quick Start',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Piano In 5 Days
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Piano In 5 Days',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // The Magic of Piano Chords Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'The Magic of Piano Chords Bootcamp',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Piano For Complete Beginners Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Piano For Complete Beginners Bootcamp',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Perfect Practice Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Perfect Practice Bootcamp',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Giveaway Form
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Giveaway Form',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // FP30 Giveaway
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'FP30 Giveaway',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // 7 Days To Sight Reading
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => '7 Days To Sight Reading',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Personality Quiz Academic
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Personality Quiz Academic',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Personality Quiz Entertainer
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Personality Quiz Entertainer',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Personality Quiz Explorer
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Personality Quiz Explorer',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Personality Quiz Scientist
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Personality Quiz Scientist',
            'brand' => 'pianote',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        //--------------------------------------------------
        // guitareo
        // Acoustic Guitar Jump Start
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Acoustic Guitar Jump Start',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Guitar Chords for Hit Songs
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Guitar Chords for Hit songs',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // The Beginner Guitar Starter
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'The Beginner Guitar Starter',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // The Guitarists Toolbox

        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'The Guitarists Toolbox',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Guitar Tricks
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Guitar Tricks',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // GQ Waitlist
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'GQ Waitlist',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'leadtracker_form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Song In An Hour
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Song Hour',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Fretboard Cheatsheet
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Fretboard Cheatsheet',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Solo In An Hour
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Solo In An Hour',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Getting Started On The Acoustic Guitar
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Acoustic Guitar',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Getting Started On The Electric Guitar
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Getting Started On The Electric Guitar',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // Blog Signup
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Blog Signup',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Waitlist 2
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Guitareo Waitlist 2',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Live Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Live Bootcamp',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        // Chord Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Chord Bootcamp',
            'brand' => 'guitareo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],

        //-------------------------------------------
        // singeo
        // --------------------------------
        // Improve Any Voice
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Improve Any Voice',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Holiday Karaoke
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Holiday Karaoke',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Singeo Waitlist
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Singeo Waitlist',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Singeo Waitlist 2
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Singeo Waitlist 2',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Stop Hating Your Voice
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Stop Hating Your Voice',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Studio Giveaway
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Studio Giveaway',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Eikon Giveaway
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Eikon Giveaway',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Ultimate Giveaway
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Ultimate Giveaway',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Mic Giveaway
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Mic Giveaway',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Vocal Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Vocal Bootcamp',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Breath Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Breath Bootcamp',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Harmony Bootcamp
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Harmony Bootcamp',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
        // --------------------------------
        // Blog Signup
        [
            'path' => '/customer-io/submit-email-form',
            'method' => 'post',
            'form_name' => 'Blog Signup',
            'brand' => 'singeo',

            'input_data_map' => [
                'email' => 'email',
                'form_name' => 'form_name',
                'utm_source' => 'leadtracker_utm_source',
                'utm_medium' => 'leadtracker_utm_medium',
                'utm_campaign' => 'leadtracker_utm_campaign',
                'utm_term' => 'leadtracker_utm_term',
                'customer_io_customer_id' => 'leadtracker_customer_io_customer_id',
                'customer_io_event_name' => 'leadtracker_customer_io_event_name',
            ],
        ],
    ],
];
