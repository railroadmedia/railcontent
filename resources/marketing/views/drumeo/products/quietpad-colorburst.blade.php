@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Drumeo QuietPad</title>
    <meta name="description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Drumeo QuietPad">
    <meta property="og:description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop()

@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('_partials.components.shop.promo-banner-2', [
        "name" => "Drumeo QuietPad",
        "fullPrice" => floatval($productPrices['quietpad']->price),
        "price" => floatval($productPrices['quietpad']->discounted_price),
        "noBreadcrumb" => true
    ])
    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#000;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-16 sm:h-24" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/drumeo-quietpad.png"><br>
                <h3 class="leading-tight my-3"><strong>Practice anywhere</strong> with<br class="lg:hidden"> two full-size playing surfaces.</h3>
                <h3 class="leading-tight">
                    @if(floatval($productPrices['quietpad']->price) > floatval($productPrices['quietpad']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['quietpad']->price) }}</s>
                        <strong>${{ floatval($productPrices['quietpad']->discounted_price) }}</strong>
                        <em class="text-musora text-sm">(Save {{ round(100 - (100 * (floatval($productPrices['quietpad']->discounted_price) / floatval($productPrices['quietpad']->price)))) }}%)</em>
                    @else
                        <strong>${{ floatval($productPrices['quietpad']->discounted_price) }}</strong>
                    @endif
                </h3>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline"   @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    @if( $products['quietpad']->getStockAvailability() > 1 && !empty($products['quietpad']->getStockAvailability()))
                        <a class="w-5/12 join smaller blue anchor-slide" href="#customize-anchor">GET YOURS &raquo;</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: radial-gradient(rgba(24,25,27,0.8), transparent);"></div>
                <img class="object-cover w-full h-full relative z-0" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/header-quiet-pad.jpg">
{{--        <video class="object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted--}}
{{--            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/eardrums-black/header2.mp4"></video>--}}
    </header>
    <section class="text-center px-3 sm:px-2 py-10 sm:py-12 lg:py-14" style="background:#fff!important;color:#000!important;">
        <div class="container mx-auto max-w-6xl">
            <h2 class="mb-4"><strong>One traditional side.<br class="hide-for-medium"> One quiet side.</strong></h2>
            <h5>The portable, double-sided practice pad<br class="hide-for-medium"> with different <br class="show-for-medium-only">volumes so you can<br class="hide-for-medium"> practice late into the night.</h5>
            <div class="pad-toggle">
                <div x-data="{ active: 'traditional' }" class="relative transition-colors duration-500 px-4 sm:px-0 sm:absolute sm:top-1/2 sm:left-4 md:left-4 sm:-translate-y-1/2 sm:w-[210px] md:w-[290px]">
                    <!-- Traditional Surface -->
                    <div @click="active = 'traditional'" class="pad-details transition-colors duration-500 relative p-4 sm:p-0"
                        :class="{ 'text-gray-500 sm:top-1/2 sm:left-4 md:left-4 sm:absolute sm:w-[210px] sm:-translate-y-1/2': active !== 'traditional', 'text-black z-10': active === 'traditional' }">
                        <svg class="w-9 relative -mt-8 left-1/2 transform -translate-x-1/2 sm:w-9 sm:mx-auto sm:mb-2 sm:relative sm:left-auto sm:top-auto" xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                            <g clip-path="url(#clip0_147_125)">
                                <path d="M37.0477 32.7145L22.5429 18.9124L35.3365 5.46802C36.0128 5.45043 36.6837 5.18488 37.1986 4.66987C38.265 3.60335 38.265 1.86797 37.1986 0.801526C36.132 -0.264996 34.3967 -0.26507 33.3302 0.801526C32.8305 1.30131 32.5486 1.96045 32.5308 2.66426L19.0003 15.5401L5.46895 2.66367C5.45091 1.96008 5.1691 1.30102 4.66954 0.801451C4.15283 0.284816 3.46593 0.000335693 2.73533 0.000335693C2.00472 0.000335693 1.31775 0.284964 0.80119 0.801526C0.284628 1.31809 0 2.00505 0 2.73566C0 3.46627 0.284628 4.15324 0.80119 4.6698C1.3012 5.16966 1.96063 5.45147 2.66482 5.46921L15.4569 18.9118L0.952151 32.7149C0.348679 33.289 0.0106875 34.064 0.000371093 34.897C-0.00994529 35.7298 0.308749 36.5131 0.897748 37.1022C1.47754 37.682 2.24534 37.9999 3.06367 37.9999C3.07673 37.9999 3.08972 37.9999 3.10278 37.9997C3.93581 37.9894 4.71073 37.6513 5.28503 37.048L19.0006 22.6349L32.7151 37.0474C33.2896 37.6511 34.0646 37.9891 34.8976 37.9994C34.9107 37.9994 34.9236 37.9996 34.9367 37.9996C35.7548 37.9996 36.5226 37.6817 37.1018 37.1025C37.6811 36.5245 38.0001 35.7549 38.0001 34.9353C37.9999 34.0875 37.6617 33.2987 37.0477 32.7145ZM34.4365 1.90775C34.6648 1.67953 34.9646 1.56538 35.2645 1.56538C35.5643 1.56538 35.8641 1.67961 36.0924 1.90775C36.549 2.36427 36.549 3.10713 36.0924 3.56365C35.6358 4.02016 34.8931 4.02016 34.4364 3.56365C34.2151 3.3424 34.0934 3.04842 34.0934 2.73566C34.0935 2.42298 34.2154 2.12885 34.4365 1.90775ZM3.56338 3.56365C3.34214 3.78489 3.04816 3.90654 2.7354 3.90654C2.42272 3.90654 2.12859 3.78482 1.90749 3.56365C1.68625 3.34255 1.56445 3.04842 1.56445 2.73566C1.56445 2.42291 1.68625 2.12885 1.90749 1.90775C2.12859 1.68651 2.42264 1.56472 2.7354 1.56472C3.04816 1.56472 3.34221 1.68651 3.56338 1.90775C3.78463 2.12885 3.90627 2.42291 3.90627 2.73566C3.90627 3.04842 3.78456 3.34247 3.56338 3.56365ZM4.33474 4.9548C4.4526 4.86952 4.56474 4.77482 4.66954 4.66995C4.77471 4.56485 4.86956 4.45241 4.95498 4.33433L17.8655 16.6198L16.5902 17.8334L4.33474 4.9548ZM4.15171 35.9693C3.87065 36.2647 3.49124 36.4302 3.08341 36.4353C2.67781 36.4391 2.29232 36.2843 2.00383 35.996C1.71541 35.7077 1.55941 35.3242 1.56453 34.9164C1.5695 34.5086 1.73508 34.1293 2.03055 33.8482L33.0449 4.33463C33.1304 4.45271 33.2253 4.565 33.3302 4.67002C33.4357 4.77556 33.5481 4.87019 33.6653 4.95487L4.15171 35.9693ZM35.9961 35.9957C35.7077 36.2841 35.3234 36.4401 34.9168 36.4351C34.509 36.4301 34.1295 36.2644 33.8482 35.9689L20.0803 21.5001L21.4644 20.0456L35.9693 33.8479C36.2699 34.134 36.4355 34.5201 36.4355 34.9353C36.4355 35.3363 36.2797 35.7127 35.9961 35.9957Z" fill="#0B76DB"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_147_125">
                                    <rect width="38" height="38" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <img class="w-60 mx-auto mt-8 relative z-10 sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper.png" alt="Quiet pad">
                        <h5 class="text-lg sm:text-base md:text-lg text-center"><strong>Traditional Surface</strong></h5>
                        <p class="my-1 sm:my-2 text-center">Durable. Realistic. Portable. The blue side offers a 12” playing surface, snare-like rebound, and everything you’d expect for every day practice. (You’ll love the hand-assembled quality.)</p>
                        <svg class="w-full h-9 max-h-8 sm:filter-sepia sm:saturate-150 sm:brightness-25 md:max-h-11" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="38" viewBox="0 0 100 38" fill="none" style="transform: scaleX(-1);">
                            <g filter="url(#filter0_i_147_124)">
                                <rect width="100" height="36.39" transform="translate(100.006 37.2709) rotate(180)" fill="url(#pattern0_147_124)"/>
                            </g>
                            <defs>
                                <filter id="filter0_i_147_124" x="0.00585938" y="0.88092" width="100" height="40.39" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feOffset dy="4"/>
                                    <feGaussianBlur stdDeviation="50"/>
                                    <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0.0431373 0 0 0 0 0.462745 0 0 0 0 0.858824 0 0 0 1 0"/>
                                    <feBlend mode="normal" in2="shape" result="effect1_innerShadow_147_124"/>
                                </filter>
                                <pattern id="pattern0_147_124" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_147_124" transform="scale(0.002 0.00549451)"/>
                                </pattern>
                                <image id="image0_147_124" width="500" height="182" xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>
                    </div>

                    <!-- Quiet Surface -->
                    <div @click="active = 'quiet'" class="pad-details transition-colors duration-500 relative p-4 sm:p-0"
                        :class="{ 'text-gray-500 sm:top-1/2 sm:right-4 md:right-4 sm:absolute sm:w-[210px] sm:-translate-y-1/2': active !== 'quiet', 'text-black z-10': active === 'quiet' }">
                        <img class="w-9 relative -mt-8 left-1/2 transform -translate-x-1/2 sm:w-9 sm:mx-auto sm:mb-2 sm:relative sm:left-auto sm:top-auto" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-moon.png" alt="Moon icon">
                        <img class="w-60 mx-auto mt-8 relative z-10 sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper-black.png" alt="Quietpad">
                        <h5 class="text-lg sm:text-base md:text-lg text-center"><strong>Quiet Surface</strong></h5>
                        <p class="my-1 sm:my-2 text-center">Shhhhhh. Avoid the tap-tappidy-tap complaints with our quiet side, up to 50% quieter than traditional pads and ideal for developing strength, endurance, and control. (You’ll love the way it feels.)</p>
                        <svg class="w-full h-9 max-h-8 sm:filter-sepia sm:saturate-150 sm:brightness-25 md:max-h-11" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="38" viewBox="0 0 100 38" fill="none">
                            <g filter="url(#filter0_i_147_124)">
                                <rect width="100" height="36.39" transform="translate(100.006 37.2709) rotate(180)" fill="url(#pattern0_147_124)"/>
                            </g>
                            <defs>
                                <filter id="filter0_i_147_124" x="0.00585938" y="0.88092" width="100" height="40.39" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feOffset dy="4"/>
                                    <feGaussianBlur stdDeviation="50"/>
                                    <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0.0431373 0 0 0 0 0.462745 0 0 0 0 0.858824 0 0 0 1 0"/>
                                    <feBlend mode="normal" in2="shape" result="effect1_innerShadow_147_124"/>
                                </filter>
                                <pattern id="pattern0_147_124" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_147_124" transform="scale(0.002 0.00549451)"/>
                                </pattern>
                                <image id="image0_147_124" width="500" height="182" xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>
                    </div>
                </div>


{{--                <div class="pad-details traditional active">--}}
{{--                    <svg class="pad-icon" xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none"><script xmlns=""/>--}}
{{--                        --}}
{{--                    </svg>--}}
{{--                    <img class="mobile-pad hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper.png" alt="Quiet pad">--}}
{{--                    <h5><strong>Traditional Surface</strong></h5>--}}
{{--                    <p class="my-1 sm:my-2">Durable. Realistic. Portable. The blue side offers a 12” playing surface, snare-like rebound, and everything you’d expect for every day practice. (You’ll love the hand-assembled quality.)</p>--}}
{{--                    <svg class="arrow active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="38" viewBox="0 0 100 38" fill="none" style="transform: scaleX(-1);"><script xmlns=""/>--}}
{{--                        --}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <div class="pad-details quiet">--}}
{{--                    <img class="pad-icon" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-moon.png" alt="Moon icon">--}}
{{--                    <img class="mobile-pad hide-for-medium" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper-black.png" alt="Quietpad">--}}
{{--                    <h5><strong>Quiet Surface</strong></h5>--}}
{{--                    <p class="my-1 sm:my-2">Shhhhhh. Avoid the tap-tappidy-tap complaints with our quiet side, up to 50% quieter than traditional pads and ideal for developing strength, endurance, and control. (You’ll love the way it feels.)</p>--}}
{{--                    <svg class="arrow active" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100" height="38" viewBox="0 0 100 38" fill="none"><script xmlns=""/>--}}
{{--                        <g filter="url(#filter0_i_147_124)">--}}
{{--                            <rect width="100" height="36.39" transform="translate(100.006 37.2709) rotate(180)" fill="url(#pattern0_147_124)"/>--}}
{{--                        </g>--}}
{{--                        <defs>--}}
{{--                            <filter id="filter0_i_147_124" x="0.00585938" y="0.88092" width="100" height="40.39" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">--}}
{{--                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>--}}
{{--                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>--}}
{{--                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>--}}
{{--                                <feOffset dy="4"/>--}}
{{--                                <feGaussianBlur stdDeviation="50"/>--}}
{{--                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>--}}
{{--                                <feColorMatrix type="matrix" values="0 0 0 0 0.0431373 0 0 0 0 0.462745 0 0 0 0 0.858824 0 0 0 1 0"/>--}}
{{--                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_147_124"/>--}}
{{--                            </filter>--}}
{{--                            <pattern id="pattern0_147_124" patternContentUnits="objectBoundingBox" width="1" height="1">--}}
{{--                                <use xlink:href="#image0_147_124" transform="scale(0.002 0.00549451)"/>--}}
{{--                            </pattern>--}}
{{--                            <image id="image0_147_124" width="500" height="182" xlink:href="data:image/png;base64,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"/>--}}
{{--                        </defs>--}}
{{--                    </svg>--}}
{{--                </div>--}}
                <div x-data="{ flipped: false }"
                    class="relative inline-block w-75 h-75 sm:w-[340px] sm:h-[340px] lg:w-[500px] lg:h-[500px] perspective-500"
                    :class="flipped ? 'sm:ml-[20px] md:ml-[30px]' : 'sm:mr-[20px] md:mr-[30px]'"
                    @click="flipped = !flipped"
                    style="transition: margin 0.5s ease-in, transform 0.5s ease-in; transform-style: preserve-3d;">
                    <div class="absolute left-0 top-0 w-full h-full bg-transparent bg-center bg-no-repeat bg-cover overflow-hidden backface-hidden transform rotate-y-180"
                        :class="flipped ? 'transform rotate-y-0' : 'transform rotate-y-180'"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper.png); transition: transform 0.5s ease-in;">
                        <i class="fad fa-repeat absolute top-1/2 left-1/2 text-4xl z-4 -m-5 opacity-0" style="transition: opacity 0.5s ease-in;"></i>
                    </div>
                    <div class="absolute left-0 top-0 w-full h-full bg-transparent bg-center bg-no-repeat bg-cover overflow-hidden backface-hidden transform rotate-y-0"
                        :class="flipped ? 'transform rotate-y-180' : 'transform rotate-y-0'"
                        style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/flipper-black.png); transition: transform 0.5s ease-in;">
                        <i class="fad fa-repeat absolute top-1/2 left-1/2 text-4xl z-4 -m-5 opacity-0" style="transition: opacity 0.5s ease-in;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 py-10 md:py-20 lg:py-24" style="background-color:#f4f8fb;">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>Your pad,<br class="sm:hidden"> your personality.</strong></h2>
            <h6 class="mt-2">Express yourself with 5 different color QuietPads (for a limited time only).</h6>

            @php
                $slides = [
                 [
                     'img' => 'marketing/drumeo/shop/quietkick/Quietkick-gallery-03.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/quietkick/Quietkick-gallery-04.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/quietkick/Quietkick-gallery-02.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/quietkick/Quietkick-gallery-01.jpg',
                 ],
             ];
             $scaleAnimation = 'cursor-pointer transform transition duration-500 ease-in-out hover:scale-105';
             $handleClick = 'handleClick';
            @endphp

            @component('drumeo._partials.modal-carousel', ['slides' => $slides, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])


                <div class="flex flex-wrap my-5 sm:my-10">
                    <div class="p-2 w-full sm:w-4/12"><div class="h-44 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(0)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[0]['img'] }}')"></div></div>
                    <div class="p-2 w-full sm:w-8/12"><div class="h-32 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(1)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')"></div></div>
                    <div class="p-2 w-full sm:w-8/12"><div class="h-36 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(2)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')"></div></div>
                    <div class="p-2 w-full sm:w-4/12"><div class="h-44 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(3)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')"></div></div>
                </div>

            @endcomponent
            <p class="leading-tight">Drum sticks and practice pad stand not included.</p>
        </div>
    </section>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>Finally, a practice pad<br class="inline sm:hidden"> for your feet.</strong></h2>
            <h6 class="mt-2">(Kick pedal not included)</h6>
            <div class="flex flex-wrap my-5 sm:my-9">
                @php
                    $reviews = [
                        [
                        "description" => '"I actually have two of these now and one stays at work for lunchtime practice sessions and one stays at home for late night rudiments. My wife works early shift patterns and goes to bed earlier in the evening and the quiet foam side is an ideal way to practice without disturbing her. I have also not had any complaints from my work colleagues when I sit quietly to one side and practice various sticking exercises at lunchtime."
                        <br><br><strong>Anthony S.</strong>',
                        ],
                        [
                        "description" => '"The blue surface is a classic rubber pad surface that allows the stick to bounce well. Here you can practice great doubles etc. I like to use the other side, which is colored black and has a slightly more impact-absorbing surface. More force has to be used here, which is great for training strength and endurance in the forearms. In addition, this is the special \"quiet\" surface, which is actually significantly quieter when touched. This means I can easily do my exercises in the next room without disturbing other roommates in the apartment."
                        <br><br><strong>FrizzB</strong>',
                        ],
                        [
                        "description" => '"With this practice pad I can practice whenever I want without disturbing others, even if it\'s the middle of the night. The blue side feels and sounds like a normal pad, the black side is quiet and has a bit less rebound. I enjoy using this, but most of all I\'m glad that I can pick it up whenever I want to without having to think about what time it is."
                        <br><br><strong>Kimiko</strong>',
                        ],
                    ]
                @endphp
                <div class="hidden sm:flex flex-wrap items-start text-left justify-center">
                    @foreach($reviews as $review)
                        <div class="w-full sm:w-1/3 px-2 lg:px-1 mb-4 lg:mb-2 ">
                            <div class="border-2 border-black rounded-xl px-5 py-9">
                                <div class="text-center mb-4">
                                    <i class="align-middle text-xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <p class="leading-normal text-sm">{!! $review['description'] !!}<br><br><em>Verified review via Thomann Music</em></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="relative flex sm:hidden w-full"
                    x-data="{
        init() {
            new Splide(this.$refs.splide, {
                        classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                                prev: 'hidden',
                                next: 'hidden',
                                pagination: 'hidden',
                        },
                        perPage: 1.5,
                        drag   : 'free',
                        snap   : false,
                        perMove: 1,
                        type: 'loop',
                        focus: 0,
                        interval: 2000,
            }).mount()
        },
    }"
                >
                    <div x-ref="splide" class="w-full splide">
                        <div class="splide__track relative">
                            <ul class="splide__list">
                                @foreach($reviews as $review)
                                    <li class="splide__slide flex flex-col items-center justify-center">
                                        <div class="flex flex-wrap items-start w-full sm:w-1/3 px-2 lg:px-3 mb-4 lg:mb-6 text-left">
                                            <div class="border-2 border-black rounded-xl px-5 py-9">
                                                <div class="text-center mb-4">
                                                    <i class="align-middle text-xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                    <i class="align-middle text-xl fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                                </div>
                                                <div>
                                                    <p class="leading-normal text-sm">{!! $review['description'] !!}<br><br><em>Verified review via Thomann Music</em></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

            <div id="customize-anchor" class="anchor"></div>


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
        'video' => '957405443',
        'vimeo' => true,
    ])

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
