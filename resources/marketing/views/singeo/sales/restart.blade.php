@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Save 50% On Your First Year</title>
    <meta property="og:title" content="Save 50% On Your First Year">
    <meta property="og:url" content="https://www.singeo.com/">

    <meta name="description" content="We want you back – so you’ll get a 50% discount on your first year with Singeo.">
    <meta property="og:description" content="We want you back – so you’ll get a 50% discount on your first year with Singeo.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2023/share-image-singeo.jpg"/>
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-singeo.css') }}">
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


    .join.green {
                 background: #10D05F;

        }
        .join:hover,
        .join:focus {
             background: #13eb6d;
         }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])

        <header class="sm:px-6 pb-14 pt-6 sm:pt-14 sm:pb-28 lg:pt-20 lg:pb-36 text-white" style="background:linear-gradient(to left, #8300E9, #3E00C2);">
            <div class="container max-w-6xl mx-auto">
                <div class="flex flex-wrap sm:flex-nowrap items-center">
                    <div class="w-full text-center">
                        <div class="px-5 sm:px-0">
                            <img class="h-20 sm:h-36" src="https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/header-collage.png">
                            <h1 class="rotater-text my-4 lg:my-5"><strong>Save 50% On <br class="inline sm:hidden"> Your First Year</strong></h1>
                            <h6 class="leading-normal mb-4 sm:mb-2">We want you back – so you’ll get a <strong>50% discount</strong> on your first year with Singeo.<br>
                                <strong class="text-musora"><em>Only available until June 30th.

                                                        <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                                        left!</em></strong></h6>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10 mx-auto sm:max-w-xs">
                                <a class="w-full join green smaller mb-2 anchor-slide" href="#customize-anchor">SEE YOUR DEAL &raquo;</a>
                                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #ba0b51;color: #ffac00;"></i>
                                </a>
                                <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

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
                    'desc' => 'Courses and live events<br class="hidden sm:inline"> with singing heroes. ',
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
        @endphp
        <div class="container max-w-4xl mx-auto -mt-10 sm:-mt-14 lg:-mt-20">
            <div class="px-5 sm:px-0">
                <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-{{ $theme }} bg-white relative">
                    <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center">
                        @foreach ($features as $key => $feature)
                            <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 my-2 sm:mb-0">
                                <img
                                    src="https://www.musora.com/musora-cdn/image/{{ $feature['image'] }}"
                                    class="h-5 sm:h-7 mb-2 mr-4 sm:mr-0 transition-opacity opacity-0"
                                    alt="feature image{{$key+1}}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                >
                                <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                                    <span class="text-sm">{!!  $feature['desc']  !!}</span></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <section class="pt-12 md:pt-20">
            <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-2">
                <h3 class="font-extrabold text-center">Singeo membership<br class="inline sm:hidden"> special pricing.</h3>
                <p class="text-center mt-3 mb-6">You’ll have one year of unlimited<br class="inline sm:hidden">  singing lessons, including:</p>
                <div class="md:grid md:grid-cols-3 md:gap-4">
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/singeo-method.jpg"></div>
                        <div class=" px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/singeo-method-logo.svg" alt="method-text">
                            <p class="mt-2">
                                Step-by-step lessons for the next stage of your singing.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/singeo-songs.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/singeo-songs-logo.svg" alt="songs-text">
                            <p class="mt-2">
                                Easy access to 1000+ famous songs with play-along tools.
                            </p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden" style="background-color:#F6F8FC;">
                        <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/singeo-coaches.jpg"></div>
                        <div class="px-3 lg:px-4 py-5 lg:py-7 text-center">
                            <img class="h-5 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/singeo-coaches-logo.svg" alt="coaches-text">
                            <p class="mt-2">
                                Personalize support for all of your singing questions.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
            'header' => 'Your friends would love to see<br class="hidden sm:inline-block">   you back in the comments.',
            'reviewText' => 'Rejoin a thriving community of singers of all skill-levels<br class="hidden sm:inline-block"> to sing with confidence.',
        ])

        @include('musora.sales.components.guarantee-section', [
        'badge' => 'https://d21xeg6s76swyd.cloudfront.net/sales/2022/singeo-guarantee.png',
            'header' => '<strong>Happy “welcome back” guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence when you rejoin Singeo. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it.',
        ])

        <div class="unstick-trigger block"></div>
        <div id="customize-anchor" class="anchor"></div>
        <div id="order" class="anchor"></div>
        <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:linear-gradient(to left, #8300E9, #3E00C2);">
            <div class="container mx-auto max-w-6xl relative z-50">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-xs">
                        <div class=" inline-block relative w-full group" style="padding-bottom: 62%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                <div class="  front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-top bg-contain bg-no-repeat" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d21xeg6s76swyd.cloudfront.net/sales/promos/june/membership-badge.png);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h3 class="leading-tight mt-4 sm:mt-5"><strong>Restart your <span class="hidden sm:inline">Singeo</span> Membership<br class="hidden sm:inline">  today and save 50%.</strong></h3>
                    <p class="leading-tight my-3 sm:my-4 text-musora font-black"><strong><em>Only available until June 30th.
                                <span x-cloak x-data="timer()" x-init="countdown()">
                                                                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                                                     <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                                                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                                                 </span>
                                left!</em></strong></p>

                    <h3 class="leading-tight mb-1"><strong>Only</strong> <s class="opacity-50">$240</s> <strong>$120</strong></h3>
                    <p class="leading-tight text-sm mb-5"><em>Renews at $240 after your first year.</em></p>
                </div>
                <a class="join green" href="https://www.musora.com/ecommerce/add-to-cart?products[musora-access-1-year]=1&promo-code=win-back&locked=true">GET Started »</a>
            </div>
        </section>

    @include("guitareo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

        @include('_partials.components.countdown',[
        'countdownDate' => '2023-07-01 00:00:00',
        'promoVersion' => false
        ])
@stop
