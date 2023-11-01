@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Chops | Drumeo</title>
    <meta property="og:title" content="30-Day Chops | Drumeo">
    <meta name="description" content="Learn drum chops with daily guided workouts.">
    <meta property="og:description" content="Learn drum chops with daily guided workouts.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/share-image2.jpg">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
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
                "name" => "30-Day Chops",
                "fullPrice" => floatval($productPrices['30-day-drummer-2']->price),
                "price" => floatval($productPrices['30-day-drummer-2']->discounted_price),
                "noBreadcrumb" => true
            ])

    
     <!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/logo.svg',
    'logoAlt' => '30 day chops logo',
    'rotatingText' => ['Learn drum chops', 'Improve your speed', 'Boost your creativity'],
    'subtitle' => 'in just 30 days',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'Guaranteed Results'],
    'brandTitle' => 'drumeo',
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/header-left-collage.png',
    'video' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/30dc.mp4',
    'buttonText' => 'GET STARTED',
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'drummers'
])

 <!-- Lessons Section -->
@php

$totalDays = 29;
$lessons = [];

for ($day = 1; $day <= $totalDays; $day++) {
     $lessons[] = "Day " . $day;
}

$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/drum-challenges.jpeg',
        'dataOpen' => 'kick-off',
        'videoId' => 823873211,
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
    'descriptionDesktop' => "We've all gazed in amazement at the incredible chops some of the best drummers in the world are capable of pulling off. Whether on social media or on stage, their facility is undeniable and something we just can't help marveling at. Ready to be the drummer people marvel at? Welcome to 30-Day Chops!",
    'descriptionMobile' => 'Welcome to 30-Day Drummer! At this point, you should have all the equipment you need to get started, know how to set up your gear, and be ready to have some fun playing the drums with Domino. In this first lesson and 10-minute workout, she will teach you the beginnings of the most popular drum beat of all time. And you will have fun doing it!',
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Zack Grooves',
    'course' => ' 29 video lessons',
    'lessons' => $lessons,
])

@php 
$practiceItems = [
            [
                "icon" =>
                "fa-sharp fa-regular fa-music",
                "title" => "Know exactly what to practice.",
                "desc" =>
                "30-Day Chops gives you guided play-along workouts every day for thirty days. You’ll know exactly what to work on every time you sit at the drums or practice pad.",
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
                "30-Day Chops can become part of your practice routine forever. You’ll have lifetime access to ALL the workouts and Q&A sessions from your class to access anytime you like.",
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
            'Daily guided drum workouts ',
            'Weekly Q&A workshops',
            'Flexible weekly schedule',
            'Ongoing motivation & support',
            'Guaranteed results'
        ]
@endphp

<!-- Get started-->
@include('drumeo.products.partials.evergreen._get-started', [
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/logo.svg',
    'items' => $items,
    'buttonText' => 'GET STARTED',
    'studentProfilesImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png',
    'numStudents' =>  number_format($nPackOwners ?? 0),
    'students' => 'drummers'])

 <!-- Meet your teacher section -->
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-profile2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Zack Graybeal<br> (aka “ZackGrooves”)</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Zack lives at the intersection of grooves and chops.
                        <br><br>
                        He’s built a passionate community of drummers on YouTube with his hilarious videos and stunning performances. His innovative playing style has inspired millions of drummers to apply chops in a musical & groove-oriented way.
                        <br><br>
                        Zack has created the exercises for this course alongside Drumeo to help YOU build your own tasty drum chops.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-7 sm:h-9" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drumeo-awards-logo.png" alt="tiktok icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <h3 class="mt-2"><strong>2x</strong></h3>
                            <p class="uppercase opacity-70 text-sm leading-tight">Drumeo Awards<br> Nominee</p>
                        </div>
                        <div class="">
                            <img class="h-7 sm:h-9" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <h3 class="mt-2"><strong>49M</strong></h3>
                            <p class="uppercase opacity-70 text-sm leading-tight">views</p>
                        </div>
                        <div class="">
                            <img class="h-7 sm:h-9" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                            <h3 class="mt-2"><strong>104k</strong></h3>
                            <p class="uppercase opacity-70 text-sm leading-tight">followers</p>
                        </div>
                    </div>
                </div>
            </div>
                <a
                   href="#final"
                   class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">GET STARTED</a><br> 

            <img class="h-7 mr-1 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/drummers.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} drummers who<br> have already registered.</p>
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
        'showTop' => true,
        'subHeader' => '17,000+ Drummers Agree...',
        'description' => '30-Day Drummer works. By focusing on playing with real music right from day one, you’ll learn the skills to play hundreds of songs on the drums in just thirty days. Check out what students are saying:',
])


    

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=410,quality=85/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course, guaranteed.</strong></h2>

            <h6 class="leading-normal">30-Day Chops is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
                <br><br>
                We think it’ll be your favorite drum course ever –
                <br><br>
                So even though it’s only a month, you’ll get three full months to go through everything and make sure it was right for you. If not, just contact our friendly support team for a full refund.</h6>

        </div>
    </section>
    

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Do I need to attend the lessons live?",
            "desc" => "The weekday workouts are pre-recorded videos you can access on your own schedule – and the weekly live Q&A sessions are optional. Plus, you’ll be sent a recording so you can watch anytime.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "What if I’m going to miss a day (or two, or more)?",
            "desc" => "That’s totally fine. The course is meant to be flexible – there are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session to catch up.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "How much time per week will this course require?",
            "desc" => "30-Day Chops gives you guided daily chop workouts for thirty days. The minimum time required adds up to 60 minutes per week – but you can spend 2+ hours or more including the live session if you’re feeling motivated.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Does it work on acoustic AND electronic drums?",
            "desc" => "Yes. 30-Day Chops is built for the intermediate-to-advanced drummer looking to improve their skills. You can complete all Zack’s exercises on either acoustic or electronic and see the full effects on your playing.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Is this a continuation of 30-Day Drummer?",
            "desc" => "Not exactly. 30-Day Drummer was our first-ever thirty day cohort designed to help beginners establish a solid groove. 30-Day Chops moves on to complex linear patterns around the kit. It’s very possible for an ambitious beginner to work through it – but the curriculums are not related.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "What devices can I access the course on?",
            "desc" => "30-Day Chops is available on your laptop, tablet, or phone. You’ll also have access through the Musora app after you’ve completed your purchase online.",
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
                    next edition of 30-Day Chops is announced. </p>
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
"video" => '//player.vimeo.com/video/825206369?h=e8d828248a&autoplay=1',
"title" => 'trailer'
])
@include('drumeo.sales.partials._video-modal',[
'modalId' => "aaron",
"video" => '//player.vimeo.com/video/823878266?h=c6a0279ff5&autoplay=1',
"title" => 'aaron'
])
@include('drumeo.sales.partials._video-modal',[
'modalId' => "anika",
"video" => '//player.vimeo.com/video/823878240?h=9d697640d7&autoplay=1',
"title" => 'anika'
])
@include('drumeo.sales.partials._video-modal',[
'modalId' => "larnell",
"video" => '//player.vimeo.com/video/823878300?h=dec74dc718&autoplay=1',
"title" => 'larnell'
])

@include('_partials.components.countdown',[
'countdownDate' => '2023-06-05 00:00:00',
'promoVersion' => false
])

    @include("drumeo.sales.partials._footer")

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

            @if(!empty($errors) && $errors->any())
                $('#waitlistModal').foundation('open');
            @endif
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
