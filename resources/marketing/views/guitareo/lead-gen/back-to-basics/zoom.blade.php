@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Live Bootcamp | Guitareo</title>
    <meta property="og:title" content="Live Bootcamp | Guitareo">
    <meta name="description" content="Join this 60-minute LIVE guitar lesson with Ayla Tesler-Mabe"/>
    <meta property="og:description" content="Join this 60-minute LIVE guitar lesson with Ayla Tesler-Mabe">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/share_image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/back-to-basics/">

    @parent

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="preload" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}"></noscript>
    <style>
        body {
            counter-reset: timeline;
        }

        .header {
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/bg_header_m.jpg');
        }


        @media (min-width:768px) {

            .header {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/bg_header.jpg');
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

@section('body')
    <header class="header text-white text-center px-3 py-6 md:py-24 relative bg-cover bg-top" style="background-color:#000C17;">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-7/12 lg:w-2/3 md:text-left">
                    <div class="mt-56 md:mt-0 pl-2 sm:pl-3">
                        <img class="h-28 lg:h-36 lazyload" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/back-to-basics/logo.png" alt="logo">
                        <p class="hidden md:block leading-tight mt-4">
                            <em>Join this 60-minute LIVE guitar lesson with Ayla Tesler-Mabe</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="relative h-5 sm:h-7 -mt-5 sm:-mt-7" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="px-4 sm:px-6 py-12 sm:py-20 text-white text-center" style="background-color: #fff;">
        <div class="max-w-2xl mx-auto">
            <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mb-2 md:mb-0 shadow-lg">
                <p class="leading-none tracking-tighter text-xs py-0.5 text-white" style="background-color:#bb3744;"><strong>SEPT</strong></p>
                <p class="leading-none text-lg py-1 text-black"><strong class="font-black">23</strong></p>
            </div><br class="inline sm:hidden">
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 9, 23, 12, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium my-2 sm:my-0" href="https://us06web.zoom.us/j/83254497207?pwd=UzhwQjBmc3pUaEVzQmJYbitISEswdz09">Morning Session - 10am PDT &raquo;</a>
            <a target="_blank" class=" @if(Carbon\Carbon::create(2022, 9, 23, 16, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join medium" href="https://us06web.zoom.us/j/86202080298?pwd=RHUrcFg3cVpHczFqYzhrZlQ2T2Vrdz09">Afternoon Session - 2pm PDT &raquo;</a>

        </div>
    </section>


@endsection
