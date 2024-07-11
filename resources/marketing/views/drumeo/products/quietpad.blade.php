@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>Drumeo QuietPad</title>
    <meta name="description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/share-image.jpg" style="display: none;">
    <meta property="og:title" content="Drumeo QuietPad">
    <meta property="og:description" content="Practice anywhere with two full-size playing surfaces.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop()

@section('body-data')
    x-data="{
    trailer: false,
    trailerM: false,
    selectedIndex: 2,
    selectedProduct: '#0B76DB',
    colors: {
    '#BB16A3': ['quietpad-color-burst-purple', 'Paradiddle', 'Pink'],
    '#3CDBC0': ['quietpad-color-burst-turquoise', 'Triplet', 'Teal'],
    '#0B76DB': ['quietpad', 'Drumeo', 'Blue'],
    '#79C300': ['quietpad-color-burst-green', 'Ghostnote', 'Green'],
    '#FF6900': ['quietpad-color-burst-orange', 'Ostinato', 'Orange']
    },
    hoverIndex: null
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
    <header class="text-white relative overflow-hidden z-10" style="height:700px;background-color:#ccc;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img class="inline-block h-16 sm:h-24 transition-all duration-300" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/logo.svg">
                <br>
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
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block"   @click="trailerM = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>

                    @if( $products['quietpad']->getStockAvailability() > 1 && !empty($products['quietpad']->getStockAvailability()))
                        <a class="w-5/12 join smaller anchor-slide transition-all duration-300 ease-in"
                            style="background-color:#0B76DB;"
                            :style="'background-color:' + selectedProduct;"
                            href="#customize-anchor">GET YOURS &raquo;</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                </div>
            </div>
        </div>
        {{--        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: radial-gradient(rgba(24,25,27,0.5), transparent);"></div>--}}
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0,0,0,0.4);"></div>
        {{--                <img class="object-cover w-full h-full relative z-0" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/header-quiet-pad.jpg">--}}
        <video class="object-cover w-full relative z-0" style="height: 100%;" type="video/mp4" autoplay loop playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/quietpad-colorburst/header.mp4"></video>
    </header>
    <div class="px-3 sm:px-6 py-5 sm:py-10 text-center text-white transition-all duration-300"
        style="background-color:#0B76DB;"
        :style="'background-color:' + selectedProduct;">
        <h1 class="uppercase font-bebas leading-none">Limited Time COLORBURST Series</h1>
        <h6 class="leading-tight mb-4">5 different color QuietPads to choose from below:</h6>
        <div class="flex flex-row max-w-md justify-center mx-auto">
            <template x-for="(color, index) in Object.keys(colors)" :key="index">
                <div class="relative cursor-pointer"
                    @click="selectedIndex = index; selectedProduct = color;">
                    <div class="relative inline-block rounded-full sm:p-0.5 border-2 border-transparent"
                        :class="selectedIndex === index ? 'border-white' : 'hover:border-white hover:sm:border-opacity-50 border-transparent'">
                        <img class="rounded-full"
                            :style="'background-color:' + color"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/170x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/flipper-transparent.png">
                        <i x-show="selectedIndex === index" class="fas fa-check absolute top-1/2 left-1/2 text-4xl leading-none transform -translate-x-1/2 -translate-y-1/2"></i>
                        </svg>
                    </div>
                    <p class="mt-1 text-sm leading-tight">
                        <em x-text="colors[color][1]"></em><br>
                        <strong class="font-black" x-text="colors[color][2]"></strong>
                    </p>
                </div>
            </template>
        </div>
    </div>
    <section class="text-center px-5 sm:px-2 py-10 sm:py-12 lg:py-14">
        <div class="container mx-auto max-w-6xl">
            <h2 class="leading-tight"><strong>One traditional side.<br class="sm:hidden"> One quiet side.</strong></h2>
            <h6 class="leading-tight mt-3 mb-6">The portable, double-sided practice pad<br class="sm:hidden"> with different <br class="hidden sm:inline lg:hidden">volumes so you can<br class="sm:hidden"> practice late into the night.</h6>
            <div class="relative" x-data="{ flipped: false }">
                <div @click="flipped = false" class="transition-opacity duration-300 ease-in relative sm:top-1/2 sm:left-0 sm:absolute sm:-translate-y-1/2 sm:w-40 md:w-52 xl:w-72"
                    :class="flipped ? 'sm:opacity-30' : 'z-10'"
                >
                    <svg class="hidden sm:inline-block relative -mt-8 w-9 sm:mx-auto sm:mb-2 transition-all duration-300 ease-in" xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                        <g clip-path="url(#clip0_147_125)">
                            <path d="M37.0477 32.7145L22.5429 18.9124L35.3365 5.46802C36.0128 5.45043 36.6837 5.18488 37.1986 4.66987C38.265 3.60335 38.265 1.86797 37.1986 0.801526C36.132 -0.264996 34.3967 -0.26507 33.3302 0.801526C32.8305 1.30131 32.5486 1.96045 32.5308 2.66426L19.0003 15.5401L5.46895 2.66367C5.45091 1.96008 5.1691 1.30102 4.66954 0.801451C4.15283 0.284816 3.46593 0.000335693 2.73533 0.000335693C2.00472 0.000335693 1.31775 0.284964 0.80119 0.801526C0.284628 1.31809 0 2.00505 0 2.73566C0 3.46627 0.284628 4.15324 0.80119 4.6698C1.3012 5.16966 1.96063 5.45147 2.66482 5.46921L15.4569 18.9118L0.952151 32.7149C0.348679 33.289 0.0106875 34.064 0.000371093 34.897C-0.00994529 35.7298 0.308749 36.5131 0.897748 37.1022C1.47754 37.682 2.24534 37.9999 3.06367 37.9999C3.07673 37.9999 3.08972 37.9999 3.10278 37.9997C3.93581 37.9894 4.71073 37.6513 5.28503 37.048L19.0006 22.6349L32.7151 37.0474C33.2896 37.6511 34.0646 37.9891 34.8976 37.9994C34.9107 37.9994 34.9236 37.9996 34.9367 37.9996C35.7548 37.9996 36.5226 37.6817 37.1018 37.1025C37.6811 36.5245 38.0001 35.7549 38.0001 34.9353C37.9999 34.0875 37.6617 33.2987 37.0477 32.7145ZM34.4365 1.90775C34.6648 1.67953 34.9646 1.56538 35.2645 1.56538C35.5643 1.56538 35.8641 1.67961 36.0924 1.90775C36.549 2.36427 36.549 3.10713 36.0924 3.56365C35.6358 4.02016 34.8931 4.02016 34.4364 3.56365C34.2151 3.3424 34.0934 3.04842 34.0934 2.73566C34.0935 2.42298 34.2154 2.12885 34.4365 1.90775ZM3.56338 3.56365C3.34214 3.78489 3.04816 3.90654 2.7354 3.90654C2.42272 3.90654 2.12859 3.78482 1.90749 3.56365C1.68625 3.34255 1.56445 3.04842 1.56445 2.73566C1.56445 2.42291 1.68625 2.12885 1.90749 1.90775C2.12859 1.68651 2.42264 1.56472 2.7354 1.56472C3.04816 1.56472 3.34221 1.68651 3.56338 1.90775C3.78463 2.12885 3.90627 2.42291 3.90627 2.73566C3.90627 3.04842 3.78456 3.34247 3.56338 3.56365ZM4.33474 4.9548C4.4526 4.86952 4.56474 4.77482 4.66954 4.66995C4.77471 4.56485 4.86956 4.45241 4.95498 4.33433L17.8655 16.6198L16.5902 17.8334L4.33474 4.9548ZM4.15171 35.9693C3.87065 36.2647 3.49124 36.4302 3.08341 36.4353C2.67781 36.4391 2.29232 36.2843 2.00383 35.996C1.71541 35.7077 1.55941 35.3242 1.56453 34.9164C1.5695 34.5086 1.73508 34.1293 2.03055 33.8482L33.0449 4.33463C33.1304 4.45271 33.2253 4.565 33.3302 4.67002C33.4357 4.77556 33.5481 4.87019 33.6653 4.95487L4.15171 35.9693ZM35.9961 35.9957C35.7077 36.2841 35.3234 36.4401 34.9168 36.4351C34.509 36.4301 34.1295 36.2644 33.8482 35.9689L20.0803 21.5001L21.4644 20.0456L35.9693 33.8479C36.2699 34.134 36.4355 34.5201 36.4355 34.9353C36.4355 35.3363 36.2797 35.7127 35.9961 35.9957Z"
                                :fill="selectedProduct"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_147_125">
                                <rect width="38" height="38" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <img class="h-56 z-10 sm:hidden mx-auto mb-4 overflow-hidden rounded-full transition-all duration-300 ease-in" :style="'background-color:' + selectedProduct;"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/flipper-transparent.png">
                    <h5 class="text-lg sm:text-base md:text-lg"><strong>Traditional Surface</strong></h5>
                    <p class="mt-1 sm:my-2">Durable. Realistic. Portable. The blue side offers a 12” playing surface, snare-like rebound, and everything you’d expect for every day practice. (You’ll love the hand-assembled quality.)</p>
                    <div class="w-full text-right">
                        <svg class="hidden sm:inline-block transition-all duration-300 ease-in" :class="flipped ? 'opacity-0' : ''"
                            xmlns="http://www.w3.org/2000/svg" width="101" height="36" viewBox="0 0 101 36" fill="none"><script xmlns=""/>
                            <path d="M0.918727 24.7345C1.14219 23.3086 2.49471 22.3243 3.93228 22.5374C14.5883 24.127 26.0624 24.2762 38.0353 22.9826C47.6483 21.9452 57.6024 19.9792 67.6184 17.1405C76.7424 14.5564 84.2627 11.7193 89.5559 9.49918L73.8747 5.52131C72.4676 5.16524 71.6229 3.73829 71.9904 2.34173C72.1689 1.66478 72.6024 1.0959 73.2091 0.740203C73.8176 0.38399 74.5277 0.282766 75.2098 0.455801L98.085 6.2599L98.1697 6.28215C98.2029 6.29126 98.2361 6.30037 98.268 6.31174L98.2977 6.32188C98.3251 6.3308 98.3525 6.33972 98.3913 6.35474L98.4106 6.36225C98.4403 6.37239 98.4688 6.38479 98.4927 6.39474L98.5427 6.41586C98.5649 6.42633 98.5888 6.43629 98.6064 6.44431C98.6285 6.45478 98.6507 6.46525 98.6733 6.47746L98.7164 6.50065C98.7458 6.51651 98.7735 6.5329 98.8053 6.54998L98.8234 6.55975C98.8534 6.57735 98.8838 6.59669 98.9143 6.61603L98.9425 6.63415C98.9712 6.654 99.0022 6.67508 99.0292 6.69545L99.0635 6.72122C99.0781 6.73202 99.0932 6.74455 99.1005 6.74995C99.2144 6.83909 99.3216 6.93775 99.417 7.04176L99.437 7.0642C99.4514 7.08072 99.4658 7.09724 99.4857 7.11968C99.4996 7.13446 99.5117 7.14976 99.5355 7.17863C99.6688 7.34694 99.7825 7.53238 99.8698 7.72556L99.8799 7.7471C99.8931 7.77906 99.9058 7.80929 99.9185 7.83951L99.9597 7.95379C99.9659 7.97463 99.972 7.99547 99.9751 8.00589L99.9955 8.07535L100.075 8.44827L100.098 8.8377L100.057 9.25144C100.05 9.2856 100.045 9.31925 100.033 9.36989C100.024 9.4063 100.014 9.44324 100.006 9.47966L100.002 9.49786C99.9911 9.53306 99.9805 9.56826 99.9699 9.60345L99.9573 9.64489C99.9476 9.67037 99.9384 9.69759 99.9255 9.73157C99.9126 9.76554 99.898 9.80004 99.8821 9.83678L99.8744 9.85602C99.8625 9.88028 99.8528 9.90576 99.8371 9.93678L99.683 10.2104C99.6713 10.2289 99.6578 10.248 99.6473 10.2642C99.6246 10.2973 99.6002 10.3309 99.5837 10.3527L81.7039 34.0935C81.3581 34.5517 80.8831 34.8819 80.3319 35.0439C79.5385 35.2772 78.6723 35.1262 78.0123 34.6392C77.4479 34.224 77.0836 33.6142 76.9834 32.923C76.8832 32.2318 77.0622 31.5434 77.4844 30.9816L89.3255 15.2606C84.3361 17.2688 77.4032 19.8011 69.1223 22.1524C58.8097 25.0784 48.55 27.1078 38.6291 28.181C26.1874 29.5275 14.2422 29.3715 3.12153 27.7129C1.68396 27.4998 0.698551 26.1651 0.922015 24.7392L0.918727 24.7345Z"
                                :fill="selectedProduct"/>
                        </svg>
                    </div>
                </div>
                <div @click="flipped = true" class="transition-opacity duration-300 ease-in relative sm:top-1/2 sm:right-0 sm:absolute sm:-translate-y-1/2 sm:w-40 md:w-52 xl:w-72"
                    :class="flipped ? 'z-10' : 'sm:opacity-30'">
                    <img class="hidden sm:inline-block relative -mt-8 w-9 sm:mx-auto sm:mb-2 filter invert" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietpad/icon-moon.png" alt="Moon icon">
                    <img class="h-56 z-10 mb-4 mt-8 sm:hidden mx-auto overflow-hidden rounded-full" style="background-color:#333;"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/flipper-transparent.png">
                    <h5 class=""><strong>Quiet Surface</strong></h5>
                    <p class="mt-1 sm:my-2">Shhhhhh. Avoid the tap-tappidy-tap complaints with our quiet side, up to 50% quieter than traditional pads and ideal for developing strength, endurance, and control. (You’ll love the way it feels.)</p>
                    <div class="w-full text-left">
                        <svg class="hidden sm:inline-block transition-all duration-300 ease-in" :class="flipped ? '' : 'opacity-0'"
                            style="transform: scaleX(-1);"
                            xmlns="http://www.w3.org/2000/svg" width="101" height="36" viewBox="0 0 101 36" fill="none"><script xmlns=""/>
                            <path d="M0.918727 24.7345C1.14219 23.3086 2.49471 22.3243 3.93228 22.5374C14.5883 24.127 26.0624 24.2762 38.0353 22.9826C47.6483 21.9452 57.6024 19.9792 67.6184 17.1405C76.7424 14.5564 84.2627 11.7193 89.5559 9.49918L73.8747 5.52131C72.4676 5.16524 71.6229 3.73829 71.9904 2.34173C72.1689 1.66478 72.6024 1.0959 73.2091 0.740203C73.8176 0.38399 74.5277 0.282766 75.2098 0.455801L98.085 6.2599L98.1697 6.28215C98.2029 6.29126 98.2361 6.30037 98.268 6.31174L98.2977 6.32188C98.3251 6.3308 98.3525 6.33972 98.3913 6.35474L98.4106 6.36225C98.4403 6.37239 98.4688 6.38479 98.4927 6.39474L98.5427 6.41586C98.5649 6.42633 98.5888 6.43629 98.6064 6.44431C98.6285 6.45478 98.6507 6.46525 98.6733 6.47746L98.7164 6.50065C98.7458 6.51651 98.7735 6.5329 98.8053 6.54998L98.8234 6.55975C98.8534 6.57735 98.8838 6.59669 98.9143 6.61603L98.9425 6.63415C98.9712 6.654 99.0022 6.67508 99.0292 6.69545L99.0635 6.72122C99.0781 6.73202 99.0932 6.74455 99.1005 6.74995C99.2144 6.83909 99.3216 6.93775 99.417 7.04176L99.437 7.0642C99.4514 7.08072 99.4658 7.09724 99.4857 7.11968C99.4996 7.13446 99.5117 7.14976 99.5355 7.17863C99.6688 7.34694 99.7825 7.53238 99.8698 7.72556L99.8799 7.7471C99.8931 7.77906 99.9058 7.80929 99.9185 7.83951L99.9597 7.95379C99.9659 7.97463 99.972 7.99547 99.9751 8.00589L99.9955 8.07535L100.075 8.44827L100.098 8.8377L100.057 9.25144C100.05 9.2856 100.045 9.31925 100.033 9.36989C100.024 9.4063 100.014 9.44324 100.006 9.47966L100.002 9.49786C99.9911 9.53306 99.9805 9.56826 99.9699 9.60345L99.9573 9.64489C99.9476 9.67037 99.9384 9.69759 99.9255 9.73157C99.9126 9.76554 99.898 9.80004 99.8821 9.83678L99.8744 9.85602C99.8625 9.88028 99.8528 9.90576 99.8371 9.93678L99.683 10.2104C99.6713 10.2289 99.6578 10.248 99.6473 10.2642C99.6246 10.2973 99.6002 10.3309 99.5837 10.3527L81.7039 34.0935C81.3581 34.5517 80.8831 34.8819 80.3319 35.0439C79.5385 35.2772 78.6723 35.1262 78.0123 34.6392C77.4479 34.224 77.0836 33.6142 76.9834 32.923C76.8832 32.2318 77.0622 31.5434 77.4844 30.9816L89.3255 15.2606C84.3361 17.2688 77.4032 19.8011 69.1223 22.1524C58.8097 25.0784 48.55 27.1078 38.6291 28.181C26.1874 29.5275 14.2422 29.3715 3.12153 27.7129C1.68396 27.4998 0.698551 26.1651 0.922015 24.7392L0.918727 24.7345Z"
                                fill="#333"/>
                        </svg>
                    </div>
                </div>

                <div class="relative hidden sm:inline-block cursor-pointer w-64 h-64 md:w-80 md:h-80 lg:w-[500px] lg:h-[500px] transition-all duration-300 ease-in sm:ml-5 md:ml-6"
                    :class="flipped ? 'sm:mr-5 md:mr-6' : 'sm:ml-5 md:ml-6'"
                    @click="flipped = !flipped"
                    style="transform-style: preserve-3d;perspective:500px;">
                    <div class="absolute inset-0 transition-all duration-300 ease-in rotate-y-0" style="backface-visibility: hidden;"
                        :class="flipped ? '-rotate-y-180' : 'rotate-y-0'"
                    >
                        <img class="absolute inset-0 object-fill overflow-hidden rounded-full transition-all duration-300 ease-in" :style="'background-color:' + selectedProduct;"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/flipper-transparent.png">
                        <i class="fad fa-repeat absolute top-1/2 left-1/2 text-4xl z-4 -m-5  text-white"></i>
                    </div>
                    <div class="absolute inset-0 transition-all duration-300 ease-in rotate-y-0" style="backface-visibility: hidden;"
                        :class="flipped ? 'rotate-y-0' : 'rotate-y-180'"
                    >
                        <img class="absolute inset-0 object-fill overflow-hidden rounded-full" style="background-color:#333;"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/flipper-transparent.png">
                        <i class="fad fa-repeat absolute top-1/2 left-1/2 text-4xl z-4 -m-5  text-white"></i>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24" style="background-color:#f4f8fb;">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>Your pad,<br class="sm:hidden"> your personality.</strong></h2>
            <h6 class="leading-normal mt-2 mb-5 sm:mb-7">Express yourself with 5 different color QuietPads (for a limited time only).
            </h6>

            @php
                $slides = [
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/pink-quietpad-01a.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/pink-quietpad-02.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/pink-quietpad-03.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/pink-quietpad-04.webp',
                 ],
             ];
                $slides2 = [
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/teal-quietpad-01a.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/teal-quietpad-02.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/teal-quietpad-03.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/teal-quietpad-04.webp',
                 ],
             ];
                $slides3 = [
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/blue-quietpad-01a.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/blue-quietpad-02.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/blue-quietpad-03.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/blue-quietpad-04.webp',
                 ],
             ];
                $slides4 = [
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/green-quietpad-01a.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/green-quietpad-02.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/green-quietpad-03.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/green-quietpad-04.webp',
                 ],
             ];
                $slides5 = [
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/orange-quietpad-01a.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/orange-quietpad-02.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/orange-quietpad-03.webp',
                 ],
                 [
                     'img' => 'marketing/drumeo/products/quietpad-colorburst/orange-quietpad-04.webp',
                 ],
             ];
             $scaleAnimation = 'cursor-pointer transform transition duration-300 ease-in-out hover:scale-105';
             $handleClick = 'handleClick';
            @endphp

            @component('drumeo._partials.modal-carousel', ['slides' => $slides, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap hidden" :class="{ 'hidden': selectedProduct !== '#BB16A3', }">
                    <div class="p-2 w-full sm:w-1/4"><div class="h-72 sm:h-80 lg:h-96 w-full bg-top bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(0)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x480/filters:quality(95)/{{ $slides[0]['img'] }}')"></div></div>
                    <div class="px-2 w-full sm:w-1/4">
                        <div class="py-2 w-full"><div class="h-64 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(1)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')"></div></div>
                        <div class="py-2 w-full"><div class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(2)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')"></div></div>
                    </div>
                    <div class="p-2 w-full sm:w-1/2"><div class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(3)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[3]['img'] }}')"></div></div>
                </div>
            @endcomponent
            @component('drumeo._partials.modal-carousel', ['slides' => $slides2, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap hidden" :class="{ 'hidden': selectedProduct !== '#3CDBC0', }">
                    <div class="p-2 w-full sm:w-1/4"><div class="h-72 sm:h-80 lg:h-96 w-full bg-top bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(0)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x480/filters:quality(95)/{{ $slides2[0]['img'] }}')"></div></div>
                    <div class="px-2 w-full sm:w-1/4">
                        <div class="py-2 w-full"><div class="h-64 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(1)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides2[1]['img'] }}')"></div></div>
                        <div class="py-2 w-full"><div class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(2)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides2[2]['img'] }}')"></div></div>
                    </div>
                    <div class="p-2 w-full sm:w-1/2"><div class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(3)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides2[3]['img'] }}')"></div></div>
                </div>
            @endcomponent
            @component('drumeo._partials.modal-carousel', ['slides' => $slides3, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap" :class="{ 'hidden': selectedProduct !== '#0B76DB', }">
                    <div class="p-2 w-full sm:w-1/4"><div class="h-72 sm:h-80 lg:h-96 w-full bg-top bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(0)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x480/filters:quality(95)/{{ $slides3[0]['img'] }}')"></div></div>
                    <div class="px-2 w-full sm:w-1/4">
                        <div class="py-2 w-full"><div class="h-64 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(1)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides3[1]['img'] }}')"></div></div>
                        <div class="py-2 w-full"><div class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(2)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides3[2]['img'] }}')"></div></div>
                    </div>
                    <div class="p-2 w-full sm:w-1/2"><div class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(3)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides3[3]['img'] }}')"></div></div>
                </div>
            @endcomponent
            @component('drumeo._partials.modal-carousel', ['slides' => $slides4, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap hidden" :class="{ 'hidden': selectedProduct !== '#79C300', }">
                    <div class="p-2 w-full sm:w-1/4"><div class="h-72 sm:h-80 lg:h-96 w-full bg-top bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(0)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x480/filters:quality(95)/{{ $slides4[0]['img'] }}')"></div></div>
                    <div class="px-2 w-full sm:w-1/4">
                        <div class="py-2 w-full"><div class="h-64 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(1)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides4[1]['img'] }}')"></div></div>
                        <div class="py-2 w-full"><div class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(2)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides4[2]['img'] }}')"></div></div>
                    </div>
                    <div class="p-2 w-full sm:w-1/2"><div class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(3)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides4[3]['img'] }}')"></div></div>
                </div>
            @endcomponent
            @component('drumeo._partials.modal-carousel', ['slides' => $slides5, 'scaleAnimation' => $scaleAnimation, 'handleClick' => $handleClick])
                <div class="flex flex-wrap hidden" :class="{ 'hidden': selectedProduct !== '#FF6900', }">
                    <div class="p-2 w-full sm:w-1/4"><div class="h-72 sm:h-80 lg:h-96 w-full bg-top bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(0)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x480/filters:quality(95)/{{ $slides5[0]['img'] }}')"></div></div>
                    <div class="px-2 w-full sm:w-1/4">
                        <div class="py-2 w-full"><div class="h-64 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(1)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides5[1]['img'] }}')"></div></div>
                        <div class="py-2 w-full"><div class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(2)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides5[2]['img'] }}')"></div></div>
                    </div>
                    <div class="p-2 w-full sm:w-1/2"><div class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl cursor-pointer hover:opacity-90 {{ $scaleAnimation }}" @click="handleClick(3)" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides5[3]['img'] }}')"></div></div>
                </div>
            @endcomponent
{{--            <h6 class="leading-normal mt-3 sm:mt-4 mb-4">--}}
{{--                <template x-for="(color, index) in Object.keys(colors)" :key="index">--}}
{{--                    <span class="cursor-pointer font-bebas uppercase leading-none py-1 px-3 mx-1 rounded-full inline-block text-white"--}}
{{--                        @click="selectedIndex = index; selectedProduct = color;"--}}
{{--                        :style="'background-color:' + color;">--}}
{{--                        <span x-text="colors[color][1]"></span> <span x-text="colors[color][2]"></span>--}}
{{--                    </span>--}}
{{--                </template>--}}
{{--            </h6>--}}

            <p class="leading-tight mt-4 sm:mt-6">Drum sticks and practice pad stand not included.</p>


        </div>
    </section>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>13,995 Drummers<br class="sm:hidden"> Use The QuietPad.</strong></h2>
            <h6 class="mt-2 italic">Here's what they're saying...</h6>
            <div class="flex flex-wrap my-5 sm:my-9">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3 text-left text-white">
                    <div class="rounded-xl pr-4 py-8 sm:py-12 bg-cover pl-[33%] sm:pl-[40%]" style="padding-left: 33%;background-position:33% 0%;background-image:url('https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/quietpad-colorburst/testimonial-02.webp');">
                        <div class="mb-4">
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        </div>
                        <p class="leading-normal text-sm">"I love using my QuietPad when I’m on the road or outside while enjoying the sun – it’s great to practice without disturbing anyone haha!"
                            <br><br><strong>Domino Santantonio</strong></p>
                    </div>
                    <div class="rounded-xl pr-4 py-8 sm:py-12 bg-cover pl-[33%] lg:pl-[40%]" style="padding-left: 33%;background-position:33% 0%;background-image:url('https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/quietpad-colorburst/testimonial-01.webp');">
                        <div class="mb-4">
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                            <i class="align-middle text-2xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                        </div>
                        <p class="leading-normal text-sm">"With this pad, I have both the surfaces I need to practice my speed and endurance for my videos. Sometimes, I use the quiet side to mute my snare hits when I’m working on a difficult pattern – it works perfectly!"
                            <br><br><strong>El Estepario Siberiano</strong></p>
                    </div>
                </div>
                <div class="hidden sm:flex flex-wrap items-start text-left justify-center">
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
                                    arrow: 'splide__arrow bg-white opacity-100 top-1/2 transform -translate-y-1/2 shadow-lg h-11 w-11',
                                    prev: 'splide__arrow--prev your-class-prev hidden sm:flex -left-1',
                                    next: 'splide__arrow--next your-class-next hidden sm:flex -right-1',
                            },
                            perMove: 1,
                            type: 'loop',
                            padding: '1rem',
                            focus: 0,
                            autoplay: true,
                            pauseOnHover: true,
                            pauseOnFocus: true,
                            interval: 5000,
                            lazyLoad: 'nearby',
                            drag   : 'free',
                            snap   : false,
                        }
                        ).mount()
                    },
                }">
                    <div x-ref="splide" class="w-full splide">
                        <div class="splide__track relative">
                            <ul class="splide__list w-full">
                                @foreach($reviews as $review)
                                    <li class="splide__slide flex">
                                        <div class="flex flex-wrap items-start w-full px-1 sm:px-2 text-left">
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
    <div class="px-3 sm:px-6 py-10 sm:py-16 lg:py-20 text-center text-white transition-all duration-300"  :style="'background-color:' + selectedProduct;">
        <div class="container mx-auto max-w-3xl">
            <img class="inline-block h-16 sm:h-20 lg:h-24 transition-all duration-300" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/logo.svg">
            <br>
            <h1 class="uppercase font-bebas leading-none mt-6 mb-3">Limited Time COLORBURST Series</h1>
            <h4 class="leading-tight mb-7">Select your color below:</h4>
            <div class="flex flex-row max-w-2xl justify-center mx-auto">
                <template x-for="(color, index) in Object.keys(colors)" :key="index">
                    <div class="relative cursor-pointer"
                        @click="selectedIndex = index; selectedProduct = color;">
                        <div :class="[
                                    'relative inline-block rounded-full sm:p-1 border-4 transition-all border-transparent',
                                    selectedIndex === index ? 'border-white' : 'hover:border-white hover:sm:border-opacity-50'
                                ]">
                            <img class="rounded-full"
                                :style="'background-color:' + color"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/240x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/flipper-transparent.png">
                            <i x-show="selectedIndex === index" class="fas fa-check absolute top-1/2 left-1/2 text-5xl leading-none transform -translate-x-1/2 -translate-y-1/2"></i>
                        </div>
                        <p class="mt-2 leading-tight text-xs sm:text-base">
                            <em x-text="colors[color][1]"></em><br>
                            <strong class="font-black" x-text="colors[color][2]"></strong>
                        </p>
                    </div>
                </template>
            </div>

            <h4 class="leading-tight my-7 sm:my-9"><strong>Only</strong>
                @if(floatval($productPrices['quietpad']->price) > floatval($productPrices['quietpad']->discounted_price))
                    <s class="opacity-50">${{ floatval($productPrices['quietpad']->price) }}</s>
                    <strong>${{ floatval($productPrices['quietpad']->discounted_price) }}</strong>
                    <em class="text-musora text-sm">(Save {{ round(100 - (100 * (floatval($productPrices['quietpad']->discounted_price) / floatval($productPrices['quietpad']->price)))) }}%)</em>
                @else
                    <strong>${{ floatval($productPrices['quietpad']->discounted_price) }}</strong>
                @endif
            </h4>
            @if( $products['quietpad']->getStockAvailability() > 1 && !empty($products['quietpad']->getStockAvailability()))
                <a class="join white w-full transition-all duration-300 ease-in"
                    :href="`/ecommerce/add-to-cart?products[${colors[selectedProduct][0]}]=1`"
                    style="letter-spacing:.04em;padding:17px 0;">
                    GET YOUR
                    <span :style="'color:' + selectedProduct;"><span x-text="colors[selectedProduct][1]"></span> <span x-text="colors[selectedProduct][2]"></span></span>
                    QUIETPAD &raquo;</a>
            @else
                <a class="join sold-out w-full">SOLD OUT</a>
            @endif
            <p class="leading-tight text-sm mt-5"><em>Drum sticks and practice pad stand not included.</em></p>

            {{--            <div class="mt-12">--}}
            {{--                <div class="text-center">--}}
            {{--                    <i class="align-middle text-3xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>--}}
            {{--                    <i class="align-middle text-3xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>--}}
            {{--                    <i class="align-middle text-3xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>--}}
            {{--                    <i class="align-middle text-3xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>--}}
            {{--                    <i class="align-middle text-3xl fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>--}}
            {{--                </div>--}}
            {{--                <h6 class="leading-tight my-4">“Placeholder. Testimonial text coming yet for Dorothea.”</h6>--}}
            {{--                <div class="flex items-center justify-center">--}}
            {{--                    <img class="h-12 sm:h-14 rounded-full mr-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/drumeo/products/quietpad-colorburst/dorothea.webp">--}}
            {{--                    <h6 class="leading-tight mx-0"><strong>Dorothea Taylor</strong></h6>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>

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
        'video' => '982740966',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'trailerM',
        'video' => '982741004',
        'vimeo' => true,
            'styles' => 'pb-[177%] bg-white',
    ])

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@stop
