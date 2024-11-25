@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
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
        BFwaitlist: false,
        waitlist: false,
        trailer : false,
        lazyLoad: false,
        videoLoaded: false,
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
            "fullSubscriptionVersion" => true,
            "scrollToJoin" => true,
        ])
{{--        @include("drumeo.sales.partials._nav", [--}}
{{--            "subscriptionVersion" => true,--}}
{{--            "scrollToJoin" => true,--}}
{{--            "hideMenu" => true,--}}
{{--        ])--}}
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

    @if(!empty($bfVersion))
        @include('_partials.layout.holiday.homepage-top-banner',[
            'bg' => "url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/BF-header-banner.webp')",
            'badge' => "https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/save-badge.webp",
            'text' => 'Save up to 91% on <br class="sm:hidden">drum lessons, gear & more!',
            'text2' => '<span class="text-promo">Save 38%</span> on your Drumeo Membership<br> + get 10 free bonuses worth $1233.94.',
            'vimeo' => '885338636',
            'orderUrl' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[the-drumeo-deal]=1&promo-code=drumeo-deal-2024&locked=true',
        ])

        <div class="sticky-trigger block"></div>
        <a href="#customize-anchor"
            class="promo-banner anchor-slide flex items-center justify-center py-1.5 px-2 sm:px-0 w-full z-[100] -mt-12 transition-none"
            style="background: #FFAC00;">

            <div x-data="timer()" x-init="countdown()"
                {{--                x-cloak x-show="day < 2"--}}
            >
                <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                    <p class="leading-none m-0 font-black"><strong>DEALS END IN:</strong></p>
                    <div class="h-8 mx-2 bg-black" style="width:2px;"></div>
                    <div class="flex text-center">
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day > 0">
                            <div class="text-lg leading-none font-extrabold" x-text="day">00</div>
                            <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                        </div>
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                            <div class="text-lg leading-none font-extrabold" x-text="hour">00</div>
                            <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                        </div>
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                            <div class="text-lg leading-none font-extrabold" x-text="minute">00</div>
                            <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                        </div>
                        <div x-show="timeLeft > 0">
                            <div class="text-lg leading-none font-extrabold" x-text="second">00</div>
                            <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                        </div>
                        <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                    </div>
                </div>
            </div>
        </a>
    @endif


    @hasSection('top-bar')
        @yield('top-bar')
    @endif


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
       $slides = $drumeo['slides'];
    @endphp

    @if(empty($hideHeader) || !$hideHeader)
    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'header' => 'Learn beginner beats, fills<br> and songs on the drums.',
            'desc' => 'Try Drumeo’s award-winning online drum lessons for 7 days FREE:',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
        ])
    @elseif(!empty($promoPage))
        @include('musora.sales.components.header-section', [
            'promoHeader' => true,
            'noCheck' => true,
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> popular songs and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
        ])
    @elseif(!empty($keyPage))
        @include('musora.sales.components.header-section', [
            'promoHeader' => true,
            'noCheck' => true,
            'header' => 'Unlimited<br> drum lessons +<br>  a <span class="relative inline-block">free drum key<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> popular songs and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
        ])
    @else
        @include('musora.sales.components.header-section', [
            'promoHeader' => true,
            'BFheader' => 'Save $100 + get $635 in free bonuses',
            'header' => 'EVERYTHING<br class="sm:hidden"> YOU NEED<br class="hidden sm:inline"> TO<br class="sm:hidden"> <span class="relative inline-block">LEARN THE DRUMS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke=" #0b76db " stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'desc' => 'Learn the drums faster with step-by-step lessons,<br class="hidden sm:inline"> popular songs and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/jan-thumb-no-badge.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo2.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/membership/homepage/2024/header-thumb-promo-m2.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
        ])
    @endif
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif


    @php
        $gridItems = $drumeo['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum featuring many of the world’s best teachers. ',
    ])

    @php
        $buttons = $drumeo['buttons'];

        $courses = $drumeo['courses'];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Amplify your skills with 200+ artist courses + <br class="hidden md:inline lg:hidden">access exclusive live events with drumming legends.'
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/898668674/rendition/540p/file.mp4?loc=external&signature=d5f33375d3a16dc91641be1539d7d621d07ad049b030baa8a7f32c23e63e3ab4',
        'workoutsBG' => 'marketing/drumeo/membership/homepage/2024/workouts-card3.webp',
    ])

    @php
        $songItems = $drumeo['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'subheader' => 'Practice and play 1500+ popular songs with <br class="lg:hidden">note-for-note transcriptions and digital tools.',
        'media' => 'drumeo/membership/homepage/2024/drumeo-songs.webp',
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
        'logo' => 'marketing/drumeo/membership/homepage/2024/logo-blue.webp',
        'header' => 'Unlimited drum lessons.<br>Guided practice sessions. <br> The world’s best teachers.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2024/collage.webp',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'drumming',
        ])

    @elseif(!empty($promoVersion))
        @include('drumeo._partials.countdown-bundle-2024')

        @php
            require_once(resource_path('marketing/views/drumeo/_partials/bonus-data.php'));
        @endphp
        @php
            $targetSkus = ['30-day-drummer-4', '30-day-independence', '30-day-double-bass', '30-day-jazz', '30-day-chops'];

            $filteredBonuses = collect($bonuses)->filter(function ($bonus) use ($targetSkus) {
                return in_array($bonus['sku'], $targetSkus, true);
            })->values();
        @endphp

        @include('drumeo._partials.bf-order-section-bonuses', [
        'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
        'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/drumeo/promos/november/2024/drumeo-deal-logo.svg',
        'topImage' => 'marketing/drumeo/membership/homepage/2024/drumeo-annual-2w-card.webp',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'logoHeight' => 'h-16 sm:h-18',
        'promoHeader' => '<h3 class="leading-tight mb-4 sm:mb-5"><strong>Save $100 on your first year + get $635 in lifetime bonuses.</strong></h3>',
        'buttonLink' => '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[the-drumeo-deal]=1&promo-code=drumeo-deal-2024&locked=true',
        'belowButton' => true,
        'bundle' => 'deal',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/drumeo/membership/homepage/2024/logo-blue.webp',
        'header' => '<strong>Unlimited drum lessons.<br>Guided practice sessions. <br> The world’s best teachers.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/drumeo/membership/homepage/2024/collage.webp',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/drumeo/membership/homepage/webp-format/devices.webp',
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
