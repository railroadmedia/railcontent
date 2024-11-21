@php
    require_once(resource_path('marketing/views/guitareo/_partials/homepage-data.php'));
@endphp

@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <meta property="og:url" content="https://www.guitareo.com"/>

    <meta name="description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee." />
    <meta property="og:description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/membership/homepage/2024/share-image-guitareo.webp"/>
    @endif

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}">
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
            fill: #00c9ac !important;
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

        .header-slide-btn {
            display: none !important;
        }

        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color:#00c9ac!important;
                background-color:#0c4a41 !important;
            }
            .option-buttons.active .radio-check {
                border-color:#00c9ac!important;
                background-color:#00c9ac!important;
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
        lazyLoad : false,
        videoLoaded: false,
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])

    @elseif(!empty($month))
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
{{--        <section class="text-center px-5 sm:px-6 py-6 sm:py-8 lg:py-10 text-white" style="background: linear-gradient(225deg, #111729 40%, #00806c);">--}}
{{--            <div class="container max-w-5xl mx-auto">--}}
{{--                <img class="h-20 sm:h-28 lg:h-32" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-white.png">--}}
{{--                <h4 class="leading-tight mt-4 mb-1"><strong>Strum with confidence<br class="sm:hidden"> in just 30 days.</strong></h4>--}}
{{--                <p class="leading-tight mb-4">Save your seat in the first-ever<br class="sm:hidden"> class starting on June 3rd!</p>--}}
{{--                <a href="/shop/30-days-to-better-strumming" class="join white smaller text-guitareo">Learn More</a>--}}
{{--            </div>--}}
{{--        </section>--}}
    @endif

    @hasSection('top-bar')
        @yield('top-bar')
    @endif

    @if(!empty($noEverflow))
        <section class="bg-black bg-cover bg-center text-center text-white py-5 sm:py-7 px-5 sm:px-6" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/musora/promos/november/bf-banner.png');">
            <div class="container max-w-4xl mx-auto">
                <div class="flex flex-wrap items-center justify-center">
                    <div class="w-full sm:w-auto mb-2 sm:mb-0 pr-6">
                        <img class="h-7 sm:h-8 lg:h-11" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/870x0/filters:quality(95)/marketing/drumeo/promos/november/bf-logo-alt.png">
                    </div>
                    <div class="w-full sm:w-auto">
                        <h5 class="leading-tight font-bold text-musora mb-2">STARTS ON NOVEMBER 26TH</h5>
                        <span class="join smaller musora w-full" @click="BFwaitlist = true;">Get Notified &raquo;</span>
                    </div>
                </div>
            </div>
        </section>
        @component('_partials.components.modal', ['name' => 'BFwaitlist'])
            @slot('content')
                <div class="relative overflow-y-visible max-w-md px-5 md:px-10 py-7 md:py-10 bg-black text-white mx-auto rounded-xl shadow-lg text-center">
                    <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/870x0/filters:quality(95)/marketing/drumeo/promos/november/bf-logo-alt.png">
                    <p class="leading-tight my-4">Sign up to be the first to know.</p>
                    @include("guitareo.lead-gen.partials.sign-up-form", [
                        "formId" => "Guitareo - Engagement - Trigger - BF24 Waitlist - Web Form",
                        "formName" => 'BF24 Waitlist',
                        "buttonText" => "Notify Me",
                        'stacked' => true,
                        "recaptchaKey" => $recaptchaKey,
                        "minimalForm" => true
                    ])
                    <p class="leading-tight text-sm mt-2"><em>
                            Don’t worry, we value your privacy and<br class="hidden sm:inline">
                            you can unsubscribe at any time.</em></p>
                </div>
            @endslot
        @endcomponent
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
          $features = $guitareo['features'];;
          $slides = $guitareo['slides'];
    @endphp

    @include('musora.sales.components.header-section', [
        'header' => 'THE <span class="text-guitareo">NEW WAY</span> TO<br> <span class="relative inline-block">LEARN GUITAR<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#00c9ac" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#00c9ac" stroke-width="3" stroke-linecap="round"></path></svg></span>.',
        'desc' => 'Learn the guitar faster with step-by-step lessons,<br class="hidden sm:inline"> a thousand songs, and unlimited personal support. ',
        'thumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/guitareo/membership/homepage/2024/header-thumb.webp',
        'promoThumb' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/guitareo/membership/homepage/2024/jan-thumb.webp',
        'promoThumbM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/guitareo/membership/homepage/2024/jan-thumb-m.webp',
            'pointOne' => 'GREAT TEACHERS',
            'pointTwo' => 'VIDEO LESSONS',
            'pointThree' => 'FUN PRACTICE',
            'pointFour' => 'POPULAR SONGS',
        'cta' => 'SEE YOUR DEAL &raquo',
    ])

    @php
        $gridItems = $guitareo['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your guitar goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Learn to play guitar online with a fluff-free curriculum that’ll<br class="hidden sm:inline">  take your skills from zero to guitar hero – with step-by-step<br class="hidden sm:inline">  lessons designed around playing songs faster. ',
    ])

    @php
        $buttons = $guitareo['buttons'];

        $courses = $guitareo['courses'];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline lg:hidden"> courses + live events with special guests.'
    ])

    @include('musora.sales.components.workouts-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314551/rendition/540p/file.mp4?loc=external&signature=49333e2b437f90a4af69eb5b19468b68f5185729516f735cd390a6ce8b673516',
        'workoutsBG' => 'marketing/guitareo/membership/homepage/2024/workouts-card2.webp',
    ])


    @php
        $songItems = $guitareo['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'subheader' => 'Practice and sing 500+ popular songs with note-for-note sheet music and digital tools.',
        'media' => 'guitareo/membership/homepage/2024/guitareo-songs.webp',
    ])

    @php
        $testimonials = $guitareo['testimonials'];
        $youtube = number_format(Prices::$guitareoYoutubeSubsc);
        $facebook = number_format(Prices::$guitareoFacebookLikes);
        $instagram = number_format(Prices::$guitareoInstagramFollowers);
    @endphp

    @include('musora.sales.components.testimonials-section', [
        'header' => 'guitarists',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
    ])
    @if(empty($trialVersion))
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/guitareo/membership/homepage/2024/guitareo-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar.',
    ])
    @endif
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @if(!empty($trialVersion))
        @include('musora.sales.components.order-section-collage', [
            "orderUrl" => "/ecommerce/add-to-cart?products[guitareo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
        'logo' => 'marketing/guitareo/membership/homepage/2024/guitareo-logo-green.webp',
        'header' => 'Unlimited guitar lessons.<br>Guided practice sessions. <br> Direct access to real teachers.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/guitareo/membership/homepage/2023/guitareo-collage.png',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'guitar',
        ])
    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'image' => 'marketing/guitareo/products/30-days-to-better-strumming/30DTBS-cart.jpg',
                    'title' => '30 Days To Better Strumming',
                    'description' => 'Strum with confidence in just 30 days.',
                    'price' => 97,
                    'shipping' => 'true'
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'marketing/guitareo/membership/homepage/2024/guitareo-annual-2w-card.webp',
        'header' => 'Online guitar lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 2 bonuses<br class="inline sm:hidden"> worth $286',
        'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
        'buttonLink' => '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[30-days-to-better-strumming]=1&redirect=/order&locked=true&promo-code=FREE-W-ANNUAL-6702,special',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/guitareo/membership/homepage/2024/guitareo-logo-green.webp',
        'header' => '<strong>Unlimited guitar lessons.<br>Guided practice sessions. <br> Direct access to real teachers.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/guitareo/membership/homepage/2023/guitareo-collage.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/guitareo/membership/homepage/webp-format/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('guitareo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'NXGlc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314408',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("guitareo.sales.partials._footer")
    @endif


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
