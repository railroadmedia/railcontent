@php
    require_once(resource_path('marketing/views/guitareo/_partials/homepage-data.php'));
@endphp

@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>30 Days To Better Strumming | Guitareo</title>
    <meta property="og:title" content="30 Days To Better Strumming | Guitareo">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
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
            background-color: #00C9AC;
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
            background-color: #00C9AC;
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
                <img alt="30 Days To Better Strumming Logo" class="h-14 sm:h-16 lg:h-20"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-white.png"><br>
                <h1 class="leading-tight my-6"><strong>Strum with confidence</strong><br> in just 30 days.</h1>
                <h6 class="leading-tight italic">Add essential rhythm techniques and strumming patterns to <br>
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
                <p class="uppercase text-sm text-guitareo">Enrollment closes in<br>
                    <strong x-cloak x-data="timer()" x-init="countdown()">
                        <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                        <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                        <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                        <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                        <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                    </strong>
                </p>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(2, 11, 22, 0.6)"></div>
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
            src="https://player.vimeo.com/progressive_redirect/playback/932207347/rendition/1080p/file.mp4?loc=external&signature=5f7623116aebc377256b8e977f9f8cd5d89a073cbbe72da98636654c0508e44c"></video>


    </header>

    @php
        $items = [
            'Daily Guided  <br class="hidden sm:inline md:hidden"> Lessons',
            'Learn By  <br class="hidden sm:inline md:hidden"> Playing Along',
            'Guaranteed <br class="hidden sm:inline md:hidden"> results'
            ];
    @endphp

    <section class="bg-black text-white py-4 sm:py-7 sm:px-6 text-center">
        <div class="container max-w-4xl mx-auto flex flex-wrap md:flex-center justify-center ">
            @foreach ($items as $item)
                <p class="w-full sm:w-auto mb-2 sm:mb-0 tracking-widest uppercase"><i class="fa fa-check text-guitareo"></i> {!! $item !!}</p>
            @endforeach
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#F1F7FE;">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-5 sm:mb-7"><strong>This course is designed for:</strong></h2>

            @php
                $drummers = [
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/audience-01.webp',
                        'title' => 'Beginner Guitarists',
                        'description' =>
                            'If you\'re new to the guitar and know a handful of chords, your strumming is limited to 1 pattern or aimless strumming. This course will take you to the next level to start strumming with intention, understand the basics of rhythm, and follow along with your favorite songs.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/audience-02.webp',
                        'title' => 'Intermediate Guitarists',
                        'description' =>
                            'You’ve been playing for a while but found yourself in a rut. You resort to the same handful of strumming patterns and don’t know where to go. This course will force you to revisit the foundations, fill the knowledge gaps that you possess, and expand your repertoire.',
                    ],
                    [
                        'image' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)//marketing/guitareo/products/30-days-to-better-strumming/audience-03.webp',
                        'title' => 'Brand New Guitarists',
                        'description' =>
                            'Maybe you haven’t learned a single thing on the guitar yet. This course might push you, but if you’re up for the challenge, follow along, take your time, and you will kick start your guitar journey with a boost!',
                    ],
                ];
            @endphp

            <div class="flex flex-col sm:flex-row text-left justify-center">
                @foreach ($drummers as $drummer)
                    <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0 mx-auto sm:mx-0">
                        <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl"
                            style="background-image:url('{{ $drummer['image'] }}'); object-position: 60% 0">
                            <h6 class="leading-tight lg:leading-relaxed absolute bottom-1 w-full z-10"><strong>{{ $drummer['title'] }}</strong></h6>
                            <div class="absolute inset-0 z-0"
                                style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                        </div>
                        <p class="leading-normal mt-3">{{ $drummer['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-center px-4 sm:px-6 py-10 sm:pt-16">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight mb-3 sm:mb-5"><strong>Strumming can make or<br> break your playing.</strong></h2>
            <p class="leading-normal mb-10 sm:mb-12 mx-auto max-w-2xl">
                30 Days To Better Strumming is the perfect course for beginner & intermediate guitarists who have ever felt stuck in their rhythm playing. Get step-by-step guidance to break through barriers and learn techniques that will stick with you for years.
                <br><br>
                <em><strong>In just 30 days you’ll be able to:</strong></em></p>
            @php
                $gettings = [
                    [
                        'special' => true,
                        'position' => 'left',
                        'img' =>  'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/feature-01.mp4',
                        'desc' =>  '<strong>Lock into the groove of any song</strong> so you can effortlessly play along with your favorite tracks and nail every beat and rhythm.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>  'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/feature-02.webp',
                        'desc' =>  '<strong>Play iconic strum patterns</strong> and bring classic strumming patterns to life with your personal touch.',
                    ],
                    [
                        'position' => 'left',
                        'img' =>  'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/marketing/guitareo/products/30-days-to-better-strumming/feature-03.webp',
                        'desc' => '<strong>Add variations and techniques</strong> to keep your strumming engaging so that playing the guitar always feels fresh, exciting, and captivating.',
                    ],
                    [
                        'position' => 'right',
                        'img' =>  'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/feature-03-1.webp',
                        'desc' => '<strong>Build a powerful rhythm part</strong> that you can use to enhance your songwriting immediately, all while showcasing your unique musical style.',
                    ],
                    [
                        'position' => 'left',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/feature-04.webp',
                        'desc' => '<strong>Develop a foundational skill</strong> that will last you a lifetime and immediately level you up as a guitar player. ',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 py-7">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h6 class="leading-normal mt-1 md:mt-0">{!!  $getting['desc']  !!}</h6>
                            </div>
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="thumbnail" />
                        </div>
                    @else
                        <div
                            class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== 4) mb-16 md:mb-20 @else md:mb-0 @endif">
                            @if(!empty($getting['special']))
                                <video class="-mt-7 rounded-lg overflow-hidden object-cover w-full h-full" src="{{ $getting['img'] }}" type="video/mp4" autoplay loop playsinline muted></video>
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                    style="background-image:url('{{ $getting['img'] }}')"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0 md:mb-10">
                                <h6 class="leading-normal mt-1 md:mt-0">{!!  $getting['desc']  !!}</h6>
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
        <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
            loading="lazy" onload="this.classList.remove('opacity-0')"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
            alt="Image of joined student profiles">
        <p class="inline-block leading-tight text-sm align-middle text-left">Join
            {{ number_format($nPackOwners ?? 0) }} guitarists who<br> have already registered.</p>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background: #111729">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>Strumming progression made simple.</strong></h2>
            <p class="leading-normal mt-5 mx-auto" style="max-width:700px;">Lorem ipsum dolor sit amet consectetur. Duis nam gravida blandit ut pharetra magna commodo nisi augue. Integer egestas in viverra quis sapien varius. Enim ultrices integer donec aenean vivamus in mauris tellus libero. Nibh bibendum eros facilisis risus.</p>

            <img class="w-full rounded-lg my-7 transition-opacity opacity-0" loading="lazy"
                onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-01.webp"
                alt="thumbnail" />
            @php
                $weeks = [
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-02.webp',
                        'weekNum' => 'WEEK 1',
                        'title' => 'Get Into The Groove',
                        'excerpt' => 'todo',
                        'desc' => 'Build the foundations to set you up for strumming success! In week 1, you will learn to get confident with constant strumming, miss notes, eighth note variations, playing the campfire strum pattern, using your foot to keep time, and using muted strums vs open chords. ',

                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-03.webp',
                        'weekNum' => 'WEEK 2',
                        'title' => 'Push The Beat',
                        'excerpt' => 'todo',
                        'desc' => 'It’s time to learn to push your beats, meet the rock n’ roll, and too many ands & reggae strumming patterns. Play alongside Kent, and you will lock in within no time. ',

                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-04.webp',
                        'weekNum' => 'Week 3',
                        'title' => 'Get Creative',
                        'excerpt' => 'todo',
                        'desc' => 'Let’s get dynamic! Join Kent as he walks you through dynamics, accents, 332 pattern, palm mutes & split strums. These techniques will transform your playing for years to come.',

                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-05.webp',
                        'weekNum' => 'Week 4',
                        'title' => 'Put It All Together',
                        'excerpt' => 'todo',
                        'desc' => 'Three weeks down, one to go! This is where you’ll take a moment to see how far you’ve come and add the icing on the cake. You’ll begin utilizing sixteenth notes, the gallop strum, the smack strum, and the Jim N Jack, and create your strum patterns. ',

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
                                x-bind:class="open && 'mb-4'" class="leading-tight text-sm">{{--{!! $week['excerpt'] !!}--}} <span class="text-guitareo inline-block" x-bind:class="open && 'hidden'">Read more...</span> </p>


                            <div
                                x-cloak
                                class="transition-all duration-100 leading-relaxed sm:leading-relaxed overflow-hidden"
                                x-bind:class="{ 'max-h-0': !open, 'max-h-[2000px]': open  }">
                                <p class="leading-tight mb-4">{!! $week['desc'] !!}
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
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #F1F7FE">
        <div class="container max-w-4xl mx-auto">

            <div class="flex flex-wrap sm:flex-nowrap items-center justify-around mt-5 sm:mt-10">
                <img class="h-28 sm:h-36 lg:h-48 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-black.png"
                    alt="30-Day Independence Logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-guitareo mr-5"></i> 20 guided play-along lessons<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> Lifetime Access<br>
                    <i class="fas fa-check text-guitareo mr-5"></i> 90 Day Money Back Guarantee
                </h4>
            </div>
            <a href="#final" class="join smaller w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 sm:mb-5 anchor-slide">ENROLL NOW</a><br>
            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/joined-profiles.png"
                alt="Image of joined student profiles">
            <p class="inline-block leading-tight text-sm align-middle text-left">Join
                {{ number_format($nPackOwners ?? 0) }} guitarists who<br> have already registered.</p>
        </div>
    </section>

    <section class="flex flex-col items-center text-white" style="background-color: #111729;">
        <picture>
            <source media="(min-width: 1200px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/coach-bg.webp">
            <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/coach-bg.webp">
            <img
                class="w-full transition-opacity opacity-0 hidden md:inline"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)//marketing/guitareo/products/30-days-to-better-strumming/coach-bg.webp"
                alt="Jordan Rudess Photo"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
        </picture>
        <img class="w-full inline md:hidden transition-opacity opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/coach-bg-m.webp" onload="this.classList.remove('opacity-0');" loading="lazy" alt="Jordan Rudess Photo">

        <div class="container mx-auto max-w-5xl p-4 md:p-6 -mt-52 md:-mt-10">
            <div class="flex flex-col justify-center items-center">
                <h6 class="uppercase text-guitareo">It’s time to meet your teacher…</h6>
                <h1 class="text-6xl mb-4 font-bebas uppercase sm:tracking-widest">Kent Shores</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="md:py-4 md:pt-10">
                    <p class="mb-4">Kent holds a degree from the University of North Texas in Jazz Studies - Guitar Performance with a Minor in Music Theory. He has performed across Canada, the United States, and India with various bands. As an educator, Kent has over ten years of experience teaching lessons ranging from complete beginners to more advanced players.</p>
                </div>
                <div class="md:py-4 md:pt-10">
                    <p class="mb-4">His teaching philosophy is about bringing out the best in his students and fostering a love of music. He strives to make sure that music lessons are fun. He enjoys sharing music with his students and celebrating their achievements.</p>
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
