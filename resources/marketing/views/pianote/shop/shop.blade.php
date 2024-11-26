@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">

    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/share-image-home.jpg">
{{--    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg">--}}
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <style>
        .splide__pagination__page.is-active {
            background:#ddd!important;
        }
        .splide .splide__arrow svg {
            fill:#F61A30 !important;
        }
    </style>
    <style>
        @media (min-width: 1536px) { /* Desktop */
            .product-wrap:nth-child(n+11) {
                display: none;
            }
        }

        @media (min-width: 767px) and (max-width: 1535px) { /* Tablet */
            .product-wrap:nth-child(n+9) {
                display: none;
            }
        }

        @media screen and (max-width: 768px) { /* Mobile */
            .product-wrap:nth-child(n+7) {
                display: none;
            }
        }

        /* Show all when 'show-all' class is added */
        .show-all .product-wrap {
            display: block !important;
        }

        .join.outline.black {
            background:transparent;
            border:2px solid #000;
            color:#000;
            outline:none!important;
        }

        .join.outline.black:hover,
        .join.outline.black:focus {
            background:#000;
            color:#fff;
        }
    </style>
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.promo-shop-header',[
        'text' => 'Save up to 90% on piano lessons, gear & more!',
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/pianote/promos/black-friday/home/save-badge.webp',
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/427x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png',
        'logoStyles' => 'h-12 sm:h-20 pb-2 sm:pb-3',
        'bg' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/promos/black-friday/home/BF-header-banner.webp',
    ])
    @include('_partials.components.shop.index-filters')



    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php
            $bundles = [
                [
                    'slug' => '/shop/prima',
                    'full' => true,
                    'visible' => 1,
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2100x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/keyboard-bundle-full2.webp',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/keyboard-bundle-full-m.webp',
                ],
                [
                    'slug' => '/shop/book-bundle',
                    'full' => true,
                    'visible' => 1,
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2100x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/book-bundle-full-70.webp',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/book-bundle-full-m-70.webp',
                ],
                [
                    'slug' => '/shop/prima-ultimate',
                    'full' => true,
                    'visible' => 1,
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2100x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/ultimate-bundle-full2.webp',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/ultimate-bundle-full-m.webp',
                ],
            ];
        @endphp
        <section x-show="filter === 'all'">
            <div class="container mx-auto">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-fire text-{{ $brand }} mr-1"></i> Featured</strong></h5>
                <div class="flex flex-wrap mb-5 sm:mb-10">
                    <a href="/shop/pianote-deal" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/pianote-deal-3.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/pianote-deal-3.webp');"></div>
                        </div>
                    </a>
                    <a href="/lifetime" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]">
{{--                                <p class="z-20 absolute top-0 left-0 rounded-br-md bg-musora text-black font-black leading-none uppercase py-1 px-2 w-auto inline-block text-xs"--}}
{{--                                style="background-color: #db182c!important;color:#fff!important;"--}}
{{--                                >Last Chance</p>--}}
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/lifetime-deal2.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/lifetime-deal2.webp');"></div>
                        </div>
                    </a>
                    <div class="w-full p-2">
                        <div class="flex flex-wrap sm:flex-nowrap items-center space-around border border-gray-300 px-4 sm:px-7 lg:px-6 py-4 sm:py-5 rounded-lg inline-block mx-auto"
                            style="background:linear-gradient(to right, #C3FFD7, #C3E4FF, #B2FFFB);">
                            <p class="leading-normal flex-shrink-0 text-center pr-4 mb-3 sm:mb-0"><i class="fas fa-sparkle mr-3"></i><strong class="font-black">ALL BLACK FRIDAY BUNDLES<i class="fas fa-sparkle ml-3 inline lg:hidden"></i><br class="lg:hidden"> = LOCKED CARTS</strong><i class="fas fa-sparkle ml-3 hidden lg:inline"></i></p>
                            <p class="leading-normal text-sm text-center sm:text-left max-w-lg">You’ll get FREE SHIPPING for USA/Canada and discounted shipping worldwide.
                                You won’t be able to add or remove items for any featured bundle.</p>
                        </div>
                    </div>
                    <div class="w-full">
                        @include('_partials.layout.holiday.bundle-tiles')
                    </div>
                </div>
            </div>
        </section>

        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-globe-pointer text-{{ $brand }} mr-1"></i> Digital Deals</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                    :class="{ 'show-all': showAll }">
{{--                @include('_partials.components.shop.product-card', [--}}
{{--                    "badge" => "7-Day Free Trial",--}}
{{--                      "price" => 240,--}}
{{--                     "instructor" => "Unlimited Piano Lessons",--}}
{{--                      "discounted_price" => 240,--}}
{{--                      "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/july/pianote-membership-shop.jpg",--}}
{{--                      "title" => "Pianote Membership",--}}
{{--                      'soldOut' => false,--}}
{{--                        "href" => "/",--}}
{{--                 ])--}}
                @foreach($lessons as $key => $lesson)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $lesson->badge_text,
                        "price" => $lesson->price,
                        "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "instructor" => $lesson->instructor_name,
                        "logo" => $lesson->thumbnail_logo,
                        "discounted_price" => $lesson->discounted_price,
                        "soldOut" => $lesson->sold_out,
                        "thumbnail" => $lesson->thumbnail,
                        "title" => $lesson->name,
                        'fetch' => $key < 4 ? true : null,
                        "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                    ])
                @endforeach
                    <div x-cloak x-show="filter === 'lessons'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/shop/pianote-deal",
                             "price" => 240,
                             "discounted_price" => 140,
                             "title" => "The Pianote Deal",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/pianote-deal-square.webp",
                             'soldOut' => false,
                        ])
                    </div>
                    <div x-cloak x-show="filter === 'lessons'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/lifetime",
                             "price" => 1200,
                             "discounted_price" => 1200,
                             "title" => "Lifetime Membership",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/lifetime-deal-square.webp",
                             'soldOut' => false,
                        ])
                    </div>
{{--                    @include('_partials.components.shop.product-card', [--}}
{{--                        "discounted_price" => 90,--}}
{{--                        "href" => "https://www.musora.com/gift-card",--}}
{{--                        "instructor" => "Award-Winning Membership",--}}
{{--                        "price" =>  90,--}}
{{--                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/marketing/musora/membership/redeem/access-pass.jpg",--}}
{{--                        "title" => "Musora Gift Cards",--}}
{{--                        'soldOut' => false,--}}
{{--                    ])--}}
            </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 sm:mt- lg:mb-10 text-center">
                    <span
                        @click="showAll = true"
                        x-show="!showAll"
                        class="join outline black smaller">
                        See More
                    </span>
                </div>
            </div>
        </section>

        <section class="grid-view category-section" data-category="door-crashers" x-show="filter === 'door-crashers' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-person-to-door text-{{ $brand }} mr-1"></i> Bundles & Door Crashers</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-4 text-left" style="margin-bottom:0;">
                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/book-bundle",
                         "price" => 1321,
                         "discounted_price" => 399,
                         "title" => "The Book Bundle",
                         "instructor" => "Get the best online piano lessons and a library of piano books",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/740x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/book-bundle.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/prima",
                         "price" => 1374,
                         "discounted_price" => 599,
                         "title" => "The Keyboard Bundle",
                         "instructor" => "Get the best beginner digital piano, Pianote Annual Membership, and 5 lifetime bonuses",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/740x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/keyboard-bundle.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/prima-ultimate",
                         "price" => 1642,
                         "discounted_price" => 799,
                         "title" => "The ULTIMATE Bundle",
                         "instructor" => "Everything you need to start playing the piano",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/740x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/ultimate-bundle.webp",
                         'soldOut' => false,
                    ])
                </div>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">

                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/metronome",
                         "price" => floatval($productPrices['taktell-piccolo-metronome']->price),
                         "discounted_price" => floatval($productPrices['taktell-piccolo-metronome']->discounted_price),
                         "title" => "The Pianote Metronome",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/doorcrasher-01.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/book-bag",
                         "price" => floatval($productPrices['pianote-book-bag']->price),
                         "discounted_price" => floatval($productPrices['pianote-book-bag']->discounted_price),
                         "title" => "The Pianote BookBag",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/doorcrasher-02.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/chords-scales-book",
                         "price" => floatval($productPrices['piano-chords-and-scales-guide']->price),
                         "discounted_price" => floatval($productPrices['piano-chords-and-scales-guide']->discounted_price),
                         "title" => "Piano Chords & Scales",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/doorcrasher-03.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/shop/headphones",
                         "price" => floatval($productPrices['pianote-headphones-2024']->price),
                         "discounted_price" => floatval($productPrices['pianote-headphones-2024']->discounted_price),
                         "title" => "Pianote Headphones",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/doorcrasher-04.webp",
                         'soldOut' => false,
                    ])
                </div>
            </div>
        </section>

        <section class="grid-view category-section" data-category="gifts" x-show="filter === 'gifts' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-gift text-{{ $brand }} mr-1"></i> Gifts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                    @include('_partials.components.shop.product-card', [
                        "discounted_price" => 240,
                        "href" => "/shop/gift-bundle",
                        "price" =>  322.94,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/gift-bundle.webp",
                        "title" => "The Gift Bundle",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-50',
                        "discounted_price" => 50,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=50",
                        "price" =>  50,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-50.webp",
                        "title" => "$50 Digital Gift Card",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-100',
                        "discounted_price" => 100,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=100",
                        "price" =>  100,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-100.webp",
                        "title" => "$100 Digital Gift Card",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-240',
                        "discounted_price" => 240,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=240",
                        "price" =>  240,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-240.webp",
                        "title" => "$240 Digital Gift Card",
                        'soldOut' => false,
                    ])
                </div>
            </div>
        </section>

        {{--   ACCESSORIES     --}}
        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Physical Products</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                    :class="{ 'show-all': showAll }">
                @foreach($accessories as $accessory)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $accessory->badge_text,
                        "price" => $accessory->price,
                        "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "discounted_price" => $accessory->discounted_price,
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                        "sizes" => $accessory->sizes,
                        "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
                    ])
                @endforeach
                    <div x-cloak x-show="filter === 'accessories'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/shop/book-bundle",
                             "price" => 1321,
                             "discounted_price" => 399,
                             "title" => "The Book Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/book-bundle.webp",
                             'soldOut' => false,
                        ])
                    </div>
                    <div x-cloak x-show="filter === 'accessories'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/shop/prima",
                             "price" => 1474,
                             "discounted_price" => 599,
                             "title" => "The Keyboard Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/keyboard-bundle.webp",
                             'soldOut' => false,
                        ])
                    </div>
                    <div x-cloak x-show="filter === 'accessories'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/shop/prima-ultimate",
                             "price" => 1642,
                             "discounted_price" => 799,
                             "title" => "The ULTIMATE Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/pianote/promos/black-friday/shop/ultimate-bundle.webp",
                             'soldOut' => false,
                        ])
                    </div>
            </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 sm:mt- lg:mb-10 text-center">
                    <span
                        @click="showAll = true"
                        x-show="!showAll"
                        class="join outline black smaller">
                        See More
                    </span>
                </div>
            </div>
        </section>

        {{--   SHIRTS     --}}
        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($shirts as $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "price" => $item->price,
                            "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "discounted_price" => $item->discounted_price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                            "sku" => $item->sku,
                        ])
                    @endforeach
            </div>
            </div>
        </section>

        {{--   HOODIES     --}}
        <div id="hoodies" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt-long-sleeve text-{{ $brand }} mr-1"></i> Sweaters</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($hoodies as $hoodie)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $hoodie->badge_text,
                            "price" => $hoodie->price,
                            "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                            "discounted_price" => $hoodie->discounted_price,
                            "size_case_sensitive" => $hoodie->size_case_sensitive,
                            "sizes" => $hoodie->sizes,
                            "soldOut" => isset($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                            "thumbnail" => $hoodie->thumbnail,
                            "title" => $hoodie->name,
                            "sku" => $hoodie->sku,
                        ])
                    @endforeach
            </div>
            </div>
        </section>

        {{--   MISC     --}}
        <div id="misc" class="anchor"></div>
        <section class="grid-view category-section" data-category="misc" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Misc</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                    @foreach($misc as $miscItem)
                        @include('_partials.components.shop.product-card', [
                             "sku" => $miscItem->sku,
                             "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),
                             "badge" => $miscItem->badge_text,
                             "thumbnail" => $miscItem->thumbnail,
                             "title" => $miscItem->name,
                             "cardDescription" => $miscItem->short_desc,
                             "price" => $miscItem->price,
                             "discounted_price" => $miscItem->discounted_price,
                             "sizes" => $miscItem->sizes,
                             "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,
                             "category" => strtolower($miscItem->productType->name),
                             "size_case_sensitive" => $miscItem->size_case_sensitive,
                        ])
                    @endforeach

                </div>
            </div>
        </section>

    </div>
@endsection

@section('layout-footer')
    @include('pianote.sales.partials._footer')
@endsection
