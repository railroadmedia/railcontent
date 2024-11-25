@php
    require_once(resource_path('marketing/views/musora/_partials/homepage-data.php'));
@endphp

@extends('musora._partials.layout', [
    'whiteNav' => true,
])

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, popular songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, popular songs, and unlimited personal support. ">

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

        .splide__pagination {
            padding:0;
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

        @media (max-width: 767px) {
            ul.splide__pagination li:nth-child(n+7) {
                display: none;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }

        .splide__arrow--prev.testimonial-arrow--prev svg {
            fill: #FFFFFF !important;
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
            color: #000;
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
        brand: "pianote",
        BFwaitlist: false,
        trailer: false,
        lazyLoad: false,
        videoLoaded: false,
    }'
@endsection

@section('layout-body')
    <header class="text-white relative overflow-hidden z-10 h-[560px] sm:h-[700px]" style="background-color:#101921;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 sm:px-10 text-center">
            @yield('spotify-banner')
            @if(!empty($bfVersion))
                <img class="h-16 sm:h-20 lg:h-24 mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/musora/promos/black-friday/musora-BF-header.webp">
                <h1 class="leading-tight mb-3"><strong>The ultimate music<br> lessons experience.</strong>  </h1>
                <h5 class="text-musora leading-tight"><strong>SAVE $100 ON YOUR FIRST YEAR OF LESSONS.</strong></h5>
                <h5 class="font-light">ONLY <span class="opacity-40"><s>$240</s></span> $140 FOR BLACK FRIDAY.</h5>
            @else
            <h1 class="leading-tight mb-3"><strong>The ultimate music<br> lessons experience.</strong>  </h1>
            <h5 class="leading-normal">Learn your favorite instruments, build better<br> habits, and play your favorite songs.</h5>
            @endif
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0 my-5 sm:my-7">
                <a class="sm:mx-0.5 w-full sm:w-56 join musora-gold smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
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
                <div class="sm:mx-0.5 w-full sm:w-56 join outline white smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            </div>
            <div class="flex justify-center">
                <img style="padding-bottom:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="logo">
                <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png" alt="logo">
                <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png" alt="logo">
                <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png" alt="logo">
            </div>
        </div>
        @if(!empty($commercialHeader))
            <div class="top-0 left-0 absolute w-full h-full z-10" style="    background: rgba(0, 0, 0, 0.6);backdrop-filter: blur(4px);-webkit-backdrop-filter: blur(4px);"></div>
            <video class="sm:hidden block object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header5-m.mp4"></video>
            <video class="hidden sm:block object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header5.mp4"></video>
        @else
            <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(16,25,33,0.7);"></div>
            <video class="sm:hidden block object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header6-m.mp4"></video>
            <video class="hidden sm:block object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header3.mp4"></video>
        @endif
    </header>
    @php
        $packs = $musora['packs'];
    @endphp
    @include('musora.sales.components.packs-section', [
        'header' => 'Learn from the<br class="sm:hidden"> best teachers.',
        'desc' => 'Get unlimited access to lessons for<br class="sm:hidden">  guitar, piano, drums, and singing.',
    ])

    @php
        $gridItems = $musora['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'bgColor' => "#f4f8fb",
        'seven' => true,
    ])

    @php
        $workoutImages = $musora['workoutImages'];
    @endphp

    @include('musora.sales.components.workouts-section', [
        'workoutsBG' => 'marketing/musora/membership/homepage/2024/workouts-card2.jpg',
    ])


    @php
        $songItems = $musora['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'subheader' => 'Practice and sing 300+ popular songs with note-for-note sheet music and digital tools.',
        'media' => 'musora/membership/homepage/2024/musora-songs.webp',
    ])

    @php
        $testimonials = $musora['testimonialsVideo'];
    @endphp
    @include('musora.sales.components.testimonials-section-video', [
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
        @include('musora.sales.components.order-section-collage', [
            "orderUrl" => "/ecommerce/add-to-cart?products[musora-annual-recurring-7-day-trial-membership]=1&locked=true",
        'logo' => 'marketing/musora/membership/homepage/webp-format/musora_logo.webp',
        'header' => 'Unlimited music lessons.<br>Guided practice sessions. <br> The world’s best teachers.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> All-access for piano, guitar, drums, and singing.</li>',
        'image' => 'marketing/musora/membership/homepage/webp-format/musora-m-team2.webp',
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'musical',
        ])
    @else
        @if($bfVersion)
        @include('drumeo._partials.countdown-bundle-2024')

        @include('musora.sales.components.order-section-collage-bf', [
        'headerLight' => true,
        'logo' => 'marketing/musora/membership/homepage/webp-format/musora_logo.webp',
        'header' => '<strong>Unlimited music lessons.<br>Guided practice sessions. <br> The world’s best teachers.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> All-access for piano, guitar, drums, and singing.</li>',
        'image' => 'marketing/musora/membership/homepage/webp-format/musora-m-team2.webp',
        'orderUrl' => '/ecommerce/add-to-cart?products[musora-annual-recurring-membership]=1&promo-code=musora-deal-2024&locked=true',
        ])
        @else
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/musora/membership/homepage/webp-format/musora_logo.webp',
        'header' => '<strong>Unlimited music lessons.<br>Guided practice sessions. <br> The world’s best teachers.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-musora"></i> Personalized feedback from real teachers.</li>
        <li class="leading-tight text-musora max-w-xs mx-0"><i class="fa-li fas fa-check"></i> All-access for piano, guitar, drums, and singing.</li>',
        'image' => 'marketing/musora/membership/homepage/webp-format/musora-m-team2.webp',
        ])
        @endif
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/musora/membership/homepage/2024/devices3.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277?platform=iphone',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('musora._partials._faq')

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '1008605396',
        'vimeo' => true,
    ])


    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')

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
@stop
