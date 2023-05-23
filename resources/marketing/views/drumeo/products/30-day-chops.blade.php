@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Chops | Drumeo</title>
    <meta property="og:title" content="30-Day Chops | Drumeo">
    <meta name="description" content="Learn drum chops with daily guided workouts.">
    <meta property="og:description" content="Learn drum chops with daily guided workouts.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/share-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
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

        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }
    </style>
    <?php \App\Analytics\Tracker::trackProductImpression('30-day-drummer-2'); ?>
@stop()

@section('body-data')
    x-data="{
    modal: {{ empty(user()) ? true : false }},
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "30-Day Chops",
                "fullPrice" => floatval($productPrices['30-day-drummer-2']->price),
                "price" => floatval($productPrices['30-day-drummer-2']->discounted_price),
                "noBreadcrumb" => true
            ])

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/logo.svg" alt="logo" fetchpriority="high">
                    <h1 class="rotater-text overflow-hidden"><strong>
                            <span class="relative nowrap delay-1000 ease-in-out">Learn drum chops</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your speed</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn drum chops</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your speed</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn drum chops</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your speed</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn drum chops</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your speed</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn drum chops</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your speed</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>
                        </strong></h1>
                    <h2 class="-mt-3 sm:-mt-1 lg:mt-0">with daily guided workouts.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>
                            Save your seat in the first-ever <br class="inline lg:hidden">class starting June 5th.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video lazyload" style="padding-bottom: 61%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/header-image-m3.png" alt="trailer image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-drumeo"></i> Learn by doing
                        <i class="ml-2 fas fa-check text-drumeo"></i> Play every day
                        <i class="ml-2 fas fa-check text-drumeo"></i> Guaranteed results</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Learn by  <br> doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Play every  <br> day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Guaranteed <br> results</p>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
{{--                            <span class="join sold-out medium w-full" data-open="waitlistModal">JOIN WAITLIST</span>--}}
                                <a href="#final" class="join blue medium w-full anchor-slide">ENROLL NOW</a>

                                <p class="opacity-50 text-sm mt-2 mb-5 sm:mb-0 underline hover:text-drumeo">
                                    <a href="https://www.musora.com/drumeo/enrollment/30-day-chops">Drumeo Members register for free here.</a>
                                </p>
                        </div>
                        <div class="w-full sm:w-1/2 pt-4 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/drummers.png" alt="joined student profiles" fetchpriority="high" />
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video" style="padding-bottom: 105%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/header-image3.png" fetchpriority="high" alt="header image" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap md:flex-nowrap text-center border rounded-lg border-gray-300 mt-6 lg:mt-8 mb-2 lg:mb-4">
                <div class="w-full md:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 md:py-3 lg:py-4">
                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5"><strong>June 5th</strong></h4>
                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                        Enrollment closes in<br class="inline lg:hidden">
                        <span class="text-drumeo" x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>
{{--                        Enrollment closed--}}
                    </p>
                </div>
                <div class="flex flex-wrap md:flex-nowrap items-center justify-evenly w-full md:w-auto md:flex-grow py-4 md:py-3 lg:py-4 text-left md:text-center">
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> June 5th to<br class="hidden md:inline"> July 5th</span></p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-clock text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span></p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play tasty linear <br class="hidden md:inline">groove & fill chops.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <img class="h-56 inline sm:hidden transition-all opacity-0" data-src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/intro-image2.png" alt="collage intro mobile" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="text-center my-5 sm:mt-0 sm:mb-7"><strong>Unlock your speed<br class="hidden sm:inline"> & creativity around the drums.</strong></h2>
            <div class="text-left flex flex-wrap sm:flex-nowrap mb-16 sm:mb-24">
                <p class="leading-normal max-w-xl sm:pr-4">Drum chops–
                    <br><br>
                    Everybody wants them, but nobody knows exactly what they are… until now.
                    <br><br>
                    30-Day Chops is the first-ever course that teaches you tasty linear drum chops one note at a time. You’ll play along with Zack Graybeal (aka “ZackGrooves”) every day for thirty days until you’re playing blistering groove & fill chops like your favorite drummers.
                    <br><br>
                    Plus, you’ll have a live lesson every Saturday to ask questions and get yourself “unstuck.”
                    <br><br>
                    By the end of the month, you’ll have hundreds of new chops in your bag and the skills to start creating your own patterns around the kit.
                    <br><br>
                    Scroll down to save your seat in the first-ever class, June 5th - July 5th.
                </p>
                <img class="h-64 lg:h-80 hidden sm:inline transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/intro-image2.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>

            @php
                $gettings = [

                    [
                    'position' => 'left',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/never-feel-lost.jpg',
                    'title' => 'Know exactly what to practice. ',
                    'desc' => 'The biggest mystery to learning chops has been knowing WHAT to practice. 30-Day Chops is foolproof because the lessons ARE your practice. You’ll play along each day with Zack – just do what he does. ',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/stop-wasting-time.jpg',
                    'title' => 'Fits any schedule. ',
                    'desc' => 'It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Chops is designed to fit any schedule. You only need 10-minutes per day to learn Zack’s tasty licks. ',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/practice-thats-actually.jpg',
                    'title' => 'Play with real music.',
                    'desc' => 'No more painfully dry exercises set to MIDI playalongs. 30-Day Chops includes custom-made music by acclaimed drum composer, Kaz Rodriguez. He’s crafted the perfect song for you to chop out with. ',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/live-support.jpg',
                    'title' => 'Live support from REAL teachers.',
                    'desc' => 'Each week you’ll have a 60-minute live lesson with Zack. Ask questions, get feedback, and connect with other students. Grab a cup of coffee and hang with your drum teacher? Yes please.  ',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/lifetime-access.jpg',
                    'title' => 'Lifetime access.',
                    'desc' => 'You can access ALL playalongs, charts, and lessons from 30-Day Chops for life. That means you can return to your favorite chop workouts over and over – plus, it means you can work at your own pace.',
                    ],
                ];
//            @endphp
            <div class="timeline-container dc30 max-w-3xl lg:max-w-4xl mx-auto relative px-4">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-0 @if($key !== 4) md:mb-28 @endif">
                            <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 overflow-hidden">
                                <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $getting['img'] }}" alt="{{ $getting['title'] }}img" loading="lazy" onload="this.classList.remove('opacity-0')" />
                            </div>
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
            <h2 class="text-center"><strong>What kind of chops<br class="inline sm:hidden"> will you learn?</strong></h2>
            <h6 class="leading-normal my-4 sm:my-7 mx-auto max-w-3xl">There’s been a movement of blistering linear patterns on the drums.
                <br><br>
                This is your chance to keep your playing on the cutting edge by immersing yourself in the world of chops for 30 days. Below are three drummers who exemplify this style of playing – click the buttons to see short examples of each playing linear chops.</h6>

            <div class="flex flex-wrap max-w-xs sm:max-w-full mx-auto">
                <div class="relative w-full sm:w-1/3 px-2 mb-4 sm:mb-0 cursor-hover autoplay-video" data-open="aaron">
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-20"></i>
                    <img class="rounded-xl relative z-10 transition-all opacity-0" src="https://i.vimeocdn.com/video/1665544113-6ae072e9d0652bdfcd726f650d7208211eaec7245bead7abc8a44032fcc7993d-d_560" alt="aaron" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <div class="relative w-full sm:w-1/3 px-2 mb-4 sm:mb-0 cursor-hover autoplay-video" data-open="anika">
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-20"></i>
                    <img class="rounded-xl relative z-10 transition-all opacity-0" src="https://i.vimeocdn.com/video/1665543766-0b53f480e98b9420f71219fe5ef7729f238a9f69f56e1e56cbc84e703930e96d-d_560" alt="anika" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
                <div class="relative w-full sm:w-1/3 px-2 cursor-hover autoplay-video" data-open="larnell">
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-20"></i>
                    <img class="rounded-xl relative z-10 transition-all opacity-0" src="https://i.vimeocdn.com/video/1665537466-98255352b2fe7e092811c665a39a7272ce9a23721135bc8907ae4c9afbdf5aa1-d_560" alt="larnell" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#EFF7FF;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-28 sm:h-36 lg:h-48 mb-3 sm:mb-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=760,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/logo.svg" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-drumeo mr-5"></i> Daily guided drum workouts<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Weekly LIVE Q&A workshops<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Guaranteed results</h4>
            </div>
{{--            <span class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" data-open="waitlistModal">JOIN WAITLIST</span><br>--}}
            <a href="#final"
                    class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>
            <img class="h-7 mr-1 mb-5 sm:mb-10 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/drummers.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>

        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-12 mb-4 sm:-mb-24 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/live-screen.png" alt="screen" loading="lazy" onload="this.classList.remove('opacity-0')">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get LIVE support<br> every step of the way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your lessons, you can ask your instructor at each week’s LIVE Q&A event. Zack will be there to help you through any sticking points and keep you motivated to complete the full course.</h6>
                    <div class="text-center sm:text-left">
                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>Join Zack LIVE: <i class="fas fa-arrow-down text-drumeo mx-2 inline lg:hidden"></i> <i class="fas fa-arrow-right text-drumeo mx-2 hidden lg:inline"></i></strong></h6><br class="inline lg:hidden">

                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>JUN</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">10</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>JUN</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">17</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>JUN</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">24</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>JUL</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">1</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-3"><strong>Playing makes perfect.</strong></h2>
            <h6 class="leading-normal mb-11">For less than the cost of monthly private lessons<br class="hidden sm:inline"> you’ll get a 30-day program to transform your drumming.</h6>

            <div class="relative">
                <p class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14" src="https://www.musora.com/musora-cdn/image/width=220,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/logo-white.svg" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')"></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tl-xl"><strong>Private<br> Lessons</strong></td>
                        <td class="cursor-pointer sm:cursor-default"><strong>Online<br> Courses</strong></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tr-xl"><strong>Drum<br> Books</strong></td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>24 Play-along Workouts</td>
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
                        <td class="rounded-b-xl"><strong>${{ floatval($productPrices['30-day-drummer-2']->discounted_price) }}</strong></td>
                        <td class="rounded-bl-xl"><strong>$30-$100</strong><br> per lesson</td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="mt-20 lg:mt-24 mb-6 sm:mb-10 lg:mb-14"><img class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/logo.svg" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')"> <strong>...is designed for:</strong></h2>
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-top relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/intermediate-drummer.jpg" alt="intermeidate drummer" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br>Intermediate<br class="hidden sm:inline lg:hidden"> Drummers</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-relaxed mt-3">30-Day Chops will help you take your drumming to the next level by studying rudiment applications on the drums. This is the perfect course to start expressing yourself creatively on the drums.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-top relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/advanced-drummer.jpg" alt="advanced drummer" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br>Advanced<br class="hidden sm:inline lg:hidden"> Drummers</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-relaxed mt-3">You’ve been playing for a while, holding down gigs and feeling confident in your drumming. 30-Day Chops will help you enter the world of linear chops and make you an even greater asset to any band or recording session. </p>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-top relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/ambitious-beginner.jpg" alt="ambitious beginners" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br> Ambitious <br class="hidden sm:inline lg:hidden"> Beginners</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-relaxed mt-3">Maybe you’re fairly early in your drumming journey but are ready for a challenge. Dive in with 30-Day Chops – you’ll have note-for-note breakdowns and live sessions to keep you moving forward. </p>
                </div>
            </div>

        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#EFF7FF;">
        <div class="container max-w-4xl mx-auto mb-10">
            <img class="h-10 sm:h-20 mb-8 sm:mb-10 lg:mb-12 mx-auto transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1220,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Just_Press_Play_logo.png" alt="just press play logo" loading="lazy" onload="this.classList.remove('opacity-0')">
{{--            <img class="cursor-pointer rounded-xl autoplay-video overflow-hidden w-full" data-open="trailer" src="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/video-thumbnail.jpg">--}}
            <div class="aspect-16:9 cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative" data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/30dc.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #d70b3b calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #d70b3b, #9d1032);">
        <div class="container max-w-2xl mx-auto">
            <div class="-mt-14 sm:-mt-20 lg:-mt-28 mb-7">
                <img class="block h-20 sm:h-24 mx-auto animated infinite bounce slower transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Important_Icon.svg" alt="important icon" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
            <h1 class="font-bebas text-5xl sm:text-6xl lg:text-7xl">FAIR WARNING</h1>
            <h6 class="leading-normal  mt-4 mb-8">30-Day Chops is a daily guided workout program for drummers — where you’ll get a new video each weekday and a live session each weekend throughout the month. Because of this, students will not be able to join midway — and you need to register before the course begins. {{--on September 5th.--}}</h6>
            <h4 class="py-1.5 w-full font-bebas uppercase inline-block mx-auto" style="background-color:#fd5;color:#9d1032;">REGISTRATION CLOSES IN<br class="inline sm:hidden">
                <span x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>
            </h4>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-profile2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Zack Graybeal<br> (aka “ZackGrooves”)</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Zack lives at the intersection of grooves and chops.
                        <br><br>
                        He’s built a passionate community of drummers on YouTube with his hilarious videos and stunning performances. His innovative playing style has inspired millions of drummers to apply chops in a musical & groove-oriented way.
                        <br><br>
                        Zack has created the exercises for this course alongside Drumeo to help YOU build your own tasty drum chops.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-7 sm:h-9" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drumeo-awards-logo.png" alt="tiktok icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <h3 class="mt-2"><strong>2x</strong></h3>
                            <p class="uppercase opacity-70 text-sm leading-tight">Drumeo Awards<br> Nominee</p>
                        </div>
                        <div class="">
                            <img class="h-7 sm:h-9" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <h3 class="mt-2"><strong>49M</strong></h3>
                            <p class="uppercase opacity-70 text-sm leading-tight">views</p>
                        </div>
                        <div class="">
                            <img class="h-7 sm:h-9" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <h3 class="mt-2"><strong>104k</strong></h3>
                            <p class="uppercase opacity-70 text-sm leading-tight">followers</p>
                        </div>
                    </div>
                </div>
            </div>
{{--            <h3 class="mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What drummers are saying:</strong></h3>--}}
{{--            <div class="flex flex-wrap text-left">--}}
{{--                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">--}}
{{--                    <div class="flex items-start p-5 bg-white rounded-lg">--}}
{{--                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=85/https://d1923uyy6spedc.cloudfront.net/232650-avatar-1568629179.jpg" alt="Larnell lewis">--}}
{{--                        <p class="pl-4"><strong>Gregg Bissonnette</strong><br>--}}
{{--                            <em class="leading-tight inline-block mb-1 opacity-60">Legendary Session Drummer</em><br>--}}
{{--                            “Zack is a great friend and amazing drummer in every style. He’s a musical inspiration to me and I know he’ll do the same for you. Too bad he doesn’t have a good sense of humor though…”--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">--}}
{{--                    <div class="flex items-start p-5 bg-white rounded-lg">--}}
{{--                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=85/https://d1923uyy6spedc.cloudfront.net/31880-avatar-1557351774.jpg" alt="Jared Falk">--}}
{{--                        <p class="pl-4"><strong>Jared Falk</strong><br>--}}
{{--                            <em class="leading-tight inline-block mb-1 opacity-60">Drumeo Co-Founder</em><br>--}}
{{--                            "Zack makes me want to sit down and improve my drumming, an essential quality of a great teacher – plus, you’re always entertained throughout the process."--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <span class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" data-open="waitlistModal">JOIN WAITLIST</span><br>--}}

                <a
                    href="#final"
                    class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>

            <img class="h-7 mr-1 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/drummers.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=410,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course, guaranteed.</strong></h2>

            <h6 class="leading-normal">30-Day Chops is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
                <br><br>
                We think it’ll be your favorite drum course ever –
                <br><br>
                So even though it’s only a month, you’ll get three full months to go through everything and make sure it was right for you. If not, just contact our friendly support team for a full refund.</h6>

        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                    <div class="text-center lg:text-left w-full lg:w-1/3 mb-7 lg:mb-0">
                        <img class="h-20 md:h-24 lg:h-28 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/logo.svg" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h4 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5"><strong>
                                20 Guided Play-Along Lessons.<br>
                                4 Live Q&A Sessions.<br>
                                Lifetime Course Access.
                            </strong></h4>
                        <div class="w-full mx-auto sm:mx-0">
                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-drumeo mr-1"></i> Boost your speed, control and creativity.</p>
                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-drumeo mr-1"></i> Join {{ number_format($nPackOwners ?? 0) }} drummers who’ve already registered.</p>
                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-drumeo mr-1"></i> Course runs June 5 to July 5.</p>
                            <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-drumeo mr-1"></i>  Choose your best option to get started.</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap max-w-xs sm:max-w-full items-center text-left w-full mx-auto lg:w-2/3 lg:pl-5 xl:pl-10">
                        <a href="/ecommerce/add-to-cart?products[30-day-chops]=1&products[Drumeo-VaterSticks]=1&locked=true"
                            class="z-10 relative px-5 sm:px-7 py-7 sm:py-9 mb-7 sm:mb-0 bg-white rounded-xl shadow-lg w-full sm:w-5/12">
                            <h3><strong>30-Day Chops</strong></h3>
                            <p class="text-sm mt-2 mb-5">Learn drum chops in 30 days. </p>
                            <h2 class="inline-block"><strong class="text-4xl">${{ 97 }}</strong></h2> <p class="inline-block text-xs">One time payment.</p><br>
                            <div class="join blue smaller my-4 w-full">ENROLL NOW</div>
                            <ul class="list-disc ml-6">
                                <li class="text-sm relaxed"><span class="text-drumeo">Free</span> 5A Drumsticks</li>
                                <li class="text-sm relaxed"><span class="text-drumeo">Free</span> Drumeo Access</li>
                            </ul>
                            <hr class="w-full my-5" style="border-color:#b2cae1">
                            <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                                <i class="fas fa-check text-drumeo mr-1"></i> Lifetime Course Access<br>
                                <i class="fas fa-check text-drumeo mr-1"></i> 90-Day Money Back Guarantee</p>
                        </a>
                        <a href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-chops]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=6&products[drum-technique-made-easy-pack]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[SD-DIGI]=1&products[four-weeks-to-better-drum-fills]=1&locked=true"
                            class="px-5 sm:px-10 py-5 sm:py-7 sm:-ml-5  rounded-xl shadow-lg w-full sm:w-7/12 bg-center bg-cover border-4 border-white"
                        style="background-color:#dde9f9;background-image:url(https://www.musora.com/musora-cdn/image/width=380,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/order-bg.jpg);"
                        >
                            <p class="border border-drumeo text-drumeo inline-block rounded-xl text-xs mb-2 px-4 tracking-wider">LAUNCH MEMBERSHIP SPECIAL</p>
                            <h3><strong>Join Drumeo + Get<br class="hidden sm:inline"> 30-Day Chops FREE</strong></h3>
                            <p class="text-sm my-2">
                                Unlimited Drum Lessons + 6 Pairs Of Sticks and more:</p>
                            <h2 class="inline-block"><!--<s class="opacity-40">$240</s>--> <strong class="text-4xl">$240</strong></h2> <p class="inline-block text-xs">Billed annually.</p><br>
                            <div class="join blue smaller my-4 w-full">GET EVERYTHING</div>
                            <ul class="list-disc ml-6">
                                <li class="text-sm leading-relaxed">Annual Drumeo Membership</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> QuietPad Practice Pad</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> 6x Drumsticks</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> Drum Technique Made Easy</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> Rock Drumming Masterclass</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> Independence Made Easy</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> Successful Drumming</li>
                                <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> Better Drum Fills</li>
                            </ul>
                            <hr class="w-full my-5" style="border-color:#b2cae1">
                            <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                                <i class="fas fa-check text-drumeo mr-1"></i> Lifetime Course Access<br>
                                <i class="fas fa-check text-drumeo mr-1"></i> 90-Day Money Back Guarantee</p>
                        </a>
                    </div>

            </div>
        </div>
    </section>
    <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
        <p class="max-w-2xl px-4 md:px-2 leading-loose">
            <i class="fas fa-info-circle text-drumeo" aria-hidden="true"></i> <b>Shipping Disclaimer –</b> Your sticks might not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is up to the shipping gods.
        </p>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Do I need to attend the lessons live?",
            "desc" => "The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are optional. Plus, you’ll be sent a recording so you can watch anytime.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "What if I’m going to miss a day (or two, or more)?",
            "desc" => "That’s totally fine. The course is meant to be flexible – there are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session to catch up.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "How much time per week will this course require?",
            "desc" => "30-Day Chops gives you guided daily chop workouts for thirty days. The minimum time required adds up to 60 minutes per week – but you can spend 2+ hours or more including the live session if you’re feeling motivated.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Does it work on acoustic AND electronic drums?",
            "desc" => "Yes. 30-Day Chops is built for the intermediate-to-advanced drummer looking to improve their skills. You can complete all Zack’s exercises on either acoustic or electronic and see the full effects on your playing.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Is this a continuation of 30-Day Drummer?",
            "desc" => "Not exactly. 30-Day Drummer was our first-ever thirty day cohort designed to help beginners establish a solid groove. 30-Day Chops moves on to complex linear patterns around the kit. It’s very possible for an ambitious beginner to work through it – but the curriculums are not related.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "What devices can I access the course on?",
            "desc" => "30-Day Chops is available on your laptop, tablet, or phone. You’ll also have access through the Musora app after you’ve completed your purchase online.",
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
'modalId' => "trailer",
"video" => '//player.vimeo.com/video/825206369?h=e8d828248a&autoplay=1',
"title" => 'trailer'
])
@include('drumeo.sales.partials._video-modal',[
'modalId' => "aaron",
"video" => '//player.vimeo.com/video/823878266?h=c6a0279ff5&autoplay=1',
"title" => 'aaron'
])
@include('drumeo.sales.partials._video-modal',[
'modalId' => "anika",
"video" => '//player.vimeo.com/video/823878240?h=9d697640d7&autoplay=1',
"title" => 'anika'
])
@include('drumeo.sales.partials._video-modal',[
'modalId' => "larnell",
"video" => '//player.vimeo.com/video/823878300?h=dec74dc718&autoplay=1',
"title" => 'larnell'
])

@include('_partials.components.countdown',[
'countdownDate' => '2023-06-05 00:00:00',
'promoVersion' => false
])

    @include("drumeo.sales.partials._footer")

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
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
