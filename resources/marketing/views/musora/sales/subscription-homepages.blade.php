@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta property="og:url" content="https://www.drumeo.com/">

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    @endif

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .slick-slider.slick-light-buttons .slick-arrow {
            background: #fff;
        }

        .dropdown .description {
            height: 0;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
        }
        .dropdown.active .description {
            visibility: visible;
            opacity: 1;
            height: auto;
            max-height: 400px;
        }
    </style>
    <style>
        .splide__pagination__page.is-active {
            background: #01050F;
        }

        .splide__arrow svg {
            fill: #0B76DB !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        trailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($trialVersion))
        @if(!empty($joinUrl))
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "joinUrl" => $joinUrl
            ])
        @else
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "scrollToJoin" => true,
            ])
        @endif
    @else
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true,
            "homepage" => true
        ])
    @endif

    @include('_partials.layout.holiday.homepage-top-banner',[
        'text' => 'GET 10 FREE BONUSES WORTH $1228.94'
    ])

    <div class="sticky-trigger block"></div>
    @include('_partials.layout.holiday.sticky-bar', [
        'text' => 'GET 10 FREE BONUSES <br> WORTH $1228.94',
    ])


    @php
        $features = [
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drum-lessons-icon.svg',
                'title' => 'Drum Lessons',
                'desc' => 'Step-by-step video lessons on every topic.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events with drumming royalty.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/songs-icon.svg',
                'title' => '5000+ Songs',
                'desc' => 'Play popular songs from every style & era.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'Drumeo is the real deal folks - a good place to study and realize one’s dreams.',
                'thumb' => 'https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/billy-cobham.jpg',
                'name' => 'Billy Cobham',
                'credit' => 'Rolling Stone  Top 100 Drummer',
            ],
            [
                'desc' => 'A world-class site for continuing education and insight into the world of drumming!',
                'thumb' => 'https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/redmond.jpg',
                'name' => 'Rich Redmond',
                'credit' => '3x Country Drummer Of The Year',
            ],
            [
                'desc' => 'The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education.',
                'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-david-garibaldi.jpg',
                'name' => 'David Garibaldi',
                'credit' => 'Rolling Stone Top 100 Drummer',
            ],
        ];
    @endphp
    @include('musora.sales.header-section', [
        'header' => 'Online drum lessons for all skill levels.',
        'desc' => 'Learn the drums faster with organized video lessons, thousands of songs, and unlimited personal support.',
        'thumb' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/header-thumb.jpg',
        'pointOne' => 'Improve Your Skills',
        'pointTwo' => 'World-Class Teachers',
        'pointThree' => 'Play More Songs',
        'students' => '31856',
    ])
    @include('musora.sales.learn-by-playing-section', [
        'header' => 'Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.',
        'desc' => 'It’s been proven over and over –
                    <br><br>
                    Playing the drums is one of the healthiest activities you can perform for your brain – showing signs of boosting happiness, intelligence, and overall well being.
                    <br><br>
                    Drumeo will help you tap into the benefits of playing the drums with organized lessons, motivational instructors, and practical tools to help you play the songs you love – and express yourself creatively in any musical setting.
                    <br><br>
                    You’ll play more. You’ll fall in love with your progress. And you’ll be surrounded by a community of students and teachers to connect, support, and grow your passion.
                    <br><br>
                    Scroll down to watch the trailer, see more details, and join the community where drummers gather – and play like you’ve always wanted!',
        'imgMobile' => 'https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Collage_intro_m.png',
        'img' => 'https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Collage_intro.png',
    ])

    @php
        $gridItems = [
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/10-level-cirriculum.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'The most trusted step-by-step video lessons for every technique, pattern, and style.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'You\'ll always have on-screen assignments and practice tools to increase retention.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with our guided workouts where we’ll practice-along with you in real time.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'The best drummers are here -- including Grammy Award winners and touring musicians.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global drum community.',
            ],
        ];
    @endphp

    @include('musora.sales.trailer-grid-section', [
        'vidThumb' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/feature-video-thumb.jpg',
        'header' => 'Your drumming goals start here.',
        'desc' => 'Learn to play drums online with an organized 10-level curriculum featuring many of the world’s best teachers.',
    ])

    @php
        $buttons = [
            'Styles', 'Creativity', 'Grooves'
        ];

        $courses = [
            [
                'title' => 'Learn and style',
                'images' => [
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/rock-drumming.jpg',
                        'title' => 'Rock <br>Drumming',
                        'instructor' => 'Todd Sucherman',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/metal-drumming.jpg',
                        'title' => 'Metal <br>Drumming',
                        'instructor' => 'Jay Weinberg',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/jazz-fusion-drumming.jpg',
                        'title' => 'Jazz & Fusion <br>Drumming',
                        'instructor' => 'Cindy Blackman Santana',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/gospel-drumming.jpg',
                        'title' => 'Gospel <br>Drumming',
                        'instructor' => 'Larnell Lewis',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/pop-drumming.jpg',
                        'title' => 'Pop <br>Drumming',
                        'instructor' => 'Domino Santantonio',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/funk-drumming.jpg',
                        'title' => 'Funk <br>Drumming',
                        'instructor' => 'Dennis Chambers',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/indian-grooves.jpg',
                        'title' => 'Indian <br>Grooves',
                        'instructor' => 'Sarah Thawer',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/big-band-drumming.jpg',
                        'title' => 'Big Band <br>Drumming',
                        'instructor' => 'Greyson Nekrutman',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/elevate-your-drum-sound.jpg',
                        'title' => 'Elevate Your<br>Drum Sound',
                        'instructor' => 'Simon Phillips',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drum-chops.jpg',
                        'title' => 'Drum Chops',
                        'instructor' => 'Aaron Spears',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/writing-drum-parts.jpg',
                        'title' => 'Writing <br>Drum Parts',
                        'instructor' => 'Hannah Welton',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/song-breakdowns.jpg',
                        'title' => 'Song <br>Breakdowns',
                        'instructor' => 'Matt McGuire',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/rudiments-patterns.jpg',
                        'title' => 'Rudiments <br>& Patterns',
                        'instructor' => 'Dorothea Taylor',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/the-creative-mindset.jpg',
                        'title' => 'The Creative<br>Mindset',
                        'instructor' => 'Aric Improta',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/rock-drumming.jpg',
                        'title' => 'Crafting <br>Drum Solos',
                        'instructor' => 'Steve Smith',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/bass-drum-calibration.jpg',
                        'title' => 'Bass Drum <br>Calibration',
                        'instructor' => 'Gavin Harrison',
                    ],
                ]
            ],
            [
                'title' => 'Find your groove',
                'images' => [
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/building-combinations.jpg',
                        'title' => 'Building <br>Combinations',
                        'instructor' => 'Marco Minnemann',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/subdivision-studies.jpg',
                        'title' => 'Subdivision <br>Studies',
                        'instructor' => 'Anika Nilles',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/musical-exercises.jpg',
                        'title' => 'Musical <br>Exercises',
                        'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/rhythmic-confidence.jpg',
                        'title' => 'Rhythmic <br>Confidence',
                        'instructor' => 'Mark Guiliana',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/internal-synchronization.jpg',
                        'title' => 'Internal <br>Synchronization',
                        'instructor' => 'Billy Cobham',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drum-licks.jpg',
                        'title' => 'Drum Licks',
                        'instructor' => 'Senri Kawaguchi',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/groove-essentials.jpg',
                        'title' => 'Groove <br>Essentials',
                        'instructor' => 'Tommy Igoe',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/electric-performance.jpg',
                        'title' => 'Electric <br>Performances',
                        'instructor' => 'Michael Schack',
                    ],
                ]
            ],
        ];
    @endphp

{{--    @include('musora.sales.coaches-section', [--}}
{{--        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',--}}
{{--        'desc' => 'Diversify your drumming knowledge by studying with the world’s best drummers and teachers – with 200+ goal-oriented artist courses to amplify your skills & exclusive live events with drumming royalty.'--}}
{{--    ])--}}

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
    <section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Play your favorite songs.</strong></h2>
            <p class="leading-tight mt-3">You’ll have all the tools you need to <br class="hidden sm:inline"> make sure you never miss a beat.</p>

            <div class="flex my-12">
                <div class="text-left pr-8 max-w-md">
                    <div class="flex mb-4">
                        <div class="w-14 flex-grow-0"><img src="https://drumeo-assets.s3.amazonaws.com/sales/2023/5000-songs-icon.svg" class="h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>5000+ popular songs.</strong></h5>
                            <p class="mt-2 text-sm">Get note-for-note song breakdowns for every style, era, and skill with handy play-along tools. </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="w-14 flex-grow-0"><img src="https://drumeo-assets.s3.amazonaws.com/sales/2023/note-for-note-icon.svg" class="h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>Find the perfect tempo.</strong></h5>
                            <p class="mt-2 text-sm">Slow down or speed up any section of a song to hear every note your favorite drummer plays. </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="w-14 flex-grow-0"><img src="https://drumeo-assets.s3.amazonaws.com/sales/2023/tempo-icon.svg" class="h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>Loop the trouble spots.</strong></h5>
                            <p class="mt-2 text-sm">No more pausing and rewinding that tricky fill. Grab any song section and loop it, over and over! </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="w-14 flex-grow-0"><img src="https://drumeo-assets.s3.amazonaws.com/sales/2023/metronome-icon.svg" class="h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>Remove the drums *NEW*</strong></h5>
                            <p class="mt-2 text-sm">Magically remove the original drum part to make each song and performance uniquely yours. </p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-14 flex-grow-0"><img src="https://drumeo-assets.s3.amazonaws.com/sales/2023/loop-icon.svg" class="h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>Take your songs anywhere.</strong></h5>
                            <p class="mt-2 text-sm">Accessible on any device, or printable, so you can play the songs you love whenever and wherever. </p>
                        </div>
                    </div>
                </div>
                <video class="h-96 rounded-xl lazyload" data-src="https://drumeo-assets.s3.amazonaws.com/sales/2023/back-in-black-player.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>
            <a href="" class="mx-1 join outline method smaller">SEE SONGS LIST <i class="fas fa-info-circle"></i> </a>
            <a href="" class="mx-1 join blue smaller anchor-slide">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
            <p class="text-light-navy text-sm mt-5"><em>Songs included with Drumeo+</em></p>
        </div>
    </section>


    <div id="promo" class="anchor"></div>
    @yield('promo-banner')

    @php
        $coaches = [
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/steve-smith.jpg',
            'date' => 'Now Available',
            'name' => 'Steve<br> Smith',
            'subtitle' => 'Crafting Musical<br> Drum Solos',
            'smallInfo' => 'Learn to craft musical & dynamic solos no matter what skill level you’re at -- hall-of-fame drummer Steve Smith is here to guide you. ',
            'modal' => 'smith',
            'prev' => false,
            'next' => 'phillips',
            'info' => 'Steve Smith has left no stone unturned in the world of drumming. From groundbreaking jazz performances to stadium rock anthems, Steve is one of drumming’s living legends. In his course, you’ll learn how to build musical drum solos and harness the power of technique to express yourself on the kit.',
            'trending' => true,
            'bigTile' => true,
            'trailer' => true,
            ],
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/simon-phillips2.jpg',
            'date' => 'Now Available',
            'name' => 'Simon     <br> Phillips',
            'subtitle' => 'Legendary<br> Drum Sounds',
            'smallInfo' => "Get more from your kit. Legendary session drummer, Simon Phillips, helps you rapidly improve your drum sound in any playing situation.",
            'modal' => 'phillips',
            'prev' => 'smith',
            'next' => 'chambers',
            'info' => 'Tuning is just the beginning. Legendary session drummer, Simon Phillips, will show you everything he’s learned about getting the best drum sound in any playing situation. From how you strike the drums to what gear you choose, the sound of your playing will rapidly improve in this course.',
            'trending' => true,
            'trailer' => true,
            ],
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/dennis-chambers2.jpg',
            'date' => 'Now Available',
            'name' => 'Dennis<br> Chambers',
            'subtitle' => 'The Essence Of<br> Funk Drumming',
            'smallInfo' => 'Push your independence & musicianship with the help of funk drumming pioneer Dennis Chambers.',
            'modal' => 'chambers',
            'prev' => 'phillips',
            'next' => 'spears',
            'info' => 'Learn the syncopated patterns of funk drumming from a living legend of the style. Dennis Chambers pushed the limits of funk drumming with Parliament/Funkadelic & John Scofield. And now he’s here to help you achieve new levels of independence & musicianship in your drumming.',
            'trending' => true,
            'trailer' => true,
            ],
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/aaron-spears-3.jpg',
            'date' => 'Now Available',
            'name' => 'Aaron   <br> Spears',
            'subtitle' => 'Getting Started<br> With Chops',
            'smallInfo' => "Aaron Spears is going to show you the building blocks of drum chops -- and how to create explosive fills that fit the music.",
            'modal' => 'spears',
            'prev' => 'chambers',
            'next' => 'nekrutman',
            'info' => 'With great chops, comes great responsibility. The Godfather of gospel chops is going to show you how to use chops to add powerful moments to any song – without distracting from the groove. Aaron Spears dives into lessons learned drumming for pop stars like Ariana Grande and Usher in this course & live interview.',
            'trending' => true,
            'trailer' => true,
            ],
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/greyson-nekrutman2.jpg',
            'date' => 'Now Available',
            'name' => 'Greyson<br> Nekrutman',
            'subtitle' => 'Big Band Drumming<br> Essentials',
            'smallInfo' => 'Big Band is where it all started. You’ll learn the fundamentals of drumming’s most celebrated style from a modern-day prodigy. ',
            'info' => 'Buddy Rich, Gene Krupa, Joe Morello… the forefathers of drumming all came from one style: jazz. Drum prodigy, Greyson Nekrutman, is showing you the fundamentals of big band playing including how to swing, traditional grip basics, and more.',
            'modal' => 'nekrutman',
            'prev' => 'spears',
            'next' => 'welton',
            'trending' => true,
            'trailer' => true
            ],
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/hannah-welton.jpg',
            'date' => 'Now Available',
            'name' => 'Hannah<br> Welton',
            'subtitle' => 'Creating The Perfect<br> Drum Part',
            'smallInfo' => 'Learn how to create the <strong>perfect</strong> drum parts for any song with the help of Prince’s drummer Hannah Welton. ',
            'info' => 'As a drummer, you have the opportunity to bring LIFE to any song. Hannah Welton’s experience drumming for Prince was like attending the world’s greatest masterclass on creating the <strong>perfect</strong> drum part for every song. And now she’s going to pass that wisdom on to YOU in her first-ever DrumeoCOACHES course.',
            'modal' => 'welton',
            'prev' => 'nekrutman',
            'next' => 'blackman',
            'trending' => true,
            'trailer' => true
            ],
            [
            'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/cindy-blackman-santana.jpg',
            'date' => '2023',
            'name' => 'Cindy Blackman  <br> Santana',
            'subtitle' => 'Jazz & Fusion<br> Drumming',
            'smallInfo' => 'Learning jazz will improve every area of your drumming. You’re in good hands with Cindy Blackman Santana – a legend who brought jazz fundamentals to stadium rock.',
            'modal' => 'blackman',
            'prev' => 'welton',
            'next' => false,
            'info' => "Learning jazz will improve every area of your drumming. Dive into drumming's most challenging (and rewarding) style guided by Cindy Blackman Santana. Cindy will help you bring the spirit of jazz into everything you play for a more creative and inspiring approach to drumming.",
            'trending' => true
            ],


            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/aric-improta.jpg',
            'tileSubtitle' => 'ROCK, ART,<br> & TOURING',
            'modal' => 'improta',
            'prev' => false,
            'name' => 'ARIC<br> IMPROTA',
            'subtitle' => 'NIGHT VERSES, FEVER 333',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">168K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble2' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">3.2M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
            'bubble3' => '<div class="bubble grammy"><p><i class="fas fa-gramophone"></i><br><strong class="font-black">GRAMMY</strong><br><span class="text-highlight">NOMINEE</span></p></div>',
            'info' => 'Aric Improta is pushing the boundaries of drum performances. Look no further than his exhilarating backflips mid drum solo in front of thousands of screaming fans. <br><br> A dedicated artist, Aric uses his original music projects (Night Verses & Fever333) to deliver sensational visual performances to the masses. <br><br> And now he’s here to help you think outside the box with your drumming and question the implied “rules” that might be holding you back from your next creative breakthrough.',
            'next' => 'santantonio',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/domino-santantonio.jpg',
            'tileSubtitle' => 'POP &<br> PERFORMANCE',
            'modal' => 'santantonio',
            'prev' => 'improta',
            'name' => 'DOMINO<br> SANTANTONIO',
            'subtitle' => 'TIKTOK SENSATION',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble"><p><i class="fab fa-tiktok"></i><br><strong class="font-black">1.3M</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble2' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">8.1M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
            'bubble3' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">381K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'info' => 'Domino Santantonio took the world by storm in 2020. In less than a year, she amassed more than half a million TikTok followers by turning trending pop songs into infectious drum grooves. <br><br> When she’s not making viral TikTok videos, she’s touring with live pop acts and performing as a house drummer on nationally broadcast television shows. <br><br> She’s here to show you what the life of a pop drummer is like -- and to help you find YOUR spotlight.',
            'next' => 'taylor',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/dorothea-taylor.jpg',
            'tileSubtitle' => 'DRUMLINE<br> DISCIPLINE',
            'modal' => 'taylor',
            'prev' => 'santantonio',
            'name' => 'DOROTHEA<br>  TAYLOR',
            'subtitle' => 'THE GODMOTHER OF DRUMMING',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble"><p><i class="fab fa-tiktok"></i><br><strong class="font-black">1.1M</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">343K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble3' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">14M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
            'info' => 'Dorothea Taylor spent the majority of her drum career out of the spotlight -- teaching lessons to budding Michigan drum students. <br><br> That’s until she partnered with Drumeo to create a powerful viral video addressing societal expectations in drumming culture -- shocking audiences with her (un)surprising command of a hard-rock anthem, garnering millions of views in two days. <br><br> Get ready to hang with one of the internet’s most renowned drum instructors and strengthen your hands with Dorothea’s go-to drumline workouts.',
            'next' => 'wooton',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/john-wooton.jpg',
            'tileSubtitle' => 'RUDIMENTS &<br> APPLICATIONS',
            'modal' => 'wooton',
            'prev' => 'taylor',
            'name' => 'JOHN <br> WOOTON',
            'subtitle' => 'PROFESSOR OF PERCUSSION',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble"><p><i class="fad fa-university"></i><br><strong class="font-black">Director </strong><br><span class="text-highlight">of Percussion</span></p></div>',
            'bubble2' => '<div class="bubble"><p><i class="fad fa-diploma"></i><br><strong class="font-black">Doctor of </strong><br><span class="text-highlight">Musical Arts</span></p></div>',
            'info' => 'John Wooton brings an accomplished academic background to your DrumeoCOACHES roster. <br><br> Holding a doctorate in musical arts from the University of Iowa, John blends theory with the application of drum rudiments. And he can do more than teach. John is a decorated drum corps snare drummer garnering national recognition for his talents. <br><br> You’ll be spending time with the professor, inside DrumeoCOACHES, getting John’s wisdom for buttery smooth chops.',
            'next' => 'rodriguez',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/kaz-rodriguez.jpg',
            'tileSubtitle' => 'MUSICALITY &<br> COMPOSITION',
            'modal' => 'rodriguez',
            'prev' => 'wooton',
            'name' => 'KAZ<br>  RODRIGUEZ',
            'subtitle' => 'DRUMMER FOR JOSH GROBAN',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">123K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble2' => '<div class="bubble"><p><i class="fad fa-list-music"></i><br><strong class="font-black">Prolific</strong><br><span class="text-highlight">COMPOSER</span></p></div>',
            'info' => 'Kaz Rodriguez brings more than an international touring resume with Grammy-nominee Josh Groban. <br><br> He produces some of the most in-demand play-along tracks in the drumming world -- with Anika Nilles, Chris Coleman, Aaron Spears and many more relying on his productions to showcase their skills. <br><br> And you’ll get to sit in with Kaz while he breaks down play alongs, discusses his creative process, and even help him write a brand new composition.',
            'next' => 'mcguire',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/matt-mcguire.jpg',
            'tileSubtitle' => 'LIVE SHOWS &<br> PERFORMANCE',
            'modal' => 'mcguire',
            'prev' => 'rodriguez',
            'name' => 'MATT<br>  MCGUIRE',
            'subtitle' => 'THE CHAINSMOKERS',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">1.8M</strong><br><span class="text-highlight">SUBS</span></p></div>',
            'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">293K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble3' => '<div class="bubble spotify"><p><i class="fab fa-spotify"></i><br><strong class="font-black">28M</strong><br><span class="text-highlight">LISTENERS</span></p></div>',
            'info' => 'Matt McGuire rose to fame posting the highest caliber drum remixes the internet has ever seen. In the process, he grabbed the attention of some of the world’s biggest acts -- including The Chainsmokers. <br><br> Now Matt tours the world with one of pop’s biggest groups as drummer, musical director, and stage designer. <br><br> Matt’s going to help you push your performances and unlock creativity, excitement, and musicianship in everything you do.',
            'next' => 'lewis',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/larnell-lewis.jpg',
            'tileSubtitle' => 'MUSICIANSHIP<br> & GROOVE',
            'modal' => 'lewis',
            'prev' => 'mcguire',
            'name' => 'LARNELL<br>  LEWIS',
            'subtitle' => 'GRAMMY AWARD WINNER',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble grammy"><p><i class="fas fa-gramophone"></i><br><strong class="font-black">GRAMMY</strong><br><span class="text-highlight">WINNER</span></p></div>',
            'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">166K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble3' => '<div class="bubble"><p><i class="fad fa-album-collection"></i><br><strong class="font-black">STUDIO</strong><br><span class="text-highlight">LEGEND</span></p></div>',
            'info' => 'In 2015, Larnell Lewis boarded a plane to the Netherlands to fill in for one of his drumming heroes, Robert “Sput” Searight. The rest is history. <br><br> Larnell learned a complex fusion set during the flight and went on to record one of the most celebrated live albums of the 21st century: We Like It Here by Snarky Puppy. <br><br> He’s a Grammy Award-winning musician, composer, producer, and educator -- and he’s here to teach YOU.',
            'next' => 'schack',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/michael-schack.jpg',
            'tileSubtitle' => 'ELECTRONIC<br> DRUMMING',
            'modal' => 'schack',
            'prev' => 'lewis',
            'name' => 'MICHAEL<br>  SCHACK',
            'subtitle' => 'TOURING CLINICIAN',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">2.8M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
            'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">29K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'info' => 'Michael Schack does it all. <br><br> Massive festival stages, sweaty European dance clubs, and concert venues around the world. <br><br> And more than a performer, he’s a clinician and teacher who knows how to translate his insights into practical results you can use. <br><br> Michael’s going to be showing what he does best -- how to energize every performance and translate digital music into compelling acoustic performances.',
            'next' => 'falk',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/jared-falk.jpg',
            'tileSubtitle' => 'GETTING STARTED<br> & MOTIVATION',
            'modal' => 'falk',
            'prev' => 'schack',
            'name' => 'JARED<br> FALK',
            'subtitle' => 'Getting Started & Motivation',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">207K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
            'bubble2' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">2.1M</strong><br><span class="text-highlight">SUBS</span></p></div>',
            'bubble3' => '<div class="bubble"><p><i class="fad fa-medal"></i><br><strong class="font-black">MOST WATCHED</strong><br><span class="text-highlight">INSTRUCTOR</span></p></div>',
            'info' => 'Jared Falk has been your trusted source for online drum lessons for 15+ years.<br><br>As the face of Drumeo, Jared is a pioneer of online drum instruction -- helping prospective drummers around the world learn their first beats and beyond.<br><br>His passion, grit, and approachable style have helped him become the most watched drum instructor online… ever! And now you’ll have exclusive access to ask him all your biggest questions -- from getting started to finding your unique voice on the drums.',
            'next' => 'sucherman',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/todd-sucherman.jpg',
            'tileSubtitle' => 'Philosophy<br> & MECHANICS',
            'modal' => 'sucherman',
            'prev' => 'falk',
            'name' => 'TODD<br>  SUCHERMAN',
            'subtitle' => 'ROCK ICON & EDUCATOR',
            'bubbles' => 'true',
            'bubble1' => '<div class="bubble"><p><i class="fad fa-trophy"></i><br><strong class="font-black">ROCK DRUMMER</strong><br><span class="text-highlight">AWARD</span></p></div>',
            'bubble2' => '<div class="bubble"><p><i class="fad fa-medal"></i><br><strong class="font-black">DRUM CLINICIAN</strong><br><span class="text-highlight">AWARD</span></p></div>',
            'info' => 'Todd Sucherman has played more than 2000 rock shows -- entertaining music fans around the world for 30+ years. <br><br> He’s a decorated clinician, winning multiple awards for his educational DVDs and enjoying a 20+ year tenure with the legendary rock band Styx. <br><br> Todd’s here to share the wisdom he’s amassed in an impressive career -- both on stage performing to the masses and in the studio dialing in that perfect sound.',
            'next' => false,
            ],
        ]
    @endphp


    @php
        $testimonials = [
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
            'name' => 'testimonial1',
            'video' => '342059271',
            'title' => 'He made the band & he’s<br> playing his dream gigs.',
            'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
            'name' => 'testimonial2',
            'video' => '373252004',
            'title' => 'She can now jam with<br> anyone she wants.',
            'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/nick-rudman-2.jpg',
            'name' => 'testimonial3',
            'video' => '342066325',
            'title' => 'Retirement was too<br> slow for him.',
            'description' => 'After working on the railroad for 40 years, Nick now keeps his snare drum beside his bed...just in case he wakes up with a good idea.',
            ],
            [
            'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620',
            'name' => 'testimonial12',
            'video' => '553438851',
            'title' => 'The student has<br> become the teacher.',
            'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
            'name' => 'testimonial4',
            'video' => '373445704',
            'title' => 'Same-day advice got<br> him through the gig.',
            'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
            'name' => 'testimonial5',
            'video' => '373446024',
            'title' => 'She didn’t let cancer<br> stop the rhythm.',
            'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
            'name' => 'testimonial6',
            'video' => '342066433',
            'title' => 'He loved the drums as a <br>kid, now he’s in two bands.',
            'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
            'name' => 'testimonial7',
            'video' => '373445466',
            'title' => 'Private teachers weren’t<br> available at 11PM',
            'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
            'name' => 'testimonial8',
            'video' => '373445819',
            'title' => 'She took her kids’ drums<br> and started a band.',
            'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead -- she’s used Drumeo to build a foundation and formed a band.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/scott-anderson.jpg',
            'name' => 'testimonial9',
            'video' => '373445587',
            'title' => 'He’s addicted to<br> self-improvement.',
            'description' => 'Scott was frustrated starting out on the drums, so he joined Drumeo which helped him slow down, see how everything fits together, and gain momentum.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/john-pruden.jpg',
            'name' => 'testimonial10',
            'video' => '373445917',
            'title' => 'He developed his own<br> style with an army of teachers.',
            'description' => 'John didn’t have time for weekly lessons or sifting through online content. Drumeo gave him structure and the ability to learn from different world class instructors.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/phil-davis.jpg',
            'name' => 'testimonial11',
            'video' => '373446155',
            'title' => 'Finally, online drum<br> lessons he could trust.',
            'description' => 'Phil found the vast amount of online content disorganized, overwhelming and contradictory, so he quickly made himself at home with Drumeo.',
            ],
        ]
    @endphp
    <div id="testimonials" class="anchor"></div>
    @include('musora.sales.testimonials-section', [
        'header' => 'Trusted by drummers<br class="inline-block sm:hidden">  everywhere',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738',
        'reviewText' => 'Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service.',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'youtube' => '2.5M',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'facebook' => '1.2M',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
        'instagram' => '946K',
    ])

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="pb-10 sm:pb-14 lg:pb-20 relative text-center px-6" style="background-color:#f6f8fc;">
        <div class="container mx-auto max-w-5xl">
            <img data-aos="fade-down" class="h-28 md:h-32 -mt-14 md:-mt-16 mb-5 sm:mb-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/guarantee.png" alt="guarantee-badge">
            <h3 class="leading-tight"><strong>Test-drive your lessons for 90 days.</strong><br>Zero risk.</h3>
            <p class="leading-normal md:leading-loose my-4 sm:my-7">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.</p>
            <div class="flex flex-wrap items-start justify-center">
                <div data-aos="fade-down" class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div data-aos="fade-down" data-aos-delay="50" class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div data-aos="fade-down" data-aos-delay="100" class="w-full sm:w-1/3 px-2">
                    <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="tooltip inline-block cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @php
        $annualLink = '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true';
    @endphp

    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative overflow-hidden" style="background: linear-gradient(45deg, #07233e, #0c1524);">
        <div class="container mx-auto max-w-5xl mb-16">
            <div class="flex flex-wrap items-center">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-1/2 sm:pl-5">
                    <h3 class="leading-normal"><strong>Unlimited drum lessons<br> The world’s best teachers<br> 5000+ popular songs</strong></h3>
                    <ul class="fa-ul text-left  my-4 sm:my-5 mx-auto">
                        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by 30,000 students.</li>
                        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                        <li class="leading-tight text-coaches"><i class="fa-li fas fa-check"></i> <strong>*BONUS*</strong> includes free access to Musora’s lessons for piano, guitar, and voice.</li>
                    </ul>
                    <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                        <a class="join smaller blue w-full my-3" href="{{ $annualLink }}">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
                        <p class="text-center text-sm"><em>Pay nothing for 7 days, then $20/month billed annually.</em></p>
                    </div>
                </div>
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-1/2 sm:order-1 sm:pl-5 lg:pl-10 mt-7 sm:mt-0">
                    <img class="max-w-xl sm:max-w-2xl lg:max-w-3xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/order_collage.png">
                </div>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="relative text-center px-6" style="background-color:#f6f8fc;">
        <div class="container mx-auto max-w-5xl relative z-20">
            <div class="text-left flex justify-center items-center">
                <div class="pr-7">
                    <h4 class="leading-normal mb-7"><strong>Available across web,<br> tablet, & mobile.</strong></h4>
                    <a class="inline-block" href="https://itunes.apple.com/us/app/musora/id1619053766?ls=1" target="_blank">
                        <img class="h-10 m-1" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
                    <a class="inline-block" href="https://play.google.com/store/apps/details?id=com.musoraapp" target="_blank">
                        <img class="h-10 m-1" src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
                </div>
                <img class="-mt-11 -mb-4 max-w-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2023/devices.png">
            </div>
        </div>
    </section>

    <section class="text-center py-10 md:py-20 lg:py-24 px-4 sm:px-6">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>Frequently Asked Questions</strong></h2>
            <div class="dropdowns my-10">
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "question" => true,
                        "title" => "What is Drumeo?",
                        "description" => 'Drumeo is an online platform that offers an organized drum curriculum, artist courses on popular topics, 5000+ songs transcribed note-for-note, and a supportive global community of students and teachers. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "question" => true,
                        "title" => "Is Drumeo good for beginners?",
                        "description" => 'Yes! You’ll always know what to practice with sequential step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "question" => true,
                        "title" => "Does Drumeo have anything for advanced drummers?",
                        "description" => 'Drumeo is the perfect companion for advanced drummers, giving you access to artist courses so you can gain insights and inspiration from the legends – with 200+ artist courses on a variety of topics. Plus, you’ll get note-for-note transcriptions for thousands of songs and practical playback tools, so you can take on any new challenge with confidence. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "question" => true,
                        "title" => "Am I too old to learn the drums?",
                        "description" => 'You’re never too old to learn the drums. Drumeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with drummers just like you who are learning and applying their skills to music. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "question" => true,
                        "title" => "Do I need to be tech-savvy to learn through your app?",
                        "description" => 'Not at all! Technology is here to make your life easier, and Drumeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
                        ])
            </div>
            <p><strong>Still have questions?</strong> Call us toll-free at 1-800-439-8921, directly at<br>
                1-604-855-7605 or start a chat with us in the bottom right corner of any page!</p>
        </div>
    </section>

    <div class="unstick-trigger block"></div>

    @foreach($coaches as $coach)
        <div class="reveal coach-wrap relative rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{{ $coach['modal'] }}" data-reveal data-reset-on-close="false">
            @if($coach['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $coach['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-44 md:pb-60 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $coach['image'] }}">
                @if(!empty($coach['trailer']))
                    <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller autoplay-video" data-close data-open="{{ $coach['modal'] }}Trailer"></i>
                @endif
            </div>
            <div class="p-4 md:p-5">
                @if(!empty($coach['date']))
                    <h6 class="leading-none font-bebas uppercase text-coaches mx-auto mb-3 md:mb-2">{{ $coach['date'] }}</h6>
                @endif
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $coach['name'])  !!}</h2>
                <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  str_replace('<br>', ' ', $coach['subtitle'])  !!}</p>
                @if(!empty($coach['bubbles']))
                    <div class="mx-auto mb-1 md:mb-2">
                        {!!  $coach['bubble1']  !!}
                        @if(!empty($coach['bubble2'])){!!  $coach['bubble2']  !!}@endif
                        @if(!empty($coach['bubble3'])){!!  $coach['bubble3']  !!}@endif
                    </div>
                @endif
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $coach['info'] !!}</p>
            </div>
            @if($coach['next'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $coach['next'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
            @endif
        </div>
    @endforeach

    @php
        $videoModals = [
            [
            'modal' => 'methodTrailer',
            'vimeo' => '495414150',
            ],
            [
            'modal' => 'songsTrailer',
            'vimeo' => '495414171',
            ],
            [
            'modal' => 'weltonTrailer',
            'vimeo' => '661320978',
            ],
            [
            'modal' => 'nekrutmanTrailer',
            'vimeo' => '671354594',
            ],
            [
            'modal' => 'spearsTrailer',
            'vimeo' => '683067897',
            ],
            [
            'modal' => 'chambersTrailer',
            'vimeo' => '693235712',
            ],
            [
            'modal' => 'phillipsTrailer',
            'vimeo' => '707892791',
            ],
            [
            'modal' => 'smithTrailer',
            'vimeo' => '726153277',
            ],
            [
            'modal' => 'trailer',
            'vimeo' => '772644658',
            ],
         ]
    @endphp
    @foreach($videoModals as $videoModal)
        <div class="reveal large" id="{{ $videoModal['modal'] }}" data-reveal data-reset-on-close="false">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $videoModal['vimeo'] }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
            </div>
        </div>
    @endforeach

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '772644658'
    ])


    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.slick').slick({
                slidesToShow: 1
            });

            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-45');
            });

            // sticky topbar before orderSection
            var stickyBar = $('.promo-banner');
            $(window).scroll(function () {
                var stickTrigger = $('.sticky-trigger').offset().top;
                var unstickTrigger = $('.unstick-trigger').offset().top;
                if ($(this).scrollTop() > (unstickTrigger - 115)) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < stickTrigger - 115) {
                    stickyBar.removeClass('fixed');
                }
                if ($(this).scrollTop() < unstickTrigger - 115 && $(this).scrollTop() > stickTrigger - 115) {
                    stickyBar.addClass('fixed');
                }
            });

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>

    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
