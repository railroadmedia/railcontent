@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Pianote Metronome | Pianote</title>
    <meta property="og:title" content="The Pianote Metronome | Pianote">

    <meta name="description" content="Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. ">
    <meta property="og:description" content="Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. ">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/stickbag/share-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

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
    trailerM: false,
    image1: false,
    image2: false,
    image3: false,
    image4: false,
    image5: false,
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    <header class="text-white px-5 sm:px-6 pt-72 pb-12 sm:py-20 lg:py-36 bg-top bg-no-repeat" style="background-color:#0e1623;">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://www.musora.com/musora-cdn/image/width=440,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/logo-light.svg">
                    <p class="leading-normal my-4 sm:my-6">Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. </p>
                    <h4 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['classical-piano-pieces']->price) > floatval($productPrices['classical-piano-pieces']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['classical-piano-pieces']->price) }}</s>
                            <strong>${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['classical-piano-pieces']->discounted_price) / floatval($productPrices['classical-piano-pieces']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="/ecommerce/add-to-cart?products[classical-piano-pieces]=1&redirect=/order" class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight"><strong>You NEED a metronome.</strong></h2>
            <p class="leading-normal mt-2 mb-5">
                It’s the most important practice tool you’ll ever have. Work on your tempo,<br class="hidden sm:inline">
                 rhythm, and speed with a metronome you can trust. The Pianote Metronome<br class="hidden sm:inline">
                 will help you keep perfect time -- every time.</p>
            @php
                $gridItems = [
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/shorter-claws-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/shorter-claws-icon-m.png',
                    'title' => 'Shorter Claws.',
                    'desc' => 'The PadStand features shorter claws to grip your practice pad perfectly with no overhang. That means you can practice your rudiments without dodging snare claws.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/extended-height-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/extended-height-icon-m.png',
                    'title' => 'Extended Height. ',
                    'desc' => 'Snare drums are deeper than practice pads – so why would you use the same stand? The PadStand is taller so you can sit up straight and run rudiments with perfect posture.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/rotated-basket-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/rotated-basket-icon-m.png',
                    'title' => 'Rotated Basket.',
                    'desc' => 'And just in case you’re still worried about claws… the PadStand basket is rotated 90 degrees to ensure you can practice as ergonomically as possible. ',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/lightweight-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/lightweight-icon-m.png',
                    'title' => 'Lightweight & Portable.',
                    'desc' => 'No more balancing your practice pad on a coffee table or hotel bed. The PadStand easily fits in your backpack or carry on for perfect practice sessions on the go.',
                    ],
                    [
                     'icon' => 'marketing/drumeo/shop/padstand/blue-tips-icon.svg',
                     'img' => 'marketing/drumeo/shop/padstand/blue-tips-icon-m.png',
                    'title' => 'Cool Blue Tips.',
                    'desc' => 'The basket and feet are in custom Drumeo blue so you’ll never confuse your PadStand for your snare stand. ',
                    ],
                ];
            @endphp
            <div class="hidden lg:flex">
                <div class="w-1/4 pr-3">
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[0]['icon'] }}">
                        <h6 class="my-2"><strong>{{ $gridItems[0]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[0]['desc'] }}</p>
                    </div>
                    <div class="my-10">
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[3]['icon'] }}">
                        <h6 class="my-2"><strong>{{ $gridItems[3]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[3]['desc'] }}</p>
                    </div>
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[4]['icon'] }}">
                        <h6 class="my-2"><strong>{{ $gridItems[4]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[4]['desc'] }}</p>
                    </div>
                </div>
                <div class="w-1/2">
                    <img class="transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/shop/padstand/padstand-diagram.png"
                    >
                </div>
                <div class="w-1/4 pl-3">
                    <div class="mt-20 mb-14">
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[2]['icon'] }}">
                        <h6 class="my-2"><strong>{{ $gridItems[2]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[2]['desc'] }}</p>
                    </div>
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[1]['icon'] }}">
                        <h6 class="my-2"><strong>{{ $gridItems[1]['title'] }}</strong></h6>
                        <p class="text-sm">{{ $gridItems[1]['desc'] }}</p>
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

        <section class="content-section text-center comparison px-1 lg:px-3" style="background:#00101D;">
            <div class="container mx-auto max-w-4xl">
                <h2 class="mb-16 md:mb-12 "><strong>Your new favorite<br class="sm:hidden"> piece of gear. </strong></h2>
                <div class="relative">
                    <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                    <table class="w-full mx-auto border-separate comparison eardrums earbuds">
                        <tbody style="background-color:transparent!important;">
                        <tr style="background-color:transparent!important;">
                            <td></td>
                            <td class="rounded-t-xl">
                                <img class="h-12 md:h-20 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/shop/stickbag/comparison2.png" alt="logo-white">
                            </td>
                            <td class="rounded-t-xl">
                                <img class="h-12 md:h-20 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/shop/stickbag/vic-firth-comparison.png" alt="logo-white">
                            </td>
                            <td class="rounded-t-xl">
                                <img class="h-12 md:h-20 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/shop/stickbag/tackle-comparison.png" alt="logo-white">
                            </td>
                        </tr>
                        <tr>
                            <td>Material</td>
                            <td>Waxed Canvas & Suede</td>
                            <td>Canvas</td>
                            <td>Leather</td>
                        </tr>
                        <tr>
                            <td>Capacity</td>
                            <td>18 Pairs</td>
                            <td>24 Pairs</td>
                            <td>12 Pairs</td>
                        </tr>
                        <tr>
                            <td>Protective<br> Brush Sleeve</td>
                            <td>YES</td>
                            <td>NO</td>
                            <td>NO</td>
                        </tr>
                        <tr>
                            <td>Dimensions</td>
                            <td>17.5” H x 16” W</td>
                            <td>20” H x 22” W</td>
                            <td>18” H x 16” W</td>
                        </tr>
                        <tr>
                            <td>Drum Key<br> Included</td>
                            <td>YES</td>
                            <td>NO</td>
                            <td>YES</td>
                        </tr>
                        <tr style="background-color:transparent!important;">
                            <td class="rounded-b-xl">Total</td>
                            <td class="rounded-b-xl">
                                @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                                    <s class="opacity-50">${{ floatval($productPrices['stickbag']->price) }}</s>
                                @endif
                                <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                            </td>
                            <td class="rounded-b-xl"><strong>$104</strong></td>
                            <td class="rounded-b-xl"><strong>$200</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24"  style="background-color:#f6f8fc;" >
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>The last StickBag<br class="sm:hidden"> you’ll ever need.</strong></h2>
            <h6 class="leading-tight mt-2 mb-5 sm:mb-10">A bag built to take everything<br class="sm:hidden"> from garage to stage. </h6>

                @php
                    $slides = [
                     [
                         'img' => 'marketing/drumeo/shop/stickbag/gallery2.jpg',
                     ],
                     [
                         'img' => 'marketing/drumeo/shop/stickbag/gallery-l1.jpg',
                     ],
                     [
                         'img' => 'marketing/drumeo/shop/stickbag/gallery-l2.jpg',
                     ],
                     [
                         'img' => 'marketing/drumeo/shop/stickbag/gallery-r1.jpg',
                     ],
                     [
                         'img' => 'marketing/drumeo/shop/stickbag/gallery-r2.jpg',
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
            <p class="mt-2 mb-5 sm:mb-10 text-sm"><em>Disclaimer: Sticks/Brushes are not included.</em></p>
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <p class="sm:max-w-md m-0 sm:pr-5 lg:pr-10 text-left mb-5 sm:mb-0">Your Drumeo StickBag is built with premium components to ensure a long-lasting home for your sticks wherever your drumming takes you.</p>
                <div class="overflow-hidden rounded-xl border  border-black ">
                    <table>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse border-black">Durable construction</td>
                            <td class="px-5 py-1 border-b border-collapse border-black"><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse border-black">Premium zippers</td>
                            <td class="px-5 py-1 border-b border-collapse border-black"><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse border-black">Quick-stick slot</td>
                            <td class="px-5 py-1 border-b border-collapse border-black"><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left border-b border-collapse border-black">Drum key</td>
                            <td class="px-5 py-1 border-b border-collapse border-black"><i class="fas fa-check"></i></td>
                        </tr>
                        <tr>
                            <td class="px-3 py-1 text-left  border-collapse border-black">Cost</td>
                            <td class="px-5 py-1  border-collapse border-black">${{ floatval($productPrices['stickbag']->discounted_price) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
        <section class="content-section text-center customize px-4 lg:px-6" style="background:#173c59 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/order-bg.jpg') center center/cover;">
            <div class="container mx-auto">
                <img alt="quietkick logo" class="h-14 sm:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stickbag-logo2.svg"><br>

                @if( $products['stickbag']->getStockAvailability() > 1 && !empty($products['stickbag']->getStockAvailability()))

                    <div class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl mx-auto">
                        <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                            @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                                <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black uppercase" >Save 34%</p>
                            @endif
                            <a href="/ecommerce/add-to-cart?locked=true&product-array=stickbag:1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                                <div class="bg-white px-3 py-5 md:py-7">
                                    <h4 class="mb-2 sm:mb-3"><strong>StickBag Only</strong></h4>
                                    <img class="h-24 transition-opacity opacity-0"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stickbag-option.png"
                                        alt="learn playing image"
                                    >
                                    <br>
                                    <h4 class="inline-block leading-tight">
                                        @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                                            <s>${{ floatval($productPrices['stickbag']->price) }}</s>
                                        @endif
                                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong></h4>
                                    <p class="text-sm"><em>
                                            @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                                                Save 34%.
                                            @endif
                                            One-time payment.</em></p>
                                    <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Select</div>
                                    <p class="text-sm mb-1.5">1 Drumeo StickBag<sup>NEW</sup></p>
                                    <p class="text-sm mb-1.5">1 Brushes Sleeve</p>
                                    <p class="text-sm">1 Premium Drum Key</p>
                                </div>
                            </a>
                        </div>

                        @if( Carbon\Carbon::now() && Carbon\Carbon::create(2023, 10, 3, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now() )
                            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                                <img class="h-16 absolute top-0 right-0 z-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/shop/stickbag/free-shipping-icon.svg">
                                <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-drumeo uppercase" >LAUNCH SPECIAL</p>
                                <a
                                    @if(!empty($memberVersion))
                                        href="/ecommerce/add-to-cart?locked=true&product-array=DLM-1-year:1,stickbag:1,Drumeo-VaterSticks:6"
                                    @else
                                        href="/promo-bag"
                                    @endif
                                    class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-drumeo">
                                    <div class="bg-white px-3 py-6 md:py-9">
                                        <h4 class="mb-2 sm:mb-3"><strong>StickBag + Lessons</strong></h4>
                                        <img class="h-24 transition-opacity opacity-0"
                                            loading="lazy"
                                            onload="this.classList.remove('opacity-0')"
                                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/shop/stickbag/lessons-stickbag-option.png"
                                            alt="learn playing image"
                                        >
                                        <br>
                                        <h4 class="inline-block leading-tight"><strong>Free StickBag</strong></h4>
                                        <p class="text-sm"><em>
                                                @if(!empty($memberVersion))
                                                    with annual Membership renewal
                                                @else
                                                    with annual Drumeo Membership
                                                @endif
                                            </em></p>
                                        <div class="join my-5 drumeo smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">
                                            @if(!empty($memberVersion))
                                                renew membership
                                            @else
                                                learn more
                                            @endif
                                        </div>
                                        <p class="text-sm mb-1.5 text-drumeo"><strong>Annual Drumeo Membership</strong> ($240/yr)</p>
                                        <p class="text-sm mb-1.5"><strong>The world's best drum lessons.</strong></p>
                                        <p class="text-sm mb-1.5"><strong>5000+ popular songs</strong></p>
                                        <p class="text-sm mb-1.5"><strong>Unlimited Personal Support</strong></p>
                                        <p class="text-sm mb-1.5">1 Drumeo StickBag<sup>NEW</sup></p>
                                        <p class="text-sm mb-1.5">1 Brushes Sleeve</p>
                                        <p class="text-sm mb-1.5">1 Premium Drum Key</p>
                                        <p class="text-sm">6 Pairs Of 5A Drumsticks</p>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                @else
                    <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
                @endif
                <br>
                <a style="color: #00bc75;" class="inline-block cursor-pointer" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[stickbag]=1&locked=true"><h4><strong><u>Or get it FREE when you join Drumeo.</u></strong></h4></a>
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
        'video' => '864032205',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailerM',
        'video' => '864032414',
        'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
    ])



    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script>
        $(document).ready(function () {
            $('table tr td:nth-child(3)').on('click', function(){
                $(this).parents().find('table').removeClass('earbuds');
                $(this).parents().find('table').addClass('headphones');
            });
            $('table tr td:nth-child(4)').on('click', function(){
                $(this).parents().find('table').removeClass('headphones');
                $(this).parents().find('table').addClass('earbuds');
            });
        });
    </script>
@stop
