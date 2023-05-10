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
    <title>Easy Chords | Pianote</title>
    <meta property="og:title" content="Easy Chords | Pianote">
    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/share-image.jpg" style="display: none;">
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
            background: #F61A30;
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
            background:#ff5454;
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
            color:#F61A30
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
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "Easy Chords",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price),
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
        "noBreadcrumb" => true
    ])

    <a href="#final" class="anchor-slide flex items-end justify-center px-2 sm:px-0 fixed w-full z-[100]" style="background: #d6e8fd;">
        <p class="font-bebas uppercase mx-0 py-2 leading-none">
            GET A FREE CHORDS & SCALES BOOK UNTIL MAY 21.
            <br><span class="text-pianote"><span x-cloak x-data="timer2()" x-init="countdown2()">
                                 <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                 <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
{{--                                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
                    {{--                                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
                                 <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                             </span> left!</span>
        </p>
        <img class="h-10 ml-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/products/new-piano-players/sticky_bar_chords_scales.png" alt="chords & scales book" fetchpriority="high" />
    </a>
    <div class="w-full block h-10 sm:h-11"></div>

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-14 sm:h-18 lg:h-20 mb-1 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" alt="logo" fetchpriority="high">
                    <h1 class=""><strong>30 days to</strong></h1>
                    <h2 class="sm:-mt-1 lg:mt-0">better piano chords.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever <br class="inline lg:hidden">class starting June 5th.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video" style="padding-bottom: 75%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/header-image-m.png" alt="header image" fetchpriority="high" />
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

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
{{--                            <span class="join sold-out medium w-full" data-open="waitlistModal">JOIN WAITLIST</span>--}}
                                <a href="#final" class="join medium w-full anchor-slide">ENROLL NOW</a>
                            <p class="opacity-50 text-sm mt-2 mb-5 sm:mb-0 underline hover:text-pianote">
                                <a href="https://www.musora.com/pianote/enrollment/easy-chords">Pianote Members register for free here.</a>
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/piano-players.png" alt="joined student profiles" fetchpriority="high">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/header-image.png" alt="header image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border rounded-lg border-gray-300 mt-8 lg:mt-12 mb-2 lg:mb-4">
                <div class="w-full sm:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 sm:py-3 lg:py-4">
                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5"><strong>June 5th</strong></h4>
                    <hr class="border-gray-300 my-4 sm:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                        Enrollment closes in<br class="inline lg:hidden">
                        <span class="text-pianote" x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>
{{--                        Enrollment closed--}}
                    </p>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> June 5th to<br class="hidden sm:inline"> July 5th.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden sm:inline"> for 30 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Better chord changes.  <br> Play 2 beautiful songs.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <h2 class="text-center"><strong>You’ll sound like THIS <br class="inline sm:hidden"> after just 30 days.</strong></h2>
            <h6 class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7">Hear the difference between your first and final lesson. And it only takes 10 minutes a day.</h6>
            <img class="sm:h-7 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/timeline.png" alt="timeline" loading="lazy" onload="this.classList.remove('opacity-0')">
            <div class="flex flex-wrap text-left max-w-3xl mx-auto mt-5 sm:mt-7 mb-10 sm:mb-14 lg:mb-20">
                <div class="w-1/2 pr-2 sm:px-4">
                    <div class="rounded-xl overflow-hidden shadow-md cursor-pointer autoplay-video" data-open="dayOne">
                        <img class="transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/day-1-thumb.jpg" alt="day1 thumb" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <p class="p-2 sm:p-5 text-sm">We’ll start slow. Here’s what you’ll be playing in your first lesson.</p>
                    </div>
                </div>
                <div class="w-1/2 sm:px-4">
                    <div class="rounded-xl overflow-hidden shadow-md cursor-pointer autoplay-video" data-open="dayThirty">
                        <img class="transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/day-30-thumb.jpg" alt="day 30 thumb" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <p class="p-2 sm:p-5 text-sm">After 30 days, you’ll be playing this beautiful song. All you have to do is follow along.</p>
                    </div>
                </div>
            </div>

            <img class="h-56 inline sm:hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/intro-image.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="text-center mt-5 sm:mt-0"><strong>Why chords?</strong></h2>
            <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7 lg:mb-10 uppercase text-pianote">We’re so glad you asked…</p>

            <div class="text-left flex flex-wrap sm:flex-nowrap mb-32 sm:mb-56 lg:mb-72">
                <p class="leading-normal max-w-lg pr-7">Chords are the foundation of music.
                    <br><br>
                    All music (even classical) is made from chords. The songs you love to listen to and play are little more than chord progressions with a melody on top. When you know how to play beautiful chord progressions, your playing will sound better, you’ll be more confident, and you’ll have more fun.
                    <br><br>
                    And no, you don’t need to understand any complex theory.
                    <br><br>
                    Easy Chords will bridge the gap between knowing about chords, and actually being able to use them. You’ll learn popular progressions, chord inversions, and rhythms to enhance your playing and take you beyond a beginner.
                    <br><br>
                    And it only takes 10 minutes a day, 5 days a week.
                    <br><br>
                    That’s less time than it takes for a trip to the grocery store.</p>
                <img class="h-96 hidden sm:inline transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/intro-image.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <div class=" aspect-16:9  cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96" data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/trailer.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>

            <img class="h-10 sm:h-20 mt-10 sm:mt-16 lg:mt-24 mb-8 transition-all opacity-0"src="https://www.musora.com/musora-cdn/image/width=1220,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/press-of-a-button.svg" alt="just play logo" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h6 class="leading-normal mb-20 lg:mb-28 max-w-lg">Log in. Press play. Follow along.
                <br><br>
                It really is that simple. In just 10 minutes a day, you’ll build the skills and muscle memory to play beautiful music.
                <br><br>
                And it will NEVER feel like practice.</h6>

            @php
                $gettings = [
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/never-feel-lost.jpg',
                    'title' => 'Never feel lost.',
                    'desc' => 'Knowing what and how to practice is half the battle of getting better. But you’ll never have to worry, because all the lessons ARE your practice sessions. Every day just press play and follow along.',
                    'special' => true,
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/stop-wasting-time.jpg',
                    'title' => 'Stop wasting time.',
                    'desc' => 'It’s precious, so don’t waste it. Each lesson is only 10 minutes and there’s a handy countdown timer so you can stay focused and get more results in a shorter time.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/practice-thats-actually.jpg',
                    'title' => 'Practice that’s actually fun.',
                    'desc' => 'You won’t be playing the same chords over and over again. You’ll be playing REAL music. You’ll sound beautiful, and it will never feel like practice.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/live-support2.jpg',
                    'title' => 'Support from REAL teachers.',
                    'desc' => 'At every step, you’ll have REAL teachers helping you. Ask questions, get feedback, and connect with other students. You’re never alone.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/lifetime-access.jpg',
                    'title' => 'Lifetime access.',
                    'desc' => 'Easy Chords is yours for life. Even though we’ll be going through the course as a community, you’ll keep access to ALL the lessons forever. So you can go back and repeat anything you want to.',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-3xl lg:max-w-4xl mx-auto relative px-4 mt-5">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg overflow-hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-0 @if($key !== 4) md:mb-28 @endif">
                            <img class="-mt-7 rounded-lg overflow-hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
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
    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/tablet-piano-bg.jpg);">
        <h3 class="leading-tight"><strong>Go on, give it a try</strong></h3>
        <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7">Curious? <strong>Try a snippet from Day 1</strong> and<br class="inline sm:hidden"> see if Easy Chords is right for you.</p>
        <div class="relative cursor-pointer autoplay-video" data-open="demoVid">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/tablet-piano-m-lisa.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/tablet-piano-lisa.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="absolute transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-2/3 px-3 py-1 z-10 rounded-xl text-white inline-block mx-auto text-sm whitespace-nowrap" style="background-color:#c20000;"><i class="fas fa-play-circle mr-1 text-xl sm:text-3xl align-middle"></i> <strong>At your piano?</strong> Hit play and try<br class="inline sm:hidden"> some of the lesson from your first day.</p>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="leading-tight"><strong>Play More = Get Better.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3 mb-5 sm:mb-7 uppercase text-pianote">It’s not rocket science.</p>
            <p class="leading-normal mb-11 max-w-2xl">The more you play, the better you’ll get. And it won’t cost the earth. For less than the cost of 2 private piano lessons, you’ll get 30 days of guided training to improve your playing. And once the course is over, the lessons are yours for life.</p>
            <div class="relative mb-20 lg:mb-24">
                <p class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=220,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo-light.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')"></td>
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
                        <td class="rounded-b-xl"><strong>${{ floatval($productPrices['new-piano-players-start-here']->discounted_price) }}</strong></td>
                        <td class="rounded-bl-xl"><strong>$50-$100</strong><br> per lesson</td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img class="h-14 sm:h-16 align-bottom opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" loading="lazy" onload="this.classList.remove('opacity-0')" alt="logo"> <strong>...is perfect for:</strong></h2>
            <div class="flex flex-wrap text-left max-w-4xl mx-auto">
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/beginner-player.jpg" alt="classical player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br>Beginner <br class="hidden sm:inline"> piano players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Know a few chords, but struggling to feel confident playing them? Or are you wondering what chord inversions are and how to practice them? With Easy Chords, you’ll move past the beginner stage and start sounding better.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/intermediate-player.jpg" alt="classical player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br>Intermediate<br class="hidden sm:inline"> piano players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Chord progressions sound better using inversions. Master your 1st and 2nd inversions to help you change chords more smoothly and sound more professional. Train your ear to hear more common chord progressions used in music.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/classical-player.jpg" alt="classical player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br> Classical<br class="hidden sm:inline"> piano players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Scared to break away from the safety of sheet music? Easy Chords will transform your understanding of composition and song structure. You don’t need notes on the page to play beautiful music. This will change everything.</p>
                </div>
            </div>

        </div>
    </section>
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">Piano chords changed my life.
                        <br><br>
                        I grew up learning classical piano through the Royal Conservatory. I didn’t know what chords were, or how they were used in composition.
                        <br><br>
                        I just had to read the notes on the page and play them.
                        <br><br>
                        That all changed the day I discovered chords and chord inversions.
                        <br><br>
                        Suddenly I could start improvising, creating my own rhythms and melodies, and eventually write my own music. Music became something I “created” rather than something I “played”.
                        <br><br>
                        Chords gave me the ability and confidence to do what we all dream of doing…
                        <br><br>
                        Sit down at the piano and “just play”.
                        <br><br>
                        If you’ve ever dreamt of playing popular songs for your family and friends without spending months learning every note. Or if you’ve ever wanted to explore improvisation and song-writing. Or if you just want to sit and play the keys and see what comes out…
                        <br><br>
                        You need to try Easy Chords.
                        <br><br>
                        Over 30 days, I’ll guide you through the stages I used to learn and feel comfortable playing piano chords. You’ll discover how chord inversions will transform your playing and make it easier to play the songs you love.
                        <br><br>
                        Come join me.
                    </p>
                    <img class="float-right h-12 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/lisa-witt-signature.png" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>

            <h3 class="leading-tight mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What students are saying about<br class="inline lg:hidden"> Lisa and her teaching style:</strong></h3>
            <div class="flex flex-wrap text-left">

                @php
                    $testimonials = [
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
                        'title' => "I’m blown away by the program you’ve created.",
                        'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
                        'name' => 'Jess Ripley',
                        'location' => 'California, USA',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
                        'title' => "If I was taught this way as a child, I would have never quit.",
                        'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                        'name' => 'Serena Dorward',
                        'location' => 'Ontario, Canada',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
                        'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
                        'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
                        'name' => 'Jayde McIntosh',
                        'video' => '660596722',
                        'location' => 'Australia',
                        ],
                        [
                        'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
                        'title' => "Such a fantastic and welcoming student community.",
                        'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                        'name' => 'Ian Kershaw',
                        'video' => '660596700',
                        'location' => 'United Kingdom',
                        ],
                    ]
//                @endphp
                @foreach ($testimonials as $key => $testimonial)
                    <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                        <div class="sm:flex items-start p-5 bg-white rounded-lg">
                            <img class="h-14 sm:h-16 lg:h-20 rounded-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=160,quality=85/{{ $testimonial['image'] }}" alt="testimonial {{ $key }}" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <p class="sm:pl-4"><strong>{{ $testimonial['name'] }}</strong><br>
                                <em class="leading-tight inline-block mb-1 opacity-60">{{ $testimonial['location'] }}</em><br>
                                “{!! $testimonial['description']  !!}”
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

{{--            <span class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" data-open="waitlistModal">JOIN WAITLIST</span><br>--}}

                <a
                    href="#final"
                    class="join medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>

            <img class="h-7 mr-1 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/piano-players.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
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
{{--                    <img class="h-16 mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=120,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/RCM_logo.svg">--}}
{{--                    <p>“Research by the Royal College of Music has found that drumming has a positive impact on mental health, with a 10-week programme of group drumming reducing depression by as much as 38% and anxiety by 20%.”</p>--}}
{{--                </div>--}}
{{--                <div class="w-full sm:w-1/3 px-4 mb-6 sm:mb-0">--}}
{{--                    <img class="h-16 mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Economist_logo.svg">--}}
{{--                    <p>“Music is good for the health. And drumming may be best of all. As well as being physically demanding, it requires people to synchronize their limbs and to react to outside stimuli”</p>--}}
{{--                </div>--}}
{{--                <div class="w-full sm:w-1/3 px-4">--}}
{{--                    <img class="h-16 mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/iHeart_logo.svg">--}}
{{--                    <p>“Drummers scored higher on an intelligence test and showed a correlation between using multiple limbs to keep a steady beat and a natural ability to problem solve.”</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <div class="h-10 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#2a2f34;">
        <div class="container max-w-3xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=410,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h3 class="my-4 sm:my-6 lg:my-8"><strong>The guarantee that lasts<br class="inline sm:hidden"> longer than the course.</strong></h3>
            <p class="leading-normal">Easy Chords will make you a better piano player in just 30 days. And we’re so confident that you’ll love the results, you’ll have 90 days to put us to the test.
                That’s enough time to go through the course 3x over before deciding if it’s worth the money.
                Because if you’re not happy with the results, then you shouldn’t have to pay.
                Simply let us know within 90 days and you’ll receive all your hard-earned money back. It’s our promise.
            </p>

        </div>
    </section>

    <section class="px-4 sm:px-6 py-10 sm:py-20 lg:py-28 relative" style="background: linear-gradient(180deg, #F61A30 0%, #910000 122.85%);">
        <div class="max-w-5xl mx-auto md:flex relative z-40">
            <div class="flex-1 text-white md:pr-4 lg:pr-0 mb-3 md:mb-0 max-w-md md:max-w-auto mx-auto">
                <h5 class="uppercase mb-2 text-center md:text-left" style="color: #FFAE00;">
                    AVAILABLE UNTIL May 21st<br> only
                    <span x-cloak x-data="timer2()" x-init="countdown2()">
                                 <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                 <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
{{--                                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
                        {{--                                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
                                 <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                             </span>
                    left!
                </h5>
                <h2 class="font-extrabold mb-4 text-center md:text-left">
                    Master every chord & <br class="hidden lg:inline">scale with this guide.
                </h2>
                <p>
                    <span class="font-extrabold">Every Chord. Every Scale. Every Key.</span>
                    <br><br> This essential resource will help you learn the most important chord shapes, chord variations, and scales in EVERY key.
                    <br><br> Regular ${{ floatval($productPrices['piano-chords-and-scales-guide']->price) }}. It’s yours FREE when you get Easy Chords. (And we’ll cover the shipping.)
                    <br><br>
                </p>
            </div>
            <div class="flex-1 relative sm:w-2/3 md:w-auto mx-auto text-center sm:pl-10">
                <div class="relative md:max-w-md mx-auto">
                    <img
                        class="md:absolute md:w-full h-80 md:h-auto md:left-0 -top-10 lg:-top-20 scales-book cursor-pointer z-50 transition-all opacity-0"
                        src="https://pianote.s3.amazonaws.com/products/the-power-of-chords/piano_scales_book.png"
                        alt="scales book" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                <div class="text-center lg:text-left w-full lg:w-1/3 mb-7 lg:mb-0 relative">
                    <img class="h-20 md:h-24 lg:h-28 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h4 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5"><strong>
                            20 Guided Play-Along Lessons.<br>
                            Feedback From Real Teachers.<br>
                            Lifetime Course Access.
                        </strong></h4>
                    <div class="w-full mx-auto sm:mx-0">
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Master your chord changes & inversions.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Course runs June 5 to July 5.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i>  Choose your best option to get started.</p>
                    </div>
                </div>

                <div class="flex flex-wrap sm:flex-nowrap max-w-xs sm:max-w-full items-center text-left w-full mx-auto lg:w-2/3 lg:pl-5 xl:pl-10">
                    <a href="/ecommerce/add-to-cart?products[easy-chords]=1&products[piano-chords-and-scales-guide]=1&locked=true"
                        class="z-10 relative px-5 sm:px-7 py-7 sm:py-9 mb-7 sm:mb-0 bg-white rounded-xl shadow-lg w-full sm:w-5/12">
                        <p class="border border-pianote text-pianote inline-block rounded-xl text-xs mb-2 px-4 tracking-wider">EARLY BIRD BUNDLE</p>
                        <h3><strong>Easy Chords</strong></h3>
                        <p class="text-sm mt-2 mb-5">Play better piano in just 30 days.</p>
                        <h2 class="inline-block"><strong class="text-4xl">${{ 97 }}</strong></h2> <p class="inline-block text-xs">One time payment.</p><br>
                        <div class="join blue smaller my-4 w-full">ENROLL NOW</div>
                        <ul class="list-disc ml-6">
                            <li class="text-sm relaxed"><span class="text-pianote">Free</span> Chords & Scales Book</li>
                            <li class="text-sm relaxed"><span class="text-pianote">Free bonus ends<br class="hidden sm:inline">  in
                                    <span x-cloak x-data="timer2()" x-init="countdown2()">
                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
{{--                                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
                                        {{--                                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                 </span>
                                    </span></li>

                        </ul>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                            <i class="fas fa-check text-pianote mr-1"></i> Lifetime Course Access<br>
                            <i class="fas fa-check text-pianote mr-1"></i> 90-Day Money Back Guarantee</p>
                    </a>
                    <a href="/ecommerce/add-to-cart?product-array=PIANOTE-MEMBERSHIP-1-YEAR:1,easy-chords:1,piano-chords-and-scales-guide:1,poster-chords:1,poster-scales:1,pianote-practice-planner:1,100-days-of-practice-poster:1,the-power-of-chords:1,piano-riffs-and-fills:1&redirect=/order&locked=true&promo-code=special"
                        class="px-5 sm:px-10 py-7 sm:py-11 sm:-ml-5  rounded-xl shadow-lg w-full sm:w-7/12 bg-center bg-cover border-4 border-white"
                        style="background-color:#dde9f9;background-image:url(https://www.musora.com/musora-cdn/image/width=380,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/order-bg.jpg);"
                    >
                        <p class="border border-pianote text-pianote inline-block rounded-xl text-xs mb-2 px-4 tracking-wider">LAUNCH MEMBERSHIP SPECIAL</p>
                        <h3><strong>Join Pianote + Get <br class="hidden sm:inline"> Easy Chords FREE</strong></h3>
                        <p class="text-sm mt-2 mb-5">The Ultimate Online Lessons Experience.</p>
                        <h2 class="inline-block"><s class="opacity-40">$240</s> <strong class="text-4xl">$200</strong></h2> <p class="inline-block text-xs">Billed annually.</p><br>
                        <div class="join blue smaller my-4 w-full">GET EVERYTHING</div>
                        <ul class="list-disc ml-6">
                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Chords & Scales Book</li>
                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Chords & Scales Posters</li>
                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Pianote Practice Planner</li>
                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> 100 Days of Practice Poster</li>
                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> The Power of Chords</li>
                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Piano Riffs & Fills</li>
                        </ul>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                            <i class="fas fa-check text-pianote mr-1"></i> Lifetime Course Access<br>
                            <i class="fas fa-check text-pianote mr-1"></i> 90-Day Money Back Guarantee</p>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Why do I need to register if I get it for free as a member?",
                "desc" => "It’s a 30-day course and it only works if you’re actively participating. So we wanted to make sure you raised your hand to enroll in the journey.<br><br>This isn’t a “watch a lesson, go do something else for 10 days, watch another” type of routine. So we’re asking for a commitment from anybody who participates.",
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What if I miss a day (or two)?",
                "desc" => "That’s totally fine. The course is meant to be flexible if you miss a day here or there. There are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session if you ever need to catch up.",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "Do I need a digital piano or software?",
                "desc" => "No! This course works with all pianos and keyboards. You don’t have to plug anything in and you don't need any fancy plugins or software. Simply click play on your lesson, and follow along!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "How much time per week will this course require?",
                "desc" => "Easy Chords gives you guided daily piano lessons for thirty days – with a few flex days built in for when life happens. Each lesson is only 10 minutes. We’ve made it short so you’re more likely to keep playing!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "Easy Chords is available on your laptop, tablet, or phone. You’ll also have access through the Musora App after you’ve completed your purchase of the course.",
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

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "dayOne",
        "video" => '//player.vimeo.com/video/823805392?h=bbd23aa655&autoplay=1',
        "title" => 'dayOne'
    ])
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "dayThirty",
        "video" => '//player.vimeo.com/video/823805719?h=722d7f7336&autoplay=1',
        "title" => 'dayThirty'
    ])
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "demoVid",
        "video" => '//player.vimeo.com/video/823806000?h=457fb12951&autoplay=1',
        "title" => 'demoVid'
    ])
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/823788317?h=b2955e3bc7&autoplay=1',
        "title" => 'trailer'
    ])
    @foreach ($modalImages as $key => $img)
        @include('pianote.products.partials.image-modal',[
            'id' => "seeInside".$key,
            "image" => $img,
            "imageName" => "seeInside".$key,
        ])
    @endforeach

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-06-05 00:00:00',
        'promoVersion' => false
    ])
    <script>
        function timer2(){
            return {
                day: '00',
                dayText: ' days',
                hour: '00',
                hourText: ' hours',
                minute: '00',
                minuteText: ' minutes',
                second: '00',
                secondText: ' seconds',
                endTime: new Date('2023-05-22 00:00:00').getTime(),
                startTime: new Date().getTime(),
                timeLeft: 0,
                smallScreen: false,
                countdown2: function (){
                    let _this = this;
                    this.startTime = new Date().getTime();
                    this.timeLeft = (this.endTime - this.startTime) / 1000;

                    this.startTime = new Date().getTime();
                    this.timeLeft = (this.endTime - this.startTime) / 1000;
                    this.day = this.formatTime(this.timeLeft / (60 * 60 * 24));
                    this.hour = this.formatTime(this.timeLeft / (60 * 60)) % 24;
                    this.minute = this.formatTime(this.timeLeft / 60) % 60;
                    this.second = this.formatTime(this.timeLeft % 60);

                    if ( !this.smallScreen ){
                        this.dayText = formatText(this.day, ' days');
                        this.hourText = formatText(this.hour, ' hours');
                        this.minuteText = formatText(this.minute, ' minutes');
                        this.secondText = formatText(this.second, ' seconds');
                    }

                    if(this.timeLeft > 0){
                        setInterval(() => {
                            this.startTime = new Date().getTime();
                            this.timeLeft = (this.endTime - this.startTime) / 1000;
                            this.day = this.formatTime(this.timeLeft / (60 * 60 * 24));
                            this.hour = this.formatTime(this.timeLeft / (60 * 60)) % 24;
                            this.minute = this.formatTime(this.timeLeft / 60) % 60;
                            this.second = this.formatTime(this.timeLeft % 60);

                            if ( !this.smallScreen ){
                                this.dayText = formatText(this.day, ' days');
                                this.hourText = formatText(this.hour, ' hours');
                                this.minuteText = formatText(this.minute, ' minutes');
                                this.secondText = formatText(this.second, ' seconds');
                            }

                        }, 1000);
                    }

                    const bodyWidth = window.innerWidth;

                    if ( bodyWidth < 768 ){
                        this.dayText = 'D';
                        this.hourText = 'H';
                        this.minuteText = 'M';
                        this.secondText = 'S';
                        this.smallScreen = true;
                    }

                    window.addEventListener('resize', function(event){
                        const bodyWidth = window.innerWidth;

                        if ( bodyWidth < 768 ){
                            _this.smallScreen = true;
                            _this.dayText = 'D';
                            _this.hourText = 'H';
                            _this.minuteText = 'M';
                            _this.secondText = 'S';
                        }
                        else {
                            _this.smallScreen = false;
                            _this.dayText = ' days';
                            _this.hourText = ' hours';
                            _this.minuteText = ' minutes';
                            _this.secondText = ' seconds';
                        }
                    });
                },
                formatTime: function (value){
                    return Math.floor(value);
                },
            }
        }
    </script>
    @include("pianote.sales.partials._footer")

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

            // var showModal = location.search.substr(1).includes('member-email');
            //
            // if (showModal) {
            //     $('#loginModal').foundation('open');
            // }
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
