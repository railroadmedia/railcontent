@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Song Secrets | Pianote</title>
    <meta property="og:title" content="Song Secrets | Pianote">

    <meta name="description" content="The Fastest Way to Play Popular Songs on the Piano">
    <meta property="og:description" content="The Fastest Way to Play Popular Songs on the Piano">

    <meta property="og:image" content="TODO" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
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
            background: #F61A30;
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
            background:#ff5454;
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
            color:#F61A30
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
        .timeline-container .timeline:after,
        .timeline-container:after {
            background-color: #f61a30;
        }
        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }
        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color:#eb1a2f;

        }

        .image-modal-arrow-left, .image-modal-arrow-right {
            font-size: 0;
            position: absolute;
            transform: translate(0, -50%);
            background: #FFF;
            transition: opacity .3s;
            border-radius: 100px;
            height: auto;
            width: auto;
            z-index: 10;
            padding: 3px 10px;
            margin: 0;
            bottom: unset;
            top: 50%;
        }

        .image-modal-arrow-left {
            left: 0;
        }

        .image-modal-arrow-right {
            right: 0;
        }

        .image-modal-arrow-left::before, .image-modal-arrow-right::before {
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            opacity: 1;
            line-height: 1;
            font-family: "Font Awesome 5 Pro";
            font-weight: 300;
            color: #f61a30;
            font-size: 28px;
        }

        .image-modal-arrow-left::before {
            content: "\f104";
        }

        .image-modal-arrow-right::before {
            content: "\f105";
        }
        .join.white {
            color:#f61a30;
        }

        .splide__arrow svg {
            fill: #f61a30 !important;
        }
    </style>
@stop()

@section('body-data')
    x-data="{
    trailer: false,
    enroll: false
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])


    <header class="px-5 sm:px-6 pt-10 pb-80 sm:py-14 lg:py-20 xl:py-36 text-white relative" style="background:#f5f8fb;">
        <div class="inset-0 hidden sm:block absolute bg-center bg-cover z-0 mx-auto" style="max-width:1920px;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/header-image.png');"></div>
        <div class="inset-0 block sm:hidden absolute bg-bottom bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/header-image-m.png');"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="w-full sm:w-1/2 text-center lg:text-left">
                <h3 class="font-bebas tracking-widest mb-1 sm:mb-0 lg:mb-3">SONG SECRETS</h3>
                <h3 class="leading-tight"><strong>The Fastest Way to Play <br class="sm:hidden"> Popular Songs on the Piano</strong></h3>
                <p class="leading-normal text-sm my-3 sm:my-5 max-w-xs sm:max-w-full"><em>Proven strategies to help you play the songs you love on the piano - <u>no matter what your age or experience level!</u> It’s never too late to play the songs you love on the piano. I’ll show you how!</em></p>
                <div @click="enroll = true;" class="join white medium">ENROLL NOW FOR FREE</div>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 pt-10 sm:pt-14 lg:pt-20" style="    background-color: #f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <div class="text-left flex flex-wrap sm:flex-nowrap">
                <div class="sm:pr-7">
                    <h4 class="leading-tight"><strong>You’ll be playing a song in 60 minutes!</strong></h4>
                    <p class="text-pianote mt-2 mb-4"><em>(Well, more like 10 minutes once you start playing.)</em></p>
                    <img class="h-48 inline sm:hidden transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/header-collage-m.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="leading-normal">And I know it’s true because I’ve done it for thousands of students just like you. With a few simple tips and secrets, you’ll be able to play hundreds of songs for yourself and your loved ones.
                        <br><br>
                        Imagine the surprise when they hear you play!
                        <br><br>
                        So how does it work? Register for your FREE Webinar and I’ll show you:</p>
                    <ul class="ml-4 sm:ml-5 fa-ul my-4">
                        <li class="font-bold"><i class="fa-li mr-1 text-pianote fas fa-check"></i> What traditional lessons won’t teach you</li>
                        <li class="font-bold"><i class="fa-li mr-1 text-pianote fas fa-check"></i> How to play music WITHOUT needing to know all the notes</li>
                        <li class="font-bold"><i class="fa-li mr-1 text-pianote fas fa-check"></i> The alternative to sheet music that makes playing songs so much easier - and FUN</li>
                    </ul>
                    <p class="leading-normal">It’s 100% FREE. Simply click below and get ready to see the piano in a whole new light:</p>
                </div>
                <img class="h-80 lg:h-96 hidden sm:inline transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/header-collage.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
            <div @click="enroll = true;" class="join medium mx-auto -mb-6 mt-8 sm:mt-14">ENROLL NOW</div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 mb-32 sm:mb-56 lg:mb-72">
        <div class="container max-w-4xl mx-auto">
            <h3 class="mb-10"><strong>In just 60 minutes, you’ll know…</strong></h3>
            <div class="flex flex-wrap text-center">
                <div class="w-full sm:w-1/3 px-3 mb-4 sm:mb-0">
                    <img class="h-12 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/chords-any-key.svg"></img>
                    <p class="leading-tight mt-5 mb-1"><strong class="font-black">How To Play Chords on ANY Key</strong></p>
                    <p class="leading-tight">Chords are your secret weapon for playing the songs you love. Major. Minor. You’ll learn them!</p>
                </div>
                <div class="w-full sm:w-1/3 px-3 mb-4 sm:mb-0">
                    <img class="h-12 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/ultimate-sheet-music.svg"></img>
                    <p class="leading-tight mt-5 mb-1"><strong class="font-black">The Ultimate Sheet Music Hack</strong></p>
                    <p class="leading-tight">You don’t need to read complicated music to play songs. There’s an easier way.</p>
                </div>
                <div class="w-full sm:w-1/3 px-3">
                    <img class="h-12 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/4-chords.svg"></img>
                    <p class="leading-tight mt-5 mb-1"><strong class="font-black">How To Play 100s of Songs</strong></p>
                    <p class="leading-tight">You’ll learn how to play a chord on ANY key. And use those chords to play 100s of songs.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto -mt-36 sm:-mt-64 lg:-mt-96">
            <h3 class="leading-tight mb-7"><strong>So how is this different?</strong></h3>
            <div class="relative cursor-pointer" x-on:click="trailer = true;">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <img class="rounded-xl overflow-hidden  h-44 sm:h-96" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/trailer.jpg"></img>
            </div>
           <br>
            <img class="h-9 sm:h-11 my-5 sm:my-8" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/dear-fellow.png"></img>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-2 items-stretch text-left mb-5 sm:mb-8">
                <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 h-full flex lg:block">
                    <img class="h-12 lg:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/nervous-icon.svg"></img>
                    <p class="leading-normal text-sm pl-4 lg:pl-0">If you’re <strong class="font-black">nervous</strong> because you tried learning in the past but had a bad experience…</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 h-full flex lg:block">
                    <img class="h-12 lg:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/struggling-icon.svg"></img>
                    <p class="leading-normal text-sm pl-4 lg:pl-0">If you’re <strong class="font-black">struggling</strong> to figure out how to make progress on this instrument…</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 h-full flex lg:block">
                    <img class="h-12 lg:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/overwhelmed-icon.svg"></img>
                    <p class="leading-normal text-sm pl-4 lg:pl-0">If you’re <strong class="font-black">overwhelmed</strong> by the traditional approach of note reading and just want to have fun playing the songs you love…</p>
                </div>
                <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 h-full flex lg:block">
                    <img class="h-12 lg:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/skeptical-icon.svg"></img>
                    <p class="leading-normal text-sm pl-4 lg:pl-0">If you’re <strong class="font-black">skeptical</strong> of the promises made by so many online courses and videos…</p>
                </div>
            </div>

            <p class="leading-tight max-w-xl mx-auto mb-5"><strong>This Webinar will change everything.</strong> Over 60 minutes, I’ll show you exactly how to start playing the songs you love without fear or frustration.
            <br><br>
            It’ll be a lot of fun. And it won’t cost you a cent.
                <br><br>
                <span class="uppercase text-pianote">All you have to do, is click to enroll.</span></p>
            <div class="relative w-auto inline-block px-12">
                <img class="absolute -mt-3 top-0 left-0 h-12" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/arrow.svg">
                <img class="absolute -mt-3 top-0 right-0 h-12" style="transform: scaleX(-1);" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/arrow.svg">
                <div @click="enroll = true;" class="join medium">ENROLL NOW</div>
            </div>


        </div>
    </section>
    <section class="text-center px-3 sm:px-6 pb-10 sm:pb-14 lg:pb-20">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/lisa-witt-profile-m.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/lisa-witt-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h2 class="text-center sm:text-left"><strong>Hello my friend! I’m Lisa.</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">The day I discovered the simple way to play my favorite songs on the piano was my AHA moment. And it changed my life!
                        <br><br>
                        I grew up taking traditional classical piano lessons, and I struggled. I couldn’t read music very well and even had to repeat a piano grade. But the day I learned about chords was the day I really started to enjoy the piano.
                        <br><br>
                        I realized that I didn’t have to read every single note on a page…
                        <br><br>
                        I didn’t have to memorize countless rules and complex theory…
                        <br><br>
                        And I could play the songs I wanted to play in MINUTES -- not months.
                        <br><br>
                        It was freedom.
                        <br><br>
                        And it led me to dedicate my life to teaching others. Since that day, I’ve made it my life’s work to show students that you CAN play the songs you love.
                        <br><br>
                        And if you’re willing to give me just a little bit of your time, I’ll show you too.
                    </p>
                </div>
            </div>

            <h3 class="leading-tight mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What students are saying about Lisa:</strong></h3>
            <div class="mb-5 sm:mb-7"
                    x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-pianote',
                                    prev: 'hidden',
                                    next: 'splide__arrow--next hidden sm:flex mb-16',
                                    pagination: 'splide__pagination bottom-0',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            drag   : 'free',
                            snap   : false,
                            breakpoints: {
                                1023: {
                                    perPage: 1.5,
                                },
                                639: {
                                    perPage: 1,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">
                            @php
                                $testimonials = [
                                    [
                                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jessripley.jpg',
                                    'title' => "I’m blown away by the program you’ve created.",
                                    'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
                                    'name' => 'Jess Ripley',
                                    'location' => 'California, USA',
                                    ],
                                    [
                                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/serenadorward.jpg',
                                    'title' => "If I was taught this way as a child, I would have never quit.",
                                    'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                                    'name' => 'Serena Dorward',
                                    'location' => 'Ontario, Canada',
                                    ],
                                    [
                                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/jaydemcintosh.jpg',
                                    'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
                                    'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
                                    'name' => 'Jayde McIntosh',
                                    'video' => '660596722',
                                    'location' => 'Australia',
                                    ],
                                    [
                                    'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/testimonials/iankershaw.jpg',
                                    'title' => "Such a fantastic and welcoming student community.",
                                    'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                                    'name' => 'Ian Kershaw',
                                    'video' => '660596700',
                                    'location' => 'United Kingdom',
                                    ],
                                ]
                //                @endphp
                            @foreach ($testimonials as $key => $testimonial)
                                <li class="splide__slide px-2 flex">
                                    <div class="p-7 border border-black rounded-lg">
                                        <div class="sm:flex items-start justify-start mb-3">
                                            <img class="h-14 sm:h-16 rounded-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=160,quality=95/{{ $testimonial['image'] }}" alt="testimonial {{ $key }}" loading="lazy" onload="this.classList.remove('opacity-0')">
                                            <p class="sm:pl-4 mx-0"><strong>{{ $testimonial['name'] }}</strong><br>
                                                <em class="leading-tight inline-block mb-1 opacity-60">{{ $testimonial['location'] }}</em></p>
                                        </div>
                                        <p>“{!! $testimonial['description']  !!}”</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <h3 class="leading-tight mb-4"><strong>Trusted by pianists<br class="inline-block sm:hidden">  everywhere.</strong></h3>
            <p class="mx-auto mb-7">Check out the reviews and meet some of our friendly students.</p>
            <a class="inline-block w-full" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                <img alt="shopper approved image" class="h-8 sm:h-9 lg:h-10 mb-2 mx-auto transition-opacity" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/shopper-approved.png" loading="lazy" onload="this.classList.remove('opacity-0')">
                <p class="mx-auto text-sm ">Rated <strong>4.8</strong> / 5 based on 6,654 student reviews. <span class="inline-block  text-pianote ">See the reviews »</span></p>

            </a>
            <div class="flex flex-wrap items-start justify-center mx-auto mt-2 sm:mt-6">
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color:#cd201f;">
                    <a href="https://www.youtube.com/pianolessonscom/" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-4xl sm:text-5xl" aria-hidden="true"></i>
                    </a>
                    <h2 class="font-black leading-none my-1 sm:my-2 text-black">1.3M</h2>
                    <p class="uppercase sm:tracking-widest">Subscribers</p>
                </div>
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color:#3b5998;">
                    <a href="https://facebook.com/pianoteofficial/" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-4xl sm:text-5xl" aria-hidden="true"></i> </a>
                    <h2 class="font-black leading-none my-1 sm:my-2 text-black">430K</h2>
                    <p class="uppercase sm:tracking-widest">Likes</p>
                </div>
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5 instagram">
                    <a href="https://instagram.com/pianoteofficial/" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-4xl sm:text-5xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;" aria-hidden="true"></i>
                    </a>
                    <h2 class="font-black leading-none my-1 sm:my-2">200K</h2>
                    <p class="uppercase sm:tracking-widest" style="color:#E1306C">Followers</p>
                </div>
            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white bg-cover bg-center" style="background:#ac1179 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/song-secrets/order-bg.jpg');">
        <div class="container max-w-xl lg:max-w-2xl mx-auto">
            <p class="text-musora uppercase">It’s your turn…</p>
            <h3 class="font-bebas tracking-widest my-4">SONG SECRETS</h3>
            <h3 class="leading-tight"><strong>The Fastest Way to Play<br> Popular Songs on the Piano</strong></h3>
            <p class="leading-normal mt-4 mb-8"><strong>Click below to choose a date and time that works for YOU!</strong> Get proven strategies to help you play the songs you love on the piano - no matter what age! It’s never too late to play the songs you love on the piano. I’ll show you how!</p>
            <div @click="enroll = true;" class="join white">ENROLL FOR FREE NOW</div>
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2 class="mb-4 sm:mb-10"><strong>Still have questions?</strong></h2>
            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "So how does this work?",
            "desc" => "This is a Webinar. When you click “ENROLL NOW” you’ll be able to choose a time and date that works for you! The video lessons are not live, but you’ll be able to ask questions and get answers from our team of moderators who will be in the chat.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "What will I learn?",
            "desc" => "You’ll get the secrets and tips to play popular songs on the piano. During the 60 minutes, Lisa will break down how to use chords and lead sheets to sound beautiful. Think of it as your first piano lesson for a new way of playing.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "Do I have to watch it all at once?",
            "desc" => "When you register, you’ll be able to choose your preferred date and time. We’d encourage you to pick a time that will allow you to watch the entire thing. During that time, you won’t be able to pause or rewind it. But if you can’t make it through the whole thing, that’s ok! You’ll be able to replay the Webinar any time and you can pause or rewind during the replay.",
            ])

            @include('_partials.components.question-dropdown', [
            "num" => "?",
            "title" => "What are you selling?",
            "desc" => "Our goal is to inspire and educate piano players around the world. The Webinar will introduce you to Lisa’s method of playing which doesn’t require years of practice and reading music. You’ll learn a lot just from watching. Then, at the end, if you decide this style of learning is right for you, Lisa will let you know about her online learning platform that uses this style. There’s absolutely no obligation.",
            ])
        </div>
    </section>

@component('_partials.components.modal', ['name' => 'enroll'])
@slot('content')
<div class="relative overflow-y-visible max-w-3xl text-black bg-white mx-auto rounded-xl shadow-lg text-center">
    <noscript><div style="text-align: center; margin-top: 1em; text-decoration: none; undefined"><a style="color: #000; font-size: 13px;" href="https://www.pianote.com/song-secrets-webinar">ENROLL NOW</a></div></noscript><style>.ewebinar__RegForm { font-family: inherit; padding: 0; text-align: left; min-width: 300px; max-width: 450px; margin: auto; } .ewebinar__RegForm a:hover, .ewebinar__RegForm a:visited, .ewebinar__RegForm a:link, .ewebinar__RegForm a:active { text-decoration: none; } .ewebinar__RegForm * { box-sizing: border-box; } .ewebinar__RegForm:not(.loading) .ewebinar__Dots { opacity: 0; animation: none; } .ewebinar__RegForm__Content { padding: 1.5rem; } .ewebinar__RegForm:not(.ewebinar__RegForm--horizontal) .ewebinar__RegForm__Content { padding-bottom: 0.25rem; } .ewebinar__RegForm__Footer { padding: 1.5rem; padding-top: 0; display: flex; flex-direction: row; justify-content: flex-end; } .ewebinar__RegForm .ewebinar__RegisterButton, .ewebinar__RegForm .ewebinar__RegisterButton__Wrap { max-width: unset !important; width: 100%; } .ewebinar__RegForm__Field { margin-bottom: 1.25rem; } .ewebinar__RegForm__Field input, .ewebinar__RegForm__Field select { font-size: inherit; } .ewebinar__RegForm__Field input { display: block; width: 100%; line-height: 1.21428571em; font-family: inherit; padding: 0.67857143em 1em; background: #fff; border: 1px solid rgba(34, 36, 38, 0.15); color: rgba(0, 0, 0, 0.87); border-radius: 0.28571429rem; box-shadow: none; } .ewebinar__RegForm__Field input::placeholder { color: #dedede !important; } .ewebinar__Session__Dropdown::after { position: absolute; content: '⌄'; font-weight: 600; display: block; right: 1em; top: 50%; transform: translate(-10%, -75%) scale(2, 1.5); pointer-events: none; } .ewebinar__RegForm__Error, .ewebinar__RegForm__Field__Error { color: #ff7470; font-size: 0.8rem; padding: 0.5833em 0.833em; display: none; } .ewebinar__RegForm__Error { margin-top: 0; padding: 0.5833em 0; margin-bottom: 0 !important; text-align: center; } .ewebinar__RegForm__Field__Error { display: none; position: relative; background: #fff; border: 1px solid #ff7470; border-radius: 0.28571429rem; margin-top: 0.5rem; } .ewebinar__RegForm__Field__Error::before { position: absolute; content: ''; background: #fff; border-left: 1px solid; border-top: 1px solid; z-index: 2; width: 0.6666em; height: 0.6666em; margin-top: -1px; border-color: inherit; border-width: 1px 0 0 1px; transform: translateX(-50%) translateY(-50%) rotate(45deg); top: 0; left: 50%; }  @media only screen and (min-width: 992px) {   } .ewebinar__RegForm__Field .ewebinar__Session__Dropdown__Select { height: auto; min-height: 2.58em; } .ewebinar__Session__Dropdown { position: relative; border: none; background: #fff; border-radius: 5px; width: 100%; outline: none; border: 1px solid #444; font-size: 1.1em; } .ewebinar__Session__Dropdown__Select { font-family: inherit; height: 36px; padding: 0 1em; opacity: 1 !important; padding-right: 2.5rem; border: none; border-radius: 0.5em; font-size: 1em; width: 100%; outline: none; -webkit-appearance: none; -moz-appearance: none; appearance: none; } .ewebinar__Session__Dropdown::after { position: absolute; content: '⌄'; font-weight: 600; display: block; right: 1em; top: 50%; transform: translate(-10%, -75%) scale(2, 1.5); pointer-events: none; } .ewebinar__Session__Dropdown__Select:invalid { color: #dedede !important; }.ewebinar__Widget { line-height: 1.5; } .ewebinar__Widget select { display: flex; } .ewebinar__Widget * { box-sizing: border-box; } .ewebinar__RegisterButton { font-family: inherit; box-sizing: border-box; font-family: inherit; position: relative; display: inline-block;   padding: 0.5em 2em; cursor: pointer; border-width: 0px; outline: none; transition: all 0.2s; font-weight: 500; font-size: inherit; box-sizing: border-box; margin: 0; } .ewebinar__RegisterButton * { font-family: inherit; } .ewebinar__RegisterButton:hover { transform: scale(1.02); } .ewebinar__RegisterButton:active {  box-shadow: none; } .ewebinar__RegisterButton .ewebinar__ButtonText { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline; vertical-align: baseline !important;  } @media only screen and (max-width: 614px) { .ewebinar__RegisterButton { max-width: 320px !important; min-height: 42px !important; width: 100% !important; } } .ewebinar__Dots { opacity: 1; animation: 1.5s linear 0s normal forwards 1.5 delayin; position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; } button .ewebinar__Dots { background: #f61a30ff; border-radius: 50px; } .ewebinar__LoadingDot { height: 0.5em; width: 0.5em; border-radius: 100%; display: inline-block; animation: 1.2s ewebinar-loading-dot ease-in-out infinite; } .ewebinar__LoadingDot:nth-of-type(2) { animation-delay: 0.15s; margin-left: 0.5em; } .ewebinar__LoadingDot:nth-of-type(3) { animation-delay: 0.25s; margin-left: 0.5em; } @keyframes delayin { 0% { opacity:0; } 66% { opacity:0; } 100% { opacity:1; } } @keyframes ewebinar-loading-dot { 30% { transform: translateY(-35%); opacity: 0.3; } 60% { transform: translateY(0%); opacity: 0.8; } }</style><div id="w1696026356499" class="ewebinar__Widget ewebinar__RegForm_Root" style="width: 100%;"><form class="ewebinar__RegForm ewebinar--ltr"><div class="ewebinar__RegForm__Content"><div><div class="ewebinar__RegForm__Field ewebinar__RegForm__Field--Sessions"><div class="ewebinar__Session__Dropdown" style="color: #f61a30ff; border-color: #f61a30ff;"><select name="session" class="ewebinar__Session__Dropdown__Select ewebinar__Session__Dropdown__Select--placeholder}"><option class="ewebinar__FixedBar__Content__Session__Dropdown__Select" value="" disabled="disabled" selected="selected" hidden="">Getting sessions...</option></select></div><div class="ewebinar__RegForm__Field__Error"></div></div><div class="ewebinar__RegForm__Field"><div class="ewebinar__RegForm__Field__Input"><input id="name" name="name" placeholder="Name"></div><div class="ewebinar__RegForm__Field__Error"></div></div><div class="ewebinar__RegForm__Field"><div class="ewebinar__RegForm__Field__Input"><input id="email" name="email" placeholder="Email"></div><div class="ewebinar__RegForm__Field__Error"></div></div></div><div class="ewebinar__RegForm__Captcha"></div><div class="ewebinar__RegForm__Error"></div></div><div class="ewebinar__RegForm__Footer"><a class="ewebinar__RegisterButton__Wrap ewebinar--ltr" href="javascript:;" style="text-decoration: none; undefined;"><button class="ewebinar__Widget ewebinar__RegisterButton" type="submit" style="margin-bottom:0;border-radius: 50px; background: #f61a30ff; color: #ffffff; undefined"><div class="ewebinar__Dots"><span class="ewebinar__LoadingDot" style="background: #ffffff"></span><span class="ewebinar__LoadingDot" style="background: #ffffff"></span><span class="ewebinar__LoadingDot" style="background: #ffffff"></span></div><span class="ewebinar__ButtonText" style="white-space: nowrap">ENROLL NOW</span></button></a></div></form></div>
    <script>(function (w,d,s,o,f,js,fjs) { w['eWidget']=o;w[o] = w[o] || function () { (w[o].q = w[o].q || []).push(arguments) }; if(d.getElementById(o)) return; js = d.createElement(s), fjs = d.getElementsByTagName(s)[0]; js.id = o; js.src = f; fjs.parentNode.insertBefore(js, fjs); }(window, document, 'script', '_ew', 'https://app.ewebinar.com/widget.js'));_ew('init', {"root":"w1696026356499","isReview":false,"mode":"public","openInPopup":false,"for":"Registration","type":"RegForm","source":"","url":"https://www.pianote.com/song-secrets-webinar","shortUrl":"https://webinar.pianote.com/webinar/12267","sessions":[],"formType":"LatestForm","ewebinar":{"title":"Pianote%20Webinar%20Test","borderRadius":50,"primaryColor":"#f61a30ff","readableColor":"#ffffff","actionColor":"#f51a2fff","readableActionColor":"#ffffff","readableOnWhiteColor":"#f61a30ff","language":"en"},"showGdprBanner":false,"gdprBannerMode":"Off","gdprBannerText":"","carouselId":"","button":{"btnText":"ENROLL NOW","showButtonTimer":false,"buttonPrimaryColor":"#f61a30ff","buttonReadableColor":"#ffffff","align":"Center","isFullWidth":false},"registerForm":{"horizontal":false,"hideSessionsDropdown":false,"showOnlyBuiltInFields":false,"showFieldsLabel":false,"openLinkInNewWindow":false,"showConsentCheckbox":false,"formSessionType":"ShowDropdown","consentCheckboxText":"","fields":[{"fieldName":"Name","propertyName":"name","type":"Text","subType":null,"isRequired":true,"isRemovable":false,"note":"","options":null,"__typename":"RegistrationFormField"},{"fieldName":"Email","propertyName":"email","type":"Email","subType":null,"isRequired":true,"isRemovable":false,"note":"","options":null,"__typename":"RegistrationFormField"}]}});window.ewInit && window.ewInit();</script>

</div>
@endslot
@endcomponent
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '869353786',
        'vimeo' => true,
    ])

@include("pianote.sales.partials._footer")

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
<script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
