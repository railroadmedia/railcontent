@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Beginner's Vocal Bootcamp | Singeo</title>
    <meta property="og:title" content="Beginner's Vocal Bootcamp | Singeo">
    <meta name="description" content="Get free LIVE vocal training with Lisa Witt"/>
    <meta property="og:description" content="Get free LIVE vocal training with Lisa Witt">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/og_image.jpg">
    <meta property="og:url" content="https://www.singeo.com/beginner-vocal-bootcamp/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">

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

        .header {
            background-position: top;
            background-size: cover;
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/header_bg_m.jpg');
        }

        @media (min-width: 768px) {
            .header {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/header_image_d.jpg');
                background-size: 1160px;
            }
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
    @include("singeo.sales.partials._nav")
    <header class="header text-white text-center px-4 sm:px-6 py-6 md:py-20 lg:py-32 relative bg-no-repeat" style="background-color:#33005c;">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2">
                    <div class="block mt-72 mb-24 md:my-0"></div>
                    <img class="sm:w-4/5 md:w-full" src="https://cdn.musora.com/image/fetch/w_840,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/beginner-vocal-bootcamp/logo.png" alt="logo">
                    <h5 class="mt-2 md:mt-5 leading-tight">Start singing the RIGHT way with a LIVE<br> singing lesson from a vocal coach.</h5>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center text-white py-10 md:py-14 lg:py-24 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto text-center max-w-2xl">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>OCT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">12</strong></p>
            </div><br class="inline sm:hidden">
            {{--<a target="_blank" class=" @if(Carbon\Carbon::create(2022, 8, 16, 11, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium my-2 sm:my-0" href="https://us06web.zoom.us/j/86046483729?pwd=QVZ4Y0pXMnB0bC9ZTGJiaHBNcGRvZz09">Morning Session - 9am PDT &raquo;</a>--}}
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 10, 12, 17, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium" href="https://us06web.zoom.us/j/5246384908?pwd=TjRIbE45N0JqK0lSSUpvUTZ3cCtqZz09">Afternoon Session - 2:30pm PDT &raquo;</a>
            {{--<hr class="my-7 sm:my-10">--}}
            {{--<div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">--}}
            {{--<p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>JULY</strong></p>--}}
            {{--<p class="leading-none text-lg py-1 text-black"><strong class="font-black">14</strong></p>--}}
            {{--</div><br class="inline sm:hidden">--}}
            {{--<a target="_blank" class=" @if(Carbon\Carbon::create(2022, 7, 14, 11, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium my-2 sm:my-0" href="https://us06web.zoom.us/j/83999876445?pwd=UWtxblpYNFZqOHJZd3NFQXdvc0YxQT09">Morning Session - 9am PDT &raquo;</a>--}}
            {{--<a target="_blank" class=" @if(Carbon\Carbon::create(2022, 7, 14, 17, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium" href="https://us06web.zoom.us/j/86124841683?pwd=OVhHQUZ2WFgyblF2c3p1OGtKZ0hRZz09">Afternoon Session - 3pm PDT &raquo;</a>--}}
            {{--<hr class="my-7 sm:my-10">--}}
            {{--<div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">--}}
            {{--<p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>JULY</strong></p>--}}
            {{--<p class="leading-none text-lg py-1 text-black"><strong class="font-black">15</strong></p>--}}
            {{--</div><br class="inline sm:hidden">--}}
            {{--<a target="_blank" class=" @if(Carbon\Carbon::create(2022, 7, 15, 11, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium my-2 sm:my-0" href="https://us06web.zoom.us/j/85199639454?pwd=WlNZQUIwS1lHdE9tUzBWMUdneTU2Zz09">Morning Session - 9am PDT &raquo;</a>--}}
            {{--<a target="_blank" class=" @if(Carbon\Carbon::create(2022, 7, 15, 17, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium" href="https://us06web.zoom.us/j/86064414872?pwd=TkpDZGRwSzdvSUo2ZWt5M1FUV2RXQT09">Afternoon Session - 3pm PDT &raquo;</a>--}}
        </div>
    </section>

    @include("singeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/singeo/nav-footer.js"></script>
@stop
