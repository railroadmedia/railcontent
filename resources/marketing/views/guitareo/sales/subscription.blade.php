@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <meta property="og:url" content="https://www.guitareo.com"/>

    <meta name="description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee." />
    <meta property="og:description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-guitareo.jpg"/>
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #00c9ac !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }

        .header-slide-btn {
            display: none !important;
        }

        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color:#00c9ac!important;
                background-color:#0c4a41 !important;
            }
            .option-buttons.active .radio-check {
                border-color:#00c9ac!important;
                background-color:#00c9ac!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
            }
        @endif
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])

    @elseif(!empty($month))
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    @if(empty($trialVersion))
    @include('_partials.components.promo-top-banner',[
        'bg' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/july/guitareo-shop-summer-sale-bg.jpg',
        'logo' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/july/guitareo-summer-sale-logo.svg',
        'logoStyles' => 'mb-3',
        'title' => 'DEALS ON LESSONS, ACCESSORIES AND MORE!',
        'promoText' => 'SAVE UP TO 91% UNTIL JULY 31ST!',
    ])
    @endif

    @php
        $bubble1 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/rob-scallon.png';
        $bubble2 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/ayla-tesler-mabe.png';
        $bubble3 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/mark-lettieri.png';
        $bubble4 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/pete-thorn.png';
        $bubble5 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/dean-lamb.png';
        $bubble6 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/sami-ghawi.png';
        $bubble7 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/yvette-young.png';
        $bubble8 = 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/bubbles/kent-shores.png';

        $features = [
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitar-lessons-icon.svg',
                'title' => 'Guitar Lessons',
                'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/artist-courses-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring guitarists. ',
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '1000+ Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'for people who want to learn how to play guitar, and fast',
                'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/as-logo.png',
                'name' => 'American Songwriter',
                'credit' => 'Music Magazine',
            ],
        ];
    @endphp

    @include('musora.sales.components.header-section', [
        'header' => 'Online guitar lessons<br> for all skill levels.',
            'underline' => true,
        'desc' => 'Learn the guitar faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/header-thumb.jpg',
        'promoThumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/jan-thumb.png',
        'promoThumbM' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/jan-thumb-m.jpg',
        'pointOne' => 'Improve Your Skills',
        'pointTwo' => 'World-Class Teachers',
        'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
        'cta' => 'SEE YOUR DEAL &raquo',
    ])


    @php
        $gridItems = [
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/method.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'Develop your core skills, techniques, and musicality to play confidently in any setting. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/method.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'You\'ll always have on-screen assignments and practice tools to help you see results.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/practical-assignments.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/guided-workouts.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches-thumb2.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'The best guitarists are here – including Grammy Award winners and touring musicians.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches-thumb2.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/downloadable-videos.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global guitar community. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/personalized-support.jpg',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your guitar goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Learn to play guitar online with a fluff-free curriculum that’ll<br class="hidden sm:inline">  take your skills from zero to guitar hero – with step-by-step<br class="hidden sm:inline">  lessons designed around playing songs faster. ',
    ])

    @php
        $buttons = [
            'Creativity', 'Styles', 'Technique'
        ];

        $courses = [
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/solo-in-an-hour.jpg',
                    'title' => 'Solo In<br> An Hour',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/songwriting-cheat-codes.jpg',
                    'title' => 'Songwriting<br> Cheat Codes',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/musical-lanes.jpg',
                    'title' => 'Creating The Perfect <br> Guitar Part',
                    'instructor' => 'Mark Lettieri',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/add-power-to-your-playing.jpg',
                    'title' => 'Better <br> Guitar Solos',
                    'instructor' => 'Dave Weiner',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/unlock-your-creativity.jpg',
                    'title' => 'Unlock Your<br> Creativity',
                    'instructor' => 'Yvette Young',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/the-anatomy-of-a-song.jpg',
                    'title' => 'The Anatomy<br> of a Song',
                    'instructor' => 'Pete Thorn',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/looping.jpg',
                    'title' => 'Looping',
                    'instructor' => 'David Becker',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/altered-open-tunings.jpg',
                    'title' => 'Altered &<br> Open Tunings',
                    'instructor' => 'Don Ross',
                    ],
                ]
            ],
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/rock-guitar.jpg',
                    'title' => 'Rock<br> Guitar ',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/surf-guitar.jpg',
                    'title' => 'Surf<br> Guitar',
                    'instructor' => 'Kent Shores',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/campfire-chords.jpg',
                    'title' => 'Campfire<br> Chords',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/funk-essentials.jpg',
                    'title' => 'Funk<br> Essentials',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/bluegrass.jpg',
                    'title' => 'Bluegrass',
                    'instructor' => 'Nate Savage',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/fingerstyle.jpg',
                    'title' => 'Fingerstyle',
                    'instructor' => 'Nate Savage',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/shred-guitar.jpg',
                    'title' => 'Shred<br> Guitar',
                    'instructor' => 'Dean Lamb',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/musical-lanes.jpg',
                    'title' => 'Fusion <br> /Neo-Soul',
                    'instructor' => 'Mark Lettieri',
                    ],
                ]
            ],
            [
                'title' => 'Add essential techniques',
                'images' => [
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/getting-started-on-the-acoustic.jpg',
                    'title' => 'Getting Started<br> On The Acoustic<br> Guitar',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/getting-started-on-the-electric.jpg',
                    'title' => 'Getting Started<br> On The Electric<br> Guitar',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/picking.jpg',
                    'title' => 'Picking',
                    'instructor' => 'Nate Savage',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/legato.jpg',
                    'title' => 'Legato',
                    'instructor' => 'Kent Shores',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/strumming-workouts.jpg',
                    'title' => 'Strumming<br> Workouts',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/bending-virbrato.jpg',
                    'title' => 'Bending &<br> Vibrato',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/rhythm-groove.jpg',
                    'title' => 'Rhythm<br> & Groove ',
                    'instructor' => 'Sami Ghawi',
                    ],
                    [
                    'img' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/coaches/timing-feel.jpg',
                    'title' => 'Timing<br> & Feel',
                    'instructor' => 'David Becker',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline"> courses + live events with special guests.'
    ])


    @php
        $songItems = [
            [
                'icon' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for   every style, era, and skill level. ',
            ],
            [
                'icon' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/tempo-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down any section of a song  to make those tricky bars easier. ',
            ],
            [
                'icon' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/loop-icon.svg',
                'title' => 'Loop the hard parts.',
                'desc' => 'Create practice loops to play-through  those difficult parts over and over.   ',
            ],
            [
                'icon' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/timing-icon.svg',
                'title' => 'Improve your timing.',
                'desc' => 'Use the built-in-metronome – your new  best friend for difficult rhythms.  ',
            ],
            [
                'icon' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/play-it-right-icon.svg',
                'title' => 'Play it right the first time.',
                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
            ],
            [
                'icon' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/devices-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,  so you can play any song, any time.    ',
            ],

        ];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/device.png',
        'brandName' => 'Guitareo',
        'bannerDesc' => 'Powered by Musora, Guitareo includes full access to our communities for voice, piano, and drums.',
    ])
    @include('musora.sales.components.learn-by-playing-section', [
        'header' => 'Learn the guitar by<br class="inline sm:hidden"> <u>playing the guitar</u>.',
        'desc' => 'With Guitareo, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.',
                'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314551/rendition/540p/file.mp4?loc=external&signature=49333e2b437f90a4af69eb5b19468b68f5185729516f735cd390a6ce8b673516',
    ])

    @php
        $testimonials = [
            [
            'title' => "I’m lightyears ahead of where I was.",
            'description' => "I’ve come so far in such a short period of time. I’ve gone from not even knowing what palm muting was to noodling with the E & A string pentatonic shapes and creating melodies with it – and using it to work on my vibrato, slides, and bends. And I’ve gained priceless info like knowing where to place chords, start power chords, and scale shapes.<br><br>Having the breakthroughs I’ve had so far has brought me confidence and kept me sane while the world is seemingly not – and made me believe there is still a bright future ahead. As I progress, I feel supported towards achieving my goals of jamming with others and using my love for writing to start telling stories through music. All in due time.<br><br>I’m lightyears ahead of where I was at. And no matter where I go, or however tough things get, I’ll always have one of my guitars in the passenger seat and we’ll always be there for each other. The life long journey has begun!",
            'name' => 'Ërlik Sörensen',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/erliksorensen.jpg',
            'location' => 'British Columbia, Canada',
            ],
            [
            'title' => "The frustration is over.",
            'description' => "I’m already playing things that were a nightmare to me before. Strumming patterns, smoothly changing chords, and improvisation of different scales. I’m even playing songs using my own chord progressions and pentatonic scales. I’m enjoying listening to myself play and proud of my progress!<br><br>The frustration is over. Guitareo has what a guitarist wants and it’s been a fun and easy learning experience.",
            'name' => 'Vetriselvi Senguttuvan',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/vetriselvisenguttuvan.jpg',
            'location' => 'India',
            ],
            [
            'title' => "I’ve never felt so much JOY playing the guitar.",
            'description' => "When I finished the first lesson, I had a feeling of joy that I’ve never had before when playing guitar. I'm experimenting a lot more and improving my technique. The goal-based learning makes each set of lessons more entertaining and a feeling of accomplishment when completed.",
            'name' => 'Jamie K',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/jamie-nova-scotia.jpg',
            'location' => 'Nova Scotia, Canada',
            ],
            [
            'title' => "I finally feel like I’m able to learn the guitar.",
            'description' => "Guitareo focuses on smaller tasks and achievements along the way to make you feel like you’re improving. In level four of GuitarQuest, I played the G chord for the first time without any pain in my hands. I finally feel like I’ll really be able to learn the guitar and succeed! This course is SO much fun and keeps me motivated!",
            'name' => 'Patrizia K',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/patrizia-germany.jpg',
            'location' => 'Germany',
            ],
            [
            'title' => "I like the sincerity, knowledge, and positivity.",
            'description' => "The internet is a nice resource for ideas, methods, tips, and tricks, but there is no linear method. I have to create one on my own, and I don’t want to teach guitar. I want to play.<br><br>So I joined Guitareo because I like the sincerity, knowledge, and positivity. Nate introduced me to the Million Dollar Progression. And Ayla showed me how to solo using backing tracks. They got me started on my journey and gave me confidence. Now I’m excited to practice. My Fender Hellcat seems to fit into my hands and against my body like it didn’t before. And I can actually say “I’m a guitarist!” Well, how about that!",
            'name' => 'Jim McKenna',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/jimmckenna.jpg',
            'location' => 'Illinois, USA',
            ],
            [
            'title' => "I’ve started making my own melodies.",
            'description' => "Guitareo has been fun and motivated me to try more. I like how we start making melodies quickly along with helpful background information on chords and notes. I love seeing other students post their melodies -- it’s so much fun to listen to others!",
            'name' => 'Jan M',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/jan-berlin-germany.jpg',
            'location' => 'Germany',
            ],
            [
            'title' => "I feel happy and more confident while playing. ",
            'description' => "I had classical guitar lessons 15 years ago and since then I’ve wanted to play acoustic and electric guitar. I’ve been trying to figure them out on my own and it was frustrating – trying to play pentatonics, or mute strings. And then I found out about Guitareo!<br><br>I feel happy and more confident while playing, even though it’s pretty early. I played my first song with mini barre chords and actually enjoyed it. I’ve never done that before! And I even sent a video playing a punk play-along song to a friend (and I normally never play guitar in front of friends). I would definitely recommend Guitareo. You have done really good work and I personally thank you for that!",
            'name' => 'Athina Katri',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/athinakatri.jpg',
            'location' => 'Greece',
            ],
            [
            'title' => "I’m holding my own while still having fun!",
            'description' => "I was skeptical at first. I’ve seen online lesson sites that are really bad, so I started with a monthly subscription. After going through the beginner lessons, I saw that Guitareo was totally different from other sites. I’ve had a guitar for years and struggled to play anything more than G, C, and D – and I always had trouble learning new chords and progressions. Guitareo’s lessons helped me advance and have more fun playing the guitar.<br><br>I have broken through doors that were closed to me several times. Things that I’ve struggled with for years have been explained in ways that make sense – and the Guitareo instructors have helped me become more comfortable. Now I’m able to sit in with friends that are way better players than me and hold my own while still having fun!",
            'name' => 'WJ Williams',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/williamwilliams.jpg',
            'location' => 'Georgia, USA',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by guitarists<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'youtube' => '1M',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'facebook' => '330K',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
        'instagram' => '19K',
    ])
    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/guitareo-guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar.',
    ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @if(!empty($trialVersion))
        @include('musora.sales.components.card-selection-section', [
            "noSelector" => true,
            "plusLogo" => "https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitareo-plus-logo-light.svg",
            "logo" => "https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo.png",
            "songs" => "1000+ popular songs.",
            "firstPoint" => "Unlimited guitar lessons.",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[guitareo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[guitareo-base-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "monthlyLink" => "/ecommerce/add-to-cart?products[guitareo-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'guitar',
        ])
    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/november/survival-kit-shop.jpg',
                    'title' => 'The Guitarist’s Survival Kit',
                    'description' => 'Get the gear essentials to start sounding better on the guitar.',
                    'price' => floatval($productPrices['guitarists-survival-kit']->price),
                    'shipping' => 'true'
                ],
                [
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/black-friday/bundles/ultimate/gq.jpg',
                    'title' => 'GuitarQuest',
                    'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',
                    'price' => floatval($productPrices['guitar-quest']->price),
                ],
                [
                    'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/black-friday/rhythm_groove_cart.jpg',
                    'title' => 'Rhythm & Groove',
                    'description' => 'Go beyond simple strumming on the guitar.',
                    'price' => floatval($productPrices['rhythm-and-groove']->price),
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitareo-annual-2w-card.png',
        'header' => 'Online guitar lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 3 bonuses<br class="inline sm:hidden"> worth $333',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'buttonLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&redirect=/order&locked=true&promo-code=special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png',
        'header' => 'Unlimited guitar lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitareo-collage.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=e92a296a-7aeb-40ec-85eb-aaf891c3e6c1',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=guitareo_previews',
    ])

    @include('guitareo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'Mnmkc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314408',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("guitareo.sales.partials._footer")
    @endif


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        // $(document).ready(function () {
        //     var stickyBar = $('.promo-banner');
        //     $(window).scroll(function () {
        //         var stickTrigger = $('.sticky-trigger').offset().top;
        //         var unstickTrigger = $('.unstick-trigger').offset().top;
        //         if ($(this).scrollTop() > (unstickTrigger - 115)) {
        //             stickyBar.removeClass('fixed mt-0');
        //         }
        //         if ($(this).scrollTop() < stickTrigger - 115) {
        //             stickyBar.removeClass('fixed mt-0');
        //         }
        //         if ($(this).scrollTop() < unstickTrigger - 115 && $(this).scrollTop() > stickTrigger - 115) {
        //             stickyBar.addClass('fixed mt-0');
        //         }
        //     });
        // });
    </script>
    @yield('scripts')
@stop
