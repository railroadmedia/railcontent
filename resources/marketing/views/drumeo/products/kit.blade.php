@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Alesis Nitro Max E-Kit | Drumeo Edition</title>
    <meta property="og:title" content="Alesis Nitro Max E-Kit | Drumeo Edition">

    <meta name="description" content="Everything you need to start playing the drums.">
    <meta property="og:description" content="Everything you need to start playing the drums.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/drumeo/products/kit/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>

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
            font-weight: 700;
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
            font:700 30px/1em "Bebas Neue", sans-serif;
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
    </style>
    <style>
        .join.outline.blue {
            border-color:#0b76db;
            color:#0b76db;
        }
        .join.smaller.outline {
            padding:12px 7%;
        }

        .text-gold {
            color:#d8b66e;
        }
        .join.gold {
            background:linear-gradient(to bottom, #e2c584, #ad7c12);
        }
    </style>

    @php
     if(!empty($membersVersion)) {
          $orderUrl = '/ecommerce/add-to-cart?products[alesis-ekit]=1&locked=true';
          $fullPrice = 499;
     }
     else {
          $orderUrl = '/ecommerce/add-to-cart?products[alesis-ekit]=1&products[drumeo_edge_1_year_access]=1&products[Drumeo-VaterSticks]=1&products[30-day-drummer-3]=1&products[30-day-chops]=1&locked=true';
          $fullPrice = 1005.95;
     }
    @endphp
@stop

@section('body-data')
    x-data="{
    waitlist: false,
    trailer: false,
    image1: false,
    image2: false,
    image3: false,
    image4: false,
    image5: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    @if(strpos(url()->full(), 'thankyou'))
        <div class="py-5 sm:py-7 px-6 text-center bg-green-400">
            <div class="container mx-auto max-w-xl">
                <h3 class="leading-tight mb-2"><strong>Thanks for contacting us!</strong></h3>
                <p class="leading-tight">You’re on the early access list for the next drop of Alesis E-Kits.<br class="hidden sm:inline"> Keep on eye on your inbox to get yours before anyone else.</p>
            </div>
        </div>
    @endif
<!-- hero section-->
<header class="text-white relative overflow-hidden z-20"
    style="height:700px;background:linear-gradient(to bottom, rgb(26, 26, 26), #1e1e1e);">
    <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
        <div class="container mx-auto max-w-5xl">
            <img class="h-4 md:h-5" alt="icon"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/drumeo/products/kit/drumeo-alesis-logo.png">
            <h1 class="leading-none my-5 uppercase font-lexend"><strong>
                    @if(empty($membersVersion))
                        Everything you need to<br class="hidden sm:inline"> start playing the drums.
                    @else
                        THE NEW DRUMEO<br class="hidden sm:inline"> DRUM KIT BY ALESIS
                    @endif
                </strong></h1>
            @if(empty($membersVersion))
                <h5 class="leading-normal text-musora mb-4 sm:mb-5">Get the highest-rated beginner e-kit <strong>PLUS</strong> a 1-Year Membership to Drumeo.<br>
                    <em>+ 3 LAUNCH-ONLY BONUSES</em></h5>
            @endif
            <h4 class="leading-tight mb-4 sm:mb-5 uppercase"> Only
                @if ($fullPrice > floatval($productPrices['alesis-ekit']->discounted_price))
                    <s class="opacity-50">${{ $fullPrice }}</s>
                    <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                    {{-- (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%) --}}
                @else
                    <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                @endif
            </h4>
            <div class="w-full max-w-xs mx-auto">
                @if ($products['alesis-ekit']->getStockAvailability() > 1 && !empty($products['alesis-ekit']->getStockAvailability()))
                    <a class="w-full join smaller blue" href="{{ $orderUrl }}">Buy Now</a>
                @else
                    <a class="w-full join smaller sold-out" @click="waitlist = true;">Join The Waitlist</a>
                @endif
                <br>
                <div class="join smaller outline mt-3" @click="trailer = true;"><i class="fas fa-play"></i> &nbsp;WATCH
                    THE TRAILER</div>
            </div>
            {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6> --}}
        </div>
    </div>
    <div class="h-full w-full absolute top-0 left-0 right-0 bottom-0 z-10 bg-black opacity-80"></div>
   <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop playsinline
       muted src="https://player.vimeo.com/progressive_redirect/playback/897277793/rendition/720p/file.mp4?loc=external&signature=2c77b974eb63073cc8631fffde2dfef4c1a0ee357f07bd63ef76a9577e287aef"></video>
</header>


<section>
    <!-- kit section-->
<div class="text-center px-3 sm:px-6 pt-8 sm:pt-6 relative"
    style="background: #01050D;">
     <div class="top-0 left-0 absolute w-full h-full z-10"
        style="background: linear-gradient(0deg, rgba(11, 118, 219, 0.20) 0%, rgba(11, 118, 219, 0.00) 100%)"></div>
    <div class="container mx-auto z-10 relative max-w-4xl text-white">
        <h2 class="leading-tight py-5"><strong>Pro details on a<br class="sm:hidden"> beginner budget.</strong></h2>
        <h6 class="leading-normal mb-7 sm:mb-10 px-2">We partnered with Alesis to bring you the best way to get started or <br class="hidden sm:block">
            get BACK into drumming – from apartment to full house.</h6>

        <picture>
            <source media="(min-width:768px)"
                srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/530x0/filters:quality(95)/marketing/drumeo/products/kit/alesis-drums-logo.png"
                type="image/png">
            <img class="transition-opacity opacity-0 h-10 md:h-12 mb-4" alt="icon" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/drumeo/products/kit/alesis-drums-logo.png">
        </picture>
        <picture>
            <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1800x0/filters:quality(95)/marketing/drumeo/products/kit/e-kit-chart-new.png">
            <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1440x0/filters:quality(95)/marketing/drumeo/products/kit/e-kit-chart-new.png">
            <img class="transition-opacity opacity-0 relative -mb-5 z-10" alt="icon" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/products/kit/e-kit-chart-new.png">
        </picture>

    </div>
</div>

<!-- next section-->
<div class="px-5 sm:px-8 py-10 sm:py-14 lg:py-20 text-white text-center sm:text-left" style="background: #01050D">
    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-wrap items-center mb-8 sm:mb-20">
            <div class="w-full sm:w-1/2 lg:w-7/12 mb-5 sm:mb-0 sm:order-1">
                <picture>
                    <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/kit/1-neighbor-friendly.png">
                    <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/1-neighbor-friendly.png">
                    <img class="transition-opacity opacity-0 rounded-xl mx-auto max-w-xs sm:max-w-full" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/1-neighbor-friendly.png">
                </picture>
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 sm:pr-7 lg:pr-10">
                <h4 class="leading-tight "><strong>Neighbor-Friendly Drums</strong></h4>
                <h6 class="leading-normal">Mesh heads give you the feel of real drums while maintaining a quiet volume for your neighbors and family.</h6>
            </div>
        </div>
        <div class="flex flex-wrap items-center mb-8 sm:mb-20">
            <div class="w-full sm:w-1/2 lg:w-7/12 mb-5 sm:mb-0">
                <picture>
                    <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/kit/2-favorite-songs-bluetooth.png">
                    <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/2-favorite-songs-bluetooth.png">
                    <img class="transition-opacity opacity-0 rounded-xl mx-auto max-w-xs sm:max-w-full" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/2-favorite-songs-bluetooth.png">
                </picture>
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 sm:pl-7 lg:pl-10">
                <h4 class="leading-tight"><strong>Play Your Favorite Songs</strong></h4>
                <h6 class="leading-normal">Bluetooth connectivity lets you seamlessly mix your drums with Spotify or Apple Music and play along.</h6>
            </div>
        </div>
        <div class="flex flex-wrap items-center mb-8 sm:mb-20">
            <div class="w-full sm:w-1/2 lg:w-7/12 mb-5 sm:mb-0 sm:order-1">
                <picture>
                    <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/kit/3-fits-anywhere3.png">
                    <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/3-fits-anywhere3.png">
                    <img class="transition-opacity opacity-0 rounded-xl mx-auto max-w-xs sm:max-w-full" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/3-fits-anywhere3.png">
                </picture>
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 sm:pr-7 lg:pr-10">
                <h4 class="leading-tight "><strong>Fits In Any Room</strong></h4>
                <h6 class="leading-normal">Space is a luxury for drummers. Your Nitro Max fits in any room and folds up for easy storage between jam sessions.</h6>
            </div>
        </div>
        <div class="flex flex-wrap items-center mb-8 sm:mb-20">
            <div class="w-full sm:w-1/2 lg:w-7/12 mb-5 sm:mb-0">
                <picture>
                    <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/kit/4-timing-metronome.png">
                    <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/4-timing-metronome.png">
                    <img class="transition-opacity opacity-0 rounded-xl mx-auto max-w-xs sm:max-w-full" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/4-timing-metronome.png">
                </picture>
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 sm:pl-7 lg:pl-10">
                <h4 class="leading-tight"><strong>Improve Your Timing & Feel</strong></h4>
                <h6 class="leading-normal">Develop your internal clock with a built-in metronome that tells you if you’re ahead or behind the beat. </h6>
            </div>
        </div>
        <div class="flex flex-wrap items-center mb-8 sm:mb-20">
            <div class="w-full sm:w-1/2 lg:w-7/12 mb-5 sm:mb-0 sm:order-1">
                <picture>
                    <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/kit/5-favorite-sounds.png">
                    <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/5-favorite-sounds.png">
                    <img class="transition-opacity opacity-0 rounded-xl mx-auto max-w-xs sm:max-w-full" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/5-favorite-sounds.png">
                </picture>
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 sm:pr-7 lg:pr-10">
                <h4 class="leading-tight "><strong>Choose Your Favorite Sounds</strong></h4>
                <h6 class="leading-normal">You’ll have 32 kit sounds from some of the most sampled drum sounds in history. You can find the perfect kit to play your favorite songs. </h6>
            </div>
        </div>
        <div class="flex flex-wrap items-center">
            <div class="w-full sm:w-1/2 lg:w-7/12 mb-5 sm:mb-0">
                <picture>
                    <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/kit/6-big-snare-drum.png">
                    <source media="(min-width:768px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/6-big-snare-drum.png">
                    <img class="transition-opacity opacity-0 rounded-xl mx-auto max-w-xs sm:max-w-full" alt="icon" loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/6-big-snare-drum.png">
                </picture>
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 sm:pl-7 lg:pl-10">
                <h4 class="leading-tight"><strong>More Snare Drum To Love</strong></h4>
                <h6 class="leading-normal">A 10” snare drum helps you play with better technique AND gives you two strike zones. (Most entry-level kits have a tiny 8” snare!).</h6>
            </div>
        </div>
    </div>
</div>
</section>


<!-- review section-->
<section class="text-center px-4 sm:px-6 py-8 sm:py-14 lg:py-16 relative" style="background:#EFF6FD">
    <div class="container mx-auto z-10 relative max-w-5xl">
        <h2 class="leading-tight mb-3"><strong>Rave reviews for<br class="sm:hidden"> the Alesis Nitro Max</strong></h2>
        <h6 class="leading-normal mb-5 sm:mb-10">The Alesis Nitro Max is the <br class="sm:hidden">highest-rated entry-level e-kit <strong>EVER</strong>.</h6>
    <div class="flex flex-wrap">
            <div class="w-full sm:w-1/3 px-2 sm:px-3 mb-4 sm:mb-0">
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-7 md:h-9 lg:h-10 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/210x0/filters:quality(95)/marketing/drumeo/products/kit/amazon-logo.png"
                        alt="Amazon Logo">
                </div>

                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>4.6</strong></h2>
                    <div class="flex justify-center">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= 4)
                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        @else
                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>
                </div>
            </div>
            </div>

            <div class="w-1/2 sm:w-1/3 px-2 sm:px-3 mb-4 sm:mb-0">
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-4 md:h-5 lg:h-6 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/marketing/drumeo/products/kit/music-radar-logo.png"
                        atl="Music Radar Logo">
                </div>

                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>5</strong></h2>
                    <div class="flex justify-center">
                    @for($i = 1; $i <= 5; $i++)
                    @if($i <= 5)
                        <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        @else
                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>

                </div>
            </div>
            </div>
        <div class="w-1/2 sm:w-1/3 px-2 sm:px-3 mb-4 sm:mb-0">
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                    <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                        <img class="h-5 md:h-7 lg:h-9 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/340x0/filters:quality(95)/marketing/drumeo/products/kit/thomann-logo.png"
                            alt="Thomann Logo">
                    </div>

                    <div class="flex flex-col align-bottom">
                        <h2 class="leading-tight my-2"><strong>4.3</strong></h2>
                        <div class="flex justify-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= 4)
                                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            @else
                                <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>
                            @endif
                        @endfor
                        </div>
                    </div>
            </div>
            </div>
{{--        <div class="w-1/2 sm:w-1/3 px-2 sm:px-3 mb-4 sm:mb-0">--}}
{{--            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">--}}
{{--                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">--}}
{{--                    <img class="h-7 md:h-10 lg:h-11 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"--}}
{{--                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/products/kit/sweetwater-logo.png"--}}
{{--                        alt="Sweetwater Logo">--}}
{{--                </div>--}}
{{--                <div class="flex flex-col align-bottom">--}}
{{--                    <h2 class="leading-tight my-2"><strong>5</strong></h2>--}}
{{--                    <div class="flex justify-center">--}}
{{--                        @for($i = 1; $i <= 5; $i++)--}}
{{--                        @if($i <= 5)--}}
{{--                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>--}}
{{--                        @else--}}
{{--                            <i class="align-middle text-lg fas fa-star-half" style="color: #ffac00;" aria-hidden="true"></i>--}}
{{--                        @endif--}}
{{--                    @endfor--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            </div>--}}
    </div>
    </div>
</section>



    @if(empty($membersVersion))
<section class="text-center px-4 sm:px-6 py-8 sm:py-12 lg:py-14 relative bg-drumeo text-white">
    <img class="w-10 md:w-16 -mt-3 sm:-mt-5 absolute top-0 left-1/2 translate -translate-x-1/2 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
        src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/union-icon.svg">

    <div class="container mx-auto z-10 relative max-w-5xl">
        <h4 class="leading-tight mb-5 sm:mb-7 italic">Your new e-kit includes one year of unlimited drum lessons with... </h4>
        <img class="w-40 md:w-80 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
            src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/drumeo-logo.svg">
    </div>
</section>



 @php
        $gridItems = $drumeo['gridItems'];
    @endphp

    @include('musora.sales.components.reason-cards-section', [
        'header' => 'Your drumming goals<br class="inline sm:hidden"> start here.',
        'desc' => 'Always know <em>exactly</em> what to practice with an organized 10-level <br class="hidden sm:inline">curriculum featuring many of the world’s best teachers. ',
        'shortVersion' => true,
    ])
@endif

<section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative bg-drumeo text-white">
    <div class="container mx-auto z-10 relative max-w-4xl">
        <h2 class="leading-tight"><strong>A double guarantee for peace of mind. </strong></h2>
        <p class="leading-tight mt-2 mb-5 sm:mb-7">Your E-Kit includes a 90-day purchase guarantee from Drumeo + a 1-year warranty from Alesis on all parts. </p>

        <picture>
            <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1270x0/filters:quality(95)/marketing/drumeo/products/kit/guarantee.png">
            <img class="transition-opacity opacity-0 h-16 sm:h-36" alt="icon" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/guarantee.png">
        </picture>
    </div>
</section>

<!-- buy section-->

    <div id="customize-anchor" class="anchor"></div>
    <section class="px-3 sm:px-0 text-center relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #fff, #f0f6fc 66%);">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap sm:flex-nowrap items-center px-4 sm:px-6 py-10 md:py-16 lg:py-20">
                <div class="text-center sm:text-left w-full sm:w-auto flex-shrink-0">
                    <h2 class="pb-6 sm:pb-4"><strong>
                            @if(empty($membersVersion))
                                Everything you need<br> to start playing<br> the drums.
                            @else
                                THE NEW DRUMEO DRUM KIT BY ALESIS
                            @endif
                        </strong></h2>
                    @if(empty($membersVersion))
                        <ul class="fa-ul text-left pl-6 mx-auto inline-block">
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> <strong>Alesis Nitro Max Drumeo Edition E-Kit</strong></li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> 1-Year Drumeo Membership (<s>$240</s> <strong>FREE</strong>)</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> 30-Day Drummer (<s>$127</s> <strong>FREE</strong>)</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> 30-Day Chops (<s>$127</s> <strong>FREE</strong>)</li>
                            <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> 5A Drumsticks (<s>$12.95</s> <strong>FREE</strong>)</li>
                        </ul>
                    @else
                        <h6 class="leading-tight">Get the ultimate starter e-kit.</h6>
                    @endif

                    <h4 class="my-4 text-drumeo"> ONLY
                        @if($fullPrice > floatval($productPrices['alesis-ekit']->discounted_price))
                            <s class="opacity-50">${{ $fullPrice }}</s>
                            <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                            {{-- (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%) --}}
                        @else
                            <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    @if ($products['alesis-ekit']->getStockAvailability() > 1 && !empty($products['alesis-ekit']->getStockAvailability()))
                        <a class="join blue smaller w-full max-w-xs" href="{{ $orderUrl }}">Buy Now</a>
                    @else
                        <a class="join sold-out smaller w-full max-w-xs" @click="waitlist = true;">Join The Waitlist</a>
                    @endif
                </div>
                <div class="flex justify-center sm:justify-start w-full sm:w-auto flex-grow-1 sm:order-1 sm:pl-5 mt-5 sm:mt-0">
                    @if(!empty($membersVersion))
                        <picture>
                            <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png">
                            <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png">
                            <img class="transition-opacity opacity-0 w-full" alt="icon" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png">
                        </picture>
                    @else
                        <picture>
                            <source media="(min-width:1024px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle.png">
                            <source media="(min-width:640px)" type="image/png" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/780x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle.png">
                            <img class="transition-opacity opacity-0 w-full" alt="icon" loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle.png">
                        </picture>
                    @endif
                </div>
            </div>
        </div>
    </section>

        <section class="px-4 sm:px-6 py-10">
        <div class="container max-w-5xl mx-auto relative z-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full mx-2">
                <p class="leading-normal text-left p-2" style="width: 100%"><strong>Free shipping USA / Canada</strong><br>
                    Your Drumeo E-Kit will ship for free anywhere in the United States and Canada. </p>

                <p class="leading-normal text-left p-2"><strong>Global Shipping</strong><br>
                    We’ve automatically applied a $100 shipping discount that you’ll see during the checkout process. You may also need to pay duty depending on your country’s regulations.
                    @if(!empty($membersVersion))
                        <br>Australia / New Zealand: <s>$267</s>  $167 shipping.
                        <br>Rest of World: <s>$147</s> $47 shipping.
                    @else
                        <br>Australia / New Zealand: <s>$280.50</s> $180.50 shipping.
                        <br>Rest of World: <s>$160.50</s> $60.50 shipping.
                    @endif
                </p>
            </div>
        </div>
    </section>


<!-- details section-->

<section class="px-4 md:px-6 py-8 sm:py-16 lg:py-20" style="background: #01050D">
    <div class="container mx-auto p-4 max-w-5xl">
        <h2 class="text-white text-center leading-tight"><strong>All in one tidy package.</strong></h2>

        <div class="flex flex-wrap md:flex-nowrap gap-4 pt-10">
            <div class="md:hidden w-full">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/products/kit/gallery-02a.png" alt="Drum kit" class="w-full h-auto transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/products/kit/gallery-01.png" alt="Drum kit" class="w-full h-auto py-6 transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
            <div class="order-1 md:w-2/3 lg:w-3/4">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/products/kit/gallery-full2.webp" alt="Drum kit" class="w-full h-full md:block hidden transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
            <div class="w-full md:w-1/3 lg:w-1/4 flex items-center justify-center">
                <table class="w-full h-full bg-white rounded-xl">
                    <tbody>
                        @php
                            if(empty($membersVersion)) {
                                $items = [
                                    ["Drumeo Membership", "1"],
                                    ["Alesis Nitro Max E-Kit", "1"],
                                    ["10” Snare Pad", "1"],
                                    ["8” Tom Pads", "3"],
                                    ["3 10” Cymbal Pads", "3"],
                                    ["Drum Module", "1"],
                                    ["Kick Tower", "1"],
                                    ["Kick Pedal", "1"],
                                    ["5A Drumsticks", "1"]
                                ];
                            } else {
                                $items = [
                                    ["Alesis Nitro Max E-Kit", "1"],
                                    ["10” Snare Pad", "1"],
                                    ["8” Tom Pads", "3"],
                                    ["3 10” Cymbal Pads", "3"],
                                    ["Drum Module", "1"],
                                    ["Kick Tower", "1"],
                                    ["Kick Pedal", "1"],
                                    ["5A Drumsticks", "1"]
                                ];
                            }
                        @endphp

                        @foreach($items as $item)
                        <tr class="border border-black">
                            <td class="border border-black pl-4">{{ $item[0] }}</td>
                            <td class="border border-black text-center px-4">{{ $item[1] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <p class="p-4 text-center hidden md:block" style="color: rgb(135, 144, 151, 1.2)"> <strong>Depth</strong> 36" (91.44cm) // <strong>Width</strong> 48" (121.92cm) //  <strong>Height</strong> 12.12" (30.78cm)</p>

        <div class="w-full max-w-xs mx-auto pt-4">
            @if ($products['alesis-ekit']->getStockAvailability() > 1 && !empty($products['alesis-ekit']->getStockAvailability()))
                <a class="join blue smaller w-full max-w-xs" href="{{ $orderUrl }}">Buy Now</a>
            @endif
        </div>

    </div>
</section>

    <section class="text-center py-10 text-white" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 opacity-60">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 opacity-60" style="margin-top: 0;">
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
        'video' => '897276787',
        'vimeo' => true,
    ])

    @component('_partials.components.modal',[
        'name' => 'waitlist',
    ])
        @slot('content')
            <div class="relative overflow-y-visible max-w-3xl px-4 md:px-5 lg:px-7 py-5 md:py-7 lg:py-10 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                <h3 class="leading-tight mb-5"><strong>Notify Me When They’re Back</strong></h3>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - Alesis Waitlist - Web Form",
                    "formName" => 'Alesis Waitlist',
                    "buttonText" => "Notify Me",
                    'stacked' => true,
                    "redirectURL" => "/drumshop/kit?notify",
                    "recaptchaKey" => $recaptchaKey,
                    "minimalForm" => true
                ])

            </div>
        @endslot
    @endcomponent

    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" async defer></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" async defer></script>
@stop
