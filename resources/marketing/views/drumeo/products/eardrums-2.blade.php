@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Drumeo EarDrums 2</title>
    <meta property="og:title" content="Drumeo EarDrums 2">
    <meta name="description" content="Protect your ears + play your favorite songs.">
    <meta property="og:description" content="Protect your ears + play your favorite songs.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">

    <style>
        @keyframes fadeEffect {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
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

        table.comparison.eardrums tr td:nth-child(1),
        table.comparison.eardrums tr td:nth-child(2),
        table.comparison.eardrums tr td:nth-child(3),
        table.comparison.eardrums tr td:nth-child(4) {
            width: 25%;
        }
        @media (min-width: 768px) {
            table.comparison.eardrums tr td:nth-child(1),
            table.comparison.eardrums tr td:nth-child(2),
            table.comparison.eardrums tr td:nth-child(3),
            table.comparison.eardrums tr td:nth-child(4) {
                width: 26%;
            }
        }
        table.comparison.eardrums tr td {
            padding:15px 7px;
            font-size:12px;
            text-transform:uppercase;

        }
        @media (min-width: 768px) {
            table.comparison.eardrums tr td {
                font-size:16px;
            }
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

    </style>
@stop()

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner', [
        "name" => "Drumeo EarDrums",
        "fullPrice" => floatval($productPrices['drumeo-eardrums']->price),
        "price" => floatval($productPrices['drumeo-eardrums']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-16 sm:h-24" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png"><br>
                <h6 class="leading-tight my-3">Protect your ears + <br class="sm:hidden">play your favorite songs.</h6>
                <h2 class="leading-tight">
                    @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['stickbag']->price) }}</s>
                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                        <em class="text-musora text-sm">(Save {{ round(100 - (100 * (floatval($productPrices['stickbag']->discounted_price) / floatval($productPrices['stickbag']->price)))) }}%)</em>
                    @else
                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                    @endif
                </h2>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block"   @click="trailerM = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    @if( $products['stickbag']->getStockAvailability() > 1 && !empty($products['stickbag']->getStockAvailability()))
                        <a class="w-5/12 join smaller blue" href="#customize-anchor">Order Now</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                </div>
                {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6>--}}
            </div>
        </div>
{{--        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>--}}
        <img class="object-cover w-full h-full relative z-0" src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header.jpg">
{{--        <video class="object-cover w-full relative z-0" style="height: 600px;" type="video/mp4" autoplay loop playsinline muted--}}
{{--            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header.jpg"></video>--}}
    </header>

    <section class="text-center px-5 sm:px-2 py-10 sm:py-12 lg:py-14" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <img class="h-14 sm:h-20 -mt-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/whats-new.webp" alt="Whats New">
            <h6 class="leading-normal mt-4 mb-7 sm:mb-10">The Drumeo EarDrums have helped 15,000 drummers protect their ears and play <br class="hidden sm:inline">
                their favorite songs. We took your feedback and made a classic even better:</h6>
            <div class="flex flex-wrap sm:flex-nowrap text-left">
                <div class="w-full sm:w-1/4 px-2 lg:px-3 mb-4 sm:mb-0">
                    <img class="rounded-xl h-56 sm:h-44 lg:h-56 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/features-01.webp">
                    <h5 class="leading-tight mt-4 mb-2"><strong>Better Connections.</strong></h5>
                    <p>An upgraded 2-pin cable connection guarantees you can hear your music in any situation.</p>
                </div>
                <div class="w-full sm:w-1/4 px-2 lg:px-3 mb-4 sm:mb-0">
                    <img class="rounded-xl h-56 sm:h-44 lg:h-56 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/features-04.webp">
                    <h5 class="leading-tight mt-4 mb-2"><strong>Miniature Road Case.</strong></h5>
                    <p>The big little upgrade. Your EarDrums now include a custom miniature road case – built to take anything you (accidentally) throw at it.</p>
                </div>
                <div class="w-full sm:w-1/4 px-2 lg:px-3 mb-4 sm:mb-0">
                    <img class="rounded-xl h-56 sm:h-44 lg:h-56 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/features-02.webp">
                    <h5 class="leading-tight mt-4 mb-2"><strong>Extra Cable.</strong></h5>
                    <p>You’ll also be covered with a backup braided cable – keep it in your travel bag or at your kit to save you mid-show.</p>
                </div>
                <div class="w-full sm:w-1/4 px-2 lg:px-3">
                    <img class="rounded-xl h-56 sm:h-44 lg:h-56 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/features-03.webp">
                    <h5 class="leading-tight mt-4 mb-2"><strong>Back In Black.</strong></h5>
                    <p>You’ll look like a pro wearing in-ear monitors in all-new triple black – the official color of touring drummers everywhere.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-0 py-10 sm:py-16 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-14 sm:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/840x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/drums-are-loud.webp" alt="Drums Are Loud">
            <h6 class="leading-normal mt-5 mb-7 sm:mb-10 mx-auto max-w-xl">
                Whether you’re playing acoustic or electronic drums, sealing in the sound while protecting your ears is crucial. <br class="sm:hidden"><br class="sm:hidden"><strong>Drumeo EarDRUMS are professional in-ear headphones that help you:</strong></h6>
            <div class="flex flex-wrap text-left">
                <div class="flex flex-wrap sm:flex-nowrap items-center mb-7 sm:mb-10">
                    <img class="h-48 sm:h-72 sm:order-1 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/970x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/current-feature-01.webp">
                    <div class="sm:px-4 lg:px-10">
                        <h4 class="leading-tight my-2"><strong>Catch every detail.</strong></h4>
                        <p>Triple driver headphones (that means 3 tiny speakers) give you a full range of sound -- from low kick drums to high cymbal shots.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center mb-7 sm:mb-10">
                    <img class="h-48 sm:h-72 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/970x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/current-feature-02.webp">
                    <div class="sm:px-4 lg:px-10">
                        <h4 class="leading-tight my-2"><strong>Seal in the sound.</strong></h4>
                        <p>Drumeo EarDRUMS reduce external volume by up to -29dB. That means you can play hard while protecting your ears.</p>
                    </div>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap items-center">
                    <img class="h-48 sm:h-72 sm:order-1 rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/970x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/current-feature-03.webp">
                    <div class="sm:px-4 lg:px-10">
                        <h4 class="leading-tight my-2"><strong>Go anywhere.</strong></h4>
                        <p>Your EarDRUMS are meant to be used. Take them anywhere with a handy carrying case + extra tips for a perfect fit every time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center text-white px-5 sm:px-10 py-8 sm:py-12 lg:py-24 relative" style="background-color:#111729;">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <div class="w-11/12 sm:w-7/12 lg:w-1/2 text-left">
                <img class="h-20 sm:h-24 lg:h-32 mb-2 sm:mb-5 lg:mb-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/not-for-the-pros.webp" alt="Not just for the pros">

                <p class="leading-normal">You don’t need to be an arena drummer to use in-ear monitors.
                    <br><br>
                    In fact, with more and more drummers using e-kits and taking lessons online, in-ear monitors have become a go-to practice tool for drummers of ALL skill levels.
                    <br><br>
                    By reducing volume by up to -29db, in-ear monitors will save your ears from ambient drum noise AND allow you to listen to your music quieter.</p>
            </div>
        </div>
        <img class="absolute inset-0 z-0 w-full h-full object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-stage.webp"
        style="object-position: 55% 50%;">
        <img class="absolute inset-0 z-0 w-full h-full object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/pro-section-living-room.webp"
        style="object-position: 55% 50%;opacity: 0; animation-delay: 5s; animation: fadeEffect 5s infinite ease-in-out;">
    </section>
    <section class="text-center px-5 sm:px-10 py-10 sm:py-16 lg:py-20 text-white" style="background-color:#111729;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h3 class="leading-tight"><strong>Everything you love about<br> the original EarDrums…</strong></h3>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-black my-7 sm:my-10">
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“I have really small ears and I am REALLY picky about sound.”</h6>
{{--                    <p class="my-4 sm:my-6">I have to say I was doubtful. I have some more expensive in-ear monitors and I have really small ears and I am REALLY picky about sound. I was 100% blown away – deep rich bass response, nice clear mids and highs and amazing fit, and best of all no ear fatigue! I was also pleasantly surprised at the nice compact package that fits into a pocket or purse to take with me and keep things all in one place. Lots of selection for ear tips and a nice cleaner all part of the package for an amazing price.  If I had listened to the sound alone I would have expected them to cost a lot more than they do. I use mine every day and recommend them to everyone I talk to!</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/360053_1646349286211-1646349288-360053.jpg" alt="Joy B">
                        <p class="leading-none mx-0 pl-4"><strong>Joy B</strong><br>
                            <span>Toronto</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“No more harsh-sounding headphones for drumming.”</h6>
{{--                    <p class="my-4 sm:my-6">I’ve been rocking EarDrums and like them. It’s great to have a lot of low end without having the bass or kick drum get muddy. They are very comfortable and I enjoy them. No more harsh-sounding headphones for drumming – and no more guessing where the bassist is going! I also like the high-end roll-off – this prevents listening fatigue AND protects your hearing if you like to listen loudly. </p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/398228_1648758391036-1648758395-398228.jpg" alt="Lauri V">
                        <p class="leading-none mx-0 pl-4"><strong>Lauri V.</strong><br>
                            <span>Finland</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“Definitely felt the Drumeo in-ears are a step up.”</h6>
{{--                    <p class="my-4 sm:my-6">I used these in a show the other night for the first time and really enjoyed them! Definitely felt the Drumeo in-ears are a step up from the KZ Pro 10s. The sound quality is competitive with KZs, but Drumeo in-ears are much more comfortable to me.</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/IMG_3193.jpg" alt="David G">
                        <p class="leading-none mx-0 pl-4"><strong>David G</strong><br>
                            <span>Mississippi</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h6 class="leading-normal">“The isolation tips do a good job of cutting sound while still comfy.”</h6>
{{--                    <p class="my-4 sm:my-6">I love these things! Great sound and a good selection of tips for various needs/uses. The isolation tips do a good job of cutting sound while still comfy. Not only great for drum monitoring but all around music enjoyment.</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Rick_profile.jpg" alt="Rick">
                        <p class="leading-none mx-0 pl-4"><strong>Rick</strong><br>
                            <span>Oregon</span>
                        </p>
                    </div>
                </div>
            </div>
            <h4 class="leading-tight"><strong>and more.</strong></h4>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-16">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>Find your fit.</strong></h1>
            <h6 class="leading-normal mt-3 mb-7 sm:mb-10 mx-auto max-w-2xl">A perfect seal is critical. That’s why your EarDrums include 9 different fits across 3 different configurations. From expanding memory foam to double-layer silicon, you can find the perfect fit for your ears.</h6>
            <div class="flex">
                <div class="w-1/3 px-1 sm:px-3">
                    <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/triple-layer2.webp">
                    <h6 class="leading-tight mt-4 mb-2"><strong>Triple-layer</strong></h6>
                    <p class="leading-tight"><em>3 sizes included.</em></p>
                </div>
                <div class="w-1/3 px-1 sm:px-3">
                    <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/double-layer2.webp">
                    <h6 class="leading-tight mt-4 mb-2"><strong>Double-layer</strong></h6>
                    <p class="leading-tight"><em>3 sizes included.</em></p>
                </div>
                <div class="w-1/3 px-1 sm:px-3">
                    <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/single-layer2.webp">
                    <h6 class="leading-tight mt-4 mb-2"><strong>Single-layer</strong></h6>
                    <p class="leading-tight"><em>3 sizes included.</em></p>
                </div>
            </div>
        </div>
    </section>
    <section class="content-section text-center comparison px-1 lg:px-3" style="background:linear-gradient(to bottom, #272e41, #02050e);">
        <div class="container mx-auto max-w-5xl">
            <h2 class="mb-16 md:mb-12 "><strong>The difference you can <img class="h-12 sm:h-20 align-bottom lazyload" data-src="https://www.musora.com/musora-cdn/image/width=320,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/hear.png" alt="Hear text"></strong></h2>
            <div class="relative">
                <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto border-separate comparison eardrums earbuds">
                    <tbody style="background-color:transparent!important;">
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl">
                            <img class="h-5 md:h-12 filter saturate-0 brightness-200 lazyload"  data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png" alt="logo-white">
                        </td>
                        <td class="leading-none rounded-t-xl">Standard<br> Earbuds</td>
                        <td class="leading-none rounded-t-xl">Standard<br> Headphones</td>
                    </tr>
                    <tr>
                        <td>Driver Type</td>
                        <td>
                            <span class="hidden sm:inline">2 dynamic drivers<br> + 1 balanced armature</span>
                            <span class="inline sm:hidden">2 dynamic drivers + 1 BAs</span>
                        </td>
                        <td>1 Dynamic Driver</td>
                        <td>Single 40mm Driver</td>
                    </tr>
                    <tr>
                        <td>Frequency Range</td>
                        <td>18Hz - 22kHz</td>
                        <td>19Hz - 20kHz</td>
                        <td>18Hz - 22kHz</td>
                    </tr>
                    <tr>
                        <td>Sound Isolation</td>
                        <td>-29 dB</td>
                        <td>0 dB</td>
                        <td>0 dB</td>
                    </tr>
                    <tr>
                        <td>Impedance (at 1khz)</td>
                        <td>18 Ω</td>
                        <td>~23 Ω</td>
                        <td>~47 Ω</td>
                    </tr>
                    <tr>
                        <td>Sensitivity (at 1khz)</td>
                        <td>97 dB</td>
                        <td>109 dB</td>
                        <td>96 dB</td>
                    </tr>
                    <tr style="background-color:transparent!important;">
                        <td class="rounded-b-xl">Built For Drummers</td>
                        <td class="rounded-b-xl">Yes</td>
                        <td class="rounded-b-xl">No</td>
                        <td class="rounded-b-xl">No</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="text-center py-8 sm:py-10 lg:py-12" style="background:linear-gradient(to bottom, #f5f4f9, #edeaef);">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>What’s in the box?</strong></h1>
            <p class="leading-tight mt-2 hidden sm:inline-block">(Tap for more information)</p>
            <ul class="list-disc mt-2 ml-6 leading-tight text-left w-auto inline-block sm:hidden">
                <li class="mb-1">1 Pair of EarDrum IEMs</li>
                <li class="mb-1">3 Memory Foam Eartips (S/M/L)</li>
                <li class="mb-1">3 Single-layer Silicone Eartips</li>
                <li class="mb-1">3 Double-layer Silicone Eartips</li>
                <li class="mb-1">3 Triple-layer Silicone Eartips</li>
                <li class="mb-1">2 Black Braided Cables</li>
                <li class="mb-1">1 Gold ¼” Adapter</li>
                <li class="mb-1">1 Clothing Clip</li>
                <li class="mb-1">1 Cleaning Brush</li>
                <li class="">1 Drumeo Miniature Road Case</li>
            </ul>
            <div class="max-w-5xl mx-auto relative">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1152x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/items2.webp">
                    <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/items2.webp" alt="logo">
                </picture>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 42%;left: 20%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="Drumeo Miniature Road Case">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 26%;left: 46%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="2 Single-layer Silicone Eartips">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 25%;left: 57%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="2 Double-layer Silicone Eartips">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 45%;left: 57%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="2 Triple-layer Silicone Eartips">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 69%;left: 46%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="3 Memory Foam Eartips (S/M/L)">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 61%;left: 56%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="Clothing Clip">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 80%;left: 61%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="Gold ¼” Adapter">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 32%;left: 66%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="Cleaning Brush">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 28%;left: 78%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="2 Black Braided Cables">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop hidden sm:block cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center"
                    style="top: 52%;left: 89%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);"
                    tip="EarDrum IEMs">
                    <span class="text-2xl">+</span>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 sm:px-6 sm:py-16 lg:py-20">
        <div class="container mx-auto max-w-3xl">
            <div class="flex flex-wrap sm:flex-nowrap">
                <div class="px-6 sm:pr-0 sm:pl-7 lg:pl-14 mb-7 sm:mb-0 sm:order-1">
                    <img class="h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/drumeo-icon.svg">
                    <h3 class="leading-tight my-4"><strong>30 Days Of Free Drum Lessons With Your EarDrums. </strong></h3>
                    <p class="leading-normal">Play your favorite songs, study with your favorite teachers, and find your next breakthrough on the drums.
                        <br><br>
                        Your Drumeo EarDrums include 30 days of unlimited drum lessons. You’ll have sheet music for 6000+ famous drum songs, step-by-step lessons with award-winning drummers, and playalongs in every style and tempo.
                    </p>
                </div>
                <picture class="w-full sm:w-auto h-auto sm:h-96">
                    <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/join-drumeo.webp">
                    <img class="sm:rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/join-drumeo-m.webp">
                </picture>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-16" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-3xl">
            <img alt="quietkick logo" class="h-16 sm:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/logo-black.png"><br>
            <h6 class="leading-tight mt-4 mb-2">Protect your ears +<br class="sm:hidden"> play your favorite songs.</h6>

            @include('drumeo.products.partials._promo-cards', [
                'firstBadge' => 'SAVE 40%',
                'firstDeal' => 'Drumeo<br> EarDrums',
                'firstDealImage' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/order-01.webp',
                'firstImageHeight' => 'h-28 lg:h-32',
                'firstDealDiscount' => 149,
                'firstDealPrice' => 99,
                'firstDealSub' => 'Just the IEMs',
                'firstDealLink' => '/ecommerce/add-to-cart?products[drumeo-eardrums-black]=1&products[drumeo_access_30-days]=1&locked=true',
                'firstButtonText' => 'SELECT',
                'firstDealExtra' => "One-time payment. Free shipping.",
                'whiteBg' => 'false',
                'firstExtraBonuses' => [
                    '<strong>1 Pair of EarDrum IEMs</strong>',
                    '3 Memory Foam Eartips (S/M/L)',
                    '3 Single-layer Silicone Eartips',
                    '3 Double-layer Silicone Eartips',
                    '3 Triple-layer Silicone Eartips',
                    '2 Black Braided Cables',
                    '1 ¼” Adapter',
                    '1 Set Of Instructions',
                    '1 Cleaning Brush',
                    '1 Drumeo Miniature Road Case',
                ],

                'secondBadge' => 'LAUNCH SPECIAL',
                'secondDeal' => 'EarDrums + 1 Year<br> Drumeo Membership',
                'secondDealImage' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/eardrums-black/order-02.webp',
                'secondImageHeight' => 'h-28 lg:h-32',
                'secondDealPrice' => 'Free EarDrums',
                'secondDealExtra' => "with annual Membership of $240/yr.",
                'secondButtonText' => 'SELECT',
                'secondDealLink' =>
                    '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[drumeo-eardrums-black]=1&locked=true',
                'secondExtraBonuses' => [
                    '<strong class="text-drumeo">Join Drumeo and get EarDrums for FREE!</strong>',
                    '<strong>Everything included with the<br> Drumeo Eardrums PLUS:</strong>',
                    'Step-by-Step Lessons',
                    '6000+ Song Breakdowns',
                    'Personalized Support',
                ],
            ])





            <h6 class="uppercase mt-6"><strong>For hygienic reasons all <br class="inline sm:hidden"> EarDrum sales are final.</strong></h6>
        </div>
    </section>

    <section class="text-center py-10" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 sm:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block sm:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 sm:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl sm:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '716917974',
        'vimeo' => true,
    ])

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).foundation();

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
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
