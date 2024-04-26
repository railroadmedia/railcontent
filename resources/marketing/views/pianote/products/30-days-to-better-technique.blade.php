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
            background: #F61A30;
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
@stop

@section('body-data')
    x-data="{
        danceOfEternity: false,
        jayZ: false,
        trailer: false,
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="30 Day to Better Technique Logo" class="h-32 sm:h-40 lg:h-48 my-4 md:my-10"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/header-logo.svg"><br>
                <h6 class="italic">What would happen if you learned piano from <br> the <strong> best
                        keyboardist in the world?</strong></h6>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                        @click="trailer = true;">
                        &nbsp;Watch Trailer
                    </div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                         &nbsp;Watch Trailer
                    </div>
                    <a class="w-5/12 join smaller text-white bg-pianote m-2 hover:bg-red-500 anchor-slide" href="#customize-anchor"
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
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(2, 11, 22, 0.6)"></div>
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
            src="https://player.vimeo.com/progressive_redirect/playback/932207347/rendition/1080p/file.mp4?loc=external&signature=5f7623116aebc377256b8e977f9f8cd5d89a073cbbe72da98636654c0508e44c"></video>


    </header>

    @php
        $items = [
            'Improve Your <br class="inline lg:hidden"> Playing',
            '30 Days of <br class="inline lg:hidden"> Lessons',
            'Practice with <br class="inline lg:hidden"> Jordan',
            'Guaranteed <br class="inline lg:hidden"> results'
            ];
    @endphp

    <section class="bg-black text-white p-4 md:px-20">
        <div class="container max-w-4xl mx-auto flex flex-wrap md:flex-center justify-center ">
            @foreach ($items as $item)
                <div class="flex flex-col items-center justify-center uppercase text-center py-2 w-1/2 md:w-1/4">
                    <p class="mb-2"><i class="fa fa-check text-pianote"></i> {!! $item !!}</p>
                </div>
            @endforeach
        </div>

    </section>

    <section class="" style="background: #ffffff;">
        <div class="container max-w-4xl mx-auto py-8 md:py-12 flex justify-center flex-col md:flex-row">
            <div class="flex flex-col items-center md:hidden mb-6 sm:mb-0">
                <h2 class="leading-tight mb-8 text-center"><strong>Technique is <br class="hidden sm:inline-block"> <span class="underline">everything.</span></strong></h2>
                <video
                    src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/30-day-better-technique/30DTBT-Gif-header-v2.mp4"
                    muted="" autoplay="" loop="" playsinline="" class="w-2/3"></video>
            </div>

            <div class="sm:mb-10 md:w-2/3 px-4">
                <h2 class="text-center hidden md:inline-block mb-6"><strong>Technique is
                    <span class="underline">everything.</span>  </strong></h2>

                <p class="text-black">
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
                    src="https://d21q7xesnoiieh.cloudfront.net/marketing/pianote/products/30-day-better-technique/30DTBT-Gif-header-v2.mp4"
                    muted="" autoplay="" loop="" playsinline=""></video>
            </div>

        </div>

    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #EFF2F6 calc(50% + 1px));">
    </div>
    <section class="text-center px-4 sm:px-6 py-10 sm:pt-16" style="background-color: #EFF2F6;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-20 sm:h-36 mb-5 sm:mb-10 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/30-days-technique-Jordan-Rudess-logo.svg"
                alt="30 Day to Better Technique Logo">
            <p class="leading-normal mb-10 sm:mb-12 mx-auto max-w-2xl"><strong>30 Days to Better Technique</strong> is the first guided piano technique course that will have you playing WITH a world-class instructor - Jordan Rudess. Over 30 days, you’ll play with Jordan as he guides you through the exercises he used to develop his incredible piano skills.</p>



            @php
                $gettings = [
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-01.webp',
                        'title' => 'Know exactly what to practice.',
                        'desc' =>
                            'Each day you’ll unlock a new lesson and play WITH Jordan. You don’t have to worry about what to do when you sit on the bench. Jordan’s got you covered.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-02.webp',
                        'title' => 'Fits any schedule.',
                        'desc' =>
                            'Building technique takes practice. But it doesn’t mean hours of scales every day. Each lesson is short and fun, so you can fit it around your busy schedule.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/marketing/pianote/products/30-day-better-technique/timeline-03.webp',
                        'title' => 'The four pillars of technique.',
                        'desc' =>
                            'Each week you’ll focus on a new element of piano technique. You’ll build your finger independence, hand coordination, speed, and musical expression.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-04.webp',
                        'title' => 'Support from REAL teachers.',
                        'desc' =>
                            'You’ll be supported every step of the way by Pianote’s team of expert instructors. Plus you’ll get to hang with Jordan in an exclusive LIVE Q&A.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-05.webp',
                        'title' => 'Lifetime Access',
                        'desc' => 'You can access ALL the lessons and downloads from 30 Days to Better Technique for life. That means you can return to your favorite workouts over and over – plus, it means you can work at your own pace.',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 py-7">
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
        <h1 class="leading-none -mt-8 mb-8"><i class="fal fa-angle-down text-pianote"></i></h1>
        <h4 class="uppercase text-pianote">And you’ll have <br class="block md:hidden"> learned all <br
                class="hidden md:block"> these things from...</h4>
    </section>

    <div class="text-white flex flex-col items-center justify-center md:flex-row md:items-center md:justify-center py-3"
        style="background: linear-gradient(90deg, #F61A30 0%, #632127 100%);">
        <h2 class="leading-tight uppercase text-center">
            <strong>
                “The greatest <br class="inline md:hidden"> keyboardist of all time”
            </strong>
        </h2>
        <p class="italic text-xs md:text-sm md:mt-auto">
            ~ MusicRadar Magazine
        </p>
    </div>

    <section class="flex flex-col items-center text-white" style="background-color: #00101D;">
        <picture>
            <source media="(min-width: 1200px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/coach.webp">
            <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/coach.webp">
            <img
                class="w-full transition-opacity opacity-0 hidden md:inline"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)//marketing/pianote/products/30-day-better-technique/coach.webp"
                alt="Jordan Rudess Photo"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
        </picture>
        <img class="w-full inline md:hidden transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/coach-m.webp" onload="this.classList.remove('opacity-0');" loading="lazy" alt="Jordan Rudess Photo">

        <div class="container mx-auto max-w-5xl p-4 md:p-6 -mt-52 md:-mt-10">
            <div class="flex flex-col justify-center items-center">
                <h6 class="uppercase text-pianote">It’s time to meet your teacher…</h6>
                <h1 class="text-6xl mb-4 font-bebas sm:tracking-widest">JORDAN RUDESS</h1>
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
                    <p class="mb-4">“I’ve always thought it would be amazing to have a place to go where you knew that
                        the exercises and steps you were taking were guaranteed to make you a better piano player,” he says.
                    </p>
                    <p class="mb-4">“This is that place.”</p>
                    <p>This is a rare opportunity to connect and learn from the world’s best.</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto max-w-6xl py-4 px-4 md:px-6 pb-10">
            <h5 class="uppercase text-gray-400 text-center mb-3">See Jordan in action</h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <div class="relative">
                        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                            x-on:click="jayZ = true;" role="button">
                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>
                            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                                data-src="" type="video/mp4" autoplay loop playsinline muted></video>
                            <img class="absolute inset-0 overflow-hidden object-cover w-full h-full absolute z-0 opacity-0 transition-opacity"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/thumb-02-02.webp"
                                alt="Thumbnail for piano technique tutorial video"/>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                            x-on:click="danceOfEternity = true;" role="button">
                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller z-10"></i>
                            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                                data-src="" type="video/mp4" autoplay loop playsinline muted></video>
                            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 opacity-0 transition-opacity"
                                loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/thumb-02-01.webp"
                                alt="Thumbnail for piano technique tutorial video "/>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center py-4">
                    <a class="w-full md:w-1/3 lg:w-1/4 join smaller text-white bg-pianote m-2 hover:bg-red-500  anchor-slide"
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
                $weeks = [
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/week1.webp',
                        'weekNum' => 'WEEK 1',
                        'title' => 'Building your finger independence.',
                        'excerpt' => 'Strong fingers make everything easier on the piano.',
                        'desc' => 'And if you don’t work on your finger independence, you’ll stay stuck with fingers that do their own thing, hit random keys and move when you don’t want them to. <br><br> That’s why we’re starting the course with Jordan’s best exercise to strengthen your fingers and give them the independence they crave. After the first day, your fingers will already feel stronger, and you’ll be more confident and excited to keep learning.',
                        'backHeader' => 'Here’s what we’ll focus on:',
                        'back' => [
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-1',
                                'desc' => '<strong>Using musical patterns</strong> to build strong fingers. Each exercise will sound like music, not a boring technical exercise. Jordan will show you exactly what notes to play in what order.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-2',
                                'desc' => '<strong>Creating true separation for your fingers.</strong> Once you’re comfortable with the patterns, we’ll start holding individual notes while playing around them to really give your fingers a mind of their own.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-3',
                                'desc' => '<strong>Independence for EVERY finger.</strong> As Jordan says, “We were given five fingers, we might as well use them.” You’ll build strength in every single digit of your hands. Yes, even your pinky and ring fingers!',
                            ],
                        ],
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/week2.webp',
                        'weekNum' => 'WEEK 2',
                        'title' => 'Separate your hands and coordinate your brain.',
                        'excerpt' => 'Now you’ve built strong fingers, it’s time to use them.',
                        'desc' => 'In Week 2, you’ll learn how to separate your hands so you can play different rhythms and motifs in your left and right hands. <br><br> No more boring whole notes in your left hand. Hand coordination trips up so many piano players and halts your progress. But with Jordan’s daily guidance, you’ll be amazed at how quickly you progress.',
                        'backHeader' => 'Here’s how we’ll do it:',
                        'back' => [
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-1',
                                'desc' => '<strong>Patterns designed to break up your hands.</strong> You’ll lay a foundational rhythm with one hand while exploring new patterns and syncopation in the other.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-2',
                                'desc' => '<strong>Personal accompaniment from Jordan.</strong> While you’re working on your exercises, Jordan will accompany you, providing a unique backing track. Yes, you’ll be making music with Jordan Rudess.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-3',
                                'desc' => '<strong>Break out of 4/4.</strong> Get out of the easy time signatures and step into Jordan’s world of off-time. “It’s easy, but it’s odd.”',
                            ],
                        ],
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/week3.webp',
                        'weekNum' => 'Week 3',
                        'title' => 'Speed. How to practice and play fast.',
                        'excerpt' => 'Now it’s time to impress.',
                        'desc' => ' Not many keyboardists can play as fast as Jordan Rudess, and in Week 3, he’ll show you the exact exercises he learned at Juilliard and used to build his prodigious speed. <br><br> Strap in, because it’s a wild ride. <br><br> But don’t worry, we’ll start slow. Because in order to play fast -- you have to start slow. But we won’t stay there. By the end of the week, you’ll notice a significant difference in your speed, and you’ll have the tools to continue practicing how to play faster.',
                        'backHeader' => 'Here’s what you’ll get:',
                        'back' => [
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-1',
                                'desc' => '<strong>Jordan’s secret Juilliard exercises.</strong> These are the exact exercises his teachers at Juilliard taught him. He’s sharing them now -- with you.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-2',
                                'desc' => '<strong>The “Flowing” exercise to give you freedom in your playing.</strong> An ethereal arpeggio exercise that sounds incredible while helping you play faster.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-3',
                                'desc' => '<strong>How to “think” about playing fast.</strong> Speed is more than an act -- it’s a mindset. Jordan will show you how to approach practicing speed so you’re set up for success, not frustration.',
                            ],
                        ],
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/week4.webp',
                        'weekNum' => 'Week 4',
                        'title' => 'Creative expression. Make beautiful music.',
                        'excerpt' => 'You’ve spent 3 weeks building the skills that you’ll be using in Week 4.',
                        'desc' => 'Because what’s the point of getting better technique?<br><br>To play beautiful music. <br><br> In Week 4, Jordan will share his tips on how to create true emotion and expression in your piano playing. How do you go from hitting the keys to making music? This final week will show you how to tell a story with your playing.',
                        'backHeader' => 'You end the course with:',
                        'back' => [
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-1',
                                'desc' => '<strong>The specific techniques to draw listeners into your playing.</strong> How to get people to stop and stare whenever you sit at the piano.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-2',
                                'desc' => '<strong>The mindset of a singer.</strong> Why thinking like a vocalist is key to bringing emotion and feeling to the pieces you play.',
                            ],
                            [
                                'icon' => 'fa-sharp fa-light fa-circle-3',
                                'desc' => '<strong>A final performance with Jordan.</strong> “We are going to rock”, says Jordan. In the final week, you’ll put all your skills together to play something Dream Theater-esque WITH Jordan.',
                            ],
                        ],
                    ],
                ];
            @endphp



    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #EFF2F6">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>“Is 30 Days to Better Technique right for me?”</strong></h2>
            <p class="leading-normal mt-5 mb-10 sm:mb-12 mx-auto" style="max-width:600px;">
                Do you want to have stronger fingers, better hand coordination, and play faster? If the answer is yes, then 30 Days to Better Technique is perfect for you. Even if you’re new on your journey, you’ll see massive improvements to your playing.
                <br><br>
                Click below to see a detailed course breakdown.</p>


            @foreach ($weeks as $week)
                <div class="dropdown text-center rounded-xl mb-4 select-none text-black  border-2 border-[#EFF3F5] bg-white  "
                    x-data="{ open: false }">
                    <div class="flex">
                        <div class="hidden sm:block mr-auto py-3 sm:py-4 lg:py-6 pl-4 lg:pl-5 cursor-pointer flex-shrink-0" x-on:click="open = !open">
                            <img class="h-10 sm:h-16 lg:h-20 opacity-0 transition-opacity"
                                src="{{ $week['img'] }}"
                                alt="Collage showing pianists" loading="lazy"
                                onload="this.classList.remove('opacity-0')">
                        </div>
                        <div class="py-3 sm:py-4 lg:py-6 px-4 cursor-pointer text-left"
                            x-on:click="open = !open;">
                            <p class="text-pianote uppercase text-left text-sm">{!! $week['weekNum'] !!}</p>
                            <h5 class="leading-normal">
                                <strong>{!! $week['title'] !!}</strong></h5>
                            <p
                                x-bind:class="open && 'mb-4'" class="leading-tight text-sm">{!! $week['excerpt'] !!} <span class="text-pianote inline-block" x-bind:class="open && 'hidden'">Read more...</span> </p>


                            <div
                                x-cloak
                                class="transition-all duration-100 leading-relaxed sm:leading-relaxed overflow-hidden"
                                x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open  }">
                                <p class="leading-tight mb-4">{!! $week['desc'] !!}
                                    <br><br>
                                    <strong>{!! $week['backHeader'] !!}</strong></p>
                                @foreach ($week['back'] as $paragraph)
                                    <div class="flex items-start">
                                        <i class="{{ $paragraph['icon'] }} text-pianote text-3xl"></i>
                                        <p class="leading-tight ml-2 pl-2 pb-4">
                                            {!! $paragraph['desc'] !!}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ml-auto text-pianote py-3 sm:py-4 lg:py-6 pr-4 sm:pr-5 cursor-pointer " x-on:click="open = !open">
                            <i class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl" x-bind:class="{ 'rotate-45': open }" aria-hidden="true"></i>
                        </div>

                    </div>
                </div>
            @endforeach


            <div class="flex flex-wrap sm:flex-nowrap items-center justify-around mt-5 sm:mt-10">
                <img class="h-28 sm:h-36 lg:h-48 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/30-days-technique-Jordan-Rudess-logo.svg"
                    alt="30-Day Independence Logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-pianote mr-5"></i> Daily guided Piano workouts<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Guaranteed results
                </h4>
            </div>
            <a href="#final" class="join smaller w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-12 sm:mb-0 anchor-slide">ENROLL NOW</a><br>
        </div>
    </section>

    <section class="text-black px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#ffffff;">
        <div class="container max-w-4xl mx-auto pb-10">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-24 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/screen.webp"
                    alt="Mobile Screen with 30 Day To Better Technique">
                <div class="flex-grow sm:pl-10">
                    <h3 class="leading-tight text-center sm:text-left py-4"><strong>Get An Exclusive LIVE Lesson With Jordan</strong></h3>
                    <div class="text-center sm:text-left pb-4">
                        <p>All students who enroll in 30 Days to Better Technique will be invited to join an exclusive LIVE lesson with Jordan Rudess.
                            <br><br>
                            You’ll be able to share your feedback, ask questions, and learn live from the “world’s best keyboardist”.
                            <br><br>
                            It’s a rare opportunity.
                            <br><br>
                            And it’s only available to students who enroll in the first-ever class of 30 Days to Better Technique.
                            <br><br>
                            Reserve your spot today.
                        </p>
                    </div>
                    <a class="w-full md:w-5/12 join smaller text-white bg-pianote m-2 hover:bg-red-500  anchor-slide" href="#customize-anchor"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false">ENROLL NOW</a>
                </div>
                </div>
                <div class="flex justify-center">

            </div>
        </div>
    </section>

    @php
        $logo =
            'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/better-technique-guarantee.webp';
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
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/guarantee-collage.webp',
            ])
        </div>
    </section>

    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background-color:#EFF2F6;">
        <div class="container mx-auto relative z-50 text-center">
            <img class="h-20 sm:h-32 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/30-days-technique-Jordan-Rudess-logo.svg"
                alt="30 Day to Better Technique Logo">
            <h3 class="italic leading-tight mt-2 mb-3 sm:my-3 lg:my-4">What would happen if you learned from the<br>  <strong> best
                    keyboardist in the world?</strong></h3>
            <p class="leading-tight mb-4">
                <i class="fas fa-check text-pianote mr-1 inline-block"></i> Runs May 6 to June 3<br class="sm:hidden">
                <i class="fas fa-check text-pianote mr-1 ml-3 inline-block"></i> 20 Guided Workouts<br class="lg:hidden">
                <i class="fas fa-check text-pianote mr-1 ml-3 inline-block"></i> Lifetime Course Access<br class="sm:hidden">
                <i class="fas fa-check text-pianote mr-1 ml-3 inline-block"></i> 90-Day Money Back Guarantee
            </p>
            <!-- <span class="join sold-out medium w-full max-w-xs align-middle mt-7" @click="waitlistModal = true;">JOIN WAITLIST</span> -->
            <h6 class="leading-normal text-sm mb-5">
                <span class="text-pianote uppercase tracking-widest">Enrollment closes in
                    <strong><span class="text-pianote" x-cloak x-data="timer()" x-init="countdown()">
                            <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span
                                    x-text="dayText"></span></span>
                            <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span
                                    x-text="hourText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span
                                    x-text="minuteText"></span></span>
                            <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span
                                    x-text="secondText"></span></span>!
                            <span x-cloak x-show="timeLeft < 0">A Limited Time!</span>
                        </span></strong>
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
                 -->


            <div class="container mx-auto max-w-5xl">
                <div id="customize-anchor" class="anchor"></div>
                <div class="flex flex-wrap sm:flex-nowrap items-start justify-center mb-3 sm:mb-5 w-full mx-auto">
                    @include('pianote.products.partials._promo-card-special', [
                        'cardTitle' => 'Course Only',
                        'cardImage' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/bundle1.webp',
                        'imageHeight' => 'h-40',
                        'cardSubtitle' => 'Just 30 Days To Better Technique.',
                        'cardPrice' => '97',
                        'cardDiscount' => '127',
                        'cardExtraInfo' => 'One-time payment. Save 24%',
                        'cardLink' => '/ecommerce/add-to-cart?products[30-days-to-better-technique]=1&products[pianote_access_30-days]=1&promo-code=technique-launch&locked=true',
                        'badgeColor' => 'musora-black',
                        'extraBonuses' => [
                            '<strong class="font-black">30 Days To Better Technique</strong>',
                            '<strong class="font-black">Lifetime</strong> Course Access',
                            '<strong class="font-black">EXCLUSIVE</strong> Livestream with Jordan',
                            '<strong class="font-black">FREE</strong> 1-month Pianote Access',
                        ],
                        'buttonText' => 'ENROLL NOW',
                    ])

                    @include('pianote.products.partials._promo-card-special', [
                        'whiteBadge' => true,
                        'badgeText' => 'MOST POPULAR',
                        'cardTitle' => 'Unlimited Lessons',
                        'cardImage' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/bundle-03.webp',
                        'imageHeight' => 'h-40',
                        'cardSubtitle' => "1 year of Pianote + 4 bonuses worth $406.",
                        'cardPrice' => '20/mo',
                        'cardExtraInfo' => "Billed annually at $240/yr.",
                        'cardLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[30-days-to-better-technique]=1&products[taktell-piccolo-metronome]=1&products[pianote-book-bag]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&locked=true',
                        'badgeColor' => 'pianote',
                        'extraBonuses' => [
                            '<strong class="font-black">Annual Pianote Membership</strong>',
                            '<strong class="font-black">FREE 30 Days To Better Technique</strong>',
                            '<strong class="font-black">LIFETIME</strong> Course Access',
                            '<strong class="font-black">BONUS</strong> Pianote Metronome',
                            '<strong class="font-black">BONUS</strong> Pianote BookBag',
                            '<strong class="font-black">BONUS</strong> Chords & Scales Book',
                            '<strong class="font-black">BONUS</strong> Practice Planner',
                            '<strong class="font-black">EXCLUSIVE</strong> Livestream with Jordan',
                        ],
                        'buttonText' => 'GET EVERYTHING',
                    ])
                </div>
                <div class="flex items-center justify-center text-left mx-auto @if(Carbon\Carbon::create(2024, 4, 29, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now()) opacity-0 h-0 @endif">
                    <img class="h-10" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/the-power-of-chords/profiles.png" alt="profiles">
                    <p class="leading-tight pl-3">
                        Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.
                    </p>
                </div>
            </div>
        </div>
    </section>




    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <h2 class="mb-4 sm:mb-6"><strong>Still Have Questions?</strong></h2>
            <div class="px-4">
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

                                    And if you’re looking for the best way to do that, we’d suggest joining Pianote and getting access to over 1000 popular songs (including some Dream Theater songs), as well as other courses from world-class instructors.
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

    <section class="text-center text-white py-10 sm:py-16" style="background: #000000;">
        <div class="container max-w-5xl mx-auto px-4">
            <h2 class="leading-tight mb-3"><strong>Still reading?</strong></h2>
            <p class="leading-normal">By now, you already know that the biggest <br class="inline md:hidden"> difference between those pianists you envy
                <br> and the ones who get stuck on a plateau, never <br class="inline md:hidden"> making progress, all comes down to…
                <br><br>
                <span class="text-pianote"><strong>Better Technique.</strong></span>
                <br><br>
                So if you’re still here, let’s wrap this up and get <br class="inline md:hidden">  you playing better.
            </p>

            <div class="md:hidden flex flex-col items-center pt-10">
                @foreach ($boxes as $box)
                    <div class="w-full border border-pianote italic rounded-xl px-4 py-6 my-1" style="background: #283049;">
                        <h5 class="leading-normal">{{ $box }}</h5>
                    </div>
                @endforeach
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/final-appeal-m.webp"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                alt="Logo with arrows" class="w-2/3 opacity-0 transition-opacity">
                <div class="w-auto max-w-5xl text-center">
                        <h3 class="leading-normal">Enroll today and make these 30 days <br> the most
                            <strong>impactful</strong> and <strong>memorable <br></strong> of
                            your piano-playing life.</h3>
                    </div>
            </div>

            <div class="hidden md:block py-6 md:py-10">
                <div class="flex flex-wrap items-center justify-around text-left">
                    <div class="w-auto max-w-xs border border-pianote rounded-xl p-6 text-center italic md:hidden lg:inline" style="background: #283049;">
                        <p class="leading-normal">If you’ve ever watched Jordan Rudess play and thought, “How does he do
                            that?”...</p>
                    </div>
                    <div class="w-full flex justify-center content-around py-3">
                        <div class="w-auto max-w-xs flex flex-wrap content-around md:mr-4 lg:mr-0">
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-6 mb-4 text-center italic md:mt-10 lg:mt-0"
                                style="background: #283049;">
                                <p class="leading-normal">If you’re tired of playing the same songs over and over again, feeling like you lack the path to improvement…</p>
                            </div>
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-6 text-center italic"
                                style="background: #283049;">
                                <p class="leading-normal">If you want to learn from the best in the world…</p>
                            </div>
                        </div>
                        <div class="w-full flex justify-center items-center flex-col">

                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-6 text-center italic mb-4 lg:hidden" style="background: #283049;">
                            <p class="leading-normal">If you’ve ever watched Jordan Rudess play and thought, “How does he do
                                that?”...</p>
                            </div>

                            <img
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/final-appeal.webp">
                        </div>
                        <div class="w-auto max-w-xs flex flex-wrap content-around md:ml-4 lg:ml-0">
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-6 mb-4 text-center italic md:mt-10 lg:mt-0"
                                style="background: #283049;">
                                <p class="leading-normal">If you feel like your fingers aren’t strong enough or fast enough…</p>
                            </div>
                            <div class="w-auto max-w-xs border border-pianote rounded-xl p-6 text-center italic"
                                style="background: #283049;">
                                <p class="leading-normal">If you’re serious about improving your skills and developing as a pianist...</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto max-w-5xl text-center">
                        <h3 class="leading-normal">Enroll today and make these 30 days the most <br>
                            <strong>impactful</strong> and <strong>memorable</strong> of
                            your piano-playing life.</h3>
                    </div>
                </div>
            </div>

                <div class="flex justify-center">
                    <a class="w-full md:w-1/3 lg:w-1/4 join smaller text-white bg-pianote m-2 hover:bg-red-500  anchor-slide"
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
        'name' => 'jayZ',
        'video' => 'aFdOW1Ql3L4',
        'youtubeEmbed' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'danceOfEternity',
        'video' => 'LUknLohfN48',
        'youtubeEmbed' => true,
    ])
    @include('_partials.components.video-modal', [
        'name' => 'trailer',
        'video' => '928599834',
        'vimeo' => true,
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
