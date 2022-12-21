@php
    $bundles = [
        [
            'slug' => '/drumshop/bundle-ultimate-lessons',
            'badgeText' => 'FREE QUIETPAD & DRUMSTICKS',
            'img' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/ultimate-lessons-shop-2.jpg',
            'title' => 'Drumeo Membership<br> + 10 Bonuses',
            'desc' => 'Drumeo Annual Membership<br class="inline md:hidden lg:inline"> + Practice Pad + Sticks + 8 Training Packs',
            'price' => 1468.94,
            'discountedPrice' => Prices::$drumeoEdgeAnnual,
            'priceColor' => 'linear-gradient(to bottom, #04afec, #213472)',
            'buttonColor' => 'linear-gradient(to bottom, #04afec, #213472)',
            'visible' => 1,
        ],
        [
            'slug' => '/drumshop/bundle-perfect-gift',
            'badgeText' => 'FREE P4 & DRUMSTICKS',
            'img' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/perfect-gift-fb-share-image.jpg',
            'title' => 'Drumeo Access Card<br> + 2 Bonuses',
            'desc' => 'Drumeo Access Card<br class="inline md:hidden lg:inline"> + Practice Pad + Sticks',
            'price' => 331.95,
            'discountedPrice' => Prices::$drumeoEdgeAnnual,
            'priceColor' => 'linear-gradient(to bottom, #01fdc0, #289077)',
            'buttonColor' => 'linear-gradient(to bottom, #01fdc0, #289077)',
            'visible' => 1,
        ],
    ];
@endphp

@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/drum-shop/og-image.jpg">
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/drum-shop.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
    <style>
        .join.smaller {
            padding: 10px 30px 6px;
            font-size: 16px;
        }

        @media (min-width: 768px) {
            .join.smaller {
                font-size: 18px;
                padding: 12px 30px 10px;
            }
        }

        .shipping-delay .delay-bar {
            background:#e3e3e3;
            padding:10px;
            cursor:pointer;
        }

        .shipping-delay .delay-bar p {
            font:400 13px/1.4em 'Open Sans';
            margin:0 auto;
        }

        .shipping-delay .delay-bar p a {
            color:inherit;
            display:inline-block;
        }

        .shipping-delay .delay-bar p a:hover {
            text-decoration:underline;
        }

        .shipping-delay .info-wrap {
            display:none;
            opacity:0;
            transition:all .3s;
            position:absolute;
            top:15px;
            left:50%;
            z-index:98;
            background:#f5f5f5;
            transform:translate(-50%, 0);
            padding:20px;
            box-shadow:0 0 15px hsla(0, 0%, 0%, 0.34);
            border-radius:7px;
            font:400 13px/1.4em 'Open Sans';
            width:98%;
            max-width:700px;
        }

        .shipping-delay .info-wrap h3 {
            font-size:15px;
            margin:0 auto 5px;
        }


        .shipping-delay .info-wrap.active {
            display:block;
            opacity:1;
        }

        .shipping-delay .info-wrap .close-modal {
            cursor:pointer;
            z-index:99;
            opacity:0.8;
            position:absolute;
            margin:0;
            line-height:1em;
            text-align:center;
            display:inline-block;
            outline:none;
            top:7px;
            right:7px;
            font-size:20px;
            width:20px;
        }
        .shipping-delay .delay-overlay {
            position:absolute;
            top:40px;
            height:calc(100% - 40px);
            width:100%;
            background:rgba(0, 0, 0, .2);
            z-index:98;
            visibility:hidden;
            opacity:0;
            transition:all .1s linear;
        }
        .shipping-delay .delay-overlay.active {
            visibility:visible;
            opacity:1;
        }

        .shipping-delay .info-wrap li {
            margin:0 auto 15px;
        }

        @media (min-width: 40em) {
            .shipping-delay .delay-bar p {
                font-size:14px;
            }
            .shipping-delay .info-wrap {
                font-size:14px;
                padding:50px;
            }

            .shipping-delay .info-wrap h3 {
                font-size:16px;
            }

            .shipping-delay .info-wrap .close-modal {
                top:10px;
                right:10px;
                font-size:25px;
                width:25px;
            }
            .shipping-delay .delay-overlay {
                top:56px;
                height:calc(100% - 56px);
            }
        }
    </style>
@stop

@section('body-data')
    x-data="{
        filter: '{{ $category !== 'drumshop' ? $category : 'all' }}'
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    <div class="shipping-delay">
        <div class="delay-bar text-center">
            <div class="container mx-auto">
                <p><a class="shipping-trigger"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $100</strong></a></p>
            </div>
        </div>
        <div class="delay-overlay">
            <div class="info-wrap shipping-info" >
                <i class="fas fa-times close-modal"></i>
                <h3><strong>Free Shipping Over $100</strong></h3>
                <p>Spend over $100 and you'll unlock free worldwide shipping on any order.</p>
            </div>
        </div>
    </div>

    <header class="drum-shop-header" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/header-background.jpg);">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="h-14 sm:h-16 lg:h-20" src="https://cdn.musora.com/image/fetch/w_450,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/christmas/holiday-drums.png"><br>
                <h1 class="my-2"><strong>DRUM SHOP</strong></h1>
                <h5 class="leading-tight">Save up to <span class="">81%</span> on lessons,<br class="inline md:hidden"> accessories, and merch.</h5>
                {{-- <div class="rounded-xl px-6 py-2 inline-flex flex-wrap mx-auto mt-5 justify-center items-center" style="background-color:#181515;">
                    <p class="leading-none m-0"><strong>DEALS END IN:</strong></p>
                    <div class="h-12 mx-5 bg-promo" style="width:2px;"></div>
                    <div class="tzcd-big">
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>
                        </div>
                        <div class="inline-block mx-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>
                        </div>
                        <div class="inline-block mr-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>
                        </div>
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>
                        </div>
                    </div>
                </div> --}}
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
        @include('_partials.layout.holiday.bundle-cards')

        <section class="bundles">
            <div class="container mx-auto">
                <div class="float-left w-full px-2 md:px-3 card-wrap">
                    <div class="px-2 sm:px-0 max-w-xs sm:max-w-full mx-auto">
                        <a href="/drumshop/bundle-practice-anywhere/" class="flex flex-row-reverse text-white rounded-xl mx-auto mb-5 overflow-hidden relative w-full sm:text-left px-5 lg:px-12 pt-40 pb-5 sm:py-7 lg:py-8">
                            <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                                <img class="h-14 lg:h-28" src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-logo-wide-white.png"><br>
                                <p class="leading-tight my-3">P4 Practice Pad + Drumsticks<br class="inline lg:hidden"> + Rudiment Poster</p>
                                <h4 class="inline-block leading-none"><strong>
                                        <s class="opacity-60">$98.95</s>&nbsp; $79</strong></h4><br>
                                <div class="join white smaller mt-3 w-full">See The Deal &raquo;</div><br>
                            </div>
                            <p class="absolute z-20 top-0 left-0 text-white rounded-br-xl bg-promo uppercase py-1.5 px-2.5 leading-none text-xs font-roboto"><i class="fas fa-star"></i> <strong>SAVE 20%</strong></p>
                            <div class="hidden sm:block absolute inset-0 z-0 bg-cover bg-center" style="background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-shop.jpg);"></div>
                            <div class="block sm:hidden absolute inset-0 z-0 bg-cover bg-right" style="background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-m.jpg);"></div>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        {{--  LESSONS  --}}

        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><i class="fas fa-video"></i></div>
                        Online Drum Lessons
                    </h1>
                </li>
                @foreach($lessons as $lesson){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                        "badgeText" => $lesson->badge_text,
                        "thumbnail" => $lesson->thumbnail,
                        "packLogo" => $lesson->thumbnail_logo,
                        "title" => $lesson->name,
                        "packAuthor" => $lesson->instructor_name,
                        "cardDescription" => $lesson->short_desc,
                        "fullPrice" => $lesson->price,
                        "price" => $lesson->discounted_price === '0.00' || empty($lesson->discounted_price) ? $lesson->price : $lesson->discounted_price,
                        "category" => strtolower($lesson->productType->name),
                        "buttonText" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? 'see the deal' : null,
                        "soldOut" => $lesson->sold_out,
                        "includedEdge" => $lesson->included_edge,
                        "sizes" => $lesson->sizes,
                    ])
                }
                @endforeach
                @include('drumeo.drumshop._partials._drum-shop-card', [
                    "itemURL" => "/drumshop/gift-card/",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                    "title" => "Drumeo Gift Card",
                    "cardDescription" => "Give the gift of drum lessons with a gift card to Drumeo -- with your choice between a one-month, 6-month, or 1-year membership pass.",
                    "fullPrice" =>Prices::$cardMonthFull,
                    "price" => Prices::$cardMonth,
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
                @foreach($accessories as $accessory){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                        "sku" => $accessory->sku,
                        "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "badgeText" => $accessory->badge_text,
                        "thumbnail" => $accessory->thumbnail,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "price" => $accessory->discounted_price === '0.00' || empty($accessory->discounted_price) ? $accessory->price : $accessory->discounted_price,
                        "sizes" => $accessory->sizes,
                        "soldOut" => !empty($products[$accessory->sku]) ? $products[$accessory->sku]->getPublicStockCount() === 0 : $accessory->sold_out,
                        "category" => strtolower($accessory->productType->name),
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                }
                @endforeach
            </ul>
        </section>

        {{--   HATS     --}}
        <section class="grid-view category-section" data-category="hats" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hat.svg"></div>
                        Hats
                    </h1>
                </li>

                @foreach($hats as $hat){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $hat->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hat->slug ),
                         "badgeText" => $hat->badge_text,
                         "thumbnail" => $hat->thumbnail,
                         "title" => $hat->name,
                         "cardDescription" => $hat->short_desc,
                         "fullPrice" => $hat->price,
                         "price" => $hat->discounted_price === '0.00' || empty($hat->discounted_price) ? $hat->price : $hat->discounted_price,
                         "sizes" => $hat->sizes,
                         "soldOut" => !empty($products[$hat->sku]) ? $products[$hat->sku]->getPublicStockCount() === 0 : $hat->sold_out,
                         "category" => strtolower($hat->productType->name),
                         "size_case_sensitive" => $hat->size_case_sensitive,
                    ])
                }
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

                @foreach($shirts as $shirt){
                    @include('drumeo.drumshop._partials._drum-shop-card', [
                         "sku" => $shirt->sku,
                         "itemURL" => '/drumshop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                         "badgeText" => $shirt->badge_text,
                         "thumbnail" => $shirt->thumbnail,
                         "title" => $shirt->name,
                         "cardDescription" => $shirt->short_desc,
                         "fullPrice" => $shirt->price,
                         "price" => $shirt->discounted_price === '0.00' || empty($shirt->discounted_price) ? $shirt->price : $shirt->discounted_price,
                         "sizes" => $shirt->sizes,
                         "soldOut" => !empty($products[$shirt->sku]) ? $products[$shirt->sku]->getPublicStockCount() === 0 : $shirt->sold_out,
                         "size_case_sensitive" => $shirt->size_case_sensitive,
                         "category" => strtolower($shirt->productType->name),
                    ])
                }
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
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hoodie.svg"></div>
                        Hoodies
                    </h1>
                </li>
                @foreach($hoodies as $hoodie){
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
                         "soldOut" => !empty($products[$hoodie->sku]) ? $products[$hoodie->sku]->getPublicStockCount() === 0 : $hoodie->sold_out,
                         "category" => strtolower($hoodie->productType->name),
                         "size_case_sensitive" => $hoodie->size_case_sensitive,
                    ])
                }
                @endforeach
            </ul>
        </section>
    </div>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/misc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/drum-shop-filters.js') }}"></script>
    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        $(function () {
            $('.scalable-card').click(function (e) {
                e.stopPropagation();
                if (!$(e.target).is('.pack-pick') && !$(e.target).is('option') && !$(e.target).is('a') && !$(e.target).is('button')) {
                    $(this).toggleClass('flipped');
                }

            });

            //customize section pack picker
            var originalLink = '/laravel/public/shopping-cart/api/query?go-back-to-shop=true';

            $('select').prop('selectedIndex', 0);
            $(".pack-pick").change(function () {
                var orderButton = $(this).parent().find(".selected-pack");
                var selectedOption = $(this).find("option:selected");
                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', originalLink);
                orderButton.attr('href', orderButton.attr('href') + selectedOption.val());
                orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
            });

            $(".selected-pack").on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter = $(this).parent().find(".pack-pick");
                    selecter.addClass('error');
                }
            });

            $('.delay-overlay').click(function (e) {
                e.stopPropagation();

                $('.delay-overlay').removeClass('active');
                $('.shipping-info').removeClass('active');
            });

            $(".shipping-delay .shipping-trigger").on('click', function () {
                $('.delay-overlay').addClass('active');
                $('.shipping-info').addClass('active');
            });

            $(".shipping-delay .close-modal").on('click', function () {
                $('.delay-overlay').removeClass('active');
                $('.shipping-info').removeClass('active');
            });
            $(document).keyup(function(e) {
                if (e.which === 27) {
                    $('.delay-overlay').removeClass('active');
                    $('.shipping-info').removeClass('active');
                }
            });
        });
    </script>
@stop
