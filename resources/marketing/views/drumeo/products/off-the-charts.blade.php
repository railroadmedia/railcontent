@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Off The Charts | Drumeo</title>
    <meta property="og:title" content="Off The Charts | Drumeo">

    <meta name="description" content="Learn to write pro drum charts.">
    <meta property="og:description" content="Learn to write pro drum charts.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/off-the-charts/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <style>
        .timeline-container::after {
            top: 30px;
        }
        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        form {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            form {
                margin: 0 auto 10px;
            }
        }

        form input, form button {
            font: 400 18px/50px 'Open Sans', sans-serif;
            height: 50px;
            color: #999;
            border-radius: 100px;
            text-align: left;
            padding: 7px 20px;
            margin: 0 auto 15px;
        }
        @media (min-width: 768px) {
            form input, form button {
                font-size: 22px;
                height: 65px;
                line-height: 65px;
            }
        }
        form input[type="submit"], form button[type="submit"], form input button, form button button {
            font-family: 'Bebas Neue', sans-serif;
            color: #fff;
            background: #0b76db;
            text-transform: uppercase;
            margin: 0 auto 15px;
            display: block;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            padding: 0;
        }
        form input[type="submit"]:hover, form button[type="submit"]:hover, form input button:hover, form button button:hover {
            background: #258ff4;
        }
        .disclaimer {
            display: none;
            margin: 0 auto;
            opacity: 0.9;
            max-width: 500px;
        }

        .thank-you-box {
            width:100%;
            max-width:960px;
            border-radius:5px;
            height:auto;
            max-height:0;
            visibility:hidden;
            opacity:0;
            transition:all .4s ease-in;
            display:block;
            margin:0 auto;
            background:#FFF;
            text-align:center;
            overflow:hidden;
            color:#000
        }

        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px
        }

        @media (min-width:40em) {
            .thank-you-box.active {
                padding:20px
            }
        }

        @media (min-width:64em) {
            .thank-you-box.active {
                padding:30px
            }
        }

        .thank-you-box p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto
        }

        @media (min-width:40em) {
            .thank-you-box p {
                font-size:19px
            }
        }

        @media (min-width:64em) {
            .thank-you-box p {
                font-size:23px
            }
        }

        .thank-you-box p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px
        }

        @media (min-width:40em) {
            .thank-you-box p em {
                font-size:14px
            }
        }

        .thank-you-box h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db
        }

        @media (min-width:40em) {
            .thank-you-box h2 {
                font-size:37px;
                margin:20px auto
            }
        }

        @media (min-width:64em) {
            .thank-you-box h2 {
                font-size:44px
            }
        }

        .thank-you-box .social-media a {
            background:#000;
            color:#fff;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:20px 3px 0;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px
        }

        @media (min-width:64em) {
            .thank-you-box .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
                margin:25px 10px 0
            }
        }

        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }

        /*  Carousel   */
        .splide__pagination__page.is-active {
            background: white;
            transform: none !important;
        }
        .splide__arrow svg{
            fill: #0B76DB !important;
        }

        .splide__arrow--next {
            right: -12px;
        }

        @media (min-width: 1140px) {
            .splide__arrow--next {
                right: -100px;
            }
        }
    </style>
@stop()

@section('body-data')
    x-data ="{
    trailer : false,
    trailerM : false,
    waitlistModal: false,
    }"
@endsection

@section('global-body')

    @include('drumeo.sales.partials._nav', [
        'cartVersion' => true,
    ])

    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#000;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-20 sm:h-24 mb-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/logo-white.png"><br>
                <h1 class="leading-tight"><strong>Learn to write <br> pro drum charts.</strong></h1>
                <h4 class="leading-tight"><em>and nail every gig.</em></h4>
                <div class="w-full max-w-xl mx-auto mt-7">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch The Trailer</div>
{{--                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block"   @click="trailerM = true;" ><i class="fas fa-play"></i> &nbsp;Watch The Trailer</div>--}}

                    @if( $products['drumeo-eardrums-black']->getStockAvailability() > 1 && !empty($products['drumeo-eardrums-black']->getStockAvailability()))
                        <a class="w-5/12 join smaller blue" href="/ecommerce/add-to-cart?products[drumeo-eardrums-black]=1">Get Started</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: radial-gradient(rgba(24,25,27,0.8), transparent);"></div>
        <img class="object-cover w-full h-full relative z-0" src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header.jpg">
    </header>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#FFFFFF;">
        <div class="container max-w-4xl mx-auto mb-24 sm:mb-40 lg:mb-36">
            <h2 class="leading-tight"><strong class="text-drumeo">Don’t just keep time.</strong></h2>
            <h3 class="leading-tight">Be the drummer everybody wants in their band.</h3>
            <img src="">
            <p class="leading-tight mt-3 mb-7 sm:mb-12 max-w-3xl">You don’t learn songs on the drums through chords or keys—you need kick patterns, ghost notes, fills, and the tiny cues that keep the band on track. Miss one, and everything falls apart. In Off The Charts, you’ll learn to capture these details in your own shortform charts. This one skill will help you learn thousands of songs faster and become an asset to any live band.</p>

            <h2 class="leading-tight"><strong>Here’s everything you’ll learn…</strong></h2>
            <h6 class="leading-tight mt-3 mb-7 sm:mb-12">You’ll learn industry secrets from one of the most prolific session <br>drummers of all time – Kenny Aronoff (300 million records and counting).</h6>
            <div class="timeline-container max-w-4xl lg:max-w-4xl mx-auto relative px-4 pt-7">
                @php
                    $gettings = [
                        [
                            'position' => 'left',
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/feature-01.webp',
                            'title' => 'Note Values',
                            'desc' => 'Learn the basics of quarter notes, eighth notes, sixteenth notes and triplets. These four note values give you the tools to learn thousands of songs on the drums.',
                        ],
                        [
                            'position' => 'right',
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/feature-02.webp',
                            'title' => 'Bar Counting',
                            'desc' => 'Kenny shows you shorthand methods for counting verses, choruses, and bridges. One glance and you’ll know exactly how long to play each section for – you’ll never miss a change again.',
                        ],
                        [
                            'position' => 'left',
                            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/feature-03.webp',
                            'title' => 'Write Any Beat',
                            'desc' => 'Putting it all together. Kenny gives you daily exercises to practice writing popular drum beats and fills. You’ll learn by doing – and have Kenny’s original charts for reference to see how you did.',
                        ],
                    ];
                @endphp
                @foreach ($gettings as $key => $getting)
                    @if ($getting['position'] === 'right')
                        <div
                            class="timeline relative flex flex-col-reverse md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 mb-16 md:mb-20">
                            <div class="content relative text-left sm:pl-10 md:pl-0">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                            <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                alt="{{ $getting['title'] }}" />
                        </div>
                    @else
                        <div
                            class="timeline relative flex flex-col md:grid md:grid-cols-2 gap-4 md:gap-14 lg:gap-20 @if(!$loop->last) mb-16 md:mb-20 @else md:mb-0 @endif">
                            @if (empty($getting['special']))
                                <img class="-mt-7 rounded-lg transition-opacity opacity-0" loading="lazy"
                                    onload="this.classList.remove('opacity-0')" src="{{ $getting['img'] }}"
                                    alt="{{ $getting['title'] }}" />
                            @else
                                <div class="-mt-7 rounded-lg bg-cover bg-center relative aspect-16:9"
                                    style="background-image:url('{{ $getting['img'] }}')"></div>
                            @endif
                            <div class="content relative text-left sm:pl-10 md:pl-0 md:mb-10">
                                <h4 class="mb-2 md:mb-5 mt-1 md:mt-0"><strong>{{ $getting['title'] }}</strong></h4>
                                <p>{{ $getting['desc'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <h1 class="leading-none sm:-mt-6 lg:-mt-7 hidden md:inline-block"><i class="fal fa-angle-down text-drumeo"></i></h1>
    </section>


    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto mb-14 lg:mb-16">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <div class="w-52 sm:w-72 lg:w-80 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8">
                    <img class="inline-block sm:hidden w-full relative z-20 transition-opacity opacity-0" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/coach.webp">
                    <img class="hidden sm:inline-block absolute top-0 left-0 w-full z-20 transition-all opacity-0"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/coach.webp"
                        loading="lazy" onload="this.classList.remove('opacity-0')">
                    <img class="hidden sm:inline-block absolute top-0 left-1/2 max-w-none z-10 transition-all opacity-0"
                        style="width: 130%;transform: translate(-44%, -7%);"
                        src="https://www.musora.com/cdn-cgi/image/width=550,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-chops/coach-brush-layer.png"
                        alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')">
                </div>

                <div class="text-white text-left z-10 rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-lg lg:max-w-2xl sm:mt-8 w-full sm:w-auto sm:flex-grow"
                    style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Kenny Aronoff</strong></h2>
                    <h6 class="leading-normal my-4 lg:my-6">Kenny Aronoff is one of the top-selling drummers of all-time. 
                        <br><br>
                        A sought-after session musician and performer, he has played with iconic artists like John Mellencamp, Bob Seger, and The Rolling Stones. With a career spanning decades, his drumming has shaped countless hits across rock, pop, and country – with hits in every genre.
                        <br><br>
                        Renowned for his precision, passion, and work ethic, his infectious energy is guaranteed to inspire you to become the best drummer (and person) you can be.
                    </h6>
                    <div class="flex items-center">
                        <h3 class="ml-0 mr-3"><i class="fad fa-fw fa-book-open text-drumeo"></i></h3>
                        <h6 class="leading-tight mx-0">
                            <strong>Top 100 Drummers of All Time</strong> - Rolling Stone Magazine
                        </h6>
                    </div>
                    <div class="flex items-center my-4 sm:my-2">
                        <h3 class="ml-0 mr-3"><i class="fad fa-fw text-drumeo fa-award"></i></h3>
                        <h6 class="leading-tight mx-0">
                            <strong>#1 Pop/Rock and #1 Studio Drummer</strong> - 5 consecutive years
                        </h6>
                    </div>
                    <div class="flex items-center">
                        <h3 class="ml-0 mr-3"><i class="fad fa-fw fa-album-collection text-drumeo"></i></h3>
                        <h6 class="leading-tight mx-0">
                            <strong>300M+ records sold</strong> worldwide with Kenny’s drumming.
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-white text-center px-5 sm:px-6 pt-10 sm:pt-14 lg:pt-20 pb-40" style="background-color:#0a60b0;">
        <div class="container max-w-5xl mx-auto">
            <h3 class="leading-tight mb-2"><strong>Everything you need to write drum charts.</strong></h3>
            <p class="leading-normal mb-4 sm:mb-6">Off The Charts is the first-ever course that includes everything you need to start writing your own drum charts:</p>

            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <div class="w-full sm:w-1/3">
                    <img src="">
                    <h5><strong>1. Eight video series</strong></h5>
                    <p>with a combination of theory and daily exercises.</p>
                </div>
                <div class="w-full sm:w-1/3">
                    <img src="">
                    <h5><strong>2. Exclusive Workbook</strong></h5>
                    <p>with notation, example charts and blank staff paper (digital OR physical)</p>
                </div>
                <div class="w-full sm:w-1/3">
                    <img src="">
                    <h5><strong>3. Extra Bonus</strong></h5>
                    <p>limited edition Blackwing charting pencils (Membership only)</p>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #2a2f34 calc(50% + 1px));">
    </div>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-2xl mx-auto">
            <img class="h-28 sm:h-40 inline-block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 mb-6 sm:mb-8 transition-opacity opacity-0"
                loading="lazy" onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/guarantee.png"
                alt="guarantee badge">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <div class="mt-4 sm:mt-0">
                    <h3 class="leading-tight mb-4 sm:mb-6"><strong>Your favorite drum<br class="inline sm:hidden"> course,
                            guaranteed.</strong></h3>

                    <p class="leading-normal">Off The Charts is the first-ever course that gives you everything you need to learn an invaluable drumming skill. We think it will be your favorite drum course ever–
                        <br><br>
                        That’s why you’ll get three full months to go through everything and make sure it’s the right topic for you. If not, just contact our friendly support team for a refund.</p>
                </div>

            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="px-3 sm:px-0 text-center customize relative z-50 overflow-hidden" style="background: #eff7ff;">
        <div class="container max-w-6xl mx-auto relative z-50" style="background: #eff7ff;">
            <div class="flex flex-wrap items-center justify-center px-4 sm:px-6 py-10 md:py-10 lg:py-20">
                <div class="text-center w-full sm:w-1/2 lg:w-5/12 sm:pl-5" style="background: #eff7ff;">
                    <img class="h-20 sm:h-24 lg:h-26 -mb-3 sm:mb-0 lg:mb-3 transition duration-300 ease-in-out" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/off-the-charts/logo.png" loading="lazy" onload="this.classList.remove('opacity-0')" alt="30 day double bass logo">
                    <h2 class="mb-4"><strong>Quickly learn any song, any time.</strong></h2>
                    <h4 class="mb-7">Grab Off The Charts on its own with a digital workbook OR with 1 year of unlimited drum lessons + a charting book and pencils shipped to your door.</h4>
                    <div class="text-center sm:pb-5">
                        <div class="flex flex-wrap flex-col sm:flex-nowrap md:flex-row items-center justify-center mt-6 sm:mt-5 lg:mt-10">
                            <div class="w-full md:w-2/3 text-center sm:pr-2 my-1">
                                <div class="w-full">
                                    <a href="/ecommerce/add-to-cart?products[30-day-jazz]=1" x-data="{ isHovered: false }">
                                        <button class="text-xl md:text-2xl bg-drumeo uppercase rounded-full w-full sm:w-full md:w-full lg:w-full xl:w-full h-12 md:h-14 transition duration-300 ease-in-out text-white font-bebas tracking-widest" :style="'background-color: ' + (isHovered ? 'lighten($brand, 10%)' : 'bg-drumeo') + '; box-shadow: ' + (isHovered ? '0 0 7px rgba(0, 0, 0, 0.35)' : 'none') + '; filter: brightness(' + (isHovered ? '115%' : '100%') + ')'" @mouseenter="isHovered = true" @mouseleave="isHovered = false" style="background-color: bg-drumeo; box-shadow: none; filter: brightness(100%)">
                                            GET STARTED
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="w-full pt-4">
                            <h5 class="leading-tight"> ONLY
                                @if(floatval($productPrices['30-day-jazz']->price) > floatval($productPrices['30-day-jazz']->discounted_price))
                                    <s class="opacity-50 font-extralight">${{ floatval($productPrices['30-day-jazz']->price) }}</s>
                                    <strong>${{ floatval($productPrices['30-day-jazz']->discounted_price) }}</strong>
                                    <em class="text-drumeo text-sm">(Save {{ round(100 - (100 * (floatval($productPrices['30-day-jazz']->discounted_price) / floatval($productPrices['30-day-jazz']->price)))) }}%)</em>
                                @else
                                    <strong>${{ floatval($productPrices['30-day-jazz']->discounted_price) }}</strong>
                                @endif
                            </h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
     <section class="bg-[#DEEFFF] py-6 md:py-10 text-center">
        <p class="max-w-3xl px-4 md:px-2 leading-loose">
            <i class="fas fa-info-circle text-drumeo" aria-hidden="true"></i> <b>Shipping Disclaimer –</b> Your physical bonuses may not arrive by the course start date. We’ll do everything on our end to make it happen – the rest is up to the shipping gods.
        </p>
    </section>
    <section class="text-center py-10 text-white" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

{{--    @include('_partials.components.video-modal', [--}}
{{--        'name' => 'trailerM',--}}
{{--        'video' => '1018759528',--}}
{{--        'vimeo' => true,--}}
{{--        'styles' => 'pb-[177%] bg-white',--}}
{{--    ])--}}
    @include('_partials.components.video-modal', [
    'name' => 'trailer',
    'video' => '1025148415',
    'vimeo' => true,
    ])



    @include('drumeo.sales.partials._footer')

    @include('_partials.components.countdown', [
        'countdownDate' => '2024-10-28 00:00:00',
        'promoVersion' => false,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
