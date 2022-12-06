@php
    $bundles = [
        [
            'slug' => '/shop/bundle-unlimited-lessons',
            'badgeText' => '$861 IN FREE BONUSES',
            'img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/unlimited-lessons-shop-2.jpg',
            'title' => 'Pianote Membership + 15 Bonuses',
            'desc' => 'Pianote Annual Membership<br class="hidden-sm hidden-md"> + 4 Books + 2 Posters + 9 Training Packs',
            'price' => 1101,
            'discountedPrice' => PianotePrices::$pianoteMembershipAnnualRegular,
            'priceColor' => 'linear-gradient(to bottom, #e91b3a, #64010f)',
            'buttonColor' => 'linear-gradient(to bottom, #e91b3a, #64010f)',
            'visible' => 1,
        ],
        [
            'slug' => '/shop/bundle-9-yards',
            'badgeText' => 'SAVE 82%',
            'img' => 'https://pianote.s3.amazonaws.com/sales/promos/november/the-whole-9-yards-header.jpg',
            'title' => '9 Discounted Courses',
            'desc' => 'Pay once and get lifetime <br class="hidden-sm hidden-md">access to 9 courses.',
            'price' => 716,
            'discountedPrice' => 127,
            'priceColor' => 'linear-gradient(to bottom, #5aba4e, #139646)',
            'buttonColor' => 'linear-gradient(to bottom, #5aba4e, #139646)',
            'visible' => 1,
        ],
    ];
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">
    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <link href="https://fonts.googleapis.com/css?family=Oswald:500" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/pianote/shop.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/vuesora.css') }}" rel="stylesheet">

    <style>
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
@stop()

@section('global-body')
    @include('pianote._partials._nav', [
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

    <header class="shop-header" style="background-image:url(https://pianote.s3.amazonaws.com/shop/header-background.jpg);">
        <div class="container mx-auto clearfix">
            <div class="float-left px-2 md:px-3 w-full">
                @include('_partials.layout.holiday.shop-page-banner',[
                    'text' => 'Save up to 83% on lessons,<br class="inline md:hidden"> accessories, and merch.'
                ])
                {{--                <img class="logo" src="https://pianote.s3.amazonaws.com/shop/pianote-shop-logo.png" alt="pianote logo">--}}
                {{--                <h3 style="margin-top: 20px;">GET LESSONS, MERCH, <br class="inline md:hidden"> GEAR & MORE!</h3>--}}
            </div>
        </div>
    </header>


    @if(Session::has('addedProducts'))
        <section class="added-to-cart-background clearfix">
            <div class="float-left px-2 md:px-3 w-full check">
                <h2><i class="fas fa-check"></i>Added to Cart</h2>
            </div>
            <div class="float-left px-2 md:px-3 w-full product-info">
                <div class="float-left px-2 md:px-3 w-full md:w-8/12 product">
                    @foreach(Session::get('addedProducts') as $addedProduct)
                        <div class="float-left px-2 md:px-3 w-full" style="padding:0;margin-bottom:15px;">
                            <img src="{{ $addedProduct['thumbnail'] }}">
                            <h4>{{ $addedProduct['name'] }}</h4>
                            <p>{{ $addedProduct['description'] }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="float-left px-2 md:px-3 w-full md:w-4/12 checkout">
                    <h5>
                        Cart Subtotal({{ Session::get('cartNumberOfItems') }}):
                        <strong>${{ Session::get('cartSubTotal') }}</strong>
                    </h5>
                    <a href="{{ get_legacy_brand_base_url("musora") }}/order/{{ $brand }}" class="checkout-button"><i class="fas fa-cart-plus"></i> Checkout</a>
                </div>
            </div>
        </section>
    @endif

    @include('pianote.shop._partials._catalogue-filters', [
        "all" => true
    ])
    <div class="white-box">
        @include('_partials.layout.holiday.bundle-cards')

        <section class="bundles">
            <div class="container mx-auto">
                <div class="w-full card-wrap mb-5">
                    <a href="/shop/book-bundle/" class="w-full {{--py-20 sm:py-28 lg:py-40--}} py-5 lg:py-8 px-4 sm:px-6 lg:px-20 banner-product overflow-hidden bg-cover bg-center sm:bg-right" style="background-color:#ca1176;background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/november/just-the-books-shop-no-classic.jpg);">
                        <span class="top-left-badge text-white bg-promo z-10"><i class="fas fa-star"></i> SAVE {{ round(100 - (100 * (59 / 145))) }}%</span>
                        <div class="text-wrap relative z-10">
                            <img class="h-24 lg:h-32 relative z-10" src="https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/november/just-the-books-bundle-white.png">
                            <p class="my-2">
                                Chords & Scales Book + Practice Planner + Christmas<br class="hidden sm:inline">
                                Songbook + Chords Poster + Scales Poster</p>
                            <h4 class="inline-block leading-none"><strong>
                                    <s class="opacity-60">$145</s>&nbsp; ${{ PianotePrices::$bundleBook }}</strong></h4><br>
                            <span class="join smaller mt-2 lg:mt-3" style="background-color:#000;">See The Deal &raquo;</span>
                        </div>
                        {{--                <div class="absolute top-0 left-0 right-0 bottom-0 z-0 hidden md:block" style="background:linear-gradient(to right, rgba(18,139,165,0.4) 25%, #003643);"></div>--}}
                        <div class="absolute top-0 left-0 right-0 bottom-0 z-0 block md:hidden" style="background:linear-gradient(to bottom, rgba(203,19,117,0.5), #7100a1);"></div>
                    </a>
                </div>
            </div>
        </section>

        {{--    LESSONS    --}}
        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards text-center lg:text-left">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon"><i class="fas fa-video"></i></div>
                        Piano Lessons
                    </h1>
                </li>

                @foreach($lessons as $lesson){
                @include('pianote.shop._partials._shop-card', [
                        "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                        "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                        "thumbnail" => $lesson->thumbnail,
                        "packLogo" => $lesson->thumbnail_logo,
                        "title" => $lesson->name,
                        "packAuthor" => $lesson->instructor_name,
                        "cardDescription" => $lesson->short_desc,
                        "fullPrice" => $lesson->price,
                        "price" => $lesson->discounted_price === '0.00' || empty($lesson->discounted_price) ? $lesson->price : $lesson->discounted_price,
                        "category" => strtolower($lesson->productType->name),
                        "soldOut" => $lesson->sold_out,
                        "includedMembership" => $lesson->included_edge,
                        "badgeText" => $lesson->badge_text,
                ])
                }
                @endforeach
            </ul>
        </section>

        {{--   ACCESSORIES     --}}
        <section class="grid-view category-section" data-category="shirts">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon"><i class="fas fa-mug-hot"></i></div>
                        Accessories
                    </h1>
                </li>
                @foreach($accessories as $accessory){
                @include('pianote.shop._partials._shop-card', [
                        "sku" => $accessory->sku,
                        "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                        "thumbnail" => $accessory->thumbnail,
                        "badgeText" => $accessory->badge_text,
                        "title" => $accessory->name,
                        "cardDescription" => $accessory->short_desc,
                        "fullPrice" => $accessory->price,
                        "price" => $accessory->discounted_price === '0.00' || empty($accessory->discounted_price) ? $accessory->price : $accessory->discounted_price,
                        "category" => strtolower($accessory->productType->name),
                        "soldOut" => $accessory->sold_out,
                        "size_case_sensitive" => $accessory->size_case_sensitive,
                ])
                }
                @endforeach
            </ul>
        </section>

        {{--   SHIRTS     --}}
        <section class="grid-view category-section" data-category="shirts">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon"><i class="fas fa-tshirt"></i></div>
                        Shirts
                    </h1>
                </li>
                @foreach($shirts as $shirt){
                @include('pianote.shop._partials._shop-card', [
                    "sku" => $shirt->sku,
                    "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                    "thumbnail" => $shirt->thumbnail,
                    "badgeText" => $shirt->badge_text,
                    "title" => $shirt->name,
                    "cardDescription" => $shirt->short_desc,
                    "fullPrice" => $shirt->price,
                    "price" => $shirt->discounted_price === '0.00' || empty($shirt->discounted_price) ? $shirt->price : $shirt->discounted_price,
                    "category" => strtolower($shirt->productType->name),
                    "sizes" => $shirt->sizes,
                    "soldOut" => $shirt->sold_out,
                    "size_case_sensitive" => $shirt->size_case_sensitive,
                ])
                }
                @endforeach
            </ul>
        </section>

        {{--   HOODIES     --}}
        <section class="grid-view category-section" data-category="shirts">
            <ul class="container mx-auto fixed-cards">
                <li>
                    <h1 class="float-left px-2 md:px-3 w-full">
                        <div class="heading-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hoodie.svg"></div>
                        Hoodies
                    </h1>
                </li>
                @foreach($hoodies as $hoodie){
                @include('pianote.shop._partials._shop-card', [
                    "sku" => $hoodie->sku,
                    "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                    "thumbnail" => $hoodie->thumbnail,
                    "badgeText" => $hoodie->badge_text,
                    "title" => $hoodie->name,
                    "cardDescription" => $hoodie->short_desc,
                    "fullPrice" => $hoodie->price,
                    "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                    "category" => strtolower($hoodie->productType->name),
                    "sizes" => $hoodie->sizes,
                    "soldOut" => $hoodie->sold_out,
                    "size_case_sensitive" => $hoodie->size_case_sensitive,
                ])
                }
                @endforeach

            </ul>
        </section>
    </div>

    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>

    <script src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{asset('/marketing/parcel/pianote/nav-footer.js') }}"></script>
    <script src="{{ asset('/marketing/js/jquery.countdown-2.min.js') }}"></script>

    <script>
        $(function () {
            $('.scalable-card').click(function (e) {
                e.stopPropagation();
                if (!$(e.target).is('.pack-pick') && !$(e.target).is('option') && !$(e.target).is('a') && !$(e.target).is('button')) {
                    $(this).toggleClass('flipped');
                }
            });


            //modal video swapping
            $('.play-vimeo').on('click', function (ev) {

                $("#vimeo")[0].src += "?autoplay=1";
                ev.preventDefault();
            });
            $('body').on('click', '.modal, .modal .stop-play', function (e) {
                if (e.target !== this)
                    return;

                var newSource = $("#vimeo").attr('src').replace("?autoplay=1", " ");
                $("#vimeo").attr('src', newSource);
            });

            //customize section pack picker
            var originalLink = '/ecommerce/add-to-cart';

            $('select').prop('selectedIndex', 0);
            $(".pack-pick").change(function () {
                var orderButton = $(this).parent().find(".selected-pack");
                var selectedOption = $(this).find("option:selected");
                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', originalLink);
                orderButton.attr('href', orderButton.attr('href') + selectedOption.val() + '&redirect=/shop');
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
                $('.timing-info').removeClass('active');
            });

            $(".shipping-delay .shipping-trigger").on('click', function () {
                $('.delay-overlay').addClass('active');
                $('.shipping-info').addClass('active');
            });

            $(".shipping-delay .timing-trigger").on('click', function () {
                $('.delay-overlay').addClass('active');
                $('.timing-info').addClass('active');
            });

            $(".shipping-delay .close-modal").on('click', function () {
                $('.delay-overlay').removeClass('active');
                $('.shipping-info').removeClass('active');
                $('.timing-info').removeClass('active');
            });
            $(document).keyup(function(e) {
                if (e.which === 27) {
                    $('.delay-overlay').removeClass('active');
                    $('.shipping-info').removeClass('active');
                    $('.timing-info').removeClass('active');
                }
            });
        });
    </script>

    <script src="{{ asset('/marketing/js/pianote/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/pianote/app.js') }}"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    @yield('scripts')

    @include('pianote.shop._partials._promo-countdown')
@stop

