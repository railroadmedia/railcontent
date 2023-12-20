@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Alesis Nitro Max E-Kit | Drumeo Edition</title>
    <meta property="og:title" content="Alesis Nitro Max E-Kit | Drumeo Edition">

    <meta name="description" content="Everything you need to start playing the drums.">
    <meta property="og:description" content="Everything you need to start playing the drums.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)//marketing/drumeo/products/kit/share-image.jpg" style="display: none;">
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

        .arrow-button {
                    background: linear-gradient(270deg, #01050D 0%, rgba(1, 5, 13, 0) 50%);
                    height: 70%;
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

    <header class="text-white relative overflow-hidden z-10" style="background-color:#3b5875;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <h1 class="leading-tight mb-3"><strong>Everything you need to<br class="hidden sm:inline"> start playing the drums.</strong></h1>
                <h5 class="leading-tight">The highest-rated beginner e-kit<br> meets award-winning drum lessons. </h5>
                <h4 class="leading-tight text-musora my-4 sm:my-5">
                    @if(floatval($productPrices['alesis-ekit']->price) > floatval($productPrices['alesis-ekit']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['alesis-ekit']->price) }}</s>
                        <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                        (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%)
                    @else
                        <strong>Only ${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                    @endif
                </h4>
                <div class="w-full max-w-xs mx-auto">
                    @if( $products['alesis-ekit']->getStockAvailability() > 1 && !empty($products['alesis-ekit']->getStockAvailability()))
                        <a class="w-full join smaller blue" href="#customize-anchor">Buy Now</a>
                    @else
                        <a class="w-full join smaller sold-out">SOLD OUT</a>
                    @endif
                    <br>
                    <div class="join smaller outline mt-3"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Check It Out!</div>
                </div>
                {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6>--}}
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10 bg-cover bg-center" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/kit/header-bg.jpg');"></div>
{{--        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>--}}
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
            src="https://d21q7xesnoiieh.cloudfront.net/marketing/drumeo/shop/stickbag/header-vid.mp4"></video>
    </header>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-5"><strong>All in one tidy package.</strong></h2>
            <div class="mx-auto max-w-4xl px-3">
                <img class="transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/e-kit-chart2.png"
                >
            </div>
        </div>
    </section>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative text-white" style="background:linear-gradient(to bottom, #01050d 66%, #021021);">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-7 sm:mb-10"><strong>Pro details on a<br class="sm:hidden">  beginner budget.</strong></h2>
            <div class="mb-7 sm:mb-10"
                x-data="{
                    splide: null,
                    init() {
                        this.splide = new Splide(this.$refs.splide, {
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-40 w-40 text-[#0B76DB]',
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
                        }).mount();
                    },
                    next() {
                        if (this.splide) {
                            this.splide.go('>');
                        }
                    },
                }"
            >

                <button class="arrow-button absolute top-1/3 right-0 transform -translate-y-1/2 z-150 w-20 hidden sm:block" @click="next()">
                <img src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/arrow-button-white.svg" alt="Arrow Icon" class="w-10" style="position: absolute; left:50px">
                </button>
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">
                            @php
                                $gridItems = [
                                    [
                                    'img' => 'marketing/drumeo/products/kit/1-save.jpg',
                                    'title' => 'Save your hands (and ears) with mesh heads.',
                                    'desc' => 'Most entry-level e-kits use hard rubber pads that lack the sensitivity and feel of a real drum set. The Alesis Nitro Max features tightly-woven premium mesh heads that let you practice anywhere, anytime without disturbing family or neighbors.',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/2-bigger.jpg',
                                    'title' => 'A bigger snare drum.',
                                    'desc' => 'Another reason to love this kit. The Nitro Max features a 10” snare with TWO strike zones – one in the center and one for rimshots. This gives your more sonic options AND helps you play with better technique and ergonomics. (Most entry-level kits have a tiny 8” snare.)',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/3-favourite.jpg',
                                    'title' => 'Play your favorite songs.',
                                    'desc' => 'Wirelessly connect your phone and choose your favorite songs to jam along with. The Nitro Max seamlessly mixes your drumming into the music – no cables required. Simple toss your phone or tablet on the built-in mount and start jamming.',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/4-improve.jpg',
                                    'title' => 'Improve your timing & feel.',
                                    'desc' => 'The perfect practice kit. The Nitro Max includes a built-in metronome trainer to help you develop your internal clock without any extra hardware. You’ll improve faster because the metronome tells you if you’re ahead, behind or just right.',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/5-choose.jpg',
                                    'title' => 'Choose your favorite kit sounds.',
                                    'desc' => 'The Nitro Max Module features 32 built-in kit sounds by BFD drums – some of the most sampled drum sounds in music production history. That means you’ll literally sound like the original drum track on your favorite songs.',
                                    ],
                                ];
                            @endphp
                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1 sm:px-3">
                                    <div class="rounded-xl overflow-hidden shadow-md border-2" style="color:#fff;background-color:#080c14;border-color:#121f2d; padding: 20px;">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1 rounded-xl"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="drumeo alesis-ekit"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <h4 class="mt-4 mb-2 font-black leading-tight"><strong>{{ $gridItem['title'] }}</strong></h4>
                                        <p class="pb-6 text-sm leading-normal opacity-70">{{ $gridItem['desc'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center sm:text-left">
                <div class="flex-grow sm:pr-5 lg:pr-8 mx-0 mb-5 sm:mb-0">
                    <h3 class="leading-tight mb-3"><strong>Your house<br class="hidden sm:inline lg:hidden"> <img src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/arrow-yellow.svg" alt="arrow" class="w-10 mx-3"> recording studio.</strong></h3>
                    <p class="leading-normal max-w-lg mx-0">
                    Connect your kit to your laptop with a single cable, open up Garage Band (or any DAW), and start laying down your grooves.
                    <br><br>
                    This makes it effortless to collaborate with other musicians and document your practice history.</p>
                </div>
                <div class="flex-shrink-0 border-2 rounded-xl p-7 sm:p-10 text-left" style="background-color:#080c14;border-color:#121f2d;">
                    <h6 class="leading-normal font-black">
                                <img class="align-middle w-8 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/record-icon.svg"> Record your practice.
                        <br><br><img class="align-middle w-8 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/drum-icon.svg"> Create your own beats.
                        <br><br><img class="align-middle w-8 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/people-icon.svg"> Share your creative ideas.
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background:linear-gradient(to bottom, #fff 66%, #e8f2fb);">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-7 sm:mb-10"><strong>Play your first beats<br class="sm:hidden"> <img src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/arrow-blue.svg" alt="Arrow" class="w-10 lg:w-12 mx-3"> Write your first song.</strong></h2>
            <div class="flex flex-wrap sm:flex-nowrap justify-center text-left mb-8 sm:mb-16 lg:mb-20">
                <div class="mb-5 sm:mb-0 sm:pr-7 sm:w-7/12 flex-grow-0">
                    <div class="h-full rounded-xl p-7 sm:p-10 pt-48 bg-black text-white flex items-end bg-cover bg-top" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/new-drummers-image2.jpg');">
                        <div>
                            <h3 class="leading-tight mb-3"><strong>New Drummers</strong></h3>
                            <p class="leading-normal max-w-lg mx-0">Get started on the drums with an affordable e-kit that gives you all the features of a premium drum set. This is the perfect way to dip your toe into the waters of drumming without breaking the bank.</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="rounded-xl p-7 sm:p-10 mb-5 sm:mb-7" style="background-color:#eff6fd;">
                        <h3 class="leading-tight mb-3"><strong>Acoustic Drummers</strong></h3>
                        <p class="leading-normal max-w-lg mx-0">You’re already living the dream on an acoustic kit. The Drumeo E-Kit gives you a quiet practice option to practice, play and record your ideas without the volume of your acoustic kit.</p>
                    </div>
                    <div class="rounded-xl p-7 sm:p-10" style="background-color:#eff6fd;">
                        <h3 class="leading-tight mb-3"><strong>Other Musicians</strong></h3>
                        <p class="leading-normal max-w-lg mx-0">Complete your home studio with a versatile e-kit. Lay down your beats and fills, add your keyboards, guitars, and vocals, and share your ideas with the world—the ultimate kit for your home studio.</p>
                    </div>
                </div>
            </div>
            <h6 class="text-drumeo mb-3"><em>The highest-rated beginner e-kit<br class="sm:hidden"> meets award-winning drum lessons.</em></h6>
            <h2 class="leading-tight mb-5 sm:mb-7"><strong>Rave reviews for the<br class="sm:hidden"> Alesis Nitro Max…</strong></h2>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 lg:gap-6">
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-7 md:h-9 lg:h-10"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/amazon-logo.png"
                        alt="Amazon Logo">
                </div>
                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>4.6</strong></h2>
                    <div class="flex justify-center">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= 4)
                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        @else
                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>
                </div>
            </div>

            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-4 md:h-5 lg:h-6"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/music-radar-logo.png"
                        atl="Music Radar Logo">
                </div>

                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>5</strong></h2>
                    <div class="flex justify-center">
                    @for($i = 1; $i <= 5; $i++)
                    @if($i <= 5)
                        <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        @else
                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>

                </div>
            </div>
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4;">

                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-5 md:h-7 lg:h-9"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/thomann-logo.png"
                        alt="Thomann Logo">
                </div>
                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>4.3</strong></h2>
                    <div class="flex justify-center">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= 4)
                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        @else
                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>
                </div>
            </div>
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-7 md:h-10 lg:h-11"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/sweetwater-logo.png"
                        alt="Sweetwater Logo">
                </div>
                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>5</strong></h2>
                    <div class="flex justify-center">
                        @for($i = 1; $i <= 5; $i++)
                        @if($i <= 4)
                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        @else
                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>

                </div>
            </div>
        </div>

        <div class="relative"></div>
            <h2 class="leading-tight mt-14 sm:mt-20 mb-4 sm:mb-5"><strong>… and {{ number_format(Prices::$students) }} happy<br class="sm:hidden"> drum students.</strong></h2>
            @php
                $testimonials = $drumeo['testimonialsShopVersion'];
            @endphp
                <div x-data="{
                    splide: null,
                    init() {
                        this.splide = new Splide(this.$refs.splide, {
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                                prev: 'hidden',
                                next: 'hidden',
                                pagination: 'splide__pagination -bottom-10',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            breakpoints: {
                                800: {
                                    perPage: 2.5,
                                },
                                769: {
                                    perPage: 1.5,
                                    drag: 'free',
                                    snap: false,
                                },
                            },
                        }).mount();
                    },
                    goNext() {
                        if (this.splide) {
                            this.splide.go('>');
                        }
                    },
                }"
                class="relative">
                <button class="absolute top-1/3 right-0 transform -translate-y-1/2 z-150 w-20 hidden sm:block" @click="goNext()">
                    <img src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/kit/arrow-button-blue.svg" alt="Arrow Icon" class="w-10" style="position: absolute; left:50px">
                </button>
                    <div x-ref="splide" class="splide" style="width: 95%">
                        <div class="splide__track">
                            <ul class="splide__list items-start" style="padding-top: 60px !important;">

                                @foreach ($testimonials as $testimonial)
                                    <li class="splide__slide bg-white rounded-xl pb-6 px-8 mr-4 text-center">
                                        <div class="-mt-10 mb-6">
                                            <img class="rounded-full w-[90px] h-[90px] object-cover"
                                                src="https://www.musora.com/musora-cdn/image/width=130,quality=95/{{ $testimonial['img'] }}"
                                                alt="{{ $testimonial['name'] }} avatar" />
                                        </div>
                                        <h6 class="mb-1"> <strong>{{ $testimonial['name'] }}</strong> </h6>
                                        <p><i>30-Day Drummer Student</i></p>
                                        @if (isset($location))
                                            <p><i>{{ $location }}</i></p>
                                        @endif
                                        <img class="my-4"
                                            src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/stars.svg"
                                            alt="stars" />
                                        <p class="mb-6">“{!! $testimonial['comment'] !!}”</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </section>


    @php
        $gridItems = [
                [
                    "image" => "marketing/drumeo/membership/homepage/webp-format/10-level-cirriculum.webp",
                    "title" => "10-Level Curriculum",
                    "desc" => "The most trusted step-by-step video lessons for every technique, pattern, and style.",
                    "lessonInfo" => [
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/10-level-cirriculum.webp",
                        ],
                    ],
                ],
                [
                    "image" => "marketing/drumeo/membership/homepage/webp-format/practical-assignments.webp",
                    "title" => "Practical Assignments",
                    "desc" => "Keep up your progress with clear assignments and handy practice tools for every level.",
                    "lessonInfo" => [
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/practical-assignments.webp",
                        ],
                    ],
                ],
                [
                    "image" => "marketing/drumeo/membership/homepage/2023/guided-workouts2.jpg",
                    "title" => "Guided Workouts",
                    "desc" => "Stay inspired with guided workouts where you’ll play along with your teacher in real time.",
                    "lessonInfo" => [
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guided-workouts2.jpg",
                        ],
                    ],
                ],
                [
                    "image" => "marketing/drumeo/membership/homepage/webp-format/world-class-teachers.webp",
                    "title" => "World-Class Teachers",
                    "desc" => "The best drummers are here — including Grammy Award winners and touring musicians.",
                    "lessonInfo" => [
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/world-class-teachers.webp",
                        ],
                    ],
                ],
                [
                    "image" => "marketing/drumeo/membership/homepage/webp-format/downloadable-videos.webp",
                    "title" => "Downloadable Videos",
                    "desc" => "Stream your lessons OR download your videos so you can practice anywhere, anytime.",
                    "lessonInfo" => [
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/downloadable-videos.webp",
                        ],
                    ],
                ],
                [
                    "image" => "marketing/drumeo/membership/homepage/webp-format/personalized-support.webp",
                    "title" => "Personalized Support",
                    "desc" => "Get weekly live streams, student lesson plans, and access to a global drum community.",
                    "lessonInfo" => [
                        [
                            "thumb" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/membership/homepage/webp-format/personalized-support.webp",
                        ],
                    ],
                ],
            ]
    @endphp

    <div id="method" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#e7f1fb;">
        <div class="container max-w-5xl mx-auto">
            <h2 class="leading-tight"><strong>Always know exactly<br class="sm:hidden"> what to practice. </strong></h2>
            <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">
                Your e-kit includes one year of unlimited drum <br class="sm:hidden">
                lessons with Drumeo’s award-winning platform.</p>
            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 hidden sm:flex">
                @foreach ($gridItems as $key => $gridItem)
                    <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0 max-w-xs sm:max-w-full">
                        <picture class="w-1/3 sm:w-full">
                            <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/{{ $gridItem['image'] }}">

                            <img
                                class="rounded-xl mb-3 transition-opacity opacity-0"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/220x0/filters:quality(95)/{{ $gridItem['image'] }}"
                                alt="grid{{$key+1}}"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                            >
                        </picture>
                        <div class="w-2/3 sm:w-full pl-3 sm:pl-0">
                            <p class="leading-tight mb-0.5"><strong class="font-black"><span class="border border-drumeo rounded-full px-2 py-0.5 inline-block">{{$key+1}}</span> {{ $gridItem['title'] }}</strong></p>
                            <p class="leading-normal text-sm">{{ $gridItem['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6 flex sm:hidden">
                @foreach ($gridItems as $key => $gridItem)
                    @include('_partials.components.question-dropdown', [
                        'variant' => true,
                        'num' => $key+1,
                        "title" => $gridItem['title'],
                        "desc" => $gridItem['desc'],
                        'lessonInfo' => $gridItem['lessonInfo'],
                        'open' => $key === 0 ? true : false
                    ])
                @endforeach
            </div>
        </div>
    </section>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative bg-drumeo text-white">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight"><strong>A double guarantee for peace of mind. </strong></h2>
            <p class="leading-tight mt-2 mb-5 sm:mb-7">Your E-Kit includes a 90-day purchase guarantee from Drumeo + a 1-year warranty from Alesis on all parts. </p>
            <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/guarantee.png">
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="px-3 sm:px-0 text-center relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #fff, #f0f6fc 66%);">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center px-4 sm:px-6 pt-10 md:py-10 lg:py-20">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5">
                    <h2 class="pb-6 sm:pb-4"><strong>Everything you need<br> to start playing<br> the drums.</strong></h2>
                    <h6 class="leading-tight">Get the ultimate starter e-kit + <br>
                        one year of unlimited drum lessons.</h6>

                    <h4 class="my-4 text-drumeo">
                        @if(floatval($productPrices['alesis-ekit']->price) > floatval($productPrices['alesis-ekit']->discounted_price))
                            <s class="opacity-50">${{ floatval($productPrices['alesis-ekit']->price) }}</s>
                            <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                            (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%)
                        @else
                            <strong>Only ${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="TODO" class="join blue smaller w-full max-w-xs">BUY NOW</a>
                </div>
                <div
                    class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl pb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/kit/collage2.png" alt="collage">
                </div>
            </div>
        </div>
        <div class="w-full sm:hidden text-center py-8">
            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/kit/collage2.png" alt="collage">
        </div>
    </section>


    <section class="px-4 sm:px-6 py-10 text-white" style="background: #00101D;">
        <div class="container max-w-5xl mx-auto relative z-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full mx-2">
                <h5 class="leading-normal text-left" style="width: 100%"><strong>Free shipping in the USA and Canada</strong><br>
                Your Drumeo E-Kit will ship for free anywhere in the USA/Canada.</h5>

                <h5 class="leading-normal text-left"><strong>Discounted shipping in all other countries.</strong><br>
                    If you live outside of the US or Canada, you qualify for a $100 shipping discount. You’ll see that applied upon checkout.</h5>
            </div>
        </div>
    </section>
    <section class="text-center py-10 text-white" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 opacity-60">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 opacity-60" style="margin-top: 0;">
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


    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

@stop
