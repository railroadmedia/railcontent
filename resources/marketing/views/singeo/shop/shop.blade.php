@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Singeo Shop</title>
    <meta property="og:title" content="Singeo Shop - Get Lessons, T-Shirts, & More!">
    <meta name="description" content="Singeo.com: Your start-to-finish guide to confident singing">
    <meta property="og:description" content="Singeo.com: Your start-to-finish guide to confident singing">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2022/og-image.jpg"/>
    <meta property="og:url" content="https://www.singeo.com/shop/">


    <link rel="stylesheet" href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/singeo/shop.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />

    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true,
    ])

    <style>
        img {
            display: inline-block;
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

        .top-banner {
            background-image: url('https://singeo.s3.amazonaws.com/sales/promos/october/harmony_bundle_shop_banner_m.png');
        }

        @media (min-width: 768px){
            .top-banner {
                background-image: url('https://singeo.s3.amazonaws.com/sales/promos/october/harmony_bundle_shop_banner.jpg');
            }
        }
        .linear-purple {
            background: linear-gradient(180deg, #8300E9 0%, #03017C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .linear-rainbow {
            background: linear-gradient(75.93deg, #00C9AC 0%, #0B76DB 32.62%, #8300E9 65.25%, #F61A30 92.11%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @media (min-width:1080px) {
            .margin-per {
                padding:80px 6%;
            }
        }
    </style>
    <div class="shipping-delay">
        <div class="delay-bar text-center">
            <div class="container mx-auto">
                <p><a class="shipping-trigger"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $100</strong></a> &nbsp; &nbsp;
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
    <header class="drum-shop-header" style="background-color:#080e1e;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/products/shop-header.jpg);">
        <div class="container mx-auto relative z-10">
            <div class="px-2 md:px-3">
                <img class="logo" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
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
                            <div class="join white smaller w-full" style="background:#D46A7D;color:white;">only <s style="color:#C4C4C4;">${{ floatval($productPrices['singing-starter-kit']->price) }}</s> ${{ floatval($productPrices['singing-starter-kit']->discounted_price) }} &raquo;</div><br>
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
                            <div class="join white smaller w-full" style="background:white;color:#2B384D;">only <s style="color:#C4C4C4;">${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->price) }}</s> ${{ floatval($productPrices['the-essential-guide-to-beautiful-harmonies']->discounted_price) }} &raquo;</div><br>
                        </div>
                        <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/black-friday/beautiful-harmonies-banner.jpg);"></div>
                        <div class="inline-block sm:hidden absolute inset-0 z-0" style="background-color:#293239;"></div>
                    </a>
                </div>
            </div>
        </section>

        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards">

                @foreach($items as $item){
                    @include('singeo.shop.partials._shop-card', [
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
                }
                @endforeach

            </ul>
        </section>

    </div>

    @include("singeo.sales.partials._footer")
    {{-- JS CDNS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>

    <script src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

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

    <script src="{{ asset('marketing/js/singeo/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/singeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/singeo/app.js') }}"></script>
    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@stop
