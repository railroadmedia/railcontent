@extends('pianote.lead-gen.chord-hacks.chord-hacks-layout')

@section('meta')
    @parent
    <title>Chord Hacks | Pianote</title>
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
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
        header .disclaimer {
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

    </style>
    <style>
        h1, h2, h3, h4, h5, h6, li, p {
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
            }
        }

        h3 {
            font-size:21px;
        }

        input {
            color:#8D8D8D !important;
            font-size:16px !important;
        }

        @media (min-width:768px) {

            h3 {
                font-size:24px;
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px;
            }
        }
    </style>
@endsection

@section('page-body')
    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left pr-0 sm:pr-6">
                    <img class="h-5 sm:h-6 lg:h-7 mb-1 sm:mb-0 lg:mb-3" src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/logo.svg" alt="logo" fetchpriority="high">
                    <h2 class=""><strong>The easiest way to</strong></h2>
                    <h3 class="sm:-mt-1 lg:mt-0">learn beautiful piano chords.</h3>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-2"><strong>Sign up for 5 FREE play-along lessons</strong></h6>

                    <div class="mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video" style="padding-bottom: 75%;" data-open="trailer">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image-m.png" alt="header image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-2 left-2"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-pianote"></i> Learn by doing
                        <i class="ml-2 fas fa-check text-pianote"></i> No theory required
                        <i class="ml-2 fas fa-check text-pianote"></i> Free lifetime access</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> No theory <br> required</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Free lifetime <br>access</p>
                    </div>

                    <div class="mt-6 sm:mt-5 lg:mt-10">
                        @include("pianote._partials._sign-up-form", [
                        "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                        "formName" => 'Chord Hacks',
                            "buttonText" => "start for free",
                            'stacked' => true,
                            'inputBorder' => '1px solid #747474',
                            'disclaimerColor' => 'rgba(208, 226, 231, 0.8)',
                        ])
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video" data-open="trailer" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image-m.png);">
{{--                        <img class="absolute inset-0" src="" alt="header image" fetchpriority="high" />--}}
                        <div class="join white smaller absolute bottom-2 left-2"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border rounded-lg border-gray-300 mt-8 lg:mt-12 mb-2 lg:mb-4">
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm">Start anytime!</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes a day for just 5 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-piano-keyboard text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Skill Level</strong><br>
                            <span class="text-sm">Beginner.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play your first song.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>
    <section class="text-center text-white pt-6 sm:pt-10 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/tablet-piano-bg.png);">
        <h3 class="leading-tight px-4"><strong>Play beautiful piano in<br class="inline sm:hidden"> minutes - NOT months</strong></h3>
        <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7 px-4">
            It really is this simple. But don’t take our word for it.<br class="hidden sm:inline">
            <span style="color:#da9d19;"><strong>Try a snippet from your 1st lesson</strong> and see if Chord Hacks is right for you.</span>
        </p>
        <div class="relative cursor-pointer autoplay-video" data-open="demoVid">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/tablet-piano-m.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/tablet-piano.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background-color:#010712;">
        <div class="container max-w-4xl mx-auto">
            <p class=" mb-5 sm:mb-8" style="color:#abb5c2">SEE MORE LESSONS</p>
            <div class="flex flex-wrap items-start justify-center text-left">
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/left-hand-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">Now it’s time to work on that left hand. This can be a sticking point for a lot of piano players, but don’t worry - just do what Lisa does!</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/playing-hands-together-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">You have two hands. Use them! You’ll be playing beautiful music with both hands in this 10-minute lesson. Just hit play and follow along.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-fills-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">How do you make your chords sounds extra special? Add some fills! They sound complicated but are easy to do. You’ll learn Lisa’s favorite.</p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <picture class="w-1/3 sm:w-full">
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg">
                        <img
                            class=" rounded-xl mb-3 transition-opacity opacity-0"
                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/chord-inversions-thumb.jpg"
                            alt="grid"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                    </picture>
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">This might be the most important piano lesson you have. It will change how you think about and see piano chords. Are you ready?! (Of course you are!)</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-5xl mx-auto">
            <img class="h-56 inline sm:hidden transition-all opacity-0 mb-5" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/dont-practice-play.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            <div class="text-left flex flex-wrap sm:flex-nowrap items-center">
                <div class=" max-w-lg sm:pr-7">
                    <h2 class="mb-3 sm:mb-7"><strong>Don’t practice -- PLAY!</strong></h2>
                    <p class="leading-normal">Practice makes perfect. But it also makes you question your sanity.
                        <br><br>
                        You’re on your own. It’s repetitive. It doesn’t sound good. And it’s hard.
                        <br><br>
                        That’s why we fixed it.
                        <br><br>
                        With Chord Hacks, you’ll never have to practice, because your lessons ARE the practice! Simply press play and follow along with Lisa as you learn and play beautiful piano chords.</p>
                </div>
                <img class="h-56 lg:h-80 hidden sm:inline transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/dont-practice-play.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </section>
    <section class="px-4 sm:px-6 py-8 sm:pb-0 sm:pt-12 lg:pt-16 relative text-white" style="background: linear-gradient(180deg, #F61A30, #910000);">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-1/2 mx-auto text-center px-10 sm:pl-0 sm:pr-10">
                    <img
                        class="w-full max-w-xs sm:max-w-full transition-all opacity-0"
                        src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/piano-chords.png"
                        alt="scales book" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </div>
                <div class="w-full sm:w-1/2 md:pr-4 lg:pr-0 mt-3 md:mt-0 mx-auto">
                    <h5 class="uppercase mb-2 text-center md:text-left" style="color: #FFAE00;">BONUS</h5>
                    <h2 class="font-extrabold mb-4 text-center md:text-left">
                        Piano Chord<br class="hidden lg:inline"> Chart Download
                    </h2>
                    <p>You won’t just get lessons. Sign up for Chord Hacks and you’ll get a BONUS chord chart with all the major and minor chords that you can save, download, and print.
                        <br><br>
                        Struggling with minor chords? Not anymore.
                        <br><br>
                        It’s yours free when you sign up today.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-8 md:py-16 lg:py-20 relative" style="background:linear-gradient(to bottom,#01050F, #02142a);">
        <div class="container mx-auto relative z-20">
            <div class="flex flex-wrap max-w-6xl mx-auto px-2 lg:px-3">
                <div class="px-3 md:px-4 w-full md:w-5/12 lg:w-5/12">
                    <h4 class="mb-3 text-white">
                        <strong>Is this really free?</strong>
                    </h4>
                    <p style="color:#ABB5C2;">
                        Yes! We love sharing videos to help piano players -- and deep down we hope you’ll see some of the value that we provide inside Pianote juuuuust in case you ever want to consider joining!
                    </p>
                </div>
                <div class="px-3 md:px-4 w-full md:w-7/12 lg:w-7/12">
                    <h4 class="mt-7 md:mt-0 mb-3 text-white">
                        <strong>Why do I need to give my email address?</strong>
                    </h4>
                    <p style="color:#ABB5C2;">
                        Secretly, we’re hoping to start a relationship with you. This is our way of saying “Hey we create awesome piano lessons, can we show you?” Don’t worry, we won’t send you spam or share your email address with anybody else. You’ll get exactly what’s promised on this page along with ongoing piano videos, free lessons, and some special offers. And if you don’t like our emails, you can unsubscribe at any time.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="text-center customize px-4 lg:px-6 relative z-50 overflow-hidden py-10 sm:py-20" style="background:#eff7ff;">
        <div class="max-w-5xl mx-auto flex flex-wrap flex-col md:flex-row md:items-center">
            <div class="max-w-lg mx-auto text-center sm:text-left w-full md:w-1/2 sm:pl-5">
                <img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=740,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/logo.svg" alt="logo">
                <h2 class="pt-4 md:pt-5 leading-7 md:leading-9 mb-6">
                    <strong>5 days of piano lessons</strong> to show you how easy and fun learning the piano can be.
                </h2>
                <p class="text-left mb-4 sm:mb-5 mx-auto inline-block sm:leading-loose">
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> FREE Lifetime Access<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> Play-along with a REAL teacher<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> No music theory knowledge required<br>
                    <i class="fas fa-check sm:mr-2 text-xl" style="color:#FF0000;"></i> FREE Chord Poster download
                </p>
                <div class="max-w-md md:max-w-auto mx-auto md:mx-0">
                    @include("pianote._partials._sign-up-form", [
                    "formId" => "Pianote - Engagement - Trigger - Chord Hacks - Web Form",
                    "formName" => 'Chord Hacks',
                        "buttonText" => "start for free",
                        'stacked' => true,
                        'inputBorder' => '1px solid #7A8491',
                    ])
                </div>
            </div>
            <div class="flex justify-center md:justify-start w-full md:w-1/2 sm:order-1 md:pl-6 mt-7 md:mt-0 relative">
                <img class="max-w-2xl md:max-w-4xl lg:max-w-2xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/collage.png" alt="collage">
            </div>
        </div>
    </section>




    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "demoVid",
        "video" => '//player.vimeo.com/video/830711083?h=701c01c83f&autoplay=1',
        "title" => 'demoVid'
    ])
    @include('drumeo.sales.partials._video-modal',[
        'modalId' => "trailer",
        "video" => '//player.vimeo.com/video/831980473?h=127881c33a&autoplay=1',
        "title" => 'trailer'
    ])
@stop

@section('scripts')
    @parent

    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
