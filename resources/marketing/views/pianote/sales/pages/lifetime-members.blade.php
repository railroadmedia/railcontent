@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership To Pianote | Pianote</title>
    <meta property="og:title" content="Lifetime Membership To Pianote">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.">
    <meta property="og:description" content="Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/promos/november/lifetime-fb-share-image-1.jpg" style="display: none;">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }

        .tooltip {
            position: absolute;
        }
        .tooltip:after, .tooltip:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
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
            font-size: 14px;
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
        .tooltip:hover:after, .tooltip:hover:before, .tooltip:active:after, .tooltip:active:before, .tooltip:focus:after, .tooltip:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }

        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
            max-width:240px;
            padding-bottom: 51%;
        }
        @media (min-width: 768px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:370px;
                padding-bottom: 35%;
            }
        }
        @media (min-width: 1024px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:400px;
                padding-bottom: 30%;
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
    "subscriptionVersion" => true,
    ])
    {{--<style>--}}
    {{--.promo-banner-shim{display:block;width:100%;height:40px}--}}
    {{--.promo-banner{display:block;background:#000 50%/cover;text-align:center;color:#fff;width:100%;transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Roboto Condensed,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:#ccc;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;text-transform:uppercase;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner p .permanent{line-height:1em;font-size:19px}@media (min-width:768px){.promo-banner p .permanent{font-size:21px}}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}--}}
    {{--</style>--}}
    {{--<div class="promo-banner fixed"--}}
    {{--style="background: #000 center center/250px;">--}}
    {{--<div class="noise-wrap">--}}
    {{--<div class="container mx-auto">--}}
    {{--<div class="text text-left">--}}
    {{--<img class="logo"--}}
    {{--src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/march/logo.png">--}}
    {{--<p>--}}
    {{--<strong>ONLY <s class='opacity-60'>50</s> {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability()}} SPOTS LEFT</strong>--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <section class="content-section text-center upgrade-video-header" style="background:#040c1b;">
        <div class="container mx-auto">
            <h1 class="font-bebas">LOCK IN A <span class="text-coaches">LIFETIME OF PIANO LESSONS!</span></h1>
            <h6 class="leading-tight"><strong>PAY ONCE. ENJOY LESSONS FOREVER.</strong></h6>
            <div class="w-full mx-auto mt-10 mb-20 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative">
                    {{-- TODO swap vimeo when headphones are sold out: 803663213--}}
                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/803662615" frameborder="0" allowfullscreen allow="autoplay" title="promo video"></iframe>
                </div>
            </div>

            {{--            @if($products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability() > 0)--}}
            {{--<a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[singeo-1-year-membership-access]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&locked=true&redirect=/order"--}}
            {{--class="join methodcta my-4">Lifetime Membership</a>--}}
            {{--@else--}}
            {{-- <a class="join sold-out methodcta my-4">Sold Out</a> --}}
            {{--@endif--}}

            {{-- <p class="text-light-navy leading-relaxed px-3 mt-10 text-left" style="width: 100%;max-width: 600px;">Two, <em>maybe</em> three times per year you get the chance to become a Pianote Lifetime Member.
                <br><br>
                You’ll make one final payment for your membership, and then enjoy a lifetime of piano lessons, song tutorials, and support from Pianote (plus boast with that lifetime badge around your name)
                <br><br>
                And while you normally get a couple of opportunities to upgrade your membership there’s one thing that’s different this time:
                <br><br>
                <strong>This is your last chance to get a Lifetime Membership for.</strong> After this round, the price is going up.
                <br><br>
                So if you’re ready to make a lifelong commitment to your piano playing, now’s the time. But a lifetime of lessons isn’t all you’ll get…
                <br><br>
                Because as part of the deal, you’ll also receive some incredible bonuses shipped to your door, including our best-selling Chords & Scales book.
                <br><br>
                And that’s not all…
                <br><br>
                You’ll also get unlimited singing lessons for an entire year. So if you’ve always wanted to sing while playing the piano, now you can try it risk-free.
            </p> --}}

            <div class="max-w-md md:max-w-4xl mx-auto px-4 lg:px-0">
                <div class="flex items-center mb-10 md:mb-32 flex-col md:flex-row">
                    <div class="md:w-1/2 md:pl-10 md:order-1 mb-6 md:mb-0">
                        <img class="rounded-xl" src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/lifetime/lifetime-headphones-collage.jpg" alt="lifetime headphones 1">
                    </div>
                    <p class="md:text-left md:w-1/2" style="color:#A4AFC7;">
                        Two, maybe three times per year you get the chance to become a Pianote Lifetime Member. <br><br>

                        You’ll make one final payment for your membership, and then enjoy a lifetime of piano lessons and support from Pianote. <br><br>

                        It’s not for everyone, but if you know the piano will be part of your life for the next 5 years (at least), then it makes so much sense. And when you get your Lifetime Membership, we’ll send you some amazing bonuses, including our NEW Pianote Concert Series over-ear headphones. <br><br>

                        Payment plans are available, and you’ll have 90 days to try it risk-free.
                    </p>
                </div>
                <div class="flex items-center mb-10 flex-col md:flex-row">
                    <div class="md:w-1/2 md:pr-10 mb-6 md:mb-0">
                        <img class="rounded-xl" src="https://pianote.s3.amazonaws.com/sales/promos/black-friday/lifetime/lifetime-headphones-feature.jpg" alt="lifetime headphones 2">
                    </div>
                    <div class="md:text-left md:w-1/2">
                        <h4 class="font-extrabold mb-4">Hear your piano the way it was meant to sound</h4>
                        <p  style="color:#A4AFC7;">
                            Introducing the NEW Pianote Concert Series over-ear headphones. <br><br>

                            These beautifully designed hi-end headphones are designed by piano players for piano players. Lightweight with comfortable ear padding for extended playing sessions and unrivalled sound definitition and bass response. <br><br>

                            Your playing has never sounded so good. <br><br>

                            Valued at $189, these headphones are FREE with your Lifetime Membership.

                        </p>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto px-4">
                <div class="flex flex-wrap mb-2">
                    <img class="w-full rounded-xl mb-2 cursor-pointer autoplay-video lazyloaded" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-04.png" alt="montage 4" data-open="unbox" aria-haspopup="true" tabindex="0" src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-04.png">
                </div>
            </div>
        </div>
    </section>
    <section class="text-center text-white py-10 md:py-20 lg:py-24 px-4 md:px-6 relative overflow-hidden" style="background:#020610;">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="mb-8 sm:mb-12"><strong>Chat (and play) LIVE with Lisa!</strong></h3>
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">

                <p class="order-1 sm:order-0 text-left text-light-navy sm:pr-5 lg:pr-12">
                    As a Lifetime Member, you’re different. <br><br>

                    This isn’t a hobby. It’s your passion, your identity. You’re a piano player. And you deserve something a little special. <br><br>

                    That’s why when you become a Lifetime Members, you’ll be invited to an exclusive LIVE Zoom lesson with Lisa. You can chat with her face-to-face in a smaller group setting to get your questions answered. <br><br>

                    <b>This live event will ONLY be available to you and your fellow Lifetime Members.</b> <br><br>

                    We’ll pick dates and times that hopefully suit all time zones, and the replay will be available on-demand anytime you want to watch again. <br><br>

                    Exact dates and times TBD. But we’ll make sure you have plenty of notice.

                </p>
                <img class="mb-4 sm:mb-0 order-0 sm:order-1 w-36 sm:w-72 lg:w-80" src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/june/Live_Chat_Screen.png" alt="Lisa">
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section text-center customize" style="background: #000;">
        <div class="container mx-auto max-w-6xl">
            <h4 class="leading-tight mb-5 md:mb-7 lg:mb-10" style="line-height: 1.4em;"><strong>Become a Lifetime Member today and get:
                </strong></h4>
            <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-6xl" style="font-size: 0;">
                <div class="w-full">
                    <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-md mb-6">
                        <div class="flip-div inline-block relative w-full group" style="padding-bottom: 47%;perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="h-full w-full bg-black bg-center bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/pianote-lifetime.png"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div class="back absolute z-40 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">Perfectly structured step by step lessons, with teachers that are fun to watch, and unlimited support. Learn piano online the easy way.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="uppercase w-full leading-normal">
                            <span class="font-bold text-promo" style="text-transform:uppercase; display:inline-block;">$1200</span>
                        </h4>
                    </div>
                </div>

                @php
                    $bonuses = [
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/shop/card-thumbs/headphones-cart.jpg',
                            'title' => 'Pianote Headphones',
                            'description' => 'Hi-end, lightweight over-ear headphones for beautiful private practice sessions.',
                            'price' => 189,
                            'feature' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/bonus-chords-scales.jpg',
                            'title' => 'Chords & <br>Scales Book',
                            'description' => 'Your encyclopedia of piano chords & scales.',
                            'price' => 39,
                            'feature' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/unlimited/planner.png',
                            'title' => 'Practice <br>Planner',
                            'description' => 'Always know exactly what to practice.',
                            'price' => 39,
                            'feature' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/classical-piano-book.jpg',
                            'title' => 'Classical <br>Book',
                            'description' => '92 pages full of beautiful pieces by famous classical composers that you can actually play!',
                            'price' => 39,
                            'feature' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/sales/promos/november/bonuses/christmas-songbook-card.jpg',
                            'title' => 'Christmas Book',
                            'description' => 'Learn these 10 beautiful Christmas Carols.',
                            'price' => 10,
                            'feature' => "Instant Access",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/shop/products/2021-merch/card-chords-poster.jpg',
                            'title' => 'Chords Poster',
                            'description' => 'Always know your chord shapes with this helpful poster.',
                            'price' => 9,
                            'feature' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/shop/products/2021-merch/card-scales-poster.jpg',
                            'title' => 'Scales Poster',
                            'description' => 'Never forget the notes of a scale with this easy-to-read poster.',
                            'price' => 9,
                            'feature' => "Free Shipping",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/Lisa-zoom-live-card.jpg',
                            'title' => 'Exclusive Masterclass',
                            'description' => 'Join Lisa in an exclusive LIVE Zoom masterclass to get your questions answered.',
                            'price' => -1,
                            'feature' => "<b class='text-promo'>Exclusive</b> <br>Masterclass",
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/guitareo-lifetime.jpg',
                            'title' => 'Guitareo Membership',
                            'description' => 'Get guitar lessons for LIFE with a Guitareo Lifetime Membership',
                            'price' => 0,
                            'feature' => "Lifetime Access",
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/drumeo-lifetime.jpg',
                            'title' => 'Drumeo Membership',
                            'description' => 'Get drumming lessons for LIFE with a Drumeo Lifetime Membership',
                            'price' => 0,
                            'feature' => "Lifetime Access",
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/lifetime/singeo-lifetime.jpg',
                            'title' => 'Singeo Membership',
                            'description' => 'Get singing lessons for LIFE with a Singeo Lifetime Membership',
                            'price' => 0,
                            'feature' => "Lifetime Access",
                        ],
                        [
                            'image' => 'https://pianote.s3.amazonaws.com/sales/2022/9-digital-courses-card.jpg',
                            'title' => 'Training Packs',
                            'description' => 'Get 9 digital courses for life. Even if you cancel your membership. They’re yours forever.',
                            'price' => 716,
                            'feature' => "Lifetime Access",
                        ],
                    ]
                @endphp
                @foreach($bonuses as $key => $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4 lg:w-1/6">
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 border-2 border-promo" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-drumeo rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                    @endif
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }}"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div class="back absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="uppercase w-full leading-normal mt-2">
                            {{--<strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                            <span style="text-transform:uppercase; display:inline-block;">@if($bonus['price'] > 0)<s>${{ $bonus['price'] }}</s>@endif @if($bonus['price'] >= 0)<strong class="text-promo">FREE</strong></span><br>@endif
                            {!! $bonus['feature'] !!}
                            {{-- @if(!empty($bonus['feature']))
                                Free Shipping
                            @else
                                Online Access
                            @endif --}}
                        </p>
                    </div>
                @endforeach

                {{--<p style="max-width: 480px;color: #aaa;padding:0 15px;"><em>All digital bonuses are added to your account IMMEDIATELY  with your membership to Pianote, and they’re yours forever. </em></p>--}}
            </div>

            @if($products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability() > 0)
                <a  href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[pianote-headphones]=1&products[piano-chords-and-scales-guide]=1&products[pianote-practice-planner]=1&products[classical-book]=1&products[christmas-song-book-digital]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[classical-piano]=1&products[jesus-molina-improvisation-and-musical-freedom-pack]=1&products[play-beautiful-piano]=1&products[piano-riffs-and-fills]=1&products[piano-technique-made-easy]=1&products[destupefy-your-left-hand]=1&products[worship-piano]=1&products[faster-fingers]=1&redirect=/order&locked=true"
                                        class="join methodcta my-4" style="background:#FB0188;">Become A lifetime Member &raquo;</a>
                <p>Only @if($products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() < 100)<s>100</s>@endif {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() }} spots remaining!</p>
            {{--<p>(Or choose a payment plan on the next page.)</p>--}}
            @else
                <span class="join sold-out methodcta my-4">Sold Out</span>
            @endif
        </div>
    </section>
    <section class="content-section text-center" style="background: #040c1b;">
        <div class="container mx-auto relative z-50 max-w-md">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <h5 class="mb-2"><strong>Still have questions?</strong></h5>
                <p>If you need any further information about becoming a Lifetime Member, <a href="{{ get_musora_brand_base_url() }}/contact"><u>contact our amazing support team!</u></a>
                    <br><br>
                    A friendly and knowledgeable support team member will get back to you right away.</p>
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

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "unbox",
        "vimeoId" => "774408046",
    ])
    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{--    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
