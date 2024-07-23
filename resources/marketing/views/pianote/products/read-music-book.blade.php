@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Companion Book | Pianote</title>
    <meta property="og:title" content="Companion Book | Pianote">
    <meta name="description" content="Learn the language of music with 30 days of guided lessons and exercises.">
    <meta property="og:description" content="Learn the language of music with 30 days of guided lessons and exercises.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/products/read-music-book/book-share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <style>

        header {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/read-music-book/header-bg-m2.webp');
            background-size: cover;
        }

        @media (min-width: 639px) {
            header {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2100x0/filters:quality(95)/marketing/pianote/products/read-music-book/header-bg2.webp');
                background-size: cover;
            }
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])
    @include('_partials.components.shop.promo-banner-3', [
        'name' => 'Classical Piano Pieces',
        'fullPrice' => floatval($productPrices['read-music-in-30-days-workbook']->price),
        'price' => floatval($productPrices['read-music-in-30-days-workbook']->discounted_price),
        'noBreadcrumb' => true,
    ])
    <header class="px-5 sm:px-6 pt-64 pb-12 sm:py-20 lg:py-36 bg-top" style="background-color:#F1F7FE;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center mt-28 sm:mt-0">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-28" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/read-music-book/logo.webp"
                        alt="Read Music in 30 Days Logo">
                    <h4 class="leading-tight my-4 sm:my-6 text-black"><strong>Learn the language of music</strong> <br> with 30 days of
                        guided lessons and exercises.</h4>
                    <h2 class="mb-4 sm:mb-6">
                        @if (floatval($productPrices['read-music-in-30-days-workbook']->price) >
                                floatval($productPrices['read-music-in-30-days-workbook']->discounted_price))
                            <strong></strong> <s
                                class="opacity-60">${{ floatval($productPrices['read-music-in-30-days-workbook']->price) }}</s>
                            <strong>${{ floatval($productPrices['read-music-in-30-days-workbook']->discounted_price) }}</strong>
                            (SAVE
                            {{ round(100 - 100 * (floatval($productPrices['read-music-in-30-days-workbook']->discounted_price) / floatval($productPrices['read-music-in-30-days-workbook']->price))) }}%)
                        @else
                            <strong>
                                ${{ floatval($productPrices['read-music-in-30-days-workbook']->discounted_price) }}</strong>
                        @endif
                    </h2>
                    <a href="/ecommerce/add-to-cart?products[read-music-in-30-days-workbook]=1"
                        class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#FFFFFF">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-3"><strong>Learn to Read Music… By <br class="md:hidden"> PLAYING Music</strong></h2>
            <h6 class="leading-normal mb-4"><em>Connect the notes on the page to the keys on your <br
                    class="hidden sm:inline"> piano with daily lesson and practice exercises.</em></h6>

            @php
                $items = [
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-book/feature-01.webp',
                        'desc' =>
                            'Reading music is like learning a language. And just like learning a language, you need to know where to start. Read Music in 30 Days starts from the beginning, and gradually progresses each day. Just turn the page each day and follow along.',
                        'alt' => 'Piano player reading sheet music',
                        'icon' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-book/feature-icon-01.svg',
                        'title' => 'Know exactly what to practice.',
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-book/feature-02.webp',
                        'desc' =>
                            'This book has been designed to be used WITH our 30-Day Challenge. Each day’s exercises are exactly the same as the videos, with added explanations. And you’ll find lots of bonus exercises at the back of the book.',
                        'alt' => 'Read Music in 30 Days Workbook',
                        'icon' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-book/feature-icon-02.svg',
                        'title' => 'The PERFECT Companion Book.',
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-book/feature-03.webp',
                        'desc' =>
                            'You’ll find a “Keys to Sight Reading” reference guide at the beginning of the book. This guide is your go-to reference for note names, key signatures, note values, time signatures and all the sight reading elements you’ll learn during the Challenge.',
                        'alt' => 'Piano and Reading Music Book',
                        'icon' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/read-music-book/feature-icon-03.svg',
                        'title' => 'Sight Reading reference guide.',
                    ],
                ];
            @endphp


            @foreach ($items as $index => $item)
                <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                    @if ($index % 2 != 0)
                        <img class="w-full sm:w-6/12 md:w-7/12 rounded-xl overflow-hidden transition-opacity opacity-0 order-1 sm:order-1"
                            loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $item['img'] }}" alt="{{ $item['alt'] }}">
                    @else
                        <img class="w-full sm:w-6/12 md:w-7/12 rounded-xl overflow-hidden transition-opacity opacity-0 order-1 sm:order-2"
                            loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $item['img'] }}" alt="{{ $item['alt'] }}">
                    @endif

                    <div class="flex flex-row md:flex-col sm:flex-1 justify-center items-start py-4 {{ $index % 2 != 0 ? 'sm:pl-4 md:pl-10' : 'sm:pr-4 md:pr-10' }} order-2 sm:order-1">
                        <img class="h-10 mb-2 mr-3 sm:hidden" src="{{ $item['icon'] }}" alt="Icon">
                        <div>
                        <img class="h-9 mr-3 hidden sm:inline-block" src="{{ $item['icon'] }}" alt="Icon">
                        <h3 class="leading-tight mx-0 my-2 sm:my-4"><strong>{{ $item['title'] }}</strong></h3>
                        <p class="leading-normal max-w-xl">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </section>

    <section class="text-white text-center px-5 sm:px-6 pt-10 pb-24 sm:py-16 lg:py-20"
        style="background-color:#0E1523;">
        <div class="container max-w-6xl mx-auto lg:mb-12">
            <h3 class="leading-tight text-center mb-6 sm:mb-7"><strong>The best way to <br class="inline sm:hidden"> play your favorites.</strong></h3>

            @php
                $slides = [
                    [
                        'img' => 'marketing/pianote/products/read-music-book/book-05.webp',
                    ],
                    [
                        'img' => 'marketing/pianote/products/read-music-book/book-03.webp',
                    ],
                    [
                        'img' => 'marketing/pianote/products/read-music-book/book-06.webp',
                    ],
                    [
                        'img' => 'marketing/pianote/products/read-music-book/book-01.webp',
                    ],
                    [
                        'img' => 'marketing/pianote/products/read-music-book/book-02.webp',
                    ],
                    [
                        'img' => 'marketing/pianote/products/read-music-book/book-03b.webp',
                    ],
                ];

                $scaleAnimation = 'cursor-pointer transform transition duration-500 ease-in-out hover:scale-105';
                $handleClick = 'handleClick';
            @endphp

            @component('drumeo._partials.modal-carousel', [
                'slides' => $slides,
                'scaleAnimation' => $scaleAnimation,
                'handleClick' => $handleClick,
            ])
                <div class="flex flex-wrap items-center">
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-1 w-full">
                            <div @click="handleClick(1)"
                                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-1 w-full">
                            <div @click="handleClick(3)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-1 w-full">
                            <div @click="handleClick(2)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[2]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-1 w-full">
                            <div @click="handleClick(0)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-1 w-full">
                            <div @click="handleClick(5)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[5]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-1 w-full">
                            <div @click="handleClick(4)"
                                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')">
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent
        </div>

    </section>

    <div id="final" class="anchor"></div>

    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20" style="background:#f1f7fe">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left sm:order-1 px-10">
                    <img class="-mt-32 sm:-mt-36 mb-4 sm:-mb-12 w-full max-w-xs lg:max-w-md"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/950x0/filters:quality(95)/marketing/pianote/products/read-music-book/RMI30D-book2.webp"
                        alt="Read Music Book Cover">
                </div>
                <div class="w-full sm:w-5/12 text-center lg:text-left sm:pr-5">
                    <img class="h-24 lg:h-28" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/read-music-book/logo.webp"
                        alt="Read Music in 30 Days Logo">
                    <h4 class="leading-tight my-4 sm:my-6 text-black"><strong>Learn the language of music</strong> <br> with 30 days of
                        guided lessons and exercises.</h4>
                    <h2 class="mb-4 sm:mb-6">
                        @if (floatval($productPrices['read-music-in-30-days-workbook']->price) >
                                floatval($productPrices['read-music-in-30-days-workbook']->discounted_price))
                            <strong></strong> <s
                                class="opacity-60">${{ floatval($productPrices['read-music-in-30-days-workbook']->price) }}</s>
                            <strong>${{ floatval($productPrices['read-music-in-30-days-workbook']->discounted_price) }}</strong>
                            (SAVE
                            {{ round(100 - 100 * (floatval($productPrices['read-music-in-30-days-workbook']->discounted_price) / floatval($productPrices['read-music-in-30-days-workbook']->price))) }}%)
                        @else
                            <strong>
                                ${{ floatval($productPrices['read-music-in-30-days-workbook']->discounted_price) }}</strong>
                        @endif
                    </h2>
                    <a href="/ecommerce/add-to-cart?products[read-music-in-30-days-workbook]=1"
                        class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </section>

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
