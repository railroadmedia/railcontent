@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Easy Rudiments | Drumeo</title>
    <meta property="og:title" content="Easy Rudiments | Drumeo">

    <meta name="description" content="The 15 Rudiments You Actually Need To Know (And How To Learn Them Quickly)">
    <meta property="og:description" content="The 15 Rudiments You Actually Need To Know (And How To Learn Them Quickly)">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .text-dull-navy {
            color:#13618B;
        }
    </style>
@stop()

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
        "name" => "Easy Rudiments",
        "fullPrice" => floatval($productPrices['easy-rudiments-book']->price),
        "price" => floatval($productPrices['easy-rudiments-book']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="text-white px-5 sm:px-6 pt-72 pb-10 sm:py-20 lg:py-24 relative" style="background-color:#013350;">
        <div class="inset-0 absolute z-0 bg-top block sm:hidden" style="background-size: 365px;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/header-bg-m.jpg')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/header-bg.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="hidden sm:inline-block h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/logo.png">
                    <h6 class="leading-normal my-4 sm:my-6">
                        The 15 Rudiments You Actually Need To<br class="sm:hidden">
                        Know (And How To Learn Them Quickly)</h6>
                    <h6 class="leading-normal text-musora">LAUNCH SPECIAL</h6>
                    <h3 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['easy-rudiments-book']->price) > floatval($productPrices['easy-rudiments-book']->discounted_price))
                            <s class="opacity-60">${{ floatval($productPrices['easy-rudiments-book']->price) }}</s>
                            <strong>
                                @if(number_format(floatval($productPrices['easy-rudiments-book']->discounted_price), 2) == intval(floatval($productPrices['easy-rudiments-book']->discounted_price)))
                                    ${{  floatVal(floatval($productPrices['easy-rudiments-book']->discounted_price))  }}
                                @else
                                    ${{  number_format(floatval($productPrices['easy-rudiments-book']->discounted_price), 2)  }}
                                @endif
                            </strong>
                            <span class="text-musora">(SAVE {{ round(100 - (100 * (floatval($productPrices['easy-rudiments-book']->discounted_price) / floatval($productPrices['easy-rudiments-book']->price)))) }}%)</span>
                        @else
                            <strong>${{ floatval($productPrices['easy-rudiments-book']->discounted_price) }}</strong>
                        @endif
                        </h3>
                    <a href="/ecommerce/add-to-cart?products[easy-rudiments-book]=1" class="join blue medium w-full">ORDER NOW &raquo;</a>
                </div>
            </div>
        </div>
    </header>
    <section class="text-left sm:px-6 pt-8 sm:py-10 lg:py-14 bg-white relative">
        <div class="inset-0 absolute z-0 bg-cover hidden sm:block mx-auto" style="max-width: 1700px;background-position:58% 50%;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/content-bg.jpg')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center">
                <div class="w-full sm:w-2/3 px-5 sm:pl-0 sm:pr-10 lg:pr-12">
                    <h4 class="leading-tight mb-3 sm:mb-6"><strong>Rudiments are boring.</strong></h4>
                    <p class="leading-normal">Well, they can be. Especially when all you see are 40 random dots on a page and no way to connect them to actually playing music.
                        <br><br>
                        So we trimmed ‘em down.
                        <br><br>
                        Easy Rudiments is your simplified guide to learning the 15 rudiments you’ll actually use on a drum set. Plus, you’ll know HOW and WHY to learn them in the first place.
                        <br><br>
                        You’ll have:</p>
                        <ul class="list-disc ml-6 my-4">
                            <li>Detailed (and funny) explanations on each rudiment</li>
                            <li>Examples of those rudiments being used in REAL songs</li>
                            <li>10 Exercises to start building your chops with each rudiment</li>
                            <li>Professionally produced tracks to play along with</li>
                            <li>And practice tips used by pros to help you get better, faster</li>
                        </ul>
                        <p class="leading-normal">It’s all the info you need to start using rudiments to actually improve your drumming.</p>
                </div>
                <div class="w-full sm:w-1/3 px-5 pt-14 pb-8 sm:py-0 sm:pr-0 sm:pl-5 lg:pl-14 justify-center relative">
                    <p class="leading-normal mb-3 sm:mb-5 w-auto relative z-10"><strong>Meet The Fab 15:</strong></p>
                    <ol class="pl-6 list-decimal w-auto relative z-10">
                        <li class="leading-none mb-3">Single Stroke Roll</li>
                        <li class="leading-none mb-3">Multiple Bounce Roll</li>
                        <li class="leading-none mb-3">Double Stroke Roll</li>
                        <li class="leading-none mb-3">Single Paradiddle</li>
                        <li class="leading-none mb-3">Flam</li>
                        <li class="leading-none mb-3">Drag</li>
                        <li class="leading-none mb-3">Single Stroke Four</li>
                        <li class="leading-none mb-3">Single Paradiddle-diddle</li>
                        <li class="leading-none mb-3">Five Stroke Roll</li>
                        <li class="leading-none mb-3">Single Drag Tap</li>
                        <li class="leading-none mb-3">Single Stroke Seven</li>
                        <li class="leading-none mb-3">Double Paradiddle</li>
                        <li class="leading-none mb-3">Nine Stroke Roll</li>
                        <li class="leading-none mb-3">Flam Accent</li>
                        <li class="leading-none mb-3">Swiss Army Triplet</li>
                    </ol>
                    <div class="inset-0 absolute z-0 bg-bottom block sm:hidden" style="background-size: 370px;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/content-bg-m.jpg')"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center text-white py-7 sm:py-14 lg:py-20 bg-cover bg-center" style="background-color:#013350;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/demo-bg.jpg');">
        <h3 class="leading-tight"><strong>Take A Look Inside.</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the book!</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <div class="max-w-xs sm:max-w-md mx-auto px-16 sm:px-0">
            <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/easy-rudiments/preview-easy-rudiment.pdf">
                <div class="w-full bg-center bg-cover" style="padding-bottom:135%;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/book-cover2.webp');"></div>
            </a>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f1f7fe;">
        <div class="container max-w-5xl mx-auto mb-16 lg:mb-5" x-data="{ open: false }">
            <h3 class="mb-5 sm:mb-8 lg:mb-10"><strong>See what drummers are saying:</strong></h3>
            <div class="flex flex-wrap text-left overflow-hidden relative" x-bind:class="open ? 'max-h-full' : 'max-h-[670px] sm:max-h-[580px] lg:max-h-full'">
                @php
                    $testimonials = [
                        [
                        'name' => 'Hannah Welton',
                        'credit' => 'Drummer for Prince',
                        'comment' => 'What an incredible resource! Drumeo never fails to deliver innovative and informative tools to enhance the technique and overall performance of drummers everywhere. No matter your drumming goals or aspirations, “Easy Rudiments” is sure to help you get exactly where you want to be!',
                        'img' => 'https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/2021-12-15-Hannah-Welton-headshots-101-1-1640671453.jpg',
                        ],
                        [
                        'name' => 'Dorothea Taylor',
                        'credit' => 'The Godmother Of Drumming',
                        'comment' => 'Learning the essential rudiments opens up a lifetime of knowledge for the road ahead.
                        This new book from Drumeo is just what you need for a good foundation starting your drumming experience.',
                        'img' => 'https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/dorothea-thumb-1656515788.jpg',
                        ],
                        [
                        'name' => 'Zach Jones',
                        'credit' => 'Drummer for Sting',
                        'comment' => '“Easy Rudiments” offers a practical, musical approach to learning the foundational skills of drumming. If you’re looking for a quick, fun route from buying your first pair of drumsticks to playing along to your favorite tunes and making music with other people, this is the book for you.',
                        'img' => 'https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/zach-jones-1-1-1693917165.jpg',
                        ],
                        [
                        'name' => 'Tony Palermo',
                        'credit' => 'Drummer for Papa Roach',
                        'comment' => 'Rudiments can be overwhelming, but with “Easy Rudiments”, Drumeo has broken them down to 15 essentials. You also have to have the mindset that rudiments are not just limited to a pad. Placing rudiments around the kit is an exciting way to up your drumming musicality. I always use rudiments as part of my pre show warm up and I’m looking forward to expanding with this book.',
                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/tony-profile.jpg',
                        ],
                        [
                        'name' => 'Mike Sleath',
                        'credit' => 'Drummer for Shawn Mendes',
                        'comment' => 'Easy Rudiments by Drumeo covers all the most important tools every drummer needs! A must have for anyone looking to pick up some sticks!!',
                        'img' => 'https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/236685-avatar-1573487733.jpg',
                        ],
                        [
                        'name' => 'JP Bouvet',
                        'credit' => 'Independent Drummer',
                        'comment' => 'A book that saves you from guessing which rudiments matter the most. I use these rudiments constantly in my improvisation.',
                        'img' => 'https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d1923uyy6spedc.cloudfront.net/2023-08-08-JP-Bouvet-Coach-Cards-1x1-1692091193.jpg',
                        ],
                     ];
                @endphp
                @foreach ($testimonials as $testimonial)
                    <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                        <div class="flex flex-wrap sm:flex-nowrap items-start p-5 bg-white rounded-lg">
                            <img class="mb-2 sm:mb-0 h-16 lg:h-20 rounded-full" src="{{ $testimonial['img'] }}" alt="{{ $testimonial['name'] }}">
                            <p class="sm:pl-4"><strong>{{ $testimonial['name'] }}</strong><br>
                                <em class="leading-tight inline-block mb-1 opacity-60">{{ $testimonial['credit'] }}</em><br>
                                {{ $testimonial['comment'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
                <div class="absolute bottom-0 left-0 right-0 h-16 z-10 lg:hidden" x-bind:class="{ 'hidden': open }" style="background:linear-gradient(to bottom, transparent, #f1f7fe);"></div>
            </div>
            <div class="join drumeo outline smaller lg:hidden" x-on:click="open = !open;" x-bind:class="{ 'hidden': open }">Show All</div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative text-white" style="background:linear-gradient(to right, #003350, #426b8e);">
        <div class="container max-w-3xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 text-center lg:text-left sm:order-1 px-10 sm:px-0">
                    <img class="-mt-32 sm:-mt-36 sm:-mb-12 w-full max-w-xs sm:max-w-sm" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/book-cover2.webp">
                </div>
                <div class="w-full sm:w-1/2 text-center lg:text-left sm:pr-5">
                    <img class="hidden sm:inline-block h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/drumeo/products/easy-rudiments/logo.png">
                    <h6 class="leading-normal my-4 sm:my-6">
                        The 15 Rudiments You Actually Need To<br class="sm:hidden">
                        Know (And How To Learn Them Quickly)</h6>
                    <h6 class="leading-normal text-musora">LAUNCH SPECIAL</h6>
                    <h3 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['easy-rudiments-book']->price) > floatval($productPrices['easy-rudiments-book']->discounted_price))
                            <s class="opacity-60">${{ floatval($productPrices['easy-rudiments-book']->price) }}</s>
                            <strong>
                                @if(number_format(floatval($productPrices['easy-rudiments-book']->discounted_price), 2) == intval(floatval($productPrices['easy-rudiments-book']->discounted_price)))
                                    ${{  floatVal(floatval($productPrices['easy-rudiments-book']->discounted_price))  }}
                                @else
                                    ${{  number_format(floatval($productPrices['easy-rudiments-book']->discounted_price), 2)  }}
                                @endif
                            </strong>
                            <span class="text-musora">(SAVE {{ round(100 - (100 * (floatval($productPrices['easy-rudiments-book']->discounted_price) / floatval($productPrices['easy-rudiments-book']->price)))) }}%)</span>
                        @else
                            <strong>${{ floatval($productPrices['easy-rudiments-book']->discounted_price) }}</strong>
                        @endif
                    </h3>
                    <a href="/ecommerce/add-to-cart?products[easy-rudiments-book]=1" class="join blue medium w-full">ORDER NOW &raquo;</a>
                </div>
            </div>
        </div>
    </section>
    <section class="text-white px-4 sm:px-6 py-8 sm:py-12 text-center" style="background: #012c41;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
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

    @include("drumeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

@stop
