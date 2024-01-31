@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">

    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">

    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
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
        'text' => 'GET LESSONS, MERCH, <br class="inline md:hidden"> GEAR & MORE!',
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/427x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png',
        'logoStyles' => 'h-12 sm:h-20 pb-2 sm:pb-3',
        'bg' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg',
    ])


    @include('_partials.components.shop.index-filters')

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php
            $bundles = [
                [
                    'slug' => '/new-year#customize-anchor',
                    'desc' => 'Join Pianote and get 4 books, 4 courses<br>  a practice poster PLUS a metronome.',
                    'full' => true,
                    'visible' => 1,
                    'price' => 855,
                    'discountedPrice' => 240,
                    'buttonColor' => '#F61A30',
                    'title' => "New Year's Bundle",
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/december/new-year-bundle.jpg',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/december/new-year-bundle-m.jpg',
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
                                            "badge" => $feat->badge_text,
                                            "price" => $feat->price,
                                            "instructor" => $feat->instructor_name,
                                            "logo" => $feat->thumbnail_logo,
                                            "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $feat->slug ),
                                            "discounted_price" => $feat->discounted_price,
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
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Piano Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                @include('_partials.components.shop.product-card', [
                      "price" => 240,
                      "href" => "/new-year#customize-anchor",
                      "instructor" => "Limited Time Offer",
                      "discounted_price" => 180,
                      "thumbnail" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/july/pianote-membership-shop.jpg",
                      "title" => "Pianote Membership",
                      'soldOut' => false,
                 ])

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
            </div>
            </div>
        </section>

        {{--   ACCESSORIES     --}}
        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Accessories</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
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
            </div>
            </div>
        </section>

        {{--   SHIRTS     --}}
        <div id="shirts" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Shirts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($shirts as $shirt)
                        @include('_partials.components.shop.product-card', [
                            "badge" => $shirt->badge_text,
                            "price" => $shirt->price,
                            "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                            "discounted_price" => $shirt->discounted_price,
                            "size_case_sensitive" => $shirt->size_case_sensitive,
                            "sizes" => $shirt->sizes,
                            "soldOut" => isset($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                            "thumbnail" => $shirt->thumbnail,
                            "title" => $shirt->name,
                            "sku" => $shirt->sku,
                        ])
                    @endforeach
            </div>
            </div>
        </section>

        {{--   HOODIES     --}}
        <div id="hoodies" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt-long-sleeve text-{{ $brand }} mr-1"></i> Hoodies</strong></h5>
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
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">

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

        {{--   limited     --}}
        <div id="limited" class="anchor"></div>
        <section class="grid-view category-section" data-category="misc" x-show="filter === 'clothing' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-shirt text-{{ $brand }} mr-1"></i> Limited Sizes</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4 text-left">

                    @foreach($lowStock as $lowStockItem)
                        @include('_partials.components.shop.product-card', [
                             "sku" => $lowStockItem->sku,
                             "href" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lowStockItem->slug ),
                             "badge" => $lowStockItem->badge_text,
                             "thumbnail" => $lowStockItem->thumbnail,
                             "title" => $lowStockItem->name,
                             "cardDescription" => $lowStockItem->short_desc,
                             "price" => $lowStockItem->price,
                             "discounted_price" => $lowStockItem->discounted_price,
                             "sizes" => $lowStockItem->sizes,
                             "soldOut" => isset($products[$lowStockItem->sku]) ? $products[$lowStockItem->sku]->getStockAvailability() === 0 : $lowStockItem->sold_out,
                             "category" => strtolower($lowStockItem->productType->name),
                             "size_case_sensitive" => $lowStockItem->size_case_sensitive,
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
