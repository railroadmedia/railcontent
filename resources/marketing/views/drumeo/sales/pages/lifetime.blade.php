@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership | Drumeo</title>
    <meta property="og:title" content="Lifetime Membership | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Drum lessons for LIFE. (+20 FREE bonuses)">
    <meta property="og:description" content="Drum lessons for LIFE. (+20 FREE bonuses)">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/promos/november/lifetime-fb-share-image.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
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

@section('body-data')
    x-data ='{
        trailer : false,
    }'
@endsection

@section('global-body')
        @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "scrollToJoin" => true
        ])
        <section class="content-section text-center" style="padding-bottom: 0; background:linear-gradient(to bottom, #01050f 70%, #020c1a);">
            <div class="container mx-auto">
                <img
                    class="hidden md:inline-block md:h-16 lg:h-20 mb-2 transition-opacity opacity-0"
                    src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/anniversary/2023/lifetime-title.png"
                    alt="Lifetime title"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"

                />
                <img
                    class="md:hidden mb-4 px-4 transition-opacity opacity-0"
                    src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/anniversary/2023/lifetime-title-m.png"
                    alt="Lifetime title"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
{{--                <h1 class="font-bebas leading-none mb-1 text-4xl md:text-6xl">GET A <span class="text-gradient">LIFETIME</span> <br class="inline md:hidden">DRUMEO MEMBERSHIP</h1>--}}
                <h4 class="text-white uppercase leading-tight mb-4">+ Your Choice of Bonuses & And An Exclusive Masterclass <br class="hidden md:inline lg:hidden">with Anika Nilles!</h4>
                <p class="uppercase text-promo font-bold">
                    AVAILABLE UNTIL MARCH 31st AT MIDNIGHT <br>
                    Only
                    <span x-cloak x-data="timer()" x-init="countdown()">
                         <span x-cloak x-show="timeLeft > 0 && day !== '00'"><span x-text="day"></span><span x-text="dayText"></span></span>
                         <span x-cloak x-show="timeLeft > 0 && hour !== '00'"><span x-text="hour"></span><span x-text="hourText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                         <span x-cloak x-show="timeLeft < 0">Limited Time</span>
                     </span>
                    Left!
                </p>

                <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                    <img
                        class="cursor-pointer"
                        src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/anniversary/2023/thumb.jpg"
                        alt="Video thumbnail"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        @click="trailer = true"
                    />
{{--                    <div class="aspect-16:9 w-full relative">--}}
{{--                        <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/774477396" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>--}}
{{--                    </div>--}}
                </div>
                <div class="text-center">
                    <a class="join smaller drumeo" href="TODO">Lifetime Membership &raquo</a>
                </div>
                <p class="leading-relaxed px-3 my-5 text-left text-light-navy" style="width: 100%;max-width: 650px;">
                    <em>“My soul is that of a drummer. I didn’t do it to become rich and famous. I did it because it was the love of my life.” – Ringo Starr</em>
                    <br><br>
                    Wise words from drumming royalty ^.
                    <br><br>
                    If you feel similarly, we want to invite you to make a lifelong commitment to your drumming.
                    <br><br>
                    To celebrate 11 years of Drumeo, Lifetime Memberships are back!
                    <br><br>
                    This is your chance to make one final payment for your Drumeo Membership and then enjoy unlimited drum lessons, song breakdowns, and LIVE events with your favorite drummers for years to come.
                    <br><br>
                    And heads up: You can split the payment for 1, 2, or 5 installments. (You’ll see that option upon checkout.)
                    <br><br>
                    You’ll also get your choice of 3 bonuses. You can select a pile of drumsticks, a new practice pad, or whatever you think will fire up the next stage of your drumming journey. PLUS, you’ll have an exclusive Masterclass to get you inspired.
                    <br><br>
                    Anika Nilles has agreed to teach a Masterclass to Drumeo Lifetime Members that will help you become more comfortable in odd time signatures. (Who better to teach that, right?)
                    <br><br>
                    Scroll down to see everything included with your Drumeo Lifetime Membership and we’ll see you with your little infinity badge around your name very soon!
                </p>
                            @if($products['DLM-Lifetime']->getPublicStockCount() > 0)
{{--                                <a class="join blue my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-2xl" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM-Lifetime]=1&products[drumeo-eardrums]=1&products[Drumeo-VaterSticks]=12&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&products[TLOD-DIGI]=1&products[MAM-DIGI]=1&products[GHFAL-DIGI]=1&products[HGAF-DIGI]=1&products[AOADS-DIGI]=1&products[ICM-DIGI]=1&products[BTC-DIGI]=1&products[CC-DIGI]=1&products[TG-DIGI]=1&locked=true">BECOME A LIFETIME MEMBER &raquo;</a>--}}
                            @else
                <a class="join sold-out my-4">{{ $products['DLM-Lifetime']->getPublicStockCount() }}</a>
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
                <img class="absolute top-0 h-14 md:h-20 md:-mt-5 rounded-full z-10" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/lifetime/jared.jpg" alt="Granpa Jared">
            </div>
            <div class="relative w-full rounded-2xl h-28 mx-auto flex space-between overflow-hidden items-center beg-adv-bar" style="background-color: #325e97;max-width: 840px;">
                <div class="h-full flex items-center flex-wrap relative" style="background-color:#64c3ef;">
                    <h4 class="uppercase leading-none w-full"><img class="h-5 sm:h-8" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="Drumeo logo"></h4>
                    <p class="text-xs leading-none absolute left-0 right-0" style="color:#003e5a;bottom: 7px;"><i class="fas fa-long-arrow-left"></i> LIFETIME PAYMENT <i class="fas fa-long-arrow-right"></i></p>
                </div>
                <h3 class="uppercase leading-none font-bebas"><i class="fas fa-infinity"></i> DRUM LESSONS FOR LIFE</h3>
            </div>
        </div>
    </section>

    <section class="text-center text-white py-10 md:py-20 lg:py-24 px-4 md:px-6 relative overflow-hidden" style="background:#01050f;">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="mb-8 sm:mb-12"><strong>Improve Your Odd-Time Feel <br class="inline sm:hidden">With Anika Nilles</strong></h3>
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center justify-center">
                <div class="order-1 sm:order-0 text-left text-light-navy sm:pr-5 lg:pr-12">
                    <p>
                        It’s one of the trickiest parts of playing the drums.
                        <br><br>
                        And to celebrate your Lifetime commitment to drumming, we’ve brought in famed educator & performer, Anika Nilles, to help you conquer the world of odd-time. You’ll get exercises + handy tips & tricks that will help you get more comfortable playing everything from 5/4 to 9/16.
                        <br><br>
                        <b>This Masterclass will ONLY be available to you & your fellow Lifetime Members.</b>
                        <br><br>
                        It will be broadcast live in early April (date TBD) in two different time zones and then available for on-demand access to reference anytime you need a refresher.
                        <br><br>
                        See you there!

                    </p>
                </div>
                <img
                    class="mb-4 sm:mb-0 order-0 sm:order-1 w-52 sm:w-72 lg:w-80 rounded-xl transition-opacity opacity-0"
                    src="https://cdn.musora.com/image/fetch/w_640,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/anniversary/2023/anika-ui-screen.jpg"
                    alt="Anika"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section
        class="content-section text-center customize relative z-50 bg-top bg-no-repeat lazyload"
        style="background-color:#01050f;"
        x-data="{
            bonus: 0,
            query: '',
        }"
    >
        <div class="container mx-auto relative z-50">
            <div class="mx-auto max-w-xs sm:max-w-md md:max-w-xl lg:max-w-5xl" style="font-size: 0;">
                {{--<h1 data-aos="fade-down" class="font-bebas leading-none mt-3 md:mt-5 text-5xl md:text-6xl">REACH YOUR  <br class="inline md:hidden"> <span class="text-coaches">DRUMMING GOALS.</span></h1>--}}
                {{--<h2 data-aos-once="true" data-aos="fade-up" class="my-3 md:my-5 leading-normal"><strong>Improve your drumming for<br> just <span class="text-drumeo">${{ round((Prices::$plusSubscriptionAnnual / 12), 2) }}</span> per month.</strong></h2>--}}
                <h3 class="mb-6" style="line-height: 1.4em;"><strong>Become a Lifetime Member<br class="inline sm:hidden"> today and get:</strong></h3>
                <div class="text-center mb-2"><p class="inline-block uppercase text-black bg-[#FFA800] py-1 px-4 font-bold rounded-lg">Your choice of any 3 bonus items:</p></div>
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-1 md:px-3 w-full max-w-sm">

{{--                    <div class="flip-div inline-block relative w-full group" style="padding-bottom: 70%;perspective: 1000px;">--}}
{{--                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">--}}
{{--                            <div class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
{{--                                <div class="h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/edge-lifetime.png"></div>--}}
{{--                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">--}}
{{--                                    <i class="fas fa-arrow-right text-4xl"></i><br>--}}
{{--                                    <p class="text-sm"><strong>DETAILS</strong></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
{{--                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">--}}
{{--                                    <p class="leading-normal mx-auto text-sm">Step-by-step drum lessons from the best drummers in the world.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <p class="uppercase w-full leading-normal mt-2">--}}
{{--                        <strong class="font-black leading-tight inline-block mb-1">Drumeo Lifetime Membership</strong><br>--}}
{{--                        <span class="text-gradient" style="text-transform:uppercase; display:inline-block;">--}}
{{--                            <strong>${{ 1200 }}</strong><br>--}}
{{--                            Instant Access--}}
{{--                        </span>--}}
{{--                    </p>--}}
                </div>
                <hr class="opacity-0">
                @php

                    $bonuses = [
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                            'title' => '12 Pairs Of Drumeo Drumsticks',
                            'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
                            'price' => floatval($productPrices['Drumeo-VaterSticks']->price),
                            'online-ship' => "Free Shipping",
                            'shipping' => true,
                            'sku' => 'Drumeo-VaterSticks',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/pad.jpg',
                            'title' => 'QuietPad',
                            'description' => 'Practice anywhere with two full-size playing surfaces.',
                            'price' => floatval($productPrices['quietpad']->price),
                            'shipping' => true,
                            'sku' => 'quietpad',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/july/quietkick_card.jpg',
                            'title' => 'Drumeo QuietKick',
                            'description' => 'Improve your kick foot anywhere with the portable & quiet bass drum workout pad. Attaches to any single OR double pedal (pedal not included).',
                            'price' => floatval($productPrices['quietkick']->price),
                            'online-ship' => "Free Shipping",
                            'shipping' => true,
                            'sku' => 'quietkick',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/p4.jpg',
                            'title' => 'Practice Pad',
                            'description' => '',
                            'price' => floatval($productPrices['practicepad']->price),
                            'shipping' => true,
                            'sku' => 'practicepad',
                        ],
                        [
                            'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/eardrums.jpg',
                            'title' => 'Drumeo EarDrums',
                            'description' => 'Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.',
                            'price' => floatval($productPrices['drumeo-eardrums']->price),
                            'online-ship' => "Free Shipping",
                            'shipping' => true,
                            'sku' => 'drumeo-eardrums',
                        ],
                        [
                            'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/bbdb.jpg',
                            'title' => 'The Best Beginner Drum Book',
                            'description' => '',
                            'price' => floatval($productPrices['BeginnerBook']->price),
                            'shipping' => true,
                            'sku' => 'BeginnerBook',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/3 lg:w-1/6"
                        x-data="{
                            selected: false,
                        }"
                        x-on:click="
                            if(bonus <= 3 && selected){
                                selected = !selected;
                                query = query.replace('&products[{{ $bonus['sku'] }}]=1', '');
                                bonus--;
                            } else if(bonus < 3 && !selected) {
                                selected = !selected;
                                bonus++;
                                query = query + '&products[{{ $bonus['sku'] }}]=1';
                            }
                        "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-drumeo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    :class="selected ? 'border-4' : !selected && bonus !==3 && 'hover:border-2'"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                    @endif
                                    <div
                                        class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover"
                                        style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"
                                        :class="!selected && bonus === 3 && 'grayscale'"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
{{--                @foreach($bonuses as $bonus)--}}
{{--                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 px-1 md:px-3 w-1/2 sm:w-1/3 lg:w-1/5">--}}
{{--                        <div class="flip-div inline-block relative w-full group" style="padding-bottom: 133%;perspective: 1000px;">--}}
{{--                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">--}}
{{--                                <div class="border-2 border-drumeo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
{{--                                    @if(!empty($bonus['shipping']))--}}
{{--                                        <p class="absolute text-white top-0 left-0 w-full pb-0.5 text-sm bg-drumeo"><strong>Free Shipping</strong></p>--}}
{{--                                    @endif--}}
{{--                                    @if(!empty($bonus['live']))--}}
{{--                                        <p class="absolute text-white top-0 left-0 w-full pb-0.5 text-sm bg-drumeo"><strong>Exclusive</strong></p>--}}
{{--                                    @endif--}}
{{--                                    <div class="h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }}"></div>--}}
{{--                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">--}}
{{--                                        <i class="fas fa-arrow-right text-4xl"></i><br>--}}
{{--                                        <p class="text-sm"><strong>DETAILS</strong></p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="back border-2 border-drumeo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">--}}
{{--                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">--}}
{{--                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <p class="uppercase w-full leading-normal mt-2">--}}
{{--                            <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
{{--                            <span class="text-gradient" style="text-transform:uppercase; display:inline-block;">--}}
{{--                                @if($bonus['price'] > 0) <s>${{ $bonus['price'] }}</s> @endif <strong>FREE</strong><br>--}}

{{--                                @if(!empty($bonus['shipping']))--}}
{{--                                    Free Shipping--}}
{{--                                @elseif(!empty($bonus['live']))--}}
{{--                                    Live Event--}}
{{--                                @else--}}
{{--                                    Instant Access--}}
{{--                                @endif--}}
{{--                            </span>--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

                <h4 class="text-center py-5">
                    <i class="text-promo font-bold">PLUS</i> AN EXCLUSIVE MASTERCLASS WITH...
                </h4>

                <div class="text-center">
                    <div class="inline-block relative lg:w-4/6 px-3 lg:px-0">
                        <img
                            class="border-4 border-drumeo rounded-xl hidden md:inline transition-opacity opacity-0"
                            src="https://drumeo-assets.s3.amazonaws.com/promos/anniversary/2023/anika-bonus.jpg"
                            alt="Anika bonus"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        />
                        <img
                            class="border-4 border-drumeo rounded-xl md:hidden transition-opacity opacity-0"
                            src="https://drumeo-assets.s3.amazonaws.com/promos/anniversary/2023/anika-bonus-m.jpg"
                            alt="Anika bonus"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        />
                        <div class="absolute w-full bottom-6 flex justify-center">
                            <h2 class="uppercase font-bold font-bebas tracking-widest">Anika Nilles</h2>
                        </div>
                    </div>
                </div>
            </div>

            {{--            @if($products['DLM-Lifetime']->getStockAvailability() > 0)--}}
            <a
                class="join blue bigger my-4 md:my-8 w-full max-w-xs md:max-w-lg lg:max-w-3xl"
                style="padding: 20px 10px;"
                :class="bonus !== 3 && 'sold-out'"
                :href="bonus === 3 ? '/ecommerce/add-to-cart?products[DLM-Lifetime]=1'+query+'&locked=true' : '#customize-anchor'"
                x-text="bonus === 3 ? 'BECOME A LIFETIME MEMBER &raquo;' : 'Choose 3 products above'"></a>
            <p class="text-promo">
                AVAILABLE UNTIL MARCH 31st AT MIDNIGHT <br>
                <b>
                    Only
                    <span x-cloak x-data="timer()" x-init="countdown()">
                         <span x-cloak x-show="timeLeft > 0 && day !== '00'"><span x-text="day"></span><span x-text="dayText"></span></span>
                         <span x-cloak x-show="timeLeft > 0 && hour !== '00'"><span x-text="hour"></span><span x-text="hourText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                         <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                         <span x-cloak x-show="timeLeft < 0">Limited Time</span>
                     </span>
                    Left!
                </b>
            </p>
            {{--            @else--}}
{{--            <a class="join sold-out my-4">Sold Out</a>--}}
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

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => 'TODO',
        'vimeo' => true,
    ])

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-01 10:00:00',
        'promoVersion' => false
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{--        <script>--}}
{{--            $(document).ready(function () {--}}
{{--                $(document).foundation();--}}
{{--                $('.flip-div').click(function (e) {--}}
{{--                    $(this).toggleClass('flipped');--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
