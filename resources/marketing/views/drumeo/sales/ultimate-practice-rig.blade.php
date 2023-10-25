@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta property="og:url" content="https://www.drumeo.com/">

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
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
            fill: #0B76DB !important;
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

        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color:#0b76db!important;
                background-color:#0c2949!important;
            }
            .option-buttons.active .radio-check {
                border-color:#0b76db!important;
                background-color:#0b76db!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
            }
        @endif
        .join.musora {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora:hover, .join.musora:focus {
            background:#FFAE00;
            color:#000;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
            "logoUrl" => Request::path(),
        ])
    @elseif(!empty($month))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    <section class="text-center px-5 sm:px-6 py-8 lg:py-10 text-white relative" style="background: linear-gradient(to bottom, #0b75da, #063968);">
        <div class="container max-w-4xl mx-auto">
            <img class="mb-5 h-32 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/drumeo/promos/october/oct-home-promo2.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="sm:text-left flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="h-32 lg:h-44 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/october/oct-home-promo2.png"
                    alt="learn playing image"
                >
                <div class="sm:pl-5 lg:pl-8 mx-0">
                    <h3><strong>Get unlimited drum lessons + a free practice rig & more!</strong></h3>
                    <p class="leading-tight text-musora my-2">Join Drumeo and get a QuietPad, drumsticks, and our brand NEW PadStand so you can practice anywhere. It’s the ultimate drummer’s practice rig!</p>
                    <h3 class="leading-tight"><strong>$16.67/month</strong></h3>
                    <p class="leading-tight text-sm mb-2"><em>Billed at $200 per year</em></p>
                    <a class="join smaller musora w-full max-w-xs" href="/ecommerce/add-to-cart?locked=true&promo-code=special&product-array=DLM-1-year:1,padstand:1,quietpad:1,rudiments-poster:1,Drumeo-VaterSticks:1,drum-technique-made-easy-pack:1,GHFAL-DIGI:1">Get Started &raquo;</a>
                </div>
            </div>
        </div>
    </section>

    @php
        $bubble1 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/dorothea-taylor.png';
        $bubble2 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/todd-sucherman.png';
        $bubble3 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/jared-falk.png';
        $bubble4 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/hannah-welton.png';
        $bubble5 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/larnell-lewis.png';
        $bubble6 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/zack-grooves.png';
        $bubble7 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/domino-santatonio.png';
        $bubble8 = 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/bubbles/aaron-spears.png';

        $slides = [
            [
                'desc' => 'Drumeo is the real deal folks - a good place to study and realize one’s dreams.',
                'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/billy-cobham.jpg',
                'name' => 'Billy Cobham',
                'credit' => 'Rolling Stone  Top 100 Drummer',
            ],
            [
                'desc' => 'A world-class site for continuing education and insight into the world of drumming!',
                'thumb' => 'https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/redmond.jpg',
                'name' => 'Rich Redmond',
                'credit' => '3x Country Drummer Of The Year',
            ],
            [
                'desc' => 'The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education.',
                'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-david-garibaldi.jpg',
                'name' => 'David Garibaldi',
                'credit' => 'Rolling Stone Top 100 Drummer',
            ],
        ];
    @endphp

    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'header' => 'Learn beginner beats, fills<br> and songs on the drums.',
            'desc' => 'Try Drumeo’s award-winning online drum lessons for 7 days FREE:',
            'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/jan-thumb-no-badge.jpg',
            'promoThumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/header-thumb-promo2.png',
            'promoThumbM' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/header-thumb-promo-m2.jpg',
            'pointOne' => 'Learn New Skills',
            'pointTwo' => 'Study With Legends',
            'pointThree' => 'Play Real Songs',
        ])
    @else
        @include('musora.sales.components.header-section', [
            'header' => 'Online drum lessons<br> for all skill levels.',
            'underline' => true,
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> thousands of songs and unlimited personal support.',
            'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/jan-thumb-no-badge.jpg',
            'promoThumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/header-thumb-promo2.png',
            'promoThumbM' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/header-thumb-promo-m2.jpg',
            'pointOne' => 'Improve Your Skills',
            'pointTwo' => 'World-Class Teachers',
            'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
        ])
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif


    <section class="text-center px-5 sm:px-8 pt-72 pb-10 sm:py-14 lg:py-20 relative">
        <div class="inset-0 hidden sm:block absolute" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/october/padstand-promo.jpg') 66% center/cover;"></div>
        <div class="inset-0 sm:hidden block absolute" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/october/padstand-promo-m.jpg') center -10px/cover;"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-start items-start">
                <div class="max-w-lg lg:max-w-xl sm:pr-5 lg:pr-8 mx-0">
                    <h2 class="leading-tight"><strong>Somebody had to do it. </strong></h2>
                    <p class="leading-normal my-4 sm:my-6">For years, you’ve balanced your practice pad on your lap, coffee table, or worse…
                        <br><br>
                        A standard snare stand with claws overhanging like a bad overbite 😬.
                        <br><br>
                        So we engineered a custom practice pad stand that fits any pad perfectly – so you can practice with perfect posture and technique even when you’re not at the kit.
                        <br><br>
                        To celebrate the brand new Drumeo PadStand, we’ve created a bundle that includes everything you need to practice anywhere, anytime: <strong>The Ultimate Drummer’s Practice Rig</strong>.
                        <br><br>
                        Scroll down to lock up your NEW practice rig + unlimited lessons for a year.
                    </p>
                    <a class="join smaller drumeo w-full max-w-xs" href="/ecommerce/add-to-cart?locked=true&promo-code=special&product-array=DLM-1-year:1,padstand:1,quietpad:1,rudiments-poster:1,Drumeo-VaterSticks:1,drum-technique-made-easy-pack:1,GHFAL-DIGI:1">Get Started &raquo;</a>
                </div>
            </div>
        </div>
    </section>

    @php
        $gridItems = [
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/10-level-cirriculum.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'The most trusted step-by-step video lessons for every technique, pattern, and style.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/10-level-cirriculum.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'Keep up your progress with clear assignments and handy practice tools for every level.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/practical-assignments.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guided-workouts2.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guided-workouts2.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'The best drummers are here — including Grammy Award winners and touring musicians.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/world-class-teachers.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/downloadable-videos.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global drum community.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/personalized-support.jpg',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum featuring many of the world’s best teachers. ',
    ])

    @php
        $buttons = [
            'Styles', 'Creativity', 'Grooves'
        ];

        $courses = [
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Todd-Sucherman.jpg',
                        'title' => 'Rock <br>Drumming',
                        'instructor' => 'Todd Sucherman',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dennis-Chambers.jpg',
                        'title' => 'Funk <br>Drumming',
                        'instructor' => 'Dennis Chambers',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Domino-Santatonio.jpg',
                        'title' => 'Pop <br>Drumming',
                        'instructor' => 'Domino Santantonio',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Steve-Smith.jpg',
                        'title' => 'Jazz <br>Drumming',
                        'instructor' => 'Steve Smith',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Larnell-Lewis.jpg',
                        'title' => 'Gospel <br>Drumming',
                        'instructor' => 'Larnell Lewis',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Greyson-Nektrutman.jpg',
                        'title' => 'Big Band <br>Drumming',
                        'instructor' => 'Greyson Nekrutman',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Gene-Hoglan.jpg',
                        'title' => 'Metal <br>Drumming',
                        'instructor' => 'Gene Hoglan',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/John-Wooton.jpg',
                        'title' => 'Latin <br>Drumming',
                        'instructor' => 'John Wooton',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Anika-Nilles.jpg',
                        'title' => 'Subdivision<br> Studies',
                        'instructor' => 'Anika Nilles',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dom-Famularo.jpg',
                        'title' => 'Pedal<br> Control',
                        'instructor' => 'Dom Famularo',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Tommy-Igoe.jpg',
                        'title' => 'Groove<br> Essentials',
                        'instructor' => 'Tommy Igoe',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dorothe-Taylor-01.jpg',
                        'title' => 'Stick<br> Control',
                        'instructor' => 'Dorothea Taylor',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Bruce-Becker.jpg',
                        'title' => 'Hand<br> Technique',
                        'instructor' => 'Bruce Becker',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Billy-Cobham.jpg',
                        'title' => 'Internal<br> Synchronization',
                        'instructor' => 'Billy Cobham',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Emmanuelle-Caplette.jpg',
                        'title' => 'Traditional<br> Grip',
                        'instructor' => 'Emmanuelle Caplette',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Sarah-Thawer.jpg',
                        'title' => '4-Way<br> Coordination',
                        'instructor' => 'Sarah Thawer',
                    ],
                ]
            ],
            [
                'title' => 'Find your groove',
                'images' => [
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Simon-Phillips.jpg',
                    'title' => 'Elevate Your<br> Drum Sound',
                    'instructor' => 'Simon Phillips',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Aaron-Spears.jpg',
                    'title' => 'Drum<br> Chops',
                    'instructor' => 'Aaron Spears',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Hannah-Welton.jpg',
                    'title' => 'Writing<br> Drum Parts',
                    'instructor' => 'Hannah Welton',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Matt-McGuire.jpg',
                    'title' => 'Song<br> Breakdowns',
                    'instructor' => 'Matt McGuire',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dorothe-Taylor-02.jpg',
                    'title' => 'Rudiments<br> & Patterns',
                    'instructor' => 'Dorothea Taylor',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Aric-Improta.jpg',
                    'title' => 'The Creative<br> Mindset',
                    'instructor' => 'Aric Improta',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Kaz-Rodgriguez.jpg',
                    'title' => 'Musical<br> Exercises',
                    'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Gavin-Harrison.jpg',
                    'title' => 'Bass Drum<br> Calibration',
                    'instructor' => 'Gavin Harrison',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Amplify your skills with 200+ artist courses + <br class="hidden md:inline">access exclusive live events with drumming legends.'
    ])

    @php
        $songItems = [
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/5000-songs-icon.svg',
                'title' => '5000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level.',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/tempo-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down or speed up any section of a song to hear every note.',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/loop-icon.svg',
                'title' => 'Loop the trouble spots.',
                'desc' => 'No more pausing and rewinding that tricky fill. Loop it over and over again!',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/no-drums-icon.svg',
                'title' => 'Remove the drums.',
                'desc' => 'Magically remove the original drums to make each song uniquely yours.',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/play-it-right-icon.svg',
                'title' => 'Play it right the first time.',
                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,so you can play any song, any time.',
            ],

        ];
    @endphp
    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a beat.',
        'video' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png',
        'brandName' => 'Drumeo',
    ])

    @include('musora.sales.components.learn-by-playing-section', [
        'header' => 'Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.',
        'desc' => 'With Drumeo, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.',
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314560/rendition/540p/file.mp4?loc=external&signature=1549cce1dacabad80dd416b5a439f6639d3b7b30c7e4d70d46245bf70c6d5102',
    ])

    @php
        $testimonials = [
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
            'name' => 'Ed Koop',
            'video' => '342059271',
            'title' => 'I’m loving music more than I ever did before!',
            'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
            'name' => 'Barry Lisle',
            'video' => '342066433',
            'title' => 'They walk you through, step-by-step, for any goal.',
            'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
            'name' => 'Lisa Aragon',
            'video' => '373252004',
            'title' => 'I was able to play drums on stage!',
            'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
            'name' => 'Guy Dobbins',
            'video' => '373445704',
            'title' => 'Drummers from all around the world helping you out.',
            'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
            ],
            [
            'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620.jpg',
            'name' => 'Omari Augustine',
            'video' => '553438851',
            'title' => 'Something you can’t get from having a drum teacher.',
            'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
            'name' => 'Marlene Rosen',
            'video' => '373446024',
            'title' => 'I’m rediscovering music again.',
            'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
            'name' => 'Jay Damberg',
            'video' => '373445466',
            'title' => 'Anytime, day or night, I can access the lessons I need.',
            'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
            'name' => 'Ivy Elizondo',
            'video' => '373445819',
            'title' => 'Now we have a band and we’re recording an album!',
            'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead — she’s used Drumeo to build a foundation and formed a band.',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by drummers<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'youtube' => '3M',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'facebook' => '1.2M',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
        'instagram' => '1.3M',
    ])
    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png',
            'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
        ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    <section class="py-16 sm:py-24 lg:py-28 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:#173c59 url(https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/stickbag/promo-order-bg.jpg) center center/cover;">
        <div class="container mx-auto max-w-6xl relative z-50">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 46%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" {{--border-2 border-promo--}} front absolute z-20  w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/990x0/filters:quality(95)/marketing/drumeo/promos/october/oct-home-promo2.png');"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <h2 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Get unlimited drum lessons +<br class="hidden sm:inline"> a free practice rig & more!</strong></h2>

                <p class="leading-tight mt-4 sm:mt-5 mb-2"><span class="text-musora">
                        Join Drumeo and get a QuietPad, drumsticks, and our brand NEW PadStand  <br class="hidden sm:inline">
                        so you can practice anywhere. It’s the ultimate drummer’s practice rig!</span></p>

                <h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>$16.67/month</strong></h3>
                <p class="leading-tight opacity-70 text-sm"><em>Billed at $200 per year.</em></p>

                <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;"
                        href="/ecommerce/add-to-cart?locked=true&promo-code=special&product-array=DLM-1-year:1,padstand:1,quietpad:1,rudiments-poster:1,Drumeo-VaterSticks:1,drum-technique-made-easy-pack:1,GHFAL-DIGI:1"
                >GET STARTED</a>
            </div>
        </div>
    </section>

    @include('musora.sales.components.app-section', [
        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone&ppid=d63c2cf3-274f-4441-8444-a5f547b1b4b6',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=drumeo_previews',
    ])

    @include('drumeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("drumeo.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
