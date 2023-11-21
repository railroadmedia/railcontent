@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Drummer | Drumeo</title>
    <meta property="og:title" content="30-Day Drummer | Drumeo">
    <meta name="description" content="Learn the drums with daily guided workouts.">
    <meta property="og:description" content="Learn the drums with daily guided workouts.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30DD2-share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
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
            background: #0b76db;
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
            background: #258ff4;
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
            color:#0b76db
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

        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }
        .splide__arrow svg{
            fill: #0B76DB !important;
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
            background: linear-gradient(rgba(10, 31, 52, 1), rgba(10, 31, 52, 0));
            }
        }
    </style>
    <?php \App\Analytics\Tracker::trackProductImpression('30-day-drummer-2'); ?>
@stop()

@section('body-data')
    x-data="{
    waitlistModal: false,
    trailer: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "30-Day Drummer",
                "fullPrice" => floatval($productPrices['30-day-drummer-3']->price),
                "price" => floatval($productPrices['30-day-drummer-3']->discounted_price),
                "noBreadcrumb" => true
            ])

    @php
            $price = floatval($productPrices['30-day-drummer-3']->price);
            $discountedPrice = floatval($productPrices['30-day-drummer-3']->discounted_price);
            $enrollmentLink = 'https://www.drumeo.com/choose-plan';
            $brandTitle = 'Drumeo';
            $buttonText = 'GET STARTED';
            $buttonLink = "/ecommerce/add-to-cart?products[30-day-drummer-3]=1&redirect=/order&locked=true";
            $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png';
            $numStudents =  number_format($nPackOwners ?? 0);
            $students = 'drummers';
    @endphp

 <!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/marketing/drumeo/products/30-day-drummer/30DayDrummerSeason3-Logo-10.png',
    'logoAlt' => '30 day drummer logo',
    'rotatingText' => ['Learn the drums', 'Improve your timing', 'Boost your creativity'],
    'subtitle' => 'with daily guided workouts.',
    'checklist' => ['Improve Your Skills', 'Drum Every Day', 'Learn By Doing'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/header-left-collage.png',
    'isVideo' => true,
    'mediaSource' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/video-reel.mp4',

])

 <!-- Lessons Section -->
@php

$lessons = [
    [
        'title' => 'Course Setup',
        'description' => 'Get ready for the course with ANY setup including an acoustic kit, electronic kit, practice pad... or even pillows!',
    ],
    [
        'title' => 'Your First Drum Beat',
        'description' => "In week 1, you'll learn the beginnings of the most popular drum beat of all-time through 1 lesson, 5 workouts, and 1 pre-recorded Q&A."
    ],
    [
        'title' => 'Doubling It Up',
        'description' => "In week 2, you'll learn how to double what your right hand is playing with 1 lesson, 5 workouts, and 1 pre-recorded Q&A."
    ],
    [
        'title' => 'Adding Fills & Crashes',
        'description' => "In week 3, you'll learn how to add a crash cymbal to your groove PLUS play your first drum fill with 1 lesson, 5 workouts, and 1 pre-recorded Q&A. "
    ],
    [
        'title' => 'Play Your First Song!',
        'description' => "In week 4, you'll learn to play your first song by assembling all the parts you've learned so far -- playing the verse, chorus, bridge, and finally the full track!"
    ],
];


$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/kick-off-30d-drummer.jpeg',
        'videoId' => 738756003, //850695588
    ],
];
@endphp

@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Learn the drums by actually playing the drums.',
    'description' => '30-Day Drummer is a NEW way to learn the drums – where you learn by actually playing the drums. By focusing on timing & coordination, you’ll build your skills over thirty days following daily guided workouts with your instructor, Domino Santantonio. <strong>And the best part is you only need 10 minutes per day.</strong>',
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Domino Santantonio',
    'course' => ' 30 Days (20 Workouts + 4 Q&As)',
    'lessons' => $lessons
])

@php
$practiceItems = [
            [
                "icon" =>
                "fa-sharp fa-regular fa-music",
                "title" => "Know exactly what to practice.",
                "desc" =>
                "30-Day Drummer gives you guided play-along workouts every day for 30 days. You’ll know exactly what to work on every time you sit at the drums or practice pad.",
            ],
            [
                "icon" =>
                "fas fa-regular fa-clock",
                "title" => "Focused practice time.",
                "desc" =>
                "Each exercise includes a countdown timer that tells you exactly how long to practice for. This means you can turn off all distractions and focus on your drumming.",
            ],
            [
                "icon" =>
                "fas fa-regular fa-infinity",
                "title" => "Lifetime access.",
                "desc" =>
                "30-Day Drummer can become part of your practice routine forever. You’ll have lifetime access to ALL the workouts and Q&A sessions from your class anytime you like.",
            ],
            ]
@endphp

<!-- Songs subsection -->
@include('drumeo.products.partials.evergreen._dropdown', [
    'bgClass' => 'bg-slate-900',
    'songItems' => $drumeo['practiceItems']])


 <!-- What you will learn section-->
@php
$items = [
            '20 guided play-along lessons. ',
            'Lifetime access to watch & re-watch.',
            '90 day money-back guarantee.',
        ]
@endphp

<!-- Get started-->
@include('drumeo.products.partials.evergreen._get-started', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30DayDrummerSeason3-Logo-10.png',
    'items' => $items,
   ])

 <!-- Meet your teacher section -->
<section class="teacher-block text-center sm:px-6 md:px-5 pt-10 sm:py-10 sm:py-14 lg:py-20 bg-white">

    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
            <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 130%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>

            <div class="text-white text-left z-10 sm:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 sm:max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                <h2 class="text-center sm:text-left"><strong>Domino Santantonio</strong></h2>
                <h6 class="leading-normal mt-4 lg:mt-6">Domino Santantonio is one of the world’s most viewed drummers.
                    <br><br>
                    And she’s achieved this with her engaging & supportive style of drumming – always smiling and reminding you why playing the drums is so fun & healthy. Who better to jumpstart your drumming progress?
                    <br><br>
                    Plus, Domino is also your personal guide through the course.
                    <br><br>
                    At the end of every week, you’ll have a Q&A session with Domino where you can ask her any questions you had during the lessons.
                </h6>
                <div class="flex justify-between text-center mt-7 lg:mt-10">
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                        <h3 class="mt-2"><strong>1.6M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                        <h3 class="mt-2"><strong>19M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">views</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                        <h3 class="mt-2"><strong>461k</strong></h3>
                        <p class="uppercase opacity-70 text-sm">followers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <!-- Testimonials section -->
@php
$testimonials = $drumeo['testimonialsShopVersion'];
$students = '30-Day Drummer Student'
@endphp

@include('drumeo.products.partials.evergreen._testimonials', [
    'socialIcons' => [
                [
                    'url' => 'https://www.youtube.com/freedrumlessons/',
                    'label' => 'youtube',
                    'iconClass' => 'fab fa-youtube',
                    'count' => '3,300,000',
                    'countLabel' => 'Subscribers',
                ],
                [
                    'url' => 'https://facebook.com/drumeo/',
                    'label' => 'facebook',
                    'iconClass' => 'fab fa-facebook-f',
                    'count' => '1,120,000',
                    'countLabel' => 'Likes',
                ],
                [
                    'url' => 'https://instagram.com/drumeoofficial/',
                    'label' => 'instagram',
                    'iconClass' => 'fab fa-instagram',
                    'count' => '1,400,000',
                    'countLabel' => 'Followers',
                ],
            ],
        'bgColor' => 'linear-gradient(rgba(11, 118, 219, 1), rgba(7, 74, 137, 1))',
        'title' => "Trusted by drummers everywhere.",
        'showBottom' => true,
        'subHeader' => '17,000+ Drummers Agree...',
        'description' => '30-Day Drummer works. By focusing on playing with real music right from day one, you’ll learn the skills to play hundreds of songs on the drums in just thirty days. Check out what students are saying:',
])

<!-- End of Testimonials section -->

<!-- Guarantee section -->
<div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
    style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
</div>
<section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20"
    style="background-color:#2a2f34; border: 1px solid #2a2f34">
    <div class="container max-w-4xl mx-auto">
        <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload"
            data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png"
            alt="guarantee badge">
        <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                guaranteed.</strong></h2>

        <h6 class="leading-normal">30-Day Drummer is a NEW way to learn the drums – and for less than a month of private
            lessons, you’ll enjoy frustration-free progress to improve your timing, coordination, and musicality.
            <br><br>
            We think it’ll be your favorite drum course ever –
            <br><br>
            So even though it’s only a month, you’ll get three full months to go through everything and make sure it was
            right for you. If not, just contact our friendly support team for a full refund.
        </h6>

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
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30DayDrummerSeason3-Logo-10.png',
    'logoAlt' => '30 day drummer logo',
    'title' => 'Learn the drums with <br class="md:hidden"> daily guided workouts.',
    'points' => $points,
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/order-collage.png',
])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '884916532',
        'vimeo' => true,
    ])

    @include("drumeo.sales.partials._footer")

    {{-- @include('_partials.components.countdown',[
        'countdownDate' => '2023-09-04 00:00:00',
        'promoVersion' => false
    ]) --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
