@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp

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
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/share-image-pianote2.webp ">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
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
        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }
    </style>
    <style>

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        .ajax-form ::-webkit-input-placeholder, .ajax-form ::-moz-placeholder, .ajax-form :-ms-input-placeholder, .ajax-form :-moz-placeholder {
            color:#777
        }

        .ajax-form {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        /*@media (min-width: 768px) {*/
        /*    .ajax-form {*/
        /*        margin: 0 auto 10px;*/
        /*    }*/
        /*}*/

        .ajax-form input, .ajax-form button {
            font: 400 18px/40px 'Open Sans', sans-serif;
            height: 40px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 2px 20px;
            margin: 0 auto 5px;
        }
        /*.ajax-form input, .ajax-form button {*/
        /*    font: 400 18px/50px 'Open Sans', sans-serif;*/
        /*    height: 50px;*/
        /*    color: #999;*/
        /*    border-radius: 100px;*/
        /*    text-align: left;*/
        /*    padding: 7px 20px;*/
        /*    margin: 0 auto 15px;*/
        /*}*/
        /*@media (min-width: 768px) {*/
        /*    .ajax-form input, .ajax-form button {*/
        /*        font-size: 22px;*/
        /*        height: 65px;*/
        /*        line-height: 65px;*/
        /*    }*/
        /*}*/
        .ajax-form input[type="submit"],
        .ajax-form button[type="submit"],
        .ajax-form input button,
        .ajax-form button button {
            font-family: 'Bebas Neue', sans-serif;
            color: #fff;
            background: #0b76db;
            text-transform: uppercase;
            /*margin: 0 auto 15px;*/
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        .ajax-form input[type="submit"]:hover, .ajax-form button[type="submit"]:hover, .ajax-form input button:hover, .ajax-form button button:hover {
            background: #258ff4;
        }
        .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }

        .thank-you-box {
            width:100%;
            max-width:960px;
            border-radius:5px;
            height:auto;
            max-height:0;
            visibility:hidden;
            opacity:0;
            transition:all .4s ease-in;
            display:block;
            margin:0 auto;
            background:#FFF;
            text-align:center;
            overflow:hidden;
            color:#000
        }

        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px
        }

        @media (min-width:40em) {
            .thank-you-box.active {
                padding:20px
            }
        }

        @media (min-width:64em) {
            .thank-you-box.active {
                padding:30px
            }
        }

        .thank-you-box p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto
        }

        @media (min-width:40em) {
            .thank-you-box p {
                font-size:19px
            }
        }

        @media (min-width:64em) {
            .thank-you-box p {
                font-size:23px
            }
        }

        .thank-you-box p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px
        }

        @media (min-width:40em) {
            .thank-you-box p em {
                font-size:14px
            }
        }

        .thank-you-box h2 {
            font:700 30px/1em "Bebas Neue", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db
        }

        @media (min-width:40em) {
            .thank-you-box h2 {
                font-size:37px;
                margin:20px auto
            }
        }

        @media (min-width:64em) {
            .thank-you-box h2 {
                font-size:44px
            }
        }

        .thank-you-box .social-media a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 3px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px
        }

        @media (min-width:64em) {
            .thank-you-box .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0
            }
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        demoVid : false,
        soundslice : false,
        workoutVid : false,
        trailer : false,
        unbox : false,
        rolandTrailer : false,
        lazyLoad: false,
        videoLoaded: false,
        @foreach($pianote['packs'] as $modalData)
        {{ $modalData['name'] }}: false,
        @endforeach
    }'
@endsection

@section('global-body')
    @if(!empty($shopNav))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "cartVersion" => true
        ])
    @elseif(!empty($promoVersion))
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

    @hasSection('top-bar')
        @yield('top-bar')
    @endif

    @if(empty($hideHeader) || !$hideHeader)
        @if(!empty($beginnerVersion))
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'Online piano lessons<br> tailored for beginners.',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => 'POPULAR SONGS',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])
        @elseif(!empty($songsVersion))
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'Learn piano from real teachers.<br> Play your favorite songs.',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => 'POPULAR SONGS',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])

        @elseif(!empty($promoPage))
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'THE <span class="text-pianote">NEW WAY</span> TO<br> <span class="relative inline-block">LEARN PIANO<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])
        @else
            @include('musora.sales.components.header-section', [
                'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/header.mp4',
                'header' => 'Piano lessons for<br> <span class="relative inline-block">all skill levels<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
                'pointOne' => 'GREAT TEACHERS',
                'pointTwo' => 'VIDEO LESSONS',
                'pointThree' => 'FUN PRACTICE',
                'pointFour' => 'POPULAR SONGS',
                'featured' => [
                    [
                        'url' => 'https://www.musicradar.com/reviews/pianote-review',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/musicradar.svg',
                    ],
                    [
                        'url' => 'https://www.nytimes.com/2023/12/07/arts/music/colette-maze-dead.html',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/nyt.svg',
                    ],
                    [
                        'url' => 'https://www.pianistmagazine.com/blogs/a-closer-look-at-pianote/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/pianist.svg',
                    ],
                    [
                        'url' => 'https://americansongwriter.com/best-online-piano-lessons/',
                        'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/membership/homepage/2025/as.webp',
                    ],
                ],
            ])
        @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    <section class="text-center relative text-white py-12 min-h-[500px] h-screen-nav max-h-[1100px]"
        x-data="{ stick: false }"
        x-init="window.addEventListener('scroll', () => {
        stick = window.scrollY + window.innerHeight > $refs.stickySection.offsetTop + $refs.stickySection.offsetHeight;
    })">
        <picture class="fixed inset-0 -z-10">
            <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/course-wall.webp">
            <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/course-wall-m.webp">
            <img
                class="w-full h-full object-cover object-bottom"
                style="background-color:#0C1524;"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/course-wall-m.webp"
            />
        </picture>
        <div class="w-auto inline-block py-3 sm:py-4 px-4 sm:px-6 z-10 sticky top-[40vh]"
            :class="{ 'bottom-auto': stick }" x-ref="stickySection">
            <h1 style="text-shadow:0 0 20px rgba(0, 0, 0, 0.5);" class="font-lexend text-4xl sm:text-6xl lg:text-7xl leading-none uppercase mb-1 sm:mb-3"><strong>STEP-BY-STEP</strong></h1>
            <h1 style="text-shadow:0 0 20px rgba(0, 0, 0, 0.5);" class="font-lexend leading-none uppercase mb-3">to any goal</h1>
        </div>
        <div class="h-full">
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 pb-12 sm:pb-16 lg:pb-20 relative overflow-hidden text-white"
        style="background: linear-gradient(to bottom, transparent 50%, #0C1524);"
    >
        <div class="container max-w-5xl mx-auto relative z-20">
            <div class="text-black bg-white rounded-xl px-4 sm:px-6 py-8 sm:py-12 mb-8">
                <h5 class="uppercase text-pianote">Step 1</h5>
                <h2 class="leading-tight my-2"><strong>Choose Your Goal</strong></h2>
                <p class="leading-tight mb-8">
                    Chords. Technique. Blues. Or just getting started the right way.<br class="hidden sm:inline">
                    Choose the lessons that are right for you. Here are a few favorites:</p>
                <div
                    x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    classes: {
                                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                            prev: 'splide__arrow--prev your-class-prev -left-1',
                                            next: 'splide__arrow--next your-class-next -right-1',
                                            pagination: 'splide__pagination flex -bottom-10',
                                    },
                                    padding: '0rem',
                                    arrows: false,
                                    pagination: false,
                                    perPage: 5,
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    breakpoints: {
                                        768: {
                                            padding: '3rem',
                                            perPage: 3,
                                            perMove: 1,
                                            pagination: true,
                                            arrows: true,
                                            type: 'loop',
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                            perPage: 1,
                                        },
                                    },
                                }).mount()
                            },
                        }"
                >
                    <section x-ref="splide" class="splide mb-10 lg:mb-0">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($pianote['packs'] as $tile)
                                    <li class="splide__slide flex flex-col items-center justify-start px-1">
                                        <div class="relative w-full rounded-xl overflow-hidden"
                                            @if(!empty($tile['vimeoId'])) @click="{{ $tile['name'] }} = true" @endif>
                                            <picture>
                                                <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/{{$tile['image']}}">
                                                <img
                                                    class="w-full transition-opacity opacity-0 duration-300"
                                                    data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$tile['image']}}"
                                                    onload="this.classList.remove('opacity-0');"
                                                />
                                            </picture>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                </div>
            </div>

            <div class="text-white pt-6 sm:pt-10 mb-8 rounded-xl overflow-hidden bg-cover bg-center"
                style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/pov-bg2.jpg');">
                <h5 class="uppercase text-pianote">Step 2</h5>
                <h2 class="leading-tight my-2"><strong>Press Play</strong></h2>
                <p class="leading-normal mb-8 px-4">
                    It’s easy. Simply choose your course, press play, and play along with your instructor.<br class="hidden sm:inline-block">
                    It’s the best way to stay motivated, keep coming back to the keys, and get amazing results.</p>

                <div class="relative cursor-pointer autoplay-video" x-on:click="demoVid = true;">
                    <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/pov-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/pov.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>

            <div class="text-black bg-white rounded-xl pl-4 lg:px-10 pt-8 sm:pt-12">
                <h5 class="uppercase text-pianote">Step 3</h5>
                <h2 class="leading-tight my-2"><strong>Hear the result.</strong></h2>
                <p class="leading-tight mb-8 px-4 sm:px-0">The most important part of learning piano is building a daily habit. Practice a little<br class="hidden sm:inline-block">
                    each day, and you’ll hear the results way sooner (and so will everyone around you!).</p>
                <picture>
                    <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1900x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/tablet.webp">
                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/tablet.webp">
                    <img
                        class="w-full -mb-6"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/membership/homepage/2025/tablet-m.webp"
                        onload="this.classList.remove('opacity-0');"
                    />
                </picture>
            </div>
        </div>
    </section>

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e',
        'workoutsBG' => 'marketing/pianote/membership/homepage/2024/workouts-card3.webp',
    ])

    @php
        $gridItems = $pianote['gridItems'];
    @endphp
    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum and direct access to real teachers. ',
        'full' => true,
    ])

    @php
        $testimonials = $pianote['testimonials'];
        $youtube = convertNumber(Prices::$pianoteYoutubeSubsc);
        $facebook = convertNumber(Prices::$pianoteFacebookLikes);
        $instagram = convertNumber(Prices::$pianoteInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'pianists',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
    ])

    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
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
        @include('musora.sales.components.order-section-collage', [
            "orderUrl" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true",
        'logo' => 'marketing/pianote/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited piano lessons.<br>The world’s best teachers.  <br> 500+ popular songs.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/pianote/membership/homepage/2025/collage.webp',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])

    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'imageFull' => true,
                    'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Pianote/Thumbnails/95dc0c77-a0a5-4f01-b743-cb01d4912042-easy-chords-cart.jpg',
                    'title' => 'Easy Chords',
                    'description' => 'Chords are the foundation of all music. But they can be tricky to understand, let alone practice. Easy Chords solves that problem. Over 30 days, you’ll play with a teacher and unlock the beauty and power of piano chord progressions. You’ll be able to play hundreds of songs after taking this course. And best of all? It only takes 10 minutes a day.',
                    'price' => floatval($productPrices['easy-chords']->price),
                ],
                [
                    'imageFull' => true,
                    'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Pianote/Thumbnails/d444aa7c-3c5f-4a3e-8d8b-36a98ac99da4-30DBluesPiano_cart.jpg',
                    'title' => '30-Day Blues',
                    'description' => 'Learn the Blues in just 30 days',
                    'price' => floatval($productPrices['30-day-blues-piano']->price),
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp',
        'header' => 'Online piano lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $357',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&redirect=/order&locked=true&promo-code=special,WBP24',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/pianote/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited piano lessons.<br>The world’s best teachers.  <br> 500+ popular songs.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/pianote/membership/homepage/2025/collage.webp',
        ])

    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/pianote/membership/homepage/2025/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '4JGlc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'workoutVid',
        'video' => '886960702',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'demoVid',
        'video' => '802011057',
        'vimeo' => true,
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
    @foreach ($pianote['packs'] as $packModal)
        @include('_partials.components.video-modal', [
            'name' => $packModal['name'],
            'video' => $packModal['vimeoId'],
            'vimeo' => true,
        ])
    @endforeach

    @if(!empty($promoVersion))
        @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("pianote.sales.partials._footer")
    @endif

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            if (!stickyBar) return;

            window.addEventListener('scroll', function () {
                var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
                var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
                if (window.scrollY > (unstickTrigger - 115)) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < stickTrigger - 115) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                    stickyBar.classList.add('fixed', 'mt-0');
                }
            });
        });
    </script>
@stop
