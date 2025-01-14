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

    <section class="bg-[#00101d] text-white"> 
        <div x-intersect.once="visible = true;" class="text-center px-4 md:px-6 py-8 md:py-12 lg:py-16">
            <div class="container max-w-5xl mx-auto">
                <img
                    alt="30 Days To Better Strumming Logo"
                    class="h-14 sm:h-20 mx-auto mb-3 sm:mb-5"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/guitareo/products/30-days-to-better-strumming/logo-white.png"
                >
                 @php
                        $lessons = [
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/eb806e481f29e1ced1011e427f74860454a67373-1920x1080.jpg',
                        'title' => 'Course Kick-Off',
                        'name' => 'course-kick-off',
                        'videoId' => '944222905',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/82f78fe3d738610f02b183424d41f0634d2704f3-1920x1080.jpg',
                        'title' => 'Gear Tips',
                        'name' => 'gear-tips',
                        'videoId' => '944223382',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/03ff53f012fe9c137bd25e6e4a818bf47c54c316-1920x1080.jpg',
                        'title' => 'Chord Shapes For The Challenge',
                        'name' => 'chord-shapes-challenge',
                        'videoId' => '944223156',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5a1a9ce37b26df9bd8e6c9b22dbd13f908b752c5-1920x1080.jpg',
                        'title' => 'Day 1 — Get Into The Groove',
                        'name' => 'day1-get-into-groove',
                        'videoId' => '944945269',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/4e7a0db0e163cb79ebed05ec8be78bac503d1626-1920x1080.jpg',
                        'title' => 'Day 2 — Learning To Miss',
                        'name' => 'day2-learning-to-miss',
                        'videoId' => '944235965',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/fc3b3bb51c93b10b1020cf11c31554702c47fbb4-1920x1080.jpg',
                        'title' => 'Day 3 — Add In The Bridge',
                        'name' => 'day3-add-bridge',
                        'videoId' => '944236131',
                        'free' => true
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/84555cfa794ec5e7b94ceec46e1b27151215c5da-1920x1080.jpg',
                        'title' => 'Day 4 — The Campfire Strum Pattern',
                        'name' => 'day4-campfire-strum',
                        'videoId' => null,
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/6729ef2d94ebc3aa300d098f38ba7eba017d9305-1920x1080.jpg',
                        'title' => 'Day 5 — Add In A Variation',
                        'name' => 'day5-add-variation',
                        'videoId' => null,
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/aea0869e6e8db7396ceb4cd84f5f324ef4da20a3-1920x1080.jpg',
                        'title' => 'Day 6 — The Reggae Strum Pattern',
                        'name' => 'day6-reggae-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5711817b2b1bc8fc2eedf2eb490674017bf3ab18-1920x1080.jpg',
                        'title' => 'Day 7 — Learn To Push Your Chords',
                        'name' => 'day7-push-chords',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/cb4b4c2879a046c6b3cce69d9facd9827ac834b7-1920x1080.jpg',
                        'title' => "Day 8 — The Rock 'N' Roll Strum Pattern",
                        'name' => 'day8-rock-roll-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/0600a9301d880539f710a128643d086c55bb3b63-1920x1080.jpg',
                        'title' => 'Day 9 — The Too-Many-Ands Strum Pattern',
                        'name' => 'day9-too-many-ands-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/978103610f9e5fb75f940469a878f8c75b89ea62-1920x1080.jpg',
                        'title' => 'Day 10 — Coming Up With Your Own Strum Patterns',
                        'name' => 'day10-own-strum-patterns',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/a3b672e0d3a087fd4b0bd586a1acdd33f7dc6c43-1920x1080.jpg',
                        'title' => 'Day 11 — Add Variations To Your Strums',
                        'name' => 'day11-strum-variations',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/30565737c95d75a91d12ec5bc53860f6f65cfa68-1920x1080.jpg',
                        'title' => 'Day 12 — Adding Accents',
                        'name' => 'day12-adding-accents',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/557473e90329029434ec47ea9b986055dc13a8a8-1920x1080.jpg',
                        'title' => 'Day 13 — The 3-3-2 Strum Pattern',
                        'name' => 'day13-332-strum',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/265fefe296030073175ab6d30a23b787598bf0b8-1920x1080.jpg',
                        'title' => 'Day 14 — Add Palm Mutes',
                        'name' => 'day14-palm-mutes',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/a2fae9d29be5d2ade1258d9484aa055421cb4fd3-1920x1080.jpg',
                        'title' => 'Day 15 — Thinking About Dynamics',
                        'name' => 'day15-dynamics',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/5c00bf1ea90312f47dd4229a6328a00089fa9506-1920x1080.jpg',
                        'title' => "Day 16 — Let's Gallop",
                        'name' => 'day16-gallop',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/97010e6e1d0d1e6a82b836644074a30da1e519fe-1920x1080.jpg',
                        'title' => 'Day 17 — Give It A Smack',
                        'name' => 'day17-give-smack',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/d32628668491939b7812f786900285af075f77ff-1920x1080.jpg',
                        'title' => 'Day 18 — Double It Up',
                        'name' => 'day18-double-it-up',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/69dc27c705f939fc679d2add0982cd8aed5f62db-1920x1080.jpg',
                        'title' => 'Day 19 — Put It All Together',
                        'name' => 'day19-put-together',
                        'videoId' => null
                    ],
                    [
                        'thumb' => 'https://cdn.sanity.io/images/4032r8py/production/17b34eaf9a89a4bffaca5b55335e7b242b8b4e95-1920x1080.jpg',
                        'title' => 'Day 20 — Final Performance',
                        'name' => 'day20-final-performance',
                        'videoId' => null
                    ]
                ];
                @endphp
                @include('_partials.components.player-section', [
                    'slugSanity' => '30-days-to-better-strumming',
                    'accessibleVideosCount'=> 5,  
                    'title' => 'Strum With Confidence In Just 30 Days',
                    'description' =>
                        '30 Days To Better Strumming is the perfect course for beginner & intermediate guitarists who have ever felt stuck in their rhythm playing. Get step-by-step guidance to break through barriers and learn techniques that will stick with you for years.',
                    'theme' => 'guitareo',
                    'aside_dark' => '#071925',
                    'aside_light' => '#000B17',
                    'cta' => 'GET FULL ACCESS FOR FREE',
                    'link' => '/choose-plan-strumming',
                    'simpleModal' => true,
                ])
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#F2F8FF;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/cdn-cgi/image/width=900,quality=95/https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/testimonials/kent.png">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://www.musora.com/cdn-cgi/image/width=900,quality=95/https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/guitareo/products/30-days-to-better-strumming/testimonials/kent.png"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/cdn-cgi/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
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
                                src="https://www.musora.com/cdn-cgi/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
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
                                src="https://www.musora.com/cdn-cgi/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
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
@endsection
