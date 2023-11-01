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
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30DD2-share-image.jpg">
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
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "30-Day Drummer",
                "fullPrice" => floatval($productPrices['30-day-drummer-2']->price),
                "price" => floatval($productPrices['30-day-drummer-2']->discounted_price),
                "noBreadcrumb" => true
            ])

 <!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30_day_drummer_logo.png',
    'logoAlt' => '30 day drummer logo',
    'rotatingText' => ['Learn the drums', 'Improve your timing', 'Boost your creativity'],
    'subtitle' => 'with daily guided workouts.',
    'checklist' => ['Improve Your Skills', 'Drum Every Day', 'Learn By Doing'],
    'brandTitle' => 'drumeo',
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/header-left-collage.png',
    'video' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/video-reel.mp4',
    'buttonText' => 'GET STARTED',
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'drummers'
])

 <!-- Lessons Section -->
@php
$lessons = ['Day 1 (Your First Drum Beat - Lesson & W...', 'Your First Drum Beat - Workout 2', 'Your First Drum Beat - Workout 3', 'Your First Drum Beat - Workout 4', 'Your First Drum Beat - Workout 5', 'Your First Drum Beat - Workout 6', 'Your First Drum Beat - Workout 7', 'Your First Drum Beat - Workout 8', 'Your First Drum Beat - Workout 9', 'Your First Drum Beat - Workout 10'];

$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://i.vimeocdn.com/video/1708757353-79d71daade4ab3ad8e9972901dcc2f0ec7622e92750c30791c3aa0b61b19a8ca-d?mw=1000&mh=1000&q=70',
        'dataOpen' => 'kick-off',
        'videoId' => 850695588,
    ],
    [
        'title' => 'Setup',
        'posterImage' => 'https://i.vimeocdn.com/video/1708754455-64e0e1a12f933556fcfa50092c4215e3dc1450b33734d888f85c8b2bf861df09-d?mw=1000&mh=1000&q=70',
        'dataOpen' => 'setup',
        'videoId' => 852833927
    ],
];
@endphp

@foreach ($features as $feature)
    @include('drumeo.sales.partials._video-modal', [
        'modalId' => $feature['dataOpen'],
        'video' => '//player.vimeo.com/video/' . $feature['videoId'],
        'title' => $feature['dataOpen'],
    ])
@endforeach


@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Learn the drums by actually playing the drums.',
    'descriptionDesktop' => '30-Day Drummer is a NEW way to learn the drums – where you learn by actually playing the drums. By focusing on timing & coordination, you’ll build your skills over thirty days following daily guided workouts with your instructor, Domino Santantonio.',
    'descriptionBold' => 'And the best part is you only need 10 minutes per day.',
    'descriptionMobile' => 'Welcome to 30-Day Drummer! At this point, you should have all the equipment you need to get started, know how to set up your gear, and be ready to have some fun playing the drums with Domino. In this first lesson and 10-minute workout, she will teach you the beginnings of the most popular drum beat of all time. And you will have fun doing it!',
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Domino Santantonio',
    'course' => ' 30 video lessons',
    'lessons' => $lessons,
])

<!-- Songs subsection -->
@include('drumeo.products.partials.evergreen._dropdown', [
    'bgClass' => 'bg-slate-900',
    'songItems' => $drumeo['practiceItems']])


 <!-- What you will learn section-->
@php
$items = [
            'Daily guided drum workouts ',
            'Weekly LIVE Q&A workshops',
            'Flexible weekly schedule',
            'Ongoing motivation & support',
            'Guaranteed results'
        ]
@endphp

<!-- Get started-->
@include('drumeo.products.partials.evergreen._get-started', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30_day_drummer_logo.png',
    'items' => $items,
    'buttonText' => 'GET STARTED',
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'drummers'])

 <!-- Meet your teacher section -->
<section class="teacher-block text-center sm:px-6 md:px-5 pt-10 sm:py-10 sm:py-14 lg:py-20 bg-white">

    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
            <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/coach-image.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 130%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>

            <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
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

 <!-- Learn the drum section -->
@php
$points = [
            'Guided drum lessons for 30 days.',
            'Practice the right things for 10 min/day.',
            'Learn on your own schedule.',
            'Play your favorite songs.',
            '90-day money-back guarantee.'
        ]
@endphp

@include('drumeo.products.partials.evergreen._learn', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/30_day_drummer_logo.png',
    'logoAlt' => '30DD logo',
    'title' => 'Learn the drums with daily guided workouts.',
    'points' => $points,
    'buttonTxt' => 'Get Started',
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png',
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/order-collage.png',
    'students' => 'drummers',
    'numStudents' => number_format($nPackOwners ?? 0),
])

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2 class="text-2xl font-extrabold md:text-4xl leading-relaxed md:leading-10" >Still Have Questions?</h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @if(is_current_user_a_member())
                    @include('_partials.components.question-dropdown', [
                    "num" => "?",
                    "title" => "Why do I need to register if I get it for free as a member?",
                    "desc" => "It’s a 30-day course and it only works if you’re actively participating. So we wanted to make sure you raised your hand to enroll in the journey.<br><br>This isn’t a “watch a lesson, go do something else for 10 days, watch another” type of routine. So we’re asking for a commitment from anybody who participates.",
                    ])
                @endif
                @include('_partials.components.question-dropdown', [
                "title" => "Do I need to attend the lessons live?",
                "desc" => "The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are totally optional, and they’ll also include a recording that you can watch or re-watch anytime.",
                'num' => '?'
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "How much time per week will this course require?",
                "desc" => "30-Day Drummer gives you guided daily drum workouts for thirty days – with flex days built in for when life happens. With each workout being 10-15 minutes, you can miss a workout and make it up the next day or later in the week.",
                'num' => '?'
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "30-Day Drummer is available on your laptop, tablet, or phone. You’ll also have access through the Musora app after you’ve completed your purchase of the course.",
                'num' => '?'
                ])
            </div>
            <div class="inline-block w-full px-3 md:px-4 my-5" style="color:#2a2f34;">
                <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 mb-10" style="color:#2a2f34;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    @component('_partials.components.modal', ['name' => 'waitlistModal'])
        @slot('content')
            <div class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
                <p class="mb-4">Enter your email below to get notified when the <br class="hidden sm:inline">
                    next edition of 30-Day Drummer is announced. </p>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                    "formName" => '30 Day Chops Waitlist',
                    "formId" => "Drumeo - Engagement - Trigger - 30 Day Chops Waitlist - Web Form",
                    "buttonText" => "Let Me Know ",
                    "stacked" => true,
                    "noSocial" => true,
                ])
            </div>
        @endslot
    @endcomponent

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/852777053?h=87d3e7a97a&autoplay=1',
        "title" => 'trailer'
    ])

    

    @include("drumeo.sales.partials._footer")

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-09-04 00:00:00',
        'promoVersion' => false
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


    <script>
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
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
