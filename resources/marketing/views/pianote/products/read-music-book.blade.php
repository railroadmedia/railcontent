@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>The Most Beautiful Classical Piano Pieces | Pianote</title>
    <meta property="og:title" content="The Most Beautiful Classical Piano Pieces | Pianote">
    <meta name="description" content="Timeless classics you’ll want to play over and over again. Presented in original and simplified arrangements.">
    <meta property="og:description" content="Timeless classics you’ll want to play over and over again. Presented in original and simplified arrangements.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/share-image.jpg" style="display: none;">
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
            background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/header-image-m.jpg);
            background-size: 290px;
        }
        @media (min-width: 768px) {
            header {
               background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/header-image.jpg);
                background-size: cover;
            }
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
        "name" => "Classical Piano Pieces",
        "fullPrice" => floatval($productPrices['classical-piano-pieces']->price),
        "price" => floatval($productPrices['classical-piano-pieces']->discounted_price),
        "noBreadcrumb" => true
    ])
    <header class="px-5 sm:px-6 pt-72 pb-12 sm:py-20 lg:py-36 bg-top bg-no-repeat" style="background-color:#F1F7FE;">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/logo-light.svg">
                    <p class="leading-normal my-4 sm:my-6"><strong>Learn the language of music</strong> with 30 days of guided lessons and exercises.</p>
                    <h4 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['classical-piano-pieces']->price) > floatval($productPrices['classical-piano-pieces']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['classical-piano-pieces']->price) }}</s>
                            <strong>${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['classical-piano-pieces']->discounted_price) / floatval($productPrices['classical-piano-pieces']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong>
                        @endif
                        </h4>
                    <a href="/ecommerce/add-to-cart?products[classical-piano-pieces]=1" class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F1EFED">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight mb-3"><strong>Learn to Read Music… By PLAYING Music</strong></h2>
            <h6 class="leading-normal italic mb-4">Connect the notes on the page to the keys on your <br class="hidden sm:inline"> piano with daily lesson and practice exercises.</h6>

            @php
                $items = [
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-01.webp',
                        'desc' => '<strong> Know exactly what to practice. </strong> Reading music is like learning a language. And just like learning a language, you need to know where to start. Read Music in 30 Days starts from the beginning, and gradually progresses each day. Just turn the page each day and follow along.',
                        'alt'=> 'todo'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-03a.webp',
                        'desc' => '<strong>The PERFECT companion book. </strong> This book has been designed to be used WITH our 30-Day Challenge. Each day’s exercises are exactly the same as the videos, with added explanations. And you’ll find lots of bonus exercises at the back of the book.',
                        'alt'=> 'todo'
                    ],
                    [
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-02.webp',
                        'desc' => '<strong>Sight Reading reference guide. </strong> You’ll find a “Keys to Sight Reading” reference guide at the beginning of the book. This guide is your go-to reference for note names, key signatures, note values, time signatures and all the sight reading elements you’ll learn during the Challenge.',
                        'alt'=> 'todo'
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

    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 mb-20 sm:mb-24" style="background-color:#0E1523;">
        <div class="container max-w-6xl mx-auto">
            <h3 class="leading-tight text-center mb-6 sm:mb-7"><strong>The best way to <br class="inline sm:hidden"> play your favorites.</strong></h3>

            @php
                $slides = [
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-04a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-06a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-03a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-02a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-05a.jpg',
                 ],
                 [
                     'img' => 'marketing/pianote/products/classical-piano-pieces/collage-01a.jpg',
                 ],

             ];

             $scaleAnimation = 'cursor-pointer transform transition duration-500 ease-in-out hover:scale-105';
             $handleClick = 'handleClick';
            @endphp

            @component('drumeo._partials.modal-carousel', ['slides' => $slides, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap items-center">
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(1)"
                                class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-3 w-full">
                            <div @click="handleClick(3)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(2)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[2]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(0)"
                                class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')">
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 md:w-1/4">
                        <div class="p-3 w-full">
                            <div @click="handleClick(5)"
                                class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[5]['img'] }}')">
                            </div>
                        </div>
                        <div class="p-3 w-full">
                            <div  @click="handleClick(4)"
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

    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 bg-cover bg-top" style="background:#f7fbfe url(https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/order-bg.jpg);">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left sm:order-1 px-10 sm:px-0">
                    <img class="-mt-32 sm:-mt-36 mb-4 sm:-mb-12 w-full max-w-xs sm:max-w-md" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/order-book.png">
                </div>
                <div class="w-full sm:w-5/12 text-center lg:text-left sm:pr-5">
                    <img class="h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/logo-light-dark.svg">
                    <p class="leading-normal my-4 sm:my-6"><strong>Learn the language of music</strong> with 30 days of guided lessons and exercises.</p>
                    <h4 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['classical-piano-pieces']->price) > floatval($productPrices['classical-piano-pieces']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['classical-piano-pieces']->price) }}</s>
                            <strong>${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['classical-piano-pieces']->discounted_price) / floatval($productPrices['classical-piano-pieces']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="/ecommerce/add-to-cart?products[classical-piano-pieces]=1" class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
