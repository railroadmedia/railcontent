@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>30 Day Drummer with Domino Santantonio</title>
    <meta property="og:title" content="30 Day Drummer with Domino Santantonio">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
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

        .join.medium {
            padding:9px 12px;
            font-size:15px;
        }

        @media (min-width:768px) {
            .join.medium {
                font-size:18px;
                padding:15px 25px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <header class="header text-white text-center px-4 sm:px-6 py-14 md:py-20 lg:py-32 relative bg-no-repeat bg-cover bg-top lazyload" style="background-color:#031e3b;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https:/dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
                <h1><strong>30 Day Drummer</strong></h1>
                <h4>with Domino Santantonio</h4>
        </div>
    </header>
    <section class="text-center text-white py-8 md:py-10 lg:py-16 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto text-center max-w-xl">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>SEPT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">10</strong></p>
            </div><br class="inline sm:hidden">
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 9, 10, 17, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue medium my-2 sm:my-0" href="/members/30-day-drummer-1">Afternoon Session - 3pm PDT</a>
            <hr class="my-7 sm:my-10">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>SEPT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">17</strong></p>
            </div><br class="inline sm:hidden">
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 9, 17, 12, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue medium my-2 sm:my-0" href="/members/30-day-drummer-2">Morning Session - 10am PDT</a>
            <hr class="my-7 sm:my-10">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>SEPT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">24</strong></p>
            </div><br class="inline sm:hidden">
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 9, 24, 17, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue medium my-2 sm:my-0" href="/members/30-day-drummer-3">Afternoon Session - 3pm PDT</a>
            <hr class="my-7 sm:my-10">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>OCT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">1</strong></p>
            </div><br class="inline sm:hidden">
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 10, 1, 12, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue medium my-2 sm:my-0" href="/members/30-day-drummer-4">Morning Session - 10am PDT</a>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
