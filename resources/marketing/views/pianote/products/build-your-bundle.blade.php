@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Build Your Bundle</title>
    <meta property="og:title" content="Build Your Bundle">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Build your own bundle and save up to 50% on Pianote books!">
    <meta property="og:description" content="Build your own bundle and save up to 50% on Pianote books!">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/books.png" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "subscriptionVersion" => true,
        "scrollToJoin" => true
    ])
    <section class="pt-6 sm:pt-10 lg:pt-12 relative text-center px-4 lg:px-6 relative" style="background: #EFF7FF;">
        <div class="container mx-auto">
            <img class="h-12 sm:h-20 lg:h-24 mb-2" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/books-bundle-logo.png">
            <h6 class="leading-relaxed">Build your own bundle and <strong>save up to 50% on Pianote books!</strong> Simply select the books <br class="hidden sm:inline">
                    you want at the bottom of this page and the discount will automatically be applied.</h6>
            <a href="#customize-anchor" class="join smaller pianote anchor-slide mt-4 sm:mt-7 mb-5 sm:mb-10">START BUILDING MY BUNDLE</a>
            <div class="w-full mx-auto px-4 max-w-xl lg:max-w-3xl">
                <img
                    class="relative z-10 sm:-mb-12 lg:-mb-16"
                    src="https://www.musora.com/musora-cdn/image/width=1300,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/books.png"
                    alt="Video thumbnail"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </section>
    <section class="py-14 sm:py-20 lg:py-32 relative overflow-hidden text-center customize px-4 sm:px-6 relative overflow-hidden">
        <div class="container mx-auto max-w-6xl">
            <div class="text-left flex flex-wrap items-start lg:items-center mb-12 sm:mb-20 lg:mb-28">
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 sm:order-1">
                    <picture>
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/chords-scales-collage.png">
                        <img class="max-w-sm sm:max-w-lg lg:max-w-xl xl:max-w-3xl transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/chords-scales-collage.png"
                            alt="collage image"
                        >
                    </picture>
                </div>
                <div class="w-full sm:w-1/2 mt-5 sm:mt-0 sm:pr-5 lg:pr-10">
                    <h3><strong>Piano Chords & Scales The Ultimate Guide</strong></h3>
                    <p class="leading-normal mt-3">Master Every Chord. Every Scale. In Every Key.
                        <br><br>
                        This book will help you learn every chord shape, chord variation, and scale in EVERY key.
                        <br><br>
                        It’s the ultimate guide to mastering the building blocks of music on the piano.
                        <br><br>
                        The handy tabs on the side will make it easy to look up any key signature and quickly find all the different scales and chords you need when it comes time to practice or learn a new song.</p>
                </div>
            </div>
            <div class="text-left flex flex-wrap items-start lg:items-center mb-12 sm:mb-20 lg:mb-28">
                <div class="flex w-full justify-center sm:justify-end sm:w-1/2">
                    <picture>
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/classical-collage.png">
                        <img class="max-w-sm sm:max-w-lg lg:max-w-xl xl:max-w-3xl transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/classical-collage.png"
                            alt="collage image"
                        >
                    </picture>
                </div>
                <div class="w-full sm:w-1/2 mt-5 sm:mt-0 sm:pl-5 lg:pl-10">
                    <h3><strong>Classical Piano Pieces (You Can Actually Play)</strong></h3>
                    <p class="leading-normal mt-3">Let’s be honest…
                        <br><br>
                        Classical piano can seem a little elitist, even snobby. And that’s a shame. Because classical music is so beautiful.
                        <br><br>
                        So we’re out to change that reputation.
                        <br><br>
                        Welcome to the world of classical piano music (you can actually play)! This book is your gateway to famous composers, stunning piano pieces, and an entirely new and rewarding experience on the piano.
                        <br><br>
                        It’s your repertoire of beautiful classical pieces that you can actually play (and that people will want to hear)!
                        <br><br>
                        <strong><em>Here are some of our favorites:</em></strong><br>
                        • Ukrainian Folk Song by Ludwig van Beethoven<br>
                        • Minuet in F Major by Wolfgang Amadeus Mozart<br>
                        • Prelude in C Major by Johann Sebastian Bach<br>
                        • Sonatina in B-flat Major by George Frideric Handel<br>
                        • Waltz in A Minor by Frédéric Chopin<br>
                        And so many more!
                    </p>
                </div>
            </div>
            <div class="text-left flex flex-wrap items-start lg:items-center">
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 sm:order-1">
                    <picture>
                        <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/planner-collage.png">
                        <img class="max-w-sm sm:max-w-lg lg:max-w-xl xl:max-w-3xl transition-opacity opacity-0"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/planner-collage.png"
                            alt="collage image"
                        >
                    </picture>
                </div>
                <div class="w-full sm:w-1/2 mt-5 sm:mt-0 sm:pr-5 lg:pr-10">
                    <h3><strong>The Pianote Practice Planner</strong></h3>
                    <p class="leading-normal mt-3">They say practice makes perfect.
                        <br><br>
                        It’s a cliche – but it’s not entirely true. Because if you’re not practicing the RIGHT things – the RIGHT way....
                        <br><br>
                        You won’t be perfect.
                        <br><br>
                        Worse – you could be wasting your time.
                        <br><br>
                        The new Pianote Practice Planner is your written guide to making every practice perfect, so you get the results you deserve.
                        <br><br>
                        This is Lisa Witt’s personal practice guide. Written by her, exclusively for piano players.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section
        class="content-section text-center customize relative z-50 bg-top bg-no-repeat lazyload"
        style="background-color:#0C1524;"
        x-data="{
            selectedNum: 0,
            query: '',
        }"
    >
        <div class="container mx-auto max-w-6xl relative z-50">
            <img class="h-12 sm:h-20" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/build-your-bundle/books-bundle-logo.png">
            <h5 class="mt-1 sm:mt-3 mb-7" style="line-height: 1.4em;"><strong>Select the books that you would <br class="inline sm:hidden"> like to add to your bundle below.</strong><br>
                <em class="text-coaches">(the more books you add – the more you’ll save!)</em>
            </h5>

            <div class="mx-auto max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-3xl" style="font-size: 0;">
                @php

                    $bonuses = [
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/may/Pianote_Planner_Card.jpg',
                            'title' => 'Practice Planner',
                            'description' => 'Always know exactly what to practice.',
                            'price' => floatval($productPrices['pianote-practice-planner']->price),
                            'shipping' => true,
                            'sku' => '&products[pianote-practice-planner]=1',
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/november/bonuses/classical-piano-book.jpg',
                            'title' => 'Classical Piano Pieces',
                            'description' => '92 pages full of beautiful pieces by famous classical composers that you can actually play!',
                            'price' => floatval($productPrices['classical-book']->price),
                            'sku' => '&products[classical-book]=1',
                        ],
                        [
                            'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/bonus-chords-scales.jpg',
                            'title' => 'Piano Chords & Scales',
                            'description' => 'Your encyclopedia of piano chords & scales.',
                            'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                            'shipping' => true,
                            'sku' => '&products[piano-chords-and-scales-guide]=1',
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4"
                        x-data="{
                            selected: false,
                        }"
                        x-on:click="
                            if (selected){
                                selected = !selected;
                                query = query.replace('{{ $bonus['sku'] }}', '');
                                selectedNum--;
                            } else if(!selected) {
                                selected = !selected;
                                selectedNum++;
                                query = query + '{{ $bonus['sku'] }}';
                            }
                        "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-pianote front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    :class="selected ? 'border-4' : !selected && bonus !==3 && 'hover:border-2'"
                                    style="backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                    @endif
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/{{ $bonus['image'] }});"></div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                            <span class="leading-tight inline-block">{!!  $bonus['title']  !!}</span><br>
                            <span style="text-transform:uppercase; display:inline-block;"><strong class="text-promo font-black">$39</strong></span><br>
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <h2 class="leading-tight">
                    <s class="opacity-40" x-show="selectedNum > 0">$<span x-text="selectedNum * 39"></span></s>
                    <strong>$<span x-text="selectedNum === 0 ? 0 : selectedNum === 1 ? 29 : selectedNum === 2 ? 49 : selectedNum === 3 && 59"></span></strong>
                </h2>
                <h5 class="leading-tight uppercase text-pianote">
                    <em x-show="selectedNum === 0">Choose a product to see your savings</em>
                    <em x-show="selectedNum > 0">This bundle saves you <span x-text="selectedNum === 0 ? 0 : selectedNum === 1 ? 26 : selectedNum === 2 ? 37 : selectedNum === 3 && 50"></span>%</em>
                </h5>
            </div>

            <a
                class="join pianote my-4 md:my-8 w-full max-w-xs sm:max-w-md lg:max-w-xl"
                :class="selectedNum === 0 && 'sold-out'"
                :href="selectedNum !== 0 ? '/ecommerce/add-to-cart?locked=true'+query : '#customize-anchor'"
                x-text="selectedNum !== 0 ? 'CLICK HERE TO CHECKOUT' : 'Choose a product'"></a>
            <h5 class="text-coaches uppercase leading-normal">
                AVAILABLE UNTIL April 30th AT MIDNIGHT<br>
                <strong x-cloak x-data="timer()" x-init="countdown()">
                    <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                    <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                    <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                    <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                    <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                </strong>
            </h5>
        </div>
    </section>


    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-30 23:59:59',
        'promoVersion' => false
    ])
@stop
