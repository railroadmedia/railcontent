@extends('pianote._partials.global-layout')

@php
    $modalImages = [
        "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-106-Edit.jpg",
        "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-107-Edit.jpg",
        "https://pianote.s3.amazonaws.com/products/chords-and-scales-book/2021-12-23-Pianote-Chords-Scales-108-Edit.jpg"
    ];
@endphp

@section('global-head')
    @parent
    <title>New Piano Players Start Here | Pianote</title>
    <meta property="og:title" content="New Piano Players Start Here | Pianote">
    <meta name="description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">
    <meta property="og:description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <style>

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        form {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            form {
                margin: 0 auto 10px;
            }
        }

        form input, form button {
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }
        @media (min-width: 768px) {
            form input, form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        form input[type="submit"], form button[type="submit"], form input button, form button button {
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 700;
            color: #fff;
            background: #0b76db;
            text-transform: uppercase;
            margin: 0 auto 15px;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        form input[type="submit"]:hover, form button[type="submit"]:hover, form input button:hover, form button button:hover {
            background: #258ff4;
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
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db
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
        .timeline-container .timeline:after,
        .timeline-container:after {
            background-color: #f61a30;
        }
        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }
        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color:#eb1a2f;

        }

        .image-modal-arrow-left, .image-modal-arrow-right {
            font-size: 0;
            position: absolute;
            transform: translate(0, -50%);
            background: #FFF;
            transition: opacity .3s;
            border-radius: 100px;
            height: auto;
            width: auto;
            z-index: 10;
            padding: 3px 10px;
            margin: 0;
            bottom: unset;
            top: 50%;
        }

        .image-modal-arrow-left {
            left: 0;
        }

        .image-modal-arrow-right {
            right: 0;
        }

        .image-modal-arrow-left::before, .image-modal-arrow-right::before {
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            opacity: 1;
            line-height: 1;
            font-family: "Font Awesome 5 Pro";
            font-weight: 300;
            color: #f61a30;
            font-size: 28px;
        }

        .image-modal-arrow-left::before {
            content: "\f104";
        }

        .image-modal-arrow-right::before {
            content: "\f105";
        }

        .timeline-container .timeline:after {
            left: -16px !important;
        }

        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }
    </style>
@stop()

@section('global-body')
    @include('pianote._partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "New Piano Players Start Here",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price),
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
                    "noBreadcrumb" => true
    ])

    @php
        if (is_current_user_a_member()) {
            $registerButtonUrl = '/cohort-packs/register/new-piano-players-start-here';
        } else {
            $registerButtonUrl = "#final";
        }
    @endphp

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="https://cdn.musora.com/image/fetch/w_440,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-2+1.png" alt="new piano players start here logo">
                    <h1 class="rotater-text overflow-hidden"><strong>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>
                        </strong></h1>
                    <h2 class="-mt-3 sm:-mt-1 lg:mt-0">in just 30 days.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever <br class="inline lg:hidden">class starting February 27th.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video lazyload" style="padding-bottom: 75%;" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/header-thumb-m2.jpg" data-open="trailer">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-pianote"></i> Learn by doing
                        <i class="ml-2 fas fa-check text-pianote"></i> Play every day
                        <i class="ml-2 fas fa-check text-pianote"></i> No theory required</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Play  <br>every day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> No theory <br> required</p>
                    </div>

                    @if(session()->has('success-message'))
                        <p class="mb-3 lg:-mb-7 mt-3 text-pianote text-center"><strong>Congrats! You have registered for New Piano Players Start Here.<br class="hidden md:inline"> Check your email for the details.</strong></p>
                    @endif

                    @if(!$hasProduct && is_current_user_a_member())
                        <p class="mb-3 lg:-mb-7 mt-5 mb-2 text-pianote text-left"><strong>You are a Pianote member! <br>Enroll for free by clicking on the button below.</strong></p>
                    @endif

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            @if($hasProduct)
                                <a class="join sold-out medium w-full">YOU'RE ENROLLED</a>
                            @else
                                <a href="{{ $registerButtonUrl }}" class="join medium w-full @if(!is_current_user_a_member()) anchor-slide @endif">ENROLL NOW</a>
                            @endif
                            @if(!auth()->check())
                                <p class="opacity-50 text-sm mt-2 mb-5 sm:mb-0 underline hover:text-pianote">
                                    <a href="{{ get_musora_brand_base_url() }}/new-piano-players">Pianote Members register for free here.</a>
                                </p>
                            @endif
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Joined_profiles.png">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/header-thumb2.jpg" data-open="trailer">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border rounded-lg border-gray-300 mt-8 lg:mt-12 mb-2 lg:mb-4">
                <div class="w-full sm:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 sm:py-3 lg:py-4">
                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5"><strong>February 27th</strong></h4>
                    <hr class="border-gray-300 my-4 sm:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                        Enrollment closes in<br class="inline lg:hidden"> <span class="tzcd-nppsh text-pianote">a limited time</span>.
                    </p>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> February 27th to<br class="hidden sm:inline"> March 28th.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden sm:inline"> for 30 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play real songs on the <br> piano and sound beautiful.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <img class="h-56 inline sm:hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/collage-intro-m.png" alt="collage intro">
            <h2 class="text-center my-5 sm:mt-0 sm:mb-7"><strong>Learn the piano<br class="inline sm:hidden"> in 30 days.</strong></h2>
            <div class="text-left flex flex-wrap sm:flex-nowrap mb-32 sm:mb-56 lg:mb-72">
                <h6 class="leading-normal max-w-lg pr-7">You don’t learn by watching. You learn by doing.
                    <br><br>
                    Start the year off right and learn the piano <b>by playing the piano</b>. You’ll be playing a song from the very first lesson and you’ll follow along with 10-minute daily guided sessions that show you exactly what to play.
                    <br><br>
                    No complicated theory. No need to read music. No frustration.
                    <br><br>
                    All you have to do is press play and follow along. Plus, you’ll have a weekly live lesson with Lisa Witt to answer your questions, stay motivated, and make sure you’re on track and having FUN on the piano.
                    <br><br>
                    So if you’re a new piano player and you’re wondering where to start…
                    <br><br>
                    Start here.
                    <br><br>
                    Scroll down to save your seat.</h6>
                <img class="h-96 hidden sm:inline lazyload" data-src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/collage-intro-desktop.png" alt="collage intro">
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <div class="{{-- aspect-16:9 --}} cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96" data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <img class="rounded-2xl" src="https://pianote.s3.amazonaws.com/products/new-piano-players/video-thumb.jpg" alt="trailer image" />
{{--                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" poster="https://i.vimeocdn.com/video/1488646391-d2694ba3d38847b00d9fcd70c946d3c45efe1202cedf305361a253a275ef5f90-d_890" data-src="https://pianote.s3.amazonaws.com/products/new-piano-players/trailer.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>--}}
            </div>

            <img class="h-10 sm:h-20 mt-10 sm:mt-16 lg:mt-24 mb-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1220,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/Just_Press_Play_logo.png" alt="just play logo">
            <h6 class="leading-normal mb-20 lg:mb-28">New Piano Players Start Here is unlike any other way to learn the piano. From day 1 you’ll be playing a REAL song by following guided play-along lessons with your instructor, Lisa Witt.
                <br><br>
                This isn’t a video game. You’ll be building your skills every single day. And the best part…
                <br><br>
                It only takes 10 minutes a day.</h6>

            @php
                $gettings = [
                    [
                    'position' => 'left',
                    'img' => 'https://pianote.s3.amazonaws.com/products/new-piano-players/calendar.jpg',
                    'title' => 'Know exactly what to practice.',
                    'desc' => 'You’ll never be left wondering what to do. Log in, press play, and follow along with daily 10-minute guided practice sessions for 30 days.',
                    'special' => true,
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://pianote.s3.amazonaws.com/products/new-piano-players/practice.jpg',
                    'title' => 'Short, focused practice sessions.',
                    'desc' => 'No wasted time, no distractions. Each session features a countdown timer so you can turn off the distractions and focus on playing.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://pianote.s3.amazonaws.com/products/new-piano-players/progress.jpg',
                    'title' => 'Smile in your first lesson.',
                    'desc' => 'Play along with a professional backing track so you’ll sound (and feel) incredible as you’re learning. It’s a super motivating way to keep making progress.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://pianote.s3.amazonaws.com/products/new-piano-players/q_a.jpg',
                    'title' => 'Your questions answered.',
                    'desc' => 'You’ll get live access to Lisa Witt each week to get your questions answered. You won’t be left alone to figure it out. Help will always be available.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://pianote.s3.amazonaws.com/products/new-piano-players/lifetime.jpg',
                    'title' => 'Lifetime access.',
                    'desc' => 'New Piano Players Start Here is yours for life. Even though we’ll be going through the course as a community, you’ll keep access to ALL the lessons forever. So you can go back and repeat anything you want to.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://pianote.s3.amazonaws.com/products/new-piano-players/skills.jpg',
                    'title' => 'Skills to take you further.',
                    'desc' => 'The skills you learn in New Piano Players Start Here go beyond the course. By the end you’ll have the building blocks to start playing hundreds of popular songs (literally)!',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-3xl lg:max-w-4xl mx-auto relative px-4 mt-5">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-0 @if($key !== 5) md:mb-28 @endif">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            @if(empty($getting['special']))
                                <img class="-mt-7 rounded-lg lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $getting['img'] }}"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-20 sm:h-28 lg:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_760,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-stacked.svg" alt="new piano players start here logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-pianote mr-5"></i> Daily guided piano workouts<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Weekly LIVE Q&A workshops<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Guaranteed results</h4>
            </div>
            @if(session()->has('success-message'))
                <p class="-mb-2 sm:-mb-8 mt-5 text-pianote text-center"><strong>Congrats! You have registered for New Piano Players Start Here.<br class="hidden md:inline"> Check your email for the details.</strong></p>
            @endif
            @if($hasProduct)
                <a class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3">YOU'RE ENROLLED</a><br>
            @else
                <a
                    href="{{ $registerButtonUrl }}"
                    class="join medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 @if(!is_current_user_a_member()) anchor-slide @endif">ENROLL NOW</a><br>
            @endif
            <img class="h-7 mr-1 mb-5 sm:mb-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Joined_profiles.png" alt="joined profiles">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>

        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-12 mb-4 sm:-mb-24 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/Screen.png" alt="screen">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get LIVE support<br> every step of the way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your lessons, you can ask your instructor at each week’s LIVE Q&A event. Lisa will be there to answer your questions, help you through any sticking points, and keep you motivated to complete the full course.</h6>
                    <div class=" text-center sm:text-left">
                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>Join Lisa LIVE: <i class="fas fa-arrow-down text-pianote mx-2 inline lg:hidden"></i> <i class="fas fa-arrow-right text-pianote mx-2 hidden lg:inline"></i></strong></h6><br class="inline lg:hidden">

                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">4</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">11</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">18</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">25</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom  lazyload" data-src="https://cdn.musora.com/image/fetch/w_380,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-2+1.png"> <strong>...is perfect for:</strong></h2>
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_530,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-player.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-3 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/plus.svg"><br>New Piano<br class="hidden sm:inline lg:hidden"> Players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">It’s right there in the name! If you’re just getting started, New Piano Players Start Here is perfect. From the very first lesson, you’ll be playing real music that sounds GOOD. </p>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_530,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/returning-piano-player.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-3 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/plus.svg"><br>Returning<br class="hidden sm:inline lg:hidden"> Piano Players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Been away a while? Come back to the piano and have FUN. Brush up on the foundations and play with confidence.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_530,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/classically-trained-player.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-3 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/plus.svg"><br> Classically-Trained<br class="hidden sm:inline lg:hidden"> Piano Players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Scared to break away from the safety of sheet music? New Piano Players Start Here will give you the confidence to trust your ear.</p>
                </div>
            </div>


            <h2 class="mt-20 lg:mt-24 mb-3"><strong>Play more. Play better.</strong></h2>
            <h6 class="leading-normal mb-11">For less than the cost of 2 private piano lessons, you’ll <br class="hidden sm:inline"> get 30 days of guided lessons to transform your playing.</h6>

            <div class="relative">
                <p class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 lazyload" data-src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-white.png"></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tl-xl"><strong>Private<br> Lessons</strong></td>
                        <td class="cursor-pointer sm:cursor-default"><strong>Online<br> Courses</strong></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tr-xl"><strong>Piano<br> Books</strong></td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>20 Play-Along Lessons</td>
                        <td>In-Person</td>
                        <td>Self-Directed</td>
                        <td>Self-Directed</td>
                    </tr>
                    <tr>
                        <td>Live</td>
                        <td>4 LIVE Q&As</td>
                        <td>Yes</td>
                        <td>Sometimes</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Length</td>
                        <td>30 Days</td>
                        <td>Open Ended</td>
                        <td>Open Ended</td>
                        <td>Open Ended</td>
                    </tr>
                    <tr>
                        <td>Access</td>
                        <td>Lifetime Access</td>
                        <td>One-Time</td>
                        <td>Varies</td>
                        <td>Lifetime</td>
                    </tr>
                    <tr>
                        <td>Guarantee</td>
                        <td>90 days</td>
                        <td>No</td>
                        <td>Varies</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Investment</td>
                        @if(is_current_user_a_member())
                            <td class="rounded-b-xl"><strong>FREE</strong><br> for Pianote<br class="inline lg:hidden"> Members</td>
                        @else
                            <td class="rounded-b-xl"><strong>${{ floatval($productPrices['new-piano-players-start-here']->discounted_price) }}</strong></td>
                        @endif
                        <td class="rounded-bl-xl"><strong>$50-$100</strong><br> per lesson</td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
{{--    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #d70b3b calc(50% + 1px));"></div>--}}
{{--    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #d70b3b, #9d1032);">--}}
{{--        <div class="container max-w-2xl mx-auto">--}}
{{--            <div class="-mt-14 sm:-mt-20 lg:-mt-28 mb-7">--}}
{{--                <img class="block h-20 sm:h-24 mx-auto lazyload --}}{{--animated infinite bounce slower--}}{{--" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Important_Icon.svg">--}}
{{--            </div>--}}
{{--            <h1 class="font-bebas text-5xl sm:text-6xl lg:text-7xl">FAIR WARNING</h1>--}}
{{--            <h6 class="leading-normal  mt-4 --}}{{--mb-8--}}{{--">30-Day Drummer is a daily guided workout program for drummers — where you’ll get a new video each weekday and a live session each weekend throughout the month. Because of this, students will not be able to join midway — and you need to register before the course begins on February 27.</h6>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="text-center px-5 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <img class="border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_550,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/profile_picture.jpg" alt="profile picture">

                <div class="text-white text-left rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Lisa Witt might just be the happiest piano teacher on the internet.
                        <br><br>
                        With 20 years of teaching experience, her online lessons have helped millions of students around the world.
                        <br><br>
                        But her true magic lies in her empathy and understanding of what it’s like to be a new piano player. She knows how it feels to struggle and she’ll show you how to overcome those challenges and approach the piano in a way that’s motivating, inspiring, and most of all - FUN!
                        <br><br>
                        Start your piano journey with Lisa today.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                            <h3 class="mt-2"><strong>103M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                            <h3 class="mt-2"><strong>175k</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                            <h3 class="mt-2"><strong>55.8K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What students are saying about Lisa and her teaching style.</strong></h3>
            <div class="flex flex-wrap text-left">

                @php
                    $testimonials = [
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jessripley.jpg',
                        'title' => "I’m blown away by the program you’ve created.",
                        'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
                        'name' => 'Jess Ripley',
                        'location' => 'California, USA',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/serenadorward.jpg',
                        'title' => "If I was taught this way as a child, I would have never quit.",
                        'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                        'name' => 'Serena Dorward',
                        'location' => 'Ontario, Canada',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jaydemcintosh.jpg',
                        'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
                        'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
                        'name' => 'Jayde McIntosh',
                        'video' => '660596722',
                        'location' => 'Australia',
                        ],
                        [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/iankershaw.jpg',
                        'title' => "Such a fantastic and welcoming student community.",
                        'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                        'name' => 'Ian Kershaw',
                        'video' => '660596700',
                        'location' => 'United Kingdom',
                        ],
                    ]
                @endphp
                @foreach ($testimonials as $key => $testimonial)
                    <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                        <div class="flex items-start p-5 bg-white rounded-lg">
                            <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_160,q_auto:best/{{ $testimonial['image'] }}" alt="testimonial {{ $key }}">
                            <p class="pl-4"><strong>{{ $testimonial['name'] }}</strong><br>
                                <em class="leading-tight inline-block mb-1 opacity-60">{{ $testimonial['location'] }}</em><br>
                                “{!! $testimonial['description']  !!}”
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>


            @if(session()->has('success-message'))
                <p class="-mb-2 sm:-mb-8 mt-5 text-pianote text-center"><strong>Congrats! You have registered for New Piano Players Start Here.<br class="hidden md:inline"> Check your email for the details.</strong></p>
            @endif

            @if($hasProduct)
                <a class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3">YOU'RE ENROLLED</a><br>
            @else
                <a
                    href="{{ $registerButtonUrl }}"
                    class="join medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 @if(!is_current_user_a_member()) anchor-slide @endif">ENROLL NOW</a><br>
            @endif
            <img class="h-7 mr-1 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Joined_profiles.png">
            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
        </div>
    </section>
{{--    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-16 lg:py-20" style="background:linear-gradient(to bottom, #0b76db, #074c8e);">--}}
{{--        <div class="container max-w-5xl mx-auto">--}}
{{--            <h2><strong>Your brain on drums.</strong></h2>--}}
{{--            <h6 class="leading-tight sm:leading-normal max-w-2xl mt-6 mb-8 sm:mb-20"><strong>The evidence is piling up.</strong><br><br>--}}
{{--                Playing the drums is one of the healthiest activities you can perform for your brain – showing signs of boosting happiness, intelligence, and overall well being. 30-Day Drummer will help you tap into the benefits of playing the drums with a guided plan and flexible schedule.</h6>--}}

{{--            <div class="flex flex-wrap sm:flex-nowrap mb-14 lg:mb-16">--}}
{{--                <div class="w-full sm:w-1/3 px-4 mb-6 sm:mb-0">--}}
{{--                    <img class="h-16 mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_120,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/RCM_logo.svg">--}}
{{--                    <p>“Research by the Royal College of Music has found that drumming has a positive impact on mental health, with a 10-week programme of group drumming reducing depression by as much as 38% and anxiety by 20%.”</p>--}}
{{--                </div>--}}
{{--                <div class="w-full sm:w-1/3 px-4 mb-6 sm:mb-0">--}}
{{--                    <img class="h-16 mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Economist_logo.svg">--}}
{{--                    <p>“Music is good for the health. And drumming may be best of all. As well as being physically demanding, it requires people to synchronize their limbs and to react to outside stimuli”</p>--}}
{{--                </div>--}}
{{--                <div class="w-full sm:w-1/3 px-4">--}}
{{--                    <img class="h-16 mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/iHeart_logo.svg">--}}
{{--                    <p>“Drummers scored higher on an intelligence test and showed a correlation between using multiple limbs to keep a steady beat and a natural ability to problem solve.”</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <div class="h-10 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload" data-src="https://cdn.musora.com/image/fetch/w_410,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/piano-guarantee.png" alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>The guarantee that lasts<br> longer than the course.</strong></h2>
            <h6 class="leading-normal">New Piano Players Start Here is all about getting you playing beautiful piano in the shortest amount of time. For less than the cost of just 2 private lessons, you’ll have a guided path to improve your playing, build your confidence, and start your journey on the piano.
                <br><br>
                You’re going to love it.
                <br><br>
                That’s why you’ll get a guarantee that’s 3X longer than the course! You’ll have 90 days to get through everything and make sure it’s right for you.
                <br><br>
                If not, simply contact our friendly support team within those 90 days for a full refund.
            </h6>

        </div>
    </section>


    @if(!is_current_user_a_member())
        <section class="px-4 sm:px-6 py-10 sm:py-20 lg:py-28 relative" style="background: linear-gradient(180deg, #F61A30 0%, #910000 122.85%);">
            <div class="max-w-5xl mx-auto md:flex relative z-40">
                <div class="flex-1 text-white md:pr-4 lg:pr-0 mb-3 md:mb-0 max-w-md md:max-w-auto mx-auto">

                    <h2 class="font-extrabold mb-4 text-center md:text-left">
                        Master every chord & <br class="hidden lg:inline">scale with this guide.
                    </h2>
                    <p>
                        <span class="font-extrabold">Every Chord. Every Scale. Every Key.</span>
                        <br><br> This essential resource will help you learn the most important chord shapes, chord variations, and scales in EVERY key.
                        <br><br> Regular ${{ floatval($productPrices['piano-chords-and-scales-guide']->price) }}. It’s yours FREE when you get New Piano Players Start Here. (And we’ll cover the shipping.)
                        <br><br>
                    </p>
                </div>
                <div class="flex-1 relative sm:w-2/3 md:w-auto mx-auto text-center sm:pl-10">
                    <div class="relative md:max-w-md mx-auto">
                        <img
                            class="md:absolute md:w-full h-80 md:h-auto md:left-0 -top-10 lg:-top-20 scales-book cursor-pointer lazyload"
                            data-src="https://pianote.s3.amazonaws.com/products/the-power-of-chords/piano_scales_book.png"
                            alt="scales book" data-open="seeInside1">
                    </div>
                </div>
            </div>
        </section>
    @endif


    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container mx-auto relative z-50">
            <div class="flex flex-wrap items-center mt-7 sm:mt-10">
                @if(is_current_user_a_member())
                    <div class="text-left w-full sm:w-1/2 xl:w-5/12 lg:pl-5">
                        <img class="h-20 md:h-20 lg:h-24 lazyload" data-src="https://cdn.musora.com/image/fetch/w_380,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-2+1.png" alt="new piano players start here logo">
                        <h2 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5"><strong>
                                20 Guided Play-Along Lessons.<br>
                                4 Live Q&A Sessions.<br>
                                Lifetime Course Access.
                            </strong></h2>
                        <div class="w-full mx-auto sm:mx-0">

                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Learn piano the easy & fun way.</p>
                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.</p>
                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Click below to get started.</p>
                            <p class="leading-tight mb-3 sm:mb-5"><i class="fas fa-check text-pianote mr-1"></i> Enrollment closes in<br class="inline lg:hidden"> <span class="tzcd-nppsh text-pianote">a limited time</span>.</p>

                            @if(session()->has('success-message'))
                                <p class="mb-3 text-pianote text-center"><strong>Congrats! You have registered for New Piano Players Start Here.<br class="hidden md:inline"> Check your email for the details.</strong></p>
                            @endif

                            <h1 class="inline-block mr-4 align-middle text-4xl sm:text-5xl"><s class="opacity-60">${{ 97 }}</s> <strong>FREE</strong></h1>

                            @if($hasProduct)
                                <a class="join sold-out medium w-1/2 align-middle">YOU'RE ENROLLED</a>
                            @else
                                <a class="join medium w-1/2 align-middle" href="/cohort-packs/register/new-piano-players-start-here">ENROLL NOW</a>
                            @endif

                            <p class="text-sm mt-2"><em>Free for Pianote members.</em></p>
                        </div>
                    </div>
                @else

                    <div class="flex flex-wrap sm:flex-nowrap items-center text-left w-full max-w-3xl mx-auto md:w-7/12 lg:w-5/12">
                        <a href="/ecommerce/add-to-cart?products[new-piano-players-start-here]=1&products[piano-chords-and-scales-guide]=1&locked=true" class="px-5 sm:px-7 lg:px-9 py-7 sm:py-11 sm:-ml-5 z-10 relative rounded-xl bg-white shadow-lg w-full">
                            <img class="h-20 md:h-20 lg:h-24 lazyload" data-src="https://cdn.musora.com/image/fetch/w_380,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-2+1.png" alt="new piano players start here logo">
                            <br>
                            <h2 class="inline-block"><strong class="text-4xl">$97</strong></h2> <p class="inline-block text-xs">One time payment.</p><br>

                            @if(session()->has('success-message'))
                                <p class="mb-3 text-pianote text-center"><strong>Congrats! You have registered for New Piano Players Start Here.<br class="hidden md:inline"> Check your email for the details.</strong></p>
                            @endif
                            @if($hasProduct)
                                <div class="join sold-out smaller my-4">YOU'RE ENROLLED</div>
                            @else
                                <div class="join smaller my-4">ENROLL NOW</div>
                            @endif
                            <ul class="list-disc ml-10">
                                <li class="text-sm leading-relaxed">Get the encyclopedia of chords & scales <strong class="text-pianote">FREE</strong> when you register before February 20th.</li>
                                <li class="text-sm leading-relaxed text-pianote">Enrollment closes in <span class="tzcd-nppsh text-pianote">a limited time</span></li>
                            </ul>
                            <hr class="w-full my-5" style="border-color:#ebf2f8">
                            <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                                <i class="fas fa-check text-pianote mr-1"></i> Runs February 27th to March 28th.<br>
                                <i class="fas fa-check text-pianote mr-1"></i> 20 Guided Play-Along Lessons.<br>
                                <i class="fas fa-check text-pianote mr-1"></i> 4 Live Q&A Sessions.<br>
                                <i class="fas fa-check text-pianote mr-1"></i> Lifetime Course Access.<br>
                                <i class="fas fa-check text-pianote mr-1"></i> 90-Day Money Back Guarantee.</p>
                        </a>
                    </div>
                @endif


                <div class="flex w-full justify-center @if(is_current_user_a_member()) sm:justify-start sm:order-1 sm:w-1/2 xl:w-7/12 sm:pl-5 lg:pl-7  mt-10 sm:mt-0 @else  md:justify-start md:order-1 md:w-5/12 lg:w-7/12 md:pl-4  mt-10 md:mt-0 @endif">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1800,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/collage.png" alt="collage">
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @if(is_current_user_a_member())
                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "Why do I need to register if I get it for free as a member?",
                    "desc" => "It’s a 30-day course and it only works if you’re actively participating. So we wanted to make sure you raised your hand to enroll in the journey.<br><br>This isn’t a “watch a lesson, go do something else for 10 days, watch another” type of routine. So we’re asking for a commitment from anybody who participates.",
                    ])
                @endif
                @include('_partials.components.question-dropdown', [
                "title" => "What if I miss a day (or two)?",
                "desc" => "That’s totally fine. The course is meant to be flexible if you miss a day here or there. There are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session if you ever need to catch up.",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "Do I need a digital piano or software?",
                "desc" => "No! This course works with all pianos and keyboards. You don’t have to plug anything or need any fancy plugins or software. Simply click play on your lesson, and follow along!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "How much time per week will this course require?",
                "desc" => "New Piano Players Start Here gives you guided daily piano lessons for thirty days – with a few flex days built in for when life happens. Each lesson is only 10 minutes. We’ve made it short so you’re more likely to keep playing!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "New Piano Players Start Here is available on your laptop, tablet, or phone. You’ll also have access through the Musora App after you’ve completed your purchase of the course.",
                "num" => '?',
                ])
            </div>
            <div class="inline-block w-full px-3 md:px-4 my-5" style="color:#2a2f34;">
                <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 mb-10" style="color:#2a2f34;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @foreach ($modalImages as $key => $img)
        @include('pianote.products.partials.image-modal',[
            'id' => "seeInside".$key,
            "image" => $img,
            "imageName" => "seeInside".$key,
        ])
    @endforeach

    @if(!is_current_user_a_member())
        <div class="reveal coach-wrap relative rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="loginModal" style="max-width: 530px;" data-reveal data-reset-on-close="false">
            <div class="p-5 sm:p-7">
                <img class="h-24 sm:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/new-piano-players-start-here-logo-2+1.png">
                <h3 class="leading-tight mb-4"><strong>Wait a sec...</strong></h3>
                <p class="leading-normal">
                    You must be logged into your Pianote <br>
                    account to register for free.
                    <br><br> Click below to log in:</p>
                <a href="/login" class="join medium w-full max-w-xs my-5">Login Here</a>
            </div>
        </div>
    @endif

{{--    <div class="reveal coach-wrap relative rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="waitlistModal" style="max-width: 530px;" data-reveal data-reset-on-close="false">--}}
{{--        <div class="p-5 sm:p-7">--}}
{{--            <img class="h-24 sm:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/30_day_drummer_logo.png">--}}
{{--            <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>--}}
{{--            <p class="mb-4">Enter your email below to get notified when the <br class="hidden sm:inline">--}}
{{--                next edition of 30-Day Drummer is announced. </p>--}}
{{--            @include("drumeo.lead-gen.partials.sign-up-form-tw", [--}}
{{--                "formName" => '30 Day Drummer Waitlist',--}}
{{--                "formId" => "Drumeo - Engagement - Trigger - 30 Day Drummer Waitlist - Web Form",--}}
{{--                "buttonText" => "Let Me Know ",--}}
{{--                "stacked" => true,--}}
{{--                "noSocial" => true,--}}
{{--            ])--}}
{{--        </div>--}}
{{--    </div>--}}

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/798501810?autoplay=1',
        "title" => 'trailer'
    ])

    @include("pianote._partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


    <script>
        $(document).ready(function () {
            $(document).foundation();
            $('.comparison tr td:nth-child(3)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('online');
            });
            $('.comparison tr td:nth-child(4)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('books');
            });
            $('.comparison tr td:nth-child(5)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('private');
            });

            var showModal = location.search.substr(1).includes('member-email');

            if (showModal) {
                $('#loginModal').foundation('open');
            }


            let imgNum = 1;

            $('.image-modal-arrow-left').on('click', function(){
                if(imgNum === 0){
                    imgNum = 2;
                }
                else {
                    imgNum--;
                }

                $('#seeInside' + imgNum).find('img').each(function(){
                    const imgSrc = $(this);
                    $('#seeInside1').find('img').attr('src', imgSrc.data('src'))
                })
            })

            $('.image-modal-arrow-right').on('click', function(){
                if(imgNum === 2){
                    imgNum = 0;
                }
                else {
                    imgNum++;
                }

                $('#seeInside' + imgNum).find('img').each(function(){
                    const imgSrc = $(this);
                    $('#seeInside1').find('img').attr('src', imgSrc.data('src'))
                })
            })
        })
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
