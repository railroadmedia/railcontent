@php
    require_once(resource_path('marketing/views/singeo/_partials/homepage-data.php'));
@endphp

@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    <meta property="og:url" content="https://www.singeo.com"/>

    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee." />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/share-image-singeo.webp"/>
    @endif

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-singeo.css') }}">
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
            fill: #8300E9 !important;
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
                border-color:#8300E9!important;
                background-color:#2f0c4a !important;
            }
            .option-buttons.active .radio-check {
                border-color:#8300E9!important;
                background-color:#8300E9!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
        }
        @endif
        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }

        .timed-toggle .media-toggle.active {
            display:block!important;
        }
        .timed-toggle .active-toggle.active {
            border-color: #8300E9!important;
            background-color:#151f31!important;
        }
        .timed-toggle .active-toggle.active .description {
            max-height:100px!important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
        lazyLoad: false,
        videoLoaded: false,
        }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
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
          $features = $singeo['features'];
          $slides = $singeo['slides'];
    @endphp

    @if(!empty($beginnerVersion))
        @include('musora.sales.components.header-section', [
            'header' => 'Singing lessons that <br> fit <span class="relative inline-block"> your schedule<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#8300e9" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#8300e9" stroke-width="3" stroke-linecap="round"></path></svg></span>. ',
            'desc' => 'Learn to sing from home, anytime, with bite-sized <br class="hidden sm:inline"> video lessons and unlimited personal support. ',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/header-thumb2.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/jan-thumb.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/jan-thumb-m.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => '1000+ SONGS',
        ])
    @else
        @include('musora.sales.components.header-section', [
            'header' => 'THE <span class="text-singeo">NEW WAY</span> TO<br> <span class="relative inline-block">SING BETTER<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#8300e9" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#8300e9" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
            'desc' => 'Improve your vocal range, strength, and control with<br class="hidden sm:inline"> step-by-step lessons and unlimited personal support.',
            'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/header-thumb2.webp',
            'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/jan-thumb.webp',
            'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/jan-thumb-m.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => '1000+ SONGS',
        ])
    @endif
    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif

    @php
        $gridItems = $singeo['gridItems'];
    @endphp


    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your singing goals start here.',
        'desc' => 'An organized curriculum to help you understand your voice, how it functions, how to strengthen it, and sing with confidence.',
    ])

    @php
        $buttons = $singeo['buttons'];

        $courses = $singeo['courses'];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Your voice. Your vocal coaches.',
        'desc' => 'Shape your voice with exclusive artist courses + live events with special guests.'
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314557/rendition/540p/file.mp4?loc=external&signature=e1db56d3f22044707be08bbb02d7327bdf4bee7a07bc705017de56ef45bf1ed4',
        'workoutsBG' => 'marketing/singeo/membership/homepage/2024/workouts-card2.webp',
    ])

    @php
        $songItems = $singeo['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Sing your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note. ',
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/device.webp',
        'brandName' => 'Singeo',
        'bannerDesc' => 'Powered by Musora, Singeo includes full access to our communities for drums, piano, and guitar.',
    ])

    @php
        $testimonials = $singeo['testimonials'];
        $youtube = convertNumber(Prices::$singeoYoutubeSubsc);
        $facebook = convertNumber(Prices::$singeoFacebookLikes);
        $instagram = convertNumber(Prices::$singeoInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'singers',
        'youtubeLink' => 'https://www.youtube.com/singeoofficial/',
        'facebookLink' => 'https://facebook.com/singeoofficial/',
        'instagramLink' => 'https://instagram.com/singeoofficial/',
    ])

    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/singeo/membership/homepage/webp-format/singeo-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence to share your voice with the world.',
    ])
    @endif

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>

    @if(!empty($trialVersion))
        @include('musora.sales.components.card-selection-section', [
            "noSelector" => true,
            "plusLogo" => "https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/singeo/membership/homepage/2023/singeo-plus-logo-light.svg",
            "logo" => "https://musora-ui.s3.amazonaws.com/logos/singeo-white.svg",
            "songs" => "1000+ popular songs.",
            "firstPoint" => "Unlimited singing lessons.",
            "thirdPoint" => "Direct access to vocal coaches.",
            "fifthPoint" => "Lesson access for guitar, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[singeo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[singeo-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[singeo-base-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "monthlyLink" => "/ecommerce/add-to-cart?products[singeo-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'singing',
        ])
    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'image' => 'marketing/singeo/membership/homepage/2024/singing-starter-kit.webp',
                    'title' => 'Singing<br> Starter Kit',
                    'description' => 'Get everything you need to start singing now. In just 7 hands-on lessons, you’ll overcome the challenges most beginner singers face and will instantly sound better.',
                    'price' => floatval($productPrices['singing-starter-kit']->price),
                ],
                [
                    'image' => 'marketing/singeo/membership/homepage/2024/Beautiful_harmonies_card.webp',
                    'title' => 'Harmony',
                    'description' => 'In just 8, short, sing-a-long lessons, you’ll learn how to elevate any vocal performance with incredible harmonies. Even if you’re a total beginner, you’ll be singing your first harmony within the first 10 minutes of this course.',
                    'price' => floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->price),
                ],
            ]
        @endphp

        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'marketing/singeo/membership/homepage/webp-format/singeo-annual-2w-card.webp',
        'header' => 'Online singing lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 2 bonuses<br class="inline sm:hidden"> worth $46',
        'buttonLink' => '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&products[the-essential-guide-to-beautiful-harmonies]=1&locked=true&redirect=/order&promo-code=FREE-W-ANNUAL-6702,special',
        'altButtonLink' => '/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'logo' => 'marketing/singeo/membership/homepage/2024/singeo-logo.webp',
        'header' => 'Unlimited singing lessons.<br> Vocal coaches and support.<br>1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
                'image' => 'marketing/singeo/membership/homepage/2024/singeo-splash.webp',

        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/singeo/membership/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=101a6930-1058-4aae-9584-1a25cec367a0',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=singeo_previews',
    ])

    @include('singeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'ZsC4c',
        'soundslice' => true
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314379',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("singeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("singeo.sales.partials._footer")
    @endif

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/songs-toggler.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
