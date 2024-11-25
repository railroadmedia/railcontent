@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

    @hasSection('share-image')
        @yield('share-image')
    @else
        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/share-image-pianote2.webp ">
    @endif

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .tool:after, .tool:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .tool:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tool:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tool:hover, .tool:active, .tool:focus {
            z-index: 100;
        }
        .tool:hover:after, .tool:hover:before, .tool:active:after, .tool:active:before, .tool:focus:after, .tool:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #f61a30 !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }

        @if(!empty($trialVersion))
            .option-buttons.active {
            border-color:#f61a30!important;
            background-color:#4a0c12 !important;
        }
        .option-buttons.active .radio-check {
            border-color:#f61a30!important;
            background-color:#f61a30!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
        @endif
        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    demoVid : false,
    stepTwo : false,
    lazyLoad: false,
    videoLoaded: false,
    }'
@endsection

@section('global-body')
    @php
        $originalPrice = 240;
        $discountedPrice = 200;
    @endphp

    @include("pianote.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])
    <header class="text-center px-5 sm:px-6 py-16 sm:py-20 lg:py-28 relative overflow-hidden text-white bg-cover bg-center"
        style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/promos/august/header-bg.webp');">
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="h-8 sm:h-10 mb-3 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png">
            <br>
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 leading-none sm:leading-none lg:leading-none uppercase">
                <strong class="relative inline-block">EVERYTHING
                    <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path></svg>
                </strong>
                YOU NEED <br class="hidden sm:inline">
                TO LEARN PIANO.
            </h1>
            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                <i class="fas fa-check text-pianote"></i> Play-Along Lessons
                <i class="fas fa-check lg:ml-5 text-pianote"></i> Great Teachers
                <br class="sm:hidden">
                <i class="fas fa-check lg:ml-5 text-pianote"></i> Fun Practice
                <i class="fas fa-check ml-3 sm:ml-5 text-pianote"></i> Popular Songs
            </p>

            <a class="join smaller sold-out mb-2 sm:mb-0" aria-label="Customize anchor">SOLD OUT</a>
{{--            <a class="join smaller mb-2 sm:mb-0 anchor-slide" href="#customize-anchor" aria-label="Customize anchor">GET STARTED</a>--}}
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #344146;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative overflow-hidden " style="background: linear-gradient(180deg, #f4f0eb, #fff);">
        <div class="container max-w-3xl mx-auto relative z-20">
            <h2 class="leading-tight mb-4"><strong>The #1 struggle<br> new piano players face…</strong></h2>

            <p class="leading-tight"><u>…is not knowing what to practice.</u>
            <br><br>
            <strong>We fixed that.</strong>
                <br><br>
            Because your lessons ARE the practice sessions. Play with a real teacher in timed, short lessons so you’ll always know you’re doing the right thing at the right time.
                <br><br>
            All you have to do is press play and follow along.
                <br><br>
            <em class="text-pianote font-bold">Here’s how it works:</em></p>

            <h4 class="leading-tight text-pianote my-4"><i class="fas fa-arrow-down"></i></h4>

            <div class="bg-white rounded-xl border border-gray p-4 sm:p-6">
                <h5 class="uppercase text-pianote"><strong>Step 1</strong></h5>
                <p class="leading-tight my-5"><strong>Choose your course.</strong> You’ll find courses on pop music, chording, Blues, even improvisation. Choose the one you want to learn. For beginners, we recommend New Piano Players Start Here.</p>
                <div class="max-w-6xl mx-auto">
                    <div
                        x-data="{
                            init() {
                                new Splide(this.$refs.splide, {
                                    classes: {
                                            arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                            prev: 'splide__arrow--prev your-class-prev -left-1',
                                            next: 'splide__arrow--next your-class-next -right-1',
                                            pagination: 'splide__pagination flex -bottom-10',
                                    },
                                    padding: '3rem',
                                    perPage: 4,
                                    perMove: 1,
                                    type: 'loop',
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    breakpoints: {
                                        1020: {
                                            padding: '2rem',
                                        },
                                        768: {
                                            padding: '3rem',
                                            perPage: 3,
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                            padding: '1rem',
                                            perPage: 2,
                                            arrows: false,
                                        },
                                    },
                                }).mount()
                            },
                        }"
                    >
                        <section x-ref="splide" class="splide mb-20 sm:mb-10">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @php
                                        $packs = [
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/30TBT.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/NPPSH.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/EC.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/30DBP.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Classical-Piano.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Creative-Songwriting.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Gospel-Piano.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Improvisational-Jazz.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Latin-Piano-Essentials.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Rhythmic-Playing.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/Simple-Piano-Arpeggios.webp",
                                                ],
                                                [
                                                    "image" => "marketing/musora/membership/homepage/2024/packs/The-Perfect-Arrangement.webp",
                                                ],
                                        ]
                                    @endphp
                                    @foreach ($packs as $image)
                                        <li class="splide__slide flex flex-col items-center justify-start px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 150%;">
                                                <picture>
                                                    <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}">
                                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$image['image']}}">
                                                    <img
                                                        class="absolute top-0 left-0 w-full h-full object-cover object-top transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['image']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                    />
                                                </picture>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <h4 class="leading-tight text-pianote my-4"><i class="fas fa-arrow-down"></i></h4>

            <div class="bg-white rounded-xl border border-gray p-4 sm:p-6">
                <h5 class="uppercase text-pianote"><strong>Step 2</strong></h5>
                <p class="leading-tight my-5"><strong>Press play and follow along.</strong>  It’s that easy. You’ll learn by playing WITH a real teacher. The sessions are short, focused, and most of all – fun! Each day you’ll unlock a new lesson. Give it a try!</p>
                <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                    x-on:click="stepTwo = true;">
                    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                        x-ref="playToLearnVideo"
                        x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                        x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                        data-src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/promos/august/step2.mp4" type="video/mp4" autoplay muted loop playsinline></video>
                </div>
            </div>

            <h4 class="leading-tight text-pianote my-4"><i class="fas fa-arrow-down"></i></h4>

            <h5 class="uppercase text-pianote"><strong>Step 3</strong></h5>
            <p class="leading-tight my-5 px-6"><strong>Hear the result.</strong> The most important part of learning piano is building a daily habit. By practicing just a little bit each day, you’ll hear the results sooner (so will everyone else!).</p>
        </div>
        <div class="container max-w-5xl mx-auto">
            <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2050x0/filters:quality(95)/marketing/pianote/promos/august/step3.png">
        </div>
    </section>
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative overflow-hidden ">
        <div class="container max-w-4xl mx-auto relative z-20">
            <div class="flex flex-wrap sm:flex-nowrap items-start">
                <picture class="w-full sm:w-auto flex-shrink">
                    <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/promos/august/coach-profile.webp">
                    <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/promos/august/coach-profile.webp">
                    <img
                        class="border-8 border-white shadow-lg rounded-xl mb-5 sm:mb-0 transition-opacity opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/august/coach-profile-m.png"
                        alt="grid"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </picture>
               <div class="w-full sm:w-7/12 flex-shrink-0 sm:pl-4 lg:pl-10">
                   <h5 class="uppercase text-pianote font-black">At Pianote, it’s all about YOU!</h5>
                   <h2 class="leading-tight my-4"><strong>Hi, I’m Lisa,</strong></h2>
                   <p class="leading-tight">the lead instructor at Pianote.
                       <br><br>
                       And if there’s one thing I’ve learned in my 20+ years of teaching, it’s this…
                       <br><br>
                       <strong>There’s no “one size fits all” approach to learning the piano.</strong>
                       <br><br>
                       While gamified apps are a fun way to get started, you need a teacher to help you reach your goals on this instrument (whatever they are).
                       <br><br>
                       At Pianote, we understand not everyone wants to be a classical pianist or professional musician. Most just want to have fun and play the music they enjoy.
                       <br><br>
                       <strong>We make that easy.</strong>
                       <br><br>
                       If you want to play rock, we won’t make you learn Beethoven first. If you want to play pop, you don’t need to read music fluently. And if you want to play classical, jazz, gospel, or more…
                       <br><br>
                       <strong> We’ve got world-class pianists to guide you every step of the way.</strong>
                       <br><br>
                       And if you need help, support, or even just a bit of encouragement, you can work with REAL teachers and an incredibly supportive community.
                       <br><br>
                       You don’t get that from an app.
                       <br><br>
                       Come and see why Pianote is the Ultimate Mix of Technology and Tradition.</p>
               </div>
           </div>
        </div>
    </section>

    <section class="text-center text-white pt-6 sm:pt-10 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/promos/august/tablet-demo-bg.webp');">
        <div class="mb-3">
            <img class="h-6 sm:h-7  mr-2 " src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png " alt="pianote logo" fetchpriority="high">

            <div class="inline-block align-middle h-4 sm:h-5" alt="songs logo" fetchpriority="high">
                <style>.fill-logo {fill:#f61a30}</style>
                <svg class="fill-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="100%" height="100%" viewBox="0 0 278 64" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                    <g transform="matrix(1,0,0,1,-431.057,-536.414)">
                        <g transform="matrix(1,0,0,0.998667,2.13971,0)">
                            <g transform="matrix(0.6548,0,0,0.655674,-247.695,226.047)">
                                <path d="M1056.19,540.313L1033.31,540.313C1032.78,581.049 1108.17,580.387 1108.17,541.503C1108.17,518.358 1090.18,515.581 1071.8,513.597C1063.47,512.671 1056.59,511.216 1057.12,504.207C1057.91,493.229 1082.78,492.171 1082.78,504.471L1105.26,504.471C1105.79,464.529 1033.84,464.529 1034.64,504.471C1034.9,524.574 1048.13,531.452 1068.23,532.907C1077.49,533.436 1085.16,534.891 1085.16,541.371C1085.16,552.216 1056.19,552.084 1056.19,540.313ZM1405.09,540.313L1382.21,540.313C1381.68,581.049 1457.07,580.387 1457.07,541.503C1457.07,518.358 1439.08,515.581 1420.7,513.597C1412.37,512.671 1405.49,511.216 1406.02,504.207C1406.81,493.229 1431.68,492.171 1431.68,504.471L1454.16,504.471C1454.69,464.529 1382.74,464.529 1383.53,504.471C1383.8,524.574 1397.02,531.452 1417.13,532.907C1426.39,533.436 1434.06,534.891 1434.06,541.371C1434.06,552.216 1405.09,552.084 1405.09,540.313ZM1204.19,522.458C1204.19,490.452 1180.45,474.448 1156.71,474.448C1132.97,474.448 1109.23,490.452 1109.23,522.458C1109.23,586.604 1204.19,586.604 1204.19,522.458ZM1290.42,522.326C1290.56,553.936 1314.36,569.674 1337.9,569.674C1354.97,569.674 1372.56,562.268 1379.17,542.958C1382.34,533.965 1382.34,525.103 1381.82,515.845L1338.04,515.845L1338.04,536.345L1357.74,536.345C1353.51,545.207 1347.43,547.72 1337.9,547.72C1323.88,547.72 1314.89,537.668 1314.89,522.326C1314.89,508.174 1322.96,496.536 1337.9,496.536C1347.3,496.536 1353.38,499.71 1357.21,507.645L1380.49,507.645C1376,484.632 1356.55,474.977 1337.9,474.845C1314.36,474.845 1290.56,490.716 1290.42,522.326ZM1278.65,568.749L1287.12,568.749L1287.12,476.035L1262.91,476.035L1262.91,521.4L1216.1,475.639L1207.5,475.639L1207.5,568.616L1231.97,568.616L1231.97,523.12L1278.65,568.749ZM1133.57,522.458C1133.57,505.794 1145.17,497.461 1156.78,497.461C1168.38,497.461 1179.99,505.794 1179.99,522.458C1179.99,556.052 1133.57,556.052 1133.57,522.458Z" style="fill-rule:nonzero;"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
        </div>
        <h2 class="leading-tight mb-4 sm:mb-6">Other apps show you the notes.<br> <strong>We teach you how to play them.</strong></h2>
        <p class="leading-tight max-w-lg mx-auto mb-9">Video lessons from REAL teachers will guide you through the music you want to play. You’ll learn faster, and have more fun!
            <br><br>
            <strong>Want to try it? Click below!</strong></p>
        <div class="relative cursor-pointer autoplay-video" x-on:click="demoVid = true;">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/august/tablet-demo-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/pianote/promos/august/tablet-demo.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </div>
    </section>


    <section class="px-5 sm:px-6 py-12 sm:py-16 relative text-white" style="background-color:#01050f;">
        <div class="container max-w-5xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $features = [
                                [
                                "icon" => "fa-circle-play",
                                "title" => "Detailed Tutorials",
                                "desc" => "Don’t just follow along. Get guided lessons from REAL teachers.",
                                ],
                                [
                                "icon" => "fa-rectangle-vertical-history",
                                "title" => "Huge Library",
                                "desc" => "From classical to pop, you’ll find your favorites here.",
                                ],
                                [
                                "icon" => "fa-gauge",
                                "title" => "Slow It Down",
                                "desc" => "Change the tempo. Practice at YOUR pace. See amazing results.",
                                ],
                                [
                                "icon" => "fa-arrows-repeat",
                                "title" => "Loop It Back",
                                "desc" => "Stuck on a section? Loop it over and over until you’ve got it.",
                                ],
                                [
                                "icon" => "fa-comment-dollar",
                                "title" => "No Extra Fees",
                                "desc" => "Some platforms charge you per song. Not us. It’s all included.",
                                ],
                                [
                                "icon" => "fa-handshake-angle",
                                "title" => "Personal Support",
                                "desc" => "Got questions? Ask our teachers and get a personal response.",
                                ]
                            ];
                @endphp
                @foreach($features as $feature)
                    <div class="flex items-start">
                        <h3 class="w-10 text-center"><i class="fal {{ $feature['icon'] }} text-pianote"></i></h3>
                        <div class="pl-4">
                            <h6 class="leading-tight font-black mb-1">{{ $feature['title'] }}</h6>
                            <p class="leading-tight">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-10 lg:py-12 relative overflow-hidden text-center px-5 lg:px-8 relative overflow-hidden">
        <div class="container mx-auto max-w-4xl">
            <h2 class="leading-tight"><strong>Practice Better. PLAY Better.</strong></h2>
            <p class="leading-tight text-pianote font-bold mt-2 mb-5"><em>Essential tools to maximize your practice time and improve your playing.</em></p>

            <p class="max-w-2xl mx-auto leading-tight mb-10 sm:mb-12">They say practice makes perfect.
            <br><br>
            It’s a cliche – and it’s not entirely true. Because if you’re not practicing the RIGHT things – the RIGHT way...
                <br><br>
            You could be wasting your time.
                <br><br>
            That’s why when you join Pianote this month, you’ll get the Ultimate Practice Bundle (valued at $380) to help you make the most of your practice time and get the best results.
                <br><br>
                <em><strong>Take a look at your bonuses… Join today and you’ll get all of these.</strong></em></p>

            @php
                $bonuses = [
                    [
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/may/annual.png',
                        'description' => "Level up your skills with Pianote - the world's best lessons, teachers, and practice tools trusted by thousands of active students.",
                        'price' => '240',
                        'customText' => '$200',
                        'customSubText' => 'true'
                    ],
                    [
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/august/practicekit-card.webp',
                        'description' => 'You’ll find a Piano Key Overlay so you can remember all the note names, pencils, erasers, sticky notes, highlighters, and more.',
                        'price' => floatval($productPrices['practice-kit']->price),
                        'shipping' => true,
                    ],
                    [
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/august/practice-planner-card.webp',
                        'description' => 'Outline your week and then stick to it. It’s that simple.',
                        'price' => floatval($productPrices['pianote-practice-planner']->price),
                        'shipping' => true,
                    ],
                    [
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/august/music-theory-card.webp',
                        'description' => 'Upgrade your practice space and master your music theory with this gorgeous poster bundle.',
                        'price' => floatval($productPrices['music-theory-posters']->price),
                        'shipping' => true,
                    ],
                    [
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/august/chords-scales-card.webp',
                        'description' => 'Every major, minor, sus, and 7th chord as well as all the scales you’ll need to play the songs you love without fear.',
                        'price' => floatval($productPrices['digital-chords-scales-guide']->price),
                    ],
                    [
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/august/RMI30D-card.webp',
                        'description' => 'Learn by DOING, playing a little bit each day with Lisa as you connect the notes on the page to the keys on your piano.',
                        'price' => floatval($productPrices['read-music-in-30-days']->price),
                    ],
                    [
                        'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/fb81d171-6ee7-46bb-bd5e-b29de32766c5-NPPSH-card.jpg',
                        'description' => 'This 30-day challenge will help you come back to the keys with confidence and feel excited to play your piano every day.',
                        'price' => floatval($productPrices['new-piano-players-start-here']->price),
                    ],
                ]
            @endphp
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:flex items-center mb-12 lg:mb-16">
                    <div class="relative flex-shrink-0">
                        <img class="h-48 sm:h-60 lg:h-64 mb-4 sm:mb-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/august/practicekit-m.webp">
                    </div>
                    <div class="sm:pl-5 lg:pl-10">
                        <img class="h-14 sm:h-16 lg:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/august/practicekit-logo.webp">
                        <h5 class="leading-tight my-4"><s class="opacity-60">WAS ${{ $bonuses[1]['price'] }}</s> <span class="font-black text-pianote">FREE</span></h5>
                        <p class="leading-normal">The quality of your practice will determine the quality of your playing. And this kit is LOADED with tools to help you get the most out of your valuable practice time. You’ll find a Piano Key Overlay so you can remember all the note names, pencils, erasers, sticky notes, highlighters, and more.</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center mb-12 lg:mb-16">
                    <div class="relative flex-shrink-0 sm:order-1">
                        <img class="h-48 sm:h-60 lg:h-64 mb-4 sm:mb-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/august/planner-m.webp">
                    </div>
                    <div class="sm:pr-5 lg:pr-10">
                        <img class="h-14 sm:h-16 lg:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/august/pianote-planner-logo.webp">
                        <h5 class="leading-tight my-4"><s class="opacity-60">WAS ${{ $bonuses[2]['price'] }}</s> <span class="font-black text-pianote">FREE</span></h5>
                        <p class="leading-normal">Fail to plan, and plan to fail. The Pianote Practice Planner is your “secret weapon” to making progress on the keys. Outline your week and then stick to it. It’s that simple. And you can work with a Pianote Mentor to create a plan that fits your goals.</p>

                    </div>
                </div>
                <div class="w-full sm:flex items-center mb-12 lg:mb-16">
                    <div class="relative flex-shrink-0">
                        <img class="h-48 sm:h-60 lg:h-64 mb-4 sm:mb-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/august/music-theory-posters-m.webp">
                    </div>
                    <div class="sm:pl-5 lg:pl-10">
                        <img class="h-14 sm:h-16 lg:h-20" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/music-theory-logo.png">
                        <h5 class="leading-tight my-4"><s class="opacity-60">WAS ${{ $bonuses[3]['price'] }}</s> <span class="font-black text-pianote">FREE</span></h5>
                        <p class="leading-normal">Upgrade your practice space and master your music theory with this gorgeous poster bundle. Shipped flat so there are no creases and printed in full color on beautiful paper stock, these posters will help you connect the notes on the page to the keys on your piano.</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center mb-12 lg:mb-16">
                    <div class="relative flex-shrink-0 sm:order-1">
                        <img class="h-48 sm:h-60 lg:h-64 mb-4 sm:mb-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/august/chords-scales-digital-m.webp">
                    </div>
                    <div class="sm:pr-5 lg:pr-10">
                        <img class="h-14 sm:h-16 lg:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/december/chords-and-scales-digital-logo2.png">
                        <h5 class="leading-tight my-4"><s class="opacity-60">WAS ${{ $bonuses[4]['price'] }}</s> <span class="font-black text-pianote">FREE</span></h5>
                        <p class="leading-normal">This is your digital encyclopedia of piano chords & scales. Inside this 174-page e-book, you’ll find every major, minor, sus, and 7th chord as well as all the scales you’ll need to play the songs you love without fear. And it’s all arranged by key, so it’s super easy to navigate.</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center mb-12 lg:mb-16">
                    <div class="relative flex-shrink-0">
                        <img class="h-48 sm:h-60 lg:h-64 mb-4 sm:mb-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/august/RMI30D-bg-m.webp">
                    </div>
                    <div class="sm:pl-5 lg:pl-10">
                        <img class="h-14 sm:h-16 lg:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/august/RMI30D-logo.webp">
                        <h5 class="leading-tight my-4"><s class="opacity-60">WAS ${{ $bonuses[5]['price'] }}</s> <span class="font-black text-pianote">FREE</span></h5>
                        <p class="leading-normal">Have you always wanted to read music, but struggled to learn? This 30-day challenge will de-mystify the language of music so you can read and play the songs you love. You’ll learn by DOING, playing a little bit each day with Lisa as you connect the notes on the page to the keys on your piano.</p>

                    </div>
                </div>
                <div class="w-full sm:flex items-center">
                    <div class="relative flex-shrink-0 sm:order-1">
                        <img class="h-48 sm:h-60 lg:h-64 mb-4 sm:mb-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/august/NPPSH-bg-m.webp">
                    </div>
                    <div class="sm:pr-5 lg:pr-10">
                        <img class="h-14 sm:h-16 lg:h-20" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/nppsh-logo.png">
                        <h5 class="leading-tight my-4"><s class="opacity-60">WAS ${{ $bonuses[6]['price'] }}</s> <span class="font-black text-pianote">FREE</span></h5>
                        <p class="leading-normal">Your first 30 days on the piano. This 30-day challenge will help you come back to the keys with confidence and feel excited to play your piano every day. Simply follow along with Lisa for 10 minutes a day. You’ll have lifetime access to this course.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $testimonials = $pianote['testimonials'];
        $youtube = convertNumber(Prices::$pianoteYoutubeSubsc);
        $facebook = convertNumber(Prices::$pianoteFacebookLikes);
        $instagram = convertNumber(Prices::$pianoteInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'pianists',
        'youtubeLink' => 'https://www.youtube.com/pianolessonscom/',
        'facebookLink' => 'https://facebook.com/pianoteofficial/',
        'instagramLink' => 'https://instagram.com/pianoteofficial/',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @php
            $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[practice-kit]=1&products[pianote-practice-planner]=1&products[music-theory-posters]=1&products[digital-chords-scales-guide]=1&products[read-music-in-30-days]=1&products[new-piano-players-start-here]=1&redirect=/order&promo-code=special&locked=true';
            $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[digital-chords-scales-guide]=1&products[read-music-in-30-days]=1&products[new-piano-players-start-here]=1&redirect=/order&promo-code=special&locked=true'
    @endphp
    <div style="background: linear-gradient(0deg, #FFF, #F4F0EB);">
        <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-center customize px-4 lg:px-6">
            <div class="container mx-auto relative z-50  max-w-4xl ">

                <img class="h-8 sm:h-10 mb-3 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png">
                <br>
                <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 leading-none sm:leading-none lg:leading-none uppercase">
                    <strong class="relative inline-block">EVERYTHING
                        <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path></svg>
                    </strong>
                    YOU NEED <br class="hidden sm:inline">
                    TO LEARN PIANO.
                </h1>
                <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                    <i class="fas fa-check text-pianote"></i> Play-Along Lessons
                    <i class="fas fa-check lg:ml-5 text-pianote"></i> Great Teachers
                    <br class="sm:hidden">
                    <i class="fas fa-check lg:ml-5 text-pianote"></i> Fun Practice
                    <i class="fas fa-check ml-3 sm:ml-5 text-pianote"></i> Popular Songs
                </p>

                <h2 class="leading-tight mt-6 mb-1">
                    <s class="opacity-50">${{$originalPrice}}</s> <strong>${{$discountedPrice}}</strong>
                </h2>
                <p class="mb-4 sm:mb-6"><strong class="text-pianote">Save {{ round(100 - (100 * (floatval($discountedPrice) / floatval($originalPrice)))) }}%</strong> for your first year. Renews at $240/yr.</p>

{{--                    <a class="join" href="{{ $buttonLink }}" aria-label="Customize anchor">GET STARTED</a>--}}
                <br>
{{--                <h2 class="leading-tight my-6"><strong>Join Pianote and get:</strong></h2>--}}
{{--                <div style="font-size:0px">--}}
{{--                    @foreach($bonuses as $bonus)--}}
{{--                        <div--}}
{{--                            class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 @endif"--}}
{{--                            x-data="{--}}
{{--                        flipped: false,--}}
{{--                    }"--}}
{{--                            x-on:click="--}}
{{--                        flipped = !flipped;--}}
{{--                        if(flipped){--}}
{{--                            $refs.front.classList.add('rotate-y-180');--}}
{{--                            $refs.back.classList.remove('-rotate-y-180');--}}
{{--                            $refs.back.classList.add('rotate-y-0');--}}
{{--                        }--}}
{{--                        else {--}}
{{--                            $refs.front.classList.remove('rotate-y-180');--}}
{{--                            $refs.back.classList.add('-rotate-y-180');--}}
{{--                            $refs.back.classList.remove('rotate-y-0');--}}
{{--                        }--}}
{{--                    "--}}
{{--                        >--}}
{{--                            <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">--}}
{{--                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">--}}
{{--                                    <div--}}
{{--                                        x-ref="front"--}}
{{--                                        class="border-2 border-pianote front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"--}}
{{--                                        style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">--}}
{{--                                        @if(!empty($bonus['badge']))--}}
{{--                                            <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>--}}
{{--                                        @endif--}}
{{--                                        <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"--}}
{{--                                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"--}}
{{--                                            x-intersect.once="lazyLoad = true">--}}
{{--                                            <picture class="absolute inset-0 w-full h-full object-cover">--}}
{{--                                                <img src="{{ $bonus['image'] }}"--}}
{{--                                                    alt="Bonus Image"--}}
{{--                                                    class="w-full h-full object-cover opacity-0 transition-opacity"--}}
{{--                                                    loading="lazy"--}}
{{--                                                    onload="this.classList.remove('opacity-0')">--}}
{{--                                            </picture>--}}
{{--                                        </div>--}}
{{--                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">--}}
{{--                                            <i class="fas fa-arrow-right text-4xl"></i><br>--}}
{{--                                            <p class="text-sm"><strong>DETAILS</strong></p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div--}}
{{--                                        x-ref="back"--}}
{{--                                        class="back border-2 border-pianote absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"--}}
{{--                                        style="backface-visibility: hidden;"--}}
{{--                                    >--}}
{{--                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">--}}
{{--                                            <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <p class="w-full leading-normal mt-2">--}}
{{--                                <span style="display:inline-block;">--}}
{{--                            @if(!empty($bonus['price']))--}}
{{--                                        <s class="opacity-40">${{ $bonus['price'] }}</s>--}}
{{--                                    @endif--}}
{{--                                    @if(!empty($bonus['customText']))--}}
{{--                                        <strong class="text-pianote">{{ $bonus['customText'] }}</strong>--}}
{{--                                    @else--}}
{{--                                        <strong class="text-pianote">FREE</strong>--}}
{{--                                    @endif--}}
{{--                                <br>--}}
{{--                                <em>--}}
{{--                                    @if(!empty($bonus['shipping']))--}}
{{--                                        Free Bonus--}}
{{--                                    @elseif(!empty($bonus['customSubText']))--}}
{{--                                        Save {{ round(100 - (100 * (floatval($discountedPrice) / floatval($originalPrice)))) }}%--}}
{{--                                    @else--}}
{{--                                        Online Access--}}
{{--                                    @endif--}}
{{--                                </em>--}}
{{--                            </span>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

                                <a class="join sold-out mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" >SOLD OUT</a>
{{--                                <a class="join mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET STARTED</a>--}}
                <br>
{{--                                <a role="link" class="inline-block mt-2" aria-label="Start a monthly membership" href="{{ $buttonLink2 }}">--}}
{{--                                    <p><u><em><strong>Trying to avoid VAT fees on physical items?</strong> Click here to just grab<br class="hidden sm:inline">  your discounted membership + 3 free digital bonuses.</em></u></p></a>--}}
            </div>
        </section>
    </div>

    <section class="content-section text-center" style="background: #000;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-white">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-white" style="margin-top: 0;">
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
        'video' => '998782491',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'stepTwo',
        'video' => '802011057',
        'vimeo' => true,
    ])

        @include("pianote.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@endsection
