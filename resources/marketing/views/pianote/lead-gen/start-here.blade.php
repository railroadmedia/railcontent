@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Begin Your Piano Journey Here</title>
    <meta property="og:title" content="Begin Your Piano Journey Here">

    <meta name="description" content="Get started on the right foot (or rather hand!) with free piano lessons.">
    <meta property="og:description" content="Get started on the right foot (or rather hand!) with free piano lessons.">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https:/d2vyvo0tyx8ig5.cloudfront.net/lead-gen/start-here/header_image.jpg">
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
                <img alt="The Note" src="https://pianote.s3.amazonaws.com/blog/the-note-logo.svg">
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
    <header class="text-center sm:text-left relative bg-cover px-6 md:px-10 pt-72 pb-8 md:py-36 lg:py-40 bg-cover bg-right sm:bg-left lazyload" style="background-color:#00101D;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/start-here/header2.jpg">
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
                <a href="/blog/all-piano-chords/" class="join">How to Play Piano</a>
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
                        <img class="rounded-lg border-pianote border-2 mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/sG7QDw5CoU8/maxresdefault.jpg" alt="how to play piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1">
                        Lisa Witt / Chord Theory
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Play ALL Piano Chords
                        (Major, Minor, 7ths)
                    </h5>
                    <p style="color: #D4D4D4;">
                        Learn how to play ALL piano chords with a free, downloadable chord chart PDF with complete chord formulas.
                    </p>
                </a>
                <a href="/blog/how-to-buy-piano/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg border-pianote border-2 mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://pianote.s3.us-east-1.amazonaws.com/blog/2021/Chord%20Progressions%20That%20Move%20You/dream%20piano.jpg" alt="how to buy your first piano">
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
                <a href="/blog/learn-piano-online/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg border-pianote border-2 mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://pianote.s3.us-east-1.amazonaws.com/blog/2021/Learn%20Piano%20Online/Learn%20Piano%20Online-02.jpg" alt="how to learn piano">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1">
                        Pianote / Articles
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Learn Piano Online
                    </h5>
                    <p style="color: #D4D4D4;">
                        Take advantage of learning whatever you want, wherever you want, whenever you want.
                    </p>
                </a>
            </div>
        </div>
    </section>

    <section class="pt-16">
        <div class="max-w-5xl mx-auto flex flex-wrap sm:flex-nowrap items-center lg:rounded-lg bg-cover py-10 px-4 px-6 lg:px-20 text-white bg-bottom" style="background-image: url(https://d2vyvo0tyx8ig5.cloudfront.net/backgrounds/background-1.jpg);">
            <img class="rounded-full h-40 md:h-52 border-white border-8 mx-auto mb-6 md:mb-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/lisa-witt.jpg" alt="lisa witt">
            <div class="w-full md:w-auto text-center flex-grow sm:pl-5 lg:pl-8">
                <img class="h-12 sm:h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=750,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/getting-started/logo-2.svg" alt="chord hacks">
                <div class="my-4">
                    Go from absolute beginner to playing<br class="hidden sm:inline-block">
                    your first song in four easy lessons!
                </div>
                @include('pianote._partials._sign-up-form', [
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
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/4rs4IYUoI1Y/maxresdefault.jpg" alt="the best tutorial on the internet">
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
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/HLB28rTqNTw/maxresdefault.jpg" alt="how to pya bohemian rhapsody">
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
                <a href="/blog/play-any-song-on-the-piano/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/pZHKJHprR4Y/maxresdefault.jpg" alt="3 things to play any song">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Lisa Witt / Song Tutorials
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Play ANY Pop Song on <br class="hidden lg:inline-block">the Piano
                    </h5>
                    <p>
                        All you need are a few tools and you can make your arrangement as simple or complex as you like.
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
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/gEI7uYOCQXo/maxresdefault.jpg" alt="how to read notes">
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
                <a href="/blog/how-to-play-piano-chords/" class="flex-1 mb-10 md:mb-0">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2022/07/25151755/ChordFormulas-1-768x432.jpg" alt="piano chord formulas">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Pianote / THEORY
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Play Piano Chords
                    </h5>
                    <p>
                        Chords form the foundation to all Western music. Instantly unlock hundreds of songs by understanding them.
                    </p>
                </a>
                <a href="/blog/how-to-use-the-circle-of-fifths/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://pianote-blog.s3.us-east-2.amazonaws.com/wp-content/uploads/2018/08/22095755/Circle-of-Fifths-New-768x432.png" alt="circle of fifths">
                        <i class="fas fa-arrow-circle-right arrows"></i>
                    </div>
                    <p class="uppercase text-xs font-semibold mb-1" style="color: #AAAAAA;">
                        Pianote / THEORY
                    </p>
                    <h5 class="font-bold mb-2 leading-6">
                        How to Use the Circle of Fifths
                    </h5>
                    <p>
                        The Circle of Fifths is an invaluable tool that helps with understanding key signatures and chord progressions.
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
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/rXC7CJgTeYY/maxresdefault.jpg" alt="improve your piano technique">
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
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/AKEHb08ztlY/maxresdefault.jpg" alt="5 days to better hand independence">
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
                <a href="/blog/piano-practice-routine-for-beginners/" class="flex-1">
                    <div class="relative thumbnail-container">
                        <img class="rounded-lg mb-4 thumbnail lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://img.youtube.com/vi/yrgO3R8mgGo/maxresdefault.jpg" alt="beginner pianist practice routine">
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
            </div>
        </div>
        <div class="max-w-xl md:max-w-5xl mx-auto px-4 pt-16" id="articles">
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
    <section class="px-4 py-16 text-white bg-cover bg-bottom lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg">
        <div class="max-w-lg md:max-w-4xl mx-auto text-center">
            <h4 class="font-extrabold">
                Get the Best Piano Content on the Web
            </h4>
            <p class="my-4" style="color: #A1A1A9;">
                Subscribe to The Note for free lessons, song tutorials, interviews, interesting <br class="hidden sm:inline">
                articles, and more delivered to your inbox every week. Unsubscribe anytime.
            </p>
            @include('pianote._partials._sign-up-form', [
                    "formId" => 'Pianote - Engagement - Trigger - Website Signup - Web Form',
                    "formName" => 'Pianote General',
                'buttonText'=> 'Subscribe to the note',
            ])
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('/marketing/js/app.js') }}"></script>
@endsection
