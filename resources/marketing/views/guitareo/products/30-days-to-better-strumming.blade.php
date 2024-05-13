@php
    require_once(resource_path('marketing/views/guitareo/_partials/homepage-data.php'));
@endphp

@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>30 Days To Better Strumming | Guitareo</title>
    <meta property="og:title" content="30 Days To Better Strumming | Guitareo">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

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
    @include('guitareo.sales.partials._nav', [
        'cartVersion' => true,
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="30 Days To Better Strumming Logo" class="h-32 sm:h-40 lg:h-48 my-4 md:my-10"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/header-logo.svg"><br>
                <h6 class="italic">Add essential rhythm techniques and strumming patterns to <br>
                    your playing <strong>by simply practicing for 10 minutes a day.</strong></h6>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                        @click="trailer = true;">
                        &nbsp;Watch Trailer
                    </div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                         &nbsp;Watch Trailer
                    </div>
                    <a class="w-5/12 join smaller text-white  m-2  anchor-slide" href="#customize-anchor"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false">ENROLL NOW</a>
{{--                    <a class="w-5/12 join sold-out smaller text-white m-2">ENROLLMENT CLOSED</a>--}}
                </div>
            </div>
{{--            <div class="uppercase text-sm text-guitareo py-4">--}}
{{--                <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                    <strong>--}}
{{--                        <span x-cloak x-show="timeLeft > 0">--}}
{{--                            Enrollment closes in--}}
{{--                            <br>--}}
{{--                                <span x-show="day > 0"><span x-text="day"></span><span x-text="day"></span></span>--}}
{{--                                <span x-show="hour > 0"><span x-text="hour"></span><span x-text="hour"></span></span>--}}
{{--                                <span x-show="minute > 0"><span x-text="minute"></span><span x-text="minute"></span></span>--}}
{{--                                <span x-show="second > 0"><span x-text="second"></span><span x-text="second"></span></span>--}}
{{--                        </span>--}}
{{--                        <span x-cloak x-show="timeLeft < 0"> A Limited Time! </span>--}}
{{--                    </strong>--}}
{{--                </span>--}}
{{--            </div>--}}
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
                    <p class="mb-2"><i class="fa fa-check text-guitareo"></i> {!! $item !!}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="text-center px-4 sm:px-6 py-10 sm:pt-16">
        <div class="container max-w-4xl mx-auto">
            <p class="leading-normal mb-10 sm:mb-12 mx-auto max-w-2xl"><strong>30 Days to Better Strumming</strong> is the first guided piano technique course that will have you playing WITH a world-class instructor - Jordan Rudess. Over 30 days, you’ll play with Jordan as he guides you through the exercises he used to develop his incredible piano skills.</p>



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
                            'You’ll be supported every step of the way by Guitareo’s team of expert instructors. Plus you’ll get to hang with Jordan in an exclusive LIVE Q&A.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/timeline-05.webp',
                        'title' => 'Lifetime Access',
                        'desc' => 'You can access ALL the lessons and downloads from 30 Days to Better Strumming for life. That means you can return to your favorite workouts over and over – plus, it means you can work at your own pace.',
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
        <h1 class="leading-none -mt-8 mb-8"><i class="fal fa-angle-down text-guitareo"></i></h1>


        <div class="flex justify-center py-4">
            <a class="w-full md:w-1/3 lg:w-1/4 join smaller text-white bg-guitareo m-2 hover:bg-red-500  anchor-slide"
                href="#customize-anchor" x-data="{ move: false }" @mouseover="move = true"
                @mouseout="move = false">ENROLL NOW</a>
        </div>
        <div class="uppercase text-sm text-center text-guitareo pb-4">
                    <span x-cloak x-data="timer()" x-init="countdown()">
                        <strong>
                            <span x-cloak x-show="timeLeft > 0">
                                Enrollment closes in
                                <br>
                                    <span x-show="day > 0"><span x-text="day"></span><span x-text="day"></span></span>
                                    <span x-show="hour > 0"><span x-text="hour"></span><span x-text="hour"></span></span>
                                    <span x-show="minute > 0"><span x-text="minute"></span><span x-text="minute"></span></span>
                                    <span x-show="second > 0"><span x-text="second"></span><span x-text="second"></span></span>
                            </span>
                            <span x-cloak x-show="timeLeft < 0"> A Limited Time! </span>
                        </strong>
                    </span>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background: #111729">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>Strumming progression made simple.</strong></h2>
            <p class="leading-normal mt-5 mb-10 sm:mb-12 mx-auto" style="max-width:600px;">Lorem ipsum dolor sit amet consectetur. Duis nam gravida blandit ut pharetra magna commodo nisi augue. Integer egestas in viverra quis sapien varius. Enim ultrices integer donec aenean vivamus in mauris tellus libero. Nibh bibendum eros facilisis risus.</p>


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
                        'desc' => 'Because what’s the point of getting Better Strumming?<br><br>To play beautiful music. <br><br> In Week 4, Jordan will share his tips on how to create true emotion and expression in your piano playing. How do you go from hitting the keys to making music? This final week will show you how to tell a story with your playing.',
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
                            <p class="text-guitareo uppercase text-left text-sm">{!! $week['weekNum'] !!}</p>
                            <h5 class="leading-normal">
                                <strong>{!! $week['title'] !!}</strong></h5>
                            <p
                                x-bind:class="open && 'mb-4'" class="leading-tight text-sm">{!! $week['excerpt'] !!} <span class="text-guitareo inline-block" x-bind:class="open && 'hidden'">Read more...</span> </p>


                            <div
                                x-cloak
                                class="transition-all duration-100 leading-relaxed sm:leading-relaxed overflow-hidden"
                                x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open  }">
                                <p class="leading-tight mb-4">{!! $week['desc'] !!}
                                    <br><br>
                                    <strong>{!! $week['backHeader'] !!}</strong></p>
                                @foreach ($week['back'] as $paragraph)
                                    <div class="flex items-start">
                                        <i class="{{ $paragraph['icon'] }} text-guitareo text-3xl"></i>
                                        <p class="leading-tight ml-2 pl-2 pb-4">
                                            {!! $paragraph['desc'] !!}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ml-auto text-guitareo py-3 sm:py-4 lg:py-6 pr-4 sm:pr-5 cursor-pointer " x-on:click="open = !open">
                            <i class="fas fa-plus transform transition-all duration-300 text-lg md:text-2xl lg:text-3xl" x-bind:class="{ 'rotate-45': open }" aria-hidden="true"></i>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #EFF2F6">
        <div class="container max-w-4xl mx-auto">

            <div class="flex flex-wrap sm:flex-nowrap items-center justify-around mt-5 sm:mt-10">
                <img class="h-28 sm:h-36 lg:h-48 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/30-days-technique-Jordan-Rudess-logo.svg"
                    alt="30-Day Independence Logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-guitareo mr-5"></i> Daily guided Piano workouts<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> Guaranteed results
                </h4>
            </div>
            <a href="#final" class="join smaller w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-12 sm:mb-0 anchor-slide">ENROLL NOW</a><br>
        </div>
    </section>

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
                <h6 class="uppercase text-guitareo">It’s time to meet your teacher…</h6>
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
    </section>


    @php
        $testimonials = $guitareo['testimonials'];
        $youtube = number_format(Prices::$guitareoYoutubeSubsc);
        $facebook = number_format(Prices::$guitareoFacebookLikes);
        $instagram = number_format(Prices::$guitareoInstagramFollowers);
    @endphp

    @include('musora.sales.components.testimonials-section', [
        'header' => 'guitarists',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/guitareo/membership/homepage/2024/guitareo-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar.',
    ])



    @include('musora.sales.components.order-section-collage', [
    'logo' => 'marketing/guitareo/membership/homepage/2024/guitareo-logo-green.webp',
    'header' => 'Unlimited guitar lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
    'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
    'image' => 'marketing/guitareo/membership/homepage/2023/guitareo-collage.png',
    ])

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

                                    But you don’t need years of experience to enroll in 30 Days to Better Strumming. The course has been structured to be beginner-friendly to start with. And if you HAVE been playing for years, you’ll pick up some incredible tips and exercises that will change how you practice.

                                    Will you be challenged? Yes.

                                    But that’s exactly how you get better.

                                    And we’ll support you every step of the way.

                                    So as Jordan says…

                                    “Don’t be scared. Jump in. I’m friendly. I’m there with you. We’re going to play together. And we’re going to make some music.”

                                    And hey, the absolute worst-case scenario is that you give it a shot and it’s not right for you. And then you’ll be protected by our 90-Day Better Strumming Guarantee.
                                    ',
                ])
                @include('_partials.components.question-dropdown', [
                    'title' =>
                        'This sounds like a big time commitment, and my life is pretty busy. What if I miss a day and fall behind?',
                    'desc' => '30 Days to Better Strumming takes place over 30 days. (It’s right there in the title.) But…

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

                                    And if you’re looking for the best way to do that, we’d suggest joining Guitareo and getting access to over 1000 popular songs (including some Dream Theater songs), as well as other courses from world-class instructors.
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

    @include('guitareo.sales.partials._footer')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
