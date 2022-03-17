@extends('guiatreo._partials.layout')

@section('head-includes')
    @parent

    <title>Guitareo Shop</title>
    <meta property="og:title" content="Guitareo Shop">
    <meta name="description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/shop/">

    {{-- @include('layouts.partials._favicons')
    @include('layouts.partials._fonts') --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/assets/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">

    <link href="{{ asset('/assets/marketing/shop.css') }}" rel="stylesheet">
@stop

@section('layout-scripts')
    @parent
    {{--<script src="/assets/js/modal.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/js/modal-autoplay.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
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
            $('.tzcd-full').countdown('2021/11/30')
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
            $('.tzcd-med').countdown('2021/11/30')
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
            $('.tzcd-small').countdown('2021/11/30')
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
            $('.tzcd-big').countdown('2021/11/30')
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

@section('layout-body')
    @include("guiatreo.sales.partials._nav", [
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
                    {{--<a href="/beginner-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge"><i class="fas fa-star"></i> Save 80%</span>--}}
                        {{--<div class="thumb hidden lg:block" style="background-image:url(https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/card-thumb2.jpg);"></div>--}}
                        {{--<div class="thumb block lg:hidden" style="background-image:url(https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/beginner/card-thumb.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>Beginner Quick-Start Bundle</strong><br>--}}
                                {{--<em>3 Amazing Lesson Packs<br class="inline md:hidden lg:inline">--}}
                                   {{--&nbsp; </em>--}}
                                {{--<span class="price"><s class="opacity-30">$491</s> <strong style="color:#fcaf43;">${{ App\Prices::$bundleBeginner }}</strong></span>--}}
                            {{--</p>--}}
                            {{--<span class="join max-w-md" style="background-color:#fcaf43;">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/2 card-wrap">--}}
                    {{--<a href="/ultimate-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge"><i class="fas fa-star"></i> 5 FREE GIFTS WORTH $885</span>--}}
                        {{--<div class="thumb hidden lg:block" style="background-image:url(https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/card-thumb2.jpg);"></div>--}}
                        {{--<div class="thumb block lg:hidden" style="background-image:url(https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/card-thumb.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>Guitareo Discount + 5 Bonuses</strong><br>--}}
                                {{--<em>Guitareo Annual Membership (Normally $127)<br>--}}
                                    {{--+ 5 Lesson Packs</em>--}}
                                {{--<span class="price"><s class="opacity-30">$1012</s> <strong style="color:#f75659;">${{  }}</strong></span>--}}
                            {{--</p>--}}
                            {{--<span class="join max-w-md" style="background-color:#f75659;">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}

                {{--<div class="float-left w-full px-2 md:px-3 md:w-1/2 card-wrap">--}}
                    {{--<a href="/lifetime-bundle" class="bundle-card">--}}
                        {{--<span class="top-left-badge">ONLY <span class="tzcd-med">0D 00H 00S</span> LEFT</span>--}}
                        {{--<div class="thumb hidden lg:block" style="background-image:url(https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/lifetime/card-thumb21-2.jpg);"></div>--}}
                        {{--<div class="thumb --}}{{----}}{{--block lg:hidden--}}{{----}}{{--" style="background-image:url(https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/lifetime/card-thumb21.jpg);"></div>--}}
                        {{--<div class="float-left w-full px-2 md:px-3">--}}
                            {{--<p><strong>The Lifetime Bundle</strong><br>--}}
                                {{--<em>Guitareo Lifetime Membership <br>--}}
                                    {{--+ 5 Lesson Packs</em>--}}
                                {{--<strong class="price"><span style="color:#262163">${{ \App\Prices::$bundleLifetime }}</span></strong>--}}
                            {{--</p>--}}
                            {{--<span class="join max-w-md" style="background-color:#262163;color:#fff;">See The Deal &raquo;</span>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
        <section class="grid-view category-section" data-category="lessons">
            <ul class="container mx-auto fixed-cards">
                @include('guitareo.shop.elements._shop-card', [
                "badgeText" => "SAVE 21% + 2 FREE BONUSES",
                "itemURL" => "/",
                "thumbnail" => "https://guitareo.s3.amazonaws.com/sales/2021/header-background.jpg",
                "packLogo" => "https://guitareo.s3.amazonaws.com/sales/storefront/guitareo-membership-logo-white.svg",
                "title" => "Guitareo Membership",
                "packAuthor" => "Ayla Tesler-Mabe",
                "cardDescription" => "Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.",
                "fullPrice" => \App\Prices::$guitareoMembershipAnnualFull,
                "price" => \App\Prices::$guitareoMembershipAnnual,
                "popularity" => "99",
                "category" => "lessons",
                "buttonText" => "See The Deal",
                ])
                @include('guitareo.shop.elements._shop-card', [
                "badgeText" => "LIFETIME ACCESS WITH GUITAREO",
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
                @include('guitareo.shop.elements._shop-card', [
                "badgeText" => "LIFETIME ACCESS WITH GUITAREO",
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
                @include('guitareo.shop.elements._shop-card', [
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
                @include('guitareo.shop.elements._shop-card', [
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
                @include('guitareo.shop.elements._shop-card', [
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

    @include("guiatreo.sales.partials._footer")
@stop