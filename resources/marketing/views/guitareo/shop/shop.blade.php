@extends('layouts.global-layout')

@section('meta')
    <title>Guitareo Shop</title>
    <meta property="og:title" content="Guitareo Shop">
    <meta name="description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/shop/">

    @include('layouts.partials._favicons')
    @include('layouts.partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/assets/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/marketing/shop.css') }}" rel="stylesheet">
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
    </style>
@stop

@section('scripts')
    @parent
    {{--<script src="/assets/js/modal.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/js/modal-autoplay.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="/js/jquery.countdown-2.min.js"></script>
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
            $('.tzcd-full').countdown('2022/08/01')
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
            $('.tzcd-med').countdown('2022/08/01')
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
            $('.tzcd-small').countdown('2022/08/01')
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
            $('.tzcd-big').countdown('2022/08/01')
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
        });
    </script>
@stop

@section('content')
    @include("sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="drum-shop-header" style="background-color:#080e1e;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/black-friday/shop-bg.jpg);">
        <div class="container mx-auto">
            <div class="px-2 md:px-3">
                <img class="logo" src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
                <h1><strong>SHOP</strong></h1>
                {{--<p>GET LESSONS, MERCH, GEAR, & MUCH MORE</p>--}}
            </div>
        </div>
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
                        <a href="/order" class="join smaller"><i class="fas fa-cart-plus"></i> Proceed to Checkout</a>
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
        {{--<section class="bundles">--}}
            {{--<div class="container mx-auto">--}}
                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/2 card-wrap">--}}
                    {{--<a href="/5-pack-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge"><i class="fas fa-star"></i> Save 89%</span>--}}
                        {{--<div class="thumb" style="background-image:url(https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/july/5pack_card.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>5 Digital Training Packs</strong><br>--}}
                                {{--<em>Get every training pack bundled together.<br class="inline md:hidden lg:inline">--}}
                                    {{--No membership or recurring fees.</em>--}}
                                {{--<span class="price"><s class="opacity-30">$885</s> <strong style="color:#537ce5;">$97</strong></span>--}}
                            {{--</p>--}}
                            {{--<span class="join max-w-md" style="background:linear-gradient(to bottom, #00f0ff, #537ce5);">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/2 card-wrap">--}}
                    {{--<a href="/ultimate-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge"><i class="fas fa-star"></i> 6 FREE BONUSES WORTH $904</span>--}}
                        {{--<div class="thumb" style="background-image:url(https://cdn.musora.com/image/fetch/w_1600,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/july/ultimate_card.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>Guitareo Membership + 6 Free Gifts</strong><br>--}}
                                {{--<em>--}}
                                    {{--Guitareo Method, Songs, & Coaches<br>--}}
                                    {{--+ Every Training Pack + Survival Guide</em>--}}
                                {{--<span class="price"><strong style="color:#ff3364;">$127</strong></span>--}}
                            {{--</p>--}}
                            {{--<span class="join max-w-md" style="background:linear-gradient(to bottom, #ff737c, #ff3364);">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards">
                @include('shop.elements._shop-card', [
                "itemURL" => "/",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/2021/header-background.jpg",
                "packLogo" => "https://guitareo.s3.amazonaws.com/sales/storefront/guitareo-membership-logo-white.svg",
                "title" => "Guitareo Membership",
                "packAuthor" => "Join Today",
                "cardDescription" => "Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.",
                "fullPrice" => \App\Prices::$guitareoMembershipAnnualFull,
                "price" => \App\Prices::$guitareoMembershipAnnual,
                "popularity" => "99",
                "category" => "lessons",
                "buttonText" => "Get Started",
                ])
                @include('shop.elements._shop-card', [
                "badgeText" => "NEW",
                "sku" => "rhythm-and-groove",
                "itemURL" => "/rhythm-and-groove",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/coach.jpg",
                "packLogo" => "https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/Logo.svg",
                "title" => "Rhythm  & Groove",
                "packAuthor" => "Sami Ghawi",
                "cardDescription" => "Go beyond simple strumming on the guitar.",
                "includedEdge" => true,
                "fullPrice" => \App\Prices::$rhythmAndGrooveFull,
                "price" => \App\Prices::$rhythmAndGroove,
                "popularity" => "89",
                "category" => "lessons",
                "redirectUrl" => "/shop",
                ])
                @include('shop.elements._shop-card', [
                "sku" => "survival-guide",
                "itemURL" => "/shop/survival-guide",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg",
                "title" => "Guitareo Survival Guide",
                "packAuthor" => "Guitareo",
                "cardDescription" => "Guitar Chords Scales And Licks You Can Take Anywhere",
                "fullPrice" => \App\Prices::$survivalGuideFull,
                "price" => \App\Prices::$survivalGuide,
                "popularity" => "89",
                "category" => "accessories",
                "redirectUrl" => "/shop",
                "soldOut" => $products['survival-guide']->isProductSoldOut()
                ])
                @include('shop.elements._shop-card', [
                "sku" => "GTME-OCT-2018-SEMESTER",
                "itemURL" => "/guitar-technique-made-easy",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/storefront/guitar-technique-made-easy-image.jpg",
                "packLogo" => "https://guitareo.s3.amazonaws.com/gtme/logo-white.png",
                "title" => "Guitar Technique Made Easy",
                "packAuthor" => "Nate Savage",
                "cardDescription" => "Learn the most important guitar techniques and reach total guitar freedom.",
                "includedEdge" => true,
                "fullPrice" => \App\Prices::$GTMEFull,
                "price" => \App\Prices::$GTMERegular,
                "popularity" => "89",
                "category" => "lessons",
                "redirectUrl" => "/shop",
                ])
                @include('shop.elements._shop-card', [
                "sku" => "GUITAR-SYSTEM",
                "itemURL" => "/guitar-system",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/june/guitar-system.jpg",
                "packLogo" => "https://guitareo.s3.amazonaws.com/tripwire/gs-logo.png",
                "title" => "The Guitar System",
                "packAuthor" => "Nate Savage",
                "cardDescription" => "Transform your guitar playing with the ultimate encyclopedia of guitar lessons.",
                "includedEdge" => true,
                "fullPrice" => \App\Prices::$guitarSystemFull,
                "price" => \App\Prices::$guitarSystemRegular,
                "popularity" => "89",
                "category" => "lessons",
                "redirectUrl" => "/shop",
                ])
                @include('shop.elements._shop-card', [
                "sku" => "guitar-quest",
                "itemURL" => "/guitar-quest",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/june/guitar-quest.jpg",
                "packLogo" => "https://d122ay5chh2hr5.cloudfront.net/guitarquest/assets/guitar-quest-logo.png",
                "title" => "GuitarQuest",
                "packAuthor" => "Rob Scallon",
                "cardDescription" => "Skip the boring stuff and start having fun! Your journey starts here.",
                "includedEdge" => true,
                "fullPrice" => \App\Prices::$guitarQuestFull,
                "price" => \App\Prices::$guitarQuestRegular,
                "popularity" => "89",
                "category" => "lessons",
                "redirectUrl" => "/shop",
                ])
                @include('shop.elements._shop-card', [
                "sku" => "AGME-JAN-2019-SEMESTER",
                "itemURL" => "/acoustic-guitar-made-easy",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/storefront/acoustic-guitar-made-easy-image.jpg",
                "packLogo" => "https://s3.amazonaws.com/guitareo/acoustic-guitar-made-easy/sales/AGME-logo-white.png",
                "title" => "Acoustic Guitar Made Easy",
                "packAuthor" => "Nate Savage",
                "cardDescription" => "Build a rock-solid foundation and get started on the acoustic guitar the right way.",
                "includedEdge" => true,
                "fullPrice" => \App\Prices::$AGMEFull,
                "price" => \App\Prices::$AGMERegular,
                "popularity" => "89",
                "category" => "lessons",
                "redirectUrl" => "/shop",
                ])
                @include('shop.elements._shop-card', [
                "sku" => "500-songs-in-5-days-guitareo",
                "itemURL" => "/500-songs",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/promos/june/500-songs-card-small.jpg",
                "packLogo" => "https://guitareo.s3.amazonaws.com/500-songs/logo.svg",
                "title" => "500 Songs In 5 Days",
                "packAuthor" => "Nate Savage",
                "cardDescription" => "Build the skills and knowledge to play 500 songs on the guitar. Comes with downloadable chord charts.",
                "includedEdge" => true,
                "fullPrice" => \App\Prices::$songs500Full,
                "price" => \App\Prices::$songs500Regular,
                "popularity" => "89",
                "category" => "lessons",
                "redirectUrl" => "/shop",
                ])
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
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    @include("sales.partials._footer")
@stop