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
    </style>
    <div class="shipping-delay">
        <div class="delay-bar text-center">
            <div class="container mx-auto">
                <p><a class="shipping-trigger"><i class="fas fa-truck"></i> <strong>FREE SHIPPING OVER $100</strong></a> &nbsp; &nbsp;
                    <a class="timing-trigger"><i class="fas fa-clock"></i> <strong>SHIPPING TIMELINES & SAFETY</strong></a></p>
            </div>
        </div>

        <div class="delay-overlay">
            <div class="info-wrap shipping-info" >
                <i class="fas fa-times close-modal"></i>
                <h3><strong>Free Shipping Over $100</strong></h3>
                <p>Spend over $100 and you'll unlock free worldwide shipping on any order.</p>
            </div>
            <div class="info-wrap timing-info" >
                <i class="fas fa-times close-modal"></i>
                <h3><strong>Shipping Timelines & Safety</strong></h3>
                <p>In these unprecedented and challenging times, we are doing our best to support vocalists with online lessons and practice tools while staying committed to the safety and wellbeing of our team: encouraging staff to work from home and practice social distancing.
                    <br><br>
                    Right now there are two ways the COVID-19 crisis might impact your Singeo order:</p>
                <ul>
                    <li><strong>Shipping Delays:</strong> There are shipping delays worldwide and shipping challenges in some countries. During checkout for any physical goods, if your location is experiencing a shipping suspension due to COVID-19, we’ve added red text to notify you of this impact. However, even if you don’t see this warning, we cannot ensure typical shipping timelines due to delays that are outside of our control.</li>
                    <li><strong>Support Requests:</strong> With more vocalists staying at home, there are more people practicing than ever before. And we’re SO excited about this! However, this also means we’re getting more requests for personalized lesson plans, student reviews, technology questions, and transactional questions. We’re continuing to help you the best we can, but please be patient if you experience any delays. (Our typical response time is within less than one hour during business hours.)</li>
                </ul>
                <p style="margin-bottom: 0;">We thank you for your patience and understanding. We wouldn’t exist without you, our students, and we’re so thankful for your continued support.
                    <br><br>
                    Have Fun Singing,
                    <br>
                    - Lisa Witt<br><br>
                    <strong>Have questions?</strong> <a target="_blank" class="text-singeo" href="https://help.singeo.com/"><u>Click here for our FAQs and answers.</u></a></p>
            </div>
        </div>
    </div>
    <header class="drum-shop-header" style="background-color:#080e1e;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/products/shop-header.jpg);">
        <div class="container mx-auto">
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
{{--                        <a href="/order" class="join smaller"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>--}}
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
        {{--<section class="bundles">--}}
            {{--<div class="container mx-auto">--}}
                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/3 card-wrap">--}}
                    {{--<a href="/shop/beginner-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge"><i class="fas fa-star"></i> SAVE 20%</span>--}}
                        {{--<div class="thumb" style="background-image:url(https://cdn.musora.com/image/fetch/w_670,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/august/beginner_bundle.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>1 Year of Singing Lessons</strong><br>--}}
                                {{--<em>Get everything you need to start improving<br class="hidden lg:inline"> your voice and maximize results NOW<br class="hidden lg:inline">--}}
                                    {{--Annual membership + Singing Starter Kit<br class="hidden lg:inline"> + Vowel Practice Poster</em>--}}
                                {{--<span class="price"><s class="opacity-30">$158</s> <strong style="color:#00c0b1;">$127</strong></span>--}}
                            {{--</p>--}}
                            {{--<span class="join" style="background-color:#00c0b1;">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/3 card-wrap">--}}
                    {{--<a href="/shop/swag-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge"><i class="fas fa-star"></i> SAVE 25%</span>--}}
                        {{--<div class="thumb" style="background-image:url(https://cdn.musora.com/image/fetch/w_670,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/august/swag_bundle.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>1 Year of Singing Lessons</strong><br>--}}
                                {{--<em>Get FULL member access<br class="hidden lg:inline"> for a year +--}}
                                    {{--Rockstar Mug<br class="hidden lg:inline"> + Singeo Retro T-Shirt<br class="hidden lg:inline">&nbsp;</em>--}}
                                {{--<span class="price"><s class="opacity-30">$168</s> <strong style="color:#ff591b;">$127</strong></span>--}}
                            {{--</p>--}}
                            {{--<span class="join" style="background-color:#ff591b;">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/3 card-wrap">--}}
                    {{--<a href="/lifetime" class="bundle-card">--}}
                        {{--<span class="top-left-badge">ONLY {{ $products['singeo-lifetime-membership-access']->getPublicStockCount() }} SPOTS</span>--}}
                        {{--<div class="thumb" style="background-image:url(https://cdn.musora.com/image/fetch/w_670,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/august/lifetime_bundle.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>Lifetime of Singing Lessons</strong><br>--}}
                                {{--<em>Have LIFETIME access to our<br class="hidden lg:inline"> member's area + ALL our merch:<br class="hidden lg:inline"> Do-Re-Mi--}}
                                    {{--tumbler + Rockstar Mug +<br class="hidden lg:inline"> Vowel Practice Poster + Retro T-shirt</em>--}}
                                {{--<strong class="price"><s class="opacity-30">$397</s> <span style="color:#dc2661">$297</span></strong>--}}
                            {{--</p>--}}
                            {{--<span class="join" style="background-color:#dc2661;color:#fff;">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}

        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards">
                <div class="mx-2 rounded-xl bg-cover bg-top bg-no-repeat mb-16 md:text-right top-banner">
                    <div class="md:w-2/5 py-6 lg:py-12 inline-block text-center">
                        <img class="mt-40 sm:mt-0 h-28 md:h-24 lg:h-36 mb-2 lg:mb-4 inline-block" src="https://singeo.s3.amazonaws.com/sales/promos/october/perfect_harmony_white.png" alt="perfect harmony logo">
                        <p class="text-white px-2 md:pr-1 lg:px-5 mb-2 text-sm">
                            Singeo Annual Membership + <b>*NEW*</b> The Essential Guide To Beautiful Harmonies <s style="color:#9C70BF;">($27)</s> + Singer Starter Kit <s style="color:#9C70BF;">($19)</s>
                        </p>
                        <a class="join smaller md:inline-block hidden" href="/shop/harmony-bundle">Get my free bonuses</a>
                        <a class="join inline-block md:hidden" href="/shop/harmony-bundle">Get my free bonuses</a>
                    </div>
                </div>

                @foreach($products as $product){
                    @include('singeo.shop.partials._shop-card', [
                            "sku" => $product->sku,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $product->slug ),
                            "thumbnail" => $product->thumbnail,
                            "packLogo" => $product->thumbnail_logo,
                            "badgeText" => $product->badge_text,
                            "title" => $product->name,
                            "packAuthor" => $product->instructor_name,
                            "cardDescription" => $product->short_desc,
                            "fullPrice" => $product->price,
                            "price" => $product->discounted_price === '0.00' || empty($product->discounted_price) ? $product->price : $product->discounted_price,
                            "category" => strtolower($product->productType->name),
                            "includedEdge" => $product->included_edge,
                            "sizes" => $product->sizes,
                            "soldOut" => $product->sold_out,
                            "size_case_sensitive" => $product->size_case_sensitive,
                    ])
                }
                @endforeach

            </ul>
        </section>

    </div>

    @include("singeo.sales.partials._footer")

    <script src="{{ asset('marketing/js/singeo/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/singeo/vendor.js') }}"></script>
    <script src="{{ asset('marketing/js/singeo/cart-sidebar.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/singeo/nav-footer.js"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
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
            // Countdown
            $('.tzcd-full').countdown('2022/09/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-med').countdown('2022/09/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2022/09/01')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2022/09/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
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
@stop
