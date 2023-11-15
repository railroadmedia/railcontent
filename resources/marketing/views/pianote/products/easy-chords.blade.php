@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Easy Chords | Pianote</title>
    <meta property="og:title" content="Easy Chords | Pianote">
    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/easy-chords/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        form {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            form {
                margin: 0 auto 10px;
            }
        }

        form input, form button {
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }
        @media (min-width: 768px) {
            form input, form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        form input[type="submit"], form button[type="submit"], form input button, form button button {
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: 700;
            color: #fff;
            background: #F61A30;
            text-transform: uppercase;
            margin: 0 auto 15px;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        form input[type="submit"]:hover, form button[type="submit"]:hover, form input button:hover, form button button:hover {
            background:#ff5454;
        }
        .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }

        .thank-you-box {
            width:100%;
            max-width:960px;
            border-radius:5px;
            height:auto;
            max-height:0;
            visibility:hidden;
            opacity:0;
            transition:all .4s ease-in;
            display:block;
            margin:0 auto;
            background:#FFF;
            text-align:center;
            overflow:hidden;
            color:#000
        }

        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px
        }

        @media (min-width:40em) {
            .thank-you-box.active {
                padding:20px
            }
        }

        @media (min-width:64em) {
            .thank-you-box.active {
                padding:30px
            }
        }

        .thank-you-box p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto
        }

        @media (min-width:40em) {
            .thank-you-box p {
                font-size:19px
            }
        }

        @media (min-width:64em) {
            .thank-you-box p {
                font-size:23px
            }
        }

        .thank-you-box p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px
        }

        @media (min-width:40em) {
            .thank-you-box p em {
                font-size:14px
            }
        }

        .thank-you-box h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#F61A30
        }

        @media (min-width:40em) {
            .thank-you-box h2 {
                font-size:37px;
                margin:20px auto
            }
        }

        @media (min-width:64em) {
            .thank-you-box h2 {
                font-size:44px
            }
        }

        .thank-you-box .social-media a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 3px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px
        }

        @media (min-width:64em) {
            .thank-you-box .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0
            }
        }
        .timeline-container .timeline:after,
        .timeline-container:after {
            background-color: #f61a30;
        }
        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }
        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color:#eb1a2f;

        }

        .image-modal-arrow-left, .image-modal-arrow-right {
            font-size: 0;
            position: absolute;
            transform: translate(0, -50%);
            background: #FFF;
            transition: opacity .3s;
            border-radius: 100px;
            height: auto;
            width: auto;
            z-index: 10;
            padding: 3px 10px;
            margin: 0;
            bottom: unset;
            top: 50%;
        }

        .image-modal-arrow-left {
            left: 0;
        }

        .image-modal-arrow-right {
            right: 0;
        }

        .image-modal-arrow-left::before, .image-modal-arrow-right::before {
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            opacity: 1;
            line-height: 1;
            font-family: "Font Awesome 6 Pro";
            font-weight: 300;
            color: #f61a30;
            font-size: 28px;
        }

        .image-modal-arrow-left::before {
            content: "\f104";
        }

        .image-modal-arrow-right::before {
            content: "\f105";
        }

         /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }
        .splide__arrow svg{
            fill: #f61a30 !important;
        }

        .splide__arrow--next {
            right: -12px;
        }

        @media (min-width: 1140px) {
            .splide__arrow--next {
                right: -100px;
            }
        }
    </style>
@stop()

@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')

    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "Easy Chords",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price), 
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
        "noBreadcrumb" => true
    ])

    @php
            $registerButtonUrl = "/ecommerce/add-to-cart?products[easy-chords]=1&redirect=/order";
    @endphp

<!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords/easy-chords-logo.png',
    'logoAlt' => '30 day easy chords logo',
    'text' => '30 days to',
    'subtitle' => 'better piano chords.',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'No Theory Required'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/easy-chords/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/easy-chords/header-left-collage.png',
    'isVideo' => true,
    'mediaSource' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/trailer.mp4',
    'buttonText' => 'GET STARTED',
    'buttonLink' =>  $registerButtonUrl,
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'piano players'
])
    

<!-- Lessons Section -->
@php

$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/easy-chords/kick-off.jpg',
        'videoId' => 824209135,
    ],
    [
        'title' => 'Let’s Get Started',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/easy-chords/start-lesson-poster.jpg',
        'videoId' => 824211328,
    ],
];

$lessons = [
    [
        'title' => 'The Happiest Chord Progression - 5 Workouts',
        'description' => "In week one, get introduced to the 1-5-6-4 progression and work up to your first first inversion."
    ],
    [
        'title' => 'Pre-Recorded Q&A - Your Questions Answered',
        'description' => "In this pre-recorded Q&A, Kevin Castro joins in to answer some of our students' excellent questions about the week's lessons."
    ],
    [
        'title' => 'Week 1 - Rest & Review',
        'description' => "Join Lisa as she reviews everything you've achieved this week, then have a rest (or maybe add a little extra practice!)"
    ],
    [
        'title' => 'Moving With Confidence - 5 Workouts',
        'description' => "In week two, you'll build deeper confidence with the 1st inversion chord and learn how to move smoothly through the Happiest Chord Progression."
    ],
    [
        'title' => 'Pre-Recorded Q&A - Your Questions Answered - Part 2',
        'description' => "In this pre-recorded Q&A, Lisa takes up questions on this challenging week. There's plenty to learn!"
    ],
    [
        'title' => 'Week 2 - Rest & Review',
        'description' => "Join Lisa as she reviews everything you've achieved this week, then have a rest (or maybe add a little extra practice!)"
    ],
    [
        'title' => 'A New Chord Progression - 5 Workouts',
        'description' => "In week three, the chords are the same but the order changes. You'll go from happy to dramatic with 2nd inversion chords."
    ],
    [
        'title' => 'Pre-Recorded Q&A - Your Questions Answered - Part 3',
        'description' => "In this pre-recorded Q&A, Lisa answers our students' questions and helps them past their sticking points."
    ],
    [
        'title' => 'Week 3 - Rest & Review',
        'description' => "Join Lisa as she reviews the week, shares where you can use what you've learned, and hints at where you can go next."
    ],
    [
        'title' => 'Connecting The Dots - 5 Workouts',
        'description' => "In week four, you'll pull together your moody progression with your root, 1st, and 2nd inversion chords. It's going to sound beauitful."
    ],
    [
        'title' => 'Pre-Recorded Q&A - Your Questions Answered - Part 4',
        'description' => "In this final pre-recorded Q&A, you'll find answers to questions from students just like you."
    ],
    [
        'title' => 'Week 4 - Rest & Review',
        'description' => "You've completed Easy Chords! Take a rest, but first watch this to find out where to go next."
    ],
    [
        'title' => 'Easy Chords Celebration',
        'description' => "Join Lisa and Kevin in this special celebration of everything you've achieved. You did it!"
    ],
];
@endphp


@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Move Beyond “Beginner” With Easy Chords',
    'description' => "Every time you listen to a song (even classical ones!) you’re hearing chords. You can tell different stories with different kinds of chords and by changing their order around. That makes them powerful tools for pianists, and absolutely critical to playing with confidence.
                    <br/><br/>
                    But chords can get <em>complicated</em>. That’s why we made this course!
                    <br/><br/>
                    Let Lisa Witt guide you from knowing about chords to actually using them. In just 10 minutes a day for 30 days, you’ll learn popular progressions, chord inversions, and rhythms.
                    <br/><br/>
                    You’ll be amazed at your progress.
                    And more importantly… <strong>you’re going to have so much FUN.</strong>",
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Lisa Witt',
    'course' => ' 30 Days (20 Workouts + 4 Q&As)',
    'lessons' => $lessons,
])


@php 
$practiceItems = [
            [
                "icon" =>
                "fa-regular fa-music",
                "title" => "Never feel lost.",
                "desc" =>
                "The secret to progress is deliberate practice. But how do you know what to practice? Easy Chords makes it crystal clear: your lessons <em>are</em> your practice sessions. Just press play, follow along with Lisa, and make steady progress every day.",
            ],
            [
                "icon" =>
                "fa-regular fa-clock",
                "title" => "Stop wasting time.",
                "desc" =>
                "Your time is valuable. So we made every lesson 10 minutes long and included a handy countdown timer so you can stay focused and get the most out of every second.",
            ],
            [
                "icon" =>
                "fa-regular fa-infinity",
                "title" => "Lifetime access.",
                "desc" =>
                "Can’t finish Easy Chords in 30 days? No problem! Your purchase gives you lifetime access to ALL the lessons forever. So whether you finish it in 30 days and just want to revisit the material, or whether you just need a few more weeks to complete the course, Easy Chords will be there for you. For life.",
            ]
            ]
@endphp

   
<!-- Songs subsection -->
@include('drumeo.products.partials.evergreen._dropdown', [
    'bgClass' => 'bg-slate-900',
    'songItems' => $practiceItems])

<!-- What you will learn section-->
@php
$items = [
            '20 guided play-along lessons.',
            'Lifetime access to watch & re-watch.',
            '90 day money-back guarantee.'
        ]
@endphp

<!-- Get started-->
@include('drumeo.products.partials.evergreen._get-started', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords/easy-chords-logo.png',
    'items' => $items,
    'buttonText' => 'GET STARTED',
    'buttonLink' =>  $registerButtonUrl,
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'piano players',
    'price' => "$127",
    'enrollmentLink' => 'https://www.pianote.com/choose-plan',
    'brandTitle' => 'Pianote'])


 <!-- Meet your teacher section -->
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40" style="background-color:#ffffff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">Piano chords changed my life.
                        <br><br>
                        I grew up learning classical piano through the Royal Conservatory. I didn’t know what chords were, or how they were used in composition.
                        <br><br>
                        I just had to read the notes on the page and play them.
                        <br><br>
                        That all changed the day I discovered chords and chord inversions.
                        <br><br>
                        Suddenly I could start improvising, creating my own rhythms and melodies, and eventually write my own music. Music became something I “created” rather than something I “played”.
                        <br><br>
                        Chords gave me the ability and confidence to do what we all dream of doing…
                        <br><br>
                        Sit down at the piano and “just play”.
                        <br><br>
                        If you’ve ever dreamt of playing popular songs for your family and friends without spending months learning every note. Or if you’ve ever wanted to explore improvisation and song-writing. Or if you just want to sit and play the keys and see what comes out…
                        <br><br>
                        You need to try Easy Chords.
                        <br><br>
                        Over 30 days, I’ll guide you through the stages I used to learn and feel comfortable playing piano chords. You’ll discover how chord inversions will transform your playing and make it easier to play the songs you love.
                        <br><br>
                        Come join me.
                    </p>
                    <img class="float-right h-12 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/lisa-witt-signature.png" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>            
        </div>
    </section>

<!-- Testimonials section -->
@php 
$testimonials = [
                                [
                                    'name' => 'Jess Ripley',
                                    'comment' => 'Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created. I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.',
                                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
                                ],
                                [
                                    'name' => 'Serena Dorward',
                                    'comment' => 'I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on. I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.',
                                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
                                ],
                                [
                                    'name' => 'Jayde McIntosh',
                                    'comment' => 'The idea behind this format is really great. These short sessions can easily be fit into everyday life, no need to think or prepare what\'s next. <strong>It keeps the guesswork out of learning the drums so you can focus on the most important part: Playing the drums and having fun.</strong>',
                                    'img' => 'https://d3fzm1tzeyr5n3.cloudfront.net/profile_picture_url/user-profile-picture-1669379419-276550.jpg',
                                ],
                                [
                                    'name' => 'Ian Kershaw',
                                    'comment' => 'When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews. But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!',
                                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
                                ]
];

$students = "Pianote Student"
@endphp

@include('drumeo.products.partials.evergreen._testimonials', [
    'socialIcons' => [
                [
                    'url' => 'https://www.youtube.com/pianolessonscom/',
                    'label' => 'youtube',
                    'iconClass' => 'fab fa-youtube',
                    'count' => '1,450,000',
                    'countLabel' => 'Subscribers',
                ],
                [
                    'url' => 'https://facebook.com/pianoteofficial/',
                    'label' => 'facebook',
                    'iconClass' => 'fab fa-facebook-f',
                    'count' => '560,000',
                    'countLabel' => 'Likes',
                ],
                [
                    'url' => 'https://instagram.com/pianoteofficial/',
                    'label' => 'instagram',
                    'iconClass' => 'fab fa-instagram',
                    'count' => '239,000',
                    'countLabel' => 'Followers',
                ],
            ],
        'bgColor' => 'linear-gradient(rgba(246, 26, 48, 1), rgba(161, 0, 0, 1))',
        'subHeader'=> 'What students are saying about Lisa',
        'description' => 'Easy Chords works. By focusing on playing with real music right from day one, you’ll learn the skills to play hundreds of songs on the piano in just 30 days. Check out what students are saying:',
        'showBottom' => true,
])


    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#2a2f34;">
        <div class="container max-w-3xl mx-auto leading-normal">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h3 class="my-4 sm:my-6 lg:my-8"><strong>The guarantee that lasts<br class="inline sm:hidden"> longer than the course.</strong></h3>
            <p class="pt-2">Easy Chords will make you a better piano player in just 30 days. And we’re so confident that you’ll love the results, you’ll have 90 days to put us to the test.
               </p>
            <p class="pt-4">That’s enough time to go through the course 3x over before deciding if it’s worth the money.
                Because if you’re not happy with the results, then you shouldn’t have to pay.
                Simply let us know within 90 days and you’ll receive all your hard-earned money back. It’s our promise.</p>

        </div>
    </section>

   
<!-- Learn section -->
@php
$points = [
            '20 guided play-along lessons.',
            'Lifetime access to watch & re-watch.',
            '90-day money-back guarantee.'
        ]
@endphp

@include('drumeo.products.partials.evergreen._learn', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/products/easy-chords/easy-chords-logo.png',
    'logoAlt' => '30 day easy chords logo',
    'title' => '30 days to better piano chords',
    'points' => $points,
    'buttonText' => 'Get Started',
    'buttonLink' =>  $registerButtonUrl,
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png',
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/easy-chords/order-collage.png',
    'students' => 'piano players',
    'numStudents' => number_format($nPackOwners ?? 0),
    'price' => "$127",
    'enrollmentLink' => 'https://www.pianote.com/choose-plan',
    'brandTitle' => 'Pianote'
])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '881061653',
        'vimeo' => true,
    ])

     {{-- @include('_partials.components.countdown',[
        'countdownDate' => '2023-06-05 00:00:00',
        'promoVersion' => false
    ]) --}}
    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>


    <script src="{{ asset('/marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/app.js') }}"></script>


    {{-- <script>
        $(document).ready(function () {
            $(document).foundation();
            $('.comparison tr td:nth-child(3)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('online');
            });
            $('.comparison tr td:nth-child(4)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('books');
            });
            $('.comparison tr td:nth-child(5)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('private');
            });
        })
    </script> --}}
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
