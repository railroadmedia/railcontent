@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <meta property="og:url" content="https://www.guitareo.com"/>

    <meta name="description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee." />
    <meta property="og:description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg"/>
    @endif

    @include('pianote._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">

    <link href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">

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
            fill: #00c9ac !important;
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
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @else
        @include("guitareo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
        ])
    @endif

    @php
        $features = [
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/piano-lesson-icon.svg',
                'title' => 'Guitar Lessons',
                'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring guitarists. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/songs-icon.svg',
                'title' => '1000+ Songs',
                'desc' => 'Play your favorite songs<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'The largest community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'I think it’s a great way to learn guitar and learn faster because you’re having a good time.',
                'thumb' => 'https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-ali.jpg',
                'name' => 'Ali Spagnola',
                'credit' => ' YouTube Entertainer',
            ],
            [
                'desc' => 'I think it’s a great way to learn guitar and learn faster because you’re having a good time.',
                'thumb' => 'https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-ali.jpg',
                'name' => 'Ali Spagnola',
                'credit' => ' YouTube Entertainer',
            ],
            [
                'desc' => 'I think it’s a great way to learn guitar and learn faster because you’re having a good time.',
                'thumb' => 'https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-ali.jpg',
                'name' => 'Ali Spagnola',
                'credit' => ' YouTube Entertainer',
            ],
        ];
    @endphp

    @include('musora.sales.components.header-section', [
        'header' => 'Online guitar lessons for all skill levels.',
        'desc' => 'Learn the guitar faster with step-by-step lessons, a thousand songs, and unlimited personal support. ',
        'thumb' => 'https://pianote.s3.amazonaws.com/sales/2023/header-thumb.jpg',
        'promoThumb' => 'https://pianote.s3.amazonaws.com/sales/2023/jan-thumb.png',
        'promoThumbM' => 'https://pianote.s3.amazonaws.com/sales/2023/jan-thumb-m.jpg',
        'pointOne' => 'Improve Your Skills',
        'pointTwo' => 'World-Class Teachers',
        'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Guitareo+Membership/79348454',
        'students' => number_format(Prices::$students),
    ])

    @if(!empty($promoVersion))
        @include('musora.sales.components.promo-section', [
        'promoLogo' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs.svg',
           'promoLogoM' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs-m.png',
        'desc' => 'Unlock step-by-step lessons & 1000+ songs to reach your guitar goals in 2023. ',
           'text' => 'Learning songs has <u>never</u> been easier.<br><br>Introducing NEW Guitareo Songs – <strong>the ultimate tool for learning songs faster and better</strong> with note-for-note sheet music, tempo adjustments, and a looping feature.<br><br>And unlike other song tools, every song is perfectly transcribed and professionally proofed to guarantee its accuracy. Because playing songs should be fun, not frustrating.<br><br>PLUS you’ll have access to step-by-step video lessons on every topic, artist courses and exclusive events, and unlimited personal support to reach all of your guitar goals in 2023.<br><br>When you join today, you\'ll receive a Guitarist\'s Survival Kit for free (valued at $89) to help you sound even better on guitar.<br><br>Click below to grab the deal – or scroll down to try a demo of the NEW Guitareo Songs.',
           'img' => 'https://pianote.s3.amazonaws.com/sales/2023/jan-launch-collage.png',
           'belowButton' => 'SAVE 17% + GET 6 BONUSES WORTH $924',
       ])
    @else
        @include('musora.sales.components.learn-by-playing-section', [
            'header' => 'Learn the guitar by<br class="inline sm:hidden"> <u>playing the guitar</u>.',
            'desc' => 'Most new guitarists learn a chord or two – and then hit some sort of roadblock. Life gets in the way. Your calluses become soft. Or even worse, you lose motivation.<br><br>But playing guitar should never feel like a chore.<br><br>And it’s our mission to help you make progress faster by playing music that inspires you – with 1000+ popular songs – and conquer new styles, skills, and techniques to play like you’ve always wanted.<br><br>Whether you want to play your favorite songs, express your creativity over a backing track, or follow inspirational coaches – you’ll have it all in the Guitareo membership. You’ll get step-by-step lessons, interactive tools, and unlimited support to play your guitar better and faster.<br><br>So give the trailer a watch, and hear how you can achieve your guitar goals today.',
            'img' => 'https://pianote.s3.amazonaws.com/sales/2023/collage-evergreen.png',
        ])
    @endif

    @php
        $gridItems = [
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/modern-method.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'Develop your core skills, techniques, and musicality to play confidently in any setting. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'You\'ll always have on-screen assignments and practice tools to increase retention. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'The best guitarists are here – including Grammy Award winners and touring musicians.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global guitar community. ',
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'vid' => 'https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/video-reel.mp4',
        'header' => 'Your guitar goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Learn to play guitar online with a fluff-free curriculum that’ll<br class="hidden sm:inline">  take your skills from zero to guitar hero – with step-by-step<br class="hidden sm:inline">  lessons designed around playing songs faster. ',
    ])

    @php
        $buttons = [
            'Creativity', 'Styles', 'Technique'
        ];

        $courses = [
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                    'img' => 'todo',
                    'title' => 'Solo In An Hour',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Songwriting Cheat Codes',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Rhythm & Groove ',
                    'instructor' => 'Sami Ghawi',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Timing & Feel',
                    'instructor' => 'David Becker',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Musical Lanes',
                    'instructor' => 'Mark Lettieri',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Add Power To Your Playing',
                    'instructor' => 'Dave Weiner',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Unlock Your Creativity',
                    'instructor' => 'Yvette Young',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'The Anatomy of a Song',
                    'instructor' => 'Pete Thorn',
                    ],
                ]
            ],
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                    'img' => 'todo',
                    'title' => 'Rock Guitar ',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Punk Rock',
                    'instructor' => 'Kent Shores',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Surf Guitar',
                    'instructor' => 'Kent Shores',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Campfire Chords',
                    'instructor' => 'Rob Scallon',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Funk Essentials',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Bluegrass',
                    'instructor' => 'Nate Savage',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Fingerstyle',
                    'instructor' => 'Nate Savage',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Shred Guitar',
                    'instructor' => 'Dean Lamb',
                    ],
                ]
            ],
            [
                'title' => 'Add essential techniques',
                'images' => [
                    [
                    'img' => 'todo',
                    'title' => 'Getting Started On The Acoustic Guitar',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Getting Started On The Electric Guitar',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Altered & Open Tunings',
                    'instructor' => 'Don Ross',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Looping',
                    'instructor' => 'David Becker',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Picking',
                    'instructor' => 'Nate Savage',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Legato',
                    'instructor' => 'Kent Shores',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Strumming Workouts',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                    [
                    'img' => 'todo',
                    'title' => 'Bending & Vibrato',
                    'instructor' => 'Ayla Tesler-Mabé',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline"> courses + live events with special guests.'
    ])

    @php
        $songItems = [
            [
                'icon' => 'https://pianote.s3.amazonaws.com/sales/2023/songs-icon.svg',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for  <br class="hidden sm:inline"> every style, era, and skill level. ',
            ],
            [
                'icon' => 'https://pianote.s3.amazonaws.com/sales/2023/tempo-icons.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down any section of a song  <br class="hidden sm:inline">to make those tricky bars easier. ',
            ],
            [
                'icon' => 'https://pianote.s3.amazonaws.com/sales/2023/loop-icons.svg',
                'title' => 'Loop the hard parts.',
                'desc' => 'Create practice loops to play-through <br class="hidden sm:inline"> those difficult parts over and over.   ',
            ],
            [
                'icon' => 'https://pianote.s3.amazonaws.com/sales/2023/timing-icons.svg',
                'title' => 'Improve your timing.',
                'desc' => 'Use the built-in-metronome – your new <br class="hidden sm:inline"> best friend for difficult rhythms.  ',
            ],
            [
                'icon' => 'https://pianote.s3.amazonaws.com/sales/2023/devices-icons.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable, <br class="hidden sm:inline"> so you can play any song, any time.    ',
            ],

        ];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note.',
        'video' => 'https://pianote.s3.amazonaws.com/sales/2023/someone-like-you2.mp4',
        'brandName' => 'Guitareo',
        'bannerDesc' => 'Powered by Musora, Guitareo includes full access to our communities for voice, piano, and drums.',
    ])

    @php
        $testimonials = [
            [
            'title' => "I’m lightyears ahead of where I was.",
            'description' => "I’ve come so far in such a short period of time. I’ve gone from not even knowing what palm muting was to noodling with the E & A string pentatonic shapes and creating melodies with it – and using it to work on my vibrato, slides, and bends. And I’ve gained priceless info like knowing where to place chords, start power chords, and scale shapes.<br><br>Having the breakthroughs I’ve had so far has brought me confidence and kept me sane while the world is seemingly not – and made me believe there is still a bright future ahead. As I progress, I feel supported towards achieving my goals of jamming with others and using my love for writing to start telling stories through music. All in due time.<br><br>I’m lightyears ahead of where I was at. And no matter where I go, or however tough things get, I’ll always have one of my guitars in the passenger seat and we’ll always be there for each other. The life long journey has begun!",
            'name' => 'Ërlik Sörensen',
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/erliksorensen.jpg',
            ],
            [
            'title' => "The frustration is over.",
            'description' => "I’m already playing things that were a nightmare to me before. Strumming patterns, smoothly changing chords, and improvisation of different scales. I’m even playing songs using my own chord progressions and pentatonic scales. I’m enjoying listening to myself play and proud of my progress!<br><br>The frustration is over. Guitareo has what a guitarist wants and it’s been a fun and easy learning experience.",
            'name' => 'Vetriselvi Senguttuvan',
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/vetriselvisenguttuvan.jpg',
            ],
            [
            'title' => "I’ve never felt so much JOY playing the guitar.",
            'description' => "When I finished the first lesson, I had a feeling of joy that I’ve never had before when playing guitar. I'm experimenting a lot more and improving my technique. The goal-based learning makes each set of lessons more entertaining and a feeling of accomplishment when completed.",
            'name' => 'Jamie K',
            'image' => 'https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jamie-nova-scotia.jpg',
            ],
            [
            'title' => "I finally feel like I’m able to learn the guitar.",
            'description' => "Guitareo focuses on smaller tasks and achievements along the way to make you feel like you’re improving. In level four of GuitarQuest, I played the G chord for the first time without any pain in my hands. I finally feel like I’ll really be able to learn the guitar and succeed! This course is SO much fun and keeps me motivated!",
            'name' => 'Patrizia K',
            'image' => 'https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/patrizia-germany.jpg',
            ],
            [
            'title' => "I like the sincerity, knowledge, and positivity.",
            'description' => "The internet is a nice resource for ideas, methods, tips, and tricks, but there is no linear method. I have to create one on my own, and I don’t want to teach guitar. I want to play.<br><br>So I joined Guitareo because I like the sincerity, knowledge, and positivity. Nate introduced me to the Million Dollar Progression. And Ayla showed me how to solo using backing tracks. They got me started on my journey and gave me confidence. Now I’m excited to practice. My Fender Hellcat seems to fit into my hands and against my body like it didn’t before. And I can actually say “I’m a guitarist!” Well, how about that!",
            'name' => 'Jim McKenna',
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/jimmckenna.jpg',
            ],
            [
            'title' => "I’ve started making my own melodies.",
            'description' => "Guitareo has been fun and motivated me to try more. I like how we start making melodies quickly along with helpful background information on chords and notes. I love seeing other students post their melodies -- it’s so much fun to listen to others!",
            'name' => 'Jan M',
            'image' => 'https://guitareo.s3.amazonaws.com/guitarquest/assets/testimonials/jan-berlin-germany.jpg',
            ],
            [
            'title' => "I feel happy and more confident while playing. ",
            'description' => "I had classical guitar lessons 15 years ago and since then I’ve wanted to play acoustic and electric guitar. I’ve been trying to figure them out on my own and it was frustrating – trying to play pentatonics, or mute strings. And then I found out about Guitareo!<br><br>I feel happy and more confident while playing, even though it’s pretty early. I played my first song with mini barre chords and actually enjoyed it. I’ve never done that before! And I even sent a video playing a punk play-along song to a friend (and I normally never play guitar in front of friends). I would definitely recommend Guitareo. You have done really good work and I personally thank you for that!",
            'name' => 'Athina Katri',
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/athinakatri.jpg',
            ],
            [
            'title' => "I’m holding my own while still having fun!",
            'description' => "I was skeptical at first. I’ve seen online lesson sites that are really bad, so I started with a monthly subscription. After going through the beginner lessons, I saw that Guitareo was totally different from other sites. I’ve had a guitar for years and struggled to play anything more than G, C, and D – and I always had trouble learning new chords and progressions. Guitareo’s lessons helped me advance and have more fun playing the guitar.<br><br>I have broken through doors that were closed to me several times. Things that I’ve struggled with for years have been explained in ways that make sense – and the Guitareo instructors have helped me become more comfortable. Now I’m able to sit in with friends that are way better players than me and hold my own while still having fun!",
            'name' => 'WJ Williams',
            'image' => 'https://guitareo.s3.amazonaws.com/sales/2022/testimonials/williamwilliams.jpg',
            ],
        ]
    @endphp
    <div id="testimonials" class="anchor"></div>
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by guitarists<br class="inline-block sm:hidden">  everywhere.',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Guitareo+Membership/79348454',
        'reviewText' => 'Rated 5 stars by Guitareo students from around the world!',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'youtube' => '991K',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'facebook' => '333K',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
        'instagram' => '18K',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://guitareo.s3.amazonaws.com/sales/2022/guitareo-guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar.',
    ])
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    @if(!empty($promoVersion))

        @php
            $bonuses = [
                [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-narrow-card-sale-site.jpg',
                    'title' => 'Survival Kit',
                    'description' => 'Electric Strings, Acoustic Strings, String Pro-Winder, 10 Assorted Picks, Tuner, Chord & Scales Book, and more!',
                    'price' => GuitareoPrices::$survivalKitFull,
                    'online-ship' => "Free Shipping"
                ],
                [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gq.jpg',
                    'title' => 'GuitarQuest',
                    'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',
                    'price' => GuitareoPrices::$guitarQuestFull,
                    'online-ship' => "Lifetime Access"
                ],
                [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',
                    'title' => 'The Guitar System',
                    'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',
                    'price' => GuitareoPrices::$guitarSystemFull,
                    'online-ship' => "Lifetime Access"
                ],
                [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/agme.jpg',
                    'title' => 'Acoustic Guitar Made Easy',
                    'description' => 'Build a rock-solid foundation and get started on the acoustic guitar the right way.',
                    'price' => GuitareoPrices::$AGMEFull,
                    'online-ship' => "Lifetime Access"
                ],
                [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',
                    'title' => 'Guitar Technique Made Easy',
                    'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',
                    'price' => GuitareoPrices::$GTMEFull,
                    'online-ship' => "Lifetime Access"
                ],
                [
                    'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/rhythm_groove_cart.jpg',
                    'title' => 'Rhythm & Groove',
                    'description' => 'Go beyond simple strumming on the guitar.',
                    'price' => GuitareoPrices::$rhythmAndGrooveFull,
                    'online-ship' => "Lifetime Access"
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://pianote.s3.amazonaws.com/sales/2023/pianote-annual-2w-card.png',
        'promoLogo' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs.svg',
       'promoLogoM' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs-m.png',
        'header' => 'Save 17% + get 6 bonuses<br class="inline sm:hidden"> worth $924',
        'fullPrice' => '240',
        'price' => '200',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[christmas-song-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&redirect=/order&locked=true',
        'subDescription' => '<strong>6 free bonuses.</strong> <br class="inline sm:hidden"><em>only available until january 31st.</em>',
        'altButtonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,month,1&locked=true',
        'altPrice' => '30',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited guitar lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
        'buttonLink' => '/choose-plan',
        'price' => '20',
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/pianote-spread.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @include('guitareo._partials.faq')

    @include('_partials.components.soundslice-modal',[
        'name' => 'soundslice',
        'video' => '162928'
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '772644658'
    ])

    @if(!empty($promoVersion))
        @include("guitareo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("guitareo.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
