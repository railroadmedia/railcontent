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
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/membership/homepage/webp-format/share-image-singeo-new.webp"/>
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-singeo.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

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
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false
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
        $bubbles= $singeo['bubbles'];
        $features = $singeo['features'];
        $slides = $singeo['slides'];
    @endphp

        @include('musora.sales.components.header-section', [
            'header' => 'Singing lessons that <br> fit your schedule. ',
            'desc' => 'Learn to sing from home, anytime, with bite-sized <br class="hidden sm:inline"> video lessons and unlimited personal support. ',
            'thumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/header-thumb2.jpg',
            'promoThumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/jan-thumb.png',
            'promoThumbM' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/jan-thumb-m.png',
            'pointOne' => 'Improve Your Voice',
            'pointTwo' => 'Helpful Vocal Coaches',
            'pointThree' => 'Sing Popular Songs',
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

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
