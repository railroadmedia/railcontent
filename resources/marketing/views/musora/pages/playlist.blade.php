@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Drumeo, Pianote, Singeo, Guitareo</title>
    <meta property="og:title" content="Musora | Drumeo, Pianote, Singeo, Guitareo">

    <meta name="description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">
    <meta property="og:description" content="Learn the songs you love; now on drums, piano, guitar, or vocals.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
    <style>
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
            background:#FFAE00;
            color:#000;
            font-size: 1.2rem;
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

        .text-musora-gold {
            color:#FFAE00;
        }

    </style>
    <style>
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

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        .ajax-form input, .ajax-form button {
            font:400 18px/45px "Open Sans", sans-serif;
            height:45px;
            color:#999;
            border-radius:100px;
            padding:7px 20px;
            margin:0 auto 10px;
            transition:all .2s ease-in;
            box-shadow:none;
            text-align:inherit;
            border: 1px solid;
        }

        @media (min-width:640px) {
            .ajax-form input, .ajax-form button {
                font-size:19px;
                margin:0 auto
            }
        }

        @media (min-width:1024px) {
            .ajax-form input, .ajax-form button {
                font-size:23px
            }
        }

        .ajax-form button {
            font-family:"Bebas Neue", sans-serif;
            text-transform:uppercase;
            margin:0 auto!important;
            text-align:center;
            display:block;
            cursor:pointer;
            border:none;
            width:100%;
            padding:0;
            color:#fff;
        }
        form input, form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            form input, form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:10px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 12px;
            }
        }
        .ajax-form input {
        margin-bottom: 8px;
    }
    </style>
@endsection

@section('body-data')
    x-data="{ scrollToSection(id) {
        const element = document.getElementById(id);
        if (element) {
            const offset = element.getBoundingClientRect().top + window.scrollY;
            window.scrollTo({
                top: offset,
                behavior: 'smooth'
            });
        }
    } }"
@endsection
<!-- Main -->
@section('layout-body')

<header class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 bg-black">
    <div class="container max-w-5xl mx-auto text-center">
        <div class="flex flex-wrap items-center">
            <div class="w-full text-center mb-7 sm:mb-0">
                <img class="h-16 sm:h-28 mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/playlist-logo.svg" alt="Musora Playlist Logo">
            <div class="w-full">
                <img class="w-full lg:w-10/12" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/header-playlist.png" alt="Playlist Image">
            </div>
            <div class="w-full text-center">
                <h4 class="leading-tight tracking-wide my-3 sm:my-5 text-white font-bebas font-normal capitalize px-10">Subscribe for a new playlist and artist  <br> conversation delivered to your inbox monthly</h4>
              
              <div class="w-full md:w-7/12 mx-auto leading-relaxed">
               @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                    "formName" => 'The Playlist - Musora Newsletter',
                    "formId" => "Musora - Engagement - Trigger - The Playlist - Musora Newsletter - WebForm",
                    "buttonText" => "Sign Up",
                    "nameInput" => "Your Name",
                    "stacked" => true,
                    "minimalForm" => true,
                    "buttonColor" => "bg-musora text-black",
                    "redirectUrl" => "https://www.musora.com/thank-you",
                ])
                </div>
            </div>
        </div>
        @php
            $features = [
                'Zero Spam',
                'Artist Curated Playlists',
                'Artist Interviews',
            ];
        @endphp

        <div class="flex justify-center mx-auto mt-3">
            <div class="flex flex-col md:flex-row items-center leading-loose">
                @foreach ($features as $feature)
                    <p class="w-full md:w-auto text-left flex items-center text-white px-2">
                        <i class="fas fa-check-circle text-musora mr-2 py-2"></i> {{ $feature }}
                    </p>
                @endforeach
            </div>
        </div>
    </div>
</header>

@php
    $latestImages = [
        'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/album-01.webp',
        'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/album-02.webp',
        'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/album-03.webp',
        'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/album-04.webp',
    ];
@endphp

<section class="text-center px-5 sm:px-6 py-10 sm:py-14 bg-black">
    <div class="container mx-auto max-w-5xl px-10">
        <h3 class="text-left uppercase text-white font-black font-bebas leading-normal">Latest</h3>
        <div class="flex flex-wrap justify-center">
            @foreach ($latestImages as $image)
                <div class="w-full sm:w-1/2 md:w-1/4 p-2">
                    <div class="overflow-hidden">
                        <img src="{{ $image }}" alt="Latest Image" class="w-10/12 md:w-full object-contain rounded">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            <button class="anchor-slide bg-musora py-4 px-6 rounded-full w-full sm:max-w-[350px] font-bebas uppercase text-black join musora-gold tracking-tight" @click="scrollToSection('customize-anchor')"> Subscribe now to get access</button>
        </div>
    </div>
</section>


<section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 bg-black" style="background-color:#F1EFED">
    <div class="container mx-auto z-10 relative max-w-4xl">
        <img class="h-28 md:h-36 lg:h-48 mx-auto pb-6" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/title-logo.svg" alt="Musora Playlist Logo">
        <p class="leading-normal mb-4 text-white">We’re tired of the lazy and shallow recommendations that the algorithm feeds us! <br class="hidden sm:inline">Let’s take back the days of the mix tape and deepen our palettes with a depth that’s only possible through <br class="hidden sm:inline">the diverse human mind! Who’s with us?</p>

        @php
            $items = [
                [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/lead-gen/playlist/player.mp4', 
                    'desc' => '<strong>Artist curated playlists <br class="hidden md:block"> Delivered to Your Inbox </strong>',
                    'sub' => 'Discover new genres, undiscovered artists, forgotten classics, and raw themes with depth that only humans can provide.'
                ],
                [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/musora/lead-gen/playlist/artist-convo.png',
                    'desc' => '<strong>Artist interviews with <br class="hidden md:block"> inside looks into their <br class="hidden md:block"> inspirations </strong>',
                    'sub' => 'Texting interviews that give you a look into your favorite artist’s favorite artists.'
                ],
            ];
        @endphp
        <div class="container mx-auto max-w-3xl"> 
                @foreach ($items as $index => $item)
            @if ($index == 0 && isset($item['video']))
                <video class="my-4 w-9/12 md:w-full rounded-xl overflow-hidden inline sm:hidden"
                    autoplay muted loop playsinline>
                    <source src="{{ $item['video'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <img class="my-4 w-9/12 md:w-full rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="{{ $item['img'] }}"
                    alt="{{ $item['desc'] }}">
            @endif

            <div class="text-left flex flex-col sm:flex-row justify-center items-center sm:py-10 text-white">
                @if ($index % 2 == 0)
                    <div class="flex-grow-0 leading-normal max-w-xl sm:pr-5 lg:pr-8 mx-0">
                        <h3 class="uppercase font-bebas tracking-wide leading-tight font-medium pb-4">{!! $item['desc'] !!}</h3>
                        <p class="tracking-tight leading-normal">{!! $item['sub'] !!}</p>
                    </div>
                    @if ($index == 0 && isset($item['video']))
                        <video class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block"
                            autoplay muted loop playsinline>
                            <source src="{{ $item['video'] }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                            alt="{{ $item['desc'] }}">
                    @endif
                @else
                    <img class="flex-shrink-0 w-full sm:w-6/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="{{ $item['img'] }}"
                        alt="{{ $item['desc'] }}">
                    <div class="flex-grow-0 leading-normal max-w-xl sm:pl-5 lg:pl-8 mx-0">
                        <h3 class="uppercase font-bebas tracking-wide leading-tight font-medium pb-4">{!! $item['desc'] !!}</h3>
                        <p class="tracking-tight leading-normal">{!! $item['sub'] !!}</p>
                    </div>
                @endif
            </div>
        @endforeach
        </div>
    </div>
</section>

<section id="customize-anchor" class="relative px-5 sm:px-6 py-12 sm:py-16 lg:py-24 bg-black" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/final-section.png'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black opacity-35"></div>
    <div class="relative container max-w-2xl mx-auto text-center">
        <div class="flex flex-wrap items-center">
            <div class="w-full text-center">
                <h2 class="leading-tight tracking-normal my-3 sm:my-5 text-white font-bebas font-medium capitalize px-10">Subscribe for a new playlist and artist  <br> conversation delivered to your inbox monthly</h2>
              
                <div class="w-full mx-auto leading-relaxed">
                    @include("drumeo.lead-gen.partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'The Playlist - Musora Newsletter',
                        "formId" => "Musora - Engagement - Trigger - The Playlist - Musora Newsletter - WebForm2",
                        "buttonText" => "Sign Up",
                        "nameInput" => "Your Name",
                        "stacked" => true,
                        "minimalForm" => true,
                        "buttonColor" => "bg-musora text-black",
                        "redirectUrl" => "https://www.musora.com/thank-you",
                    ])
                </div>
            </div>
        </div>
        @php
            $features = [
                'Zero Spam',
                'Artist Curated Playlists',
                'Artist Interviews',
            ];
        @endphp

        <div class="flex justify-center mx-auto mt-3">
            <div class="flex flex-col md:flex-row items-center leading-loose">
                @foreach ($features as $feature)
                    <p class="w-full md:w-auto text-left flex items-center text-white px-2">
                        <i class="fas fa-check-circle text-musora mr-2 py-2"></i> {{ $feature }}
                    </p>
                @endforeach
            </div>
        </div>
    </div>
</section>

@stop

