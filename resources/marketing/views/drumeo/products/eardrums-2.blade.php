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

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">

    <style>

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
            box-shadow: 0 0 15px #000;
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
                <img alt="quietkick" class="h-20 sm:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/280x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stickbag-logo2.svg"><br>
                <h6 class="leading-tight mt-2 mb-3">Protect your ears + play your favorite songs.</h6>
                <h3 class="leading-tight">
                    @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['stickbag']->price) }}</s>
                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                        (Save {{ round(100 - (100 * (floatval($productPrices['stickbag']->discounted_price) / floatval($productPrices['stickbag']->price)))) }}%)
                    @else
                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                    @endif
                </h3>
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
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>
        <video class="object-cover w-full relative z-0" style="height: 600px;" type="video/mp4" autoplay loop playsinline muted
            src="https://d21q7xesnoiieh.cloudfront.net/marketing/drumeo/shop/stickbag/header-vid.mp4"></video>
    </header>

    <section class="text-center px-5 md:px-6 py-10 md:py-14 lg:py-16" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>What's <img class="h-12 sm:h-20 align-bottom lazyload" data-src="https://www.musora.com/musora-cdn/image/width=290,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/loud.png" alt="Loud text"></strong></h1>
            <h6 class="leading-tight mt-3 mb-7 sm:mb-10">The Drumeo EarDrums have helped 15,000 drummers protect their ears and play <br class="hidden sm:inline">
                their favorite songs. We took your feedback and made a classic even better:</h6>
            <div class="flex text-left">
                <div class="w-full sm:w-1/4 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Better Connections.</strong></h5>
                    <p>An upgraded 2-pin cable connection guarantees you can hear your music in any situation.</p>
                </div>
                <div class="w-full sm:w-1/4 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Extra Cable.</strong></h5>
                    <p>You’ll also be covered with a backup braided cable – keep it in your travel bag or at your kit to save you mid-show.</p>
                </div>
                <div class="w-full sm:w-1/4 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Miniature Road Case.</strong></h5>
                    <p>The big little upgrade. Your EarDrums now include a custom miniature road case – built to take anything you (accidentally) throw at it.</p>
                </div>
                <div class="w-full sm:w-1/4 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Back In Black.</strong></h5>
                    <p>You’ll look like a pro wearing in-ear monitors in all-new triple black – the official color of touring drummers everywhere.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 md:px-0 py-10 md:py-16 lg:py-20">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>Drums are <img class="h-12 sm:h-20 align-bottom lazyload" data-src="https://www.musora.com/musora-cdn/image/width=290,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/loud.png" alt="Loud text"></strong></h1>
            <h6 class="leading-normal mt-1 mb-7 sm:mb-10 mx-auto max-w-xl">
                Whether you’re playing acoustic or electronic drums, sealing in the sound while protecting your ears is crucial. <strong>Drumeo EarDRUMS are professional in-ear headphones that help you:</strong></h6>
            <div class="flex flex-wrap text-left">
                <div class="flex">
                    <img class="sm:order-1" src="">
                    <div class="sm:pr-4">
                        <h5 class="leading-tight my-2"><strong>Catch every detail.</strong></h5>
                        <p>Triple driver headphones (that means 3 tiny speakers) give you a full range of sound -- from low kick drums to high cymbal shots.</p>
                    </div>
                </div>
                <div class="flex">
                    <img class="" src="">
                    <div class="sm:pl-4">
                        <h5 class="leading-tight my-2"><strong>Seal in the sound.</strong></h5>
                        <p>Drumeo EarDRUMS reduce external volume by up to -29dB. That means you can play hard while protecting your ears.</p>
                    </div>
                </div>
                <div class="flex">
                    <img class="sm:order-1" src="">
                    <div class="sm:pr-4">
                        <h5 class="leading-tight my-2"><strong>Go anywhere.</strong></h5>
                        <p>Your EarDRUMS are meant to be used. Take them anywhere with a handy carrying case + extra tips for a perfect fit every time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center text-white px-5 py-10 md:py-16 lg:py-20 relative" style="background-color:#111729;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <div class="w-full sm:w-7/12 text-left">
                <h1 class="mb-3 sm:mb-5"><strong>Not just for<br> the <img class="h-12 sm:h-20 align-top lazyload" data-src="https://www.musora.com/musora-cdn/image/width=320,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/pros.png" alt="Pros text"></strong></h1>

                <p>You don’t need to be an arena drummer to use in-ear monitors.
                    <br><br>
                    In fact, with more and more drummers using e-kits and taking lessons online, in-ear monitors have become a go-to practice tool for drummers of ALL skill levels.
                    <br><br>
                    By reducing volume by up to -29db, in-ear monitors will save your ears from ambient drum noise AND allow you to listen to your music quieter.</p>
            </div>
        </div>
        <img class="absolute inset-0 z-0 w-full h-full object-cover" src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/final.jpg">
    </section>
    <section class="text-center px-5 sm:px-10 py-10 md:py-16 lg:py-20 text-white" style="background-color:#111729;">
        <div class="container mx-auto relative z-10 max-w-5xl">

            <h2 class="leading-tight mb-7"><strong>Everything you love about<br> the original EarDrums…</strong></h2>

            <div class="grid grid-cols-4 gap-3 text-black">
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h5 class="leading-tight">“I have really small ears and I am REALLY picky about sound.”</h5>
{{--                    <p class="my-4 sm:my-6">I have to say I was doubtful. I have some more expensive in-ear monitors and I have really small ears and I am REALLY picky about sound. I was 100% blown away – deep rich bass response, nice clear mids and highs and amazing fit, and best of all no ear fatigue! I was also pleasantly surprised at the nice compact package that fits into a pocket or purse to take with me and keep things all in one place. Lots of selection for ear tips and a nice cleaner all part of the package for an amazing price.  If I had listened to the sound alone I would have expected them to cost a lot more than they do. I use mine every day and recommend them to everyone I talk to!</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/360053_1646349286211-1646349288-360053.jpg" alt="Joy B">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>Joy B</strong><br>
                            <span>Toronto</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h5 class="leading-tight">“No more harsh-sounding headphones for drumming.”</h5>
{{--                    <p class="my-4 sm:my-6">I’ve been rocking EarDrums and like them. It’s great to have a lot of low end without having the bass or kick drum get muddy. They are very comfortable and I enjoy them. No more harsh-sounding headphones for drumming – and no more guessing where the bassist is going! I also like the high-end roll-off – this prevents listening fatigue AND protects your hearing if you like to listen loudly. </p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/398228_1648758391036-1648758395-398228.jpg" alt="Lauri V">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>Lauri V.</strong><br>
                            <span>Finland</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h5 class="leading-tight">“Definitely felt the Drumeo in-ears are a step up.”</h5>
{{--                    <p class="my-4 sm:my-6">I used these in a show the other night for the first time and really enjoyed them! Definitely felt the Drumeo in-ears are a step up from the KZ Pro 10s. The sound quality is competitive with KZs, but Drumeo in-ears are much more comfortable to me.</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dzryyo1we6bm3.cloudfront.net/avatars/IMG_3193.jpg" alt="David G">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>David G</strong><br>
                            <span>Mississippi</span>
                        </p>
                    </div>
                </div>
                <div class="rounded-xl p-4 sm:p-6 text-left h-full bg-white">
                    <h5 class="leading-tight">“The isolation tips do a good job of cutting sound while still comfy.”</h5>
{{--                    <p class="my-4 sm:my-6">I love these things! Great sound and a good selection of tips for various needs/uses. The isolation tips do a good job of cutting sound while still comfy. Not only great for drum monitoring but all around music enjoyment.</p>--}}
                    <div class="flex items-center border-t-2 mt-5 pt-3" style="border-color:#B3D9FF;">
                        <img class="rounded-full h-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Rick_profile.jpg" alt="Rick">
                        <p class="leading-none mx-0 pl-4 text-drumeo"><strong>Rick</strong><br>
                            <span>Oregon</span>
                        </p>
                    </div>
                </div>
            </div>
            <h3 class="leading-tight mt-7"><strong>and more...</strong></h3>
        </div>
    </section>
    <section class="text-center px-5 md:px-6 py-10 md:py-14 lg:py-16">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>Find your fit.</strong></h1>
            <h6 class="leading-tight mt-3 mb-7 sm:mb-10 mx-auto max-w-2xl">A perfect seal is critical. That’s why your EarDrums include 9 different fits across 3 different configurations. From expanding memory foam to double-layer silicon, you can find the perfect fit for your ears.</h6>
            <div class="flex">
                <div class="w-full sm:w-1/3 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Triple-layer</strong></h5>
                    <p><em>3 sizes included.</em></p>
                </div>
                <div class="w-full sm:w-1/3 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Double-layer</strong></h5>
                    <p><em>3 sizes included.</em></p>
                </div>
                <div class="w-full sm:w-1/3 px-3">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>Single-layer</strong></h5>
                    <p><em>3 sizes included.</em></p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-1 sm:px-5 pt-10 md:pt-16 lg:pt-20" style="background:linear-gradient(to right, #f9f9fc, #eae8ee);">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h1 class="leading-tight"><strong>What’s in the box?</strong></h1>
            <div class="max-w-xl mx-auto relative my-7">
                <picture>
                    <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1152x0/filters:quality(95)/marketing/singeo/products/singing-straw/whats-inside2.webp">
                    <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/670x0/filters:quality(95)/marketing/singeo/products/singing-straw/whats-inside2.webp" alt="logo">
                </picture>
                <div class="info-pop cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 30%;left: 11%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="Durable stainless steel case to keep everything organized">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 61%;left: 24%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="Cleaning brush to keep your straws in perfect condition (just like your voice)">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 44%;left: 39%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="3 straws in varying diameters to improve your singing">
                    <span class="text-2xl">+</span>
                </div>
                <div class="info-pop cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 29%;left: 47%; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);" tip="Canvas carry bag">
                    <span class="text-2xl">+</span>
                </div>
            </div>
        </div>
    </section>
    <section class="px-5 md:px-0 py-10 md:py-16 lg:py-20">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap">
                <img class="" src="">
                <div class="sm:pl-4">
                    <img src="">
                    <h5 class="leading-tight my-2"><strong>30 Days Of Free Drum Lessons With Your EarDrums. </strong></h5>
                    <p>Play your favorite songs, study with your favorite teachers, and find your next breakthrough on the drums.
                        <br><br>
                        Your Drumeo EarDrums include 30 days of unlimited drum lessons. You’ll have sheet music for 6000+ famous drum songs, step-by-step lessons with award-winning drummers, and playalongs in every style and tempo.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="customize-anchor" class="anchor"></div>
    <section class="text-center px-5 md:px-6 py-10 md:py-14 lg:py-16" style="background-color:#F4F8FB;">
        <div class="container mx-auto relative z-10 max-w-3xl">
            <img alt="quietkick logo" class="h-12 sm:h-24" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png"><br>
            <h5 class="leading-tight mt-4 mb-2">Protect your ears + play your favorite songs.</h5>

            @include('drumeo.products.partials._promo-cards', [
                'firstDeal' => '30-Day Independence',
                'firstDealImage' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/bundle-01.webp',
                'firstImageHeight' => 'h-36 lg:h-40',
                'firstDealPrice' => 97,
                'firstDealSub' => 'Just the course + 2 bonuses worth $42.95',
                'firstDealLink' => '/ecommerce/add-to-cart?products[30-day-independence]=1&products[Drumeo-VaterSticks]=1&products[drumeo_access_30-days]=1&locked=true',
                'firstButtonText' => 'ENROLL NOW',
                'firstDealExtra' => "One-time payment",
                'whiteBg' => 'false',
                'firstExtraBonuses' => [
                    '<strong>30-Day Independence</strong>',
                    '<strong>Free</strong> Drumeo 5A Drumsticks',
                    '<strong>Free</strong> 1-month Drumeo Access',
                ],

                'topBadge' => 'MOST POPULAR',
                'secondDeal' => 'Unlimited Lessons',
                'secondDealImage' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/products/30-day-independence/bundle-02.webp',
                'secondImageHeight' => 'h-36 lg:h-40',
                'secondDealSub' => "1 year of Drumeo + 5 bonuses worth $258.94",
                'secondDealPrice' => '20/mo',
                'secondDealLink' =>
                    '/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-independence]=1&products[quietpad]=1&products[padstand]=1&products[Drumeo-VaterSticks]=1&products[easy-rudiments-book]=1&locked=true',
                'secondExtraBonuses' => [
                    '<strong>Annual Drumeo Membership</strong>',
                    '<strong>Free 30-Day Independence</strong>',
                    '<strong>Free</strong> Drumeo QuietPad',
                    '<strong>Free</strong> Drumeo PadStand',
                    '<strong>Free</strong> Drumeo 5A Drumsticks',
                    '<strong>Free</strong> Easy Rudiments Book',
                ],
                'secondButtonText' => 'GET EVERYTHING',
                'secondDealExtra' => "Billed annually at $240/yr.",
            ])
            <h6 class="uppercase mt-6"><strong>For hygienic reasons all <br class="inline sm:hidden"> EarDrum sales are final.</strong></h6>
        </div>
    </section>

    <section class="text-center py-10" style="background: #00101D;">
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
