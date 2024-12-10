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
            background: #FFAE00;
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
            background:#ffb61a;
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
            color:#FFAE00
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
        BFwaitlist : false,
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
    @hasSection('top-bar')
        @yield('top-bar')
    @endif
    @php
        $bubbles =  [
             [
                 'src' => $bubble1,
                 'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
             ],
             [
                 'src' => $bubble2,
                 'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
             ],
             [
                 'src' => $bubble3,
                 'classes' => 'h-16 sm:h-12 lg:h-16 top-[50%] sm:top-[50%] left-[8%] sm:left-[8%]',
             ],
             [
                 'src' => $bubble4,
                 'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
             ],
             [
                 'src' => $bubble5,
                 'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
             ],
             [
                 'src' => $bubble6,
                 'classes' => 'h-16 sm:h-16 lg:h-20 top-[53%] sm:top-[53%] left-[99%] sm:left-[92%]',
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
            'pointFour' => 'POPULAR SONGS',
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
            'pointFour' => 'POPULAR SONGS',
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
        'subheader' => 'Practice and sing 300+ popular songs with note-for-note sheet music and digital tools.',
        'media' => 'singeo/membership/homepage/2024/singeo-songs.webp',
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
        @include('musora.sales.components.order-section-collage', [
        "orderUrl" => "/ecommerce/add-to-cart?products[singeo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
        'logo' => 'marketing/singeo/membership/homepage/2024/singeo-logo.webp',
        'header' => 'Unlimited singing lessons.<br>Guided practice sessions. <br> Vocal coaches and support.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
                'image' => 'marketing/singeo/membership/homepage/2024/singeo-collage-new.webp',

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
            ]
        @endphp

        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'marketing/singeo/membership/homepage/webp-format/singeo-annual-2w-card.webp',
        'header' => 'Online singing lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 1 bonus<br class="inline sm:hidden"> worth $19',
        'buttonLink' => '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&locked=true&redirect=/order&promo-code=FREE-W-ANNUAL-6702,special',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/singeo/membership/homepage/2024/singeo-logo.webp',
        'header' => '<strong>Unlimited singing lessons.<br>Guided practice sessions. <br> Vocal coaches and support.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
                'image' => 'marketing/singeo/membership/homepage/2024/singeo-collage-new.webp',

        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/singeo/membership/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('singeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'PTGlc',
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

     @if(Carbon\Carbon::create(2024, 12, 02, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
    {{--    end of BF weekend--}}
    @include('_partials.components.countdown',[
        'countdownDate' => '2024-12-02 00:00:00',
        'promoVersion' => true
    ])
    @else
        {{--    end of cyber monday--}}
        @include('_partials.components.countdown',[
            'countdownDate' => '2024-12-03 00:00:00',
            'promoVersion' => true
        ])
    @endif

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
