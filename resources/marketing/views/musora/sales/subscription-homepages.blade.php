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
        'desc' => 'It’s been proven over and over –<br><br>Playing the drums is one of the healthiest activities you can perform for your brain – showing signs of boosting happiness, intelligence, and overall well being.<br><br>Drumeo will help you tap into the benefits of playing the drums with organized lessons, motivational instructors, and practical tools to help you play the songs you love – and express yourself creatively in any musical setting.<br><br>You’ll play more. You’ll fall in love with your progress. And you’ll be surrounded by a community of students and teachers to connect, support, and grow your passion.<br><br>Scroll down to watch the trailer, see more details, and join the community where drummers gather – and play like you’ve always wanted!',
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

    @include('musora.sales.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden">best drummers.',
        'desc' => 'Diversify your drumming knowledge by studying with the world’s best drummers and teachers – with 200+ goal-oriented artist courses to amplify your skills & exclusive live events with drumming royalty.'
    ])

    @php
        $songItems = [
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/5000-songs-icon.svg',
                'title' => '5000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill with handy play-along tools. ',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/note-for-note-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down or speed up any section of a song to hear every note your favorite drummer plays. ',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/tempo-icon.svg',
                'title' => 'Loop the trouble spots.',
                'desc' => 'No more pausing and rewinding that tricky fill. Grab any song section and loop it, over and over! ',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/metronome-icon.svg',
                'title' => 'Remove the drums *NEW*',
                'desc' => 'Magically remove the original drum part to make each song and performance uniquely yours. ',
            ],
            [
                'icon' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/loop-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable, so you can play the songs you love whenever and wherever. ',
            ],

        ];
    @endphp
    @include('musora.sales.songs-section', [
        'header' => 'Play your favorite songs.',
        'desc' => 'You’ll have all the tools you need to <br class="hidden sm:inline"> make sure you never miss a beat.',
        'video' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/back-in-black-player.mp4',
        'brand' => 'Drumeo+',
    ])

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
    @include('musora.sales.guarantee-section', [
        'badge' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/guarantee.png',
        'header' => '<strong>Test-drive your lessons for 90 days.</strong><br>Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
    ])
    <div class="unstick-trigger block"></div>
    @include('musora.sales.order-section-collage', [
        'header' => 'Unlimited drum lessons<br> The world’s best teachers<br> 5000+ popular songs',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by 30,000 students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches"><i class="fa-li fas fa-check"></i> <strong>*BONUS*</strong> includes free access to Musora’s lessons for piano, guitar, and voice.</li>',
        'buttonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true',
        'price' => '20',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/august/order_collage.png',
    ])
    @include('musora.sales.app-section', [
        'header' => 'Available across web,<br> tablet, & mobile.',
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @php
        $faqs = [
            [
            "title" => "What is Drumeo?",
            "description" => 'Drumeo is an online platform that offers an organized drum curriculum, artist courses on popular topics, 5000+ songs transcribed note-for-note, and a supportive global community of students and teachers. ',
            ],
            [
            "title" => "Is Drumeo good for beginners?",
            "description" => 'Yes! You’ll always know what to practice with sequential step-by-step video lessons – plus have fun applying your new skills to your favorite songs, sorted by skill level. And if you ever need help, you’ll have unlimited personal support through live Q&A sessions, student reviews, and a helpful community. ',
            ],
            [
            "title" => "Does Drumeo have anything for advanced drummers?",
            "description" => 'Drumeo is the perfect companion for advanced drummers, giving you access to artist courses so you can gain insights and inspiration from the legends – with 200+ artist courses on a variety of topics. Plus, you’ll get note-for-note transcriptions for thousands of songs and practical playback tools, so you can take on any new challenge with confidence. ',
            ],
            [
            "title" => "Am I too old to learn the drums?",
            "description" => 'You’re never too old to learn the drums. Drumeo has a community of students of all ages, from all around the world. Whether you’re 40, 50, 60, 70, or beyond – you’ll connect with drummers just like you who are learning and applying their skills to music. ',
            ],
            [
            "title" => "Do I need to be tech-savvy to learn through your app?",
            "description" => 'Not at all! Technology is here to make your life easier, and Drumeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
            ],
        ]
    @endphp
    @include('musora.sales.faq-section')

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '772644658'
    ])

    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
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
