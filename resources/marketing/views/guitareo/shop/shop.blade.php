@php
    $bundles = [
        [
            'slug' => '/shop/sound-better-bundle',
            'badgeText' => 'FREE GUITAR GEAR',
            'img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/sound-better-thumb-no-play.jpg',
            'title' => 'Guitareo Membership + 6 Bonuses',
            'desc' => 'Annual Guitareo Membership <br class="inline md:hidden lg:inline">+ The Guitarist’s Survival Kit + 5 Training Packs',
            'price' => 1164,
            'discountedPrice' => GuitareoPrices::$guitareoMembershipAnnual,
            'priceColor' => 'linear-gradient(180deg, #00C9AC 0%, #16414A 100%)',
            'buttonColor' => 'linear-gradient(180deg, #00C9AC 0%, #16414A 100%)',
            'visible' => 1,
        ],
        [
            'slug' => '/shop/build-a-song',
            'badgeText' => '87% OFF',
            'img' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/build-a-song-fb-share-image.jpg',
            'title' => '5 Discounted Courses',
            'desc' => 'Pay once and get lifetime <br class="hidden-sm hidden-md">access to 5 courses.',
            'price' => 735,
            'discountedPrice' => 97,
            'priceColor' => 'linear-gradient(180deg, #fe7c02 0%, #feb157 100%)',
            'buttonColor' => 'linear-gradient(180deg, #fe7c02 0%, #feb157 100%)',
            'visible' => 1,
        ],
    ];
@endphp

@extends('guitareo._partials.global-layout')

@section('meta')
    <title>Guitareo Shop</title>
    <meta property="og:title" content="Guitareo Shop">
    <meta name="description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/shop/">

    @include('_partials.layout.favicons.guitareo-favicons')
    @include('guitareo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/guitareo/shop.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
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
@stop

@section('scripts')
    @parent
    {{--<script src="/assets/js/modal.js"></script>--}}
    {{--<script type="text/javascript" src="/marketing/js/modal-autoplay.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/guitareo/nav-footer.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $('.scalable-card').click(function (e) {
                    e.stopPropagation();
                    if (!$(e.target).is('.pack-pick') && !$(e.target).is('option') && !$(e.target).is('a') && !$(e.target).is('button')) {
                        $(this).toggleClass('flipped');
                    }

                });

                //customize section pack picker
                var originalLink = '/ecommerce/add-to-cart?redirect=/shop';

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
            });
        });
    </script>
@stop

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="drum-shop-header" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/black-friday/shop-bg.jpg);">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="h-14 sm:h-16 lg:h-20" src="https://cdn.musora.com/image/fetch/w_450,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/november/holiday-guitar.png"><br>
                <h1 class="my-2"><strong>GUITAREO SHOP</strong></h1>
                <h5 class="leading-tight">Save up to <span class="">91%</span> on guitar  <br class="inline md:hidden"> lessons & accessories</h5>
                {{--                <div class="rounded-xl px-6 py-2 inline-flex flex-wrap mx-auto mt-5 justify-center items-center" style="background-color:#181515;">--}}
                {{--                    <p class="leading-none m-0"><strong>DEALS END IN:</strong></p>--}}
                {{--                    <div class="h-12 mx-5 bg-promo" style="width:2px;"></div>--}}
                {{--                    <div class="tzcd-big">--}}
                {{--                        <div class="inline-block">--}}
                {{--                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
                {{--                            <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="inline-block mx-2">--}}
                {{--                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
                {{--                            <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="inline-block mr-2">--}}
                {{--                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
                {{--                            <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="inline-block">--}}
                {{--                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>--}}
                {{--                            <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="absolute inset-0" style="background:linear-gradient(to bottom, rgba(255, 0, 21, 0.25), transparent);"></div>
    </header>

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
                        <a href="{{ get_legacy_brand_base_url("musora") }}/order/{{ $brand }}" class="join smaller"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>
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
    <div class="white-box">
        @include('_partials.layout.holiday.bundle-cards')
        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards text-center">
                @foreach($products as $product){
                @include('guitareo.shop._partials._shop-card', [
                    "sku" => $product->sku,
                    "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $product->slug ),
                    "thumbnail" => $product->thumbnail,
                    "packLogo" => $product->thumbnail_logo,
                    "badgeText" => $product->badge_text,
                    "title" => $product->name,
                    "packAuthor" => $product->instructor_name ? $product->instructor_name : 'Guitareo',
                    "cardDescription" => $product->short_desc,
                    "includedEdge" => $product->included_edge,
                    "fullPrice" => $product->price,
                    "price" => $product->discounted_price === '0.00' || empty($product->discounted_price) ? $product->price : $product->discounted_price,
                    "category" => strtolower($product->productType->name),
                    "sizes" => $product->sizes,
                    "soldOut" => $product->sold_out,
                    "size_case_sensitive" => $product->size_case_sensitive,
                ])
                }
                @endforeach

            </ul>
        </section>

        </div>
        <section class="content-section text-white text-center px-6 py-10 sm:py-20" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
            <div class="container mx-auto max-w-4xl">
                <img class="h-28 md:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-guarantee.png" alt="guitareo-guarantee">

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
                        <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                    </div>
                </div>
            </div>
        </section>

    @include("guitareo.sales.partials._footer")
@stop

