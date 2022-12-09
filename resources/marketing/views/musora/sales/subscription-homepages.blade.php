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

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

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


    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#f6f8fc;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 sm:pr-8 text-center lg:text-left">
                    <h1 class="rotater-text text-drumeo"><strong>Online drum lessons for all skill levels.</strong></h1>
                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Learn the drums faster with organized video lessons, thousands of songs, and unlimited personal support.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video lazyload" style="padding-bottom: 75%;" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/header_thumb.png" data-open="trailer">
                        <div class="join white smaller absolute bottom-5 left-5"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-drumeo"></i> Improve Your Skills
                        <i class="ml-2 fas fa-check text-drumeo"></i> World-Class Teachers
                        <i class="ml-2 fas fa-check text-drumeo"></i> Play More Songs</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Improve<br> Your Skills</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> World-Class<br>  Teachers</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> Play More <br> Songs</p>
                    </div>
                    <div class="flex flex-wrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <a href="" class="w-full join blue smaller anchor-slide mb-2">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
                        <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                        <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                        <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                        <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                        <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
{{--                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Joined_profiles.png">--}}
                        <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ 31856 }} active students.</em></p>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/header_thumb.png" data-open="trailer">
                        {{--<video class="object-cover w-full h-full absolute z-0 lazyload" data-src="https://player.vimeo.com/progressive_redirect/download/738758998/rendition/source/video-reel2.mp4%20%28Original%29.mp4?loc=external&signature=323bf87c6c208cda28dd99180b56fbc7238cd98d3ca6b60dba352659187783ff" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>--}}
                        <div class="join white smaller absolute bottom-5 left-5"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-drumeo mt-8 lg:mt-12 mb-2 lg:mb-4" style="background-color:#eaf1fa;">
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Drum Lessons</strong><br>
                            <span class="text-sm">Step-by-step video lessons on every topic.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Artist Courses</strong><br>
                            <span class="text-sm">Courses and live events with drumming royalty.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">5000+ Songs</strong><br>
                            <span class="text-sm">Play popular songs from every style & era.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-drumeo text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">24/7 Support</strong><br>
                            <span class="text-sm">The largest community of students & teachers.</span></p>
                    </div>
                </div>
            </div>

            <div class="slick slick-light-buttons text-center mx-auto my-9 md:mb-0 h-40 sm:h-24 lg:h-20">
                <div class="px-3 md:px-6 slick-slide">
                    <p class="leading-normal text-sm"><em>“Drumeo is the real deal folks - a good place to study and realize one’s dreams.”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap text-left items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/billy-cobham.jpg"><br class="inline md:hidden">
                        <p class="leading-tight w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>Billy Cobham,<br> Rolling Stone  Top 100 Drummer</em></p>
                    </div>
                </div>
                <div class="px-3 md:px-6 slick-slide">
                    <p class="leading-normal text-sm"><em>“A world-class site for continuing education and insight into the world of drumming!”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap text-left items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/redmond.jpg"><br class="inline md:hidden">
                        <p class="leading-tight w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>Rich Redmond,<br> 3x Country Drummer Of The Year</em></p>
                    </div>
                </div>
                <div class="px-3 md:px-6 slick-slide">
                    <p class="leading-normal text-sm"><em>“The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education.”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap text-left items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-david-garibaldi.jpg"><br class="inline md:hidden">
                        <p class="leading-tight w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>David Garibaldi,<br> Rolling Stone Top 100 Drummer</em></p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <img class="h-56 inline sm:hidden lazyload" data-src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Collage_intro_m.png">
            <h2 class="text-center my-5 sm:mt-0 sm:mb-7"><strong>Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.</strong></h2>
            <div class="text-left flex flex-wrap sm:flex-nowrap mb-32 sm:mb-56 lg:mb-72">
                <h6 class="leading-normal max-w-lg pr-7">It’s been proven over and over –
                    <br><br>
                    Playing the drums is one of the healthiest activities you can perform for your brain – showing signs of boosting happiness, intelligence, and overall well being.
                    <br><br>
                    Drumeo will help you tap into the benefits of playing the drums with organized lessons, motivational instructors, and practical tools to help you play the songs you love – and express yourself creatively in any musical setting.
                    <br><br>
                    You’ll play more. You’ll fall in love with your progress. And you’ll be surrounded by a community of students and teachers to connect, support, and grow your passion.
                    <br><br>
                    Scroll down to watch the trailer, see more details, and join the community where drummers gather – and play like you’ve always wanted!</h6>
                <img class="h-96 hidden sm:inline lazyload" data-src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Collage_intro.png">
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="aspect-16:9 cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96" data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" poster="https://i.vimeocdn.com/video/1488646391-d2694ba3d38847b00d9fcd70c946d3c45efe1202cedf305361a253a275ef5f90-d_890" data-src="https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/video-reel.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
                {{--<iframe class="absolute w-full h-full" src="//player.vimeo.com/video/738385463" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>--}}
            </div>
            <h2><strong>Your drumming goals start here.</strong></h2>
            <h6>Learn to play drums online with an organized 10-level curriculum featuring many of the world’s best teachers.</h6>
            <div class="flex flex-wrap items-center justify-center text-left mb-6">
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 sm:px-4">
                    <img class="rounded-xl mb-4" src="">
                    <p>
                        <strong>10-Level Curriculum</strong><br> The most trusted step-by-step video lessons for every technique, pattern, and style.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 sm:px-4">
                    <img class="rounded-xl mb-4" src="">
                    <p>
                        <strong>Practical Assignments</strong><br> You'll always have on-screen assignments and practice tools to increase retention.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 sm:px-4">
                    <img class="rounded-xl mb-4" src="">

                    <p>
                        <strong>## Guided Workouts</strong><br> Stay inspired with our guided workouts where we’ll practice-along with you in real time.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 sm:px-4">
                    <img class="rounded-xl mb-4" src="">

                    <p>
                        <strong>World-Class Teachers</strong><br> The best drummers are here -- including Grammy Award winners and touring musicians.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 sm:px-4">
                    <img class="rounded-xl mb-4" src="">

                    <p>
                        <strong>Downloadable Videos</strong><br> Stream your lessons OR download your videos so you can practice anywhere, anytime.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 sm:px-4">
                    <img class="rounded-xl mb-4" src="">

                    <p>
                        <strong>Personalized Support</strong><br> Get weekly live streams, student lesson plans, and access to a global drum community.
                    </p>
                </div>
            </div>
            <a href="" class="mx-1 join outline method smaller">EXPLORE THE METHOD <i class="fas fa-info-circle"></i> </a>
            <a href="" class="mx-1 join blue smaller anchor-slide">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
        </div>
    </section>

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

    @include('musora.sales.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Diversify your drumming knowledge by studying with the world’s best drummers and teachers – with 200+ goal-oriented artist courses to amplify your skills & exclusive live events with drumming royalty.'
    ])

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
    <section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
        <div class="container max-w-5xl mx-auto">
            <h2><strong>Play your favorite songs.</strong></h2>
            <h6 class="leading-tight mt-3">You’ll have all the tools you need to <br class="hidden sm:inline"> make sure you never miss a beat.</h6>

            <div class="flex my-10">
                <div class="text-left pr-4">
                    <div class="flex mb-4">
                        <i class="fas fa-music text-drumeo"></i>
                        <div class="flex-grow pl-4">
                            <h4><em>5000+ popular songs.</em></h4>
                            <p>Get note-for-note song breakdowns for music from every style & era, sorted by skill level so you can always find a song you’ll love.</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-music text-drumeo"></i>
                        <div class="flex-grow pl-4">
                            <h4><em>Find the perfect tempo.</em></h4>
                            <p>Slow down any section of a song to hear every note. When you’ve nailed the part, bump the tempo back up to rock out in real time!</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-music text-drumeo"></i>
                        <div class="flex-grow pl-4">
                            <h4><em>Loop the trouble spots.</em></h4>
                            <p>No more pausing and rewinding when you mess up that fill. Simply grab the section of a song and loop it – over and over again.</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-music text-drumeo"></i>
                        <div class="flex-grow pl-4">
                            <h4><em>Remove the drums *NEW*</em></h4>
                            <p>Play-along with the original drummer – or magically remove the original drum parts to make each song and performance uniquely yours!</p>
                        </div>
                    </div>
                    <div class="flex">
                        <i class="fas fa-music text-drumeo"></i>
                        <div class="flex-grow pl-4">
                            <h4><em>Take your songs anywhere.</em></h4>
                            <p>Accessible on any device, plus get printable sheet music. You’ll be able to learn and play the songs you love whenever and wherever you want.</p>
                        </div>
                    </div>
                </div>
                <img src="">
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

    <div id="testimonials" class="anchor"></div>
    <section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5">
        <div class="container mx-auto max-w-5xl">
            <h3 class="leading-tight mb-3" data-aos="fade-up"><strong>Trusted By Drummers<br class="inline-block sm:hidden">  Everywhere</strong></h3>


            <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;">
                <p class="mx-auto mb-2">Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
            </a>
            <br>
            <img alt="" class="h-6 sm:h-8 mb-2 md:mb-0 mx-auto sm:mr-1 filter invert opacity-40 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
            <i class="align-middle text-lg md:text-2xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-lg md:text-2xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-lg md:text-2xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-lg md:text-2xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-lg md:text-2xl fas fa-star" style="color: #f68d2d;"></i>


            <div class="flex flex-wrap items-start justify-center mx-auto mt-6">
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#cd201f;">
                        <a href="https://www.youtube.com/freedrumlessons/" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-3xl md:text-5xl"></i>
                        </a>
                        <h2 class="font-black leading-none my-2 text-black">2.5M</h2>
                        <p class="uppercase leading-none md:tracking-widest">Subs<span class="hidden sm:inline-block">cribers</span></p>
                    </div>
                </div>
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#3b5998;">
                        <a href="https://facebook.com/drumeo/" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-3xl md:text-5xl"></i> </a>
                        <h2 class="font-black leading-none my-2 text-black">1.2M</h2>
                        <p class="uppercase leading-none md:tracking-widest">Likes</p>
                    </div>
                </div>
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="instagram py-4 md:py-5 lg:py-6 rounded-xl w-full">
                        <a href="https://instagram.com/drumeoofficial/" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-3xl md:text-5xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                        </a>
                        <h2 class="font-black leading-none my-2">946K</h2>
                        <p class="uppercase leading-none md:tracking-widest" style="color:#E1306C">Followers</p>
                    </div>
                </div>
            </div>
            <div class="testimonials flex flex-wrap justify-center mx-auto w-full">
                @php
                    $testimonials = [
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
                        'modal' => 'testimonial1',
                        'title' => 'He made the band & he’s<br> playing his dream gigs.',
                        'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
                        'modal' => 'testimonial2',
                        'title' => 'She can now jam with<br> anyone she wants.',
                        'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/nick-rudman-2.jpg',
                        'modal' => 'testimonial3',
                        'title' => 'Retirement was too<br> slow for him.',
                        'description' => 'After working on the railroad for 40 years, Nick now keeps his snare drum beside his bed...just in case he wakes up with a good idea.',
                        ],
                        [
                        'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620',
                        'modal' => 'testimonial12',
                        'title' => 'The student has<br> become the teacher.',
                        'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
                        'modal' => 'testimonial4',
                        'title' => 'Same-day advice got<br> him through the gig.',
                        'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
                        'modal' => 'testimonial5',
                        'title' => 'She didn’t let cancer<br> stop the rhythm.',
                        'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
                        'modal' => 'testimonial6',
                        'title' => 'He loved the drums as a <br>kid, now he’s in two bands.',
                        'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
                        'modal' => 'testimonial7',
                        'title' => 'Private teachers weren’t<br> available at 11PM',
                        'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
                        'modal' => 'testimonial8',
                        'title' => 'She took her kids’ drums<br> and started a band.',
                        'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead -- she’s used Drumeo to build a foundation and formed a band.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/scott-anderson.jpg',
                        'modal' => 'testimonial9',
                        'title' => 'He’s addicted to<br> self-improvement.',
                        'description' => 'Scott was frustrated starting out on the drums, so he joined Drumeo which helped him slow down, see how everything fits together, and gain momentum.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/john-pruden.jpg',
                        'modal' => 'testimonial10',
                        'title' => 'He developed his own<br> style with an army of teachers.',
                        'description' => 'John didn’t have time for weekly lessons or sifting through online content. Drumeo gave him structure and the ability to learn from different world class instructors.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/phil-davis.jpg',
                        'modal' => 'testimonial11',
                        'title' => 'Finally, online drum<br> lessons he could trust.',
                        'description' => 'Phil found the vast amount of online content disorganized, overwhelming and contradictory, so he quickly made himself at home with Drumeo.',
                        ],
                    ]
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="testimonial w-full md:w-1/3 lg:w-1/4 md:px-2 pb-2 md:pb-4 flex flex-auto">
                        <div class="rounded-xl overflow-hidden">
                            <div class="thumb aspect-16:9 relative bg-center bg-cover autoplay-video cursor-pointer lazyload" data-bg="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $testimonial['image'] }}" data-open="{{ $testimonial['modal'] }}">
                                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller"></i>
                            </div>
                            <div class="p-4">
                                <p class="leading-tight mb-2"><strong>{!!  $testimonial['title'] !!}</strong></p>
                                <p class="leading-normal text-xs">{{ $testimonial['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="pb-10 sm:pb-14 lg:pb-20 relative overflow-hidden text-center px-6" style="background-color:#f6f8fc;">
        <div class="container mx-auto max-w-5xl">
            <img data-aos="fade-down" class="h-28 md:h-32 -mt-14 md:-mt-16 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/guarantee.png" alt="guarantee-badge">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 "><strong>Test-drive your lessons for 90 days.</strong><br>
            Zero risk.</h3>
            <p class="leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.</p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
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

    <section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-white text-center customize px-4 lg:px-6 relative z-50 overflow-hidden" style="background: linear-gradient(to right, #07233e, #0c1524);">
        <div class="container mx-auto max-w-5xl relative z-50">

            <div class="flex flex-wrap items-center">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-1/2 sm:pl-5">
                    <h3 class="leading-normal"><strong>Unlimited drum lessons<br> The world’s best teachers<br> 5000+ popular songs</strong></h3>
                    <p class="text-left my-4 sm:my-5 mx-auto inline-block sm:leading-loose">
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> Trusted by 30,000 students.<br>
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> Online lessons on every topic.<br>
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> Personalized feedback from real teachers.<br>
                        <span class="text-coaches"><i class="fas fa-check sm:mr-2"></i> <strong>*BONUS*</strong> includes free access to Musora’s lessons for piano, guitar, and voice.</span>
                    </p>
                    <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                        <a class="join smaller blue w-full my-3" href="{{ $annualLink }}">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
                        <p class="text-center text-sm"><em>Pay nothing for 7 days, then $20/month billed annually.</em></p>
                    </div>
                </div>
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-1/2 sm:order-1 sm:pl-5 lg:pl-10 mt-7 sm:mt-0">
                    <img class="max-w-xl sm:max-w-3xl lg:max-w-5xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/order_collage.png">
                </div>
            </div>
        </div>
    </section>

    <section class="text-center py-10 md:py-20 lg:py-24">
        <div class="container mx-auto max-w-5xl">
            <h3><strong>Frequently Asked Questions</strong></h3>
            <h6 class="mt-3 mb-10">If your questions aren’t answered below, please start a chat with us in the bottom right!</h6>
            <div class="dropdowns">
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "customClass" => "border-blue md:rounded-full",
                        "customArrow" => "text-blue",
                        "question" => true,
                        "title" => "What is Drumeo?",
                        "description" => 'Drumeo is an online platform that offers an organized drum curriculum, artist courses on popular topics, 5000+ songs transcribed note-for-note, and a supportive global community of students and teachers. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "customClass" => "border-blue md:rounded-full",
                        "customArrow" => "text-blue",
                        "question" => true,
                        "title" => "Is Drumeo good for beginners?",
                        "description" => 'Yes! You’ll always know what to practice with sequential step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "customClass" => "border-blue md:rounded-full",
                        "customArrow" => "text-blue",
                        "question" => true,
                        "title" => "Does Drumeo have anything for advanced drummers?",
                        "description" => 'Drumeo is the perfect companion for advanced drummers, giving you access to artist courses so you can gain insights and inspiration from the legends – with 200+ artist courses on a variety of topics. Plus, you’ll get note-for-note transcriptions for thousands of songs and practical playback tools, so you can take on any new challenge with confidence. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "customClass" => "border-blue md:rounded-full",
                        "customArrow" => "text-blue",
                        "question" => true,
                        "title" => "Am I too old to learn the drums?",
                        "description" => 'You’re never too old to learn the drums. Drumeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with drummers just like you who are learning and applying their skills to music. ',
                        ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                        "customClass" => "border-blue md:rounded-full",
                        "customArrow" => "text-blue",
                        "question" => true,
                        "title" => "Do I need to be tech-savvy to learn through your app?",
                        "description" => 'Not at all! Technology is here to make your life easier, and Drumeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
                        ])
            </div>
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
            'modal' => 'testimonial1',
            'vimeo' => '342059271',
            ],
            [
            'modal' => 'testimonial2',
            'vimeo' => '373252004',
            ],
            [
            'modal' => 'testimonial3',
            'vimeo' => '342066325',
            ],
            [
            'modal' => 'testimonial4',
            'vimeo' => '373445704',
            ],
            [
            'modal' => 'testimonial5',
            'vimeo' => '373446024',
            ],
            [
            'modal' => 'testimonial6',
            'vimeo' => '342066433',
            ],
            [
            'modal' => 'testimonial7',
            'vimeo' => '373445466',
            ],
            [
            'modal' => 'testimonial8',
            'vimeo' => '373445819',
            ],
            [
            'modal' => 'testimonial9',
            'vimeo' => '373445587',
            ],
            [
            'modal' => 'testimonial10',
            'vimeo' => '373445917',
            ],
            [
            'modal' => 'testimonial11',
            'vimeo' => '373446155',
            ],
            [
            'modal' => 'testimonial12',
            'vimeo' => '553438851',
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
                $(this).find('i').toggleClass('rotate-180');
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


    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
