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
        <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @endif

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
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
        .splide__pagination {
            bottom:0;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 6px !important;
            opacity: 1 !important;
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
        soundslice : false,
        trailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("drumeo.sales.partials._nav")
    @else
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "trialVersion" => true,
        ])
    @endif


    @php
        $features = [
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drum-lessons-icon.svg',
                'title' => 'Drum Lessons',
                'desc' => 'Step-by-step video<br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/artist-course-icon2.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with drumming heroes. ',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/songs-icon.svg',
                'title' => '5000+ Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
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
    @include('musora.sales.components.header-section', [
        'header' => 'Online drum lessons for all skill levels.',
        'desc' => 'Learn the drums faster with step-by-step lessons, thousands of songs and unlimited personal support.',
        'thumb' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/jan-thumb-no-badge.jpg',
        'promoThumb' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/header-thumb-promo2.png',
        'promoThumbM' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/header-thumb-promo-m2.jpg',
        'pointOne' => 'Improve Your Skills',
        'pointTwo' => 'World-Class Teachers',
        'pointThree' => 'Play More Songs',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738',
        'students' => number_format(31856),
    ])

    @if(!empty($promoVersion))
        @include('musora.sales.components.promo-section', [
        'promoLogo' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs.svg',
           'promoLogoM' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs-m.png',
        'desc' => 'Loop, learn, and remove the drums from 5,000+ drumming anthems. ',
           'text' => 'The NEW Drumeo Songs is here.<br><br>You can now magically remove the drums from 5,000+ popular drumming anthems. And with note-for-note sheet music, tempo adjustment, and a looping feature you’ll have <strong>the ultimate tool for learning songs on the drums.</strong> <br><br>And to make your goals easier in 2023 – you’ll also get a FREE pair of Drumeo’s in-ear headphones when you join Drumeo. So you can enjoy unlimited drum lessons, note-for-note song breakdowns, AND protect your ears while playing your favorite songs.<br><br>Click below to grab the deal – or scroll down to try a demo of the NEW Drumeo Songs.',
           'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/collage-promo.png',
           'belowButton' => 'SAVE 17% + GET 10 BONUSES WORTH $1342.94',
       ])
    @else
        @include('musora.sales.components.learn-by-playing-section', [
            'header' => 'Learn the drums by<br class="inline sm:hidden"> <u>playing the drums</u>.',
            'desc' => 'It’s the best feeling in the world –<br><br>Nailing that fill in your favorite song, slamming out the chorus of an all-time classic, or writing your own drum part that locks in with the music… but it’s a process.<br><br>And it starts with learning the skills & techniques you need to play the drums.<br><br>Drumeo makes learning the drums easier by giving you step-by-step lessons anytime & anywhere it fits your schedule. Plus, the groundbreaking NEW Drumeo Songs tool makes playing your favorite songs a reality – with note-for-note breakdowns of 5,000 popular songs.<br><br>You’ll play more. You’ll fall in love with your progress. And you’ll have personalized support every step of the way.<br><br>Scroll down to watch the trailer, see more details, and learn to play like you’ve always wanted!',
            'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/collage2.png',
        ])

    @endif


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
                'desc' => 'Keep up your progress with clear assignments and handy practice tools for every level.',
            ],
            [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
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

    @include('musora.sales.components.trailer-grid-section', [
        'vid' => 'https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/video-reel.mp4',
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
                'title' => 'Learn and style',
                'images' => [
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Todd-Sucherman.jpg',
                        'title' => 'Rock <br>Drumming',
                        'instructor' => 'Todd Sucherman',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Dennis-Chambers.jpg',
                        'title' => 'Funk <br>Drumming',
                        'instructor' => 'Dennis Chambers',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Domino-Santatonio.jpg',
                        'title' => 'Pop <br>Drumming',
                        'instructor' => 'Domino Santantonio',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Steve-Smith.jpg',
                        'title' => 'Jazz <br>Drumming',
                        'instructor' => 'Steve Smith',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Larnell-Lewis.jpg',
                        'title' => 'Gospel <br>Drumming',
                        'instructor' => 'Larnell Lewis',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Greyson-Nektrutman.jpg',
                        'title' => 'Big Band <br>Drumming',
                        'instructor' => 'Greyson Nekrutman',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Gene-Hoglan.jpg',
                        'title' => 'Metal <br>Drumming',
                        'instructor' => 'Gene Hoglan',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/John-Wooton.jpg',
                        'title' => 'Latin <br>Drumming',
                        'instructor' => 'John Wooton',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Anika-Nilles.jpg',
                        'title' => 'Subdivision<br> Studies',
                        'instructor' => 'Anika Nilles',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Dom-Famularo.jpg',
                        'title' => 'Pedal<br> Control',
                        'instructor' => 'Dom Famularo',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Tommy-Igoe.jpg',
                        'title' => 'Groove<br> Essentials',
                        'instructor' => 'Tommy Igoe',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Dorothe-Taylor-01.jpg',
                        'title' => 'Stick<br> Control',
                        'instructor' => 'Dorothea Taylor',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Bruce-Becker.jpg',
                        'title' => 'Hand<br> Technique',
                        'instructor' => 'Bruce Becker',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Billy-Cobham.jpg',
                        'title' => 'Internal<br> Synchronization',
                        'instructor' => 'Billy Cobham',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Emmanuelle-Caplette.jpg',
                        'title' => 'Traditional<br> Grip',
                        'instructor' => 'Emmanuelle Caplette',
                    ],
                    [
                        'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Sarah-Thawer.jpg',
                        'title' => '4-Way<br> Coordination',
                        'instructor' => 'Sarah Thawer',
                    ],
                ]
            ],
            [
                'title' => 'Find your groove',
                'images' => [
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Simon-Phillips.jpg',
                    'title' => 'Elevate Your<br> Drum Sound',
                    'instructor' => 'Simon Phillips',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Aaron-Spears.jpg',
                    'title' => 'Drum<br> Chops',
                    'instructor' => 'Aaron Spears',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Hannah-Welton.jpg',
                    'title' => 'Writing<br> Drum Parts',
                    'instructor' => 'Hannah Welton',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Matt-McGuire.jpg',
                    'title' => 'Song<br> Breakdowns',
                    'instructor' => 'Matt McGuire',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Dorothe-Taylor-02.jpg',
                    'title' => 'Rudiments<br> & Patterns',
                    'instructor' => 'Dorothea Taylor',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Aric-Improta.jpg',
                    'title' => 'The Creative<br> Mindset',
                    'instructor' => 'Aric Improta',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Kaz-Rodgriguez.jpg',
                    'title' => 'Musical<br> Exercises',
                    'instructor' => 'Kaz Rodriguez',
                    ],
                    [
                    'img' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drummers/Gavin-Harrison.jpg',
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
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/5000-songs-icon.svg',
                'title' => '5000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for <br class="hidden sm:inline"> every style, era, and skill level.',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/note-for-note-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down or speed up any section <br class="hidden sm:inline">of a song to hear every note.',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/tempo-icon.svg',
                'title' => 'Loop the trouble spots.',
                'desc' => 'No more pausing and rewinding that<br class="hidden sm:inline"> tricky fill. Loop it over and over again!  ',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/no-drums-icon.svg',
                'title' => 'Remove the drums <div class="rounded-full ml-2 inline-block bg-promo text-black text-xs px-2">NEW</div>',
                'desc' => 'Magically remove the original drums<br class="hidden sm:inline"> to make each song uniquely yours. ',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/devices-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,<br class="hidden sm:inline"> so you can play any song, any time.  ',
            ],

        ];
    @endphp
    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a beat.',
        'video' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/smells-like-teen-spirit2.mp4',
        'brandName' => 'Drumeo',
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
            'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620',
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
    <div id="testimonials" class="anchor"></div>
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by drummers<br class="inline-block sm:hidden">  everywhere.',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738',
        'reviewText' => 'Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service.',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'youtube' => '2.5M',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'facebook' => '1.2M',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
        'instagram' => '950K',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
    ])
    <div class="unstick-trigger block"></div>

    @if(!empty($promoVersion))

        @php
            $bonuses = [
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/eardrums.jpg',
                'title' => 'EarDrums',
                'description' => 'Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.',
                'price' => Prices::$earDrumsFull,
                'shipping' => true,
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                'title' => 'Drumeo Drumsticks',
                'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
                'price' => Prices::$sticksFull,
                'shipping' => true,
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/rdm.jpg',
                'title' => 'Rock Drumming Masterclass',
                'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                'price' => Prices::$rdmFull,
                'online-ship' => "Instant Access"
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/dtme.jpg',
                'title' => 'Drum Technique Made Easy',
                'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                'price' => Prices::$dtmeFull,
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/ime.jpg',
                'title' => 'Independence Made Easy',
                'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                'price' => Prices::$imeFull,
                'online-ship' => "Instant Access"
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/eyd.jpg',
                'title' => 'Electrify Your Drumming',
                'description' => 'Your guide to playing 10 styles of electronic dance music - includes 23 play-alongs!',
                'price' => Prices::$eydFull,
                'online-ship' => "Instant Access"
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/fwtbdf.jpg',
                'title' => 'Better Drum Fills',
                'description' => 'The ultimate four-week crash course to playing more creative & musical drum fills.',
                'price' => Prices::$bdfFull,
                'online-ship' => "Instant Access"
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/sd.jpg',
                'title' => 'Successful Drumming',
                'description' => 'Jared Falk’s step-by-step curriculum for building a rock-solid foundation on the drums.',
                'price' => Prices::$sdOnlineFull,
                'online-ship' => "Instant Access"
                ],
                [
                'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://drumeo-assets.s3.amazonaws.com/promos/july/tommy_card.jpg',
                'title' => 'Great Hands For A Lifetime',
                'description' => 'Tommy Igoe helps you improve your hand strength, speed, stamina, comfort, and control in the drums in four hours of video lessons.',
                'price' => Prices::$ghfalFull,
                ],
                [
                'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/lsf.jpg',
                'title' => 'Learn Songs Faster',
                'description' => 'This masterclass will give you proven techniques for learning MORE songs in less time.',
                'price' => Prices::$learnSongsFasterFull,
                'online-ship' => "Instant Access"
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeo-annual-2w-card.png',
        'promoLogo' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs.svg',
       'promoLogoM' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs-m.png',
        'header' => 'Save 17% + get 10 bonuses<br class="inline sm:hidden"> worth $1342.94',
        'fullPrice' => '240',
        'price' => '200',
        'buttonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true',
        'subDescription' => '<strong>10 free bonuses.</strong> <br class="inline sm:hidden"><em>only available until january 31st.</em>',
        'altButtonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,month,1&locked=true',
        'altPrice' => '29',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited drum lessons<br> The world’s best teachers<br> 5000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(31856) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and voice lessons with full access to all Musora communities.</li>',
        'buttonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true',
        'price' => '20',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeo-spread.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @include('drumeo._partials.faq')

    @include('_partials.components.soundslice-modal',[
        'name' => 'soundslice',
        'video' => '162928'
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '772644658'
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
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
