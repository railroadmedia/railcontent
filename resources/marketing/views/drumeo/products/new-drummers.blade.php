@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>New Drummers Start Here | Drumeo</title>
    <meta name="description" content="The fastest way to get started on the drums and play the songs you love.">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/og-image.jpg" style="display: none;">
    <meta property="og:title" content="New Drummers Start Here | Drumeo">
    <meta property="og:description" content="The ultimate guide to getting started on the drums and playing the songs you love.">
    <meta property="og:url" content="https://www.drumeo.com/new-drummers/">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/ndsh.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <style>
        .dropdowns {
            max-width: 1100px;
            margin: 20px auto 0;
            padding: 0 10px;
        }
        @media (min-width: 40em) {
            .dropdowns {
                margin: 40px auto 0;
                padding: 0 20px;
            }
        }
        .dropdowns .dropdown .bg-pred {
            min-width: 32px;
        }
        @media (min-width: 40em) {
            .dropdowns .dropdown .bg-pred {
                min-width: 83px;
            }
        }
        .dropdowns .dropdown .description {
            height: 0;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
        }
        .dropdowns .dropdown.active .description {
            visibility: visible;
            opacity: 1;
            height: auto;
            max-height: 400px;
        }

    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                    "name" => "New Drummers Start Here",
                    "fullPrice" => floatval($productPrices['new-drummers-start-here']->price),
                    "price" => floatval($productPrices['new-drummers-start-here']->discounted_price),
                "noBreadcrumb" => true
                ])

    <header class="text-center text-white py-5 md:py-8 bg-top bg-no-repeat relative" style="background-color:#020d1f;background-image: url(https://cdn.musora.com/image/fetch/w_3000,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/header.jpg);">
        <div class="container mx-auto relative z-10">
            <img class="logo" src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/logo.png"><br>
            <i class="fas fa-play play-button autoplay-video mt-40 md:mt-72 mb-16 md:mb-24" data-open="trailer"></i>
            <h2><strong>Crush your first 90 days<br class="inline md:hidden"> on the drums.</strong></h2>
            <h5 class="my-3">Go from a total beginner to <br class="inline md:hidden"> playing drums with real music.</h5>
            <h4 class="text-yellow-400 mb-3 md:mb-5"><strong>ONLY
                    @if(floatval($productPrices['new-drummers-start-here']->price) > floatval($productPrices['new-drummers-start-here']->discounted_price)) <s class="opacity-60">${{ floatval($productPrices['new-drummers-start-here']->price) }}</s> @endif
                    ${{ floatval($productPrices['new-drummers-start-here']->discounted_price) }}</strong></h4>
            <a class="join ndsh" href="/ecommerce/add-to-cart?products[new-drummers-start-here]=1">Start Drumming &raquo;</a>
        </div>
    </header>

    <div class="reveal large" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/543324037?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    <section class="text-center text-white py-10 md:py-20 lg:py-24 relative overflow-hidden" style="background:#000a1e;">
        <div class="container mx-auto z-10 relative">
            <div class="px-2 md:px-4">
                <div class="relative w-full rounded-2xl mx-auto h-10 beg-adv-text" style="max-width: 840px;">
                    <img class="absolute top-0 h-5 md:h-7" src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/logo.png">
                    <p class="absolute top-0 leading-none text-xs uppercase whitespace-nowrap hidden md:inline">Play your<br> favorite songs<br><i class="fal fa-angle-down"></i></p>
                    <p class="absolute top-0 leading-none text-xs uppercase whitespace-nowrap">Play in<br> bands<br><i class="fal fa-angle-down"></i></p>
                    <p class="absolute top-0 leading-none text-xs uppercase whitespace-nowrap hidden md:inline">Write & record<br> drum parts<br><i class="fal fa-angle-down"></i></p>
                    <p class="absolute top-0 leading-none text-xs uppercase whitespace-nowrap">Play anything<br> you want<br><i class="fal fa-angle-down"></i></p>
                </div>
                <div class="relative w-full rounded-2xl h-20 mx-auto flex space-between overflow-hidden items-center beg-adv-bar" style="background-color: #1571bd;max-width: 840px;">
                    <div class="h-full flex items-center flex-wrap relative" style="background-color:#00bafd;">
                        <h4 class="uppercase leading-none w-full"><strong>Beginner</strong></h4>
                        <p class="text-xs leading-none absolute left-0 right-0" style="color:#003e5a;bottom: 7px;"><i class="fas fa-long-arrow-left"></i> 90 Days <i class="fas fa-long-arrow-right"></i></p>
                    </div>
                    <h4 class="uppercase leading-none"><strong>Intermediate</strong></h4>
                    <div class="h-full flex items-center" style="background-color:#1a4b89;">
                        <h4 class="uppercase leading-none"><strong>Advanced</strong></h4>
                    </div>
                </div>
                <div class="relative w-full rounded-2xl mx-auto h-10 beg-adv-text block md:hidden" style="max-width: 840px;">
                    <p></p>
                    <p class="absolute top-0 leading-none text-xs uppercase whitespace-nowrap inline md:hidden"><i class="fal fa-angle-up"></i><br>Play your<br> favorite songs</p>
                    <p></p>
                    <p class="absolute top-0 leading-none text-xs uppercase whitespace-nowrap inline md:hidden"><i class="fal fa-angle-up"></i><br>Write & record<br> drum parts</p>
                    <p></p>
                </div>
            </div>
            <div class="mx-auto text-left pt-16 md:mt-24 px-5" style="max-width:730px">
                <h3><strong>Learning the drums should be FUN.</strong></h3>

                <h5 class="mt-7 leading-normal">…but way too often, it seems intimidating.
                    <br><br> You’re trying to figure out what kind of kit you need, where to take lessons, and then those doubts creep in that almost make you give up:
                    <em>“Am I too old to get started?”, “Maybe playing the drums is too hard for me, anyway.”</em> <br><br>
                    <strong>Spoiler alert:</strong> There’s no “perfect age” to start drumming. And learning the drums doesn’t have to be hard.
                    <br><br> You just need to set yourself up for success with the best information, from a qualified teacher, and delivered on a flexible schedule that works for YOU.
                    <br><br>
                    <em>New Drummers Start Here</em> will take you from a total beginner to playing the drums with REAL music as fast as possible. With expert guidance from award-winning online drum instructor, Jared Falk, you’ll be set up for success every step of the way.
                    <br><br> And before you know it, you’ll be playing your favorite songs, impressing your friends & relatives, and changing your relationship with music forever. Excited yet?
                </h5>
            </div>
        </div>
        <img class="opacity-10 lg:opacity-30 w-80 z-0 absolute left-0 top-1/2 lazyload" style="    margin-left: -190px;transform: translate(0, -50%);" data-src="https://cdn.musora.com/image/fetch/w_640,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/icon-blue.png">
        <img class="opacity-10 lg:opacity-30 w-44 z-0 absolute right-0 top-1/2 lazyload" style="    width: 170px;margin-right: -80px;" data-src="https://cdn.musora.com/image/fetch/w_340,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/icon-orange.png">
    </section>

    <section class="text-center text-white pt-10 md:pt-20 lg:pt-24 pb-10 md:pb-14 overflow-hidden" style="background:linear-gradient(#000a1e, #01082b);">
        <div class="container mx-auto">
            <h3 class="leading-tight mb-7 md:mb-16 lg:mb-20"><strong>Everything you need to<br class="inline md:hidden"> start learning the drums.</strong></h3>
            <div class="slick-1 text-left mx-auto w-full" style="max-width:1200px; margin-bottom: 0;">
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>THE DRUM SETUP SYSTEM<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>The best way to set up your drums.</strong></h4>
                            <h6 class="leading-relaxed">Learn to set up your drums in a comfortable & ergonomic way so moving around the kit becomes effortless. You’ll also get to know each piece of the kit and how it works together to create one unified instrument.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>01</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-setup-system.jpg">
                        </div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>Drum Tuning Quick Start<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Tune your drums to perfection.</strong></h4>
                            <h6 class="leading-relaxed">If you’ve ever felt like your drums don’t sound quite right (or you’re still shocked drums need to be tuned at all), you’re in the right place. You’ll learn how to tune each drum and what to listen for in great & inspiring drum sounds.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>02</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-tuning-quick-start.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>Drum Theory Simplifier<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>How to read drum music.</strong></h4>
                            <h6 class="leading-relaxed">It’s not as hard as it sounds. Jared breaks down reading drum music in a quick & fun way so you’ll be able to look at a page of simple drum music and hear the pattern in your head -- it’s like you speak another language!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>03</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-theory-simplifier.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>Drum Technique System<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Play with control & prevent injuries.</strong></h4>
                            <h6 class="leading-relaxed">“Tension is the enemy of movement.” That’s why you’re going to learn proper techniques for everything from holding the drumsticks to striking each drum & cymbal. You’ll learn the mechanics to play anything you want on the drums.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>04</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-technique-system.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Drum Beat System<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Your first drum beats.</strong></h4>
                            <h6 class="leading-relaxed">It’s all coming together. You’re ready to play your first drum beats and learn a variety of patterns that can be used in thousands of your favorite songs. This is a huge step on your way to playing real music!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>05</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-beat-system.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Drum Fill System<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Play drum fills around the kit.</strong></h4>
                            <h6 class="leading-relaxed">Fills are your moment to shine. You’ll learn how to harness the magic of the drum fill and use it to transition into new sections of a song. This is your chance to move around the kit musically (and hit ALL the drums in your setup.)</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>06</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-fill-system.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Drum Rudiment Quick-Start<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>The drummer’s alphabet.</strong></h4>
                            <h6 class="leading-relaxed">Rudiments are the letters of drumming. You’ll learn how to use them to build words, sentences, and ultimately tell your own story on the drums. Get started with these 6 rudiments and take them wherever you want!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>07</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-rudiment-quick-start.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The 5 Step Song Learning Method<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Play with REAL music.</strong></h4>
                            <h6 class="leading-relaxed">It’s time to apply everything you’ve learned and play with REAL music. You’ll gain the skills to play your favorite songs and experience the magic of being THE drummer on a drum-less play-along track. The training wheels have come off!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>08</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-5-step-song-learning-method.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Practice Routine Generator<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Always know what to practice.</strong></h4>
                            <h6 class="leading-relaxed">Your time matters. You’ll learn to generate a practice routine that helps you use your valuable practice time efficiently. Whether it’s 15-mins, 1-hour, or 3-hours, you’ll always know what to work on for the best results.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>09</strong></h1>
                            <img class="rounded-2xl" src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-practice-routine-generator.jpg"></div>
                    </div>
                </div>
            </div>
            <div class="inline-block md:hidden text-left mx-auto w-full" style="max-width:1200px; margin-bottom: 0;">
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>THE DRUM SETUP SYSTEM<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>The best way to set up your drums.</strong></h4>
                            <h6 class="leading-relaxed">Learn to set up your drums in a comfortable & ergonomic way so moving around the kit becomes effortless. You’ll also get to know each piece of the kit and how it works together to create one unified instrument.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>01</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-setup-system.jpg">
                        </div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>Drum Tuning Quick Start<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Tune your drums to perfection.</strong></h4>
                            <h6 class="leading-relaxed">If you’ve ever felt like your drums don’t sound quite right (or you’re still shocked drums need to be tuned at all), you’re in the right place. You’ll learn how to tune each drum and what to listen for in great & inspiring drum sounds.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>02</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-tuning-quick-start.jpg"></div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>Drum Theory Simplifier<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>How to read drum music.</strong></h4>
                            <h6 class="leading-relaxed">It’s not as hard as it sounds. Jared breaks down reading drum music in a quick & fun way so you’ll be able to look at a page of simple drum music and hear the pattern in your head -- it’s like you speak another language!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>03</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-theory-simplifier.jpg"></div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>Drum Technique System<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Play with control & prevent injuries.</strong></h4>
                            <h6 class="leading-relaxed">“Tension is the enemy of movement.” That’s why you’re going to learn proper techniques for everything from holding the drumsticks to striking each drum & cymbal. You’ll learn the mechanics to play anything you want on the drums.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>04</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-technique-system.jpg"></div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Drum Beat System<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Your first drum beats.</strong></h4>
                            <h6 class="leading-relaxed">It’s all coming together. You’re ready to play your first drum beats and learn a variety of patterns that can be used in thousands of your favorite songs. This is a huge step on your way to playing real music!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>05</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-beat-system.jpg"></div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Drum Fill System<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Play drum fills around the kit.</strong></h4>
                            <h6 class="leading-relaxed">Fills are your moment to shine. You’ll learn how to harness the magic of the drum fill and use it to transition into new sections of a song. This is your chance to move around the kit musically (and hit ALL the drums in your setup.)</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>06</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-fill-system.jpg"></div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Drum Rudiment Quick-Start<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>The drummer’s alphabet.</strong></h4>
                            <h6 class="leading-relaxed">Rudiments are the letters of drumming. You’ll learn how to use them to build words, sentences, and ultimately tell your own story on the drums. Get started with these 6 rudiments and take them wherever you want!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>07</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-drum-rudiment-quick-start.jpg"></div>
                    </div>
                </div>
                <div class="px-5 mb-12">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The 5 Step Song Learning Method<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Play with REAL music.</strong></h4>
                            <h6 class="leading-relaxed">It’s time to apply everything you’ve learned and play with REAL music. You’ll gain the skills to play your favorite songs and experience the magic of being THE drummer on a drum-less play-along track. The training wheels have come off!</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>08</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-5-step-song-learning-method.jpg"></div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h2 class="uppercase text-blue"><strong>The Practice Routine Generator<sup>&trade;</sup></strong></h2>
                            <h4 class="my-3 md:my-5"><strong>Always know what to practice.</strong></h4>
                            <h6 class="leading-relaxed">Your time matters. You’ll learn to generate a practice routine that helps you use your valuable practice time efficiently. Whether it’s 15-mins, 1-hour, or 3-hours, you’ll always know what to work on for the best results.</h6>
                        </div>
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-blue absolute bottom-0 text-7xl lg:text-9xl -left-3 lg:-left-8"><strong>09</strong></h1>
                            <img class="rounded-2xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/level-practice-routine-generator.jpg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white pt-10 md:pt-20 lg:pt-24 pb-3 md:pb-7 lg:pb-10" style="background:#000a1e;">
        <div class="container mx-auto clearfix">
            <h3 class=" mb-6 md:mb-10 lg:mb-14"><strong>Why study with Jared Falk & Drumeo?</strong></h3>
            <div class="float-left w-1/3">
                <div class="social-platform py-4 md:py-5 lg:py-6 rounded-3xl w-11/12" style="color: #0b76db;background: linear-gradient(#000a1e, #00102e);">
                    <img class="lazyload w-auto h-10 md:h-12 lg:h-14 py-2" data-src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
                    <h1 class="count font-black leading-none my-2 md:my-4 text-white" id="likes-count" data-total-count="51000">0</h1>
                    <p class="uppercase leading-none md:tracking-widest">Active Students</p>
                </div>
            </div>
            <div class="float-left w-1/3">
                <div class="social-platform youtube py-4 md:py-5 lg:py-6 rounded-3xl w-11/12" style="color: #cd201f;background: linear-gradient(#000a1e, #00102e);">
                    <i class="fab fa-youtube text-4xl md:text-5xl lg:text-6xl"></i>
                    <h1 class="count font-black leading-none my-2 md:my-4 text-white" id="youtube-count" data-total-count="2090000">0</h1>
                    <p class="uppercase leading-none md:tracking-widest">Subs<span class="hidden sm:inline-block">cribers</span></p>
                </div>
            </div>
            <div class="float-left w-1/3">
                <div class="social-platform py-4 md:py-5 lg:py-6 rounded-3xl w-11/12" style="color: #ffc900;background: linear-gradient(#000a1e, #00102e);">
                    <i class="fas fa-trophy-alt text-4xl md:text-5xl lg:text-6xl"></i>
                    <h1 class="font-black leading-none my-2 md:my-4 text-white">Awarded</h1>
                    <p class="uppercase leading-none md:tracking-widest">BEST EDUCATIONAL WEBSITE</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-white pt-10 pb-0 md:py-20 lg:py-28 relative" style="background-color:#020d1f;">
        <div class="absolute inset-0 z-0 bg-top bg-no-repeat jared-bio lazyload hidden md:block" data-bg="https://cdn.musora.com/image/fetch/w_3000,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/jared-falk.jpg" style="background-color:#020d1f;"></div>
        <div class="absolute inset-0 z-0 bg-top bg-no-repeat jared-bio lazyload block md:hidden" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/jared-falk-m.jpg" style="background-color:#020d1f;"></div>
        <div class="container mx-auto max-w-4xl relative z-10 px-4">
            <div class="md:flex flex-wrap md:w-1/2 ml-auto order-1">
                <h1 class="text-center md:text-left text-blue m-0 text-5xl md:text-6xl lg:text-8xl leading-none"><strong>JARED<br class="hidden md:inline"> FALK</strong></h1>
                <h6 class="mt-60 md:mt-5 leading-relaxed">Jared Falk has been a trusted source for online drum lessons for 15+ years.
                    <br><br>
                    As the face of Drumeo, Jared is a pioneer of online drum instruction -- helping prospective drummers around the world learn their first beats and beyond.
                    <br><br>
                    His passion, grit, and approachable style have helped him become the most-watched drum instructor online… ever! And now you can take in his first-ever full curriculum for beginner drummers anytime and anywhere it fits your schedule.</h6>
            </div>
        </div>
    </section>

    <section class="text-center text-white py-20 md:py-20 lg:py-24" style="background:#000a1e;">
        <div class="container mx-auto">
            <h3 class="mb-7 md:mb-10 lg:mb-12"><strong>But don’t just take our word for it…</strong></h3>
            <div class="slick-2 text-left">
                <div class="px-3">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000a1e, #01092b)">
                        <p class="leading-normal md:leading-relaxed">"Drumeo is the real deal folks! Jared Falk and his team have my confidence and support in what is done to promote music through the art of drumming and percussion. It is absolutely imperative for the student of the art to SEE, HEAR and EMULATE every lesson that is presented by the instructor. This is accomplished when studying lessons at Drumeo - a good place to study and realize one’s dreams."</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/billy-cobham.jpg">
                            <div class="text pl-3 md:pl-5">
                                <h6 class="uppercase"><strong>BILLY COBHAM</strong></h6>
                                <h6 class="text-blue uppercase pt-2">Legendary Jazz Fusion Drummer</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000a1e, #01092b)">
                        <p class="leading-normal md:leading-relaxed">"Jared Falk has a comprehensive expert knowledge in providing and structuring lesson plans. He has a great human sense and knows how to handle, host and guide a lesson. It certainly didn’t come overnight. It’s more that he grew over the years to an expert and a professional instructor who really knows how to teach."</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/anika-nilles.jpg">
                            <div class="text pl-3 md:pl-5">
                                <h6 class="uppercase"><strong>Anika Nilles</strong></h6>
                                <h6 class="text-blue uppercase pt-2">Drummer & Composer</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000a1e, #01092b)">
                        <p class="leading-normal md:leading-relaxed">"After years of watching Jared's lessons on YouTube and Drumeo, and getting to work side by side with him, I can confidently say that he gives every bit of his effort and skill into every product or lesson he teaches. He cares about each and every drummer who will watch and learn from his work and wants nothing more than to change drumming education for the better each time he puts his name on something."</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/casey-cooper.jpg">
                            <div class="text pl-3 md:pl-5">
                                <h6 class="uppercase"><strong>Casey Cooper</strong></h6>
                                <h6 class="text-blue uppercase pt-2">Most Subscribed Drummer On YouTube</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(#000a1e, #01092b)">
                        <p class="leading-normal md:leading-relaxed">"Jared and the whole Drumeo team have a great way of delivering information that’s proven to work and helps the student grow. In my visits to Drumeo it is apparent to me that not only is Jared wickedly smart, his heart is in the right place as well—and that’s an essential element for any successful teacher."</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/todd-sucherman.jpg">
                            <div class="text pl-3 md:pl-5">
                                <h6 class="uppercase"><strong>Todd Sucherman</strong></h6>
                                <h6 class="text-blue uppercase pt-2">Styx, Award-winning Rock Drummer</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white py-10 md:py-20 lg:py-24 overflow-hidden" style="background:#000a1e;">
        <div class="container mx-auto">
            <h3 class="leading-tight"><strong>Getting started has<br class="inline md:hidden"> never been easier.</strong></h3>
            <h6 class="mt-3 md:mt-5 lg:mt-7 mb-7 lg:mb-10 leading-relaxed text-blue"><em>Or more affordable.</em></h6>
            <div class="relative w-full mx-auto" style="max-width:1150px;">
                <p class="leading-tight text-xs absolute top-0 right-0 -mt-8 w-1/4 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="compare-table select-none">
                    <tbody>
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td><img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/logo.png"></td>
                        <td><img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_190,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png"></td>
                        <td class="cursor-pointer">Other Online<br> Courses</td>
                        <td class="cursor-pointer"><img src="https://cdn.musora.com/image/fetch/w_190,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/udemy.png"></td>
                        <td class="cursor-pointer"><img src="https://cdn.musora.com/image/fetch/w_260,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/masterclass.png"></td>
                        <td class="cursor-pointer"><img src="https://cdn.musora.com/image/fetch/w_240,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/drum-ambitions.png"></td>
                    </tr>
                    <tr>
                        <td>Beginner focused</td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td>Sometimes</td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td><i class="fas fa-minus"></i></td>
                        <td><i class="fas fa-check-circle"></i></td>
                    </tr>
                    <tr>
                        <td>Qualified teacher</td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td>Varies</td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td><i class="fas fa-check-circle"></i></td>
                    </tr>
                    <tr>
                        <td>Lifetime access</td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td>Available</td>
                        <td>Sometimes</td>
                        <td><i class="fas fa-check-circle"></i></td>
                        <td><i class="fas fa-minus"></i></td>
                        <td><i class="fas fa-minus"></i></td>
                    </tr>
                    <tr>
                        <td>Money-back guarantee</td>
                        <td>90 days</td>
                        <td>90 days</td>
                        <td>30 days</td>
                        <td>30 days</td>
                        <td>30 days</td>
                        <td><i class="fas fa-minus"></i></td>
                    </tr>
                    <tr>
                        <td>Course Length</td>
                        <td>90 days</td>
                        <td><i class="fas fa-infinity"></i></td>
                        <td>Varies</td>
                        <td>12.5 hours</td>
                        <td>2.5 hours</td>
                        <td><i class="fas fa-infinity"></i></td>
                    </tr>
                    <tr>
                        <td>Included</td>
                        <td>52 videos</td>
                        <td>Unlimited Content</td>
                        <td>Varies</td>
                        <td>104 videos</td>
                        <td>15 videos</td>
                        <td>100 videos</td>
                    </tr>
                    <tr style="background-color:transparent!important;">
                        <td>TOTAL INVESTMENT</td>
                        <td>@if(floatval($productPrices['new-drummers-start-here']->price) > floatval($productPrices['new-drummers-start-here']->discounted_price))
                                <s>${{ floatval($productPrices['new-drummers-start-here']->price) }}</s>
                            @endif
                            @if(floatval($productPrices['new-drummers-start-here']->discounted_price) == 0)
                                FREE
                            @else
                                ${{ floatval($productPrices['new-drummers-start-here']->discounted_price) }}
                            @endif
                        </td>
                        <td>${{ Prices::$plusSubscriptionAnnual }}/yr</td>
                        <td>$89-$270</td>
                        <td>$89.99</td>
                        <td>$240/yr</td>
                        <td>$200/yr</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="relative text-center text-white py-10 md:py-14 lg:py-16" style="background:#ff570d;    border-bottom: 5px solid #ffa16a;border-top: 5px solid #ffa16a;box-shadow: 0 0px 0px 5px #0bf;">
        <div class="container mx-auto">
            <h3 class="leading-tight"><strong>Say goodbye to jumping around<br class="hidden md:inline"> between random YouTube videos.</strong></h3>
            <h6 class="mt-3 leading-relaxed px-4" style="max-width: 700px;">You’ll have a step-by-step guide to getting started on the drums all in one place. And with simple assignments after every lesson, New Drummers Start Here helps you fly through your first 90 days of playing the drums.</h6>
        </div>
    </section>

    <section class="text-center text-white py-10 md:py-24" style="background:#000a1e;">
        <div class="container mx-auto">
            <div class="w-full md:mx-auto mt-3 md:mt-0 px-4 md:flex items-start lg:items-center" style="max-width:990px">
                <img alt="" class="guarantee-badge lazyload mx-auto mb-3 md:mb-0 order-1" data-src="https://cdn.musora.com/image/fetch/w_1160,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/new-drummers/guarantee.png">
                <div class="text-wrap md:pr-5 lg:pr-12">
                    <h3 class="md:text-left"><strong><em>“I’m still not sure...”</em></strong></h3>
                    <h6 class="text-left mt-3 md:mt-7 leading-relaxed">Hey, starting something new is scary… we get it.
                        <br><br>
                        That’s why New Drummers Start Here comes with a full 90 day money-back guarantee. Even though it’s only $7 (seriously), you’ll get three full months to decide if this course is the right way for you to get started on the drums. If not, just contact our super-friendly support team to collect your refund.</h6>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="final text-center text-white py-10 md:py-20 lg:py-24 bg-center bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/order-background.jpg">
        <div class="container mx-auto">
            <img class="logo lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/new-drummers/logo.png">
            <h2 class="mt-5 md:mt-8"><strong>Crush your first 90 days<br class="inline md:hidden"> on the drums.</strong></h2>
            {{--<h6 class="mb-5 md:mb-14 leading-normal px-3"><em>Choose your adventure -- get your beginner lessons for just $7 <br class="hidden md:inline">--}}
                    {{--or add a practice pad and drumsticks for a discount. </em></h6>--}}

            <h5 class="my-3 leading-normal px-3">Go from a total beginner to <br class="inline md:hidden"> playing drums with real music.</h5>
            <h4 class="text-yellow-400 mb-10 md:mb-14"><strong>ONLY
                    @if(floatval($productPrices['new-drummers-start-here']->price) > floatval($productPrices['new-drummers-start-here']->discounted_price)) <s class="opacity-60">${{ floatval($productPrices['new-drummers-start-here']->price) }}</s> @endif
                    ${{ floatval($productPrices['new-drummers-start-here']->discounted_price) }}</strong></h4>

            <a href="/ecommerce/add-to-cart?products[new-drummers-start-here]=1" class="join ndsh w-2/3 md:-mt-4">START DRUMMING &raquo;</a>

            <div class="inline-block w-full px-3 md:px-4 mt-5 md:mt-8 text-light-navy text-4xl md:text-5xl">
                <i class="fab mx-1 fa-cc-visa"></i>
                <i class="fab mx-1 fa-cc-mastercard"></i>
                <i class="fab mx-1 fa-cc-amex"></i>
                <i class="fab mx-1 fa-cc-paypal"></i>
                <i class="fab mx-1 fa-cc-discover"></i>
            </div>
            <div class="inline-block w-full px-3 md:px-4 mt-3 questions text-light-navy">
                <p class="leading-tight"><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

    <section class="text-center py-10 md:py-20 lg:py-24" style="background:#000a1e;">
        <div class="container mx-auto">
            <h3 class="text-white"><strong>Still have questions?</strong></h3>
            <div class="dropdowns">
            @include('drumeo.products.partials.question-dropdown-tw', [
                    "title" => "Do I need a full drum set to complete the course?",
                    "description" => 'The lessons work on both electric and acoustic drum sets. While you can even get value with just a practice pad & sticks, it’s recommended that you have access to a drum set to get the most from this course.',
                    ])
            @include('drumeo.products.partials.question-dropdown-tw', [
                    "title" => "How much time per week will this course require?",
                    "description" => 'It’s up to you and your schedule! New Drummers Start Here is designed to be flexible so you can work through it at your own pace. Or, if you’re super motivated you could cruise the entire course in a week. Every drummer will be different!',
                    ])
            @include('drumeo.products.partials.question-dropdown-tw', [
                    "title" => "What devices can I access the course on?",
                    "description" => 'New Drummers Start Here is available on your laptop, tablet, or phone. You’ll also have access through the Drumeo app after you’ve completed your purchase of the course.',
                    ])
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
            $('.slick-1').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                autoplay: true,
                autoplaySpeed: 5000,
            });
            $('.slick-2').slick({
                slidesToShow: 3,
                responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]

            });
            //scrolls up subscriber count
            $('.count').each(function () {
                var thisCountElement = $(this);
                var options = {
                    useEasing: true,
                    useGrouping: true,
                    separator: ',',
                    decimal: '.',
                    prefix: '',
                    suffix: ''
                };
                var demo = new CountUp(
                    thisCountElement.attr('id'), 0, thisCountElement.data('total-count'), 0, 2.5, options
                );

                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window)
                        .height() + 200 > (thisCountElement.offset().top)) {
                        demo.start();
                    }
                });
            });

            $(window).trigger('scroll');


            $('.compare-table tr td:nth-child(4)').on('click', function(){
                $(this).parents().find('table').removeClass('masterclass ambition');
                $(this).parents().find('table').addClass('udemy');
            });
            $('.compare-table tr td:nth-child(5)').on('click', function(){
                $(this).parents().find('table').removeClass('udemy ambition');
                $(this).parents().find('table').addClass('masterclass');
            });
            $('.compare-table tr td:nth-child(6)').on('click', function(){
                $(this).parents().find('table').removeClass('masterclass udemy');
                $(this).parents().find('table').addClass('ambition');
            });
            $('.compare-table tr td:nth-child(7)').on('click', function(){
                $(this).parents().find('table').removeClass('ambition udemy masterclass');
            });

            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-180');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
