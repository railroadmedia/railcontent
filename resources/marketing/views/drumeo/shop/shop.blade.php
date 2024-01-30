@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">

    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/og-image.jpg">

    <meta property="og:url" content="https://www.drumeo.com/drumshop/">
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
        'text' => 'GET LESSONS, MERCH, GEAR, & MUCH MORE',
        'bg' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg',
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/543x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-blue.png',
        'logoStyles' => 'h-6 sm:h-8 mb-1',
    ])
{{--    'logoStyles' => 'h-12 sm:h-20 pb-3 sm:pb-4',--}}

    @include('_partials.components.shop.index-filters', [
        "all" => true
    ])

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php

            if ($products['alesis-ekit']->getStockAvailability() > 1 && !empty($products['alesis-ekit']->getStockAvailability())) {
                $bundles = [
                    [
                        'slug' => '/drumshop/kit',
                        'desc' => 'Get the ultimate starter e-kit <br> + one year of Drumeo.',
                        'visible' => 1,
                        'price' => floatval($productPrices['alesis-ekit']->price),
                        'discountedPrice' => floatval($productPrices['alesis-ekit']->discounted_price),
                        'buttonColor' => '#0A69D0',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/december/alesis-nitro-max-logo.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/alesis-shop.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/december/alesis-shop-m.jpg',
                    ],
                    [
                        'slug' => '/new-year#customize-anchor',
                        'desc' => 'A practice pad, stand and sticks <br> so you can practice anywhere.',
                        'visible' => 1,
                        'price' => 240,
                        'discountedPrice' => 200,
                        'buttonColor' => '#0A69D0',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/december/practice-anywhere-logo.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/practice-anywhere.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/practice-anywhere-m.jpg',
                    ],
                ];
            }
            else {
                $bundles = [
                    [
                        'slug' => '/drumshop/kit',
                        'desc' => 'Get the ultimate starter e-kit <br> + one year of Drumeo.',
                        'visible' => 1,
                        'soldOut' => true,
                        'price' => 'SOLD OUT',
                        'buttonColor' => '#0A69D0',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/december/alesis-nitro-max-logo.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/alesis-shop.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/december/alesis-shop-m.jpg',
                    ],
                    [
                        'slug' => '/new-year#customize-anchor',
                        'desc' => 'A practice pad, stand and sticks <br> so you can practice anywhere.',
                        'visible' => 1,
                        'price' => 240,
                        'discountedPrice' => 200,
                        'buttonColor' => '#0A69D0',
                        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/december/practice-anywhere-logo.png',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/practice-anywhere.jpg',
                        'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/practice-anywhere-m.jpg',
                    ],
                ];
            }
        @endphp
        @include('_partials.layout.holiday.bundle-tiles', [
            "header" => 'Featured Deals',
        ])

        <section class="grid-view" data-category="featured" x-show="filter === 'featured' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-fire text-{{ $brand }} mr-1"></i> Trending Now</strong></h5>
                <div
                    x-data="{
                init() {
                    new Splide(this.$refs.splide, {
                        classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                                prev: 'hidden',
                                next: 'splide__arrow--next hidden sm:flex mb-16',
                                pagination: 'hidden',
                        },
                        perPage: 3.5,
                        perMove: 1,
                        type: 'loop',
                        focus: 0,
                        interval: 2000,
                        breakpoints: {
                            1023: {
                                perPage: 2.5,
                            },
                            767: {
                                perPage: 1.5,
                                drag   : 'free',
                                snap   : false,
                            },
                        },
                    }).mount()
                },
            }"
                >
                    <div x-ref="splide" class="splide text-left">
                        <div class="splide__track pb-8">
                            <ul class="splide__list items-start">
                                @foreach($featured as $key => $feat)
                                    <li class="splide__slide px-1">
                                        @include('_partials.components.shop.product-card', [
                                            "badgeText" => $feat->badge_text,
                                            "fullPrice" => $feat->price,
                                            "packAuthor" => $feat->instructor_name,
                                            "packLogo" => $feat->thumbnail_logo,
                                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $feat->slug ),
                                            "price" => $feat->discounted_price,
                                            "size_case_sensitive" => $feat->size_case_sensitive,
                                            "sizes" => $feat->sizes,
                                            "soldOut" => isset($products[$feat->sku]) ? $products[$feat->sku]->getStockAvailability() === 0 : $feat->sold_out,
                                            "thumbnail" => $feat->thumbnail,
                                            "title" => $feat->name,
                                            "sku" => $feat->sku,
                                        ])
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Online Drum Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                @include('_partials.components.shop.product-card', [
                     "fullPrice" => 240,
                     "packAuthor" => "Award-Winning Membership",
                     "price" => 240,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-membership-shop.jpg",
                     "title" => "Drumeo Membership",
                     'soldOut' => false,
                     "itemURL" => "/",
                ])
                @foreach($lessons as $key => $lesson)
                    @include('_partials.components.shop.product-card', [
                        "badgeText" => $lesson->badge_text,
                        "fullPrice" => $lesson->price,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "packAuthor" => $lesson->instructor_name,
                        "packLogo" => $lesson->thumbnail_logo,
                        "price" => $lesson->discounted_price,
                        "soldOut" => $lesson->sold_out,
                        "thumbnail" => $lesson->thumbnail,
                        "title" => $lesson->name,
                        'FCP' => $key < 4 ? true : null,
                        "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                    ])
                @endforeach

                @include('_partials.components.shop.product-card', [
                    "fullPrice" =>29,
                    "packAuthor" => "Award-Winning Membership",
                    "price" => 29,
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                    "title" => "Gift Card",
                    'soldOut' => false,
                    "itemURL" => "https://www.musora.com/gift-card",
                ])
            </div>
            </div>
        </section>

        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="accessories" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Accessories</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                @foreach($accessories as $accessory)
                    @include('_partials.components.shop.product-card', [
                        "badgeText" => $accessory->badge_text,
                        "fullPrice" => $accessory->price,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "price" => $accessory->discounted_price,
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                        "sizes" => $accessory->sizes,
                        "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
                    ])
                @endforeach
                </div>
            </div>
        </section>

        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                @foreach($shirts as $shirt)
                    @include('_partials.components.shop.product-card', [
                        "badgeText" => $shirt->badge_text,
                        "fullPrice" => $shirt->price,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                        "price" => $shirt->discounted_price,
                        "size_case_sensitive" => $shirt->size_case_sensitive,
                        "sizes" => $shirt->sizes,
                        "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                        "thumbnail" => $shirt->thumbnail,
                        "title" => $shirt->name,
                        "sku" => $shirt->sku,
                    ])
                @endforeach
                @include('_partials.components.shop.product-card', [
                     "badgeText" => "SEE MORE ON TEESPRING",
                     "externalURL" => true,
                     "fullPrice" => 18,
                     "itemURL" => "https://teespring.com/stores/drumeo",
                     "price" => 18,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/teespring.jpg",
                     "title" => "Teespring Drumeo Store",
                     'soldOut' => false,
                ])
                </div>
            </div>
        </section>

        {{--   HOODIES     --}}
        <div id="hoodies" class="anchor"></div>
        <section class="grid-view category-section" data-category="hoodies" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt-long-sleeve text-{{ $brand }} mr-1"></i> Hoodies</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                @foreach($hoodies as $hoodie)
                    @include('_partials.components.shop.product-card', [
                            "badgeText" => $hoodie->badge_text,
                            "fullPrice" => $hoodie->price,
                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                            "price" => $hoodie->discounted_price,
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
                            "badgeText" => $miscItem->badge_text,
                            "fullPrice" => $miscItem->price,
                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),
                            "price" => $miscItem->discounted_price,
                            "size_case_sensitive" => $miscItem->size_case_sensitive,
                            "sizes" => $miscItem->sizes,
                            "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,
                            "thumbnail" => $miscItem->thumbnail,
                            "title" => $miscItem->name,
                            "sku" => $miscItem->sku,
                        ])
                    @endforeach
                </div>
            </div>
        </section>

        {{--   30DD     --}}
        <div id="30dd" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> 30-Day Drummer Merch</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($thirtyDD as $key => $thirtyDDItem)
                        @include('_partials.components.shop.product-card', [
                            "badgeText" => $thirtyDDItem->badge_text,
                            "fullPrice" => $thirtyDDItem->price,
                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $thirtyDDItem->slug ),
                            "price" => $thirtyDDItem->discounted_price,
                            "size_case_sensitive" => $thirtyDDItem->size_case_sensitive,
                            "sizes" => $thirtyDDItem->sizes,
                            "soldOut" => isset($products[$thirtyDDItem->sku]) ? $products[$thirtyDDItem->sku]->getStockAvailability() === 0 : $thirtyDDItem->sold_out,
                            "thumbnail" => $thirtyDDItem->thumbnail,
                            "title" => $thirtyDDItem->name,
                            "sku" => $thirtyDDItem->sku,
                        ])
                    @endforeach
                </div>
            </div>
        </section>

        {{--   limited     --}}
        <div id="limited" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Limited Sizes</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($lowStock as $key => $lowStockItem)
                        @include('_partials.components.shop.product-card', [
                            "badgeText" => $lowStockItem->badge_text,
                            "fullPrice" => $lowStockItem->price,
                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lowStockItem->slug ),
                            "price" => $lowStockItem->discounted_price,
                            "size_case_sensitive" => $lowStockItem->size_case_sensitive,
                            "sizes" => $lowStockItem->sizes,
                            "soldOut" => isset($products[$lowStockItem->sku]) ? $products[$lowStockItem->sku]->getStockAvailability() === 0 : $lowStockItem->sold_out,
                            "thumbnail" => $lowStockItem->thumbnail,
                            "title" => $lowStockItem->name,
                            "sku" => $lowStockItem->sku,
                        ])
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

