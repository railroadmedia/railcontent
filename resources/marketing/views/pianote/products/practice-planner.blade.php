@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Practice Planner | Pianote</title>
    <meta property="og:title" content="Practice Planner | Pianote">
    <meta name="description" content="Stay on track and see better results from your practice sessions. Make every practice perfect.">
    <meta property="og:description" content="Stay on track and see better results from your practice sessions. Make every practice perfect.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/products/practice-planner/share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <style>

        .header-bg {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-planner/header-bg-m.webp');
            background-size: cover;
        }

        @media (min-width: 639px) {
            .header-bg {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/practice-planner/header-bg.webp');
                background-size: cover;
            }
        }

        .icon-gradient {
            background: linear-gradient(180deg, #FDBD4F, #B87F34);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])

    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Practice Planner",
        "fullPrice" => floatval($productPrices['practice-planner']->price),
        "price" => floatval($productPrices['practice-planner']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="header-bg px-5 sm:px-6 py-12 sm:py-20 bg-top" style="background-color:#F4F1EC;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center sm:mt-0">
             <img class="w-96 mx-auto mb-4 sm:hidden px-6" alt="Logo" fetchpriority="high"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-planner/logo-mobile.svg">

                <div class="w-full sm:w-7/12 text-center lg:text-left sm:order-1 px-10">
                    <img class="w-full max-w-xs lg:max-w-md lg:p-6"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/practice-planner/planner.webp"
                        alt="Practice Planner Cover">
                </div>
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="w-96 hidden sm:block" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-planner/logo-desktop.svg"
                        alt="Logo">
                    <p class="my-4 sm:my-6 text-black">Stay on track and see better results from your practice sessions.</p>
                    <p>Make every practice perfect.</p>
                    <h2 class="mb-4 sm:mb-6">
                        @if (floatval($productPrices['practice-planner']->price) >
                                floatval($productPrices['practice-planner']->discounted_price))
                            <strong></strong> <s
                                class="opacity-60">${{ floatval($productPrices['practice-planner']->price) }}</s>
                            <strong>${{ floatval($productPrices['practice-planner']->discounted_price) }}</strong>
                            <span class="text-pianote text-base">(SAVE
                            {{ round(100 - 100 * (floatval($productPrices['practice-planner']->discounted_price) / floatval($productPrices['practice-planner']->price))) }}%)
                            </span>
                        @else
                            <strong>
                                ${{ floatval($productPrices['practice-planner']->discounted_price) }}</strong>
                        @endif
                    </h2>
                    <a href="/ecommerce/add-to-cart?products[practice-planner]=1&promo-code=ny-books-shipping&locked=true"
                        class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#FFFFFF">
        <div class="container mx-auto z-10 relative max-w-5xl">
            @php
            $item = [
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-planner/intro-image.webp',
                'desc' => [
                    'Practice doesn’t make perfect.',
                    '<strong>Perfect practice makes perfect.</strong>',
                    'And with the Pianote Practice Planner, you’ll get the most from your practice every time you sit at the keys.',
                    'Plan in advance so you always know what to work on. Stick to your plan. Record the result.',
                    'It’s the best way to make progress on the piano.',
                    'You have goals on the piano.',
                    'This planner will help you achieve them.'
                ],
                'alt' => 'Piano Key Overlay',
                'title' => 'Not all practice is <br class="hidden md:block"> created equal.',
            ];
            @endphp

            <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                <div class="w-full sm:w-6/12 rounded-2xl order-1 sm:order-2"
                     loading="lazy"
                     onload="this.classList.remove('opacity-0')">
                    <img class="object-cover w-full h-full rounded-2xl"
                         src="{{ $item['img'] }}"
                         alt="{{ $item['alt'] }}">
                </div>

                <div class="flex flex-row md:flex-col sm:flex-1 justify-center items-start py-4 sm:pr-4 md:px-10 order-2 sm:order-1">
                    <div>
                        <h3 class="leading-tight mx-0 my-2 sm:my-4">
                            <strong>{!! $item['title'] !!}</strong>
                        </h3>
                        @foreach ($item['desc'] as $desc)
                            <p class="pb-2">{!! $desc !!}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34; background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-planner/piano-bg.webp');">
        <h3 class="leading-tight"><strong>Take a look inside</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5 text-xs sm:text-base"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative text-[#FCBD50]" style="bottom:-7px"></i> <em>Click to see a sample of how to use your practice planner.</em> <i class="fa-light fa-arrow-turn-down ml-1 relative text-[#FCBD50]" style="bottom:-7px"></i></p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/practice-planner/practice-planner-sample.pdf" class="relative">
            <img class="inline-block lg:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-planner/piano-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden lg:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/practice-planner/piano.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>

    <section class="bg-white md:py-10 lg:py-20">
        <div class="py-8">
            <div class="max-w-6xl mx-auto px-4">
            <div class="max-w-sm md:max-w-4xl mx-auto px-4">
                 <h2 class="text-center mb-2">
                    <strong>Your guide to <br class="block md:hidden"> playing better.</strong>
                </h2>
                <p class="text-center mb-2 px-10 md:px-0">
                    Here's a small sample of how the planner will help you get the most out of your valuable practice time.
                </p>
                <p class="text-center mb-6"><strong>You'll learn:</strong></p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-3">
                    @php
                    $cards = [
                        [
                            'icon' => 'icons-01.svg',
                            'text' => 'The <strong>one question</strong> every piano player needs to be able to answer before getting started.'
                        ],
                        [
                            'icon' => 'icons-02.svg',
                            'text' => 'What to do if you only have <strong>10 minutes</strong> to practice today.'
                        ],
                        [
                            'icon' => 'icons-03.svg',
                            'text' => 'The <strong>essential elements</strong> every practice needs to include (don\'t skip these).'
                        ],
                        [
                            'icon' => 'icons-04.svg',
                            'text' => 'How to <strong>stay motivated</strong> so you\'ll want to practice more (and get better).'
                        ],
                        [
                            'icon' => 'icons-06.svg',
                            'text' => 'How to play <strong>any chord</strong> from <strong>any key</strong> with these chord formulas (including 6th, 7th, diminished, and augmented chords).'
                        ],
                        [
                            'icon' => 'icons-05.svg',
                            'text' => 'The <strong>4 elements</strong> you need to set achievable goals (and how to follow through).'
                        ],
                        [
                            'icon' => 'icons-07.svg',
                            'text' => 'What to do when you <strong>don\'t feel like practicing</strong> (one simple trick).'
                        ],
                        [
                            'icon' => 'icons-08.svg',
                            'text' => 'How to <strong>end each practice session on a high note</strong> (so you\'ll want to come back).'
                        ]
                    ];
                    @endphp

                    @foreach ($cards as $index => $card)
                        <div class="bg-[#F4F1EC] rounded-lg p-4 shadow-sm flex items-center md:block lg:p-6 lg:min-h-[220px]"
                            style="box-shadow: 0px 4px 4px 0px #00000040;">
                            <div class="icon-gradient w-12 h-12 flex items-center justify-center mb-4 md:mb-6 md:mr-0 mr-4">
                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/practice-planner/{{ $card['icon'] }}" alt="Icon {{ $index + 1 }}" class="w-9 h-9 md:w-11 md:h-11">
                            </div>
                            <p class="flex-1 text-sm">{!! $card['text'] !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>

    <section class="header-bg px-5 sm:px-6 py-12 sm:py-16 lg:py-20 bg-top">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <img class="w-96 mx-auto mb-4 sm:hidden px-6" alt="Logo" fetchpriority="high"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-planner/logo-mobile.svg">
                <div class="w-full sm:w-7/12 text-center lg:text-left sm:order-1 px-10">
                    <img class="w-full max-w-xs lg:max-w-md lg:p-10"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/practice-planner/planner.webp"
                        alt="Practice Planner Cover">
                </div>
                <div class="w-full sm:w-5/12 text-center sm:text-left sm:pr-5">
                    <img class="w-96 hidden sm:block" alt="Logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-planner/logo-desktop.svg">
                    <p class="my-4 sm:my-6 text-black">Stay on track and see better results from your practice sessions.</p>
                    <p class="my-4 sm:my-6 text-black">Make every practice perfect.</p>

                    <ul class="leading-relaxed">
                        <li><i class="fa fa-check text-pianote mb-2"></i> 186 Pages</li>
                        <li><i class="fa fa-check text-pianote mb-2"></i> Weekly templates to track your goals</li>
                        <li><i class="fa fa-check text-pianote mb-2"></i> Monthly check-ins</li>
                    </ul>

                    <h2 class="my-4 sm:my-6">
                        @if (floatval($productPrices['practice-planner']->price) >
                                floatval($productPrices['practice-planner']->discounted_price))
                            <strong></strong> <s
                                class="opacity-60">${{ floatval($productPrices['practice-planner']->price) }}</s>
                            <strong>${{ floatval($productPrices['practice-planner']->discounted_price) }}</strong>
                            (SAVE
                            {{ round(100 - 100 * (floatval($productPrices['practice-planner']->discounted_price) / floatval($productPrices['practice-planner']->price))) }}%)
                        @else
                            <strong>
                                ${{ floatval($productPrices['practice-planner']->discounted_price) }}</strong>
                        @endif
                    </h2>
                    <a href="/ecommerce/add-to-cart?products[practice-planner]=1&promo-code=ny-books-shipping&locked=true"
                        class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </section>


    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
