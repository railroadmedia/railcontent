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

        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/share-image-pianote2.webp ">

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


        table.comparison tr:hover, table.comparison tr:nth-child(even):hover {
            background-color: #f2f5fa;
        }
        table.comparison tr:hover td:nth-child(2), table.comparison tr:nth-child(even):hover td:nth-child(2) {
            background: linear-gradient(to right, #F61A30, #A10000);
        }
        table.comparison tr:hover td:nth-child(3),
        table.comparison tr:nth-child(even):hover td:nth-child(3),
        table.comparison tr:hover td:nth-child(4),
        table.comparison tr:nth-child(even):hover td:nth-child(4) {
            background-color: #f6f8fb;
        }
        table.comparison tr td {
            padding: 10px 7px;
            font: 400 12px/1.2em 'Open Sans', sans-serif;
        }
        @media (min-width: 768px) {
            table.comparison tr td {
                font-size: 14px;
                padding: 20px 10px;
            }
        }
        table.comparison tr td:nth-child(1) {
            text-align: right;
            font-weight: 900;
        }
        table.comparison tr td:nth-child(2) {
            color: #fff;
            background: linear-gradient(to right, #F61A30, #A10000);
            text-shadow: 1px 1px 0 #A10000;
        }
        table.comparison tr td:nth-child(3),
        table.comparison tr td:nth-child(4) {
            background-color: #f2f5fa;
        }
        table.comparison tr td:nth-child(2),
        table.comparison tr td:nth-child(3),
        table.comparison tr td:nth-child(4) {
            width: 45%;
        }
        @media (min-width: 768px) {
            table.comparison tr td:nth-child(2),
            table.comparison tr td:nth-child(3),
            table.comparison tr td:nth-child(4) {
                width: 28%;
            }
        }
        table.comparison tr:nth-child(1) td {
            border-width: 0 0 2px;
            border-color: #fff;
            padding: 18px 0;
        }
        @media (min-width: 768px) {
            table.comparison tr:nth-child(1) td {
                font-size: 17px;
                padding: 18px 10px;
            }
        }
        @media (min-width: 1024px) {
            table.comparison tr:nth-child(1) td {
                font-size: 19px;
            }
        }
        table.comparison tr:last-child td {
            padding: 14px 10px;
        }
        @media (min-width: 768px) {
            table.comparison tr:last-child td {
                padding: 25px 10px;
            }
        }
        table.comparison tr:last-child td strong {
            font-size: 19px;
        }
        @media (min-width: 768px) {
            table.comparison tr:last-child td strong {
                font-size: 22px;
            }
        }
        table.comparison.private tr td:nth-child(3) {
            display: table-cell;
        }
        table.comparison.private tr td:nth-child(4) {
            display: none;
        }
        @media (min-width: 768px) {
            table.comparison.private tr td:nth-child(4) {
                display: table-cell;
            }
        }
        table.comparison.online tr td:nth-child(4) {
            display: table-cell;
        }
        table.comparison.online tr td:nth-child(3) {
            display: none;
        }
        @media (min-width: 768px) {
            table.comparison.online tr td:nth-child(3) {
                display: table-cell;
            }
        }

        /* column-oriented masonry layout */
        .masonry {
            column-count: 1;
            column-gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .masonry {
                column-count: 2;
            }
        }

        @media (min-width: 1024px) {
            .masonry {
                column-count: 3;
            }
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 1rem;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    headphones : false,
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
    <header class="text-center px-5 sm:px-6 py-16 sm:py-20 lg:py-28 relative overflow-hidden text-white bg-cover bg-center relative z-10"
        style="background: linear-gradient(to left, #9F3E77, #B31A1D);">
        <div class="container max-w-6xl mx-auto relative z-20">
            <h6 class="text-musora uppercase tracking-widest font-bold leading-none  mb-3 sm:mb-4">BEAUTIFUL BEGINNER BUNDLE</h6>
            <h2 class="relative w-auto inline-block mb-7 sm:mb-10 leading-tight font-black">
                Get 1 year of unlimited piano lessons<br class="hidden sm:inline">

                <span class="relative inline-block"> plus $450 worth
                    <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#ffae00" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#ffae00" stroke-width="3" stroke-linecap="round"></path></svg>
                </span>
                <br class="sm:hidden">of FREE bonuses
            </h2>
            <p class="text-sm leading-normal mb-5 lg:mb-7">
                <i class="fas fa-check text-musora"></i> Perfectly-structured curriculum
                <br class="sm:hidden">
                <i class="fas fa-check sm:ml-5 text-musora"></i> Designed for beginners
                <br class="lg:hidden">
                <i class="fas fa-check sm:ml-5 text-musora"></i> Note-by-note instruction
                <br class="sm:hidden">
                <i class="fas fa-check ml-3 sm:ml-5 text-musora"></i> Personalized support from real teachers
            </p>

            <a class="join smaller sold-out mb-2 sm:mb-0" aria-label="Customize anchor">SOLD OUT</a>
{{--            <a class="join smaller mb-2 sm:mb-0 anchor-slide" href="#customize-anchor" aria-label="Customize anchor">GET THE BUNDLE</a>--}}
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #aa2943;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #aa2943;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #aa2943;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #aa2943;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
    </header>

{{--    <div class="sticky-trigger block"></div>--}}
{{--    <a href="#customize-anchor"--}}
{{--        class="promo-banner flex text-white text-center items-center justify-center -mt-12 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"--}}
{{--        style="background: #091F30;">--}}
{{--        <p class="inline-block mx-0 text-sm leading-tight uppercase">--}}
{{--            <strong class="text-musora">SAVE 70% OFFER ENDS IN:</strong>--}}
{{--                <br>--}}
{{--            <span x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                <span x-cloak x-show="timeLeft < 0">A Limited Time</span>--}}
{{--            </span>--}}
{{--        </p>--}}
{{--    </a>--}}

    <section class="text-center px-5 sm:px-6 pb-12 sm:pb-16 lg:pb-20 " style="background: linear-gradient(180deg, #f4f0eb, #fff);">
        <div class="pt-4 md:pt-0">
            <div class="container max-w-4xl mx-auto mb-20 -mt-10 md:-mt-14 lg:-mt-16 z-20 relative">
                <div class="px-5 lg:px-0">
                    <div class="flex flex-wrap sm:flex-nowrap text-center shadow-xl rounded-xl relative" style="background:linear-gradient(to bottom, #fff, #F1F7FE);">
                        <div class="z-10 flex flex-wrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-6 lg:px-5 text-left sm:text-center">
                            <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 border-r border-gray-300">
                                <i class="far fa-fw mr-3 sm:mr-0 fa-light fa-user-group text-pianote text-xl" aria-hidden="true"></i>
                                <div class="flex flex-col items-left text-left sm:text-center">
                                    <h4 class="mx-0"><strong>{{ number_format(Prices::$students) }}</strong></h4>
                                    <p class="leading-tight mx-0 text-sm">Active students</p>
                                </div>
                            </div>
                            <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 border-r border-gray-300">
                                <i class="fab fa-fw mr-3 sm:mr-0 fa-youtube text-pianote text-xl" aria-hidden="true"></i>
                                <div class="flex flex-col items-left text-left sm:text-center">
                                    <h4 class="mx-0"><strong class="font-black">{{ convertNumber(Prices::$pianoteYoutubeSubsc) }}</strong></h4>
                                    <p class="leading-tight mx-0 text-sm">YouTube subscribers</p>
                                </div>
                            </div>
                            <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 border-r border-gray-300">
                                <i class="far fa-fw mr-3 sm:mr-0 fa-piano-keyboard text-pianote text-xl" aria-hidden="true"></i>
                                <div class="flex flex-col items-left text-left sm:text-center">
                                    <h4 class="mx-0"><strong class="font-black">4.8/5</strong></h4>
                                    <p class="leading-tight mx-0 text-sm">Student reviews</p>
                                </div>
                            </div>
                            <div class="flex sm:block w-full sm:w-1/4 px-4 sm:px-0 mb-4 sm:mb-0 ">
                                <i class="far fa-fw mr-3 sm:mr-0 fa-star text-pianote text-xl" aria-hidden="true"></i>
                                <div class="flex flex-col items-left text-left sm:text-center">
                                    <h4 class="mx-0"><strong class="font-black">World-class</strong></h4>
                                    <p class="leading-tight mx-0 text-sm">Instructors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container max-w-3xl mx-auto relative z-20 overflow-hidden">
            <h2 class="leading-tight mb-4"><strong>The <u style="text-decoration-color: #F61A30;">easiest</u> way to<br> learn piano online</strong></h2>

            <p class="leading-tight">No more guesswork. Because we’ve got it all mapped out for you.
                <br><br>
                All you have to do is press play and follow along.
                <br><br>
                <strong class="font-black text-pianote">Here’s how it works.</strong></p>

            <h4 class="leading-tight text-pianote my-4"><i class="fas fa-arrow-down"></i></h4>

            <div class="bg-white rounded-xl border border-gray p-4 sm:p-6">
                <h5 class="leading-tight"><strong><span class="text-pianote">STEP 1.</span><br>Pick your jam.</strong></h5>
                <p class="leading-tight my-5">Pop, classical, blues, chording, fingering—whatever sparks your interest, we’ve got it. Dive into hundreds of topics and pick the one that gets you excited to hit the keys.
                    <br><br>
                    Not sure where to start?<br>
                    Check out New Piano Players Start Here—the perfect course for beginners to start strong and build confidence from day one.</p>
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
                <h5 class="leading-tight"><strong><span class="text-pianote">STEP 2.</span><br>Press play and follow along.</strong></h5>
                <p class="leading-tight my-5">Learn by PLAYING with a real teacher.<br>
                    The sessions are short, focused, most of all – fun! Each day you’ll unlock a new lesson.</p>
                <img class="w-full rounded-xl cursor-pointer autoplay-video" x-on:click="stepTwo = true;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2050x0/filters:quality(95)/marketing/pianote/promos/october/step2.webp">
{{--                <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"--}}
{{--                    x-on:click="stepTwo = true;">--}}
{{--                    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"--}}
{{--                        x-ref="playToLearnVideo"--}}
{{--                        x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"--}}
{{--                        x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"--}}
{{--                        data-src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/promos/august/step2.mp4" type="video/mp4" autoplay muted loop playsinline></video>--}}
{{--                </div>--}}
            </div>

            <h4 class="leading-tight text-pianote my-4"><i class="fas fa-arrow-down"></i></h4>

            <h5 class="leading-tight"><strong><span class="text-pianote">STEP 3.</span><br>Hear the results. Way faster.</strong></h5>
            <p class="leading-tight my-5 px-6">The most important part of learning piano is building a daily habit. Practice a little each day, and you’ll be hearing the results way sooner (and so will everyone around you!).</p>
        </div>
        <div class="container max-w-5xl mx-auto">
            <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2050x0/filters:quality(95)/marketing/pianote/promos/october/step3.webp">
        </div>
    </section>

    <section class="text-center text-white pt-6 sm:pt-10 lg:pt-20 bg-cover bg-center" style="background-color:#591513;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/promos/october/piano-bg.webp');">
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
        <h2 class="leading-tight mb-4 sm:mb-6">Other apps show you the notes.<br> <strong>We teach you how to <u style="text-decoration-color: #F61A30;">play</u> them.</strong></h2>
        <p class="leading-normal max-w-3xl mx-auto mb-9">Sure, apps can give you the notes.<br>
            But REAL teachers at Pianote show you how to bring them to life. We’re talking about<br>
            finger placement, posture, technique, pedal timing—the stuff no algorithm can ever truly teach.<br>
            <strong>Ready to experience a real lesson? <span class="text-pianote">Click below and give it a try!</span></strong></p>
        <div class="relative cursor-pointer autoplay-video" x-on:click="demoVid = true;">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/august/tablet-demo-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/pianote/promos/august/tablet-demo.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </div>
    </section>


    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative text-white text-center" style="background: linear-gradient(258deg, #9F3E77 1.12%, #B31A1D 99.64%);">
        <div class="container max-w-5xl mx-auto">
            <h3 class="leading-tight mb-7 sm:mb-12"><strong>You’re here because you want to play the music that inspires you <br class="hidden sm:inline"> and we’re here to <u style="text-decoration-color: #FFAC00;">make that happen.</u></strong></h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
                @php
                    $features = [
                                [
                                "icon" => "fa-circle-play",
                                "title" => "No more guesswork",
                                "desc" => "Should I use my thumb or index finger? Get step-by-step guidance for every single note and more.",
                                ],
                                [
                                "icon" => "fa-rectangle-vertical-history",
                                "title" => "Huge Library",
                                "desc" => "From Beethoven to Elton John, whatever your jam is, you’ll find it here in our song library.",
                                ],
                                [
                                "icon" => "fa-gauge",
                                "title" => "Set YOUR perfect tempo.",
                                "desc" => "Slow it down, speed it up, or loop a section until it’s perfect. Practice at your own pace.",
                                ],
                                [
                                "icon" => "fa-comment-dollar",
                                "title" => "No sneaky fees",
                                "desc" => "Some platforms charge you per song. Not us. It’s all included.",
                                ],
                                [
                                "icon" => "fa-circle-play",
                                "title" => "Weekly Livestreams",
                                "desc" => "Learn fresh tips and tricks while hanging out with your teachers and fellow students in real-time.",
                                ],
                                [
                                "icon" => "fa-handshake-angle",
                                "title" => "Personalized 1:1 support",
                                "desc" => "YouTubers ghosting you? We don’t. Ask our teachers and get personalized help whenever you need it.",
                                ]
                            ];
                @endphp
                @foreach($features as $feature)
                    <div class="flex items-start">
                        <h3 class="w-10 text-center"><i class="fal {{ $feature['icon'] }} text-musora"></i></h3>
                        <div class="pl-4">
                            <h6 class="leading-tight font-black mb-1">{{ $feature['title'] }}</h6>
                            <p class="leading-tight">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="coaches" class="anchor"></div>
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative text-center" style="">
        <p class="leading-tight mx-auto font-black text-pianote uppercase"> Meet your instructors</p>
        <h2 class="leading-tight font-extrabold mt-1">Learn from world-class teachers.</h2>
        <div class="md:pb-56 lg:pb-80 relative my-7">
            <section class="max-w-6xl mx-auto px-4 lg:px-6 mb-6 md:mb-0 md:absolute md:inset-0">
                <div
                        x-data="{
                        init() {
                            new Splide(this.$refs.splide, {
                                classes: {
                                        arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                        prev: 'splide__arrow--prev your-class-prev hidden sm:flex -left-1',
                                        next: 'splide__arrow--next your-class-next hidden sm:flex -right-1',
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
                                    720: {
                                        padding: '3rem',
                                        perPage: 3,
                                        drag   : 'free',
                                        snap   : false,
                                    },
                                    620: {
                                        padding: '1rem',
                                        perPage: 2,
                                    },
                                },
                            }).mount()
                        },
                    }"
                >
                    <section x-ref="splide" class="splide mb-20 h-44 sm:h-48 lg:h-72">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @php
                                    $courses = [

                                        [
                                        'img' => 'marketing/pianote/membership/homepage/2024/coaches/7-days-to-sight-reading.webp',
                                        'instructor' => 'Lisa Witt',
                                        'title' => 'Lead Pianote Instructor',
                                        'description' => 'With over 20 years of experience and 168 million YouTube views, Lisa turns traditional piano lessons into fun, beginner-friendly play-alongs.'
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/jordan-rudess.jpg',
                                        'instructor' => 'Jordan Rudess',
                                        'title' => 'GRAMMY-winning<br>Dream Theater’s Keyboardist',
                                        'description' => 'With remarkable skills and exceptional piano technique, Jordan loves sharing his deep musical insights and inspiring musicians at all levels.',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/classical-piano.webp',
                                        'instructor' => 'Victoria Theodore',
                                        'title' => 'Stanford Master of Classical Piano',
                                        'description' => 'As a highly accomplished pianist who has performed with legends like Stevie Wonder and Beyoncé, Victoria inspires the next generation of musicians with her captivating performances.',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/improvisational-jazz.webp',
                                        'instructor' => 'Jesús Molina',
                                        'title' => 'World-class Jazz Pianist',
                                        'description' => 'Best known for his extraordinary technique and improvisations, Jesús is passionate about inspiring others to push musical boundaries and explore new possibilities.',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/gospel-piano.webp',
                                        'instructor' => 'Erskine Hawkins',
                                        'title' => 'Gospel Piano',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/Tango-Piano.webp',
                                        'instructor' => 'Sangah Noona',
                                        'title' => 'Tango Piano',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/Latin-Jazz.webp',
                                        'instructor' => 'Gabriel Palatchi',
                                        'title' => 'Latin Jazz',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/worship-piano.webp',
                                        'instructor' => 'Amberly Martz',
                                        'title' => 'Worship Piano',
                                        ],
                                        [
                                            'img' => 'marketing/pianote/membership/homepage/2024/coaches/cocktail-piano.webp',
                                        'instructor' => 'Brett Ziegler',
                                        'title' => 'Cocktail Piano',
                                        ],
                                    ];
                                @endphp
                                @foreach ($courses as $image)
                                    <li class="splide__slide flex flex-col items-center justify-center px-1">
                                        <div class="relative w-full rounded-xl overflow-hidden pb-48 sm:pb-52 lg:pb-72">
                                            <picture>
                                                <source media="(min-width:1024px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/290x0/filters:quality(95)/{{$image['img']}}">
                                                <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/290x0/filters:quality(95)/{{$image['img']}}">
                                                <img
                                                        alt="{{ $image['instructor'] }}"
                                                        class="absolute top-0 left-0 w-full h-full object-cover transition-opacity opacity-0 duration-300"
                                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$image['img']}}"
                                                        onload="this.classList.remove('opacity-0');"
                                                />
                                            </picture>
                                            <div class="rounded-b-xl absolute w-full bottom-0 h-full text-white text-center flex justify-end flex-col pb-3 lg:pb-6" style="background:linear-gradient(180deg, rgba(1, 5, 15, 0) 50%, #01050F 100%);">
                                                <h4 class="leading-none font-extrabold mb-1.5 lg:mb-2">{!! $image['instructor'] !!}</h4>
                                                <p class="leading-none text-xs">{!!  $image['title']  !!}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                </div>
            </section>
        </div>
{{--        <a href="#customize-anchor" class="join smaller anchor-slide mb-20">GET THE BUNDLE &raquo;</a>--}}

        <div class="container max-w-5xl mx-auto">
            <img class="h-28 sm:h-48 lg:h-56" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/pianote/promos/october/bundle-image.webp">
            <h6 class="leading-tight mx-auto font-black text-pianote mt-7">Join Pianote today with the Beautiful Beginner Bundle and get</h6>
            <h2 class="leading-tight font-black mt-1 mb-2">One year of UNLIMITED piano lessons<br class="hidden sm:inline"> plus 4 awesome LIFETIME bonuses</h2>
            <h4 class="leading-tight mb-7 sm:mb-10"><strong>For</strong> <s class="opacity-60">$591</s> <strong>$180</strong> (Save 70%)</h4>
            @php
                $bonuses = [
                    [
                        'title' => 'Pianote Membership',
                        'description' => 'Experience the joy of making beautiful music with unlimited piano lessons. Play along with world-class musicians, master your favorite songs, and get personalized 1:1 support at your fingertips. <br><br><span class="text-pianote">Plus, you\'ll also get full access to voice, guitar, and drum lessons at no extra cost.</span>',
                        'noBonus' => true,
                        'price' => ' ',
                        'discounted_price' => 'SAVE 25%',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/promos/october/bonus-01.webp',
                    ],
                    [
                        'title' => 'New Piano Players Start Here',
                        'description' => 'Get ready to dive into your first 30 days on the piano! This beginner-friendly course will help you get started on the keys with total confidence, guiding you lesson by lesson, note by note. Simply follow along with Lisa for 10 minutes a day to kickstart your musical journey.',
                        'price' => '$127',
                        'discounted_price' => 'FREE',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/promos/october/bonus-02.webp',
                    ],
                    [
                        'title' => 'Easy Chords',
                        'description' => 'Now that you’re comfortable with the piano, let’s take a further step with Easy Chords! Every song (yes, even classical ones) is built on chords, and they’re the key to telling musical stories. In just 10 minutes a day for 30 days, follow Lisa as you’ll go from knowing about chords to confidently playing them.',
                        'price' => '$127',
                        'discounted_price' => 'FREE',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/promos/october/bonus-03.webp',
                    ],
                    [
                        'title' => 'Read Music In 30 Days',
                        'description' => 'No more spending hours memorizing every single note. This 30-day course will demystify the language of music so you can read and play the songs you love. You’ll learn by DOING, playing a little bit each day with Lisa as you connect the notes on the page to the keys on your piano.',
                        'price' => '$97',
                        'discounted_price' => 'FREE',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/promos/october/bonus-04.webp',
                    ],
                    [
                        'title' => 'Read Music In 30 Days E-Book',
                        'description' => 'Every hero needs a trusty sidekick, and this e-book is ready to join you on your musical adventure! Grab this FREE 74-page companion e-book, packed to help you nail those notes and reinforce everything you learn.',
                        'price' => '',
                        'discounted_price' => 'FREE',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/promos/october/bonus-05.webp',
                    ],
                ];
            @endphp
            @foreach ($bonuses as $bonus)
                <div class="rounded-xl p-6 mb-5 text-left" style="background-color:#F2F5FA;">
                    <div class="flex flex-col sm:flex-row items-start">
                        <img src="{{ $bonus['image'] }}" class="h-24 sm:h-32 lg:h-36 mb-3 sm:mb-0 rounded-xl">
                        <div class="sm:pl-6">
                            <div class="flex justify-between">
                                <div>
                                    @if(empty($bonus['noBonus']))
                                        <p class="text-pianote uppercase mb-1">Bonus</p>
                                    @else
                                        <p class="text-pianote uppercase mb-1">MEMBERSHIP</p>
                                    @endif
                                    <h5 class="font-black mb-2">{{ $bonus['title'] }}</h5>
                                </div>
                                <div class="text-right">
                                    @if ($bonus['price'])
                                        <h5 class="inline-block mr-2"><s class="opacity-60">{{ $bonus['price'] }}</s></h5>
                                    @endif
                                    <p class="px-2 py-0.5 rounded-lg text-white inline-block text-sm" style="background-color:#007904;">{{ $bonus['discounted_price'] }}</p>
                                </div>
                            </div>
                            <p class="mb-4">{!!  $bonus['description']  !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach

{{--            <a href="#customize-anchor" class="join smaller anchor-slide">SAVE 70% &raquo;</a>--}}
        </div>
    </section>

    <section class="px-7 sm:px-6 py-10 sm:py-16 lg:py-20 relative" style="background: #F4F1EC;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-col-reverse sm:flex-row items-center">
                <div class="sm:w-7/12 text-left sm:pr-6">
                    <p class="leading-tight text-pianote uppercase font-black mb-3">Limited Time Offer</p>
                    <h3 class="leading-tight font-black mb-5">
                        Get the brand new Pianote headphones for <u style="text-decoration-color: #F61A30;"> just $20 more</u>
                    </h3>
                    <p class="leading-tight mb-5">
                        <strong>Get ready to experience your digital piano like never before!</strong><br><br>
                        With an impressive frequency range and large drivers, the new Pianote headphones let you hear every note as it was meant to be heard. Plus, enjoy complete privacy—no more worrying about your neighbors overhearing as you practice that tricky section. (They just don’t get that practice is part of the journey!)
                        <br><br>
                        For just $20 more*, you can snag these brand-new headphones today when you join Pianote with the Beautiful Beginner Bundle!
                        <br><br>
                        <em class="text-sm">*Free shipping in the US.</em>
                    </p>
{{--                    <a href="#customize-anchor" class="join smaller anchor-slide">Get the Bundle &raquo;</a>--}}
                </div>

                <div class="sm:w-5/12 mb-7 sm:mb-0 relative">
                    <img class="mx-auto sm:ml-auto sm:mr-0 max-w-xs sm:max-w-full cursor-pointer autoplay-video" x-on:click="headphones = true;"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2050x0/filters:quality(95)/marketing/pianote/promos/october/headphones.webp"
                        alt="Pianote Headphones">
                </div>
            </div>
        </div>
    </section>
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative text-center">
        <div class="container max-w-5xl mx-auto">
                <h2 class="leading-tight mb-7"><strong>The better way<br class="sm:hidden"> to learn piano.</strong></h2>
            <div class="relative" x-data="{
        tableClass: 'private',
        getClass() {
            return {
                'private': this.tableClass === 'private',
                'online': this.tableClass === 'online'
            };
        }
    }">
                <p
                        class="inline md:hidden leading-none text-xs absolute top-0 right-0 -mt-8 w-2/5 animated infinite bounce slower pt-2 text-black">
                    <strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong>
                </p>
                <table :class="getClass()"
                        class="w-full mx-auto comparison max-w-5xl mb-10 private">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl bg-pianote relative">
                            <img class="h-5 sm:h-6 mr-3 sm:mr-0 transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-white.png"
                                    >
                            <img class="h-8 sm:h-10 lg:h-14 mr-1.5 absolute top-0 right-0 transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/pianote/promos/october/best-value-badge.svg"
                                    >
                        </td>
                        <td class="cursor-pointer sm:cursor-default" @click="tableClass = 'online'"><strong>YouTube<br> Tutorials</strong></td>
                        <td class="cursor-pointer sm:cursor-default rounded-tr-xl" @click="tableClass = 'private'"><strong>Private <br> Lessons</strong></td>
                    </tr>
                    <tr>
                        <td>Flexibility</td>
                        <td>Learn anytime, anywhere, at your own pace.</td>
                        <td>Watch any time</td>
                        <td>Limited. Depends on your and the teacher’s schedules</td>
                    </tr>
                    <tr>
                        <td>Clear learning roadmap</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td>Yes</td>
                    </tr>
                    <tr>
                        <td>Topic Variety</td>
                        <td>Yes. Covers a wide range: pop, classical, technique, theory, and more.</td>
                        <td>Yes</td>
                        <td>Limited. Depends on the teacher’s expertise and curriculum.</td>
                    </tr>
                    <tr>
                        <td>Teacher Support</td>
                        <td>Personalized support with students reviews and feedback</td>
                        <td>No</td>
                        <td>1:1 Support</td>
                    </tr>
                    <tr>
                        <td>Community</td>
                        <td>Supportive community </td>
                        <td>No </td>
                        <td>No </td>
                    </tr>
                    <tr>
                        <td>Guarantee</td>
                        <td>90 days</td>
                        <td>No</td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Total Investment</td>
                        <td class="rounded-bl-xl"><strong>$180</strong><br> For 1 year of unlimited lessons</td>
                        <td><strong>Free</strong><br> (limited quality)</td>
                        <td class="rounded-br-xl"><strong>From $3,120</strong><br> ($60/lesson/week * 52 weeks)</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    @include('musora.sales.components.guarantee-section', [
        'theme' => 'white',
        'bgColor' => true,
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])


    @php
        $testimonials = [
            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/nico.webp',
                'name' => 'Nico Human',
                'location' => 'New Westminster, Canada',
                'title' => 'Learning the piano is easier than I thought it would be',
                'description' => 'Life is busy, and it’s tough to predict when you will have time to practice and learn. But learning the piano is easier than I thought it would be. The lessons are little units. It’s like how you eat an elephant: in biteable chunks!<br><br> I love that I can learn on my own schedule whenever I have an opportunity. It feels modern and progressive, and it can work for anyone.',
            ],
            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/erika.webp',
                'name' => 'Erika Espinosa',
                'location' => 'Washington, USA',
                'title' => 'Way less stressful than private lessons.',
                'description' => 'I work many hours, and I’m a mom of a teenager and a 5-year-old. I took private lessons for over a year, but it was hard for me to continue because of my busy schedule. <br><br>Pianote’s lessons are laid out so well, mimicking private lessons but allowing you to learn at your own pace. Plus, it’s way less stressful than private lessons.<br><br>I’m super happy and pleased with my decision to join Pianote!',
            ],
             [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/steve.webp',
                'name' => 'Steve Wilson',
                'location' => 'Arizona, USA',
                'title' => 'I\'ve learned that it doesn\'t have to be such a huge time commitment to really start',
                'description' => 'I\'ve learned that it doesn\'t have to be such a huge time commitment to really start to learn it because I\'m doing this for me. I\'m not doing this as a course. I\'m not doing this because somebody else wants me to learn it. This is finally for me and something I want to do for myself. <br><br> I tried some piano books and I tried some of the courses, where you can plug a piano into an iPad and then try to play along with it. That didn\'t very work very well for me. But when I saw Lisa teaching basic chords and making music from that, that was very inspiring.',
            ],
           [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/janet.webp',
                'name' => 'Janet Ketchen',
                'location' => 'Victoria, Canada',
                'title' => 'I’m 66 years old now, and I’m having a ball!',
                'description' => 'I first wanted to play the piano as a child. I also wanted to learn ballet. But we couldn’t afford both, so I said I would learn the piano sometime later in life. Well, I’m 66 years old now and I’m having a ball! Anyone should try this, and it is never too late to learn!',
            ],
             [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/bernhard.webp',
                'name' => 'Bernhard Zainsinger',
                'location' => 'Chicago, USA',
                'title' => 'Lisa is the perfect teacher',
                'description' => 'Lisa is the perfect teacher. Her hands-on teaching approach is invaluable to my learning and helps me make progress more easily.',
            ],

            [
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/marcel.webp',
                'name' => 'Marcel Robichaud',
                'location' => 'Canada',
                'title' => 'Finally, the instrument really feels like an instrument where I can enjoy playing it',
                'description' => 'Hey, Lisa and Pianote and anyone watching this. This is Marce. <br><br> I just want to record a quick message to say Thank you for all your help.<br><br>It\'s been such a treat to be with the piano. Finally, the instrument really feels like an instrument that I can enjoy playing, rather than just being a pretty piece of furniture sitting in a corner, collecting dust in my living room (laughs).<br><br>So once again, I appreciate everything you guys do - all the support, everything. It\'s just been awesome. Thank you so much.',
            ],
        ];
    @endphp
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20">
        <div class="container max-w-5xl mx-auto text-center">
            <h2 class="leading-tight"><strong>Trusted by pianists everywhere.</strong></h2>
            <p class="mt-2">See real stories from real students.</p>
            <img alt="star ratings" class="h-11 my-3 opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/homepage/2024/stars.png">
            <p class="mx-auto mb-7">
                Rated 4.8/5 based on <strong class="font-black">{{ number_format(Prices::$reviews) }} student reviews.</strong>
                <a role="link" aria-label="Link to shopperapproved" class="inline-block" target="_blank"
                            href="https://www.shopperapproved.com/reviews/Musora.com"
                        onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;"
                >
                    <strong class="font-black text-{{ $theme }}"><u>See the reviews »</u></strong>
                </a>
            </p>

            <div class="masonry text-left">
                @foreach ($testimonials as $card)
                    <div class="masonry-item bg-[#F1F7FE] shadow-lg rounded-lg p-6 lg:px-6 mb-4 flex flex-col">
                        <div class="flex items-center mb-4">
                            <img class="w-16 h-16 rounded-full mr-4" src="{{ $card['avatar'] }}" alt="{{ $card['name'] }}">
                            <div>
                                <h5 class="text-lg font-semibold">{{ $card['name'] }}</h5>
                                <p class="text-gray-600 text-xs">{{ $card['location'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center mb-4">
                            <span>
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star text-2xl text-[#FFC800]"></i>
                                @endfor
                            </span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">"{{ $card['title'] }}"</h3>
                        <p class="text-gray-700 flex-grow">"{!! $card['description'] !!}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="unstick-trigger block"></div>
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @php
            $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[read-music-in-30-days]=1&products[read-music-in-30-days-pdf]=1&redirect=/order&promo-code=BB0924&locked=true';
            $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[read-music-in-30-days]=1&products[read-music-in-30-days-pdf]=1&products[pianote-headphones-2024]=1&redirect=/order&promo-code=BB0924,beginner-headphones,headphones-us&locked=true'
    @endphp

    @php
        $courseDetails = [
            'courseOnly' => [
                'title' => 'Beautiful Beginner Bundle',
                'description' => 'Everything you need to get started on the piano.',
                'discountedPrice' => 591,
                'price' => 180,
                'keyFeatures' => [
                    '1 year of unlimited lessons ($240 value)',
                    'New Piano Players Start Here ($127 value)',
                    'Easy Chords ($127 value)',
                    'Read Music in 30 Days ($97 value)',
                    'Read Music in 30 Days E-Book (Free)',
                    '90-Day Guarantee'
                ]
            ],
            'membershipSpecial' => [
                'title' => 'Beautiful Beginner Bundle + Pianote Headphones ',
                'description' => 'Everything in the Beautiful Beginner Bundle, PLUS the brand new Pianote headphones at an unbeatable price.',
                'discountedPrice' => 690,
                'price' => 200,
                'keyFeatures' => [
                    'One year of unlimited piano lessons ($240 value) ',
                    '<span class="text-pianote">BONUS</span> New Piano Players Start Here ($127 value)',
                    '<span class="text-pianote">BONUS</span> Easy Chords ($127 value)',
                    '<span class="text-pianote">BONUS</span> Read Music in 30 Days ($97 value)',
                    '<span class="text-pianote">BONUS</span> Read Music in 30 Days E-Book (Free)',
                    '<strong><span class="text-pianote">SPECIAL OFFER</span> New Pianote Headphones</strong> ($99 value)',
                    'Free shipping in the US',
                    '90-Day Guarantee'
                ]
            ]
        ];
    @endphp
    <section class="text-center relative z-50 overflow-hidden px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-black" style="background-color:#F6F5F4;" id="final">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                <div class="text-center lg:text-left w-full max-w-xl lg:max-w-full mx-auto lg:w-1/4 mb-7 lg:mb-0 relative">
                    <h3 class="leading-tight mt-2 mb-4 sm:my-4 lg:my-5 font-black">Get 1 year of unlimited piano lessons <br>

                            <span class="relative inline-block"> plus $450 worth
                    <svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 70%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#F61A30" stroke-width="3" stroke-linecap="round"></path></svg>
                </span>
                            of FREE bonuses
                    </h3>
                    <p class="mb-2 sm:mb-3 text-black">Know exactly what to practice, learn from world-class teachers, and enjoy personalized support every step of the way.</p>
                </div>

                <div class="flex flex-wrap sm:flex-nowrap max-w-xs sm:max-w-full items-center text-left mx-auto w-full lg:w-3/4 lg:pl-5 xl:pl-10">
                    <span class="join sold-out smaller mx-auto">OFFER HAS NOW ENDED</span>
{{--                    <a href="{{ $buttonLink }}" style="text-decoration:none"--}}
{{--                            class="z-10 relative px-5 sm:px-6 sm:pr-10 py-7 sm:py-9 mb-7 sm:mb-0 bg-white rounded-xl shadow-xl w-full sm:w-1/2 relative z-10">--}}
{{--                        <h3 class="text-black leading-tight"><strong>{{ $courseDetails['courseOnly']['title'] }}</strong></h3>--}}
{{--                        <p class="text-sm mb-5 text-black">{{ $courseDetails['courseOnly']['description'] }}</p>--}}
{{--                        @if ($courseDetails['courseOnly']['price'] == $courseDetails['courseOnly']['discountedPrice'])--}}
{{--                            <h2 class="inline-block text-black"><strong class="">${{ $courseDetails['courseOnly']['price'] }}</strong></h2>--}}
{{--                        @else--}}
{{--                            <h2 class="inline-block text-black opacity-40 font-light line-through">${{ $courseDetails['courseOnly']['discountedPrice'] }}</h2>--}}
{{--                            <h2 class="inline-block text-black"><strong class="">${{ $courseDetails['courseOnly']['price'] }}</strong></h2>--}}
{{--                            <p class="inline-block text-black">(Save 70%)</p>--}}
{{--                        @endif--}}
{{--                        <div class="join bg-{{$theme}} smaller my-4 w-full max-w-[260px] text-white uppercase">SAVE 70%</div>--}}
{{--                        <p class="leading-tight text-sm"><span class="text-pianote">Discount ends in:</span><br>--}}
{{--                            <span class="uppercase" x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft < 0">A Limited Time</span>--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                        <hr class="w-full my-5" style="border-color:#b2cae1">--}}
{{--                        <p class="leading-loose text-xs text-black"><strong>Key Features</strong><br>--}}
{{--                            @foreach ($courseDetails['courseOnly']['keyFeatures'] as $keyFeature)--}}
{{--                                <i class="fas fa-check text-{{$theme}} mr-1"></i> {!! $keyFeature !!}<br>--}}
{{--                            @endforeach--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <a href="{{ $buttonLink2 }}" class="px-5 sm:px-6 py-5 sm:py-7 sm:-ml-5 rounded-xl shadow-xl w-full sm:w-1/2 relative z-20 sm:max-w-md"--}}
{{--                        style="text-decoration:none; background: #fffbf7;filter: drop-shadow(0px 0px 10px rgba(246, 26, 48, 0.50));">--}}
{{--                        <p class="border border-{{$theme}} text-{{$theme}} inline-block rounded-xl text-sm mb-2 px-4 tracking-wider text-black">BEST OFFER</p>--}}
{{--                        <h3 class="text-black leading-tight"><strong>{!! $courseDetails['membershipSpecial']['title'] !!}</strong></h3>--}}
{{--                        <p class="text-sm mb-5 text-black">{{ $courseDetails['membershipSpecial']['description'] }}</p>--}}
{{--                        @if ($courseDetails['membershipSpecial']['price'] == $courseDetails['membershipSpecial']['discountedPrice'])--}}
{{--                            <h2 class="inline-block text-black"><strong class="">${{ $courseDetails['membershipSpecial']['price'] }}</strong></h2>--}}
{{--                        @else--}}
{{--                            <h2 class="inline-block text-black opacity-40 font-light line-through">${{ $courseDetails['membershipSpecial']['discountedPrice'] }}</h2>--}}
{{--                            <h2 class="inline-block text-black"><strong class="">${{ $courseDetails['membershipSpecial']['price'] }}</strong></h2>--}}
{{--                            <p class="inline-block text-black">(Save 71%)</p>--}}
{{--                        @endif--}}
{{--                        <div class="join bg-{{$theme}} smaller my-4 w-full max-w-[260px] text-white uppercase">save 71% & Start now</div>--}}
{{--                        <p class="leading-tight text-sm"><span class="text-pianote">Offer ends in:</span><br>--}}
{{--                            <span class="uppercase" x-cloak x-data="timer()" x-init="countdown()">--}}
{{--                                <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft > 0 && day < 7"><span x-text="second"></span><span x-text="secondText"></span></span>--}}
{{--                                <span x-cloak x-show="timeLeft < 0">A Limited Time</span>--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                        <ul class="list-disc ml-6 text-black">--}}
{{--                            @if (!empty($courseDetails['membershipSpecial']['bonusItems']))--}}
{{--                                @foreach ($courseDetails['membershipSpecial']['bonusItems'] as $bonusItem)--}}
{{--                                    <li class="text-sm leading-relaxed text-black"><span class="text-{{$theme}}"></span> {!! $bonusItem !!}</li>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                        <hr class="w-full my-5" style="border-color:#b2cae1">--}}
{{--                        <p class="leading-loose text-xs text-black"><strong>Key Features</strong><br>--}}
{{--                            @foreach ($courseDetails['membershipSpecial']['keyFeatures'] as $keyFeature)--}}
{{--                                <i class="fas fa-check text-{{$theme}} mr-1"></i> {!! $keyFeature !!}<br>--}}
{{--                            @endforeach--}}
{{--                        </p>--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>
    </section>
    <section class="content-section text-center text-black" style="background: #e6e4e3;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/pianote/membership/homepage/webp-format/devices.webp',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])
    @include('pianote._partials.faq')

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
    @include('_partials.components.video-modal',[
        'name' => 'headphones',
        'video' => '1018435070',
        'vimeo' => true,
    ])
    @include('_partials.components.countdown',[
        'countdownDate' => '2024-11-01 00:00:00',
        'promoVersion' => false
        ])

        @include("pianote.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            window.addEventListener('scroll', function () {
                var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
                var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
                if (window.scrollY > (unstickTrigger - 115)) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < stickTrigger - 115) {
                    stickyBar.classList.remove('fixed', 'mt-0');
                }
                if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                    stickyBar.classList.add('fixed', 'mt-0');
                }
            });
        });
    </script>
@endsection
