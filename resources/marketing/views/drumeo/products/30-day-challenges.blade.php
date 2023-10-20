@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Drummer | Drumeo</title>
    <meta property="og:title" content="30-Day Drummer | Drumeo">
    <meta name="description" content="Learn the drums with daily guided workouts.">
    <meta property="og:description" content="Learn the drums with daily guided workouts.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
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

        /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }
        .splide__arrow svg{
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
    </style>
    <?php \App\Analytics\Tracker::trackProductImpression('30-day-drummer-2'); ?>
@stop()

@section('body-data')
    x-data="{
    waitlistModal: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "30-Day Drummer",
                "fullPrice" => floatval($productPrices['30-day-drummer-2']->price),
                "price" => floatval($productPrices['30-day-drummer-2']->discounted_price),
                "noBreadcrumb" => true
            ])

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-col sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/30_day_drummer_logo.svg" alt="30DD logo season3 logo">
                    <h1 class="rotater-text overflow-hidden"><strong>
                            <span class="relative nowrap delay-1000 ease-in-out">Learn the drums</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your timing</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn the drums</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your timing</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn the drums</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your timing</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn the drums</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your timing</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>

                            <span class="relative nowrap delay-1000 ease-in-out">Learn the drums</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Improve your timing</span><br>
                            <span class="relative nowrap delay-1000 ease-in-out">Boost your creativity</span><br>
                        </strong></h1>

                    <h2 class="-mt-3 sm:-mt-1 lg:mt-0">with daily guided workouts.</h2>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-drumeo"></i> Improve Your Skills
                        <i class="ml-2 fas fa-check text-drumeo"></i> Drum Every Day
                        <i class="ml-2 fas fa-check text-drumeo"></i> Learn By Doing</p>
                    <div class="flex inline lg:hidden my-3">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Improve<br> Your Skills</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Drum<br> Every Day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Learn<br> By Doing</p>
                    </div>
                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video lazyload" style="padding-bottom: 63%;" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_thumb_no_badge_m.jpg" data-open="trailer">

                    </div>
                    
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-cover bg-top bg-no-repeat cursor-pointer autoplay-video lazyload" style="padding-bottom: 98%;" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_no_badge_thumb.jpg" data-open="trailer">
                        <div class="join white smaller absolute {{-- bottom-1 --}} bottom-2 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
                <div class="flex w-full flex-col items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2 my-1">
                               <a href="#final" class="join blue medium w-full anchor-slide">GET STARTED</a>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5 my-1 text-center">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Joined_profiles.png" alt="joined student profiles">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
                        </div>
                    </div>
            </div>       
        </div>
    </header>


<section style="background: #00101D;">
    <div class="text-center text-white text-2xl md:text-5xl font-extrabold font-['Open Sans'] leading-10 pt-12 md:pt-20">
        Just Press Play</div>
    <div class="text-center text-white text-base md:text-xl font-normal font-['Open Sans'] leading-loose">Get an overview
        of what 30-Day Drummer has to offer!</div>

    <div class="container max-w-6xl mx-auto p-4 md:p-6 lg:flex">
        <!-- Left Column -->
        <div class="lg:w-4/6 py-2 md:p-4">
            <!-- Video -->
            <div class="w-full">
                <img class="rounded-xl"
                    src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/shop/30-day-challenges/drum-challenges.jpeg" />
            </div>

            <div class="mt-4 md:py-4 text-white font-sans text-15 font-normal font-light leading-35 hidden md:block">
                <p>Welcome to 30-Day Drummer! At this point, you should have all the equipment you need to get started,
                    know how to set up your gear, and be ready to have some fun playing the drums with Domino. In this
                    first lesson and 10-minute workout, she will teach you the beginnings of the most popular drum beat
                    of all time. And you will have fun doing it!</p>
                <p class="pt-10">Instructor: <strong>Domino Santantonio</strong></p>
                <p class="pt-2">Lesson Length: <strong>30 video lessons</strong></p>
            </div>
        </div>

        <!-- Right Column -->
        <div class="lg:w-2/6 py-2 md:p-4">
            <div class="h-14 flex flex-row rounded-lg mb-2 px-6 py-4" style="background: #eff7ff;"> <svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM10 16.5V7.5L16 12L10 16.5Z"
                        fill="#0B76DB" />
                </svg>
                <div class="text-base font-normal font-light leading-7 px-2"> Course Kick-Off</div>
            </div>
            <div class="h-14 flex flex-row rounded-lg my-2 px-6 py-4" style="background: #eff7ff;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path
                        d="M12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7363 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM10 16.5V7.5L16 12L10 16.5Z"
                        fill="#0B76DB" />
                </svg>
                <div class="text-base font-normal font-light leading-7 px-2">Setup</div>
            </div>
            <p class="text-white font-sans text-15 font-semibold leading-35">Course Lessons</p>
            @php
                $lessons = ['Day 1 - Introduction', 'Day 2 - Basics of Drumming', 'Day 3 - Rhythms and Patterns', 'Day 4 - Advanced Techniques', 'Day 5 - Grooves and Fills', 'Day 6 - Introduction', 'Day 7 - Basics of Drumming', 'Day 8 - Rhythms and Patterns', 'Day 9 - Advanced Techniques', 'Day 10 - Grooves and Fills'];
            @endphp
            <!-- Container with scroll  -->
            <div x-data="{ isOpen: [] }" class="h-80 overflow-y-scroll rounded-lg">
                @foreach ($lessons as $i => $lesson)
                    <div x-data="{ open: false }"
                        class="rounded-lg bg-white shadow text-base font-normal font-light leading-7">
                        <button @click="open = !open"
                            class="rounded-lg flex w-full items-center justify-between px-6 py-4 my-1"
                            style="background: #eff7ff;">
                            <span>Day {{ $i + 1 }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"
                                fill="none" x-show="open">
                                <path d="M10.59 0.59L6 5.17L1.41 0.590001L-5.24537e-07 2L6 8L12 2L10.59 0.59Z"
                                    fill="#0B76DB" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"
                                fill="none" x-show="!open">
                                <path d="M10.59 0.59L6 5.17L1.41 0.590001L-5.24537e-07 2L6 8L12 2L10.59 0.59Z"
                                    fill="#0B76DB" />
                            </svg>
                        </button>
                        <div x-show="open" x-cloak>
                            <div class="px-6 pb-4">
                                Content for lesson {{ $i + 1 }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    
    <!-- Paragraphs for mobile -->
    <div class="mt-4 p-4 text-white font-sans text-15 font-normal font-light leading-35 md:hidden">
        <p>Welcome to 30-Day Drummer! At this point, you should have all the equipment you need to get started, know how
            to set up your gear, and be ready to have some fun playing the drums with Domino. In this first lesson and
            10-minute workout, she will teach you the beginnings of the most popular drum beat of all time. And you will
            have fun doing it!</p>
        <p class="pt-10">Instructor: <strong>Domino Santantonio</strong></p>
        <p class="pt-2">Lesson Length: <strong>30 video lessons</strong></p>


    </div>
</div>

 <div class="container max-w-6xl mx-auto px-4 md:px-0 lg:flex">
    <!-- Songs subsection -->
    @php
        $songItems = [
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/5000-songs-icon.svg',
                'title' => '5000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level.',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/tempo-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down or speed up any section of a song to hear every note.',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/loop-icon.svg',
                'title' => 'Loop the trouble spots.',
                'desc' => 'No more pausing and rewinding that tricky fill. Loop it over and over again!',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/no-drums-icon.svg',
                'title' => 'Remove the drums.',
                'desc' => 'Magically remove the original drums to make each song uniquely yours.',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/play-it-right-icon.svg',
                'title' => 'Play it right the first time.',
                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/devices-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,so you can play any song, any time.',
            ],
        ];
    @endphp

    <div x-data="{ openItem: null }" class="text-center text-white w-full sm:w-auto mt-6 lg:mt-0 mx-auto px-4 pb-16 md:pb-28">
        <div class="flex flex-wrap">
            @foreach ($songItems as $i => $songItem)
                <div class="w-full sm:w-1/3 flex items-center h-20 md:h-max sm:px-2 lg:px-6 mb-6 lg:my-6"
                    x-bind:class="{ 'bg-gradient-mobile': openItem === {{ $i }} }">
                    <div @click="openItem = (openItem === {{ $i }} ? null : {{ $i }})"
                        class="flex sm:inline-block cursor-pointer">
                        <div class="w-14 text-left sm:w-full flex-shrink-0">
                            <img alt="point icon" src={{ $songItem['icon'] }} class="h-6 sm:h-10">
                        </div>
                        <div class="text-left">
                            <p class="mb-1 sm:my-2">
                                <strong>{!! $songItem['title'] !!}</strong>
                            </p>
                            <div class="text-sm hidden sm:block">
                                {!! $songItem['desc'] !!}
                            </div>
                            <div x-show="openItem === {{ $i }}" x-cloak class="text-sm md:hidden">
                                {!! $songItem['desc'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

 </div>
</section>

 <!-- Meet your teacher section -->

<section class="text-center px-6 md:px-5 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 130%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Domino Santantonio</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Domino Santantonio is one of the world’s most viewed drummers.
                        <br><br>
                        And she’s achieved this with her engaging & supportive style of drumming – always smiling and reminding you why playing the drums is so fun & healthy. Who better to jumpstart your drumming progress?
                        <br><br>
                        Plus, Domino is also your personal guide through the course.
                        <br><br>
                        At the end of every week, you’ll have a Q&A session with Domino where you can ask her any questions you had during the lessons.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                            <h3 class="mt-2"><strong>1.6M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                            <h3 class="mt-2"><strong>19M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                            <h3 class="mt-2"><strong>461k</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

 <!-- Testimonials section -->

    <section class="pt-16 md:pt-32 pb-44 md:pb-64" style="background: linear-gradient(rgba(11, 118, 219, 1), rgba(7, 74, 137, 1))">
    <div class="text-center text-white">
        <h2 class="leading-tight text-2xl md:text-5xl mb-4"><strong>Trusted by drummers everywhere.</strong></h2>
        <a class="inline-block w-full" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank"
            onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
            <img alt="shopper approved image" class="h-8 sm:h-9 lg:h-10 mb-2 mx-auto transition-opacity opacity-0"
                src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/shopper-approved.png"
                loading="lazy" onload="this.classList.remove('opacity-0')">

        </a>
        <div class="flex flex-wrap items-start justify-center mx-auto mt-2 sm:mt-6">
            <div class="w-full sm:w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color: white;">
                <a href="https://www.youtube.com/freedrumlessons/" target="_blank" aria-label="youtube">
                    <i class="fab fa-youtube text-4xl sm:text-5xl"></i>
                </a>
                <h2 class="my-1 sm:my-2 text-white text-4xl md:text-5xl font-extrabold">3,300,00</h2>
                <p class="uppercase text-base md:text-lg">Subscribers</p>
            </div>
            <div class="w-full sm:w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color: white;">
                <a href="https://facebook.com/drumeo/" target="_blank" aria-label="facebook">
                    <i class="fab fa-facebook-f text-4xl sm:text-5xl"></i>
                </a>
                <h2 class="my-1 sm:my-2 text-white text-4xl md:text-5xl font-extrabold">1,120,000</h2>
                <p class="uppercase text-base md:text-lg">Likes</p>
            </div>
            <div class="w-full sm:w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5">
                <a href="https://instagram.com/drumeoofficial/" target="_blank" aria-label="instagram">
                    <i class="fab fa-instagram text-4xl sm:text-5xl" style="color: white;"></i>
                </a>
                <h2 class="my-1 sm:my-2 text-white text-4xl md:text-5xl font-extrabold">1,400,000</h2>
                <p class="uppercase text-base md:text-lg">Followers</p>
            </div>
        </div>
    </div>

    <h3 class="mb-4 text-center text-white"><strong>17,000+ Drummers Agree...</strong></h3>
    <p class="text-white mb-2 md:mb-3 px-4 lg:px-0 text-center">30-Day Drummer works. By focusing on playing with real
        music right from day one, you’ll learn the <br class="hidden lg:inline">skills to play hundreds of songs on the
        drums in just thirty days. Check out what students are saying:</p>
    <div class="max-w-5xl mx-auto px-5 sm:px-6 mb-10 sm:mb-0">
        <div x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    classes: {
                        arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                        prev: 'hidden',
                        next: 'splide__arrow--next hidden sm:flex mb-16',
                        pagination: 'splide__pagination -bottom-10',
                    },
                    perPage: 2.5,
                    perMove: 1,
                    type: 'loop',
                    focus: 0,
                    interval: 2000,
                    breakpoints: {
                        800: {
                            perPage: 2.5,
                        },
                        769: {
                            perPage: 1.5,
                            drag: 'free',
                            snap: false,
                        },
                    },
                }).mount()
            },
        }">
            <div x-ref="splide" class="splide sm:mb-9">
                <div class="splide__track">
                    <ul class="splide__list items-start" style="padding-top: 60px !important;">
                        @php
                            $testimonials = [
                                [
                                    'season' => '1',
                                    'name' => 'Erin W.',
                                    'comment' => '<strong>I am shocked at how much I learned in these last 30 days.</strong> My husbands a drummer so he watched me go from knowing NOTHING to being able to make it through a song.',
                                    'img' => 'https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1678130486-572603.jpg',
                                ],
                                [
                                    'season' => '1',
                                    'name' => 'Kristyn T.',
                                    'comment' => '<b>I\'m SOO EXCITED to have actually learned my first entire song ever!!!</b>  Such a HIGH!!!  Domino is like having a dear sweet encouraging friend and mentor to work with daily! ',
                                    'img' => 'https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1679111185-496776.jpg',
                                ],
                                [
                                    'season' => '1',
                                    'name' => 'Tobias W.',
                                    'comment' => 'The idea behind this format is really great. These short sessions can easily be fit into everyday life, no need to think or prepare what\'s next. <strong>It keeps the guesswork out of learning the drums so you can focus on the most important part: Playing the drums and having fun.</strong>',
                                    'img' => 'https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1669379419-276550.jpg',
                                ],
                                [
                                    'season' => '1',
                                    'name' => 'Stephiekitty (Estephania E.)',
                                    'comment' => 'I never thought I’d be a drummer but here I am! I went from zero to hero all thanks to Domino and Drumeo! I would have never tried drums had it not been for this 30 day drummer program💕🥁🎵🎶',
                                    'img' => 'https://dzryyo1we6bm3.cloudfront.net/avatars/526989_1660712845376-1660712847-526989.jpg',
                                ],
                                [
                                    'season' => '1',
                                    'name' => 'Monique G.',
                                    'comment' => 'I\'m thrilled that I\'m back behind a drum kit after 30 years and not only loving it, but genuinely understanding it. Thank you, thank you, thank you! 🥁',
                                    'img' => 'https://dzryyo1we6bm3.cloudfront.net/avatars/528540_1661460541688-1661460545-528540.jpg',
                                ],
                                [
                                    'season' => '2',
                                    'name' => 'Alan C.',
                                    'comment' => '<strong>Five weeks ago I didn\'t own a drum kit – Today I played a whole song twice!</strong> I wouldn\'t have believed it possible if I hadn\'t just experienced it. Big thanks to Domino and all at Drumeo',
                                    'img' => 'https://dzryyo1we6bm3.cloudfront.net/avatars/412320_1662361641020-1662361646-412320.jpg',
                                ],
                                [
                                    'season' => '2',
                                    'name' => 'Shae C.',
                                    'comment' => 'Yes! I’m so happy and so proud. I still can’t believe I played my first ever drum song. And I did it twice!! So very happy right now, it’s making me tear up.',
                                    'img' => 'https://dzryyo1we6bm3.cloudfront.net/avatars/521912_1663974802851-1663974809-521912.jpg',
                                ],
                                [
                                    'season' => '2',
                                    'name' => 'David Stanley',
                                    'comment' => 'This has just been the best experience. In less than 30 days I\'ve gone from the occasional uncoordinated bash on my son\'s acoustic kit to sounding like I almost know what I\'m doing.',
                                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/david.jpg',
                                ],
                                [
                                    'season' => '2',
                                    'name' => 'Evan W.',
                                    'comment' => 'An absolutely fabulous program… for yourself, your son, your daughter or otherwise. <strong>Filled with great energy, and sound fundamentals.</strong> 🤩 If you’re thinking about it - don’t think, just do! ⚡️',
                                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/evan.jpg',
                                ],
                            ];
                        @endphp
                        @foreach ($testimonials as $testimonial)
                            <li class="splide__slide bg-[#F4F8FB] rounded-xl pb-6 px-8 mr-4 text-center">
                                <div class="-mt-10 mb-6">
                                    <img class="rounded-full w-[90px] h-[90px] object-cover lazyload"
                                        data-src="https://www.musora.com/musora-cdn/image/width=130,quality=95/{{ $testimonial['img'] }}"
                                        alt="{{ $testimonial['name'] }} avatar" />
                                </div>
                                <h6 class="mb-1 font-extrabold">{{ $testimonial['name'] }}</h6>
                                <p><i>Season {!! $testimonial['season'] !!} Student</i></p>
                                <img class="my-4"
                                    src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/stars.svg"
                                    alt="stars" />
                                <p class="mb-6">“{!! $testimonial['comment'] !!}”</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- End of Testimonials section -->

  <!-- Guarantee section -->
<div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
    style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
</div>
<section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
    style="background-color:#2a2f34; border: 1px solid #2a2f34">
    <div class="container max-w-4xl mx-auto">
        <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload"
            data-src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png"
            alt="guarantee badge">
        <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                guaranteed.</strong></h2>

        <h6 class="leading-normal">30-Day Drummer is a NEW way to learn the drums – and for less than a month of private
            lessons, you’ll enjoy frustration-free progress to improve your timing, coordination, and musicality.
            <br><br>
            We think it’ll be your favorite drum course ever –
            <br><br>
            So even though it’s only a month, you’ll get three full months to go through everything and make sure it was
            right for you. If not, just contact our friendly support team for a full refund.
        </h6>

    </div>
</section>



 <!-- Learn the drum section -->
<section class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/30_day_drummer_logo.svg" alt="30DD logo season3 logo">
                    <h1><strong>Learn the drums <br/> with daily guided workouts.
                        </strong></h1>


                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video lazyload" style="padding-bottom: 63%;" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_thumb_no_badge_m.jpg" data-open="trailer">
                    </div>

                    <div class="flex flex-col text-base md:text-xl font-normal leading-10 py-3 md:py-5">
                        <ul>
                            <li><i class="fas fa-check text-drumeo"></i> Guided drum lessons for 30 days.</li>
                            <li><i class="fas fa-check text-drumeo"></i> Practice the right things for 10 min/day.</li>
                            <li><i class="fas fa-check text-drumeo"></i> Learn on your own schedule.</li>
                            <li><i class="fas fa-check text-drumeo"></i> Play your favorite songs.</li>
                            <li class="font-bold" style="color: #0B76DB"><i class="fas fa-check text-drumeo"></i> 90-day money-back guarantee.</li>
                        </ul>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2 my-1">
                               <a href="#final" class="join blue medium w-full anchor-slide">GET STARTED</a>
                        </div>
                        <div class="w-full sm:w-1/2 py-2 md:py-0">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Joined_profiles.png" alt="joined student profiles">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-cover bg-top bg-no-repeat cursor-pointer autoplay-video lazyload" style="padding-bottom: 98%;" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30DD2_header_no_badge_thumb.jpg" data-open="trailer">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2 class="text-2xl font-extrabold md:text-4xl leading-relaxed md:leading-10" >Still Have Questions?</h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @if(is_current_user_a_member())
                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "Why do I need to register if I get it for free as a member?",
                    "desc" => "It’s a 30-day course and it only works if you’re actively participating. So we wanted to make sure you raised your hand to enroll in the journey.<br><br>This isn’t a “watch a lesson, go do something else for 10 days, watch another” type of routine. So we’re asking for a commitment from anybody who participates.",
                    ])
                @endif 
                @include('_partials.components.question-dropdown', [
                "title" => "Do I need to attend the lessons live?",
                "desc" => "The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are totally optional, and they’ll also include a recording that you can watch or re-watch anytime.",
                'num' => '?'
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "How much time per week will this course require?",
                "desc" => "30-Day Drummer gives you guided daily drum workouts for thirty days – with flex days built in for when life happens. With each workout being 10-15 minutes, you can miss a workout and make it up the next day or later in the week.",
                'num' => '?'
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "30-Day Drummer is available on your laptop, tablet, or phone. You’ll also have access through the Musora app after you’ve completed your purchase of the course.",
                'num' => '?'
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


    @component('_partials.components.modal', ['name' => 'waitlistModal'])
        @slot('content')
            <div class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
                <p class="mb-4">Enter your email below to get notified when the <br class="hidden sm:inline">
                    next edition of 30-Day Drummer is announced. </p>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                    "formName" => '30 Day Chops Waitlist',
                    "formId" => "Drumeo - Engagement - Trigger - 30 Day Chops Waitlist - Web Form",
                    "buttonText" => "Let Me Know ",
                    "stacked" => true,
                    "noSocial" => true,
                ])
            </div>
        @endslot
    @endcomponent

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/852777053?h=87d3e7a97a&autoplay=1',
        "title" => 'trailer'
    ])

    @include("drumeo.sales.partials._footer")

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-09-04 00:00:00',
        'promoVersion' => false
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/@alpinejs/ui@3.13.1-beta.0/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/@alpinejs/collapse@3.13.1/dist/cdn.min.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.13.1/dist/cdn.min.js"></script>

@stop
