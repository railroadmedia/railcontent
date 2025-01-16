@php
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data-2024.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Prima @if(!empty($ultimate)) Ultimate Bundle @elseif(!empty($lifetime)) Keyboard @else Bundle @endif | Pianote</title>
    <meta property="og:title" content="Prima | Pianote">

    <meta name="description" content="Everything you need to start playing the piano. ">
    <meta property="og:description" content="Everything you need to start playing the piano. ">
    @php
            $shareImage = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/prima/share-image.jpg';
              $orderUrl = '#customize-anchor';
    @endphp

    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .join, .join.smaller {
            background: #F61A30;
            border-color: #F61A30;
        }
        .join:hover, .join:focus,
        .join.smaller:focus, .join.smaller:hover {
            background: #F61A30;
            filter: brightness(125%);
            box-shadow: 0 0 7px hsla(0, 0%, 0%, 0.35);
        }
        .join.musora, .join.musora:hover {
            background-color: #FFAE00;
            border-color: #FFAE00;
            color: #000;
        }
        .join.outline.red {
            border-color: #F61A30;
            color: #0b76db;
        }

        .join.smaller.outline {
            padding: 12px 7%;
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
        .prima-piano-next svg {
            fill: #F61A30;
        }
    </style>
    <style>
        table.comparison.eardrums tr td:nth-child(1) {
            width: 1%;
            font-weight: 700;
            text-align: center;
        }

        table.comparison.eardrums tr td:nth-child(2) {
            color: white;
            background: linear-gradient(to right, #D14037, #8A230F) !important;
            font-weight:600;
        }

        table.comparison.eardrums tr:nth-child(1) td {
            font-weight:600;
            border-bottom:2px solid #fff;
            font-size:20px;

        }
        table.comparison.eardrums tr:nth-child(1) td:nth-child(2) {
            background: linear-gradient(to right, #D14037, #8A230F) !important;
        }

        table.comparison.eardrums tr td:nth-child(1) {
            width: 20%;
        }
        table.comparison.eardrums tr td:nth-child(2),
        table.comparison.eardrums tr td:nth-child(3),
        table.comparison.eardrums tr td:nth-child(4),
        table.comparison.eardrums tr td:nth-child(5) {
            width: 20%;
        }

        table.comparison.eardrums tr td:nth-child(1),
        table.comparison.eardrums tr td:nth-child(3),
        table.comparison.eardrums tr td:nth-child(4),
        table.comparison.eardrums tr td:nth-child(5) {
            color: #2F2F2F;
            background-color:rgba(244, 245, 249, 0.8);
        }

        table.comparison.eardrums tr:nth-child(1) td:nth-child(1),
        table.comparison.eardrums tr:nth-child(1) td:nth-child(3),
        table.comparison.eardrums tr:nth-child(1) td:nth-child(4),
        table.comparison.eardrums tr:nth-child(1) td:nth-child(5) {
            background-color:rgba(237, 238, 242, 0.8);
        }

        table.comparison tr:hover td:nth-child(1),
        table.comparison tr:hover td:nth-child(3),
        table.comparison tr:hover td:nth-child(4),
        table.comparison tr:hover td:nth-child(5),
        table.comparison tr:nth-child(2n):hover td:nth-child(3),
        table.comparison tr:nth-child(2n):hover td:nth-child(4),
        table.comparison tr:nth-child(2n):hover td:nth-child(5) {
            background-color:rgba(240, 241, 245, 0.8);
        }

        table.comparison tr:hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2),
        table.comparison tr:nth-child(2n):hover td:nth-child(2) {
            background-color: #BD0013;
        }

        table.comparison.eardrums tr:hover td:nth-child(2) {
            filter: brightness(1.2);
        }

        table.comparison.eardrums tr td {
            color: black;
            padding: 15px 7px;
            font-size: 12px;
            text-transform: capitalize;
        }

        table.comparison.eardrums tr:last-child td {
            padding: 15px 7px 30px;
        }

        @media (min-width: 768px) {
            table.comparison.eardrums tr td {
                font-size: 16px;
            }
            table.comparison.eardrums tr:nth-child(2n) td strong {
                font-size: 28px;
                color: #2F2F2F;
            }
            table.comparison.eardrums tr:nth-child(2n) td:nth-child(2) strong {
                color: white;
            }
            table.comparison.eardrums tr:last-child td strong {
                font-size: 24px;
            }
        }

        table.comparison.eardrums tr td:nth-child(1) {
            text-transform: capitalize;
        }

        @media (max-width: 767px) {

            .roland tr td:nth-child(3) {
                display: table-cell;
            }

            .roland tr td:nth-child(4),
            .roland tr td:nth-child(5) {
                display: none;
            }

            .yamaha tr td:nth-child(4) {
                display: table-cell;
            }

            .yamaha tr td:nth-child(3),
            .yamaha tr td:nth-child(5) {
                display: none;
            }

            .casio tr td:nth-child(5) {
                display: table-cell;
            }

            .casio tr td:nth-child(3),
            .casio tr td:nth-child(4) {
                display: none;
            }
        }

        table.comparison {
            border-spacing: 0;
            cursor: pointer;
        }
    </style>
@stop

@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')
    @include("pianote.sales.partials._nav", [
        "cartVersion" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color: #020B16;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container max-w-6xl mx-auto relative z-20">

                    <img class="h-6 md:h-10 my-2 block mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/200x0/filters:quality(95)/marketing/pianote/products/prima/Logo.webp">
                    <h1 class="relative w-auto leading-tight">
                        A digital piano  <br class="block sm:hidden"><u style="text-decoration-color: #F61A30;"><strong>made for beginners</strong></u>.
                    </h1>
                    <h4 class="relative w-auto leading-tight mt-3 mb-4 sm:mb-6">Everything you need in a first piano,  <br class="block sm:hidden">without the expensive price tag.</h4>
                    <h2 class="leading-tight inline-block">Only <span class="relative inline-block leading-none text-gray-300"><strong>$599</strong><img class="absolute z-10 inset-0 object-cover mt-2" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/v2/strike.png"> </span> </h2>
                    <h1 class="leading-tight mt-6 inline-block"><strong> $449</strong></h1>
                <h6 class="leading-tight mt-1 mb-7 sm:mb-10"><em>Free worldwide shipping.</em></h6>

                <div class="w-full max-w-xl mx-auto">
                    <a class="w-full sm:w-5/12 join sold-out smaller text-white bg-pianote my-2 sm:m-2 hover:bg-red-500"
                        href="{{ $orderUrl }}"
                    >START PLAYING</a>
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block bg-transparent hover:bg-white hover:text-black"
                        @click="trailer = true;">
                        &nbsp;Watch The Trailer
                    </div>
                    <div class="w-full sm:w-5/12 join smaller outline sm:hidden inline-block bg-transparent hover:bg-white hover:text-black"
                        x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false" @click="trailer = true;">
                        &nbsp;Watch The Trailer
                    </div>
                </div>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0, 0, 0, 0.5)"></div>
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/header.mp4"></video>
    </header>

    <section class="py-12 lg:py-20 px-4 sm:px-6 lg:px-10 text-center" style="background:#f1efed;">
        <div class="max-w-5xl mx-auto flex flex-col-reverse md:flex-row items-center md:gap-8 pt-6">
            <div class="w-full lg:w-7/12 text-left lg:px-6 leading-normal">
                <h2 class="leading-tight mb-2"><strong>Your <span class="text-pianote">perfect</span> first piano.</strong></h2>
                <p class="mb-6">Choosing your first piano can be overwhelming. So we’ve made it simple.</p>

                <p class="mb-4 border-l-4 border-pianote pl-4">The Pianote Prima is a full-size 88-key piano that feels and sounds like a real piano.</p>
                <p class="mb-4 border-l-4 border-pianote pl-4">It has everything you need in a beginner instrument including beautiful sounds, stereo speakers, and Bluetooth.</p>
                <p class="mb-6 border-l-4 border-pianote pl-4">But we’ve left out all the “extras” that only increase complexity and drive up the price.</p>

                <p>That’s what makes it the <strong>best</strong> beginner digital piano.</p>
            </div>

            <div class="flex-shrink-0 w-full sm:w-10/12 lg:w-5/12 flex justify-center items-center md:py-6">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/1100x0/filters:quality(95)/marketing/pianote/products/prima/v2/playing-keyboard.jpg"
                    alt="Laptop Preview"
                    class="w-full h-auto object-contain rounded-xl"
                >
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background: #FFF;"
    >
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-7 sm:mb-12">Premium Features. <strong>Beginner Price.</strong></h2>
            <img
                src="https://d21q7xesnoiieh.cloudfront.net/2050x0/filters:quality(95)/marketing/pianote/products/prima/v2/arrows.png"
                alt="Laptop Preview"
                class="w-full h-auto mb-5"
            >
            @php
                $items = [
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature1.mp4',
                    'title' => 'Keys that feel like a real piano',
                    'desc' => 'You’ll feel like you’re playing a real piano when you press the Prima’s fully-weighted keys. You’ll build strength and dexterity in your fingers, and be able to play more expressively across the full keyboard.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature2.mp4',
                    'title' => 'Play along to your favorite songs',
                    'desc' => 'The Prima’s Bluetooth connectivity lets you seamlessly mix your playing to any device. Play along with your favorite songs or connect to your Pianote lessons for a truly immersive learning experience.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature3.mp4',

                    'title' => 'Beautiful piano sounds. And so many more',
                    'desc' => 'With 238 different tones, from classic grand pianos to strings, organs, and more, the Prima gives you endless options for creativity. The variety will keep you inspired and motivated to practice.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature4.mp4',
                    'title' => 'Hear every note in full, rich detail',
                    'desc' => 'The Prima’s built-in stereo speakers deliver clear, balanced sound, making it easy to hear every detail as you practice. And the stereo headphone jack ensures you can practice privately without sacrificing sound quality.',
                    ],
                    [
                    'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/prima/video-features/feature5.mp4',
                    'title' => 'Feels good under your feet',
                    'desc' => 'Unlike the cheap plastic pedals that come with many beginner digital pianos, the Prima features a premium sustain pedal that feels just like a real acoustic piano pedal. You’ll feel the difference immediately.',
                    ],
                ];
            @endphp
           @foreach ($items as $index => $item)
            <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                @if ($index % 2 == 0)
                    <video class="w-full sm:w-6/12 lg:w-1/2 rounded-xl order-1 sm:order-1" src="{{ $item['video'] }}" type="video/mp4" autoplay muted loop>
                    </video>
                @else
                    <video class="w-full sm:w-6/12 lg:w-1/2 rounded-xl order-1 sm:order-2" src="{{ $item['video'] }}" type="video/mp4" autoplay muted loop>
                    </video>
                @endif

                <div class="flex flex-row md:flex-col sm:flex-1 justify-center items-start py-4 {{ $index % 2 == 0 ? 'sm:pl-4 md:pl-10' : 'sm:pr-4 md:pr-10' }} order-2 sm:order-1">
                    <div>
                        <h6 class="leading-tight mx-0 my-2 sm:my-4"><strong>{{ $item['title'] }}</strong></h6>
                        <p class="leading-normal max-w-xl">{!! $item['desc'] !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <a href="#customize-anchor" class="join smaller w-full sm:w-5/12 mx-auto mt-6 sm:mt-10 anchor-slide">Start Playing</a>

        </div>
    </section>

    <section class="py-12 lg:py-20 px-4 sm:px-6 lg:px-10 text-center text-white" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/prima/v2/chart-bg.jpg');" x-data="{ tableClass: 'roland' }">
        <div class="container mx-auto max-w-6xl">
            <h2 class="leading-tight">How does the <strong>Pianote Prima</strong> stack up?</h2>
            <p class="leading-tight mb-12 mt-3 sm:mt-5 sm:mb-12">Add the essential practice tools you need for the ultimate home practice space.</p>
            <div class="relative">
                <p class="inline md:hidden leading-none text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower pt-2"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <div class="overflow-hidden rounded-xl">
                    <table :class="{'roland': tableClass === 'roland', 'yamaha': tableClass === 'yamaha', 'casio': tableClass === 'casio'}"  class="w-full mx-auto border-separate comparison eardrums roland">
                        <tbody style="background-color:transparent!important;">
                        <tr style="background-color:transparent!important;">
                            <td></td>
                            <td>
                                Pianote Prima
                            </td>
                            <td @click="tableClass = 'yamaha'">
                                Roland FP-10
                            </td>
                            <td @click="tableClass = 'casio'">
                                Yamaha P-45
                            </td>
                            <td @click="tableClass = 'roland'">
                                Casio CDP-S160
                            </td>
                        </tr>
                        <tr>
                            <td>88-Key Weighted Action</td>
                            <td>Progressive Hammer Action</td>
                            <td>PHA-4 Action</td>
                            <td>Graded Hammer Action</td>
                            <td>Scaled Hammer Action II</td>
                        </tr>
                        <tr>
                            <td>Number of Tones</td>
                            <td>238</td>
                            <td>15</td>
                            <td>10</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>Built-In Speakers</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Bluetooth</td>
                            <td>Audio + MIDI</td>
                            <td>MIDI Only</td>
                            <td>None</td>
                            <td>None</td>
                        </tr>
                        <tr>
                            <td>Universal Power Cord</td>
                            <td>Yes, with Adapters Included</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>Sustain Pedal</td>
                            <td>Premium Piano-Like Pedal</td>
                            <td>Basic Footswitch</td>
                            <td>Basic Footswitch</td>
                            <td>Basic Footswitch</td>
                        </tr>
                        <tr>
                            <td>Connectivity</td>
                            <td>Bluetooth, USB MIDI, Stereo Headphones</td>
                            <td>USB MIDI, Single Headphone Jack</td>
                            <td>USB MIDI, Single Headphone Jack</td>
                            <td>USB MIDI, Single Headphone Jack</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr class="overflow-hidden" style="background-color:transparent!important;">
                            <td>Price</td>
                            <td class="text-white"><strong>$449</strong></td>
                            <td><strong>$499.99</strong></td>
                            <td><strong>$399.99</strong></td>
                            <td><strong>$479.99</strong></td>
                            @php
                                @endphp
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20  relative">
            <div class="container mx-auto z-10 relative max-w-5xl">
                <h2 class="leading-tight"><strong>Complete the setup.</strong></h2>
                <p class="leading-tight my-5">Add the essential practice tools you need for the ultimate home practice space.</p>
                <img class="w-full max-w-5xl rounded-xl px-2" src="https://d21q7xesnoiieh.cloudfront.net/1200x0/filters:quality(95)/marketing/pianote/products/prima/setup-01.webp">
                <div class="flex flex-wrap text-left pt-4">
                    <div class="w-full sm:w-1/2 px-2">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/setup-02.webp">
                        <h6 class="pt-4"><strong>The Prima Keyboard Stand</strong></h6>
                        <p class="lg:pr-6">This double braced "X" style keyboard stand is lightweight but very strong.<br><br>Adjusting this stand to the perfect height is easy, thanks to the trigger style latch- you can do it with a single finger!</p>
                    </div>
                    <div class="w-full sm:w-1/2 px-2">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/setup-03.webp">
                        <h6 class="pt-4"><strong>The Prima Bench</strong></h6>
                        <p class="lg:pr-6">This compact heavy duty bench is comfortable, adjustable and portable.<br><br>It folds flat for storage or transport, and is height adjustable to help you find that perfect position for practice and performance!</p>
                    </div>
                </div>
                @if (!empty($ultimate))
                <div class="flex flex-wrap text-left">
                    <div class="w-full sm:w-1/2 px-2 pt-4">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/setup-04.webp">
                        <h6 class="pt-4"><strong>The Pianote Metronome</strong></h6>
                        <p class="lg:pr-6">Develop your rhythm, timing, and coordination with this beautiful compact metronome made in Germany by Wittner.<br><br>It’s the most important practice tool you’ll ever have. Work on your tempo, rhythm, and speed with a metronome you can trust.</p>
                    </div>
                    <div class="w-full sm:w-1/2 px-2 pt-4">
                        <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/marketing/pianote/products/prima/bundle/setup-05.webp">
                        <h6 class="pt-4"><strong>The Music Theory Poster Bundle</strong></h6>
                        <p class="lg:pr-6">Connecting what you see on a page to the keys can feel like a giant leap.<br><br>That’s why we’ve made it easy with 6 beautiful full-color posters highlighting the essential theory you need to play the songs you love.</p>
                    </div>
                </div>
                @endif
            </div>
        </section>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative text-white"
    style="background:linear-gradient(to bottom, #F61A30, #900F1C);">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h2 class="leading-tight"><strong>Peace of mind - guaranteed.</strong></h2>
            <p class="leading-tight mt-2 mb-5 sm:mb-7">Your piano includes a 2-year parts warranty for your Prima.</p>
            <picture>
                <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1270x0/filters:quality(95)/marketing/pianote/products/prima/warranty.webp">
                <img class="transition-opacity opacity-0 h-20 sm:h-36" alt="icon" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/pianote/products/prima/warranty.webp">
            </picture>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-6xl">
            <div class="flex flex-wrap items-start justify-center mx-auto my-5 sm:my-8 lifetime-card">
                @include('drumeo.products.partials._order-card', [
                    'customStrike' => true,
                    'threeWide' => true,
                    'header' => 'The Pianote PRIMA',
                    'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/prima/order-01.webp',
                    'imageHeight' => 'h-24 lg:h-16 px-4',
                    'fullPrice' => "$599",
                    'price' => "$449",
                    'specialText' => 'Save $150.<br> FREE worldwide shipping.',
                    'cta' => 'BUY NOW',
                    'link' => '/ecommerce/add-to-cart?products[prima-keyboard]=1',
                    'bonuses' => [
                        '<i class="fas fa-check text-pianote mr-1"></i> The Pianote Prima',
                        '<i class="fas fa-check text-pianote mr-1"></i> 88-key Progressive Lever Hammer Action',
                        '<i class="fas fa-check text-pianote mr-1"></i> Stereo Speakers',
                        '<i class="fas fa-check text-pianote mr-1"></i> Double Headphone Jack',
                        '<i class="fas fa-check text-pianote mr-1"></i> Bluetooth Connectivity',
                        '<i class="fas fa-check text-pianote mr-1"></i> 4 Built-in Metronomes',
                        '<i class="fas fa-check text-pianote mr-1"></i> 238 Built-in Sounds',
                        '<i class="fas fa-check text-pianote mr-1"></i> True Piano Sustain Pedal',
                        '<i class="fas fa-check text-pianote mr-1"></i> Music Stand Included',
                        '<i class="fas fa-check text-pianote mr-1"></i> USB MIDI and Audio In/Out',
                    ],
                ])
                @include('drumeo.products.partials._order-card', [
                    'highlightBorder' => true,
                    'customStrike' => true,
                    'threeWide' => true,
                   'badge' => 'BEST DEAL',
                   'firstOnMobile' => true,
                   'header' => 'Add a Bench & Stand',
                   'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/prima/order-02.webp',
                   'imageHeight' => 'h-24 lg:h-16',
                    'fullPrice' => "$749",
                    'price' => "$549",
                    'specialText' => 'Save $200.<br> FREE worldwide shipping.',
                   'cta' => 'BUY NOW',
                   'highlightBorder' => true,
                   'link' => '/ecommerce/add-to-cart?products[prima-keyboard]=1&products[piano-bench]=1',
                    'bonuses' => [
                    '<i class="fas fa-check text-pianote mr-1"></i> The Pianote Prima',
                    '<i class="fas fa-check text-pianote mr-1"></i> 88-key Progressive Lever Hammer Action',
                    '<i class="fas fa-check text-pianote mr-1"></i> Stereo Speakers',
                    '<i class="fas fa-check text-pianote mr-1"></i> Double Headphone Jack',
                    '<i class="fas fa-check text-pianote mr-1"></i> Bluetooth Connectivity',
                    '<i class="fas fa-check text-pianote mr-1"></i> 4 Built-in Metronomes',
                    '<i class="fas fa-check text-pianote mr-1"></i> 238 Built-in Sounds',
                    '<i class="fas fa-check text-pianote mr-1"></i> True Piano Sustain Pedal',
                    '<i class="fas fa-check text-pianote mr-1"></i> Music Stand Included',
                    '<i class="fas fa-check text-pianote mr-1"></i> USB MIDI and Audio In/Out',
                    '<span class="text-pianote"><i class="fas fa-check text-pianote mr-1"></i> Prima Keyboard Stand</span>',
                    '<span class="text-pianote"><i class="fas fa-check text-pianote mr-1"></i> Prima Piano Bench</span>',
                ],
               ])
                @include('drumeo.products.partials._order-card', [
                    'customStrike' => true,
                    'threeWide' => true,
                   'firstOnMobile' => true,
                   'header' => 'get it ALL',
                   'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/pianote/products/prima/order-02.webp',
                   'imageHeight' => 'h-24 lg:h-16',
                    'fullPrice' => "$848",
                    'price' => "$649",
                    'specialText' => 'Save $199.<br> FREE worldwide shipping.',
                   'cta' => 'BUY NOW',
                   'link' => '/ecommerce/add-to-cart?products[prima-keyboard]=1&products[piano-bench]=1&products[pianote-headphones-2024]=1',
                    'bonuses' => [
                    '<i class="fas fa-check text-pianote mr-1"></i> The Pianote Prima',
                    '<i class="fas fa-check text-pianote mr-1"></i> 88-key Progressive Lever Hammer Action',
                    '<i class="fas fa-check text-pianote mr-1"></i> Stereo Speakers',
                    '<i class="fas fa-check text-pianote mr-1"></i> Double Headphone Jack',
                    '<i class="fas fa-check text-pianote mr-1"></i> Bluetooth Connectivity',
                    '<i class="fas fa-check text-pianote mr-1"></i> 4 Built-in Metronomes',
                    '<i class="fas fa-check text-pianote mr-1"></i> 238 Built-in Sounds',
                    '<i class="fas fa-check text-pianote mr-1"></i> True Piano Sustain Pedal',
                    '<i class="fas fa-check text-pianote mr-1"></i> Music Stand Included',
                    '<i class="fas fa-check text-pianote mr-1"></i> USB MIDI and Audio In/Out',
                    '<span class="text-pianote"><i class="fas fa-check text-pianote mr-1"></i> Prima Keyboard Stand</span>',
                    '<span class="text-pianote"><i class="fas fa-check text-pianote mr-1"></i> Prima Piano Bench</span>',
                    '<span class="text-pianote"><i class="fas fa-check text-pianote mr-1"></i> Pianote Headphones</span>',
                ],
               ])
            </div>
            <p class="leading-tight">Already have a piano? <a href="/ecommerce/add-to-cart?products[piano-bench]=1"><u>Grab the Stand & Bench for just $109 (Free worldwide shipping).</u></a></p>
        </div>
    </section>

    <section class="text-center py-10" style="background: #00101D;">
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
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '1032522905',
        'vimeo' => true,
    ])

    @include("pianote.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
