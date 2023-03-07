@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    <meta property="og:url" content="https://www.singeo.com"/>

    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee." />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee."/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2023/share-image-singeo.jpg"/>
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/sales-page.css') }}">
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
            fill: #8300E9 !important;
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
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
    @elseif(!empty($month))
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-your-trial-month',
        ])

    @else
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
            "trialVersion" => true,
            "joinUrl" => '/choose-plan',
        ])
    @endif

    @php
        $features = [
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/vocal-lessons-icon.svg',
                'title' => 'Vocal Lessons',
                'desc' => 'Step-by-step video<br class="hidden sm:inline"> lessons on every topic.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/artist-course-icon.svg',
                'title' => 'Artist Courses',
                'desc' => 'Courses and live events<br class="hidden sm:inline"> with drumming heroes. ',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/songs-icon.svg',
                'title' => '1000+ Songs',
                'desc' => 'Sing your favorite<br class="hidden sm:inline"> from every style & era.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/support-icon.svg',
                'title' => '24/7 Support',
                'desc' => 'A global community<br class="hidden sm:inline"> of students & teachers.',
            ],
        ];
        $slides = [
            [
                'desc' => 'You’re going to learn how your voice works, how to strengthen it – and to sing with confidence.',
                'thumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/testimonials/CodyMcManus.png',
                'name' => 'Cody McManus',
                'credit' => 'Music Producer',
            ],
            [
                'desc' => 'Singeo really works. The skills are attainable, easy to learn, and lots of fun.',
                'thumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/SylviaCantu.jpg',
                'name' => 'Sylvia Cantu',
                'credit' => 'Singeo Student from USA',
            ],
            [
                'desc' => 'I took traditional singing lessons in the past and didn’t have nearly this much fun.',
                'thumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/AmberKissler.jpg',
                'name' => 'Amber Kissler',
                'credit' => 'Singeo Student from USA',
            ],
        ];
    @endphp
    @include('musora.sales.components.header-section', [
        'header' => 'Get the singing voice you’ve always wanted.',
        'desc' => 'Improve your vocal range, strength, and control with step-by-step lessons and unlimited personal support.',
        'thumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/header-thumb2.jpg',
        'promoThumb' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/jan-thumb.png',
        'promoThumbM' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/jan-thumb-m.png',
        'pointOne' => 'Improve Your Voice',
        'pointTwo' => 'Helpful Vocal Coaches',
        'pointThree' => 'Sing Popular Songs',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Singeo+Membership/79348458',
        'students' => number_format(Prices::$students),
    ])
    @hasSection('promo-banner')
        @yield('promo-banner')
    @endif
{{--    @if(!empty($promoVersion))--}}
{{--        @include('musora.sales.components.promo-section', [--}}
{{--        'promoLogo' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/new-year-new-songs.svg',--}}
{{--           'promoLogoM' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2023/new-year-new-songs-m.png',--}}
{{--        'desc' => 'Vocal lessons, personal coaches, and 1000+ songs to reach your singing goals.',--}}
{{--           'text' => 'If you’ve tried online singing lessons, you know the struggle: spending months, even years, going around in circles – never <em>actually</em> singing like you’ve wished.<br><br>With videos alone, you’re all alone.<br><br>And that’s why Singeo doubles down on the personal touch – with direct and unlimited access to vocal coaches to give you personal feedback, tailored for your voice.<br><br>You’ll boost your skills with step-by-step video lessons, warmups, artist courses, video reviews, live Q&A sessions with real vocal coaches, and 1000+ songs with playback tools to help you practice and hit every note! PLUS you’ll get unlimited access to our communities for guitar lessons, piano lessons, and drum lessons to reach all of your musical goals.<br><br>Just click the link to make 2023 the year you FINALLY sing like you’ve always wanted.',--}}
{{--           'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/jan-launch-collage2.png',--}}
{{--           'belowButton' => 'SAVE 17% + GET 3 BONUSES WORTH $58',--}}
{{--       ])--}}
{{--    @else--}}
        @include('musora.sales.components.learn-by-playing-section', [
            'header' => 'Learning to sing made easy with <u>personal coaching</u>.',
            'desc' => 'If you’ve tried online singing lessons, you know the struggle: spending months, even years, going around in circles – never actually singing like you’ve wished.<br><br>With videos alone, you’re all alone.<br><br>And that’s why Singeo doubles down on the personal touch – with direct and unlimited access to vocal coaches to give you personal feedback, tailored for your voice.<br><br>You’ll get the convenience of step-by-step video lessons, warmups, artist courses, and song tools so you can improve your vocals anywhere, anytime. PLUS you’ll also enjoy personalized video reviews, live Q&A sessions, community recitals, and technique-boosting bootcamps.<br><br>If you’ve dreamed of hitting higher notes, finding the perfect pitch, and delivering confident performances – we’d love to help. Click any of the big buttons to try Singeo risk-free and start your journey to becoming the singer you’ve always wanted to be.',
            'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/collage-evergreen.png',
        ])

{{--    @endif--}}


    @php
        $gridItems = [
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/method.jpg',
                'title' => '10-Level Curriculum',
                'desc' => 'Turn your desire to sing into passionate practice with useful lessons and exercises.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/practical-assignments.jpg',
                'title' => 'Practical Assignments',
                'desc' => 'You\'ll always have on-screen assignments and practice tools to guide you along the way.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/guided-workouts.jpg',
                'title' => 'Warm-Up Routines',
                'desc' => 'Access our quick warm-up routines to fit any schedule, ranging from 5 to 20 minutes.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/world-class-teachers.jpg',
                'title' => 'World-Class Teachers',
                'desc' => 'Gain insights from vocal coaches, Grammy-Award winners, and chart-topping performers.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/downloadable-videos.jpg',
                'title' => 'Downloadable Videos',
                'desc' => 'Stream your lessons OR download your videos so you can practice anywhere, anytime.',
            ],
            [
                'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/personalized-support.jpg',
                'title' => 'Personalized Support',
                'desc' => 'Get weekly live streams, student lesson plans, and access to a global singing community.',
            ],
        ];
    @endphp

    @include('musora.sales.components.trailer-grid-section', [
        'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314557/rendition/540p/file.mp4?loc=external&signature=e1db56d3f22044707be08bbb02d7327bdf4bee7a07bc705017de56ef45bf1ed4',
        'header' => 'Your singing goals start here.',
        'desc' => 'An organized curriculum to help you understand your voice, how it functions, how to strengthen it, and sing with confidence.',
    ])

    @php
        $buttons = [
            'Expression', 'Technique', 'Performance'
        ];

        $courses = [
            [
                'title' => 'Express your voice',
                'images' => [
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/find-your-true-voice.jpg',
                        'title' => 'Find Your<br> True Voice',
                        'instructor' => 'Sheléa',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/The-power-of-movement.jpg',
                        'title' => 'The Power<br> of Movement ',
                        'instructor' => 'Chris Johnson',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/singing-with-soul.jpg',
                        'title' => 'Singing<br> With Soul',
                        'instructor' => 'Tony Lindsay',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/define-your-singing.jpg',
                        'title' => 'Define Your<br> Singing',
                        'instructor' => 'Cate Canning',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/the-science-of-singing-better.jpg',
                        'title' => 'The Science of<br> Singing Better',
                        'instructor' => 'Darcy D',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/get-your-voice-heard-online.jpg',
                        'title' => 'Get Your Voice<br> Heard Online',
                        'instructor' => 'Hailey Benedict',
                    ]
                ]
            ],
            [
                'title' => 'Add essential techniqes',
                'images' => [
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/singing-with-vibrato.jpg',
                        'title' => 'Sing With<br> Vibrato',
                        'instructor' => 'Lisa Witt',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/hit-the-high-notes.jpg',
                        'title' => 'Hit The <br>High Notes',
                        'instructor' => 'Lisa Witt',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/beautiful-harmonies.jpg',
                        'title' => 'Beautiful<br> Harmonies',
                        'instructor' => 'Julia Ziegler',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/how-to-sing-a-duet.jpg',
                        'title' => 'How To Sing<br> A Duet',
                        'instructor' => 'Tony Lindsay & Lisa Witt',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/singing-runs.jpg',
                        'title' => 'Singing<br> Runs',
                        'instructor' => 'Lisa Witt',
                    ],
                    [
                        'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/increase-your-vocal-range.jpg',
                        'title' => 'Increase Your<br> Vocal Range',
                        'instructor' => 'Lisa Witt',
                    ],
                ]
            ],
            [
                'title' => 'Songwriting & performance',
                'images' => [
                    [
                    'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/singing-starter-kit.jpg',
                    'title' => 'Singing <br>Starter Kit',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/start-writing-songs.jpg',
                    'title' => 'Start Writing<br> Songs',
                    'instructor' => 'Cate Canning',
                    ],
                    [
                    'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/composing-lyrics.jpg',
                    'title' => 'Composing<br> Lyrics',
                    'instructor' => 'Tony Lindsay',
                    ],
                    [
                    'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/songwriting-for-singers.jpg',
                    'title' => 'Songwriting <br>For Singers',
                    'instructor' => 'Hailey Benedict',
                    ],
                    [
                    'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/how-your-voice-works.jpg',
                    'title' => 'How Your <br>Voice Works',
                    'instructor' => 'Darcy D',
                    ],
                    [
                    'img' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/coaches/how-to-record-your-voice.jpg',
                    'title' => 'How To Record<br> Your Voice',
                    'instructor' => 'Cate Canning',
                    ],
                ]
            ],
        ];
    @endphp

    @include('musora.sales.components.coaches-section', [
        'header' => 'Your voice. Your vocal coaches.',
        'desc' => 'Shape your voice with exclusive artist courses + live events with special guests.'
    ])

    @php
        $songItems = [
            [
                'icon' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/1000-songs-icon.svg',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns<br class="hidden sm:inline"> for every style, era, and skill level.',
            ],
            [
                'icon' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/find-tempo-icon.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down any section of a song to<br class="hidden sm:inline">  hear the cadence and intricacies.',
            ],
            [
                'icon' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/loop-icon.svg',
                'title' => 'Loop the hard parts.',
                'desc' => 'Working on the chorus? Simply create<br class="hidden sm:inline">  a loop to sing it over and over!',
            ],
            [
                'icon' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/personal-feedback-icon.svg',
                'title' => 'Personal feedback, anytime.',
                'desc' => 'Share a video and you’ll get helpful<br class="hidden sm:inline">  feedback from our singing community.',
            ],
            [
                'icon' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/device-icon.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable,<br class="hidden sm:inline">  so you can sing any song, any time.',
            ],

        ];
    @endphp

    @include('musora.sales.components.songs-section', [
        'header' => 'Sing your favorite songs.',
        'desc' => 'You’ll have <strong>all the tools you need</strong> to make sure you never miss a note. ',
        'video' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/dont-stop-believin.mp4',
        'brandName' => 'Singeo',
        'bannerDesc' => 'Powered by Musora, Singeo includes full access to our communities for drums, piano, and guitar.',
    ])

    @php
        $testimonials = [
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/OriannaSells.jpg',
            'name' => 'Orianna Sells',
            'title' => 'It felt like the chains finally fell off my voice.',
            'description' => 'I was concerned that my singing style was too different to truly learn what I needed – and I wanted to strengthen my voice and stretch my range in a healthy manner.<br><br>With Singeo, I started practicing my songs more meticulously and it paid off – stronger high notes were available and it felt like the chains finally fell off my voice!',
            'location' => 'South Carolina, USA',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/JocelynnRodrigues.jpg',
            'name' => 'Jocelynn Rodrigues',
            'title' => 'It’s so healing to sing.',
            'description' => 'I wasn’t sure if I could really learn online, because I’ve heard in the past how important it is to have somebody with you, who can guide you – and make sure you don’t get injured.<br><br>But I’ve been making so much progress with Singeo. After doing the routines, I noticed that it didn’t stress me out as much to sing the higher octaves during the exercise. And while I’m singing around the house my voice feels stronger. Everyone can truly sing, and it’s so healing to sing. We were all born with this beautiful instrument and it’s just waiting to be played.',
            'location' => 'Alberta, Canada',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/JohnStevenson.jpg',
            'name' => 'John Stevenson',
            'title' => 'I have my first solo gig lined up!',
            'description' => 'For years I thought I wouldn’t be able to sing. I don’t feel like that anymore. I feel that I can and I now have my first solo gig lined up for January.<br><br>Essentially I realised that I needed to maintain a disciplined regimen. I needed to practice every day. I needed to do specific exercises that focussed on my weak spots. I also realised it wasn’t magic. Improvement is gradual and requires effort. It was a relief realising that if I put in the work, I would get there. Singeo is a good program. If you put in the time you will see improvement.',
            'location' => 'Australia',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/DamienGiven3.jpg',
            'name' => 'Damien Given',
            'title' => 'I’m getting back some of my old confidence.',
            'description' => 'Thirty-five years ago, I sang professionally in a group. And now at 74 years old, I’d given up the idea of ever singing properly again. But when tendonitis put a stop to my piano playing for several months, I decided to give Singeo a try – and boy, what a great choice!<br><br>I’m getting back some of my old confidence through the lessons and feedback – and I’m now keen to regain more pitch and breathing control, even though physiologically I’ve probably lost about one and a half steps at the top of my range. But that doesn’t bother me as much as I thought it would after a few months with Singeo. I’ve received a great deal of positive feedback from my classmates - and great tips from Lisa, Julia, and the team. What a find, what a course, and what great tutors!',
            'location' => 'Northern Ireland',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/KathyMandell.jpg',
            'name' => 'Kathy Mandell',
            'title' => 'It was like, OH! That’s what my problem is.',
            'description' => 'It was like, OH! THAT’S what my problem is! I’ve been having a lot of fun understanding the different singing styles, such as ‘flipper’ or ‘yeller’ – and getting past the flipping thing and either using it in my favor and flipping on purpose like Alanis Morrissette or opening my mouth more to have a stronger voice.<br><br>If you’ve always wanted to sing and didn’t have the confidence or thought you weren’t good enough, this is the program for you. The teachers and students are so supportive, non-judgmental, and encouraging.',
            'location' => 'South Carolina, USA',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/JerryBradley2.jpg',
            'name' => 'Jerry Bradley',
            'title' => 'More comfortable with my own voice every day.',
            'description' => 'This is NOT a standard web-based training where you are provided training videos with no interaction. The teachers are always willing to give personal feedback, suggestions, and recommendations.<br><br>Singeo made me realize it’s about being the best singer I can be while working within my own unique style – not matching somebody else’s. It’s like having a weight lifted off my shoulders. Don’t get me wrong, there is still lots of work to do, but my direction and understanding changed – and I’m feeling more comfortable with my own voice every day.<br><br>It’s up to you to take advantage of it all. The worst case is that you will learn a lot. The best case: you will improve your vocal abilities, confidence, make connections, and become a part of a family that really cares.',
            'location' => 'North Carolina, USA',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/RichardBailey.jpg',
            'name' => 'Richard Bailey',
            'title' => 'Like having your own singing coach.',
            'description' => 'When I saw how knowledgeable, energetic, and bubbly Lisa was it convinced me that this was not just an online tutorial – Singeo is like having your own singing coach at your home, literally any time of the day or night. I’ve learned how to breathe and control my breath to sing – and I’m able to sing songs how they were meant to be sung.<br><br>I enjoy singing so much more than I did before and it’s great fun and so satisfying to hear others say how much they enjoy my singing!',
            'location' => 'New Jersey, USA',
            ],
            [
            'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/testimonials/TerriPigg.jpg',
            'name' => 'Terri Pigg',
            'title' => 'I sing all the time – at home, at the office, in the car, wherever!',
            'description' => 'The learning is always fun and customized to fit you and your singing goals. In addition to that, you’ll get to know people all around the world who also love singing. The Singeo community celebrates and encourages each other as we learn and grow as singers from the convenience of our own homes.<br><br>Singeo’s given me a confidence boost and helped me begin to believe that I can really DO this singing thing while having fun at the same time. I sing all the time – at home, at the office, in the car, wherever. Singing just makes me happy!',
            'location' => 'Tennessee, USA',
            ],
        ]
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Trusted by singers everywhere.',
        'reviewLink' => 'https://www.shopperapproved.com/reviews/Musora.com/product/Singeo+Membership/79348458',
        'reviewText' => 'Rated 5 stars by Singeo students from around the world!',
        'youtubeLink' => 'https://www.youtube.com/singeoofficial/',
        'youtube' => '29,000',
        'facebookLink' => 'https://facebook.com/singeoofficial/',
        'facebook' => '23,000',
        'instagramLink' => 'https://instagram.com/singeoofficial/',
        'instagram' => '9,000',
    ])

    @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/singeo-guarantee.png',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence to share your voice with the world.',
    ])

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @if(!empty($promoVersion))

        @php
            $bonuses = [
                [
                    'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/promos/november/singing-starter-kit.jpg',
                    'title' => 'Singing<br> Starter Kit',
                    'description' => 'Get everything you need to start singing now. In just 7 hands-on lessons, you’ll overcome the challenges most beginner singers face and will instantly sound better.',
                    'price' => floatval($productPrices['singing-starter-kit']->price),
                ],
                [
                    'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/promos/october/Beautiful_harmonies_card.jpg',
                    'title' => 'Harmony',
                    'description' => 'In just 8, short, sing-a-long lessons, you’ll learn how to elevate any vocal performance with incredible harmonies. Even if you’re a total beginner, you’ll be singing your first harmony within the first 10 minutes of this course.',
                    'price' => floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->price),
                ],
            ]
        @endphp

        @include('musora.sales.components.order-section-bonuses', [
        'topImage' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/singeo-annual-2w-card.png',
        'header' => 'Online singing lessons for all skill levels.',
        'subDescription' => 'Save 17% + get 2 bonuses<br class="inline sm:hidden"> worth $46',
        'buttonLink' => '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&products[the-essential-guide-to-beautiful-harmonies]=1&locked=true&redirect=/order',
        'altButtonLink' => '/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true',
        ])
    @else
        @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited singing lessons.<br> Vocal coaches and support.<br>1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/singeo-spread.png',
        ])
    @endif

    @include('musora.sales.components.app-section', [
        'image' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=101a6930-1058-4aae-9584-1a25cec367a0',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=singeo_previews',
    ])

    @include('singeo._partials.faq')

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => 'ZsC4c',
        'soundslice' => true
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314379',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("singeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("singeo.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
