@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Blues Piano | Pianote</title>
    <meta property="og:title" content="30-Day Blues Piano | Pianote">
    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <style>
        .timeline-container .timeline:after,
        .timeline-container:after {
            background-color: #284ffd;
        }
        table.comparison tr td:nth-child(2) {
            background-color: #f61a30;
            text-shadow: 3px 3px #f61a30;
        }
        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color:#eb1a2f;

        }
    </style>
@stop()

@section('body-data')
    x-data ='{
    trailer : false,
    demoVid : false,
    }'
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "30-Day Blues Piano",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price),
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
        "noBreadcrumb" => true
    ])


    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white bg-cover bg-top" style="background:#00114f url(https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/header-bg.jpg);">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-20 sm:h-24 lg:h-32 mb-1 sm:mb-0 lg:mb-1" src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="logo" fetchpriority="high">
                    <h1 class=""><strong>Learn the Blues</strong></h1>
                    <h2 class="sm:-mt-1 lg:mt-0">in just 30 days.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Save your seat in the first-ever <br class="inline lg:hidden">class starting Sept. 4th.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-pointer autoplay-video" style="padding-bottom: 75%;"  x-on:click="trailer = true;">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/header-thumb-m.png" alt="header image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>

                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-pianote"></i> Learn by doing
                        <i class="ml-2 fas fa-check text-pianote"></i> Play every day
                        <i class="ml-2 fas fa-check text-pianote"></i> Perfect for beginners</p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Learn  <br> by doing</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Play  <br>every day</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-pianote"></i><br> Perfect for  <br> beginners</p>
                    </div>

                    <div class="flex flex-wrap sm:flex-nowrap items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full sm:w-1/2 text-center sm:pr-2">
{{--                            <span class="join sold-out medium w-full" data-open="waitlistModal">JOIN WAITLIST</span>--}}
                                <a href="#final" class="join medium w-full anchor-slide">ENROLL NOW</a>
                            <p class="opacity-70 text-sm mt-2 mb-5 sm:mb-0 underline hover:text-pianote">
                                <a href="https://www.musora.com/pianote/enrollment/30-day-blues-piano">Pianote Members register for free here.</a>
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 lg:pb-5">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/piano-players-trusted.png" alt="joined student profiles" fetchpriority="high">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-pointer autoplay-video" x-on:click="trailer = true;">
                        <img class="absolute inset-0" src="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/header-thumb.png" alt="header image" fetchpriority="high" />
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border rounded-lg border-gray-300 mt-8 lg:mt-12 mb-2 lg:mb-4">
                <div class="w-full sm:w-auto border-b sm:border-b-0 sm:border-r border-gray-300 py-4 sm:py-3 lg:py-4">
                    <p class="tracking-wide text-pianote text-sm">STARTS ON</p>
                    <h4 class="px-3 lg:px-5"><strong>Sept. 4th</strong></h4>
                    <hr class="border-gray-300 my-4 sm:my-2 lg:my-4">
                    <p class="text-sm px-3 lg:px-5">
                        <span class="text-pianote">Enrollment closes in</span><br class="inline lg:hidden">
                        <span x-cloak x-data="timer()" x-init="countdown()">
                             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                             <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                         </span>
{{--                        Enrollment closed--}}
                    </p>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Dates</strong><br>
                            <span class="text-sm"> Sept. 4th to<br class="hidden sm:inline"> Oct. 4th.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes/day<br class="hidden sm:inline"> for 30 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play your first<br class="hidden sm:inline"> Blues solo!</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-70 text-center"><em>Flexible lesson times to fit any schedule<br class="inline sm:hidden"> PLUS you get lifetime access!</em></p>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <img class="h-56 inline sm:hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/collage.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h2 class="text-center mt-5 sm:mt-0"><strong>Learn the Blues by PLAYING the Blues.</strong></h2>
            <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7 lg:mb-10 uppercase text-blue-600">This is the NEW way of learning Blues piano.<br class="hidden sm:inline"> Play along with your teacher for just 10 minutes a day.</p>

            <div class="text-left flex flex-wrap sm:flex-nowrap">
                <p class="leading-normal max-w-lg pr-7">All your favorite songs can be traced back to one genre – the Blues.
                    <br><br>
                    It’s one of the funnest styles to play – but it can seem IMPOSSIBLE to learn. After all, how do you learn something that is supposed to be improvised? How can you practice something that is meant to be spontaneous?
                    <br><br>
                    The same way you learn everything else…
                    <br><br>
                    <strong>With a great teacher and a bit of practice.</strong>
                    <br><br>
                    30-Day Blues Piano will guide you through the essential skills you need to confidently play the Blues on your piano. You’ll learn the basic structure of the Blues, the most important scale, and some iconic riffs than will get you started on your Blues journey.
                    <br><br>
                    All in just 10 minutes a day.
                    <br><br>
                    Keep scrolling to see how.</p>
                <img class="h-96 hidden sm:inline transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/collage.png" alt="collage intro" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f1f7fe calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f1f7fe;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-10 sm:h-20 mb-8 transition-all opacity-0"src="https://www.musora.com/musora-cdn/image/width=1220,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/just-press-play-title.png" alt="just play logo" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="leading-normal mb-20 lg:mb-28 max-w-2xl">30-Day Blues Piano is the new way to learn the Blues. By focusing on short, consistent practice sessions, you’ll develop the skill and muscle memory to play the Blues. You’ll never have to worry about what to practice. All you need to do is follow along.</p>

            @php
                $gettings = [
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/perfect-lesson.jpg',
                    'title' => 'The PERFECT lesson, every time.',
                    'desc' => 'You’ll start slow and gradually build your skills day-by-day. It won’t be overwhelming, and you’ll never have to worry about WHAT to practice.',
                    'special' => true,
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/practice.jpg',
                    'title' => 'Get the MOST out of every practice.',
                    'desc' => 'Your time is precious, so don’t waste it. Each lesson is only 10 minutes and there’s a handy countdown timer so you can stay focused and get better results in a shorter time.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/live-support.jpg',
                    'title' => 'Live support from REAL teachers.',
                    'desc' => 'Throughout the 30 days, you’ll have a team of REAL teachers to help you. Got questions? You’ll get a personalized answer from an experienced piano teacher. You’re never alone.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/lifetime-access.jpg',
                    'title' => 'Lifetime access.',
                    'desc' => 'The course lasts 30 days. But it’s yours for life. You’ll keep access to ALL the lessons forever. So you can go back and repeat anything you want to, as often as you like.',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-3xl lg:max-w-4xl mx-auto relative px-4 mt-5">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 @if($key !== 3) md:mb-28 @else md:mb-0 @endif">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg overflow-hidden transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            @if(empty($getting['special']))
                                <img class="-mt-7 rounded-lg transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" loading="lazy" onload="this.classList.remove('opacity-0')" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 overflow-hidden">
                                    <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}img" loading="lazy" onload="this.classList.remove('opacity-0')" />
                                </div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <img class="h-14 mb-2" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/scoll-more-icon.svg">
            <h5 class="leading-tight text-blue-600"><strong>Watch the<br> demo below!</strong></h5>
        </div>
    </section>
    <div id="demo" class="anchor"></div>
    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-tablet-bg.png);">
        <h3 class="leading-tight"><strong>You should know it’s right for you.</strong></h3>
        <p class="leading-normal mt-2 sm:mt-3 mb-5 sm:mb-7">Curious? <strong>Try a snippet from Day 1</strong> and<br class="inline sm:hidden"> see if  30-Day Blues Piano is right for you.</p>
        <div class="relative cursor-pointer autoplay-video" x-on:click="demoVid = true;">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-tablet-m.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-tablet.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="absolute transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-2/3 px-3 py-1 z-10 rounded-xl text-white inline-block mx-auto text-sm whitespace-nowrap" style="background-color:#284ffd;"><i class="fas fa-play-circle mr-1 text-xl sm:text-3xl align-middle"></i> Hit play and see what Day 1 is like.</p>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white bg-cover bg-top" style="background:#00114f url(https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/midway-bg.jpg);">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-32 sm:h-64 lg:h-72 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=760,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30DD logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-pianote mr-5"></i> Daily guided Blues lessons<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Weekly LIVE support & Q&A<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Flexible schedule<br>
                    <i class="fas fa-check text-pianote mr-5"></i> 10-minute lessons<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Guaranteed results</h4>
            </div>

            <a href="#final" class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3">ENROLL NOW</a><br>
            <img class="h-7 mr-1 mb-5 sm:mb-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/piano-players-trusted.png" alt="joined student profiles">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>

        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f1f7fe;">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img class="h-20 sm:h-24 align-bottom opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-black.png" loading="lazy" onload="this.classList.remove('opacity-0')" alt="logo"> <strong>...is perfect for:</strong></h2>
            <div class="flex flex-wrap text-left max-w-4xl mx-auto">
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/beginner-piano-player.jpg" alt="classical player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br>Beginner <br class="hidden sm:inline"> piano players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Know a few chords, but struggling to feel like you’re “playing the piano”? Or are you feeling overwhelmed about improvisation or soloing? 30-Day Blues Piano will give you the exact structure to start exploring your creative side.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/intermediate-piano-player.jpg" alt="classical player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br>Intermediate<br class="hidden sm:inline"> piano players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Do you want to play with other musicians? Or break through that plateau of the same chords and the same songs? You’ll learn the riffs and techniques the pros use to make their playing sound interesting and advanced.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl">
                        <img class="absolute inset-0 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/classical-piano-player.jpg" alt="classical player" loading="lazy" onload="this.classList.remove('opacity-0')" />
                        <h6 class="leading-tight absolute bottom-1 w-full z-10"><strong><img class="h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon" loading="lazy" onload="this.classList.remove('opacity-0')"><br> Classical<br class="hidden sm:inline"> piano players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">The Blues is scary for a classically-trained musician. There are no notes. It’s all about what’s inside. If that’s making you sweat a little, then you NEED to try 30-Day Blues Piano. Push that comfort zone, and start playing the Blues.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="leading-tight"><strong>Play More. Get Better.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3 mb-5 sm:mb-7 uppercase text-blue-600">It’s not rocket science.</p>
            <p class="leading-normal mb-11 max-w-2xl">The more you play, the better you’ll get. And it won’t cost the earth. For less than the cost of 2 private piano lessons, you’ll get 30 days of guided training to get you playing awesome Blues piano. And once the course is over, the lessons are yours for life.</p>
            <div class="relative">
                <p class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=220,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-white.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')"></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tl-xl"><strong>Private<br> Lessons</strong></td>
                        <td class="cursor-pointer sm:cursor-default"><strong>Online<br> Courses</strong></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tr-xl"><strong>Piano<br> Books</strong></td>
                    </tr>
                    <tr>
                        <td>Style</td>
                        <td>20 Play-Along Lessons</td>
                        <td>In-Person</td>
                        <td>Self-Directed</td>
                        <td>Self-Directed</td>
                    </tr>
                    <tr>
                        <td>Live</td>
                        <td>Weekly Live Q&As</td>
                        <td>Yes</td>
                        <td>Sometimes</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Length</td>
                        <td>30 Days</td>
                        <td>Open Ended</td>
                        <td>Open Ended</td>
                        <td>Open Ended</td>
                    </tr>
                    <tr>
                        <td>Access</td>
                        <td>Lifetime Access</td>
                        <td>One-Time</td>
                        <td>Varies</td>
                        <td>Lifetime</td>
                    </tr>
                    <tr>
                        <td>Guarantee</td>
                        <td>90 days</td>
                        <td>No</td>
                        <td>Varies</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Investment</td>
                        <td class="rounded-b-xl"><strong>${{ floatval($productPrices['new-piano-players-start-here']->discounted_price) }}</strong><br>Single Payment</td>
                        <td class="rounded-bl-xl"><strong>$50-$100</strong><br> For a Single <L></L>esson</td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #d70b3b calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #d70b3b, #9d1032);">
        <div class="container max-w-2xl mx-auto">
            <div class="-mt-14 sm:-mt-20 lg:-mt-28 mb-7">
                <img class="block h-20 sm:h-24 mx-auto animated infinite bounce slower transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Important_Icon.svg" alt="important icon" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
            <h1 class="font-bebas text-5xl sm:text-6xl lg:text-7xl">FAIR WARNING</h1>
            <h6 class="leading-normal  mt-4 mb-8">30-Day Blues Piano is a daily guided workout program for piano players — where you’ll get a new video each weekday and live support throughout the month. Because of this, students will not be able to join midway. You need to register before the course begins.</h6>
                        <h4 class="py-1.5 w-full font-bebas uppercase inline-block mx-auto" style="background-color:#fd5;color:#9d1032;">REGISTRATION CLOSES IN<br class="inline sm:hidden">
                            <span x-cloak x-data="timer()" x-init="countdown()">
                                         <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                                         <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                                         <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                                         <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>
                                         <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                                     </span>
                        </h4>
        </div>
    </section>
    <section class="text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32 lg:pb-40">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-64 lg:w-72 relative -mb-8 sm:mb-0 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/coach-profile-m2.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/coach-profile.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0" style="width: 150%;transform: translate(-44%, -7%);" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-20 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Kevin Castro</strong></h2>
                    <p class="leading-normal my-4 lg:my-6">Kevin Castro wouldn’t be a professional pianist without the Blues. In fact, it was a Blues improvisation that got him accepted into University.
                        <br><br>
                        Since then, he’s toured with rising stars and JUNO-Award winners (JESSIA, Elijah Woods), played at TikTok Headquarters in New York and LA, and even recorded a demo for Jennifer Lopez (which was, sadly, never released).
                        <br><br>
                        And whenever Kevin plays with new musicians, he always uses the Blues to jam.
                        <br><br>
                        But Kevin’s real passion comes from sharing his experience and knowledge with students.
                        <br><br>
                        And he’ll be with you at stage of this journey.
                        <br><br>
                        The Blues changed his life, and he knows it will do the same for you.
                    </p>
                    <img class="float-right h-12 sm:h-24 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/kevin-signature.png" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>
            </div>


{{--            <span class="join sold-out medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3" data-open="waitlistModal">JOIN WAITLIST</span><br>--}}

                <a href="#final"
                    class="join medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">ENROLL NOW</a><br>

            <img class="h-7 mr-1 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/piano-players-trusted.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
        </div>
    </section>

    <div class="h-10 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f1f7fe calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#f1f7fe;">
        <div class="container max-w-3xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h3 class="my-4 sm:my-6 lg:my-8"><strong>But what if it doesn’t<br class="inline sm:hidden"> work for you?</strong></h3>
            <p class="leading-normal">You’ll be playing the Blues in just 30 days. That’s our promise.
                <br><br>
                But what if it doesn’t work?
                <br><br>
                Then you won’t have to pay. We’re so confident you’ll love the results, that you’ll have 90 days to put us to the test (even though the course only lasts for 30).
                <br><br>
                If you give it an honest try and you’re not happy (for any reason), simply let us know within 90 days for a FULL refund.</p>
        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white bg-cover bg-top" style="background:#00114f url(https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/order-bg.jpg);">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="text-center">
                <img class="h-20 md:h-24 lg:h-28 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="logo" loading="lazy" onload="this.classList.remove('opacity-0')">
                <h4 class="leading-tight mt-4 mb-2">
                    <strong>20 Guided Play-Along Lessons + Feedback From REAL Teachers.</strong>
                </h4>
                <p class="mb-10">Learn to play the Blues in the first-ever class starting September 4th!</p>
            </div>
            <div class="md:grid md:grid-cols-2 gap-6 items-start max-w-md md:max-w-3xl mx-auto text-black mb-7">
                <div class="bg-white rounded-xl py-8 px-4 mb-10 md:mb-0">
                    <div class="text-center -mt-11">
                        <div class="bg-[#284FFD] rounded-full text-white inline-block uppercase py-0.5 px-4 text-sm mb-6">EARLY BIRD SPECIAL</div>
                        <h4 class="mb-10"><strong>30-Day Blues Piano</strong></h4>
                        <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/early-bird-collage.png" alt="Early bird special pack" />
                        <h2><s class="text-[#ABB5C2] mr-2">$235</s><strong>$97</strong></h2>
                        <p class="italic mb-4 text-xs">One-time payment</p>
                        <a href="/ecommerce/add-to-cart?product-array=30-day-blues-piano:1,faster-fingers:1,piano-chords-and-scales-guide:1&redirect=/order&locked=true" class="join blue medium w-full mb-5 bg-[#284FFD]">ENROLL NOW</a>
                        <p>
                            <b class="text-[#284FFD]">30-Day Blues Piano (Lifetime Access)</b><br/>
                            <span class="text-[#284FFD]">Free</span> Faster Fingers <i>($99 value)</i><br>
                            <span class="text-[#284FFD]">Free</span> Chords & Scales Book <i>($39 value)</i>
                        </p>
                    </div>
                </div>
                <div class="bg-white rounded-xl py-8 px-4">
                    <div class="text-center -mt-11">
                        <div class="bg-pianote rounded-full text-white inline-block uppercase py-0.5 px-4 text-sm mb-6">LAUNCH MEMBERSHIP SPECIAL</div>
                        <h4 class="mb-10"><strong>Join Pianote + FREE 30-Day Blues Piano</strong></h4>
                        <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/launch-membership-collage.png" alt="Membership special pack" />
                        <h2><s class="text-[#ABB5C2] mr-2">$726</s><strong>$200</strong></h2>
                        <p class="italic mb-4 text-xs">Your first year</p>
                        <a href="/ecommerce/add-to-cart?product-array=PIANOTE-MEMBERSHIP-1-YEAR:1,30-day-blues-piano:1,easy-chords:1,new-piano-players-start-here:1,faster-fingers:1,piano-chords-and-scales-guide:1,poster-chords:1,poster-scales:1,pianote-practice-planner:1&promo-code=special&redirect=/order&locked=true" class="join blue medium w-full mb-5 bg-pianote">ENROLL NOW</a>
                        <p>
                            <b class="text-pianote">Annual Pianote Membership</b><br/>
                            <b class="text-pianote">30-Day Blues Piano (Lifetime Access)</b><br/>
                            <span class="text-pianote">Free</span> Easy Chords <i>($97 value)</i><br>
                            <span class="text-pianote">Free</span> New Piano Players Start Here <i>($97 value)</i><br>
                            <span class="text-pianote">Free</span> Faster Fingers <i>($99 value)</i><br>
                            <span class="text-pianote">Free</span> Chords & Scales Book <i>($39 value)</i><br>
                            <span class="text-pianote">Free</span> Chords & Scales Posters <i>($18 value)</i><br>
                            <span class="text-pianote">Free</span> Pianote Practice Planner <i>($39 value)</i>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <img class="h-7 mr-1 transition-all" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/piano-players-trusted.png" alt="joined student profiles" loading="lazy" onload="this.classList.remove('opacity-0')">
                <div class="inline-block leading-tight text-sm">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</div>
            </div>

{{--                <div class="flex flex-wrap sm:flex-nowrap max-w-xs sm:max-w-full items-center text-left w-full mx-auto lg:w-2/3 lg:pl-5 xl:pl-10 text-black">--}}
{{--                    <a href="/ecommerce/add-to-cart?products[30-day-blues-piano]=1&locked=true"--}}
{{--                        class="z-10 relative px-5 sm:px-7 py-7 sm:py-9 mb-7 sm:mb-0 bg-white rounded-xl shadow-lg w-full sm:w-5/12">--}}
{{--                        <p class="text-white bg-blue-600 inline-block rounded-xl text-xs mb-2 px-4 tracking-wider">EARLY BIRD SPECIAL</p>--}}
{{--                        <h3><strong>30-Day Blues Piano</strong></h3>--}}
{{--                        <p class="text-sm mt-2 mb-5">Play the Blues in just 30 days.</p>--}}
{{--                        <h2 class="inline-block"><s class="opacity-60">$235</s> <strong class="text-4xl">${{ 97 }}</strong></h2> <p class="inline-block text-xs">One time payment.</p><br>--}}
{{--                        <div class="join blue smaller my-4 w-full">ENROLL NOW</div>--}}
{{--                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>--}}
{{--                            <i class="fas fa-check text-blue-600 mr-1"></i> Lifetime Course Access<br>--}}
{{--                            <i class="fas fa-check text-blue-600 mr-1"></i> FREE Faster Fingers ($99 Value)<br>--}}
{{--                            <i class="fas fa-check text-blue-600 mr-1"></i> FREE Chords & Scales Book ($39 Value)<br>--}}
{{--                            <i class="fas fa-check text-blue-600 mr-1"></i> 90-Day Money-Back Guarantee</p>--}}
{{--                    </a>--}}
{{--                    <a href="/ecommerce/add-to-cart?product-array=PIANOTE-MEMBERSHIP-1-YEAR:1,30-day-blues-piano:1,piano-chords-and-scales-guide:1,poster-chords:1,poster-scales:1,pianote-practice-planner:1,100-days-of-practice-poster:1,the-power-of-chords:1,piano-riffs-and-fills:1&redirect=/order&locked=true"--}}
{{--                        class="px-5 sm:px-10 py-5 sm:py-7 sm:-ml-5  rounded-xl shadow-lg w-full sm:w-7/12 bg-center bg-cover border-4 border-white"--}}
{{--                        style="background-color:#dde9f9;background-image:url(https://www.musora.com/musora-cdn/image/width=380,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/order-bg.jpg);"--}}
{{--                    >--}}
{{--                        <p class="bg-pianote text-white inline-block rounded-xl text-xs mb-2 px-4 tracking-wider">LAUNCH MEMBERSHIP SPECIAL</p>--}}
{{--                        <h3><strong>Join Pianote + FREE <br class="hidden sm:inline"> 30-Day Blues Piano</strong></h3>--}}
{{--                        <p class="text-sm mt-2 mb-5">The Ultimate Online Lessons Experience.</p>--}}
{{--                        <h2 class="inline-block"><s class="opacity-60">$726</s> <strong class="text-4xl">$200</strong></h2> <p class="inline-block text-xs">Billed annually.</p><br>--}}
{{--                        <div class="join blue smaller my-4 w-full">GET EVERYTHING</div>--}}
{{--                        <ul class="list-disc ml-6">--}}
{{--                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Easy Chords ($97 Value)</li>--}}
{{--                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> New Piano Players Start Here ($97 Value)</li>--}}
{{--                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Faster Fingers ($99 Value)</li>--}}
{{--                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Chords & Scales Book ($39 Value)</li>--}}
{{--                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Chords & Scales Posters ($18 Value)</li>--}}
{{--                            <li class="text-sm leading-relaxed"><span class="text-pianote">Free</span> Pianote Practice Planner ($39 Value)</li>--}}
{{--                        </ul>--}}
{{--                        <hr class="w-full my-5" style="border-color:#b2cae1">--}}
{{--                        <p class="leading-loose text-sm"><strong>Key Features</strong><br>--}}
{{--                            <i class="fas fa-check text-pianote mr-1"></i> Lifetime Course Access<br>--}}
{{--                            <i class="fas fa-check text-pianote mr-1"></i> 90-Day Money-Back Guarantee</p>--}}
{{--                    </a>--}}
{{--                </div>--}}
        </div>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="max-w-6xl mt-4 sm:mt-10 px-4">
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
                "desc" => "30-Day Blues Piano gives you guided daily piano lessons for thirty days – with a few flex days built in for when life happens. Each lesson is only 10 minutes. We’ve made it short so you’re more likely to keep playing!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "30-Day Blues Piano is available on your laptop, tablet, or phone. You’ll also have access through the Musora App after you’ve completed your purchase of the course.",
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

    @include('_partials.components.video-modal',[
        'name' => 'demoVid',
        'video' => '852836211',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '852795615',
        'vimeo' => true,
    ])

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-09-04 00:00:00',
        'promoVersion' => false
    ])
    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

        <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
        <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
        <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
        <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


    <script>
        $(document).ready(function () {
            $('.comparison tr td:nth-child(3)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('online');
            });
            $('.comparison tr td:nth-child(4)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('books');
            });
            $('.comparison tr td:nth-child(5)').on('click', function(){
                $(this).parents().find('table').removeClass('private books online');
                $(this).parents().find('table').addClass('private');
            });
        })
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
