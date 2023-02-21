@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Singeo Shop</title>
    <meta property="og:title" content="Singeo Shop - Get Lessons, T-Shirts, & More!">
    <meta name="description" content="Singeo.com: Your start-to-finish guide to confident singing">
    <meta property="og:description" content="Singeo.com: Your start-to-finish guide to confident singing">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2022/og-image.jpg"/>
    <meta property="og:url" content="https://www.singeo.com/shop/">
@endsection

@section('layout-header')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true,
    ])
@endsection

@section('body')
    <header class="drum-shop-header" style="background-color:#080e1e;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/products/shop-header.jpg);">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="logo" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png" alt="singeo logo">
                <h1><strong>SHOP</strong></h1>
                <p>GET LESSONS, MERCH, GEAR, & MUCH MORE</p>
            </div>
        </div>
    </header>


    {{--    @if(Session::has('addedProducts'))--}}
    {{--        <section class="py-6 md:py-10">--}}
    {{--            <div class="max-w-4xl mx-auto">--}}
    {{--                <div class="w-full px-2 md:px-3">--}}
    {{--                    <h4 class="text-green-400 mb-3 md:mb-4"><strong><i class="fas fa-check mr-1"></i> Added to Cart</strong></h4>--}}
    {{--                </div>--}}
    {{--                <div class="flex flex-wrap">--}}
    {{--                    <div class="w-full px-2 md:px-3 md:w-2/3">--}}
    {{--                        @foreach(Session::get('addedProducts') as $addedProduct)--}}
    {{--                            <div class="flex items-center float-left w-full px-2 md:px-3 mb-3">--}}
    {{--                                <img class="rounded-full h-20 md:h-36 border-2 border-gray-300" src="{{ $addedProduct['thumbnail'] }}">--}}
    {{--                                <div class="flex-shrink pl-3 md:pl-4">--}}
    {{--                                    <h5 class="leading-tight"><strong>{{ $addedProduct['name'] }}</strong></h5>--}}
    {{--                                    <p class="leading-normal">{{ $addedProduct['description'] }}</p>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                    <div class="w-full px-2 md:px-3 md:w-1/3 md:text-center">--}}
    {{--                        <p class="mb-2">--}}
    {{--                            Cart Subtotal({{ Session::get('cartNumberOfItems') }}):--}}
    {{--                            <strong>${{ number_format(Session::get('cartSubTotal'), 2, '.', ',') }}</strong>--}}
    {{--                        </p>--}}
    {{--                        <a href="{{ get_musora_brand_base_url() }}/order/{{ $brand }}" class="join smaller"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--    @endif--}}

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
    <div class="white-box">
        <section class="bundles">
            <div class="container mx-auto fixed-cards">
                {{--                <div class="float-left w-full px-2 md:px-3 md:w-1/2 card-wrap">--}}
                {{--                    <a href="/shop/bundle-unlimited" class="bundle-card lg:pb-1">--}}
                {{--                        <span class="top-left-badge text-white bg-promo"><i class="fas fa-star"></i> $538 IN FREE BONUSES</span>--}}
                {{--                        <div class="bg-center bg-cover pb-40 sm:pb-56 xl:pb-64" style="background-image:url(https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/black-friday/unlimited-lessons.png);"></div>--}}
                {{--                        <div class="float-left w-full px-2 md:px-3">--}}
                {{--                            <p><strong>Singeo Membership + 5 Bonuses </strong><br>--}}
                {{--                                <em>Singeo Annual Membership<br class="hidden lg:inline"> + Starter Kit + Practice Poster + Guitar/Piano Lessons & More!</em>--}}
                {{--                                <span class="price"><s class="opacity-30">$778</s> <strong class="linear-purple">${{ Prices::$plusSubscriptionAnnual }}</strong></span>--}}
                {{--                            </p>--}}
                {{--                            <span class="join" style="background:linear-gradient(180deg, #8300E9 0%, #03017C 100%);">See The Deal &raquo;</span>--}}
                {{--                        </div>--}}
                {{--                    </a>--}}
                {{--                </div>--}}
                <div class="float-left w-full px-2 md:px-3 card-wrap">
                    <a href="/shop/singing-starter-kit" class="flex flex-row text-white rounded-xl mb-3 md:mb-5 overflow-hidden relative w-full sm:text-left px-5 lg:px-10 py-10 sm:py-10 lg:py-28 xl:py-32">
                        <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                            <img class="h-20 md:h-16 lg:h-28" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png" alt="essential bundle logo"><br>
                            <p class="leading-tight mt-2 mb-2 lg:mb-3 lg:mt-5 text-sm">
                                Everything you need to <b>start singing now.</b>
                            </p>
                            <div class="join white smaller w-full" style="background:#D46A7D;color:white;">only <!--<s style="color:#C4C4C4;">${{ floatval($productPrices['singing-starter-kit']->price) }}</s>--> ${{ floatval($productPrices['singing-starter-kit']->discounted_price) }} &raquo;</div><br>
                        </div>
                        <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover" style="background-position:60% 0;background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/black-friday/singing-starter-kit-banner.jpg);"></div>
                        <div class="inline-block sm:hidden absolute inset-0 z-0" style="background-color:#293239;"></div>
                    </a>
                </div>

                <div class="float-left w-full px-2 md:px-3 card-wrap">
                    <a href="/beautiful-harmonies" class="flex flex-row-reverse text-white rounded-xl mb-5 overflow-hidden relative w-full sm:text-left px-4 lg:px-12 py-10 sm:py-7 lg:py-20 margin-per">
                        <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                            <img class="h-20 md:h-16 lg:h-28" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/black-friday/essential-logo.png" alt="essential bundle logo"><br>
                            <p class="leading-tight mt-4 mb-2 lg:mb-3 lg:mt-5 text-sm">
                                Take your singing skills to the <b>next level.</b>
                            </p>
                            <div class="join white smaller w-full" style="background:white;color:#2B384D;">only <!--<s style="color:#C4C4C4;">${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->price) }}</s>--> ${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->discounted_price) }} &raquo;</div><br>
                        </div>
                        <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/black-friday/beautiful-harmonies-banner.jpg);"></div>
                        <div class="inline-block sm:hidden absolute inset-0 z-0" style="background-color:#293239;"></div>
                    </a>
                </div>
            </div>
        </section>

        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards">
                @foreach($items as $item)
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                            "sku" => $item->sku,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $item->slug ),
                            "thumbnail" => $item->thumbnail,
                            "packLogo" => $item->thumbnail_logo,
                            "badgeText" => $item->badge_text,
                            "title" => $item->name,
                            "packAuthor" => $item->instructor_name ?? 'Singeo',
                            "cardDescription" => $item->short_desc,
                            "fullPrice" => $item->price,
                            "price" => $item->discounted_price,
                            "category" => strtolower($item->productType->name),
                            "includedEdge" => $item->included_edge,
                            "sizes" => $item->sizes,
                            "soldOut" => (!empty($products[$item->sku]) && $item->productType->name !== 'Lessons') ? $products[$item->sku]->getStockAvailability() === 0 : $item->sold_out,
                            "size_case_sensitive" => $item->size_case_sensitive,
                    ])
                @endforeach

            </ul>
        </section>
    </div>
@endsection

@section('layout-footer')
    @include("singeo.sales.partials._footer")
@endsection
