@php
    require_once(resource_path('marketing/views/musora/_partials/homepage-data.php'));
@endphp

@extends('musora._partials.layout', [
    'whiteNav' => true,
])

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">

    <style>
        html {
            scroll-behavior: smooth;
        }
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
        .join.musora {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora:hover {
            background:#FFAE00;
            color:#000;
        }
        .join.drumeo {
            background:#0b76db;
        }
        .join.drumeo:hover {
            background:#0c84f5;
        }
        .join.pianote {
            background:#F61A30;
        }
        .join.pianote:hover {
            background:#ff3347;
        }
        .join.guitareo {
            background:#00C9AC;
        }
        .join.guitareo:hover {
            background:#00e3c1;
        }
        .join.singeo {
            background:#8300E9;
        }
        .join.singeo:hover {
            background:#9000ff;
        }
        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }

        .timed-toggle .media-toggle.active {
            display:block!important;
        }
        .timed-toggle .active-toggle.active {
            border-color: #FFAE00!important;
            background-color:#151f31!important;
        }
        .timed-toggle .active-toggle.active .description {
            max-height:100px!important;
        }

        @-webkit-keyframes breathing {
            0% {
                opacity: 0.4;
            }
            40% {
                opacity: 1;
            }
            60% {
                opacity: 1;
            }
            100% {
                opacity: 0.4;
            }
        }

        @keyframes breathing {
            0% {
                opacity: 0.4;
            }
            40% {
                opacity: 1;
            }
            60% {
                opacity: 1;
            }
            100% {
                opacity: 0.4;
            }
        }
        @keyframes move {
            0% {
                top: 0;
            }
            19% {
                top: 0;
            }
            20% {
                top: -100px;
            }
            39% {
                top: -100px;
            }
            40% {
                top: -200px;
            }
            59% {
                top: -200px;
            }
            60% {
                top: -300px;
            }
            79% {
                top: -300px;
            }
            80% {
                top: -400px;
            }
            99% {
                top: -400px;
            }
            100% {
                top: 0;
            }
        }


        .rotater-text span {
            animation: move 25s infinite;
            background: -webkit-linear-gradient(20deg, #980353, #003285, #00B59F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sedgwick+Ave&display=swap" rel="stylesheet">
@stop

@section('body-data')
    x-data ='{
        brand: "pianote",
        drumeoSoundslice: false,
        pianoteSoundslice: false,
        guitareoSoundslice: false,
        singeoSoundslice: false,
        trailer: false,
        lazyLoad: false,
        videoLoaded: false,
    }'
@endsection

@section('layout-body')

    @php
        $bubbles =  [
             [
                 'src' => $bubble1,
                 'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
             ],
             [
                 'src' => $bubble2,
                 'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
             ],
             [
                 'src' => $bubble3,
                 'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
             ],
             [
                 'src' => $bubble4,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
             ],
             [
                 'src' => $bubble5,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
             ],
             [
                 'src' => $bubble6,
                 'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
             ],
             [
                 'src' => $bubble7,
                 'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
             ],
             [
                 'src' => $bubble8,
                 'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
             ]
         ];
    @endphp
    <header class="text-center px-3 py-10 sm:py-16 lg:py-20 relative overflow-hidden" style="background:linear-gradient(to bottom, #fff, #F1EFED);">
        <div class="container max-w-6xl mx-auto relative z-20">

            @yield('spotify-banner')

            <h5 class="leading-tight uppercase">MUSIC STUDENTS <br class="sm:hidden"><strong>PREFER LEARNING HERE</strong></h5>
            <h1 class="overflow-hidden leading-tight text-[35px] sm:text-5xl sm:leading-[76px] rotater-text my-1 sm:my-0" style="height: 100px;font-family: 'Sedgwick Ave', sans-serif!important; ">
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"Like my very own<br class="sm:hidden"> music coach!"</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"So positive and<br class="sm:hidden"> uplifting!"</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"Convenient and<br class="sm:hidden"> affordable."</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"Try it once and<br class="sm:hidden"> you’ll see."</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"The best teaching<br class="sm:hidden"> tool ever."</span><br>
            </h1>
            <div class="grid grid-cols-4 gap-1 sm:gap-3 mb-5 lg:mb-7 text-center sm:text-left">
                <div class="relative w-full aspect-1:1">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/560x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-drumeo-part.webp">
                        <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/360x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-drumeo-part.webp">
                        <img x-ref="image"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-drumeo-part.webp"
                            alt="tile"
                            class="w-full h-full object-contain object-bottom rounded-xl absolute inset-0 opacity-0 transition-opacity"
                            onload="this.classList.remove('opacity-0')">
                    </picture>
                    <h6 class="uppercase text-white absolute bottom-0 w-full py-2 sm:py-4 sm:px-4 lg:px-6"><strong>DRUMS</strong></h6>
                </div>
                <div class="relative w-full aspect-1:1">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/560x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-pianote-part.webp">
                        <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/360x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-pianote-part.webp">
                        <img x-ref="image"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-pianote-part.webp"
                            alt="tile"
                            class="w-full h-full object-contain object-bottom rounded-xl absolute inset-0 opacity-0 transition-opacity"
                            onload="this.classList.remove('opacity-0')">
                    </picture>
                    <h6 class="uppercase text-white absolute bottom-0 w-full py-2 sm:py-4 sm:px-4 lg:px-6"><strong>PIANO</strong></h6>
                </div>
                <div class="relative w-full aspect-1:1">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/560x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-guitareo-part.webp">
                        <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/360x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-guitareo-part.webp">
                        <img x-ref="image"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-guitareo-part.webp"
                            alt="tile"
                            class="w-full h-full object-contain object-bottom rounded-xl absolute inset-0 opacity-0 transition-opacity"
                            onload="this.classList.remove('opacity-0')">
                    </picture>
                    <h6 class="uppercase text-white absolute bottom-0 w-full py-2 sm:py-4 sm:px-4 lg:px-6"><strong>GUITAR</strong></h6>
                </div>
                <div class="relative w-full aspect-1:1">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/560x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-singeo-part.webp">
                        <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/360x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-singeo-part.webp">
                        <img x-ref="image"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header-singeo-part.webp"
                            alt="tile"
                            class="w-full h-full object-contain object-bottom rounded-xl absolute inset-0 opacity-0 transition-opacity"
                            onload="this.classList.remove('opacity-0')">
                    </picture>
                    <h6 class="uppercase text-white absolute bottom-0 w-full py-2 sm:py-4 sm:px-4 lg:px-6"><strong>SINGING</strong></h6>
                </div>
            </div>
            @if(empty($boldText) && empty($noCheck))
                <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                    <i class="fas fa-check text-{{ $theme }}"></i> GREAT TEACHERS
                    <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> VIDEO LESSONS
                    <br class="lg:hidden">
                    <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> FUN PRACTICE
                    <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> 1000+ SONGS
                </p>
            @endif
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">
                <a class="sm:mx-0.5 w-full sm:w-56 join {{ $theme }} smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
                    @if(!empty($promoVersion))
                        href="#customize-anchor"
                    aria-label="Customize anchor"
                    @elseif(!empty($month))
                        href="/choose-your-trial-month"
                    aria-label="Choose your trial month"
                    @else
                        href="/choose-plan"
                    aria-label="Choose plan"
                    @endif
                >
                    @if(!empty($promoVersion) && empty($trialVersion))
                        @if(!empty($cta))
                            {!! $cta !!}
                        @else
                            SEE YOUR DEAL &raquo;
                        @endif
                    @elseif(!empty($month))
                        30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                    @else
                        7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                    @endif
                </a>
                <a class="sm:mx-0.5 w-full sm:w-56 join outline black smaller"
                    href="https://www.shopperapproved.com/reviews/Musora.com"
                    rel="noopener noreferrer"
                    aria-label="See the reviews on Shopper Approved"
                    onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;"
                >SEE THE REVIEWS</a>
            </div>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
    </header>
    @if(!empty($slides))
        <section class="sm:px-6 py-4 sm:py-5 text-white" style="background:#0c1524;">
            <div class="container max-w-5xl mx-auto">
                @component('_partials.components.carousel',[
                    'xdata' => "
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 header-slide-btn',
                            prev: 'splide__arrow--prev your-class-prev hidden sm:flex z-50',
                            next: 'splide__arrow--next your-class-next hidden sm:flex z-50',
                            pagination: 'hidden',
                        },
                        perPage: 1,
                        perMove: 1,
                        type: 'loop',
                        autoplay: true,
                        pauseOnHover: true,
                        pauseOnFocus: true,
                        interval: 3000,
                        lazyLoad: 'nearby',
                    ",
                ])
                    @slot('content')
                        @foreach ($slides as $slide)
                            <li class="splide__slide">
                                <div class="px-3 md:px-6 text-center">
                                    <p class="leading-normal text-sm"><em>“{{ $slide['desc'] }}”</em></p>
                                    <div class="flex flex-wrap md:flex-nowrap sm:text-left items-center justify-center mt-1.5">
                                        <img
                                            class="rounded-full object-contain object-bottom object-right w-9 h-9"
                                            data-splide-lazy={{ $slide['thumb'] }}
                                    alt="{{$slide['name']}}"
                                        ><br class="inline md:hidden">
                                        <p class="leading-tight w-full text-center md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-0.5 md:mt-0"><em>{{ $slide['name'] }}, {{ $slide['credit'] }}</em></p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
        </section>
    @endif


    @php
        $gridItems = $musora['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'seven' => true,
    ])

    @php
        $buttons = $musora['buttons'];

        $courses = $musora['courses'];
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden"><u>best teachers.</u>',
        'desc' => 'Amplify your skills with artist<br class="inline sm:hidden"> courses and live events.',
        'split' => true
    ])

    @php
        $workoutImages = $musora['workoutImages'];
    @endphp

    @include('musora.sales.components.workouts-section', [
        'workoutsBG' => 'marketing/musora/membership/homepage/2024/workouts-card.webp',
    ])


    @php
        $songItems = $musora['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/device.webp',
    ])

    @php
        $testimonials = $musora['testimonials'];
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Where musical<br class="hidden sm:inline"> dreams come true.',
    ])

    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'marketing/musora/membership/homepage/2024/guarantee.webp',
            'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
        ])
    @endif
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @hasSection('final')
        @yield('final')
    @elseif(!empty($hideMenu))
        @include('musora.sales.components.card-selection-section', [
            "whiteBg" => true,
            "plusLogo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_plus_logo.png",
            "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
            "songs" => "Thousands of popular songs.",
            "firstPoint" => "Learn piano, guitar, drums, & singing.",
            "thirdPoint" => "Unlimited personal support",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[musora-annual-recurring-7-day-trial-membership]=1&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[musora-monthly-recurring-7-day-trial-membership]=1&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[musora-base-annual-recurring-7-day-trial-membership]=1&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[musora-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'musical',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'marketing/musora/membership/homepage/webp-format/musora_logo.webp',
        'header' => 'Unlimited music lessons.<br> The world’s best teachers.<br> Thousands of popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> All-access for piano, guitar, drums, and singing.</li>',
        'image' => 'marketing/musora/membership/homepage/webp-format/musora-m-team2.webp',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/musora/membership/homepage/2024/devices2.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277?platform=iphone',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('musora._partials._faq')

    @include('_partials.components.video-modal',[
        'name' => 'drumeoSoundslice',
        'video' => '23rlc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'pianoteSoundslice',
        'video' => '4JGlc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'guitareoSoundslice',
        'video' => 'NXGlc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'singeoSoundslice',
        'video' => 'PTGlc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])

    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/songs-toggler.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
