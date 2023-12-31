@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Alesis Nitro Max E-Kit | Drumeo Edition</title>
    <meta property="og:title" content="Alesis Nitro Max E-Kit | Drumeo Edition">

    <meta name="description" content="Everything you need to start playing the drums.">
    <meta property="og:description" content="Everything you need to start playing the drums.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)//marketing/drumeo/products/kit/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
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

<!-- hero section-->
<header class="text-white relative overflow-hidden z-20"
    style="height:700px;background:linear-gradient(to bottom, rgb(26, 26, 26), #1e1e1e);">
    <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
        <div class="container mx-auto max-w-5xl">
            <picture>
                <source
                    srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/kit/drumeo-alesis-logo.png"
                    type="image/png">
                <img class="transition-opacity opacity-0 h-4 md:h-5" alt="icon" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/kit/drumeo-alesis-logo.png">
            </picture>
            <h1 class="leading-none my-5 uppercase font-lexend"><strong>Everything you need to<br class="hidden sm:inline"> start
                    playing the drums.</strong></h1>
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
                    <a class="w-full join smaller sold-out">SOLD OUT</a>
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
       muted src="https://player.vimeo.com/progressive_redirect/playback/897277793/rendition/1080p/file.mp4?loc=external&signature=54243ca347163456312ff377c17948ff48334aa49e5375628363ab40a7049cde"></video>
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
            <source
                srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)//marketing/drumeo/products/kit/alesis-drums-logo.png"
                type="image/png">
            <img class="transition-opacity opacity-0 h-10 md:h-12 mb-4" alt="icon" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)//marketing/drumeo/products/kit/alesis-drums-logo.png">
        </picture>

            <img class="transition-opacity opacity-0 relative -mb-5 z-10" alt="icon" loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/e-kit-chart-new.png">

    </div>
</div>

<!-- next section-->
<div class="px-4 sm:px-6 py-16 text-white" style="background: #01050D">
    <div class="container max-w-5xl mx-auto relative z-50">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 w-full mx-2">
            <div class="px-1">
                <h5 class="leading-normal text-left"><strong>Neighbor-Friendly Drums</strong></h5>
                <h5 class="pt-4 leading-normal text-left">Mesh heads give you the feel of real drums while maintaining a quiet volume for your neighbors and family.</h5>
            </div>
            <div class="px-1">
                <h5 class="leading-normal text-left"><strong>Play Your Favorite Songs</strong></h5>
                <h5 class="pt-4 leading-normal text-left">Bluetooth connectivity lets you seamlessly mix your drums with Spotify or Apple Music and play along.</h5>
            </div>
            <div class="px-1">
                <h5 class="leading-normal text-left"><strong>Fits In Any Room</strong></h5>
                <h5 class="leading-normal text-left pt-4">Space is a luxury for drummers. Your Nitro Max fits in any room and folds up for easy storage between jam sessions.</h5>
            </div>
            <div class="px-1">
                <h5 class="leading-normal text-left"><strong>Improve Your Timing & Feel</strong></h5>
                <h5 class="pt-4 leading-normal text-left">Develop your internal clock with a built-in metronome that tells you if you’re ahead or behind the beat. </h5>
            </div>
            <div class="px-1">
                <h5 class="leading-normal text-left"><strong>Choose Your Favorite Sounds</strong></h5>
                <h5 class="pt-4 leading-normal text-left">You’ll have 32 kit sounds from some of the most sampled drum sounds in history. You can find the perfect kit to play your favorite songs. </h5>
            </div>
            <div class="px-1">
                <h5 class="leading-normal text-left"><strong>Big Fat Snare Drum</strong></h5>
                <h5 class="leading-normal text-left pt-4">A 10” snare drum helps you play with better technique AND gives you two strike zones. (Most entry-level kits have a tiny 8” snare!).</h5>
            </div>
        </div>
    </div>
</div>
</section>


<!-- review section-->
<section class="text-center px-4 sm:px-6 py-8 sm:py-14 lg:py-16 relative" style="background:#EFF6FD">
    <div class="container mx-auto z-10 relative max-w-5xl">
        <h2 class="leading-tight mb-3"><strong>Rave reviews for<br class="sm:hidden"> the Alesis Nitro Max</strong></h2>
        <h6 class="leading-normal mb-3 sm:mb-4">The Alesis Nitro Max is the <br class="sm:hidden">highest-rated entry-level e-kit <strong>EVER</strong>.</h6>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 lg:gap-6 pt-6">
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-7 md:h-9 lg:h-10"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/amazon-logo.png"
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

            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-4 md:h-5 lg:h-6"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/music-radar-logo.png"
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
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                    <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                        <img class="h-5 md:h-7 lg:h-9"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/thomann-logo.png"
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
            <div class="rounded-xl border-2 px-4 py-5 sm:py-8" style="border-color:#cad1e4; background: white;">
                <div class="h-7 md:h-10 lg:h-12 flex items-start justify-center">
                    <img class="h-7 md:h-10 lg:h-11"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/products/kit/sweetwater-logo.png"
                        alt="Sweetwater Logo">
                </div>
                <div class="flex flex-col align-bottom">
                    <h2 class="leading-tight my-2"><strong>5</strong></h2>
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
    </div>
</section>



    @if(empty($membersVersion))
<section class="text-center px-4 sm:px-6 py-8 sm:py-12 lg:py-14 relative bg-drumeo text-white">
    <img class="w-8 md:w-16 -mt-5 absolute top-0 left-1/2 translate -translate-x-1/2" src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/union-icon.svg">

    <div class="container mx-auto z-10 relative max-w-5xl">
        <h4 class="leading-tight mb-5 sm:mb-7 italic">Your new e-kit includes one year of unlimited drum lessons with... </h4>
        <img class="w-40 md:w-80" src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/drumeo-logo.svg">
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
        <img class="h-16 sm:h-36" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/guarantee.png">
    </div>
</section>

<!-- buy section-->

    <div id="customize-anchor" class="anchor"></div>
    <section class="px-3 sm:px-0 text-center relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #fff, #f0f6fc 66%);">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center px-4 sm:px-6 pt-10 md:py-10 lg:py-20">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5">
                    <h2 class="pb-6 sm:pb-4"><strong>Everything you need<br> to start playing<br> the drums.</strong></h2>
                    <h6 class="leading-tight">
                        @if(empty($membersVersion))
                            Get the ultimate starter e-kit + 1 year of unlimited drum lessons + 3 extra launch bonuses.
                        @else
                            Get the ultimate starter e-kit.
                        @endif
                    </h6>

                    <h4 class="my-4 text-drumeo"> ONLY
                        @if($fullPrice > floatval($productPrices['alesis-ekit']->discounted_price))
                            <s class="opacity-50">${{ $fullPrice }}</s>
                            <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                            {{-- (Save {{ round(100 - (100 * (floatval($productPrices['alesis-ekit']->discounted_price) / floatval($productPrices['alesis-ekit']->price)))) }}%) --}}
                        @else
                            <strong>${{ floatval($productPrices['alesis-ekit']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="{{ $orderUrl }}" class="join blue smaller w-full max-w-xs">BUY NOW</a>
                </div>
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                    <img class="w-full"
                        @if(!empty($membersVersion))
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png"
                        @else
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle.png"
                        @endif
                        alt="collage">
                </div>
            </div>
        </div>
        <div class="w-full sm:hidden text-center py-8">
            <img
                @if(!empty($membersVersion))
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-lifetime.png"
                @else
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/products/kit/ekit-bundle.png"
                @endif
                alt="collage">
        </div>
    </section>

        <section class="px-4 sm:px-6 py-10">
        <div class="container max-w-5xl mx-auto relative z-50">
            <h2 class="leading-tight mb-5 w-full text-center"><strong>E-Kit Shipping Notice</strong></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full mx-2">
                <p class="leading-normal text-left p-2" style="width: 100%"><strong>Free shipping USA / Canada</strong><br>
                    Your Drumeo E-Kit will ship for free anywhere in the United States and Canada. </p>

                <p class="leading-normal text-left p-2"><strong>Global Shipping</strong><br>
                    We’ve automatically applied a $100 shipping discount that you’ll see during the checkout process. You may also need to pay duty depending on your country’s regulations.
                    <br></br>Australia / New Zealand: <s>$267</s>  $167 shipping.
                    <br>Rest of World: <s>$147</s> $47 shipping.
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
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/gallery-02.png" alt="Drum kit" class="w-full h-auto">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/gallery-01.png" alt="Drum kit" class="w-full h-auto py-6">
            </div>

            <div class="w-full  md:w-1/3 lg:w-1/4 flex items-center justify-center">
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
                <div class="md:w-2/3 lg:w-3/4">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/marketing/drumeo/products/kit/gallery-full.png" alt="Drum kit" class="w-full h-full md:block hidden">
                </div>
        </div>

        <p class="p-4 text-center hidden md:block" style="color: rgb(135, 144, 151, 1.2)"> <strong>Height</strong> 12.12" (30.78cm) // <strong>Depth</strong> 21" (53.34cm) // <strong>Width</strong> 36.2" (91.94cm)</p>

        <div class="w-full max-w-xs mx-auto pt-4">
            <a href="{{ $orderUrl }}" class="join blue smaller w-full max-w-xs">BUY NOW</a>
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


    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>

@stop
