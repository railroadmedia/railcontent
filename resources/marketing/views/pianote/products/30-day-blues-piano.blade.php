@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Blues Piano | Pianote</title>
    <meta property="og:title" content="30-Day Blues Piano | Pianote">
    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/30-day-blues/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
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
    </style>
    <style>
        .timeline-container .timeline:after,
        .timeline-container:after {
            background-color: #284ffd;
        }
        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }
        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color:#eb1a2f;

        }
    </style>
@stop()

@section('body-data')
    x-data ='{
        trailer : false,
    }'
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "30-Day Blues Piano",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price),
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
        "noBreadcrumb" => true
    ])

<!-- Header Section -->
    @include('pianote.products.partials._header-evergreen', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/30-day-blues/30-day-blues-piano-logo-blue-glow.png',
    'logoAlt' => '30 day blues logo',
    'text' => 'Learn the Blues',
    'subtitle' => 'in just 30 days',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'Perfect For Beginners'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/header-left-collage.png',
    'mediaSource' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/video-thumb-header.png',
    'buttonText' => 'GET STARTED',
    'buttonLink' => "/ecommerce/add-to-cart?product-array=30-day-blues-piano:1&redirect=/order&locked=true",
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'piano players'
])


 <!-- Lessons Section -->
@php

$totalDays = 32;
$lessons = [];

for ($day = 1; $day <= $totalDays; $day++) {
     $lessons[] = "Day " . $day;
}

$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://i.vimeocdn.com/video/1706069049-5c9a9ce3570e3622a46ed50a69adc9c95aadf315619524ec972daf689e6ad7d8-d?mw=1000&mh=1000&q=70',
        'videoId' => 851379131,
    ],
    [
        'title' => 'Blues Essentials',
        'posterImage' => 'https://i.vimeocdn.com/video/1706072524-8e70123f338ddd11d4ac00e8db3a4ba7c04bdfe4333b17a25270add04760991d-d?mw=1000&mh=1000&q=70',
        'videoId' => 851379154,
    ],
];
@endphp


@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Learn the piano by actually playing the piano.',
    'descriptionDesktop' => "Welcome to 30-Day Blues Piano! Join Kevin and jump into the world of blues piano. This is where you will gather all the knowledge that you need to build a foundation for blues, but also develop your skills in improvisation. Get ready to have some fun so you can be the blues player that you always wanted to be.",
    'descriptionMobile' => 'Welcome to 30-Day Blues Piano! Join Kevin and jump into the world of blues piano. This is where you will gather all the knowledge that you need to build a foundation for blues, but also develop your skills in improvisation. Get ready to have some fun so you can be the blues player that you always wanted to be.',
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Kevin Castro',
    'course' => ' 32 video lessons',
    'lessons' => $lessons
])

@php 
$practiceItems = [
            [
                "icon" =>
                "fa-sharp fa-regular fa-music",
                "title" => "Know exactly what to practice.",
                "desc" =>
                "30-Day Blues Piano gives you guided play-along workouts every day for thirty days. You’ll know exactly what to work on every time you sit at the piano.",
            ],
            [
                "icon" =>
                "fas fa-regular fa-clock",
                "title" => "Focused practice time.",
                "desc" =>
                "Each exercise includes a countdown timer that tells you exactly how long to practice for. This means you can turn off all distractions and focus on your playing.",
            ],
            [
                "icon" =>
                "fas fa-regular fa-infinity",
                "title" => "Lifetime access.",
                "desc" =>
                "30-Day Blues Piano can become part of your practice routine forever. You’ll have lifetime access to ALL the workouts and Q&A sessions from your class to access anytime you like.",
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
            'Daily guided Piano workouts',
            'Weekly Q&A workshops',
            'Flexible weekly schedule',
            'Ongoing motivation & support',
            'Guaranteed results'
        ]
@endphp

<!-- Get started-->
@include('drumeo.products.partials.evergreen._get-started', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/30-day-blues/30-day-blues-piano-logo-blue-glow.png',
    'items' => $items,
    'buttonText' => 'GET STARTED',
    'buttonLink' => "/ecommerce/add-to-cart?product-array=30-day-blues-piano:1&redirect=/order&locked=true",
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'piano players'])


 <!-- Meet your teacher section -->
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Kevin Castro</strong></h2>
                    <p class="leading-normal my-4 lg:my-6">Kevin Castro wouldn’t be a professional pianist without the Blues. In fact, it was a Blues improvisation that got him accepted into University.
                        <br><br>
                        Since then, he’s toured with rising stars and JUNO-Award winners (JESSIA, Elijah Woods), played at TikTok Headquarters in New York and LA, and even recorded a demo for Jennifer Lopez.
                        <br><br>
                        And whenever Kevin plays with new musicians, he always uses the Blues to jam.
                        <br><br>
                        But Kevin’s real passion comes from sharing his experience and knowledge with students.
                        <br><br>
                        And he’ll be with you at stage of this journey.
                        <br><br>
                        The Blues changed his life, and he knows it will do the same for you.
                    </p>
                    <img class="float-right h-12 sm:h-24 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/kevin-signature.png" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>
        </div>
    </section>
<!-- Testimonials section -->

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
        'title' => "Trusted by piano players everywhere.",
        'subTitle' => "Rated 5 stars by thousands by Pianote students from around the world! See the reviews ››",
        'showTop' => true,
])
    <div class="h-10 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2A2F34 calc(50% + 1px));"></div>
    <section class="text-center text-white px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#2A2F34; border: 1px solid #2A2F34">
        <div class="container max-w-3xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h3 class="my-4 sm:my-6 lg:my-8"><strong>But what if it doesn’t<br class="inline sm:hidden"> work for you?</strong></h3>
            <p class="leading-normal">You’ll be playing the Blues in just 30 days. That’s our promise.
                <br><br>
                But what if it doesn’t work?
                <br><br>
                Then you won’t have to pay. We’re so confident you’ll love the results, that you’ll have 90 days to put us to the test (even though the course only lasts for 30).
                <br><br>
                If you give it an honest try and you’re not happy (for any reason), simply let us know within 90 days for a FULL refund.</p>
        </div>
    </section>

<!-- Learn section -->
@php
$points = [
            'Guided piano lessons for 30 days.',
            'Practice the right things for 10 min/day.',
            'Learn on your own schedule.',
            'Play your favorite songs.',
            '90-day money-back guarantee.'
        ]
@endphp

@include('drumeo.products.partials.evergreen._learn', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/30-day-blues/30-day-blues-piano-logo-blue-glow.png',
    'logoAlt' => '30 day blues logo',
    'title' => 'Learn the blues by playing the blues',
    'points' => $points,
    'buttonTxt' => 'Get Started',
    'buttonLink' => "/ecommerce/add-to-cart?product-array=30-day-blues-piano:1&redirect=/order&locked=true",
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png',
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/30-day-blues/order-collage.png',
    'students' => 'piano players',
    'numStudents' => number_format($nPackOwners ?? 0),
])
    
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '852795615',
        'vimeo' => true,
    ])


    {{-- @include('_partials.components.countdown',[
        'countdownDate' => '2023-09-01 00:00:00',
        'promoVersion' => false
    ]) --}}

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

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
        })
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
