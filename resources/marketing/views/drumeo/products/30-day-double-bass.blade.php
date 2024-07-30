@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Independence | Drumeo</title>
    <meta property="og:title" content="30-Day Independence | Drumeo">
    <meta name="description" content="Improve your coordination with daily guided workouts.">
    <meta property="og:description" content="Unlock your creativity and speed around the drums.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/30-day-independence/share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
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
    @include('drumeo.sales.partials._nav', [
        'cartVersion' => true,
    ])
    @include('_partials.components.shop.promo-banner', [
        'name' => '30-Day Independence',
        'fullPrice' => floatval($productPrices['30-day-independence']->price),
        'price' => floatval($productPrices['30-day-independence']->discounted_price),
        'noBreadcrumb' => true,
    ])
    @php
        if(!empty($products['quietpad-estepario']->getStockAvailability()) && $products['quietpad-estepario']->getStockAvailability() > 250) {
            $stock = $products['quietpad-estepario']->getStockAvailability() - 250;
        }
        else {
            $stock = 'a limited amount';
        }
    @endphp

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#EFF7FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center pt-4">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp"
                        alt="30-Day Independence Logo">
                    @php
                        $lines = [
                            'Learn Double Kick',
                            'Improve Your Technique',
                            'Play Heavy Breakdowns'
                            ];
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
                                class="inline lg:hidden">starting September 2nd.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video"
                        style="padding-bottom: 63%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/header-thumb.webp');"
                        x-on:click="trailerM = true;">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer
                        </div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-drumeo"></i> Play With Real Music
                        <i class="ml-2 fas fa-check text-drumeo"></i> Drum Every Day
                        <i class="ml-2 fas fa-check text-drumeo"></i> Learn By Doing
                    </p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Play With<br>
                            Real Music</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Drum<br> Every
                            Day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Learn<br> By
                            Doing</p>
                    </div>

                    <div class="flex flex-wrap items-left sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            {{--                            <span class="join sold-out medium w-full" x-on:click="waitlistModal = true;">JOIN WAITLIST</span>--}}
                            <a href="#final" class="join blue medium w-full anchor-slide">ENROLL NOW</a>
                            <p class="opacity-50 text-xs mt-2 mb-5 sm:mb-0 hover:text-drumeo">
                                <a href="https://www.musora.com/drumeo/enrollment/30-day-double-bass">Registration is FREE for
                                    Drumeo Members.</a>
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                                alt="Image of joined student profiles in 30-Day Independence">
                            <p class="inline-block leading-tight text-sm align-middle">Join
                                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
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
                    <h4 class="px-3 lg:px-5 text-2xl"><strong>September 2nd</strong></h4>
                    <hr class="border-gray-300 my-4 md:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                    <span class="text-drumeo" x-cloak x-data="timer()" x-init="countdown()">
                        <strong>
                            <span x-cloak x-show="timeLeft > 0">
                                Enrollment closes in
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
                        <i class="far fa-fw mr-3 md:mr-0 fa-calendar-day text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> September 2nd to<br class="hidden md:inline"> September 30th</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 mb-4 md:mb-0 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-clock text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden md:inline"> for 30 days.</span>
                        </p>
                    </div>
                    <div class="flex md:block w-full md:w-auto px-4 md:px-3 justify-center">
                        <i class="far fa-fw mr-3 md:mr-0 fa-trophy text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play beginner double <br> bass beats & fills.</span>
                        </p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden">
                    PLUS you get lifetime access!</em></p>
        </div>
    </header>



    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight mb-7 sm:mb-12"><strong>Unlock your creativity <br />and speed around the drums.</strong></h2>
            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/practice.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Double Bass pushes you both physically and mentally – it’s easy to get frustrated and give up. That’s why 30-Day Double Bass starts slow and builds your muscles and coordination over 30 days with daily practice. ',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/schedule.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Double Bass fits any schedule. You only need 10-minutes per day to build your endurance and coordination.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/music.webp',
                        'title' => 'Play with real music.',
                        'desc' =>
                            'No more painfully dry exercises set to MIDI playalongs. 30-Day Double Bass includes custom-made music by acclaimed drum composer, Kaz Rodriguez. He’s crafted the perfect song to develop smooth, even feet on the drums.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/q%26a.webp',
                        'title' => 'Live support from REAL teachers.',
                        'desc' =>
                            'Each week you’ll have a 60-minute live lesson with 66Samus. Ask questions, get feedback, and connect with other students – you’re learning with students from around the world. Grab a cup of coffee and hang with your drum teacher? Yes please. ',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/lifetime.webp',
                        'title' => 'Lifetime access.',
                        'desc' =>
                            'You can access ALL playalongs, charts, and lessons from 30-Day Double Bass for life. That means you can return to your favorite double kick workouts over and over – plus, it means you can work at your own pace.',
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
                    <i class="fas fa-check text-drumeo mr-5"></i> Daily guided drum workouts<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Weekly LIVE Q&A workshops<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-drumeo mr-5"></i> Guaranteed results
                </h4>
            </div>

            <a href="#final" class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>
            {{--                <a href="#final" class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" x-on:click="waitlistModal = true;">JOIN WAITLIST</a><br>--}}

            <img class="h-7 mr-1 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                alt="Image of joined student profiles in 30-Day Independence">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join
                {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>

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
                    <h3 class="leading-tight text-center sm:text-left"><strong>Get LIVE support<br> every step of the
                            way.</strong></h3>
                    <h6 class="leading-normal mt-3 sm:mt-5 lg:mt-7 mb-5 sm:mb-7 lg:mb-10">If you have questions about your
                        lessons, you can ask your instructor at each week’s LIVE Q&A event. 66Samus will be there to
                        help you through any sticking points and keep you motivated to complete the full course.</h6>
                    <div class="text-center sm:text-left">
                        <h6 class="inline-block uppercase mb-2 lg:mb-0"><strong>JOIN 66Samus LIVE: <i
                                    class="fas fa-arrow-down text-drumeo mx-2 inline lg:hidden"></i> <i
                                    class="fas fa-arrow-right text-drumeo mx-2 hidden lg:inline"></i></strong></h6><br
                            class="inline lg:hidden">

                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">
                                <strong>SEPT</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">8</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">
                                <strong>SEPT</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">15</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">
                                <strong>SEPT</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">22</strong></p>
                        </div>
                        <div class="align-middle bg-white text-center rounded-lg inline-block overflow-hidden w-11 mr-2">
                            <p class="leading-none tracking-tighter text-xs py-0.5 text-white bg-drumeo">
                                <strong>SEPT</strong></p>
                            <p class="leading-none text-lg py-1 text-black"><strong class="font-black">29</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img
                    class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp"
                    alt="30-Day Independence Logo"> <strong> is designed for:</strong></h2>

            @php
                $drummers = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/intermediate.webp',
                        'title' => 'Beginner Double Pedal Players.',
                        'description' =>
                            'Always wanted to play rock and metal songs? 30-Day Double Bass will help you learn the basic coordination and stamina you need to play 8th and 16th note kick patterns to REAL music.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/drumeo/products/30-day-independence/beginner.webp',
                        'title' => 'Intermediate Drummers.',
                        'description' =>
                            'So you can play The Beatles and Nirvana but really want to explore the world of Van Halen, Mötley Crüe and Metallica. 30-Day Double Bass starts you down the path of rock & metal on the drums. ',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/advanced.webp',
                        'title' => 'Advanced Drummers',
                        'description' =>
                            ' If you’re solid on a single pedal but looking for a new challenge, 30-Day Double Bass will open up a new world of music to you. By the end, you’ll be playing new grooves & fills on your feet with control and musicality.',
                    ],
                ];
            @endphp

            <div class="flex flex-col sm:flex-row text-left justify-center">
                @foreach ($drummers as $drummer)
                    <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                        <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                            style="background-image:url('{{ $drummer['image'] }}'); object-position: 60% 0">
                            <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong><img
                                        class="h-8 transition-opacity opacity-0" loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/plus.svg"
                                        alt="plus icon"><br>{{ $drummer['title'] }}</strong></h6>
                            <div class="absolute inset-0 z-0"
                                style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                        </div>
                        <p class="leading-normal mt-3">{{ $drummer['description'] }}</p>
                    </div>
                @endforeach
            </div>


            <h2 class="mt-10 lg:mt-24 mb-3"><strong>Playing makes perfect.</strong></h2>
            <h6 class="leading-normal mb-14 md:mb-11">For less than the cost of monthly private lessons<br
                    class="hidden sm:inline"> you’ll get a 30-day program to transform your drumming.</h6>

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
                                alt="30 day drummer logo"></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tl-xl"><strong>Private<br> Lessons</strong>
                        </td>
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
                        <td>Lifetime</td>
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
                        <td class="rounded-b-xl">
                            <strong>${{ floatval($productPrices['30-day-drummer-4']->discounted_price) }}</strong><br>
                            <span class="text-xs">Single Payment</span></td>
                        <td class="rounded-bl-xl"><strong>$30-$100</strong><br> <span class="text-xs">Per
                                    Lesson</span></td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
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

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Samus Paulicelli<br> (aka 66Samus)</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">66Samus is the hero the metal community deserves.
                        <br><br>
                        His world-class double bass work and infectious sense of humor have inspired millions of drummers and garnered +200 million views on his YouTube Channel. And more than entertainment, Samus is a renowned educator.
                        <br><br>
                        His beginner double bass videos have become go-to resources for drummers of all levels looking to learn drumming’s most coveted skill.
                        <br><br>
                        You’re in good <s class="opacity-70">feet</s> hands with 66Samus.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
                                alt="tiktok icon">
                            <h3 class="mt-2"><strong>463K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg"
                                alt="insta icon">
                            <h3 class="mt-2"><strong>368K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>218M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: linear-gradient(180deg, #0B76DB 0%, #063F75 100%);">
        <div class="container max-w-5xl mx-auto">
            No pedal? No problem.
            <p class="leading-tight">The right tools are essential to your craft.
            <br><br>
            That’s why we’ve partnered with Pearl to bring you the highest-rated beginner double bass pedal bundled with 30-Day Double Bass.
                <br><br>
            The Pearl P932 Demonator has premium-quality features at an entry-level price point:</p>
            <ul>
                <li><strong>Single-chain drive</strong> for a lightweight, responsive action so you can develop speed and control in your playing.</li>
                <li><strong>A longer footboard</strong> gives you more room to experiment with different techniques and find what works best for you.</li>
                <li><strong>Interchangeable cam</strong> and <strong>adjustable beater angle</strong> let you find the perfect settings for a natural feel and response.</li>
            </ul>
            <p>Here’s what people are saying about the Pearl Demonator Double Pedal:</p>

        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png"
                alt="guarantee badge">
            <div class="flex justify-center items-center">
                <img class="h-96 sm:order-1 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png">
                <div class="sm:pr-8">
                    <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                            guaranteed.</strong></h2>

                    <h6 class="leading-normal">30-Day Double Bass is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
                        <br><br>
                        We think it’ll be your favorite drum course ever –
                        <br><br>
                        So even though it’s only a month, you’ll get three full months to go through everything and make sure it was right for you. If not, just contact our friendly support team for a full refund.
                    </h6>
                </div>

            </div>
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

            <!-- <span class="join sold-out medium w-full max-w-xs align-middle mt-7" @click="waitlistModal = true;">JOIN WAITLIST</span> -->

            <!-- Version 1 -->
            <h6 class="leading-normal mb-4 text-drumeo">
                <strong x-cloak x-data="timer()" x-init="countdown()">
                    <span x-cloak x-show="timeLeft > 0">
                    Enrollment closes in
                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                            x-text="dayText"></span></span>
                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                            x-text="hourText"></span></span>
                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                            x-text="minuteText"></span></span>
                    <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                            x-text="secondText"></span></span>!</span>
                    <span x-cloak x-show="timeLeft < 0">A Limited Time!</span>
                </strong>
            </h6>



            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                alt="Image of joined student profiles in 30-Day Independence">
            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }}
                drummers who<br class="sm:hidden"> have already registered.</p>

            @include('drumeo.products.partials._promo-cards', [
                'firstDeal' => '30-Day Independence',
                'firstDealImage' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/bundle-01.webp',
                'firstImageHeight' => 'h-36 lg:h-40',
                'firstDealPrice' => 97,
                'firstDealSub' => 'Just the course + 2 bonuses worth $42.95',
                'firstDealLink' => '/ecommerce/add-to-cart?products[30-day-independence]=1&products[Drumeo-VaterSticks]=1&products[drumeo_access_30-days]=1&locked=true',
                'firstButtonText' => 'ENROLL NOW',
                'firstDealExtra' => "One-time payment",
                'whiteBg' => 'false',
                'firstExtraBonuses' => [
                    '<strong>30-Day Independence</strong>',
                    '<strong>Free</strong> Drumeo 5A Drumsticks',
                    '<strong>Free</strong> 1-month Drumeo Access',
                ],

                'topBadge' => 'MOST POPULAR',
                'secondDeal' => 'Unlimited Lessons',
                'secondDealImage' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/bundle-02.webp',
                'secondImageHeight' => 'h-36 lg:h-40',
                'secondDealSub' => "1 year of Drumeo + 5 bonuses worth $258.94",
                'secondDealPrice' => '20/mo',
                'secondDealLink' =>
                    '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-independence]=1&products[quietpad]=1&products[padstand]=1&products[Drumeo-VaterSticks]=1&products[easy-rudiments-book]=1&locked=true',
                'secondExtraBonuses' => [
                    '<strong>Annual Drumeo Membership</strong>',
                    '<strong>Free 30-Day Independence</strong>',
                    '<strong>Free</strong> Drumeo QuietPad',
                    '<strong>Free</strong> Drumeo PadStand',
                    '<strong>Free</strong> Drumeo 5A Drumsticks',
                    '<strong>Free</strong> Easy Rudiments Book',
                ],
                'secondButtonText' => 'GET EVERYTHING',
                'secondDealExtra' => "Billed annually at $240/yr.",
            ])

            <a class="mt-10 inline-block" href="/ecommerce/add-to-cart?products[30-day-independence]=1&products[drumeo_access_30-days]=1&locked=true"><u class="text-drumeo">Don’t want a free bonus? Click here to get just digital access to 30-Day Independence ($97).</u></a>
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
