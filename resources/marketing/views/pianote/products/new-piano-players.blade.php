@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>New Piano Players Start Here | Pianote</title>
    <meta property="og:title" content="New Piano Players Start Here | Pianote">
    <meta name="description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">
    <meta property="og:description" content="Learn the piano. Play your favorite songs. Start sounding beautiful.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/share-image.jpg" style="display: none;">
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
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "New Piano Players Start Here",
        "fullPrice" => floatval($productPrices['new-piano-players-start-here']->price),
        "price" => floatval($productPrices['new-piano-players-start-here']->discounted_price),
        "noBreadcrumb" => true
    ])

    @php
            $registerButtonUrl = "/ecommerce/add-to-cart?product-array=new-piano-players-start-here:1";
    @endphp

    <header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left">
                    <img class="h-14 sm:h-18 lg:h-20 -mb-2 sm:mb-0 lg:mb-3 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png" alt="new piano players start here logo">
                    <h1 class="rotater-text overflow-hidden"><strong>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>

                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Learn the piano</span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Play real songs </span><br>
                            <span class="relative whitespace-nowrap delay-1000 ease-in-out">Sound beautiful</span><br>
                        </strong></h1>
                    <h2 class="-mt-3 sm:-mt-1 lg:mt-0">in just 30 days.</h2>

                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>Start your journey on the piano <br class="inline lg:hidden"> with 30 days of guided lessons.</strong></h6>

                    <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video lazyload" style="padding-bottom: 75%;" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb-m2.jpg" data-open="trailer">
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
                                <a href="{{ $registerButtonUrl }}" class="join medium w-full">Get Started</a>
                        </div>
                        <div class="w-full sm:w-1/2">
                            <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined student profiles">
                            <p class="inline-block leading-tight text-sm align-middle">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-5/12 hidden sm:block">
                    <div class="rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-hover autoplay-video lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/header-thumb2.jpg" data-open="trailer">
                        <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap text-center border rounded-lg border-gray-300 mt-8 lg:mt-12 mb-2 lg:mb-4">
                <div class="flex flex-wrap sm:flex-nowrap items-center justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 text-left sm:text-center">
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-calendar-day text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Course Length</strong><br>
                            <span class="text-sm">30 days.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-clock text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Commitment</strong><br>
                            <span class="text-sm">10 minutes per day.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-piano-keyboard text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Skill Level</strong><br>
                            <span class="text-sm">Beginner.</span></p>
                    </div>
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3">
                        <i class="far fa-fw mr-3 sm:mr-0 fa-trophy text-pianote text-2xl"></i>
                        <p class="leading-tight mx-0"><strong class="font-black">Result</strong><br>
                            <span class="text-sm">Play real songs on the <br> piano and sound beautiful.</span></p>
                    </div>
                </div>
            </div>
            <p class="opacity-50 text-center"><em> Learn the piano on YOUR schedule<br class="inline sm:hidden"> with lifetime access!</em></p>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <img class="h-56 inline sm:hidden lazyload" data-src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/collage-intro-m.png" alt="collage intro">
            <h2 class="text-center my-5 sm:mt-0 sm:mb-7"><strong>Learn the piano<br class="inline sm:hidden"> in 30 days.</strong></h2>
            <div class="text-left flex flex-wrap sm:flex-nowrap">
                <h6 class="leading-normal max-w-xl pr-7">You don’t learn by watching. You learn by doing.
                    <br><br>
                    So learn the piano <strong>by playing the piano.</strong> You’ll be playing a song from the very first lesson and you’ll follow along with 10-minute daily guided sessions that show you exactly what to play.
                    <br><br>
                    No complicated theory. No need to read music. No frustration.
                    <br><br>
                    All you have to do is press play and follow along. Plus, you’ll have access to real teachers who can answer your questions, help you stay motivated, and make sure you’re on track and having FUN on the piano.
                    <br><br>
                    So if you’re a new piano player and you’re wondering where to start…
                    <br><br>
                    <strong>Start here.</strong></h6>
                <img class="h-96 hidden sm:inline lazyload" data-src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/collage-intro-desktop.png" alt="collage intro">
            </div>
            <a href="{{ $registerButtonUrl }}" class="join smaller">Get Started</a>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-10 sm:h-20 mb-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1220,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/Just_Press_Play_logo.png" alt="just play logo">
            <h6 class="leading-normal mb-20 lg:mb-28">New Piano Players Start Here is unlike any other way to learn the piano. From day 1 you’ll be playing a REAL song by following guided play-along lessons with your instructor, Lisa Witt.
                <br><br>
                This isn’t a video game. You’ll be building your skills every single day. And the best part…
                <br><br>
                It only takes 10 minutes a day.</h6>

            @php
                $gettings = [
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/calendar2.jpg',
                    'title' => 'Know exactly what to practice.',
                    'desc' => 'You’ll never be left wondering what to do. Log in, press play, and follow along with daily 10-minute guided practice sessions for 30 days.',
                    'special' => true,
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/practice.jpg',
                    'title' => 'Short, focused practice sessions.',
                    'desc' => 'No wasted time, no distractions. Each session features a countdown timer so you can turn off the distractions and focus on playing.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/progress.jpg',
                    'title' => 'Smile in your first lesson.',
                    'desc' => 'Play along with a professional backing track so you’ll sound (and feel) incredible as you’re learning. It’s a super motivating way to keep making progress.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/q_a2.jpg',
                    'title' => 'Your questions answered.',
                    'desc' => 'You’ll have access to Lisa and the other teachers inside Pianote. So when you have questions, you’ll get answers. You’ll never be left alone to figure it out.',
                    ],
                    [
                    'position' => 'left',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/lifetime.jpg',
                    'title' => 'Lifetime access.',
                    'desc' => 'New Piano Players Start here is yours for life. Go through it as often as you like, you’ll keep access to ALL the lessons forever. There’s no membership or subscription.',
                    ],
                    [
                    'position' => 'right',
                    'img' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/skills.jpg',
                    'title' => 'Skills to take you further.',
                    'desc' => 'The skills you learn in New Piano Players Start Here go beyond the course. By the end you’ll have the building blocks to start playing hundreds of popular songs (literally)!',
                    ],
                ];
            @endphp
            <div class="timeline-container max-w-3xl lg:max-w-4xl mx-auto relative px-4 mt-5">
                @foreach ($gettings as $key => $getting)
                    @if($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 @if($key !== 5) md:mb-28 @else md:mb-0 @endif">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-28">
                            @if(empty($getting['special']))
                                <img class="-mt-7 rounded-lg lazyload" data-src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9 lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $getting['img'] }}"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background-color: #2a2f34;">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="filter saturate-0 invert h-20 sm:h-28 lg:h-32 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=760,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-stacked.svg" alt="new piano players start here logo">
                <h4 class="leading-loose text-left">
                    <i class="fas fa-check text-pianote mr-5"></i> Daily guided piano workouts<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Flexible weekly schedule<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Ongoing motivation & support<br>
                    <i class="fas fa-check text-pianote mr-5"></i> Guaranteed results</h4>
            </div>
            <a href="{{ $registerButtonUrl }}" class="join medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3">Get Started</a><br>
            <img class="h-7 mr-1 mb-5 sm:mb-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png" alt="joined profiles">
            <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join {{ number_format($nPackOwners ?? 0) }} piano players who<br> have already registered.</p>

        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-6 sm:mb-10 lg:mb-14"><img class="h-16 sm:h-24 -mb-2 sm:-mb-4 align-bottom  lazyload" data-src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png" alt="new piano players start here logo"> <strong>...is perfect for:</strong></h2>
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-player.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-3 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon"><br>New Piano<br class="hidden sm:inline lg:hidden"> Players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">It’s right there in the name! If you’re just getting started, New Piano Players Start Here is perfect. From the very first lesson, you’ll be playing real music that sounds GOOD. </p>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-6 sm:mb-0">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/returning-piano-player.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-3 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon"><br>Returning<br class="hidden sm:inline lg:hidden"> Piano Players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Been away a while? Come back to the piano and have FUN. Brush up on the foundations and play with confidence.</p>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <div class="pb-44 sm:pb-36 lg:pb-52 text-center text-white bg-cover bg-center relative overflow-hidden rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=530,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/classically-trained-player.jpg">
                        <h6 class="leading-tight lg:leading-relaxed absolute bottom-3 w-full z-10"><strong><img class="h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/plus.svg" alt="check icon"><br> Classically-Trained<br class="hidden sm:inline lg:hidden"> Piano Players</strong></h6>
                        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.8));"></div>
                    </div>
                    <p class="leading-normal mt-3">Scared to break away from the safety of sheet music? New Piano Players Start Here will give you the confidence to trust your ear.</p>
                </div>
            </div>


            <h2 class="mt-20 lg:mt-24 mb-3"><strong>Play more. Play better.</strong></h2>
            <h6 class="leading-normal mb-11">For less than the cost of 2 private piano lessons, you’ll <br class="hidden sm:inline"> get 30 days of guided lessons to transform your playing.</h6>

            <div class="relative">
                <p class="inline sm:hidden leading-tight text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto comparison max-w-4xl mx-auto mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl"><img class="h-8 sm:h-14 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=220,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-white.png" alt="new piano players start here logo"></td>
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
                        <td class="rounded-b-xl">
                            @if($productPrices['new-piano-players-start-here']->price > $productPrices['new-piano-players-start-here']->discounted_price)
                                <s class="opacity-60">${{ floatval($productPrices['new-piano-players-start-here']->price) }}</s>
                            @endif
                            <strong>${{ floatval($productPrices['new-piano-players-start-here']->discounted_price) }}</strong></td>
                        <td class="rounded-bl-xl"><strong>$50-$100</strong><br> per lesson</td>
                        <td><strong>$89-$270+</strong><br>&nbsp;</td>
                        <td class="rounded-br-xl"><strong>$19-$49</strong><br>&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 pt-10 sm:pt-14 lg:pt-20 py-16 sm:pb-32" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <img class="border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/profile_picture.jpg" alt="profile picture">

                <div class="text-white text-left rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-pianote leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Lisa Witt</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Lisa Witt might just be the happiest piano teacher on the internet.
                        <br><br>
                        With 20 years of teaching experience, her online lessons have helped millions of students around the world.
                        <br><br>
                        But her true magic lies in her empathy and understanding of what it’s like to be a new piano player. She knows how it feels to struggle and she’ll show you how to overcome those challenges and approach the piano in a way that’s motivating, inspiring, and most of all - FUN!
                        <br><br>
                        Start your piano journey with Lisa today.
                    </h6>
                    <div class="flex justify-between text-center mt-7 lg:mt-10">
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                            <h3 class="mt-2"><strong>103M</strong></h3>
                            <p class="uppercase opacity-70 text-sm">views</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                            <h3 class="mt-2"><strong>175k</strong></h3>
                            <p class="uppercase opacity-70 text-sm">followers</p>
                        </div>
                        <div class="">
                            <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                            <h3 class="mt-2"><strong>55.8K</strong></h3>
                            <p class="uppercase opacity-70 text-sm">Followers</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What students are saying about Lisa and her teaching style.</strong></h3>
            <div class="flex flex-wrap text-left">

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
                    <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                        <div class="flex items-start p-5 bg-white rounded-lg">
                            <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/{{ $testimonial['image'] }}" alt="testimonial {{ $key }}">
                            <p class="pl-4"><strong>{{ $testimonial['name'] }}</strong><br>
                                <em class="leading-tight inline-block mb-1 opacity-60">{{ $testimonial['location'] }}</em><br>
                                “{!! $testimonial['description']  !!}”
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="h-10 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));"></div>
    <section class="text-white text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>The guarantee that lasts<br> longer than the course.</strong></h2>
            <p class="leading-normal mx-auto" style="max-width:540px">New Piano Players Start Here is all about getting you playing beautiful piano in the shortest amount of time. For less than the cost of just 2 private lessons, you’ll have a guided path to improve your playing, build your confidence, and start your journey on the piano.
                <br><br>
                You’re going to love it.
                <br><br>
                That’s why you’ll get a guarantee that’s 3X longer than the course! You’ll have 90 days to get through everything and make sure it’s right for you.
                <br><br>
                If not, simply contact our friendly support team within those 90 days for a full refund.
            </p>

        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-12 sm:py-16 lg:py-24" style="background-color:#eff7ff;">
        <div class="container mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                <div class="text-left w-full sm:w-7/12 xl:w-5/12 lg:pl-5">
                    <img class="h-20 md:h-20 lg:h-24 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=380,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/new-piano-players-start-here-logo-2+1.png" alt="new piano players start here logo">
                    <h3 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5"><strong>
                            20 Guided Play-Along Lessons.<br>
                            Feedback From Real Teachers.<br>
                            Lifetime Course Access.
                        </strong></h3>
                    <div class="w-full mx-auto sm:mx-0">

                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Learn piano the easy & fun way.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Join {{ number_format($nPackOwners ?? 0) }} piano players who have already registered.</p>
                        <p class="leading-tight mb-2 sm:mb-3"><i class="fas fa-check text-pianote mr-1"></i> Click below to get started.</p>

                        <h1 class="inline-block mr-4 align-middle text-4xl sm:text-5xl">
                            @if($productPrices['new-piano-players-start-here']->price > $productPrices['new-piano-players-start-here']->discounted_price)
                                <s class="opacity-60">${{ floatval($productPrices['new-piano-players-start-here']->price) }}</s>
                            @endif
                            <strong>${{ floatval($productPrices['new-piano-players-start-here']->discounted_price) }}</strong></h1>

                            <a class="join medium w-1/2 align-middle" href="{{ $registerButtonUrl }}">Get Started</a>
                    </div>
                </div>
                <div class="flex w-full justify-center sm:justify-start sm:order-1 sm:w-5/12 xl:w-7/12 sm:pl-5 lg:pl-7  mt-10 sm:mt-0">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1800,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/collage.png" alt="collage">
                </div>
            </div>
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
                "desc" => "New Piano Players Start Here gives you guided daily piano lessons for thirty days – with a few flex days built in for when life happens. Each lesson is only 10 minutes. We’ve made it short so you’re more likely to keep playing!",
                "num" => '?',
                ])
                @include('_partials.components.question-dropdown', [
                "title" => "What devices can I access the course on?",
                "desc" => "New Piano Players Start Here is available on your laptop, tablet, or phone. You’ll also have access through the Musora App after you’ve completed your purchase of the course.",
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
        "video" => '//player.vimeo.com/video/798501810?autoplay=1',
        "title" => 'trailer'
    ])

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>


    <script>
        $(document).ready(function () {
            $(document).foundation();
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
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
