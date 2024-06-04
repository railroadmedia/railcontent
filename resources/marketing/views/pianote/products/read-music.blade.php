@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Read Music in 30 Days | Pianote</title>
    <meta property="og:title" content="Read Music in 30 Days | Pianote">
    <meta name="description" content="Learn the language of music with daily guided workouts.">
    <meta property="og:description" content="Learn the language of music with daily guided workouts.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/30-day-independence/share-image.jpg"
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

        form input[type="submit"]:hover,
        form button[type="submit"]:hover,
        form input button:hover,
        form button button:hover {
            background: #258ff4;
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
            color: #0b76db
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

        /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }

        .splide__arrow svg {
            fill: #0B76DB !important;
        }

        .splide__arrow--next {
            right: -12px;
        }

        @media (min-width: 1140px) {
            .splide__arrow--next {
                right: -100px;
            }
        }
        .translate-x-2 {
            transform: translateX(0.2rem);
        }
        .play-button {
            display: inline-block;
            cursor: pointer;
            outline: none;
            transition: opacity 0.3s;
            color: #fff;
            background: rgba(0, 0, 0, 0.6);
            border: 2px solid #fff;
            border-radius: 200px;
            line-height: 1em;
            font-size: 29px;
            padding: 18px 22px;
        }
        @media (min-width: 768px) {
            .play-button {
                font-size: 35px;
                padding: 22px 27px;
                border-width: 4px;
            }
        }
        @media (min-width: 1024px) {
            .play-button {
                font-size: 39px;
                padding: 25px 30px;
            }
        }
        .play-button:hover {
            opacity: 0.8;
        }
        .play-button.smaller {
            border-width: 2px;
            font-size: 24px;
            padding: 14px 17px;
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
            .timeline-container::after, .timeline::after {
                left: 50%;
            }
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
    @include('_partials.components.shop.promo-banner', [
        'name' => '30-Day Independence',
        'fullPrice' => floatval($productPrices['read-music-in-30-days']->price),
        'price' => floatval($productPrices['read-music-in-30-days']->discounted_price),
        'noBreadcrumb' => true,
    ])
@php
    if(!empty($products['quietpad-estepario']->getStockAvailability()) && $products['quietpad-estepario']->getStockAvailability() > 250) {
        $stock = $products['quietpad-estepario']->getStockAvailability() - 250;
    }
    else {
        $stock = 'a limited amount';
    }
    $startDate = "July 1st";
    $endDate = "July 30th";
    $today = 2024-06-24;
    $changeDate = date("Y") . "-06-23";
@endphp

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp"
                        alt="Read music Logo">
                    @php
                        $lines = ['Learn the language of music', 'Read & play your favorite songs', 'Transform your playing'];
                    @endphp

                    <h2 class="rotater-text overflow-hidden">
                        <strong>
                            @foreach (range(1, 5) as $i)
                                @foreach ($lines as $line)
                                    <span
                                        class="relative nowrap delay-1000 ease-in-out">{{ $line }}</span><br>
                                @endforeach
                            @endforeach
                        </strong>
                    </h2>
                    <h3 class="-mt-3 sm:-mt-1 lg:mt-0">with daily guided workouts.</h3>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever class <br
                                class="inline lg:hidden">starting {{$startDate}}.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video"
                        style="padding-bottom: 63%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/header-thumb.webp');"
                        x-on:click="trailerM = true;">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer
                        </div>
                    </div>

                    @php
                        $items = ['Play With Real Music', 'Play Every Day', 'No theory required'];
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
                    @if (session()->has('success-message'))
                        <p class="mb-3 lg:-mb-7 mt-3 text-pianote text-center"><strong>Congrats! You have registered for
                                30-Day Independence.<br class="hidden md:inline"> Check your email for the details.</strong>
                        </p>
                    @endif

                    <div class="flex flex-wrap items-left sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            <!-- <span class="join sold-out medium w-full">ENROLLMENT CLOSED</span> -->
                            <a href="#final" class="join bg-pianote medium w-full anchor-slide">ENROLL NOW</a>
                           <p class="opacity-50 text-xs mt-2 mb-5 sm:mb-0 hover:text-pianote">
                               <a href="https://www.musora.com/drumeo/enrollment/30-day-drummer">Registration is FREE for
                                   Drumeo Members.</a>
                         </p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                                alt="Image of joined student profiles in 30-Day Independence">
                            <p class="inline-block leading-tight text-sm align-middle">Join
                                {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video"
                        style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/header-thumb.webp');"
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
                    <h4 class="px-3 lg:px-5 text-2xl"><strong>{{$startDate}}.</strong></h4>
{{--                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">--}}
{{--                    <p class="text-sm px-3 lg:px-5">--}}
{{--                    <span class="text-pianote" x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                        <strong>--}}
{{--                            <span x-cloak x-show="timeLeft > 0">--}}
{{--                                Enrollment closes in--}}
{{--                                <br>--}}
{{--                                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                            </span>--}}
{{--                            <span x-cloak x-show="timeLeft < 0"> A Limited Time! </span>--}}
{{--                        </strong>--}}
{{--                    </span>--}}
{{--                    </p>--}}
                </div>
                <div
                    class="flex flex-wrap md:flex-nowrap items-center justify-evenly w-full md:w-auto md:flex-grow py-4 md:py-3 lg:py-4 text-left md:text-center">
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> {{$startDate}} to<br class="hidden md:inline"> {{$endDate}}</span>
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
                            <span class="text-sm">Improve your 4-way <br>  coordination</span>
                        </p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden">
                    PLUS you get lifetime access!</em></p>
        </div>
    </header>

    <section>
        <div class="flex flex-col container max-w-4xl mx-auto">
            <div class="w-full flex flex-col justify-center">
            <h2 class="text-2xl mb-4">Header Text</h2>
                <img src="header-image.jpg" alt="Header Image" class="w-full text-center">
            </div>
            <div class="w-full md:flex md:flex-row p-4">
                <div class="w-full md:w-1/2 pr-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
                </div>
                <div class="w-full md:w-1/2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.</p>
                </div>
            </div>
        </div>
    </section> 

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>Learn to Read Music… <br class="block md:hidden"/>By PLAYING Music</strong></h2>
            <p class="mb-7 sm:mb-12">Connect the notes on the page to the keys on your piano with expert play-along lessons.</p>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/practice.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Reading music is like learning a language. And just like learning a language, you need to know where to start. Read Music in 30 Days starts from the beginning, and gradually progresses each day. Just follow along.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Life’s busy. And it’s hard to fit practice between work, school, and family. That’s why Read Music in 30 Days is designed to fit any schedule (even yours). You only need 10 minutes per day.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/music.webp',
                        'title' => 'Practice with a REAL teacher.',
                        'desc' =>
                            'This isn’t a textbook. And these aren’t videos where you watch someone else do the work. Each day you’ll be playing and practicing WITH Lisa. And you can ask her any questions during the weekly Q&A.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/q%26a.webp',
                        'title' => 'Lifetime access.',
                        'desc' =>
                            'Read Music in 30 Days is yours for life. That means you can return to your favorite workouts over and over. It also means you can work through it at your own pace.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/lifetime.webp',
                        'title' => 'BONUS workbook to keep improving.',
                        'desc' => $today >= $changeDate ? 'Practice makes you better. So you’ll get a FREE 74-page companion E-Book to help you through the Challenge and bonus exercises to cement the new skills you’ll learn.' : 'Practice makes you better. So you’ll get a FREE 74-page companion workbook when you enroll before June 23rd to help you through the Challenge and bonus exercises to cement the new skills you’ll learn.',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 pt-7">
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
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #EFF7FF">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-28 sm:h-36 lg:h-48 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp"
                    alt="30-Day Independence Logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-pianote mr-5"></i> Daily guided piano workouts<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Weekly Q&A workshops<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Guaranteed results
                </h4>
            </div>

{{--                                <a href="#final" class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>--}}
{{--                <a href="#final" class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" x-on:click="waitlistModal = true;">JOIN WAITLIST</a><br>--}}

{{--            <img class="h-7 mr-1 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"--}}
{{--                onload="this.classList.remove('opacity-0')"--}}
{{--                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"--}}
{{--                alt="Image of joined student profiles in 30-Day Independence">--}}
{{--            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join--}}
{{--                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>--}}

        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-12 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/screen.webp"
                    alt="Mobile Screen with 30-Day Independence">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get support from Lisa <br> every step of the way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your lessons, you can ask Lisa and get an answer at each week’s Q&A event. She will be there to help you through any sticking points and keep you motivated to complete the full course.</h6>
                    <div class="text-center sm:text-left">
                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>JOIN LISA <i
                                    class="fas fa-arrow-down text-pianote mx-2 inline lg:hidden"></i> <i
                                    class="fas fa-arrow-right text-pianote mx-2 hidden lg:inline"></i></strong></h6><br
                            class="inline lg:hidden">

                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">6</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">13</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">20</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-pianote">
                                <strong>JULY</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">27</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img
                    class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp"
                    alt="30-Day Independence Logo"> <strong>is perfect for…</strong></h2>

            @php
                $drummers = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/intermediate.webp',
                        'title' => 'Beginner Piano Players',
                        'description' =>
                            'You’re just starting and you want to read music to play your favorite songs. We’ve got you covered. This course is designed with you in mind.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/advanced.webp',
                        'title' => 'Returning Piano Players',
                        'description' =>
                            'You’ve played a bit and maybe know some basics, but you’re a little rusty. Read Music in 30 Days will get you back up to speed (and beyond) in no time. ',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/drumeo/products/30-day-independence/beginner.webp',
                        'title' => '“Play by Ear” Piano Players',
                        'description' =>
                            'You love to play by ear, but don’t know how to read music? Connect the melodies in your head to the notes on the page and become a more rounded piano player. ',
                    ],
                ];
            @endphp

            <div class="flex flex-col sm:flex-row text-left justify-center">
                @foreach ($drummers as $drummer)
                    <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                        <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                            style="background-image:url('{{ $drummer['image'] }}'); object-position: 60% 0">
                            <div class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img
                                        class="h-8 transition-opacity opacity-0" loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/tick-icon.svg"
                                        alt="plus icon"><br>{{ $drummer['title'] }}</strong></div>
                            <div class="absolute inset-0 z-0"
                                style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                        </div>
                        <p class="leading-normal mt-3">{{ $drummer['description'] }}</p>
                    </div>
                @endforeach
            </div>


            <h2 class="mt-10 lg:mt-24"><strong>The Better Way to Read Music.</strong></h2>
            <h6 class="leading-normal italic text-pianote pt-4 md:pt-6">You can’t get this anywhere else.</h6>
            <p class="py-4 md:py-6">Traditional lessons only happen once a week. Those old workbooks have nobody to ask for help. <br/> And online courses don’t help you practice. Read Music in 30 Days is the better way.</p>

            <div class="relative">
                <p
                    class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower">
                    <strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                        <tr style="background-color:transparent!important;">
                            <td></td>
                            <td class="rounded-t-xl"><img class="h-8 sm:h-14 transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/icon-logo-white.webp"
                                    alt="Read Music in 30 Days Logo"></td>
                            <td class="cursor-pointer sm:cursor-default"><strong>Private <br> Lessons</strong></td>
                            <td class="cursor-pointer sm:cursor-default rounded-tr-xl"><strong>Online<br> Courses</strong></td>
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
                                <strong>${{ floatval($productPrices['30-day-drummer-4']->discounted_price) }}</strong><br>
                                <span class="text-xs">Single Payment</span></td>
                            <td class="rounded-bl-xl"><strong>$50-$100</strong><br> <span class="text-xs">For A Single Lesson</span></td>
                            <td><strong>$89-$270+</strong><br>&nbsp;</td>
                            <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section style="background: #EFF7FF" class="px-5 sm:px-8 py-8 sm:py-12 lg:py-16 text-center">
        <div class="container max-w-4xl mx-auto mb-10">
            <h5 class="uppercase leading-relaxed opacity-50 mb-3">No theory. No homework.</h5>
            <img class="w-full sm:max-w-2xl mb-5 sm:mb-10"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/press-play-logo.svg"
                alt="Just Press Play Image" />
            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                x-on:click="window.innerWidth <= 640 ? trailerM = true : trailer = true;">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                    x-ref="playToLearnVideo"
                    x-on:error="loadAlternateSrc('https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/30-day-independence/30-day-independence-silent-reel.mp4')"
                    x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                    x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                    poster="https://i.vimeocdn.com/video/1828301259-c092a2a94d0b5008ba1042a1dd0a4f8f7289dac5a9ba14bc19a17e5a679b07d0-d?mw=2700&mh=1519&q=70"
                    data-src="https://player.vimeo.com/progressive_redirect/playback/931215529/rendition/540p/file.mp4?loc=external&signature=6bb8c33a63099e10ddedf690bf5a125956bb2e296b8f4ea56e5a48396a90ecb8"
                    type="video/mp4"
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="auto"></video>
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
            <h6 class="leading-normal  mt-4">Read Music in 30 Days is a daily guided workout program for piano players. You’ll unlock a new video each weekday and get questions answered each weekend. Because of this, you won’t be able to join halfway. — <strong>and you need to register before the course begins on {{$startDate}}.</strong></h6>
{{--            <h4 class="mt-8 py-1.5 w-full font-bebas uppercase inline-block mx-auto"--}}
{{--                style="background-color:#fd5;color:#9d1032;">--}}
{{--                <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                <span x-cloak x-show="timeLeft > 0">REGISTRATION CLOSES IN <br>--}}
{{--                </span>--}}
{{--                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                    <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                <span x-cloak x-show="timeLeft < 0">A Limited Time</span>--}}
{{--                </span>--}}
{{--            </h4>--}}
        </div>
    </section>

    <section class="text-center sm:px-6 pt-10 sm:pt-14 lg:pt-20 pt-16 sm:pb-32 lg:pb-40" style="background-color:#ffffff;">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/coach-image.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/coach-image.webp"
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
                        I’m not great at reading music. As a student I struggled to connect the lines, spaces, and dots on the page to the black and white keys on my piano. I even had to repeat a grade.
                        <br><br>
                        But that all changed when I discovered the techniques to make reading music accessible, enjoyable, and, yes, even easy.
                        <br><br>
                        And that’s what I’m going to show you in Read Music in 30 Days.
                        <br><br>
                        This isn’t about memorizing acronyms or ledger lines. It’s about seeing patterns and intervals in the music so you can spend less time trying to read music.<br><br>
                        Chords gave me the ability and confidence to do what we all dream of doing…
                        <br><br>
                        And more time playing it.
                    </h6>
                    <div class="text-right">
                    <img class="h-16 lg:h-20 rounded-full transition-opacity opacity-0" loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/read-music-in-30-days/lisa-witt-signature.svg"
                            alt="Lisa Witt Signature">
                    </div>
                </div>
            </div>
    </section>

    <section class="container max-w-5xl mx-auto mb-14 lg:mb-16">
        <div class="flex flex-col container max-w-5xl mx-auto">
            <div class="w-full md:flex md:flex-row p-4">
                <div class="w-full md:w-1/2 pr-6 text-justify">
                    <h3><strong>The key to reading music… <br class="hidden md:block">in your hands!</strong></h3><br><br>
                    <p>Read Music in 30 Days is an online Challenge that will have you reading and playing music each day. <br><br>
                    Enroll before June 23rd and you’ll also get the Read Music in 30 Days Companion Book for FREE (with free shipping). <br><br>
                    This 74-page book has every exercise used in the course PLUS a reference guide, practice notes for each day, and a ton of bonus sight-reading exercises.  <br><br>
                    It’s the perfect companion to the course, and it’s yours FREE. <br><br>
                    <span><strong>But you must enroll before June 23 to have the best chance of getting the book before the Challenge starts.</strong></span> <br><br>
                    Or -- choose the Annual Membership and you’ll get the book along with 7 other bonuses ($364 value).</p>
                </div>
                <div class="w-full md:w-1/2">
                    <img src="image" alt="">
                </div>
            </div>
        </div>
    </section>

    @php
        $testimonials = [
            [
                'avatar' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/membership/homepage/2024/testimonials/Jayde-McIntosh-thumb-m.webp',
                'title' => 'I’m learning to read sheet music quicker than I ever did…',
                'content' => 'I’ve taken piano lessons in the past, but not recently. I thought I’d give Pianote a try, and I’m glad I decided to. <br><br> I’m learning to read sheet music quicker than I ever did while taking private piano lessons.',
                'name' => 'Jayde McIntosh',
                'location' => 'WYOMING, USA',
            ],
            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/jessripley.jpg',
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/pianote/membership/homepage/2023/testimonials/jessripley.jpg',
                'title' => 'It’s like sitting down with a friend who’s teaching me how to play…',
                'content' => 'I’d been self-taught but hit a wall and wasn’t progressing anymore, so I decided to try Pianote. <br><br> It’s like sitting down with a friend who’s teaching me how to play while explaining the logic behind what they’re doing. The lessons are well thought out and I can do this all on my own schedule.',
                'name' => 'Paul Bucci',
                'location' => 'DUXBURY, MASSACHUSETTS USA',
            ],
            [
                'avatar' => 'https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1699032272-630719.jpg',
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/1024x1024/filters:quality(95)/marketing/pianote/products/new-piano-players/testimonials/Brian-smith-thumb.webp',
                'title' => 'I love the 30-day courses.',
                'content' => "The courses where you can start out five days a week, it's 10 minutes long, and you follow along for 10 minutes. The instructor's there with you and you're able to follow along just for 10 minutes every day. Those are extremely helpful for me in building some of that routine and confidence and really mastering building on what we did yesterday.",
                'name' => 'Brian Smith',
                'location' => 'WYOMING, USA',
            ],
        ];
    @endphp

    <div id="testimonials" class="anchor"></div>
    <section class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto mb-14 lg:mb-16">
        <h2 class="leading-tight text-black pb-6"><strong>What students are saying about Lisa:</strong></h2>
        
        <div x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    arrows: false,
                    perPage: 1.5,
                    type: 'loop',
                    gap: '1rem',
                    start: 1,
                    lazyLoad: 'nearby',
                }).mount();
            },
        }">
            <section x-ref="splide" class="splide md:mb-12">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($testimonials as $testimonial)
                            <li class="splide__slide flex items-start sm:items-stretch px-1">
                                <div class="w-full rounded-xl p-6 text-white flex flex-wrap sm:flex-nowrap transition-colors duration-300 active-bg" style="background-color:#ffffff;">
                                    <div class="flex flex-col justify-evenly text-left sm:pl-8 text-black">
                                        <h4 class="leading-normal mt-3 sm:mt-0 mb-2"><strong><em>"{!! $testimonial['title'] !!}"</em></strong></h4>
                                        <p class="leading-normal mt-3 sm:mt-0 mb-2"><em>{!! $testimonial['content'] !!}</em></p>

                                        <div class="flex items-center">
                                            @if(!empty($testimonial['avatar']))
                                                <img class="h-16 lg:h-20 w-16 lg:w-20 rounded-full object-cover mr-4 border-2 border-white opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" alt="Avatar" src="{{ $testimonial['avatar'] }}">
                                            @endif
                                            <div>
                                                <p class="leading-tight mx-0 font-black">{{ $testimonial['name'] }}</p>
                                                @if(!empty($testimonial['location']))
                                                    <p class="leading-tight mx-0 text-sm text-gray-600"><em>{{ $testimonial['location'] }}</em></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
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
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                    guaranteed.</strong></h2>

            <h6 class="leading-normal">30-Day Independence is a NEW way to learn the drums – and for less than a month of
                private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
                <br><br>
                We think it’ll be your favorite drum course ever –
                <br><br>
                So even though it’s only a month, you’ll get three full months to go through everything and make sure it was
                right for you. If not, just contact our friendly support team for a full refund.
            </h6>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background-color:#eff7ff;">
        <div class="container mx-auto relative z-50 text-center">
            <img class="h-20 sm:h-28 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp"
                alt="30 day independence logo">
            <h2 class="leading-tight mt-2 mb-3 sm:my-3 lg:my-4"><strong>20 Play-Along Lessons + 4 Live Q&A
                    Sessions</strong></h2>

{{--            <span class="join sold-out medium w-full max-w-xs align-middle mt-7" @click="waitlistModal = true;">JOIN WAITLIST</span>--}}
            <span class="join sold-out medium w-full max-w-xs align-middle mt-7">ENROLLMENT CLOSED</span>

        </div>
    </section>
    <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
        <p class="max-w-3xl px-4 md:px-2 leading-loose">
            <i class="fas fa-info-circle text-pianote" aria-hidden="true"></i> <b>Shipping Disclaimer –</b> Your physical bonuses may not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is up to the shipping gods.
        </p>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    'title' => 'Do I need to attend the lessons live?',
                    'desc' =>
                        'The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are optional. Plus, you’ll be sent a recording so you can watch anytime.',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'What if I’m going to miss a day (or two, or more)?',
                    'desc' =>
                        'That’s totally fine. The course is meant to be flexible – there are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session to catch up.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'How much time per week will this course require?',
                    'desc' =>
                        '30-Day Independence gives you guided daily coordination workouts for thirty days. The minimum time required adds up to 60 minutes per week – but you can spend 2+ hours or more including the live session if you’re feeling motivated.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'Does it work on acoustic AND electronic drums?',
                    'desc' =>
                        'Yes. 30-Day Independence is built for the intermediate-to-advanced drummer looking to improve their skills. You can complete all of Estepario’s exercises on either acoustic or electronic and see the full effects on your playing.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'Is this a continuation of 30-Day Drummer?',
                    'desc' =>
                        'Not exactly. 30-Day Drummer was our first-ever thirty day cohort designed to help beginners establish a solid groove. 30-Day Independence challenges your coordination around the kit.',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'What devices can I access the course on?',
                    'desc' =>
                        '30-Day Independence is available on your laptop, tablet, or phone. You’ll also have access through the Musora app after you’ve completed your purchase online.',
                    'num' => '?',
                ])
            </div>
            <div class="inline-block w-full px-3 md:px-4 my-5" style="color:#2a2f34;">
                <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD.
                </p>
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

    <div id="healthy" class="anchor"></div>

    @component('_partials.components.modal', ['name' => 'waitlistModal'])
        @slot('content')
            <div
                class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
                <p class="mb-4">Enter your email below to get notified when the <br class="hidden sm:inline">
                     30-Day Independence is announced. </p>
                @include('drumeo.lead-gen.partials.sign-up-form', [
                    'recaptchaKey' => $recaptchaKey,
                    'formName' => '30 Day Independence Waitlist',
                    'formId' => 'Drumeo - Engagement - Trigger - 30 Day Independence Waitlist - Web Form',
                    'buttonText' => 'Let Me Know ',
                    'stacked' => true,
                    'noSocial' => true,
                ])
            </div>
        @endslot
    @endcomponent
    @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => '931212517',
        'vimeo' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'trailerM',
        'video' => '931214479',
        'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
    ])

    @include('drumeo.sales.partials._footer')

    @include('_partials.components.countdown', [
        'countdownDate' => '2024-05-06 00:00:00',
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
