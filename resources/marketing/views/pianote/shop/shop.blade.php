@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Pianote Shop</title>
    <meta property="og:title" content="Pianote Shop">
    <meta name="description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:description" content="Get Lessons, T-Shirts, & Much More!">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/og-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">--}}
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/shop.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:500" rel="stylesheet">

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
    @include('pianote.sales.nav', [
    "joinVersion" => true,
    "scrollToJoin" => true,
    "homepageVersion" => true,
    ])

{{--    @include('pianote.sales.nav', [--}}
{{--        "cartVersion" => true--}}
{{--    ])--}}
{{--    @include('shop.partials._promo-banner')--}}

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
                <p>In these unprecedented and challenging times, we are doing our best to support pianists with online lessons and practice tools while staying committed to the safety and wellbeing of our team: encouraging staff to work from home and practice social distancing.
                    <br><br>
                    Right now there are two ways the COVID-19 crisis might impact your Pianote order:</p>
                <ul>
                    <li><strong>Shipping Delays:</strong> There are shipping delays worldwide and shipping challenges in some countries. During checkout for any physical goods, if your location is experiencing a shipping suspension due to COVID-19, we’ve added red text to notify you of this impact. However, even if you don’t see this warning, we cannot ensure typical shipping timelines due to delays that are outside of our control.</li>
                    <li><strong>Support Requests:</strong> With more pianists staying at home, there are more people practicing than ever before. And we’re SO excited about this! However, this also means we’re getting more requests for personalized lesson plans, student reviews, technology questions, and transactional questions. We’re continuing to help you the best we can, but please be patient if you experience any delays. (Our typical response time is within less than one hour during business hours.)</li>
                </ul>
                <p style="margin-bottom: 0;">We thank you for your patience and understanding. We wouldn’t exist without you, our students, and we’re so thankful for your continued support.
                    <br><br>
                    Have Fun Playing Piano,
                    <br>
                    - Lisa Witt<br><br>
                    <strong>Have questions?</strong> <a target="_blank" class="text-pianote" href="https://help.pianote.com/"><u>Click here for our FAQs and answers.</u></a></p>
            </div>
        </div>
    </div>

    <header class="shop-header" style="background-image:url(https://pianote.s3.amazonaws.com/shop/header-background.jpg);">
        <div class="container mx-auto clearfix">
            <div class="float-left px-2 md:px-3 w-full">
                <img class="logo" src="https://pianote.s3.amazonaws.com/shop/pianote-shop-logo.png">
                <h3 style="margin-top: 20px;">GET LESSONS, MERCH, <br class="inline md:hidden"> GEAR & MORE!</h3>
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
                    <a href="/order" class="checkout-button"><i class="fas fa-cart-plus"></i> Checkout</a>
                </div>
            </div>
        </section>
    @endif

    @include('pianote.shop.partials._catalogue-filters', [
        "all" => true
    ])
    <div class="white-box">
        @yield('cards')
    </div>


    @include('pianote.sales.footer')
    <script src="{{ asset('marketing/parcel/pianote/manifest.js') }}"></script>
    <script src="{{ asset('marketing/parcel/pianote/vendor.js') }}"></script>
    <script src="{{ asset('marketing/parcel/pianote/cart-sidebar.js') }}"></script>
    <script src="{{ asset('marketing/parcel/pianote/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/marketing/parcel/pianote/nav-footer.js"></script>
    <script src="/marketing/parcel/pianote/shop-filters.js"></script>
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
    @yield('scripts')

    @include('pianote.shop.partials._promo-countdown')
@stop
