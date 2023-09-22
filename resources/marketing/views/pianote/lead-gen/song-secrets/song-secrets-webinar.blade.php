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
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])


    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-14 sm:h-18 lg:h-20 mb-1 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" alt="logo" fetchpriority="high">
                    <h1 class=""><strong>30 days to</strong></h1>
                    <h2 class="sm:-mt-1 lg:mt-0">better piano chords.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever <br class="inline lg:hidden">class starting June 5th.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video" style="padding-bottom: 75%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/header-image-m.png" alt="header image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-pianote"></i> Learn by doing
                        <i class="ml-2 fas fa-check text-pianote"></i> Play every day
                        <i class="ml-2 fas fa-check text-pianote"></i> No theory required</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Play  <br>every day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> No theory <br> required</p>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
                            <span class="join sold-out medium w-full" data-open="waitlistModal">JOIN WAITLIST</span>
{{--                                <a href="#final" class="join medium w-full anchor-slide">ENROLL NOW</a>--}}
                            <p class="opacity-50 text-sm mt-2 mb-5 sm:mb-0 underline hover:text-pianote">
                                <a href="https://www.musora.com/pianote/enrollment/easy-chords">Pianote Members register for free here.</a>
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/piano-players.png" alt="joined student profiles" fetchpriority="high">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-pointer autoplay-video" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/header-image.png" alt="header image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">

            <img class="h-56 inline sm:hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/intro-image.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="text-center mt-5 sm:mt-0"><strong>Why chords?</strong></h2>
            <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7 lg:mb-10 uppercase text-pianote">We’re so glad you asked…</p>

            <div class="text-left flex flex-wrap sm:flex-nowrap mb-32 sm:mb-56 lg:mb-72">
                <p class="leading-normal max-w-lg pr-7">Chords are the foundation of music.
                    <br><br>
                    All music (even classical) is made from chords. The songs you love to listen to and play are little more than chord progressions with a melody on top. When you know how to play beautiful chord progressions, your playing will sound better, you’ll be more confident, and you’ll have more fun.
                    <br><br>
                    And no, you don’t need to understand any complex theory.
                    <br><br>
                    Easy Chords will bridge the gap between knowing about chords, and actually being able to use them. You’ll learn popular progressions, chord inversions, and rhythms to enhance your playing and take you beyond a beginner.
                    <br><br>
                    And it only takes 10 minutes a day, 5 days a week.
                    <br><br>
                    That’s less time than it takes for a trip to the grocery store.</p>
                <img class="h-96 hidden sm:inline transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/intro-image.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <div class=" aspect-16:9  cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96" data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/trailer.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>


        </div>
    </section>
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <p class="leading-normal mt-4 lg:mt-6">Piano chords changed my life.
                        <br><br>
                        I grew up learning classical piano through the Royal Conservatory. I didn’t know what chords were, or how they were used in composition.
                        <br><br>
                        I just had to read the notes on the page and play them.
                        <br><br>
                        That all changed the day I discovered chords and chord inversions.
                        <br><br>
                        Suddenly I could start improvising, creating my own rhythms and melodies, and eventually write my own music. Music became something I “created” rather than something I “played”.
                        <br><br>
                        Chords gave me the ability and confidence to do what we all dream of doing…
                        <br><br>
                        Sit down at the piano and “just play”.
                        <br><br>
                        If you’ve ever dreamt of playing popular songs for your family and friends without spending months learning every note. Or if you’ve ever wanted to explore improvisation and song-writing. Or if you just want to sit and play the keys and see what comes out…
                        <br><br>
                        You need to try Easy Chords.
                        <br><br>
                        Over 30 days, I’ll guide you through the stages I used to learn and feel comfortable playing piano chords. You’ll discover how chord inversions will transform your playing and make it easier to play the songs you love.
                        <br><br>
                        Come join me.
                    </p>
                    <img class="float-right h-12 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/lisa-witt-signature.png" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>

            <h3 class="leading-tight mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What students are saying about<br class="inline lg:hidden"> Lisa and her teaching style:</strong></h3>



        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#eff7ff;">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center justify-center">
                <div class="text-center w-full sm:w-7/12 lg:w-1/3 mb-7 lg:mb-0">
                    <img class="h-20 md:h-24 lg:h-28 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/easy-chords/logo.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <h4 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5"><strong>
                            20 Guided Play-Along Lessons.<br>
                            Feedback From Real Teachers.<br>
                            Lifetime Course Access.
                        </strong></h4>
                    <div class="w-full mx-auto sm:mx-0">
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Master your chord changes & inversions.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Course runs June 5 to July 5.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i>  Choose your best option to get started.</p>
                    </div>
                    <span class="join sold-out medium w-full align-middle" data-open="waitlistModal">JOIN WAITLIST</span>
                </div>

            </div>
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Why do I need to register if I get it for free as a member?",
                "desc" => "It’s a 30-day course and it only works if you’re actively participating. So we wanted to make sure you raised your hand to enroll in the journey.<br><br>This isn’t a “watch a lesson, go do something else for 10 days, watch another” type of routine. So we’re asking for a commitment from anybody who participates.",
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What if I miss a day (or two)?",
                "desc" => "That’s totally fine. The course is meant to be flexible if you miss a day here or there. There are a few buffer days mixed in PLUS the lessons are short enough that you could watch 2-3 in a single session if you ever need to catch up.",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "Do I need a digital piano or software?",
                "desc" => "No! This course works with all pianos and keyboards. You don’t have to plug anything in and you don't need any fancy plugins or software. Simply click play on your lesson, and follow along!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "How much time per week will this course require?",
                "desc" => "Easy Chords gives you guided daily piano lessons for thirty days – with a few flex days built in for when life happens. Each lesson is only 10 minutes. We’ve made it short so you’re more likely to keep playing!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "Easy Chords is available on your laptop, tablet, or phone. You’ll also have access through the Musora App after you’ve completed your purchase of the course.",
                "num" => '?',
                ])
            </div>
            <div class="inline-block w-full px-3 md:px-4 my-5" style="color:#2a2f34;">
                <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 mb-10" style="color:#2a2f34;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/823788317?h=b2955e3bc7&autoplay=1',
        "title" => 'trailer'
    ])

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
