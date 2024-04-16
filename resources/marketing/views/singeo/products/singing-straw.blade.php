@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Singing Straw | Singeo</title>
    <meta property="og:title" content="Singing Straw | Singeo">

    <meta name="description" content="Strengthen your voice, increase your range, and sing with confidence."/>
    <meta property="og:description" content="Strengthen your voice, increase your range, and sing with confidence.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/singeo/products/singing-straw/share-image.jpg">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">

    <style>
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
            transition: all 0.3s;
            overflow: hidden;
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
            font: 400 14px/1.4em 'Open Sans', sans-serif;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .info-pop:hover, .info-pop:active, .info-pop:focus {
            z-index: 100;
        }
        .info-pop:hover:after, .info-pop:active:after, .info-pop:focus:after, .info-pop:hover:before, .info-pop:active:before, .info-pop:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }


        .dropdown .active {
            height: auto !important;
            visibility: visible !important;
            max-height: 400px !important;
            opacity: 1 !important;
        }
        .join.smaller {
            font-size: 18px;
            padding: 16px 25px;
        }

        @media (min-width: 768px) {
            .join.smaller {
                padding: 16px 30px;
            }
        }

    </style>
    @parent
@endsection

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
    "name" => "Beautiful Harmonies",
    "fullPrice" => floatval($productPrices['singing-straw']->price),
    "price" => floatval($productPrices['singing-straw']->discounted_price),
    "noBreadcrumb" => true
    ])
    @yield('topbar')

    <header class="py-12 md:py-20" style="background:linear-gradient(to bottom, #FFF, #F3EEF7);">
        <div class="max-w-md md:max-w-4xl mx-auto md:flex md:items-center md:gap-10 px-6 lg:px-0">
            <div class="md:w-1/2 text-center md:text-left">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/310x0/filters:quality(95)/marketing/singeo/products/singing-straw/logo-dark.svg">
                    <img class="h-24 lg:h-28 rounded-b-md mb-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/270x0/filters:quality(95)/marketing/singeo/products/singing-straw/logo-dark.svg" alt="logo">
                </picture>
                <div class="relative md:hidden">
                    <img class="rounded-xl mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/660x0/filters:quality(95)/marketing/singeo/products/singing-straw/header2.webp" alt="header thumb">
{{--                    <div class="absolute uppercase bg-white text-black rounded-full pb-1 pt-1.5 px-4 font-bebas bottom-6 left-2 cursor-pointer autoplay-video text-sm" data-open="trailer">--}}
{{--                        <i class="fa-solid fa-play mr-1"></i> play video--}}
{{--                    </div>--}}
                </div>
                <h3 class="font-extrabold leading-tight text-center md:text-left mb-5">
                    Strengthen your voice, increase your range, and sing with confidence.
                </h3>
                <h2 class="font-extrabold leading-tight text-center md:text-left">
                    @if(floatval($productPrices['singing-straw']->discounted_price) < floatval($productPrices['singing-straw']->price))
                        <s class="opacity-50">${{ floatval($productPrices['singing-straw']->price) }}</s>
                    @endif
                    <strong>${{ floatval($productPrices['singing-straw']->discounted_price) }}</strong>
                </h2>
                @if(floatval($productPrices['singing-straw']->discounted_price) < floatval($productPrices['singing-straw']->price))
                    <p class="text-musora">(Save {{ round(100 - (100 * (floatval($productPrices['singing-straw']->discounted_price) / floatval($productPrices['singing-straw']->price)))) }}%)</p>
                @endif
                <div class="md:w-72 lg:w-2/3 text-center mt-5">
                    <a class="join smaller w-full" href="/ecommerce/add-to-cart?products[singing-straw]=1&promo-code=transform">ORDER NOW</a>
                </div>
            </div>
            <div class="md:w-1/2 hidden md:block relative">
                <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/860x0/filters:quality(95)/marketing/singeo/products/singing-straw/header2.webp" alt="header thumb">
{{--                <div class="absolute uppercase bg-white text-black rounded-full pb-1 pt-2 px-6 font-bebas bottom-3 lg:bottom-4 left-4 lg:left-6 autoplay-video cursor-pointer" data-open="trailer">--}}
{{--                    <i class="fa-solid fa-play mr-1"></i> play video--}}
{{--                </div>--}}
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="leading-tight font-playfair mb-3"><strong>Start singing with confidence.</strong></h3>
            <p class="leading-normal mb-4">Let your voice shine! The Singeo Singing Straw is the perfect practice<br class="hidden sm:inline">  tool to maintain a healthy and consistent singing voice.</p>
            @php
                $items = [
                    [
                        'icon' => 'fa-arrows-to-line rotate-90',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1050x0/filters:quality(95)/marketing/singeo/products/singing-straw/feature-01.webp',
                        'title' => 'Reduces Tension.',
                        'desc' => 'As you use the Singing Straw, tension gets released from your vocal cords allowing all the right muscles to relax. This leads to smoother transitions and reduced strain on your voice (meaning less vocal cracks)!',
                    ],
                    [
                        'icon' => 'fa-chart-simple',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1050x0/filters:quality(95)/marketing/singeo/products/singing-straw/feature-02.webp',
                        'title' => 'Extended Range.',
                        'desc' => 'The precise diameter of the straw creates a resistance that channels energy back to your vocal cords making it easier to sing high notes and safely develop your vocal range.',
                    ],
                    [
                        'icon' => 'fa-microphone-stand',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1050x0/filters:quality(95)/marketing/singeo/products/singing-straw/feature-03.webp',
                        'title' => 'Balanced Singing.',
                        'desc' => 'Using your Singing Straw is like a yoga class… but for your voice! It’s perfect for warming up or cooling down and improves your voice\'s flexibility, agility, and clarity.',
                    ],
                ];
            @endphp

            @foreach ($items as $index => $item)
                <img class="mb-4 w-full rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="{{ $item['img'] }}">
                <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center sm:py-10 mb-5 sm:mb-0">
                    @if ($index == 1)
                        <img class="flex-shrink-0 w-full sm:w-7/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                        >
                        <div class="flex-grow-0 max-w-xl sm:pl-5 lg:pl-8">
                            <h2 class="leading-none text-singeo"><i class="fal {{ $item['icon'] }}"></i></h2>
                            <h4 class="flex-grow-0 leading-normal mx-0 my-1 sm:my-3"><strong>{!! $item['title'] !!}</strong></h4>
                            <p class="flex-grow-0 leading-normal mx-0">{!! $item['desc'] !!}</p>
                        </div>
                    @else
                        <div class="flex-grow-0 max-w-xl sm:pr-5 lg:pr-8">
                            <h2 class="leading-none text-singeo"><i class="fal {{ $item['icon'] }}"></i></h2>
                            <h4 class="flex-grow-0 leading-normal mx-0 my-1 sm:my-3"><strong>{!! $item['title'] !!}</strong></h4>
                            <p class="flex-grow-0 leading-normal mx-0">{!! $item['desc'] !!}</p>
                        </div>
                        <img class="flex-shrink-0 w-full sm:w-7/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                        >
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#EFF3F5">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="leading-tight font-playfair mb-3"><strong>Improve your voice anywhere, anytime.</strong></h3>
            <p class="leading-normal">Whether you’re brand new to singing, looking to blow the doors off the next open mic night, or you’re a gigging musician and need to keep your voice in top shape while on the road – the Singing Straw has everything you need.</p>
            <img class="inline-block sm:hidden rounded-xl my-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/singeo/products/singing-straw/whats-inside-m.webp" alt="Eardrums kit">

            <div class="hidden sm:inline-block relative text-musora text-xs sm:text-lg my-7">
                <p class="absolute w-full text-center -top-6 sm:top-6"><strong>(Tap for more information)</strong></p>
                <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/singeo/products/singing-straw/whats-inside.webp" alt="Eardrums kit">
                <div class="info-pop cursor-pointer" style="top: 30%;left: 29%;" tip="Durable stainless steel case to keep everything organized"><i class="fas fa-info-circle"></i></div>
                <div class="info-pop cursor-pointer" style="top: 61%;left: 38%;" tip="Cleaning brush to keep your straws in perfect condition (just like your voice)"><i class="fas fa-info-circle"></i></div>
                <div class="info-pop cursor-pointer" style="top: 44%;left: 47%;" tip="3 straws in varying diameters to improve your singing"><i class="fas fa-info-circle"></i></div>
                <div class="info-pop cursor-pointer" style="top: 29%;left: 68%;" tip="Canvas carry bag"><i class="fas fa-info-circle"></i></div>
            </div>
            <div class="overflow-hidden rounded-xl border  border-black inline-block">
                <table>
                    <tbody>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse  border-black ">Straws in varying diameters</td>
                            <td class="px-5 py-1 border-b border-collapse  border-black ">3</td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse  border-black ">Cleaning brush</td>
                            <td class="px-5 py-1 border-b border-collapse  border-black "><i class="fas fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse  border-black ">Durable stainless steel case</td>
                            <td class="px-5 py-1 border-b border-collapse  border-black "><i class="fas fa-check" aria-hidden="true"></i></td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left  border-collapse  border-black ">Canvas carry bag</td>
                            <td class="px-5 py-1 border-collapse  border-black "><i class="fas fa-check" aria-hidden="true"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20 px-4 sm:px-6 text-center text-white bg-center bg-cover" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/singeo/products/singing-straw/order-bg.webp');">
        <div class="container mx-auto max-w-3xl">
            <img class="h-20 md:h-28 lg:h-32 mb-2" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/360x0/filters:quality(95)/marketing/singeo/products/singing-straw/logo-white.svg" alt="logo">
            <h3 class="font-extrabold leading-tight mb-5">
                Strengthen your voice, increase your<br class="hidden sm:inline-block">
                range, and sing with confidence.
            </h3>

            <h2 class="font-extrabold leading-tight">
                @if(floatval($productPrices['singing-straw']->discounted_price) < floatval($productPrices['singing-straw']->price))
                    <s class="opacity-50">${{ floatval($productPrices['singing-straw']->price) }}</s>
                @endif
                <strong>${{ floatval($productPrices['singing-straw']->discounted_price) }}</strong>
            </h2>
            @if(floatval($productPrices['singing-straw']->discounted_price) < floatval($productPrices['singing-straw']->price))
                <p class="text-musora">(Save {{ round(100 - (100 * (floatval($productPrices['singing-straw']->discounted_price) / floatval($productPrices['singing-straw']->price)))) }}%)</p>
            @endif
            <a class="join smaller bg-musora text-black w-1/2 mb-3 mt-5" href="/ecommerce/add-to-cart?products[singing-straw]=1&promo-code=transform">Order Now</a>
            <p class="leading-tight"><em>For hygienic reasons all singing <br class="sm:hidden"> straw sales are final.</em></p>
        </div>
    </section>

    <section class="text-center px-4 sm:px-6 py-10 md:py-20 lg:py-24">
        <div class="container mx-auto max-w-3xl">
            <h2 class="mb-5"><strong>Still have questions? </strong></h2>
            <div class="dropdowns  mx-auto px-4">
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "Why can’t I just use a normal straw?",
                "desc" => "Most normal straws are too wide to create the pressure needed to affect your vocal folds. The Singeo Singing Straw was engineered to precise diameters, creating the perfect airflow to improve your voice. And every voice is different (some will need more resistance than others). That’s why you can mix and match these straws to create the perfect resistance for your own voice!",
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "How do I clean my Singeo Singing Straw?",
                "desc" => "Easily clean your straws with the included brush or run them through a dishwasher. They’re washable, reusable, and environmentally friendly!",
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "What’s the best way to use it?",
                "desc" => "The most common uses for the Singeo Singing Straw include warming up your vocals, resetting your voice between songs, and cooling down after practice. Log in to your <a href='https://www.musora.com/singeo/enrollment/5-days-to-transform-your-voice'>Singeo Membership</a> to access all the lessons on how to improve your voice using the Straw.",
                ])
                @include('_partials.components.question-dropdown', [
                "num" => "?",
                "title" => "What’s the science behind how it works?",
                "desc" => "Singing through a straw is a powerful “semi-occluded vocal tract” (SOVT) exercise, which means that as you vocalize, the air coming out of your mouth is partially blocked. This creates a resistance in the vocal tract, which sends energy back to the vocal folds and helps them vibrate more efficiently.",
                ])
            </div>
        </div>
    </section>

{{--    @include('_partials.components.video-modal',[--}}
{{--        'name' => 'trailer',--}}
{{--        'video' => '738333190',--}}
{{--        'vimeo' => true,--}}
{{--    ])--}}
    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
{{--    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>--}}
@endsection
