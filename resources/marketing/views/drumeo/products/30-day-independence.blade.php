@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Independence | Drumeo</title>
    <meta property="og:title" content="30-Day Independence | Drumeo">
    <meta name="description" content="Improve your coordination with daily guided workouts.">
    <meta property="og:description" content="Unlock your creativity and speed around the drums.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/30-day-independence/share-image.jpg">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
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
            font:700 30px/1em "Bebas Neue", sans-serif;
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
        .splide__arrow svg {
            fill: #0B76DB;
        }
        .splide__pagination__page.is-active {
            background: #ffffff;
            opacity: 0.8;
        }
        .splide__arrow--next {
            right:-1.5em;
        }
    </style>
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
    @include('_partials.components.shop.promo-banner-2', [
                "name" => "30-Day Independence",
                "fullPrice" => floatval($productPrices['30-day-independence']->price),
                "price" => floatval($productPrices['30-day-independence']->discounted_price),
                "noBreadcrumb" => true
            ])

    @php
        $price = floatval($productPrices['30-day-independence']->price);
        $discountedPrice = floatval($productPrices['30-day-independence']->discounted_price);
        $buttonText = 'GET STARTED';
        $buttonLink = "/ecommerce/add-to-cart?products[30-day-independence]=1";
        $studentProfilesImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/Joined_profiles.png';
        $numStudents =  number_format($nPackOwners ?? 0);
        $students = 'drummers';
        $enrollmentLink = 'https://www.drumeo.com/choose-plan';
        $brandTitle = 'Drumeo';
    @endphp

        <!-- Header Section -->
    @include('drumeo.products.partials.evergreen._header', [
    'logoHeader' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp',
    'logoAlt' => '30 day Independence logo',
    'rotatingText' => ['Improve Your Coordination', 'Unlock Your Limbs', 'Boost Your Independence'],
    'subtitle' => 'with daily guided workouts.',
    'checklist' => ['Play With Real Music', 'Drum Every Day', 'Learn By Doing'],
    'bgImageRight' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/header-left-collage.webp',
    'bgImageLeft' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/header-left-collage.webp',
    'isVideo' => true,
    'mediaSource' => 'https://player.vimeo.com/progressive_redirect/playback/975466470/rendition/540p/file.mp4?loc=external&signature=f54a0f37fe3342c738f2e529f2d3d778fb92fba8f0238b62345dac334e511ca2',
    'poster' =>'https://i.vimeocdn.com/video/1889890450-a7e98719a624f12033eb2e7c924686b2eebafb71325cf5b6ef5e892675317720-d?mw=1500&mh=844&q=70',
    'alternateSrc' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/promos/summer-sale/30di_trailer_full_16x9(evergreen)+(540p).mp4',
])

    <!-- Lessons Section -->
    @php


        $features = [
            [
                'title' => 'Course Kick-Off',
                'posterImage' => 'https://d1923uyy6spedc.cloudfront.net/0-1712554313.jpg',
                'videoId' => 932525713,
            ],
        ];

        $lessons = [
            [
                'title' => 'Play The Groove',
                'description' => "Day 1 starts with the basic building blocks of the groove and by Day 5 you’ll be playing the entire groove and start playing around with orchestrations."
            ],
            [
                'title' => 'Off-Beat Training',
                'description' => "Week 2 kicks off with learning how to keep time with an off-beat hi-hat using your left foot and by Day 10 you’ll be speeding things up and start using your cymbals."
            ],
            [
                'title' => 'Speeding Things Up',
                'description' => "You are half way there! Day 11 introduces a new groove to start testing the independence skills that you’ve learned. By the end of the week the speed begins to ramp up (but you can always go at your own pace!)"
            ],
            [
                'title' => 'Fly Around The Kit!',
                'description' => "The final week kicks off by starting to apply this groove within context and by your final 30 Day Independence lesson you will playing the groove in it’s final form at blazing fast speeds."
            ],
        ];
    @endphp

    @include('drumeo.products.partials.evergreen._lessons', [
        'title' => 'Unlock your creativity and speed around the drums.',
        'description' => '30-Day Independence is a NEW way to improve your coordination and speed around the drum kit. Independence can be the most frustrating skill to develop on the drums. 30-Day Independence starts slow and builds your coordination over 30 days with daily practice. Just play along with Estepario and build new pathways in your brain.<strong> And the best part is you only need 10 minutes per day.</strong>',
        'features' => $features,
        'lessonTitle' => 'Course Lessons',
        'instructor' => ' El Estepario Siberiano',
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
                        "30-Day Independence gives you guided play-along workouts every day for thirty days. You’ll know exactly what to work on every time you sit at the drums or practice pad.",
                    ],
                    [
                        "icon" =>
                        "fa-regular fa-clock",
                        "title" => "Fits your schedule.",
                        "desc" =>
                        "It’s not easy trying to cram your drum practice between work, school, and family. That’s why 30-Day Independence is designed to fit any schedule. You only need 10 minutes per day to improve your 4-way coordination.",
                    ],
                    [
                        "icon" =>
                        "fa-regular fa-infinity",
                        "title" => "Lifetime access.",
                        "desc" =>
                        "You can access ALL playalongs, charts, and lessons from 30-Day Independence for life. That means you can return to your favorite workouts over and over – plus, it means you can work at your own pace.",
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
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp',
        'items' => $items,
        'eg' => true,
    ])

    <!-- Meet your teacher section -->
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #ffffff calc(50% + 1px));"></div>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#ffffff;">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/coach-image.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/coach-image.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                        alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>El Estepario Siberiano</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Estepario Siberiano has pushed the boundaries of drumming.
                        <br><br>
                        He’s inspired millions of people with his dedication, talent, and innovation. He’s created viral
                        videos performing complex 4-way patterns with control. And he always applies these patterns in a
                        musical context.
                        <br><br>
                        Estepario is the perfect teacher to help you improve your drum set independence so you can unlock
                        your creativity on the kit.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg"
                                alt="tiktok icon">
                            <h3 class="mt-2"><strong>4M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg"
                                alt="youtube icon">
                            <h3 class="mt-2"><strong>810M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg"
                                alt="insta icon">
                            <h3 class="mt-2"><strong>4M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials section -->
    <section class="py-10 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-32" style="background: linear-gradient(to bottom, rgba(11, 118, 219, 1) 40%, rgba(7, 74, 137, 1) 100%);">
        <h3 class="mb-4 text-center text-white"><strong>What professional drummers are saying:</strong></h3>
        <p class="text-white mb-2 md:mb-3 px-4 lg:px-0 text-center">30-Day Independence works. By focusing on playing with real music right from day one, <br class="hidden lg:inline">you’ll learn the skills to play hundreds of songs on the drums in just thirty days. Check out what drummers are saying:</p>
        <div class="max-w-4xl mx-auto px-5 sm:px-6 mb-10 sm:mb-0">
            <div
                x-data="{
                init() {
                    new Splide(this.$refs.splide, {
                        classes: {
                            arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                            prev: 'hidden',
                            next: 'splide__arrow--next hidden sm:flex mb-16',
                            pagination: 'splide__pagination -bottom-6 lg:-bottom-10',
                        },
                        perPage: 2.5,
                        perMove: 1,
                        type: 'loop',
                        lazyLoad: 'nearby',
                        focus: 0,
                        interval: 2000,
                        breakpoints: {
                            800: {
                                perPage: 2.5,
                            },
                            769: {
                                perPage: 1.5,
                                drag: 'free',
                                snap: false,
                            },
                             410: {
                                perPage: 1,
                            },
                        },
                    }).mount()
                },
            }"
            >
                <div x-ref="splide" class="splide mb-12 sm:mb-10 lg:mb-12 py-4 px-8">
                    <div class="splide__track">
                        <ul class="splide__list items-start" style="padding-top: 60px !important;">
                            @php
                                $testimonials = [
                                    [
                                        'name' => 'Mike Portnoy',
                                        'subheader' => 'Dream Theater',
                                        'comment' => 'El Estepario continues to push the boundaries of what is possible with drumming, creativity and independence… proving to be one of the most inspiring (and popular) drummers on the internet.',
                                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/mike-portnoy.webp',
                                    ],
                                    [
                                        'name' => 'Nic Collins',
                                        'subheader' => 'Phil Collins/Genesis',
                                        'comment' => 'I’ve been a fan of Estepario’s ever since I saw one of his videos for the first time on my Instagram. He never ceases to blow my mind with his speed, precision, and creativity.',
                                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/nic-collins.webp',
                                    ],
                                    [
                                        'name' => 'Chad Smith',
                                        'subheader' => 'Red Hot Chili Peppers',
                                        'comment' => 'All I know is that guy is a freak of nature.',
                                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/chad-smith.webp',
                                    ],
                                    [
                                        'name' => 'Gregg Bissonette',
                                        'subheader' => 'Ringo Starr & His All-Starr Band',
                                        'comment' => 'El Estepario Siberiano is one of the greatest drummers I have ever heard in my entire life. His dedication, technique, and tremendous showmanship, and just everything are a real inspiration to myself and to drummers all around the world.',
                                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/gregg-bisonnette.webp',
                                    ],
                                ];
                            @endphp
                            @foreach ($testimonials as $testimonial)
                                <li class="splide__slide bg-[#F4F8FB] rounded-xl pb-6 px-4 sm:px-8 mr-4 text-center h-[400px] sm:h-[340px]">
                                    <div class="mb-6" style="margin-top: -60px;">
                                        <img class="rounded-full w-[90px] h-[90px] object-cover"
                                            data-splide-lazy="{{ $testimonial['img'] }}" alt="{{ $testimonial['name'] }} avatar" />
                                    </div>
                                    <h6 class="mb-1 font-extrabold">{{ $testimonial['name'] }}</h6>
                                    <p class="pb-6"><i> {!! $testimonial['subheader'] !!} </i></p>
                                    <p class="mb-6">“{!! $testimonial['comment'] !!}”</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png" alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Your favorite drum<br class="inline sm:hidden"> course, guaranteed.</strong></h2>

            <h6 class="leading-normal">30-Day Independence is a NEW way to learn the drums – and for less than a month of private lessons, you’ll enjoy frustration-free progress to improve your speed, control, and creativity.
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
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/770x0/marketing/drumeo/products/30-day-independence/icon-logo-dark.webp',
        'logoAlt' => '30 day Independence logo',
        'title' => 'Improve your chops <br class="md:hidden"> in just 30 days.',
        'points' => $points,
        'profileImageAlt' => 'student profile image',
        'mainImage' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/order-collage.webp',
    ])

    <!-- trailer for header section -->

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '975466470',
        'vimeo' => true,
    ])


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>


    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" defer></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js" defeer></script>

@stop
