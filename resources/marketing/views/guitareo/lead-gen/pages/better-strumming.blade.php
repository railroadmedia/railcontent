@php
    $steps = [
        [
            'position' => 'left',
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/Step1.jpg',
            'desc' => 'Enter your email address. It’s free. That’s right - 100% free!'
        ],
        [
            'position' => 'right',
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/Step2.jpg',
            'desc' => 'Join the Facebook Event. You’ll be emailed the invite.'
        ],
        [
            'position' => 'left',
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/Step3.jpg',
            'desc' => 'Access your special link for your LIVE lesson with Ayla.'
        ],
        [
            'position' => 'right',
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/Step4.jpg',
            'desc' => 'Get your downloadable resources and practice tips, and connect with Ayla.'
        ],
        [
            'position' => 'left',
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/Step5.jpg',
            'desc' => 'Post your progress (if you want - it’s totally up to you).'
        ],
        [
            'position' => 'right',
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/Step6.jpg',
            'desc' => 'Play guitar BETTER!'
        ],
      ];
@endphp

@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Live Bootcamp | Guitareo</title>
    <meta property="og:title" content="Live Bootcamp | Guitareo">
    <meta name="description" content="Join any of these 60-minute LIVE guitar lessons with Ayla Tesler-Mabe"/>
    <meta property="og:description" content="Join any of these 60-minute LIVE guitar lessons with Ayla Tesler-Mabe">

    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/lead-gen/back-to-basics/share_image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/back-to-basics/">

    @parent

    @include('_partials.layout._tailwindcdn')
    <link rel="preload" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}"></noscript>
    <style>

        /* column-oriented masonry layout */
        .masonry {
            column-count: 1;
            column-gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .masonry {
                column-count: 2;
            }
        }

        @media (min-width: 1024px) {
            .masonry {
                column-count: 3;
            }
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
    kickOff: false,
    lazyLoad: false,
    }"
@endsection

@section('body')
    <section x-data="{ visible: false }" x-intersect.once="visible = true;" class="m-0 text-white" style="background: #111729;">
        <div class="container max-w-5xl mx-auto px-4 md:px-6 md:flex leading-normal py-6 md:py-8">
            <div class="pb-4 md:w-2/3 lg:w-8/12 md:pr-4 flex-shrink-0">
                <div class="aspect-16:9 cursor-pointer rounded-xl my-7 autoplay-video overflow-hidden w-full relative"
                    x-on:click="kickOff = true;" role="button">
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                    <img class="absolute inset-0 overflow-hidden object-cover w-full h-full absolute z-0 opacity-0 transition-opacity"
                        loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-01.webp"
                        alt="Thumbnail for tutorial video"/>
                </div>
                <div class="mt-4 md:py-4">
                    <h5 class="leading-tight"><strong>Strum With Confidence In Just 30 Days</strong></h5>
                    <p class="mt-4">
                        <span>30 Days To Better Strumming is the perfect course for beginner &amp; intermediate guitarists who have ever felt stuck in their rhythm playing. Get step-by-step guidance to break through barriers and learn techniques that will stick with you for years. </span>
                    </p>
                </div>
            </div>

            <div class="text-black md:w-1/3">
                <div class="relative">
                    <div x-data="{ isOpen: [] }">

                        @php
                            $lessons = [
                                [
                                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-02.webp',
                                    'weekNum' => 'WEEK 1',
                                    'title' => 'Get Into The Groove',
                                    'excerpt' => 'todo',
                                    'description' => 'Build the foundations to set you up for strumming success! In week 1, you will learn to get confident with constant strumming, miss notes, eighth note variations, playing the campfire strum pattern, using your foot to keep time, and using muted strums vs open chords. ',

                                ],
                                [
                                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-03.webp',
                                    'weekNum' => 'WEEK 2',
                                    'title' => 'Push The Beat',
                                    'excerpt' => 'todo',
                                    'description' => 'It’s time to learn to push your beats, meet the rock n’ roll, and too many ands & reggae strumming patterns. Play alongside Kent, and you will lock in within no time. ',

                                ],
                                [
                                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-04.webp',
                                    'weekNum' => 'Week 3',
                                    'title' => 'Get Creative',
                                    'excerpt' => 'todo',
                                    'description' => 'Let’s get dynamic! Join Kent as he walks you through dynamics, accents, 332 pattern, palm mutes & split strums. These techniques will transform your playing for years to come.',

                                ],
                                [
                                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1100x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-05.webp',
                                    'weekNum' => 'Week 4',
                                    'title' => 'Put It All Together',
                                    'excerpt' => 'todo',
                                    'description' => 'Three weeks down, one to go! This is where you’ll take a moment to see how far you’ve come and add the icing on the cake. You’ll begin utilizing sixteenth notes, the gallop strum, the smack strum, and the Jim N Jack, and create your strum patterns. ',

                                ],
                            ];
                        @endphp
                        @foreach ($lessons as $lesson)
                            <div x-data="{ open: false }" class="rounded-lg bg-white shadow mb-1.5">
                                <button class="rounded-lg flex w-full items-center justify-between px-4 py-3.5" style="background: #eff7ff;" x-on:click="open = !open;">
                                    <p class="mx-0 truncate">{{ $lesson['title'] }}</p>
                                    <div class="ml-auto text-{{ $brand }} cursor-pointer">
                                        <i class="fas fa-angle-down transform transition-all duration-300" x-bind:class="{ 'rotate-180': open }"></i>
                                    </div>
                                </button>
                                <div x-cloak class="transition-all duration-200 overflow-hidden" x-bind:class="open ? 'max-h-[2000px]' : 'max-h-0'">
                                    <p class="px-4 pb-4 bg-blue-50 rounded-lg leading-tight text-xs">{{ $lesson['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="absolute h-5 bottom-0 left-0 right-0 z-10 hidden" style="background: linear-gradient(to bottom, transparent, #00101d);"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#F2F8FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/platform-header.png">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/platform-header.png"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                        alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-guitareo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Kent Shores</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Kent holds a degree from the University of North Texas in Jazz Studies - Guitar Performance with a Minor in Music Theory. He has performed across Canada, the United States, and India with various bands. As an educator, Kent has over ten years of experience teaching lessons ranging from complete beginners to more advanced players.
                        <br><br>
                        His teaching philosophy is about bringing out the best in his students and fostering a love of music. He strives to make sure that music lessons are fun. He enjoys sharing music with his students and celebrating their achievements.
                    </h6>
                    <div class="flex justify-around text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
                                alt="tiktok icon">
                            <h3 class="mt-2"><strong>42K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Likes</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>18K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="/favicons/guitareo/apple-touch-icon.png"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>3.5K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $testimonials = [
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'Wow. I really didn’t know how much I learned from this lesson. I will definitely go through the course again. I’m a lot worse than I thought I was at timing. Thank you!!',
             'name' => 'wr_jenkyn15006',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'I love these so much! One of my favorite 30 day challenges in all of Musora!   Thank you Kent!  You are such a great teacher!  My 10 year old daughter and I do this together.',
             'name' => 'Andrew Naranjo',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'The strum pattern was based on the double bass workout in drumeo: 1 & 2 . . & 4 .<br><br> Thanks for the fun workout!',
             'name' => 'Vincent Blansaer',
             ],

             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => '😎It\'s been a long time since I had so much fun with the guitar. thank you so much!!!😄',
             'name' => 'RAlvarez1',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'Oh Man! I have been playing guitar for so long but only solo. This is the first time I am strumming with drums. It feels SOOOO Goooood. I am happy to find out that I kept the rhythm perfectly. Adding the misses at will, any number of misses any number of places. Strking similar to Flamenco rasgueo (on steel strings - mind it), with really gentle strokes. I am getting the feeling - I will gro though the entire 30 day challenge. Thank you for designing such an exhilarating exercise.',
             'name' => 'Boyati',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'So glad I stuck with this challenge.  Love the 16th notes. Learning what a sixteenth note feels like in my pick hand, and my whole body. Looking forward to the rest of this week.',
             'name' => 'will.larson1',
             ],

             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'Thanks, Kent, I\'m liking this. Putting on my beginner\'s hat, it\'s letting some good info come into my mind. Getting the rhythm in my right hand and left foot. Also the fancy C and D, figuring out what the top three strings "mean" in the chord is a fun exercise.',
             'name' => 'will.larson1',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'Thank you, I also find that I am contantly releasing the pressure on the neck with the chord hand when strumming to stop the strings from ringing out and sounding muddy. Very much like the use of the pedal when playing piano. Is this okay or should I avoid doing that?',
             'name' => 'p_radley80864',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
             'description' => 'Yayyyy! I\'ve completed! I really, really enjoyed this course, Kent. Thank you so much.',
             'name' => 'clairespry60545',
             ]
         ];
    @endphp
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20">
        <div class="container max-w-5xl mx-auto text-center">
            <h2 class="mb-5 md:mb-7"><strong>What Our Students Are Saying</strong></h2>
            <div class="masonry text-left">
                @foreach ($testimonials as $card)
                    <div class="masonry-item rounded-lg p-6 lg:px-6 mb-4 flex flex-col" style="background-color:#F2F8FF;">
                        <p class="text-gray-700 flex-grow">{!! $card['description'] !!}</p>
                        <div class="flex items-center mt-4">
                            <img class="w-12 h-12 border border-guitareo rounded-full mr-2" src="{{ $card['avatar'] }}" alt="{{ $card['name'] }}">
                            <div>
                                <h5 class="text-lg font-semibold">{{ $card['name'] }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('_partials.components.video-modal', [
        'name' => 'kickOff',
        'video' => '944222905',
        'vimeo' => true,
    ])
@endsection
