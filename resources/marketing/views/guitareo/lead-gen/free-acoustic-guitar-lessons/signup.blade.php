@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <title>Getting Started On The Acoustic Guitar</title>
    <meta property="og:title" content="Getting Started On The Acoustic Guitar">

    <meta name="description" content="Pick up your guitar and start playing today!"/>
    <meta property="og:description" content="Pick up your guitar and start playing today!">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/free-acoustic-guitar-lessons/">

    <link rel="preload" href="/marketing/parcel/guitareo/song-in-an-hour.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="/marketing/parcel/guitareo/song-in-an-hour.css"></noscript>

    <style>
        .hero-header img {
            width:auto;
            max-width:100%;
        }

        .header-bg {
            background-image: url('https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/header-bg.jpg');
        }

        .meet-rob {
            background-color:#020317;
            background-size: 1060px;
            background-position: 20% 30px;
            background-image: url('https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/coach-bg.jpg');
        }

        .meet-rob .content-wrap {
            max-width:500px;
        }

        @media (min-width:768px) {
            .header-bg {
                background-image: url('https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/header-bg.jpg');
            }

            .meet-rob {
                background-size: cover;
                background-position: 45% top;
                background-image: url('https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/coach-bg.jpg');
            }
        }
        @media (min-width:1024px) {
            .header-bg {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/header-bg.jpg');
            }

            .meet-rob {
                background-size: cover;
                background-position: 50% top;
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/coach-bg.jpg');
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
    <script src="/marketing/parcel/drumeo/modal-autoplay.js"></script>
@stop

@section('body')
    @include('guitareo.lead-gen.partials._header1', [
        "bgColor" => "#010416",
        "imgs" => ['
            <picture>
                <source media="(min-width: 1024px)" srcset="https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/logo.png">
                <img class="h-14 sm:h-20 lg:h-28 mb-5 lg:mb-8" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/logo.png" alt="logo">
            </picture>
        '],
        "playButton" => "up",
        "formId" => "Guitareo - Engagement - Trigger - Getting Started On The Acoustic Guitar - Web Form",
        "formName" => 'Getting Started On The Acoustic Guitar',
    ])

    @include('guitareo.lead-gen.partials._lesson1', [
        "bg" => "linear-gradient(to bottom, #011029, #010414)",
        "textbg" => "linear-gradient(to bottom, #0e2834 56%, #16102b)",
        "headLine" => '<div class="font-black text-lg md:text-2xl lg:text-3xl">Pick up your guitar and<br class="inline md:hidden"> <strong>start playing today!</strong></div>',
        "subHeadLine" => '<div class="opacity-70 mt-3 mb-8 leading-normal lg:text-lg lg:leading-normal">Learn everything you need to get started on the acoustic<br class="hidden sm:inline-block"> guitar and start playing music as fast as possible!</div>',
        $lessons = [
            [
            'title' => "Becoming Familiar With Your Acoustic Guitar",
            'description' => "Get to know your guitar! You’ll know each part of your guitar, the name of all the strings, and how to get it in perfect tune.",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-01.jpg',
            ],
            [
            'title' => "SOUNDING GOOD",
            'description' => "You’re ready for your first chords! You’ll learn two-chord shapes and how to play them clearly and cleanly.",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-02.jpg',
            ],
            [
            'title' => "STRUMMING BASICS",
            'description' => "This is essential! You’ll get the correct motion of your wrist down so you can play three different strumming patterns.",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-03.jpg',
            ],
            [
            'title' => "START MAKING MUSIC",
            'description' => "More chords! You’ll master 5 more basic guitar chords every player should know. With these alone you’ll be able to play hundreds of popular songs.",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-04.jpg',
            ],
            [
            'title' => "PLAY A SONG",
            'description' => "Put everything together! You’ll understand how to apply these chords and put them together to create different progressions and play along with the backing track!",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-05.jpg',
            ],
            [
            'title' => "PAVE YOUR OWN PATH",
            'description' => "You did it! With these chords and strumming patterns, you already know how to play hundreds of songs. But this is just the beginning...",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-06.jpg',
            ],
        ],
    ])

    @include('guitareo.lead-gen.partials._lesson2', [
        "bg" => "linear-gradient(to bottom, #01051b, #032b33)",
        "headLine" => "The <strong> Beginner Guitarist’s </strong> Guide to…",
        "lessons" => [
                        [
                        'title' => "TIMING & RHYTHM",
                        'description' => "Learn to strum three different patterns in time with a jam track.",
                        'icon' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/timing_icon.svg',
                        ],
                        [
                        'title' => "PLAYING YOUR FIRST SONG",
                        'description' => "Play a real song along with Ayla and the jam track.",
                        'icon' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/music_icon.svg',
                        ],
                        [
                        'title' => "MAKING MUSIC",
                        'description' => "Get started with a handful of chords to put together in your own chord progression.",
                        'icon' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/question_icon.svg',
                        ],
                        [
                        'title' => "QUESTIONS ANSWERED",
                        'description' => "Get personalized feedback and support from real teachers.",
                        'icon' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/guitar_icon.svg',
                        ],
                    ]
    ])

    @include('guitareo.lead-gen.partials._meet-your-teacher1', [
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/coach-bg.jpg",
        "bgColor" => "#010416",
        "meetYourTeacher" => '<h3>Meet your teacher...</h3>',
        "name" => '<h1 class="leading-tight" style="background: linear-gradient(to bottom, #39e5b6, #6cb6d6);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>Ayla Tesler-Mabe</strong></h1>',
        "desc" => "Ayla Tesler-Mabe has made a splash in the music industry as a professional guitarist, vocalist, and songwriter -- playing in popular bands including Ludic and formally Calpurnia. And while she’s actively creating new music and performing, Ayla’s also passionate about helping students through Guitareo every day!
        <br><br>
        Ayla’s no stranger to answering questions candidly, lending advice, and starting conversations about all things guitar -- and her teaching style makes students feel comfortable and encouraged, so you’ll keep practicing and developing your skills.",
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
        "id" => "trailer",
        "url" => "//player.vimeo.com/video/678469858?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "slap",
        "url" => "https://www.youtube.com/embed/qqrYZlW4Hjg?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "delay",
        "url" => "https://www.youtube.com/embed/C3f0HC0-J10?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "fret",
        "url" => "https://www.youtube.com/embed/PILuE378Mj4?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._enter-email', [
        "bgColor" => "linear-gradient(to bottom, #042932, #010317)",
        "img" => '<img class="h-14 sm:h-20 lg:h-28 mx-auto" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/logo.png" alt="logo" />',
        "text" => '<div class="leading-tight text-lg md:leading-tight md:text-2xl lg:leading-tight lg:text-3xl my-5 md:my-8">Enter your email below to get<br class="inline sm:hidden"> the ENTIRE 6-video course.</div>',
        "formId" => "Guitareo - Engagement - Trigger - Getting Started On The Acoustic Guitar - Web Form",
        "formName" => "Getting Started On The Acoustic Guitar",
    ])
@stop
