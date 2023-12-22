@php
    require_once(resource_path('marketing/views/musora/_partials/homepage-data.php'));
@endphp

@extends('musora._partials.layout', [
    'whiteNav' => true,
    'fullSubscriptionVersion' => true,
])

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }

        .join.white {
            background:#fff;
            color:#000;
        }

        .join.white:hover, .join.white:focus {
            background:#eee;
        }

        .join.smaller {
            padding:8px 30px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:11px 30px;
            }
        }

        .join.smaller.outline {
            padding:8px 28px 6px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller.outline {
                font-size:18px;
                padding:10px 28px 8px;
            }
        }

        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .join.outline {
            background:transparent;
            outline-style:none !important;
            border:1px solid #fff;
            color:#fff;
            padding:6px 12px;
        }

        @media (min-width:768px) {
            .join.outline {
                border-width:2px;
                padding:11px 30px;
            }
        }

        .join.outline:hover, .join.outline:focus {
            background:#fff;
            color:#000;
        }

        .join.outline.black {
            border-color:#000;
            color:#000;
        }
        .join.outline.black:hover, .join.outline.black:focus {
            background:#000;
            color:#fff;
        }
        .join.outline.musora {
            border-color:#0c1524;
            color:#0c1524;
        }

        .join.outline.musora:hover, .join.outline.musora:focus {
            background:#0c1524;
            color:#fff;
        }

        .text-musora-black {
            color:#0c1524;
        }

        .text-musora,
        .text-musora-gold {
            color:#FFAE00;
        }

        .splide__pagination__page.is-active {
            background:#01050F;
            transform:none !important;
        }

        .splide__pagination__page {
            margin:3px 10px !important;
            opacity:1 !important;
        }

        @media (min-width:768px) {
            .splide__pagination__page {
                margin:3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }

        .dot {
            left:-16px;
        }

        .full-line {
            left:0;
            bottom:31%;
        }

        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }

            .full-line {
                bottom:0;
            }
        }
        .join.drumeo {
            background:#0b76db;
        }
        .join.drumeo:hover {
            background:#0c84f5;
        }
        .join.pianote {
            background:#F61A30;
        }
        .join.pianote:hover {
            background:#ff3347;
        }
        .join.guitareo {
            background:#00C9AC;
        }
        .join.guitareo:hover {
            background:#00e3c1;
        }
        .join.singeo {
            background:#8300E9;
        }
        .join.singeo:hover {
            background:#9000ff;
        }
        .splide__slide.is-active .active-bg {
            background-color:#FFAE00!important;
        }

        .timed-toggle .media-toggle.active {
            display:block!important;
        }
        .timed-toggle .active-toggle.active {
            border-color: #FFAE00!important;
            background-color:#151f31!important;
        }
        .timed-toggle .active-toggle.active .description {
            max-height:100px!important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
        brand: "pianote",
        drumeoSoundslice: false,
        pianoteSoundslice: false,
        guitareoSoundslice: false,
        singeoSoundslice: false,
        trailer: false,
    }'
@endsection

@section('layout-body')

    @php
        $bubble1 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header4.png';
        $bubble2 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/350x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header5.png';
        $bubble3 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header7.png';
        $bubble4 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header1.png';
        $bubble5 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header3.png';
        $bubble6 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header8.png';
        $bubble7 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header6.png';
        $bubble8 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/musora/membership/homepage/2023/bubbles/header2.png';
    @endphp
    @include('musora.sales.components.header-section', [
        'header' => 'Your musical goals<br> start here.',
        'underline' => true,
        'noTrailer' => true,
        'pointOne' => 'GREAT TEACHERS',
        'pointTwo' => 'VIDEO LESSONS',
        'pointThree' => 'FUN PRACTICE',
        'pointFour' => '1000+ SONGS',
    ])

    <section class="text-center text-white py-5 sm:py-7" style="background-color:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex-wrap justify-center items-center hidden sm:flex">
                <a href="/6-reasons/piano"><h5 class="px-1 sm:px-5 lg:px-10"><i class="text-pianote text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-piano-keyboard"></i> <strong>Piano</strong></h5></a>
                <a href="/6-reasons/guitar"><h5 class="px-1 sm:px-5 lg:px-10"><i class="text-guitareo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-guitar"></i> <strong>Guitar</strong></h5></a>
                <a href="/6-reasons/drums"><h5 class="px-1 sm:px-5 lg:px-10"><i class="text-drumeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-drum"></i> <strong>Drums</strong></h5></a>
                <a href="/6-reasons/singing"><h5 class="px-1 sm:px-5 lg:px-10"><i class="text-singeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-microphone-stand"></i> <strong>Singing</strong></h5></a>
            </div>
            <div class="flex-wrap justify-center items-center flex sm:hidden">
                <a href="/6-reasons/piano"><p class="px-2 sm:px-5 lg:px-10"><i class="text-pianote text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-piano-keyboard"></i> <strong>Piano</strong></p></a>
                <a href="/6-reasons/guitar"><p class="px-2 sm:px-5 lg:px-10"><i class="text-guitareo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-guitar"></i> <strong>Guitar</strong></p></a>
                <a href="/6-reasons/drums"><p class="px-2 sm:px-5 lg:px-10"><i class="text-drumeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-drum"></i> <strong>Drums</strong></p></a>
                <a href="/6-reasons/singing"><p class="px-2 sm:px-5 lg:px-10"><i class="text-singeo text-xl sm:text-5xl align-middle mr-0.5 sm:mr-1 fa-light fa-microphone-stand"></i> <strong>Singing</strong></p></a>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20" style="background-color:#f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <img class="text-center mx-auto sm:h-20 lg:h-24 mb-10 hidden sm:inline-block" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/homepage/2023/learn-practice-play.png">
            <img class="text-center mx-auto h-24 inline-block sm:hidden" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/homepage/2023/learn-practice-play-m.png">
            <img class="my-5 h-64 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/musora/membership/homepage/2023/intro-collage3.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center mb-5">
                <p class="leading-normal max-w-xl pr-7 mx-0">Learning an instrument can be frustrating. So we’ve made the most helpful music lessons on the planet:
                    <br><br>
                    Guided video lessons from great teachers, interactive exercises that transform practice into play, and <strong>thousands of popular songs</strong> for every style, era, and skill level. PLUS unlimited personal support from real teachers.
                    <br><br>
                    You’ll play more. You’ll fall in love with the process. And we’re so confident you’ll love your new skills that you’ll get a 7-day free trial PLUS a 90-day guarantee (just to make sure!).
                </p>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/musora/membership/homepage/2023/intro-collage3.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10 relative z-20" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>




    @php
        $gridItems = $musora['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section')

    @php
        $buttons = $musora['buttons'];

        $courses = $musora['courses'];
    @endphp

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    @include('musora.sales.components.coaches-section', [
        'header' => 'Study with the world’s <br class="md:hidden"><u>best teachers.</u>',
        'desc' => 'Amplify your skills with artist<br class="inline sm:hidden"> courses and live events.',
        'split' => true
    ])

    @include('musora.sales.components.workouts-section', [
        'workoutsBG' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/840x0/filters:quality(95)/marketing/musora/membership/homepage/2024/workouts-card.jpg',
    ])


    @php
        $songItems = $musora['songItems'];
    @endphp

    @include('musora.sales.components.songs-section', [
        'video' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/device.png',
    ])

    @php
        $testimonials = $musora['testimonials'];
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'Where musical<br class="hidden sm:inline"> dreams come true.',
    ])

    @if(empty($trialVersion))
        @include('musora.sales.components.guarantee-section', [
            'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png',
            'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
            'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.',
        ])
    @endif
    @include('musora._partials.order-section-collage')

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/musora/membership/homepage/2023/devices2.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?platform=iphone',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
    ])

    @include('musora._partials._faq')

    @include('_partials.components.video-modal',[
        'name' => 'drumeoSoundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'pianoteSoundslice',
        'video' => '77f4c',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'guitareoSoundslice',
        'video' => 'Mnmkc',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'singeoSoundslice',
        'video' => 'ZsC4c',
        'soundslice' => true,
    ])

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '785314424',
        'vimeo' => true,
    ])

    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var timedToggle = document.querySelector('.timed-toggle'),
                songPoints = Array.from(timedToggle.querySelectorAll('.media-toggle')),
                songPointToggles = Array.from(timedToggle.querySelectorAll('.active-toggle')),
                currentSongPoint = 0,
                totalSongPoints = songPoints.length,
                autoplayInterval = 10000,
                autoplaySongPoints;

            function updateIndex(index) {
                songPoints.forEach((point, i) => {
                    point.classList.toggle('active', i === index);
                    const video = point.querySelector('video');
                    if (video) {
                        video.currentTime = 0;
                        video.play();
                    }
                });

                songPointToggles.forEach((toggle, i) => {
                    toggle.classList.toggle('active', i === index);
                });
            }

            function autoplayHandler() {
                currentSongPoint = (currentSongPoint + 1) % totalSongPoints;
                updateIndex(currentSongPoint);
            }

            autoplaySongPoints = setInterval(autoplayHandler, autoplayInterval);

            songPointToggles.forEach((toggle, index) => {
                toggle.addEventListener('click', function () {
                    updateIndex(index);
                    currentSongPoint = index;
                    clearInterval(autoplaySongPoints);
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
