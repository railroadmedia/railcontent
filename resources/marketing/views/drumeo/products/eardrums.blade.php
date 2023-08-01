@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Drumeo EarDrums</title>
    <meta property="og:title" content="Drumeo EarDrums">
    <meta name="description" content="Protect your ears + play your favorite songs.">
    <meta property="og:description" content="Protect your ears + play your favorite songs.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Pro_BG2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <link href="{{ asset('/marketing/parcel/drumeo/comfort-cover.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .tooltip {
            position:absolute;
        }

        header {
            height:530px;
        }
        @media (min-width: 768px) {
            header {
                height:700px;
            }
        }

        .content-section table.comparison.eardrums tr td:nth-child(1),
        .content-section table.comparison.eardrums tr td:nth-child(2),
        .content-section table.comparison.eardrums tr td:nth-child(3),
        .content-section table.comparison.eardrums tr td:nth-child(4) {
            width: 25%;
        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td:nth-child(1),
            .content-section table.comparison.eardrums tr td:nth-child(2),
            .content-section table.comparison.eardrums tr td:nth-child(3),
            .content-section table.comparison.eardrums tr td:nth-child(4) {
                width: 26%;
            }
        }
        .content-section table.comparison.eardrums tr td {
            padding:15px 7px;
            font-size:12px;
            text-transform:uppercase;

        }
        @media (min-width: 768px) {
            .content-section table.comparison.eardrums tr td {
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
    <?php \App\Analytics\Tracker::trackProductImpression('comfort-cover'); ?>
@stop()

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
        "name" => "Drumeo EarDrums",
        "fullPrice" => floatval($productPrices['drumeo-eardrums']->price),
        "price" => floatval($productPrices['drumeo-eardrums']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="text-white relative overflow-hidden z-10" style="background-color:#0f1628;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-6xl">
                <img alt="quietkick" class="h-14 sm:h-16 lg:h-20 mb-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png"><br>
                <p>Protect your ears + play your favorite songs.</p>
                <i class="fas fa-play play-button autoplay-video my-28 md:my-36" data-open="trailer"></i><br>
                @if( $products['drumeo-eardrums']->getStockAvailability() > 1 && !empty($products['drumeo-eardrums']->getStockAvailability()))
                    <a class="join blue my-2 sm:my-4 w-full sm:w-2/3" href="/ecommerce/add-to-cart?products[drumeo-eardrums]=1">GRAB A PAIR &raquo;</a>
                @else
                    <a class="join sold-out my-2 sm:my-4 w-full sm:w-2/3">SOLD OUT</a>
                @endif
                <h6 class="leading-tight">
                    <strong> ONLY @if(floatval($productPrices['drumeo-eardrums']->price) > floatval($productPrices['drumeo-eardrums']->discounted_price)) <s style="opacity: 0.6;">${{ floatval($productPrices['drumeo-eardrums']->price) }}</s> @endif
                    ${{ floatval($productPrices['drumeo-eardrums']->discounted_price) }}
                    </strong>
                </h6>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(15,22,40,0.8);"></div>
        {{--<video class="object-cover w-full h-full relative z-0" poster="" src="https://player.vimeo.com/progressive_redirect/playback/696274730/rendition/1080p?loc=external&signature=a2e19f58b044993d2561fbeaabcd4855ec9d1f577a7bba332fc5a7e7221cb23a" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>--}}
        <img class="object-cover object-right w-full h-full relative z-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Pro_BG2.jpg" alt="Eardrum background">
    </header>

    <section class="text-center px-5 md:px-0 py-10 md:py-16 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1><strong>Drums are <img class="h-12 sm:h-20 align-bottom lazyload" data-src="https://www.musora.com/musora-cdn/image/width=290,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/loud.png" alt="Loud text"></strong></h1>
            <h6 class="leading-tight mt-1 mb-7 sm:mb-10">Whether you’re playing acoustic or electronic drums,<br class="hidden sm:inline">
                sealing in the sound while protecting your ears is crucial.</h6>
        </div>
        <div class="container mx-auto relative z-10">
            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-7/12 lg:w-2/3 sm:order-1 sm:pl-5 lg:pl-10 mb-7">
                    <img class="w-full inline sm:hidden lazyload" data-src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Intro_Collage_M.png" alt="Intro Collage">
                    <img class="w-full hidden sm:inline lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Intro_Collage2.png" alt="Intro Collage">
                </div>
                <div class="text-left w-full sm:w-5/12 lg:w-1/3 sm:pl-5">
                    <h6 class="leading-normal mb-5 sm:mb-10"><strong>Drumeo EarDrums are professional <span class="inline-block">in-ear</span> headphones that help you:</strong></h6>
                    <div class="flex items-start">
                        <img class="h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Detail_Icon.svg" alt="Detail icon">
                        <div class="pl-4">
                            <p class="mb-1 uppercase text-drumeo"><strong>Catch every detail.</strong></p>
                            <p class="mb-7 sm:mb-10">Triple driver headphones (that means 3 tiny speakers) give you a full range of sound — from low kick drums to high cymbal shots.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <img class="h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Seal_Sound_Icon.svg" alt="Seal sound icon">
                        <div class="pl-4">
                            <p class="mb-1 uppercase text-drumeo"><strong>Seal in the sound.</strong></p>
                            <p class="mb-7 sm:mb-10">Drumeo EarDrums reduce external volume by up to -29dB. That means you can play hard while protecting your ears.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <img class="h-7" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Anywhere_Icon.svg" alt="Anywhere icon">
                        <div class="pl-4">
                            <p class="mb-1 uppercase text-drumeo"><strong>Go anywhere.</strong></p>
                            <p>Your EarDrums are meant to be used. Take them anywhere with a handy carrying case + extra tips for a perfect fit every time.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <section class="text-center text-white px-5 py-10 md:py-16 lg:py-20 bg-cover bg-left sm:bg-right lazyload" style="background-color:#000;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Pro_BG2.jpg">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <div class="p-7 sm:p-14 rounded-xl w-full sm:w-7/12 text-left" style="background-color:rgba(4,17,37,0.9);">
                <h1 class="mb-3 sm:mb-5"><strong>Not just for<br> the <img class="h-12 sm:h-20 align-top lazyload" data-src="https://www.musora.com/musora-cdn/image/width=320,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/pros.png" alt="Pros text"></strong></h1>

                <p>You don’t need to be an arena drummer to use in-ear monitors.
                    <br><br>
                    In fact, with more and more drummers using e-kits and taking lessons online, in-ear monitors have become a go-to practice tool for drummers of ALL skill levels.
                    <br><br>
                    By reducing volume by up to -29db, in-ear monitors will save your ears from ambient drum noise AND allow you to listen to your music quieter.</p>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-10 py-10 md:py-16 lg:py-20" style="background-color:#f5f5f7;">
        <div class="container mx-auto relative z-10 max-w-3xl">

            <h2 class="mb-7"><strong>What are students saying?</strong></h2>

            <div class="flex flex-wrap">
                <div class="rounded-xl px-4 sm:px-10 py-6 sm:py-10 text-left h-full bg-white mb-6">
                    <h4 class="leading-tight"><em>“I have really small ears and I am REALLY picky about sound.”</em></h4>
                    <p class="my-4 sm:my-6">I have to say I was doubtful. I have some more expensive in-ear monitors and I have really small ears and I am REALLY picky about sound. I was 100% blown away – deep rich bass response, nice clear mids and highs and amazing fit, and best of all no ear fatigue! I was also pleasantly surprised at the nice compact package that fits into a pocket or purse to take with me and keep things all in one place. Lots of selection for ear tips and a nice cleaner all part of the package for an amazing price.  If I had listened to the sound alone I would have expected them to cost a lot more than they do. I use mine every day and recommend them to everyone I talk to!</p>
                    <div class="flex items-center">
                        <img class="rounded-full h-12 sm:h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/360053_1646349286211-1646349288-360053.jpg" alt="Joy B">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>Joy B</strong><br>
                            <span>Toronto</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl px-4 sm:px-10 py-6 sm:py-10 text-left h-full bg-white mb-6">
                    <h4 class="leading-tight"><em>“No more harsh-sounding headphones for drumming.”</em></h4>
                    <p class="my-4 sm:my-6">I’ve been rocking EarDrums and like them. It’s great to have a lot of low end without having the bass or kick drum get muddy. They are very comfortable and I enjoy them. No more harsh-sounding headphones for drumming – and no more guessing where the bassist is going! I also like the high-end roll-off – this prevents listening fatigue AND protects your hearing if you like to listen loudly. </p>
                    <div class="flex items-center">
                        <img class="rounded-full h-12 sm:h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/398228_1648758391036-1648758395-398228.jpg" alt="Lauri V">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>Lauri V.</strong><br>
                            <span>Finland</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl px-4 sm:px-10 py-6 sm:py-10 text-left h-full bg-white mb-6">
                    <h4 class="leading-tight"><em>“Definitely felt the Drumeo in-ears are a step up.”</em></h4>
                    <p class="my-4 sm:my-6">I used these in a show the other night for the first time and really enjoyed them! Definitely felt the Drumeo in-ears are a step up from the KZ Pro 10s. The sound quality is competitive with KZs, but Drumeo in-ears are much more comfortable to me.</p>
                    <div class="flex items-center">
                        <img class="rounded-full h-12 sm:h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/IMG_3193.jpg" alt="David G">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>David G</strong><br>
                            <span>Mississippi</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl px-4 sm:px-10 py-6 sm:py-10 text-left h-full bg-white">
                    <h4 class="leading-tight"><em>“The isolation tips do a good job of cutting sound while still comfy.”</em></h4>
                    <p class="my-4 sm:my-6">I love these things! Great sound and a good selection of tips for various needs/uses. The isolation tips do a good job of cutting sound while still comfy. Not only great for drum monitoring but all around music enjoyment.</p>
                    <div class="flex items-center">
                        <img class="rounded-full h-12 sm:h-16 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Rick_profile.jpg" alt="Rick">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>Rick</strong><br>
                            <span>Oregon</span>
                        </p>
                    </div>
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

    <section class="text-center px-1 sm:px-5 py-10 md:py-16 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>In-ears by drummers<br> for drummers.</strong></h2>
            <h6 class="hidden sm:inline-block mb-5 sm:mb-10">Scroll down to see everything included with your Drumeo EarDrums.</h6>
            <h6 class="inline-block sm:hidden mb-5 sm:mb-10">Watch the video to see everything<br> included with your Drumeo EarDrums.</h6>
            <div class="hidden sm:inline-block relative text-coaches text-xs sm:text-lg p-1">
                <p class="absolute w-full text-center -top-6 sm:top-6"><strong>(Tap for more information)</strong></p>
                <img class="rounded-xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Product_Image01.jpg" alt="Eardrums kit">
                <div class="tooltip cursor-pointer" style="top: 22.5%;left: 62.5%;" tip="Memory Foam Eartips (S/M/L)"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 22.5%;left: 45%;" tip="Single-layer Silicone Eartips (S/M/L)"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 22.5%;left: 53%;" tip="Triple-layer Silicone Eartips (S/M/L)"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 15%;left: 75.5%;" tip="Drumeo Carrying Case"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 43%;left: 47.5%;" tip="¼” Adapter"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 44%;left: 61%;" tip="Cleaning Brush"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 58%;left: 41%;" tip="Drumeo EarDrums"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 56%;left: 67%;" tip="Clothing Clip"><i class="fas fa-info-circle"></i></div>
                <div class="tooltip cursor-pointer" style="top: 74%;left: 71%;" tip="Silver-plated Detachable Cable"><i class="fas fa-info-circle"></i></div>
            </div>
            <div class="p-1">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/716922633" frameborder="0" allowfullscreen allow="autoplay" title="Eardrums unboxing video"></iframe>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="p-1 w-full sm:w-7/12"><div class="h-56 sm:h-64 lg:h-80 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Product_Image04.jpg"></div></div>
                <div class="p-1 w-full sm:w-5/12"><div class="h-56 sm:h-64 lg:h-80 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Product_Image03.jpg"></div></div>

                <div class="p-1 w-full sm:w-5/12"><div class="h-56 sm:h-64 lg:h-80 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/drumeo-eardrums-6.jpg"></div></div>
                <div class="p-1 w-full sm:w-7/12"><div class="h-56 sm:h-64 lg:h-80 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/drumeo-eardrums-1.jpg"></div></div>

                <div class="p-1 w-full sm:w-7/12"><div class="h-56 sm:h-64 lg:h-80 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Product_Image02.jpg"></div></div>
                <div class="p-1 w-full sm:w-5/12"><div class="h-56 sm:h-64 lg:h-80 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/drumeo-eardrums-8alt.jpg"></div></div>
            </div>
        </div>
    </section>
    <div id="customize-anchor" class="anchor"></div>
    <section class="content-section text-center customize px-4 lg:px-6 lazyload" style="background-color:#253b53;background-size: cover;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Order_Image.jpg">
        <div class="container mx-auto">
            <img alt="quietkick logo" class="h-12 sm:h-16 lg:h-20 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png"><br>
            <h2 class="leading-tight mt-4 mb-2"><strong>Protect your ears +<br> play your favorite songs. </strong></h2>
            @if( $products['drumeo-eardrums']->getStockAvailability() > 1 && !empty($products['drumeo-eardrums']->getStockAvailability()))
                <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-10 mx-auto">
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl" style="background:linear-gradient(to bottom, #0a73d8, #10518f);"><strong>LAUNCH SPECIAL</strong></p>--}}
                        <a href="/ecommerce/add-to-cart?products[drumeo-eardrums]=1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                            <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                                <h5 class="leading-none mb-3">EarDrums</h5>
                                <h1 class="inline-block leading-none">
                                    @if(floatval($productPrices['drumeo-eardrums']->price) > floatval($productPrices['drumeo-eardrums']->discounted_price))
                                        <s class="opacity-40">${{ floatval($productPrices['drumeo-eardrums']->price) }}</s>
                                    @endif
                                    <strong>${{ floatval($productPrices['drumeo-eardrums']->discounted_price) }}</strong></h1>
                                {{--<p class="text-sm my-2 sm:my-4 opacity-60"><em>Save {{ round(100 - (100 * (floatval($productPrices['drumeo-eardrums']->discounted_price) / floatval($productPrices['drumeo-eardrums']->price)))) }}% for a limited time.</em></p>--}}
                                <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80 mt-2 sm:mt-4" style="max-width: 230px;">Get Started</div>
                            </div>
                            <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                <p class="mb-1">Drumeo EarDrum IEMs</p>
                                <p class="mb-1">3 Eartip Options (3 Sizes Each)</p>
                                <p class="mb-1">Detachable Cable</p>
                                <p class="mb-1">¼” Adapter</p>
                                <p class="mb-1">Cleaning Brush</p>
                                <p>Drumeo Carrying Case</p>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif

            <p class="uppercase"><strong>For hygienic reasons all <br class="inline sm:hidden"> EarDrum sales are final.</strong></p>
        </div>
    </section>

    <section class="content-section text-center" style="background: #0c1429;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    <div class="reveal large" id="trailer" data-reveal data-reset-on-close="false" style="background:transparent;">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/716917974?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>

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
