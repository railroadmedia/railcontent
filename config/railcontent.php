<?php

return [
    // brands
    'brand' => 'brand',
    'available_brands' => ['brand'],

    // cache
    // ttl value in minutes
    'cache_duration' => 60 * 24 * 30,
    'cache_prefix' => 'railcontent',
    'cache_driver' => 'redis',

    // database
    'database_connection_name' => 'mysql',
    'connection_mask_prefix' => 'railcontent_',
    'data_mode' => 'host',
    'table_prefix' => 'railcontent_',

    // languages
    'default_language' => 'en-US',
    'available_languages' => [
        'en-US',
    ],

    // if you have any of these middleware classes in your global http kernel, they must be removed from this array
    'controller_middleware' => [
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ],

    //middleware for API requests
    'api_middleware' => [
        \Tymon\JWTAuth\Http\Middleware\RefreshToken::class,
    ],

    // filter options limitation
    'field_option_list' => [
        'instructor',
        'topic',
        'difficulty',
        'bpm',
        'style',
        'artist',
    ],

    // comments
    'comment_likes_amount_of_users' => 3,
    'commentable_content_types' => [
        'course',
        'course lesson',
    ],
    'comment_assignation_owner_ids' => [
        102905,
        8,
        5,
        87011,
        5814,
        40641,
        98085,
        63599,
        70324,
        136145,
        7776,
    ],

    // validation
    'validation' => [],

    // aws integration
    'awsS3_remote_storage' => [
        'accessKey' => env('AWS_S3_REMOTE_STORAGE_ACCESS_KEY'),
        'accessSecret' => env('AWS_S3_REMOTE_STORAGE_ACCESS_SECRET'),
        'region' => env('AWS_S3_REMOTE_STORAGE_REGION'),
        'bucket' => env('AWS_S3_REMOTE_STORAGE_BUCKET'),
    ],
    'awsCloudFront' => 'd1923uyy6spedc.cloudfront.net',

    // search
    'searchable_content_types' => ['recordings', 'courses'],
    'search_index_values' => [
        'high_value' => [
            'content_attributes' => ['slug'],
            'field_keys' => ['title', 'instructor:name'],
            'data_keys' => [],
        ],
        'medium_value' => [
            'content_attributes' => [],
            'field_keys' => ['*'],
            'data_keys' => ['*'],
        ],
        'low_value' => [
            'content_attributes' => [],
            'field_keys' => ['*'],
            'data_keys' => ['description'],
        ],
    ],

    // progress bubbling
    'allowed_types_for_bubble_progress' => [
        'started' => [],
        'completed' => [],
    ],

    // video content sync
    'video_sync' => [
        'vimeo' => [
            'brand' => [
                'client_id' => env('VIMEO_CLIENT_ID'),
                'client_secret' => env('VIMEO_CLIENT_SECRET'),
                'access_token' => env('VIMEO_ACCESS_TOKEN'),
            ],
        ],
        'youtube' => [
            'key' => env('YOUTUBE_API_KEY'),
            'brand' => [
                'user' => env('YOUTUBE_USERNAME'),
            ],
        ],
    ],

    // middleware
    'all_routes_middleware' => [],
    'user_routes_middleware' => [],
    'administrator_routes_middleware' => [],

    // decorators
    'decorators' => [
        'content' => [
            \Railroad\Railcontent\Decorators\Hierarchy\ContentSlugHierarchyDecorator::class,
            \Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator::class,
        ],
        'comment' => [
            \Railroad\Railcontent\Decorators\Comments\CommentLikesDecorator::class,
            \Railroad\Railcontent\Decorators\Entity\CommentEntityDecorator::class,
        ],
    ],

    // use collections
    'use_collections' => true,

    // content hierarchy
    'content_hierarchy_max_depth' => 3,
    'content_hierarchy_decorator_allowed_types' => [
        'content-type',
        'content-type',
    ],

    // ecommerce integration
    'enable_ecommerce_integration' => true,
    'ecommerce_product_sku_to_content_permission_name_map' => [
        'SKU' => 'name',
    ],

    // event to job listeners/map
    'event_to_job_map' => [],

    #'commentable-content-types' => [],

    'shows' => [
        'live' => [
            'title' => 'Live',
            'type' => 'live',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/show-live.jpg',
            "description" => "All Drumeo live lessons are archived to our library so if you miss one, you can still watch it in here. This includes lessons from all the guest artists we have had out as well as our satellite and in-house instructors.",
            "allowableFilters" => ['difficulty', 'instructor', 'topic', 'progress'],
            "sortedBy" => "-published_on",
        ],
        'quick-tips' => [
            'title' => 'Quick Tips',
            'type' => 'quick-tips',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/show-quick-tips.jpg',
            "description" => "These videos are great for quick inspiration or if you don’t have time to sit down and watch a full lesson. They are short and to the point, giving you tips, concepts, and exercises you can take to your kit.",
            "allowableFilters" => ['difficulty', 'instructor', 'topic', 'progress'],
            "sortedBy" => "-published_on",
        ],
        'sonor-drums' => [
            'title' => 'Sonor Drums',
            'type' => 'sonor-drums',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/sonor-drums.jpg',
            "description" => "Enjoy our official Drumeo Podcasts in video form! Whether it be discussions about drum topics or interviews with the greats you are looking for, these are an entertaining and educational way to pass the time.",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'paiste-cymbals' => [
            'title' => 'Paiste Cymbals',
            'type' => 'paiste-cymbals',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/paiste-cymbals.jpg',
            "description" => "Take a closer look at Paiste Cymbals with Jared as he explores the Paiste factory in Switzerland and interviews the people behind the amazing brand.",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'exploring-beats' => [
            'title' => 'Exploring Beats',
            'type' => 'exploring-beats',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/exploring-beats.jpg',
            "description" => "Join Carson and his extraterrestrial roommate Gary as they travel through time and space exploring some of earth's greatest hip-hop beats and delicious snacks.",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'rhythms-from-another-planet' => [
            'title' => 'Rhythms From Another Planet',
            'type' => 'rhythms-from-another-planet',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/rythms-from-another-planet.jpg',
            "description" => "Flying Saucers Over Canada! Aliens from the Horsehead Nebula are here glitching humans! Aaron assembles an assortment of numerically nimble nerds to save the day! Tag along for the adventure, Glitchings, Quintuplet Panteradies, and save the world to learn some phenomenally fancy fives!",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'boot-camps' => [
            'title' => 'Boot Camps',
            'type' => 'boot-camps',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/bootcamps.jpg',
            "description" => "Grab your sticks and practice along while watching a lesson! These boot camps are designed like workout videos so you can follow along and push your drumming at the same time.",
            "allowableFilters" => ['difficulty', 'instructor', 'topic', 'progress'],
            "sortedBy" => "-published_on",
        ],
        'challenges' => [
            'title' => 'Challenges',
            'type' => 'challenges',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/challenges.jpg',
            "description" => "Like drumming puzzles, our challenges are lessons that will take a little more brain power and practice to get down. They are a great way to motivate you to get behind the kit or pad to practice, and cover the entire gamut of drumming skill level.",
            "allowableFilters" => ['difficulty', 'instructor', 'topic', 'progress'],
            "sortedBy" => "-published_on",
        ],
        'namm-2019' => [
            'title' => 'Namm 2019',
            'type' => 'namm-2019',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/namm-show-card.jpg',
            "description" => "Take a closer look at the 2019 NAMM show, including the best and most obscure products and booths from the show, and performances from the worlds best drummers at the Drumeo booth!",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'gear-guides' => [
            'title' => 'Gear Guides',
            'type' => 'gear-guides',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/gear.jpg',
            "description" => "Drummers love their gear - and in here you will find videos on gear demos, reviews, maintenance, tuning tips and much more.",
            "allowableFilters" => ['instructor', 'topic', 'progress'],
            "sortedBy" => "-published_on",
        ],
        'solos' => [
            'title' => 'Solos',
            'type' => 'solos',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/solos.jpg',
            "description" => "Watch drum solos performed by the many different artists we have had out on Drumeo! A great way to be entertained, motivated, and to learn through amazing performances.",
            "allowableFilters" => ['instructor', 'progress'],
            "sortedBy" => "-published_on",

        ],
        'study-the-greats' => [
            'title' => 'Study The Greats',
            'type' => 'study-the-greats',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/study-the-greats.jpg',
            "description" => "Study the greats with Austin Burcham! These lessons break down the beats, licks, and ideas of some of the most famous drummers we have had out on Drumeo.",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'on-the-road' => [
            'title' => 'On The Road',
            'type' => 'on-the-road',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/on-the-road.jpg',
            "description" => "See Drumeo in action outside of the studio! This is your backstage pass to some of the biggest drum/music events in the world, as well as factory tours of your favorite drum brands.",
            "allowableFilters" => [],
            "sortedBy" => "-published_on",
        ],
        'podcasts' => [
            'title' => 'Podcasts',
            'type' => 'podcasts',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/show-podcast.jpg',
            "description" => "Enjoy our official Drumeo Podcasts in video form! Whether it be discussions about drum topics or interviews with the greats you are looking for, these are an entertaining and educational way to pass the time.",
            "allowableFilters" => [],
            "sortedBy" => "-published_on",
        ],
        'behind-the-scenes' => [
            'title' => 'Behind The Scenes',
            'type' => 'behind-the-scenes',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/behind-the-scenes.jpg',
            "description" => "Have you ever wondered what it’s like to work at the Drumeo office? 
             This is your behind the scenes look at what we do and all the shenanigans that happen day to day.",
            "allowableFilters" => [],
            "sortedBy" => "-published_on",
        ],
        'performances' => [
            'title' => 'Performances',
            'type' => 'performances',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/performances.jpg',
            "description" => "Watch the world's best drummers perform songs, duets, and other inspirational pieces. Sit back, relax, and get ready to be inspired by these amazing performances!",
            "allowableFilters" => ['instructor', 'progress'],
            "sortedBy" => "-published_on",
        ],
        '25-days-of-christmas' => [
            'title' => '25 Days of Christmas',
            'type' => '25-days-of-christmas',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/25-days-of-christmas.jpg',
            "description" => "Join Jared, Dave, and Reuben in Drumeo’s version of a Christmas Advent Calendar! You will receive a new drumming treat each day counting down to Christmas! Be sure to “Subscribe” to the calendar to make sure you never miss an episode!",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'tama-drums' => [
            'title' => 'Tama Drums',
            'type' => 'tama-drums',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/tama-drums.jpg',
            "description" => "Take a closer look at Tama Drums with Jared as he explores the Tama factory in Japan, learns about Japanese Culture, experiments with traditional Taiko drummers,  and interviews the people behind the amazing brand.",
            "allowableFilters" => [],
            "sortedBy" => "published_on",
        ],
        'question-and-answer' => [
            'title' => 'Q & A',
            'type' => 'question-and-answer',
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/question-answer.jpg',
            "description" => "Get any drum related question answered by a Drumeo instructor on our weekly Q&A episodes! You can submit as many questions as you like by clicking the button below, and either join us live for the next episode, or check for your answer in the archived videos below!",
            "allowableFilters" => [],
            "sortedBy" => "-published_on",
        ],
    ],
    'onboardingContentIds' => [],
];