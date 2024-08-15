@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Blue Man Group Discount | Drumeo</title>
    <meta property="og:title" content="Blue Man Group Discount | Drumeo">

    <meta name="description" content="SAVE 30% on tickets in 4 US cities">
    <meta property="og:description" content="SAVE 30% on tickets in 4 US cities">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/share-image.jpg" style="display: none;">
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

    <section class="py-12 sm:py-14 lg:py-20 px-4 text-center" style="background: linear-gradient(0deg, #FFF2D4, #3EC8FF);">
        <div class="container max-w-5xl mx-auto">
            <img style="height:500px;" src="https://placehold.co/630x500/EEE/31343C">
{{--            <img style="height:550px;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp">--}}
            <p class="uppercase leading-tight text-drumeo tracking-widest mt-7">Exclusive drumeo member offer</p>
            <h2 class="leading-tight font-black my-2">SAVE 30% on tickets in 4 US cities</h2>
            <p class="leading-tight mb-7">Available August 26 to October 29.</p>
            <a class="anchor-slide join drumeo smaller" href="#final">Select Your City</a>
        </div>
    </section>
    <section class="px-4 sm:px-6 py-10 sm:py-16 lg:py-20">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <img class="w-full sm:w-auto h-auto sm:h-96 sm:rounded-xl" src="https://placehold.co/580x600/EEE/31343C">
{{--                <img class="w-full sm:w-auto h-auto sm:h-96 sm:rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp">--}}
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
    <section class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFF8EB;">
        <div class="max-w-5xl mx-auto">
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
                <div x-ref="splide" class="splide mb-10">
                    <div class="splide__track">
                        <ul class="splide__list items-start">
                            <li class="splide__slide px-2">
                                <a href="">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://placehold.co/450x450/EEE/31343C" alt="city" />
{{--                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp" alt="city" />--}}
                                </a>
                            </li>
                            <li class="splide__slide px-2">
                                <a href="">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://placehold.co/450x450/EEE/31343C" alt="city" />
{{--                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp" alt="city" />--}}
                                </a>
                            </li>
                            <li class="splide__slide px-2">
                                <a href="">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://placehold.co/450x450/EEE/31343C" alt="city" />
{{--                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp" alt="city" />--}}
                                </a>
                            </li>
                            <li class="splide__slide px-2">
                                <a href="">
                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://placehold.co/450x450/EEE/31343C" alt="city" />
{{--                                    <img class="rounded-xl transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/double-bass-101/header.webp" alt="city" />--}}
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
