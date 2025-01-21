@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">

    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/og-image.jpg">

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
    isIndexPage: {{ $isIndexPage ?? 'true' }},
@endsection

@section('layout-header')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.shop-header',[
        'text' => 'GET LESSONS, MERCH, GEAR, & MUCH MORE',
        'bg' => 'https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg',
        'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/543x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-blue.png',
        'logoStyles' => 'h-6 sm:h-8 mb-1',
    ])


    @include('_partials.components.shop.index-filters', [
        "all" => true
    ])

    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        <section x-show="filter === 'all'">
            <div class="container mx-auto">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-fire text-{{ $brand }} mr-1"></i> Featured</strong></h5>
                <div class="flex flex-wrap mb-5 sm:mb-10">
                    <a href="/new-year" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]" style="padding-bottom:71%;">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/january/ny-bundle.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/january/ny-bundle-m.webp');"></div>
                        </div>
                    </a>
                    <a href="/drumshop/kit" class="w-full mx-auto p-1 sm:p-2 sm:w-1/2 transition-opacity duration-500 hover:opacity-90">
                        <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[71%]" style="padding-bottom:71%;">
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/promos/january/e-kit-bundle.webp');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/january/e-kit-bundle-m.webp');"></div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container" x-data="{ showAll: false }">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-globe-pointer text-{{ $brand }} mr-1"></i> Digital Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left"
                    :class="{ 'show-all': showAll || (!isIndexPage && filter !== 'all') || filter === 'lessons' }">
                    @include('_partials.components.shop.product-card', [
                    "badge" => "7-Day Free Trial",
                     "price" => 240,
                     "instructor" => "Award-Winning Membership",
                     "discounted_price" => 240,
                     "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-membership-shop.jpg",
                     "title" => "Drumeo Membership",
                     'soldOut' => false,
                        "href" => "/",
                    ])
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
                </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 mb-10 text-center" x-show="isIndexPage && filter === 'all'">
                    <span
                        @click="showAll = true"
                        x-show="!showAll"
                        class="join outline black smaller">
                        See More
                    </span>
                </div>
            </div>
        </section>

        <section class="grid-view category-section" data-category="gifts" x-show="filter === 'gifts' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-gift text-{{ $brand }} mr-1"></i> Gifts</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">

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
                    :class="{ 'show-all': showAll || (!isIndexPage && filter !== 'all') || filter === 'accessories' }">
                    @include('_partials.components.shop.product-card', [
                            "href" => "/drumshop/kit",
                             "price" => 1474,
                             "discounted_price" => 599,
                             "title" => "The E-KIT Bundle",
                             "thumbnailFull" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/drumeo/promos/november/2024/ekit-bundle.webp",
                             'soldOut' => false,
                        ])
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
                </div>
                <div class="-mt-3 sm:-mt-5 lg:-mt-8 mb-10 text-center" x-show="isIndexPage && filter === 'all'">
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
                    :class="{ 'show-all': showAll || (!isIndexPage && filter !== 'all') || filter === 'clothing' }">
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
                <div class="lg:mb-10 text-center" x-show="isIndexPage && filter === 'all'">
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

