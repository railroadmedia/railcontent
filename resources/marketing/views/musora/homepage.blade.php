@extends('musora._partials.layout', [
    'whiteNav' => true,
])

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }

        .join.white {
            background:#fff;
            color:#000;
        }

        .join.white:hover, .join.white:focus {
            background:#eee;
        }

        .join.smaller {
            padding:8px 30px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:11px 30px;
            }
        }

        .join.smaller.outline {
            padding:8px 28px 6px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller.outline {
                font-size:18px;
                padding:10px 28px 8px;
            }
        }

        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .join.outline {
            background:transparent;
            outline-style:none !important;
            border:1px solid #fff;
            color:#fff;
            padding:6px 12px;
        }

        @media (min-width:768px) {
            .join.outline {
                border-width:2px;
                padding:11px 30px;
            }
        }

        .join.outline:hover, .join.outline:focus {
            background:#fff;
            color:#000;
        }

        .join.outline.black {
            border-color:#000;
            color:#000;
        }
        .join.outline.black:hover, .join.outline.black:focus {
            background:#000;
            color:#fff;
        }
        .join.outline.musora {
            border-color:#0c1524;
            color:#0c1524;
        }

        .join.outline.musora:hover, .join.outline.musora:focus {
            background:#0c1524;
            color:#fff;
        }

        .text-musora-black {
            color:#0c1524;
        }

        .text-musora,
        .text-musora-gold {
            color:#FFAE00;
        }

        .splide__pagination__page.is-active {
            background:#01050F;
            transform:none !important;
        }

        .splide__pagination__page {
            margin:3px 10px !important;
            opacity:1 !important;
        }

        @media (min-width:768px) {
            .splide__pagination__page {
                margin:3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }

        .dot {
            left:-16px;
        }

        .full-line {
            left:0;
            bottom:31%;
        }

        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }

            .full-line {
                bottom:0;
            }
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        brand: "pianote",
        drumeoSoundslice: false,
        pianoteSoundslice: false,
        guitareoSoundslice: false,
        singeoSoundslice: false,
        trailer: false,
    }'
@endsection

@section('layout-body')
    <section class="text-center px-5 sm:px-6 py-32 sm:py-52 lg:py-56 relative overflow-hidden" style="background:linear-gradient(to bottom, #fff 40%, #F1EFED);">
        <div class="container max-w-xs sm:max-w-6xl mx-auto relative z-20">
            <h1 class="relative w-auto inline-block text-3xl sm:text-4xl lg:text-5xl">
                <strong>Your musical goals <br class="inline sm:hidden"> start here.</strong>
                <img class="w-64 lg:w-80 sm:absolute -mt-4 sm:mt-0 sm:-bottom-1 sm:-right-6 px-7" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/underline.png" alt="underline" fetchpriority="high">
            </h1>
            <h6 class="leading-relaxed sm:mt-6 mb-4 sm:mb-7 px-5 sm:px-0 max-w-xs sm:max-w-full">
                Find your musical flow with step-by-step lessons, <br class="hidden sm:inline">
                thousands of songs, and unlimited personal support.</h6>
            <a class="sm:mx-1 w-full sm:w-56 join musora-gold smaller" href="/choose-plan">START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
        <img class="absolute z-10 h-10 sm:h-14 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header4.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-24 sm:h-28 lg:h-44 transform -translate-x-1/2 -translate-y-1/2 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]" src="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header5.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-32 sm:h-40 lg:h-52 transform -translate-x-1/2 -translate-y-1/2 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header7.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-10 sm:h-12 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header1.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-10 sm:h-12 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header3.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-28 sm:h-32 lg:h-48 transform -translate-x-1/2 -translate-y-1/2 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header8.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-28 sm:h-36 lg:h-52 transform -translate-x-1/2 -translate-y-1/2 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header6.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-12 sm:h-14 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header2.png" alt="header circle image" fetchpriority="high">
    </section>

    <section class="text-center text-white py-5 sm:py-7" style="background-color:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex-wrap justify-center items-center hidden sm:flex">
                <h5 class="px-1 sm:px-5 lg:px-10"><i class="text-pianote text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-piano-keyboard"></i> <strong>Piano</strong></h5>
                <h5 class="px-1 sm:px-5 lg:px-10"><i class="text-guitareo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-guitar"></i> <strong>Guitar</strong></h5>
                <h5 class="px-1 sm:px-5 lg:px-10"><i class="text-drumeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-drum"></i> <strong>Drums</strong></h5>
                <h5 class="px-1 sm:px-5 lg:px-10"><i class="text-singeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-microphone-stand"></i> <strong>Singing</strong></h5>
            </div>
            <div class="flex-wrap justify-center items-center flex sm:hidden">
                <p class="px-2 sm:px-5 lg:px-10"><i class="text-pianote text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-piano-keyboard"></i> <strong>Piano</strong></p>
                <p class="px-2 sm:px-5 lg:px-10"><i class="text-guitareo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-guitar"></i> <strong>Guitar</strong></p>
                <p class="px-2 sm:px-5 lg:px-10"><i class="text-drumeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-drum"></i> <strong>Drums</strong></p>
                <p class="px-2 sm:px-5 lg:px-10"><i class="text-singeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fal fa-microphone-stand"></i> <strong>Singing</strong></p>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20" style="background-color:#f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <img class="text-center mx-auto sm:h-20 lg:h-24 mb-10 hidden sm:inline-block" src="https://musora-center.s3.amazonaws.com/homepage/2023/learn-practice-play.png">
            <img class="text-center mx-auto h-24 inline-block sm:hidden" src="https://musora-center.s3.amazonaws.com/homepage/2023/learn-practice-play-m.png">
            <img class="my-5 h-64 inline sm:hidden"
                src="https://www.musora.com/musora-cdn/image/width=620,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/intro-collage3.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center mb-5">
                <p class="leading-normal max-w-xl pr-7 mx-0">Learning an instrument can be frustrating. So we’ve made the most helpful music lessons on the planet:
                    <br><br>
                    Guided video lessons from great teachers, interactive exercises that transform practice into play, and <strong>thousands of popular songs</strong> for every style, era, and skill level. PLUS unlimited personal support from real teachers.
                    <br><br>
                    You’ll play more. You’ll fall in love with the process. And we’re so confident you’ll love your new skills that you’ll get a 7-day free trial PLUS a 90-day guarantee (just to make sure!).
                </p>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/intro-collage3.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-20" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>




    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <div id="method" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <h2 class="leading-tight"><strong><span class="border-2 border-musora rounded-full px-3 sm:px-4 py-1 inline-block">6</span> reasons why you’ll <br class="inline sm:hidden">love learning here.</strong></h2>
            <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">Level up your skills with the lessons, teachers, and<br class="hidden sm:inline lg:hidden">  practice tools <strong class="font-black">trusted by <span class="text-musora">{{ number_format(Prices::$students) }}</span> active students</strong>. </p>
            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 hidden sm:flex">

                @php
                    $gridItems = [
                        [
                            'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/10-level-cirriculum.jpg',
                            'title' => 'Step-By-Step Clarity',
                            'desc' => 'Learn the right skills in the right order with our 10-level curriculum for each instrument. ',
                            'lessonInfo' => [
                                [
                                    'thumb' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/10-level-cirriculum.jpg',
                                ],
                            ]
                        ],
                        [
                            'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/practical-assignments.jpg',
                            'title' => 'Handy Practice Tools',
                            'desc' => 'Gain momentum with interactive exercises, speed control, looping, and progress tracking.',
                            'lessonInfo' => [
                                [
                                    'thumb' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/practical-assignments.jpg',
                                ],
                            ]
                        ],
                        [
                            'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/world-class-teachers.jpg',
                            'title' => 'World-Class Teachers',
                            'desc' => 'Study with 100+ music authorities including Grammy Award winners and touring musicians. ',
                            'lessonInfo' => [
                                [
                                    'thumb' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/world-class-teachers.jpg',
                                ],
                            ]
                        ],
                        [
                            'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/on-demand-courses2.jpg',
                            'title' => 'On-Demand Courses',
                            'desc' => 'Prefer to jump around? Boost any skill, anytime with topic-based courses for any musical goal. ',
                            'lessonInfo' => [
                                [
                                    'thumb' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/on-demand-courses2.jpg',
                                ],
                            ]
                        ],
                        [
                            'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/downloadable-videos.jpg',
                            'title' => 'Downloadable Videos',
                            'desc' => 'Stream your lesson OR download your videos so you can learn and practice anywhere, anytime. ',
                            'lessonInfo' => [
                                [
                                    'thumb' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/downloadable-videos.jpg',
                                ],
                            ]
                        ],
                        [
                            'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/personalized-support.jpg',
                            'title' => 'Powered By Humans',
                            'desc' => 'Get weekly live streams, student lesson plans, and access to a global music community. ',
                            'lessonInfo' => [
                                [
                                    'thumb' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/personalized-support.jpg',
                                ],
                            ]
                        ],
                    ];
                @endphp
                @foreach ($gridItems as $key => $gridItem)
                    <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0 max-w-xs sm:max-w-full">
                        <picture class="w-1/3 sm:w-full">
                            <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/{{ $gridItem['image'] }}">
                            <img
                                class=" rounded-xl mb-3 transition-opacity opacity-0"
                                src="https://www.musora.com/musora-cdn/image/width=200,quality=95/{{ $gridItem['image'] }}"
                                alt="grid{{$key+1}}"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                            >
                        </picture>
                        <div class="w-2/3 sm:w-full pl-3 sm:pl-0">
                            <p class="leading-tight mb-0.5"><strong class="font-black"><span class="border border-musora rounded-full px-2 py-0.5 inline-block">{{$key+1}}</span> {{ $gridItem['title'] }}</strong></p>
                            <p class="leading-normal text-sm">{{ $gridItem['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 flex sm:hidden">
                @foreach ($gridItems as $key => $gridItem)
                    @include('_partials.components.question-dropdown', [
                        'variant' => true,
                        'num' => $key+1,
                        "title" => $gridItem['title'],
                        "desc" => $gridItem['desc'],
                        'lessonInfo' => $gridItem['lessonInfo'],
                        'open' => $key === 0 ? true : false
                    ])
                @endforeach
            </div>
            @if(empty($promoVersion))
                <a href="/method" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline {{ $theme }} smaller">{{ $theme }} METHOD</a>
            @endif
            <a class="sm:mx-1 w-full sm:w-64 mb-5 join {{ $theme }}-gold smaller @if(!empty($promoVersion)) anchor-slide @endif"
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
        $buttons = [
            '<i class="text-pianote align-middle mr-0.5 fal fa-piano-keyboard"></i> Piano',
            '<i class="text-guitareo align-middle mr-0.5 fal fa-guitar"></i> Guitar',
            '<i class="text-drumeo align-middle mr-0.5 fal fa-drum"></i> Drums',
            '<i class="text-singeo align-middle mr-0.5 fal fa-microphone-stand"></i> Singing'
        ];

        $courses = [
            [
                'title' => '<i class="text-pianote align-middle mr-0.5 fal fa-piano-keyboard"></i> Piano',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/classical-piano.jpg',
                    'title' => 'Classical<br> Piano',
                    'instructor' => 'Victoria Theodore',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/improvisational-jazz.jpg',
                    'title' => 'Improvisational<br> Jazz',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/beautifully-simple-piano-arpeggios.jpg',
                    'title' => 'Simple Piano<br> Arpeggios',
                    'instructor' => 'Sangah Noona',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/the-perfect-arrangement.jpg',
                    'title' => 'The Perfect<br> Arrangement',
                    'instructor' => 'Summer Swee-Singh',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/creative-song-writing.jpg',
                    'title' => 'Creative<br> Songwriting',
                    'instructor' => 'Josh Dion',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/rhythmic-playing.jpg',
                    'title' => 'Rhythmic<br> Playing',
                    'instructor' => 'Jay Oliver',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/gospel-piano.jpg',
                    'title' => 'Gospel<br> Piano',
                    'instructor' => 'Erskine Hawkins',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/latin-essentials.jpg',
                    'title' => 'Latin<br> Essentials',
                    'instructor' => 'Kevin Castro',
                    ],
                ]
            ],
            [
                'title' => '<i class="text-guitareo align-middle mr-0.5 fal fa-guitar"></i> Guitar',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/solo-in-an-hour.jpg',
                    'title' => 'Solo In<br> An Hour',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/songwriting-cheat-codes.jpg',
                    'title' => 'Songwriting<br> Cheat Codes',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/rhythm-groove.jpg',
                    'title' => 'Rhythm &<br> Groove',
                    'instructor' => 'Sami Ghawi',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/shred-guitar.jpg',
                    'title' => 'Shred<br> Guitar',
                    'instructor' => 'Dean Lamb',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/unlock-your-creativity.jpg',
                    'title' => 'Unlock Your<br> Creativity',
                    'instructor' => 'Yvette Young',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/musical-lanes.jpg',
                    'title' => 'Musical<br> Lanes',
                    'instructor' => 'Mark Lettieri',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/add-power-to-your-playing.jpg',
                    'title' => 'Add Power To<br> Your Playing',
                    'instructor' => 'Dave Weiner',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/the-anatomy-of-a-song.jpg',
                    'title' => 'The Anatomy<br> of a Song',
                    'instructor' => 'Pete Thorn',
                    ],
                ]
            ],
            [
                'title' => '<i class="text-drumeo align-middle mr-0.5 fal fa-drum"></i> Drums',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aaron-Spears.jpg',
                    'title' => 'Drum<br> Chops',
                    'instructor' => 'Aaron Spears',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Hannah-Welton.jpg',
                    'title' => 'Writing<br> Drum Parts',
                    'instructor' => 'Hannah Welton',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Todd-Sucherman.jpg',
                    'title' => 'Rock <br>Drumming',
                    'instructor' => 'Todd Sucherman',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Matt-McGuire.jpg',
                    'title' => 'Song<br> Breakdowns',
                    'instructor' => 'Matt McGuire',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Dorothe-Taylor-01.jpg',
                    'title' => 'Rudiments <br>& Patterns',
                    'instructor' => 'Dorothea Taylor',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aric-Improta.jpg',
                    'title' => 'The Creative<br> Mindset',
                    'instructor' => 'Aric Improta',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Kaz-Rodgriguez.jpg',
                    'title' => 'Musical <br>Exercises',
                    'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Sarah-Thawer.jpg',
                    'title' => '4-Way <br>Coordination',
                    'instructor' => 'Sarah Thawer',
                    ]
                ]
            ],
            [
                'title' => '<i class="text-singeo align-middle mr-0.5 fal fa-microphone-stand"></i> Singing',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/find-your-true-voice.jpg',
                    'title' => 'Find Your<br> True Voice',
                    'instructor' => 'Sheléa',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/The-power-of-movement.jpg',
                    'title' => 'The Power<br> of Movement',
                    'instructor' => 'Chris Johnson',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/singing-with-soul.jpg',
                    'title' => 'Singing<br> With Soul',
                    'instructor' => 'Tony Lindsay',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/define-your-singing.jpg',
                    'title' => 'Define Your<br> Singing',
                    'instructor' => 'Cate Canning',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/the-science-of-singing-better.jpg',
                    'title' => 'The Science<br> of Singing Better',
                    'instructor' => 'Darcy D',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/songwriting-for-singers.jpg',
                    'title' => 'Songwriting <br>For Singers',
                    'instructor' => 'Hailey Benedict',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/hit-the-high-notes.jpg',
                    'title' => 'Hit The <br>High Notes',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/beautiful-harmonies.jpg',
                    'title' => 'Beautiful<br> Harmonies',
                    'instructor' => 'Julia Ziegler',
                    ],
                ]
            ],
        ];
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden"><u>best teachers.</u>',
        'desc' => 'Amplify your skills with artist<br class="inline sm:hidden"> courses and live events.',
        'split' => true
    ])

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white" style="background:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-10 sm:h-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/just-press-play-title2.png" alt="collage intro mobile" loading="lazy" onload="this.classList.remove('opacity-0')">
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
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/sheet-music-alive2.png',
                    'title' => 'Sheet music that comes alive!',
                    'desc' => 'Every lesson comes with interactive assignments to make your practice session easier. Play-along to the sheet music, create loops, and adjust the speed to hit the right note, every time. ',
                    ],
                ];
//            @endphp
            <div class="max-w-3xl lg:max-w-4xl mx-auto relative sm:px-4 mt-7 pb-10 sm:pb-20">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h5 class="mb-2 md:mb-4 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 bg-contain bg-top bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }});"></div>
                            <div class="dot hidden sm:block absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @else
                        <div class="relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if($key !== 2) mb-16 md:mb-28 @endif">
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 bg-contain bg-top bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }});"></div>
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h5 class="mb-2 md:mb-4 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h5>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <div class="dot hidden sm:block absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @endif
                @endforeach
                <div class="full-line hidden sm:block absolute bg-white top-0 z-0 transform -translate-x-1/2" style="width: 2px;"></div>
            </div>
            <div class="text-center sm:text-left sm:text-center mb-5">
                <img class="h-24 mb-4 transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')" src="https://www.musora.com/musora-cdn/image/width=190,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/guarantee-musora-line.png" alt="bonus icon">
                <h5><strong><i class="fas fa-star text-musora"></i> BETTER PRACTICE GUARANTEE <i class="fas fa-star text-musora"></i></strong></h5>
                <p class="max-w-sm mx-auto leading-normal mt-3">You’ll get 7 days free PLUS a 90-day guarantee<br> to make sure you love your improvements!</p>
            </div>
            <a class="sm:mx-1 w-full sm:w-64 join musora-gold smaller @if(!empty($promoVersion)) anchor-slide @endif"
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


    <div id="songs" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong><u>1000+</u> popular songs.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3 mb-7">You’ll have <strong>all the tools you need</strong><br class="inline sm:hidden"> to play the songs you love.</p>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'pianote'">
                <div style="padding-bottom:62.4%;" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="pianoteSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/pianote-player2.png" alt="pianote player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'guitareo'">
                <div style="padding-bottom:62.4%" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="guitareoSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/guitareo-player2.png" alt="guitareo player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'drumeo'">
                <div style="padding-bottom:62.4%;" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="drumeoSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/drumeo-player2.png" alt="drumeo player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'singeo'">
                <div style="padding-bottom:62.4%" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="singeoSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/singeo-player2.png" alt="singeo player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="">
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-pianote text-xl"
                    :class="brand === 'pianote' ? 'text-white bg-pianote' : 'text-pianote'"
                    @click="brand = 'pianote'"
                >
                    <i class="fa-regular fa-piano-keyboard"></i>
                </div>
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-guitareo text-xl"
                    :class="brand === 'guitareo' ? 'text-white bg-guitareo' : 'text-guitareo'"
                    @click="brand = 'guitareo'"
                >
                    <i class="fa-light fa-guitar"></i>
                </div>
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-drumeo text-xl"
                    :class="brand === 'drumeo' ? 'text-white bg-drumeo' : 'text-drumeo'"
                    @click="brand = 'drumeo'"
                >
                    <i class="fa-regular fa-drum"></i>
                </div>
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-singeo text-xl"
                    :class="brand === 'singeo' ? 'text-white bg-singeo' : 'text-singeo'"
                    @click="brand = 'singeo'"
                >
                    <i class="fa-light fa-microphone-stand"></i>
                </div>
            </div>
            <div class="text-center w-full sm:w-auto mt-6 sm:mt-12 mx-auto mb-5 sm:mb-10">
                <div class="hidden sm:flex flex-wrap">
                    @php
                        $songItems = [
                            [
                                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/popular-song-icon.svg',
                                'fa-icon' => 'fa-music',
                                'title' => '1000+ popular songs.',
                                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level.',
                            ],
                            [
                                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/isolate-icon.svg',
                                'fa-icon' => 'fa-sliders-up',
                                'title' => 'Ditch the distractions.',
                                'desc' => 'Isolate the piano, guitar, or drums so you always know exactly what to play.',
                            ],
                            [
                                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/loop-icon.svg',
                                'fa-icon' => 'fa-arrows-repeat',
                                'title' => 'Simplify the tricky parts.',
                                'desc' => 'Learn songs faster with perfect notation, practice loops, and tempo control.',
                            ],
                            [
                                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/metronome-icon.svg',
                                'fa-icon' => 'fa-timer',
                                'title' => 'Improve your timing.',
                                'desc' => 'Use built-in metronome - your new best friend to get the timing just right. ',
                            ],
                            [
                                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/notation-icon.svg',
                                'fa-icon' => 'fa-list-music',
                                'title' => 'Play it right the first time.',
                                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
                            ],
                            [
                                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/devices-icon.svg',
                                'fa-icon' => 'fa-laptop-mobile',
                                'title' => 'Take your songs anywhere.',
                                'desc' => 'Accessible on any device, or printable,so you can play any song, any time.',
                            ],

                        ];
                    @endphp
                    @foreach ($songItems as $songItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 sm:mb-4">
                            <div class="flex sm:inline-block">
                                <div class="w-14 sm:w-full flex-shrink-0">
                                    <i class="fal {!! $songItem['fa-icon'] !!} text-3xl sm:text-4xl text-musora-black"></i>
{{--                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">--}}
                                </div>
                                <div class="text-left sm:text-center">
                                    <p class="mb-1 sm:my-2"><strong class="font-black">{!!$songItem['title']!!}</strong></p>
                                    <p class="text-sm">{!! $songItem['desc'] !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 flex sm:hidden">
                    @foreach ($songItems as $key => $songItem)
                        @include('_partials.components.question-dropdown', [
                            'variant' => true,
                            "title" => '<i class="fal ' . $songItem['fa-icon'] . ' text-xl mr-1.5 text-musora-black"></i>' . $songItem['title'],
                            "desc" => $songItem['desc'],
                            'open' => $key === 0 ? true : false
                        ])
                    @endforeach
                </div>
            </div>
            @if(empty($promoVersion))
                <a href="/songs" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline {{ $theme }} smaller">SEE SONGS LIST</a>
            @endif
            <a class="sm:mx-1 w-full sm:w-64 join {{ $theme }}-gold smaller @if(!empty($promoVersion)) anchor-slide @endif"
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
            'brand' => 'Drummer',
            'video' => '342059271',
            'title' => 'I’m loving music more than I ever did before!',
            'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
            'name' => 'Lisa Aragon',
            'brand' => 'Drummer',
            'video' => '373252004',
            'title' => 'I was able to play drums on stage!',
            'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
            'title' => "If I was taught this way as a child, I would have never quit.",
            'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'brand' => 'Pianist',
            'location' => 'Ontario, Canada',
            ],
            [
            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
            'title' => "I’m blown away by the program you’ve created.",
            'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
            'name' => 'Jess Ripley',
            'brand' => 'Pianist',
            'location' => 'California, USA',
            ],
            [
            'title' => "I’m lightyears ahead of where I was.",
            'description' => "I’ve come so far in such a short period of time. I’ve gone from not even knowing what palm muting was to noodling with the E & A string pentatonic shapes and creating melodies with it – and using it to work on my vibrato, slides, and bends. And I’ve gained priceless info like knowing where to place chords, start power chords, and scale shapes.<br><br>Having the breakthroughs I’ve had so far has brought me confidence and kept me sane while the world is seemingly not – and made me believe there is still a bright future ahead. As I progress, I feel supported towards achieving my goals of jamming with others and using my love for writing to start telling stories through music. All in due time.<br><br>I’m lightyears ahead of where I was at. And no matter where I go, or however tough things get, I’ll always have one of my guitars in the passenger seat and we’ll always be there for each other. The life long journey has begun!",
            'name' => 'Ërlik Sörensen',
            'brand' => 'Guitarist',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/2022/testimonials/erliksorensen.jpg',
            'location' => 'British Columbia, Canada',
            ],
            [
            'title' => "I’ve never felt so much JOY playing the guitar.",
            'description' => "When I finished the first lesson, I had a feeling of joy that I’ve never had before when playing guitar. I'm experimenting a lot more and improving my technique. The goal-based learning makes each set of lessons more entertaining and a feeling of accomplishment when completed.",
            'name' => 'Jamie K',
            'brand' => 'Guitarist',
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/testimonials/jamie-nova-scotia.jpg',
            'location' => 'Nova Scotia, Canada',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/OriannaSells.jpg',
            'name' => 'Orianna Sells',
            'brand' => 'Singer',
            'title' => 'It felt like the chains finally fell off my voice.',
            'description' => 'I was concerned that my singing style was too different to truly learn what I needed – and I wanted to strengthen my voice and stretch my range in a healthy manner.<br><br>With Singeo, I started practicing my songs more meticulously and it paid off – stronger high notes were available and it felt like the chains finally fell off my voice!',
            'location' => 'South Carolina, USA',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/DamienGiven3.jpg',
            'name' => 'Damien Given',
            'brand' => 'Singer',
            'title' => 'I’m getting back some of my old confidence.',
            'description' => 'Thirty-five years ago, I sang professionally in a group. And now at 74 years old, I’d given up the idea of ever singing properly again. But when tendonitis put a stop to my piano playing for several months, I decided to give Singeo a try – and boy, what a great choice!<br><br>I’m getting back some of my old confidence through the lessons and feedback – and I’m now keen to regain more pitch and breathing control, even though physiologically I’ve probably lost about one and a half steps at the top of my range. But that doesn’t bother me as much as I thought it would after a few months with Singeo. I’ve received a great deal of positive feedback from my classmates - and great tips from Lisa, Julia, and the team. What a find, what a course, and what great tutors!',
            'location' => 'Northern Ireland',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'desktopGrid' => true,
        'header' => 'Your new musical home. ',
        'reviewText' => 'Music students everywhere are reaching their goals with Musora.<br class="hidden sm:inline"> Check out the reviews and meet some of our friendly students. ',
    ])
    @include('musora._partials.order-section-collage')

    @include('musora.sales.components.app-section', [
        'image' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/devices2.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
    ])

    @include('musora._partials._faq')

    @include('_partials.components.video-modal',[
        'name' => 'drumeoSoundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'pianoteSoundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'guitareoSoundslice',
        'video' => 'Mnmkc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'singeoSoundslice',
        'video' => 'ZsC4c',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
