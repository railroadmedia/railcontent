@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">

    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/promos/november/xmas-drumeo-shop-share-image.jpg">
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
                                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $feat->slug ),
                                            "sku" => $feat->sku === 'drumeo' ? null : $feat->sku,
                                            "badgeText" => $feat->badge_text,
                                            "thumbnail" => $feat->thumbnail,
                                            "packLogo" => $feat->thumbnail_logo,
                                            "title" => $feat->name,
                                            "packAuthor" => $feat->instructor_name,
                                            "cardDescription" => $feat->short_desc,
                                            "fullPrice" => $feat->price,
                                            "price" => $feat->discounted_price,
                                            "category" => strtolower($feat->productType->name),
                                            "buttonText" => $feat->sku === 'drumeo' || $feat->sku === 'pianote' || $feat->sku === 'singeo' || $feat->sku === 'guitareo' ? 'see the deal' : null,
                                            "soldOut" => $feat->sold_out,
                                            "includedEdge" => $feat->included_edge,
                                            "sizes" => $feat->sizes,
                                            'FCP' => $key < 4 ? true : null,
                                            "size_case_sensitive" => $feat->size_case_sensitive,
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
                     "itemURL" => "/",
                     "sku" => null,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-membership-shop.jpg",
                     "title" => "Drumeo Membership",
                     "packAuthor" => "Award-Winning Membership",
                     "cardDescription" => "The Ultimate Online Drum Lessons Experience. You’ll get step-by-step drum lessons from the best drummers in the world (and much more).",
                     "specialPrice" => "7-Day Free Trial",
                     "fullPrice" => 240,
                     "price" => 240,
                     "category" => "lessons",
                     "buttonText" => "Start For Free <i class='fas fa-arrow-right'></i>",
                     'soldOut' => false,
                ])
                @foreach($lessons as $key => $lesson)
                    @include('_partials.components.shop.product-card', [
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "sku" => $lesson->sku === 'drumeo' ? null : $lesson->sku,
                        "badgeText" => $lesson->badge_text,
                        "thumbnail" => $lesson->thumbnail,
                        "packLogo" => $lesson->thumbnail_logo,
                        "title" => $lesson->name,
                        "packAuthor" => $lesson->instructor_name,
                        "cardDescription" => $lesson->short_desc,
                        "fullPrice" => $lesson->price,
                        "price" => $lesson->discounted_price,
                        "category" => strtolower($lesson->productType->name),
                        "buttonText" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? 'see the deal' : null,
                        "soldOut" => $lesson->sold_out,
                        "includedEdge" => $lesson->included_edge,
                        "sizes" => $lesson->sizes,
                        'FCP' => $key < 4 ? true : null,
                    ])
                @endforeach

                @include('_partials.components.shop.product-card', [
                    "itemURL" => "/drumshop/gift-card/",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                    "title" => "Drumeo Gift Card",
                    "cardDescription" => "Give the gift of drum lessons with a gift card to Drumeo — with your choice between a one-month, 6-month, or 1-year membership pass.",
                    "fullPrice" =>29,
                    "price" => 29,
                    "category" => "card",
                    'soldOut' => false,
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
                        "sku" => $accessory->sku,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "badgeText" => $accessory->badge_text,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "price" => $accessory->discounted_price,
                        "sizes" => $accessory->sizes,
                        "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "category" => strtolower($accessory->productType->name),
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                @endforeach
                </div>
            </div>
        </section>
        {{--   MISC     --}}
{{--        <div id="misc" class="anchor"></div>--}}
{{--        <section class="grid-view category-section" data-category="misc" x-show="filter === 'clothing' || filter === 'all'">--}}
{{--            <div class="container">--}}
{{--                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Misc</strong></h5>--}}
{{--                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">--}}

{{--                    @foreach($misc as $miscItem)--}}
{{--                        @include('_partials.components.shop.product-card', [--}}
{{--                             "sku" => $miscItem->sku,--}}
{{--                             "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $miscItem->slug ),--}}
{{--                             "badgeText" => $miscItem->badge_text,--}}
{{--                             "thumbnail" => $miscItem->thumbnail,--}}
{{--                             "title" => $miscItem->name,--}}
{{--                             "cardDescription" => $miscItem->short_desc,--}}
{{--                             "fullPrice" => $miscItem->price,--}}
{{--                             "price" => $miscItem->discounted_price,--}}
{{--                             "sizes" => $miscItem->sizes,--}}
{{--                             "soldOut" => isset($products[$miscItem->sku]) ? $products[$miscItem->sku]->getStockAvailability() === 0 : $miscItem->sold_out,--}}
{{--                             "category" => strtolower($miscItem->productType->name),--}}
{{--                             "size_case_sensitive" => $miscItem->size_case_sensitive,--}}
{{--                        ])--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

                @foreach($shirts as $shirt)
                    @include('_partials.components.shop.product-card', [
                         "sku" => $shirt->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                         "badgeText" => $shirt->badge_text,
                         "thumbnail" => $shirt->thumbnail,
                         "title" => $shirt->name,
                         "cardDescription" => $shirt->short_desc,
                         "fullPrice" => $shirt->price,
                         "price" => $shirt->discounted_price,
                         "sizes" => $shirt->sizes,
                         "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                         "size_case_sensitive" => $shirt->size_case_sensitive,
                         "category" => strtolower($shirt->productType->name),
                    ])
                @endforeach
                @include('_partials.components.shop.product-card', [
                     "badgeText" => "SEE MORE ON TEESPRING",
                     "itemURL" => "https://teespring.com/stores/drumeo",
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/teespring.jpg",
                     "title" => "Teespring Drumeo Store",
                     "cardDescription" => "Check out our on-demand designs that are only available through Teespring.",
                     "specialPrice" => "Various Designs & Pricing",
                     "fullPrice" => 18,
                     "price" => 18,
                     "category" => "shirts",
                     "buttonText" => "VISIT TEESPRING <i class='fas fa-external-link'></i>",
                     "externalURL" => true,
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
                         "sku" => $hoodie->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                         "badgeText" => $hoodie->badge_text,
                         "thumbnail" => $hoodie->thumbnail,
                         "title" => $hoodie->name,
                         "cardDescription" => $hoodie->short_desc,
                         "fullPrice" => $hoodie->price,
                         "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                         "sizes" => $hoodie->sizes,
                         "soldOut" => isset($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                         "category" => strtolower($hoodie->productType->name),
                         "size_case_sensitive" => $hoodie->size_case_sensitive,
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
                            "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $thirtyDDItem->slug ),
                            "sku" => $thirtyDDItem->sku === 'drumeo' ? null : $thirtyDDItem->sku,
                            "badgeText" => $thirtyDDItem->badge_text,
                            "thumbnail" => $thirtyDDItem->thumbnail,
                            "packLogo" => $thirtyDDItem->thumbnail_logo,
                            "title" => $thirtyDDItem->name,
                            "packAuthor" => $thirtyDDItem->instructor_name,
                            "cardDescription" => $thirtyDDItem->short_desc,
                            "fullPrice" => $thirtyDDItem->price,
                            "price" => $thirtyDDItem->discounted_price,
                            "category" => strtolower($thirtyDDItem->productType->name),
                            "buttonText" => $thirtyDDItem->sku === 'drumeo' || $thirtyDDItem->sku === 'pianote' || $thirtyDDItem->sku === 'singeo' || $thirtyDDItem->sku === 'guitareo' ? 'see the deal' : null,
                            "soldOut" => $thirtyDDItem->sold_out,
                            "includedEdge" => $thirtyDDItem->included_edge,
                            "sizes" => $thirtyDDItem->sizes,
                            'FCP' => $key < 4 ? true : null,
                            "size_case_sensitive" => $thirtyDDItem->size_case_sensitive,
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

