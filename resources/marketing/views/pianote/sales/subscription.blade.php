@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
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
            fill: #f61a30 !important;
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
                border-color:#f61a30!important;
                background-color:#4a0c12 !important;
            }
            .option-buttons.active .radio-check {
                border-color:#f61a30!important;
                background-color:#f61a30!important;
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
        trailer : false,
        unbox : false,
        rolandTrailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white relative" style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        <div class="container max-w-5xl mx-auto">
            <img class="my-5 h-40 inline sm:hidden"
                    src="https://www.musora.com/musora-cdn/image/width=620,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/pianote-october-bundle.png"
                    alt="learn playing image"
                    fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <div class="max-w-xl pr-5 lg:pr-8 mx-0">
                <h2><strong>Unlimited piano lessons + a FREE course for life. </strong></h2>
                <p class="leading-tight text-musora mt-1"><strong>You’ll get a FREE course on Riffs & Fills when you try Pianote for 7 days ($99 value)</strong></p>
                <p class="leading-normal">
                    <a class="join smaller musora my-3 w-1/2 anchor-slide" href="#customize-anchor">Start For Free &raquo;</a>
                    <br>
                    <em>Free worldwide shipping!</em>
                </p>
                </div>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/pianote-october-bundle.png"
                        alt="learn playing image"
                >
            </div>
        </div>
    </section>
    @php
        $bubble1 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/summer-swee-singh.png';
        $bubble2 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/lisa-witt.png';
        $bubble3 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/jesus-molina.png';
        $bubble4 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/kevin-castro.png';
        $bubble5 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/erskine-hawkins.png';
        $bubble6 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/victoria-theodore.png';
        $bubble7 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/sangah-noona.png';
        $bubble8 = 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/bubbles/cassi-falk.png';

        $features = [
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/piano-lesson-icon.svg',
                'title' => 'Piano Lessons',
                'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring pianists. ',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '1000+ Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'Pianote is a really fun resource for those wishing to pick up tips and tricks and gain perspective. ',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/feature-testimonial-yvette.jpg',
                'name' => 'Yvette Young',
                'credit' => ' Multi-Instrumentalist',
            ],
            [
                'desc' => 'You should check out Pianote. If you’re a beginner or intermediate, this is ideal for you!',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/feature-testimonial-ali.jpg',
                'name' => 'Ali Spagnola',
                'credit' => ' YouTube Entertainer',
            ],
            [
                'desc' => 'Whether you’re getting your head around “Chopsticks” or brushing up on your Shostakovich, there should be a lesson for you.',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/feature-testimonial-musicradar.jpg',
                'name' => 'MusicRadar',
                'credit' => ' Website For Musicians',
            ],
        ];
    @endphp
    @if(empty($hideHeader) || !$hideHeader)
        @if(!empty($beginnerVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> tailored for beginners.',
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> friendly teachers, and songs perfect for your skill level.',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb-m2.jpg',
                'pointOne' => 'Perfect for Beginners',
                'pointTwo' => 'Super-Friendly Teachers',
                'pointThree' => 'Fun Lessons',
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'desc' => ' Find and play the songs you love. Download, print, and<br class="hidden sm:inline">   play 1000+ songs. Plus get flexible, fun lessons and<br class="hidden sm:inline">  unlimited personal support from real teachers.',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb-m2.jpg',
                'pointOne' => '1000+ popular songs',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Learn anywhere, anytime',
            ])
        @else
            @include('musora.sales.components.header-section', [
                'header' => 'Online piano lessons<br> for all skill levels.',
                'underline' => true,
                'desc' => 'Learn the piano faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
                'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/header-thumb2.jpg',
                'promoThumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb2.png',
                'promoThumbM' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/jan-thumb-m2.jpg',
                'pointOne' => 'Improve Your Skills',
                'pointTwo' => 'World-Class Teachers',
                'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
            ])
        @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white relative" style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Start a trial. Get a FREE course. No strings attached.</strong></h2>
            <p class="leading-tight text-musora mt-1 sm:mb-10"><strong>We’re giving you a $99 course when you start a 7-day trial of Pianote.</strong></p>

            <img class="my-5 h-40 inline sm:hidden"
                    src="https://www.musora.com/musora-cdn/image/width=620,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/promo-collage-m.png"
                    alt="learn playing image"
                    fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <p class="leading-normal max-w-xl pr-5 lg:pr-8 mx-0">
                    <strong>Now you can</strong><br>
                    Learn at home. Whenever, wherever<br>
                    Finally start piano lessons
                    <br><br>
                    Stop putting it off. Start learning piano today with Pianote and we’ll give you <strong>a FREE course worth $99</strong>.
                    <br><br>
                    Sign up for a free 7-day trial of Pianote and you’ll get lifetime access to one of our most popular courses: Piano Riffs & Fills. You’ll learn the exact techniques to play beautiful and professional-sounding fills on the piano.
                    <br><br>
                    But that’s nothing compared to what you’ll achieve with Pianote. And that’s why we’re giving you this course.
                    <br><br>
                    It’s yours to keep even if you cancel your membership.
                    <br><br>
                    So don’t put it off any longer.
                    <br><br>
                    Start today.
                    <br>
                    <a class="join smaller musora my-3 w-1/2 anchor-slide" href="#customize-anchor">GET Started &raquo;</a>
                    <br>
                    <em>Free worldwide shipping!</em>
                </p>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/promo-collage.png"
                        alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="sticky-trigger block"></div>
    <a href="#customize-anchor"
            class="promo-banner flex text-white items-center justify-center -mt-10 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        {{--        <img class="h-8 sm:h-10 mr-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas text-musora mx-0 pr-3">* OCTOBER ONLY *</h3>
        <p class="inline-block text-xs mx-0 leading-tight">
            Get a <strong>FREE Riffs & Fills course</strong> when
            <br> you try Pianote for 7 days ($99 value)
        </p>
    </a>
    @include('musora.sales.components.musicounts-section')

    @php
        $gridItems = [
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/modern-method.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'Develop your core skills, techniques, and musicality to play beautifully in any setting. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/modern-method.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'You\'ll always have on-screen assignments and practice tools to help you see results.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/practical-assignments.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/guided-workouts.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'Lifetime teachers, touring performers, recording professionals, and trending stars. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/world-class-teachers.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/downloadable-videos.jpg',
                    ],
                ]
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global piano community. ',
                'lessonInfo' => [
                    [
                        'thumb' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/personalized-support.jpg',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum and direct access to real teachers. ',
    ])

    @php
        $buttons = [
            'Styles', 'Technique', 'Creativity'
        ];

        $courses = [
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/classical-piano.jpg',
                    'title' => 'Classical<br> Piano',
                    'instructor' => 'Victoria Theodore',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/cocktail-piano.jpg',
                    'title' => 'Cocktail<br> Piano',
                    'instructor' => 'Brett Ziegler',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/latin-essentials.jpg',
                    'title' => 'Latin<br> Essentials',
                    'instructor' => 'Kevin Castro',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/worship-piano.jpg',
                    'title' => 'Worship<br> Piano',
                    'instructor' => 'Amberly Martz',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/improvisational-jazz.jpg',
                    'title' => 'Improvisational<br> Jazz',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/gospel-piano.jpg',
                    'title' => 'Gospel<br> Piano',
                    'instructor' => 'Erskine Hawkins',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/Latin-Jazz.jpg',
                    'title' => 'Latin<br> Jazz',
                    'instructor' => 'Gabriel Palatchi',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/Tango-Piano.jpg',
                    'title' => 'Tango<br> Piano',
                    'instructor' => 'Sangah Noona',
                    ]
                ]
            ],
            [
                'title' => 'Add essential techniques',
                'images' => [
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/piano-technique-made-easy.jpg',
                    'title' => 'Piano Technique<br> Made Easy',
                    'instructor' => 'Cassi Falk',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/faster-fingers.jpg',
                    'title' => 'Faster<br> Fingers',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/hanon-exercises.jpg',
                    'title' => 'Hanon<br> Exercises',
                    'instructor' => 'Cassi Falk',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/de-stupefy-your-left-hand.jpg',
                    'title' => 'De-Stupefy<br> Your Left Hand',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/beautifully-simple-piano-arpeggios.jpg',
                    'title' => 'Beautifully<br> Simple Piano<br> Arpeggios',
                    'instructor' => 'Sangah Noona',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/riffs-fills.jpg',
                    'title' => 'Riffs<br> & Fills',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/7-days-to-sight-reading.jpg',
                    'title' => '7 Days To<br> Sight Reading',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/dexterity-finger-strength.jpg',
                    'title' => 'Dexterity &<br> Finger Strength',
                    'instructor' => 'Cassi Falk',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/playing-piano-beautifully.jpg',
                    'title' => 'Playing Piano<br> Beautifully',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/musical-freedom.jpg',
                    'title' => 'Improvisation &<br> Musical Freedom',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/the-perfect-arrangement.jpg',
                    'title' => 'The Perfect<br> Arrangement',
                    'instructor' => 'Summer Swee-Singh',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/creative-composition.jpg',
                    'title' => 'Creative<br> Composition',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pillars-of-improvisation.jpg',
                    'title' => 'Pillars of<br> Improvisation',
                    'instructor' => 'Jordan Leibel',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/the-power-of-chords.jpg',
                    'title' => 'The Power<br> of Chords',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/creative-song-writing.jpg',
                    'title' => 'Creative<br> Songwriting',
                    'instructor' => 'Josh Dion',
                    ],
                    [
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/rhythmic-playing.jpg',
                    'title' => 'Rhythmic<br> Playing',
                    'instructor' => 'Jay Oliver',
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
                'icon' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level. ',
            ],
            [
                'icon' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/tempo-icons.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down any section of a song to make those tricky bars easier. ',
            ],
            [
                'icon' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/loop-icons.svg',
                'title' => 'Loop the hard parts.',
                'desc' => 'Create practice loops to play-through those difficult parts over and over.   ',
            ],
            [
                'icon' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/timing-icons.svg',
                'title' => 'Improve your timing.',
                'desc' => 'Use the built-in-metronome – your new best friend for difficult rhythms.  ',
            ],
            [
                'icon' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/play-it-right-icon.svg',
                'title' => 'Play it right the first time.',
                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
            ],
            [
                'icon' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/devices-icons.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable, so you can play any song, any time.    ',
            ],

        ];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/device.png',
        'brandName' => 'Pianote',
        'bannerDesc' => 'Powered by Musora, Pianote includes full access to our communities for drums, guitar, and voice.',
    ])
    @include('musora.sales.components.learn-by-playing-section', [
        'header' => 'Learn the piano by<br class="inline sm:hidden"> <u>playing the piano</u>.',
        'desc' => 'With Pianote, you’ll play more, you’ll fall in love with your progress, <br class="hidden sm:inline lg:hidden"> and you’ll have personalized support every step of the way.',
                'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e',

    ])

{{--    @include('pianote.sales.headphones-section')--}}

    @php
        $testimonials = [
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
            'title' => "Such a fantastic and welcoming student community.",
            'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
            'name' => 'Ian Kershaw',
            'video' => '660596700',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
            'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
            'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
            'name' => 'Jayde McIntosh',
            'video' => '660596722',
            'location' => 'Australia',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/xitlalicaballero2.jpg',
            'title' => "I’m six years old. My biggest moment is when I play Für Elise.",
            'description' => "My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.",
            'name' => 'Xitlali Caballero',
            'video' => '660596752',
            'location' => 'Florida, USA',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/nabilabdelmoneim.jpg',
            'title' => "I’m a lot better at using both hands and it opened up more songs.",
            'description' => "You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!",
            'name' => 'Nabil Abd El Moneim',
            'video' => '660596735',
            'location' => 'British Columbia, Canada',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
            'title' => "I’m blown away by the program you’ve created.",
            'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
            'name' => 'Jess Ripley',
            'location' => 'California, USA',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/anselmdesouza.jpg',
            'title' => "Helped coordinate my left and right hands.",
            'description' => "I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined Pianote and went back to the basics.<br><br>Pianote helped coordinate my left and right hands. The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging.",
            'name' => 'Anselm de Souza',
            'location' => 'Singapore',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/johnmaclean.jpg',
            'title' => "My 6 year old daughter started dancing as I played.",
            'description' => "Before Pianote and The Method, I was completely lost in terms of knowing how to become a better musician. All I would do is try to play songs, but without any of the structure and practice that is required to actually improve. And with face to face lessons I wasn’t really progressing much between the lessons. But having access to the video tutorials online lets me go back as often as I need to.<br><br>My biggest breakthrough has been independent hand control – allowing me to hear rich music that I’m creating for the first time. And gaining that confidence has allowed me to start to improvise the pieces that I learn.<br><br>The lightbulb moment happened when my 6 year old daughter started dancing as I played! You must be doing something right if someone dances to music that you’re playing, right?",
            'name' => 'John Maclean',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
            'title' => "If I was taught this way as a child, I would have never quit.",
            'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'location' => 'Ontario, Canada',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by pianists<br class="inline-block sm:hidden">  everywhere.',
        'reviewText' => 'Check out the reviews and meet some of our friendly students.',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'youtube' => '1.4M',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'facebook' => '430K',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
        'instagram' => '220K',
    ])
    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @hasSection('final')
        @yield('final')
    @elseif(!empty($trialVersion))
        @include('musora.sales.components.card-selection-section', [
            "noSelector" => true,
            "plusLogo" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-plus-logo-light.svg",
            "logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-white.png",
            "songs" => "1000+ popular songs.",
            "firstPoint" => "Unlimited piano lessons.",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, guitar, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[pianote-base-annual-recurring-7-day-trial-membership]=1&promo-code=annual-trial&redirect=/order&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[pianote-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])
    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                    'title' => 'Chords & <br>Scales Book',
                    'description' => 'Your encyclopedia of piano chords & scales.',
                    'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                    'shipping' => 'true'
                ],
                [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg',
                'title' => 'Piano Technique<br> Made Easy',
                'description' => 'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
                'price' => floatval($productPrices['piano-technique-made-easy']->price),
                ],
                [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
                'title' => 'Piano Riffs<br> & Fills',
                'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
                'price' => floatval($productPrices['piano-riffs-and-fills']->price),
                ],
                [
                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/faster-fingers.jpg',
                    'title' => '',
                    'description' => 'Boost your speed and confidence with this guided practice course.',
                    'price' => floatval($productPrices['faster-fingers']->price),
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-annual-2w-card.png',
        'header' => 'Online piano lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $357',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[piano-technique-made-easy]=1&products[piano-riffs-and-fills]=1&products[faster-fingers]=1&redirect=/order&locked=true&promo-code=special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder',
        ])
    @else
        <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
                style="background: linear-gradient(to right, #08203a, #0c1524);">
            <div class="container mx-auto max-w-6xl relative z-50">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 39.5%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class=" {{--border-2 border-promo--}} front absolute z-20  w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/pianote-october-bundle.png);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h2 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Try Pianote for 7 days & get <br class="hidden sm:inline"> a FREE $99 course for life.</strong></h2>

                    <p class="leading-tight mt-4 sm:mt-5 mb-2"><span class="text-musora">Click below to start your free 7-day trial. Your annual membership will<br class="hidden sm:inline"> continue on {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }} (after your free trial).</span></p>

                    <h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Free for 7 days</strong></h3>
                    <p class="leading-tight opacity-70 text-sm"><em>Then billed at $240 per year. Save 33%.</em></p>
                    <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?product-array=PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL:1,poster-chords:1,poster-scales:1&promo-code=annual-trial&redirect=/order&locked=true">CLICK HERE TO GET STARTED</a>
                </div>
                <a class="inline-block text-pianote mt-2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true"><p class="leading-tight"><strong><u>Or start a Monthly Plan for<br class="sm:hidden"> $30/month (no bonus posters)</u></strong></p></a>
                <p class="opacity-70 text-sm mt-2"><em>90-day money-back guarantee. Cancel anytime.</em></p>
            </div>
        </section>
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])
{{--        @include('musora.sales.components.order-section-collage', [--}}
{{--        'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png',--}}
{{--        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',--}}
{{--        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>--}}
{{--                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> All-access for piano, guitar, drums, and singing.</li>--}}
{{--                    <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> We’ll donate 20% towards music programs for kids. </li>',--}}
{{--        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-collage.png',--}}
{{--        ])--}}
{{--        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>--}}
{{--        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>--}}
{{--        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',--}}
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'unbox',
        'video' => '774408046',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("pianote.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script>
        $(document).ready(function () {
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var stickTrigger = $('.sticky-trigger').offset().top;
                var unstickTrigger = $('.unstick-trigger').offset().top;
                if ($(this).scrollTop() > (unstickTrigger - 115)) {
                    stickyBar.removeClass('fixed mt-0');
                }
                if ($(this).scrollTop() < stickTrigger - 115) {
                    stickyBar.removeClass('fixed mt-0');
                }
                if ($(this).scrollTop() < unstickTrigger - 115 && $(this).scrollTop() > stickTrigger - 115) {
                    stickyBar.addClass('fixed mt-0');
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
