@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership To Pianote | Pianote</title>
    <meta property="og:title" content="Lifetime Membership To Pianote">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.">
    <meta property="og:description" content="Two, maybe three times per year you get the chance to become a Pianote Lifetime Member.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/lifetime-fb-share-image-1.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
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
        "cartVersion" => true
    ])
    @php
        if(!empty($products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount())) {
            $stock = $products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount();
        }
        else {
            $stock = 0;
        }

        if(!empty($products['maelzel-metronome']->getStockAvailability())) {
            $PMstock = $products['maelzel-metronome']->getStockAvailability();
        }
        else {
            $PMstock = 0;
        }
    @endphp
{{--    @include('_partials.components.shop.promo-banner', [--}}
{{--                "name" => "Lifetime",--}}
{{--                "fullPrice" => 1200,--}}
{{--                "price" => 1200,--}}
{{--                    "specialText" => "<strong>Only <s class='opacity-60'>300</s> <span class='text-promo'>" . $stock . "</span> left!</strong>",--}}
{{--                "noBreadcrumb" => true,--}}
{{--                "noCountdown" => true--}}
{{--            ])--}}
    <section class="px-5 py-10 md:py-14 lg:py-16 text-white text-center bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1900x0/filters:quality(95)/marketing/pianote/promos/march/header-bg.webp');">
        <div class="container mx-auto">
            <h1 class="leading-none"><strong>Get piano lessons<br class="sm:hidden"> for <span class="text-musora">life.</span></strong></h1>
            <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:920px;">
                <div class="w-full relative rounded-xl overflow-hidden" style="padding-bottom: 42.5%;">
{{--                    <iframe class="absolute w-full h-full reset-on-close" src="//player.vimeo.com/video/885340200" frameborder="0" allowfullscreen allow="autoplay" title="Lifetime Video"></iframe>--}}
                    <img class="absolute inset-0 object-cover"
                        @if($PMstock > 0)
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1900x0/filters:quality(95)/marketing/pianote/promos/march/lifeitme-bundle-metronome.webp"
                        @else
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1900x0/filters:quality(95)/marketing/pianote/promos/march/TODO.webp"
                        @endif
                    ></img>
                </div>
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2>
                <p class="leading-tight text-sm"><em>One time payment or choose a <br class="sm:hidden">
                        payment plan below.</em></p>
                <a class="join drumeo mt-4 w-full anchor-slide" href="#customize-anchor">GET STARTED &raquo;</a>
{{--                <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>--}}
                <p class="leading-tight mt-4">ONLY <s class='opacity-60'>300</s> {{ $stock }} SPOTS AVAILABLE</p>
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative overflow-hidden" style="background-color:#F6F8FC;">
        <div class="container mx-auto max-w-4xl z-10 relative">
            <h2 class="leading-tight mb-2"><strong>The Lifetime Advantage</strong></h2>
            <p class="leading-tight"><em>Pay once. Play forever. Get unlimited piano lessons for <br class="hidden sm:inline lg:hidden"> the price of 5 years of access to Pianote ($1200 total).</em></p>
            <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/promos/november/bundles/timeline2.png">
            <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/november/bundles/timeline-m2.png">
            <p class="text-left leading-relaxed mt-5">
                Playing the piano makes your life better. It’s proven to improve your mood, memory, and cognitive function.
                <br><br>
                <strong>This isn’t just a hobby -- it’s a lifestyle.</strong>
                <br><br>
                That’s why we’re re-opening a limited number of Lifetime Memberships to celebrate 8 years of Pianote.
                <br><br>
                It’s your chance to make one final payment (or split the payments into 3 installments) and enjoy unlimited lessons, courses, and live access to your favorite instructors inside Pianote.
                <br><br>
                You’ll also get some incredible bonuses to help you start and stay playing -- for life.
                <br><br>
                Scroll down to see everything included, and to see why joining Pianote for life makes so much sense.


                And for the cost of just 5 years of lessons with Pianote, you’ll get:
            </p>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <p class="leading-tight"><em>Introducing the <strong class="text-pianote font-black">NEW…</strong></em></p>
            <img alt="pianote logo block center" class="h-20 sm:h-24 md:h-26 lg:h-30 my-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/book-bag/pianote-bookbag-logo-black.svg">
            <p class="leading-tight mb-7">A handcrafted premium leather satchel for your music books, laptop, and life.</p>

            @php
                $gridItems = [
                    [
                        'img' => 'marketing/pianote/products/book-bag/tanned.webp',
                        'desc' => '<strong>Single leather handle</strong> provide easy carrying options and minimalistic styling.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/back-pockets.webp',
                        'desc' => '<strong>External side and back</strong> pockets <br/>for easy access and extra security',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/handle.webp',
                        'desc' => '<strong>Premium-grade, oil-tanned leather</strong> ensures a classic look that only gets better with age.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/sleeve.webp',
                        'desc' => '<strong>16-inch laptop sleeve </strong> <br/>keeps your computer safe.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/emobssed.webp',
                        'desc' => '<strong>Custom Pianote embossing</strong> provides a subtle yet distinctive look. This bag is for piano players.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/magnetic-clasps.webp',
                        'desc' => '<strong>Magnetic clasps</strong> give you modern access while keeping  a vintage buckle look.',
                    ],
                    [
                        'img' => 'marketing/pianote/products/book-bag/removable.webp',
                        'desc' => '<strong>Removable shoulder strap</strong> for convenience and comfort.',
                    ],
                ];
            @endphp
            <div class="hidden lg:block">
                <div class="flex flex-wrap items-center justify-around text-left">
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[0]['desc'] !!}</p>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[1]['desc'] !!}</p>
                    </div>
                    <div class="w-full flex justify-center content-around py-3">
                        <div class="w-auto max-w-xs py-12 flex flex-wrap content-around">
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[2]['desc'] !!}</p>
                            </div>
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[3]['desc'] !!}</p>
                            </div>
                        </div>
                        <div class="w-7/12 flex-shrink-0">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-graph.webp">
                        </div>
                        <div class="w-auto max-w-xs flex flex-wrap content-around">
                            <div class="">
                                <p class="leading-normal">{!! $gridItems[4]['desc'] !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[5]['desc'] !!}</p>
                    </div>
                    <div class="w-auto max-w-xs">
                        <p class="leading-normal">{!! $gridItems[6]['desc'] !!}</p>
                    </div>
                </div>
            </div>
            <div class="lg:hidden mb-5"
                x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    classes: {
                        arrow: 'hidden',
                        prev: 'hidden',
                        next: 'hidden',
                        pagination: 'splide__pagination bottom-0',
                    },
                    perPage: 2.5,
                    perMove: 1,
                    type: 'loop',
                    focus: 0,
                    interval: 2000,
                    drag: 'free',
                    snap: false,
                    lazyLoad: 'nearby',
                    breakpoints: {
                        767: {
                            perPage: 1.5,
                        },
                    },
                }).mount()
            },
        }">
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">

                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1">
                                    <div class="rounded-xl overflow-hidden shadow-md" style="background-color:#F1EFED;">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="Pianote Book Bag Details"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <div class="flex items-start justify-start h-28">
                                            <p class="text-base leading-wide font-playfair m-0 px-6 py-4">
                                                {!! $gridItem['desc'] !!}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($PMstock > 0)
        <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F6F8FC;">
            <div class="container mx-auto z-10 relative max-w-5xl">
                <img class="h-24 sm:h-28 lg:h-36" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/logo-m2.svg">
                <p class="leading-tight my-7">The Prestige Flamed Maple Metronome might be the most exclusive metronome in the world.
                    <br><br>
                    Only 216 were made and each one is hand-numbered.
                    <br><br>
                    But there are only 100 left, and you’ll get one FREE with your Lifetime Membership (while stocks last).
                    <br><br>
                    The only way to get one is to be a Pianote Member. Even Elton John couldn’t get one (unless he decided to join Pianote).
                    <br><br>
                    But you can.</p>
                <div class="flex flex-wrap items-center">
                    <div class="w-full sm:w-1/2 sm:order-1">
                        <div class="p-2 w-full"><div data-open="image1" class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/gallery-01.jpg')"></div></div>
                    </div>
                    <div class="w-1/2 sm:w-1/4">
                        <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/gallery-02.jpg')"></div></div>
                        <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/gallery-03.jpg')"></div></div>
                    </div>
                    <div class="w-1/2 sm:w-1/4 sm:order-2">
                        <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/gallery-04.jpg')"></div></div>
                        <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/gallery-05.jpg')"></div></div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @php
    if($PMstock > 0) {
        $bonuses = [
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/march/metronome-card.webp',
                'description' => 'A limited edition flamed maple metronome from Wittner',
                'badge' => 'ONLY ' . $PMstock . ' REMAINING!',
                'price' => floatval($productPrices['maelzel-metronome']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/march/bookbag-card.webp',
                'description' => 'A premium leather satchel for your music books, laptop, and life.',
                'price' => floatval($productPrices['pianote-book-bag']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                'description' => 'Your encyclopedia of piano chords & scales.',
                'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
                'description' => 'Plan your practice and reach your goals with this beautiful planner.',
                'price' => floatval($productPrices['pianote-practice-planner']->price),
                'shipping' => true,
            ],
        ];
        $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[maelzel-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849';
        $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME-3-pay]=1&products[maelzel-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849';
    } else {
        $bonuses = [
            [
                'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Thumbnails/b15d76f7-b3c5-4dcd-94c3-449cd60ed88e-metronome-cart.jpg',
                'description' => 'Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner.',
                'price' => floatval($productPrices['taktell-piccolo-metronome']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/promos/march/bookbag-card.webp',
                'description' => 'A premium leather satchel for your music books, laptop, and life.',
                'price' => floatval($productPrices['pianote-book-bag']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                'description' => 'Your encyclopedia of piano chords & scales.',
                'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                'shipping' => true,
            ],
            [
                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
                'description' => 'Plan your practice and reach your goals with this beautiful planner.',
                'price' => floatval($productPrices['pianote-practice-planner']->price),
                'shipping' => true,
            ],
        ];
        $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[taktell-piccolo-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849';
        $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME-3-pay]=1&products[taktell-piccolo-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849';
    }
    @endphp
    @php
//        if(!empty($upgradeVersion)) {
//            $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[musora-access-1-year]=1&products[taktell-piccolo-metronome]=1&products[pianote-practice-planner]=1&products[christmas-songbook]=1&products[christmas-song-book-digital]=1&products[classical-piano-pieces]=1&products[music-theory-posters]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&products[piano-riffs-and-fills]=1&products[the-power-of-chords]=1&products[piano-technique-made-easy]=1&products[faster-fingers]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849,lifetime-existing';
//            $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME-3-pay]=1&products[musora-access-1-year]=1&products[taktell-piccolo-metronome]=1&products[pianote-practice-planner]=1&products[christmas-songbook]=1&products[christmas-song-book-digital]=1&products[classical-piano-pieces]=1&products[music-theory-posters]=1&products[new-piano-players-start-here]=1&products[easy-chords]=1&products[30-day-blues-piano]=1&products[piano-riffs-and-fills]=1&products[the-power-of-chords]=1&products[piano-technique-made-easy]=1&products[faster-fingers]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849,lifetime-existing';
//        } else {
//            $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[maelzel-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849';
//            $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME-3-pay]=1&products[maelzel-metronome]=1&products[pianote-book-bag]=1&products[pianote-practice-planner]=1&products[piano-chords-and-scales-guide]=1&redirect=/order&locked=true&promo-code=FREE-W-LIFETIME-849';
//        };
    @endphp

    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background:linear-gradient(to bottom, #AF1F2D, #180104);"
    >
        <div class="container mx-auto relative z-50 max-w-4xl">
            <h3 class="leading-tight mb-5 md:mb-7 lg:mb-10" style="line-height: 1.4em;"><strong>Become a Lifetime Member today and get:</strong></h3>
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 56%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" {{--border-2 border-musora--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-center bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=850,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/black-friday/unlimited/pianote-lifetime.png');"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="leading-tight mt-4 sm:mt-6 mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2>
                <p class="leading-tight text-sm">One time payment or choose a payment plan on the next page.</p>
                <a class="join mt-4 md:mt-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>
                <p class="mt-4 md:mt-5 leading-tight text-musora">ONLY {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() }} SPOTS AVAILABLE</p>
                <h3 class="leading-tight mt-8 sm:mt-12 mb-5 sm:mb-9"><strong>+ get these FREE anniversary bonuses</strong></h3>
            </div>
            <div style="font-size:0px">
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4 lg:w-1/5"
                        x-data="{
                        flipped: false,
                    }"
                        x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-black top-0 left-0 w-full py-0.5 bg-musora font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }}');"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div
                                    x-ref="back"
                                    class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                    style="backface-visibility: hidden;"
                                >
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                        <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                <s class="opacity-40">${{ $bonus['price'] }}</s>
                            @endif
                            <strong class="text-musora">FREE</strong></span><br>
                            <em>
                                @if(!empty($bonus['shipping']))
                                    Free Shipping
                                @else
                                    Online Access
                                @endif
                                @if(!empty($bonus['delayshipping']))
                                       <br><u class="text-xs"> Shipping will be delayed</u>
                                @endif
                            </em>
                        </p>
                    </div>
                @endforeach
            </div>

{{--            <a class="join sold-out my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;">SOLD OUT</a>--}}
            <a class="join my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>
            @if($PMstock > 0)
                <a class="inline-block leading-tight text-white opacity-70" href="{{ $buttonLink2 }}"><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>
            @endif
        </div>
    </section>

    @php
        $faqs = [
            [
                "title" => "How long does my lifetime membership last?",
                "desc" => 'Simply, for life! Either yours or ours. Your Lifetime Membership is valid as long as Pianote (Musora) remains in service and you stay alive.',
            ],
            [
                "title" => "What happens if Pianote or Musora’s service ends?",
                "desc" => 'We’ll make every effort to provide Lifetime Members with all the original media content we have created available for download. That way, you can continue to enjoy everything we’ve done.<br><br>This will cover all available Musora original content (our entire curriculum and courses) but will not include and 3rd party content that we do not own rights to.',
            ],
            [
                "title" => "What content is included with my Lifetime Membership? Are songs included?",
                "desc" => 'As a Lifetime Member, you get access to all original Musora content for life. That’s all our courses, the Method, Live lessons, Student Reviews, and the forums.<br><br>Some of our content is licensed by 3rd parties, which means we have to pay a fee for each member to use the material on a temporary basis. This includes song transcriptions.<br><br>Those songs are licensed and require an additional fee for ongoing access. We wish it wasn’t the case and have done our best to make the fee as small as possible. Currently, the fee is $40/year for Lifetime Members.<br><br>To put that in context, that’s $40/year for ALL the song transcriptions inside Musora (Pianote, Guitareo, Singeo, and Drumeo). You’ll get access to thousands of officially licensed song transcriptions for the price of one songbook a year.',
            ],
        ]
    @endphp

    <div id="faq" class="anchor"></div>
    <section class="py-12 md:py-20" style="background: #000;">
        <div class="container mx-auto max-w-5xl px-6">
            <h2 class="font-extrabold mb-10 text-center text-white">Frequently Asked Questions</h2>
            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
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

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
