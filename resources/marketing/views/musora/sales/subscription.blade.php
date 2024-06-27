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
    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#101921;">

        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 sm:px-10 text-center">
            @yield('spotify-banner')
            <h1 class="leading-tight mb-3"><strong>The ultimate music<br> lessons experience.</strong>  </h1>
            <h5 class="leading-normal">Learn your favorite instruments, build better<br> habits, and play 1000s of songs.</h5>
            <div class="mx-auto my-5 sm:my-7">
                <a class="w-full sm:w-96 join smaller musora-gold mb-3 @if(!empty($promoVersion)) anchor-slide @endif"
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
                <p class="opacity-80 text-sm leading-normal">
                    @if(!empty($promoVersion) && empty($trialVersion))
                    @elseif(!empty($month))
                        Your first 30 days are free, then just $20/month.
                    @else
                        Your first 7 days are free, then just $20/month.
                    @endif
                </p>
            </div>
            <div class="flex justify-center">
                            <img style="padding-bottom:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="logo">
                            <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png" alt="logo">
                            <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block mr-2 sm:mr-4" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png" alt="logo">
                            <img style="padding-top:2px;" class="h-5 sm:h-6 inline-block" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png" alt="logo">
                        </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(16,25,33,0.7);"></div>
{{--                <img class="object-cover object-center w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/musora/membership/homepage/2024/header.jpg">--}}
        <video class="sm:hidden block object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header-m.mp4"></video>
        <video class="hidden sm:block object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header3.mp4"></video>
    </header>
    @php
        $packs = $musora['packs'];
    @endphp
    @include('musora.sales.components.packs-section', [
        'header' => 'Learn from the best teachers.',
        'desc' => 'Get unlimited access to lessons for guitar, piano, drums, and singing.',
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
