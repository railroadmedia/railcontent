@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote2.jpg" style="display: none;">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
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
            fill: #f61a30 !important;
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
        trailer : false,
        unbox : false,
        rolandTrailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($promoVersion))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("pianote.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    @php
        $features = [
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/piano-lesson-icon.svg',
                'title' => 'Piano Lessons',
                'desc' => 'Step-by-step video <br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with inspiring pianists. ',
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
                'desc' => 'Pianote is a really fun resource for those wishing to pick up tips and tricks and gain perspective. ',
                'thumb' => 'https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-yvette.jpg',
                'name' => 'Yvette Young',
                'credit' => ' Multi-Instrumentalist',
            ],
            [
                'desc' => 'You should check out Pianote. If you’re a beginner or intermediate, this is ideal for you!',
                'thumb' => 'https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-ali.jpg',
                'name' => 'Ali Spagnola',
                'credit' => ' YouTube Entertainer',
            ],
            [
                'desc' => 'Whether you’re getting your head around “Chopsticks” or brushing up on your Shostakovich, there should be a lesson for you.',
                'thumb' => 'https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-musicradar.jpg',
                'name' => 'MusicRadar',
                'credit' => ' Website For Musicians',
            ],
        ];
    @endphp

    @if(empty($hideHeader) || !$hideHeader)
        @include('musora.sales.components.header-section', [
            'header' => 'Online piano lessons for all skill levels.',
            'desc' => 'Learn the piano faster with step-by-step lessons, a thousand songs, and unlimited personal support. ',
            'thumb' => 'https://pianote.s3.amazonaws.com/sales/2023/header-thumb2.jpg',
            'promoThumb' => 'https://pianote.s3.amazonaws.com/sales/2023/jan-thumb2.png',
            'promoThumbM' => 'https://pianote.s3.amazonaws.com/sales/2023/jan-thumb-m2.jpg',
            'pointOne' => 'Improve Your Skills',
            'pointTwo' => 'World-Class Teachers',
            'pointThree' => 'Play More<br class="inline lg:hidden"> Songs',
            'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Pianote+Membership/79348450',
            'students' => number_format(Prices::$students),
        ])
    @endif

    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif
{{--    @if(!empty($promoVersion))--}}
{{--        @include('musora.sales.components.promo-section', [--}}
{{--        'promoLogo' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs.svg',--}}
{{--           'promoLogoM' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/new-year-new-songs-m.png',--}}
{{--        'desc' => 'One membership. All instruments. 1000s of songs.',--}}
{{--           'text' => 'This is your year.<br><br>Experience the NEW Pianote membership in 2023 and make the best investment in yourself. You’ll get guided lessons from world-class piano teachers to help you reach any goal this year.<br><br>And best of all…<br><br>You’ll have unlimited access to our brand new song library, complete with 1000 note-for-note transcriptions from our partners at Hal Leonard. Play your favorite songs the way they were written, complete with professional backing tracks so you’ll feel like a star.<br><br>And it gets better.<br><br>Because your Pianote membership now comes fully-loaded with all instruments. You can learn to sing, play guitar, or even rock out on the drums. All for no extra cost.<br><br>Join today and you’ll also get a set of Pianote professional over-ear headphones. Valued at $189, they’re yours free. Start the year off right. Click below to begin.',--}}
{{--           'img' => 'https://pianote.s3.amazonaws.com/sales/promos/january/jan-launch-collage.png',--}}
{{--           'belowButton' => 'SAVE 17% + GET 10 BONUSES WORTH $905',--}}
{{--       ])--}}
{{--    @else--}}
        @include('musora.sales.components.learn-by-playing-section', [
            'header' => 'Learn the piano by<br class="inline sm:hidden"> <u>playing the piano</u>.',
            'desc' => 'It’s not rocket science.<br><br>If you don’t play your piano, you won’t get better. At Pianote, our mission is to get you playing more so you get better, faster (while having FUN!).<br><br>In short, you’ll learn piano <u>by playing piano</u>.<br><br>These are short, fun lessons from world-class teachers. But the real magic happens when you practice ALONG with your coaches.<br><br>You’ll play more, you’ll get better faster, and you’ll fall in love with your progress. Plus you’ll have access to a library of thousands of popular songs with sheet music and backing tracks.<br><br>Scroll down to watch the trailer, see more details, and start playing like you’ve always wanted!',
            'img' => 'https://pianote.s3.amazonaws.com/sales/2023/collage-evergreen.png',
        ])
{{--    @endif--}}

    @php
        $gridItems = [
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/modern-method.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'Develop your core skills, techniques, and musicality to play beautifully in any setting. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'You\'ll always have on-screen assignments and practice tools to help you see results.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/guided-workouts.jpg',
                'title' => 'Guided Workouts',
                'desc' => 'Stay inspired with guided workouts where you’ll play along with your teacher in real time.',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'Lifetime teachers, touring performers, recording professionals, and trending stars. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime. ',
            ],
            [
                'image' => 'https://pianote.s3.amazonaws.com/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global piano community. ',
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314572/rendition/540p/file.mp4?loc=external&signature=b8d6bc7c80a784c2cc9473ae9e1389b3f9e005fbbce2568d7bd6b7d548a4c19e',
        'header' => 'Your piano goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline lg:hidden">curriculum and direct access to real teachers. ',
    ])

    @php
        $buttons = [
            'Styles', 'Technique', 'Creativity'
        ];

        $courses = [
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/classical-piano.jpg',
                    'title' => 'Classical<br> Piano',
                    'instructor' => 'Victoria Theodore',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/cocktail-piano.jpg',
                    'title' => 'Cocktail<br> Piano',
                    'instructor' => 'Brett Ziegler',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/latin-essentials.jpg',
                    'title' => 'Latin<br> Essentials',
                    'instructor' => 'Kevin Castro',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/worship-piano.jpg',
                    'title' => 'Worship<br> Piano',
                    'instructor' => 'Amberly Martz',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/improvisational-jazz.jpg',
                    'title' => 'Improvisational<br> Jazz',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/gospel-piano.jpg',
                    'title' => 'Gospel<br> Piano',
                    'instructor' => 'Erskine Hawkins',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/Latin-Jazz.jpg',
                    'title' => 'Latin<br> Jazz',
                    'instructor' => 'Gabriel Palatchi',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/Tango-Piano.jpg',
                    'title' => 'Tango<br> Piano',
                    'instructor' => 'Sangah Noona',
                    ]
                ]
            ],
            [
                'title' => 'Add essential techniques',
                'images' => [
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/piano-technique-made-easy.jpg',
                    'title' => 'Piano Technique<br> Made Easy',
                    'instructor' => 'Cassi Falk',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/faster-fingers.jpg',
                    'title' => 'Faster<br> Fingers',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/hanon-exercises.jpg',
                    'title' => 'Hanon<br> Exercises',
                    'instructor' => 'Cassi Falk',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/de-stupefy-your-left-hand.jpg',
                    'title' => 'De-Stupefy<br> Your Left Hand',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/beautifully-simple-piano-arpeggios.jpg',
                    'title' => 'Beautifully<br> Simple Piano<br> Arpeggios',
                    'instructor' => 'Sangah Noona',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/riffs-fills.jpg',
                    'title' => 'Riffs<br> & Fills',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/7-days-to-sight-reading.jpg',
                    'title' => '7 Days To<br> Sight Reading',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/dexterity-finger-strength.jpg',
                    'title' => 'Dexterity &<br> Finger Strength',
                    'instructor' => 'Cassi Falk',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/playing-piano-beautifully.jpg',
                    'title' => 'Playing Piano<br> Beautifully',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/musical-freedom.jpg',
                    'title' => 'Improvisation &<br> Musical Freedom',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/the-perfect-arrangement.jpg',
                    'title' => 'The Perfect<br> Arrangement',
                    'instructor' => 'Summer Swee-Singh',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/creative-composition.jpg',
                    'title' => 'Creative<br> Composition',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/pillars-of-improvisation.jpg',
                    'title' => 'Pillars of<br> Improvisation',
                    'instructor' => 'Jordan Leibel',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/the-power-of-chords.jpg',
                    'title' => 'The Power<br> of Chords',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/creative-song-writing.jpg',
                    'title' => 'Creative<br> Songwriting',
                    'instructor' => 'Josh Dion',
                    ],
                    [
                    'img' => 'https://pianote.s3.amazonaws.com/sales/2023/rhythmic-playing.jpg',
                    'title' => 'Rhythmic<br> Playing',
                    'instructor' => 'Jay Oliver',
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
        'brandName' => 'Pianote',
        'bannerDesc' => 'Powered by Musora, Pianote includes full access to our communities for drums, guitar, and voice.',
    ])

{{--    @include('pianote.sales.headphones-section')--}}

    @php
        $testimonials = [
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/iankershaw.jpg',
            'title' => "Such a fantastic and welcoming student community.",
            'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
            'name' => 'Ian Kershaw',
            'video' => '660596700',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jaydemcintosh.jpg',
            'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
            'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
            'name' => 'Jayde McIntosh',
            'video' => '660596722',
            'location' => 'Australia',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/xitlalicaballero2.jpg',
            'title' => "I’m six years old. My biggest moment is when I play Für Elise.",
            'description' => "My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.",
            'name' => 'Xitlali Caballero',
            'video' => '660596752',
            'location' => 'Florida, USA',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/nabilabdelmoneim.jpg',
            'title' => "I’m a lot better at using both hands and it opened up more songs.",
            'description' => "You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!",
            'name' => 'Nabil Abd El Moneim',
            'video' => '660596735',
            'location' => 'British Columbia, Canada',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jessripley.jpg',
            'title' => "I’m blown away by the program you’ve created.",
            'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
            'name' => 'Jess Ripley',
            'location' => 'California, USA',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/anselmdesouza.jpg',
            'title' => "Helped coordinate my left and right hands.",
            'description' => "I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined Pianote and went back to the basics.<br><br>Pianote helped coordinate my left and right hands. The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging.",
            'name' => 'Anselm de Souza',
            'location' => 'Singapore',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/johnmaclean.jpg',
            'title' => "My 6 year old daughter started dancing as I played.",
            'description' => "Before Pianote and The Method, I was completely lost in terms of knowing how to become a better musician. All I would do is try to play songs, but without any of the structure and practice that is required to actually improve. And with face to face lessons I wasn’t really progressing much between the lessons. But having access to the video tutorials online lets me go back as often as I need to.<br><br>My biggest breakthrough has been independent hand control – allowing me to hear rich music that I’m creating for the first time. And gaining that confidence has allowed me to start to improvise the pieces that I learn.<br><br>The lightbulb moment happened when my 6 year old daughter started dancing as I played! You must be doing something right if someone dances to music that you’re playing, right?",
            'name' => 'John Maclean',
            'location' => 'United Kingdom',
            ],
            [
            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/serenadorward.jpg',
            'title' => "If I was taught this way as a child, I would have never quit.",
            'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
            'name' => 'Serena Dorward',
            'location' => 'Ontario, Canada',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by pianists<br class="inline-block sm:hidden">  everywhere.',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Pianote+Membership/79348450',
        'reviewText' => 'Rated 5 stars by Pianote students of all skill levels!',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'youtube' => '1.2M',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'facebook' => '422K',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
        'instagram' => '174K',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://pianote.s3.amazonaws.com/sales/2022/piano-guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @hasSection('final')
        @yield('final')
    @elseif(!empty($promoVersion))
        @php
            $bonuses = [
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/bonus-chords-scales.jpg',
                    'title' => 'Chords & <br>Scales Book',
                    'description' => 'Your encyclopedia of piano chords & scales.',
                    'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                    'shipping' => 'true'
                ],
                [
                'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-technique-made-easy.jpg',
                'title' => 'Piano Technique<br> Made Easy',
                'description' => 'Your ultimate guide to learning the piano. Learn EVERY scale, chord, arpeggio, and key signature.',
                'price' => floatval($productPrices['piano-technique-made-easy']->price),
                ],
                [
                'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/piano-riffs-and-fills.jpg',
                'title' => 'Piano Riffs<br> & Fills',
                'description' => 'Learn the secrets and tips to play fills that sound complicated and advanced, but are simple to learn.',
                'price' => floatval($productPrices['piano-riffs-and-fills']->price),
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/faster-fingers.jpg',
                    'title' => '',
                    'description' => 'Boost your speed and confidence with this guided practice course.',
                    'price' => floatval($productPrices['faster-fingers']->price),
                ],
            ]
        @endphp
        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://pianote.s3.amazonaws.com/sales/2023/pianote-annual-2w-card.png',
        'header' => 'Online piano lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 4 bonuses<br class="inline sm:hidden"> worth $357',
        'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[piano-technique-made-easy]=1&products[piano-riffs-and-fills]=1&products[faster-fingers]=1&redirect=/order&locked=true',
        'altButtonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/pianote-spread.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews',
    ])

    @include('pianote._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'unbox',
        'video' => '774408046',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("pianote.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
