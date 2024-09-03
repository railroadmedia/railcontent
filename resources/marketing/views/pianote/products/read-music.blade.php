@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Read Music in 30 Days | Pianote</title>
    <meta property="og:title" content="Read Music in 30 Days | Pianote">
    <meta name="description" content="Learn the language of music with daily guided workouts.">
    <meta property="og:description" content="Learn the language of music with daily guided workouts.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/products/read-music-in-30-days/share-image-read-music.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        [placeholder]:focus::-webkit-input-placeholder {
            color: transparent
        }

        form ::-webkit-input-placeholder,
        form ::-moz-placeholder,
        form :-ms-input-placeholder,
        form :-moz-placeholder {
            color: #777
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

        form input,
        form button {
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }

        @media (min-width: 768px) {

            form input,
            form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }

        form input[type="submit"],
        form button[type="submit"],
        form input button,
        form button button {
            font-family: 'Bebas Neue', sans-serif;
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

        form input[type="submit"]:hover,
        form button[type="submit"]:hover,
        form input button:hover,
        form button button:hover {
            background: #F61A30;
        }

        .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }

        .thank-you-box {
            width: 100%;
            max-width: 960px;
            border-radius: 5px;
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .4s ease-in;
            display: block;
            margin: 0 auto;
            background: #FFF;
            text-align: center;
            overflow: hidden;
            color: #000
        }

        .thank-you-box.active {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            padding: 15px
        }

        @media (min-width:40em) {
            .thank-you-box.active {
                padding: 20px
            }
        }

        @media (min-width:64em) {
            .thank-you-box.active {
                padding: 30px
            }
        }

        .thank-you-box p {
            font: 400 15px/1.4em "Open Sans", sans-serif;
            margin: 0 auto
        }

        @media (min-width:40em) {
            .thank-you-box p {
                font-size: 19px
            }
        }

        @media (min-width:64em) {
            .thank-you-box p {
                font-size: 23px
            }
        }

        .thank-you-box p em {
            line-height: 1.4em;
            max-width: 550px;
            display: inline-block;
            font-size: 12px
        }

        @media (min-width:40em) {
            .thank-you-box p em {
                font-size: 14px
            }
        }

        .thank-you-box h2 {
            font: 700 30px/1em "Roboto Condensed", sans-serif;
            margin: 15px auto;
            text-transform: uppercase;
            color: #F61A30;
        }

        @media (min-width:40em) {
            .thank-you-box h2 {
                font-size: 37px;
                margin: 20px auto
            }
        }

        @media (min-width:64em) {
            .thank-you-box h2 {
                font-size: 44px
            }
        }

        .thank-you-box .social-media a {
            background: #000;
            color: #fff;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            margin: 20px 3px 0;
            width: 50px;
            height: 50px;
            line-height: 50px;
            font-size: 26px
        }

        @media (min-width:64em) {
            .thank-you-box .social-media a {
                width: 70px;
                height: 70px;
                line-height: 70px;
                font-size: 35px;
                margin: 25px 10px 0
            }
        }

        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 3px;
            background-color: #F61A30;
            top: 0;
            bottom: 0;
            transform: translate(-50%, 0);
            z-index: 0;
            left: 0;
        }

        .timeline-container .timeline::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            transform: translate(-50%, 0);
            background-color: #F61A30;
            top: 0;
            border-radius: 50%;
            z-index: 1;
            left: -16px;
        }

        @media (min-width: 768px) {
            .timeline-container .timeline::after {
                left: 50%;
            }
        }

        @media (min-width: 768px) {

            .timeline-container::after,
            .timeline::after {
                left: 50%;
            }
        }

        table.comparison tr td:nth-child(2) {
            text-shadow: 1px 1px #F61A30 !important;
            background: linear-gradient(to right, #F61A30, #A10000) !important;

        }
    </style>

@stop()

@section('body-data')
    x-data ="{
    trailer : false,
    trailerM: false,
    lazyLoad: false,
    loadAlternateSrc: function(src) {
        this.$refs.playToLearnVideo.src = src;
    },
    videoLoaded: false,
    waitlistModal: false,
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])
    @include('_partials.components.shop.promo-banner-3', [
        'name' => 'Read Music in 30 Days',
        'fullPrice' => floatval($productPrices['read-music-in-30-days']->price),
        'price' => floatval($productPrices['read-music-in-30-days']->discounted_price),
        'noBreadcrumb' => true,
    ])
    @php
        if (
            !empty($products['read-music-in-30-days-workbook']->getStockAvailability()) &&
            $products['read-music-in-30-days-workbook']->getStockAvailability() > 250
        ) {
            $stock = $products['read-music-in-30-days-workbook']->getStockAvailability() - 250;
        } else {
            $stock = 'a limited amount';
        }

        $startDateCourse = Carbon\Carbon::create(2024, 7, 1, 0, 0, 0, 'America/Vancouver');
        $startDateCourse = $startDateCourse->format('F jS');
        $endDateCourse = Carbon\Carbon::create(2024, 7, 30, 0, 0, 0, 'America/Vancouver');
        $endDateCourse = $endDateCourse->format('F jS');
        $earlyBirdStart = Carbon\Carbon::create(2024, 6, 13, 0, 0, 0, 'America/Vancouver');
        $earlyBirdEnd = Carbon\Carbon::create(2024, 6, 24, 0, 0, 0, 'America/Vancouver');
        $course = 'Read Music in 30 Days';
    @endphp

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 lg:h-24 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/read-music-in-30-days/RMI30D-dark.webp"
                        alt="Read music Logo">
                    @php
                        $lines = [
                            'Learn the language of music',
                            'Read & play your favorite songs',
                            'Transform your playing',
                        ];
                    @endphp
                    <h2 class="text-3xl sm:text-xl md:text-2xl lg:text-3xl rotater-text overflow-hidden">
                        <strong>
                            @foreach (range(1, 5) as $i)
                                @foreach ($lines as $line)
                                    <span class="relative nowrap delay-1000 ease-in-out">{{ $line }}</span><br>
                                @endforeach
                            @endforeach
                        </strong>
                    </h2>
                    <h3 class="-mt-2 sm:-mt-1 lg:mt-0">with daily guided workouts.</h3>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever class <br
                                class="inline lg:hidden">starting {{ $startDateCourse }}.</strong></h6>

                    <div class="mt-4 mb-3 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/header2.png');"
                        x-on:click="trailer = true;">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer
                        </div>
                    </div>

                    @php
                        $items = ['Play With Real Music', 'Play Every Day', 'Lifetime Access'];
                    @endphp
                    <p class="hidden lg:inline">
                        @foreach ($items as $item)
                            <i class="ml-2 fas fa-check text-pianote"></i> {{ $item }}
                        @endforeach
                    </p>

                    <div class="flex inline lg:hidden">
                        @foreach ($items as $item)
                            <p class="w-1/3 leading-tight">
                                <i class="fas fa-check-circle text-pianote"></i><br>
                                @php
                                    $words = explode(' ', $item);
                                    $words[1] = $words[1] . '<br>';
                                    $itemWithBreak = implode(' ', $words);
                                @endphp
                                {!! $itemWithBreak !!}
                            </p>
                        @endforeach
                    </div>
                    <!-- @if (session()->has('success-message'))
                        <p class="mb-3 lg:-mb-7 mt-3 text-pianote text-center"><strong>Congrats! You have registered for
                                {{ $course }}.<br class="hidden md:inline"> Check your email for the details.</strong>
                        </p>
                    @endif -->

                    <div class="flex flex-wrap items-left sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            <a href="#final" class="@if($startDateCourse > Carbon\Carbon::now()) sold-out @else bg-pianote @endif join medium w-full anchor-slide">@if($startDateCourse > Carbon\Carbon::now()) ENROLLMENT CLOSED @else ENROLL NOW @endif</a>
                        </div>
                        <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png"
                                alt="Image of joined student profiles in read music in 30 days">
                            <p class="inline-block leading-tight text-sm align-middle">Join
                            {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/header2.png');"
                        x-on:click="trailer = true;">
                        <div class="join white smaller absolute {{-- bottom-1 --}} bottom-2 left-1"><i
                                class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div
                class="flex flex-wrap md:flex-nowrap text-center border rounded-lg border-gray-300 mt-6 lg:mt-8 mb-2 lg:mb-4">
                <div class="w-full md:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 md:py-3 lg:py-4">
                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5 text-2xl"><strong>{{ $startDateCourse }}</strong></h4>
                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">
                        <p class="text-sm px-3 lg:px-5">
                            <span class="text-pianote" x-cloak x-data="timer()" x-init="countdown()">
                                <strong>
                                    <span x-cloak x-show="timeLeft > 0">
                                     <span class="text-black">   Enrollment closes in </span>
                                        <br>
                                        <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                        <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                        <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                        <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                                    </span>
                                    <span x-cloak x-show="timeLeft < 0"> A Limited Time! </span>
                                </strong>
                            </span>
                        </p>
                </div>
                <div
                    class="flex flex-wrap md:flex-nowrap items-center justify-evenly w-full md:w-auto md:flex-grow py-4 md:py-3 lg:py-4 text-left md:text-center">
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> {{ $startDateCourse }} to<br class="hidden md:inline">
                                {{ $endDateCourse }}.</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Read sheet music.<br> Play real songs.</span>
                        </p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden">
                    PLUS you get lifetime access!</em></p>
        </div>
    </header>

    <section class="bg-top bg-cover"
        style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/read-this-section-bg.webp');">
        <div class="flex flex-col container max-w-4xl mx-auto py-10 md:py-20">
            <div class="w-full flex flex-col justify-center  px-4">
                <!-- <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/sheet-music.webp"
                    alt="Sheet Music" class="w-full text-center px-6"> -->

                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/header-arrow.svg"
                    alt="Sheet Music" class="w-full pl-8 md:pl-14">
                    <video class="rounded-xl w-full h-full"
                            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/read-music-in-30-days/sheet-music.mp4"
                            type="video/mp4"
                            autoplay
                            muted
                            loop
                            playsinline
                            preload="auto"></video>
            </div>
            @php
                $content = [
                    [
                        'class' => 'w-full md:w-1/2 pr-6',
                        'sentences' => [
                            'Sheet music can be intimidating and overwhelming.',
                            'Does this sound familiar?',
                            '<em>“I can’t make sense of the notes I see on the page.”</em>',
                            '<em>“It felt too difficult to learn, so I gave up.”</em>',
                            "<em>“I don't want to spend years learning to read music before I can play music.”</em>",
                            'Music is a language. And learning to read music is like learning another language. But once you know how…',
                            '<strong>An entire world of possibilities will open before you.</strong>',
                        ],
                    ],
                    [
                        'class' => 'w-full md:w-1/2',
                        'sentences' => [
                            'You can play beautiful music (like this one) without having to spend hours memorizing each and every note. You won’t have to watch YouTube tutorials and follow someone’s hands.',
                            'If you’ve always wanted to read music, but felt like it was “too hard” or you weren’t “good enough”, then you need to enroll in Read Music in 30 Days.',
                            'This course is an immersive experience where you’ll learn to read music <strong> by playing music.</strong>',
                            'Through daily practice and repetition, you’ll start to understand the notes on the page. And you’ll be able to translate them to the keys on your piano.',
                            'Keep scrolling to see how it works.',
                        ],
                    ],
                ];
            @endphp

            <div class="w-full md:flex md:flex-row p-6 text-black">
                @foreach ($content as $item)
                    <div class="{{ $item['class'] }}">
                        @foreach ($item['sentences'] as $sentence)
                            <p class="py-2 md:py-3">{!! $sentence !!}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:pt-14 lg:pt-20" style="background-color:#F1F7FE;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>Learn to Read Music… <br class="block md:hidden" />By PLAYING Music</strong>
            </h2>
            <p class="mb-7 sm:mb-12">Connect the notes on the page to the keys on your piano with expert play-along
                lessons.</p>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/feature-01.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Reading music is like learning a language. And just like learning a language, you need to know where to start. Read Music in 30 Days starts from the beginning, and gradually progresses each day. Just follow along.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/feature-02.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Life’s busy. And it’s hard to fit practice between work, school, and family. That’s why Read Music in 30 Days is designed to fit any schedule (even yours). You only need 10 minutes per day.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/feature-03.webp',
                        'title' => 'Practice with a REAL teacher.',
                        'desc' =>
                            'This isn’t a textbook. And these aren’t videos where you watch someone else do the work. Each day you’ll be playing and practicing WITH Lisa. And you can ask her any questions during the weekly Q&A.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/feature-04.webp',
                        'title' => 'Lifetime access.',
                        'desc' =>
                            'Read Music in 30 Days is yours for life. That means you can return to your favorite workouts over and over. It also means you can work through it at your own pace.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/feature-05.webp',
                        'title' => 'BONUS Companion Book to keep improving.',
                        'desc' =>
                            $earlyBirdEnd < Carbon\Carbon::now()
                                ? 'Practice makes you better. So you’ll get a FREE 74-page Companion E-Book to help you through the Challenge and bonus exercises to cement the new skills you’ll learn.'
                                : 'Practice makes you better. So you’ll get a FREE 74-page Companion Book when you enroll before June 23rd to help you through the Challenge and bonus exercises to cement the new skills you’ll learn.',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 mt-20">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div
                            class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== 4) mb-16 md:mb-20 @else md:mb-0 @endif">
                            @if (empty($getting['special']))
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                    alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                    style="background-image:url('{{ $getting['img'] }}')"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0 md:mb-10">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <h1 class="leading-none -mt-8 mb-8"><i class="fal fa-angle-down text-pianote hidden md:block"></i></h1>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #FFFFFF">
        <div class="container max-w-4xl mx-auto">
            @php
                $items = [
                    'Daily guided piano workouts',
                    'Weekly Q&A workshops',
                    'Flexible weekly schedule',
                    'Ongoing motivation & support',
                    'Guaranteed results',
                ];
            @endphp

            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-16 sm:h-24 lg:h-32 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/read-music-in-30-days/RMI30D-dark.webp"
                    alt="30-Day Independence Logo">
                <h4 class="leading-loose text-left pt-4 sm:pt-0">
                    @foreach ($items as $item)
                        <i class="fas fa-check text-pianote mr-5"></i> {!! $item !!}<br>
                    @endforeach
                </h4>
            </div>
        </div>

        {{-- <span class="join sold-out medium w-full max-w-xs align-middle my-10" @click="waitlistModal = true;">JOIN WAITLIST</span> --}}

        @if ($startDateCourse > Carbon\Carbon::now())
            <span class="join sold-out medium w-full max-w-xs align-middle my-10">ENROLLMENT CLOSED</span>
        @else
            <span href="#final" class="join bg-pianote medium w-full max-w-xs align-middle my-10 anchor-slide">ENROLL NOW</span>
        @endif

    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-12 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/marketing/pianote/products/read-music-in-30-days/phone-screen.webp"
                    alt="Mobile Screen with Read Music">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get support from Lisa <br> every step of the
                            way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your
                        lessons, you can ask Lisa and get an answer at each week’s Q&A event. She will be there to help you
                        through any sticking points and keep you motivated to complete the full course.</h6>
                    <div class="text-center sm:text-left">
                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>JOIN LISA <i
                                    class="fas fa-arrow-down text-pianote mx-2 inline lg:hidden"></i> <i
                                    class="fas fa-arrow-right text-pianote mx-2 hidden lg:inline"></i></strong></h6><br
                            class="inline lg:hidden">

                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong>
                            </p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">6</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong>
                            </p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">13</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong>
                            </p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">20</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong>
                            </p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">27</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14">
                <img class="h-12 sm:h-20 align-bottom transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/RMI30D-dark.webp"
                    alt="Read Music in 30 Days Logo"> <strong>...is perfect for: </strong>
            </h2>

            @php
                $players = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/Beginner.webp',
                        'title' => 'Beginner<br> Piano Players',
                        'description' =>
                            'You’re just starting and you want to read music to play your favorite songs. We’ve got you covered. This course is designed with you in mind.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/Returning.webp',
                        'title' => 'Returning<br> Piano Players',
                        'description' =>
                            'You’ve played a bit and maybe know some basics, but you’re a little rusty. Read Music in 30 Days will get you back up to speed (and beyond) in no time. ',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/Play-by-ear.webp',
                        'title' => '“Play by Ear”<br> Piano Players',
                        'description' =>
                            'You love to play by ear, but don’t know how to read music? Connect the melodies in your head to the notes on the page and become a more rounded piano player. ',
                    ],
                ];
            @endphp

            <div class="flex flex-col sm:flex-row text-left justify-center">
                @foreach ($players as $player)
                    <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                        <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                            style="background-image:url('{{ $player['image'] }}'); object-position: 60% 0">
                            <h5 class="leading-tight absolute bottom-1 w-full z-10"><strong><img
                                        class="h-8 transition-opacity opacity-0" loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/tick-icon.svg"
                                        alt="plus icon"><br>{!!  $player['title']  !!}</strong></h5>
                            <div class="absolute inset-0 z-0"
                                style="background:linear-gradient(to bottom, transparent 30%, rgba(0,0,0,0.4));"></div>
                        </div>
                        <p class="leading-normal mt-3">{{ $player['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="max-w-3xl mx-auto md:pl-10 pb-10 sm:pb-14 md:pb-0">
                <h2 class="mt-10 lg:mt-24"><strong>The Better Way to Read Music.</strong></h2>
                <h6 class="leading-normal italic text-pianote pt-4 md:pt-6">You can’t get this anywhere else.</h6>
                <p class="py-4 md:py-6">Traditional lessons only happen once a week. Those old workbooks have nobody to ask
                    for help. And online courses don’t help you practice. Read Music in 30 Days is the better way.</p>
            </div>


            <div class="relative">
                <p
                    class="inline md:hidden leading-none text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower pt-2 text-black">
                    <strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong>
                </p>
                <table id="comparison-table"
                    class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private table-wrapper">
                    <tbody>
                        <tr style="background-color:transparent!important;">
                            <td></td>
                            <td class="rounded-t-xl bg-pianote"><img class="h-8 sm:h-14 transition-opacity opacity-0"
                                    loading="lazy" onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/RMI30D-light.webp"
                                    alt="Read Music in 30 Days Logo"></td>
                            <td class="cursor-pointer sm:cursor-default"><strong>Private <br> Lessons</strong></td>
                            <td class="cursor-pointer sm:cursor-default"><strong>Online<br> Courses</strong>
                            </td>
                            <td class="cursor-pointer sm:cursor-default rounded-tr-xl"><strong>Piano<br> Books</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Style</td>
                            <td>20 Play-Along Lessons</td>
                            <td>In-Person</td>
                            <td>Self-Directed</td>
                            <td>Self-Directed</td>
                        </tr>
                        <tr>
                            <td>Teacher Support</td>
                            <td>Yes</td>
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
                            <td>Total Investment</td>
                            <td class="rounded-b-xl">
                                <strong>${{ floatval($productPrices['read-music-in-30-days']->discounted_price) }}</strong><br>
                                <span class="text-xs">Single Payment</span>
                            </td>
                            <td class="rounded-bl-xl"><strong>$50-$100</strong><br> <span class="text-xs">For A Single
                                    Lesson</span></td>
                            <td><strong>$89-$270+</strong><br>&nbsp;</td>
                            <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section style="background: #EFF7FF" class="px-5 sm:px-8 py-8 sm:py-12 lg:py-16 text-center">
        <div class="container max-w-5xl mx-auto mb-10">
            <h6 class="uppercase leading-relaxed text-pianote">READ MUSIC IN 30 DAYS</h6>
            <h1 class="uppercase leading-relaxed md:pb-4"><strong>JUST PRESS PLAY</strong></h1>
            <!-- <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                        x-on:click="window.innerWidth <= 640 ? trailerM = true : trailer = true;">
                        <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                        <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                            x-ref="playToLearnVideo"
                            x-on:error="loadAlternateSrc('')"
                            x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                            x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                            poster="https://i.vimeocdn.com/video/1828301259-c092a2a94d0b5008ba1042a1dd0a4f8f7289dac5a9ba14bc19a17e5a679b07d0-d?mw=2700&mh=1519&q=70"
                            data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/press-play-logo.svg"
                            type="video/mp4"
                            autoplay
                            muted
                            loop
                            playsinline
                            preload="auto"></video>
                    </div> -->

            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/trailer-thumb2.png"
                alt="Read Music in 30 Days Trailer Thumbnail" class="w-full cursor-pointer autoplay-video"
                x-on:click="trailer = true"
            >

        </div>
    </section>

    <section class="bg-top bg-cover pb-10 md:py-10"
        style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/book-bg.webp');">
        <div class="container max-w-6xl mx-auto mb-14 lg:mb-16 text-white">
            <div class="flex flex-col container max-w-5xl mx-auto px-4">
                <div class="flex flex-col-reverse md:flex-row items-center w-full lg:pt-10">
                    <div class="w-full md:w-7/12 lg:w-1/2 text-justify px-6 lg:px-6">
                        <h3 class="leading-tight mb-3 sm:mb-5"><strong>The key to reading music… <br class="hidden md:block">in your hands!</strong></h3>
                        <p class="leading-normal">Read Music in 30 Days is an online Challenge that will have you reading and playing music each
                            day. <br><br>
                            Enroll before June 23rd and you’ll also get the Read Music in 30 Days Companion Book for FREE. <br><br>
                            This 74-page book has every exercise used in the course PLUS a reference guide, practice notes
                            for
                            each day, and a ton of bonus sight-reading exercises.  <br><br>
                            It’s the perfect companion to the course, and it’s yours FREE. <br><br>
                            <span><strong>But you must enroll before June 23 to have the best chance of getting the book
                                    before
                                    the Challenge starts.</strong></span> <br><br>
                            Or -- choose the Annual Membership and you’ll get the book along with 7 other bonuses ($364
                            value).
                        </p>
                    </div>
                    <div class="flex w-full md:w-5/12 lg:w-1/2 p-10 md:p-0">
                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/book.webp"
                        alt="Read Music in 30 Days Book"
                        class="md:pl-10">
{{--                        cursor-pointer transition-transform duration-300 transform hover:scale-105--}}

                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #d70b3b calc(50% + 1px));">
    </div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background:linear-gradient(to bottom, #d70b3b, #9d1032);">
        <div class="container max-w-2xl mx-auto">
            <div class="-mt-14 sm:-mt-20 lg:-mt-28 mb-7">
                <img class="block h-20 sm:h-24 mx-auto animated infinite bounce slower transition-opacity opacity-0"
                    loading="lazy" onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Important_Icon.svg"
                    alt="important icon">
            </div>
            <h1 class="font-bebas text-5xl sm:text-6xl lg:text-7xl">FAIR WARNING</h1>
            <h6 class="leading-normal  mt-4">Read Music in 30 Days is a daily guided workout program for piano players.
                You’ll unlock a new video each weekday and get questions answered each weekend. Because of this, you won’t
                be able to join halfway. — <strong>and you need to register before the course begins on
                    {{ $startDateCourse }}.</strong></h6>
                    <h4 class="mt-8 py-1.5 w-full font-bebas uppercase inline-block mx-auto" style="background-color:#fd5;color:#9d1032;">
                        <span x-cloak x-data="timer()" x-init="countdown()">
                            <span x-cloak x-show="timeLeft > 0">REGISTRATION CLOSES IN <br class="block md:hidden"></span>
                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                            <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                            <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                        </span>
                    </h4>
        </div>
    </section>

    <section class="text-center px-2 sm:px-6 pt-10 sm:pt-14 lg:pt-20 pb-32 lg:pb-40" style="background-color:#f4f8fb;">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
            <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/coach-profile.webp">
                <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/coach-profile.webp"
                    loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                    style="width: 130%;transform: translate(-44%, -7%);"
                    src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                    alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>

            <div class="text-white text-left z-10 rounded-2xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-3xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                style="background-color:#00101d;">
                <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                <h6 class="leading-normal mt-4 lg:mt-6">I have a confession.
                    <br><br>
                    I’m not great at reading music. As a student I struggled to connect the lines, spaces, and dots on the
                    page to the black and white keys on my piano. I even had to repeat a grade.
                    <br><br>
                    But that all changed when I discovered the techniques to make reading music accessible, enjoyable, and,
                    yes, even easy.
                    <br><br>
                    And that’s what I’m going to show you in Read Music in 30 Days.
                    <br><br>
                    This isn’t about memorizing acronyms or ledger lines. It’s about seeing patterns and intervals in the
                    music so you can spend less time trying to read music.<br><br>
                    Chords gave me the ability and confidence to do what we all dream of doing…
                    <br><br>
                    And more time playing it.
                </h6>
                <div class="text-right">
                    <img class="h-16 lg:h-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/lisa-witt-signature.svg"
                        alt="Lisa Witt Signature">
                </div>
            </div>
        </div>

        <div id="testimonials" class="anchor"></div>
        <div class="py-10 sm:py-14 md:py-20" style="background-color:#f4f8fb;">
            <div class="container max-w-6xl mx-auto">
                <h3 class="leading-tight text-black py-4 md:py-6 text-center"><strong>What students are saying<br class="sm:hidden"> about Lisa:</strong></h3>

                <div x-data="{ splide: null }" x-init="splide = new Splide($refs.splide, {  classes: {
                    arrow: 'hidden',
                    prev: 'hidden',
                    next: 'hidden',
                    pagination: 'hidden',
                },
                perPage: 1.5,
                perMove: 1,
                autoplay: true,
                gap: '1rem',
                type: 'loop',
                focus: 0,
                interval: 3000,
                drag: 'free',
                snap: false,
                lazyLoad: 'nearby',}).mount()">

                <div x-ref="splide" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @php
                                    $testimonials = [
                                        [
                                            'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/lynda-burton.webp',
                                            'title' => 'I’m learning to read sheet music quicker than I ever did…',
                                            'content' => 'I’ve taken piano lessons in the past, but not recently. I thought I’d give Pianote a try, and I’m glad I decided to. <br><br> I’m learning to read sheet music quicker than I ever did while taking private piano lessons.',
                                            'name' => 'Lynda Burton',
                                            'location' => 'WYOMING, USA',
                                        ],
                                        [
                                            'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/products/read-music-in-30-days/paul-bucci.webp',
                                            'title' => 'It’s like sitting down with a friend who’s teaching me how to play…',
                                            'content' => 'I’d been self-taught but hit a wall and wasn’t progressing anymore, so I decided to try Pianote. <br><br> It’s like sitting down with a friend who’s teaching me how to play while explaining the logic behind what they’re doing. The lessons are well thought out and I can do this all on my own schedule.',
                                            'name' => 'Paul Bucci',
                                            'location' => 'DUXBURY, MASSACHUSETTS USA',
                                        ],
                                        [
                                            'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/steve-wilson.webp',
                                            'title' => 'I love the 30-day courses.',
                                            'content' => "The courses where you can start out five days a week, it's 10 minutes long, and you follow along for 10 minutes. The instructor's there with you and you're able to follow along just for 10 minutes every day. Those are extremely helpful for me in building some of that routine and confidence and really mastering building on what we did yesterday.",
                                            'name' => 'Steve Wilcon',
                                            'location' => 'ARIZONA, USA',
                                        ],
                                    ];
                                @endphp
                                @foreach ($testimonials as $testimonial)
                                    <li class="splide__slide flex items-start sm:items-stretch px-1 hover:cursor-pointer">
                                        <div class="w-full rounded-xl p-6 text-black flex flex-wrap sm:flex-nowrap transition-colors duration-300 active-bg" style="background-color:#ffffff;">
                                            <div class="flex flex-col justify-evenly text-left sm:px-8">
                                                <h4 class="leading-normal mt-3 sm:mt-0 mb-3 mx-0">
                                                    <strong><em>"{!! $testimonial['title'] !!}"</em></strong>
                                                </h4>
                                                <p class="leading-normal mt-3 sm:mt-0 mb-20"><em>{!! $testimonial['content'] !!}</em></p>

                                                <div class="flex items-center">
                                                    @if (!empty($testimonial['avatar']))
                                                        <img class="h-16 lg:h-20 w-16 lg:w-20 rounded-full object-cover mr-4 border-2 border-white opacity-0 transition-opacity"
                                                            loading="lazy" onload="this.classList.remove('opacity-0')"
                                                            alt="Avatar" src="{{ $testimonial['avatar'] }}">
                                                    @endif
                                                    <div>
                                                        <p class="leading-tight mx-0 font-black">{{ $testimonial['name'] }}</p>
                                                        @if (!empty($testimonial['location']))
                                                            <p class="leading-tight mx-0 text-sm text-gray-600">
                                                                <em>{{ $testimonial['location'] }}</em>
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto text-center flex flex-col content-center items-center w-full">

        @if ($startDateCourse > Carbon\Carbon::now())
            <span class="join sold-out medium w-full max-w-xs align-middle">ENROLLMENT CLOSED</span>
        @else
            <span href="#final" class="join bg-pianote medium w-full max-w-xs align-middle anchor-slide">ENROLL NOW</span>
        @endif

            <div class="pt-4">
                <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png"
                    alt="Image of joined student profiles in read music in 30 days">
                <p class="inline-block leading-tight text-sm align-middle">Join
                {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.
                </p>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/guarantee.svg"
                alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>The “Read Music”<br class="inline sm:hidden"> Guarantee</strong></h2>

            <h6 class="leading-normal">Read Music in 30 Days is a NEW way to learn to read music. For less than a month of
                private lessons, you’ll frustration-free progress to improve your musical skill and knowledge.

                <br><br>
                We think it’ll be your favorite piano course ever –
                <br><br>
                So even though it’s only a month, you’ll get three full months to go through everything and make sure it’s
                right for you. If not, just contact our friendly support team for a refund.

            </h6>
        </div>
    </section>

    <div id="final" class="anchor"></div>

    <section
        class="flex flex-col md:flex-row text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background-color:#eff7ff;">

        <div class="flex flex-col lg:flex-row container max-w-6xl mx-auto">
            <div class="flex flex-col items-center justify-center w-full lg:w-7/12 text-center lg:text-left">
                <img class="h-16 sm:h-18 lg:h-24 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/pianote/products/read-music-in-30-days/RMI30D-dark.webp"
                    alt="Read music Logo">

                <h5 class="leading-tight mt-4 md: my-4 my-1"><strong>20 Guided Play-Along
                        Lessons. <br>
                        4 Weekly Q&A Sessions. <br>
                        Lifetime Course Access. <br> <span class="text-pianote">BONUS</span>
                        Companion Book.</strong></h5>

                <div class="flex flex-col items-start">
                    @php
                        $items = [
                            'Read music and play the songs you love.',
                            'Join ' . number_format($nPackOwners ?? 0) . ' piano players who<br> have already registered.',
                            'Choose your best option to get started.',
                        ];
                    @endphp
                    @foreach ($items as $item)
                        <div class="flex items-center mb-2">
                            <i class="ml-2 fas fa-check text-pianote"></i>
                            <p class="ml-2">{!! $item !!}</p>
                        </div>
                    @endforeach
                </div>
                @if ($startDateCourse > Carbon\Carbon::now())
                    <span class="join sold-out medium w-full max-w-xs align-middle">ENROLLMENT CLOSED</span>
                @endif

            </div>

            @if ($startDateCourse > Carbon\Carbon::now())

            @else
                <div class="flex flex-wrap sm:flex-nowrap items-center text-left w-full max-w-3xl mx-auto mt-5 lg:mt-0">
                    <a class="px-5 sm:px-7 py-7 sm:py-8 mb-7 sm:mb-0 rounded-xl shadow-lg w-full sm:w-5/12 z-10" style="background: #ffffff;"
                        @if ($earlyBirdEnd < Carbon\Carbon::now())
                            href="/ecommerce/add-to-cart?products[read-music-in-30-days]=1&products[read-music-in-30-days-pdf]=1&locked=true"
                        @else
                            href="/ecommerce/add-to-cart?products[read-music-in-30-days]=1&products[read-music-in-30-days-pdf]=1&products[read-music-in-30-days-workbook]=1&locked=true"
                        @endif
                        >
                    <div class="inline-block px-2 border rounded-xl border-pianote text-pianote text-center my-2">
                        <p class="text-xs px-3 py-1">  @if ($earlyBirdEnd > Carbon\Carbon::now()) EARLY BIRD OFFER @else COURSE ONLY @endif</p>
                    </div>
                    <h3 class="leading-tight"><strong>Read Music in 30 Days</strong></h3>
                    <p class="text-sm mt-2 mb-3">Learn the language of music in just 30 days.</p>
                    <h2 class="inline-block"><strong class="text-4xl">${{ 97 }}</strong></h2>
                    <p class="inline-block text-xs">one time payment.</p><br>
                    <div class="join bg-pianote smaller my-4">ENROLL NOW</div>
                    <ul class="list-disc ml-5">
                        @if ($earlyBirdEnd > Carbon\Carbon::now())<li class="text-sm relaxed"><span class="text-pianote">Bonus</span> Companion  Book</li> @endif
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span>  Companion PDF</li>
                    </ul>
                    <hr class="w-full my-5" style="border-color:#b2cae1">
                    <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                        <i class="fas fa-check text-pianote mr-1"></i> Lifetime Access<br>
                        <i class="fas fa-check text-pianote mr-1"></i> 90-Day Guarantee<br>
                    </p>
                </a>
                <a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[read-music-in-30-days]=1&products[read-music-in-30-days-workbook]=1&products[read-music-in-30-days-pdf]=1&products[read-music-in-30-days-pdf]=1&products[music-theory-posters]=1&products[little-book-arpeggios]=1&products[little-book-chord]=1&products[little-book-hanon]=1&products[taktell-piccolo-metronome]=1&products[piano-riffs-and-fills]=1&locked=true"
                    class="px-5 sm:px-12 py-7 sm:py-10 sm:-ml-5 relative rounded-xl shadow-lg w-full sm:w-7/12 relative" style="background: #D2E8FF80;">
                    <div class="inline-block border rounded-xl bg-musora text-black text-center my-2">
                        <p class="text-xs px-3 py-1 font-black">BEST DEAL</p>
                    </div>
                    <h3 class="leading-tight"><strong>Join Pianote</strong></h3>
                    <p class="text-sm mt-2 mb-3">Step-by-step lessons with world-class teachers and popular songs!</p>
                    <h2 class="inline-block"><strong class="text-4xl">$240</strong></h2>
                    <p class="inline-block text-xs">(Includes $364 in free bonuses)</p><br>
                    <div class="join bg-pianote smaller my-4">GET EVERYTHING</div>
                    <ul class="list-disc ml-5">
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Read Music in 30 Days</li>
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Companion Book</li>
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Companion PDF</li>
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Music Theory Poster Bundle</li>
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Little Book Bundle (3 Books)</li>
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Metronome</li>
                        <li class="text-sm leading-relaxed"><span class="text-pianote">Bonus</span> Piano Riffs & Fills</li>

                    </ul>
                    <hr class="w-full my-5" style="border-color:#b2cae1">
                    <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                        <i class="fas fa-check text-pianote mr-1"></i> Lifetime Course Access<br>
                        <i class="fas fa-check text-pianote mr-1"></i> 90-Day Guarantee<br>
                    </p>
                </a>
            </div>
            @endif
        </div>
    </section>

    <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
        <p class="max-w-3xl px-4 md:px-2 leading-loose">
            <b>Shipping Disclaimer –</b> Your physical
            bonuses may not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is
            up to the shipping gods.
        </p>
    </section>


    <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-white">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-white" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    'title' => 'Do I need to attend the lessons live?',
                    'desc' =>
                        'The weekday workouts are pre-recorded videos you can access on your own schedule. A new lesson is unlocked each weekday. Follow along at a time that works best for you.',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'What if I miss a day (or two, or more)?',
                    'desc' =>
                        'That’s ok! This course is meant to be flexible, and you’ll have 2 buffer days each week to help you catch up.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'How much time per week will this course require?',
                    'desc' =>
                        'Each lesson is just 10 minutes, so the minimum time commitment is less than an hour a week. Of course, with the bonus Companion Book and practices, you could spend more. It’s really up to you.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'Do I need to plug my keyboard into any software (MIDI etc)?',
                    'desc' =>
                        'No. This course doesn’t require any special software or keyboards or cables. You can follow along on any piano or keyboard.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'What devices can I access the course on?',
                    'desc' =>
                        'Read Music in 30 Days is available on your laptop, tablet, or smartphone. You’ll also have access through the Musora app after you’ve completed your enrollment online.',
                    'num' => '?',
                ])
            </div>
        </div>
    </section>

    <div id="healthy" class="anchor"></div>

    @component('_partials.components.modal', ['name' => 'waitlistModal'])
        @slot('content')
            <div
                class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
                <p class="mb-4">Enter your email below to get notified when the <br class="hidden sm:inline">
                    30-Day Independence is announced. </p>
                @include('pianote._partials.sign-up-form', [
                    'recaptchaKey' => $recaptchaKey,
                    'formName' => 'Read Music in 30 Days Waitlist',
                    'formId' => 'Pianote - Engagement - Trigger - Read Music in 30 Days Waitlist - Web Form',
                    'buttonText' => 'Let Me Know ',
                    'stacked' => true,
                    'noSocial' => true,
                ])
            </div>
        @endslot
    @endcomponent
    @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => '952486575',
        'vimeo' => true,
    ])

{{--    @include('_partials.components.video-modal', [--}}
{{--        'name' => 'trailerM',--}}
{{--        'video' => '952486575',--}}
{{--        'vimeo' => true,--}}
{{--        'styles' => 'pb-[177%] bg-white',--}}
{{--    ])--}}

    @include('pianote.sales.partials._footer')

    @include('_partials.components.countdown', [
        'countdownDate' => '2024-07-01 00:00:00',
        'promoVersion' => false,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>




    <script>
        $(document).ready(function() {
            $('.comparison tr td:nth-child(3)').on('click', function() {
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('online');
            });
            $('.comparison tr td:nth-child(4)').on('click', function() {
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('books');
            });
            $('.comparison tr td:nth-child(5)').on('click', function() {
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('private');
            });
        });
    </script>


@stop
