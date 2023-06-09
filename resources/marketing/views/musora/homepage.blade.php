@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image.jpg">

    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
<style>
    .join {
        display: inline-block;
        font: 500 22px/1em 'Bebas Neue', sans-serif;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        background: #0c1524;
        border-radius: 50px;
        color: #fff;
        padding: 17px 7%;
        outline: none;
        cursor: pointer;
        text-align: center;
        user-select: none;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s, opacity 0.3s;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
    }
    @media (min-width: 768px) {
        .join {
            font-size: 30px;
        }
    }
    .join:hover, .join:focus {
        color: #fff;
        background:#14233d;
        box-shadow: 0 0 7px rgba(0, 0, 0, 0.35);
    }
    .join.green {
        background: #10d05f;
    }
    .join.green:hover, .join.green:focus {
        background: #25ee78;
    }
    .join.white {
        background: #fff;
        color: #000;
    }
    .join.white:hover, .join.white:focus {
        background: #eee;
    }
    .join.sold-out {
        background: #777;
    }
    .join.sold-out:hover, .join.sold-out:focus {
        background: #919191;
    }
    .join.smaller {
        padding: 10px 30px 6px;
        font-size: 16px;
    }
    @media (min-width: 768px) {
        .join.smaller {
            font-size: 18px;
            padding: 12px 30px 10px;
        }
    }
    .join.smaller.outline {
        padding: 8px 28px 6px;
        font-size: 16px;
    }
    @media (min-width: 768px) {
        .join.smaller.outline {
            font-size: 18px;
            padding: 10px 28px 8px;
        }
    }
    .join.coaches {
        background-color: #fe9f13;
        color: #000;
    }
    .join.coaches:hover, .join.coaches:focus {
        background: #feb446;
        color: #000;
    }
    .join.promo {
        background: #ffac00;
        color: #000;
    }
    .join.promo:hover, .join.promo:focus {
        background: #ffbd33;
        color: #000;
    }
    .join.outline {
        background: transparent;
        outline-style: none !important;
        border: 1px solid #fff;
        color: #fff;
        padding: 6px 12px;
    }
    @media (min-width: 768px) {
        .join.outline {
            border-width: 2px;
            padding: 11px 30px;
        }
    }
    .join.outline:hover, .join.outline:focus {
        background: #fff;
        color: #000;
    }
    .join.outline.light-navy {
        border-color: #a1afc9;
        color: #a1afc9;
    }
    .join.outline.light-navy:hover, .join.outline.light-navy:focus {
        background: #a1afc9;
        color: #000;
    }
    .join.outline.method, .join.outline.pianote {
        border-color: #f61a30;
        color: #f61a30;
    }
    .join.outline.method:hover, .join.outline.pianote:hover, .join.outline.method:focus, .join.outline.pianote:focus {
        background: #f61a30;
        color: #fff;
    }
    .join.outline.songs {
        border-color: #17d1fa;
        color: #17d1fa;
    }
    .join.outline.songs:hover, .join.outline.songs:focus {
        background: #17d1fa;
        color: #fff;
    }
    .join.outline.coaches {
        border-color: #fe9f13;
        color: #fe9f13;
    }
    .join.outline.coaches:hover, .join.outline.coaches:focus {
        background: #fe9f13;
        color: #fff;
    }
    .join.outline.promo {
        border-color: #ffac00;
        color: #ffac00;
    }
    .join.outline.promo:hover, .join.outline.promo:focus {
        background: #ffac00;
        color: #fff;
    }

    .text-musora {
        color: #0c1524;
        -webkit-text-fill-color: #0c1524 !important;
    }

    .text-musora-gold {
        color: #FFAE00;
    }

    .bg-musora {
        background:#0c1524 !important;
    }
    .border-musora {
        border-color:#0c1524!important;
    }
    .border-musora::before {
        content:none!important;
    }
</style>
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

            .option-buttons.active {
                border-color:#fff!important;
                background:linear-gradient(45deg, #0a3f48, #122753, #2b1054, #3e1033)!important;
            }
            .option-buttons.active .radio-check {
                border-color:#fff!important;
                background-color:#fff!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
                color:#000!important;
            }
    </style>
    <style>
        .dot {
            left:-16px;
        }
        .full-line {
            left:0;
            /*bottom: 29.5%;*/
            bottom: 31%;
        }
        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }
            .full-line {
                bottom:0;
            }
            /*.full-line {*/
            /*    bottom: 21.5%;*/
            /*}*/
        }
        /*@media (min-width:1024px) {*/
        /*    .full-line {*/
        /*        bottom: 23%;*/
        /*    }*/
        /*}*/
    </style>
@stop

@section('body-data')
    x-data ='{
        brand: "drumeo",
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
            <h1 class="relative w-auto inline-block text-4xl sm:text-5xl lg:text-6xl">
                <strong>Musicians<br class="inline sm:hidden"> start here.</strong>
                <img class="w-72 lg:w-96 absolute -bottom-1 -right-6 px-7" src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/underline.png" alt="underline" fetchpriority="high">
            </h1>
            <h6 class="leading-relaxed mt-6 mb-7">Learn your favorite instruments with step-by-step lessons, thousands<br class="hidden sm:inline">
                of songs, and unlimited personal support.</h6>
            <a class="sm:mx-1 w-full sm:w-56 join {{ $theme }} smaller anchor-slide" href="#customize-anchor">START FOR FREE</a>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by 70,145 active students.</em></p>
            </div>
        </div>
        <img class="absolute z-10 h-12 sm:h-14 lg:h-16 transform -translate-x-1/2 -translate-y-1/2" style="top:53%;left: 4%;" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header4.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-20 sm:h-28 lg:h-44 transform -translate-x-1/2 -translate-y-1/2" style="top:21%;left: 10%;" src="https://www.musora.com/musora-cdn/image/width=350,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header5.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-24 sm:h-40 lg:h-52 transform -translate-x-1/2 -translate-y-1/2" style="top:81%;left: 18%;" src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header7.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-10 sm:h-12 lg:h-16 transform -translate-x-1/2 -translate-y-1/2" style="top:13%;left: 31%;" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header1.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-10 sm:h-12 lg:h-16 transform -translate-x-1/2 -translate-y-1/2" style="top:8%;left: 58%;" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header3.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-24 sm:h-32 lg:h-48 transform -translate-x-1/2 -translate-y-1/2" style="top:88%;left: 78%;" src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header8.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-24 sm:h-36 lg:h-52 transform -translate-x-1/2 -translate-y-1/2" style="top:18%;left: 87%;" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header6.png" alt="header circle image" fetchpriority="high">
        <img class="absolute z-10 h-12 sm:h-14 lg:h-16 transform -translate-x-1/2 -translate-y-1/2" style="top:63%;left: 99%;" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/header2.png" alt="header circle image" fetchpriority="high">
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="text-center sm:mb-10"><strong>The easier way to<br class="inline sm:hidden"> learn <u>any instrument</u>.</strong></h2>
            <img class="my-5 h-64 inline sm:hidden"
                src="https://www.musora.com/musora-cdn/image/width=300,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/intro-collage3.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center">
                <p class="leading-normal max-w-xl pr-7 mx-0">Learning an instrument can be frustrating. So we’ve made the most helpful music lessons on the planet –<br><br>Guided video lessons from great teachers, interactive exercises that transform practice into play, and <strong>thousands of popular songs</strong> for every style, era, and skill level. PLUS unlimited personal support from real teachers.<br><br>You’ll play more. You’ll fall in love with the process. And we’re so confident you’ll love your new skills that you’ll get a 7-day free trial PLUS a 90-day guarantee (just to make sure!).</p>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/intro-collage3.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-20" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>


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


    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <div id="method" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Where musical dreams <br class="inline sm:hidden"> <u>come true.</u> </strong></h2>
            <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">Always know <em>exactly</em> what to practice with a step-by-step curriculum for each  <br class="hidden sm:inline">instrument plus exclusive courses on any topic you’d ever want to learn!</p>
            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6">
                @foreach ($gridItems as $key => $gridItem)
                    <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0 max-w-xs">
                        <picture class="w-1/3 sm:w-full">
                            <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/{{ $gridItem['image'] }}">
                            <img
                                class=" rounded-xl mb-3 transition-opacity opacity-0"
                                src="https://www.musora.com/musora-cdn/image/width=200,quality=85/{{ $gridItem['image'] }}"
                                alt="grid{{$key+1}}"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                            >
                        </picture>
                        <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                            <strong class="font-black inline-block mb-0.5">{{ $gridItem['title'] }}</strong><br> {{ $gridItem['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
            @if(empty($promoVersion))
                <a href="/method" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline text-{{ $theme }} border-{{ $theme }} smaller">EXPLORE THE METHOD <i class="fas fa-info-circle"></i> </a>
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
        $buttons = [
            'Piano', 'Guitar', 'Drums', 'Singing'
        ];

        $courses = [
            [
                'title' => 'Piano',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/classical-piano.jpg',
                    'title' => 'Classical Piano',
                    'instructor' => 'Victoria Theodore',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/improvisational-jazz.jpg',
                    'title' => 'Improvisational Jazz',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/beautifully-simple-piano-arpeggios.jpg',
                    'title' => 'Simple Piano Arpeggios',
                    'instructor' => 'Sangah Noona',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/the-perfect-arrangement.jpg',
                    'title' => 'The Perfect Arrangement',
                    'instructor' => 'Summer Swee-Singh',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/creative-song-writing.jpg',
                    'title' => 'Creative Songwriting',
                    'instructor' => 'Josh Dion',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/rhythmic-playing.jpg',
                    'title' => 'Rhythmic Playing',
                    'instructor' => 'Jay Oliver',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/gospel-piano.jpg',
                    'title' => 'Gospel Piano',
                    'instructor' => 'Erskine Hawkins',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/latin-essentials.jpg',
                    'title' => 'Latin Essentials',
                    'instructor' => 'Kevin Castro',
                    ],
                ]
            ],
            [
                'title' => 'Guitar',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/solo-in-an-hour.jpg',
                    'title' => 'Solo In An Hour',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/songwriting-cheat-codes.jpg',
                    'title' => 'Songwriting Cheat Codes',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/rhythm-groove.jpg',
                    'title' => 'Rhythm & Groove',
                    'instructor' => 'Sami Ghawi',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/shred-guitar.jpg',
                    'title' => 'Shred Guitar',
                    'instructor' => 'Dean Lamb',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/unlock-your-creativity.jpg',
                    'title' => 'Unlock Your Creativity',
                    'instructor' => 'Yvette Young',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/musical-lanes.jpg',
                    'title' => 'Musical Lanes',
                    'instructor' => 'Mark Lettieri',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/add-power-to-your-playing.jpg',
                    'title' => 'Add Power To Your Playing',
                    'instructor' => 'Dave Weiner',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/the-anatomy-of-a-song.jpg',
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
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Hannah-Welton.jpg',
                    'title' => 'Writing Drum Parts',
                    'instructor' => 'Hannah Welton',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Todd-Sucherman.jpg',
                    'title' => 'Rock Drumming',
                    'instructor' => 'Todd Sucherman',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Matt-McGuire.jpg',
                    'title' => 'Song Breakdowns',
                    'instructor' => 'Matt McGuire',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Dorothe-Taylor-01.jpg',
                    'title' => 'Rudiments & Patterns',
                    'instructor' => 'Dorothea Taylor',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Aric-Improta.jpg',
                    'title' => 'The Creative Mindset',
                    'instructor' => 'Aric Improta',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Kaz-Rodgriguez.jpg',
                    'title' => 'Musical Exercises',
                    'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/Sarah-Thawer.jpg',
                    'title' => '4-Way Coordination',
                    'instructor' => 'Sarah Thawer',
                    ]
                ]
            ],
            [
                'title' => 'Singing',
                'images' => [
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/find-your-true-voice.jpg',
                    'title' => 'Find Your True Voice',
                    'instructor' => 'Sheléa',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/The-power-of-movement.jpg',
                    'title' => 'The Power of Movement',
                    'instructor' => 'Chris Johnson',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/singing-with-soul.jpg',
                    'title' => 'Singing With Soul',
                    'instructor' => 'Tony Lindsay',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/define-your-singing.jpg',
                    'title' => 'Define Your Singing',
                    'instructor' => 'Cate Canning',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/the-science-of-singing-better.jpg',
                    'title' => 'The Science of Singing Better',
                    'instructor' => 'Darcy D',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/songwriting-for-singers.jpg',
                    'title' => 'Songwriting For Singers',
                    'instructor' => 'Hailey Benedict',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/hit-the-high-notes.jpg',
                    'title' => 'Hit The High Notes',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/coaches/beautiful-harmonies.jpg',
                    'title' => 'Beautiful Harmonies',
                    'instructor' => 'Julia Ziegler',
                    ],
                ]
            ],
        ];
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden"><u>best musicians.</u>',
        'split' => true
    ])

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-10 sm:h-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/just-press-play-title2.png" alt="collage intro mobile" loading="lazy" onload="this.classList.remove('opacity-0')">
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
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9">
                                <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="workout {{ $key+1 }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                            </div>
                            <div class="dot hidden sm:block absolute bg-white top-0 rounded-full z-10 transform -translate-x-1/2 -translate-y-1/2" style="width: 20px;height:20px"></div>
                        </div>
                    @else
                        <div class="relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if($key !== 2) mb-16 md:mb-28 @endif">
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9">
                                <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="workout {{ $key+1 }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                            </div>
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
                onload="this.classList.remove('opacity-0')" src="https://www.musora.com/musora-cdn/image/width=190,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/guarantee-musora-line.png" alt="bonus icon">
                <h5><strong><i class="fas fa-star text-musora-gold"></i> BETTER PRACTICE GUARANTEE <i class="fas fa-star text-musora-gold"></i></strong></h5>
                <p class="max-w-sm mx-auto leading-normal mt-3">You’ll get 7 days free PLUS a 90-day guarantee<br> to make sure you love your improvements!</p>
            </div>
            <a class="sm:mx-1 w-full sm:w-64 join white smaller @if(!empty($promoVersion)) anchor-slide @endif"
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
        $songItems = [
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/popular-song-icon.svg',
                'fa-icon' => 'fa-user-music',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/isolate-icon.svg',
                'fa-icon' => 'fa-sliders-up',
                'title' => 'Ditch the distractions',
                'desc' => 'Isolate the piano, guitar, or drums so you always know exactly what to play.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/loop-icon.svg',
                'fa-icon' => 'fa-arrows-repeat',
                'title' => 'Simplify the tricky parts',
                'desc' => 'Learn songs faster with perfect notation, practice loops, and tempo control.',
            ],
            [
                'icon' => 'https://dmmior4id2ysr.cloudfront.net/homepage/2023/metronome-icon.svg',
                'fa-icon' => 'fa-timer',
                'title' => 'Improve your timing',
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
    <div id="songs" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <h2><strong>Play <u>1000+</u> popular songs.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3">You’ll have <strong>all the tools you need</strong> to play the songs you love.</p>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'drumeo'">
                <div style="padding-bottom:62.4%;" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="drumeoSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png" alt="drumeo player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'pianote'">
                <div style="padding-bottom:62.4%;" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="pianoteSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/pianote-player.png" alt="pianote player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'guitareo'">
                <div style="padding-bottom:62.4%" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="guitareoSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/guitareo-player.png" alt="guitareo player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto" x-show="brand === 'singeo'">
                <div style="padding-bottom:62.4%" class="my-4 sm:my-6 lg:my-6 relative" x-on:click="singeoSoundslice = true;" >
                    <img class="absolute inset-0 transition-all opacity-0 cursor-pointer" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/singeo-player.png" alt="singeo player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto  hidden">
                <div style="padding-bottom:62.4%;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png)" class="mt-4 sm:mt-6 lg:my-6 bg-cover bg-center" x-on:click="soundslice = true;" ></div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto hidden">
                <div style="padding-bottom:62.4%;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png)" class="mt-4 sm:mt-6 lg:my-6 bg-cover bg-center" x-on:click="soundslice = true;" ></div>
            </div>
            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto  hidden">
                <div style="padding-bottom:62.4%;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png)" class="mt-4 sm:mt-6 lg:my-6 bg-cover bg-center" x-on:click="soundslice = true;" ></div>
            </div>
            <div class="">
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-drumeo border text-xl"
                    :class="brand === 'drumeo' ? 'text-white bg-drumeo' : 'text-drumeo'"
                    @click="brand = 'drumeo'"
                >
                    <i class="fa-regular fa-drum"></i>
                </div>
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-pianote border text-xl"
                    :class="brand === 'pianote' ? 'text-white bg-pianote' : 'text-pianote'"
                    @click="brand = 'pianote'"
                >
                    <i class="fa-regular fa-piano-keyboard"></i>
                </div>
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-guitareo border text-xl"
                    :class="brand === 'guitareo' ? 'text-white bg-guitareo' : 'text-guitareo'"
                    @click="brand = 'guitareo'"
                >
                    <i class="fa-light fa-guitar"></i>
                </div>
                <div
                    class="inline-block border-2 rounded-full py-1 px-5 sm:px-10 mx-1 sm:mx-2 mb-2 cursor-pointer border-singeo border text-xl"
                    :class="brand === 'singeo' ? 'text-white bg-singeo' : 'text-singeo'"
                    @click="brand = 'singeo'"
                >
                    <i class="fa-light fa-microphone-stand"></i>
                </div>
            </div>
            <div class="text-center w-full sm:w-auto mt-6 lg:mt-10 mx-auto">
                <div class="flex flex-wrap">
                    @foreach ($songItems as $songItem)
                        <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                            <div class="flex sm:inline-block">
                                <div class="w-14 sm:w-full flex-shrink-0">
                                    <i class="fad {!! $songItem['fa-icon'] !!} text-5xl text-musora-gold"></i>
{{--                                    <img alt="point icon" src="https://www.musora.com/musora-cdn/image/{{ $songItem['icon'] }}" class="h-6 sm:h-10">--}}
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
        "plusLogo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_plus_logo.png",
        "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
        "songs" => "5000",
        "firstPoint" => "Piano, Guitar, Drums, Singing.",
        "thirdPoint" => "Unlimited personal support",
        "plusAnnualLink" => "/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true",
        "plusMonthlyLink" => "/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true",
        "annualLink" => "/ecommerce/add-to-cart?products[drumeo-base-annual-recurring-7-day-trial-membership]=1&locked=true",
        "monthlyLink" => "/ecommerce/add-to-cart?products[drumeo-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
    ])

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
