@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/og-image.jpg">
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
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
    <header class="drum-shop-header relative">
        <picture>
            <source media="(min-width: 640px)" srcset="https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg">
            <img class="absolute w-full h-full left-0 top-0 object-cover object-center" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg" alt="header background" fetchpriority="high" />
        </picture>

        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="h-6 md:h-9" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="drumeo logo" fetchpriority="high">
                <h1><strong>DRUM SHOP</strong></h1>
                <p>GET LESSONS, MERCH, GEAR, & MUCH MORE</p>
            </div>
        </div>
    </header>

    @if(Session::has('addedProducts'))
        <section class="added-to-cart-background clearfix">
            <div class="float-left w-full px-2 md:px-3 check">
                <h2><i class="fas fa-check"></i>Added to Cart</h2>
            </div>
            <div class="float-left w-full px-2 md:px-3 product-info">
                <div class="float-left w-full px-2 md:px-3 md:w-2/3 product">
                    @foreach(Session::get('addedProducts') as $addedProduct)
                        <div class="float-left w-full px-2 md:px-3" style="padding:0;margin-bottom:15px;">
                            <img src="{{ $addedProduct['thumbnail'] }}">
                            <h4>{{ $addedProduct['name'] }}</h4>
                            <p>{{ $addedProduct['description'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="float-left w-full px-2 md:px-3 md:w-1/3 checkout">
                    <h5>
                        Cart Subtotal({{ Session::get('cartNumberOfItems') }}):
                        <strong>${{ number_format(Session::get('cartSubTotal'), 2, '.', ',') }}</strong>
                    </h5>
                    <a href="{{ get_musora_brand_base_url() }}/order/{{ $brand }}" class="join"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>
                </div>
            </div>
        </section>
    @endif

    @if(Session::has('success-message') ||
    Session::has('warning-message') ||
    Session::has('error-message'))
        <div class="container mx-auto clearfix">
            <div class="float-left w-full px-2 md:px-3 no-padding">
                @if(Session::has('success-message'))
                    <div class="alert alert-success">
                        <strong>Success: </strong> {{ Session::get('success-message') }}
                    </div>
                @endif

                @if(Session::has('warning-message'))
                    <div class="alert alert-warning">
                        <strong>Warning: </strong> {{ Session::get('warning-message') }}
                    </div>
                @endif

                @if(Session::has('error-message'))
                    <div class="alert alert-danger">
                        <strong>Error: </strong> {{ Session::get('error-message') }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    @include('drumeo.drumshop._partials._catalogue-filters', [
        "all" => true
    ])


    <div class="white-box">
        {{--        @include('_partials.layout.holiday.bundle-cards')--}}

        {{--        <section class="bundles">--}}
        {{--            <div class="container mx-auto">--}}
        {{--                <div class="float-left w-full px-2 md:px-3 card-wrap">--}}
        {{--                    <div class="px-2 sm:px-0 max-w-xs sm:max-w-full mx-auto">--}}
        {{--                        <a href="/drumshop/bundle-practice-anywhere/" class="flex flex-row-reverse text-white rounded-xl mx-auto mb-5 overflow-hidden relative w-full sm:text-left px-5 lg:px-12 pt-40 pb-5 sm:py-7 lg:py-8">--}}
        {{--                            <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">--}}
        {{--                                <img class="h-14 lg:h-28" src="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/november/practice-anywhere-logo-wide-white.png"><br>--}}
        {{--                                <p class="leading-tight my-3">P4 Practice Pad + Drumsticks<br class="inline lg:hidden"> + Rudiment Poster</p>--}}
        {{--                                <h4 class="inline-block leading-none"><strong>--}}
        {{--                                        <s class="opacity-60">$98.95</s>&nbsp; $79</strong></h4><br>--}}
        {{--                                <div class="join white smaller mt-3 w-full">See The Deal &raquo;</div><br>--}}
        {{--                            </div>--}}
        {{--                            <p class="absolute z-20 top-0 left-0 text-white rounded-br-xl bg-promo uppercase py-1.5 px-2.5 leading-none text-xs font-roboto"><i class="fas fa-star"></i> <strong>SAVE 20%</strong></p>--}}
        {{--                            <div class="hidden sm:block absolute inset-0 z-0 bg-cover bg-center" style="background-color:#0d1d3f;background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/november/practice-anywhere-shop.jpg);"></div>--}}
        {{--                            <div class="block sm:hidden absolute inset-0 z-0 bg-cover bg-right" style="background-color:#0d1d3f;background-image:url(https://www.musora.com/musora-cdn/image/width=800,quality=85/https://dpwjbsxqtam5n.cloudfront.net/promos/november/practice-anywhere-m.jpg);"></div>--}}
        {{--                        </a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--            </div>--}}
        {{--        </section>--}}

        {{--  LESSONS  --}}
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><i class="fas fa-video"></i></div>
                        Online Drum Lessons
                    </h1>
                </li>
                @foreach($lessons as $key => $lesson)
                    @include('drumeo.drumshop._partials._drum-shop-card', [
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

                @include('drumeo.drumshop._partials._drum-shop-card', [
                    "itemURL" => "/drumshop/gift-card/",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                    "title" => "Drumeo Gift Card",
                    "cardDescription" => "Give the gift of drum lessons with a gift card to Drumeo -- with your choice between a one-month, 6-month, or 1-year membership pass.",
                    "fullPrice" =>29,
                    "price" => 29,
                    "category" => "card",
                    'soldOut' => false,
                ])
            </ul>
        </section>

        {{--   ACCESSORIES     --}}
        <section class="grid-view category-section" data-category="accessories" x-show="filter === 'accessories' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><i class="fas fa-suitcase"></i></div>
                        Accessories
                    </h1>
                </li>
                @foreach($accessories as $accessory)
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                        "sku" => $accessory->sku,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "badgeText" => $accessory->badge_text,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "price" => $accessory->discounted_price,
                        "sizes" => $accessory->sizes,
                        "soldOut" => !empty($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                        "category" => strtolower($accessory->productType->name),
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                @endforeach
            </ul>
        </section>

        {{--   HATS     --}}
        <section class="grid-view category-section" data-category="hats" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hat.svg" alt="hat icon"></div>
                        Hats
                    </h1>
                </li>

                @foreach($hats as $hat)
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $hat->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hat->slug ),
                         "badgeText" => $hat->badge_text,
                         "thumbnail" => $hat->thumbnail,
                         "title" => $hat->name,
                         "cardDescription" => $hat->short_desc,
                         "fullPrice" => $hat->price,
                         "price" => $hat->discounted_price,
                         "sizes" => $hat->sizes,
                         "soldOut" => !empty($products[$hat->sku]) ? $products[$hat->sku]->getStockAvailability() === 0 : $hat->sold_out,
                         "category" => strtolower($hat->productType->name),
                         "size_case_sensitive" => $hat->size_case_sensitive,
                    ])
                @endforeach

            </ul>
        </section>

        {{--   SHIRTS     --}}
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><i class="fas fa-tshirt"></i></div>
                        Shirts
                    </h1>
                </li>

                @foreach($shirts as $shirt)
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $shirt->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                         "badgeText" => $shirt->badge_text,
                         "thumbnail" => $shirt->thumbnail,
                         "title" => $shirt->name,
                         "cardDescription" => $shirt->short_desc,
                         "fullPrice" => $shirt->price,
                         "price" => $shirt->discounted_price,
                         "sizes" => $shirt->sizes,
                         "soldOut" => !empty($products[$shirt->sku]) ? $products[$shirt->sku]->getStockAvailability() === 0 : $shirt->sold_out,
                         "size_case_sensitive" => $shirt->size_case_sensitive,
                         "category" => strtolower($shirt->productType->name),
                    ])
                @endforeach
                @include('drumeo.drumshop._partials._drum-shop-card', [
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
            </ul>
        </section>

        {{--   HOODIES     --}}
        <section class="grid-view category-section" data-category="hoodies" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hoodie.svg" alt="hoodie icon"></div>
                        Hoodies
                    </h1>
                </li>
                @foreach($hoodies as $hoodie)
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $hoodie->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                         "badgeText" => $hoodie->badge_text,
                         "thumbnail" => $hoodie->thumbnail,
                         "title" => $hoodie->name,
                         "cardDescription" => $hoodie->short_desc,
                         "fullPrice" => $hoodie->price,
                         "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                         "sizes" => $hoodie->sizes,
                         "soldOut" => !empty($products[$hoodie->sku]) ? $products[$hoodie->sku]->getStockAvailability() === 0 : $hoodie->sold_out,
                         "category" => strtolower($hoodie->productType->name),
                         "size_case_sensitive" => $hoodie->size_case_sensitive,
                    ])
                @endforeach
            </ul>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include("drumeo.sales.partials._footer")
@endsection

