@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <title>Getting Started On The Electric Guitar</title>
    <meta property="og:title" content="Getting Started On The Electric Guitar">

    <meta name="description" content="Pick up your guitar and start playing today!"/>
    <meta property="og:description" content="Pick up your guitar and start playing today!">

    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/free-electric-guitar-lessons/">

    <link rel="preload" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}"></noscript>

    <style>
        .hero-header img {
            width:auto;
            max-width:100%;
        }

        .header-bg {
            background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-header.jpg');
        }

        .meet-rob {
            background-size: 960px;
            background-position: 25% 6%;
            background-image: url('https://www.musora.com/musora-cdn/image/width=800,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-coach.jpg');
        }

        .meet-rob .content-wrap {
            max-width:500px;
        }

        @media (min-width:768px) {
            .header-bg {
                background-image:url('https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-header.jpg');
            }

            .meet-rob {
                background-size: 1300px;
                background-position: 50% top;
                background-image: url('https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-coach.jpg');
            }
        }
        @media (min-width:1024px) {
            .header-bg {
                background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-header.jpg');
            }

            .meet-rob {
                background-size: 1550px;
                background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-coach.jpg');
            }

            .meet-rob .content-wrap {
                max-width:700px;
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
        "bgColor" => "#010416",
        "imgs" => ['<img class="h-14 sm:h-20 lg:h-28 mt-64 sm:mt-80 lg:mt-96 mb-5 lg:mb-8" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-logo.png" alt="logo">'],
        "formId" => "Guitareo - Engagement - Trigger - Getting Started On The Electric Guitar - Web Form",
        "formName" => "Getting Started On The Electric Guitar",
    ])

    @include('guitareo.lead-gen.partials._lesson1', [
        "bg" => "linear-gradient(to bottom, #011029, #010414)",
        "textbg" => "linear-gradient(to bottom, #0e2834 56%, #16102b)",
        "headLine" => '<div class="leading-none text-lg md:text-2xl md:leading-none lg:text-3xl lg:leading-none">Pick up your guitar and<br class="inline md:hidden"> <strong>start playing today!</strong></div>',
        "subHeadLine" => '<div class="opacity-70 mt-3 mb-8 leading-normal text-base lg:text-lg">Learn everything you need to get started on the electric<br class="hidden sm:inline-block"> guitar and start playing music as fast as possible!</div>',
        "lessons" => [
                        [
                        'title' => "ELECTRIC 101",
                        'description' => "Get to know your guitar! You’ll know each part of your guitar, the name of all the strings, and how to get it in perfect tune.",
                        'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-01.jpg',
                        ],
                        [
                        'title' => "SOUNDING GOOD",
                        'description' => "Explore your tone! You’ll find your sound by playing around with the different knobs and switches of your guitar AND play your very first guitar chord.",
                        'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-02.jpg',
                        ],
                        [
                        'title' => "STRUMMING BASICS",
                        'description' => "This is essential! You’ll get the correct motion of your wrist down so you can play different strumming patterns.",
                        'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-03.jpg',
                        ],
                        [
                        'title' => "START MAKING MUSIC",
                        'description' => "Play more chords! You’ll master a total of six guitar chords and how they can be put together in different progressions.",
                        'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-04.jpg',
                        ],
                        [
                        'title' => "PLAY YOUR FIRST SONG",
                        'description' => "The moment you’ve been waiting for! Put everything you’ve learned together and play a full song — including a simple lead guitar line.",
                        'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-05.jpg',
                        ],
                        [
                        'title' => "PAVE YOUR OWN PATH",
                        'description' => "You did it! With these chords and strumming patterns, you already know how to play hundreds of songs. But this is just the beginning...",
                        'image' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/thumbs-electric-06.jpg',
                        ],
                    ]
    ])

    @include('guitareo.lead-gen.partials._lesson2', [
        "bg" => "linear-gradient(to bottom, #01051b, #032b33)",
        "headLine" => "The <strong> Beginner Guitarist’s </strong> Guide to…",
        "lessons" => [
                        [
                        'title' => "TIMING & RHYTHM",
                        'description' => "Learn to strum three different patterns in time with a jam track.",
                        'icon' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/timing_icon.svg',
                        ],
                        [
                        'title' => "PLAYING YOUR FIRST SONG",
                        'description' => "Play a real song along with Ayla and the jam track.",
                        'icon' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/music_icon.svg',
                        ],
                        [
                        'title' => "MAKING MUSIC",
                        'description' => "Get started with a handful of chords to put together in your own chord progression.",
                        'icon' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/question_icon.svg',
                        ],
                        [
                        'title' => "QUESTIONS ANSWERED",
                        'description' => "Get personalized feedback and support from real teachers and connect with other students for advice.",
                        'icon' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/guitar_icon.svg',
                        ],
                    ]
    ])

    @include('guitareo.lead-gen.partials._meet-your-teacher1', [
        "bgImg" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-coach.jpg",
        "bgColor" => "#010416",
        "meetYourTeacher" => '<h3>Meet your teacher...</h3>',
        "name" => '<h1 class="leading-tight font-bebas" style="background: linear-gradient(to bottom, #FFDD00, #FBB034);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>Ayla Tesler-Mabe</strong></h1>',
        "desc" => "Ayla Tesler-Mabe is a professional guitarist, vocalist, and songwriter who has culled millions of views on YouTube and Instagram with her instructional guitar videos and performances. Ayla’s deep passion for music contributes to her various musical projects, such as lead guitarist and singer in Ludic, a funk, R&B, and art-pop fusion band from Vancouver, Canada. And now she’s encouraging and teaching YOU to start playing and understanding the guitar.",
        "asSeenColor" => "text-guitareo",
        "thumbnails" => [
            [
                "src" => "https://img.youtube.com/vi/qqrYZlW4Hjg/mqdefault.jpg",
                "desc" => "4 Things Every Beginner<br> Guitarist Should Know",
                "dataOpen" => "slap",
            ],
            [
                "src" => "https://img.youtube.com/vi/C3f0HC0-J10/mqdefault.jpg",
                "desc" => "3 Ways To Fake<br> Amazing Guitar Solos!",
                "dataOpen" => "delay",
            ],
            [
                "src" => "https://img.youtube.com/vi/PILuE378Mj4/mqdefault.jpg",
                "desc" => "Minor Pentatonic Magic",
                "dataOpen" => "fret",
            ]
        ]
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "slap",
        "url" => "https://www.youtube.com/embed/qqrYZlW4Hjg?autoplay=1"
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "delay",
        "url" => "https://www.youtube.com/embed/C3f0HC0-J10?autoplay=1"
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "fret",
        "url" => "https://www.youtube.com/embed/PILuE378Mj4?autoplay=1"
    ])

    @include('guitareo.lead-gen.partials._enter-email', [
        "bgColor" => "linear-gradient(to bottom, #042932, #010317)",
        "img" => '<img class="h-14 sm:h-20 lg:h-28 mx-auto" src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/electric-logo.png" alt="logo" />',
        "text" => '<div class="text-lg leading-none my-5 md:my-8 md:text-2xl md:leading-none lg:text-3xl lg:leading-none">Enter your email below to get the ENTIRE 6-video <br class="hidden md:inline"> course on <strong>Getting Started On Electric Guitar</strong></div>',
        "formId" => "Guitareo - Engagement - Trigger - Getting Started On The Electric Guitar - Web Form2",
        "formName" => "Getting Started On The Electric Guitar",
    ])
@stop
