@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Lifetime Membership | Drumeo</title>
    <meta property="og:title" content="Lifetime Membership | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Drum lessons for LIFE. (+20 FREE bonuses)">
    <meta property="og:description" content="Drum lessons for LIFE. (+20 FREE bonuses)">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/promos/november/lifetime-fb-share-image.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }

        .beg-adv-text img {
            transform: translate(-50%, 0);
            left: 95%;
        }
        .beg-adv-text p {
            transform: translate(-50%, 0);
        }
        .beg-adv-text p:nth-child(2) {
            left: 40%;
        }
        .beg-adv-text p:nth-child(3) {
            left: 50%;
        }
        .beg-adv-bar div:nth-child(1) {
            width: 40%;
        }
        .text-gradient {
            display:inline-block;
            background:-webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }
        .text-gradient s {
            -webkit-text-fill-color: #888;
        }
    </style>
@stop

@section('global-body')
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true
        ])
        <section class="content-section text-center" style="padding-bottom: 0; background:linear-gradient(to bottom, #01050f 70%, #020c1a);">
            <div class="container mx-auto">
                <h1 class="font-bebas leading-none mb-1 text-4xl md:text-6xl">GET A <span class="text-gradient">LIFETIME</span> <br class="inline md:hidden">DRUMEO MEMBERSHIP</h1>
                <h4 class="text-gradient uppercase">+ FREE In-Ear Headphones, An Exclusive Masterclass, And More!</h4>

                <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/774477396" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                    </div>
                </div>
                <p class="leading-relaxed px-3 my-5 text-left text-light-navy" style="width: 100%;max-width: 650px;">
                    <em>“My soul is that of a drummer. I didn’t do it to become rich and famous. I did it because it was the love of my life.” – Ringo Starr</em>
                    <br><br>
                    If you feel like Ringo, we want to invite you to make a lifelong commitment to your drumming.
                    <br><br>
                    Drumeo Lifetime Memberships are back – for Cyber Monday ONLY!
                    <br><br>
                    This is your chance to make one final payment for your Drumeo Membership and then enjoy unlimited drum lessons, song breakdowns, and LIVE events with your favorite drummers for years to come.
                    <br><br>
                    <strong>And heads up:</strong> You can split the payment for 1, 2, or 5 installments. (You’ll see that option upon checkout.)
                    <br><br>
                    You’ll also get FREE bonuses with your membership – including a NEW pair of Drumeo EarDrums + an exclusive masterclass with award-winning Drumeo Coach, Todd Sucherman.
                    <br><br>
                    Scroll down to see everything included with your Drumeo Lifetime Membership and we’ll see you with your little infinity badge around your name very soon!
                </p>
                            @if($products['DLM-Lifetime']->getStock() > 0)
{{--                                <a class="join blue my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-2xl" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM-Lifetime]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=12&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&products[TLOD-DIGI]=1&products[MAM-DIGI]=1&products[GHFAL-DIGI]=1&products[HGAF-DIGI]=1&products[AOADS-DIGI]=1&products[ICM-DIGI]=1&products[BTC-DIGI]=1&products[CC-DIGI]=1&products[TG-DIGI]=1&locked=true">BECOME A LIFETIME MEMBER &raquo;</a>--}}
                            @else
                <a class="join sold-out my-4">{{ $products['DLM-Lifetime']->getStock() }}</a>
                            @endif
            </div>
        </section>

    <section class="text-center text-white py-10 md:py-20 lg:py-24 px-2 md:px-4 relative overflow-hidden" style="background:linear-gradient(to bottom, #020c1a, #021125);">
        <div class="container mx-auto z-10 relative">
            <h2><strong>The Lifetime Advantage</strong></h2>
            <p class="text-light-navy mt-2 mb-12">You’ll have a lifetime of unlimited drum lessons for the price of 5 years of access to Drumeo.</p>

            <style>
                .beg-adv-text p {
                    transform: translate(-50%, 0);
                    left: 3%;
                }
                .beg-adv-text p:nth-child(2) {
                    left: 40%;
                }
                .beg-adv-text img {
                    transform: translate(-50%, 0);
                    left: 96%;
                }
                .beg-adv-bar div:nth-child(1) {
                    width: 40%;
                }
            </style>
            <div class="relative w-full rounded-2xl mx-auto h-8 beg-adv-text" style="max-width: 840px;">
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap">NOW<br><i class="fal fa-angle-down"></i></p>
                <p class="absolute top-0 leading-none text-sm uppercase whitespace-nowrap">YEAR 5<br><i class="fal fa-angle-down"></i></p>
                <img class="absolute top-0 h-14 md:h-20 md:-mt-5 rounded-full z-10" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/lifetime/jared.jpg">
            </div>
            <div class="relative w-full rounded-2xl h-28 mx-auto flex space-between overflow-hidden items-center beg-adv-bar" style="background-color: #325e97;max-width: 840px;">
                <div class="h-full flex items-center flex-wrap relative" style="background-color:#64c3ef;">
                    <h4 class="uppercase leading-none w-full"><img class="h-5 sm:h-8" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"></h4>
                    <p class="text-xs leading-none absolute left-0 right-0" style="color:#003e5a;bottom: 7px;"><i class="fas fa-long-arrow-left"></i> LIFETIME PAYMENT <i class="fas fa-long-arrow-right"></i></p>
                </div>
                <h3 class="uppercase leading-none font-bebas"><i class="fas fa-infinity"></i> DRUM LESSONS FOR LIFE</h3>
            </div>
        </div>
    </section>

    <section class="text-center text-white py-10 md:py-20 lg:py-24 px-4 md:px-6 relative overflow-hidden" style="background:#01050f;">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="mb-8 sm:mb-12"><strong>Get Timeless Wisdom <br class="inline sm:hidden">From A Drumming Legend</strong></h3>
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center justify-center">
                <div class="order-1 sm:order-0 text-left text-light-navy sm:pr-5 lg:pr-12">
                    <p>Todd Sucherman can do it all.
                        <br><br>
                        Technique, musicianship, groove, double bass, multiple styles… You name it, Todd has studied it and thoroughly understands what it takes to be successful. And now he’s going to share it with you.
                        <br><br>
                        In this exclusive Drumeo Lifetime Member Masterclass, Todd Sucherman will impart his wisdom on what it takes to be successful on the drums – no matter what level you’re at or what your goals are.
                        <br><br>
                        This Masterclass will be streamed LIVE in January (date TBD – you’ll be notified by mid-December) and available for on-demand access.
                        <br><br>
                        This is your chance to learn directly from a drumming legend & have your questions answered LIVE.
                        <br><br>
                        <strong>Masterclass Date:</strong> January 2023 (Exact date to be determined).
                    </p>
                </div>
                <img class="mb-4 sm:mb-0 order-0 sm:order-1 w-36 sm:w-72 lg:w-80 rounded-xl" src="https://cdn.musora.com/image/fetch/w_640,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/todd-sucherman-exclusive-lifetime.jpg">
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section text-center customize relative z-50 bg-top bg-no-repeat lazyload" style="background-color:#01050f;">
        <div class="container mx-auto relative z-50">
            <div class="mx-auto max-w-xs sm:max-w-md md:max-w-xl lg:max-w-5xl" style="font-size: 0;">
                {{--<h1 data-aos="fade-down" class="font-bebas leading-none mt-3 md:mt-5 text-5xl md:text-6xl">REACH YOUR  <br class="inline md:hidden"> <span class="text-coaches">DRUMMING GOALS.</span></h1>--}}
                {{--<h2 data-aos-once="true" data-aos="fade-up" class="my-3 md:my-5 leading-normal"><strong>Improve your drumming for<br> just <span class="text-drumeo">${{ round((Prices::$drumeoEdgeAnnual / 12), 2) }}</span> per month.</strong></h2>--}}
                <h3 class="mb-5 md:mb-7 lg:mb-10" style="line-height: 1.4em;"><strong>Become a Lifetime Member<br class="inline sm:hidden"> today and get:</strong></h3>
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-1 md:px-3 w-full max-w-sm">
                    <div class="flip-div inline-block relative w-full group" style="padding-bottom: 70%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            <div class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/edge-lifetime.png"></div>
                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-arrow-right text-4xl"></i><br>
                                    <p class="text-sm"><strong>DETAILS</strong></p>
                                </div>
                            </div>
                            <div class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-sm">Step-by-step drum lessons from the best drummers in the world.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="uppercase w-full leading-normal mt-2">
                        <strong class="font-black leading-tight inline-block mb-1">Drumeo Lifetime Membership</strong><br>
                        <span class="text-gradient" style="text-transform:uppercase; display:inline-block;"><strong>${{ Prices::$drumeoEdgeLifetime }}</strong><br>
                                Instant Access</span>
                    </p>
                </div>
                <hr class="opacity-0">
                @php

                    $bonuses = [
                        [
                        'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/eardrums.jpg',
                        'title' => 'Drumeo EarDrums',
                        'description' => 'Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.',
                        'price' => Prices::$earDrumsFull,
                        'online-ship' => "Free Shipping",
                        'shipping' => "no-shipping"
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                        'title' => '12 Pairs Of Drumeo Drumsticks',
                        'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
                        'price' => 155.40,
                        'online-ship' => "Free Shipping",
                        'shipping' => "no-shipping"
                        ],
                        [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/todd-sucherman-masterclass.png',
                        'title' => 'Todd Sucherman’s Exclusive Lifetime Masterclass',
                        'description' => ' ',
                        'price' => 0,
                        'online-ship' => "Instant Access",
                        'live' => true,
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-1 md:px-3 w-1/2 sm:w-1/3 lg:w-1/5">
                        <div class="flip-div inline-block relative w-full group" style="padding-bottom: 133%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    @if(!empty($bonus['shipping']))
                                        <p class="absolute text-white top-0 left-0 w-full pb-0.5 text-sm bg-drumeo"><strong>Free Shipping</strong></p>
                                    @endif
                                    @if(!empty($bonus['live']))
                                        <p class="absolute text-white top-0 left-0 w-full pb-0.5 text-sm bg-drumeo"><strong>Exclusive</strong></p>
                                    @endif
                                    <div class="h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }}"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="uppercase w-full leading-normal mt-2">
                            <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                            <span class="text-gradient" style="text-transform:uppercase; display:inline-block;">
                                @if($bonus['price'] > 0) <s>${{ $bonus['price'] }}</s> @endif <strong>FREE</strong><br>

                                @if(!empty($bonus['shipping']))
                                    Free Shipping
                                @elseif(!empty($bonus['live']))
                                    Live Event
                                @else
                                    Instant Access
                                @endif
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>

            {{--            @if($products['DLM-Lifetime']->getStock() > 0)--}}
            {{--                <a class="join blue bigger my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM-Lifetime]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=12&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&products[TLOD-DIGI]=1&products[MAM-DIGI]=1&products[GHFAL-DIGI]=1&products[HGAF-DIGI]=1&products[AOADS-DIGI]=1&products[ICM-DIGI]=1&products[BTC-DIGI]=1&products[CC-DIGI]=1&products[TG-DIGI]=1&locked=true">BECOME A LIFETIME MEMBER &raquo;</a>--}}
            {{--            @else--}}
            <a class="join sold-out my-4">Sold Out</a>
            {{--            @endif--}}
        </div>
    </section>

    <section class="content-section text-center" style="background: #0c1429;">
        <div class="container mx-auto relative z-50">
            <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;">
                <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
                <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
                <p class="mx-auto mt-2 md:mt-3 text-light-navy">Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
            </a>
            <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $(document).foundation();
                $('.flip-div').click(function (e) {
                    $(this).toggleClass('flipped');
                });
            });
        </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
