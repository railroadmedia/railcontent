
@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Perfect Piano Practice Live Bootcamp | Pianote</title>
    <meta property="og:title" content="Perfect Piano Practice Live Bootcamp | Pianote">
    <meta name="description" content="Accelerate your progress on the piano with a FREE 90-minute live lesson from Lisa Witt"/>
    <meta property="og:description" content="Accelerate your progress on the piano with a FREE 90-minute live lesson from Lisa Witt">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https:/d2vyvo0tyx8ig5.cloudfront.net/lead-gen/magic-of-piano-chords/header.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

@endsection
@section('head')
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
            background-image: url('https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/magic-of-piano-chords/header_m.jpg');
        }

        .text-yellow {
            color: #FFAC00;
        }

        .header .sub-header {
            font-size: 18px;
        }

        .time-counter {
            font-size: 14px;
        }

        /* vertical line */
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #4d1823;
            top: 0;
            bottom: 0;
            left: 4px;
            margin-left: -3px;
        }

        /* circles in the middle */
        .timeline::after {
            counter-increment: timeline;
            content: counter(timeline);;
            position: absolute;
            width: 20px;
            height: 20px;
            font-size: 12px;
            left: -6px;
            background-color: #4d1823;
            top: 0px;
            border-radius: 50%;
            z-index: 1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-img {
            filter: drop-shadow(4px 4px 10px rgba(0, 0, 0, 0.25));
            border:1px solid #E4E4E4;
        }

        @media (min-width: 640px) {

            .timeline::after {
                width: 25px;
                height: 25px;
                font-size: 14px;
                left: -10px;
            }
        }

        @media (min-width: 768px) {
            .header {
                background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/magic-of-piano-chords/header.jpg');
                background-size: 1410px;
            }

            .header .sub-header {
                font-size: 17px;
            }

            .time-counter {
                font-size: 16px;
            }

            .timeline-container::after {
                left: 50%;
            }

            .timeline::after {
                left: 48%;
            }
        }

        @media (min-width: 1024px) {
            .header {
                background-size: 1560px;
            }
            .time-counter {
                font-size: 17px;
            }

            .header .sub-header {
                font-size: 20px;
            }

            .timeline::after {
                left: 48.5%;
                width: 30px;
                height: 30px;
                font-size: 16px;
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
@endsection

@section('page-body')
    <header class="header text-white text-center px-4 sm:px-6 py-6 md:py-20 lg:py-32 relative bg-no-repeat" style="background-color:#350d0d;">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2">
                    <div class="block mt-72 mb-24 md:my-0"></div>
                    <h1 class="leading-none font-bebas uppercase" style="color:#fcffe3">Perfect piano practice</h1>
                    <h3 class="tracking-widest">LIVE BOOTCAMP</h3>

                    <p class="leading-tight mt-2 md:mt-5" style="color:#fcffe3">
                        <em>
                            Accelerate your progress on the piano with<br class="hidden sm:inline">
                            a FREE 90-minute live lesson from Lisa Witt
                        </em>
                    </p>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center text-white py-8 md:py-12 lg:py-20 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto text-center max-w-2xl">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-11 mr-2 align-middle">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>OCT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">17</strong></p>
            </div><br class="inline sm:hidden">
            {{--<a target="_blank" class=" @if(Carbon\Carbon::create(2022, 8, 16, 11, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium my-2 sm:my-0" href="https://us06web.zoom.us/j/86046483729?pwd=QVZ4Y0pXMnB0bC9ZTGJiaHBNcGRvZz09">Morning Session - 9am PDT &raquo;</a>--}}
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 10, 17, 11, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium" href="https://us06web.zoom.us/j/5246384908?pwd=TjRIbE45N0JqK0lSSUpvUTZ3cCtqZz09">Morning Session - 9am PDT &raquo;</a>
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
@endsection
