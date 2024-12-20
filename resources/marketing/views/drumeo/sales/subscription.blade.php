@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
@endphp

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
{{--        <meta property="twitter:image" content="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2024/twitter-image.webp">--}}
{{--        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/share-image-drumeo.webp">--}}

        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/home-shop-share-image.jpg">
    @endif

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
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
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }
        @media (min-width: 768px) {
            .ajax-form input, .ajax-form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
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
        soundslice : false,
        waitlist: false,
        trailer : false,
        lazyLoad: false,
        videoLoaded: false,
        @foreach($bonuses as $bonus)
            @if(!empty($bonus['vimeoId']))
                modal{{ $bonus['vimeoId'] }}: false,
            @endif
        @endforeach
    }'
@endsection

@section('global-body')
    @if(!empty($shopNav))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "cartVersion" => true
        ])
    @elseif(!empty($promoVersion))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
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

    @hasSection('top-bar')
        @yield('top-bar')
    @endif

    @if(empty($hideHeader) || !$hideHeader)
    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'Learn beginner beats, fills<br> and songs on the drums.',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
            'featured' => [
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
            ],
        ])
    @elseif(!empty($promoPage))
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'featured' => [
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
            ],
        ])
    @elseif(!empty($keyPage))
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'Unlimited<br> drum lessons +<br>  a <span class="relative inline-block">free drum key<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'featured' => [
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
            ],
        ])
    @else
        @include('musora.sales.components.header-section', [
            'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
            'featured' => [
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
                'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
            ],
        ])
    @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif


    <section class="text-center relative text-white py-12 min-h-[500px] h-screen-nav max-h-[1100px]"
        style="background-color:#0c1524;"
        x-data="{ stick: false }"
        x-init="window.addEventListener('scroll', () => {
        stick = window.scrollY + window.innerHeight > $refs.stickySection.offsetTop + $refs.stickySection.offsetHeight;
    })">
        <picture class="fixed inset-0 -z-10">
            <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/course-wall.webp">
            <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/course-wall-m.webp">
            <img
                class="w-full h-full object-cover object-bottom"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/course-wall-m.webp"
            />
        </picture>
        <div class="w-auto inline-block py-3 sm:py-4 px-4 sm:px-6 z-10 sticky top-[40vh]"
            :class="{ 'bottom-auto': stick }" x-ref="stickySection">
            <h1 style="text-shadow:0 0 20px rgba(0, 0, 0, 0.5);" class="font-lexend text-3xl sm:text-5xl lg:text-7xl leading-none uppercase mb-3"><strong>STEP-BY-STEP</strong></h1>
            <h1 style="text-shadow:0 0 20px rgba(0, 0, 0, 0.5);" class="font-lexend leading-none uppercase mb-3">to any goal.</h1>
        </div>
        <div class="h-full">
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 pb-12 sm:pb-16 lg:pb-20 relative overflow-hidden text-white"
        style="background: linear-gradient(to bottom, transparent 50%, #0C1524);"
    >
        <div class="container max-w-5xl mx-auto relative z-20">
            <div class="text-black bg-white rounded-xl px-4 sm:px-6 py-8 sm:py-12 mb-8">
                <h5 class="uppercase text-drumeo">Step 1</h5>
                <h2 class="leading-tight my-2"><strong>Choose Your Goal</strong></h2>
                <p class="leading-tight mb-8">You’ll enjoy guided courses from the world’s best drummers. Take a peek at a few favorites:</p>
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
                                    @php
                                        $packs = [
                                            [
                                                "image" => "marketing/drumeo/membership/homepage/2025/courses-01.webp",
                                            ],
                                            [
                                                "image" => "marketing/drumeo/membership/homepage/2025/courses-02.webp",
                                            ],
                                            [
                                                "image" => "marketing/drumeo/membership/homepage/2025/courses-03.webp",
                                            ],
                                            [
                                                "image" => "marketing/drumeo/membership/homepage/2025/courses-04.webp",
                                            ],
                                            [
                                                "image" => "marketing/drumeo/membership/homepage/2025/courses-05.webp",
                                            ],
                                        ]
                                    @endphp
                                    @foreach ($packs as $image)
                                        <li class="splide__slide flex flex-col items-center justify-start px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 161%;">
                                                <picture>
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/{{$image['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}"
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

            <div class="text-white pt-6 sm:pt-10 mb-8 rounded-xl overflow-hidden bg-cover bg-center" style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/pov-bg.webp');">
                <h5 class="uppercase text-drumeo">Step 2</h5>
                <h2 class="leading-tight my-2"><strong>Press Play</strong></h2>
                <p class="leading-normal mb-8 px-4">We’ve tailored each course to keep you motivated – so you<br class="hidden sm:inline-block"> keep returning to the kit & experience amazing results!</p>

                <div class="relative cursor-pointer autoplay-video" x-on:click="demoVid = true;">
                    <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/pov-m2.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/pov2.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>

            <div class="text-black bg-white rounded-xl pl-4 lg:px-10 pt-8 sm:pt-12">
                <h5 class="uppercase text-drumeo">Step 3</h5>
                <h2 class="leading-tight my-2"><strong>Hear the result.</strong></h2>
                <p class="leading-tight mb-8 px-4 sm:px-0">If you love your lessons, you’re more likely to practice. And when you practice, <br class="hidden sm:inline-block"> you’ll hear the results way sooner – and so will everyone around you!</p>
                <picture>
                    <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1900x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/tablet3.webp">
                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/tablet3.webp">
                    <img
                        class="w-full -mb-6"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/membership/homepage/2025/tablet-m3.webp"
                        onload="this.classList.remove('opacity-0');"
                    />
                </picture>
            </div>
        </div>
    </section>

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/898668674/rendition/540p/file.mp4?loc=external&signature=d5f33375d3a16dc91641be1539d7d621d07ad049b030baa8a7f32c23e63e3ab4',
        'workoutsBG' => 'marketing/drumeo/membership/homepage/2024/workouts-card3.webp',
    ])

    @php
        $gridItems = $drumeo['gridItems'];
    @endphp
    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum featuring many of the world’s best teachers. ',
        'full' => true,
    ])

    @php
        $testimonials = $drumeo['testimonials'];
        $youtube = convertNumber(Prices::$drumeoYoutubeSubsc);
        $facebook = convertNumber(Prices::$drumeoFacebookLikes);
        $instagram = convertNumber(Prices::$drumeoInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'drummers',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
    ])

    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
            'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
        ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @hasSection('final')
        @yield('final')
    @elseif(!empty($trialVersion))
        @include('musora.sales.components.order-section-collage', [
        'orderUrl' => '/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true',
        'logo' => 'marketing/drumeo/membership/homepage/2025/logo.webp',
        'header' => 'Unlimited drum lessons.<br>Guided practice sessions. <br> The world’s best teachers.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2025/collage.webp',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'drumming',
        ])

    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'imageFull' => true,
                    'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Drumeo/Thumbnails/bafe2908-b615-4892-a621-d246828f8cb4-30day-chops-cart.jpg',
                    'title' => '30-Day Chops',
                    'description' => 'Boost your creativity in just 30 days',
                    'price' => floatval($productPrices['30-day-chops']->price),
                ],
                [
                    'imageFull' => true,
                    'image' => 'https://www.musora.com/musora-cdn/image/width=520,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Drumeo/Thumbnails/57b58267-17bd-475a-89f7-874185438a7b-30DDs4_cart.jpg',
                    'title' => '30-Day Drummer',
                    'description' => 'Learn the drums with daily guided workouts.',
                    'price' => floatval($productPrices['30-day-drummer-4']->price),
                ],
            ];
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp',
        'header' => 'Online drum lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $603.95',
        'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-drummer-4]=1&locked=true&promo-code=special,WBD24',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/drumeo/membership/homepage/2025/logo.webp',
        'header' => '<strong>Unlimited drum lessons.<br>Guided practice sessions. <br> The world’s best teachers.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2025/collage.webp',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/drumeo/membership/homepage/2025/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('drumeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '23rlc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '898623255',
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
