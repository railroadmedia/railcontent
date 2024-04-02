@extends('pianote._partials.global-layout')

@section('global-head')
    <title>30 Day to Better Technique | Pianote</title>
    <meta property="og:title" content="30 Day to Better Technique | Pianote">

    <meta name="description"
        content="30 Days to Better Technique is the first guided piano technique course that will have you playing WITH a world-class instructor - Jordan Rudess.">
    <meta property="og:description"
        content="30 Days to Better Technique is the first guided piano technique course that will have you playing WITH a world-class instructor - Jordan Rudess.">

    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/share-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .join,
        .join:hover {
            background-color: #F61A30;
            border-color: #F61A30;
        }

        .join.musora,
        .join.musora:hover {
            background-color: #FFAE00;
            border-color: #FFAE00;
            color: #000;
        }

        .join.outline.red {
            border-color: #F61A30;
            color: #0b76db;
        }

        .join.smaller.outline {
            padding: 12px 7%;
            border-color: #F61A30;
            background-color: rgb(18, 18, 6, 0.3);
        }

        .join.smaller.outline:hover {
            background-color: #F61A30;
            color: #FFFFFF;
        }

        .join i {
            transition: all .3s;
            position: relative;
            right: 0;
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }
        .play-button {
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

    </style>
@stop

@section('body-data')
    x-data="{
        trailerLeft: false,
        trailerRight: false,
        trailerM: false,
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="30 Day to Better Technique Logo" class="h-20 md:h-28 lg:h-44 my-4 md:my-10"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/header-logo.svg"><br>
                <p class="text-sm md:text-2xl italic">What would happen if you learned piano from <br> the <strong> best
                        keyboardist in the world?</strong></p>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-pianote hover:text-white"
                        @click="trailer = true;">
                        &nbsp;Watch Trailer
                    </div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-pianote hover:text-white"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailerM = true;">
                         &nbsp;Watch Trailer
                    </div>
                    <a class="w-5/12 join smaller text-white bg-pianote m-2 hover:bg-red-500" href="#customize-anchor"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false">ENROLL NOW</a>
                </div>
            </div>
            <div class="uppercase text-sm text-pianote py-4">
                <span x-cloak x-data="timer()" x-init="countdown()">
                    <span>
                        Enrollment closes in
                        <br>
                        <strong>
                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                    x-text="dayText"></span></span>
                            <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                    x-text="hourText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                    x-text="minuteText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                                    x-text="secondText"></span></span>
                        </strong>
                    </span>
                </span>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(2, 11, 22, 0.7)"></div>
        <img class="object-cover w-full relative z-0" style="height: 700px;"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/hero-image.jpeg"
            alt="Description of the image">
        <!-- <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop
                        playsinline muted
                        src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/book-bag/book-bag-hero-reel-wide-to-loop-1.mp4"></video> -->


    </header>

    @php
        $items = ['Improve Your <br class="hidden md:inline lg:hidden"> Playing', '30 Days of <br class="hidden md:inline lg:hidden"> Lessons', 'Practice with <br class="hidden md:inline lg:hidden"> Jordan', 'Guaranteed <br class="hidden md:inline lg:hidden"> results'];
    @endphp

    <section class="bg-black text-white p-4 md:px-20">
        <div class="container max-w-4xl mx-auto flex flex-wrap md:flex-center justify-center ">
            @foreach ($items as $item)
                <div class="flex flex-col items-center justify-center p-2 uppercase text-center md:w-1/4">
                    <p class="mb-2"><i class="fa fa-check text-pianote"></i> {!! $item !!}</p>
                </div>
            @endforeach
        </div>

    </section>

    <section class="" style="background: #ffffff;">
        <div class="container max-w-4xl mx-auto py-4 md:py-10 flex justify-center flex-col md:flex-row">
            <div class="flex flex-col items-center md:hidden">
                <h2 class="my-6 text-center text-5xl pb-2"><strong>Technique is <br/> <span class="underline">everything.</span>  </strong></h2>
                <video
                    src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/30-day-better-technique/gif-header-white.mp4"
                    muted="" autoplay="" loop="" playsinline="" class="w-2/3"></video>
            </div>

            <div class="sm:mb-10 md:w-2/3 p-4">
                <h2 class="text-center hidden md:inline"><strong>Technique is 
                    <span class="underline">everything.</span>  </strong></h2>

                <p class="text-black pt-10">
                    It’s the foundation that will allow you to build your skills and abilities on the piano. It’s the key
                    that unlocks that feeling of musical freedom when your fingers feel like they have a mind of their own.
                    <br><br>
                    And the good news is…
                    <br><br>
                    You can build your technique and break through those walls WITHOUT spending hours each day playing
                    exercises that haven’t changed in the past 200 years.
                    <br><br>
                    It doesn’t take months and years of daily scale practice that make the rest of your household invest in
                    earplugs.
                    <br><br>
                    And it doesn’t take thousands of dollars spent on private lessons.
                    <br><br>
                    All it takes…
                    <br><br>
                    <strong>Is 30 days.</strong>
                </p>
            </div>
            <div class="md:w-1/3 p-4 sm:-mb-24">
                <video class="hidden md:inline relative top-0 rounded-xl overflow-hidden"
                    src="https://d21q7xesnoiieh.cloudfront.net/marketing/pianote/products/30-day-better-technique/gif-header-white.mp4"
                    muted="" autoplay="" loop="" playsinline=""></video>
            </div>

        </div>

    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #EFF2F6 calc(50% + 1px));">
    </div>
    <section class="text-center px-4 sm:px-6 py-10 sm:pt-14" style="background-color: #EFF2F6;">
        <div class="container max-w-3xl mx-auto">
            <h2 class="leading-normal"><strong>In just 30 days, <br />you’ll be able to:</strong></h2>



            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/fingers.jpeg',
                        'title' => 'Separate your fingers',
                        'desc' =>
                            '<strong>Separate your fingers</strong> so they play what YOU want them to play. Your pinky and ring fingers will finally quit their co-dependent relationship and learn how to live healthily without each other.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/approach.webp',
                        'title' => 'Approach your piano practice',
                        'desc' =>
                            'Approach your piano practice in a way that’s <strong>musical</strong> -- and enhances your ear as well as your fingers.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/marketing/pianote/products/30-day-better-technique/speed.webp',
                        'title' => 'Boost your speed',
                        'desc' =>
                            '<strong>Boost your speed and accuracy </strong>around the keyboard. You’ll learn practice secrets normally reserved for the greatest piano schools in the world.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/fluidity.webp',
                        'title' => 'Move around the keyboard',
                        'desc' =>
                            '<strong>Move around the keyboard</strong> with greater fluidity and independence. Playing will feel fun again, and you’ll be excited about the potential for the future.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/lifetime.webp',
                        'title' => 'Return to a technique routine',
                        'desc' => 'Return to a technique routine that will <strong>last you a <span class="text-pianote">lifetime<span></strong>.',
                    ],
                ];
            @endphp
            <div class="max-w-4xl mx-auto relative md:pb-10 mt-5 pt-6">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 mb-16 @if ($key !== 4) md:mb-20 @else md:mb-0 @endif">
                            <div class="content relative flex items-center text-left">
                                <p>{!! $getting['desc'] !!}</p>
                            </div>
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div class="relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 mb-16 md:mb-20">
                            @if (empty($getting['special']))
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                    alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                    style="background-image:url('{{ $getting['img'] }}')"></div>
                            @endif
                            <div class="content relative flex items-center text-left md:mb-10">
                                <p>{!! $getting['desc'] !!}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <h3 class="uppercase text-pianote">And you’ll have <br class="block md:hidden"> learned all <br
                class="hidden md:block"> these things from...</h3>
    </section>

    <div class="text-white flex flex-col items-center justify-center md:flex-row md:items-center md:justify-center py-4"
        style="background: linear-gradient(90deg, #F61A30 0%, #632127 100%);">
        <p class="uppercase text-center text-2xl lg:text-3xl xl:text-5xl">
            <strong>
                “The greatest <br class="inline md:hidden"> keyboardist of all time”
            </strong>
        </p>
        <p class="italic text-xs md:text-sm md:mt-auto">
            ~ MusicRadar Magazine
        </p>
    </div>

    <section class="flex flex-col items-center text-white" style="background-color: #00101D;">
        <img class="w-full hidden md:inline"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/coach.webp"
            alt="Jordan Rudess Photo">
        <img class="w-full inline md:hidden"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/coach-m.webp"
            alt="Jordan Rudess Photo">


        <div class="container mx-auto max-w-6xl p-4 md:p-6 -mt-96 md:mt-0">
            <div class="flex flex-col justify-center items-center">
                <h6 class="uppercase text-pianote">It’s time to meet your teacher…</h6>
                    <h1 class="text-6xl pb-4 font-bebas tracking-widest">JORDAN RUDESS</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="md:py-4 md:pt-10">
                    <p class="mb-4">Jordan Rudess is best known as the extraordinary keyboardist for the
                        platinum-selling, GRAMMY Award-winning progressive rock band, Dream Theater.</p>
                    <p class="mb-4">As a classical child prodigy, Jordan was admitted to the prestigious Juilliard School
                        of Music when he was just 9 years old.</p>
                    <p class="mb-4">His piano playing is renowned for its virtuosity, speed, and of course…
                        <strong>technique.</strong>
                    </p>
                    <p class="mb-4">Jordan honed his piano technique under the supervision of some of the greatest piano
                        teachers at Juilliard. And now…</p>
                    <p><strong>He’s sharing those secrets with you.</strong></p>
                </div>
                <div class="md:py-4 md:pt-10">
                    <p class="mb-4">“These are the exercises that have made the biggest impact on my playing,” says
                        Jordan.</p>
                    <p class="mb-4">Over 30 days, Jordan will guide you through the exact exercises he used to develop
                        his incredible piano skill. But you won’t just be watching Jordan, you’ll be playing with him.</p>
                    <p class="mb-4">His piano playing is renowned for its virtuosity, speed, and of course…
                        <strong>technique.</strong>
                    </p>
                    <p class="mb-4">“I’ve always thought it would be amazing to have a place to go where you knew that
                        the exercises and steps you were taking were guaranteed to make you a better piano player,” he says.
                    </p>
                    <p class="mb-4">“This is that place.”</p>
                    <p>This is a rare opportunity to connect and learn from the world’s best.</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto max-w-6xl py-4 md:px-6 pb-10">
            <h4 class="uppercase text-gray-400 text-center py-4">See Jordan in action</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 md:py-10 relative">
                        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                            x-on:click="trailerLeft = true;" role="button">
                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>                            
                            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                                data-src="" type="video/mp4" autoplay loop playsinline muted></video>
                            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/thumb-02-01.webp"
                                alt="header image" fetchpriority="high" />
                        </div>
                    </div>
                    <div class="md:p-4 md:py-10 relative">
                        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                            x-on:click="trailerRight = true;" role="button">
                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>                            
                            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                                data-src="" type="video/mp4" autoplay loop playsinline muted></video>
                            <img class="absolute inset-0 overflow-hidden object-cover w-full h-full absolute z-0"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/thumb-02-02.webp"
                                alt="header image" fetchpriority="high" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-center py-4">
                    <a class="w-full md:w-1/3 lg:w-1/4 join smaller text-white bg-pianote m-2 hover:bg-red-500"
                        href="#customize-anchor" x-data="{ move: false }" @mouseover="move = true"
                        @mouseout="move = false">ENROLL NOW</a>
                </div>
                <div class="uppercase text-sm text-center text-pianote pb-4">
                    <span x-cloak x-data="timer()" x-init="countdown()">
                        <span>
                            Enrollment closes in
                            <br>
                            <strong>
                                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                        x-text="dayText"></span></span>
                                <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                        x-text="hourText"></span></span>
                                <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                        x-text="minuteText"></span></span>
                                <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                                        x-text="secondText"></span></span>
                            </strong>
                        </span>
                    </span>
                </div>

        </div>

    </section>


    @php
        $gridItems = [
            [
                'image' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/overview-01.webp',
                'text' =>
                    'ONE exercise guaranteed to build your finger independence, so your pinky and ring fingers will start working on their own.',
                'icon' => 'far fa-hand',
            ],
            [
                'image' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/overview-02.webp',
                'text' =>
                    'Ways to create emotional depths in your playing, so you’ll go from playing notes to making music.',
                'icon' => 'far fa-face-smile',
            ],
            [
                'image' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/overview-03.webp',
                'text' =>
                    'Juilliard secret to boost your speed for scales and arpeggios. You’ll feel (and hear) the difference.',
                'icon' => 'far fa-gauge-low',
            ],
        ];
    @endphp


    <section class="bg-gray-100 pt-10 pb-20">
        <div class="container mx-auto max-w-2xl pt-8 px-4">
            <div class="flex flex-col items-center pb2 md:pb-4">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/logo-introducing.svg"
                    alt="30 Day to Better Technique Logo" class="h-32 md:h-48">
            </div>

            <p class="text-center mt-4">
                <strong>30 Days to Better Technique</strong> is the first guided piano technique course that will have you
                playing WITH a world-class instructor - Jordan Rudess.
                <br><br>
                Over 30 days, you’ll play with Jordan as he guides you through the exercises he used to develop his
                incredible piano skills.
            </p>
            <h5 class="text-pianote uppercase text-center pt-10">You’ll know the:</h5>
        </div>

        <div class="container mx-auto max-w-5xl p-4 hidden lg:block">
            <div class="flex justify-center pt-10 gap-4">
                @foreach ($gridItems as $gridItem)
                    <div class="relative text-center w-1/3 bg-white rounded-xl px-4 py-8">
                        <img src="{{ $gridItem['image'] }}" alt="Image" class="mx-auto rounded-xl">
                        <p class="mt-4 text-left h-28">{{ $gridItem['text'] }}</p>
                        <div
                            class="w-16 h-16 bg-white rounded-full absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                            <i class="{{ $gridItem['icon'] }} text-pianote text-3xl"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--mobile view-->
        <div class="lg:hidden" x-data="{
            init() {
                new Splide(this.$refs.splide1, {
                    classes: {
                        arrow: 'hidden',
                        prev: 'hidden',
                        next: 'hidden',
                        pagination: 'splide__pagination bottom-0',
                    },
                    perPage: 2.5,
                    perMove: 1,
                    type: 'loop',
                    focus: 0,
                    interval: 2000,
                    drag: 'free',
                    snap: false,
                    lazyLoad: 'nearby',
                    pagination: false,
                    breakpoints: {
                        1020: {
                            perPage: 3,
                            focus: 2,
                        },
                        767: {
                            perPage: 1.5,
                        },
                    },
                }).mount()
            },
        }">
            <div x-ref="splide1" class="splide text-left">
                <div class="splide__track pt-10">
                    <ul class="splide__list items-start">
                        @foreach ($gridItems as $gridItem)
                            <li class="splide__slide px-4">
                                <div class="relative text-center bg-white rounded-xl px-4 py-10">
                                    <img src="{{ $gridItem['image'] }}" alt="Image" class="mx-auto rounded-l">
                                    <p class="mt-4 text-left sm:text-sm">{{ $gridItem['text'] }}</p>
                                    <div
                                        class="bg-white rounded-full absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                                        <i class="{{ $gridItem['icon'] }} text-pianote text-3xl"></i>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="px-4">
            <div class="text-center">
                <img class="hidden md:inline h-20"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/line-circle.svg"
                    alt="Red Lines">
                <img class="inline md:hidden h-16"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/line-m.svg"
                    alt="Red Line">
            </div>

            <div class="bg-white border-2 border-pianote rounded-md px-4 w-full sm:w-9/12 lg:w-2/3 mx-auto">
                <h4 class="p-4 text-center">The result is <strong>stronger fingers <br class="inline sm:hidden"> and hands,
                        improved coordination,</strong> and <strong>better technique </strong> <br
                        class="inline sm:hidden">so you play the songs you love on the piano with ease.</h4>
            </div>
        </div>


        <h5 class="text-pianote uppercase text-center py-10">Let’s dive in:</h5>
        @php
            $weeks = [
                [
                    'img' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/week1.webp',
                    'header1' => 'WEEK 1',
                    'header2' => 'Building your finger independence.',
                    'desc' => 'Strong fingers make everything easier on the piano.
            <br><br>
            And if you don’t work on your finger independence, you’ll stay stuck with fingers that do their own thing, hit
            random keys and move when you don’t want them to.
            <br><br>
            That’s why we’re starting the course with Jordan’s best exercise to strengthen your fingers and give them the
            independence they crave.
            After the first day, your fingers will already feel stronger, and you’ll be more confident and excited to keep
            learning.',
                    'notes' => 'See what we’ll focus on...',
                    'backHeader' => 'Here’s what you’ll get:',
                    'back' => [
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-1',
                            'desc' => 'Jordan’s secret Juilliard exercises. These are the exact exercises his teachers at Juilliard taught him.
            He’s sharing them now -- with you.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-2',
                            'desc' => 'The “Flowing” exercise to give you freedom in your playing. An etherial arpeggio exercise that sounds
            incredible while helping you play faster.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-3',
                            'desc' => 'How to “think” about playing fast. Speed is more than an act -- it’s a mindset. Jordan will show you how
            to approach practicing speed so you’re set up for success, not frustration.',
                        ],
                    ],
                ],
                [
                    'header1' => 'WEEK 2',
                    'header2' => 'Separate your hands and coordinate your brain.',
                    'desc' => 'Now you’ve built strong fingers, it’s time to use them.
            <br><br>
            In Week 2, you’ll learn how to separate your hands so you can play different rhythms and motifs in your left and
            right hands.
            <br><br>
            No more boring whole notes in your left hand. You’ll learn to play different rhythms in your left hand than your
            right hand.',
                    'notes' => 'See what we’ll focus on...',
                    'backHeader' => 'Here’s what you’ll get:',
                    'back' => [
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-1',
                            'desc' => 'Patterns designed to break up your hands. You’ll lay a foundational rhythm with one hand while exploring
            new patterns and syncopation in the other.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-2',
                            'desc' => 'Personal accompaniment from Jordan. While you’re working on your exercises, Jordan will accompany you,
            providing a unique backing track. Yes, you’ll be making music with Jordan Rudess.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-3',
                            'desc' => 'Break out of 4/4. Get out of the easy time signtarures and step into Jordan’s world of off-time. “It’s
            easy, but it’s odd.”',
                        ],
                    ],
                ],
                [
                    'img' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/week3.webp',
                    'header1' => 'Week 3',
                    'header2' => 'Speed. How to practice and play fast.',
                    'desc' => 'Now it’s time to impress.
            <br><br>
            Not many keyboardists can play as fast as Jordan Rudess, and in Week 3, he’ll show you the exact exercises he
            learned at Juilliard and used to build his prodigious speed.
            <br><br>
            Strap in, because it’s a wild ride.
            <br><br>
            But don’t worry, we’ll start slow. Because in order to play fast -- you have to start slow. But we won’t stay
            there. By the end of the week, you’ll notice a significant difference in your speed, and you’ll have the tools
            to continue practicing how to play faster.',
                    'notes' => 'See what you’ll get...',
                    'backHeader' => 'Here’s what you’ll get:',
                    'back' => [
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-1',
                            'desc' => 'Jordan’s secret Juilliard exercises. These are the exact exercises his teachers at Juilliard taught
            him. He’s sharing them now -- with you.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-2',
                            'desc' => 'The “Flowing” exercise to give you freedom in your playing. An etherial arpeggio exercise that sounds
            incredible while helping you play faster.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-3',
                            'desc' => 'How to “think” about playing fast. Speed is more than an act -- it’s a mindset. Jordan will show you
            how to approach practicing speed so you’re set up for success, not frustration.',
                        ],
                    ],
                ],
                [
                    'header1' => 'Week 4',
                    'header2' => 'Creative expression. Make beautiful music.',
                    'desc' => 'You’ve spent 3 weeks building the skills that you’ll be using in Week 4.
            <br><br>
            Because what’s the point of getting better technique?
            <br><br>
            To play beautiful music.
            <br><br>
            In Week 4, Jordan will share his tips on how to create true emotion and expression in your piano playing. How do
            you go from hitting the keys to making music? This final week will show you how to tell a story with your
            playing.
            ',
                    'notes' => 'See what you’ll end the course with:',
                    'backHeader' => 'Here’s what you’ll get:',
                    'back' => [
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-1',
                            'desc' => 'The specific techniques to draw listeners in to your playing. How to get people to stop and stare
            whenever you sit at the piano.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-2',
                            'desc' => 'The mindset of a singer. Why thinking like a vocalist is key to bringing emotion and feeling to the
            pieces you play.',
                        ],
                        [
                            'icon' => 'fa-sharp fa-light fa-circle-3',
                            'desc' => 'A final performance with Jordan. “We are going to rock”, says Jordan. In the final week, you’ll put
            all your skills together to play sometning Dream Theater-esque WITH Jordan.',
                        ],
                    ],
                ],
            ];
        @endphp

        <div class="max-w-8xl">
            <div class="pl-4 lg:pl-20">
                <div x-data="{
                    init() {
                        new Splide(this.$refs.splide2, {
                            classes: {
                                arrow: 'hidden',
                                prev: 'hidden',
                                next: 'hidden',
                                pagination: 'splide__pagination bottom-0',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'slide',
                            gap: 20,
                            focus: 0,
                            interval: 2000,
                            drag: 'free',
                            snap: false,
                            lazyLoad: 'nearby',
                            breakpoints: {
                                920: {
                                    perPage: 2.1,
                                },
                                870: {
                                    perPage: 1.5,
                                },
                                640: {
                                    perPage: 1.1,
                                },
                            },
                        }).mount()
                    },
                }" class="mb-5">
                    <div x-ref="splide2" class="splide text-left">
                        <div class="splide__track pb-8">
                            <ul class="splide__list items-start">
                                @foreach ($weeks as $index => $week)
                                    <li class="splide__slide px-1">
                                        <!-- card -->
                                        <div x-data="{ flipped: false }" class="rounded-xl overflow-hidden cursor-pointer"
                                            @click="flipped = !flipped">
                                            <!-- Front -->
                                            <div class="relative w-[650px] h-[650px]">

                                            </div>

                                            <div class="absolute inset-0 rounded-lg text-white p-4 md:p-10 w-full bg-gray-900"
                                                x-show.transition.scale.5.duration.400ms="!flipped">
                                                @if ($index % 2 == 0 && !empty($week['img']))
                                                    <img class="h-40" src="{{ $week['img'] }}" alt="">
                                                @endif
                                                <h5
                                                    class="text-pianote uppercase text-left {{ $index % 2 == 0 ? '' : 'pt-5 md:pt-10' }} tracking-tight">
                                                    <strong>{!! $week['header1'] !!}</strong>
                                                </h5>
                                                <h4 class="leading-normal"><strong>{!! $week['header2'] !!}</strong></h4>
                                                <p class="py-8">{!! $week['desc'] !!}</p>
                                                <p class="text-pianote absolute bottom-[16px]">
                                                    <i class="fa-solid fa-arrows-rotate-reverse"></i>
                                                    {!! $week['notes'] !!}
                                                </p>
                                            </div>
                                            <!-- Back  -->
                                            <div class="absolute inset-0 rounded-lg p-4 md:p-10 w-full bg-gray-800"
                                                x-show.transition.scale.5.duration.400ms="flipped">
                                                <h5
                                                    class="text-pianote uppercase text-left {{ $index % 2 == 0 ? '' : 'pt-5 md:pt-10' }} tracking-tight">
                                                    <strong>{!! $week['header1'] !!}</strong>
                                                </h5>
                                                <p class="leading-normal text-white">
                                                    <strong>{!! $week['header2'] !!}</strong>
                                                </p>
                                                @foreach ($week['back'] as $paragraph)
                                                    <div class="flex items-center">
                                                        <i class="{{ $paragraph['icon'] }} text-pianote text-4xl"></i>
                                                        <p class="text-white ml-2 py-4 pl-2">{!! $paragraph['desc'] !!}</p>
                                                    </div>
                                                @endforeach
                                                <p class="text-pianote absolute bottom-[16px]">
                                                    <i class="fa-solid fa-arrows-rotate-reverse"></i>
                                                    See the weeks overview...
                                                </p>
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

    </section>

    <section class="text-black px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#ffffff;">
        <div class="container max-w-4xl mx-auto pb-10">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-24 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/screen.webp"
                    alt="Mobile Screen with 30-Day Independence">
                <div class="flex-grow sm:pl-10">
                    <h3 class="leading-tight text-center sm:text-left py-4"><strong>Get an exclusive LIVE <br> every step
                            of the way.</strong></h3>
                    <div class="text-center sm:text-left pb-4">
                        <p>
                            All students who enroll in 30-Days to Better Technique will be invited to join an exclusive LIVE
                            lesson with Jordan Rudess.
                            <br><br>
                            You’ll be able to share your feedback, ask questions, and learn live from the “world’s best
                            keyboardist”.
                            <br><br>
                            It’s a rare opportunity.
                            <br><br>
                            And it’s only available to students who enroll in the first-ever class of 30-Days to Better
                            Technique.
                            <br><br>
                            Reserve your spot today.
                        </p>
                    </div>
                    <a class="w-full md:w-5/12 join smaller text-white bg-pianote m-2 hover:bg-red-500" href="#customize-anchor"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false">ENROLL NOW</a>
                </div>
                </div>
                <div class="flex justify-center">
                
            </div>
        </div>
    </section>

    @php
        $logo =
            'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp';
        $guaranteeText = "We’re so confident that you’ll LOVE the improvements to your piano technique after Jordan’s course, that we’re giving you THREE times as long to put it to the test.
                        <br><br>
                        <strong>The course is 30 days, but you’ll have 90 days to try it risk-free.</strong>
                        <br><br>
                        That means you’ll have enough time to go through every lesson and play with Jordan - THREE times. And if -- after you’ve put in the work -- you don’t see real improvements to your technique... 
                        <br><br>
                        If your fingers don’t feel stronger and your hands aren’t more coordinated…
                        <br><br>
                        If you don’t enjoy playing the piano more than you did before you started…
                        <br><br>
                        Contact support@pianote.com within those 90 days and get a refund.";
        $guaranteeHeader = "<strong>The 90-Day “Better <br class='inline sm:hidden'> Technique” Guarantee</strong>";
    @endphp

    <!-- @if (empty($membersVersion))
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #00101D calc(50% + 1px));"></div>
                    <section class="text-center text-white px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#00101D; border: 1px solid #00101D">
                        <div class="container max-w-3xl mx-auto">
                            @include('pianote._partials._guarantee-section', [
                                'containerWidth' => 'max-w-3xl',
                            ])
                        </div>
                    </section>
    @endif -->

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #00101D calc(50% + 1px));">
    </div>
    <section class="text-center text-white px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32"
        style="background-color:#00101D; border: 1px solid #00101D">
        <div class="container max-w-6xl mx-auto">
            @include('pianote._partials._guarantee-section', [
                'containerWidth' => 'max-w-6xl',
                'imageUrl' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/guarantee-collage.webp',
            ])
        </div>
    </section>

    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background-color:#EFF2F6;">
        <div class="container mx-auto relative z-50 text-center">
            <img class="h-20 sm:h-28 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/30-days-technique-Jordan-Rudess-logo.svg"
                alt="30 Day to Better Technique Logo">
            <h2 class="leading-tight mt-2 mb-3 sm:my-3 lg:my-4"><strong>20 Play-Along Lessons + weekly Q&As <br> with a
                    real piano techer </strong></h2>

            <!-- <span class="join sold-out medium w-full max-w-xs align-middle mt-7" @click="waitlistModal = true;">JOIN WAITLIST</span> -->
            <h6 class="leading-normal text-sm mb-4">
                <span class="text-pianote">Enrollment closes in
                    <strong><span class="text-pianote" x-cloak x-data="timer()" x-init="countdown()">
                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                    x-text="dayText"></span></span>
                            <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                    x-text="hourText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                    x-text="minuteText"></span></span>
                            <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span
                                    x-text="secondText"></span></span>
                            <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                        </span>!</strong>
                </span>
            </h6>

            <!-- Version 2 -->

            <!-- <div class="w-full py-2">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/bundle-01.webp"
                        alt="Deal for 30 Day to Better Technique">
                    <h3><strong>$127</strong></h3>
                    <p class="text-gray-600 italic">One-time payment</p>
                </div>
                <div class="flex justify-center">
                    <a class="w-full md:w-1/3 lg:w-1/4 join smaller text-white bg-pianote m-2 hover:bg-red-500"
                        href="#customize-anchor" x-data="{ move: false }" @mouseover="move = true"
                        @mouseout="move = false">ENROLL NOW</a>
                </div>
                <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png"
                    alt="Image of joined student profiles in 30-Day Independence">
                <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano
                    players who<br class="sm:hidden"> have already registered.</p> -->


            <div class="container mx-auto max-w-5xl py-10">
                <div id="customize-anchor" class="anchor"></div>
                <div class="flex flex-wrap lg:flex-nowrap items-start justify-center mb-5 sm:mb-10 w-full mx-auto">
                    @include('pianote.products.partials._promo-card-special', [
                        'badgeText' => 'JUST THE COURSE',
                        'cardTitle' => '30 Days To <br> Better Technique',
                        'cardImage' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/bundle-01.webp',
                        'imageHeight' => 'h-40',
                        'cardSubtitle' => 'Just the course.',
                        'cardPrice' => '97',
                        'cardDiscount' => '127',
                        'cardLink' =>
                            '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=1&products[Drumeo-Key]=1&products[30-day-drummer-3]=1&products[30-day-chops]=1&products[rock-drumming-masterclass-pack]=1&products[drum-technique-made-easy-pack]=1&products[independence-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[learn-songs-faster-pack]=1&products[GHFAL-DIGI]=1&products[CC-DIGI]=1&locked=true',
                        'badgeColor' => 'musora',
                        'extraBonuses' => [
                            '<strong>30-Days To Better Technique</strong> <span class="italic text-xs">(Lifetime Access)</span>',
                            '<strong>LIVE</strong> Session with Jordan Rudess',
                        ],
                        'buttonText' => 'ENROLL NOW',
                        'cardExtraInfo' => 'SAVE 24%. One-time payment.',
                    ])

                    @include('pianote.products.partials._promo-card-special', [
                        'badgeText' => 'COURSE BUNDLE',
                        'cardTitle' => 'The Better <br> Technique Bundle',
                        'cardImage' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/bundle-01.webp',
                        'imageHeight' => 'h-40',
                        'cardSubtitle' => "The course + red Pianote metronome",
                        'cardPrice' => '127',
                        'cardLink' =>
                            '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=1&products[Drumeo-Key]=1&products[30-day-drummer-3]=1&products[30-day-chops]=1&products[rock-drumming-masterclass-pack]=1&products[drum-technique-made-easy-pack]=1&products[independence-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[learn-songs-faster-pack]=1&products[GHFAL-DIGI]=1&products[CC-DIGI]=1&locked=true',
                        'badgeColor' => 'pianote',
                        'extraBonuses' => [
                            '<strong>30-Days To Better Technique</strong> <span class="italic text-xs">(Lifetime Access)</span>',
                            '<strong>FREE</strong> Pianote Metronome <span class="italic text-xs">(Lifetime Access)</span>',
                            '<strong>LIVE</strong> Session with Jordan Rudess',
                        ],
                        'buttonText' => 'GET EVERYTHING',
                        'cardExtraInfo' => "One-time payment.",
                    ])
                </div>
            </div>
    </section>




    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Frequently Asked Questions</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    'title' =>
                        'I want to do this, but I’m worried I’m not good enough. What level do I need to be to start this course?',
                    'desc' => 'We hear you.
                
                                    And we didn’t bring in the world’s best keyboard player just to teach you the C scale. In fact, you should already know your C scale (at least) before starting this course.
                
                                    But you don’t need years of experience to enroll in 30 Days to Better Technique. The course has been structured to be beginner-friendly to start with. And if you HAVE been playing for years, you’ll pick up some incredible tips and exercises that will change how you practice.
                
                                    Will you be challenged? Yes.
                
                                    But that’s exactly how you get better. 
                
                                    And we’ll support you every step of the way. 
                
                                    So as Jordan says…
                
                                    “Don’t be scared. Jump in. I’m friendly. I’m there with you. We’re going to play together. And we’re going to make some music.”
                
                                    And hey, the absolute worst-case scenario is that you give it a shot and it’s not right for you. And then you’ll be protected by our 90-Day Better Technique Guarantee.
                                    ',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' =>
                        'This sounds like a big time commitment, and my life is pretty busy. What if I miss a day and fall behind?',
                    'desc' => '30 Days to Better Technique takes place over 30 days. (It’s right there in the title.) But…
                
                                        We created this course with the real-world in mind.
                
                                        So while it’s designed to be completed in 30 days, there are actually only 20 lessons. That leaves you 2 free days each week to catch up or repeat anything you need to. Because life happens, and missing one day shouldn’t mean the end of your progress.
                
                                        The lessons are designed to run Monday - Friday, and then on the weekend we’ll answer your questions and you’ll have time to catch up on anything you missed.
                
                                        And the lessons themselves range from 10-15 minutes each day.
                
                                        And we know you can find 15 minutes each day. 
                                        ',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'How involved is Jordan Rudess? Will I get to meet him?',
                    'desc' => ' Very. And YES.
                
                                    Jordan wrote every single lesson and resource for this course with YOU in mind. He presents every lesson, and it will feel like he’s in the room with you. You’ll play along with him, and then he’ll accompany you while you practice.
                
                                    And at the end of the course, you’ll have the chance to join an exclusive live stream with Jordan to share your experience, ask any questions you might have, and just hang out with the world’s best keyboard player.
                
                                    It’s a rare opportunity to learn from and connect with the very best.
                                    ',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'Do I need the metronome to complete this course?',
                    'desc' => 'No.
                
                                    Every lesson has a built-in metronome that you’ll be playing along to. But we included the metronome as a bonus because when Jordan was here filming -- he loved it so much that we sent him home with one.
                
                                    And having a physical metronome on your piano is a wonderful reminder to practice.
                
                                    And by the end of this course, you’ll see how valuable and important a metronome is for your development as a pianist.
                
                                    ',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'What happens once the course is over? ',
                    'desc' => 'That’s up to you.
                
                                    You’ll have access to this course for the rest of your life. It will never expire. And we’d encourage you to go through it again and again, as you’ll get something new each time.
                
                                    But once you finish it, you’ll be itching to put your new technique to use.
                
                                    And if you’re looking for the best way to do that, we’d suggest joining Pianote and getting access to over 1000 popular songs (including some Dream Theater songs), as well as other courses form world-class instructors.
                                    ',
                    'num' => '?',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' => 'When will the course be open again?',
                    'desc' => 'The short answer is…
                
                                    We don’t know.
                
                                    We’ll be closing enrollment on May 6th so we can focus on helping thousands of piano players improve their technique. 
                
                                    So it could be months before we open it again. And if we do, Jordan won’t be available for an exclusive live lesson.
                
                                    Don’t wait. Join now and improve your technique in just 30 days.
                                    ',
                    'num' => '?',
                ])

            </div>
        </div>
    </section>

    @php
        $boxes = [
            'If you’ve ever watched Jordan Rudess play and thought, “How does he do that?”...',
            'If you feel like your fingers aren’t strong enough or fast enough…',
            'If you’re serious about improving your skills and developing as a pianist...',
            'If you want to learn from the best in the world…',
            'If you’re tired of playing the same songs over and over again, feeling like you lack the path to improvement…',
        ];
    @endphp

    <section class="text-center text-white py-10" style="background: #000000;">
        <div class="container sm:max-w-5xl lg:max-w-6xl mx-auto px-4">
            <h2><strong>Still reading?</strong></h2>
            <h5 class="leading-normal">By now, you already know that the biggest <br class="inline md:hidden"> difference between those pianists you envy
                <br> and the ones who get stuck on a plateau, never <br class="inline md:hidden"> making progress, all comes down to…
                <br><br>
                <span class="text-pianote"><strong>Better Technique.</strong></span>
                <br><br>
                So if you’re still here, let’s wrap this up and get <br class="inline md:hidden">  you playing better.
            </h5>

            <div class="md:hidden flex flex-col items-center pt-10">
                @foreach ($boxes as $box)
                    <div class="w-full border border-pianote italic rounded-xl px-4 py-6 my-1" style="background: #283049;">
                        <h5 class="leading-normal">{{ $box }}</h5>
                    </div>
                @endforeach
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/final-appeal-m.webp" alt="Logo with arrows" class="w-2/3">
                <div class="w-auto max-w-5xl text-center">
                        <h3 class="leading-normal">Enroll today and make these 30 days the most <br>
                            <strong>impactful</strong> and <strong>memorable</strong> of
                            your piano-playing life.</h3>
                    </div>
            </div>

            <div class="hidden md:block py-6 md:py-10">
                <div class="flex flex-wrap items-center justify-around text-left">
                    <div class="w-auto max-w-xs border border-pianote rounded-xl p-8 text-center italic" style="background: #283049;">
                        <p class="leading-normal">If you’ve ever watched Jordan Rudess play and thought, “How does he do
                            that?”...</p>
                    </div>
                    <div class="w-full flex justify-center content-around py-3">
                        <div class="w-auto max-w-xs flex flex-wrap content-around">
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-8 mb-4 text-center italic"
                                style="background: #283049;">
                                <p class="leading-normal">If you’re tired of playing the same songs over and over again, feeling like you lack the path to improvement…</p>
                            </div>
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-8 text-center italic"
                                style="background: #283049;">
                                <p class="leading-normal">If you want to learn from the best in the world…</p>
                            </div>
                        </div>
                        <div>
                            <img
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/final-appeal.webp">
                        </div>
                        <div class="w-auto max-w-xs flex flex-wrap content-around">
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-8 mb-4 text-center italic"
                                style="background: #283049;">
                                <p class="leading-normal">If you feel like your fingers aren’t strong enough or fast enough…</p>
                            </div>
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-8 text-center italic"
                                style="background: #283049;">
                                <p class="leading-normal">If you’re serious about improving your skills and developing as a pianist...</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto max-w-5xl text-center">
                        <h4 class="leading-normal">Enroll today and make these 30 days the most <br>
                            <strong>impactful</strong> and <strong>memorable</strong> of
                            your piano-playing life.</h4>
                    </div>
                </div>
            </div>
           
                <div class="flex justify-center">
                    <a class="w-full md:w-1/3 lg:w-1/4 join smaller text-white bg-pianote m-2 hover:bg-red-500"
                        href="#customize-anchor" x-data="{ move: false }" @mouseover="move = true"
                        @mouseout="move = false">ENROLL NOW</a>
                </div>
                <div class="uppercase text-base text-center text-pianote py-4">
                    <span x-cloak x-data="timer()" x-init="countdown()">
                        <span>
                            Enrollment closes in
                            <br>
                            <strong>
                                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                        x-text="dayText"></span></span>
                                <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                        x-text="hourText"></span></span>
                                <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                        x-text="minuteText"></span></span>
                                <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                                        x-text="secondText"></span></span>
                            </strong>
                        </span>
                    </span>
                </div>

        </div>
    </section>



    @include('_partials.components.video-modal', [
        'name' => 'trailerRight',
        'video' => 'aFdOW1Ql3L4',
        'youtube' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'trailerLeft',
        'video' => 'LUknLohfN48',
        'youtube' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'trailerM',
        'video' => '928599834',
        'vimeo' => true,
        'styles' => 'pb-[177%] bg-white',
    ])
    @include('_partials.components.countdown', [
        'countdownDate' => '2024-05-06 00:00:00',
        'promoVersion' => false,
    ])

    @include('pianote.sales.partials._footer')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
