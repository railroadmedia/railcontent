@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Drummer | Drumeo</title>
    <meta property="og:title" content="30-Day Drummer | Drumeo">
    <meta name="description" content="Learn the drums with daily guided workouts.">
    <meta property="og:description" content="Learn the drums with daily guided workouts.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/30-day-drummer/season-4/share-image.jpg" style="display: none;">
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
    modal: {{ empty(user()) ? true : false }},
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
                "name" => "30-Day Drummer",
                "fullPrice" => floatval($productPrices['30-day-drummer-3']->price),
                "price" => floatval($productPrices['30-day-drummer-3']->discounted_price),
                "noBreadcrumb" => true
            ])

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=420,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer_logo.png" alt="30DD logo season3 logo">
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

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the next class <br class="inline lg:hidden">starting Feb 26th.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video"
                        style="padding-bottom: 63%; background-image:url(https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-drummer/season-4/header-thumb-m.png);"
                        data-open="trailer">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-drumeo"></i> Improve Your Skills
                        <i class="ml-2 fas fa-check text-drumeo"></i> Drum Every Day
                        <i class="ml-2 fas fa-check text-drumeo"></i> Learn By Doing</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Improve<br> Your Skills</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Drum<br> Every Day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Learn<br> By Doing</p>
                    </div>
                    @if(session()->has('success-message'))
                        <p class="mb-3 lg:-mb-7 mt-3 text-drumeo text-center"><strong>Congrats! You have registered for 30-Day Drummer.<br class="hidden md:inline"> Check your email for the details.</strong></p>
                    @endif

                    @if(!$hasProduct && is_current_user_a_member())
                        {{--                        <p class="mb-3 lg:-mb-7 mt-5 mb-2 text-drumeo text-left"><strong>You are a Drumeo member! <br>Enroll for free by clicking on the button below.</strong></p>--}}
                    @endif

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            {{--                            <span class="join sold-out medium w-full" data-open="waitlistModal">JOIN WAITLIST</span>--}}
                            <a href="#final" class="join blue medium w-full anchor-slide">ENROLL NOW</a>
                            <p class="opacity-50 text-sm mt-2 mb-5 sm:mb-0 underline hover:text-drumeo">
                                <a href="{{ get_musora_brand_base_url() }}/30-day-drummer">Drumeo Members register for free here.</a>
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Joined_profiles.png" alt="joined student profiles">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl overflow-hidden relative {{-- bg-cover --}} bg-contain bg-center bg-no-repeat cursor-pointer autoplay-video" style="padding-bottom: 98%; background-image:url(https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/marketing/drumeo/products/30-day-drummer/season-4/header-thumb.png);" data-open="trailer">
                        <div class="join white smaller absolute {{-- bottom-1 --}} bottom-2 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap md:flex-nowrap text-center border rounded-lg border-gray-300 mt-6 lg:mt-8 mb-2 lg:mb-4">
                <div class="w-full md:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 md:py-3 lg:py-4">
                    <p class="tracking-wide opacity-70 text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5"><strong>February 26th</strong></h4>
                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                        Enrollment closes in<br class="inline lg:hidden">
                        <span class="text-drumeo" x-cloak x-data="timer()" x-init="countdown()">
                                 <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                 <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                 <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
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
                            <span class="text-sm"> February 26th to<br class="hidden md:inline"> March 25th</span></p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-clock text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span></p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play your favorite songs<br> with excellent timing & feel.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>

    <section class="py-10 sm:py-14 lg:py-20 bg-drumeo">
        <h3 class="mb-4 text-center text-white"><strong>17,000+ Drummers Agree...</strong></h3>
        <p class="text-white mb-2 md:mb-3 px-4 lg:px-0 text-center">30-Day Drummer works. By focusing on playing with real music right from day one, you’ll learn the <br class="hidden lg:inline">skills to play hundreds of songs on the drums in just thirty days. Check out what students are saying:</p>
        <div class="max-w-5xl mx-auto px-5 sm:px-6 mb-10 sm:mb-0">
            <div
                x-data="{
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
                                    drag   : 'free',
                                    snap   : false,
                                },
                            },
                        }).mount()
                    },
                }"
            >
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
                                        <img class="rounded-full w-[90px] h-[90px] object-cover lazyload" data-src="https://www.musora.com/musora-cdn/image/width=130,quality=95/{{ $testimonial['img'] }}" alt="{{ $testimonial['name'] }} avatar" />
                                    </div>
                                    <h6 class="mb-1 font-extrabold">{{ $testimonial['name'] }}</h6>
                                    <p><i>Season {!! $testimonial['season'] !!} Student</i></p>
                                    <img class="my-4" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/stars.svg" alt="stars" />
                                    <p class="mb-6">“{!! $testimonial['comment'] !!}”</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-10 sm:h-20 {{--mt-10 sm:mt-16 lg:mt-24--}} mb-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Just_Press_Play_logo.png" alt="just press play logo">
            <h6 class="leading-normal mb-20 lg:mb-28">30-Day Drummer is a NEW way to learn the drums – where you learn by <em>actually</em> playing the drums. By focusing on <b>timing & coordination</b>, you’ll build your skills over thirty days following daily guided workouts with your instructor, Domino Santantonio.
                <br><br>
                <b>And the best part is you only need 10 minutes per day.</b></h6>
            @php
                $gettings = [
                    [
                    'position' => 'left',
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/marketing/drumeo/products/30-day-drummer/season-4/calendar.jpg',
                    'title' => 'Know exactly what to practice.',
                    'desc' => '30-Day Drummer gives you guided play-along workouts every day for thirty days. You’ll know exactly what to work on every time you sit at the drums or practice pad.',
                    'special' => true,
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/practice.jpg',
                    'title' => 'Focused practice time.',
                    'desc' => 'Each exercise includes a countdown timer that tells you exactly how long to practice for. This means you can turn off all distractions and focus on your drumming.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/q%26a.jpg',
                    'title' => 'Your questions answered.',
                    'desc' => 'You won’t be left hanging. Domino will be answering your questions every Saturday to make sure you keep moving forward (and have as much as possible!).',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/lifetime.jpg',
                    'title' => 'Lifetime access.',
                    'desc' => '30-Day Drummer can become part of your practice routine forever. You’ll have lifetime access to ALL the workouts and Q&A sessions from your class to access anytime you like.',
                    ],
                ];
//            @endphp
            <div class="timeline-container max-w-3xl lg:max-w-4xl mx-auto relative px-4 sm:pb-14 lg:pb-20 mt-5">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 @if($key !== 3) md:mb-28 @else md:mb-0 @endif">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            @if(empty($getting['special']))
                                <img class="-mt-7 rounded-lg lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="text-center -mt-10 sm:mt-0 mb-32 sm:mb-48 lg:mb-72">
                <img class="h-10 sm:mt-2 mb-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=60,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Bonus_Icon.svg" alt="bonus icon">
                <p class="text-drumeo"><strong>LIMITED TIME BONUS</strong></p>
                <img class="h-16 sm:h-20 my-3 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/headshot.jpg" alt="headshot"><br>
                <h4><strong>Performance review by Domino!</strong></h4>
                <p class="max-w-sm leading-normal mt-4">You can submit a video of yourself performing for the chance to get a personalized review from Domino!</p>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96 mb-14" data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/video-reel2.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-28 sm:h-36 lg:h-48 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=760,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer_logo.png" alt="30DD logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-drumeo mr-5"></i> Daily guided drum workouts<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Weekly LIVE Q&A workshops<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Guaranteed results</h4>
            </div>
            @if(session()->has('success-message'))
                <p class="-mb-2 sm:-mb-8 mt-5 text-drumeo text-center"><strong>Congrats! You have registered for 30-Day Drummer.<br class="hidden md:inline"> Check your email for the details.</strong></p>
            @endif
            {{--            <span class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" data-open="waitlistModal">JOIN WAITLIST</span><br>--}}
            @if($hasProduct)
                <a class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3">YOU'RE ENROLLED</a><br>
            @else
                <a
                    href="#final"
                    class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>
            @endif
            <img class="h-7 mr-1 mb-5 sm:mb-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Joined_profiles.png" alt="joined student profiles">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>

        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-12 mb-4 sm:-mb-24 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Screen.png" alt="screen">
                <div class="flex-grow sm:pl-7">
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get LIVE support<br> every step of the way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your lessons, you can ask your instructor at each week’s LIVE Q&A event. Domino will be there to help you through any sticking points and keep you motivated to complete the full course.</h6>
                    <div class="text-center sm:text-left">
                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>Join Domino LIVE: <i class="fas fa-arrow-down text-drumeo mx-2 inline lg:hidden"></i> <i class="fas fa-arrow-right text-drumeo mx-2 hidden lg:inline"></i></strong></h6><br class="inline lg:hidden">

                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">2</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">9</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">16</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo"><strong>MAR</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">23</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom lazyload" data-src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer_logo.png" alt="30 day drummer logo"> <strong>...is designed for:</strong></h2>
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:w-1/4 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/new_drummers.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon"><br>New<br class="hidden sm:inline lg:hidden"> Drummers</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">If you’re picking up drums for the first time, 30-Day Drummer is perfect for you. From lesson one, you’ll be learning skills to help you play with REAL music.</p>
                </div>
                <div class="w-full sm:w-1/4 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/returning_drummers.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon"><br>Returning<br class="hidden sm:inline lg:hidden"> Drummers</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Get BACK into drumming by focusing on timing & feel. You’ll build a strong foundation to play your favorite songs with confidence.</p>
                </div>
                <div class="w-full sm:w-1/4 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/experienced_drummers.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon"><br>Experienced<br class="hidden sm:inline lg:hidden"> Drummers</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">If you already play the drums, 30-Day Drummer will help you revisit the fundamentals. You’ll be focusing on beginner beats but playing them with precision.</p>
                </div>
                <div class="w-full sm:w-1/4 px-2">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/other_musicians.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg" alt="plus icon"><br> Other<br class="hidden sm:inline lg:hidden"> Musicians</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Learning the drums can help existing musicians improve their rhythm. You’ll skip the theory and get right into playing the drums with music from day one.</p>
                </div>
            </div>


            <h2 class="mt-20 lg:mt-24 mb-3"><strong>Playing makes perfect.</strong></h2>
            <h6 class="leading-normal mb-11">For less than the cost of monthly private lessons<br class="hidden sm:inline"> you’ll get a 30 day program to transform your drumming.</h6>

            <div class="relative">
                <p class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=220,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Logo_white.png" alt="30 day drummer logo"></td>
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
                        @if(is_current_user_a_member())
                            <td class="rounded-b-xl"><strong>FREE</strong><br> for Drumeo<br class="inline lg:hidden"> Members</td>
                        @else
                            <td class="rounded-b-xl"><strong>${{ floatval($productPrices['30-day-drummer-2']->discounted_price) }}</strong></td>
                        @endif
                        <td class="rounded-bl-xl"><strong>$30-$100</strong><br> per lesson</td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #d70b3b calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #d70b3b, #9d1032);">
        <div class="container max-w-2xl mx-auto">
            <div class="-mt-14 sm:-mt-20 lg:-mt-28 mb-7">
                <img class="block h-20 sm:h-24 mx-auto lazyload animated infinite bounce slower" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Important_Icon.svg" alt="important icon">
            </div>
            <h1 class="font-bebas text-5xl sm:text-6xl lg:text-7xl">FAIR WARNING</h1>
            <h6 class="leading-normal  mt-4">30-Day Drummer is a daily guided workout program for drummers — where you’ll get a new video each weekday and a live session each weekend throughout the month. Because of this, students will not be able to join midway — <strong>and you need to register before the course begins on February 26th.</strong></h6>
            <h4 class="mt-8 py-1.5 w-full font-bebas uppercase inline-block mx-auto" style="background-color:#fd5;color:#9d1032;">
                REGISTRATION CLOSES IN<br class="inline sm:hidden">
                <span x-cloak x-data="timer()" x-init="countdown()">
                                         <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                         <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                         <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                         <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                         <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                     </span>
            </h4>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 130%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
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
                            <h3 class="mt-2"><strong>23M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                            <h3 class="mt-2"><strong>505k</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What drummers are saying:</strong></h3>
            <div class="flex flex-wrap text-left">
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/LARNELL-LEWIS-HEAD-1641315158.jpg" alt="Larnell lewis">
                        <p class="pl-4"><strong>Larnell Lewis</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">Grammy-winner, Snarky Puppy</em><br>
                            “Domino’s passion for drumming is infectious! It’s a great reminder that all we need is a love for music and drums to get started!”
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/281911-avatar-1609277722.png" alt="Matt Mcguire">
                        <p class="pl-4"><strong>Matt McGuire</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">The Chainsmokers</em><br>
                            “I genuinely enjoy watching Domino play, you can see the pure love for what she does. This program not only provides education, I'm sure you'll be entertained throughout the process.”
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/dorothea-thumb-1656515788.jpg" alt="Dorothea Taylor">
                        <p class="pl-4"><strong>Dorothea Taylor</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">The Godmother Of Drumming,<br> Educator for 50+ years</em><br>
                            “Domino plays drums with high energy & passion which shows how much fun playing drums can be.”
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/31880-avatar-1557351774.jpg" alt="Jared Falk">
                        <p class="pl-4"><strong>Jared Falk</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">Drumeo Co-Founder</em><br>
                            “Every-time I watch and listen to Domino Santantonio play drums I smile. She plays with joy, teaches with passion, and inspires drummers to take action.”
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png" alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course, guaranteed.</strong></h2>

            <h6 class="leading-normal">30-Day Drummer is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your timing, coordination, and musicality.
                <br><br>
                We think it’ll be your favorite drum course ever –
                <br><br>
                So even though it’s only a month, you’ll get three full months to go through everything and make sure it was right for you. If not, just contact our friendly support team for a full refund.</h6>

        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container mx-auto relative z-50">
            <img class="h-20 sm:h-28 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=450,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/30_day_drummer_logo.png" alt="30DD season 2">
            <h2 class="leading-tight mt-2 mb-3 sm:my-3 lg:my-4"><strong>Learn the drums with daily guided workouts.</strong></h2>

            <h6 class="leading-normal mb-4">
                <strong>EARLY BIRD SPECIAL:</strong> Get a free practice & sticks <br class="hidden sm:inline md:hidden">when you enroll before February 19th.
                <br>
                <span class="text-drumeo">Enrollment closes in
                    <span class="text-drumeo" x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>!</span>
            </h6>

            <div class="flex flex-wrap items-center mt-7 sm:mt-10">
                <div class="flex flex-wrap sm:flex-nowrap items-center text-left w-full max-w-3xl mx-auto xl:w-7/12">
                    <a href="/ecommerce/add-to-cart?products[30-day-drummer-4]=1&locked=true" class="px-5 sm:px-7 lg:px-9 py-7 sm:py-9 mb-7 sm:mb-0 rounded-xl shadow-lg w-full sm:w-1/2" style="background-color:#d4eaff;">
                        <h3><strong>30-Day Drummer</strong></h3>
                        <p class="text-sm mt-2 mb-5">Just The Course (SAVE 61%)</p>
                        <h2 class="inline-block"><s class="opacity-60">$127</s> <strong class="text-4xl">${{ 50 }}</strong></h2> <p class="inline-block text-xs">one time payment.</p><br>
                        <div class="join blue smaller mt-4">ENROLL NOW</div>
                        <hr class="w-full my-5" style="border-color:#b2cae1">
                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>
                            <i class="fas fa-check text-drumeo mr-1"></i> Runs February 26 to March 25<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> 24 Guided Workouts<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> 4 Live Q&A Sessions<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> Lifetime Course Access<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> 90-Day Money Back Guarantee</p>
                    </a>
                    <a href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-drummer-4]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[BeginnerBook]=1&locked=true" class="px-5 sm:px-7 lg:px-9 py-7 sm:py-11 sm:-ml-5 z-10 relative rounded-xl bg-white shadow-lg w-full sm:w-1/2">
                        <h3><strong>Unlimited Lessons</strong></h3>
                        <p class="text-sm mt-2 mb-5">1 Year of Drumeo + 5 Bonuses worth $231.89.</p>
                        <h2 class="inline-block"><strong class="text-4xl">$20</strong>/mo</h2> <p class="inline-block text-xs">Billed annually at $240/yr.</p><br>
                        <div class="join blue smaller my-4">GET EVERYTHING</div>
                        <ul class="list-disc ml-10">
                            <li class="text-sm leading-relaxed">Drumeo Annual Membership</li>
                            <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> 30-Day Drummer</li>
                            <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> QuietPad Practice Pad</li>
                            <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> 5A Drumsticks</li>
                            <li class="text-sm leading-relaxed"><span class="text-drumeo">Free</span> Best Beginner Drum Book</li>
                        </ul>
                        <hr class="w-full my-5" style="border-color:#ebf2f8">
                        <p class="leading-loose text-sm"><strong>Drumeo Membership includes:</strong><br>
                            <i class="fas fa-check text-drumeo mr-1"></i> 10-Level Drumeo Method Curriculum<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> Play Along To 5000+ Popular Songs.<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> Study With 300+ World-Class Drummers.<br>
                            <i class="fas fa-check text-drumeo mr-1"></i> 90-Day Money Back Guarantee</p>
                    </a>
                </div>
                <div class="flex w-full justify-center xl:justify-start xl:order-1 xl:w-5/12 xl:pl-4  mt-10 xl:mt-0">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/marketing/drumeo/products/30-day-drummer/season-4/collage.png" alt="order collage image">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
        <p class="max-w-3xl px-4 md:px-2 leading-loose">
            <i class="fas fa-info-circle text-drumeo" aria-hidden="true"></i> <b>Shipping Disclaimer –</b> Your physical bonuses may not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is up to the shipping gods.
        </p>
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
                "title" => "Do I need to attend the lessons live?",
                "desc" => "The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are totally optional, and they’ll also include a recording that you can watch or re-watch anytime.",
                'num' => '?'
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What if I’m going to miss a day (or two, or more)?",
                "desc" => "That’s totally fine. The course is meant to be flexible if you miss a day here or there. There are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session if you ever need to catch up.",
                'num' => '?'
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "Do I need a full drum set to complete the course?",
                "desc" => "The lessons work on both electric and acoustic drum sets. While you can even get value with just a practice pad & sticks, it’s recommended that you have access to a drum set to get the most from this course.",
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

    <div id="healthy" class="anchor"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-16 lg:py-20" style="background:linear-gradient(to bottom, #0b76db, #074c8e);">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Your brain on drums.</strong></h2>
            <h6 class="leading-tight sm:leading-normal max-w-2xl mt-6 mb-8 sm:mb-20"><strong>The evidence is piling up.</strong><br><br>
                Playing the drums is one of the healthiest activities you can perform for your brain – showing signs of boosting happiness, intelligence, and overall well being. 30-Day Drummer will help you tap into the benefits of playing the drums with a guided plan and flexible schedule.</h6>

            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="w-full sm:w-1/3 px-4 mb-6 sm:mb-0">
                    <img class="h-16 mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=120,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/RCM_logo.svg" alt="RCM logo">
                    <p>“Research by the Royal College of Music has found that drumming has a positive impact on mental health, with a 10-week programme of group drumming reducing depression by as much as 38% and anxiety by 20%.”</p>
                </div>
                <div class="w-full sm:w-1/3 px-4 mb-6 sm:mb-0">
                    <img class="h-16 mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Economist_logo.svg" alt="Economist logo">
                    <p>“Music is good for the health. And drumming may be best of all. As well as being physically demanding, it requires people to synchronize their limbs and to react to outside stimuli”</p>
                </div>
                <div class="w-full sm:w-1/3 px-4">
                    <img class="h-16 mb-4 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/iHeart_logo.svg" alt="iHeart logo">
                    <p>“Drummers scored higher on an intelligence test and showed a correlation between using multiple limbs to keep a steady beat and a natural ability to problem solve.”</p>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/884916532?h=87d3e7a97a&autoplay=1',
        "title" => 'trailer'
    ])

    @include("drumeo.sales.partials._footer")

    @include('_partials.components.countdown',[
        'countdownDate' => '2024-02-26 00:00:00',
        'promoVersion' => false
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
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

@stop
