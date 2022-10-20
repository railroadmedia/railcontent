@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Lifetime Members Masterclass with Jared Falk</title>
    <meta property="og:title" content="Lifetime Members Masterclass with Jared Falk">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="/marketing/css/drumeo/tailwind-helpers.css" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }

        body {
            counter-reset: timeline;
        }
        .join.smaller {
            font-size: 18px;
            padding: 16px 25px;
        }

        @media (min-width: 768px) {
            .join.smaller {
                padding: 16px 30px;
            }
        }

        .tooltip {
            position: relative;
        }
        .tooltip:after, .tooltip:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s;
            overflow: hidden;
        }
        .tooltip:before {
            z-index: 100;
            content: ' ';
            top: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-bottom: 7px solid #fff;
        }
        .tooltip:after {
            padding: 6px 9px;
            content: attr(tip);
            font: 600 12px/1.2em 'Open Sans', sans-serif;
            color: #000;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            top: 30px;
            left: 50%;
        }
        .tooltip:hover, .tooltip:focus {
            z-index: 100;
        }
        .tooltip:hover:after, .tooltip:focus:after, .tooltip:hover:before, .tooltip:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <header class="header text-white text-center px-4 sm:px-6 py-14 md:py-20 lg:py-32 relative bg-no-repeat bg-cover bg-top lazyload" style="background-color:#031e3b;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https:/dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
                <h1><strong>Lifetime Members Masterclass</strong></h1>
                <h3>with Jared Falk</h3>
        </div>
    </header>
    <section class="text-center text-white py-8 md:py-24 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto text-center max-w-2xl">
            <a href="https://www.addevent.com/event/qM14764665" class="inline-block tooltip group" tip="Add To Calendar">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-14 mr-2 align-middle transition-opacity group-hover:opacity-70">
                <p class="leading-none tracking-tighter text-xs py-1 text-white" style="background-color:#bb3744;"><strong>AUG</strong></p>
                <p class="leading-none text-lg py-1.5 text-black"><strong class="font-black">27</strong></p>
            </div></a>
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 8, 27, 14, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue smaller" href="/members/drumeo-masterclass-1">Afternoon Session - 12pm PDT</a>
            <hr class="my-7">
            <a href="https://www.addevent.com/event/cB14764666" class="inline-block tooltip group" tip="Add To Calendar">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-14 mr-2 align-middle transition-opacity group-hover:opacity-70">
                <p class="leading-none tracking-tighter text-xs py-1 text-white" style="background-color:#bb3744;"><strong>AUG</strong></p>
                <p class="leading-none text-lg py-1.5 text-black"><strong class="font-black">27</strong></p>
            </div></a>
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 8, 27, 20, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue smaller" href="/members/drumeo-masterclass-2">Evening Session - 6pm PDT</a>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
