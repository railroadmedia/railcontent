@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Drumeo EarDrums</title>
    <meta property="og:title" content="Drumeo EarDrums">
    <meta name="description" content="Protect your ears + play your favorite songs.">
    <meta property="og:description" content="Protect your ears + play your favorite songs.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/share-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

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
            font-family: 'Bebas Neue', sans-serif;
            color: #fff;
            background: #0b76db;
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
            background: #258ff4;
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
            font:700 30px/1em "Bebas Neue", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db
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
        @-webkit-keyframes fadeEffect {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes fadeEffect {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .info-pop {
            position: absolute;
        }
        .info-pop:after, .info-pop:before {
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
        .info-pop:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .info-pop:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
            bottom: 30px;
            left: -300%;
        }
        .info-pop:hover, .info-pop:active, .info-pop:focus {
            z-index: 100;
        }
        .info-pop:hover:after, .info-pop:hover:before, .info-pop:active:after, .info-pop:active:before, .info-pop:focus:after, .info-pop:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }


        .content-section table.comparison.eardrums tr td:nth-child(1),
        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 25%;
        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td:nth-child(1),
            .content-section table.comparison.eardrums tr td:nth-child(2),
            .content-section table.comparison.eardrums tr td:nth-child(3),
            .content-section table.comparison.eardrums tr td:nth-child(4) {
                width: 26%;
            }
        }
        .content-section table.comparison.eardrums tr td {
            padding:15px 7px;
            font-size:12px;
            text-transform:uppercase;

        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
                font-size:16px;
            }
        }

        @media (max-width: 767px) {
            table tr td:nth-child(3),
            table tr td:nth-child(4) {
                cursor:pointer;
            }
            .earbuds tr td:nth-child(3) {
                display: table-cell;
            }
            .earbuds tr td:nth-child(4) {
                display: none;
            }
            .headphones tr td:nth-child(4) {
                display: table-cell;
            }
            .headphones tr td:nth-child(3) {
                display: none;
            }
        }


        .splide__arrow:focus {
            outline: none;
        }
    </style>
@stop()

@section('body-data')
    x-data="{
    trailer: false,
    waitlistModal: false,
    trailerM: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Drumeo EarDrums",
        "fullPrice" => floatval($productPrices['drumeo-eardrums-black']->price),
        "price" => floatval($productPrices['drumeo-eardrums-black']->discounted_price),
        "noBreadcrumb" => true
    ])

    @if(strpos(url()->full(), 'thankyou'))
        <div class="py-5 sm:py-7 px-6 text-center bg-green-400">
            <div class="container mx-auto max-w-xl">
                <h3 class="leading-tight mb-2"><strong>Thanks for contacting us!</strong></h3>
                <p class="leading-tight">You’re on the early access list for the next drop of Drumeo EarDrums.<br class="hidden sm:inline"> Keep on eye on your inbox to get yours before anyone else.</p>
            </div>
        </div>
    @endif

    @if(!empty($products['drumeo-eardrums-black']->getStockAvailability()))
    @if($products['drumeo-eardrums-black']->getStockAvailability() > 1 && $products['drumeo-eardrums-black']->getStockAvailability() < 100)
        <a class="promo-banner fixed flex text-black items-center justify-center py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide bg-musora">
            <h3 class="inline-block font-bebas mx-0 pr-3">LOW STOCK</h3>
            <p class="inline-block text-xs mx-0 leading-tight">
                Get yours before they're gone!
            </p>
        </a>
    @endif
    @endif
    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#000;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-16 sm:h-24" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png"><br>
                <h6 class="leading-tight my-3">Protect your ears + <br class="sm:hidden">play your favorite songs.</h6>
                <h2 class="leading-tight">
                    @if(floatval($productPrices['drumeo-eardrums-black']->price) > floatval($productPrices['drumeo-eardrums-black']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['drumeo-eardrums-black']->price) }}</s>
                        <strong>${{ floatval($productPrices['drumeo-eardrums-black']->discounted_price) }}</strong>
                        <em class="text-musora text-sm">(Save {{ round(100 - (100 * (floatval($productPrices['drumeo-eardrums-black']->discounted_price) / floatval($productPrices['drumeo-eardrums-black']->price)))) }}%)</em>
                    @else
                        <strong>${{ floatval($productPrices['drumeo-eardrums-black']->discounted_price) }}</strong>
                    @endif
                </h2>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block"   @click="trailerM = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    @if( $products['drumeo-eardrums-black']->getStockAvailability() > 1 && !empty($products['drumeo-eardrums-black']->getStockAvailability()))
                        <a class="w-5/12 join smaller blue anchor-slide" href="#customize-anchor">Order Now</a>
                    @else
                        <a class="join smaller sold-out" @click="waitlistModal = true;">JOIN WAITLIST</a>
                    @endif
                </div>
                {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6>--}}
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: radial-gradient(rgba(24,25,27,0.8), transparent);"></div>
        {{--        <img class="object-cover w-full h-full relative z-0" src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header.jpg">--}}
        <video class="object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header2.mp4"></video>
    </header>

    <section class="text-center px-3 sm:px-2 py-10 sm:py-12 lg:py-14" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <img class="h-14 sm:h-20 -mt-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/whats-new.webp" alt="Whats New">
            <h6 class="leading-normal mt-4 mb-7 sm:mb-10">The Drumeo EarDrums have helped 14,000 drummers protect their ears and play <br class="hidden sm:inline">
                their favorite songs. We took your feedback and made a classic even better:</h6>

            @php
                $gridItems = [
                [
                 'img' => 'marketing/drumeo/products/eardrums-black/features-01a.webp',
                'title' => 'Better Connections.',
                'desc' => 'An upgraded 2-pin cable connection guarantees you can hear your music in any situation.',
                ],
                [
                 'img' => 'marketing/drumeo/products/eardrums-black/features-02a.webp',
                'title' => 'Miniature Road Case.',
                'desc' => 'The big little upgrade. Your EarDrums now include a custom miniature road case – built to take anything you (accidentally) throw at it.',
                ],
                [
                 'img' => 'marketing/drumeo/products/eardrums-black/features-03a.webp',
                'title' => 'Extra Cable.',
                'desc' => 'You’ll also be covered with a backup braided cable – keep it in your travel bag or at your kit to save you mid-show.',
                ],
                [
                 'img' => 'marketing/drumeo/products/eardrums-black/features-04a.webp',
                'title' => 'Back In Black.',
                'desc' => 'You’ll look like a pro wearing in-ear monitors in all-new triple black – the official color of touring drummers everywhere.',
                ],
                ];
            @endphp
            <div class="hidden lg:flex flex-nowrap text-left">
                @foreach ($gridItems as $gridItem)
                    <div class="w-full sm:w-1/4 px-2 lg:px-3 mb-4 sm:mb-0">
                        <img class="rounded-xl h-56 sm:h-44 lg:h-56 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/{{ $gridItem['img'] }}">
                        <h5 class="leading-tight mt-4 mb-2"><strong>{{ $gridItem['title'] }}</strong></h5>
                        <p>{{ $gridItem['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="lg:hidden mb-5"
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'hidden',
                                    prev: 'hidden',
                                    next: 'hidden',
                                    pagination: 'splide__pagination bottom-0',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            drag   : 'free',
                            snap   : false,
                            breakpoints: {
                                767: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">
                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1">
                                    <div class="rounded-xl overflow-hidden shadow-md bg-white text-black">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="drumeo stickbag"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <p class="mt-4 mb-1 px-4 font-black leading-tight"><strong>{{ $gridItem['title'] }}</strong></p>
                                        <p class="px-4 pb-6 text-sm leading-tight">{{ $gridItem['desc'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-16 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-14 sm:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/840x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/drums-are-loud.webp" alt="Drums Are Loud">
            <h6 class="leading-normal mt-5 mb-7 sm:mb-10 mx-auto max-w-xl">
                Whether you’re playing acoustic or electronic drums, sealing in the sound while protecting your ears is crucial. <br class="sm:hidden"><br class="sm:hidden"><strong>Drumeo EarDrums are professional in-ear headphones that help you:</strong></h6>
            <div class="flex flex-wrap text-left">
                <div class="flex flex-wrap sm:flex-nowrap items-center mb-7 sm:mb-10">
                    <img class="h-auto w-full sm:w-auto sm:h-56 lg:h-72 sm:order-1 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/970x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/features-01b.webp">
                    <div class="sm:px-6 lg:px-10">
                        <h4 class="leading-tight my-2"><strong>Catch every detail.</strong></h4>
                        <p>Triple driver headphones (that means 3 tiny speakers) give you a full range of sound -- from low kick drums to high cymbal shots.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center mb-7 sm:mb-10">
                    <img class="h-auto w-full sm:w-auto sm:h-56 lg:h-72 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/970x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/current-feature-02.webp">
                    <div class="sm:px-6 lg:px-10">
                        <h4 class="leading-tight my-2"><strong>Seal in the sound.</strong></h4>
                        <p>Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center">
                    <img class="h-auto w-full sm:w-auto sm:h-56 lg:h-72 sm:order-1 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/970x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/current-feature-03.webp">
                    <div class="sm:px-6 lg:px-10">
                        <h4 class="leading-tight my-2"><strong>Go anywhere.</strong></h4>
                        <p>Your EarDrums are meant to be used. Take them anywhere with a handy carrying case + extra tips for a perfect fit every time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center text-white px-5 sm:px-10 pb-12 pt-96 sm:py-12 lg:py-24 relative" style="background-color:#111729;">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <div class="w-full sm:w-7/12 lg:w-1/2 text-left">
                <img class="h-24 sm:h-24 lg:h-32 mb-5 lg:mb-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/not-for-the-pros.webp" alt="Not just for the pros">

                <p class="leading-normal">You don’t need to be an arena drummer to use in-ear monitors.
                    <br><br>
                    In fact, with more and more drummers using e-kits and taking lessons online, in-ear monitors have become a go-to practice tool for drummers of ALL skill levels.
                    <br><br>
                    By reducing volume by up to -29db, in-ear monitors will save your ears from ambient drum noise AND allow you to listen to your music quieter.</p>
            </div>
        </div>
        <picture>
            <source media="(min-width: 1200px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-stage.webp">
            <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-stage.webp">
            <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-stage.webp">
            <img class="absolute inset-0 z-0 w-full h-full object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-stage-m.webp" style="object-position: 55% 20%;">
        </picture>
        <picture>
            <source media="(min-width: 1200px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-living-room.webp">
            <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-living-room.webp">
            <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-living-room.webp">
            <img class="absolute inset-0 z-0 w-full h-full object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-living-room-m.webp" style="object-position: 55% 20%;opacity: 0; animation-delay: 5s; animation: fadeEffect 5s infinite ease-in-out;">
        </picture>
    </section>
    <section class="text-center px-5 sm:px-10 py-10 sm:py-16 lg:py-20 text-white" style="background-color:#111729;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h3 class="leading-tight"><strong>Everything you love about<br> the original EarDrums…</strong></h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-black my-7 sm:my-10">
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“I have really small ears and I am REALLY picky about sound.”</h6>
                    {{--                    <p class="my-4 sm:my-6">I have to say I was doubtful. I have some more expensive in-ear monitors and I have really small ears and I am REALLY picky about sound. I was 100% blown away – deep rich bass response, nice clear mids and highs and amazing fit, and best of all no ear fatigue! I was also pleasantly surprised at the nice compact package that fits into a pocket or purse to take with me and keep things all in one place. Lots of selection for ear tips and a nice cleaner all part of the package for an amazing price.  If I had listened to the sound alone I would have expected them to cost a lot more than they do. I use mine every day and recommend them to everyone I talk to!</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/360053_1646349286211-1646349288-360053.jpg" alt="Joy B">
                        <p class="leading-none mx-0 pl-4"><strong>Joy B</strong><br>
                            <span>Toronto</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“No more harsh-sounding headphones for drumming.”</h6>
                    {{--                    <p class="my-4 sm:my-6">I’ve been rocking EarDrums and like them. It’s great to have a lot of low end without having the bass or kick drum get muddy. They are very comfortable and I enjoy them. No more harsh-sounding headphones for drumming – and no more guessing where the bassist is going! I also like the high-end roll-off – this prevents listening fatigue AND protects your hearing if you like to listen loudly. </p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/398228_1648758391036-1648758395-398228.jpg" alt="Lauri V">
                        <p class="leading-none mx-0 pl-4"><strong>Lauri V.</strong><br>
                            <span>Finland</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“Definitely felt the Drumeo in-ears are a step up.”</h6>
                    {{--                    <p class="my-4 sm:my-6">I used these in a show the other night for the first time and really enjoyed them! Definitely felt the Drumeo in-ears are a step up from the KZ Pro 10s. The sound quality is competitive with KZs, but Drumeo in-ears are much more comfortable to me.</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/IMG_3193.jpg" alt="David G">
                        <p class="leading-none mx-0 pl-4"><strong>David G</strong><br>
                            <span>Mississippi</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“The isolation tips do a good job of cutting sound while still comfy.”</h6>
                    {{--                    <p class="my-4 sm:my-6">I love these things! Great sound and a good selection of tips for various needs/uses. The isolation tips do a good job of cutting sound while still comfy. Not only great for drum monitoring but all around music enjoyment.</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10" src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Rick_profile.jpg" alt="Rick">
                        <p class="leading-none mx-0 pl-4"><strong>Rick</strong><br>
                            <span>Oregon</span>
                        </p>
                    </div>
                </div>
            </div>
            <h4 class="leading-tight"><strong>and more.</strong></h4>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-16">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>Find your fit.</strong></h1>
            <h6 class="leading-normal mt-3 mb-7 sm:mb-10 mx-auto max-w-2xl">A perfect seal is critical. That’s why your EarDrums include 9 different fits across 3 different configurations. From expanding memory foam to double-layer silicon, you can find the perfect fit for your ears.</h6>
            <div class="flex">
                <div class="w-1/3 px-1 sm:px-3">
                    <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/triple-layer2.webp">
                    <h6 class="leading-tight mt-4 mb-2"><strong>Triple-layer</strong></h6>
                    <p class="leading-tight"><em>3 sizes included.</em></p>
                </div>
                <div class="w-1/3 px-1 sm:px-3">
                    <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/double-layer2.webp">
                    <h6 class="leading-tight mt-4 mb-2"><strong>Memory Foam</strong></h6>
                    <p class="leading-tight"><em>3 sizes included.</em></p>
                </div>
                <div class="w-1/3 px-1 sm:px-3">
                    <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/single-layer2.webp">
                    <h6 class="leading-tight mt-4 mb-2"><strong>Single-layer</strong></h6>
                    <p class="leading-tight"><em>3 sizes included.</em></p>
                </div>
            </div>
        </div>
    </section>
    <section class="content-section text-center comparison px-1 lg:px-3" style="background:linear-gradient(to bottom, #272e41, #02050e);" x-data="{ tableClass: 'earbuds' }">
        <div class="container mx-auto max-w-5xl">
            <h2 class="mb-16 md:mb-12 "><strong>The difference<br class="sm:hidden"> you can <img class="h-12 sm:h-20 align-bottom" src="https://www.musora.com/musora-cdn/image/width=320,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/hear.png" alt="Hear text"></strong></h2>
            <div class="relative">
                <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table :class="{'earbuds': tableClass === 'earbuds', 'headphones': tableClass === 'headphones'}" class="w-full mx-auto border-separate comparison eardrums earbuds">
                    <tbody style="background-color:transparent!important;">
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl">
                            <img class="h-5 md:h-12 filter saturate-0 brightness-200"  src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png" alt="logo-white">
                        </td>
                        <td class="leading-none rounded-t-xl" @click="tableClass = 'headphones'">Standard<br> Earbuds</td>
                        <td class="leading-none rounded-t-xl" @click="tableClass = 'earbuds'">Standard<br> Headphones</td>
                    </tr>
                    <tr>
                        <td>Driver Type</td>
                        <td>
                            <span class="hidden sm:inline">2 dynamic drivers<br> + 1 balanced armature</span>
                            <span class="inline sm:hidden">2 dynamic drivers + 1 BAs</span>
                        </td>
                        <td>1 Dynamic Driver</td>
                        <td>Single 40mm Driver</td>
                    </tr>
                    <tr>
                        <td>Frequency Range</td>
                        <td>18Hz - 22kHz</td>
                        <td>19Hz - 20kHz</td>
                        <td>18Hz - 22kHz</td>
                    </tr>
                    <tr>
                        <td>Sound Isolation</td>
                        <td>-29 dB</td>
                        <td>0 dB</td>
                        <td>0 dB</td>
                    </tr>
                    <tr>
                        <td>Impedance (at 1khz)</td>
                        <td>18 Ω</td>
                        <td>~23 Ω</td>
                        <td>~47 Ω</td>
                    </tr>
                    <tr>
                        <td>Sensitivity (at 1khz)</td>
                        <td>97 dB</td>
                        <td>109 dB</td>
                        <td>96 dB</td>
                    </tr>
                    <tr style="background-color:transparent!important;">
                        <td class="rounded-b-xl">Built For Drummers</td>
                        <td class="rounded-b-xl">Yes</td>
                        <td class="rounded-b-xl">No</td>
                        <td class="rounded-b-xl">No</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="text-center px-0 sm:px-6 py-8 sm:py-10 lg:py-12" style="background:linear-gradient(180deg, #fbfbfd, #e7e3eb);">
        <div class="container mx-auto relative z-10 max-w-3xl">
            <h1 class="leading-tight"><strong>What’s in the box?</strong></h1>
            <p class="leading-tight mt-2 hidden sm:inline-block">(Tap for more information)</p>
            <ul class="list-disc mt-2 ml-6 leading-tight text-left w-auto inline-block sm:hidden">
                <li class="mb-1"><strong>1 Pair of EarDrum IEMs</strong></li>
                <li class="mb-1">Single-layer Silicone Eartips (S/M/L)</li>
                <li class="mb-1">Triple-layer Silicone Eartips (S/M/L)</li>
                <li class="mb-1">Memory Foam Eartips (S/M/L)</li>
                <li class="mb-1">Drumeo Miniature Road Case</li>
                <li class="mb-1">2 Black Braided Cables</li>
                <li class="mb-1">Cleaning Brush</li>
                <li class="mb-1">Clothing Clip</li>
                <li>¼” Adapter</li>
            </ul>
            <picture>
                <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1152x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/items3.webp">
                <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/items3.webp" alt="logo">
            </picture>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 35%;left: 15%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Triple-layer Silicone Eartips (S/M/L)">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 34%;left: 35%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Memory Foam Eartips (S/M/L)">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 67%;left: 14%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Single-layer Silicone Eartips (S/M/L)">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 79%;left: 40%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Gold ¼” Adapter">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 62%;left: 34%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Clothing Clip">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 74%;left: 61%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="2 Black Braided Cables">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 42%;left: 51%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Cleaning Brush">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 28%;left: 75%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="Drumeo Miniature Road Case">
                <span class="text-2xl">+</span>
            </div>
            <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                style="top: 84%;left: 83%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                tip="EarDrum IEMs">
                <span class="text-2xl">+</span>
            </div>
        </div>
    </section>
    <section class="pt-10 sm:px-6 sm:py-16 lg:py-20">
        <div class="container mx-auto max-w-3xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="px-6 sm:pr-0 sm:pl-7 lg:pl-14 mb-7 sm:mb-0 sm:order-1">
                    <img class="h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/drumeo-icon.svg">
                    <h3 class="leading-tight my-4"><strong>30 Days Of Free Drum Lessons With Your EarDrums. </strong></h3>
                    <p class="leading-normal">Play your favorite songs, study with your favorite teachers, and find your next breakthrough on the drums.
                        <br><br>
                        Your Drumeo EarDrums include 30 days of unlimited drum lessons. You’ll have sheet music for famous drum songs, step-by-step lessons with award-winning drummers, and playalongs in every style and tempo.
                    </p>
                </div>
                <picture class="w-full sm:w-auto h-auto sm:h-96">
                    <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/join-drumeo2.jpg">
                    <img class="sm:rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x700/filters:quality(95)/marketing/drumeo/products/eardrums-black/join-drumeo2.jpg">
                </picture>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-3xl">
            <img alt="quietkick logo" class="h-16 sm:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/logo-black.png"><br>
            <h6 class="leading-tight mt-4 mb-2">Protect your ears +<br class="sm:hidden"> play your favorite songs.</h6>
            @if( $products['drumeo-eardrums-black']->getStockAvailability() > 1 && !empty($products['drumeo-eardrums-black']->getStockAvailability()))
                @include('drumeo.products.partials._promo-cards', [
                    'firstBadge' => 'SAVE 34%',
                    'firstDeal' => 'Drumeo<br> EarDrums',
                    'firstDealImage' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/order-01.webp',
                    'firstImageHeight' => 'h-28 lg:h-32',
                    'firstDealDiscount' => 149,
                    'firstDealPrice' => 99,
                    'firstDealSub' => 'Just the IEMs',
                    'firstDealLink' => '/ecommerce/add-to-cart?products[drumeo-eardrums-black]=1&products[drumeo_access_30-days]=1&promo-code=eardrums-shipping&locked=true',
                    'firstButtonText' => 'SELECT',
                    'firstDealExtra' => "One-time payment. Free shipping.",
                    'whiteBg' => 'false',
                    'firstExtraBonuses' => [
                        '<strong>1 Pair of EarDrum IEMs</strong>',
                        '<strong>30 Days Of Drumeo</strong>',
                        'Single-layer Silicone Eartips (S/M/L)',
                        'Triple-layer Silicone Eartips (S/M/L)',
                        'Memory Foam Eartips (S/M/L)',
                        'Drumeo Miniature Road Case',
                        '2 Black Braided Cables',
                        'Cleaning Brush',
                        'Clothing Clip',
                        '¼” Adapter',
                    ],

                    'secondBadge' => 'LAUNCH SPECIAL',
                    'secondDeal' => 'EarDrums + 1 Year<br> Drumeo Membership',
                    'secondDealImage' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/order-02.webp',
                    'secondImageHeight' => 'h-28 lg:h-32',
                    'secondDealPrice' => 'Free EarDrums',
                    'secondDealExtra' => "with annual Membership of $240/yr.",
                    'secondButtonText' => 'SELECT',
                    'secondDealLink' =>
                        '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums-black]=1&promo-code=eardrums-shipping&locked=true',
                    'secondExtraBonuses' => [
                        '<strong class="text-drumeo">Join Drumeo and get EarDrums for FREE!</strong>',
                        '<strong>Everything included with the<br> Drumeo Eardrums PLUS:</strong>',
                        'Step-by-Step Lessons',
                        'Song Breakdowns',
                        'Personalized Support',
                    ],
                ])
            @else
                <a class="join sold-out my-7"  @click="waitlistModal = true;">JOIN WAITLIST</a>
            @endif

            <h6 class="uppercase mt-6"><strong>For hygienic reasons all <br class="inline sm:hidden"> EarDrum sales are final.</strong></h6>
        </div>
    </section>

    <section class="py-6 md:py-10 text-center">
        <p class="max-w-md px-4 md:px-2 leading-normal">
            <i class="fas fa-info-circle text-drumeo" aria-hidden="true"></i> <b>Shipping Disclaimer</b><br>
            Due to high demand, your EarDrums will ship <br class="hidden sm:inline">
            within 2-4 business days of your order.
        </p>
    </section>
    <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 sm:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block sm:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 sm:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    @component('_partials.components.modal', ['name' => 'waitlistModal'])
        @slot('content')
            <div class="relative overflow-y-visible max-w-md px-4 md:px-5 lg:px-7 py-5 md:py-7 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <h3 class="leading-tight mb-4"><strong>Join The Waitlist!</strong></h3>
                <p class="mb-4">Enter your email below to get notified when the <br class="hidden sm:inline">
                    Drumeo EarDrums are back in stock. </p>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                    "formName" => 'EarDrums Waitlist',
                    "formId" => "Drumeo - Engagement - Trigger - Eardrums Waitlist - Web Form",
                    "buttonText" => "Let Me Know ",
                    "stacked" => true,
                    "redirectURL" => "/drumshop/eardrums?thankyou",
                    "minimalForm" => true
                ])
            </div>
        @endslot
    @endcomponent
    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '957405443',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailerM',
        'video' => '957405389',
        'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
    ])

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
