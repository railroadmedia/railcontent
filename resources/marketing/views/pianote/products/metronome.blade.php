@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Pianote Metronome | Pianote</title>
    <meta property="og:title" content="The Pianote Metronome | Pianote">

    <meta name="description" content="Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. ">
    <meta property="og:description" content="Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. ">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/metronome/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
@stop

@section('body-data')
    x-data="{
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    @include('pianote._partials.promo-banner', [
        "name" => "Pianote Metronome",
        "fullPrice" => floatval($productPrices['taktell-piccolo-metronome']->price),
        "price" => floatval($productPrices['taktell-piccolo-metronome']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="text-white px-5 sm:px-6 pt-[100%] pb-10 sm:py-20 lg:py-28 relative" style="background-color:#690808;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/pianote/products/metronome/header-bg-m.jpg')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/metronome/header-bg.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-20 lg:hidden" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/metronome/metronome-web-logo-center.svg">
                    <img class="h-24 lg:h-32 hidden lg:inline-block" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/metronome/metronome-web-logo.svg">
                    <p class="leading-normal my-3 sm:my-6">Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. </p>
                    <h4 class="mb-3 sm:mb-6">
                        @if(floatval($productPrices['taktell-piccolo-metronome']->price) > floatval($productPrices['taktell-piccolo-metronome']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['taktell-piccolo-metronome']->price) }}</s>
                            <strong>${{ floatval($productPrices['taktell-piccolo-metronome']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['taktell-piccolo-metronome']->discounted_price) / floatval($productPrices['taktell-piccolo-metronome']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['taktell-piccolo-metronome']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="/ecommerce/add-to-cart?products[taktell-piccolo-metronome]=1" class="join medium w-full">ORDER NOW &raquo;</a>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight"><strong>You NEED a metronome.</strong></h2>
            <p class="leading-normal mt-2 mb-5 mx-auto max-w-xl">It’s the most important practice tool you’ll ever have. Work on your tempo, rhythm, and speed with a metronome you can trust. The Pianote Metronome will help you keep perfect time -- every time.</p>
            @php
                $gridItems = [
                    [
                    'icon' => 'marketing/pianote/products/metronome/lightweight-icon.svg',
                    'img' => 'marketing/pianote/products/metronome/lightweight-slide.png',
                    'title' => 'Lightweight & Compact',
                    'desc' => 'Weighing just 170 grams and standing just under 6 inches tall, this metronome is lightweight and compact so you can take it anywhere.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/metronome/hand-wound-icon.svg',
                    'img' => 'marketing/pianote/products/metronome/hand-wound-slide.png',
                    'title' => 'Hand-Wound and Battery-Free',
                    'desc' => 'Like the best watches, this metronome doesn’t take batteries. Instead, you’ll find a hand winder on the side to set the internal gears in motion. And once it’s wound, it’ll keep ticking away.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/metronome/durable-icon.svg',
                    'img' => 'marketing/pianote/products/metronome/durable-slide.png',
                    'title' => 'Durable Plastic Casing',
                    'desc' => 'The retro-style plastic casing is both fashionable and durable. Presented in a custom Pianote red, the case protects the important mechanics inside. Your metronome will last years and years.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/metronome/adjustable-icon.svg',
                    'img' => 'marketing/pianote/products/metronome/adjustable-slide.png',
                    'title' => 'Adjustable Tempos For Any Song',
                    'desc' => 'Changing tempos is easy with this metronome. Pick your tempo between 40 and 208 bpm and simply slide the adjustable weight until it clicks to the right tempo. The old ways are still the best ways.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/metronome/timing-icon.svg',
                    'img' => 'marketing/pianote/products/metronome/timing-slide.png',
                    'title' => 'Precision Timing So You’re Always On Beat',
                    'desc' => 'The Swiss make watches. The Germans make metronomes. And Wittner makes the best. Cheap metronomes don’t keep time. With this metronome - every beat is perfect.',
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
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/metronome/metronome-features.png"
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
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="metronome"
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

    <section class="text-center px-5 py-10 md:py-20 lg:py-24 text-white"  style="background-color:#010b1a;" >
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>The metronome you’ll<br class="sm:hidden">  WANT to use.</strong></h2>
            <p class="leading-tight mt-2 mb-5 sm:mb-10 mx-auto max-w-2xl">
                Let’s be honest. Piano players don’t like metronomes. But you’ll love using this one. The beautiful styling and quality feel are so much better than any app. And precision German manufacturing will mean your metronome will last as long as you keep playing.</p>

                @php
                    $slides = [
                     [
                         'img' => 'marketing/pianote/products/metronome/metronome-gallery-06.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/metronome/metronome-gallery-01.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/metronome/metronome-gallery-04.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/metronome/metronome-gallery-07.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/metronome/metronome-gallery-05.jpg',
                     ],
                 ];
                @endphp

            <div class="flex flex-wrap items-center mb-12">
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
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #000 calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32 text-white" style="background-color:#000;">
        <div class="container max-w-3xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/pianote/products/metronome/repair-guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h3 class="my-4 sm:my-6 lg:my-8"><strong>Focus on your practice<br class="inline sm:hidden"> - not your product</strong></h3>
            <p class="leading-normal">Wittner makes the best metronomes in the world.
                <br><br>
                And your Pianote Metronome comes with a 2-year guarantee. That means you don’t have to worry about the quality of your metronome.
                <br><br>
                Instead, you can focus on what’s most important - practice.</p>
        </div>
    </section>
    <div id="customize-anchor" class="anchor"></div>
    <section class="text-white px-5 sm:px-6 pt-64 pb-20 sm:py-20 lg:py-28 relative" style="background-color:#690808;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/pianote/products/metronome/order-bg-m.jpg')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/metronome/header-bg.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-20">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:hidden" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/metronome/metronome-web-logo-center.svg">
                    <img class="h-24 lg:h-32 hidden lg:inline-block" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/metronome/metronome-web-logo.svg">
                    <p class="leading-normal my-5 sm:my-6">Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner. </p>
                    <h4 class="mb-5 sm:mb-6">
                        @if(floatval($productPrices['taktell-piccolo-metronome']->price) > floatval($productPrices['taktell-piccolo-metronome']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['taktell-piccolo-metronome']->price) }}</s>
                            <strong>${{ floatval($productPrices['taktell-piccolo-metronome']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['taktell-piccolo-metronome']->discounted_price) / floatval($productPrices['taktell-piccolo-metronome']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['taktell-piccolo-metronome']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="/ecommerce/add-to-cart?products[taktell-piccolo-metronome]=1" class="join medium w-full">ORDER NOW &raquo;</a>
                </div>
            </div>
        </div>
    </section>

    <section class="text-white px-4 sm:px-6 py-8 sm:py-12 text-center" style="background: #00101D;">
        <div class="max-w-lg container mx-auto relative z-50 opacity-70">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p><strong>Any questions?</strong><br> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
