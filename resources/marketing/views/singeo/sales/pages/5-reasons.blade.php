@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    <meta property="og:url" content="https://www.singeo.com"/>

    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee." />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee."/>

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
    </style>
@stop

@section('body-data')
    x-data ='{
    trailer : false
    }'
@endsection

@section('global-body')
        @include("singeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true,
            "hideMenu" => true,
        ])
        <section class="text-center px-5 sm:px-8 pt-4 pb-10 sm:pt-7 sm:pb-14 lg:py-20">
            <div class="container max-w-3xl mx-auto">
                <img src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/5-reasons/header.png">
                <h2 class="leading-tight my-4 sm:my-6"><strong>5 Reasons Why Singeo Is Better Than<br class="hidden sm:inline"> In-Person Singing Lessons.</strong></h2>
                <h6 class="text-left leading-normal mb-10 sm:mb-14">Imagine being able to sing ANY song you want. Leading the choir rather than following it. Or even just singing a lullaby for your kids and actually sounding good.
                    <br><br>All because you found the singing lessons that are right for you, your voice and the unique challenges you were facing… And because you didn’t waste your money and time with in-person signing lessons.</h6>

                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center mb-10">
                    <img class="rounded-xl h-64 lg:h-80" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/5-reasons/1-bang.jpg">
                    <div class="sm:pl-10 mt-3 sm:mt-0 sm:text-left">
                        <h5 class="leading-normal mb-2"><strong>1. Get more bang for your buck:</strong></h5>
                        <p class="leading-relaxed">Traditional singing lessons can be very expensive - up to $80+/session - especially when considering the cost of travel and the rate of instructors. Singeo provides complete instruction, on-demand practice tools, real coaches, and a vibrant community, all for a fraction of the cost of in-person lessons.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center mb-10">
                    <img class="rounded-xl h-64 lg:h-80" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/5-reasons/2-feedback.jpg">
                    <div class="sm:pl-10 mt-3 sm:mt-0 sm:text-left">
                        <h5 class="leading-normal mb-2"><strong>2. Unlimited personal feedback:</strong></h5>
                        <p class="leading-relaxed">With Singeo you’ll get the personal feedback and support you need to get results faster. Your growth isn’t limited to someone else’s schedule. Get on-demand access to mentors, reviews & live lessons with real vocal coaches to overcome the challenges unique to you and your voice.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center mb-10">
                    <img class="rounded-xl h-64 lg:h-80" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/5-reasons/3-access.jpg">
                    <div class="sm:pl-10 mt-3 sm:mt-0 sm:text-left">
                        <h5 class="leading-normal mb-2"><strong>3. Access whenever, wherever:</strong></h5>
                        <p class="leading-relaxed">Forget about commuting or adjusting to someone else's schedule. With Singeo, you can access top-quality singing lessons anytime, anywhere. Whether you're on the road, at home, between kid’s karate lessons or even on a lunch break, Singeo is there for you.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center mb-10">
                    <img class="rounded-xl h-64 lg:h-80" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/5-reasons/4-lost.jpg">
                    <div class="sm:pl-10 mt-3 sm:mt-0 sm:text-left">
                        <h5 class="leading-normal mb-2"><strong>4. You’ll never feel lost:</strong></h5>
                        <p class="leading-relaxed">Singeo offers a comprehensive 10-level curriculum. Everything from basic singing techniques to advanced skills that will help you grow and evolve as a singer. You'll never have to wonder where to go next in your journey to singing mastery.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                    <img class="rounded-xl h-64 lg:h-80" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/5-reasons/5-trained.jpg">
                    <div class="sm:pl-10 mt-3 sm:mt-0 sm:text-left">
                        <h5 class="leading-normal mb-2"><strong>5. Be trained by the best:</strong></h5>
                        <p class="leading-relaxed">In-person lessons usually limit you to whatever teachers are available in your area. But with Singeo, you’ll get access to world-class teachers and Grammy-Winning coaches to teach you specialized skills, styles and techniques.</p>
                    </div>
                </div>
            </div>
        </section>

        @include('musora.sales.components.learn-by-playing-section', [
            'header' => 'Made for you<br class="inline sm:hidden"> and your voice.',
            'desc' => "Sure, you could find free singing tutorials online. But with every singer’s unique voice and<br class='hidden md:inline'> specific challenges, generalized tutorials don't cut it. You need something that caters to<br class='hidden md:inline'> your individual needs. It’s the fastest way to get the results you want.",
                    'vid' => 'https://player.vimeo.com/progressive_redirect/playback/785314557/rendition/540p/file.mp4?loc=external&signature=e1db56d3f22044707be08bbb02d7327bdf4bee7a07bc705017de56ef45bf1ed4',
        ])

        @php
            $testimonials = [
                [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/OriannaSells.jpg',
            'name' => 'Orianna Sells',
            'title' => 'It felt like the chains finally fell off my voice.',
            'description' => 'I was concerned that my singing style was too different to truly learn what I needed – and I wanted to strengthen my voice and stretch my range in a healthy manner.<br><br>With Singeo, I started practicing my songs more meticulously and it paid off – stronger high notes were available and it felt like the chains finally fell off my voice!',
            'location' => 'South Carolina, USA',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/JocelynnRodrigues.jpg',
            'name' => 'Jocelynn Rodrigues',
            'title' => 'It’s so healing to sing.',
            'description' => 'I wasn’t sure if I could really learn online, because I’ve heard in the past how important it is to have somebody with you, who can guide you – and make sure you don’t get injured.<br><br>But I’ve been making so much progress with Singeo. After doing the routines, I noticed that it didn’t stress me out as much to sing the higher octaves during the exercise. And while I’m singing around the house my voice feels stronger. Everyone can truly sing, and it’s so healing to sing. We were all born with this beautiful instrument and it’s just waiting to be played.',
            'location' => 'Alberta, Canada',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/JohnStevenson.jpg',
            'name' => 'John Stevenson',
            'title' => 'I have my first solo gig lined up!',
            'description' => 'For years I thought I wouldn’t be able to sing. I don’t feel like that anymore. I feel that I can and I now have my first solo gig lined up for January.<br><br>Essentially I realised that I needed to maintain a disciplined regimen. I needed to practice every day. I needed to do specific exercises that focussed on my weak spots. I also realised it wasn’t magic. Improvement is gradual and requires effort. It was a relief realising that if I put in the work, I would get there. Singeo is a good program. If you put in the time you will see improvement.',
            'location' => 'Australia',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/DamienGiven3.jpg',
            'name' => 'Damien Given',
            'title' => 'I’m getting back some of my old confidence.',
            'description' => 'Thirty-five years ago, I sang professionally in a group. And now at 74 years old, I’d given up the idea of ever singing properly again. But when tendonitis put a stop to my piano playing for several months, I decided to give Singeo a try – and boy, what a great choice!<br><br>I’m getting back some of my old confidence through the lessons and feedback – and I’m now keen to regain more pitch and breathing control, even though physiologically I’ve probably lost about one and a half steps at the top of my range. But that doesn’t bother me as much as I thought it would after a few months with Singeo. I’ve received a great deal of positive feedback from my classmates - and great tips from Lisa, Julia, and the team. What a find, what a course, and what great tutors!',
            'location' => 'Northern Ireland',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/KathyMandell.jpg',
            'name' => 'Kathy Mandell',
            'title' => 'It was like, OH! That’s what my problem is.',
            'description' => 'It was like, OH! THAT’S what my problem is! I’ve been having a lot of fun understanding the different singing styles, such as ‘flipper’ or ‘yeller’ – and getting past the flipping thing and either using it in my favor and flipping on purpose like Alanis Morrissette or opening my mouth more to have a stronger voice.<br><br>If you’ve always wanted to sing and didn’t have the confidence or thought you weren’t good enough, this is the program for you. The teachers and students are so supportive, non-judgmental, and encouraging.',
            'location' => 'South Carolina, USA',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/JerryBradley2.jpg',
            'name' => 'Jerry Bradley',
            'title' => 'More comfortable with my own voice every day.',
            'description' => 'This is NOT a standard web-based training where you are provided training videos with no interaction. The teachers are always willing to give personal feedback, suggestions, and recommendations.<br><br>Singeo made me realize it’s about being the best singer I can be while working within my own unique style – not matching somebody else’s. It’s like having a weight lifted off my shoulders. Don’t get me wrong, there is still lots of work to do, but my direction and understanding changed – and I’m feeling more comfortable with my own voice every day.<br><br>It’s up to you to take advantage of it all. The worst case is that you will learn a lot. The best case: you will improve your vocal abilities, confidence, make connections, and become a part of a family that really cares.',
            'location' => 'North Carolina, USA',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/RichardBailey.jpg',
            'name' => 'Richard Bailey',
            'title' => 'Like having your own singing coach.',
            'description' => 'When I saw how knowledgeable, energetic, and bubbly Lisa was it convinced me that this was not just an online tutorial – Singeo is like having your own singing coach at your home, literally any time of the day or night. I’ve learned how to breathe and control my breath to sing – and I’m able to sing songs how they were meant to be sung.<br><br>I enjoy singing so much more than I did before and it’s great fun and so satisfying to hear others say how much they enjoy my singing!',
            'location' => 'New Jersey, USA',
            ],
            [
            'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/marketing/singeo/membership/homepage/2023/testimonials/TerriPigg.jpg',
            'name' => 'Terri Pigg',
            'title' => 'I sing all the time – at home, at the office, in the car, wherever!',
            'description' => 'The learning is always fun and customized to fit you and your singing goals. In addition to that, you’ll get to know people all around the world who also love singing. The Singeo community celebrates and encourages each other as we learn and grow as singers from the convenience of our own homes.<br><br>Singeo’s given me a confidence boost and helped me begin to believe that I can really DO this singing thing while having fun at the same time. I sing all the time – at home, at the office, in the car, wherever. Singing just makes me happy!',
            'location' => 'Tennessee, USA',
            ],
            ]
        @endphp
    @include('musora.sales.components.testimonials-section', [
        'desktopGrid' => true,
        'header' => 'singers',
    ])

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
        @include('musora.sales.components.order-section-collage', [
        'headerLight' => true,
        'logo' => 'marketing/singeo/membership/homepage/2024/singeo-logo.webp',
        'header' => '<strong>Unlimited singing lessons.<br>Guided practice sessions. <br> Vocal coaches and support.</strong>',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
        <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
        <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
                'image' => 'marketing/singeo/membership/homepage/2024/singeo-collage-new.webp',

        ])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314379',
        'vimeo' => true,
    ])

    @if(!empty($promoVersion))
        @include("singeo.sales.partials._footer", [
            "minimal" => true
        ])
    @else
        @include("singeo.sales.partials._footer")
    @endif
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
