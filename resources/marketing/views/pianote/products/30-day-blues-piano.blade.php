@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
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
            font-family: 'Bebas Neue', sans-serif;
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
            font:700 30px/1em "Bebas Neue", sans-serif;
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
         @media (max-width: 638px) {
            .dropdown-box {
            background: linear-gradient(180deg, #00101D 0%, rgba(0, 16, 29, 0) 100%);
            }
        }
         .container-video {
    background: linear-gradient(3deg, white 50%, #EFF7FF 50%);
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
        testimonial: false,
    }'
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
        "name" => "30-Day Blues Piano",
        "fullPrice" => floatval($productPrices['30-day-blues-piano']->price),
        "price" => floatval($productPrices['30-day-blues-piano']->discounted_price),
        "noBreadcrumb" => true
    ])


        @php
            $price = floatval($productPrices['30-day-blues-piano']->price);
            $discountedPrice = floatval($productPrices['30-day-blues-piano']->discounted_price);
            $enrollmentLink = 'https://www.pianote.com/choose-plan';
            $brandTitle = 'Pianote';
            $buttonText = 'GET STARTED';
            $buttonLink = "/ecommerce/add-to-cart?products[30-day-blues-piano]=1";
            $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/products/30-day-blues/piano-players-trusted.png';
            $numStudents =  number_format($nPackOwners ?? 0);
            $students = 'piano players';
        @endphp

<!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/30-day-blues/30-day-blues-piano-logo-blue-glow.png',
    'logoAlt' => '30 day blues logo',
    'text' => 'Learn the Blues',
    'subtitle' => 'in just 30 days',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'Perfect For Beginners'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/header-left-collage.png',
    'mediaSource' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/video-thumb-header.png',
    'extraClass' => 'h-20 sm:h-24 lg:h-32',
])


 <!-- Lessons Section -->
@php

$lessons = [
        [
        'title' => 'Blues Essentials',
        'description' => "Before the course starts, Kevin shares some essential advice that will prepare you for success."
],
    [
        'title' => 'Blues Foundations',
        'description' => "In week 1, you'll dive into the 12-bar blues, develop rhythm, and get both hands playing with 5 workouts and a pre-recorded Q&A."
    ],
    [
        'title' => 'Building Confidence & Adding Scales',
        'description' => "In week 2, you'll build confidence with the blues progression and rhythm through 5 workouts and a pre-recorded Q&A."
    ],
    [
        'title' => 'Blues Riffs & Fills',
        'description' => "In week 3, you'll learn simple riffs alongside iconic riffs and fills through 5 workouts and a pre-recorded Q&A."
    ],
    [
        'title' => 'Storytelling With Solos',
        'description' => "In week 4, everything you've learned will be brought together and you'll craft your story for your very own blues piano solo!"
    ],
];

$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/kick-off-30-day-blues.jpg',
        'videoId' => 851379131,
    ]
];
@endphp


@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Learn the Blues by PLAYING the Blues.',
    'description' => "The Blues is <em>everywhere</em>. At least one of your favorite songs can be traced back to the Blues. Probably way <em>more</em> than one.
                        <br><br>
                        But the Blues is IMPOSSIBLE to learn, right? After all, there’s so much improvisation! How do you learn to make stuff up? Don’t you need to be <em>gifted</em>?
                        <br><br>
                        No way! All you need is a great teacher.
                        <br><br>
                        Give teacher Kevin Castro 30 days, and he’ll give you the essential skills you need to confidently play the Blues on your piano. In just 10 minutes a day, you’ll learn everything from the basic Blues structure and the most important scale, through to the Blues riffs and fills you’ll use to tell a musical story in the final week.
                        <br><br>
                        It’s all here. Let’s get bluesy!",
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Kevin Castro',
    'course' => ' 30 Days (20 Workouts + 4 Q&As)',
    'lessons' => $lessons
])

@php
$practiceItems = [
            [
                "icon" =>
                "fa-regular fa-music",
                "title" => "The PERFECT lesson, every time.",
                "desc" =>
                "Your job is simple: sit down to play. Kevin’s got your lesson and practice ready — all you need to do is follow along! Start where you are, be thrilled with where you end up.",
            ],
            [
                "icon" =>
                "fa-regular fa-clock",
                "title" => "Stop wasting time.",
                "desc" =>
                "Your time is precious. So is your desire to learn something new. That’s why every lesson is only 10 minutes long and includes a handy countdown timer. Get better results in less time with greater focus.",
            ],
            [
                "icon" =>
                "fa-regular fa-infinity",
                "title" => "Lifetime access.",
                "desc" =>
                "Oh no! You didn’t finish 30-Day Blues Piano in 30 days! Don’t worry. The course is yours for life. And that’s important, because learning should happen on your time. So whether you need a few extra weeks, or just want to revisit the course to focus on different skills, 30-Day Blues Piano will be there for you. For life.
",
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

<!-- Get started with video section-->
<section class="text-center bg-blue-50">
    <div class="container max-w-4xl mx-auto px-6 pt-6">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center pb-4">
            <img class="h-32 md:h-64 lg:h-72 py-4 lazyload p-2"
                data-src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/30-day-blues-piano-logo-blue-glow.png"
                alt="logo">
            <ul class="pl-6">
                @foreach ($items as $item)
                    <li>
                        <h4 class="leading-loose text-left"><i
                                class="fas fa-sharp fa-solid fa-circle-check text-{{ $brand }} mr-5"
                                aria-hidden="true"></i>{{ $item }}</h4>
                    </li>
                @endforeach
            </ul>
        </div>
        {{-- <a href={{$buttonLink}} class="join blue medium w-full sm:w-1/2 md:w-1/3 lg:w-3/5 mt-6 sm:mt-12 mb-3 anchor-slide" role="button">{{$buttonText}}</a><br> --}}
        <div class="w-full flex flex-col items-center">
            <div class="w-full sm:w-1/2 md:w-1/3">
                @include('drumeo.products.partials.evergreen._button', [
                    'link' => $buttonLink,
                    'buttonClass' => 'text-white font-bebas tracking-widest',
                    'buttonText' => $buttonText,
                ])
            </div>
            {{-- <div class="flex flex-row items-center py-2">
                     @if ($numStudents > 500)
                    <img class="h-7 mr-2 lazyload" alt="Joined Student Profiles" data-src={{ $studentProfilesImage }}>
                    <span class="inline-block align-middle leading-tight text-xs">Join
                        {{ $numStudents }} {{ $students }} who<br> have already registered.
                    </span>
                    @endif
                </div> --}}
        </div>
        @include('drumeo.products.partials.evergreen._price-link', [
            'price' => $price,
            'enrollmentLink' => $enrollmentLink,
            'brandTitle' => $brandTitle,
        ])
    </div>
</section>

<section class="container-video">
    <div class="container max-w-4xl mx-auto flex flex-col items-center md:pt-10 text-center px-6">
        <h2 class="py-2"><strong>You’ll sound like THIS after 30 days…</strong></h2>
        <p class="pb-2 md:pb-4">Hear what REAL 30-Day Blues Piano students sound like after completing the course:
        </p>
        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
            x-on:click="testimonial = true;" role="button">
            <i
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>


            <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/testimonial-video-thumb.png"
                alt="testimonial image" fetchpriority="high" />

        </div>
        <p class="py-2 md:py-6">Ready to sound this good?</p>

        <div class="w-full sm:w-1/2 md:w-1/3">
            @include('drumeo.products.partials.evergreen._button', [
                'link' => $buttonLink,
                'buttonClass' => 'text-white font-bebas tracking-widest',
                'buttonText' => $buttonText,
            ])
        </div>
    </div>
</section>


 <!-- Meet your teacher section -->
    <section class="text-center sm:px-6 pt-10 sm:pt-14 lg:pt-20 sm:pb-32 lg:pb-40">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/coach-profile-m.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/30-day-blues/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 sm:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 sm:max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
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
                    'count' => number_format(Prices::$pianoteYoutubeSubsc),
                    'countLabel' => 'Subscribers',
                ],
                [
                    'url' => 'https://facebook.com/pianoteofficial/',
                    'label' => 'facebook',
                    'iconClass' => 'fab fa-facebook-f',
                    'count' => number_format(Prices::$pianoteFacebookLikes),
                    'countLabel' => 'Likes',
                ],
                [
                    'url' => 'https://instagram.com/pianoteofficial/',
                    'label' => 'instagram',
                    'iconClass' => 'fab fa-instagram',
                    'count' => number_format(Prices::$pianoteInstagramFollowers),
                    'countLabel' => 'Followers',
                ],
            ],
        'bgColor' => 'linear-gradient(rgba(246, 26, 48, 1), rgba(161, 0, 0, 1))',
        'title' => "Trusted by piano players everywhere.",
        'subTitle' => "Rated 5 stars by thousands by Pianote students from around the world! See the reviews ››",
        'showTop' => true,
])
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2A2F34 calc(50% + 1px));"></div>
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
            '20 guided play-along lessons.',
            'Lifetime access to watch & re-watch.',
            '90-day money-back guarantee.'
        ]
@endphp

@include('drumeo.products.partials.evergreen._learn', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/30-day-blues/30-day-blues-piano-logo-blue-glow.png',
    'logoAlt' => '30 day blues logo',
    'title' => 'Learn the blues <br class="md:hidden"> by playing the blues',
    'points' => $points,
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/30-day-blues/order-collage.png',
])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '879913986',
        'vimeo' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'testimonial',
        'video' => '884499141',
        'vimeo' => true,
    ])


    {{-- @include('_partials.components.countdown',[
        'countdownDate' => '2023-09-01 00:00:00',
        'promoVersion' => false
    ]) --}}

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>


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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" defer></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js" defer></script>

@stop
