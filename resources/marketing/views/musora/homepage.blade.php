@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora - Social Learning Communities For Musicians</title>
    <meta property="og:title" content="Musora - Social Learning Communities For Musicians">

    <meta name="description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote. ">
    <meta property="og:description" content="Musora Media, Inc. is the technology that powers the most popular online social learning communities for musicians.  Learn music from the best teachers in the world at Drumeo, Guitareo, and Pianote.">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2021/share-image.jpg">

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
    </style>
    <style>
        .dot {
            left:-16px;
        }
        .full-line {
            left:0;
            bottom: 29.5%;
        }
        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }
            .full-line {
                bottom: 21.5%;
            }
        }
        @media (min-width:1024px) {
            .full-line {
                bottom: 23%;
            }
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    soundslice : false,
    trailer : false,
    }'
@endsection

@section('layout-body')
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-56 relative overflow-hidden">
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="h-24" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-title.png" alt="Your New Community musicians start here.">
            <h6 class="leading-relaxed mt-4 mb-7">Learn your favorite instruments with step-by-step lessons, thousands<br>
                of songs, and unlimited personal support.</h6>
            <a class="sm:mx-1 w-full sm:w-64 join {{ $theme }} smaller anchor-slide" href="#customize-anchor">START FOR FREE</a>
        </div>
        <img class="absolute z-10 h-20" style="top:43%;left: 2%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-04.png">
        <img class="absolute z-10 h-36" style="top:8%;left: 6%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-05.png">
        <img class="absolute z-10 h-52" style="top:62%;left: 7%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-07.png">
        <img class="absolute z-10 h-16" style="top:9%;left: 29%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-01.png">
        <img class="absolute z-10 h-16" style="top:4%;left: 56%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-03.png">
        <img class="absolute z-10 h-40" style="top:65%;left: 74%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-08.png">
        <img class="absolute z-10 h-48" style="top:9%;left: 78%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-06.png">
        <img class="absolute z-10 h-20" style="top:66%;left: 97%;" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/header-02.png">
    </section>
    <section class="text-center px-5 sm:px-6 py-5 sm:py-6 lg:py-8" style="    background: linear-gradient(45deg, #e6fffb, #e6f2ff, #f6e6ff, #ffe6e8);">
        <div class="container max-w-6xl mx-auto">
            <div class="inline-block px-5">
                <img class="h-32 mb-2" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/piano.png">
                <p>PIANO</p>
            </div>
            <div class="inline-block px-5">
                <img class="h-32 mb-2" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/guitar.png">
                <p>GUITAR</p>
            </div>
            <div class="inline-block px-5">
                <img class="h-32 mb-2" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/drums.png">
                <p>DRUMS</p>
            </div>
            <div class="inline-block px-5">
                <img class="h-32 mb-2" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/mic.png">
                <p>SINGING</p>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <h2 class="text-center sm:mb-10"><strong>The easier way to<br class="inline sm:hidden"> learn <u>any instrument</u>.</strong></h2>
            <img class="my-5 h-64 inline sm:hidden transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/intro-collage.png"
                alt="learn playing image"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center">
                <p class="leading-normal max-w-xl pr-7 mx-0">Learning an instrument can be frustrating. So we’ve made the most helpful music lessons on the planet –<br><br>Guided video lessons from great teachers, interactive exercises that transform practice into play, and <strong>thousands of popular songs</strong> for every style, era, and skill level. PLUS unlimited personal support from real teachers.<br><br>You’ll play more. You’ll fall in love with the process. And we’re so confident you’ll love your new skills that you’ll get a 7-day free trial PLUS a 90-day guarantee (just to make sure!).</p>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/intro-collage.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>


    @php
        $gridItems = [
            [
                'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/10-level-cirriculum.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'The most trusted step-by-step video lessons for piano, guitar, drums, and singing. ',
            ],
            [
                'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'Keep up your progress with clear assignments and handy practice tools for every level. ',
            ],
            [
                'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'Study with 100+ music authorities including Grammy Award winners and touring musicians. ',
            ],
            [
                'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/on-demand-courses.jpg',
                'title' => 'On-Demand Courses',
                'desc' => 'Boost any skill, anytime with topic-based courses to guide you towards any goal. ',
            ],
            [
                'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lesson OR download your videos so you can practice anywhere, anytime. ',
            ],
            [
                'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global music community. ',
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'bg' => true,
        'header' => 'Where musical dreams <br class="inline sm:hidden"> <u>come true.</u> ',
        'desc' => 'Always know <em>exactly</em> what to practice with a step-by-step curriculum for each  <br class="hidden sm:inline">instrument plus exclusive courses on any topic you’d ever want to learn!',
    ])

    @php
        $buttons = [
            'Piano', 'Guitar', 'Drums', 'Singing'
        ];

        $courses = [
            [
                'title' => 'Piano',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Classical Piano',
                    'instructor' => 'Victoria Theodore',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Improvisational Jazz',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Simple Piano Arpeggios',
                    'instructor' => 'Sangah Noona',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'The Perfect Arrangement',
                    'instructor' => 'Summer Swee-Singh',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Creative Songwriting',
                    'instructor' => 'Josh Dion',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Rhythmic Playing',
                    'instructor' => 'Jay Oliver',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Gospel Piano',
                    'instructor' => 'Erskine Hawkins',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Latin Essentials',
                    'instructor' => 'Kevin Castro',
                    ],
                ]
            ],
            [
                'title' => 'Guitar',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Solo In An Hour',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Songwriting Cheat Codes',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Rhythm & Groove',
                    'instructor' => 'Sami Ghawi',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Shred Guitar',
                    'instructor' => 'Dean Lamb',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Unlock Your Creativity',
                    'instructor' => 'Yvette Young',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Musical Lanes',
                    'instructor' => 'Mark Lettieri',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dennis-Chambers.jpg',
                    'title' => 'Add Power To Your Playing',
                    'instructor' => 'Dave Weiner',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dennis-Chambers.jpg',
                    'title' => 'The Anatomy of a Song',
                    'instructor' => 'Pete Thorn',
                    ],
                ]
            ],
            [
                'title' => 'Drums',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Drum Chops',
                    'instructor' => 'Aaron Spears',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Writing Drum Parts',
                    'instructor' => 'Hannah Welton',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Rock Drumming',
                    'instructor' => 'Todd Sucherman',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Song Breakdowns',
                    'instructor' => 'Matt McGuire',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Rudiments & Patterns',
                    'instructor' => 'Dorothea Taylor',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'The Creative Mindset',
                    'instructor' => 'Aric Improta',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Musical Exercises',
                    'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => '4-Way Coordination',
                    'instructor' => 'Sarah Thawer',
                    ]
                ]
            ],
            [
                'title' => 'Singing',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Find Your True Voice',
                    'instructor' => 'Sheléa',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'The Power of Movement',
                    'instructor' => 'Chris Johnson',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Singing With Soul',
                    'instructor' => 'Tony Lindsay',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Define Your Singing',
                    'instructor' => 'Cate Canning',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'The Science of Singing Better',
                    'instructor' => 'Darcy D',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Songwriting For Singers',
                    'instructor' => 'Hailey Benedict',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Hit The High Notes',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Beautiful Harmonies',
                    'instructor' => 'Julia Ziegler',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden"><u>best musicians.</u>',
        'desc' => 'Amplify your skills with artist courses and live events.'
    ])

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-20" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/just-press-play-title.png" alt="collage intro mobile">
            <p class="text-center mt-5 mb-16 sm:mt-5 sm:mb-20">Musora is loaded with practice tools and guided workouts
                <br class="hidden sm:inline"> to help you learn music by actually playing.</p>

            @php
                $gettings = [

                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/your-schedule.png',
                    'title' => 'Practice on your schedule. ',
                    'desc' => 'Day or night. Here or there. Musora goes anywhere – an app for iOS or Android, a full desktop experience, as well as downloadable videos and printable PDFs so you can learn your way, every time. ',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/know-exactly.png',
                    'title' => 'Know exactly what to practice. ',
                    'desc' => 'You’ll never be left wondering what to do – with one-click progress tracking on every lesson and exercise so you know exactly where you left off and what to practice next. ',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/sheet-music-alive.png',
                    'title' => 'Sheet music that comes alive!',
                    'desc' => 'Every lesson comes with interactive assignments to make your practice session easier. Play-along to the sheet music, create loops, and adjust the speed to hit the right note, every time. ',
                    ],
                ];
//            @endphp
            <div class="max-w-3xl lg:max-w-4xl mx-auto relative px-4 mt-7">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}"></div>
                            <div class="dot absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @else
                        <div class="relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}"></div>
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="dot absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @endif
                @endforeach
                <div class="full-line absolute bg-white top-0 z-0 transform -translate-x-1/2" style="width: 3px;"></div>
            </div>
        </div>
    </section>


    @php
        $songItems = [
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/popular-song-icon.svg',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/isolate-icon.svg',
                'title' => 'Ditch the distractions',
                'desc' => 'Isolate the piano, guitar, or drums so you always know exactly what to play.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/loop-icon.svg',
                'title' => 'Simplify the tricky parts',
                'desc' => 'Learn songs faster with perfect notation, practice loops, and tempo control.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/metronome-icon.svg',
                'title' => 'Improve your timing',
                'desc' => 'Use built-in metronome - your new best friend to get the timing just right. ',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/notation-icon.svg',
                'title' => 'Play it right the first time.',
                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/devices-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,so you can play any song, any time.',
            ],

        ];
    @endphp
    <div id="songs" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <h2><strong>Play <u>1000+</u> popular songs.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3">You’ll have <strong>all the tools you need</strong> to play the songs you love. <strong class="cursor-pointer" x-on:click="soundslice = true;"><u>Try the demo &raquo;</u></strong></p>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto">
                <div style="padding-bottom:62.4%;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png)" class="mt-4 sm:mt-6 lg:my-6 bg-cover bg-center" x-on:click="soundslice = true;" ></div>
            </div>
            <div class="">
                <div class="inline-block border-2 rounded-full border-drumeo py-1 px-10 mx-2"><img class="h-6" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/drum-button-icon-color.svg"></div>
                <div class="inline-block border-2 rounded-full border-pianote py-1 px-10 mx-2"><img class="h-6" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/piano-button-icon-color.svg"></div>
                <div class="inline-block border-2 rounded-full border-guitareo py-1 px-10 mx-2"><img class="h-6" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/guitar-button-icon-color.svg"></div>
                <div class="inline-block border-2 rounded-full border-singeo py-1 px-10 mx-2"><img class="h-6" src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/mic-button-icon-color.svg"></div>
            </div>
            <div class="text-center w-full sm:w-auto mt-6 lg:mt-10 mx-auto">
                <div class="flex flex-wrap">
                    @foreach ($songItems as $songItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                            <div class="flex sm:inline-block">
                                <div class="w-14 sm:w-full flex-shrink-0">
                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">
                                </div>
                                <div class="text-left sm:text-center">
                                    <p class="mb-1 sm:my-2"><strong>{!!$songItem['title']!!}</strong></p>
                                    <p class="text-sm">{!! $songItem['desc'] !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if(empty($promoVersion))
                <a href="/songs" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline text-{{ $theme }} border-{{ $theme }} smaller">SEE SONGS LIST <i class="fas fa-list-music"></i> </a>
            @endif
            <a class="sm:mx-1 w-full sm:w-64 join {{ $theme }} smaller @if(!empty($promoVersion)) anchor-slide @endif"
                @if(!empty($promoVersion))
                    href="#customize-anchor"
                @elseif(!empty($month))
                    href="/choose-your-trial-month"
                @else
                    href="/choose-plan"
                @endif
            >
                @if(!empty($promoVersion) && empty($trialVersion))
                    SEE YOUR DEAL &raquo;
                @else
                    START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                @endif
            </a>
        </div>
    </section>

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
            'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead -- she’s used Drumeo to build a foundation and formed a band.',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'A home for <u>every</u> musician.',
        'subheadline' => 'Get the personal support you need to see the results you want.',
        $testimonialFeats = [
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/live-icon.svg',
                'title' => 'Live Events',
                'desc' => 'Join weekly live lessons, Q&As and exclusive bootcamps.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/special-guest-icon.svg',
                'title' => 'Special Guests',
                'desc' => 'Get insider access to the world’s best musicians and coaches.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/mentors-icon.svg',
                'title' => 'Personal Mentors',
                'desc' => 'Get past your unique challenges with support from your mentor.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/forum-icon.svg',
                'title' => 'Community Forum',
                'desc' => 'Learn from others, share your progress & connect with other students.',
            ],
        ],
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738',
        'reviewText' => 'Don’t take it from us. Musora is trusted by ' . number_format(Prices::$students) . ' students & is rated 5-stars<br> for price, satisfaction, and customer service.',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/guarantee-musora.png',
        'header' => '<strong>Happy student guarantee.</strong><br>7-days free + <strong>90-days to fall in love.</strong>',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with a <strong>7-day trial PLUS our 90-day guarantee</strong> to make sure you’re seeing results and enjoying a fresh, positive start to your musical journey.',
    ])
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeoplus_logo.svg",
        "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
        "songs" => "5000",
        "firstPoint" => "The world’s best drum lessons.",
        "thirdPoint" => "Unlimited personal support",
        "fifthPoint" => "Lesson access for piano, guitar, and singing.",
        "plusAnnualLink" => "/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true",
        "plusMonthlyLink" => "/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true",
        "annualLink" => "/ecommerce/add-to-cart?products[drumeo-base-annual-recurring-7-day-trial-membership]=1&locked=true",
        "monthlyLink" => "/ecommerce/add-to-cart?products[drumeo-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
    ])

    @include('musora.sales.components.app-section', [
        'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone&ppid=d63c2cf3-274f-4441-8444-a5f547b1b4b6',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=drumeo_previews',
    ])

    @include('musora._partials._faq')

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
