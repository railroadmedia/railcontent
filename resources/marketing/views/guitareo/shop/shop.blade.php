@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Guitareo Shop</title>
    <meta property="og:title" content="Guitareo Shop">
    <meta name="description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:description" content="Say goodbye to “do it yourself” guitar lessons.">

        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/promos/november/xmas-guitareo-shop-share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/shop/">
@endsection

@section('layout-styles')
    @parent
    <style>
        .tooltip {
            position: relative;
        }
        .tooltip:after, .tooltip:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s;
            overflow: hidden;
        }
        .tooltip:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tooltip:after {
            padding: 5px 8px;
            content: attr(tip);
            font: 400 14px/1.4em 'Open Sans', sans-serif;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 15px #000;
            bottom: 30px;
            left: -300%;
        }
        .tooltip:hover, .tooltip:active, .tooltip:focus {
            z-index: 100;
        }
        .tooltip:hover:after, .tooltip:active:after, .tooltip:focus:after, .tooltip:hover:before, .tooltip:active:before, .tooltip:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }

        .linear-green {
            background: linear-gradient(180deg, #00C9AC 0%, #16414A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .linear-rainbow {
            background: linear-gradient(75.93deg, #00C9AC 0%, #0B76DB 32.62%, #8300E9 65.25%, #F61A30 92.11%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (min-width:1080px) {
            .padding-per {
                padding: 60px 8%;
            }
        }
    </style>
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.promo-top-banner',[
        'text' => '<span class="text-promo">Save up to 80%</span> on guitar lessons,<br class="sm:hidden"> merch, & more.',
        'bg' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/black-friday/shop-bg.jpg',
    ])

    @if(Session::has('addedProducts'))
        <section class="py-6 md:py-10">
            <div class="max-w-4xl mx-auto">
                <div class="w-full px-2 md:px-3">
                    <h4 class="text-green-400 mb-3 md:mb-4"><strong><i class="fas fa-check mr-1"></i> Added to Cart</strong></h4>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full px-2 md:px-3 md:w-2/3">
                        @foreach(Session::get('addedProducts') as $addedProduct)
                            <div class="flex items-center float-left w-full px-2 md:px-3 mb-3">
                                <img class="rounded-full h-20 md:h-36 border-2 border-gray-300" src="{{ $addedProduct['thumbnail'] }}">
                                <div class="flex-shrink pl-3 md:pl-4">
                                    <h5 class="leading-tight"><strong>{{ $addedProduct['name'] }}</strong></h5>
                                    <p class="leading-normal">{{ $addedProduct['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="w-full px-2 md:px-3 md:w-1/3 md:text-center">
                        <p class="mb-2">
                            Cart Subtotal({{ Session::get('cartNumberOfItems') }}):
                            <strong>${{ number_format(Session::get('cartSubTotal'), 2, '.', ',') }}</strong>
                        </p>
                        <a href="{{ get_musora_brand_base_url() }}/order/{{ $brand }}" class="join smaller"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>
                    </div>
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
        "noClothing" => true
    ])
    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        @php
            $bundles = [
                [
                    'slug' => 'https://www.guitareo.com/shop/ultimate-lessons-bundle',
                    'desc' => 'Guitareo Discount<br> + 5 Bonuses',
                    'visible' => 1,
                    'full' => true,
                    'price' => 1075,
                    'discountedPrice' => 240,
                    'buttonColor' => '#00C9AC',
                    'logo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/november/bundles/ultimate-lessons-white.png',
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-ultimate-lessons-card.jpg',
                    'imgM' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-ultimate-lessons-card-m.jpg',
                ],
            ];
        @endphp
        @include('_partials.layout.holiday.bundle-tiles', [
            "header" => 'Featured Deals',
        ])

        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Guitar Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
{{--                    @include('musora.shop._shop-card-alt', [--}}
{{--                     "itemURL" => "/",--}}
{{--                     "sku" => null,--}}
{{--                     "thumbnail" => "https://d122ay5chh2hr5.cloudfront.net/sales/promos/july/guitareo-membership-shop.jpg",--}}
{{--                     "title" => "Guitareo Membership",--}}
{{--                     "packAuthor" => "Ayla Tesler-Mabe",--}}
{{--                     "cardDescription" => "Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.",--}}
{{--                     "specialPrice" => "7-Day Free Trial",--}}
{{--                     "fullPrice" => 240,--}}
{{--                     "price" => 150,--}}
{{--                     "category" => "lessons",--}}
{{--                     "buttonText" => "Start For Free <i class='fas fa-arrow-right'></i>",--}}
{{--                     'soldOut' => false,--}}
{{--                ])--}}

                    <div x-cloak x-show="filter === 'lessons'">
                        @include('musora.shop._shop-card-alt', [
                             "itemURL" => "/shop/ultimate-lessons-bundle",
                             "sku" => null,
                             "thumbnail" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/540x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-ultimate-shop-thumb.jpg",
                             "title" => "Ultimate Lessons Bundle",
                             "fullPrice" => 240,
                             "price" => 150,
                             "category" => "lessons",
                             'soldOut' => false,
                        ])
                    </div>
                @foreach($lessons as $key => $lesson)
                    @include('musora.shop._shop-card-alt', [
                            "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                            "thumbnail" => $lesson->thumbnail,
                            "packLogo" => $lesson->thumbnail_logo,
                            "title" => $lesson->name,
                            "packAuthor" => $lesson->instructor_name,
                            "cardDescription" => $lesson->short_desc,
                            "fullPrice" => $lesson->price,
                            "price" => $lesson->discounted_price,
                            "category" => strtolower($lesson->productType->name),
                            "soldOut" => $lesson->sold_out,
                            "includedMembership" => $lesson->included_edge,
                            "badgeText" => $lesson->badge_text,
                            'FCP' => $key < 4 ? true : null,
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
                    @include('musora.shop._shop-card-alt', [
                            "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                            "thumbnail" => $accessory->thumbnail,
                            "badgeText" => $accessory->badge_text,
                            "title" => $accessory->name,
                            "cardDescription" => $accessory->short_desc,
                            "fullPrice" => $accessory->price,
                            "sizes" => $accessory->sizes,
                            "price" => $accessory->discounted_price,
                            "category" => strtolower($accessory->productType->name),
                            "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                            "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                @endforeach
            </div>
            </div>
        </section>

    </div>
    <section class="content-section text-white text-center px-6 py-10 sm:py-20" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img class="h-28 md:h-32 lazyload" src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/2022/guitareo-guarantee.png" alt="guitareo-guarantee">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Happy student guarantee. </strong><br>
                Test-drive your lessons for 90 days. Zero risk. </h3>
            <p class=" opacity-60 leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar. </p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br> days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund.
{{--                        <div class="inline-block tooltip cursor-pointer bg-white" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle text-white"></i></div>--}}
                    </h6>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('layout-footer')
    @include("guitareo.sales.partials._footer")
@endsection
