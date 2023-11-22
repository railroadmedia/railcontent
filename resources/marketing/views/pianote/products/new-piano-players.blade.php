@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>New Piano Players Start Here | Pianote</title>
    <meta property="og:title" content="New Piano Players Start Here | Pianote">
    <meta name="description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">
    <meta property="og:description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/new-piano-players/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
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
         @media (max-width: 638px) {
            .dropdown-box {
            background: linear-gradient(180deg, #00101D 0%, rgba(0, 16, 29, 0) 100%);
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
    @include('pianote._partials._promo-banner', [
        "name" => "New Piano Players Start Here",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price),
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
        "noBreadcrumb" => true
    ])

        @php
            $price = floatval($productPrices['new-piano-players-start-here']->price);
            $discountedPrice = floatval($productPrices['new-piano-players-start-here']->discounted_price);
            $enrollmentLink = 'https://www.pianote.com/choose-plan';
            $brandTitle = 'Pianote';
            $buttonText = 'GET STARTED';
            $buttonLink = "/ecommerce/add-to-cart?products[new-piano-players-start-here]=1&redirect=/order&locked=true";
            $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png';
            $numStudents =  number_format($nPackOwners ?? 0);
            $students = 'piano players';
        @endphp


<!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/new-piano-players/new-piano-players-logo.png',
    'logoAlt' => '30 day new piano players logo',
    'rotatingText' => ['Sound beautiful', 'Learn the piano', 'Play real songs'],
    'subtitle' => 'in just 30 days.',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'No Theory Required'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/header-left-collage.png',
    'mediaSource' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/header-image.png',
])

<!-- Lessons Section -->
@php

$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/kick-off-new-players.jpg',
        'videoId' => 797858259,
    ],

];

$lessons = [
    [
        'title' => 'Quick-Start Guide To The Piano',
        'description' => "Before we begin, we'll show you the note names and how to sit at the piano correctly. You've got this!"
    ],
    [
        'title' => 'Your First Chord Progression',
        'description' => "In week 1, you'll learn your first chord progression from start to finish and build your confidence through 1 lesson, 5 workouts, and a pre-recorded Q&A."
    ],
    [
        'title' => 'Build Real Chords',
        'description' => "In week 2, you'll learn triads and different hand movements needed to build real chords with 1 lesson, 5 workouts, and a pre-recorded Q&A. "
    ],
    [
        'title' => 'Create Beautiful Patterns',
        'description' => "In week 3, you'll learn about quarter notes and half notes and use them to create patterns through 1 lesson, 5 workouts, and a pre-recorded Q&A. "
    ],
    [
        'title' => 'Play Your First Song!',
        'description' => "In week 4, you'll pull together everything you've learned and add a few sprinkles of fancy leading into playing a song on your own!"
    ],
];
@endphp


@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Learn the piano in 30 days.',
    'description' => "Piano lessons can be super intimidating. “So many keys! All that music theory! How do I even get my hands to play at the same time?!”
    <br/> <br/>
    New Piano Players Start Here is <em>different</em>. You just sit down, press play, and follow along as Lisa guides you through a daily 10-minute lesson.
     <br/> <br/>
    No complicated theory. No need to read music. No frustration.
      <br/> <br/>
    Lisa focuses on the <em>fun</em> and gets you playing songs from day one. By the time you’re done, you’ll have a well-established piano playing habit, some very important skills, and the confidence that <strong>YES!</strong>
     <br/> <br/>
    <strong><em>You</em> can play the piano.</strong>",
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Lisa Witt',
    'course' => ' 30 Days (20 Workouts + 4 Q&As)',
    'lessons' => $lessons
])


@php
$practiceItems = [
            [
                "icon" =>
                "fa-regular fa-music",
                "title" => "Know exactly what to practice.",
                "desc" =>
                "Log in. Press play. Follow along with Lisa through a daily 10-minute guided practice session. Do that for 30 days. <em>Easy, right?</em> You’ll never wonder what you’re supposed to do: Lisa will <em>tell</em> you.",
            ],
            [
                "icon" =>
                "fa-regular fa-clock",
                "title" => "Short, focused practice sessions.",
                "desc" =>
                "Life is busy. It’s hard to juggle priorities. To help make sure you stick to your new piano habit, each short exercise includes a countdown timer so you know exactly how long you have left. That means you can comfortably shut out all distractions, focus on your playing, and make room for your own growth.",
            ],
            [
                "icon" =>
                "fa-regular fa-infinity",
                "title" => "Lifetime access.",
                "desc" =>
                "“What if I don’t finish in 30 days?” New Piano Players Start Here is yours to keep. If it takes you a little longer, that’s okay! And if you feel like revisiting the lessons or coming back to some of the exercises, you can do that, too. You keep the course for life.",
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
            '90 day money-back guarantee.',
        ]
@endphp

<!-- Get started-->
@include('drumeo.products.partials.evergreen._get-started', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/logo-new-piano-players-2.png',
    'items' => $items,
])

 <!-- Meet your teacher section -->

   <section class="text-center sm:px-6 pt-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto sm:mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                    <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/profile-pic.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/profile-pic.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">

                </div>

                    <div class="text-white text-left z-10 sm:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 sm:max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">

                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">Lisa Witt might just be the happiest piano teacher on the
                        internet.
                        <br><br>
                        With 20 years of teaching experience, her online lessons have helped millions of students around the
                        world.
                        <br><br>
                        But her true magic lies in her empathy and understanding of what it’s like to be a new piano player.
                        She knows how it feels to struggle and she’ll show you how to overcome those challenges and approach
                        the piano in a way that’s motivating, inspiring, and most of all - FUN!
                        Start your piano journey with Lisa today.

                    </p>
                    <br />
                    <img class="float-right h-12 transition-all opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/lisa-witt-signature.png"
                        alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>
        </div>
    </section>
@php
                    $testimonials = [
                        [
                        'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
                        'comment' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created. I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
                        'name' => 'Jess Ripley',
                        ],
                        [
                        'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
                        'comment' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on. I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                        'name' => 'Serena Dorward',
                        ],
                        [
                        'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
                        'comment' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals. During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing. I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
                        'name' => 'Jayde McIntosh',
                        ],
                        [
                        'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
                        'comment' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                        'name' => 'Ian Kershaw',
                        ],
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
        'description' => 'New Piano Players Start Here  works. By focusing on playing with real music right from day one, you’ll learn the skills to play hundreds of songs on the piano in just thirty days. Check out what students are saying:',
        'showBottom' => true,
])


    <section class="text-white text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>The guarantee that lasts<br> longer than the course.</strong></h2>
            <p class="leading-normal mx-auto" style="max-width:540px">New Piano Players Start Here is all about getting you playing beautiful piano in the shortest amount of time. For less than the cost of just 2 private lessons, you’ll have a guided path to improve your playing, build your confidence, and start your journey on the piano.
                <br><br>
                You’re going to love it.
                <br><br>
                That’s why you’ll get a guarantee that’s 3X longer than the course! You’ll have 90 days to get through everything and make sure it’s right for you.
                <br><br>
                If not, simply contact our friendly support team within those 90 days for a full refund.
            </p>
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
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/new-piano-players/new-piano-players-logo.png',
    'logoAlt' => 'new piano players logo',
    'title' => 'Learn the piano <br class="md:hidden"> in just 30 days.',
    'points' => $points,
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/new-piano-players/order-collage.png',
])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '879916161',
        'vimeo' => true,
    ])

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" defer></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js" defer></script>

@stop
