@extends('drumeo._partials.layout-template')

@section('global-head')
    @yield('meta')

    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    @endif

    @include('drumeo._partials._fonts')

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}
@stop

@section('global-body')
    @if(!empty($trialVersion))
        @if(!empty($joinUrl))
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "joinUrl" => $joinUrl
            ])
        @else
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "scrollToJoin" => true,
            ])
        @endif
    @else
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true,
            "homepage" => true
        ])
    @endif

    @yield('promo-banner-alt')

    <div class="sticky-trigger block"></div>
    @yield('sticky-bar')

    <header class="header text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center md:text-left">
            <div class="container mx-auto max-w-6xl">
                <h1 data-aos="fade-down" class="leading-tight max-w-xs md:max-w-md lg:max-w-2xl mx-auto md:mx-0 md:text-3xl lg:text-4xl"><strong>Learn to play the drums with the best teachers in the world.</strong></h1>
                <h6 class="leading-normal text-light-navy mt-5 mb-7 text-shadow-4">
                    Organized video drum lessons you can watch anytime with <br class="hidden sm:inline">
                    direct access to legendary drummers every step of the way.</h6>
                <a data-aos="fade-up"
                    @hasSection('start-button')
                        href="@yield('start-button')" class="join blue smaller w-1/2 md:w-1/3 lg:w-1/4"
                    @else
                        href="#customize-anchor" class="join blue smaller anchor-slide w-1/2 md:w-1/3 lg:w-1/4 anchor-slide"
                    @endif
                >Get Started</a>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10 hidden md:block" style="background: linear-gradient(to right, #011434, transparent);"></div>
        <div class="top-0 left-0 absolute w-full h-full z-10 block md:hidden" style="background: rgba(1, 19, 50, 0.7);"></div>
        <video class="object-cover w-full h-full relative z-0" poster="https://i.vimeocdn.com/video/1246906562-a88c36cebb94874513441385c9c4d9b65b02c8537aae511ff4a872e1c5cad6ec-d_720" src="https://dpwjbsxqtam5n.cloudfront.net/sales/header-compress.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
    </header>


    <section class="px-2 lg:px-4 py-10 md:py-14 md:py-20 text-white text-center overflow-hidden" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">
        <div class="container mx-auto max-w-6xl">
            <h3 class="leading-tight " data-aos="fade-up"><strong>The Ultimate Drum<br class="inline md:hidden"> Lessons Experience&trade;</strong></h3>
            <p class="text-light-navy mt-2 md:mt-4 mb-8 md:mb-10">
                You’ll have the perfect balance of step-by-step lessons, breakdowns of your favorite songs, <br class="hidden md:inline">
                and ongoing motivation & support from REAL teachers to help you achieve your goals.</p>
            <div class="md:grid md:grid-cols-3 md:gap-4 max-w-xs md:max-w-full mx-auto">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/thumb-method.jpg"></div>
                    <div class=" px-4 lg:px-6 py-5 lg:py-7">
                        <i class="text-4xl align-middle icon-drumeo-method text-drumeo"></i>
                        <img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                        <h4 class="leading-tight my-3"><strong>Step-By-Step<br class="hidden md:inline"> Curriculum</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">Fail to plan, plan to fail. With the Drumeo Method, you’ll always know what to work on next. It’s your step-by-step guide to go from a beginner drummer to playing anything you want on the drums.</p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller method outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#method">Learn More</a>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/thumb-songs2.jpg"></div>
                    <div class="px-4 lg:px-6 py-5 lg:py-7">
                        <i class="text-4xl align-middle icon-songs text-songs"></i>
                        <img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                        <h4 class="leading-tight my-3"><strong>{{ Prices::$songs }}+ Songs &<br class="hidden md:inline">  Practice Tools</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">Nothing beats the rush of playing your favorite song on the drums. Drumeo Songs makes it easier – with note-for-note transcriptions of {{ Prices::$songs }}+ popular songs and handy play-back tools so you can nail every note.</p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller songs outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#songs">Learn More</a>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/thumb-coaches.jpg"></div>
                    <div class="px-4 lg:px-6 py-5 lg:py-7">
                        <img class="h-8 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                        <img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                        <h4 class="leading-tight my-3"><strong>Ongoing Motivation<br class="hidden md:inline"> & Support</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">We brought all your favorite drummers to one place. You’ll have exclusive live events, new courses every month, and opportunities to have your questions answered by drumming’s biggest names.</p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller coaches outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#coaches">Learn More</a>
                    </div>
                </div>
            </div>

            <a
                @hasSection('start-button')
                    href="@yield('start-button')" class="join smaller blue mt-12 mb-2 lg:w-1/3"
                @else
                    href="#customize-anchor" class="join smaller blue anchor-slide mt-9 md:mt-12 mb-2 lg:w-1/3"
                @endif
            >Get The Drumeo Advantage</a>
            <p class="text-light-navy text-sm"><em>Trusted by 31,856 active students.</em></p>

            <div class="slick mx-auto max-w-xs md:max-w-xl lg:max-w-4xl my-9 md:mb-0 h-40 sm:h-24 lg:h-20">
                <div class="px-3 md:px-6 slick-slide">
                    <p class="leading-normal text-sm"><em>“Drumeo is the real deal folks - a good place to study and realize one’s dreams.”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/billy-cobham.jpg"><br class="inline md:hidden">
                        <p class="w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>Billy Cobham,<br class="inline md:hidden"> Rolling Stone  Top 100 Drummer</em></p>
                    </div>
                </div>
                <div class="px-3 md:px-6 slick-slide">
                    <p class="leading-normal text-sm"><em>“A world-class site for continuing education and insight into the world of drumming!”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://dzryyo1we6bm3.cloudfront.net/independence-made-easy/sales/redmond.jpg"><br class="inline md:hidden">
                        <p class="w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>Rich Redmond,<br class="inline md:hidden"> 3x Country Drummer Of The Year</em></p>
                    </div>
                </div>
                <div class="px-3 md:px-6 slick-slide">
                    <p class="leading-normal text-sm"><em>“The Drumeo standard is one of the highest quality and is THE place to go for the best in drum education.”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/four-weeks-to-better-drum-fills/drummer-david-garibaldi.jpg"><br class="inline md:hidden">
                        <p class="w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>David Garibaldi,<br class="inline md:hidden"> Rolling Stone Top 100 Drummer</em></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="promo" class="anchor"></div>
    @yield('promo-banner')

    {{--<section class="content-section text-center px-4 lg:px-5" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">--}}
        {{--<div class="container mx-auto max-w-6xl">--}}
            {{--<h3 class="" data-aos="fade-up"><strong>Join the party</strong></h3>--}}
            {{--<p class="leading-normal text-light-navy mt-2 md:mt-4">You’ll be front row for NEW drum<br class="inline sm:hidden"> lessons dropping in May and beyond.</p>--}}

            @php
                $coaches = [
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/steve-smith.jpg',
                    'date' => 'This Month',
                    'name' => 'Steve<br> Smith',
                    'subtitle' => 'Crafting Musical<br> Drum Solos',
                    'smallInfo' => 'Learn to craft musical & dynamic solos no matter what skill level you’re at -- hall-of-fame drummer Steve Smith is here to guide you. ',
                    'modal' => 'smith',
                    'prev' => false,
                    'next' => 'phillips',
                    'info' => 'Steve Smith has left no stone unturned in the world of drumming. From groundbreaking jazz performances to stadium rock anthems, Steve is one of drumming’s living legends. In his course, you’ll learn how to build musical drum solos and harness the power of technique to express yourself on the kit.',
                    'trending' => true,
                    'bigTile' => true,
                    'trailer' => true,
                    ],
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/simon-phillips2.jpg',
                    'date' => 'Now Available',
                    'name' => 'Simon     <br> Phillips',
                    'subtitle' => 'Legendary<br> Drum Sounds',
                    'smallInfo' => "Get more from your kit. Legendary session drummer, Simon Phillips, helps you rapidly improve your drum sound in any playing situation.",
                    'modal' => 'phillips',
                    'prev' => 'smith',
                    'next' => 'chambers',
                    'info' => 'Tuning is just the beginning. Legendary session drummer, Simon Phillips, will show you everything he’s learned about getting the best drum sound in any playing situation. From how you strike the drums to what gear you choose, the sound of your playing will rapidly improve in this course.',
                    'trending' => true,
                    'trailer' => true,
                    ],
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/dennis-chambers2.jpg',
                    'date' => 'Now Available',
                    'name' => 'Dennis<br> Chambers',
                    'subtitle' => 'The Essence Of<br> Funk Drumming',
                    'smallInfo' => 'Push your independence & musicianship with the help of funk drumming pioneer Dennis Chambers.',
                    'modal' => 'chambers',
                    'prev' => 'phillips',
                    'next' => 'spears',
                    'info' => 'Learn the syncopated patterns of funk drumming from a living legend of the style. Dennis Chambers pushed the limits of funk drumming with Parliament/Funkadelic & John Scofield. And now he’s here to help you achieve new levels of independence & musicianship in your drumming.',
                    'trending' => true,
                    'trailer' => true,
                    ],
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/aaron-spears-3.jpg',
                    'date' => 'Now Available',
                    'name' => 'Aaron   <br> Spears',
                    'subtitle' => 'Getting Started<br> With Chops',
                    'smallInfo' => "Aaron Spears is going to show you the building blocks of drum chops -- and how to create explosive fills that fit the music.",
                    'modal' => 'spears',
                    'prev' => 'chambers',
                    'next' => 'nekrutman',
                    'info' => 'With great chops, comes great responsibility. The Godfather of gospel chops is going to show you how to use chops to add powerful moments to any song – without distracting from the groove. Aaron Spears dives into lessons learned drumming for pop stars like Ariana Grande and Usher in this course & live interview.',
                    'trending' => true,
                    'trailer' => true,
                    ],
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/greyson-nekrutman2.jpg',
                    'date' => 'Now Available',
                    'name' => 'Greyson<br> Nekrutman',
                    'subtitle' => 'Big Band Drumming<br> Essentials',
                    'smallInfo' => 'Big Band is where it all started. You’ll learn the fundamentals of drumming’s most celebrated style from a modern-day prodigy. ',
                    'info' => 'Buddy Rich, Gene Krupa, Joe Morello… the forefathers of drumming all came from one style: jazz. Drum prodigy, Greyson Nekrutman, is showing you the fundamentals of big band playing including how to swing, traditional grip basics, and more.',
                    'modal' => 'nekrutman',
                    'prev' => 'spears',
                    'next' => 'welton',
                    'trending' => true,
                    'trailer' => true
                    ],
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/hannah-welton.jpg',
                    'date' => 'Now Available',
                    'name' => 'Hannah<br> Welton',
                    'subtitle' => 'Creating The Perfect<br> Drum Part',
                    'smallInfo' => 'Learn how to create the <strong>perfect</strong> drum parts for any song with the help of Prince’s drummer Hannah Welton. ',
                    'info' => 'As a drummer, you have the opportunity to bring LIFE to any song. Hannah Welton’s experience drumming for Prince was like attending the world’s greatest masterclass on creating the <strong>perfect</strong> drum part for every song. And now she’s going to pass that wisdom on to YOU in her first-ever DrumeoCOACHES course.',
                    'modal' => 'welton',
                    'prev' => 'nekrutman',
                    'next' => 'weinberg',
                    'trending' => true,
                    'trailer' => true
                    ],
                    [
                    'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coaches/cindy-blackman-santana.jpg',
                    'date' => '2023',
                    'name' => 'Cindy Blackman  <br> Santana',
                    'subtitle' => 'Jazz & Fusion<br> Drumming',
                    'smallInfo' => 'Learning jazz will improve every area of your drumming. You’re in good hands with Cindy Blackman Santana – a legend who brought jazz fundamentals to stadium rock.',
                    'modal' => 'blackman',
                    'prev' => 'weinberg',
                    'next' => false,
                    'info' => "Learning jazz will improve every area of your drumming. Dive into drumming's most challenging (and rewarding) style guided by Cindy Blackman Santana. Cindy will help you bring the spirit of jazz into everything you play for a more creative and inspiring approach to drumming.",
                    'trending' => true
                    ],


                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/aric-improta.jpg',
                    'tileSubtitle' => 'ROCK, ART,<br> & TOURING',
                    'modal' => 'improta',
                    'prev' => false,
                    'name' => 'ARIC<br> IMPROTA',
                    'subtitle' => 'NIGHT VERSES, FEVER 333',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">168K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble2' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">3.2M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
                    'bubble3' => '<div class="bubble grammy"><p><i class="fas fa-gramophone"></i><br><strong class="font-black">GRAMMY</strong><br><span class="text-highlight">NOMINEE</span></p></div>',
                    'info' => 'Aric Improta is pushing the boundaries of drum performances. Look no further than his exhilarating backflips mid drum solo in front of thousands of screaming fans. <br><br> A dedicated artist, Aric uses his original music projects (Night Verses & Fever333) to deliver sensational visual performances to the masses. <br><br> And now he’s here to help you think outside the box with your drumming and question the implied “rules” that might be holding you back from your next creative breakthrough.',
                    'next' => 'santantonio',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/domino-santantonio.jpg',
                    'tileSubtitle' => 'POP &<br> PERFORMANCE',
                    'modal' => 'santantonio',
                    'prev' => 'improta',
                    'name' => 'DOMINO<br> SANTANTONIO',
                    'subtitle' => 'TIKTOK SENSATION',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble"><p><i class="fab fa-tiktok"></i><br><strong class="font-black">1.3M</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble2' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">8.1M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
                    'bubble3' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">381K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'info' => 'Domino Santantonio took the world by storm in 2020. In less than a year, she amassed more than half a million TikTok followers by turning trending pop songs into infectious drum grooves. <br><br> When she’s not making viral TikTok videos, she’s touring with live pop acts and performing as a house drummer on nationally broadcast television shows. <br><br> She’s here to show you what the life of a pop drummer is like -- and to help you find YOUR spotlight.',
                    'next' => 'taylor',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/dorothea-taylor.jpg',
                    'tileSubtitle' => 'DRUMLINE<br> DISCIPLINE',
                    'modal' => 'taylor',
                    'prev' => 'santantonio',
                    'name' => 'DOROTHEA<br>  TAYLOR',
                    'subtitle' => 'THE GODMOTHER OF DRUMMING',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble"><p><i class="fab fa-tiktok"></i><br><strong class="font-black">1.1M</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">343K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble3' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">14M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
                    'info' => 'Dorothea Taylor spent the majority of her drum career out of the spotlight -- teaching lessons to budding Michigan drum students. <br><br> That’s until she partnered with Drumeo to create a powerful viral video addressing societal expectations in drumming culture -- shocking audiences with her (un)surprising command of a hard-rock anthem, garnering millions of views in two days. <br><br> Get ready to hang with one of the internet’s most renowned drum instructors and strengthen your hands with Dorothea’s go-to drumline workouts.',
                    'next' => 'wooton',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/john-wooton.jpg',
                    'tileSubtitle' => 'RUDIMENTS &<br> APPLICATIONS',
                    'modal' => 'wooton',
                    'prev' => 'taylor',
                    'name' => 'JOHN <br> WOOTON',
                    'subtitle' => 'PROFESSOR OF PERCUSSION',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble"><p><i class="fad fa-university"></i><br><strong class="font-black">Director </strong><br><span class="text-highlight">of Percussion</span></p></div>',
                    'bubble2' => '<div class="bubble"><p><i class="fad fa-diploma"></i><br><strong class="font-black">Doctor of </strong><br><span class="text-highlight">Musical Arts</span></p></div>',
                    'info' => 'John Wooton brings an accomplished academic background to your DrumeoCOACHES roster. <br><br> Holding a doctorate in musical arts from the University of Iowa, John blends theory with the application of drum rudiments. And he can do more than teach. John is a decorated drum corps snare drummer garnering national recognition for his talents. <br><br> You’ll be spending time with the professor, inside DrumeoCOACHES, getting John’s wisdom for buttery smooth chops.',
                    'next' => 'rodriguez',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/kaz-rodriguez.jpg',
                    'tileSubtitle' => 'MUSICALITY &<br> COMPOSITION',
                    'modal' => 'rodriguez',
                    'prev' => 'wooton',
                    'name' => 'KAZ<br>  RODRIGUEZ',
                    'subtitle' => 'DRUMMER FOR JOSH GROBAN',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">123K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble2' => '<div class="bubble"><p><i class="fad fa-list-music"></i><br><strong class="font-black">Prolific</strong><br><span class="text-highlight">COMPOSER</span></p></div>',
                    'info' => 'Kaz Rodriguez brings more than an international touring resume with Grammy-nominee Josh Groban. <br><br> He produces some of the most in-demand play-along tracks in the drumming world -- with Anika Nilles, Chris Coleman, Aaron Spears and many more relying on his productions to showcase their skills. <br><br> And you’ll get to sit in with Kaz while he breaks down play alongs, discusses his creative process, and even help him write a brand new composition.',
                    'next' => 'mcguire',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/matt-mcguire.jpg',
                    'tileSubtitle' => 'LIVE SHOWS &<br> PERFORMANCE',
                    'modal' => 'mcguire',
                    'prev' => 'rodriguez',
                    'name' => 'MATT<br>  MCGUIRE',
                    'subtitle' => 'THE CHAINSMOKERS',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">1.8M</strong><br><span class="text-highlight">SUBS</span></p></div>',
                    'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">293K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble3' => '<div class="bubble spotify"><p><i class="fab fa-spotify"></i><br><strong class="font-black">28M</strong><br><span class="text-highlight">LISTENERS</span></p></div>',
                    'info' => 'Matt McGuire rose to fame posting the highest caliber drum remixes the internet has ever seen. In the process, he grabbed the attention of some of the world’s biggest acts -- including The Chainsmokers. <br><br> Now Matt tours the world with one of pop’s biggest groups as drummer, musical director, and stage designer. <br><br> Matt’s going to help you push your performances and unlock creativity, excitement, and musicianship in everything you do.',
                    'next' => 'lewis',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/larnell-lewis.jpg',
                    'tileSubtitle' => 'MUSICIANSHIP<br> & GROOVE',
                    'modal' => 'lewis',
                    'prev' => 'mcguire',
                    'name' => 'LARNELL<br>  LEWIS',
                    'subtitle' => 'GRAMMY AWARD WINNER',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble grammy"><p><i class="fas fa-gramophone"></i><br><strong class="font-black">GRAMMY</strong><br><span class="text-highlight">WINNER</span></p></div>',
                    'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">166K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble3' => '<div class="bubble"><p><i class="fad fa-album-collection"></i><br><strong class="font-black">STUDIO</strong><br><span class="text-highlight">LEGEND</span></p></div>',
                    'info' => 'In 2015, Larnell Lewis boarded a plane to the Netherlands to fill in for one of his drumming heroes, Robert “Sput” Searight. The rest is history. <br><br> Larnell learned a complex fusion set during the flight and went on to record one of the most celebrated live albums of the 21st century: We Like It Here by Snarky Puppy. <br><br> He’s a Grammy Award-winning musician, composer, producer, and educator -- and he’s here to teach YOU.',
                    'next' => 'schack',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/michael-schack.jpg',
                    'tileSubtitle' => 'ELECTRONIC<br> DRUMMING',
                    'modal' => 'schack',
                    'prev' => 'lewis',
                    'name' => 'MICHAEL<br>  SCHACK',
                    'subtitle' => 'TOURING CLINICIAN',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">2.8M</strong><br><span class="text-highlight">VIEWS</span></p></div>',
                    'bubble2' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">29K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'info' => 'Michael Schack does it all. <br><br> Massive festival stages, sweaty European dance clubs, and concert venues around the world. <br><br> And more than a performer, he’s a clinician and teacher who knows how to translate his insights into practical results you can use. <br><br> Michael’s going to be showing what he does best -- how to energize every performance and translate digital music into compelling acoustic performances.',
                    'next' => 'falk',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/jared-falk.jpg',
                    'tileSubtitle' => 'GETTING STARTED<br> & MOTIVATION',
                    'modal' => 'falk',
                    'prev' => 'schack',
                    'name' => 'JARED<br> FALK',
                    'subtitle' => 'Getting Started & Motivation',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble instagram"><p><i class="fab fa-instagram"></i><br><strong class="font-black">207K</strong><br><span class="text-highlight">FOLLOWS</span></p></div>',
                    'bubble2' => '<div class="bubble youtube"><p><i class="fab fa-youtube"></i><br><strong class="font-black">2.1M</strong><br><span class="text-highlight">SUBS</span></p></div>',
                    'bubble3' => '<div class="bubble"><p><i class="fad fa-medal"></i><br><strong class="font-black">MOST WATCHED</strong><br><span class="text-highlight">INSTRUCTOR</span></p></div>',
                    'info' => 'Jared Falk has been your trusted source for online drum lessons for 15+ years.<br><br>As the face of Drumeo, Jared is a pioneer of online drum instruction -- helping prospective drummers around the world learn their first beats and beyond.<br><br>His passion, grit, and approachable style have helped him become the most watched drum instructor online… ever! And now you’ll have exclusive access to ask him all your biggest questions -- from getting started to finding your unique voice on the drums.',
                    'next' => 'sucherman',
                    ],
                    [
                    'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/todd-sucherman.jpg',
                    'tileSubtitle' => 'Philosophy<br> & MECHANICS',
                    'modal' => 'sucherman',
                    'prev' => 'falk',
                    'name' => 'TODD<br>  SUCHERMAN',
                    'subtitle' => 'ROCK ICON & EDUCATOR',
                    'bubbles' => 'true',
                    'bubble1' => '<div class="bubble"><p><i class="fad fa-trophy"></i><br><strong class="font-black">ROCK DRUMMER</strong><br><span class="text-highlight">AWARD</span></p></div>',
                    'bubble2' => '<div class="bubble"><p><i class="fad fa-medal"></i><br><strong class="font-black">DRUM CLINICIAN</strong><br><span class="text-highlight">AWARD</span></p></div>',
                    'info' => 'Todd Sucherman has played more than 2000 rock shows -- entertaining music fans around the world for 30+ years. <br><br> He’s a decorated clinician, winning multiple awards for his educational DVDs and enjoying a 20+ year tenure with the legendary rock band Styx. <br><br> Todd’s here to share the wisdom he’s amassed in an impressive career -- both on stage performing to the masses and in the studio dialing in that perfect sound.',
                    'next' => false,
                    ],
                ]
            @endphp

            {{--@php--}}
                {{--$altSlider = [--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/may/simon-flippy.jpg',--}}
                    {{--'date' => 'MAY',--}}
                    {{--'name' => 'SIMON<br> PHILLIPS',--}}
                    {{--'subtitle' => 'Legendary Drum Sounds',--}}
                    {{--'smallInfo' => 'Simon Phillips will show you everything he’s learned about getting the best drum sounds in any playing situation. Get ready to learn from session drumming royalty!',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-cards/lewis.jpg',--}}
                    {{--'date' => 'MAY 9',--}}
                    {{--'name' => 'LARNELL<br> LEWIS',--}}
                    {{--'subtitle' => 'Cymbals VS Drums',--}}
                    {{--'smallInfo' => 'Learn how to harness the dynamic power of your cymbals & drums with Larnell Lewis. He’ll show you how to get maximum impact from your gear.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-cards/santantonio.jpg',--}}
                    {{--'date' => 'MAY 10',--}}
                    {{--'name' => 'DOMINO<br> SANTANTONIO',--}}
                    {{--'subtitle' => 'Perfecting Pop Dynamics',--}}
                    {{--'smallInfo' => 'Learn how to choose & tune your drums for the perfect pop punch. Domino Santantonio is showing you the tricks behind her viral pop videos.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-cards/sucherman.jpg',--}}
                    {{--'date' => 'MAY 11',--}}
                    {{--'name' => 'TODD <br>SUCHERMAN',--}}
                    {{--'subtitle' => 'Spotlight: Danny Seraphine',--}}
                    {{--'smallInfo' => 'Award-winning drummer, Todd Sucherman, shows you the world of fusion drummers and techniques you can apply to your own drumming.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-cards/improta.jpg',--}}
                    {{--'date' => 'MAY 13',--}}
                    {{--'name' => 'ARIC<br> IMPROTA',--}}
                    {{--'subtitle' => 'Artist Interview Series',--}}
                    {{--'smallInfo' => 'Dive deeper into the creative process with Aric Improta. You’ll hear from the musical innovators that will help you unlock your own creative potential.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/march/flippy_card_7.jpg',--}}
                    {{--'date' => 'MAY 16',--}}
                    {{--'name' => 'KAZ <br>RODRIGUEZ',--}}
                    {{--'subtitle' => 'NEW Drum Playalong Production',--}}
                    {{--'smallInfo' => 'Join Kaz Rodriguez LIVE as he creates a brand new exclusive drum play-along for you to jam with at your next practice session.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-cards/taylor.jpg',--}}
                    {{--'date' => 'MAY 17',--}}
                    {{--'name' => 'DOROTHEA<br> TAYLOR',--}}
                    {{--'subtitle' => 'Triple Paradiddles',--}}
                    {{--'smallInfo' => 'It’s one of the most underrated rudiments – and you’ll be learning how to apply it from the Godmother of Drumming herself.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/may/drumeo-team-flippy.jpg',--}}
                    {{--'date' => 'MAY 19',--}}
                    {{--'name' => 'DRUMEO<br>TEAM',--}}
                    {{--'subtitle' => 'Make Subdivisions Feel EASY',--}}
                    {{--'smallInfo' => 'They sound intimidating at first. But subdividing beats doesn’t have to be scary. Aaron Edgar will walk you through tricks to make odd time feel less, well… odd!',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-cards/mcguire.jpg',--}}
                    {{--'date' => 'MAY 31',--}}
                    {{--'name' => 'MATT<br> MCGUIRE',--}}
                    {{--'subtitle' => 'Drum Cover Roast & Review',--}}
                    {{--'smallInfo' => 'Are you brave enough? Matt McGuire is personally reviewing your drum cover videos – the good, the bad, and the ugly. You’ll get pro tips on how to take yours to the next level.',--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/april/flippy_cards10.jpg',--}}
                    {{--'date' => 'And More...',--}}
                    {{--'name' => 'Join<br>Drumeo',--}}
                    {{--'subtitle' => 'get unlimited access to lessons, playalongs, live events, and more!',--}}
                    {{--'smallInfo' => 'Join Drumeo to get unlimited access to lessons, playalongs, live events, and more!',--}}
                    {{--],--}}
                {{--]--}}
            {{--@endphp--}}
            {{--<div class="slick-2 mx-auto mb-12 mt-7 md:my-10 max-w-md md:max-w-3xl lg:max-w-full h-64 sm:h-80">--}}
                {{--@foreach($altSlider as $altSlide)--}}
                    {{--<div class="px-1 md:px-2 slick-slide">--}}
                        {{--<div class="mx-auto" style="max-width:215px">--}}
                            {{--<div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">--}}
                                {{--<div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">--}}
                                    {{--<div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
                                        {{--<div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $altSlide['image'] }}"></div>--}}
                                        {{--<div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">--}}
                                            {{--<h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $altSlide['name']  !!}</h2>--}}
                                            {{--<p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $altSlide['subtitle'] !!}</p>--}}
                                        {{--</div>--}}
                                        {{--@if(!empty($altSlide['date']))--}}
                                            {{--<p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $altSlide['date'] !!}</p>--}}
                                        {{--@endif--}}
                                        {{--<div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>--}}
                                    {{--</div>--}}
                                    {{--<div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
                                        {{--<div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">--}}
                                            {{--<p class="text-coaches uppercase leading-tight mx-auto mb-1">{!!  str_replace('<br>', ' ', $altSlide['subtitle'])  !!}</p>--}}
                                            {{--<p class="leading-normal mx-auto text-sm">{!! $altSlide['smallInfo'] !!}</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
            {{--<a--}}
                {{--@hasSection('start-button')--}}
                    {{--href="@yield('start-button')" class="join smaller blue md:mt-6 mb-2 md:w-1/3"--}}
                {{--@else--}}
                    {{--href="#customize-anchor" class="join smaller blue anchor-slide md:mt-6 mb-2 md:w-1/3"--}}
                {{--@endif--}}
            {{-->Get Started</a>--}}
            {{--<p class="text-light-navy text-sm"><em>It takes less than a minute to sign up.</em></p>--}}
        {{--</div>--}}
    {{--</section>--}}
    <section class="py-10 md:py-16 lg:py-20 px-3 lg:px-6 text-white text-center" style="background:linear-gradient(to bottom, #0b76db, #014486);">
        <div class="container mx-auto max-w-6xl">
            <h2 class="leading-tight max-w-2xl"><em>“... a smooth process that makes it easy to learn and develop good habits”</em></h2>
            <h6 class="mt-5 mb-10 md:mb-20"><em>- DrummingReview.com</em></h6>
            <div class="flex flex-wrap justify-center mx-auto max-w-md w-full opacity-70">
                <div class="w-1/3">
                    <img class="h-9 lg:h-12 mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/badge-modern-drummer.png" alt="badge-modern-drummer">
                    <p class="leading-tight text-sm">Education Award</p>
                </div>
                <div class="w-1/3 ">
                    <img class="h-9 lg:h-12 mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/badge-shopper-approved.png" alt="rated 5 stars">
                    <p class="leading-tight text-sm">Rated 5 Stars</p>
                </div>
                <div class="w-1/3">
                    <img class="h-9 lg:h-12 mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/badge-drummies.png" alt="badge-drummies">
                    <p class="leading-tight text-sm">Education Award</p>
                </div>
            </div>
        </div>
    </section>

    <div id="method" class="anchor"></div>
    <section class="content-section text-center px-4 lg:px-6 lazyload" style="padding-bottom: 0;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/bg-method.jpg">
        <div class="container mx-auto clearfix max-w-6xl">
            <i class="text-3xl md:text-5xl lg:text-6xl icon-drumeo-method text-drumeo"></i><br>
            <img class="h-7 md:h-10 lg:h-11 mt-1 mb-4 md:mb-8 imgfilter-method lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
            <h3 class="leading-tight " data-aos="fade-up"><strong>Always know exactly<br class="inline md:hidden"> what to practice.</strong></h3>
            <h6 class="leading-normal text-light-navy text-shadow-4 mt-3 md:mt-5 mb-20 md:mb-40">10 perfectly organized levels with video lessons<br class="inline md:hidden"> from the top authorities on every topic.</h6>
            <i class="fas fa-play play-button autoplay-video opacity-0" data-open="methodTrailer"></i>
            <h6 class="uppercase font-bebas mt-4 opacity-0">Play Method Trailer</h6>
            <h3 class="leading-tight mt-20 md:mt-40 mb-6 md:mb-10 " data-aos="fade-up"><strong>Your clear path, frustration-free <br class="inline lg:hidden">
                    guide to playing the drums.</strong></h3>
            @php
                $levels = [
                    [
                    "navyBorder" => true,
                    "defaultOpen" => true,
                    "level" => "1",
                    "title" => "Getting Started On The Drums",
                    "description" => "This is where it starts. You’ll learn how to set up your drum-set, hold your drumsticks properly, and play your first beats. And, best of all, you’ll learn how to play your first two songs on the drums.",
                    "meta" => "30 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "2",
                    "title" => "Basic Theory & Ear Training",
                    "description" => "In Level Two, you’ll continue to build your drumming foundation. You’re going to learn your first drum rudiments, develop basic reading skills (it’s not that hard, we promise!), and get introduced to three styles of drumming: rock, punk, and metal.",
                    "meta" => "51 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "3",
                    "title" => "The Motions Of Drumming",
                    "description" => "Learning the motions of drumming will help you play faster, smoother, and for longer periods. This level introduces you to key drum set techniques like the three main stick grips and beginner bass drum pedal technique.",
                    "meta" => "59 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "4",
                    "title" => "The Moeller Method & Essential Grooves",
                    "description" => "You’re ready to learn drumming’s most powerful technique! The Moeller Method is a technique drummers have used for decades to achieve power, efficiency and fluidity on the drums – all your favorites use it! Level Four also introduces you to new styles like jazz, blues, and rock ballads.",
                    "meta" => "64 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "5",
                    "title" => "Rhythmic Groupings & Independence",
                    "description" => "This is where you get creative. You’ll be introduced to the concept of “groupings” and how you can use them to create powerful grooves & fills of your own. You’ll also dig into more new styles like funk, Motown, and reggae that will push your independence – in a good way!",
                    "meta" => "63 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "6",
                    "title" => "Odd Time & Inspiration",
                    "description" => "Not gonna lie… Level Six is tough. But you’ve laid the foundation and you’re ready! Intermediate drummers will love learning how to play odd-time signatures and digging into world styles like Caribbean soca grooves and New Orleans second line.",
                    "meta" => "51 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "7",
                    "title" => "Foot Technique & Combinations",
                    "description" => "If you ever wondered how John Bonham’s foot was so fast… this is the level for you. You’ll dig into challenging bass drum techniques like slide, heel-toe, and swivel. And you’ll also get introduced to playing double-bass drum beats. Yup… get the double pedals out!",
                    "meta" => "34 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "8",
                    "title" => "Brushes, Texture & Articulation",
                    "description" => "This is where things get deeper. Level Eight dives into advanced topics like articulation and texture – how to express yourself more clearly on the drums. You’ll also explore new dynamic levels by learning brush stroke patterns and challenging new jazz styles. ",
                    "meta" => "43 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "9",
                    "title" => "Advanced Styles & Musical Decisions",
                    "description" => "By Level 9, you’re thinking about high-level concepts that will help you play live, in the studio, and on camera. Whether you’re jamming with a guitarist in your basement, playing in a wedding cover band, or touring the world playing stadiums with a rock band, it’s important to know how to make musical decisions for your specific scenario.",
                    "meta" => "38 Lessons"
                    ],
                    [
                    "navyBorder" => true,
                    "level" => "10",
                    "title" => "Go Anywhere On The Drums",
                    "description" => "Level 10 prepares you to “go anywhere on the drums.” You’ll learn about advanced rhythmic concepts like metric modulation, polyrhythms and polymeters, hybrid rudiments, and way more. These are concepts you can explore endlessly on your drumming journey.",
                    "meta" => "38 Lessons"
                    ],
                ]
            @endphp
            @foreach($levels as $level)
                    <div class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none @if(!empty($level['defaultOpen'])) active @endif
                    @if(!empty($level['navyBorder'])) border-navy-600 @endif">
                        <div class="bg-drumeo py-5 px-2 sm:px-3 ">
                            <h5 class="leading-tight whitespace-nowrap inline-flex items-center">
                                <span class="text-xs hidden md:inline mr-1"> LEVEL</span>
                                <strong>{{ $level['level'] }}</strong>
                            </h5>
                        </div>
                        <div class="py-5 px-3 md:px-4 text-left flex-grow">
                            <div class="flex items-center text-left flex-col sm:flex-row relative">
                                <h5 class="leading-tight flex-grow w-full sm:w-auto"><strong>{!! $level['title'] !!}</strong></h5>
                                @if(!empty($level['meta']))
                                    <p class="inline-flex text-light-navy w-full sm:w-auto">
                                        <em><strong> {!!  $level['meta'] !!} </strong></em>
                                    </p>
                                @endif
                            </div>
                            @if(!empty($level['description']))
                                <p class="description leading-normal transition-all duration-300 overflow-hidden opacity-0 h-0 max-h-0 invisible text-light-navy">
                                    <br>
                                    {!! nl2br( $level['description']) !!}
                                </p>
                            @endif
                        </div>
                        @if(!empty($level['description']))
                            <div class="py-5 px-2 sm:px-3 ml-auto">
                                <i class="text-sm sm:text-xl @if(!empty($level['navyBorder'])) text-light-navy @endif fas fa-chevron-down transform transition-all duration-300 @if(!empty($level['defaultOpen'])) rotate-180 @endif"></i>
                            </div>
                        @endif
                    </div>
                @endforeach

        </div>
    </section>
    <section class="content-section text-center px-4 lg:px-5" style="padding-top: 0;background:linear-gradient(to bottom, #01050f 60%, #021225);">
        <div class="container mx-auto clearfix max-w-6xl">

            <h4 class="mb-6 md:mb-7 lg:mb-10 mt-8 md:mt-10 lg:mt-14 leading-normal"><strong class="inline-block mr-1 bg-drumeo px-1 md:px-3 md:py-1 rounded-md md:rounded-lg leading-none" style="color: #000a1e;">PLUS</strong><em>On-demand access to <strong class="text-drumeo">{{ Prices::$courses }}+<br class="inline md:hidden"> courses</strong> &<br class="hidden md:inline">
                    <strong class="text-drumeo">{{ Prices::$lessons }}+ lessons</strong> to <br class="inline md:hidden">improve any skill, anytime.</em></h4>

            <div class="w-full flex flex-wrap justify-center md:mb-2 mx-auto max-w-xs md:max-w-full">
                @php
                    $topics = [
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-jared-falk.jpg',
                        'title' => 'Getting<br class="hidden md:inline"> Started',
                        'description' => 'Everything you need to get started on the drums, from setting up your kit to playing your first song!',
                        'artist' => 'Jared <strong>Falk</strong>',
                        'credit' => "Co-Founder of Drumeo.com",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-bruce-becker.jpg',
                        'title' => 'Hand<br class="hidden md:inline"> Technique',
                        'description' => 'Learn the most effective grips and motions so you can play with unlimited fluidity and confidence.',
                        'artist' => 'Bruce <strong>Becker</strong>',
                        'credit' => "Technique Author & Guru",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/instructors/drummer-jonathanmoffett.jpg',
                        'title' => 'Foot<br class="hidden md:inline"> Technique',
                        'description' => 'Improve your bass drum speed, power, control, and independence with lessons for all skill levels.',
                        'artist' => 'Jonathan <strong>Moffett</strong>',
                        'credit' => "Pop drummer for Michael Jackson",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-anika-nilles.jpg',
                        'title' => 'Creative<br class="hidden md:inline"> Drumming',
                        'description' => 'Stop playing the same old beats and fills - you’ll get insights to take your creativity to new heights. ',
                        'artist' => 'Anika <strong>Nilles</strong>',
                        'credit' => "Composer & Clinician",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-brian-frasier-moore.jpg',
                        'title' => 'Better<br class="hidden md:inline"> Grooves',
                        'description' => 'Make your playing come alive with practical tips for adding flavor to your drum grooves.',
                        'artist' => 'Brian <strong>Frasier-Moore</strong>',
                        'credit' => "3x Super Bowl Performer",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-thomas-lang.jpg',
                        'title' => 'Independence',
                        'description' => 'Unlock all four limbs so you can play complex patterns and achieve freedom behind the drums.',
                        'artist' => 'Thomas <strong>Lang</strong>',
                        'credit' => "8X Best Clinician",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-todd-sucherman.jpg',
                        'title' => 'Rudiments &<br class="hidden md:inline"> Application',
                        'description' => 'Learn all 40 drum rudiments PLUS get tips for applying them effectively and creatively.',
                        'artist' => 'Todd <strong>Sucherman</strong>',
                        'credit' => "Rock Drummer for Styx",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-rashid-williams.jpg',
                        'title' => 'Playing<br class="hidden md:inline"> Songs',
                        'description' => 'You’ll be able to break down any song, learn the drum parts, and put it all together quickly.',
                        'artist' => 'Rashid <strong>Williams</strong>',
                        'credit' => "John Legend, Alicia Keys",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-gene-hoglan.jpg',
                        'title' => 'Double<br class="hidden md:inline"> Bass',
                        'description' => 'Develop your double bass skills for better endurance, speed, dexterity, and balance.',
                        'artist' => 'Gene <strong>Hoglan</strong>',
                        'credit' => "Metal Drummer for Strapping Young Lad",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-gregg-bissonette.jpg',
                        'title' => 'Gigging<br class="hidden md:inline"> Tips',
                        'description' => 'Time-tested advice for working drummers - on getting gigs, playing styles, and stage presence. ',
                        'artist' => 'Gregg <strong>Bissonette</strong>',
                        'credit' => "Grammy Award Winner, Santana",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-peter-erskine.jpg',
                        'title' => 'Better<br class="hidden md:inline"> Practice',
                        'description' => 'Practice makes perfect. And you’ll get tips for more efficient practice routines to see faster results.',
                        'artist' => 'Peter <strong>Erskine</strong>',
                        'credit' => "Jazz Drummer, 2x Grammy Awards",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-senri-kawaguchi.jpg',
                        'title' => 'Speed &<br class="hidden md:inline"> Endurance',
                        'description' => 'Build incredible speed, power, and endurance with simple exercises that are proven to work.',
                        'artist' => 'Senri <strong>Kawaguchi</strong>',
                        'credit' => "Drum Prodigy & YouTube Sensation",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-heather-thomas.jpg',
                        'title' => 'Musicality',
                        'description' => 'Your skills only matter if the music sounds great -- so we’ll help you lock-in for any style & setting. ',
                        'artist' => 'Heather <strong>Thomas</strong>',
                        'credit' => "Singer & Drummer, Good Morning America",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-larnell-lewis.jpg',
                        'title' => 'Drum<br class="hidden md:inline"> Solos',
                        'description' => 'No matter your skill level, you’ll gain a blueprint for creating musical and interesting drum solos.',
                        'artist' => 'Larnell <strong>Lewis</strong>',
                        'credit' => "Grammy Award Winner, Snarky Puppy",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-michael-schack.jpg',
                        'title' => 'Electronic<br class="hidden md:inline"> Drums',
                        'description' => 'Get more from your electronic drums with setup demos, hybrid tips, and expert advice.',
                        'artist' => 'Michael <strong>Schack</strong>',
                        'credit' => "Touring E-Drums Clinician, Netsky",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-taylor-gordon.jpg',
                        'title' => 'Developing<br class="hidden md:inline"> Pocket',
                        'description' => 'Better pocket means you’ll have more people moving, dancing, and head bobbing to YOUR drumming.',
                        'artist' => 'Taylor <strong>Gordon</strong>',
                        'credit' => "The Pocket Queen",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-marco-minnemann.jpg',
                        'title' => 'Showmanship',
                        'description' => 'Learn simple but effective stick tricks to create incredible live shows and “WOW” your audiences.',
                        'artist' => 'Marco <strong>Minnemann</strong>',
                        'credit' => "Drummer & Composer, The Aristocrats",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-benny-greb.jpg',
                        'title' => 'Dynamic<br class="hidden md:inline"> Drumming',
                        'description' => 'Add dynamics to your playing to make even the simplest of drum beats sound totally amazing.',
                        'artist' => 'Benny <strong>Greb</strong>',
                        'credit' => "Clinician & Author, Language Of Drumming",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-tuning.jpg',
                        'title' => 'Tuning &<br class="hidden md:inline"> Recording',
                        'description' => 'Make your drums sound better with tuning tips, mic overviews, and recording advice from Drumeo engineers.',
                        'artist' => 'Victor <strong>Guidera</strong>',
                        'credit' => "Drumeo’s Audio Guru",
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/2021/topic-tony-coleman.jpg',
                        'title' => 'Musical<br class="hidden md:inline"> Styles',
                        'description' => 'Study any musical style -- rock, metal, jazz, latin, funk, prog, gospel, country, and more -- with legends.',
                        'artist' => '<span class="hidden md:inline"><strong>100+</strong> of the best drummers in the world.</span>',
                        'credit' => '',
                        ]
                    ]
                @endphp
                @foreach($topics as $topic)
                    <div class="relative md:px-2 lg:px-1 w-full md:w-1/3 lg:w-1/4 mx-auto mb-3 md:mb-5 lg:mb-1.5">
                        <div class="flip-div inline-block relative md:w-full group" style="perspective: 1000px;" data-aos="fade-down">
                            <div class="text-center relative md:w-full md:h-full md:absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="front relative z-20 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 hidden md:visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                    <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $topic['image'] }}"></div>
                                    <div class="absolute uppercase w-full bottom-3 md:bottom-5 z-10 text-shadow-4">
                                        <h3><strong> {!! $topic['title']  !!} </strong></h3>
                                    </div>
                                    <div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(11,118,219,0.9) 100%);"></div>
                                </div>
                                <div class="back relative z-40 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center md:text-black md:bg-white flex flex-wrap justify-center items-center content-center pt-3 md:p-3">
                                        <h5 class="leading-none uppercase mx-auto mb-2 md:mb-3 hidden sm:inline-block"><strong>{!! $topic['title']  !!}</strong></h5>
                                        <p class="leading-normal mx-auto">{{ $topic['description'] }}</p>
                                        <h6 class="w-full leading-normal uppercase mt-2 md:mt-3 mx-auto text-drumeo hidden md:inline-block">{!! $topic['artist'] !!}</h6>
                                        <p class="w-full leading-tight text-drumeo hidden md:inline-block"><em>{{ $topic['credit'] }}</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <a
                @hasSection('start-button')
                    href="@yield('start-button')" class="join blue smaller"
                @else
                    href="#customize-anchor" class="join blue smaller anchor-slide"
                @endif
            >GET STARTED</a>
        </div>
    </section>

    <div id="songs" class="anchor"></div>
    <section class="content-section text-center relative" style="background:linear-gradient(to bottom, #01050f 80%, #021225);">
        <div class="song-wrap relative z-0 overflow-hidden">
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/acdc-back-in-black.png" alt="AC/DC - Back In Black">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/270343-card-thumbnail-maxres-1602085835.jpg" alt="Avenged Sevenfold - Hail To The King">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260310-card-thumbnail-maxres-1592340581.jpg" alt="B.B. King - The Thrill Is Gone">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/beastie-boys-fight-for-your-right.jpg" alt="Beastie Boys - Fight For Your Right">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/20249-card-thumbnail-maxres-1592340937.jpeg" alt="Blink-182 - All The Small Things">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bon-jovi-livin-on-a-prayer.jpg" alt="Bon Jovi - Livin' On A Prayer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264327-card-thumbnail-maxres-1596218854.jpg" alt="Chick Corea Elektric Band - Beneath The Mask">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/chris-stapleton-tennessee-whiskey.jpg" alt="Chris Stapleton - Tennessee Whiskey">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260343-card-thumbnail-maxres-1592340469.jpg" alt="Coldplay - Yellow">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/acdc-back-in-black.png" alt="AC/DC - Back In Black">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/270343-card-thumbnail-maxres-1602085835.jpg" alt="Avenged Sevenfold - Hail To The King">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260310-card-thumbnail-maxres-1592340581.jpg" alt="B.B. King - The Thrill Is Gone">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/beastie-boys-fight-for-your-right.jpg" alt="Beastie Boys - Fight For Your Right">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/20249-card-thumbnail-maxres-1592340937.jpeg" alt="Blink-182 - All The Small Things">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/bon-jovi-livin-on-a-prayer.jpg" alt="Bon Jovi - Livin' On A Prayer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264327-card-thumbnail-maxres-1596218854.jpg" alt="Chick Corea Elektric Band - Beneath The Mask">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/chris-stapleton-tennessee-whiskey.jpg" alt="Chris Stapleton - Tennessee Whiskey">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260343-card-thumbnail-maxres-1592340469.jpg" alt="Coldplay - Yellow">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/creedence-clearwater-revival-bad-moon-rising.jpg" alt="Creedence Clearwater Revival - Bad Moon Rising">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/dr-dre-i-need-a-doctor.jpg" alt="Dr. Dre - I Need A Doctor">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/foo-fighters-everlong.jpg" alt="Foo Fighters - Everlong">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/eminem-lose-yourself.jpg" alt="Eminem - Lose Yourself">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260404-card-thumbnail-maxres-1592340380.jpeg" alt="Green Day - 21 Guns">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/jason-aldean-dirt-road-anthem.jpg" alt="Jason Aldean - Dirt Road Anthem">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/jay-z-empire-state-of-mind.jpg" alt="Jay-Z - Empire State Of Mind">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/john-coltrane-acknowledgement.jpg" alt="John Coltrane - Acknowledgement">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/john-lennon-imagine.jpg" alt="John Lennon - Imagine">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/creedence-clearwater-revival-bad-moon-rising.jpg" alt="Creedence Clearwater Revival - Bad Moon Rising">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/dr-dre-i-need-a-doctor.jpg" alt="Dr. Dre - I Need A Doctor">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/foo-fighters-everlong.jpg" alt="Foo Fighters - Everlong">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/eminem-lose-yourself.jpg" alt="Eminem - Lose Yourself">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260404-card-thumbnail-maxres-1592340380.jpeg" alt="Green Day - 21 Guns">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/jason-aldean-dirt-road-anthem.jpg" alt="Jason Aldean - Dirt Road Anthem">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/jay-z-empire-state-of-mind.jpg" alt="Jay-Z - Empire State Of Mind">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/john-coltrane-acknowledgement.jpg" alt="John Coltrane - Acknowledgement">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/john-lennon-imagine.jpg" alt="John Lennon - Imagine">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/johnny-cash-i-walk-the-line.jpg" alt="Johnny Cash - I Walk The Line">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/journey-don_t-stop-believin.jpg" alt="Journey - Don't Stop Believin'">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/led-zeppelin-good-times-bad-times.jpg" alt="Led Zeppelin - Good Times Bad Times">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/metallica-enter-sandman.jpg" alt="Metallica - Enter Sandman">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/miles-davis-freddie-freeloader.jpg" alt="Miles Davis - Freddie Freeloader">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/nirvana-come-as-you-are.jpg" alt="Nirvana - Come As You Are">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/nitty-gritty-dirt-band-fishin-in-the-dark.jpg" alt="Nitty Gritty Dirt Band - Fishin' In The Dark">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/oasis-wonderwall.jpg" alt="Oasis - Wonderwall">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/outkast-hey-ya.jpg" alt="OutKast - Hey Ya!">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-dec/album-art/johnny-cash-i-walk-the-line.jpg" alt="Johnny Cash - I Walk The Line">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/journey-don_t-stop-believin.jpg" alt="Journey - Don't Stop Believin'">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/led-zeppelin-good-times-bad-times.jpg" alt="Led Zeppelin - Good Times Bad Times">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/metallica-enter-sandman.jpg" alt="Metallica - Enter Sandman">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/miles-davis-freddie-freeloader.jpg" alt="Miles Davis - Freddie Freeloader">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/nirvana-come-as-you-are.jpg" alt="Nirvana - Come As You Are">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/nitty-gritty-dirt-band-fishin-in-the-dark.jpg" alt="Nitty Gritty Dirt Band - Fishin' In The Dark">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/oasis-wonderwall.jpg" alt="Oasis - Wonderwall">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/outkast-hey-ya.jpg" alt="OutKast - Hey Ya!">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/22613-card-thumbnail-maxres-1592341635.jpeg" alt="Pantera - Walk">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/paul-simon-50-ways-to-leave-your-lover.jpg" alt="Paul Simon - 50 Ways To Leave Your Lover">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/pearl-jam-even-flow.jpg" alt="Pearl Jam - Even Flow">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/phil-collins-in-the-air-tonight.jpg" alt="Phil Collins - In The Air Tonight">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/red-hot-chili-peppers-under-the-bridge.jpg" alt="Red Hot Chili Peppers - Under The Bridge">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/rush-tom-sawyer.jpg" alt="Rush - Tom Sawyer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/santana-smooth.jpg" alt="Santana - Smooth">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/280219-card-thumbnail-maxres-1608317248.jpg" alt="Snarky Puppy - What About Me?">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/31234-card-thumbnail-maxres-1592341311.jpg" alt="Sublime - Santeria">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/22613-card-thumbnail-maxres-1592341635.jpeg" alt="Pantera - Walk">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/paul-simon-50-ways-to-leave-your-lover.jpg" alt="Paul Simon - 50 Ways To Leave Your Lover">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/pearl-jam-even-flow.jpg" alt="Pearl Jam - Even Flow">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-september/album-art/phil-collins-in-the-air-tonight.jpg" alt="Phil Collins - In The Air Tonight">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/red-hot-chili-peppers-under-the-bridge.jpg" alt="Red Hot Chili Peppers - Under The Bridge">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/rush-tom-sawyer.jpg" alt="Rush - Tom Sawyer">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/santana-smooth.jpg" alt="Santana - Smooth">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/280219-card-thumbnail-maxres-1608317248.jpg" alt="Snarky Puppy - What About Me?">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/31234-card-thumbnail-maxres-1592341311.jpg" alt="Sublime - Santeria">
            </div>
            <div class="song-row absolute z-0 whitespace-nowrap">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/system-of-a-down-toxicity.jpg" alt="System Of A Down - Chop Suey!">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/the-killers-mr-brightside.jpg" alt="The Killers - Mr. Brightside">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/The-Roots-Mellow-My-Man.jpg" alt="The Roots - Mellow My Man">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/tool-the-pot.jpg" alt="Tool - The Pot">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/twenty-one-pilots-heathens.jpg" alt="Twenty One Pilots - Heathens">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/van-halen-hot-for-teacher.jpg" alt="Van Halen - Hot For Teacher">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/weezer-buddy-holly.jpg" alt="Weezer - Buddy Holly">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260702-card-thumbnail-maxres-1592339760.jpg" alt="Wolfmother - Joker &amp; The Thief">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260706-card-thumbnail-maxres-1592339732.jpg" alt="Zac Brown Band - Chicken Fried">

                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/system-of-a-down-toxicity.jpg" alt="System Of A Down - Chop Suey!">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/the-killers-mr-brightside.jpg" alt="The Killers - Mr. Brightside">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-november/album-art/The-Roots-Mellow-My-Man.jpg" alt="The Roots - Mellow My Man">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/tool-the-pot.jpg" alt="Tool - The Pot">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/twenty-one-pilots-heathens.jpg" alt="Twenty One Pilots - Heathens">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-june/album-art/van-halen-hot-for-teacher.jpg" alt="Van Halen - Hot For Teacher">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/drumeo-songs-2020-july/album-art/weezer-buddy-holly.jpg" alt="Weezer - Buddy Holly">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260702-card-thumbnail-maxres-1592339760.jpg" alt="Wolfmother - Joker &amp; The Thief">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/260706-card-thumbnail-maxres-1592339732.jpg" alt="Zac Brown Band - Chicken Fried">
            </div>
            <div class="absolute z-10 inset-0" style="background: linear-gradient(to bottom, #01050f, rgba(41,47,61,0.7), #01050f);"></div>
        </div>
        <div class="px-4 lg:px-6">
            <div class="container mx-auto relative z-10 max-w-6xl">
                <i class="text-3xl md:text-5xl lg:text-6xl icon-songs text-songs"></i><br>
                <img class="h-7 md:h-10 lg:h-11 mt-1 mb-4 md:mb-8 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                <h3 class="" data-aos="fade-up"><strong>Play your favorite songs.</strong></h3>
                <h6 class="leading-normal max-w-2xl lg:max-w-4xl text-light-navy mt-3 md:mt-5 mb-20 md:mb-40 text-shadow-4">
                    Playing drums is all about the MUSIC. So we’ve transcribed {{ Prices::$songs }}+ songs and created the ultimate practice tools. DrumeoSONGS automatically syncs sheet music with audio tracks for each song -- and lets you adjust the speed, create practice loops, play with or without the metronome, and so much more!
                </h6>
                <i class="fas fa-play play-button autoplay-video" data-open="songsTrailer"></i>
                <h6 class="uppercase font-bebas mt-4">Play Songs Trailer</h6>

                <h4 class="mt-20 md:mt-40 mb-6 md:mb-7 lg:mb-10 leading-normal"><strong class="inline-block mr-1 bg-songs px-3 py-1 rounded-md md:rounded-lg leading-none" style="color: #000a1e;">THE BEST PART ABOUT<br class="inline sm:hidden"> PLAYING THE DRUMS</strong><br>
                    <em class="text-shadow-4">Get {{ Prices::$songs }}+ note-for-note song breakdowns for every<br class="hidden md:inline"> <strong class="text-songs">style</strong>, <strong class="text-songs">era</strong>, and <strong class="text-songs">skill</strong> with handy play-along tools.</em></h4>

                <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center mx-auto mt-4 md:mt-14 lg:mt-20 mb-8 md:mb-10 px-2">
                    <div class="pic-wrap md:order-1 mx-auto my-5 md:my-0 pl-0 md:pl-5 lg:pl-10 flex-shrink-0">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/method-screens-05.png" alt="method-screen-5">
                        <img class="lazyload side-pic songs w-full md:hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/method-screens-04.png" alt="method-screen-4">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/method-screens-03.png" alt="method-screen-3">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/method-screens-02.png" alt="method-screen-2">
                        <img class="lazyload side-pic songs w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/method-screens-01.png" alt="method-screen-1">
                    </div>
                    <div class="text-left text-light-navy">
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90 active">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-music"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Find the perfect tempo.</strong></h4>
                                <p>Slow down or speed up any section of a song to hear every note your favorite drummer plays. When you’ve nailed the part, bump the tempo back up and rock out in real time.</p>
                            </div>
                        </div>
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-repeat"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Loop the trouble spots.</strong></h4>
                                <p>No more pausing and rewinding when you mess up that fill. Simply grab the section of the song and loop it over, and over, and over until you’ve got it down.</p>
                            </div>
                        </div>
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs icon-metronome"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Counting just got easier.</strong></h4>
                                <p>Add or remove the metronome to help you count out the beats in a bar. This makes learning songs of all levels easier -- even that odd-time Rush song!</p>
                            </div>
                        </div>
                        <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-arrow-to-bottom"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Take your charts anywhere.</strong></h4>
                                <p>Downloadable pdf files let you take sheet music of your favorite songs anywhere -- to the gig, rehearsal with the band, or back to the practice space.</p>
                            </div>
                        </div>
                        <div class="flex mx-auto md:cursor-pointer text-icon-wrap songs md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-phone-laptop"></i>
                            <div class="pl-3">
                                <h4 class="mx-auto mb-2 md:mb-3"><strong>Available on all your devices.</strong></h4>
                                <p>Load up DrumeoSONGS on your phone during practice time, your laptop when you’re behind the kit, and your tablet at the gig -- wherever the music takes you!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a
                    @hasSection('start-button')
                        href="@yield('start-button')" class="join blue smaller"
                    @else
                        href="#customize-anchor" class="join blue smaller anchor-slide"
                    @endif
                >GET STARTED &raquo;</a>
            </div>
        </div>
    </section>

    <div id="coaches" class="anchor"></div>
    <section class="content-section text-center px-4 lg:px-6 lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/bg-coaches.jpg">
        <div class="container mx-auto max-w-6xl">
            <img class="inline h-10 md:h-14 lg:h-16 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon"><br>
            <img class="h-7 md:h-10 lg:h-11 mt-3 mb-4 md:mb-8 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
            <h3 class="leading-tight " data-aos="fade-up"><strong>Stay motivated with backstage<br class="inline lg:hidden"> access to your drum heroes.</strong></h3>
            <h6 class="leading-normal max-w-2xl lg:max-w-4xl text-light-navy mt-3 md:mt-5 mb-8 md:mb-10 text-shadow-4">Connect with legendary coaches who’ll answer your questions and encourage your development as a drummer PLUS get unlimited personal support from our in-house team of professional drummers to review your videos and answer every question.</h6>
            @foreach($coaches as $coach)
                @if(!empty($coach['bigTile']))
                    <div class="px-1 md:px-2 mb-3 md:mb-4 mx-auto max-w-md md:max-w-3xl lg:max-w-full">
                        <div class="relative big-tile-bg bg-left-top rounded-xl overflow-hidden text-left px-3 md:px-10 lg:px-20 py-10 md:py-20 lg:py-36 cursor-pointer group @if(!empty($coach['trailer'])) autoplay-video @endif lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/{{ $coach['image'] }}" style="background-color:#010510"
                                @if(!empty($coach['trailer'])) data-open="{{ $coach['modal'] }}Trailer" @else  data-open="{{ $coach['modal'] }}" @endif >
                            @if(!empty($coach['trailer']))
                                <i class="absolute bottom-5 sm:bottom-auto sm:top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl group-hover:opacity-100 fas fa-play play-button smaller" data-open="{{ $coach['modal'] }}Trailer"></i>
                            @else
                                <i class="fas fa-expand absolute top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>
                            @endif
                            <div class="relative z-10">
                                <h4 class="inline-block leading-none font-bebas bg-coaches text-black rounded-sm px-2 md:px-3 pt-1">{!! $coach['date']  !!}</h4><br>
                                <h1 class="inline-block font-bebas leading-none mt-3 md:mt-5 mb-1 md:mb-4 text-5xl md:text-7xl lg:text-8xl" style="line-height: 0.85em;">{!! $coach['name']  !!}</h1><br>
                                <h5 class="inline-block leading-tight text-coaches uppercase">{!! $coach['subtitle'] !!}</h5><br>
                            </div>
                            <div class="absolute inset-0 z-0" style="background:linear-gradient(to right, #010510, transparent 50%);"></div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="flex flex-wrap items-center justify-center mx-auto max-w-md md:max-w-3xl lg:max-w-full">
                @foreach($coaches as $coach)
                    @if(!empty($coach['trending']))
                        @if(empty($coach['bigTile']))
                            <div class="px-1 md:px-2 lg:px-0.5 w-1/2 md:w-1/3 lg:w-1/6 mb-1 md:mb-2">
                                <div class="mx-auto" style="max-width:240px">
                                    <div class="inline-block relative w-full group" style="padding-bottom: 148%; perspective: 1000px;" data-open="{{ $coach['modal'] }}">
                                        <div class="text-center w-full h-full absolute cursor-pointer">
                                            <div class="absolute z-20 overflow-hidden rounded-xl w-full h-full">
                                                <i class="fas fa-expand absolute top-2 right-2 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>
                                                <div class="bg-image w-full bg-black bg-top bg-cover lazyload" style="padding-bottom: 145%;" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}"></div>
                                                <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                                    <h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $coach['name']  !!}</h2>
                                                    <p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $coach['subtitle'] !!}</p>
                                                </div>
                                                <p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $coach['date'] !!}</p>
                                                <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
            {{--<h4 class="mt-8 md:mt-12 mb-6 md:mb-7 lg:mb-10 leading-normal"><strong class="inline-block mr-1 bg-coaches px-3 py-1 rounded md:rounded-lg leading-none" style="color: #000a1e;">PLUS ONGOING ACCESS<br class="inline sm:hidden"> & PERSONAL SUPPORT</strong><br>--}}
                {{--<em>Enjoy new monthly releases and direct access to Grammy winners,<br class="hidden md:inline"> social media sensations, and award-winning clinicians.</em></h4>--}}
            {{--<div class="relative z-10 mx-auto mb-8 md:mb-16 flex flex-wrap justify-center max-w-md md:max-w-full">--}}
                {{--@foreach($coaches as $coach)--}}
                    {{--@if(empty($coach['trending']))--}}
                        {{--<div class="w-full md:w-1/2 px-1 md:px-2">--}}
                            {{--<div data-aos="fade-down" class="overflow-hidden cursor-pointer relative mx-auto mb-3 rounded-3xl bg-cover bg-top group lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}" data-open="{{ $coach['modal'] }}" style="background-color:#00141d;padding-bottom: 52.65%;">--}}
                                {{--<i class="fas fa-expand absolute top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>--}}
                                {{--<div class="absolute text-left uppercase select-none z-10 left-4 bottom-4 lg:bottom-auto transform lg:-translate-y-1/2 lg:top-1/2 text-shadow-1">--}}
                                    {{--<h1 class="leading-none mx-auto mb-1 md:mb-2 font-bebas" style="line-height:0.85em;">{!! $coach['name'] !!}</h1>--}}
                                    {{--<h6 class="leading-tight text-coaches uppercase">{!! $coach['tileSubtitle'] !!}</h6>--}}
                                {{--</div>--}}
                                {{--<div class="z-0 absolute inset-0" style="background: linear-gradient(to right, #000a18, transparent 60%);"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--</div>--}}
            <h3 class="leading-tight mt-8 md:mt-16" data-aos="fade-up"><strong>Your calendar never<br class="inline sm:hidden"> sounded so good.</strong></h3>
            <h6 class="leading-normal max-w-2xl lg:max-w-4xl text-light-navy mt-3 md:mt-5 mb-5 md:mb-20">You’ll have the chance to learn from a NEW featured coach every month of 2022 including drumming’s biggest names like Steve Smith, Jay Weinberg, Cindy Blackman-Santana and more. </h6>
            <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center mx-auto mb-8 md:mb-10">
                <div class="pic-wrap md:order-0 mx-auto my-5 md:my-0 pr-0 md:pr-5 lg:pr-10 flex-shrink-0">
                    <img class="lazyload side-pic coaches w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-rotating-01.png" alt="coach-rotating-1">
                    <img class="lazyload side-pic coaches w-full md:hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-rotating-02.png" alt="coach-rotating-2">
                    <img class="lazyload side-pic coaches w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/coach-rotating-03.png" alt="coach-rotating-3">
                </div>
                <div class="text-left text-light-navy">
                    <div class="flex mx-auto mb-9 md:mb-7 lg:mb-10 md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90 active">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-lightbulb-on"></i>
                            <div class="pl-3">
                            <h3 class="mx-auto mb-2 md:mb-3"><strong>Inspiration</strong></h3>
                            <p>You’ve got front-row seats to the best drummers in the world. Your coaches are here to inspire you about what’s possible on the drums through organized courses, live streams, and Q&A sessions.</p>
                        </div>
                    </div>
                    <div class="flex mx-auto mb-9 md:mb-7 lg:mb-10 md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-users"></i>
                            <div class="pl-3">
                            <h3 class="mx-auto mb-2 md:mb-3"><strong>Connection</strong></h3>
                            <p>Every coach is in your corner. You’ll have opportunities to get feedback on your playing, ask your biggest questions, and have ongoing support throughout your drumming journey and beyond.</p>
                        </div>
                    </div>
                    <div class="flex mx-auto md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90">
                            <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-signal-alt"></i>
                            <div class="pl-3">
                            <h3 class="mx-auto mb-2 md:mb-3"><strong>Results</strong></h3>
                            <p>Your coaching sessions include clear takeaways you can start applying to your own drumming right away. You can play with confidence knowing you’re getting advice from your favorite drum heroes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <a
                @hasSection('start-button')
                    href="@yield('start-button')" class="join blue smaller"
                @else
                    href="#customize-anchor" class="join blue smaller anchor-slide"
                @endif
            >GET STARTED &raquo;</a>
        </div>
    </section>

    <section class="content-section text-center">
        <div class="gradient-bg absolute top-0 left-0 right-0 z-0" style="background: linear-gradient(to bottom, #01050f 60%, #021225);"></div>
        <div class="container mx-auto relative z-10">
            <img class="h-32 md:h-48 lg:h-56 mb-14 lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/drumeo-dotted-logo.png" alt="drumeo-dotted-logo">
            <h6 class="text-light-navy">Drum lessons at your fingertips.</h6>
            <h3 class="mt-3 md:mt-5 mb-8 md:mb-12 " data-aos="fade-up"><strong>Wherever you go. Whatever you use.</strong></h3>
            <div class="device-spread relative w-full mx-auto mb-5 md:mb-0">
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md desktop">
                    <em class="inline-block">World<br> Class<br> Teachers</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-right-blue.png" alt="arrow-right">
                </div>
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md macbook">
                    <em class="inline-block">Regular<br> Live<br> Lessons</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-right-alt-blue.png" alt="arrow-right">
                </div>
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md ipad">
                    <em class="inline-block">better<br> practice<br> tools</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 h-7 lg:h-9 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-down-blue.png" alt="arrow-left">
                </div>
                <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md iphone">
                    <em class="inline-block">Learn<br> from<br> anywhere</em><br class="hidden md:inline">
                    <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-blue.png" alt="arrow-left">
                </div>
                <img class="w-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/drumeo-spread.png" alt="drumeo-spread">
                <video class="absolute rounded-md" style="width: 43.1%;height: 54%;left: 6.5%;top: 39.1%;" src="https://drumeo-assets.s3.amazonaws.com/sales/2022/spread-vid.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
            </div>
        </div>
    </section>

    <section class="content-section text-center comparison px-1 lg:px-3">
        <div class="container mx-auto max-w-6xl">
            <h3 class="mb-8 md:mb-12 " data-aos="fade-up"><strong>Say hello to your unfair advantage.</strong></h3>
            <table class="w-full mx-auto border-separate comparison">
                <tbody>
                <tr style="background-color:transparent!important;">
                    <td></td>
                    <td class="rounded-t-xl">
                        <img class="h-5 md:h-9 lazyload"  data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png" alt="logo-white">
                    </td>
                    <td class="rounded-t-xl">Private Lessons</td>
                </tr>
                <tr>
                    <td>Step-By-Step Curriculum</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Consistent & Qualified Advice</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Progress-Tracking</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Live Lessons & Questions</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>Personal Reviews & Feedback</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-check-circle"></i></td>
                </tr>
                <tr>
                    <td>{{ Prices::$songs }}+ Popular Songs</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Downloadable Sheet Music</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Connect With Drum Legends</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>100+ World-Class Teachers</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Re-Watch Any Lesson</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Learn From Home, Anytime</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>Supportive Community</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr>
                    <td>100% Money Back Guarantee</td>
                    <td><i class="fas fa-check-circle"></i></td>
                    <td><i class="fas fa-minus"></i></td>
                </tr>
                <tr style="background-color:transparent!important;">
                    <td></td>

                    @hasSection('comparison')
                        @yield('comparison')
                    @else
                        <td class="rounded-b-xl">
                            @if(empty($trialVersion))
                                @if(number_format(Prices::$drumeoEdgeAnnual, 2) == intval(Prices::$drumeoEdgeAnnual))
                                    <strong>${{  round(Prices::$drumeoEdgeAnnual / 12, 2) }}</strong>/mo<br>
                                @else
                                    <strong>${{  number_format(Prices::$drumeoEdgeAnnual / 12, 2)  }}</strong>/mo<br>
                                @endif
                                <em>Billed annually at ${{  Prices::$drumeoEdgeAnnual }}</em><br><br>
                                Unlimited lessons & support.
                            @else
                                <strong>Free Trial</strong><br>&nbsp;
                            @endif
                        </td>
                    @endif
                    <td class="rounded-b-xl">
                        <strong>$200</strong>/mo<br>
                        <em>Typically $50 per 30-minutes.</em><br><br>
                        For private lessons.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div id="testimonials" class="anchor"></div>
    <section class="content-section text-center px-3 lg:px-5">
        <div class="container mx-auto max-w-6xl">
            <h3 class="leading-tight mb-8 md:mb-11 " data-aos="fade-up"><strong>Trusted By Drummers<br class="inline-block sm:hidden">  Everywhere</strong></h3>
            <div class="flex flex-wrap items-start justify-center mx-auto">
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#cd201f;background: #051124;">
                        <a href="https://www.youtube.com/freedrumlessons/" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-3xl md:text-5xl"></i>
                        </a>
                        <h2 class="font-black leading-none my-2 text-white">2.4M</h2>
                        <p class="uppercase leading-none md:tracking-widest">Subs<span class="hidden sm:inline-block">cribers</span></p>
                    </div>
                </div>
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#3b5998;background: #051124;">
                        <a href="https://facebook.com/drumeo/" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-3xl md:text-5xl"></i> </a>
                        <h2 class="font-black leading-none my-2 text-white">1.2M</h2>
                        <p class="uppercase leading-none md:tracking-widest">Likes</p>
                    </div>
                </div>
                <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                    <div class="instagram py-4 md:py-5 lg:py-6 rounded-xl w-full" style="background: #051124;">
                        <a href="https://instagram.com/drumeoofficial/" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-3xl md:text-5xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                        </a>
                        <h2 class="font-black leading-none my-2 text-white">942K</h2>
                        <p class="uppercase leading-none md:tracking-widest" style="color:#E1306C">Followers</p>
                    </div>
                </div>
            </div>
            <div class="testimonials flex flex-wrap justify-center mx-auto w-full max-w-xs md:max-w-full">
                @php
                    $testimonials = [
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ed-koop.jpg',
                        'modal' => 'testimonial1',
                        'title' => 'He made the band & he’s<br> playing his dream gigs.',
                        'description' => 'After 20 years away from the drums, Ed says he’s loving music more than ever. He nailed his first audition and has now played at the venues of his dreams.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/lisa-aragon.jpg',
                        'modal' => 'testimonial2',
                        'title' => 'She can now jam with<br> anyone she wants.',
                        'description' => 'Lisa got interested in the drums by playing Rock Band. She had no idea she’d be performing with strangers in Nashville just a few years later.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/nick-rudman-2.jpg',
                        'modal' => 'testimonial3',
                        'title' => 'Retirement was too<br> slow for him.',
                        'description' => 'After working on the railroad for 40 years, Nick now keeps his snare drum beside his bed...just in case he wakes up with a good idea.',
                        ],
                        [
                        'image' => 'https://i.vimeocdn.com/video/1143532818-61ead907372040ae51f23b9d5f05469c271aee744e9cb67e777ae4307f762b23-d_620',
                        'modal' => 'testimonial12',
                        'title' => 'The student has<br> become the teacher.',
                        'description' => 'Omari had big shoes to fill. His father was already an accomplished drummer in Trinidad & Tobago when Omari decided to take his drumming to the next level.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/guy-dobbins.jpg',
                        'modal' => 'testimonial4',
                        'title' => 'Same-day advice got<br> him through the gig.',
                        'description' => 'Guy had trouble figuring out a song, he reached out and an instructor walked him through it that same day - getting him through the gig that evening.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/marlene-rosen.jpg',
                        'modal' => 'testimonial5',
                        'title' => 'She didn’t let cancer<br> stop the rhythm.',
                        'description' => 'Marlene, a cancer survivor, filled her recovery time with drumming and was able to progress at a pace that worked for her.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/barry-lisle.jpg',
                        'modal' => 'testimonial6',
                        'title' => 'He loved the drums as a <br>kid, now he’s in two bands.',
                        'description' => 'Barry wanted something to keep his mind busy, so he revisited the instrument he’d loved as a kid: the drums. Now he’s playing in bands and recording an album.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/jay-damberg-2.jpg',
                        'modal' => 'testimonial7',
                        'title' => 'Private teachers weren’t<br> available at 11PM',
                        'description' => 'With a full-time job and a family, Jay often can’t practice drums until late at night, which is why he loves being able to access Drumeo whenever he wants.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/ivy-elizondo-2.jpg',
                        'modal' => 'testimonial8',
                        'title' => 'She took her kids’ drums<br> and started a band.',
                        'description' => 'When Ivy’s kids decided to stop playing drums, she jumped on the throne instead -- she’s used Drumeo to build a foundation and formed a band.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/scott-anderson.jpg',
                        'modal' => 'testimonial9',
                        'title' => 'He’s addicted to<br> self-improvement.',
                        'description' => 'Scott was frustrated starting out on the drums, so he joined Drumeo which helped him slow down, see how everything fits together, and gain momentum.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/john-pruden.jpg',
                        'modal' => 'testimonial10',
                        'title' => 'He developed his own<br> style with an army of teachers.',
                        'description' => 'John didn’t have time for weekly lessons or sifting through online content. Drumeo gave him structure and the ability to learn from different world class instructors.',
                        ],
                        [
                        'image' => 'https://dpwjbsxqtam5n.cloudfront.net/sales/testimonials/phil-davis.jpg',
                        'modal' => 'testimonial11',
                        'title' => 'Finally, online drum<br> lessons he could trust.',
                        'description' => 'Phil found the vast amount of online content disorganized, overwhelming and contradictory, so he quickly made himself at home with Drumeo.',
                        ],
                    ]
                @endphp
                @foreach($testimonials as $testimonial)
                    <div class="testimonial w-full md:w-1/3 lg:w-1/4 md:px-2 pb-2 md:pb-4 flex flex-auto">
                        <div class="rounded-xl overflow-hidden" style="background: #051124;">
                            <div class="thumb aspect-16:9 relative bg-center bg-cover autoplay-video cursor-pointer lazyload" data-bg="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $testimonial['image'] }}" data-open="{{ $testimonial['modal'] }}">
                                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller"></i>
                            </div>
                            <div class="p-4">
                                <p class="leading-tight mb-2"><strong>{!!  $testimonial['title'] !!}</strong></p>
                                <p class="leading-normal text-light-navy text-sm">{{ $testimonial['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="w-full -mt-14 lg:-mt-5">
                    <div class="join smaller outline light-navy testimonials-show-all mx-auto">Show More</div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section text-center px-6" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img data-aos="fade-down" class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2022/guarantee.png" alt="guarantee-badge">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 "><strong>Test-drive your lessons for 90 days.</strong><br>
            Zero risk.</h3>
            <p class="text-light-navy leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums. </p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div data-aos="fade-down" class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div data-aos="fade-down" data-aos-delay="50" class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div data-aos="fade-down" data-aos-delay="100" class="w-full sm:w-1/3 px-2">
                    <h5 class="text-drumeo border-drumeo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="tooltip inline-block cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    <div class="unstick-trigger block"></div>
    @yield('final')

    @foreach($coaches as $coach)
        <div class="reveal coach-wrap relative rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{{ $coach['modal'] }}" data-reveal data-reset-on-close="false">
            @if($coach['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $coach['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-44 md:pb-60 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $coach['image'] }}">
                @if(!empty($coach['trailer']))
                    <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller autoplay-video" data-close data-open="{{ $coach['modal'] }}Trailer"></i>
                @endif
            </div>
            <div class="p-4 md:p-5">
                @if(!empty($coach['date']))
                    <h6 class="leading-none font-bebas uppercase text-coaches mx-auto mb-3 md:mb-2">{{ $coach['date'] }}</h6>
                @endif
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $coach['name'])  !!}</h2>
                <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  str_replace('<br>', ' ', $coach['subtitle'])  !!}</p>
                @if(!empty($coach['bubbles']))
                    <div class="mx-auto mb-1 md:mb-2">
                        {!!  $coach['bubble1']  !!}
                        @if(!empty($coach['bubble2'])){!!  $coach['bubble2']  !!}@endif
                        @if(!empty($coach['bubble3'])){!!  $coach['bubble3']  !!}@endif
                    </div>
                @endif
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $coach['info'] !!}</p>
            </div>
            @if($coach['next'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $coach['next'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
            @endif
        </div>
    @endforeach

    @php
        $videoModals = [
            [
            'modal' => 'methodTrailer',
            'vimeo' => '495414150',
            ],
            [
            'modal' => 'songsTrailer',
            'vimeo' => '495414171',
            ],
            [
            'modal' => 'testimonial1',
            'vimeo' => '342059271',
            ],
            [
            'modal' => 'testimonial2',
            'vimeo' => '373252004',
            ],
            [
            'modal' => 'testimonial3',
            'vimeo' => '342066325',
            ],
            [
            'modal' => 'testimonial4',
            'vimeo' => '373445704',
            ],
            [
            'modal' => 'testimonial5',
            'vimeo' => '373446024',
            ],
            [
            'modal' => 'testimonial6',
            'vimeo' => '342066433',
            ],
            [
            'modal' => 'testimonial7',
            'vimeo' => '373445466',
            ],
            [
            'modal' => 'testimonial8',
            'vimeo' => '373445819',
            ],
            [
            'modal' => 'testimonial9',
            'vimeo' => '373445587',
            ],
            [
            'modal' => 'testimonial10',
            'vimeo' => '373445917',
            ],
            [
            'modal' => 'testimonial11',
            'vimeo' => '373446155',
            ],
            [
            'modal' => 'testimonial12',
            'vimeo' => '553438851',
            ],
            [
            'modal' => 'weltonTrailer',
            'vimeo' => '661320978',
            ],
            [
            'modal' => 'nekrutmanTrailer',
            'vimeo' => '671354594',
            ],
            [
            'modal' => 'spearsTrailer',
            'vimeo' => '683067897',
            ],
            [
            'modal' => 'chambersTrailer',
            'vimeo' => '693235712',
            ],
            [
            'modal' => 'phillipsTrailer',
            'vimeo' => '707892791',
            ],
            [
            'modal' => 'smithTrailer',
            'vimeo' => '726153277',
            ],
         ]
    @endphp
    @foreach($videoModals as $videoModal)
        <div class="reveal large" id="{{ $videoModal['modal'] }}" data-reveal data-reset-on-close="false">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $videoModal['vimeo'] }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
            </div>
        </div>
    @endforeach


    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/sales-page.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.tzcd-mcdays').countdown('2022/10/01')
                .on('update.countdown', function (event) {
                    var format = '';

                    if (event.offset.totalDays > 0) {
                        format = '%-D ' + format;
                    } else if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('limited time');
                });
            $('.tzcd-full').countdown('2022/10/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-days').countdown('2022/10/01')
                .on('update.countdown', function (event) {
                    var format = '';

                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    } else if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    } else if (event.offset.totalHours <= 0) {
                        format = '%-M Minute%!M %-S Second%!S' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('limited time');
                });
            $('.tzcd-small').countdown('2022/10/01')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
        });
    </script>

    @yield('scripts')
@stop
