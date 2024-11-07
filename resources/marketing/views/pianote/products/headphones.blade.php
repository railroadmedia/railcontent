@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Headphones | Pianote</title>
    <meta property="og:title" content="Headphones | Pianote">

    <meta name="description" content="The Pianote Headphones deliver studio-quality sound, all-day comfort, and complete privacy for focused practice sessions.">
    <meta property="og:description" content="The Pianote Headphones deliver studio-quality sound, all-day comfort, and complete privacy for focused practice sessions.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/headphones/share-image-new.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join, .join:hover {
            background-color: #F61A30;
            border-color: #F61A30;
        }
        .join.musora, .join.musora:hover {
            background-color: #FFAE00;
            border-color: #FFAE00;
            color: #000;
        }
        .join.outline.red {
            border-color: #F61A30;
            color: #F61A30;
        }

        .join.smaller.outline {
            padding: 15px 7%;
            border-color: #F61A30;
            background-color: rgb(18, 18, 6, 0.3);
        }

        .join.smaller.outline:hover {
            background-color: #F61A30;
            color: #FFFFFF;
        }

        .join i {
            transition: all .3s;
            position: relative;
            right: 0;
        }

        .translate-x-2 {
            transform: translateX(0.2rem);
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            width: 1%;
            font-weight: 700;
            text-align: left;
        }

        .content-section table.comparison.eardrums tr td:nth-child(2) {
            color: white;
            background: linear-gradient(to right, #F61A30, #A10000) !important;
        }

        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(2) {
            background: linear-gradient(to right, #F61A30, #A10000) !important;
        }

        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 27.33%;
            border: none;
        }

        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            color: black;
            background-color: #F1EFED;
        }

        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(3),
        .content-section table.comparison.eardrums tr:nth-child(1) td:nth-child(4) {
            background-color: #D7D3CF;
        }

        .content-section table.comparison tr:hover td:nth-child(3),
        .content-section table.comparison tr:hover td:nth-child(4),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(3),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(4) {
            background-color: #D7D3CF;
        }

        .content-section table.comparison tr:hover td:nth-child(2),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(2),
        .content-section table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color: #BD0013;
        }

        .content-section table.comparison.eardrums tr:hover td:nth-child(2) {
            filter: brightness(1.2);
        }

        .content-section table.comparison.eardrums tr td {
            color: black;
            padding: 15px 7px;
            font-size: 12px;
            text-transform: capitalize;
        }

        .content-section table.comparison.eardrums tr:last-child td {
            padding: 15px 7px 30px;
        }

        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
                font-size: 16px;
            }
            .content-section table.comparison.eardrums tr:nth-child(2n) td strong {
                font-size: 28px;
                color: #5B6068;
            }
            .content-section table.comparison.eardrums tr:last-child td strong {
                font-size: 36px;
            }

            .content-section table.comparison.eardrums tr:last-child td s {
                font-size: 28px;
                font-weight:400;
            }
        }

        .content-section table.comparison.eardrums tr td:nth-child(1) {
            text-transform: capitalize;
        }

        @media (max-width: 767px) {

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

        table.comparison {
            border-spacing: 15px 0;
            cursor: pointer;
        }

        @media (max-width: 767px) {
            table.comparison {
                border-spacing: 7px 0;
            }
        }
        .info-pop {
            position: absolute;
        }
        .info-pop:after, .info-pop:before {
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
        .info-pop:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .info-pop:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
            bottom: 30px;
            left: -300%;
        }
        .info-pop:hover, .info-pop:active, .info-pop:focus {
            z-index: 100;
        }
        .info-pop:hover:after, .info-pop:hover:before, .info-pop:active:after, .info-pop:active:before, .info-pop:focus:after, .info-pop:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
    </style>

    @php
        $orderUrl = '/ecommerce/add-to-cart?products[pianote-headphones-2024]=1';
        $discountedPrice = number_format(floatval($productPrices['pianote-headphones-2024']->discounted_price), 2) == intval(floatval($productPrices['pianote-headphones-2024']->discounted_price))
           ? floatval($productPrices['pianote-headphones-2024']->discounted_price)
           : number_format(floatval($productPrices['pianote-headphones-2024']->discounted_price), 2)
    @endphp
@stop

@section('body-data')
    x-data="{
    trailer: false,
    trailerM: false,
    }"
@endsection

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner-3', [
        "name" => "Pianote Headphones",
        "fullPrice" => floatval($productPrices['pianote-headphones-2024']->price),
        "price" => $discountedPrice,
        "noBreadcrumb" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#000;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-16 sm:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/headphones/logo-white.webp"><br>
                <h6 class="leading-tight my-3 lg:my-6">Superior Sound, Comfort, and Privacy <br class="sm:hidden">for Piano Players.</h6>
                <h2 class="leading-tight">
                    @if(floatval($productPrices['pianote-headphones-2024']->price) > floatval($productPrices['pianote-headphones-2024']->discounted_price))
                        <s class="opacity-50 font-extralight">${{ floatval($productPrices['pianote-headphones-2024']->price) }}</s>
                        <strong>${{ floatval($productPrices['pianote-headphones-2024']->discounted_price) }}</strong>
                        {{-- <em class="text-musora text-sm">(Save {{ round(100 - (100 * (floatval($productPrices['pianote-headphones-2024']->discounted_price) / floatval($productPrices['pianote-headphones-2024']->price)))) }}%)</em> --}}
                    @else
                        <strong>${{ floatval($productPrices['pianote-headphones-2024']->discounted_price) }}</strong>
                    @endif
                </h2>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline red hidden sm:inline-block"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    <div class="sm:w-5/12 join smaller outline red sm:hidden inline-block"   @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    @if( $products['pianote-headphones-2024']->getStockAvailability() > 1 && !empty($products['pianote-headphones-2024']->getStockAvailability()))
                        <a class="w-5/12 join smaller bg-pianote anchor-slide ml-2" href="#customize-anchor">Order Now</a>
                    @else
                        <a class="join smaller sold-out" @click="waitlistModal = true;">JOIN WAITLIST</a>
                    @endif
                </div>
                {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6>--}}
            </div>
        </div>
        {{-- <div class="top-0 left-0 absolute w-full h-full z-10" style="background: radial-gradient(rgba(24,25,27,0.8), transparent);"></div> --}}
        <img class="hidden sm:inline object-cover w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/headphones/header-bg.webp">
        <img class="sm:hidden object-cover w-full h-full relative z-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/headphones/header-bg-m.webp">
        {{-- <video class="object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header2.mp4"></video> --}}
    </header>


     @php
        $gettings = [
            [
                'position' => 'right',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/headphones/catch-every-detail-pianote.webp',
                'title' => 'Catch every detail.',
                'desc' => 'With an extended <strong>frequency range of 10–26,000 Hz</strong> and <strong>larger 45mm drivers</strong>, these headphones allow you to experience your digital piano like it’s meant to be heard.
                <br/><br/>Your digital piano will sound better immediately, helping you connect with your music and stay motivated to practice longer. It’s like upgrading your speakers without having to buy a new piano!',
            ],
            [
                'position' => 'left',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/headphones/cushioned-ear-pads.webp',
                'title' => 'Comfort that keeps you playing.',
                'desc' => 'The Pianote Headphones feature <strong> ultra-soft, cushioned ear pads </strong>and a light weight frame.<strong> Weighing just 295 grams</strong>, they’re so light and comfortable you’ll forget you’re wearing them.
                <br/><br/>So you can <strong>focus on what’s most important - the music.</strong>',
            ],
            [
                'position' => 'right',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/headphones/practice-in-privacy.webp',
                'title' => 'Don’t let anyone hear you practice.',
                'desc' => 'The <strong>closed-back design </strong>of the Pianote Headphones will keep your sound in -- and the outside world out. You can <strong>practice in complete privacy</strong> without disturbing others or having them hear you play the same thing over and over again (which is part of the process).',
            ],
            [
                'position' => 'left',
                'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/headphones/zero-latency.webp',
                'title' => 'Wired for real-time response.',
                'desc' => 'The Pianote Headphones feature a <strong>wired connection </strong>for <strong>zero-latency audio</strong>, meaning you hear the notes exactly as you play them, in real time.
                <br/><br/>And the 3.5mm jack (with 6.3mm adapter) means you can plug into ANY digital piano.',
            ],
        ];
    @endphp
    <section class="text-center px-4 py-10 sm:py-16" style="background:#F1EFED;">
        <div class="container max-w-5xl mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-4">
                <h2><strong>Studio-Quality Sound. <br> Immersive Practice. Better Results. </strong></h2>
                <h6 class="leading-relaxed my-2 sm:mb-8">
                    The Pianote Headphones deliver studio-quality sound, all-day <br class="hidden sm:inline">
                    comfort, and complete privacy for focused practice sessions.
                </h6>
            </div>
            <div class="max-w-5xl mx-auto pt-7 pb-6 md:pb-0 leading-none">
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left">
                                <h5 class="mb-2 mt-1 md:mt-0"><strong>{!! $getting['title'] !!}</strong></h5>
                                <p class="tracking-tight">{!! $getting['desc'] !!}</p>
                            </div>
                            @if (!empty($getting['special']))
                                <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                </video>
                            @else
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @endif
                        </div>
                    @else
                        <div class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if ($key !== count($gettings) - 1) mb-16 md:mb-20 @else md:mb-10 @endif">
                            @if (!empty($getting['special']))
                                <video class="-mt-7 rounded-lg" src="{{ $getting['special'] }}" type="video/mp4" autoplay muted loop>
                                </video>
                            @else
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}" alt="{{ $getting['title'] }}" />
                            @endif
                            <div class="content relative text-left md:mb-10">
                                <h5 class="mb-2 mt-1 md:mt-0"><strong>{!! $getting['title'] !!}</strong></h5>
                                <p class="tracking-tight">{!! $getting['desc'] !!}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="content-section text-center comparison px-1 lg:px-3 py-10 md:py-16" style="background:#FFFFFF;" x-data="{ tableClass: 'earbuds' }">
        <div class="container mx-auto max-w-5xl">
            <div class="container mx-auto max-w-3xl px-2">
                <h2 class="text-black"><strong>The Best Sound For Your Buck.</strong></h2>
                <h6 class="leading-normal md:leading-relaxed mb-16 md:mb-12 ">With a 45mm driver and wide frequency range, the Pianote Headphones <br class="hidden md:inline"/>deliver a richer sound across the spectrum, so you’ll catch every detail <br class="hidden md:inline"/> from the deep bass to the crisp trebles.</h6>
            </div>

            <div class="relative">
                <p class="inline md:hidden leading-none text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower pt-2"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table :class="{'earbuds': tableClass === 'earbuds', 'headphones': tableClass === 'headphones'}"  class="w-full mx-auto border-separate comparison eardrums earbuds">
                    <tbody style="background-color:transparent!important;">
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl">
                            <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/headphones/headphones-comparison-01.webp" alt="The Pianote Headphones">
                        </td>
                        <td class="rounded-t-xl" @click="tableClass = 'headphones'">
                            <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/headphones/headphones-comparison-02.webp" alt="Headphones">
                        </td>
                        <td class="rounded-t-xl" @click="tableClass = 'earbuds'">
                            <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/headphones/headphones-comparison-03.webp" alt="Headphones">
                        </td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>Closed-Back Dynamic</td>
                        <td>Closed-Back Dynamic</td>
                        <td>Closed-Back Dynamic</td>
                    </tr>
                    <tr>
                        <td>Driver Size</td>
                        <td>45mm</td>
                        <td>40mm</td>
                        <td>40mm</td>
                    </tr>
                    <tr>
                        <td>Frequency Response</td>
                        <td>10-26,000 Hz</td>
                        <td>15-20,000 Hz</td>
                        <td>8-25,000 Hz</td>
                    </tr>
                    <tr>
                        <td>Impedance</td>
                        <td>40 ohms</td>
                        <td>35 ohms</td>
                        <td>64 ohms</td>
                    </tr>
                    <tr>
                        <td>Sensitivity</td>
                        <td>98 ±3 dB</td>
                        <td>98 dB</td>
                        <td>102 dB</td>
                    </tr>
                    <tr style="background-color:transparent!important;">
                        <td class="rounded-b-xl">Total</td>
                        <td class="rounded-b-xl text-white">
                            @if(floatval($productPrices['pianote-headphones-2024']->price) > $discountedPrice)
                                 <s class="opacity-40">${{ floatval($productPrices['pianote-headphones-2024']->price) }}</s>
                                <strong>${{ $discountedPrice }}</strong>
                            @else
                                <strong>${{$discountedPrice}}</strong>
                            @endif
                        </td>
                        <td class="rounded-b-xl"><strong>$99</strong></td>
                        <td class="rounded-b-xl"><strong>$99</strong></td>
                        @php
                            @endphp
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

{{--    <section class="text-center px-6 py-8 sm:py-10 lg:py-12" style="background:#FFFFFF;">--}}
{{--    <div class="container mx-auto relative z-10 max-w-5xl">--}}
{{--       <h2 class="pb-2"><strong>What’s in the box?</strong></h2>--}}
{{--       <p class="hidden md:block pb-4">(Tap for more information.)</p>--}}
{{--       <div class="md:hidden">--}}
{{--            @php--}}
{{--                $items = [--}}
{{--                    ['title' => '1 pair of Headphones'],--}}
{{--                    ['title' => '1 Gold ¼” Adapter'],--}}
{{--                ];--}}
{{--            @endphp--}}
{{--                <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/headphones/whats-inside.webp" alt="Image 1">--}}

{{--                <ul class="list-disc text-left px-4 pb-4">--}}
{{--                @foreach ($items as $item)--}}
{{--                    <li>--}}
{{--                        <p class="py-1">{{ $item['title'] }}</p>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="hidden md:block">--}}
{{--            <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/pianote/products/headphones/whats-inside.webp" alt="Image 2">--}}
{{--            @php--}}
{{--                $infoPops = [--}}
{{--                    ['top' => '25%', 'left' => '45%', 'tip' => 'Professional Stereo Headphones'],--}}
{{--                    ['top' => '25%', 'left' => '90%', 'tip' => 'Pair of Headphones'],--}}
{{--                    ['top' => '95%', 'left' => '71%', 'tip' => '6.3mm stereo adapter'],--}}
{{--                ];--}}
{{--            @endphp--}}
{{--            @foreach ($infoPops as $infoPop)--}}
{{--                <div class="info-pop hidden sm:block cursor-pointer rounded-full w-7 h-7 flex items-center justify-center"--}}
{{--                    style="top: {{ $infoPop['top'] }}; left: {{ $infoPop['left'] }};"--}}
{{--                    tip="{{ $infoPop['tip'] }}">--}}
{{--                    <i class="fa-duotone fa-solid fa-circle-info text-xl lg:text-2xl" style="--fa-primary-color: #050505; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 0.9; --fa-secondary-box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);"></i>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

    @php
        $testimonials = [
            [
                'quote' => 'These headphones have quickly<strong> become my favorite!</strong> I love their <strong>comfortable fit</strong> and <strong>lightweight design</strong>, and the sound quality is exceptional. When I play piano, I’m <strong>hearing every detail like never before</strong> and I even find myself reaching for them when listening to music on my phone or laptop — they really <strong>make everything sound amazing!</strong>',
                'role' => 'CANADA',
                'name' => 'Tim Bondyra',
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/products/headphones/TimB.jpg'
            ],
              [
                'quote' => 'As a person with a smaller cranium, <strong>these headphones fit amazingly well</strong>! The ear pads fit perfectly around my ears and they are <strong>very comfortable to wear</strong>. Now I can play piano without external distractions and can really work on the dynamics of the song as the headphones <strong> pick up even the faintest of sounds</strong>. These are truly great headphones!!',
                'role' => 'CANADA',
                'name' => 'Megan Werry',
                'avatar' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/products/headphones/megan-headphones.jpeg'
            ],
        ];
    @endphp

    {{-- <section class="text-center px-6 pt-10 sm:pt-14 lg:pt-20 pb-32 lg:pb-40" style="background:#F1EFED;">
        <div class="container max-w-2xl mx-auto relative z-10">
            <h2 class="leading-normal pb-4 md:pb-8"><strong>Everything you love about<br class="hidden sm:inline">the Pianote headphones...</strong></h2>

            <div class="grid grid-cols-1">
                @foreach ($testimonials as $testimonial)
                    <div class="rounded-xl p-10 sm:p-4 lg:p-10 text-left h-full bg-white shadow-md flex flex-col justify-between w-10/12 sm:w-full mx-auto">
                        <h6 class="mb-4">"{{ $testimonial['quote'] }}"</h6>
                        <div class="flex items-center mt-4 border-t border-[#FFECEC] pt-2">
                            <img class="rounded-full h-14 w-14 object-cover" src="{{ $testimonial['avatar'] }}" alt="Avatar of {{ $testimonial['role'] }}">
                            <div class="ml-3">
                                <p class="leading-none pb-1"><strong>{{ $testimonial['name'] ?? '' }}</strong></p>
                                <p class="text-xs text-gray-600">{{ $testimonial['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    <section class="text-center px-6 pt-10 sm:pt-14 lg:pt-20 pb-32 lg:pb-40" style="background:#F1EFED;">
        <div class="container max-w-2xl mx-auto relative z-10">

            <div x-data x-init="
                new Splide($refs.splide, {
                    type: 'loop',
                    autoplay: true,
                    interval: 6000,
                    arrows: false,
                    pagination: false,
                }).mount();
            ">
                <div class="splide" x-ref="splide">
                    <div class="splide__track">
                        <div class="splide__list">
                            @foreach ($testimonials as $testimonial)
                                <div class="splide__slide">
                                    <div class="text-center flex flex-row">
                                        <img class="h-4 md:h-8 pr-4" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/lead-gen/getting-started/quotation-icon.svg">
                                        <div class="text-left">
                                            <h3 class="leading-snug">{!! $testimonial['quote'] !!}</h3>
                                            <div class="flex items-center mt-4">
                                                <img class="rounded-full h-20 w-20 object-cover" src="{{ $testimonial['avatar'] }}" alt="Avatar of  @if (!empty($testimonial['role'])){{ $testimonial['role'] }}@endif">
                                                <div class="ml-3">
                                                    @if (!empty($testimonial['name']))
                                                        <h6 class="leading-none pb-1"><strong>{{ $testimonial['name'] }}</strong></h6>
                                                    @endif
                                                    @if (!empty($testimonial['role']))
                                                        <p class="text-xs text-gray-600">{{ $testimonial['role'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #111729 calc(50% + 1px));">
    </div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#111729;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/headphones/guarantee-logo.svg"
                alt="guarantee badge">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>The Pianote<br class="inline sm:hidden"> Guarantee.</strong></h2>

            <h6 class="leading-normal"><strong>You’ll be protected for 2 years. So you can focus on what’s most important - playing piano.</strong>

                <br><br>
                We’ve designed these headphones with your piano practice in mind, and we’re confident you’ll love them.
                <br><br>
                But if anything goes wrong, you’ll have the peace of mind that comes with knowing your headphones are protected for two full years.
                <br><br>
                So you can focus on your piano playing.
                <br><br>
                We’ll worry about the rest.

            </h6>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-3xl">
            <img alt="quietkick logo" class="h-16 sm:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/headphones/logo-black.webp"><br>
            <h6 class="leading-tight mt-4 mb-2">Superior Sound, Comfort, and Privacy for <br class="sm:hidden">Piano Players.</h6>
            @if( $products['pianote-headphones-2024']->getStockAvailability() > 1 && !empty($products['pianote-headphones-2024']->getStockAvailability()))
                <div class="flex flex-wrap items-start justify-center mx-auto my-5 sm:my-8">
                    @php
                        $originalPrice = $productPrices['pianote-headphones-2024']->price;
                        $discountedPrice = $productPrices['pianote-headphones-2024']->discounted_price;
                        $difference = $originalPrice - $discountedPrice;
                        $percentage = $originalPrice > 0 ? ($difference / $originalPrice) * 100 : 0;
                        $badge = $difference > 0 ? 'SAVE ' . number_format($percentage) . '%' : '';
                    @endphp

                    @include('drumeo.products.partials._order-card', [
                        'badge' => $badge,
                        'header' => 'Pianote Headphones',
                        'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/headphones/order.webp',
                        'imageHeight' => 'h-28 lg:h-32',
                        'fullPrice' => "$" . floatval($productPrices['pianote-headphones-2024']->price),
                        'price' => "$" . floatval($productPrices['pianote-headphones-2024']->discounted_price),
                        'specialText' => 'One-time payment.',
                        'cta' => 'SELECT',
                        'link' => '/ecommerce/add-to-cart?products[pianote-headphones-2024]=1',
                        'bonuses' => [
                            '<strong>1 Pair of Pianote Headphones</strong>',
                            '1.8m cable',
                            '6.3mm stereo adapter',
                        ],
                    ])
                    @include('drumeo.products.partials._order-card', [
                       'firstOnMobile' => true,
                       'highlightBorder' => true,
                       'badge' => 'LAUNCH SPECIAL',
                       'header' => 'Headphones + 1 Year<br>Pianote Membership',
                       'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/headphones/order-bundle.webp',
                       'imageHeight' => 'h-28 lg:h-32',
                       'price' => '<span class="text-2xl md:text-3xl">Free Headphones</span>',
                       'specialText' => 'With Annual Membership of $240/yr',
                       'cta' => 'SELECT',
                       'link' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-headphones-2024]=1&promo-code=headphones-annual&locked=true',
                       'bonuses' => [
                           '<strong>Everything included with the<br>Headphones PLUS:</strong>',
                           'Step-by-Step Lessons',
                           'Personalized Support',
                           'Song Tutorials',
                           'World-Class Instructors',
                       ],
                   ])
                </div>
            @else
                <a class="join sold-out my-7"  @click="waitlistModal = true;">JOIN WAITLIST</a>
            @endif
        </div>
        <h6 class="uppercase mt-6"><strong>For hygienic reasons all <br class="inline sm:hidden"> HEADPHONE sales are final.</strong></h6>

    </section>

    {{-- <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-white">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-white" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section> --}}

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '1018435070',
        'vimeo' => true,
    ])
    {{-- @include('_partials.components.video-modal',[
        'name' => 'trailerM',
        'video' => '1018435070',
        'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
    ]) --}}

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
