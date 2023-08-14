@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <title>Solo In An Hour | Guitareo</title>
    <meta property="og:title" content="Solo In An Hour">
    <meta name="description" content="Play your first solo in less than 60 minutes"/>
    <meta property="og:description" content="Play your first solo in less than 60 minutes">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/solo-in-an-hour/">

    <link rel="preload" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}"></noscript>

    <style>
        .infusion-form button {
            background:#ffde16;
        }
        .infusion-form button:hover {
            background:#f2ce00;
        }
        .header-bg {
            background-size:675px;
            background-image: url('https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/bg.jpg');
        }
        .teacher-gradient {
            background:linear-gradient(to top, #04111d 40%, transparent 75%);
        }
        .teacher-section {
            background: #04111d 50% top/530px no-repeat url('https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/coach-bg.jpg');;
        }
        @media (min-width: 768px) {
            .header-bg {
                background-size:1140px;
                background-image:url('https://www.musora.com/musora-cdn/image/width=1250,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/bg.jpg');
            }
            .teacher-gradient {
                background:linear-gradient(to right, #04111d, transparent 80%);
            }
            .teacher-section {
                background-size:630px;
                background-position:180% 50%;
                background-image:url('https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/coach-bg.jpg');
            }

        }
        @media (min-width: 1024px) {
            .header-bg {
                background-size:1240px;
                background-image: url('https://www.musora.com/musora-cdn/image/width=1600,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/bg.jpg');
            }
            .teacher-gradient {
                background:linear-gradient(to right, #04111d, transparent 60%);
            }
            .teacher-section {
                background-size:750px;
                background-position:95% 50%;
                background-image:url('https://www.musora.com/musora-cdn/image/width=1250,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/coach-bg.jpg');
            }
        }
    </style>
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop

@section('body')
    @include('guitareo.lead-gen.partials._header1', [
        "bgColor" => "#00101d",
        "imgs" => [
            '<img class="w-full h-24 md:h-32 lg:h-36" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/logo.png" alt="logo">',
        ],
        "playButton" => "down",
        "headLine" => '<h1 class="font-bison-bold">Play your first solo<br class="inline md:hidden"> in less than 60 minutes</h1>
        <div class="leading-normal mt-2 md:mt-3 mb-4 md:mb-6 lg:text-xl">Enter your email below for your free lessons...</div>',
        "formId" => "Guitareo - Engagement - Trigger - Solo In An Hour - Web Form",
        "formName" => 'Solo In An Hour',
        "submitButtonColor" => 'linear-gradient(180deg,#ffd500,#ffb600)',
    ])

    @include('guitareo.lead-gen.partials._lesson3', [
        "bg" => "#00101d",
        "headLine" => '<strong class="font-bold">Yes, You CAN Solo In An Hour!</strong>',
        "subHeadLine" => 'Soloing doesn’t need to be scary! In this free lesson series, Ayla will walk<br class="hidden md:inline"> you through a few simple steps to have you soloing in under an hour!',
        "lessons" => [
            [
            'title' => "The Most Important Scale For Soloing",
            'description' => "Solo over all different types of music with just a few notes from this scale.",
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/thumbs1.jpg',
            ],
            [
            'title' => "What Makes A Good Solo?",
            'description' => "See how the greats do it and learn from the best.",
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/thumbs2.jpg',
            ],
            [
            'title' => "Building A Lick Vocabulary",
            'description' => "Get inspired with 3 boxed and ready licks and build your lick library.",
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/thumbs3.jpg',
            ],
            [
            'title' => "Playing Your First Solo",
            'description' => "Put it all together to create your very first solo.",
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/thumbs4.jpg',
            ],
            [
            'title' => "What About Soloing In Other Keys?",
            'description' => "Move up and down the fretboard freely and play along to any song in any key.",
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/thumbs5.jpg',
            ],
            [
            'title' => "Where To Go From Here?",
            'description' => "Take your solos from good to great and find your own artistic identity on the guitar.",
            'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/thumbs6.jpg',
            ],
        ],
    ])

    <?php
        $steps = [
            [
                "title" => "STEP-BY-STEP LESSONS",
                "description" => "Learn the right things<br> at the right time",
                "icon" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/guide-icon.svg",
            ],
            [
                "title" => "DOWNLOADABLE LICKS",
                "description" => "Save them, print them,<br> they’re yours!",
                "icon" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/download-icon.svg",
            ],
            [
                "title" => "PLAY-ALONG BACKING TRACKS",
                "description" => "Jam out with your<br> new skills",
                "icon" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/play-along-icon.svg",
            ],
        ];
    ?>

    <section class="text-center text-white relative py-14 md:py-20 lg:px-4" style="background: linear-gradient(to bottom, #00101d 60%, #0a1a27);">
        <div class="container mx-auto">
            <div class="leading-normal text-lg md:text-2xl lg:text-3xl"><strong>Your step-by-step guide<br class="inline md:hidden"> to soloing on the guitar</strong></div>
            <p class="opacity-70 mt-2 mb-8 px-4">You can solo and it only takes an hour. Even if you’re a complete beginner.<br class="hidden md:inline">
                You’ll have everything you need to unlock and discover the essentials to soloing on the guitar. </p>
            <div class="flex flex-wrap items-start max-w-4xl mx-auto">
                @foreach ($steps as $key => $step)
                    <div class="w-full md:w-1/3 px-3 mb-8 md:mb-0">
                        <img class="h-12" src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $step['icon'] }}" alt="step-icon-{{ $key + 1 }}">
                        <p class="my-3"><strong>{!! $step['title'] !!}</strong></p>
                        <p class="leading-normal">{!! $step['description'] !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center text-white relative pt-60 pb-8 md:py-20 lg:py-24 px-4 teacher-section lazyload">
        <div class="container mx-auto relative z-10">
            <div class="flex flex-wrap items-center mx-auto max-w-sm md:max-w-4xl md:px-3">
                <div class="w-full md:w-7/12 lg:w-1/2 z-20">
                    <div class="text-left">
                        <p><em>Meet Your Teacher</em></p>
                        <h1>Ayla<br>
                        <strong>Tesler-Mabe</strong></h1>
                        <div class="uppercase text-yellow-2 lg:text-lg">TEACHING GUITARISTS FOR {{ date('Y') - 2013}} YEARS</div>
                    </div>
                    <p class="leading-relaxed text-left mt-4 lg:mt-5">Ayla Tesler-Mabe has made a splash in the music industry as a professional guitarist, vocalist, and songwriter — playing in popular bands including Ludic and formally Calpurnia. And while she’s actively creating new music and performing, Ayla’s also passionate about helping students through Guitareo every day!</p>
                </div>
            </div>
        </div>
        <div class="teacher-gradient z-0 absolute inset-0"></div>
    </section>

    @include('guitareo.lead-gen.partials._enter-email', [
        "bgImg" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/order-bg.jpg",
        "img" => '
            <picture>
                <source media="(min-width: 1024px)" srcset="https://www.musora.com/musora-cdn/image/width=350,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/logo.png">
                <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/logo.png">
                <img class="h-28 md:h-40 lg:h-52 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/solo-in-an-hour/logo.png" alt="logo">
            </picture>
        ',
        "text" => '<h1 class="font-bison-bold">Play your first solo<br class="inline md:hidden"> in less than 60 minutes</h1>
        <div class="leading-normal mt-2 md:mt-3 mb-4 md:mb-6 lg:text-lg">Enter your email below for your free lessons...</div>',
        "formId" => "Guitareo - Engagement - Trigger - Solo In An Hour - Web Form",
        "formName" => 'Solo In An Hour',
        "submitButtonColor" => 'linear-gradient(180deg,#ffd500,#ffb600)',
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "trailer",
        "url" => "//player.vimeo.com/video/675642559?autoplay=1"
    ])
@stop
