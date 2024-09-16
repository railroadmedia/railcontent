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
    <title>30 Days To Better Strumming | Guitareo</title>
    <meta property="og:title" content="30 Days To Better Strumming | Guitareo">
    <meta name="description" content="Strum With Confidence In Just 30 Days"/>
    <meta property="og:description" content="Strum With Confidence In Just 30 Days">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    @parent

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
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

        .join.outline {
            background:transparent;
            border:2px solid #fff;
            color:#fff;
        }

        .join.outline:hover,
        .join.outline:focus {
            background:#fff;
            color:#000;
        }
        .lessons-list::-webkit-scrollbar {
            width: 6px; 
        }

        /* The track (background) of the scrollbar */
        .lessons-list::-webkit-scrollbar-track {
            background-color: #000B17; /* Background color of the track */
            border-radius: 8px; /* Rounded corners for the track */
        }

        /* The thumb (the draggable part of the scrollbar) */
        .lessons-list::-webkit-scrollbar-thumb {
            background-color: #2A3C47; /* Color of the scrollbar thumb */
            border-radius: 8px; /* Rounded corners for the thumb */
        }

        /* The thumb when hovered */
        .lessons-list::-webkit-scrollbar-thumb:hover {
            background-color: #4A5568; /* Slightly lighter color on hover */
        }
    </style>
@endsection

@section('body-data')
    x-data="{
    kickOff: false,
    unlock: false,
    lazyLoad: false,
    }"
@endsection

@section('body')
<section x-data="{ visible: false, showVideoModal: false, videoId: null, currentVideoIndex: 0 }" x-intersect.once="visible = true;" class="text-white text-center px-4 md:px-6 py-6 md:py-8" style="background: #111729;">
    <div class="container max-w-5xl mx-auto">
        <img 
            alt="30 Days To Better Strumming Logo" 
            class="h-14 sm:h-20 mx-auto mb-3 sm:mb-5"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-white.png"
        >
        <div class="md:flex">
            <div class="pb-4 md:w-2/3 lg:w-8/12 md:pr-4 flex-shrink-0 text-left">
                <div 
                    class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                    x-on:click="kickOff = true;" 
                    role="button"
                >
                    <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                    <img 
                        class="absolute inset-0 overflow-hidden object-cover w-full h-full z-0 opacity-0 transition-opacity"
                        loading="lazy" 
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/thumbs-01.webp"
                        alt="Thumbnail for tutorial video"
                    />
                </div>
                <div class="mt-4">
                    <h5 class="leading-tight"><strong>Strum With Confidence In Just 30 Days</strong></h5>
                    <p class="mt-4">
                        <span>
                            30 Days To Better Strumming is the perfect course for beginner &amp; intermediate guitarists who have ever felt stuck in their rhythm playing. Get step-by-step guidance to break through barriers and learn techniques that will stick with you for years.
                        </span>
                    </p>
                </div>
            </div>
           
           <!-- Video Modal -->
            <div 
                x-show="showVideoModal" 
                x-on:keydown.escape.prevent.stop="showVideoModal = false; pauseVideo();" 
                class="fixed inset-0 overflow-y-auto" style="display: none; z-index: 2147483002;" 
                role="dialog" 
                aria-modal="true"
            >
                <div x-show="showVideoModal" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-80" style="z-index: 1005;" @click="showVideoModal = false; pauseVideo();"></div>

                <div 
                    x-show="showVideoModal" 
                    x-transition 
                    class="relative min-h-screen flex items-center justify-center px-4" 
                    style="z-index: 1006;" 
                    @click="showVideoModal = false; pauseVideo();"
                >
                    <i class="fa-light fa-times fa-2x fixed top-1 right-1 text-white cursor-pointer text-5xl" @click="showVideoModal = false; pauseVideo();"></i>
                    <div x-on:click.stop class="relative w-full max-w-6xl overflow-hidden rounded-xl">
                        <div class="relative w-full" style="padding-top: 56.25%;">
                            <div id="vimeo-player" class="absolute inset-0 w-full h-full"></div> 
                        </div>
                        <a class="w-full sm:w-2/3 md:max-w-[320px] join guitareo smaller mt-4 sm:pr-4" href="/shop/30-days-to-better-strumming" x-show="showVideoModal">GET FULL ACCESS FOR FREE</a>
                        <a class="w-full sm:w-2/3 md:max-w-[320px] join smaller white outline my-2" x-show="showVideoModal" @click="nextLesson()">Next Lesson</a>
                    </div>
                </div>
            </div>

            <div class="text-black md:w-1/3 text-left">
                <div class="relative h-96 mb-5 rounded-xl overflow-hidden">
                    <div class="overflow-y-auto h-full lessons-list">
                        @php
                           $lessons = [
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/Course Kickoff-1715065477.jpg',
                                    'title' => 'Course Kick-Off',
                                    'name' => 'kickOff',
                                    'videoId' => '944222905',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/Gear Tips-1715065538.jpg',
                                    'title' => 'Gear Tips',
                                    'name' => 'gearTips',
                                    'videoId' => '944223382',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/Chord Shapes-1715065612.jpg',
                                    'title' => 'Chord Shapes For The Challenge',
                                    'name' => 'chordShapes',
                                    'videoId' => '944223156',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/1-1715253818.jpg',
                                    'title' => 'Day 1 — Get Into The Groove',
                                    'name' => 'getIntoTheGroove',
                                    'videoId' => '944945269',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/2-1715253863.jpg',
                                    'title' => 'Day 2 — Learning To Miss',
                                    'name' => 'learningToMiss',
                                    'videoId' => '944235965',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/3-1715253902.jpg',
                                    'title' => 'Day 3 — Add In The Bridge',
                                    'name' => 'addInTheBridge',
                                    'videoId' => '944236131',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/4-1715253943.jpg',
                                    'title' => 'Day 4 — The Campfire Strum Pattern',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/5-1715253975.jpg',
                                    'title' => 'Day 5 — Add In A Variation',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/6-1715490929.jpg',
                                    'title' => 'Day 6 — The Reggae Strum Pattern',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/7-1715491118.jpg',
                                    'title' => 'Day 7 — Learn To Push Your Chords',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/8-1715491304.jpg',
                                    'title' => 'Day 8 — The Rock ’N’ Roll Strum Pattern',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/9-1715491483.jpg',
                                    'title' => 'Day 9 — The Too-Many-Ands Strum Pattern',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/10-1715491541.jpg',
                                    'title' => 'Day 10 — Coming Up With Your Own Strum Patterns',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/11-1715495497.jpg',
                                    'title' => 'Day 11 — Add Variations To Your Strums',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/12-1715495568.jpg',
                                    'title' => 'Day 12 — Adding Accents',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/13-1715496223.jpg',
                                    'title' => 'Day 13 — The 3-3-2 Strum Pattern',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/14-1715496361.jpg',
                                    'title' => 'Day 14 — Add Palm Mutes',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/15-1715497833.jpg',
                                    'title' => 'Day 15 — Thinking About Dynamics',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/16-1715496741.jpg',
                                    'title' => 'Day 16 — Let’s Gallop',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/17-1715496918.jpg',
                                    'title' => 'Day 17 — Give It A Smack',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/18-1715497021.jpg',
                                    'title' => 'Day 18 — Double It Up',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/19-1715497134.jpg',
                                    'title' => 'Day 19 — Put It All Together',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/20-1715497295.jpg',
                                    'title' => 'Day 20 — Final Performance',
                                ],
                                [
                                    'thumb' => 'https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/Week4 (1)-1715497438.jpg',
                                    'title' => 'Week 4 — Rest & Review',
                                ],
                            ];
                        @endphp
                        @foreach ($lessons as $index => $lesson)
                            <div class="w-full flex items-center px-3 py-3 mb-2 cursor-pointer hover:opacity-80 transition-opacity"
                                style="background: {{ $index % 2 == 0 ? '#071925' : '#000B17' }};"
                                @click="
                                    @if (isset($lesson['videoId']))
                                        currentVideoIndex = {{ $index }}; 
                                        videoId = '{{ $lesson['videoId'] }}'; 
                                        showVideoModal = true; 
                                        loadAndPlayVideo(videoId, currentVideoIndex);
                                    @else
                                        unlock = true;
                                    @endif
                                ">
                                <img src="{{ $lesson['thumb'] }}" alt="{{ $lesson['title'] }}" class="h-20 rounded-lg mr-4">
                                <div class="flex flex-col">
                                    @if ($index < 6)
                                        <span class="text-guitareo font-bold text-xs uppercase">FREE</span>
                                    @endif
                                    <p class="leading-tight text-white font-semibold text-sm">{{ $lesson['title'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="absolute h-10 bottom-0 left-0 right-0 z-10" style="background: linear-gradient(to bottom, transparent, #000);"></div>
                </div>
                <a href="/shop/30-days-to-better-strumming" class="w-full join smaller guitareo mb-3 text-base lg:text-xl">GET FULL ACCESS FOR FREE</a>
                <a href="/ecommerce/add-to-cart?products[30-days-to-better-strumming]=1" class="w-full join smaller white outline text-base lg:text-xl" style="outline: 0px;">BUY THE COURSE</a>
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
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/testimonials/kent.png">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/testimonials/kent.png"
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
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>1M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Subscribers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)//marketing/guitareo/products/30-days-to-better-strumming/guitareo-logo.svg"
                                alt="guitareo icon">
                            <h3 class="mt-2"><strong>3.5K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Students</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
                                alt="tiktok icon">
                            <h3 class="mt-2"><strong>42K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Likes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $testimonials = [
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/default.png',
             'description' => 'Wow. I really didn’t know how much I learned from this lesson. I will definitely go through the course again. I’m a lot worse than I thought I was at timing. Thank you!!',
             'name' => 'wr_jenkyn15006',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/andrew.png',
             'description' => 'I love these so much! One of my favorite 30 day challenges in all of Musora!   Thank you Kent!  You are such a great teacher!  My 10 year old daughter and I do this together.',
             'name' => 'Andrew Naranjo',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/vincent.png',
             'description' => 'The strum pattern was based on the double bass workout in drumeo: 1 & 2 . . & 4 .<br><br> Thanks for the fun workout!',
             'name' => 'Vincent Blansaer',
             ],

             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/default.png',
             'description' => '😎It\'s been a long time since I had so much fun with the guitar. thank you so much!!!😄',
             'name' => 'RAlvarez1',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/default.png',
             'description' => 'Oh Man! I have been playing guitar for so long but only solo. This is the first time I am strumming with drums. It feels SOOOO Goooood. I am happy to find out that I kept the rhythm perfectly. Adding the misses at will, any number of misses any number of places. Strking similar to Flamenco rasgueo (on steel strings - mind it), with really gentle strokes. I am getting the feeling - I will gro though the entire 30 day challenge. Thank you for designing such an exhilarating exercise.',
             'name' => 'Boyati',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/will.png',
             'description' => 'So glad I stuck with this challenge.  Love the 16th notes. Learning what a sixteenth note feels like in my pick hand, and my whole body. Looking forward to the rest of this week.',
             'name' => 'will.larson1',
             ],

             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/will.png',
             'description' => 'Thanks, Kent, I\'m liking this. Putting on my beginner\'s hat, it\'s letting some good info come into my mind. Getting the rhythm in my right hand and left foot. Also the fancy C and D, figuring out what the top three strings "mean" in the chord is a fun exercise.',
             'name' => 'will.larson1',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/radley.png',
             'description' => 'Thank you, I also find that I am contantly releasing the pressure on the neck with the chord hand when strumming to stop the strings from ringing out and sounding muddy. Very much like the use of the pedal when playing piano. Is this okay or should I avoid doing that?',
             'name' => 'p_radley80864',
             ],
             [
             'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/testimonials/claire.png',
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
    
    @php
        $videos = [
            ['name' => 'kickOff', 'video' => '944222905'],
        ];
    @endphp
    
    @foreach ($videos as $video)
        @include('_partials.components.video-modal', [
            'name' => $video['name'],
            'video' => $video['video'],
            'button' => '<div class="w-full mt-4 text-center"><a class="join guitareo" href="/shop/30-days-to-better-strumming">GET FULL ACCESS FOR FREE</a></div>',
            'vimeo' => true,
        ])
    @endforeach
    @component('_partials.components.modal', ['name' => 'unlock'])
        @slot('content')
            <div class="relative overflow-y-visible px-4 md:px-5 lg:px-7 py-5 md:py-7 text-white mx-auto text-center">
                <h1 class="text-guitareo"><i class="fas fa-lock"></i></h1>
                <h3 class="leading-tight my-4"><strong>Start your free trial to<br class="hidden sm:inline">  continue watching</strong></h3>
                <a class="join guitareo smaller" href="/shop/30-days-to-better-strumming">GET FULL ACCESS FOR FREE</a>
            </div>
        @endslot
    @endcomponent
@endsection

<script src="https://player.vimeo.com/api/player.js"></script>

<script>
const videoIds = [
    '944222905',
    '944223382',
    '944223156',
    '944945269',
    '944235965',
    '944236131'
];

let player;
let currentIndex = 0;

function initializePlayer(videoId) {
    const options = {
        id: videoId,
        loop: false,
        width: '100%',
        responsive: true 
    };

    if (player) {
        player.destroy().then(() => {
            player = new Vimeo.Player('vimeo-player', options);
            playVideo();
        }).catch(error => {
            console.error('Error destroying player:', error);
        });
    } else {
        player = new Vimeo.Player('vimeo-player', options);
        playVideo();
    }
}

function playVideo() {
    player.play().catch(error => {
        console.error('Error playing video:', error);
    });

    player.on('ended', function() {
        currentIndex++;
        if (currentIndex < videoIds.length) {
            initializePlayer(videoIds[currentIndex]);
        }
    });
}

function loadAndPlayVideo(videoId, startIndex) {
    currentIndex = startIndex;
    initializePlayer(videoId);
}

function pauseVideo() {
    if (player) {
        player.pause().catch(error => {
            console.error('Error pausing video:', error);
        });
    }
}

function nextLesson() {
    currentIndex++;
    if (currentIndex < videoIds.length) {
        initializePlayer(videoIds[currentIndex]);
    } else {
        console.log('No more lessons available.');
    }
}

</script>