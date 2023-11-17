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
    trailer: false,
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

    @php
    $price = floatval($productPrices['30-day-chops']->price);
    $discountedPrice = floatval($productPrices['30-day-chops']->discounted_price);
    $buttonText = 'GET STARTED';
    $buttonLink = "/ecommerce/add-to-cart?products[30-day-chops]=1&redirect=/order";
    $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png';
    $numStudents =  number_format($nPackOwners ?? 0);
    $students = 'drummers';
    $enrollmentLink = 'https://www.drumeo.com/choose-plan';
    $brandTitle = 'Drumeo';
    @endphp

     <!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/logo.svg',
    'logoAlt' => '30 day chops logo',
    'rotatingText' => ['Learn drum chops', 'Improve your speed', 'Boost your creativity'],
    'subtitle' => 'in just 30 days',
    'checklist' => ['Learn By Doing', 'Play Every Day', 'Guaranteed Results'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/header-right-collage.png',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/header-left-collage.png',
    'isVideo' => true,
    'mediaSource' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/30dc.mp4',
])

 <!-- Lessons Section -->
@php


$features = [
    [
        'title' => 'Course Kick-Off',
        'posterImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/kick-off-30-day-chops.jpg',
        'videoId' => 823873211,
    ],
];

$lessons = [
    [
        'title' => 'Paradiddle Chops',
        'description' => "In week 1, you'll learn what a paradiddle is and apply it to interesting drum chops with 1 lesson, 5 workouts, and 1 pre-recorded Q&A. "
    ],
    [
        'title' => 'Doubles & Inverted Doubles',
        'description' => "In week 2, you'll learn double and inverted double strokes through 1 lesson, 5 workouts, and 1 pre-recorded Q&A."
    ],
    [
        'title' => 'Paradiddle-diddle Chops',
        'description' => "In week 3, you'll learn Zack's favorite rudiment, the paradiddle-diddle, through 1 lesson, 5 workouts, and 1 pre-recorded Q&A. "
    ],
    [
        'title' => 'Creative Combinations',
        'description' => "In week 4, you'll apply everything you've learned in a series of mastery exercises designed around making your drum chops sound amazing!"
    ],
];
@endphp

@include('drumeo.products.partials.evergreen._lessons', [
    'title' => 'Unlock your speed & creativity around the drums.',
    'description' => '<strong>This is a first:</strong> a course dedicated to teaching you tasty linear drum chops one note at a time. We’re talking blistering groove & fill chops, just like your favorite drummers. For 30 days, play along with Zack Graybeal (aka “Zack Grooves”) and gain the skills to create your own patterns around the kit.',
    'features' => $features,
    'lessonTitle' => 'Course Lessons',
    'instructor' => ' Zack Grooves',
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
                "This is <em>key</em>. No more sitting at the kit trying to figure out how to get better. It’s simple: Zack shows you what to do. You do it. Every day. For 30 days. It’s foolproof.",
            ],
            [
                "icon" =>
                "fa-regular fa-clock",
                "title" => "Fits your schedule.",
                "desc" =>
                "Family, school, work. You’ve got a life and you need to fit your practice into it. That’s why every lesson is only 10-minutes long. Get in, get out, get <strong>better</strong>.",
            ],
            [
                "icon" =>
                "fa-regular fa-infinity",
                "title" => "Lifetime access.",
                "desc" =>
                "Learning is a lifetime thing. So why should 30-Day Chops be any different? You keep the course for life: every play-along, every chart, every lesson, yours to revisit again and again as often as you want.",
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
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/logo-30d-chops-2.png',
    'items' => $items,
])

 <!-- Meet your teacher section -->
    <section class="text-center sm:px-6 pt-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=100/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-profile2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 sm:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 sm:max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
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
        'subTitle' => "Rated 5 stars by thousands by Drumeo students from around the world! See the reviews ››",
        'showTop' => true,
])

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34; border: 1px solid #2a2f34">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course, guaranteed.</strong></h2>
            <h6 class="leading-normal">30-Day Chops is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
                <br><br>
                We think it’ll be your favorite drum course ever –
                <br><br>
                So even though it’s only a month, you’ll get three full months to go through everything and make sure it was right for you. If not, just contact our friendly support team for a full refund.</h6>

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
    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/logo.svg',
    'logoAlt' => '30 day chops logo',
    'title' => 'Improve your chops <br class="md:hidden"> in just 30 days.',
    'points' => $points,
    'profileImageAlt' => 'student profile image',
    'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/30-day-chops/order-collage.png',
])

<!-- trailer for header section -->

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '884916500',
        'vimeo' => true,
    ])


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


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

            @if(!empty($errors) && $errors->any())
                $('#waitlistModal').foundation('open');
            @endif
        });
    </script> --}}
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
