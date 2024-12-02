@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">

    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">

{{--    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/og-image.jpg">--}}
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/home-shop-share-image.jpg">

    <meta property="og:url" content="https://www.drumeo.com/drumshop/">
    <style>
        .splide__arrow svg{
            fill: #0B76DB !important;
        }
        .splide__pagination__page.is-active {
            background:#ddd!important;
        }
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
    filter: '{{ $category !== 'drumshop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.promo-shop-header',[
        'text' => 'Save up to 91% on drum lessons, gear & more!',
        'badge' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/cm-save-badge.webp',
        'bg' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/CM-header-banner.webp',
        'isShop' => true,
    ])

    @include('_partials.components.shop.index-filters', [
        "all" => true
    ])


    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php
            $bundles = [
                [
                    'slug' => '/drumshop/kit',
                    'full' => true,
                    'visible' => 1,
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/ekit-bundle-full.webp',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/ekit-bundle-full-m.webp',
                ],
                [
                    'slug' => '/drumshop/challenges-bundle',
                    'full' => true,
                    'visible' => 1,
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/challenges-bundle-full.webp',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/challenges-bundle-full-m.webp',
                ],
                    [
                        'slug' => '/drumshop/practice-bundle',
                    'full' => true,
                        'visible' => 1,
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/practice-full-bundle.webp',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/practice-bundle-full-m.webp',
                    ],
                    [
                        'slug' => '/drumshop/ultimate-bundle',
                    'full' => true,
                        'visible' => 1,
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/ultimate-full-bundle.webp',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/shop/ultimate-bundle-full-m.webp',
                    ],
            ];
        @endphp
        <section x-show="filter === 'all'">
            <div class="container mx-auto">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-fire text-{{ $brand }} mr-1"></i> Featured</strong></h5>
                <div class="flex flex-wrap mb-5 sm:mb-10">
                    <a href="/drumshop/drumeo-deal" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal-4.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal-m-4.webp');"></div>
                        </div>
                    </a>
                    <a href="/lifetime" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal-3.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal-m.webp');"></div>
                        </div>
                    </a>
                    <div class="w-full p-2">
                            <div class="flex flex-wrap sm:flex-nowrap items-center space-around border border-gray-300 px-4 sm:px-7 lg:px-6 py-4 sm:py-5 rounded-lg inline-block mx-auto"
                                style="background:linear-gradient(to right, #C3FFD7, #C3E4FF, #B2FFFB);">
                                <p class="leading-normal flex-shrink-0 text-center pr-4 mb-3 sm:mb-0"><i class="fas fa-sparkle mr-3"></i><strong class="font-black">ALL CYBER MONDAY BUNDLES<i class="fas fa-sparkle ml-3 inline lg:hidden"></i><br class="lg:hidden"> = LOCKED CARTS</strong><i class="fas fa-sparkle ml-3 hidden lg:inline"></i></p>
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
{{--                    @include('_partials.components.shop.product-card', [--}}
{{--                    "badge" => "7-Day Free Trial",--}}
{{--                     "price" => 240,--}}
{{--                     "instructor" => "Award-Winning Membership",--}}
{{--                     "discounted_price" => 240,--}}
{{--                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-membership-shop.jpg",--}}
{{--                     "title" => "Drumeo Membership",--}}
{{--                     'soldOut' => false,--}}
{{--                        "href" => "/",--}}
{{--                    ])--}}
{{--                    @include('_partials.components.shop.product-card', [--}}
{{--                        "discounted_price" => 90,--}}
{{--                        "href" => "https://www.musora.com/gift-card",--}}
{{--                        "instructor" => "Award-Winning Membership",--}}
{{--                        "price" =>  90,--}}
{{--                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/590x0/filters:quality(95)/marketing/musora/membership/redeem/access-pass.jpg",--}}
{{--                        "title" => "Musora Gift Cards",--}}
{{--                        'soldOut' => false,--}}
{{--                    ])--}}
                    @foreach($lessons as $key => $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "discounted_price" => $item->discounted_price,
                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "instructor" => $item->instructor_name,
                            "logo" => $item->thumbnail_logo,
                            "price" => $item->price,
                            "sku" => $item->sku === 'drumeo' || $item->sku === 'pianote' || $item->sku === 'singeo' || $item->sku === 'guitareo' ? null : $item->sku,
                            "soldOut" => $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                            'fetch' => $key < 4 ? true : null,
                        ])
                    @endforeach
                    <div x-cloak x-show="filter === 'lessons'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/drumshop/drumeo-deal",
                             "price" => 240,
                             "discounted_price" => 140,
                             "title" => "The Drumeo deal",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/drumeo-deal-square.webp",
                             'soldOut' => false,
                        ])
                    </div>
                    <div x-cloak x-show="filter === 'lessons'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/drumshop/challenges-bundle",
                             "price" => 381,
                             "discounted_price" => 127,
                             "title" => "Challenges Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle-square.jpg",
                             'soldOut' => false,
                        ])
                    </div>
                    <div x-cloak x-show="filter === 'lessons'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/lifetime",
                             "price" => 1200,
                             "discounted_price" => 1200,
                             "title" => "Lifetime Membership",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/lifetime-deal-square.webp",
                             'soldOut' => false,
                        ])
                    </div>
                </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 mb-10 text-center">
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
                <div style="margin-bottom: 0;" class="fixed-cards grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4 text-left">
                    <a class="product-wrap relative text-black pb-4 hover:opacity-90 transition-opacity" data-price="127" href="/drumshop/challenges-bundle" x-data="{ open: false }">
                        <div class="overflow-hidden rounded-lg relative bg-cover bg-top mb-3 border border-gray-300" style="padding-bottom: 100%;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/challenges-bundle-square.jpg');"></div>
                        <p class="leading-tight font-black mb-1">Challenges Bundle</p>
                        <p class="leading-tight text-sm mb-1">3 popular courses for the price of 1.</p>
                        <p class="leading-tight"><s class="opacity-60">$381</s> <strong class="text-drumeo font-extrabold">$127</strong> <span class="ml-1 text-xs bottom-0 font-black text-black rounded-md px-1.5 leading-none py-1 inline-block bg-musora align-bottom">Save 66%</span></p>
                    </a>
                    <a class="product-wrap relative text-black pb-4 hover:opacity-90 transition-opacity" data-price="399" href="/drumshop/practice-bundle" x-data="{ open: false }">
                        <div class="overflow-hidden rounded-lg relative bg-cover bg-top mb-3 border border-gray-300" style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/practice-bundle.webp');"></div>
                        <p class="leading-tight font-black mb-1">The Practice Bundle</p>
                        <p class="leading-tight text-sm mb-1">Save $828.87 on most popular practice essentials + lessons.</p>
                        <p class="leading-tight"><s class="opacity-60">$1227.87</s> <strong class="text-drumeo font-extrabold">$399</strong> <span class="ml-1 text-xs bottom-0 font-black text-black rounded-md px-1.5 leading-none py-1 inline-block bg-musora align-bottom">Save 67%</span></p>
                    </a>
                    @include('_partials.components.shop.product-card', [
                        "href" => "/drumshop/kit",
                         "price" => 1474,
                         "discounted_price" => 599,
                         "title" => "The E-KIT Bundle",
                         "instructor" => "Save $875 on an electronic drum kit + lessons.",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/ekit-bundle.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/drumshop/ultimate-bundle",
                         "price" => 1747.99,
                         "discounted_price" => 799,
                         "title" => "The ULTIMATE Bundle",
                         "instructor" => "Save 948.90 on our ultimate bundle.",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/ultimate-bundle.webp",
                         'soldOut' => false,
                    ])

                    @include('_partials.components.shop.product-card', [
                        "href" => "/drumshop/stickbag",
                         "price" => floatval($productPrices['stickbag']->price),
                         "discounted_price" => floatval($productPrices['stickbag']->discounted_price),
                         "title" => "Drumeo StickBag",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/doorcrasher-01.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/drumshop/eardrums",
                         "price" => floatval($productPrices['drumeo-eardrums-black']->price),
                         "discounted_price" => floatval($productPrices['drumeo-eardrums-black']->discounted_price),
                         "title" => "Drumeo EarDrums In-Ear Monitors",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/doorcrasher-02.webp",
                         'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "href" => "/drumshop/the-drummers-toolbox",
                         "price" => floatval($productPrices['the-drummers-toolbox-book']->price),
                         "discounted_price" => floatval($productPrices['the-drummers-toolbox-book']->discounted_price),
                         "title" => "The Drummer’s Toolbox",
                         "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/doorcrasher-03-last.webp",
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
                        "href" => "/drumshop/gift-bundle",
                        "price" =>  341.94,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gift-bundle.webp",
                        "title" => "The Gift Bundle",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-50',
                        "discounted_price" => 50,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=50",
                        "price" =>  50,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-50.webp",
                        "title" => "$50 Digital Gift Card",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-100',
                        "discounted_price" => 100,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=100",
                        "price" =>  100,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-100.webp",
                        "title" => "$100 Digital Gift Card",
                        'soldOut' => false,
                    ])
                    @include('_partials.components.shop.product-card', [
                        "sku" => 'musora-gift-card-240',
                        "discounted_price" => 240,
                        "href" => "https://www.musora.com/electronic-gift-card?amount=240",
                        "price" =>  240,
                        "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/gc-240.webp",
                        "title" => "$240 Digital Gift Card",
                        'soldOut' => false,
                    ])
                </div>
            </div>
        </section>

        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="accessories" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Physical Products</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                    :class="{ 'show-all': showAll }">
                @foreach($accessories as $item)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $item->badge_text,
                        "discounted_price" => $item->discounted_price,
                        "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                        "price" => $item->price,
                        "size_case_sensitive" => $item->size_case_sensitive,
                        "sizes" => $item->sizes,
                        "sku" => (str_contains($item->sku, 'member') || str_contains($item->sku, 'products')) ? '' : $item->sku,
                        "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                        "thumbnail" => $item->thumbnail,
                        "title" => $item->name,
                    ])
                @endforeach
                    <div x-cloak x-show="filter === 'accessories'">
                        <a class="product-wrap relative text-black pb-4 hover:opacity-90 transition-opacity" data-price="399" href="/drumshop/practice-bundle" x-data="{ open: false }">
                            <div class="overflow-hidden rounded-lg relative bg-cover bg-top mb-3 border border-gray-300" style="padding-bottom: 100%; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/740x0/filters:quality(95)/marketing/drumeo/promos/november/2024/practice-bundle.webp');"></div>
                            <p class="leading-tight font-black mb-1">The Practice Bundle</p>
                            <p class="leading-tight text-sm mb-1">Save $828.87 on most popular practice essentials + lessons.</p>
                            <p class="leading-tight"><s class="opacity-60">$1227.87</s> <strong class="text-drumeo font-extrabold">$399</strong><span class="ml-1 text-xs bottom-0 font-black text-black rounded-md px-1.5 leading-none py-1 inline-block bg-musora align-bottom">Save 67%</span></p>
                        </a>
                    </div>
                    <div x-cloak x-show="filter === 'accessories'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/drumshop/kit",
                             "price" => 1474,
                             "discounted_price" => 599,
                             "title" => "The E-KIT Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/ekit-bundle.webp",
                             'soldOut' => false,
                        ])
                    </div>
                    <div x-cloak x-show="filter === 'accessories'">
                        @include('_partials.components.shop.product-card', [
                            "href" => "/drumshop/ultimate-bundle",
                             "price" => 1747.99,
                             "discounted_price" => 799,
                             "title" => "The ULTIMATE Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/ultimate-bundle.webp",
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

        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Merch</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                    :class="{ 'show-all': showAll }">
                @foreach($shirts as $item)
                    @include('_partials.components.shop.product-card', [
                        "badge" => $item->badge_text,
                        "discounted_price" => $item->discounted_price,
                        "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                        "price" => $item->price,
                        "size_case_sensitive" => $item->size_case_sensitive,
                        "sizes" => $item->sizes,
                        "sku" => $item->sku,
                        "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                        "thumbnail" => $item->thumbnail,
                        "title" => $item->name,
                    ])
                @endforeach
                @include('_partials.components.shop.product-card', [
                     "badge" => "SEE MORE ON TEESPRING",
                     "discounted_price" => 18,
                     "external" => true,
                     "href" => "https://teespring.com/stores/drumeo",
                     "price" => 18,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/teespring.jpg",
                     "title" => "Teespring Drumeo Store",
                     'soldOut' => false,
                ])
                    @foreach($hoodies as $item)
                        @include('_partials.components.shop.product-card', [
                                "badge" => $item->badge_text,
                                "discounted_price" => $item->discounted_price,
                                "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                                "price" => $item->price,
                                "size_case_sensitive" => $item->size_case_sensitive,
                                "sizes" => $item->sizes,
                                "sku" => $item->sku,
                                "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                                "thumbnail" => $item->thumbnail,
                                "title" => $item->name,
                        ])
                    @endforeach
                    @foreach($misc as $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "discounted_price" => $item->discounted_price,
                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "price" => $item->price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "sku" => $item->sku,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                        ])
                    @endforeach
                    @foreach($thirtyDD as $key => $item)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $item->badge_text,
                            "discounted_price" => $item->discounted_price,
                            "href" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "price" => $item->price,
                            "size_case_sensitive" => $item->size_case_sensitive,
                            "sizes" => $item->sizes,
                            "sku" => $item->sku,
                            "soldOut" => isset($products[$item->sku]) ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "thumbnail" => $item->thumbnail,
                            "title" => $item->name,
                        ])
                    @endforeach
                </div>
                <div class="lg:mb-10 text-center">
                    <span
                        @click="showAll = true"
                        x-show="!showAll"
                        class="join outline black smaller">
                        See More
                    </span>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

