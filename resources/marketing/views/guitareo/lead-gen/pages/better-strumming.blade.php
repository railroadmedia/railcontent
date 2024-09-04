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

@section('body')
    @php

        $features = [
            [
                'title' => 'Course Kick-Off',
                'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/kick-off-new-players.jpg',
                'videoId' => 797858259,
            ],

        ];
        $lessons = [
            [
            'title' => 'Quick-Start Guide To The Piano',
            'description' => "Before we begin, we'll show you the note names and how to sit at the piano correctly. You've got this!"
            ],
            [
            'title' => 'Your First Chord Progression',
            'description' => "In week 1, you'll learn your first chord progression from start to finish and build your confidence through 1 lesson, 5 workouts, and a pre-recorded Q&A."
            ],
            [
            'title' => 'Build Real Chords',
            'description' => "In week 2, you'll learn triads and different hand movements needed to build real chords with 1 lesson, 5 workouts, and a pre-recorded Q&A. "
            ],
            [
            'title' => 'Create Beautiful Patterns',
            'description' => "In week 3, you'll learn about quarter notes and half notes and use them to create patterns through 1 lesson, 5 workouts, and a pre-recorded Q&A. "
            ],
            [
            'title' => 'Play Your First Song!',
            'description' => "In week 4, you'll pull together everything you've learned and add a few sprinkles of fancy leading into playing a song on your own!"
            ],
        ];
    @endphp


    @include('drumeo.products.partials.evergreen._lessons', [
        'title' => ' ',
        'description' => "<strong>Strum With Confidence In Just 30 Days</strong><br><br>30 Days To Better Strumming is the perfect course for beginner & intermediate guitarists who have ever felt stuck in their rhythm playing. Get step-by-step guidance to break through barriers and learn techniques that will stick with you for years.",
        'features' => $features,
        'lessonTitle' => ' ',
        'instructor' => ' ',
        'course' => ' ',
        'lessons' => $lessons
    ])
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#F2F8FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/coach-image.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-double-bass/coach-image.webp"
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
@endsection
