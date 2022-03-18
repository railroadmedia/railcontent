@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <title>Lifetime Membership To Guitareo | Guitareo</title>
    <meta property="og:title" content="Lifetime Membership To Guitareo">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    <meta name="description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
    <meta property="og:description" content="With the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar.">
        <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/assets/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/marketing/sales-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/animate.css') }}" rel="stylesheet">

    @include('_partials.components.google-optimize')

    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
    </style>
    <style>
        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special p {
            max-width:100%;
        }

        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
            max-width:240px;
            padding-bottom: 52%;
        }
        @media (min-width: 768px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:290px;
                padding-bottom: 34%;
            }
        }
        @media (min-width: 1024px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:330px;
                padding-bottom: 25%;
            }
        }
    </style>
@stop
@section('layout-scripts')
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
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

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
    {{--@include('shop.elements.promo-banner', [--}}
                {{--"name" => "The Lifetime Bundle",--}}
                {{--"fullPrice" => App\Prices::$bundleLifetime,--}}
                {{--"price" => App\Prices::$bundleLifetime,--}}
                    {{--"noBreadcrumb" => true,--}}
                    {{--"specialText" => "<strong>Extended for Cyber Monday</strong>",--}}
            {{--])--}}
    <section class="content-section relative overflow-hidden text-white grey text-center upgrade-video-header" style="background-color:#000318;padding-bottom:10px">
        <div class="container mx-auto">
            <h1><strong>Guitar lessons for the REST OF YOUR LIFE.</strong></h1>
            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative">
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/649717537" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

            <h3 class="leading-tight">
                {{--<strong class="text-promo">Extended for Cyber Monday</strong><br>--}}
                Lifetime Membership For ${{ \App\Prices::$guitareoMembershipLifetime }}
                {{--AVAILABLE UNTIL DEC. 3--}}
            </h3>
            <a href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[guitar-quest]=1&products[GTME-OCT-2018-SEMESTER]=1&products[AGME-JAN-2019-SEMESTER]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&redirect=/order&locked=true"
                    class="join promo methodcta my-4">BECOME A LIFETIME MEMBER &raquo;</a>
            {{--<a class="join sold-out methodcta my-4">SOLD OUT</a>--}}
            <p>(Or choose a payment plan on the next page.)</p>

            <h6 class="leading-relaxed px-3 mt-10 text-left" style="width: 100%;max-width: 600px;">You're not just a guitarist for one day. You're not just a guitarist for one week. You're a guitarist for LIFE. And it doesn't matter if the guitar is a passion or a tool for living your dream - with the LIFETIME bundle, you'll get everything you need to pursue and develop your skills on the guitar. Learn any style you want, from jazz, to blues, to country, and more. Or find new and creative ways to get inspired with any of the digital lesson packs, whenever, however much you want -- FOR THE REST OF YOUR LIFE. There are no limits to what you can study and achieve with a lifetime of guitar lessons.
                {{--<br><br>--}}
                {{--Scroll down to learn more...--}}
            </h6>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
        <section class="content-section relative overflow-hidden text-white grey text-center customize" style="background: linear-gradient(#000318,#01082b 100%);">
                <div class="container mx-auto">
                    {{--<div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl" style="font-size: 0;">--}}
                        {{--<div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-full">--}}
                            {{--<div class="flip-div special">--}}
                                {{--<div class="flip-inner">--}}
                                    {{--<div class="front ">--}}
                                        {{--<div class="absolute top-0 right-0 border-2 bg-black text-promo rounded-full py-4 px-3 -m-5" style="border-color:#fa153e"><p style="line-height: 1em;">SAVE</p><br><h5 class="leading-none" style="margin-bottom: 0;"><strong>25%</strong></h5></div>--}}
                                        {{--<div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/lifetime/card-thumb21.jpg);"></div>--}}
                                    {{--</div>--}}
                                    {{--<div class="back">--}}
                                        {{--<div class="text-wrap">--}}
                                            {{--<p>Imagine what it would be like to call yourself a guitarist for the rest of your life… And with a LIFETIME membership to Guitareo -- you can do just that! Get full access to every lesson, song, chord chart, jam track, live Q&A, video review, and real teachers helping you along the way, from now and into the future. And it never expires! You can learn what you want, whenever you want, for the rest of your life.</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<p><span style="text-transform:uppercase; display:inline-block;margin-top: 7px;">--}}{{--<s>${{ \App\Prices::$guitareoMembershipLifetimeFull }}</s>--}}{{-- <strong class="text-promo">${{ \App\Prices::$guitareoMembershipLifetime }}</strong></span><br>--}}
                                {{--INSTANT ACCESS--}}
                            {{--</p>--}}
                        {{--</div>--}}
                        {{--@php--}}
                            {{--$bonuses = [--}}
                                {{--[--}}
                                {{--'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gq.jpg',--}}
                                {{--'title' => 'GuitarQuest',--}}
                                {{--'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',--}}
                                {{--'price' => \App\Prices::$guitarQuestFull,--}}
                                {{--'online-ship' => "Lifetime Access"--}}
                                {{--],--}}
                                {{--[--}}
                                {{--'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/500s.jpg',--}}
                                {{--'title' => '500 Songs In 5 Days',--}}
                                {{--'description' => 'Build the skills and knowledge to play 500 songs on the guitar. Comes with downloadable chord charts.',--}}
                                {{--'price' => \App\Prices::$songs500Full,--}}
                                {{--'online-ship' => "Lifetime Access"--}}
                                {{--],--}}
                                {{--[--}}
                                {{--'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/agme.jpg',--}}
                                {{--'title' => 'Acoustic Guitar Made Easy',--}}
                                {{--'description' => 'Build a rock-solid foundation and get started on the acoustic guitar the right way.',--}}
                                {{--'price' => \App\Prices::$AGMEFull,--}}
                                {{--'online-ship' => "Lifetime Access"--}}
                                {{--],--}}
                                {{--[--}}
                                {{--'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',--}}
                                {{--'title' => 'Guitar Technique Made Easy',--}}
                                {{--'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',--}}
                                {{--'price' => \App\Prices::$GTMEFull,--}}
                                {{--'online-ship' => "Lifetime Access"--}}
                                {{--],--}}
                                {{--[--}}
                                {{--'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',--}}
                                {{--'title' => 'The Guitar System',--}}
                                {{--'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',--}}
                                {{--'price' => \App\Prices::$guitarSystemFull,--}}
                                {{--'online-ship' => "Lifetime Access"--}}
                                {{--],--}}
                            {{--]--}}
                        {{--@endphp--}}
                        {{--@foreach($bonuses as $bonus)--}}
                            {{--<div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3">--}}
                                {{--<div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 132%;">--}}
                                    {{--<div class="flip-inner">--}}
                                        {{--<div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">--}}
                                            {{--<div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>--}}
                                            {{--<div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>--}}
                                        {{--</div>--}}
                                        {{--<div class="back">--}}
                                            {{--<div class="text-wrap">--}}
                                                {{--<p class="text-xs">{!!  $bonus['description']  !!}</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<p class="uppercase">--}}
                                    {{--<strong class="font-black leading-tight inline-block mt-2 mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                                    {{--<span class="text-promo" style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong>FREE</strong></span><br>--}}
                                    {{--{{ $bonus['online-ship'] }}--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}

                        {{--<p style="max-width: 500px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account IMMEDIATELY  with your membership to Guitareo, and they’re yours forever. </em></p>--}}
                    {{--</div>--}}
                    <div class="arrow-wrap text-promo">
                        <i class="fal fa-chevron-down animated infinite pulse"></i>
                        <i class="fal fa-chevron-down animated delay-1s infinite pulse"></i>
                        <i class="fal fa-chevron-down animated delay-2s infinite pulse"></i>
                    </div>

                    <a class="join promo methodcta"
                            href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[guitar-quest]=1&products[GTME-OCT-2018-SEMESTER]=1&products[AGME-JAN-2019-SEMESTER]=1&products[500-songs-in-5-days-guitareo]=1&products[GUITAR-SYSTEM]=1&redirect=/order&locked=true"
                    >Get Started &raquo;</a>
                    {{--<a class="join sold-out methodcta my-4">SOLD OUT</a>--}}
                    <br><br>

                    <div class="inline-block w-full px-3 md:px-4 my-5 credit-cards text-light-navy">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-amex"></i>
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fab fa-cc-discover"></i>
                    </div>
                    <div class="inline-block w-full px-3 md:px-4 questions max-w-2xl">
                        <h4><strong>Still have questions?</strong></h4>
                        <p>If you need any further information about becoming a Lifetime Member, email our amazing support team <a class="text-white" href="/support">here</a>
                            <br><br>
                            A friendly and knowledgeable support team member will get back to you right away.
                            <br> All prices listed in USD.</p>
                        {{--<p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at--}}
                            {{--<a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at--}}
                            {{--<a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>--}}
                    </div>

                </div>
        </section>

    <section class="content-section relative overflow-hidden text-white text-center">
        <div class="container mx-auto max-w-5xl">
            <img alt="" class="guarantee-badge lazyload inline-block sm:hidden w-32" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/guarantee-badge.png">
            <div class="flex items-start lg:items-center px-5">
                <img alt="" class="guarantee-badge lazyload hidden sm:inline-block order-1 w-48 lg:w-60" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/guarantee-badge.png">
                <div class="text-wrap sm:text-left sm:pr-5">
                    <h2 class="my-3 sm:mt-0"><strong>Happy guitar playing, guaranteed!</strong></h2>
                    <p class="leading-loose text-navy">We love our students. More than anything, we want you to enjoy a super-positive experience playing guitar. And that means we only want you to pay if you actually LOVE your Guitareo experience! So join below to try it out totally risk-free. If it’s not for you, simply cancel your membership within 90 days and contact support for a full refund.</p>
                </div>
            </div>
        </div>
    </section>

    @include("guitareo.sales.partials._footer")
@stop