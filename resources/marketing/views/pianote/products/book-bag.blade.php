@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Book Bag | Pianote</title>
    <meta property="og:title" content="BookBag | Pianote">

    <meta name="description" content="A handcrafted premium leather satchel for your music books, laptop, and life.">
    <meta property="og:description" content="A handcrafted premium leather satchel for your music books, laptop, and life.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/book-bag/book-bag-share-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join.outline.red {
            border-color: #F61A30;
            color: #0b76db;
        }

        .join.smaller.outline {
            padding: 12px 7%;
            border-color: #F61A30;
            background-color: rgb(18, 18, 6, 0.3);
        }

        .join.smaller.outline:hover {
            background-color: #F61A30;
            color: #FFFFFF;
        }

        .join i {
            transition: all .3s;
            position: relative;
            right: 0;
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }

        .font-playfair {
            font-family: "Playfair Display", serif;
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            width: 1%;
            font-weight: 700;
            text-align: left;
        }

        .content-section table.comparison.eardrums tr td:nth-child(2) {
            color: #5B6068;
            background-color: #F1EFED;
        }

        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(2) {
            background-color: #D7D3CF;
        }

        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 27.33%;
            border: none;
        }

        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            color: #5B6068;
            background-color: #DBE1E9;
        }

        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(3),
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(4) {
            background-color: #CDD4DC;
        }

        .content-section table.comparison tr:hover td:nth-child(3),
        .content-section table.comparison tr:hover td:nth-child(4),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(3),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(4) {
            background-color: #CDD4DC;
        }

        .content-section table.comparison tr:hover td:nth-child(2),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(2),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color: #D7D3CF;
        }

        .content-section table.comparison.eardrums tr td {
            color: black;
            padding: 15px 7px;
            font-size: 12px;
            text-transform: capitalize;
        }

        .content-section table.comparison.eardrums tr:last-child td {
            padding: 15px 7px 30px;
        }



        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
                font-size: 16px;
            }
            .content-section table.comparison.eardrums tr:nth-child(2n) td strong {
                font-size: 28px;
                color: #5B6068;
            }
            .content-section table.comparison.eardrums tr:last-child td strong {
                font-size: 36px;
            }

            .content-section table.comparison.eardrums tr:last-child td s {
                font-size: 28px;
                font-weight:400;
            }
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            text-transform: capitalize;
        }

        @media (max-width: 767px) {

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

        table.comparison {
            border-spacing: 15px 0;
            cursor: pointer;
            @media (max-width: 767px) {
                border-spacing: 7px 0;
            }
        }
    </style>
    <style>
        .messy-bg {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/book-bag/messy.webp');
        }
        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 4px;
            height: 705px;
            background: #191617;
            cursor: move;
            transition: all 300ms ease;
            margin-left: 4px;
        }
    </style>
    @php
        if(!empty($membersVersion)) {
             $orderUrl = '/ecommerce/add-to-cart?products[pianote-book-bag]=1&promo-code=members&locked=true';
             $discountedPrice = 149;
        }
        else {
             $orderUrl = '/ecommerce/add-to-cart?products[pianote-book-bag]=1';
             $discountedPrice = $productPrices['pianote-book-bag']->discounted_price;
        }
    @endphp
@stop

@section('body-data')
    x-data="{
    trailer: false,
    trailerM: false,
    }"
@endsection

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="pianote logo" class="h-20 md:h-28 lg:h-32"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/book-bag/pianote-bookbag-logo-white.svg"><br>
                <h6 class="py-4 sm:py-6 px-4">A handcrafted premium leather satchel for your music books, laptop, and life.</h6>
                <h3 class="leading-tight">
                    @if (floatval($productPrices['pianote-book-bag']->price) > floatval($discountedPrice))
                        <s class="opacity-50">${{ floatval($productPrices['pianote-book-bag']->price) }}</s>
                        <strong>${{ floatval($discountedPrice) }}</strong>
                        <span class="text-xl">(Save
                            {{ round(100 - 100 * (floatval($discountedPrice) / floatval($productPrices['pianote-book-bag']->price))) }}%)</span>
                    @else
                        <strong>Only ${{ floatval($discountedPrice) }}</strong>
                    @endif
                </h3>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block text-pianote hover:bg-pianote hover:text-white"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false"
                        @click="trailer = true;">
                        <i class="fas fa-play" :class="{ 'translate-x-2': move }"></i> &nbsp;Watch Video
                    </div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block text-pianote hover:bg-pianote hover:text-white"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false"
                        @click="trailerM = true;">
                        <i class="fas fa-play" :class="{ 'translate-x-2': move }"></i> &nbsp;Watch Video
                    </div>
                    @if ($products['pianote-book-bag']->getStockAvailability() > 1 && !empty($products['pianote-book-bag']->getStockAvailability()))
                        <a class="w-5/12 join smaller text-white bg-pianote m-2 hover:bg-red-500"
                            href="#customize-anchor" x-data="{ move: false }" @mouseover="move = true"
                            @mouseout="move = false">Order Now</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                </div>
                {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Pianote Membership.</em></h6> --}}
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0, 0, 0, 0.6)"></div>
        <!-- <img class="object-cover w-full relative z-0" style="height: 700px;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/hero-image.webp"> -->
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop
            playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/book-bag/book-bag-hero-reel-wide-to-loop-1.mp4"></video>
    </header>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight font-playfair pb-2 sm:pb-4 lg:pb-6"><strong>The beauty is in the <br class="sm:hidden">
                    details.</strong></h2>
            @php
                $gridItems = [
                    [
                        'img' => 'marketing/pianote/products/book-bag/tanned.webp',
                        'desc' => '<strong>Single leather handle</strong> provide easy carrying options and minimalistic styling.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/back-pockets.webp',
                        'desc' => '<strong>External side and back</strong> pockets <br/>for easy access and extra security.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/handle.webp',
                        'desc' => '<strong>Premium-grade, oil-tanned leather</strong> ensures a classic look that only gets better with age.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/sleeve.webp',
                        'desc' => '<strong>16-inch laptop sleeve </strong> <br/>keeps your computer safe.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/emobssed.webp',
                        'desc' => '<strong>Custom Pianote embossing</strong> provides a subtle yet distinctive look. This bag is for piano players.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/magnetic-clasps.webp',
                        'desc' => '<strong>Magnetic clasps</strong> give you modern access while keeping  a vintage buckle look.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/removable.webp',
                        'desc' => '<strong>Removable shoulder strap</strong> for convenience and comfort.',
                    ],
                ];
            @endphp
            <div class="hidden lg:block">
                <div class="flex flex-wrap items-center justify-around text-left">
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[0]['desc'] !!}</p>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[1]['desc'] !!}</p>
                    </div>
                    <div class="w-full flex justify-center content-around py-3">
                        <div class="w-auto max-w-xs py-12 flex flex-wrap content-around">
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[2]['desc'] !!}</p>
                            </div>
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[3]['desc'] !!}</p>
                            </div>
                        </div>
                        <div class="w-7/12 flex-shrink-0">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-graph.webp">
                        </div>
                        <div class="w-auto max-w-xs flex flex-wrap content-around">
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[4]['desc'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[5]['desc'] !!}</p>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[6]['desc'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!--mobile view-->
        <div class="lg:hidden mb-5" x-data="{
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
                drag: 'free',
                snap: false,
                lazyLoad: 'nearby',
                breakpoints: {
                    767: {
                        perPage: 1.5,
                    },
                },
            }).mount()
        },
    }">
            <div x-ref="splide" class="splide text-left">
                <div class="splide__track pb-8">
                    <ul class="splide__list items-start">

                        @foreach ($gridItems as $gridItem)
                            <li class="splide__slide px-1">
                                <div class="rounded-xl overflow-hidden shadow-md" style="background-color:#F1EFED;">
                                    <div class="relative" style="padding-bottom:71%;">
                                        <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                            loading="lazy" onload="this.classList.remove('opacity-0')" alt="Pianote Book Bag Details"
                                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                    </div>
                                    <div class="flex items-start justify-start h-28">
                                        <p class="text-base leading-wide font-playfair m-0 px-6 py-4">
                                            {!! $gridItem['desc'] !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="text-white pt-8 sm:pt-16 lg:pt-20" style="background: #191617;">
        <div class="container mx-auto max-w-5xl">
            <h2 class="text-center leading-tight font-playfair mb-3 relative z-10"><strong>Organize the chaos</strong></h2>
            <p class="text-center leading-normal -mb-10 sm:-mb-24 lg:-mb-32 relative z-10 px-3 sm:px-4">
                Let’s be honest. Your practice space looks like a mad scientist's desk. Books, staff paper,<br class="hidden sm:inline">
                sheet music, pens. It’s time to tame your space and organize the chaos with your Pianote BookBag.</p>

            <div x-data="{ sliderValue: 50 }" class="relative transform-gpu w-full overflow-hidden mx-auto h-96 sm:h-[44rem]" style="transform-style: preserve-3d;">
                <div class="image absolute h-full left-0 top-0 bg-no-repeat bg-[length:530px] sm:bg-[length:960px] messy-bg z-10"  :style="`width: ${sliderValue}%;`"></div>
                <div class="image absolute h-full left-0 top-0 bg-no-repeat bg-[length:530px] sm:bg-[length:960px] bg-center w-full" style="background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/book-bag/clean.webp');"></div>

                <input x-model="sliderValue" class="range-slider flex absolute w-full h-full m-0 items-center justify-center bg-transparent outline-none transition-all duration-200 appearance-none z-50"
                    type="range" min="1" max="100" />

                <div :style="`left: ${sliderValue}%; background: #191617;`" class="text-white rounded-full w-8 top-1/2 mt-10 sm:mt-24 lg:mt-32 block relative z-20 text-center py-1 cursor-move transform -translate-x-1/2 -translate-y-1/2 translate-y-[-50%]">
                    <i class="fa fa-chevron-left text-xs"></i>
                    <i class="fa fa-chevron-right text-xs"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F1EFED">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight font-playfair mb-3"><strong>From concert halls to city streets.</strong></h2>
            <h6 class="leading-normal italic mb-4">The Pianote Book Bag oozes style. This beautiful leather satchel<br class="hidden sm:inline"> will look at home in Carnegie Hall and next to your Casio.</h6>

            @php
                $items = [
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-01.webp',
                        'desc' => '<strong> Designed to be used, </strong> the Pianote Book Bag combines fashion and function to ensure you never have to leave the important things behind.',
                        'alt'=> 'A woman carrying The Pianote Book Bag, showcasing its fashionable and functional design.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-03a.webp',
                        'desc' => '<strong>Five separate internal compartments </strong> give you enough space for your music books, sheet music, notebooks, and a laptop. This messenger bag is your everyday carry for the things that matter most.',
                        'alt'=> 'Stack of music sheets neatly organized inside The Pianote Book Bag.'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-02.webp',
                        'desc' => '<strong>The premium leather </strong> will only look better with age. This is truly a luxury bag that doesn’t come with the pretense. <br/><br/>But don’t worry… <br/><br/> You’ll still get compliments every time you leave the house.',
                        'alt'=> 'Front view of The Pianote Book Bag, highlighting its premium leather construction that ages beautifully.'
                    ]
                ];
            @endphp

            @foreach ($items as $index => $item)
                <img class="my-4 w-full rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="{{ $item['img'] }}"
                    alt="{{ $item['alt'] }}">
                <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center sm:py-10">
                    @if ($index % 2 == 0)
                        <img class="flex-shrink-0 w-full sm:w-7/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                            alt="{{ $item['alt'] }}"
                        >
                        <h6 class="flex-grow-0 leading-normal max-w-xl sm:pl-5 lg:pl-8 mx-0">
                            {!! $item['desc'] !!}
                        </h6>
                    @else
                        <h6 class="flex-grow-0 leading-normal max-w-xl sm:pr-5 lg:pr-8 mx-0">
                            {!! $item['desc'] !!}
                        </h6>
                        <img class="flex-shrink-0 w-full sm:w-7/12 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="{{ $item['img'] }}"
                            alt="{{ $item['alt'] }}"
                        >
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <section class="relative overflow-hidden px-5 sm:px-7 py-10 sm:py-16 lg:py-24">
        <div class="inset-0 hidden sm:block absolute bg-center bg-cover z-0 mx-auto" style="max-width:1920px;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/products/book-bag/made-with-love2.webp');"></div>
        <div class="inset-0 block sm:hidden absolute bg-top bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/made-with-love-m2.webp');"></div>

        <div class="container mx-auto max-w-5xl relative z-10">
            <div class="w-full sm:w-7/12 lg:w-1/2">
                <div class="p-5 sm:px-10 sm:py-10 mt-60 sm:mt-0 rounded-xl text-left text-white" style="background: rgba(18, 18, 16, 0.9);">
                    <h2 class="leading-tight font-playfair pb-2 sm:pb-4">Made with love. And priced that way too.</h2>
                    <p class="leading-tight text-sm lg:text-base">
                        The Pianote Book Bag is custom-designed by leather artisans in the USA. Each bag is handmade with a level of craftsmanship and quality comparable to bags in the $300 - $600 price range. <br><br> But we’re not here for the mark-up. <br><br>We love our students and genuinely think this bag will make your life better. So we’re committed to keeping the price affordable, without compromising on quality.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section text-center comparison px-1 lg:px-3 py-10 md:py-16" style="background:#F5F5F5;" x-data="{ tableClass: 'earbuds' }">
        <div class="container mx-auto max-w-5xl">
            <h2 class="mb-16 md:mb-12 text-black font-playfair"><strong>See how the Pianote Book Bag <br class="sm:hidden">  compares. </strong></h2>
            <div class="relative">
                <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table :class="{'earbuds': tableClass === 'earbuds', 'headphones': tableClass === 'headphones'}"  class="w-full mx-auto border-separate comparison eardrums earbuds">
                    <tbody style="background-color:transparent!important;">
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl">
                            <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-comparison-new.webp" alt="The Pianote Book Bag">
                        </td>
                        <td class="rounded-t-xl" @click="tableClass = 'headphones'">
                            <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-comparison-01.webp" alt="Brand Name Messenger Bag">
                        </td>
                        <td class="rounded-t-xl" @click="tableClass = 'earbuds'">
                            <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-comparison-02.webp" alt="Brand Name Satchel Bag">
                        </td>
                    </tr>
                    <tr>
                        <td>Leather</td>
                        <td>Premium Oil-Tanned Leather</td>
                        <td>Full-Grain Leather</td>
                        <td>Vintage Tribe Leather</td>
                    </tr>
                    <tr>
                        <td>Laptop Sleeve</td>
                        <td>16” Laptop Sleeve</td>
                        <td>16” Laptop Sleeve</td>
                        <td>13” Laptop Sleeve</td>
                    </tr>
                    <tr>
                        <td>External Pockets</td>
                        <td>Yes</td>
                        <td>Yes</td>
                        <td>Yes</td>
                    </tr>
                    <tr style="background-color:transparent!important;">
                        <td class="rounded-b-xl">Total</td>
                        <td class="rounded-b-xl text-black">
                            @if(floatval($productPrices['pianote-book-bag']->price) > floatval($discountedPrice))
                                <s class="opacity-40">${{ floatval($productPrices['pianote-book-bag']->price) }}</s>
                            @endif
                            <strong>${{ floatval($discountedPrice) }}</strong>
                        </td>
                        <td class="rounded-b-xl"><strong>$349</strong></td>
                        <td class="rounded-b-xl"><strong>$448</strong></td>
                        @php
                            floatval($productPrices['pianote-book-bag']->price)
                        @endphp
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="text-center py-10 md:py-16" style="background: #F1EFED;">

        <img alt="pianote logo block center" class="h-20 sm:h-24 md:h-26 lg:h-30"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/280x0/filters:quality(95)/marketing/pianote/products/book-bag/pianote-bookbag-logo-black.svg">

        <div class="container mx-auto max-w-5xl">
            <div id="customize-anchor" class="anchor"></div>
            <div
                class="flex flex-wrap items-start justify-center flex-col-reverse md:flex-row max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto">

                @if(!empty($membersVersion))
                    @include('pianote.products.partials._promo-card', [
                        'topBadgeText' => 'Save ' . round(100 - 100 * (floatval($discountedPrice) / floatval($productPrices['pianote-book-bag']->price))) . '%',
                        'productTheme' => 'black',
                        'cardTitle' => 'Book Bag Only',
                        'cardImageHeight' => 'h-40',
                        'cardImageUrl' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/order-bag-01.webp',
                        'cardDiscount' => floatval($discountedPrice),
                        'cardPrice' => floatval($productPrices['pianote-book-bag']->price),
                        'cardSubtitle' => 'One-time payment. Free shipping.',
                        'cardButtons' => [
                            [
                                'link' => $orderUrl,
                                'text' => 'Select'
                            ]
                        ],
                        'cardBonuses' => ['Premium Oil-Tanned Leather', '16” Laptop Sleeve', 'Custom Embossed'],
                        'sku' => 'pianote-book-bag',
                    ])
                @endif
                @include('pianote.products.partials._promo-card', [
                    'topBadgeText' => 'LAUNCH SPECIAL',
                    'productTheme' => 'pianote',
                    'cardTitle' => 'The Book Bag Bundle',
                    'cardImageHeight' => 'h-40',
                    'cardImageUrl' =>
                        'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/order-bag-02.webp',
                    'cardDiscount' => 249,
                    'cardPrice' => 376,
                    'cardSubtitle' => 'One-time payment. Free shipping.',
                        'cardButtons' => [
                            [
                                'link' => '/ecommerce/add-to-cart?products[pianote-book-bag]=1&products[piano-chords-and-scales-guide]=1&products[classical-piano-pieces]=1&products[pianote-practice-planner]=1&promo-code=launch-bundle&redirect=/order&locked=true',
                                'text' => 'Select'
                            ]
                        ],
                    'cardBonuses' => [
                        'Pianote Book Bag',
                        'Chords & Scales Book',
                        'Practice Planner',
                        'The Most Beautiful Classical Piano Pieces',
                    ],
                    'sku' => 'pianote-book-bag',
                ])

            </div>
            <a href="/" class="text-center text-xs italic pt-4"><h6><u>Or get your bag FREE with a Pianote Membership</u></h6></a>
        </div>

    </section>

    <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-white">
                <p>Call us toll-free at
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
        'name' => 'trailer',
        'video' => '913081651',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailerM',
        'video' => '913519565',
        'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
    ])

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
