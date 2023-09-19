@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Begin Your Piano Journey Here</title>
    <meta property="og:title" content="Begin Your Piano Journey Here">

    <meta name="description" content="Get started on the right foot (or rather hand!) with free piano lessons.">
    <meta property="og:description" content="Get started on the right foot (or rather hand!) with free piano lessons.">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https:/d2vyvo0tyx8ig5.cloudfront.net/lead-gen/start-here/header_image.jpg">
    <meta property="og:url" content="https://www.pianote.com/blog/start-here">
@endsection

@section('head')
    <style>
        html {
            scroll-behavior: smooth;
        }

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li{
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
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

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
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

        p {
            font-size:15px;
        }

        @media (min-width:768px) {
            p {
                font-size:16px
            }
        }

        .nav-items {
            border-bottom: 2px solid #E4E4E4;
        }

        .nav-items:hover{
            background:rgba(255, 0, 25, 0.05);
        }

        .selected-nav {
            border-bottom: 2px solid #F61A30;
            background: rgba(255, 0, 25, 0.1);
        }

        .thumbnail {
            transition: transform 400ms;
            cursor: pointer;
        }

        .thumbnail-container:hover .thumbnail {
            transform: scale(1.03);
        }

        .arrows {
            font-size: 30px;
            position: absolute;
            top: 50%;
            left: 50%;
            opacity: 0;
            z-index: 99;
            transition: opacity .3s;
            transform: translate(-50%,-50%);
            cursor: pointer;
            color: white;
        }

        .thumbnail-container:hover .arrows {
            opacity: 1;
        }


        .beat-navigation {
            text-align: center;
            z-index: 100;
            background: #000c17;
            border: 1px solid #111c26;
            border-width: 1px 0;
            font-size: 0;
            transition: top .4s;
            position: sticky;
            top: 0
        }

        .beat-navigation.scrollUp {
            top: 40px
        }

        @media(min-width: 768px) {
            .beat-navigation.scrollUp {
                top:56px
            }
        }

        .beat-navigation .nav-item {
            text-align: center;
            color: #fff;
            width: auto;
            vertical-align: middle;
            max-height: 40px;
            opacity: .7;
            padding: 12px 13px;
            font: 700 0/1em Open Sans,sans-serif;
            transition: all .3s;
            position: relative
        }

        @media(min-width: 768px) {
            .beat-navigation .nav-item {
                max-height:52px;
                padding: 13px 14px;
                font-size: 11px
            }
        }

        @media(min-width: 1024px) {
            .beat-navigation .nav-item {
                padding:13px 30px
            }
        }

        @media(min-width: 768px) {
            .beat-navigation .nav-item:hover {
                opacity:.8;
                background: #001931
            }
        }

        .beat-navigation .nav-item.active,.beat-navigation .nav-item.active:hover {
            opacity: 1
        }

        .beat-navigation .nav-item img {
            height: 16px
        }

        @media(min-width: 768px) {
            .beat-navigation .nav-item img {
                height:29px
            }
        }

        .beat-navigation .nav-item i {
            color: #0b76db;
            font-size: 16px;
            line-height: 16px;
            display: block
        }

        @media(min-width: 768px) {
            .beat-navigation .nav-item i {
                margin:0 auto 3px;
                font-size: 15px;
                line-height: 15px
            }
        }

        .beat-navigation.drumeo .nav-item img {
            height: 29px
        }

        .beat-navigation.drumeo .nav-item {
            text-transform: uppercase;
            font-weight: 600;
            padding: 5px 5px 6px;
            letter-spacing: -.05em
        }

        @media(min-width: 640px) {
            .beat-navigation.drumeo .nav-item {
                font-size:11px;
                padding: 8px 4px
            }
        }

        @media(min-width: 768px) {
            .beat-navigation.drumeo .nav-item {
                font-size:13px;
                padding: 13px 6px
            }
        }

        @media(min-width: 1024px) {
            .beat-navigation.drumeo .nav-item {
                font-size:15px;
                padding: 13px 16px
            }
        }

    </style>
@endsection


@section('page-body')
    <div class="beat-navigation drumeo">
        <div class="row">
            <a href="/blog/" class="nav-item inline-block">
                <img alt="The Note" src="https://d2vyvo0tyx8ig5.cloudfront.net/blog/the-note-logo.svg">
            </a>
            <a href="/start-here" class="nav-item hidden sm:inline-block">
                START HERE</a>
            <a href="https://www.pianote.com/blog/chord-theory/" class="nav-item hidden sm:inline-block
        ">
                CHORD THEORY</a>
            <a href="https://www.pianote.com/blog/song-tutorials/" class="nav-item hidden sm:inline-block
        ">
                SONG TUTORIALS</a>
            <a href="https://www.pianote.com/blog/theory/" class="nav-item hidden sm:inline-block
        ">
                THEORY</a>
            <a href="https://www.pianote.com/blog/technique/" class="nav-item hidden sm:inline-block
        ">
                TECHNIQUE</a>
            <a href="https://www.pianote.com/blog/musicianship/" class="nav-item hidden sm:inline-block
        ">
                MUSICIANSHIP</a>
            <a href="https://www.pianote.com/blog/chords-and-scales/" class="nav-item hidden sm:inline-block
        ">
                CHORDS &amp; SCALES LIBRARY</a>
        </div>
    </div>
    <header class="text-center sm:text-left relative bg-cover px-6 md:px-10 pt-72 pb-8 md:py-36 lg:py-40 bg-cover bg-right sm:bg-left lazyload" style="background-color:#00101D;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/start-here/header2.jpg">
        <div class="relative z-10 max-w-md md:max-w-5xl mx-auto">
            <h2 class="text-white font-extrabold">
                Begin Your Piano <br>
                Journey Here
            </h2>
            <p class="max-w-xl py-4 sm:py-5 lg:my-6" style="color: #A1A1A9;">
                Get started on the right foot (or rather hand!) <br>with free piano lessons.
                {{--Want a deeper dive? Try a Pianote Membership for 7 days.--}}
            </p>
            <div class="text-center md:text-left">
                <a href="/blog/how-to-play-piano" class="join">How to Play Piano</a>
            </div>
        </div>
        <div class="absolute inset-0 z-0 hidden sm:block" style="background:linear-gradient(to right, #00101D 33%, transparent);"></div>
        <div class="absolute inset-0 z-0 block sm:hidden" style="background:linear-gradient(to top, #00101D, transparent);"></div>
    </header>
    <section class="bg-white sticky z-50 top-10 md:top-14" x-data='{ nav: "start here"}'>
        <div class="max-w-xl md:max-w-5xl mx-auto flex justify-evenly uppercase font-bebas text-base sm:text-lg text-center">
            <a
                    class="py-1 sm:py-2 flex-grow nav-items"
                    x-bind:class="nav === 'start here' && 'selected-nav'"
                    href="#starthere"
                    x-on:click="
                    nav = 'start here';
                "
            >
                start here
            </a>
            <a
                    class="py-1 sm:py-2 flex-grow nav-items"
                    x-bind:class="nav === 'tutorials' && 'selected-nav'"
                    href="#tutorials"
                    x-on:click="
                    nav = 'tutorials';
                "
            >
                song tutorials
            </a>
            <a
                    class="py-1 sm:py-2 flex-grow nav-items"
                    x-bind:class="nav === 'theory' && 'selected-nav'"
                    href="#theory"
                    x-on:click="
                    nav = 'theory';
                "
            >
                theory
            </a>
            <a
                    class="py-1 sm:py-2 flex-grow nav-items"
                    x-bind:class="nav === 'technique' && 'selected-nav'"
                    href="#technique"
                    x-on:click="
                    nav = 'technique';
                "
            >
                technique
            </a>
            <a
                    class="py-1 sm:py-2 flex-grow nav-items"
                    x-bind:class="nav === 'musicianship' && 'selected-nav'"
                    href="#musicianship"
                    x-on:click="
                    nav = 'musicianship';
                "
            >
                musicianship
            </a>
            <a
                    class="py-1 sm:py-2 flex-grow nav-items"
                    x-bind:class="nav === 'articles' && 'selected-nav'"
                    href="#articles"
                    x-on:click="
                    nav = 'articles';
                "
            >
                articles
            </a>
        </div>
    </section>
    <section class="text-white py-20" id="starthere" style="background: #00101D;">
        <div class="max-w-xl md:max-w-5xl mx-auto px-4">
            <h3 class="font-extrabold mb-2">Start Here</h3>
            <p class="mb-4">
                The most important beginner lessons, all in one place.
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/how-to-play-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg border-pianote border-2 mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/quality=95,width=600/https://pianote.s3.us-east-1.amazonaws.com/blog/2021/How%20to%20Play%20Piano%20-%20Ultimate%20Guide/HowToPlayPiano-01.jpg" alt="how to play piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1">
                        CHARMAINE LI / Musicianship
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                       How to Play Piano
                    </h5>
                    <p style="color: #D4D4D4;">
                        Everything you need to get started with piano, from buying your first instrument to mastering the fundamentals.
                    </p>
                </a>
                <a href="/blog/how-to-buy-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg border-pianote border-2 mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://pianote.s3.us-east-1.amazonaws.com/blog/2021/Chord%20Progressions%20That%20Move%20You/dream%20piano.jpg" alt="how to buy your first piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1">
                        Pianote / Articles
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Buy Your First Piano
                    </h5>
                    <p style="color: #D4D4D4;">
                        Acoustic vs. digital. Upright vs. grand. Learn how to shop for your dream instrument with confidence.
                    </p>
                </a>
                <a href="/blog/best-way-to-learn-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                    <div class="relative aspect-16:9 overflow-hidden rounded-xl border-pianote border-2 mb-4 thumbnail lazyload">
                        <img src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/04/11102931/best-way-to-learn-piano-768x512.jpg" class="transition-opacity duration-500 opacity-1 absolute object-cover h-full w-full" loading="lazy">
                    </div>
                    <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1">
                        Pianote / Articles
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        What’s the Best Way to Learn Piano? (Online, Teachers & More)
                    </h5>
                    <p style="color: #D4D4D4;">
                        Online. Books. Teachers. What’s the best way to learn piano? Explore your 21st-century options.
                    </p>
                </a>
            </div>
        </div>
    </section>

    <section class="pt-16">
        <div class="max-w-5xl mx-auto flex flex-wrap sm:flex-nowrap items-center lg:rounded-lg bg-cover py-10 px-4 px-6 lg:px-20 text-white bg-bottom" style="background-image: url(https://d2vyvo0tyx8ig5.cloudfront.net/backgrounds/background-1.jpg);">
            <img class="rounded-full h-40 md:h-52 border-white border-8 mx-auto mb-6 md:mb-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lisa-witt.jpg" alt="Headshot of woman with short platinum hair.">
            <div class="w-full md:w-auto text-center flex-grow sm:pl-5 lg:pl-8">
                <img class="h-12 sm:h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/logo-2.svg" alt="Text “On the Piano” in handwritten style font.">
                <div class="my-4">
                    Go from absolute beginner to playing<br class="hidden sm:inline-block">
                    your first song in four easy lessons!
                </div>
                @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => 'Pianote - Engagement - Trigger - GSOTP - Web Form',
                    "formName" => 'Getting Started On The Piano',
                ])
            </div>
        </div>
    </section>

    <section class="pb-20">
        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-16" id="tutorials">
            <h3 class="font-extrabold mb-2">Song Tutorials</h3>
            <p class="mb-4">
                Playing songs is the whole point! Here are some of our most popular song tutorials.
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/fur-elise-piano-sheet-music-tutorial/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/4rs4IYUoI1Y/maxresdefault.jpg" alt="the best tutorial on the internet">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / Classical Songs
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        The Best “Für Elise” Tutorial on the Internet
                    </h5>
                    <p>
                        How to play the entire piece, from top to bottom, in its original form written by Beethoven.
                    </p>
                </a>
                <a href="/blog/bohemian-rhapsody-sheet-music/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/HLB28rTqNTw/maxresdefault.jpg" alt="how to pya bohemian rhapsody">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / Song Tutorials
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        “Bohemian Rhapsody” (Queen) Tutorial
                    </h5>
                    <p>
                        Channel your inner Freddie Mercury with the iconic and legendary piano-driven rock anthem.
                    </p>
                </a>
                <a href="/blog/coldplay-the-scientist/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/yD0tj7vQd7s/maxresdefault.jpg" alt="how to play a perfect beginner song">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / Pop/Rock
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                       “The Scientist” (Coldplay) Tutorial
                    </h5>
                    <p>
                        This Coldplay classic is a perfect beginner song. Learn it step-by-step with Lisa.
                    </p>
                </a>
            </div>
        </div>
        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-20" id="theory">
            <h3 class="font-extrabold mb-2">Theory</h3>
            <p class="mb-4">
                The most important music theory concepts, explained in plain language
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/how-to-read-piano-notes/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/gEI7uYOCQXo/maxresdefault.jpg" alt="how to read notes">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Pianote, Lisa Witt / Theory
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Piano Notes: The Ultimate Beginner’s Guide to Reading Music
                    </h5>
                    <p>
                        How to read notes, make sense of music symbols, and learn music faster with sight-reading shortcuts.
                    </p>
                </a>
                <a href="/blog/piano-music-theory-basics/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/05/19082410/Music-Theory-thumbnail-1-768x432.png" alt="music theory basics">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Pianote / THEORY
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Music Theory Basics: What to Learn First
                    </h5>
                    <p>
                        Theory is a lot, we get it! Here are the absolute fundamentals you should learn first.
                    </p>
                </a>
                <a href="/blog/piano-scales/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/03/19121717/MajorAmp-1-768x432.png" alt="circle of fifths">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Pianote / Scales and Keys
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Piano Scales: Types of Scales & How to Apply Them
                    </h5>
                    <p>
                        The main types of scales, how they work, and why it’s smart to practice them.
                    </p>
                </a>
            </div>
        </div>
        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-16" id="technique">
            <h3 class="font-extrabold mb-2">Technique</h3>
            <p class="mb-4">
                Chords, scales, and arpeggios are the building blocks to playing beautiful music.
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/piano-technique-made-easy/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/rXC7CJgTeYY/maxresdefault.jpg" alt="improve your piano technique">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / TECHNIQUE
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Piano Technique Made Easy
                    </h5>
                    <p>
                        What to focus on when you practice technique, including scales, inversions, finger patterns, and arpeggios.
                    </p>
                </a>
                <a href="/blog/hand-independence-in-5-days/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/AKEHb08ztlY/maxresdefault.jpg" alt="5 days to better hand independence">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / Hand Independence
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Hand Independence in 5 Days
                    </h5>
                    <p>
                        Playing hands together is one of the toughest skills for beginners to master. Here’s a 5-day plan to improve hand independence.
                    </p>
                </a>
                <a href="/blog/how-piano-pedals-work/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/quality=96,width=600/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/07/19154235/2023-07-Piano-Pedals-Explained-1920x1080-1.jpg" alt="beginner pianist practice routine">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Pianote / TECHNIQUE
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How Piano Pedals Work
                    </h5>
                    <p>
                        How the sustain, sostenuto, and una corda pedals work and how to use them effectively.
                    </p>
                </a>
            </div>
        </div>

        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-16" id="musicianship">
            <h3 class="font-extrabold mb-2">Musicianship</h3>
            <p class="mb-4">
                Musicianship skills include ear training, songwriting, improvisation, playing in groups, and more.
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/piano-practice-routine-for-beginners/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/yrgO3R8mgGo/maxresdefault.jpg" alt="piano practice routine for beginners">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / Practice
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Piano Practice Routine for Beginners (Not Boring!)
                    </h5>
                    <p>
                        A beginner-friendly routine designed to maximize skill and minimize boredom.
                    </p>
                    </a>
                <a href="/blog/how-to-improvise-on-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/FJ-Y21kBkMk/maxresdefault.jpg" alt="how to improvise on piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Jesús Molina, Pianote / Improvisation
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Improvise on Piano: A Beginner’s Guide
                    </h5>
                    <p>
                        There’s a technique to improvising. Get tips from top piano improviser Jesús Molina.
                    </p>
                </a>
                <a href="/blog/interval-ear-training/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://img.youtube.com/vi/U8xQfdKPRXs/maxresdefault.jpg" alt="ultimate guide to interval ear training">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Kevin Castro / Ear Training
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Ultimate Guide to Interval Ear Training: How to Play By Ear Using Intervals
                    </h5>
                    <p>
                        How the sustain, sostenuto, and una corda pedals work and how to use them effectively.
                    </p>
                </a>
            </div>
        </div>

        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-16" id="articles">
            <h3 class="font-extrabold mb-2">Articles</h3>
            <p class="mb-4">
                Insights into piano learning, benefits, and challenges.
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/how-long-does-it-take-to-learn-piano-survey/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/quality=95,width=600/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/08/24114556/Blog-Thumbnail-1920x1080-1.jpg" alt="how long does it take to learn piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        CHARMAINE LI / ARTICLES
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How Long Does It Take to Learn Piano? We Asked 1000+ Pianists
                    </h5>
                    <p>
                        It takes 4-5 years of consistent practice on average to get to an intermediate level of piano.
                    </p>
                </a>
                <a href="/blog/benefits-of-learning-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2022/05/18091546/2023-08-Piano-Is-Good-For-You-1920x1080-1-768x432.jpg" alt="benefits of learning piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        CHARMAINE LI / ARTICLES
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        14 Benefits of Playing Piano
                    </h5>
                    <p>
                        Piano is good for you! It can improve mood, slow cognitive decline, and it's the perfect mindfulness exercise.
                    </p>
                </a>
                <a href="/blog/is-piano-hard-to-learn/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/05/12081100/Is-Piano-Hard-1400x788-1-768x432.jpg" alt="is piano hard to learn">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        CHARMAINE LI / Articles
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        Is Piano Hard to Learn? Tips for Beginners
                    </h5>
                    <p>
                        The piano is one of the best instruments for beginners...and one of the hardest for musicians to master.
                    </p>
                </a>
            </div>
        </div>

        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-16" id="articles-pianists">
            <h3 class="font-extrabold mb-2">Articles for Pianists</h3>
            <p class="mb-4">
                Topics of interest for piano enthusiasts everywhere.
            </p>
            <div class="flex flex-col md:flex-row md:gap-4">
                <a href="/blog/history-of-the-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:good/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2023/01/04154216/2023-01-What-Is-Musicianship-768x432.jpg" alt="piano evolutiong">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        CHARMAINE LI / ARTICLES
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        What Is Musicianship?
                    </h5>
                    <p>
                        Being a piano player is more than playing the right notes at the right time. Learn how to develop your musicianship.
                    </p>
                </a>
                <a href="/blog/hardest-piano-song/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:good/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2022/10/06100459/2022-10-Legendary-Pieces-768x432.jpg" alt="top 10 hardest piano songs">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        CHARMAINE LI / ARTICLES
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        40+ Legendary Classical Piano Songs By Difficulty
                    </h5>
                    <p>
                        Explore the stories behind 40+ famous classical piano songs and get links to sheet music and tutorials to help you start playing.
                    </p>
                </a>
                <a href="/blog/the-many-styles-of-piano-playing-styles-genres/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:good/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2022/09/14114445/HowPianosWork-02-768x432.jpg" alt="piano styles">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        CHARMAINE LI / Articles
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How Pianos Work
                    </h5>
                    <p>
                        How does a piano work? Take a peek under the lid for a fascinating tour of the piano's intricate system of hammers and strings.
                    </p>
                </a>
            </div>
        </div>
    </section>
    <section class="px-4 py-16 text-white bg-cover bg-bottom lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg">
        <div class="max-w-lg md:max-w-4xl mx-auto text-center">
            <h4 class="font-extrabold">
                Get the Best Piano Content on the Web
            </h4>
            <p class="my-4" style="color: #A1A1A9;">
                Subscribe to The Note for free lessons, song tutorials, interviews, interesting <br class="hidden sm:inline">
                articles, and more delivered to your inbox every week. Unsubscribe anytime.
            </p>
            @include('pianote._partials.sign-up-form', [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => 'Pianote - Engagement - Trigger - Website Signup - Web Form2',
                    "formName" => 'Pianote General',
                'buttonText'=> 'Subscribe to the note',
            ])
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('/marketing/js/app.js') }}"></script>
@endsection
