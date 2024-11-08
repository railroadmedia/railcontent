@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>100 Grooves | Drumeo</title>
    <meta property="og:title" content="100 Grooves | Drumeo">

    <meta name="description" content="These beats are masterpieces in groove, creativity, and musicianship. You'll see a transformation in your own drumming with each one you add to your repertoire.">
    <meta property="og:description" content="These beats are masterpieces in groove, creativity, and musicianship. You'll see a transformation in your own drumming with each one you add to your repertoire.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/100-grooves/share-image.jpg" style="display: none;">
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
    @include('_partials.components.shop.promo-banner-2', [
        "name" => "100 Grooves",
        "fullPrice" => floatval($productPrices['100-grooves-book']->price),
        "price" => floatval($productPrices['100-grooves-book']->discounted_price),
        "noBreadcrumb" => true
    ])
    <header class="bg-[#F1F7FE] text-black">
        <div class="relative md:px-6 lg:px-12 pb-10 md:py-20 lg:py-28 xl:py-36 overflow-hidden mx-auto w-full" style="max-width: 1440px;">
            <div class="container max-w-5xl lg:mx-auto">
                <div class="flex flex-wrap md:flex-nowrap items-center">
                    <div class="w-full md:w-5/12 text-center lg:text-left order-2 md:order-1 px-5 md:px-0 z-10 md:pr-10">

                        <img class="block h-28 md:h-24 lg:h-32 py-2 mx-auto md:mx-0"
                            alt="logo"
                            fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/drumeo/products/100-grooves/logo-dark.svg"
                        >
                         <img class="block h-6 pl-2 py-1 mx-auto lg:mx-0"
                            alt="logo"
                            fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/drumeo/products/100-grooves/by-drumeo.svg"
                        >
                        {{-- <h6 class="leading-normal my-4 sm:my-6">
                        The 15 Rudiments You Actually Need To<br class="sm:hidden">
                        Know (And How To Learn Them Quickly)</h6> --}}
                        <p class="text-sm text-drumeo pt-10">LAUNCH SPECIAL</p>

                        <h3 class="mb-4 sm:mb-6">
                            @if(floatval($productPrices['100-grooves-book']->price) > floatval($productPrices['100-grooves-book']->discounted_price))
                                <s class="opacity-60">${{ floatval($productPrices['100-grooves-book']->price) }}</s>
                                <strong>
                                    @if(number_format(floatval($productPrices['100-grooves-book']->discounted_price), 2) == intval(floatval($productPrices['100-grooves-book']->discounted_price)))
                                        ${{ floatVal(floatval($productPrices['100-grooves-book']->discounted_price)) }}
                                    @else
                                        ${{ number_format(floatval($productPrices['100-grooves-book']->discounted_price), 2) }}
                                    @endif
                                </strong>
                                <span class="text-musora">
                                    (SAVE {{ round(100 - (100 * (floatval($productPrices['100-grooves-book']->discounted_price) / floatval($productPrices['100-grooves-book']->price)))) }}%)
                                </span>
                            @else
                                <strong>${{ floatval($productPrices['100-grooves-book']->discounted_price) }}</strong>
                            @endif
                        </h3>
                        <a href="/ecommerce/add-to-cart?products[100-grooves-book]=1" class="join blue smaller w-full md:max-w-[350px]">
                            ORDER NOW &raquo;
                        </a>
                    </div>

                    <div class="w-full order-1 md:order-2 flex justify-end md:hidden">
                        <img class="w-3/4 block lg:hidden"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/drumeo/products/100-grooves/header-m.webp"
                            alt="100 Grooves Book Image">
                    </div>
                </div>
            </div>

           <img class="hidden md:block absolute top-0 right-0 h-full object-cover z-0 max-w-none sm:pb-10 sm:-mr-12 lg:mx-0"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/100-grooves/header.webp"
                alt="100 Grooves Book Image">
        </div>
    </header>

    <section class="text-left sm:px-6 pt-8 sm:py-10 lg:py-14 bg-[#F1F7FE] relative">
    <div class="max-w-7xl mx-auto p-4 lg:p-0">
        <div class="flex flex-col lg:flex-row gap-8">
        <div class="w-full sm:w-10/12 lg:w-6/12 mx-auto flex lg:items-center justify-center">
            <div class="w-full max-w-xl lg:max-w-2xl">
            <img
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/100-grooves/sample.webp"
                alt="100 Grooves Sample Image"
                class="w-full h-auto object-cover"
            >
            </div>
        </div>
        <div class="w-full lg:w-6/12 space-y-4 sm:space-y-6 lg:pl-4 lg:pr-10 tracking-normal">
            <h3 class="leading-tight lg:pt-4">
            <strong>
                100 Grooves <br/>
                That Changed History
            </strong>
            </h3>
            <div class="space-y-3">
            <p>
                You live in an era of access to every piece of recorded music ever.
            </p>
            <p>
                And with so many options, how do you know which songs truly moved the
                needle in the drumming world?
            </p>
            <p>
                After decades of hearing from thousands of drummers, we organized the
                most-influential drum parts into one handy guide.
            </p>
            <p>
                From Jimi Hendrix to John Coltrane, TOOL to Taylor Swift, we broke genre
                barriers to bring you <strong>the most comprehensive list of 100 grooves every
                drummer needs to know</strong>. And you'll learn more than just the grooves.
            </p>
            <p>
                You'll also have the history of each famous recording - including the
                drummer, album and backstory behind each iconic drum part. It's
                everything you need to go deeper (and impress your friends at parties).
            </p>
            <p>
                These beats are masterpieces in groove, creativity, and musicianship. You'll
                see a transformation in your own drumming with each one you add to your
                repertoire.
            </p>
            <p>
                Scroll down to take a peek inside - we're honored to help organize these
                pieces of drum recording history in one handy guide for you.
            </p>
            </div>
        </div>
        </div>
    </div>
    </section>


    <section class="text-center text-white py-7 sm:py-14 lg:py-20 bg-cover bg-center" style="background-color:#013350;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/100-grooves/demo-bg.webp');">
        <h3 class="leading-tight"><strong>Take A Look Inside.</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the book!</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <div class="max-w-xs sm:max-w-md mx-auto px-16 sm:px-0">
            <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/100-grooves/100-grooves-preview.pdf">
                <div class="w-full bg-center bg-cover" style="padding-bottom:135%;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/100-grooves/book.webp');"></div>
            </a>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f1f7fe;">
        <div class="container max-w-2xl mx-auto mb-16 lg:mb-5" x-data="{ open: false }">
            <h3 class="mb-5 sm:mb-8 lg:mb-10"><strong>Inspiration for drummers of all levels.</strong></h3>
            <div class="flex flex-wrap text-left overflow-hidden relative" x-bind:class="open ? 'max-h-full' : 'max-h-[670px] sm:max-h-[580px] lg:max-h-full'">
                @php
                    $testimonials = [
                        [
                        'name' => 'Nic Collins',
                        'credit' => 'Genesis, Better Stranger',
                        'comment' => '"100 Beats You Need To Know" is an awesome release from Drumeo and a must-have for any drummer. So much of what I\'ve learnt behind the kit came from playing along to my favorite songs and albums. Now with so many legendary grooves and transcriptions in one place, there\'s something new to learn for any drummer at any level.',                        'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/nic-collins.webp',
                        ]
                     ];
                @endphp
                @foreach ($testimonials as $testimonial)
                    <div class="w-full py-2 sm:px-2 lg:p-3">
                        <div class="flex flex-wrap sm:flex-nowrap items-start p-5 bg-white rounded-lg">
                            <img class="mb-2 sm:mb-0 h-16 lg:h-24 rounded-full" src="{{ $testimonial['img'] }}" alt="{{ $testimonial['name'] }}">
                            <p class="sm:pl-4 text-base lg:text-xl"><strong>{{ $testimonial['name'] }}</strong><br>
                                <em class="inline-block mb-1 opacity-60">{{ $testimonial['credit'] }}</em><br>
                               <span class="leading-relaxed tracking-none"> {{ $testimonial['comment'] }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="absolute bottom-0 left-0 right-0 h-16 z-10 lg:hidden" x-bind:class="{ 'hidden': open }" style="background:linear-gradient(to bottom, transparent, #f1f7fe);"></div> --}}
            </div>
            {{-- <div class="join drumeo outline smaller lg:hidden" x-on:click="open = !open;" x-bind:class="{ 'hidden': open }">Show All</div> --}}
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 relative text-white object-cover object-center" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/products/100-grooves/order-bg.webp')">
        <div class="container max-w-3xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 text-center lg:text-left sm:order-1 px-10 sm:px-0">
                    <img class="w-full max-w-xs sm:max-w-sm" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/100-grooves/book.webp">
                </div>
                <div class="w-full sm:w-1/2 text-center lg:text-left sm:pr-5">
                   <img class="block h-28 lg:h-32 pb-2 mx-auto sm:mx-0"
                            alt="logo"
                            fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/drumeo/products/100-grooves/logo-light.svg"
                        >
                         <img class="block h-6 pl-2 py-1 mx-auto lg:mx-0"
                            alt="logo"
                            fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/drumeo/products/100-grooves/by-drumeo.svg"
                        >
                        {{-- <h6 class="leading-normal my-4 sm:my-6">
                        The 15 Rudiments You Actually Need To<br class="sm:hidden">
                        Know (And How To Learn Them Quickly)</h6> --}}
                        <p class="text-sm text-drumeo pt-10">LAUNCH SPECIAL</p>
                    <h3 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['100-grooves-book']->price) > floatval($productPrices['100-grooves-book']->discounted_price))
                            <s class="opacity-60">${{ floatval($productPrices['100-grooves-book']->price) }}</s>
                            <strong>
                                @if(number_format(floatval($productPrices['100-grooves-book']->discounted_price), 2) == intval(floatval($productPrices['100-grooves-book']->discounted_price)))
                                    ${{  floatVal(floatval($productPrices['100-grooves-book']->discounted_price))  }}
                                @else
                                    ${{  number_format(floatval($productPrices['100-grooves-book']->discounted_price), 2)  }}
                                @endif
                            </strong>
                            <span class="text-musora">(SAVE {{ round(100 - (100 * (floatval($productPrices['100-grooves-book']->discounted_price) / floatval($productPrices['100-grooves-book']->price)))) }}%)</span>
                        @else
                            <strong>${{ floatval($productPrices['100-grooves-book']->discounted_price) }}</strong>
                        @endif
                    </h3>
                    <a href="/ecommerce/add-to-cart?products[100-grooves-book]=1" class="join blue medium w-full">ORDER NOW &raquo;</a>
                </div>
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
