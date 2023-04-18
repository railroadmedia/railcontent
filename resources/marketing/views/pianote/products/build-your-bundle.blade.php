@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Beautiful Beginner Piano Bundle</title>
    <meta property="og:title" content="The Beautiful Beginner Piano Bundle">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Because starting out should sound this good.">
    <meta property="og:description" content="Because starting out should sound this good.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://pianote.s3.amazonaws.com/shop/products/beautiful-beginner-bundle/banner.jpg" style="display: none;">

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

        .tooltip {
            position: absolute;
        }
        .tooltip:after, .tooltip:before {
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
        .tooltip:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .tooltip:after {
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
        .tooltip:hover, .tooltip:active, .tooltip:focus {
            z-index: 100;
        }
        .tooltip:hover:after, .tooltip:hover:before, .tooltip:active:after, .tooltip:active:before, .tooltip:focus:after, .tooltip:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }

        .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
            max-width:240px;
            padding-bottom: 51%;
        }
        @media (min-width: 768px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:370px;
                padding-bottom: 35%;
            }
        }
        @media (min-width: 1024px) {
            .content-section.customize .horizontal-bonuses .bonus-wrap .flip-div.special {
                max-width:400px;
                padding-bottom: 30%;
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "subscriptionVersion" => true,
        "scrollToJoin" => true
    ])

    <section class="content-section text-center upgrade-video-header text-black" style="background-color:#EFF7FF;">
        <div class="container mx-auto">
            <h1 data-aos="fade-down" class="font-bebas leading-none text-5xl md:text-7xl mb-1" style="text-shadow: 2px 3px #f61a30;"><strong>BUILD YOUR BUNDLE</strong></h1>
            <h6 class="leading-tight">Build your own bundle and save up to 50% on Pianote books! Simply select the books <br class="hidden sm:inline">
                    you want at the bottom of this page and the discount will automatically be applied.</h6>
            <a href="#customize-anchor" class="join smaller pianote anchor-slide my-5 sm:my-10">START BUILDING MY BUNDLE</a>
{{--            <div class="w-full mx-auto px-4" style="max-width:920px;">--}}
{{--                <img--}}
{{--                    class="rounded-xl"--}}
{{--                    src="https://www.musora.com/musora-cdn/image/width=1300,quality=85/https://pianote.s3.amazonaws.com/shop/products/beautiful-beginner-bundle/banner.jpg"--}}
{{--                    alt="Video thumbnail"--}}
{{--                    loading="lazy"--}}
{{--                    onload="this.classList.remove('opacity-0')"--}}
{{--                />--}}
{{--            </div>--}}
        </div>
    </section>
    <section class="content-section text-center upgrade-video-header bg-white text-black">
        <div class="container mx-auto max-w-5xl">
            <div class="text-left">
                <h3><strong>Piano Chords & Scales The Ultimate Guide</strong></h3>
                <p class="leading-tight mt-2">Master Every Chord. Every Scale. In Every Key.
                    <br><br>
                    This book will help you learn every chord shape, chord variation, and scale in EVERY key.
                    <br><br>
                    It’s the ultimate guide to mastering the building blocks of music on the piano.
                    <br><br>
                    The handy tabs on the side will make it easy to look up any key signature and quickly find all the different scales and chords you need when it comes time to practice or learn a new song.</p>
            </div>
            <div class="text-right my-10">
                <h3><strong>Classical Piano Pieces (You Can Actually Play)</strong></h3>
                <p class="leading-tight mt-2">Let’s be honest…
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
            <div class="text-left">
                <h3><strong>The Pianote Practice Planner</strong></h3>
                <p class="leading-tight mt-2">They say practice makes perfect.
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
            <h1 data-aos="fade-down" class="font-bebas leading-none text-5xl md:text-7xl" style="text-shadow: 2px 3px #f61a30;"><strong>BUILD YOUR BUNDLE</strong></h1>
            {{--<h2 data-aos-once="true" data-aos="fade-up" class="my-3 md:my-5 leading-normal"><strong>Improve your drumming for<br> just <span class="text-drumeo">${{ round((Prices::$plusSubscriptionAnnual / 12), 2) }}</span> per month.</strong></h2>--}}
            <h5 class="mt-1 sm:mt-3 mb-6" style="line-height: 1.4em;"><strong>Select the books that you would <br class="inline lg:hidden"> like to add to your bundle below.</strong><br>
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
            </div>

            <a
                class="join pianote bigger my-4 md:my-8 w-full max-w-xs md:max-w-lg lg:max-w-3xl"
                style="padding: 20px 10px;"
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
