@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Blue Man Group Discount | Drumeo</title>
    <meta property="og:title" content="Blue Man Group Discount | Drumeo">

    <meta name="description" content="SAVE 30% on tickets in 4 US cities">
    <meta property="og:description" content="SAVE 30% on tickets in 4 US cities">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/image.webp" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
@stop

@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="py-12 sm:py-14 lg:py-20 px-4 text-center text-white bg-cover bg-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/header-bg.webp');">
        <div class="container max-w-5xl mx-auto">
            <img class="mx-auto w-full max-w-lg" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1260x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/header.webp">
            <p class="uppercase leading-tight text-drumeo tracking-widest mt-7">Exclusive drumeo member offer</p>
            <h2 class="leading-tight font-black my-2"><span class="text-drumeo">SAVE 30%</span> on tickets in 4 US cities</h2>
            <p class="leading-tight mb-5">Available August 20 to October 29.</p>
            <a class="anchor-slide join drumeo smaller" href="#final">Select Your City</a>
        </div>
    </section>
    <section class="px-4 sm:px-6 py-10 sm:py-16 lg:py-20">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <img class="w-full sm:w-auto h-auto sm:h-96 sm:rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1160x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/image.webp">
                <div class="px-6 sm:pr-0 sm:pl-7 lg:pl-10 mt-7 sm:mt-0 sm:order-1">
                    <h3 class="leading-tight mb-4"><strong>Drums, world-class performances, the color blue…</strong></h3>
                    <p class="leading-normal">The Blue Man Group and Drumeo have too much in common to NOT combine forces. 
                        <br><br>
                        That’s why we’re teaming up to offer Drumeo Members (that’s you) an exclusive discount to attend Blue Man Group shows in 4 US cities. 
                        <br><br>
                        It’s our way of saying thanks for being a lover of all things drums.
                        <br><br>
                        Scroll down to select your city and save 30% on your tickets.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="py-10 sm:py-14 lg:py-20 text-white" style="background-color:#030A25;">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-center mb-7 sm:mb-10"><strong>Select a city to see your show</strong></h2>
            <div
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                                    prev: 'hidden',
                                    next: 'splide__arrow--next hidden sm:flex mb-16',
                                    pagination: 'splide__pagination -bottom-10',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            breakpoints: {
                                767: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <div x-ref="splide" class="splide mb-10 sm:px-16">
                    <div class="splide__track">
                        <ul class="splide__list items-start">
                            <li class="splide__slide px-2">
                                <a target="_blank" class="hover:opacity-70 transition-opacity" href="https://www.ticketmaster.com/promo/0h4pq7">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/boston.webp" alt="city" />
                                </a>
                            </li>
                            <li class="splide__slide px-2">
                                <a target="_blank" class="hover:opacity-70 transition-opacity" href="https://www.ticketmaster.com/promo/3h9jow">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/chicago.webp" alt="city" />
                                </a>
                            </li>
                            <li class="splide__slide px-2">
                                <a target="_blank" class="hover:opacity-70 transition-opacity" href="https://www.ticketmaster.com/promo/ellnle">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/new-york.webp" alt="city" />
                                </a>
                            </li>
                            <li class="splide__slide px-2">
                                <a target="_blank" class="hover:opacity-70 transition-opacity" href="https://luxor.mgmresorts.com/redirect/show-offer-id/EntOffer_558265">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/lead-gen/blue-man/las-vegas.webp" alt="city" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
