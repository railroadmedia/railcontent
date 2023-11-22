@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Lifetime Membership To Guitareo | Guitareo</title>
    <meta property="og:title" content="Lifetime Membership To Guitareo">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    <meta name="description" content="Two, maybe three times per year you get the chance to become a Guitareo Lifetime Member.">
    <meta property="og:description" content="Two, maybe three times per year you get the chance to become a Guitareo Lifetime Member.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-lt-share-image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-guitareo.css') }}">
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
    @include('guitareo.sales.partials._nav', [
        "cartVersion" => true
    ])
    <section class="px-5 py-10 md:py-14 lg:py-16 text-white text-center" style="background:linear-gradient(to bottom, #077061 50%, #011815);">
        <div class="container mx-auto">
            <h1 class="leading-none"><strong>Get guitar lessons<br class="sm:hidden"> for <span class="text-musora">life.</span></strong></h1>
            <div class="w-full mx-auto my-4 sm:my-8 " style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <img class="absolute inset-0 object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-lifetime-thumb2.jpg">
                </div>
            </div>
            <div class="px-3 mx-auto w-full max-w-2xl">
                <h2 class="leading-none mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2>
                <p class="leading-tight text-sm"><em>One time payment or choose a <br class="sm:hidden">
                        payment plan below.</em></p>
                <a class="join smaller drumeo mt-4 w-full anchor-slide" href="#customize-anchor">GET STARTED &raquo;</a>
{{--                <p class="leading-tight mt-4 text-musora">ONLY {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() }} SPOTS AVAILABLE</p>--}}
            </div>
        </div>
    </section>
    <section class="text-center px-3 sm:px-5 py-10 md:py-14 lg:py-16 px-2 md:px-4 relative overflow-hidden">
        <div class="container mx-auto max-w-4xl z-10 relative">
            <h2 class="leading-tight mb-2"><strong>The Lifetime Advantage</strong></h2>
            <p class="leading-tight"><em>Pay once. Play forever. Get unlimited piano lessons for <br class="hidden sm:inline lg:hidden"> the price of 5 years of access to Guitareo ($1200 total).</em></p>
            <img class="hidden sm:inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/timeline.png">
            <img class="sm:hidden inline-block w-full max-w-3xl mb-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/timeline-m.png">
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center justify-center">
                <div class="order-1 sm:order-0 text-left sm:pr-5 lg:pr-7">
                    <p class="leading-relaxed my-5">
                        For the price of 5 years Guitareo access, you’ll get:
                    </p>
                    <ul class="leading-tight">
                        <li><i class="fas fa-check text-guitareo mr-2"></i> Unlimited guitar lessons for life</li>
                        <li><i class="fas fa-check text-guitareo mr-2"></i> 7 guitar bonuses (see below)</li>
                        <li><i class="fas fa-check text-guitareo mr-2"></i> Drum, piano, and singing lessons included</li>
                        <li><i class="fas fa-check text-guitareo mr-2"></i> An option to split payments over 3 installments</li>
                    </ul>
                    <p class="leading-relaxed my-5">
                        We know this invitation isn’t for everyone… but if you see yourself playing & learning the guitar for 5 or more years, a Lifetime Membership gives you the best value. Scroll down to see everything included and click the button to explore payment options.
                    </p>
                </div>
                <img
                    class="mb-4 sm:mb-0 order-0 sm:order-1 h-56 lg:h-72 rounded-xl transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-lifetime-collage.png"
                    alt="Anika"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                >
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @php
        $bonuses = [
            [
                'price' => floatval($productPrices['guitarists-survival-kit']->price),
                'description' => "Get the gear essentials to start sounding better on the guitar.",
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/november/survival-kit-shop.jpg',
                    'shipping' => true,
            ],
            [
                'price' => floatval($productPrices['chords-scales-poster']->price),
                'description' => "When you need an instant refresher on a chord in a song or want to improvise with your own solo or chord progression, this poster has you covered.",
                'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Guitareo/Thumbnails/5bd94363-e9f4-46c3-a602-d8c7c39bbeea-f2efb356-6d7e-451b-a087-e90c06cefa40-cart-image.jpg',
                    'shipping' => true,
            ],
            [
                'price' => floatval($productPrices['AGME-JAN-2019-SEMESTER']->price),
                'description' => "Master the five pillars of the acoustic guitar and build a rock-solid foundation to play the songs you love in this organized 26-week course. You'll have fun playing the guitar by applying everything you learn to real music.",
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/acoustic-guitar-made-easy.png',
            ],
            [
                'price' => floatval($productPrices['GTME-OCT-2018-SEMESTER']->price),
                'description' => 'Take a crystal-clear path to gain total guitar confidence in playing the music you love. This 26-week plan provides a complete foundation for you to achieve guitar techniques, giving you the freedom to explore the guitar neck and improvise on the spot.',
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-technique-made-easy.png',
            ],
            [
                'price' => floatval($productPrices['guitar-quest']->price),
                'description' => 'Go on a guitar-playing mission to complete nine musical projects with YouTuber Rob Scallon. Each level builds on expanding your creativity and skills on the guitar — such as shooting a music video, making a commercial jingle, and writing your own song.',
                'image' => 'https://d1923uyy6spedc.cloudfront.net/398-product-thumb--1609436919.jpg',
            ],
            [
                'price' => floatval($productPrices['GUITAR-SYSTEM']->price),
                'description' => "Transform your guitar playing with the ultimate encyclopedia of guitar lessons. Inside, you'll find guided lessons on anything you want to learn on the guitar — such as the fundamentals, gear and tone, playing styles for genres, and more.",
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/order-form/guitar-system.png',
            ],
            [
                'price' => floatval($productPrices['rhythm-and-groove']->price),
                'description' => "Start grooving to rhythms on the guitar that you can throw into any song. Your teacher Sami Ghawi will show you how to change the feel of your music and get an audience moving to the beat.",
                'image' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/black-friday/rhythm_groove_cart.jpg',
            ],
        ];
        $buttonLink = '/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&products[musora-access-1-year]=1&products[chords-scales-poster]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&locked=true';
        $buttonLink2 = '/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP-3-pay]=1&products[musora-access-1-year]=1&products[chords-scales-poster]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&locked=true';
    @endphp

    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background:linear-gradient(to bottom, #077061, #011815);"
    >
        <div class="container mx-auto relative z-50 max-w-4xl">
            <h3 class="leading-tight mb-5 md:mb-7 lg:mb-10" style="line-height: 1.4em;"><strong>Become a Lifetime Member today and get:</strong></h3>
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 56%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" {{--border-2 border-musora--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-center bg-cover" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/guitareo/promos/november/bundles/guitareo-lifetime-card.jpg');"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="leading-tight mt-4 sm:mt-6 mb-1">
                    @if(!empty($upgradeVersion))
                        <s class="opacity-60">$1200</s> <strong>$960</strong>
                    @else
                        <strong>$1200</strong>
                    @endif
                </h2>
                <p class="leading-tight text-sm">One time payment.</p>
                <a class="join mt-4 md:mt-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 15px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>
{{--                <p class="mt-4 md:mt-5 leading-tight text-musora">ONLY {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getPublicStockCount() }} SPOTS AVAILABLE</p>--}}
                <h3 class="leading-tight mt-8 sm:mt-12 mb-5 sm:mb-9"><strong>+ get 13 free Black Friday bonuses.</strong></h3>
            </div>
            <div style="font-size:0px">
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4"
                        x-data="{
                        flipped: false,
                    }"
                        x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }}');"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div
                                    x-ref="back"
                                    class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                    style="backface-visibility: hidden;"
                                >
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                        <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                <s class="opacity-40">${{ $bonus['price'] }}</s>
                            @endif
                            <strong class="text-musora">FREE</strong></span><br>
                            <em>
                                @if(!empty($bonus['shipping']))
                                    Free Shipping
                                @else
                                    Online Access
                                @endif
                            </em>
                        </p>
                    </div>
                @endforeach
            </div>
            <a class="join my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>
            <a class="inline-block leading-tight" href="{{ $buttonLink2 }}"><em><u>Prefer a payment plan? Click here to order with 3 monthly payments.</u></em></a>
        </div>
    </section>

    @php
        $faqs = [
            [
                "title" => "How long does my lifetime membership last?",
                "desc" => 'Simply, for life! Either yours or ours. Your Lifetime Membership is valid as long as Guitareo (Musora) remains in service and you stay alive.',
            ],
            [
                "title" => "What happens if Guitareo or Musora’s service ends?",
                "desc" => 'We’ll make every effort to provide Lifetime Members with all the original media content we have created available for download. That way, you can continue to enjoy everything we’ve done.<br><br>This will cover all available Musora original content (our entire curriculum and courses) but will not include and 3rd party content that we do not own rights to.',
            ],
            [
                "title" => "What content is included with my Lifetime Membership? Are songs included?",
                "desc" => 'As a Lifetime Member, you get access to all original Musora content for life. That’s all our courses, the Method, Live lessons, Student Reviews, and the forums.<br><br>Some of our content is licensed by 3rd parties, which means we have to pay a fee for each member to use the material on a temporary basis. This includes song transcriptions.<br><br>Those songs are licensed and require an additional fee for ongoing access. We wish it wasn’t the case and have done our best to make the fee as small as possible. Currently, the fee is $40/year for Lifetime Members.<br><br>To put that in context, that’s $40/year for ALL the song transcriptions inside Musora (Pianote, Guitareo, Singeo, and Drumeo). You’ll get access to thousands of officially licensed song transcriptions for the price of one songbook a year.',
            ],
        ]
    @endphp

    <div id="faq" class="anchor"></div>
    <section class="py-12 md:py-20" style="background: #000;">
        <div class="container mx-auto max-w-5xl px-6">
            <h2 class="font-extrabold mb-10 text-center text-white">Frequently Asked Questions</h2>
            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
        </div>
    </section>
    <section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #00101d;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <h5 class="mb-2"><strong>Still have questions?</strong></h5>
                <p>If you need any further information about becoming a Lifetime Member, <a href="{{ get_musora_brand_base_url() }}/contact"><u>contact our amazing support team!</u></a>
                    <br><br>
                    A friendly and knowledgeable support team member will get back to you right away.</p>
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

    @include('guitareo.sales.partials._footer')

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-03-31 23:59:59',
        'promoVersion' => false
    ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{--    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/app.js') }}"></script>
@stop
