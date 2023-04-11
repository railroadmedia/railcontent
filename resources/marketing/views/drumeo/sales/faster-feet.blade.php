@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta property="og:url" content="https://www.drumeo.com/">

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
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

        @if(!empty($trialVersion))
            .option-buttons.active {
                border-color:#0b76db!important;
                background-color:#0c2949!important;
            }
            .option-buttons.active .radio-check {
                border-color:#0b76db!important;
                background-color:#0b76db!important;
            }
            .option-buttons.active .radio-check i {
                display:block!important;
            }
        @endif
    </style>
@stop

@section('body-data')
    x-data ='{
        soundslice : false,
        trailer : false,
        qkModal: false,
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])

    @endif

    @include('._partials.components.sticky-bar',[
        'link' => '#customize-anchor',
        'logo' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/april/faster-feet-logo-dark.png',
        'text' => 'FREE QUIETKICK + TRAINING<br> PACKS ($754.99 VALUE!)',
    ])
    <div class="block w-full h-12 sm:h-14"></div>

    @php
        $features = [
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drum-lessons-icon.svg',
                'title' => 'Drum Lessons',
                'desc' => 'Step-by-step video<br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/artist-course-icon2.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with drumming heroes. ',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '5000+ Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'Drumeo is the real deal folks - a good place to study and realize one’s dreams.',
                'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/billy-cobham.jpg',
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

    @include('musora.sales.components.header-section', [
        'header' => 'Online drum lessons for all skill levels.',
        'desc' => 'Learn the drums faster with step-by-step lessons, thousands of songs and unlimited personal support.',
        'thumb' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/april/header-image2.png',
        'thumbM' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/april/header-image2-m.jpg',
        'promoThumb' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/april/header-image2.png',
        'promoThumbM' => 'https://dpwjbsxqtam5n.cloudfront.net/promos/april/header-image2-m.jpg',
        'pointOne' => 'Improve Your Skills',
        'pointTwo' => 'World-Class Teachers',
        'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738',
        'students' => number_format(Prices::$students),
        'noThumbShadow' => true,
    ])

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif
{{--    @if(!empty($promoVersion))--}}
{{--        @include('musora.sales.components.promo-section', [--}}
{{--        'promoLogo' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/new-year-new-songs.svg',--}}
{{--           'promoLogoM' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/new-year-new-songs-m.png',--}}
{{--        'desc' => 'Loop, learn, and remove the drums from 5,000+ drumming anthems. ',--}}
{{--           'text' => 'The NEW Drumeo Songs is here.<br><br>You can now magically remove the drums from 5,000+ popular drumming anthems. And with note-for-note sheet music, tempo adjustment, and a looping feature you’ll have <strong>the ultimate tool for learning songs on the drums.</strong> <br><br>And to make your goals easier in 2023 – you’ll also get a FREE pair of Drumeo’s in-ear headphones when you join Drumeo. So you can enjoy unlimited drum lessons, note-for-note song breakdowns, AND protect your ears while playing your favorite songs.<br><br>Click below to grab the deal – or scroll down to try a demo of the NEW Drumeo Songs.',--}}
{{--           'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/collage3.png',--}}
{{--           'belowButton' => 'SAVE 17% + GET 10 BONUSES WORTH $1342.94',--}}
{{--       ])--}}
{{--    @else--}}
        @include('musora.sales.components.learn-by-playing-section', [
            'header' => 'Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.',
            'desc' => 'It’s the best feeling in the world –<br><br>Nailing that fill in your favorite song, slamming out the chorus of an all-time classic, or writing your own drum part that locks in with the music… but it’s a process.<br><br>And it starts with learning the skills & techniques you need to play the drums.<br><br>Drumeo makes learning the drums easier by giving you step-by-step lessons anytime & anywhere it fits your schedule. Plus, the groundbreaking NEW Drumeo Songs tool makes playing your favorite songs a reality – with note-for-note breakdowns of 5,000 popular songs.<br><br>You’ll play more. You’ll fall in love with your progress. And you’ll have personalized support every step of the way.<br><br>Scroll down to watch the trailer, see more details, and learn to play like you’ve always wanted!',
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/collage2.png',
        ])
{{--    @endif--}}

    @php
        $gridItems = [
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/10-level-cirriculum.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'The most trusted step-by-step video lessons for every technique, pattern, and style.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'Keep up your progress with clear assignments and handy practice tools for every level.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'The best drummers are here -- including Grammy Award winners and touring musicians.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime.',
            ],
            [
                'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global drum community.',
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314560/rendition/540p/file.mp4?loc=external&signature=1549cce1dacabad80dd416b5a439f6639d3b7b30c7e4d70d46245bf70c6d5102',
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => '
        Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum featuring many of the world’s best teachers. ',
    ])

    @php
        $buttons = [
            'Styles', 'Creativity', 'Grooves'
        ];

        $courses = [
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Todd-Sucherman.jpg',
                        'title' => 'Rock <br>Drumming',
                        'instructor' => 'Todd Sucherman',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dennis-Chambers.jpg',
                        'title' => 'Funk <br>Drumming',
                        'instructor' => 'Dennis Chambers',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Domino-Santatonio.jpg',
                        'title' => 'Pop <br>Drumming',
                        'instructor' => 'Domino Santantonio',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Steve-Smith.jpg',
                        'title' => 'Jazz <br>Drumming',
                        'instructor' => 'Steve Smith',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Larnell-Lewis.jpg',
                        'title' => 'Gospel <br>Drumming',
                        'instructor' => 'Larnell Lewis',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Greyson-Nektrutman.jpg',
                        'title' => 'Big Band <br>Drumming',
                        'instructor' => 'Greyson Nekrutman',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Gene-Hoglan.jpg',
                        'title' => 'Metal <br>Drumming',
                        'instructor' => 'Gene Hoglan',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/John-Wooton.jpg',
                        'title' => 'Latin <br>Drumming',
                        'instructor' => 'John Wooton',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Anika-Nilles.jpg',
                        'title' => 'Subdivision<br> Studies',
                        'instructor' => 'Anika Nilles',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dom-Famularo.jpg',
                        'title' => 'Pedal<br> Control',
                        'instructor' => 'Dom Famularo',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Tommy-Igoe.jpg',
                        'title' => 'Groove<br> Essentials',
                        'instructor' => 'Tommy Igoe',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dorothe-Taylor-01.jpg',
                        'title' => 'Stick<br> Control',
                        'instructor' => 'Dorothea Taylor',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Bruce-Becker.jpg',
                        'title' => 'Hand<br> Technique',
                        'instructor' => 'Bruce Becker',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Billy-Cobham.jpg',
                        'title' => 'Internal<br> Synchronization',
                        'instructor' => 'Billy Cobham',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Emmanuelle-Caplette.jpg',
                        'title' => 'Traditional<br> Grip',
                        'instructor' => 'Emmanuelle Caplette',
                    ],
                    [
                        'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Sarah-Thawer.jpg',
                        'title' => '4-Way<br> Coordination',
                        'instructor' => 'Sarah Thawer',
                    ],
                ]
            ],
            [
                'title' => 'Find your groove',
                'images' => [
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Simon-Phillips.jpg',
                    'title' => 'Elevate Your<br> Drum Sound',
                    'instructor' => 'Simon Phillips',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Aaron-Spears.jpg',
                    'title' => 'Drum<br> Chops',
                    'instructor' => 'Aaron Spears',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Hannah-Welton.jpg',
                    'title' => 'Writing<br> Drum Parts',
                    'instructor' => 'Hannah Welton',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Matt-McGuire.jpg',
                    'title' => 'Song<br> Breakdowns',
                    'instructor' => 'Matt McGuire',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Dorothe-Taylor-02.jpg',
                    'title' => 'Rudiments<br> & Patterns',
                    'instructor' => 'Dorothea Taylor',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Aric-Improta.jpg',
                    'title' => 'The Creative<br> Mindset',
                    'instructor' => 'Aric Improta',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Kaz-Rodgriguez.jpg',
                    'title' => 'Musical<br> Exercises',
                    'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                    'img' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drummers/Gavin-Harrison.jpg',
                    'title' => 'Bass Drum<br> Calibration',
                    'instructor' => 'Gavin Harrison',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Amplify your skills with 200+ artist courses + <br class="hidden md:inline">access exclusive live events with drumming legends.'
    ])

    @php
        $songItems = [
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/5000-songs-icon.svg',
                'title' => '5000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for <br class="hidden sm:inline"> every style, era, and skill level.',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/note-for-note-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down or speed up any section <br class="hidden sm:inline">of a song to hear every note.',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/tempo-icon.svg',
                'title' => 'Loop the trouble spots.',
                'desc' => 'No more pausing and rewinding that<br class="hidden sm:inline"> tricky fill. Loop it over and over again!  ',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/no-drums-icon.svg',
                'title' => 'Remove the drums <div class="rounded-full ml-2 inline-block bg-promo text-black text-xs px-2">NEW</div>',
                'desc' => 'Magically remove the original drums<br class="hidden sm:inline"> to make each song uniquely yours. ',
            ],
            [
                'icon' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,<br class="hidden sm:inline"> so you can play any song, any time.  ',
            ],

        ];
    @endphp
    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a beat.',
        'video' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/smells-like-teen-spirit2.mp4',
        'brandName' => 'Drumeo',
        'bannerDesc' => 'Powered by Musora, Drumeo includes full access to our communities for piano, guitar, and voice.',
    ])

    @php
        $testimonials = [
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
            'name' => 'Ed Koop',
            'video' => '342059271',
            'title' => 'I’m loving music more than I ever did before!',
            'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
            'name' => 'Barry Lisle',
            'video' => '342066433',
            'title' => 'They walk you through, step-by-step, for any goal.',
            'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
            'name' => 'Lisa Aragon',
            'video' => '373252004',
            'title' => 'I was able to play drums on stage!',
            'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
            'name' => 'Guy Dobbins',
            'video' => '373445704',
            'title' => 'Drummers from all around the world helping you out.',
            'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
            ],
            [
            'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620.jpg',
            'name' => 'Omari Augustine',
            'video' => '553438851',
            'title' => 'Something you can’t get from having a drum teacher.',
            'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
            'name' => 'Marlene Rosen',
            'video' => '373446024',
            'title' => 'I’m rediscovering music again.',
            'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
            'name' => 'Jay Damberg',
            'video' => '373445466',
            'title' => 'Anytime, day or night, I can access the lessons I need.',
            'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
            ],
            [
            'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
            'name' => 'Ivy Elizondo',
            'video' => '373445819',
            'title' => 'Now we have a band and we’re recording an album!',
            'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead -- she’s used Drumeo to build a foundation and formed a band.',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by drummers<br class="inline-block sm:hidden">  everywhere.',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738',
        'reviewText' => 'Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service.',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'youtube' => '2.6M',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'facebook' => '1.2M',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
        'instagram' => '1M',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
    ])
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @hasSection('final')
        @yield('final')
    @elseif(!empty($trialVersion))
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeoplus_logo.svg",
            "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
            "songs" => "5000",
            "firstPoint" => "The world’s best drum lessons.",
            "thirdPoint" => "Unlimited personal support",
            "fifthPoint" => "Lesson access for piano, guitar, and singing.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[drumeo-base-annual-recurring-7-day-trial-membership]=1&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[drumeo-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
        ])
    @elseif(!empty($promoVersion))
        <div style="background:linear-gradient(30deg, #0a3761, #0c1526);">
            <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:url(https://dpwjbsxqtam5n.cloudfront.net/sales/2023/order-bg-tile-2.png) center center/160px;">
                <div class="container mx-auto max-w-6xl relative z-50">
                    <div class="w-full">
                        <div class="text-center">
                            <img class="h-14 md:h-20 lg:h-24 transition-opacity" src="https://dpwjbsxqtam5n.cloudfront.net/promos/april/faster-feet-logo-light.png" alt="Promo logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                        </div>
                        <h4 class="leading-tight my-4 sm:my-5"><strong>
                                Improve your kick foot anywhere <br class="inline lg:hidden">with 6 FREE bonuses</strong> <em class="text-coaches">($754.99 value)</em></h4>

                        <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                            <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                                <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                    <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="h-full w-full bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeo-annual-2w-card.png);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="leading-tight text-sm  my-4 "><em>$240. Cancel anytime. 90-day guarantee.</em></p>
                        <a class="join drumeo mb-6 md:mb-10 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" @click="qkModal = true;">GET Started »</a>
                    </div>
                    <div class="mx-auto max-w-xs sm:max-w-xl lg:max-w-full" style="font-size:0px">
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3  w-1/2 md:w-1/3 lg:w-1/5 " x-data="{
                        flipped: false,
                    }" x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    ">
                            <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div x-ref="front" class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                        <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/july/quietkick_card.jpg);"></div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl" aria-hidden="true"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div x-ref="back" class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">Improve your kick foot anywhere with the portable &amp; quiet bass drum workout pad. Attaches to any single OR double pedal (pedal not included).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">

                                <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-40">$79</s> <strong class="text-promo">FREE</strong></span><br>
                                <em>
                                    Free Shipping
                                </em>
                            </p>
                        </div>
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3  w-1/2 md:w-1/3 lg:w-1/5 " x-data="{
                        flipped: false,
                    }" x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    ">
                            <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div x-ref="front" class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                        <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/rdm.jpg);"></div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl" aria-hidden="true"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div x-ref="back" class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">

                                <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-40">$197</s> <strong class="text-promo">FREE</strong></span><br>
                                <em>
                                    Online Access
                                </em>
                            </p>
                        </div>
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3  w-1/2 md:w-1/3 lg:w-1/5 " x-data="{
                        flipped: false,
                    }" x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    ">
                            <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div x-ref="front" class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                        <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/dtme.jpg);"></div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl" aria-hidden="true"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div x-ref="back" class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">Bruce Becker’s 26-week masterclass to improve your hand &amp; foot technique.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">

                                <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-40">$197</s> <strong class="text-promo">FREE</strong></span><br>
                                <em>
                                    Online Access
                                </em>
                            </p>
                        </div>
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3  w-1/2 md:w-1/3 lg:w-1/5 " x-data="{
                        flipped: false,
                    }" x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    ">
                            <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div x-ref="front" class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                        <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/ime.jpg);"></div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl" aria-hidden="true"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div x-ref="back" class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">

                                <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-40">$197</s> <strong class="text-promo">FREE</strong></span><br>
                                <em>
                                    Online Access
                                </em>
                            </p>
                        </div>
                        <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3  w-1/2 md:w-1/3 lg:w-1/5 " x-data="{
                        flipped: false,
                    }" x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    ">
                            <div class="flip-div inline-block relative w-full group" style=" padding-bottom: 133%;  perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div x-ref="front" class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style=" backface-visibility: hidden;">
                                        <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/black-friday/bundles/vertical-bg/creative-control.jpg);"></div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl" aria-hidden="true"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div x-ref="back" class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">Thomas Lang’s innovative system for developing technique so you can play more effectively in any style of music. Includes more than four hours of video.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">

                                <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-40">$29.99</s> <strong class="text-promo">FREE</strong></span><br>
                                <em>
                                    Online Access
                                </em>
                            </p>
                        </div>
                        <div class="flex flex-wrap sm:flex-nowrap justify-center items-start my-2 sm:my-4">
                            <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                                <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/pianote-bonus.jpg">
                                <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/pianote-bonus-m.jpg">
                                <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">PIANO LESSONS INCLUDED</p>
                            </div>
                            <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                                <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guitareo-bonus.jpg">
                                <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guitareo-bonus-m.jpg">
                                <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">GUITAR LESSONS INCLUDED</p>
                            </div>
                            <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                                <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus.jpg">
                                <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus-m.jpg">
                                <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">SINGING LESSONS INCLUDED</p>
                            </div>
                        </div>
                    </div>
                    <a class="join drumeo my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" @click="qkModal = true;">GET Started »</a>
                    <br>
                    <a class="inline-block text-light-navy mt-2" href="/ecommerce/add-to-cart?products[DLM-1-month]=1&amp;locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">$30/month. (no bonuses)</em></u></p></a>
                </div>
            </section>
        </div>
        @component('_partials.components.modal', ['name' => 'qkModal'])
            @slot('content')
                <div class="max-w-2xl mx-auto">
                    <div class="bg-white py-5 md:py-10 px-4 md:px-5 rounded-xl text-center">
                        <h5 class="leading-tight mb-5">Choose your QuietKick setup<br>
                            <strong>single or double pedal:</strong></h5>
                        <a class="join drumeo mb-3 w-full"
                            href="/ecommerce/add-to-cart?product-array=DLM-1-year:1,quietkick:1,drum-technique-made-easy-pack:1,rock-drumming-masterclass-pack:1,independence-made-easy-pack:1,CC-DIGI:1&locked=true"
                        >Single Kick &raquo;</a>
                        <a class="join drumeo w-full"
                            href="/ecommerce/add-to-cart?product-array=DLM-1-year:1,quietkick:1,quietkick-beater:1,drum-technique-made-easy-pack:1,rock-drumming-masterclass-pack:1,independence-made-easy-pack:1,CC-DIGI:1&locked=true"
                        >Double Kick &raquo;</a>
                    </div>
                </div>
            @endslot
        @endcomponent
    @else
        @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited drum lessons.<br> The world’s best teachers.<br> 5000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and voice lessons with full access to all Musora communities.</li>',
        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeo-spread.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone&ppid=d63c2cf3-274f-4441-8444-a5f547b1b4b6',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=drumeo_previews',
    ])

    @include('drumeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("drumeo.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
