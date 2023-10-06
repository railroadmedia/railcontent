@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>PadStand | Drumeo</title>
    <meta property="og:title" content="PadStand | Drumeo">

    <meta name="description" content="Practice anywhere with perfect height and ergonomics.">
    <meta property="og:description" content="Practice anywhere with perfect height and ergonomics.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/padstand/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join.outline.blue {
            border-color:#0b76db;
            color:#0b76db;
        }

        .join.smaller.outline {
            padding:12px 7%;
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            width: 18%;

        }
        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 27.33%;
        }
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            color: #3E4145;
            background-color: #A2AEBD;
        }
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(3),
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(4) {
            background-color:#8996A5;
        }
        .content-section table.comparison tr:hover td:nth-child(3),
        .content-section table.comparison tr:hover td:nth-child(4),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(3),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(4) {
            background-color:#abb8c7;
        }
        .content-section table.comparison.eardrums tr td {
            color:#fff;
            padding:15px 7px;
            font-size:12px;
            text-transform:none;

        }
        .content-section table.comparison.eardrums tr:last-child td {
            padding: 15px 7px 30px;
        }
        .content-section table.comparison.eardrums tr:last-child td strong {
            font-size: 16px;
        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
                font-size:16px;
            }
            .content-section table.comparison.eardrums tr:last-child td strong {
                font-size: 28px;
            }
        }
        .content-section table.comparison.eardrums tr td:nth-child(1) {
            text-transform:uppercase;
        }
        @media (max-width: 767px) {
            table tr td:nth-child(3),
            table tr td:nth-child(4) {
                cursor:pointer;
            }
            .earbuds tr td:nth-child(3) {
                display: table-cell;
            }
            .earbuds tr td:nth-child(4) {
                display: none;
            }
            .headphones tr td:nth-child(4) {
                display: table-cell;
            }
            .headphones tr td:nth-child(3) {
                display: none;
            }
        }
        .text-gold {
            color:#d8b66e;
        }
        .join.gold {
            background:linear-gradient(to bottom, #e2c584, #ad7c12);
        }
    </style>
@stop

@section('body-data')
    x-data="{
    trailer: false,
    image1: false,
    image2: false,
    image3: false,
    image4: false,
    image5: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-12 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/280x0/filters:quality(95)/marketing/drumeo/shop/padstand/padstand-logo.png"><br>
                <h2 class="leading-tight my-4"><strong>Practice anywhere with</strong><br class="hidden sm:inline"> perfect height and ergonomics.</h2>
                <h3 class="leading-tight">
                    @if(floatval($productPrices['padstand']->price) > floatval($productPrices['padstand']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['padstand']->price) }}</s>
                        <strong>${{ floatval($productPrices['padstand']->discounted_price) }}</strong>
                        (Save {{ round(100 - (100 * (floatval($productPrices['padstand']->discounted_price) / floatval($productPrices['padstand']->price)))) }}%)
                    @else
                        <strong>Only ${{ floatval($productPrices['padstand']->discounted_price) }}</strong>
                    @endif
                </h3>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    @if( $products['padstand']->getStockAvailability() > 1 && !empty($products['padstand']->getStockAvailability()))
                        <a class="w-5/12 join smaller blue" href="#customize-anchor">Order Now</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                </div>
                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to right, rgba(7,23,43,0.85), rgba(26,32,38,0.85));"></div>
        <img class="object-cover w-full relative z-0" style="height: 600px;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/padstand/padstand-gallery-05.jpg">
    </header>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight"><strong>Somebody had to do it.</strong></h2>
            <p class="leading-normal mt-2 mb-5">
                For years, you’ve balanced your practice pad on your lap, coffee table, or worse…<br class="hidden sm:inline">
                A standard snare stand with claws overhanging like a bad overbite 😬. So we <br class="hidden sm:inline">
                engineered a custom practice pad stand that fits any pad perfectly:</p>
            @php
                $gridItems = [
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/rotated-basket-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/rotated-basket-icon-m.png',
                    'title' => 'Rotated Basket.',
                    'desc' => 'And just in case you’re still worried about claws, the PadStand basket is rotated 90 degrees to ensure you can practice as ergonomically as possible. This makes practice pad work more comfortable and translates better to the kit.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/lightweight-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/lightweight-icon-m.png',
                    'title' => 'Lightweight & Portable.',
                    'desc' => 'No more balancing your practice pad on a coffee table or hotel bed. The snare stand easily fits in your backpack or carry on for perfect practice sessions on the go.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/blue-tips-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/blue-tips-icon-m.png',
                    'title' => 'Cool Blue Tips.',
                    'desc' => ' The basket and feet are in custom Drumeo blue so you’ll never confuse your practice stand for your real snare stand.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/shorter-claws-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/shorter-claws-icon-m.png',
                    'title' => 'Shorter Claws.',
                    'desc' => 'No more overbite on your snare stand 😬. The PadStand features custom cut claws to grip your practice pad perfectly. That means you can practice your rudiments without dodging snare claws.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/extended-height-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/extended-height-icon-m.png',
                    'title' => 'Extended Height. ',
                    'desc' => 'Practice pads are WAY thinner than your snare drum – so why would you use the same stand? The PadStand is taller than normal snare stands so you can sit up straight and run rudiments with perfect posture.',
                    ],
                ];
            @endphp
            <div class="hidden lg:flex">
                <div class="w-1/4 pr-3">
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[3]['icon'] }}"
                        >
                        <h6 class="my-2"><strong>{{ $gridItems[3]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[3]['desc'] }}</p>
                    </div>
                    <div class="my-7">
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[1]['icon'] }}"
                        >
                        <h6 class="my-2"><strong>{{ $gridItems[1]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[1]['desc'] }}</p>
                    </div>
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[2]['icon'] }}"
                        >
                        <h6 class="my-2"><strong>{{ $gridItems[2]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[2]['desc'] }}</p>
                    </div>
                </div>
                <div class="w-1/2">
                    <img class="transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/shop/padstand/padstand-diagram.png"
                    >
                </div>
                <div class="w-1/4 pl-3">
                    <div class="mt-16 mb-10">
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[0]['icon'] }}"
                        >
                        <h6 class="my-2"><strong>{{ $gridItems[0]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[0]['desc'] }}</p>
                    </div>
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[4]['icon'] }}"
                        >
                        <h6 class="my-2"><strong>{{ $gridItems[4]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[4]['desc'] }}</p>
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
                            drag   : 'free',
                            snap   : false,
                            breakpoints: {
                                767: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">
                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1">
                                    <div class="rounded-xl overflow-hidden shadow-md" style="color:#000;background-color:#F6F8FC;">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                                    loading="lazy" onload="this.classList.remove('opacity-0')" alt="drumeo padstand"
                                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <p class="mt-4 mb-1 px-4 font-black leading-tight"><strong>{{ $gridItem['title'] }}</strong></p>
                                        <p class="px-4 pb-6 text-sm leading-tight">{{ $gridItem['desc'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f6f8fc calc(50% + 1px));"></div>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24" style="background-color:#f6f8fc;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Works with ANY practice pad.</strong></h2>
            <h6 class="leading-tight mt-2 mb-5 sm:mb-10">
                The Drumeo PadStand can be used with a QuietPad, P4, or any other branded <br class="hidden sm:inline">
                practice pad. Simply tighten the basket for the perfect fit. </h6>
            @php
                $slides = [
                 [
                     'img' => 'marketing/drumeo/shop/padstand/padstand-gallery-01.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/padstand/padstand-gallery-02.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/padstand/padstand-gallery-03.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/padstand/padstand-gallery-04.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/padstand/padstand-gallery-05.jpg',
                 ],
             ];
            @endphp
            @foreach($slides as $slide)
                @component('_partials.components.modal', ['name' => 'imageModal'])
                    @slot('content')
                        <div class="relative overflow-y-visible max-w-3xl px-4 md:px-5 lg:px-7 py-5 md:py-7 lg:py-10 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                            <img class="logo h-7 md:h-12 lg:h-14 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/{{$slide['img']}}">
                        </div>
                    @endslot
                @endcomponent
            @endforeach

            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-1/2 sm:order-1">
                    <div class="p-2 w-full"><div data-open="image1" class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')"></div></div>
                </div>
                <div class="w-1/2 sm:w-1/4">
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')"></div></div>
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')"></div></div>
                </div>
                <div class="w-1/2 sm:w-1/4 sm:order-2">
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')"></div></div>
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                                style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')"></div></div>
                </div>
            </div>
            <p class="mt-2 mb-5 sm:mb-10 text-sm"><em>Disclaimer: Quietkick/Sticks/Pad are not included.</em></p>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
        <section class="content-section text-center customize px-4 lg:px-6" style="background:#173c59 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/order-bg.jpg') center center/cover;">
            <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to right, rgba(7,23,43,0.5), rgba(26,32,38,0.5));"></div>
            <div class="container mx-auto relative z-20">
                <img alt="quietkick logo" class="h-14 sm:h-20 mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/shop/padstand/padstand-logo.png"><br>

                @if( $products['padstand']->getStockAvailability() > 1 && !empty($products['padstand']->getStockAvailability()))

                    <div class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl mx-auto">
                        <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                            <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black uppercase" >Save 34%</p>
                            <a href="/ecommerce/add-to-cart?locked=true&product-array=padstand:1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                                <div class="bg-white px-3 py-5 md:py-7">
                                    <h4 class="mb-2 sm:mb-3"><strong>PadStand Only</strong></h4>
                                    <img class="h-24 transition-opacity opacity-0"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/drumeo/shop/padstand/padstand-only.png"
                                            alt="learn playing image"
                                    >
                                    <br>
                                    <h4 class="inline-block leading-tight">
                                        @if(floatval($productPrices['padstand']->price) > floatval($productPrices['padstand']->discounted_price))
                                            <s>${{ floatval($productPrices['padstand']->price) }}</s>
                                        @endif

                                        <strong>${{ floatval($productPrices['padstand']->discounted_price) }}</strong></h4>
                                    <p class="text-sm"><em>
                                            @if(floatval($productPrices['padstand']->price) > floatval($productPrices['padstand']->discounted_price))
                                                Save {{ round(100 - (100 * (floatval($productPrices['stickbag']->discounted_price) / floatval($productPrices['stickbag']->price)))) }}%
                                            @endif
                                            One-time payment.</em></p>
                                    <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Select</div>
                                    <p class="text-sm">1 Drumeo PadStand<sup>NEW</sup></p>
                                </div>
                            </a>
                        </div>
                        <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                            <img class="h-16 absolute top-0 right-0 z-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/shop/stickbag/free-shipping-icon.svg">
                            <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-drumeo uppercase" >LAUNCH SPECIAL</p>
                            <a href="/ecommerce/add-to-cart?locked=true&product-array=DLM-1-year:1,padstand:1,quietpad:1,rudiments-poster:1,Drumeo-VaterSticks:1"
                                class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-drumeo">
                                <div class="bg-white px-3 py-6 md:py-9">
                                    <h4 class="mb-2 sm:mb-3"><strong>Ultimate Practice Rig</strong></h4>
                                    <img class="h-24 transition-opacity opacity-0"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/shop/padstand/bundle-collage.png"
                                            alt="learn playing image"
                                    >
                                    <br>
                                    <h4 class="inline-block leading-tight"><strong>Free PadStand</strong></h4>
                                    <p class="text-sm"><em>with annual Drumeo Membership</em></p>
                                    <div class="join my-5 drumeo smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">learn more</div>
                                    <p class="text-sm mb-1.5 text-drumeo"><strong>Annual Drumeo Membership</strong> ($240/yr)</p>
                                    <p class="text-sm mb-1.5"><strong>The world's best drum lessons.</strong></p>
                                    <p class="text-sm mb-1.5"><strong>5000+ popular songs</strong></p>
                                    <p class="text-sm mb-1.5"><strong>Unlimited Personal Support</strong></p>
                                    <p class="text-sm mb-1.5">1 QuietPad</p>
                                    <p class="text-sm mb-1.5">1 Drumeo PadStand<sup>NEW</sup></p>
                                    <p class="text-sm mb-1.5">1 Rudiment Poster</p>
                                    <p class="text-sm">5A Drumsticks</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @else
                    <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
                @endif
            </div>
        </section>

    <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
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

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '871987691',
        'vimeo' => true,
    ])


    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
