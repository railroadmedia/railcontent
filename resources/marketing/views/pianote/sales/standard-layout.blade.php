@extends('pianote._partials.global-layout')

@section('global-head')
    @yield('meta')
    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta name="google-site-verification" content="jBgu6Dd2U4OfaZ_90eIjxuPWIJ1qIVBuO5nEp2xvhbE"/>

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote2.jpg" style="display: none;">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}
@stop

@section('global-body')
    @if(empty($rolandVersion))
        @include('pianote._partials._nav', [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "homepageVersion" => true,
        ])
    @else
        @include('pianote._partials._nav')
    @endif

    @yield('top-promo-bar')

    <div class="sticky-trigger block"></div>
    @yield('sticky-bar')

    @hasSection('header')
        @yield('header')
    @else
        <header class="header text-white relative overflow-hidden z-10" style="background-color:#29050f;">
            <div class="transform -translate-y-1/2 top-3/4 md:top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center md:text-left">
                <div class="container mx-auto max-w-6xl">
                    <h1 class="leading-tight max-w-xs md:max-w-md lg:max-w-2xl mx-auto md:mx-0 md:text-3xl lg:text-4xl"><strong>Learn the piano anytime <br> with real teachers.</strong></h1>
                    <h6 class="leading-normal text-light-navy text-shadow-4 mt-3 md:mt-5 mb-5 md:mb-7">
                        <strong>TECHNOLOGY MEETS TRADITION:</strong> Online video <br>
                        lessons you can watch anytime, with support<br>
                        from real teachers every step of the way.</h6>
                    <a
                        @hasSection('start-button')
                            href="@yield('start-button')" class="join blue smaller w-1/2 md:w-1/3 lg:w-1/4"
                        @else
                            href="#customize-anchor" class="join blue smaller anchor-slide w-1/2 md:w-1/3 lg:w-1/4 anchor-slide"
                        @endif
                    >
                        @if(!empty($trialVersion) && $trialVersion)
                            Start your free trial
                        @else
                            Get Started
                        @endif
                    </a>
                    @if(!empty($bfButton))
                        <a data-open="trailer" class="join outline promo smaller autoplay-video w-2/3 md:w-auto mt-3 md:mt-0"><i class="fas fa-play"></i> Holiday Deals</a>
                    @endif
                </div>
            </div>
            <div class="header-image relative mx-auto w-full h-full relative z-0" style="max-width: 1536px;background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_auto:best/q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/header-image5.jpg);">
                <div class="top-0 left-0 absolute w-full h-full z-10 hidden xl:block" style="background: linear-gradient(to right, #29050f, transparent 60%, transparent 85%, #29050f);"></div>
                <div class="top-0 left-0 absolute w-full h-full z-10 hidden md:block xl:hidden" style="background: linear-gradient(to right, #29050f, transparent 75%);"></div>
                <div class="top-0 left-0 absolute w-full h-full z-10 block md:hidden" style="background: linear-gradient(to bottom, transparent 35%, #29050f);"></div>
            </div>
        </header>
    @endif

    <section class="px-2 lg:px-4 py-10 md:py-14 md:py-20 text-white text-center overflow-hidden" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">
        <div class="container mx-auto max-w-6xl">
            <h3 class="leading-tight " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>
                    Achieve musical<br class="inline md:hidden"> freedom on the piano.</strong></h3>
            <p class="text-light-navy mt-2 md:mt-4 mb-8 md:mb-10">Develop your skills and play your favorite<br class="inline md:hidden"> songs with guidance from the best<br class="inline md:hidden"> piano players in the world.</p>
            <div class="md:grid md:grid-cols-3 md:gap-4 max-w-xs md:max-w-full mx-auto">
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/coaches-thumbs.jpg"></div>
                    <div class=" px-4 lg:px-6 py-5 lg:py-7">
                        <i class="text-4xl align-middle fal fa-piano text-pianote"></i>
                        <img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                        <h4 class="leading-tight my-3"><strong>Step-By-Step<br class="hidden md:inline"> Curriculum</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">Build your foundation on the piano with a perfectly structured curriculum that will teach you all the skills you need to start playing beautiful music. This is your guide to musical freedom on the piano, perfect for beginners and intermediates.</p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller method outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#method">Learn More</a>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/songs-thumbs.jpg"></div>
                    <div class="px-4 lg:px-6 py-5 lg:py-7">
                        <i class="text-4xl align-middle icon-songs text-songs"></i>
                        <img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                        <h4 class="leading-tight my-3"><strong>Play Your <br class="hidden md:inline">  Favorite Songs</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">Nothing is better than playing real music! 100s of detailed song tutorials will teach you how to play popular music from all eras, styles, and genres. Practice along to backing tracks and download the sheet music for every song.</p>
                        <a class="absolute bottom-4 lg:bottom-6 left-0 right-0 join smaller songs outline anchor-slide w-2/3 md:w-5/6 lg:w-2/3 mx-auto" href="#songs">Learn More</a>
                    </div>
                </div>
                <div class="relative rounded-xl overflow-hidden" style="background-color:#051124;">
                    <div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/method-thumbs.jpg"></div>
                    <div class="px-4 lg:px-6 py-5 lg:py-7">
                        <img class="h-8 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">
                        <img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                        <h4 class="leading-tight my-3"><strong>Motivation <br class="hidden md:inline"> & Support</strong></h4>
                        <p class="leading-normal text-light-navy mb-10 md:mb-14">From the big stage straight to your living room – you’ll get weekly live events, lessons, and personal feedback from incredible artists as they guide and support you every step of the way on your piano journey. </p>
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
            >
                @if(!empty($trialVersion) && $trialVersion)
                    Start your free trial
                @else
                    Get The Pianote Advantage
                @endif
            </a>
            <p class="text-light-navy text-sm"><em>Trusted by 26,040 active students.</em></p>

            <div class="slick mx-auto max-w-xs md:max-w-xl lg:max-w-4xl my-9 md:mb-0 h-44 sm:h-24 lg:h-20">
                <div class="px-3 md:px-6">
                    <p class="leading-normal text-sm"><em>“Pianote is a really fun resource for those wishing to pick up tips and tricks and gain perspective. ”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-yvette.jpg" alt="testimonial-yvette"><br class="inline md:hidden">
                        <p class="w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>Yvette Young, <br class="inline md:hidden"> Multi-Instrumentalist</em></p>
                    </div>
                </div>
                <div class="px-3 md:px-6">
                    <p class="leading-normal text-sm"><em>“You should check out Pianote. If you’re a beginner or intermediate, this is ideal for you!”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-ali.jpg" alt="testimonial-ali"><br class="inline md:hidden">
                        <p class="w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>Ali Spagnola,<br class="inline md:hidden"> YouTube Entertainer</em></p>
                    </div>
                </div>
                <div class="px-3 md:px-6">
                    <p class="leading-normal text-sm"><em>“Whether you’re getting your head around “Chopsticks” or brushing up on your Shostakovich, there should be a lesson for you.”</em></p>
                    <div class="flex flex-wrap md:flex-nowrap items-center justify-center mt-1.5">
                        <img class="rounded-full h-10 lazyload" data-src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/feature-testimonial-musicradar.jpg" alt="testimonial-musicradar"><br class="inline md:hidden">
                        <p class="w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>MusicRadar,<br class="inline md:hidden"> Website For Musicians</em></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="promo" class="anchor"></div>
    @yield('promo-banner')

    <div id="timeline" class="anchor"></div>
    <section class="content-section text-center px-4 lg:px-5" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">
        <div class="container mx-auto max-w-6xl">
            <h3 class="" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>What’s Trending <br class="inline sm:hidden"> Inside Pianote</strong></h3>
            <p class="leading-normal text-light-navy mt-2 md:mt-4">Join today to get access to our newest releases & events...</p>

            @php
                $coaches = [
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/summer-swee-singh2.jpg',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/summer-swee-singh2.jpg',
                    'date' => 'Available Now',
                    'name' => 'Summer<br> Swee-Singh',
                    'subtitle' => 'Creating The Perfect<br> Piano Arrangement',
                    'smallInfo' => 'Learn how to create your own beautiful arrangements on the piano from the skilled Summer Swee-Singh.',
                    'info' => 'There is nothing quite as satisfying and empowering as being able to put your own spin on your favorite songs.  And Summer is a true master of doing just that.<br><br>She’s truly dedicated to her craft, and is praised for her arrangements and compositions by artists around the world.<br><br>Learn from the skilled Summer Swee-Singh and discover her process for creating arrangements on the piano.',
                    'modal' => 'singh',
                    'prev' => false,
                    'next' => 'noona',
                    'trending' => true,
                    'trailer' => true,
                    'bigTile' => true,
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/sangah-noona2.jpg',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/sangah-noona2.jpg',
                    'date' => 'Available Now',
                    'name' => 'Sangah<br> Noona',
                    'subtitle' => '5 Essential<br> Styles',
                    'smallInfo' => 'Discover new techniques to help you play any genre on the piano from the experienced Sangah Noona.',
                    'info' => 'As an experienced performer and technical guru on the keys, Sangah Noona is an incredibly versatile pianist that can play in just about any and every style.<br><br>Pop, Jazz, Blues, Funk, Bossa Nova, and more. She can play it all, and sounds pretty dang good doing it.<br><br>She’ll be motivating you to discover new styles and techniques so you can sound incredible playing any genre.',
                    'modal' => 'noona',
                    'prev' => 'singh',
                    'next' => 'molina',
                    'trending' => true,
                    'trailer' => true,
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/jesus_molina3.jpg',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/jesus_molina3.jpg',
                    'date' => 'Available Now',
                    'name' => 'JESÚS<br>MOLINA',
                    'subtitle' => 'IMPROVISATION &<br>MUSICAL FREEDOM',
                    'smallInfo' => 'Take your musical freedom to the next level as you explore the world of improvisation with Jesús Molina.',
                    'info' => 'Colombian jazz pianist Jesús Molina is an award-winning piano virtuoso. He quickly discovered his natural talents on the piano from a young age and attended Berklee College of Music.<br><br>He’s a master of improvising over jazz, ragtime, and odd time signatures with some of the fastest moving fingers you’ll ever see.<br><br>Take your musical freedom to the next level as you explore the world of improvisation with Jesús Molina.',
                    'modal' => 'molina',
                    'prev' => 'noona',
                    'next' => 'hawkins',
                    'trending' => true,
                    'trailer' => true
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/erskine-hawkins3.jpg',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/erskine-hawkins3.jpg',
                    'date' => 'Available Now',
                    'name' => 'Erskine<br> Hawkins',
                    'subtitle' => 'Teaches Gospel<br> Piano',
                    'smallInfo' => 'Discover the world of gospel piano from music director and performer, Erskine Hawkins.',
                    'info' => 'As a music director for Disney star Zendaya, producer and performer, Erskine Hawkins has done a lot. But his favorite thing in the world is playing gospel piano.<br><br>After touring with Eminem and Rihanna, Erskine focused on his love for gospel music and playing in church, and has become a true master of the genre.<br><br>He’s here to share his knowledge of gospel piano and help you learn and grow as a musician.',
                    'modal' => 'hawkins',
                    'prev' => 'molina',
                    'next' => 'witt2',
                    'trending' => true,
                    'trailer' => true
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/lisa-witt.jpg',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/lisa-witt.jpg',
                    'date' => 'Available Now',
                    'name' => 'Lisa<br> Witt',
                    'subtitle' => 'Teaches The Power<br> Of Chords',
                    'smallInfo' => '',
                    'info' => 'Lisa Witt is a well known face in the piano community, reaching millions of people around the world through her online lessons. 20 years of teaching experience, training through the Royal Conservatory of Music, and embracing all styles of playing has equipped her to teach you just about anything you’d ever want to learn on the piano. Lisa’s contagious enthusiasm will have you excited every time you sit down to play and will make learning the piano a super fun and engaging experience.',
                    'modal' => 'witt2',
                    'prev' => 'hawkins',
                    'next' => 'theodore',
                    'trending' => true,
                    'trailer' => true
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/victoria-theodore2.jpg',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/victoria-theodore2.jpg',
                    'date' => 'Available Now',
                    'name' => 'Victoria<br> Theodore',
                    'subtitle' => 'Teaches Classical<br> Piano',
                    'smallInfo' => 'Unlock the beauty of classical piano from world-class touring pianist Victoria Theodore in this beginner focused course.',
                    'info' => 'As a performer, Victoria Theodore has spent a lot of time in the spotlight. She’s shared the big stage with musical icons like Beyoncé, Stevie Wonder, Prince, Sting, B.B. King, Tony Bennett, and more.<br><br>But her success on the piano all started with her classical roots, studying from teachers linked to famous composer Claude Debussy. She has multiple degrees in classical piano and it has translated into some serious success over her career.<br><br>Victoria’s experience and incredible talent will be your go-to resource to make your time on the piano a success.',
                    'modal' => 'theodore',
                    'prev' => 'witt2',
                    'next' => false,
                    'trending' => true,
                    'trailer' => true
                    ],

                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/lisa-witt.jpg',
                    'subtitle' => 'Guidance, Practice,<br> & Inspiration',
                    'modal' => 'witt',
                    'date' => ' ',
                    'prev' => false,
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/lisa-witt.jpg',
                    'name' => 'LISA<br> WITT',
                    'info' => 'Lisa Witt is a well known face in the piano community, reaching millions of people around the world through her online lessons. 20 years of teaching experience, training through the Royal Conservatory of Music, and embracing all styles of playing has equipped her to teach you just about anything you’d ever want to learn on the piano. Lisa’s contagious enthusiasm will have you excited every time you sit down to play and will make learning the piano a super fun and engaging experience.',
                    'next' => 'castro',
                    'bigTile' => true,
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/kevin-castro.jpg',
                    'subtitle' => 'MUSICAL STYLES<br> & IMPROVISATION',
                    'modal' => 'castro',
                    'prev' => 'witt',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/kevin-castro.jpg',
                    'name' => 'Kevin<br> Castro',
                    'info' => 'Whether it’s playing stadium shows around the world in front of tens of thousands of people, or watching the sense of pride and accomplishment from a beginner student’s very first lesson, for Kevin Castro -- it’s all about the music.<br><br>Kevin is a graduate of the prestigious MacEwan University with a degree in Jazz and Contemporary Popular Music, and is the Musical Director and touring pianist for JUNO-winning Canadian pop star, JESSIA.<br><br>As your instructor at Pianote, Kevin is able to break down seemingly complex and intimidating musical concepts into understandable and approachable skills that you can not only learn, but start applying in your own playing.',
                    'next' => 'falk',
                    ],
                    [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/cassi-falk.jpg',
                    'subtitle' => 'Technique &<br> Foundations',
                    'modal' => 'falk',
                    'prev' => 'castro',
                    'modalImage' => 'https://pianote.s3.amazonaws.com/sales/2022/coaches/cassi-falk.jpg',
                    'name' => 'Cassi<br> Falk',
                    'info' => 'Meet your technique teacher, Cassi Falk! As an Elementary and Intermediate Specialist through the Royal Conservatory, Cassi has 15 years of teaching experience under her belt. She’ll be your go-to source for building up your foundational skills on the piano, with live sessions every Tuesday to improve your technique!',
                    'next' => false,
                    ],
                ]
            @endphp
            {{--<div class="slick-2 mx-auto mb-12 mt-7 md:my-10 max-w-md md:max-w-3xl lg:max-w-full">--}}
                {{--@foreach($coaches as $coach)--}}
                    {{--@if(!empty($coach['trending']))--}}
                        {{--<div class="px-1 md:px-2 slick-slide">--}}
                            {{--<div class="mx-auto" style="max-width:215px">--}}
                                {{--<div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">--}}
                                    {{--<div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">--}}
                                        {{--<div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
                                            {{--<div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}"></div>--}}
                                            {{--<div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">--}}
                                                {{--<h2 class="font-bebas text-3xl mb-0.5" style="line-height:0.85em">{!! $coach['name']  !!}</h2>--}}
                                                {{--<p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $coach['subtitle'] !!}</p>--}}
                                            {{--</div>--}}
                                            {{--<p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $coach['date'] !!}</p>--}}
                                            {{--<div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 30%, #010510);"></div>--}}
                                        {{--</div>--}}
                                        {{--<div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
                                            {{--<div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">--}}
                                                {{--<p class="text-coaches uppercase leading-tight mx-auto mb-1">{!! $coach['subtitle'] !!}</p>--}}
                                                {{--<p class="leading-normal mx-auto text-sm">{!! $coach['smallInfo'] !!}</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--</div>--}}


            @php
                $altSlider = [
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/power_of_chords_card.jpg',
                        'name' => 'The Power<br> of Chords',
                        'smallInfo' => 'Unlock the power of chords with this deep dive into chording from Lisa Witt. Sound better and play songs faster in just 9 lessons.',
                    ],
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/how_to_practice_chords_card.jpg',
                        'name' => 'How to<br> Practice Chords',
                        'smallInfo' => 'Master your chords and chord inversions with this guided practice lesson from Lisa.',
                    ],
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/piano_routine_to_start_your_day_card.jpg',
                        'name' => 'Piano Routine<br> to Start Your Day',
                        'smallInfo' => 'The perfect routine for your morning practice that you can keep coming back to.',
                    ],
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/practice_hacks_for_busy_people_card.jpg',
                        'name' => 'Practice Hacks<br> for Busy People',
                        'smallInfo' => 'Too busy to practice? Here are some quick tips to help you manage a busy life and practice schedule.',
                    ],
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/technique_tuesday_card.jpg',
                        'name' => 'Technique <br>Tuesday Live Q&A',
                        'smallInfo' => 'Join Cassi Falk every Tuesday as she breaks down techniques and exercises to maximize your practice and improve your playing.',
                    ],
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/10_minute_practice_card.jpg',
                        'name' => 'The 10 Minute<br> Practice',
                        'smallInfo' => 'You’ll be surprised at what you can accomplish in a short amount of time. Take 10 minutes and turn it into a super-effective practice session.',
                    ],
                    [
                        'image' => 'https://pianote.s3.amazonaws.com/sales/promos/piano-month/expanding_your_musical_style_card.jpg',
                        'name' => 'Expanding Your<br> Musical Style <br> with Sangah Noona',
                        'smallInfo' => 'In this course, Sangah uses Beethoven’s Für Elise to demonstrate 6 essential styles of music.',
                    ],
                ]
            @endphp
            <div class="slick-2 mx-auto mb-12 mt-7 md:mt-10 md:mb-0 max-w-md md:max-w-3xl lg:max-w-full h-64 sm:h-80">
                @foreach($altSlider as $altSlide)
                    <div class="px-1 md:px-2 slick-slide">
                        <div class="mx-auto" style="max-width:215px">
                            <div class="flip-div inline-block relative w-full group" style="perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $altSlide['image'] }}"></div>
                                        <div class="absolute uppercase w-full bottom-3 lg:bottom-4 z-10 text-shadow-4">
                                            <h2 class="font-bebas text-3xl {{--mb-0.5--}}" style="line-height:0.85em">{!! $altSlide['name']  !!}</h2>
{{--                                            <p class="text-coaches uppercase leading-tight mx-auto text-sm">{!! $altSlide['subtitle'] !!}</p>--}}
                                        </div>
                                        @if(!empty($altSlide['date']))
                                            <p class="leading-none font-bebas text-black bg-coaches rounded-md pt-1 px-2 absolute top-2 left-2">{!! $altSlide['date'] !!}</p>
                                        @endif
                                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 66%, #010510);"></div>
                                    </div>
                                    <div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-5" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            {{--<p class="text-coaches uppercase leading-tight mx-auto mb-1">{!!  str_replace('<br>', ' ', $altSlide['subtitle'])  !!}</p>--}}
                                            <p class="leading-normal mx-auto text-sm">{!! $altSlide['smallInfo'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a
                @hasSection('start-button')
                    href="@yield('start-button')" class="join smaller blue md:mt-6 mb-2 md:w-1/3"
                @else
                    href="#customize-anchor" class="join smaller blue anchor-slide md:mt-6 mb-2 md:w-1/3"
                @endif
            >
                @if(!empty($trialVersion) && $trialVersion)
                    Start your free trial
                @else
                    Get Started
                @endif
            </a>
            <p class="text-light-navy text-sm"><em>It takes less than a minute to sign up.</em></p>
        </div>
    </section>
    <section class="py-10 md:py-16 lg:py-20 px-3 lg:px-6 text-white text-center" style="background:linear-gradient(to bottom, #f61b31, #670811);">
        <div class="container mx-auto max-w-6xl">
            <h2 class="leading-tight max-w-3xl"><em>“... a new approach to<br class="inline md:hidden"> traditional lessons”</em></h2>
            <h6 class="mt-5 mb-10 md:mb-20"><em>- Keyboard Kraze</em></h6>
            <div class="mx-auto w-full opacity-50">
                <p class="text-sm mb-3"><em>As seen in:</em></p>
                <img class="h-4 md:h-5 mb-2 md:mb-0 mx-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/brand-logos-04.svg" alt="brand-logos-4">
                <img class="h-4 md:h-5 mb-2 md:mb-0 mx-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/brand-logos-01.svg" alt="brand-logos-1">
                <img class="h-4 md:h-5 mb-2 md:mb-0 mx-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/brand-logos-02.svg" alt="brand-logos-2">
                <img class="h-4 md:h-5 mb-2 md:mb-0 mx-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/brand-logos-03.svg" alt="brand-logos-3">
                <img class="h-4 md:h-5 mb-2 md:mb-0 mx-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_150,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/brand-logos-05.svg" alt="brand-logos-5">
            </div>
        </div>
    </section>

    <div id="method" class="anchor"></div>
    <section class="content-section text-center px-2 lg:px-4" style="padding-bottom: 0; background:radial-gradient(#1c2434, #020610 80%);">
        <div class="container mx-auto clearfix max-w-6xl">
            <div class="flex flex-wrap items-end">
                <div class="w-1/2">
                    <i class="text-xl md:text-2xl lg:text-3xl fal fa-piano text-pianote"></i><br>
                    <img class="h-6 md:h-7 lg:h-9 mt-3 imgfilter-method lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">
                </div>
                <div class="w-1/2">
                    <p class="tracking-widest text-sm">* NEW *</p>
                    <img class="h-12 md:h-14 lg:h-20 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/august/classical-method-logo.png" alt="march-logo">
                </div>
            </div>

                    <h3 class="leading-tight mt-4 md:mt-8" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Step-by-Step Lessons To<br class="inline md:hidden"> Develop Your Core Skills</strong></h3>
                    <h6 class="leading-normal text-shadow-4 text-light-navy mt-2 md:mt-3 mb-6 md:mb-8">Perfectly organized lessons for <br class="inline sm:hidden">Classical and Modern piano styles.</h6>

                    <div class="flex flex-wrap">
                        <div class="method-levels w-full sm:w-1/2 sm:px-1">
                            @php
                                $levels = [
                                    [
                                    "navyBorder" => true,
                                    "level" => "1",
                                    "title" => "Getting Started On The Piano",
                                    "description" => 'Welcome to the piano. This level will get you acquainted with this beautiful instrument, and teach you the fundamental skills to be successful on the keys, no matter what style you want to play.<br><br>You’ll learn how to set up your practice space, identify the notes on the keyboard and start practicing your first scale.<br><br>But it won’t just be exercises. You’ll learn your first real song.',
                                    "meta" => "16 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "2",
                                    "title" => "Keyboard Confidence & Control",
                                    "description" => 'Scales can get real boring, real fast. In Level 2, you’ll learn how to make scale practice musical so you not only develop greater control and confidence at the keyboard, you also have a ton of fun (and sound great).<br><br>Feeling comfortable and confident at the keyboard will make you want to keep coming back for more, which is the key to seeing results. This level will teach you good practice habits that will be instrumental in your long-term success.',
                                    "meta" => "12 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "3",
                                    "title" => "The Key To Beautiful Music",
                                    "description" => 'Chords make songs. It’s as simple as that. In Level 3 you’ll dive deeper into the concepts of piano chords and you’ll learn how to play them better, faster, and more smoothly.<br><br>This is also the level where you’ll work on your chord inversions, which are the key to changing chords beautifully and with ease.<br><br>You’ll also learn some “fancy” chords that are simple to play, but sound amazing and give you incredible improvisational options.',
                                    "meta" => "15 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "4",
                                    "title" => "Playing Chords Like A Pro",
                                    "description" => 'Level 3 was all about learning what chords were. Now you’ll learn how to play them like a pro. That means learning the different types of chords and how to play chords in different key signatures.<br><br>It will be a challenge, but you’ll know it’s worth it when you’re playing a beautiful Adele ballad and learning how to add special riffs and fills to “sparkle” up your playing.<br><br>Your ear training will also take a big step forward in this level, as you’ll start to learn the skills to figure out what key signature a song is in, and how to identify the order of a chord progression.',
                                    "meta" => "15 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "5",
                                    "title" => "How To Read (And Write) Music",
                                    "description" => "Welcome to the wonderful world of reading notation! And the best news is that it’s NOT as hard as you might think.<br><br>In this level, you will learn how to identify and play notes in the treble clef, bass clef, and grand staff. Everything you've learned so far about chords, intervals and hand coordination will help you to have success at reading music.<br><br>And you’ll also WRITE your own music. You do have the skills. This level will show you how.",
                                    "meta" => "16 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "6",
                                    "title" => "Developing Your Musicality",
                                    "description" => 'Take your playing from good to great as you learn how to develop your musicality in Level 6. The sustain pedal, phrasing, dynamics and control will all help you to be the best and most impactful piano player you can be.<br><br>These more intricate skills are what separate the piano players who sound “okay” from the ones who demand attention every time they sit at the keyboard. You’ll learn how to really express emotion through the keys.<br><br>Not only will you take your technique and sight reading further in this level, you will also learn how to play from a lead sheet which will open up a whole new world of songs for you!',
                                    "meta" => "19 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "7",
                                    "title" => "Common Piano Player Problems",
                                    "description" => 'This level is all about solving common piano player problems and answering piano questions like "How many key signatures are there?" and "How do I develop better independence between my hands?".<br><br>Expect to emerge from this level with a clear understanding of how to develop your hand independence, keyboard confidence, practice your technique in creative and exciting ways and improvise in a variety of styles AND the ability to play in every single key signature!',
                                    "meta" => "20 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "8",
                                    "title" => "Exploring Musical Styles",
                                    "description" => 'One of the best things about the piano is that you can play pretty much ANY musical style with it.<br><br>Classical, Blues, Jazz, Rock, Pop, the list goes on. In Level 8 you’ll learn some of the most popular and fun styles.<br><br>You’ll learn some beautiful classical music pieces from different eras, before studying the blues and finally moving on to jazz.<br><br>Who knows, you might even discover a new style of music that you had no idea you loved!',
                                    "meta" => "30 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "9",
                                    "title" => "Composition And Songwriting",
                                    "description" => 'Anybody can write a song. Even you! Level 9 will break down the basics of song structure and composition, so you can see how possible it is to create your own music.<br><br>You don’t have to be Hans Zimmer to create a masterpiece. You’ll learn how different musical styles have their own structures and rules that frame the music. And using those rules, you’ll be able to compose something of your own.<br><br>You’ll also learn how to listen to music with a “new” ear, hearing things you might never have noticed before.',
                                    "meta" => "15 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "10",
                                    "title" => "Go Anywhere On The Piano",
                                    "description" => 'The final level of the Pianote Method. But music doesn’t have an end point. In this level, you’ll learn how to turn everything you’ve studied up until now into a lifelong pursuit of learning, discovery, and enjoyment.<br><br>Everything from how to structure and create your own practice routines, to how to play in a band with other musicians and even get professional gigs.<br><br>Wherever you want to go with the piano, this level will show you how to create your own journey. But of course, as a Pianote member, you’ll always have access to our professional guidance and help.',
                                    "meta" => "18 Lessons"
                                    ]
                                ]
                            @endphp
                            @foreach($levels as $level)
                                <div class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none @if(!empty($level['defaultOpen'])) active @endif
                                @if(!empty($level['navyBorder'])) border-navy-600 @endif">
                                    <div class="bg-pianote py-5 px-2 sm:px-3 ">
                                        <h5 class="leading-tight whitespace-nowrap inline-flex items-center">
                                            <span class="text-xs hidden md:inline mr-1"> LEVEL</span>
                                            <strong>{{ $level['level'] }}</strong>
                                        </h5>
                                    </div>
                                    <div class="py-5 px-3 md:px-4 text-left flex-grow">
                                        <div class="flex items-center text-left flex-col sm:flex-row relative">
                                            <h5 class="leading-tight flex-grow w-full sm:w-auto"><strong>{!! $level['title'] !!}</strong></h5>
                                        </div>
                                        @if(!empty($level['description']))
                                            <p class="description leading-normal transition-all duration-300 overflow-hidden opacity-0 h-0 max-h-0 invisible text-light-navy">
                                                <br>
                                                <em><strong> {!!  $level['meta'] !!} </strong></em>
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

                            <div class="join smaller outline light-navy levels-show-all mx-auto cursor-pointer">Show More</div>
                        </div>
                        <div class="w-full sm:w-1/2 sm:px-1">
                            @php
                                $classicalLevels = [
                                    [
                                    "navyBorder" => true,
                                    "level" => "1",
                                    "title" => "Beginning Your Classical Journey",
                                    "description" => 'Welcome to the world of Classical Piano! We’ll start with the basics you’ll need to play this beautiful genre, and introduce you to the main eras of classical music.',
                                    "meta" => "15 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "2",
                                    "title" => "Beyond The Basics",
                                    "description" => 'In Level 2, you’ll push the difficulty level a little bit and dive deeper in the Baroque, Classical, Romantic, and Contemporary eras.',
                                    "meta" => "15 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "3",
                                    "title" => "Expanding What You Know",
                                    "description" => 'New key signatures, longer pieces, more technical demands. Welcome to Level 3. Yes the pieces might be a little harder, but with complexity comes beauty. You’ve got this.',
                                    "meta" => "16 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "4",
                                    "title" => "More Complexity, More Beauty",
                                    "description" => 'We’re now beyond the basics and ready to dive deeper into polyphony and introduce even more key signatures, time signatures, and tempos!',
                                    "meta" => "16 Lessons"
                                    ],
                                    [
                                    "navyBorder" => true,
                                    "level" => "5",
                                    "title" => "Making A Masterpiece",
                                    "description" => 'You’ve made it to Level 5 - congratulations!! In this final level you’ll master the kind of nuance and precision that professional concert pianists use.',
                                    "meta" => "17 Lessons"
                                    ],
                                ]
                            @endphp
                            @foreach($classicalLevels as $level)
                                <div class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none @if(!empty($level['defaultOpen'])) active @endif
                                @if(!empty($level['navyBorder'])) border-navy-600 @endif">
                                    <div class="py-5 px-2 sm:px-3 " style="background-color:#ce9432;">
                                        <h5 class="leading-tight whitespace-nowrap inline-flex items-center">
                                            <span class="text-xs hidden md:inline mr-1"> LEVEL</span>
                                            <strong>{{ $level['level'] }}</strong>
                                        </h5>
                                    </div>
                                    <div class="py-5 px-3 md:px-4 text-left flex-grow">
                                        <div class="flex items-center text-left flex-col sm:flex-row relative">
                                            <h5 class="leading-tight flex-grow w-full sm:w-auto"><strong>{!! $level['title'] !!}</strong></h5>
                                        </div>
                                        @if(!empty($level['description']))
                                            <p class="description leading-normal transition-all duration-300 overflow-hidden opacity-0 h-0 max-h-0 invisible text-light-navy">
                                                <br>
                                                <em><strong> {!!  $level['meta'] !!} </strong></em>
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
                    </div>
                </div>
            </section>
            <section class="content-section text-center px-4 lg:px-5" style="padding-top: 0;background:linear-gradient(to bottom, #01050f 60%, #021225);">
                <div class="container mx-auto clearfix max-w-6xl">

                    <h4 class="mb-6 md:mb-7 lg:mb-10 mt-8 md:mt-10 lg:mt-14 leading-normal">
                        <strong class="inline-block mr-1 bg-pianote px-1 md:px-3 md:py-1 rounded-md md:rounded-lg leading-none" style="color: #000a1e;">PLUS</strong>
                        <em>

                            On-demand access to <strong class="text-pianote">{{ Prices::$pianoteCourses }}+<br class="inline md:hidden"> comprehensive piano courses</strong> <br>
                            and <strong class="text-pianote">{{ Prices::$pianoteLessons }}+ lessons</strong> to focus on <br class="inline md:hidden">specific skills, styles, and techniques.</em></h4>

                    <div class="course-tiles w-full flex flex-wrap justify-center md:mb-2 mx-auto max-w-xs md:max-w-full">
                        @php
                            $topics = [
                                [
                                'logo' => 'https://pianote.s3.amazonaws.com/sales/2022/course-logo-classical.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/classical-piano-card2.jpg',
                                'title' => 'Classical Piano',
                                'description' => 'Unlock the beauty of classical music with this course from world-class touring pianist, Victoria Theodore.',
                                'artist' => 'Victoria  <strong>Theodore</strong>',
                                ],
                                [
                                'logo' => 'https://pianote.s3.amazonaws.com/sales/2022/course-logo-cocktail.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/cocktail-piano-card2.jpg',
                                'title' => 'Cocktail Piano For Beginners',
                                'description' => 'Learn the chord progressions, songs, and improvisation techniques to start playing cocktail piano.',
                                'artist' => 'Brett <strong>Ziegler</strong>',
                                ],
                                [
                                'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/500-songs-card2.jpg',
                                'title' => '500 Songs in 5 Days',
                                'description' => 'Play the songs you love in this 5-day bootcamp that teaches you how to play almost any song.',
                                'artist' => 'Lisa <strong>Witt</strong>',
                                ],
                                [
                                'logo' => 'https://pianote.s3.amazonaws.com/products/play-beautiful-piano/logo-minimal.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/playing-beautiful-card2.jpg',
                                'title' => 'The Beginners Guide To Playing Beautiful Piano',
                                'description' => 'Start playing beautiful piano music from your very first lesson.',
                                'artist' => 'Lisa <strong>Witt</strong>',
                                ],
                                [
                                'logo' => 'https://pianote.s3.amazonaws.com/sales/2022/course-logo-latin.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/latin-piano-card2.jpg',
                                'title' => 'Latin Piano Essentials',
                                'description' => 'Spice up your playing and learn five of the most influential Latin genres on the piano.',
                                'artist' => 'Kevin <strong>Castro</strong>',
                                ],
                                [
                                'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/logo-text-white.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/worship-card2.jpg',
                                'title' => 'Worship Piano',
                                'description' => 'Start playing piano or keyboard in your church.',
                                'artist' => 'Amberly <strong>Martz</strong>',
                                ],
                                [
                                'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/riffs-fills-card2.jpg',
                                'title' => 'Piano Riffs & Fills',
                                'description' => 'Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect.',
                                'artist' => 'Lisa <strong>Witt</strong>',
                                ],
                                [
                                'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/logo.png',
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/faster-card2.jpg',
                                'title' => 'Faster Fingers',
                                'description' => 'Your roadmap to success for increasing your speed on the keys so you can learn songs quicker and play them better.',
                                'artist' => 'Lisa <strong>Witt</strong>',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/beginners-card2.jpg',
                                'title' => 'Songs For<br> Beginners',
                                'description' => 'Learn your first songs on the piano – perfect for complete beginners.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/daily-practice-card2.jpg',
                                'title' => 'Daily Practice<br> Routines',
                                'description' => 'Practice tips and routines to make sure you’re progressing on the piano.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/easy-classical-card2.jpg',
                                'title' => 'Easy Classical<br> Pieces',
                                'description' => 'Sound like a pro and learn some easy, amazing sounding classical pieces.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/hand-independece-card2.jpg',
                                'title' => 'Hand <br>Independence',
                                'description' => 'Master one of the hardest parts of playing piano – using both hands.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/chord-mastery-card2.jpg',
                                'title' => 'Chord<br> Mastery',
                                'description' => 'The perfect practice routine to master all your chords.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/play-in-any-key-card2.jpg',
                                'title' => 'Play In<br> Any Key',
                                'description' => 'Learn all your chords and scales for every single key signature.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/beautiful-melodies-card2.jpg',
                                'title' => 'Beautiful<br> Melodies',
                                'description' => 'Discover the secrets to playing beautiful melodies on the piano.',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/arpeggios-card2.jpg',
                                'title' => 'Amazing<br> Arpeggios',
                                'description' => 'Your fingers will flow across the piano when you learn how to play these amazing arpeggios.',
                                ],
                            ]
                        @endphp
                        @foreach($topics as $topic)
                            <div class="course relative md:px-2 lg:px-1 w-full md:w-1/3 lg:w-1/4 mx-auto mb-3 md:mb-5 lg:mb-1.5">
                                <div class="flip-div inline-block relative md:w-full group" style="perspective: 1000px;" data-aos-once="true" data-aos="fade-down" data-aos-offset="200" data-aos-duration="250" data-aos-delay="200">
                                    <div class="text-center relative md:w-full md:h-full md:absolute cursor-pointer" style="transform-style: preserve-3d;">
                                        <div class="front relative z-20 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">
                                            <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 hidden md:visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                                <i class="fas fa-arrow-right text-4xl"></i><br>
                                                <p class="text-sm"><strong>DETAILS</strong></p>
                                            </div>
                                            <div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $topic['image'] }}"></div>
                                            <div class="absolute uppercase w-full bottom-3 md:bottom-5 z-10 text-shadow-4">
                                                @if(!empty($topic['logo']))
                                                    <div class="px-6">
                                                        <img class="w-full h-12 md:h-16 object-contain lazyload" data-src="{{ $topic['logo'] }}" alt="{!! $topic['title'] !!}">
                                                    </div>
                                                @else
                                                    <h3><strong> {!! $topic['title']  !!} </strong></h3>
                                                @endif
                                            </div>
                                            @if(!empty($topic['logo']))
                                                <div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 40%, #29050f 100%);"></div>
                                            @else
                                                <div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 40%, #000 100%);"></div>
                                            @endif
                                        </div>
                                        <div class="back relative z-40 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">
                                            <div class="w-full h-full mx-auto text-center md:text-black md:bg-white flex flex-wrap justify-center items-center content-center pt-3 md:p-3">
                                                <h5 class="leading-none uppercase mx-auto mb-2 md:mb-3 hidden sm:inline-block"><strong>{!! $topic['title']  !!}</strong></h5>
                                                <p class="leading-normal mx-auto">{{ $topic['description'] }}</p>
                                                @if(!empty($topic['artist']))
                                                    <h6 class="w-full leading-normal uppercase mt-2 md:mt-3 mx-auto text-pianote hidden md:inline-block">{!! $topic['artist'] !!}</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="join smaller outline light-navy courses-show-all mx-auto cursor-pointer mt-5">Show More</div>
                    </div>
                    {{--<br>--}}
                    {{--<a--}}
                        {{--@hasSection('start-button')--}}
                            {{--href="@yield('start-button')" class="join blue smaller"--}}
                        {{--@else--}}
                            {{--href="#customize-anchor" class="join blue smaller anchor-slide"--}}
                        {{--@endif--}}
                    {{-->--}}
                        {{--@if(!empty($trialVersion) && $trialVersion)--}}
                            {{--Start your free trial--}}
                        {{--@else--}}
                            {{--Get Started--}}
                        {{--@endif--}}
                    {{--</a>--}}
                </div>
            </section>

            <div id="songs" class="anchor"></div>
            <section class="content-section text-center relative" style="background:linear-gradient(to bottom, #01050f 80%, #021225);">
                <div class="song-wrap relative z-0 overflow-hidden">
                    <div class="song-row absolute z-0 whitespace-nowrap">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/222782-card-thumbnail-maxres-1554464501.jpg" alt="thumbnail1">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/283673-card-thumbnail-maxres-1610378738.png" alt="thumbnail2">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/279826-card-thumbnail-maxres-1609786632.png" alt="thumbnail3">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/275879-card-thumbnail-maxres-1606131995.png" alt="thumbnail4">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264119-card-thumbnail-maxres-1603893657.png" alt="thumbnail5">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264113-card-thumbnail-maxres-1597397472.jpg" alt="thumbnail6">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264109-card-thumbnail-maxres-1596814472.jpg" alt="thumbnail7">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264202-card-thumbnail-maxres-1596188071.jpg" alt="thumbnail8">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/226212-card-thumbnail-maxres-1560343481.jpg" alt="thumbnail9">

                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/222782-card-thumbnail-maxres-1554464501.jpg" alt="thumbnail10">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/283673-card-thumbnail-maxres-1610378738.png" alt="thumbnail11">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/279826-card-thumbnail-maxres-1609786632.png" alt="thumbnail12">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/275879-card-thumbnail-maxres-1606131995.png" alt="thumbnail13">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264119-card-thumbnail-maxres-1603893657.png" alt="thumbnail14">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264113-card-thumbnail-maxres-1597397472.jpg" alt="thumbnail15">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264109-card-thumbnail-maxres-1596814472.jpg" alt="thumbnail16">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264202-card-thumbnail-maxres-1596188071.jpg" alt="thumbnail17">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/226212-card-thumbnail-maxres-1560343481.jpg" alt="thumbnail18">
                    </div>
                    <div class="song-row absolute z-0 whitespace-nowrap">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/257690-card-thumbnail-maxres-1592474987.jpg" alt="thumbnail19">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/262339-card-thumbnail-maxres-1595588683.jpg" alt="thumbnail20">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/243077-card-thumbnail-maxres-1580219802.jpg" alt="thumbnail21">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/246094-card-thumbnail-maxres-1582901931.jpg" alt="thumbnail22">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/233584-card-thumbnail-maxres-1570095696.jpg" alt="thumbnail23">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/223640-card-thumbnail-maxres-1555602049.jpg" alt="thumbnail24">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/227485-card-thumbnail-maxres-1563358088.jpg" alt="thumbnail25">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/242634-card-thumbnail-maxres-1579174888.jpg" alt="thumbnail26">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/235815-card-thumbnail-maxres-1572535303.jpg" alt="thumbnail27">

                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/257690-card-thumbnail-maxres-1592474987.jpg" alt="thumbnail28">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/262339-card-thumbnail-maxres-1595588683.jpg" alt="thumbnail29">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/243077-card-thumbnail-maxres-1580219802.jpg" alt="thumbnail30">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/246094-card-thumbnail-maxres-1582901931.jpg" alt="thumbnail31">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/233584-card-thumbnail-maxres-1570095696.jpg" alt="thumbnail32">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/223640-card-thumbnail-maxres-1555602049.jpg" alt="thumbnail33">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/227485-card-thumbnail-maxres-1563358088.jpg" alt="thumbnail34">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/242634-card-thumbnail-maxres-1579174888.jpg" alt="thumbnail35">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/235815-card-thumbnail-maxres-1572535303.jpg" alt="thumbnail36">
                    </div>
                    <div class="song-row absolute z-0 whitespace-nowrap">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/292406-card-thumbnail-maxres-1615228204.png" alt="thumbnail37">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/246181-card-thumbnail-maxres-1583836517.jpg" alt="thumbnail38">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/223643-card-thumbnail-maxres-1556202457.jpg" alt="thumbnail39">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/225983-card-thumbnail-maxres-1559663715.jpg" alt="thumbnail40">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/226818-card-thumbnail-maxres-1561462268.jpg" alt="thumbnail41">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/250094-card-thumbnail-maxres-1586176244.jpg" alt="thumbnail42">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/236823-card-thumbnail-maxres-1573820297.jpg" alt="thumbnail43">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/250096-card-thumbnail-maxres-1586873271.jpg" alt="thumbnail44">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/240149-card-thumbnail-maxres-1576867933.jpg" alt="thumbnail45">

                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/292406-card-thumbnail-maxres-1615228204.png" alt="thumbnail46">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/246181-card-thumbnail-maxres-1583836517.jpg" alt="thumbnail47">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/223643-card-thumbnail-maxres-1556202457.jpg" alt="thumbnail48">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/225983-card-thumbnail-maxres-1559663715.jpg" alt="thumbnail49">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/226818-card-thumbnail-maxres-1561462268.jpg" alt="thumbnail50">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/250094-card-thumbnail-maxres-1586176244.jpg" alt="thumbnail51">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/236823-card-thumbnail-maxres-1573820297.jpg" alt="thumbnail52">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/250096-card-thumbnail-maxres-1586873271.jpg" alt="thumbnail53">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/240149-card-thumbnail-maxres-1576867933.jpg" alt="thumbnail54">
                    </div>
                    <div class="song-row absolute z-0 whitespace-nowrap">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/255531-card-thumbnail-maxres-1590756807.jpg" alt="thumbnail55">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/222918-card-thumbnail-maxres-1554896817.jpg" alt="thumbnail56">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/241186-card-thumbnail-maxres-1578478732.jpg" alt="thumbnail57">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/257684-card-thumbnail-maxres-1591119455.jpg" alt="thumbnail58">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/250098-card-thumbnail-maxres-1587634754.jpg" alt="thumbnail59">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/255528-card-thumbnail-maxres-1590171418.jpg" alt="thumbnail60">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/231578-card-thumbnail-maxres-1566472504.jpg" alt="thumbnail61">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/257689-card-thumbnail-maxres-1591889440.png" alt="thumbnail62">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/232251-card-thumbnail-maxres-1567590538.jpg" alt="thumbnail63">

                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/255531-card-thumbnail-maxres-1590756807.jpg" alt="thumbnail64">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/222918-card-thumbnail-maxres-1554896817.jpg" alt="thumbnail65">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/241186-card-thumbnail-maxres-1578478732.jpg" alt="thumbnail66">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/257684-card-thumbnail-maxres-1591119455.jpg" alt="thumbnail67">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/250098-card-thumbnail-maxres-1587634754.jpg" alt="thumbnail68">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/255528-card-thumbnail-maxres-1590171418.jpg" alt="thumbnail69">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/231578-card-thumbnail-maxres-1566472504.jpg" alt="thumbnail70">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/257689-card-thumbnail-maxres-1591889440.png" alt="thumbnail71">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/232251-card-thumbnail-maxres-1567590538.jpg" alt="thumbnail72">
                    </div>
                    <div class="song-row absolute z-0 whitespace-nowrap">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/234327-card-thumbnail-maxres-1570793466.jpg" alt="thumbnail73">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/233519-card-thumbnail-maxres-1569406563.jpg" alt="thumbnail74">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/241180-card-thumbnail-maxres-1576843045.jpg" alt="thumbnail75">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/224471-card-thumbnail-maxres-1557395531.jpg" alt="thumbnail76">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/244282-card-thumbnail-maxres-1580985656.jpg" alt="thumbnail77">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/243076-card-thumbnail-maxres-1579798565.jpg" alt="thumbnail78">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/244280-card-thumbnail-maxres-1582194229.jpg" alt="thumbnail79">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264116-card-thumbnail-maxres-1605532058.png" alt="thumbnail80">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/262342-card-thumbnail-maxres-1596013952.png" alt="thumbnail81">

                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/234327-card-thumbnail-maxres-1570793466.jpg" alt="thumbnail82">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/233519-card-thumbnail-maxres-1569406563.jpg" alt="thumbnail83">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/241180-card-thumbnail-maxres-1576843045.jpg" alt="thumbnail84">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/224471-card-thumbnail-maxres-1557395531.jpg" alt="thumbnail85">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/244282-card-thumbnail-maxres-1580985656.jpg" alt="thumbnail86">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/243076-card-thumbnail-maxres-1579798565.jpg" alt="thumbnail87">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/244280-card-thumbnail-maxres-1582194229.jpg" alt="thumbnail88">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/264116-card-thumbnail-maxres-1605532058.png" alt="thumbnail89">
                        <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://d1923uyy6spedc.cloudfront.net/262342-card-thumbnail-maxres-1596013952.png" alt="thumbnail90">
                    </div>
                    <div class="absolute z-10 inset-0" style="background: linear-gradient(to bottom, #01050f, rgba(41,47,61,0.7), #01050f);"></div>
                </div>
                <div class="px-4 lg:px-6">
                    <div class="container mx-auto relative z-10 max-w-6xl">
                        <i class="text-3xl md:text-5xl lg:text-6xl icon-songs text-songs"></i><br>
                        <img class="h-7 md:h-10 lg:h-11 mt-1 mb-4 md:mb-8 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">
                        <h3 class="" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Everybody has songs. We actually<br class="hidden sm:inline"> teach you how to play them.</strong></h3>
                        <h6 class="leading-normal max-w-2xl lg:max-w-3xl text-light-navy mt-3 md:mt-5 mb-64 md:mb-96 md:pb-20 text-shadow-4">It’s the Pianote difference. Every song comes with a detailed video tutorial breaking it down into simple parts. You can play along to the backing tracks, adjust the tempo, create practice loops, and more! And if you get stuck, there are real teachers to ask for help. </h6>
                        <h4 class="mb-6 md:mb-7 lg:mb-10 leading-normal"><strong class="inline-block mr-1 bg-songs px-3 py-1 rounded-md md:rounded-lg leading-none" style="color: #000a1e;">LEARNING SONGS HAS<br class="inline sm:hidden"> NEVER BEEN EASIER</strong><br>
                            <em class="text-shadow-4">You’ll have <strong class="text-songs">all the tools you need</strong> to<br class="hidden md:inline"> make sure you never miss a note.</em></h4>

                        <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center mx-auto mt-4 md:mt-14 lg:mt-20 mb-8 md:mb-10 px-2">
                            <div class="pic-wrap md:order-1 mx-auto my-5 md:my-0 pl-0 md:pl-5 lg:pl-10 flex-shrink-0">
                                <video class="rounded-xl" src="https://pianote.s3.amazonaws.com/sales/2022/songs-side.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
                            </div>
                            <div class="text-left">
                                <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 text-icon-wrap songs active">
                                    <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-music"></i>
                                    <div class="pl-3">
                                        <h4 class="mx-auto mb-2 md:mb-3"><strong>Find the perfect tempo.</strong></h4>
                                        <p class="text-light-navy">Slow down any section of a song to make learning those tricky bars easier. Or, increase the tempo and get those fingers moving!</p>
                                    </div>
                                </div>
                                <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 text-icon-wrap songs active">
                                    <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-repeat"></i>
                                    <div class="pl-3">
                                        <h4 class="mx-auto mb-2 md:mb-3"><strong>Loop the hard parts.</strong></h4>
                                        <p class="text-light-navy">Make practicing difficult songs a piece of cake. Simply grab a section of the song and loop it over, and over, and over until you’ve got it down.</p>
                                    </div>
                                </div>
                                <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 text-icon-wrap songs active">
                                    <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs icon-metronome"></i>
                                    <div class="pl-3">
                                        <h4 class="mx-auto mb-2 md:mb-3"><strong>Improve your timing.</strong></h4>
                                        <p class="text-light-navy">Use the built-in metronome to stay in time. This will be your best friend when you tackle those odd time signatures and difficult rhythms!</p>
                                    </div>
                                </div>
                                <div class="flex mx-auto mb-9 md:mb-7 lg:mb-8 text-icon-wrap songs active">
                                    <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-arrow-to-bottom"></i>
                                    <div class="pl-3">
                                        <h4 class="mx-auto mb-2 md:mb-3"><strong>Take your songs anywhere.</strong></h4>
                                        <p class="text-light-navy">Downloadable sheet music means you can play your favorite songs wherever you go! As long as there's a piano, you’ll be able to play.</p>
                                    </div>
                                </div>
                                <div class="flex mx-auto text-icon-wrap songs active">
                                    <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-3xl text-songs fal fa-phone-laptop"></i>
                                    <div class="pl-3">
                                        <h4 class="mx-auto mb-2 md:mb-3"><strong>Available on all your devices.</strong></h4>
                                        <p class="text-light-navy">It doesn’t matter if you’re on your phone, tablet, or computer. You’ll be able to learn and play the songs you love whenever you want.</p>
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
                        >
                            @if(!empty($trialVersion) && $trialVersion)
                                Start your free trial
                            @else
                                Get Started &raquo;@endif
                        </a>
                    </div>
                </div>
            </section>

            <div id="coaches" class="anchor"></div>
            <section class="content-section text-center px-4 lg:px-6 lazyload" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/coaches-bg.jpg">
                <div class="container mx-auto max-w-6xl">
                    <img class="inline h-10 md:h-14 lg:h-16 icon imgfilter-coaches" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon"><br>
                    <img class="h-7 md:h-10 lg:h-11 mt-3 mb-4 md:mb-8 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">
                    <h3 class="leading-tight " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Stay motivated with <u>direct <br class="inline lg:hidden"> access</u> to real teachers.</strong></h3>
                    <h6 class="leading-normal max-w-2xl lg:max-w-4xl text-light-navy mt-3 md:mt-5 mb-8 md:mb-10 text-shadow-4">Get unlimited personal support from our in-house team of teachers through personal feedback, live lessons, and Q&A sessions PLUS get access to NEW guest coaches where you’ll connect with world-class pianists and gain their best insights.</h6>
                    <div class="relative z-10 mx-auto mb-8 md:mb-16 flex flex-wrap justify-center max-w-md md:max-w-full">
                        @foreach($coaches as $coach)
                            @if(empty($coach['trending']))
                                <div class="w-full @if(empty($coach['bigTile'])) md:w-1/2 @endif px-1 md:px-2">
                                    <div class="@if(empty($coach['bigTile'])) half-tile-bg @else big-tile-bg @endif overflow-hidden cursor-pointer relative mx-auto mb-3 rounded-3xl bg-left-top group lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $coach['image'] }}" data-open="{{ $coach['modal'] }}" style="background-color:#00141d;padding-bottom: 52.65%;">
                                        <i class="fas fa-expand absolute top-5 right-5 z-10 transition-opacity duration-300 text-xl md:text-2xl lg:opacity-50 group-hover:opacity-100"></i>
                                        <div class="absolute text-left uppercase select-none z-10 left-4 bottom-4 lg:bottom-auto transform lg:-translate-y-1/2 lg:top-1/2 text-shadow-1">
                                            <h2 class="text-3xl md:text-4xl lg:text-5xl mx-auto mb-1 md:mb-2 font-bebas" style="line-height:0.85em;">{!! $coach['name'] !!}</h2>
                                            <h6 class="leading-tight text-coaches">{!! $coach['subtitle'] !!}</h6>
                                        </div>
                                        <div class="z-0 absolute inset-0" style="background: linear-gradient(to right, #000a18, transparent 60%);"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <h4 class="mt-8 md:mt-12 mb-3 mb-6 md:mb-7 lg:mb-10 leading-normal"><strong class="inline-block mr-1 bg-coaches px-3 py-1 rounded md:rounded-lg leading-none" style="color: #000a1e;">PLUS GAIN ACCESS <br class="inline sm:hidden"> TO FEATURED COACHES</strong><br>
                        <em>Get tips & insights from some of the most accomplished pianists <br class="hidden md:inline"> through course releases, live events, and Q&A sessions.</em></h4>

                    <div id="thisMonth" class="anchor"></div>
                    @foreach($coaches as $coach)
                        @if(!empty($coach['bigTile']) && !empty($coach['trending']))
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
                                    <div class="px-1 md:px-2 w-1/2 md:w-1/3 lg:w-1/5 mb-1 md:mb-2">
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


                    <h3 class="leading-tight mt-8 md:mt-16" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Real Teachers,<br class="inline sm:hidden">  Real Results. </strong></h3>
                    <h6 class="leading-normal max-w-2xl lg:max-w-3xl text-light-navy mt-3 md:mt-5 mb-5 md:mb-20">Pianote Coaches gives you the chance to ask your biggest questions and get direct, personal feedback. You can choose the coaches who align with your goals on the piano… or choose them all!</h6>
                    <div class="feature-rotater w-full max-w-md md:max-w-full flex flex-wrap md:flex-nowrap items-center mx-auto mb-8 md:mb-10">
                        <div class="pic-wrap md:order-0 mx-auto my-5 md:my-0 pr-0 md:pr-5 lg:pr-10 flex-shrink-0">
                            <img class="lazyload side-pic coaches w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/coaches-pianote-ui01.png" alt="coaches-pianote-ui-1">
                            <img class="lazyload side-pic coaches w-full md:hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/coaches-pianote-ui02.png" alt="coaches-pianote-ui-2">
                            <img class="lazyload side-pic coaches w-full hidden" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/coaches-pianote-ui03.png" alt="coaches-pianote-ui-3">
                        </div>
                        <div class="text-left text-light-navy">
                            <div class="flex mx-auto mb-9 md:mb-7 lg:mb-10 md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90 active">
                                <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-lightbulb-on"></i>
                                <div class="pl-3">
                                    <h3 class="mx-auto mb-2 md:mb-3"><strong>Inspiration</strong></h3>
                                    <p>Share the piano bench with the best in the world and get inspired to play like never before. Open the door to new possibilities with organized piano courses, live streams, and Q&A sessions.</p>
                                </div>
                            </div>
                            <div class="flex mx-auto mb-9 md:mb-7 lg:mb-10 md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90">
                                <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-users"></i>
                                <div class="pl-3">
                                    <h3 class="mx-auto mb-2 md:mb-3"><strong>Connection</strong></h3>
                                    <p>Every coach is in your corner. You’ll have opportunities to get feedback on your playing, ask your biggest questions, and have ongoing support throughout your journey on the piano. </p>
                                </div>
                            </div>
                            <div class="flex mx-auto md:cursor-pointer text-icon-wrap coaches md:opacity-60 hover:opacity-90">
                                <i class="flex-shrink-0 w-8 md:w-10 lg:w-11 text-2xl md:text-4xl text-coaches fal fa-signal-alt"></i>
                                <div class="pl-3">
                                    <h3 class="mx-auto mb-2 md:mb-3"><strong>Results</strong></h3>
                                    <p>You’ll gain new skills and knowledge on the piano that you can start applying right away. Sit down at the piano with confidence knowing you’re getting advice from legendary piano players.</p>
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
                    >
                        @if(!empty($trialVersion) && $trialVersion)
                            Start your free trial
                        @else
                            Get Started &raquo;
                            @endif
                    </a>
                </div>
            </section>

            <section class="content-section text-center">
                <div class="gradient-bg absolute top-0 left-0 right-0 z-0" style="background: linear-gradient(to bottom, #01050f 60%, #021225);"></div>
                <div class="container mx-auto relative z-10">
                    <img class="h-32 md:h-48 lg:h-56 mb-14 lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/pianote-method-songs-coaches.png" alt="pianote-method-songs-coaches">
                    <h3 class="" data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Piano lessons at your fingertips.</strong></h3>
                    <h6 class="leading-tight text-light-navy mt-3 md:mt-5 mb-8 md:mb-12 ">Learn how to play the piano online. <br class="inline sm:hidden"> Wherever you go. Whatever you use.</h6>
                    <div class="device-spread relative w-full mx-auto mb-5 md:mb-0">
                        <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md desktop">
                            <em class="inline-block">Better<br> Practice<br> Tools</em><br class="hidden md:inline">
                            <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-right-red.png" alt="arrow-right">
                        </div>
                        <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md macbook">
                            <em class="inline-block">A<br> Supportive<br> Community</em><br class="hidden md:inline">
                            <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-right-alt-red.png" alt="arrow-right">
                        </div>
                        <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md ipad">
                            <em class="inline-block">Regular<br> Live<br> Lessons</em><br class="hidden md:inline">
                            <img class="hidden md:inline mt-1 h-7 lg:h-9 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-left-down-red.png" alt="arrow-left">
                        </div>
                        <div class="z-10 text-arrow w-1/4 md:w-auto transform md:-translate-x-1/2 -translate-y-1/2 absolute uppercase text-xs md:text-sm lg:text-md iphone">
                            <em class="inline-block">Most<br> Popular<br> Songs</em><br class="hidden md:inline">
                            <img class="hidden md:inline mt-1 w-7 lg:w-10 lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/sales/arrow-left-red.png" alt="arrow-left">
                        </div>
                        <img class="w-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/device-spread2.png" alt="device-spread-2">
                        <video class="absolute rounded-md" style="width: 43.1%;height: 54%;left: 6.5%;top: 39.1%;" src="https://pianote.s3.amazonaws.com/sales/2022/spread-vid.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
                    </div>
                </div>
            </section>

            <section class="content-section text-center comparison px-1 lg:px-3">
                <div class="container mx-auto max-w-6xl">
                    <h3 class="mb-8 md:mb-12 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Say hello to your unfair advantage.</strong></h3>
                    <table class="w-full mx-auto border-separate comparison">
                        <tbody>
                        <tr style="background-color:transparent!important;">
                            <td></td>
                            <td class="rounded-t-xl">
                                <img class="h-6 md:h-11 lazyload" data-src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-white.png" alt="pianote-logo">
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
                            <td>POPULAR SONG BREAKDOWNS</td>
                            <td><i class="fas fa-check-circle"></i></td>
                            <td><i class="fas fa-minus"></i></td>
                        </tr>
                        <tr>
                            <td>Downloadable Sheet Music</td>
                            <td><i class="fas fa-check-circle"></i></td>
                            <td><i class="fas fa-minus"></i></td>
                        </tr>
                        <tr>
                            <td>CONNECT WITH PIANO LEGENDS</td>
                            <td><i class="fas fa-check-circle"></i></td>
                            <td><i class="fas fa-minus"></i></td>
                        </tr>
                        <tr>
                            <td>LEARN FROM MULTIPLE TEACHERS</td>
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
                                        @if(number_format(Prices::$plusSubscriptionAnnual, 2) == intval(Prices::$plusSubscriptionAnnual))
                                            <strong>${{  round(Prices::$plusSubscriptionAnnual / 12, 2) }}</strong>/mo<br>
                                        @else
                                            <strong>${{  number_format(Prices::$plusSubscriptionAnnual / 12, 2)  }}</strong>/mo<br>
                                        @endif
                                        <em>Billed annually at ${{  Prices::$plusSubscriptionAnnual }}</em><br><br>
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
                    <h3 class="leading-tight mb-8 md:mb-11 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Trusted by piano<br class="inline-block sm:hidden"> students  everywhere</strong></h3>
                    <div class="flex flex-wrap items-start justify-center mx-auto">
                        <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                            <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#cd201f;background: #051124;">
                                <a href="https://www.youtube.com/pianolessonscom/" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-3xl md:text-4xl"></i>
                                </a>
                                <h2 class="hidden sm:block count font-black leading-none my-2 md:my-3 text-white" id="youtube-count" data-total-count="1230000">0</h2>
                                <h2 class="count block sm:hidden font-black leading-none my-2 md:my-3 text-white">1.23M</h2>
                                <p class="uppercase leading-none md:tracking-widest">Subs<span class="hidden sm:inline-block">cribers</span></p>
                            </div>
                        </div>
                        <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                            <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#3b5998;background: #051124;">
                                <a href="https://facebook.com/pianoteofficial/" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-3xl md:text-4xl"></i> </a>
                                <h2 class="hidden sm:block count font-black leading-none my-2 md:my-3 text-white" id="likes-count" data-total-count="418000">0</h2>
                                <h2 class="count block sm:hidden font-black leading-none my-2 md:my-3 text-white">418K</h2>
                                <p class="uppercase leading-none md:tracking-widest">Likes</p>
                            </div>
                        </div>
                        <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                            <div class="instagram py-4 md:py-5 lg:py-6 rounded-xl w-full" style="background: #051124;">
                                <a href="https://instagram.com/pianoteofficial/" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-3xl md:text-4xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                                </a>
                                <h2 class="hidden sm:block count font-black leading-none my-2 md:my-3 text-white" id="follower-count" data-total-count="171000">0</h2>
                                <h2 class="count block sm:hidden font-black leading-none my-2 md:my-3 text-white">171K</h2>
                                <p class="uppercase leading-none md:tracking-widest" style="color:#E1306C">Followers</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonials flex flex-wrap justify-center mx-auto w-full max-w-xs md:max-w-full">
                        @php
                            $testimonials = [
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/iankershaw.jpg',
                                'title' => "Such a fantastic and welcoming student community.",
                                'description' => "When I signed up for Pianote, I knew I was going to get Lisa’s great energy, the Method, the courses, the bootcamps, and the student reviews.<br><br>But my breakthrough came when I realized that sitting behind all of this is such a fantastic and welcoming, supportive student community. It’s this community – as well as the teachers and the rest of the Pianote team – that really actively encourages you to share your progress and practice. And it doesn’t have to be perfect. And that really does encourage you to practice more. And it’s in that sharing and practice that the real breakthroughs come. Thank you!",
                                'name' => 'Ian Kershaw',
                                'location' => 'United Kingdom',
                                'trailer' => true,
                                'next' => 'JaydeMcIntosh',
                                'prev' => false,
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jaydemcintosh.jpg',
                                'title' => "I’ve had to give up on a lot of my dreams. Then I discovered Pianote.",
                                'description' => "I’ve been chronically ill for the last six years, which means I’ve had to give up on a lot of my dreams and goals.<br><br>During my health journey, my interest in piano and my connection to music really arose – but it also seemed impossible. I had no prior music knowledge and couldn’t even get out of bed some days. This is when I discovered Pianote and they’ve been amazing.<br><br>I have to work at a very slow pace due to my health, but I’ve already learned so many basics. I can play some of my all-time favorite songs – and it’s just so awesome to know I can learn from home and accomplish one of my dreams. I’m so excited to keep learning and I recommend Pianote so much.",
                                'name' => 'Jayde McIntosh',
                                'location' => 'Australia',
                                'trailer' => true,
                                'next' => 'XitlaliCaballero',
                                'prev' => 'IanKershaw',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/xitlalicaballero2.jpg',
                                'title' => "I’m six years old. My biggest moment is when I play Für Elise.",
                                'description' => "My name is Xitlali. I’m six years old. I started playing piano when I was five. A few weeks ago, I started using pianote. My biggest moment is when I play Für Elise.",
                                'name' => 'Xitlali Caballero',
                                'location' => 'Florida, USA',
                                'trailer' => true,
                                'next' => 'NabilAbdEl-Moneim',
                                'prev' => 'JaydeMcIntosh',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/nabilabdelmoneim.jpg',
                                'title' => "I’m a lot better at using both hands and it opened up more songs.",
                                'description' => "You guys make learning way too fun.<br><br>I’ve had two breakthrough moments. There was this video that promised hand independence in five days. And what do you know? A few days later I’m a lot better at using both hands and it just opened up a bunch more songs for me. And my second breakthrough moment was finding this chord chart that made it so much easier to go through the chords and practice them. And I started realizing that these chords sounded a lot like the ones I play on guitar. So I managed to take the notes that were in the practice log and apply them to my guitar, and actually learned theory for both instruments at once. Thank you Lisa and happy playing!",
                                'name' => 'Nabil Abd El-Moneim',
                                'location' => 'British Columbia, Canada',
                                'trailer' => true,
                                'next' => 'JessRipley',
                                'prev' => 'XitlaliCaballero',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jessripley.jpg',
                                'title' => "I’m blown away by the program you’ve created.",
                                'description' => "Pianote is an insanely encouraging and supportive community run by an insanely encouraging and supportive team. Sincerely, I’m blown away by the program you’ve created.<br><br>I sat down one day and it just clicked. From then on, I’ve felt VERY encouraged to keep learning and practicing. It’s fulfilling and fun to see myself progress and achieve goals. Now I’m playing with both hands at the same time with confidence – and I’ve started playing along with more backing tracks and making up my own songs.",
                                'name' => 'Jess Ripley',
                                'location' => 'California, USA',
                                'next' => 'AnselmdeSouza',
                                'prev' => 'NabilAbdEl-Moneim',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/anselmdesouza.jpg',
                                'title' => "Helped coordinate my left and right hands.",
                                'description' => "I was using a piano app, but it wasn’t personal and I had to figure it out on my own most of the time. So I joined Pianote and went back to the basics.<br><br>Pianote helped coordinate my left and right hands. The explanations and instructions are very clear, easy to follow, and slowly I noticed I was improving by using skills from one lesson to the next. It’s structured to allow you to build the foundations, and the tips and tricks videos make your playing special. The lessons are fun and the instructors are engaging.",
                                'name' => 'Anselm de Souza',
                                'location' => 'Singapore',
                                'next' => 'JohnMaclean',
                                'prev' => 'JessRipley',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/johnmaclean.jpg',
                                'title' => "My 6 year old daughter started dancing as I played.",
                                'description' => "Before Pianote and The Method, I was completely lost in terms of knowing how to become a better musician. All I would do is try to play songs, but without any of the structure and practice that is required to actually improve. And with face to face lessons I wasn’t really progressing much between the lessons. But having access to the video tutorials online lets me go back as often as I need to.<br><br>My biggest breakthrough has been independent hand control – allowing me to hear rich music that I’m creating for the first time. And gaining that confidence has allowed me to start to improvise the pieces that I learn.<br><br>The lightbulb moment happened when my 6 year old daughter started dancing as I played! You must be doing something right if someone dances to music that you’re playing, right?",
                                'name' => 'John Maclean',
                                'location' => 'United Kingdom',
                                'next' => 'SerenaDorward',
                                'prev' => 'AnselmdeSouza',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/serenadorward.jpg',
                                'title' => "If I was taught this way as a child, I would have never quit.",
                                'description' => "I decided to sign up with Pianote not only to re-learn how to play the piano, but also because my mental health was really suffering and I needed something positive to focus on that was just for ME. I knew almost immediately that this was the answer I had been looking for. It felt like the heaviness on my shoulders got a bit lighter after every piano session.  And even though the lessons are virtual, it was like Lisa was right there beside me cheering me on.<br><br>I was blown away by how quickly I progressed with a few tutorials from Lisa. My overall confidence improved, especially with improvisation. Now I know all these little tricks (fills & riffs) and how to play inversions and practice chords in ways that sound so lovely.  If I had been taught this way as a child, I probably never would have quit.",
                                'name' => 'Serena Dorward',
                                'location' => 'Ontario, Canada',
                                'next' => 'BettyG',
                                'prev' => 'JohnMaclean',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/betty.jpg',
                                'title' => "Pianote helped me discover my IDENTITY through music.",
                                'description' => "Pianote helped me discover my IDENTITY through music. I love playing during and after watching videos. Laughing, enjoying lessons, and feeling joy – I have sometimes forgot even meals and just got lost in learning and practicing.<br><br>It felt like rising from the dead! Stop everything and do it. I almost feel jealous to share such an awesome tool, but when more people are playing music, this world is better.",
                                'name' => 'Betty G',
                                'location' => 'Kenya',
                                'next' => 'CarmenAlymatiris',
                                'prev' => 'SerenaDorward',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/carmenalymatiris.jpg',
                                'title' => "Lisa is such a great tutor, sympathetic and knowledgeable.",
                                'description' => "Pianote helped from day one as it focuses on underlying concepts rather than only practicing different skills. I realized the tremendous impact when I was able to apply the freshly learned concepts to improvise and create beautiful music.<br><br>Now I can create my own songs based on the scales logic, arpeggios, chords and the inversions. I love it! I can now listen to songs, find the first notes, and then identify the rest based on matching notes and chords.<br><br>Pianote has completely changed my relationship to this beautiful instrument. Lisa is such a great tutor, sympathetic and knowledgeable. I somehow always feel understood, no matter whether a practice goes well or not.",
                                'name' => 'Carmen Alymatiris',
                                'location' => 'Germany',
                                'next' => 'EdKirk',
                                'prev' => 'BettyG',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/edkirk.jpg',
                                'title' => "I like that I can take a lesson any time of day or night.",
                                'description' => "I played organ 45 years ago but had not touched any keyboard in 30 years. Essentially I was starting over from scratch.<br><br>It must have been my second or third lesson when I knew I had found the right place. I like Lisa’s style of teaching – and I found I actually LIKE doing the work and won’t mark a lesson complete until I have thoroughly mastered it. And I like that I can take a lesson any time of day or night.<br><br>I can’t imagine there is any better way to learn. I can go back and review the details of any lesson over and over if needed. Could never do that with live lessons.",
                                'name' => 'Ed Kirk',
                                'location' => 'Florida, USA',
                                'next' => 'DebbieReed',
                                'prev' => 'CarmenAlymatiris',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/debbiereed.jpg',
                                'title' => "The support you receive will keep you wanting to learn.",
                                'description' => "I tried to learn on my own. This turned out to be very frustrating. I needed some guidance, more structure, and more support.<br><br>With Pianote, I was inspired from the very first video I watched. I am able to spend time learning each lesson before moving on – and having questions answered helps so much. Because piano is new to me, doubt would creep in. I felt I would never be able to play well. But practice and awareness of the keyboard has been what I needed. The support you receive will keep you wanting to learn, and having fun with the love of piano.",
                                'name' => 'Debbie Reed',
                                'location' => 'North Carolina, USA',
                                'next' => 'DhivyaSubramanian',
                                'prev' => 'EdKirk',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/dhivyasubramanian.jpg',
                                'title' => "I love the energy Lisa brings to every lesson.",
                                'description' => "I love the energy Lisa brings to every lesson and how she makes everything look fun and easy enough to try.<br><br>I wasn’t sure if video lessons would be engaging enough and if it would be easy to learn virtually. But I enjoy learning at my own pace and having the freedom to choose what I want to learn – playing some of my favorite songs and gaining the tools to explore and play with confidence in front of people. I would highly recommend Pianote.",
                                'name' => 'Dhivya Subramanian',
                                'location' => 'Singapore',
                                'next' => 'ShannonGlisan',
                                'prev' => 'DebbieReed',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/shannonglisan.jpg',
                                'title' => "When I first played a song I cried with joy.",
                                'description' => "I worried I wouldn’t be able to learn from the lessons since I had no musical experience, but I went from not being able to read music to playing songs. When I first played a song and it sounded like the actual song I cried with joy.<br><br>I have wanted to play piano since I was a child and Pianote made my dream come true. With a little practice, I can now play large portions of the songs from the lessons without looking at the keys. And each time I learn a new chord and apply it to the song it’s just as exciting as when I first started.<br><br>I was worried about the cost versus what I would get from the lessons. Pianote is well worth the cost. It’s easy to access and I like being able to play on my own schedule. Lisa makes learning the piano fun!",
                                'name' => 'Shannon Glisan',
                                'location' => 'Tennessee, USA',
                                'next' => 'JulieOjango',
                                'prev' => 'DhivyaSubramanian',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/julieojango.jpg',
                                'title' => "I played piano while my friend played guitar and it was magical.",
                                'description' => "I’ve made a huge stride forward. My fingers are now lighter on the keys – and my left hand can actually play without always following the right hand.<br><br>On a safari away from home, I sat at a piano in a friend’s house and was able to play “Bless The Lord Oh My Soul” by ear using chords. We just enjoyed the music. I played piano while my friend played guitar and it was magical! Pianote is fantastic and I have recommended it already to two friends.",
                                'name' => 'Julie Ojango',
                                'location' => 'Kenya',
                                'next' => 'PetraMiriamTierno',
                                'prev' => 'ShannonGlisan',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/petramiriamtierno.jpg',
                                'title' => "It’s been years since I’ve been this excited.",
                                'description' => "Even though I have been playing for more than 10 years, there is always so much more to learn. And it has felt so rewarding to learn something new each time I visit Pianote. It’s been years since I’ve been this excited.<br><br>They are such great teachers – especially Lisa! She makes everything seem fun and breaks it down to the simplest format for you to learn quickly.",
                                'name' => 'Petra Miriam Tierno',
                                'location' => 'South Carolina, USA',
                                'next' => 'HumbertoCruz',
                                'prev' => 'JulieOjango',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/humbertocruz.jpg',
                                'title' => "Mickey Mouse hugged me for my piano playing.",
                                'description' => "I’ve made steady progress in many areas, from technique to musicality to understanding music theory in a practical way – even playing the first movement of the Moonlight Sonata without sheet music. It feels fantastic.<br><br>And I had the most fun musical experience ever aboard a Disney cruise ship during the holidays. I found a piano not being used in a meeting room and just sat down and began to play Christmas music. An employee dressed in a Mickey Mouse costume came in. I thought he was going to tell me to stop, but instead he walked over and gave me a hug! I was being hugged by Mickey Mouse for my piano playing!",
                                'name' => 'Humberto Cruz',
                                'location' => 'Florida, USA',
                                'next' => 'NickRae',
                                'prev' => 'PetraMiriamTierno',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/nickrae.jpg',
                                'title' => "The best investment I have ever made.",
                                'description' => "I’ve been with Pianote for years and I’m still finding new content every day to keep me occupied. You’ll be amazed at the variety and depth of content available.<br><br>Don’t fancy a 20 minute lesson? Just jump into a Quick Tips video or learn a song. Having the ability to choose whatever lessons I want plus being given a clearly defined learning structure is brilliant. And years of frustrating self-tuition was accelerated thanks to Lisa, Cassi, and Sam. I can honestly say Pianote has been the best investment I have ever made, apart from buying my actual piano!",
                                'name' => 'Nick Rae',
                                'location' => 'United Kingdom',
                                'next' => 'MyraValdez',
                                'prev' => 'HumbertoCruz',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/myravaldez.jpg',
                                'title' => "The impossible becomes possible.",
                                'description' => "I didn’t know how to coordinate my left and right hands. And I had zero knowledge about theory.<br><br>Pianote helped me a lot in building my confidence to become a better pianist. I’m starting to know how to sight read and play the songs I like – the impossible becomes possible.<br><br>I am happy with what I’ve achieved and grateful to continue learning. The teachers and community are very supportive – student review is one of my favorite segments where I’ll submit a song and Sam will assess and give tips for improvement. Overall it’s fun and knowledgeable. I love Pianote.",
                                'name' => 'Myra Valdez',
                                'location' => 'United Arab Emirates',
                                'next' => 'VeronicaValverde',
                                'prev' => 'NickRae',
                                ],
                                [
                                'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/veronicavalverde.jpg',
                                'title' => "I can improvise – I even made a TikTok duet with a singing dog.",
                                'description' => "I feel like I wasted my time for 6 years on a conservatory that taught way too little knowledge – I could only play classical music and was dependent on piano sheets which was frustrating. Now I have learned so much with Pianote. I like the way you guys teach theory.<br><br>One time I saw a video on TikTok about a dog singing – and I could make a duet with my piano and identify the key that it was singing. I know this sounds crazy, but it’s something that made me happy. I can improvise and this is thanks to this platform!",
                                'name' => 'Veronica Valverde',
                                'location' => 'Nicaragua',
                                'next' => false,
                                'prev' => 'MyraValdez',
                                ],
                            ]
                        @endphp
                        {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/janeh.jpg',--}}
                {{--'title' => "I’ve learned so much in such a short space of time.",--}}
                {{--'description' => "I had just stopped private piano piano lessons because I have a chronic illness that made it very, very difficult for me to continue. And I thought maybe that’s going to be the end of my personal journey. But having discovered Pianote, it made me realize that actually that is far from the case.<br><br>I’ve been able to self-pace, which is really helpful with my condition. And I’ve learned so much in such a short space of time. I feel like I’ve learned more than I did even having private lessons. So it’s just been a wonderful experience. I’m looking forward to continuing the journey at my own pace – and being the kind of pianist that I’ve always wanted to be. And I’ve actually been able to call myself a pianist and that feels really amazing.",--}}
                {{--'name' => 'Jane H',--}}
                {{--'location' => 'United Kingdom',--}}
                {{--'trailer' => true--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/irenelee.jpg',--}}
                {{--'title' => "You can access it all on your own time, at your own pace.",--}}
                {{--'description' => "I’m loving it. Previously, I was a casual piano player. I’d taken lessons when I was a kid, but in recent times I was getting sick of playing the same song over and over again or taking too long to learn a new song. The videos that Lisa and the team have put together are fantastic for learning.<br><br>Lisa has an ability to break concepts down into quite simple to understand bites – and you can access it all on your own time, at your own pace. I watch the videos on the train. It’s fantastic and I look forward to progressing my journey.",--}}
                {{--'name' => 'Irene Lee',--}}
                {{--'location' => 'todo',--}}
                {{--'trailer' => true--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/nasreen.jpg',--}}
                {{--'title' => "I’m really excited about learning to play by ear.",--}}
                {{--'description' => "Good but has an annoying beep in the background that makes it unusable.<br><br>15 years ago, I was struck down with a systemic disease. I couldn’t even lift a cup of tea, let alone play the piano. And then I saw Lisa on piano and I thought, well I’ll try again. So I enrolled with Pianote to help me start and it was lovely to be able to listen to Lisa’s voice. And she’s got such a lovely character. It always makes me smile.<br><br>So I started to strengthen my fingers again on the piano and I’m really excited about actually learning to play by ear because I was always sight reading as a child. I’m really looking forward to this new adventure. It’s really lovely to start playing again. Thank you very much!",--}}
                {{--'name' => 'Nasreen Bawa',--}}
                {{--'location' => 'todo',--}}
                {{--'trailer' => true--}}
                {{--],--}}

                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/nancystechlergawle.jpg',--}}
                {{--'title' => "I’d never played piano before joining.",--}}
                {{--'description' => "I feel so accomplished! I’d never played piano before joining, and now I’m learning everything at my own pace. Learning keys, bass clef, two-handed playing. I don’t even need to think about what note each key is anymore. I’ve learned what I wanted and now everything else is just icing on the cake.<br><br>Pianote has something for everyone and the teachers and students are “real”. They make mistakes, laugh at themselves, and teach with enthusiasm.",--}}
                {{--'name' => 'Nancy Stechler Gawle',--}}
                {{--'location' => 'Massachusetts, USA',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/jessycarrara.jpg',--}}
                {{--'title' => "I have my own business, so I don’t have much time.",--}}
                {{--'description' => "I have my own business, so I don’t have much time for fun things – but Pianote is something I can fit in early in the morning before I get ready for work.<br><br>I love the classes that show you the basics then show you add-ons to make it sound even better. I like a challenge. I’ve learned several songs and it’s a great way to practice where you never get bored.",--}}
                {{--'name' => 'Jessy Carrara',--}}
                {{--'location' => 'Oregon, USA',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/robertmann.jpg',--}}
                {{--'title' => "There’s no better place to learn.",--}}
                {{--'description' => "Pianote is beautifully presented and offers well-explained lessons.<br><br>It felt amazing being able to play a favourite song of mine – and also that moment when I finally understood the theory of playing! There’s no better place to learn online.",--}}
                {{--'name' => 'Robert Mann',--}}
                {{--'location' => 'United Kingdom',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/pamelamclean.jpg',--}}
                {{--'title' => "I’m making music WITHOUT reading music.",--}}
                {{--'description' => "Talk about one-stop learning. I’m having a blast. There is something for every musical taste and practice personality. I realized I could have fun practicing scales and chord progressions as much as when I’m practicing songs.<br><br>I never considered myself to be musical, just a hard worker and good sight reader. But now I’m making music WITHOUT reading music. How awesome to discover there is music in me. Pianote helped me find it. Public performances at nursing homes became FUN, not sources of nervous fear of making mistakes. Now if I hit a sour note, I just move chromatically to the right one and keep going. Who knew you could do that!",--}}
                {{--'name' => 'Pamella McLean',--}}
                {{--'location' => 'Illinois, USA',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/matihukin.jpg',--}}
                {{--'title' => "I fell in love right from the start with the Method classes.",--}}
                {{--'description' => "I fell in love right from the start with the Method classes. I’m already telling everyone about the experience – that this is a team that lives with me in the piano world.<br><br>Unlike the past, I don’t just sit down to play a song, but instead I’ll play for fun and run with chords on a number of octaves. I feel like I’m mastering some scales and the chord inversions!",--}}
                {{--'name' => 'Mati Hukin',--}}
                {{--'location' => 'Israel',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/saileer.jpg',--}}
                {{--'title' => "Really makes me more confident.",--}}
                {{--'description' => "Putting in the work to learn music theory and practicing the cool assignments at the end of each lesson really makes me more confident in my playing ability. I finally know the why and how, rather than just copying notes from YouTube.<br><br>Now I can play any song – as long as I can break it down and practice, practice, practice. If there’s one thing you want to do for yourself, join Pianote. It will be worth every penny and more!",--}}
                {{--'name' => 'Sailee R',--}}
                {{--'location' => 'Oregon, USA',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/annegoldsmith.jpg',--}}
                {{--'title' => "I’m just gobbling up all the information. It’s fantastic.",--}}
                {{--'description' => "I learned to play piano as a child, but I never learned chords and was missing all the theory behind chords. I searched the internet and could not find a platform to meet my needs until Pianote.<br><br>When I purchased the membership I was blown away by what was included. I feel like the Cookie Monster eating his favourite cookies and I’m just gobbling up all the information. It’s fantastic.<br><br>No matter where you are in your piano learning journey, Pianote has so many tools available for you. You can move through the lessons at your own pace and you will be so glad you joined. It’s invaluable.",--}}
                {{--'name' => 'Anne Goldsmith',--}}
                {{--'location' => 'Ontario, Canada',--}}
                {{--],--}}
                {{--[--}}
                {{--'image' => 'https://pianote.s3.amazonaws.com/sales/2022/testimonials/tomaszboinski.jpg',--}}
                {{--'title' => "You can achieve your goals much quicker.",--}}
                {{--'description' => "I was afraid that online courses couldn’t replace a real piano teacher and live lessons. But the moment I started Pianote, I realized this is for me. It provided something very close to real 1:1 piano lessons with a teacher. It gave me proper structure with all the basics I needed.<br><br>I was really surprised when I realized how much I could do with a very basic tool set. Pianote understands what students want, especially if you are an adult and don’t have time for full classical training. Learning how to use simple chords and understanding some basic concepts of music theory allowed me to actually play songs and enjoy my time spent on piano.<br><br>I know there are no shortcuts in the learning process, but with the right tools you can achieve your goals much quicker. There’s a great community and super-friendly teachers. Just try it!",--}}
                {{--'name' => 'Tomasz Boinski',--}}
                {{--'location' => 'Ireland',--}}
                {{--],--}}
                @foreach($testimonials as $testimonial)
                    <div class="flex flex-auto testimonial w-full md:w-1/3 lg:w-1/4 md:px-2 pb-2 md:pb-4">
                        <div class="w-full rounded-xl overflow-hidden" style="background: #051124;" @if(empty($testimonial['trailer'])) data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}" @endif >
                            <div class="thumb relative bg-top bg-cover cursor-pointer autoplay-video lazyload" style="padding-bottom:75%" data-bg="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $testimonial['image'] }}" @if(!empty($testimonial['trailer'])) data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}Trailer" @endif>
                                @if(!empty($testimonial['trailer']))
                                    <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller"></i>
                                @endif
                            </div>
                            <div class="p-4 cursor-pointer" @if(!empty($testimonial['trailer'])) data-open="{!!  str_replace(' ', '', $testimonial['name'])  !!}" @endif>
                                <p class="leading-tight"><em>{!!  $testimonial['title'] !!}</em></p>
                                <h6 class="leading-tight mt-3 mb-1 uppercase font-bebas text-pianote">{!!  $testimonial['name'] !!}</h6>
                                <p class="leading-normal text-light-navy text-sm"><em><u>Read more</u> &nbsp;<i class="fas fa-expand"></i></em></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="w-full -mt-14 lg:-mt-5">
                    <div class="join smaller outline light-navy testimonials-show-all mx-auto cursor-pointer">Show More</div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section text-center px-6" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/sales/2022/piano-guarantee.png" alt="guarantee-badge">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Test-drive your lessons for 90 days.</strong><br>
                Zero risk.</h3>
            <p class="text-light-navy leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.</p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>


    <div id="customize-anchor" class="anchor"></div>
    @yield('final')
    <div class="unstick-trigger block"></div>

    @foreach($coaches as $coach)
        <div class="reveal large relative coach-wrap rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{{ $coach['modal'] }}" data-reveal data-reset-on-close="false">
            @if($coach['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $coach['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-44 md:pb-60 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $coach['modalImage'] }}">
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
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $coach['info'] !!}</p>
            </div>
            @if($coach['next'] != false)
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $coach['next'] }}"></i>
                @else
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
                @endif
        </div>
    @endforeach

    @foreach($testimonials as $testimonial)
        <div class="reveal large relative coach-wrap rounded-xl text-center overflow-visible select-none max-w-xs md:max-w-md" id="{!!  str_replace(' ', '', $testimonial['name'])  !!}" data-reveal data-reset-on-close="false">
            @if($testimonial['prev'] != false)
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10" data-close data-open="{{ $testimonial['prev'] }}"></i>
            @else
                <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pr-2.5 md:pr-5 text-5xl md:text-6xl fas fa-angle-left -left-7 md:-left-10 opacity-50"></i>
            @endif
            <div class="relative rounded-t-lg pb-60 md:pb-96 bg-top bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $testimonial['image'] }}"></div>
            <div class="p-4 md:p-5">
                <h2 class="leading-none font-bebas">{!!  str_replace('<br>', ' ', $testimonial['name'])  !!}</h2>
                <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  $testimonial['location'] !!}</p>
                <p class="mx-auto mt-2 mb-3 md:mb-2 leading-tight"><strong>{!!  $testimonial['title'] !!}</strong></p>
                <p class="mx-auto text-left leading-normal md:leading-normal">{!! $testimonial['description'] !!}</p>
            </div>
            @if($testimonial['next'] != false)
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10" data-close data-open="{{ $testimonial['next'] }}"></i>
                @else
                    <i class="absolute transform -translate-y-1/2 top-44 md:top-60 text-white cursor-pointer py-2.5 pl-2.5 md:pl-5 text-5xl md:text-6xl fas fa-angle-right -right-7 md:-right-10 opacity-50"></i>
                @endif
        </div>
    @endforeach

    @php
        $videoModals = [
            [
            'modal' => 'IanKershawTrailer',
            'vimeo' => '660596700',
            'vertical' => true
            ],
            [
            'modal' => 'JaydeMcIntoshTrailer',
            'vimeo' => '660596722',
            'vertical' => true
            ],
            [
            'modal' => 'XitlaliCaballeroTrailer',
            'vimeo' => '660596752',
            'vertical' => true
            ],
            [
            'modal' => 'NabilAbdEl-MoneimTrailer',
            'vimeo' => '660596735',
            'vertical' => true
            ],
            [
            'modal' => 'theodoreTrailer',
            'vimeo' => '660805096',
            ],
            [
            'modal' => 'witt2Trailer',
            'vimeo' => '681588973',
            ],
            [
            'modal' => 'hawkinsTrailer',
            'vimeo' => '694238262',
            ],
            [
            'modal' => 'molinaTrailer',
            'vimeo' => '703892831',
            ],
            [
            'modal' => 'noonaTrailer',
            'vimeo' => '716864694',
            ],
            [
            'modal' => 'singhTrailer',
            'vimeo' => '744366357',
            ],
            [
            'modal' => 'trailer',
            'vimeo' => '778592245',
            ],
         ]
    @endphp
    @foreach($videoModals as $videoModal)
        <div class="reveal large" id="{{ $videoModal['modal'] }}" data-reveal data-reset-on-close="false" @if(!empty($videoModal['vertical'])) style="max-width:320px" @endif>
            <div
                    @if(!empty($videoModal['vertical']))
                        class="w-full relative" style="padding-bottom: 176%;"
                    @else
                        class="w-full relative aspect-16:9"
                    @endif>
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $videoModal['vimeo'] }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="pianote-video"></iframe>
            </div>
        </div>
    @endforeach

    @include('pianote._partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{--    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>


    @yield('scripts')

    @include('pianote._partials.inspectlet')
@stop

