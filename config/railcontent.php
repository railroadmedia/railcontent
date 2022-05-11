<?php

use Railroad\Railcontent\Services\ContentService;

return [
    'cache_duration' => 60 * 12,
    'database_connection_name' => env('DB_DEFAULT_CONNECTION_NAME'),
    'connection_mask_prefix' => 'railcontent_',
    'data_mode' => env('RAILCONTENT_DATA_MODE', 'host'),

    'table_prefix' => 'railcontent_',

    'brand' => 'musora',
    'available_brands' => ['drumeo', 'pianote', 'guitareo', 'singeo'],

    'default_language' => 'en-US',
    'available_languages' => [
        'en-US',
    ],

    'field_option_list' => [
        'instructor',
        'topic',
        'difficulty',
        'bpm',
        'style',
        'artist',
        'vimeo_video_id',
        'focus',
        'genre'
//        'video'
    ],
    'commentable_content_types' => [
        'course-part',
        'pack-bundle-lesson',
        'semester-pack-lesson',
        'play-along',
        'recording',
        'song',
        'student-focus',
        'ha-oemurd-pmac',
        'learning-path-lesson',
        'rudiment',
        'coach-stream',
        'coach',
    ],
    'comment_assignation_owner_ids' => [
        102905,
        5,
        87011,
        5814,
        40641,
        98085,
        63599,
        70324,
        136145,
        7,
        96326,
        8,
        365658,
        154138,
        149630,
        344840,
        149629,
        349001,
    ],
    'searchable_content_types' => [
        'learning-path',
        'learning-path-lesson',
        'learning-path-course',
        'learning-path-level',
        'coach-stream'
    ],
    'validation' => [
        'drumeo' => [
            'library-lesson' => [
                'slug' => 'required|max:64',
                'fields' => [
                    'title|string' => 'required|string|min:3|max:64',
                    'instructor|multiple' => 'required|exists:content,id',

                ],
                'datum' => [
                    'description|string' => 'required|max:1024',
                ],
            ],
        ],
    ],

    'awsS3_remote_storage' => [
        'accessKey' => env('S3_KEY'),
        'accessSecret' => env('S3_SECRET'),
        'region' => env('S3_REGION'),
        'bucket' => env('S3_BUCKET'),
    ],
    'awsCloudFront' => 'dzryyo1we6bm3.cloudfront.net',

    'indexable_content_statuses' => [
        ContentService::STATUS_PUBLISHED,
        ContentService::STATUS_SCHEDULED,
        ContentService::STATUS_ARCHIVED,
    ],

    'search_index_values' => [
        'high_value' => [
            'content_attributes' => ['slug'],
            'field_keys' => ['title', 'instructor:name'],
            'data_keys' => [],
        ],
        'medium_value' => [
            'content_attributes' => [],
            'field_keys' => ['*'],
            'data_keys' => [],
        ],
        'low_value' => [
            'content_attributes' => [],
            'field_keys' => ['*'],
            'data_keys' => ['description'],
        ],
    ],

    'allowed_types_for_bubble_progress' => [
        'started' => [
            'course',
            'pack-bundle',
            'pack',
            'semester-pack',
            'semester-pack-lesson',
            'assignment',
            'pack-bundle-lesson',
            'course-part',
            'play-along',
            'song',
            'student-focus',
            'rudiment',
            'assignment',
            'recording',
            'learning-path',
            'learning-path-lesson',
            'learning-path-course',
            'learning-path-level'
        ],
        'completed' => [
            'course',
            'course-part',
            'learning-path',
            'pack-bundle',
            'pack',
            'semester-pack',
            'semester-pack-lesson',
            'assignment',
            'pack-bundle-lesson',
            'course-part',
            'play-along',
            'song',
            'student-focus',
            'rudiment',
            'assignment',
            'recording',
            'learning-path-lesson',
            'learning-path-course',
            'learning-path-level'
        ],
    ],

    'video_sync' => [
        'vimeo' => [
            'musora' => [
                'client_id' => env('VIMEO_CLIENT_ID_DRUMEO'),
                'client_secret' => env('VIMEO_CLIENT_SECRET_DRUMEO'),
                'access_token' => env('VIMEO_ACCESS_TOKEN_DRUMEO'),
            ],
        ],
        'youtube' => [
            'key' => env('YOUTUBE_API_KEY'),
            'musora' => [
                'user' => env('YOUTUBE_USERNAME'),
            ],
        ],
        'youtube_client_api' => [
            'client_id' => env('YOUTUBE_API_CLIENT_ID', env('YOUTUBE_API_CLIENT_ID')),
            'client_secret' => env('YOUTUBE_API_CLIENT_SECRET', env('YOUTUBE_API_CLIENT_SECRET')),
            'refresh_token' => env('YOUTUBE_API_CLIENT_REFRESH_TOKEN', env('YOUTUBE_API_CLIENT_REFRESH_TOKEN')),
        ],
    ],

    'all_routes_middleware' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class,
        \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
        \App\Http\Middleware\SetContentPermissions::class,
    ],

    'user_routes_middleware' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Modules\UserManagementSystem\Middleware\AuthenticatedOnly::class,
        \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
        \App\Http\Middleware\SetContentPermissions::class,
    ],
    'administrator_routes_middleware' => ['auth.admin'],

    //middleware for API requests
    'api_middleware' => [
        \Modules\UserManagementSystem\Middleware\AuthenticateIfAvailable::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \App\Modules\Brand\Middleware\SetLastUsedBrand::class,
        \App\Http\Middleware\SetContentPermissions::class,
    ],

    'cache_prefix' => 'musora_railcontent_',
    'cache_driver' => 'array',

    'decorators' => [
        'content' => [
            \Railroad\Railcontent\Decorators\UserProgress\ContentUserProgressDecorator::class,
            \Railroad\Railcontent\Decorators\Entity\ContentEntityDecorator::class,
            \App\Decorators\Content\UrlDecorator::class,
            \App\Decorators\Content\InstructorDecorator::class,
            \App\Decorators\Content\AddedToPrimaryPlaylistDecorator::class,
            \App\Decorators\Content\ContentTimezoneDecorator::class,
            \App\Decorators\Content\PianoteFoundationsLearningPathDecorator::class,
            \App\Decorators\Content\LearningPathLevelDecorator::class,
            \App\Decorators\Content\ChapterDecorator::class,
            \App\Decorators\Content\LessonAssignmentDecorator::class, // this one
            \App\Decorators\Content\MultiPartParentDecorator::class, // this one
            \App\Decorators\Content\ContentLikesDecorator::class, // this one
            \App\Decorators\Content\ResourceDecorator::class, // this one
            \App\Decorators\Content\ContentExperienceDecorator::class,
//            \App\Decorators\Content\ContentUserWatchPositionDecorator::class, // todo: media playback tracker
            \App\Decorators\Content\PackBundleLessonDecorator::class,
            \App\Decorators\Content\PackBundleDecorator::class,
            \App\Decorators\Content\PackDecorator::class,
            \App\Decorators\Content\PianoteMethodLearningPathDecorator::class,
            \App\Decorators\Content\LearningPathCourseDecorator::class,
            \App\Decorators\Content\LearningPathLessonDecorator::class,
            \App\Decorators\Content\NewDecorator::class,
            \App\Decorators\Content\LiveEventDecorator::class,
            \App\Decorators\Content\DefaultDifficultyDecorator::class,
            \App\Decorators\Content\AssignmentXPDecorator::class,

            \App\Decorators\Content\CourseDecorator::class,
            \App\Decorators\Content\CoursePartDecorator::class,
            \App\Decorators\Content\ShowsDecorator::class,
            \App\Decorators\Content\SongsDecorator::class,
            \App\Decorators\Content\PlayAlongDecorator::class,
            \App\Decorators\Content\StudentFocusDecorator::class,
            \App\Decorators\Content\RudimentDecorator::class,

            \App\Decorators\Content\SemesterPackDecorator::class,
            \App\Decorators\Content\SemesterPackLessonDecorator::class,

            // cant the level rank stuff use the RC updates for user progress label calculated on progress update?
            \App\Decorators\Content\DrumeoMethodLearningPathDecorator::class, // REALLY needs optimization

        ],
        'comment' => [
            \Railroad\Railcontent\Decorators\Entity\CommentEntityDecorator::class,
            \Railroad\Railcontent\Decorators\Comments\CommentLikesDecorator::class,
            \App\Decorators\Comments\CommentUserDecorator::class,
            \App\Decorators\Comments\CommentLikesUserDecorator::class,
        ],
        'comment_likes' => [
            \App\Decorators\Content\ContentCommentLikesUserDecorator::class,
        ],
        'content_likes' => [
            \App\Decorators\Content\ContentLikesUserDecorator::class,
        ],
    ],

    // specific decorator configs

    // use collections
    'use_collections' => true,

    // comments
    'comment_likes_amount_of_users' => 3,

    // content hierarchy
    'content_hierarchy_max_depth' => 3,
    'content_hierarchy_decorator_allowed_types' => [
        'learning-path',
        'course',
        'course-part',
    ],

    // ['type' => depth]
    'content_types_and_depth_to_calculate_hierarchy_higher_key_progress' => [
        'learning-path',
    ],

    // for schedule page
    'semester-packs-for-calendars' => [
        'drumeo' => [
            'rock-drumming-masterclass-january-2019-semester',
            'drum-technique-made-easy-april-2019-semester',
            'rock-drumming-masterclass-july-2019-semester',
        ],
    ],

    'semester-pack-schedule-labels' => [
        'drumeo' => [
            'rock-drumming-masterclass-january-2019-semester' => 'rock-drumming-masterclass',
            'drum-technique-made-easy-april-2019-semester' => 'drum-technique-made-easy',
        ],
    ],

    'commentable-content-types' => ['published', 'archived'],

    'onboardingContentIds' => [20977, 197893, 218057],

    'cataloguesMetadata' => [
        'all' => [
            'name' => 'New Content',
            'shortname' => 'Content',
            'icon' => 'fas fa-star',
            'description' => "Here's a list of every lesson that's been published in Drumeo. Browse on your
                own or use search to find whatever it is you'd like to learn!",
            'allowableFilters' => [],
            'sortBy' => '-published_on',
        ],
        'subscribed' => [
            'name' => 'Subscribed',
            'shortname' => 'Content',
            'icon' => 'fas fa-bell',
            'description' => "This is a list of all of the releases by the coaches and topics that you have subscribed to across the member's area. You can filter by the type of content it is, or use the search bar to find all lessons by a specific coach or topic! ",
            'allowableFilters' => [],
            'sortBy' => '-published_on',
        ],
        'coaches' => [
            'name' => 'Coaches',
            'icon' => 'icon-coach',
            'description' => "This is where you’ll find all of our step-by-step video courses.
                    Make sure to use the filters on this page to sort by level, topic, or instructor so
                    you can find the perfect lessons for you.",
            'allowableFilters' => ['progress'],
            'sortBy' => '-published_on',
        ],
        'courses' => [
            'name' => 'Courses',
            'icon' => 'icon-courses',
            'description' => "This is where you’ll find all of our step-by-step video courses.
                    Make sure to use the filters on this page to sort by level, topic, or instructor so
                    you can find the perfect lessons for you.",
            'allowableFilters' => ['difficulty', 'instructor', 'topic', 'progress'],
            'sortBy' => '-published_on',
        ],
        'songs' => [
            'name' => 'Songs',
            'icon' => 'icon-songs',
            'description' => "One of the best things about learning the drums is playing along
                    to your favorite songs! Here you’ll find song breakdowns for music by popular bands
                    from a range of eras and styles.",
            'allowableFilters' => ['difficulty', 'style', 'artist', 'progress'],
            'sortBy' => 'slug',
        ],
        'student-focus' => [
            'name' => 'Student Focus',
            'icon' => 'icon-student-focus',
            'description' => "What do you want to focus on next? This is where you can submit your
                    student plan application and watch videos where we’ll break down student videos and offer
                    tips to improve your playing.",
            'allowableFilters' => ['instructor', 'progress'],
            'sortBy' => '-published_on',
        ],
        'rudiments' => [
            'name' => 'Rudiments',
            'icon' => 'icon-drums',
            'description' => "Hi, I'm Dave from Drumeo - and we're excited to help you learn all 40 drum
                    rudiments. You can click on each rudiment below to get started.",
            'allowableFilters' => ['topic', 'progress'],
            'sortBy' => 'sort',
        ],
        'gear-guides' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/gear.jpg',
            'name' => 'Gear Guides',
            'icon' => 'icon-shows',
            'description' => "Drummers love their gear - and in here you will find videos on gear demos,
                    reviews, maintenance, tuning tips and much more.",
            'allowableFilters' => ['instructor', 'progress'],
            'sortBy' => '-published_on',
        ],
        'challenges' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/challenges.jpg',
            'name' => 'Challenges',
            'icon' => 'icon-shows',
            'description' => "Like drumming puzzles, our challenges are lessons that will take a little
                    more brain power and practice to get down. They are a great way to motivate you to get behind
                    the kit or pad to practice, and cover the entire gamut of drumming skill level.",
            'allowableFilters' => ['difficulty', 'instructor', 'topic', 'progress'],
            'sortBy' => '-published_on',
        ],
        'boot-camps' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/bootcamps.jpg',
            'name' => 'Boot Camps',
            'icon' => 'icon-shows',
            'description' => "Grab your sticks and practice along while watching a lesson! These boot camps
                    are designed like workout videos so you can follow along and push your drumming at the same time.",
            'allowableFilters' => ['difficulty', 'instructor', 'topic', 'progress'],
            'sortBy' => '-published_on',
        ],
        'quick-tips' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/show-quick-tips.jpg',
            'name' => 'Quick Tips',
            'icon' => 'icon-shows',
            'description' => "These videos are great for quick inspiration or if you don’t have time to sit
                    down and watch a full lesson. They are short and to the point, giving you tips, concepts,
                    and exercises you can take to your kit.",
            'allowableFilters' => ['difficulty', 'instructor', 'topic', 'progress'],
            'sortBy' => '-published_on',
        ],
        'podcasts' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/show-podcast.jpg',
            'name' => 'The Drumeo Podcast',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Enjoy our official Drumeo Podcasts in video form! Whether it be discussions
                    about drum topics or interviews with the greats you are looking for, these are an entertaining
                    and educational way to pass the time.",
            'allowableFilters' => [],
            'sortBy' => '-sort',
        ],
        'on-the-road' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/on-the-road.jpg',
            'name' => 'On The Road',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "See Drumeo in action outside of the studio! This is your backstage pass to
                    some of the biggest drum/music events in the world, as well as factory tours of your favorite
                    drum brands.",
            'allowableFilters' => [],
            'sortBy' => '-published_on',
        ],
        'behind-the-scenes' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/behind-the-scenes.jpg',
            'name' => 'Behind the Scenes',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Have you ever wondered what it’s like to work at the Drumeo office?
                    This is your behind the scenes look at what we do and all the shenanigans that happen day to day.",
            'allowableFilters' => [],
            'sortBy' => '-sort',
        ],
        'study-the-greats' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/study-the-greats.jpg',
            'name' => 'Study the Greats',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Study the greats with Austin Burcham! These lessons break down the beats,
                    licks, and ideas of some of the most famous drummers we have had out on Drumeo.",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
        'live' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/show-live.jpg',
            'name' => 'Live',
            'shortname' => 'Live Lessons',
            'icon' => 'icon-shows',
            'description' => "All Drumeo live lessons are archived to our library so if you miss one, you can
                    still watch it in here. This includes lessons from all the guest artists we have had out as well
                    as our satellite and in-house instructors.",
            'allowableFilters' => ['difficulty', 'instructor', 'topic', 'progress'],
            'sortBy' => '-published_on',
        ],
        'solos' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/solos.jpg',
            'name' => 'Solos',
            'icon' => 'icon-shows',
            'description' => "Watch drum solos performed by the many different artists we have had out
                    on Drumeo! A great way to be entertained, motivated, and to learn through amazing performances.",
            'allowableFilters' => ['instructor', 'progress'],
            'sortBy' => '-published_on',
        ],
        'performances' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/performances.jpg',
            'name' => 'Performances',
            'icon' => 'icon-shows',
            'description' => "Watch the world's best drummers perform songs, duets, and other inspirational
                    pieces. Sit back, relax, and get ready to be inspired by these amazing performances!",
            'allowableFilters' => ['instructor', 'progress'],
            'sortBy' => '-published_on',
        ],
        'exploring-beats' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/exploring-beats.jpg',
            'name' => 'Exploring Beats',
            'icon' => 'icon-shows',
            'description' => "Join Carson and his extraterrestrial roommate Gary as they travel through time and space exploring some of earth's greatest hip-hop beats and delicious snacks.",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
        'sonor-drums' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/sonor-drums.jpg',
            'name' => 'Sonor Drums: A Drumeo Documentary',
            'shortname' => 'Videos',
            'icon' => 'icon-shows',
            'description' => "Take a closer look at Sonor Drums with Jared as he explores the Sonor Factory in Bad Berleburg Germany and interviews the people behind the amazing brand.",
            'allowableFilters' => [],
            'sortBy' => 'published_on',
        ],
        'paiste-cymbals' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/paiste-cymbals.jpg',
            'name' => 'Paiste Cymbals: A Drumeo Documentary',
            'shortname' => 'Videos',
            'icon' => 'icon-shows',
            'description' => "Take a closer look at Paiste Cymbals with Jared as he explores the Paiste factory in Switzerland and interviews the people behind the amazing brand.",
            'allowableFilters' => [],
            'sortBy' => 'published_on',
        ],
//        '25-days-of-christmas' => [
//            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/advent-calendar-show-card.jpg',
//            'name' => '25 Days of Christmas',
//            'shortname' => 'Videos',
//            'icon' => 'icon-shows',
//            'description' => "Join Jared, Dave, and Reuben in Drumeo’s version of a Christmas Advent Calendar! You will receive a new drumming treat each day counting down to Christmas! Be sure to “Subscribe” to the calendar to make sure you never miss an episode!",
//            'allowableFilters' => [],
//            'sortBy' => 'sort',
//        ],
        'rhythms-from-another-planet' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/rythms-from-another-planet.jpg',
            'name' => 'Rhythms From Another Planet',
            'shortname' => 'Videos',
            'icon' => 'icon-shows',
            'description' => "Flying Saucers Over Canada! Aliens from the Horsehead Nebula are here glitching humans! Aaron assembles an assortment of numerically nimble nerds to save the day! Tag along for the adventure, Glitchings, Quintuplet Panteradies, and save the world to learn some phenomenally fancy fives!",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
//        'namm-2019' => [
//            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/namm-show-card.jpg',
//            'name' => 'NAMM 2019',
//            'shortname' => 'Episodes',
//            'icon' => 'icon-shows',
//            'description' => "Take a closer look at the 2019 NAMM show, including the best and most obscure products and booths from the show, and performances from the worlds best drummers at the Drumeo booth!",
//            'allowableFilters' => [],
//            'sortBy' => 'published_on',
//        ],
        'tama-drums' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/tama-drums.jpg',
            'name' => 'Tama Drums',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Take a closer look at Tama Drums with Jared as he explores the Tama factory in Japan, learns about Japanese Culture, experiments with traditional Taiko drummers,  and interviews the people behind the amazing brand.",
            'allowableFilters' => [],
            'sortBy' => 'published_on',
        ],
        'question-and-answer' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/question-answer.jpg',
            'name' => 'Q & A',
            'shortname' => 'Lessons',
            'icon' => 'icon-shows',
            'description' => "Get any drum related question answered by a Drumeo instructor on our weekly Q&A episodes! You can submit as many questions as you like by clicking the button below, and either join us live for the next episode, or check for your answer in the archived videos below!",
            'allowableFilters' => [],
            'sortBy' => '-published_on',
        ],
        'student-collaborations' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/student-collaborations.jpg',
            'name' => 'Drumeo Monthly Collaborations',
            'shortname' => 'Collaborations',
            'icon' => 'icon-shows',
            'description' => "Collaborate with the community with Drumeo Monthly Collaborations! Each month a new Play-Along is chosen and members are tasked to submit their videos playing along to the song. At the end of each month, every video is joined together to create a single performance!",
            'allowableFilters' => [],
            'sortBy' => '-published_on',
        ],
//        'camp-drumeo-ah' => [
//            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/camp-drumeo-ah.jpg',
//            'name' => 'Camp Drumeo-Ah: Summer 2019',
//            'shortname' => 'Episodes',
//            'icon' => 'icon-shows',
//            'description' => "Welcome to Camp Drum-eh-oh-ah! I’m K-Rad, the camp counselor, and are you in for a treat fellow drummers :). Get your sunscreen on and take your sticks out of hiding because we are in for some super awesome fun this summer!!!",
//            'allowableFilters' => ['instructor'],
//            'sortBy' => '-published_on',
//        ],
        'diy-drum-experiments' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/diy-drum-experiments.jpg',
            'name' => 'DIY Drum Experiments',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Step into David Raouf’s workshop where he will show you how to repurpose old and broken drum gear into usable and functional items! Whether you are a handyman or not, this show will give you unique and creative ideas and drum hacks that you have never seen before!",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
        'rhythmic-adventures-of-captain-carson' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/raocc-showcard.jpg',
            'name' => 'Rhythmic Adventures of Captain Carson',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "In The Rhythmic Adventures of Captain Carson, kids will join Captain Carson and his best friends Ricky (the robot) and Gary (the alien) as they fly through space and learn fun musical grooves. But they’ve got to be quick, because the tricky Groove Troll is trying to steal their groove!",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
        'in-rhythm' => [
            'thumbnailUrl' => 'https://dpwjbsxqtam5n.cloudfront.net/shows/in-rhythm-show-card.jpg',
            'name' => 'In Rhythm',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Witness a day in the life of a professional touring drummer on the road! “In Rhythm” gives you an inside look into professional drummers, what they do on the road outside of performing, and how they warm-up and prepare for the big stage!",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
        'backstage-secrets' => [
            'thumbnailUrl' => 'https://cdn.musora.com/image/fetch/c_fill,w_500,h_500,q_auto:good/https://d1923uyy6spedc.cloudfront.net/RushDoc-Neil-02.jpg',
            'name' => 'Backstage Secrets',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "Join the roadies of Rush and get a firsthand look at what it's like to be part of one of our favorite bands. You’re going on an exciting, behind-the-scenes journey to their 2008 Snakes & Arrows Concert Tour - an exclusive invitation to witness the reveal of all of the band’s backstage secrets. Roadies are the unsung heroes of any band - and being a roadie with a top-rated, world-famous rock and roll band is a highly coveted job. It may appear to be all glamour and adventure, but it can be a grueling marathon of 18-hour workdays!",
            'allowableFilters' => [],
            'sortBy' => 'sort',
        ],
        'the-history-of-electronic-drums' => [
            'thumbnailUrl' => 'https://cdn.musora.com/image/fetch/c_fill,w_500,h_500,q_auto:good/https://imagedelivery.net/0Hon__GSkIjm-B_W77SWCA/31847ba4-02d4-4c6a-4507-32b40284a000/public',
            'name' => 'The History Of Electronic Drums',
            'shortname' => 'Episodes',
            'icon' => 'icon-shows',
            'description' => "The music industry is dominated by electronic music and electronic drums. For the first time ever, we’ve gathered 14 of the most innovative electronic drum kits to learn more about how they were made, how they work, and most importantly, how they sound.",
            'allowableFilters' => [],
            'sortBy' => 'sort',
            'amountOfFutureLessonsToShow' => 10,
            'showFutureLessonAtTopOrBottom' => 'bottom',
        ],
    ],

//    ---------------------------------------
//    Content Types
    /**
     * The order of the show types it's IMPORTANT.
     * The show cards on 'Shows' page are displayed in this order.
     */
    'showTypes' => [
        'the-history-of-electronic-drums',
        'backstage-secrets',
        'quick-tips',
        'question-and-answer',
        'student-collaborations',
        'live',
        'podcasts',
        'solos',
        'boot-camps',
        'gear-guides',
        'performances',
        'in-rhythm', /* 2020 */
        'challenges', /* 2020 */
        'on-the-road', /* 2020 */
        'diy-drum-experiments', /* 2019*/
        'rhythmic-adventures-of-captain-carson', /* 2019*/
        'study-the-greats', /* 2019*/
        'rhythms-from-another-planet', /* 2019*/
        'tama-drums', /* 2019*/
        'paiste-cymbals', /* 2019*/
        'behind-the-scenes', /* 2019*/
//        'namm-2019', /* 2019*/
//        'camp-drumeo-ah', /* 2019*/
//        '25-days-of-christmas', /* 2019*/
        'exploring-beats', /* 2018*/
        'sonor-drums', /* 2018*/
    ],
    'userListContentTypes' => [
        'course',
        'play-along',
        'song',
        'student-focus',
        'pack-lesson',
        'rudiment',
        'learning-path-lesson',
        'learning-path-course',
        'learning-path-level',
        'semester-pack-lesson',
        'coach-stream',
    ],
    'liveContentTypes' => [
        'student-focus',
        'song',
        'coach-stream',
        'live',
        'question-and-answer',
    ],
    'topLevelContentTypes' => [
        'learning-path',
        'pack',
        'pack-bundle',
        'pack-bundle-lesson',
        'semester-pack',
        'semester-pack-lesson',
        'course',
        'song',
        'play-along',
        'student-focus',
        'rudiment',
    ],
    'catalogueContentTypes' => [
        'course',
        'play-along',
        'student-focus',
        'song',
        'rudiment',
    ],
    'contentReleaseContentTypes' => [
        'course',
        'play-along',
        'student-focus',
        'course-part',
//        'song',
    ],
    'countedCompletedContentTypes' => [
        'course',
        'song',
        'play-along',
    ],
    'homeOurPicksContentTypes' => [
        'course',
        'course-lesson',
        'song',
        'play-along',
    ],
    'homeNewContentTypes' => [
        'course',
        'play-along',
        'student-focus',
        'coach-stream',
//        'song',
    ],
    'homeInProgressContentTypes' => [
        'course',
        'play-along',
        'coach-stream',
        'song',
        'student-focus',
        'pack-lesson',
        'semester-pack-lesson',
        'rudiment',
        'unit',
        'unit-part',
        'course',
        'course-part',
        'song',
        'song-part',
        'quick-tips',
        'question-and-answer',
        'student-review',
        'boot-camps',
        'chord-and-scale',
        'pack-bundle-lesson',
        'podcasts',
        'learning-path-lesson',
        'learning-path-course',
        'learning-path-level'
    ],
    'dashboardInProgressContentTypes' => [
        'course',
        'course-part',
        'coach-stream',
        'play-along',
        'student-focus',
        'song',
        'pack-lesson',
        'semester-pack-lesson',
    ],
    'userProgressListContentTypes' => [
        'pack-bundle-lesson',
        'semester-pack-lesson',
        'coach-stream',
        'course',
        'course-lesson',
        'play-along',
        'recording',
        'song',
        'student-focus',
    ],
    'singularContentTypes' => [
        'course-part',
        'pack-bundle-lesson',
        'coach-stream',
        'play-along',
        'rudiment',
        'song',
        'student-focus',
        'semester-pack-lesson',
        'ha-oemurd-pmac',
        'learning-path-lesson',
    ],
    'appUserListContentTypes' => [
        'course',
        'course-part',
        'coach-stream',
        'play-along',
        'song',
        'student-focus',
        'learning-path-lesson',
        'learning-path-course',
        'learning-path-level',
        'pack-bundle-lesson',
        'pack-bundle',
        'pack',
        'semester-pack-lesson',
        'semester-pack'
    ],
    'hiddenContentTypes' => [
        'ha-oemurd-pmac',
    ],
    'webUpcomingEventPriorMinutes' => null,
    'appUpcomingEventPriorMinutes' => 240,

    'coach_id_instructor_id_mapping' => [
        281901 => 202287,
        281902 => 31973,
        281903 => 273806,
        281904 => 31895,
        281905 => 234095,
        281906 => 236681,
        281907 => 31978,
        281908 => 31935,
        281909 => 202289,
        281910 => 31880,
        281911 => 311690,
        325266 => 255287,
    ],
    'coachesFilePath' => __DIR__ . '/../Coaches v2.0.2.csv',

    'coachContentTypes' => [
        'course',
        'course-part',
        'coach-stream',
        'student-focus',
        'quick-tips',
        'pack',
        'semester-pack',
    ],

];
