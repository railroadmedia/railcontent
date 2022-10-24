@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <title>Play Your First Song On The Guitar | 1-Hour Challenge</title>
    <meta name="description" content="Rob Scallon will lead you on a guitar adventure with 9 free videos to gain the fundamentals, transition between chords, and play a full song from start to finish. Are you up for the challenge?"/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/og-image.jpg">
    <meta property="og:title" content="Play Your First Song On The Guitar | 1-Hour Challenge">
    <meta property="og:description" content="Play your first song on the guitar, start to finish, in an hour -- even if you’ve never played before.">
    <meta property="og:url" content="https://www.guitareo.com/song-in-an-hour/">


    <link rel="preload" href="/marketing/parcel/guitareo/song-in-an-hour.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="/marketing/parcel/guitareo/song-in-an-hour.css"></noscript>

    <style>
        .reveal-overlay {background: linear-gradient(180deg, rgba(1, 7, 19, 0.9), #10052b);}

        .header-bg {
            background-image: url('https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg');
        }

        .final-pitch {
            background-image: url('https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/order-background.jpg');
        }

        .meet-rob {
            background-image: url('https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/teacher-background-mobile.jpg');
        }

        @media (min-width: 768px) {
            .header-bg {
                background-image: url('https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg');
            }

            .final-pitch {
                background-image: url('https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/order-background.jpg');
            }

            .meet-rob {
                background-image: url('https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/teacher-background.jpg');
            }
        }

        @media (min-width: 1024px) {
            .header-bg {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg');
            }

            .final-pitch {
                background-image: url('https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/order-background.jpg');
            }

            .meet-rob {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/guitar-tricks/teacher-background.jpg');
            }
        }
    </style>
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $(".infusion-form").submit(function(event) {
                if(event.originalEvent != null) {
                    var formId = $(this).find('input[name="inf_form_xid"]').val();

                    dataLayer.push({
                        'event': 'gtm.formSubmit',
                        'formId': formId,
                        'formSuccess': true
                    });
                }
            });
        });
    </script>
    <script src="/marketing/parcel/guitareo/modal-autoplay.js"></script>
@stop

@section('body')

    @include('guitareo.lead-gen.partials._header1', [
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/header.jpg",
        "bgColor" => "black",
        "imgs" => [
            '<img class="logo guitar-quest mx-auto mb-2 sm:mb-5" src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://guitareo.s3.amazonaws.com/shop/logos/guitar-quest-logo.png" alt="guitar-quest-logo">',
            '<img class="logo mx-auto" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-purple.png" alt="song-in-an-hour-logo">',
        ],
        "playButton" => "down",
        "headLine" => "<h1 class='font-bison-bold leading-none text-3xl md:text-5xl lg:text-6xl'><strong>PLAY YOUR FIRST SONG ON THE<br> GUITAR, START TO FINISH, IN AN HOUR.</strong></h1>
        <h2 class='text-lg mt-5 mb-8 text-yellow md:text-xl lg:text-2xl'>Even if you've never played before!</h2>",
        "formId" => "Guitareo - Engagement - Trigger - Song Hour - Web Form",
        "formName" => "Song Hour",
        "redirectURL" => "/song-in-an-hour/thank-you",
        "submitButtonColor" => 'linear-gradient(180deg,#ffd500,#ffb600)',
    ])

    <section class="pt-7 px-3 md:px-4 md:pt-12 lg:pt-16" style=" background:#010611;">
        <div class="w-3/4 md:w-full sm:flex items-start lg:items-center mx-auto text-left text-white md:px-2 md:px-4" style="max-width:1000px;">
            <img class="w-28 md:w-48 lg:w-60 mb-5 sm:mb-0 sm:mr-5 lg:mr-10" src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/rob-stopwatch.png" alt="rob-stopwatch-img">
            <div>
                <h1 class="mb-6 text-lg md:text-xl lg:text-2xl">Get your stopwatch ready. <strong>You WILL play your first song…</strong></h1>
                <p class="leading-normal">Getting started on the guitar can feel daunting. This challenge was designed to get you started faster with a single focus: let’s play a song!
                <br><br>
                Rob Scallon will lead you on an adventure with 9 free videos to gain the fundamentals, transition between chords, and play a full song from start to finish. Are you up for the challenge?</p>
            </div>
        </div>
    </section>

    @include('guitareo.lead-gen.partials._lesson3', [
        "bg" => "#010611",
        "headLine" => '',
        "subHeadLine" => '',
        "lessonTitleFont" => 'font-bison-bold',
        "lessons" => [
            [
            'title' => "SONG IN AN HOUR CHALLENGE",
            'description' => "Your guitar adventure begins. Are you going to join the challenge to play your first song in just one hour?",
            'image' => 'https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/thumb-trailer.jpg',
            'playButton' => true,
            "dataOpen" => 'trailer',
            ],
            [
            'title' => "HOW TO HOLD THE GUITAR",
            'description' => "Learn how to hold your guitar so it’s comfortable and ready to play.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-2.png',
            ],
            [
            'title' => "SETTING UP YOUR GUITAR",
            'description' => "We’ll show you each string on your guitar and help you play it in perfect tune.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-3.png',
            ],
            [
            'title' => "STRUMMING FUNDAMENTALS",
            'description' => "This is an essential skill -- and you’ll start strumming up and down so each note rings out clearly.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-4.png',
            ],
            [
            'title' => "YOUR FIRST CHORD",
            'description' => "Start playing the easiest chord and quite possibly the greatest chord -- the G chord.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-5.png',
            ],
            [
            'title' => "BETTER PRACTICE",
            'description' => "You’ll need one more easy chord to complete the song -- and learn how to transition between chords.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-6.png',
            ],
            [
            'title' => "PLAY YOUR FIRST SONG",
            'description' => "You’ll start playing -- putting everything you’ve learned to play a full song with a band!",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-7.png',
            ],
            [
            'title' => '<span class="text-yellow">BONUS - </span> WRITING A MELODY',
            'description' => "Explore the fretboard freely and come up with a melody to write your very first song.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-8.png',
            ],
            [
            'title' => '<span class="text-yellow">BONUS - </span> YOUR NEXT STEPS ON THE GUITAR',
            'description' => "Practice everything you learned in this challenge to become confident in your skills before moving on.",
            'image' => 'https://d1923uyy6spedc.cloudfront.net/Guitar-Quest-1-9.png',
            ],
        ],
    ])

    @include('guitareo.lead-gen.partials._lesson4', [
        "headLine" => "THE NEW GUITARIST'S GUIDE TO... ",
        "lessons" => [
            [
                "icon" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/checkmark.png",
                "title" => "PLAYING YOUR FIRST SONG",
                "description" => "Play a song, start to finish, faster than you thought possible.",
            ],
            [
                "icon" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/checkmark.png",
                "title" => "GAINING MOMENTUM",
                "description" => "Starting on the guitar should be fun. You’ll fall in love once you’re playing music!",
            ],
            [
                "icon" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/checkmark.png",
                "title" => "TIMING & RHYTHM",
                "description" => "Learn to strum in time with a full band to improve your rhythm.",
            ],
            [
                "icon" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/checkmark.png",
                "title" => "JAMMING WITH A BAND",
                "description" => "Enjoy play-along jam tracks for an interactive experience.",
            ],
            [
                "icon" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/checkmark.png",
                "title" => "WRITING YOUR FIRST MELODY",
                "description" => "Get started with melodies and writing your own tunes right away.",
            ],
            [
                "icon" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/checkmark.png",
                "title" => "HAVING FUN",
                "description" => "That’s what it’s all about, right? And with Rob Scallon, it’s all but guaranteed.",
            ],
        ]
    ])

    @include('guitareo.lead-gen.partials._meet-your-teacher1', [
      "font" => "font-bison-bold",
      "bgColor" => "black",
      "meetYourTeacher" => '<div class="text-yellow text-lg md:text-xl lg:text-2xl">Meet your teacher...</div>',
      "name" => '<h1 class="font-bison-bold leading-none text-5xl md:text-6xl lg:text-8xl"><strong>ROB SCALLON</strong></h1>',
      "desc" => "Rob Scallon plays guitar for the internet -- with 2M Subscribers on YouTube and counting -- and now he’s sharing his best tips to help YOU get more out of this amazing instrument.",
      "asSeenColor" => "text-yellow",
      "thumbnails" => [
        [
            "src" => "https://img.youtube.com/vi/wC9QTHv2eQ4/mqdefault.jpg",
            "desc" => "Slap Guitar 101",
            "views" => '<em class="text-yellow">2.8m views</em>',
            "dataOpen" => "slap",
        ],
        [
            "src" => "https://img.youtube.com/vi/MNzBFgwkU0A/mqdefault.jpg",
            "desc" => "Getting Delay<br> w/o Effects</strong>",
            "views" => '<em class="text-yellow">6.4m views</em>',
            "dataOpen" => "delay",
        ],
        [
            "src" => "https://img.youtube.com/vi/EjHDp_bDjeU/mqdefault.jpg",
            "desc" => "One Fret Song",
            "views" => '<em class="text-yellow">4.8m views</em>',
            "dataOpen" => "fret",
        ],
      ]
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "trailer",
        "url" => "//player.vimeo.com/video/489918210?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "slap",
        "url" => "https://www.youtube.com/embed/wC9QTHv2eQ4?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "delay",
        "url" => "https://www.youtube.com/embed/MNzBFgwkU0A?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._video-player',[
        "id" => "fret",
        "url" => "https://www.youtube.com/embed/EjHDp_bDjeU?autoplay=1",
    ])

    @include('guitareo.lead-gen.partials._enter-email', [
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/order-background.jpg",
        "img" => '<img class="h-14 sm:h-20 lg:h-28 mx-auto" src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/song-in-an-hour/logo-purple.png" alt="song-in-an-hour-logo" />',
        "text" => '<div class="leading-tight text-lg my-5 md:my-8 md:text-2xl lg:text-3xl">Enter your email below<br class="inline md:hidden"> to get started!</div>',
        "formId" => "Guitareo1 - Engagement - Trigger - Song Hour - Web Form",
        "formName" => 'Song Hour',
        "redirectURL" => "/song-in-an-hour/thank-you",
        "submitButtonColor" => 'linear-gradient(180deg,#ffd500,#ffb600)',
    ])
@stop
