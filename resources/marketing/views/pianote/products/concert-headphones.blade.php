@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Pianote Concert Series Headphones</title>
    <meta property="og:title" content="Pianote Concert Series Headphones">
    <meta name="description" content="Enhance your playing experience."/>
    <meta property="og:description" content="Enhance your playing experience.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/products/concert-headphones/fb-share-image.jpg">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/play-beautiful-piano.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        .text-yellow {
            color: #EAB308;
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

        .header-bg {
            background-image: url('https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/header-m.jpg');
        }

        @media (min-width: 500px) {
            .header-bg {
                background-size: 500px;
            }
        }

        @media (min-width: 768px) {
            .header-bg {
                background-image: url('https://cdn.musora.com/image/fetch/w_1800,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/header.png');
                background-size: cover;
            }
        }
    </style>
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    <section class="py-4 md:py-10 bg-center bg-cover bg-no-repeat header-bg bg-black">
        <div class="max-w-md md:max-w-2xl mx-auto text-center px-2 md:px-0">
            <img class="h-20 md:h-40 mb-0.5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/logo-header.png" alt="headphone logo">
            <h6 class="text-yellow italic font-bold">Enhance your playing experience.</h6>
            <i data-open="trailer" class="fas fa-play play-button autoplay-video text-white smaller my-80 mb-10"></i>
            <br>
            <a class="join w-full" href="#customize-anchor">Grab your pair</a>
            <h4 class="text-white font-extrabold my-4">
                Only
                @if((floatval($productPrices['pianote-headphones']->price) -floatval($productPrices['pianote-headphones']->discounted_price)) > 0)
                    <s class="font-normal">${{floatval($productPrices['pianote-headphones']->price) }}</s>
                @endif
                ${{floatval($productPrices['pianote-headphones']->discounted_price) }}
            </h4>
            <p class="text-yellow italic font-bold leading-tight">LIMITED EDITION.</p>

        </div>
    </section>

    <section class="pt-12 md:pt-20 pb-48">
        <div class="max-w-2xl mx-auto text-center px-4 md:px-0">
            <h3 class="font-extrabold">Step into your personal Concert Hall</h3>
            <p class="italic font-bold my-2" style="color:#AC2134;">The only headphones designed by piano players -- for piano players.</p>
            <p class="mb-10">
                Your digital piano sounds better with headphones. It’s a simple fact. And Pianote’s Concert Series over-ear headphones deliver the immersive experience your playing deserves.
            </p>
            <div class="relative max-w-sm md:max-w-md lg:max-w-lg mx-auto">
                <img class="absolute left-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/headphones-overlap.png" alt="headphone">
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-12 lg:h-28" style="background: linear-gradient(to left top, #AF2234 calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>
    <section class="pb-12 md:pb-20 pt-52 md:pt-72 lg:pt-80 px-4 sm:px-6" style="background:linear-gradient(180deg, #AF2234 6.54%, #610915 100%);">
        <div class="max-w-5xl mx-auto mt-8 md:mt-28 grid md:grid-cols-2 lg:grid-cols-4 gap-6 text-white px-4 lg:px-0" style="color:#D1D1D1;">
            <div class="flex md:block">
                <img class="h-8 md:h-10 mb-4 mr-3 md:mr-0 lazyload" data-src="https://pianote.s3.amazonaws.com/products/concert-headphones/lightweight-icon.svg" alt="lightweight icon">
                <p class="text-sm mt-2 md:mt-0">
                    <b class="text-white">Lightweight with comfortable ear padding</b> for extended practice and playing sessions. You might even forget they’re there. Because playing piano should not mean getting sore ears.
                </p>
            </div>
            <div class="flex md:block">
                <img class="h-8 md:h-10 mb-4 mr-3 md:mr-0 lazyload" data-src="https://pianote.s3.amazonaws.com/products/concert-headphones/no-sound-leaks-icon.svg" alt="lightweight icon">
                <p class="text-sm mt-2 md:mt-0">
                    <b class="text-white">No sound leaks.</b> You hear the piano, nothing else. And you won’t have to worry about anyone eavesdropping on your practice sessions. They’ll only hear the clacking of your piano keys!

                </p>
            </div>
            <div class="flex md:block">
                <img class="h-8 md:h-10 mb-4 mr-3 md:mr-0 lazyload" data-src="https://pianote.s3.amazonaws.com/products/concert-headphones/sound-icon.svg" alt="lightweight icon">
                <p class="text-sm mt-2 md:mt-0">
                    <b class="text-white">Unrivaled sound definition and bass response.</b> Beautiful clarity up high and deep rich sounds down low. Hear your piano the way it was intended to sound.
                </p>
            </div>
            <div class="flex md:block">
                <img class="h-8 md:h-10 mb-4 mr-3 md:mr-0 lazyload" data-src="https://pianote.s3.amazonaws.com/products/concert-headphones/custom-icon.svg" alt="lightweight icon">
                <p class="text-sm mt-2 md:mt-0">
                    <b class="text-white">Custom designed</b> by piano players for piano players. This is a limited edition design of just 2300 which won’t be reproduced. Once they’re gone, they’re gone.
                </p>
            </div>
        </div>
    </section>

    <section class="pb-12 md:py-20 lg:py-0 bg-black">
        <div class="max-w-4xl mx-auto md:flex md:items-center">
            <div class="order-1 flex-1 mb-6 md:mb-0">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/feature-01.jpg" alt="feature 1">
                <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/feature-02.jpg" alt="feature 2">
            </div>
            <div class="flex-1 md:pr-10 px-4 md:px-6" style="color:#D1D1D1;">
                <h3 class="font-extrabold leading-tight text-white">Your piano deserves <br>to sound its best</h3>
                <p class="italic font-bold mt-4 md:mt-0 mb-4" style="color:#EAB308;">Sound better. Play more.</p>
                <p class="mb-10">
                    Your digital piano is the result of 300 years of research and refinement. Countless masterpieces have been written on and for it. That kind of history deserves the acoustic respect that comes from the Pianote Concert Series Headphones.
                </p>
                <div class="flex items-start mb-6">
                    <i class="fas fa-check mr-4 text-xs border-2 rounded-full mt-0.5" style="color:#E2393B; border-color: #E2393B; padding: 2px;" aria-hidden="true"></i>
                    <p>
                        <b class="text-white">The large 50mm neodymium driver size</b> guarantees fidelity of sound, especially at lower frequencies. The neodymium produces light, loud, and clear sound definition.
                    </p>
                </div>
                <div class="flex items-start mb-6">
                    <i class="fas fa-check mr-4 text-xs border-2 rounded-full mt-0.5" style="color:#E2393B; border-color: #E2393B; padding: 2px;" aria-hidden="true"></i>
                    <p>
                        <b class="text-white">Low impedance,</b> unrivaled frequency response means you’ll hear every note as it was intended to be heard. Beautifully.
                    </p>
                </div>
                <div class="flex items-start mb-6">
                    <i class="fas fa-check mr-4 text-xs border-2 rounded-full mt-0.5" style="color:#E2393B; border-color: #E2393B; padding: 2px;" aria-hidden="true"></i>
                    <p>
                        <b class="text-white">Closed-back circumaural design</b> guarantees your ears are fully covered by the comfortable leather padding.
                    </p>
                </div>
                <div class="flex items-start mb-6">
                    <i class="fas fa-check mr-4 text-xs border-2 rounded-full mt-0.5" style="color:#E2393B; border-color: #E2393B; padding: 2px;" aria-hidden="true"></i>
                    <p>
                        <b class="text-white">3.5mm stereo plug</b> with <b class="text-white">¼ inch adapter</b> to work with all your devices.
                    </p>
                </div>
                <div class="flex items-start mb-6">
                    <i class="fas fa-check mr-4 text-xs border-2 rounded-full mt-0.5" style="color:#E2393B; border-color: #E2393B; padding: 2px;" aria-hidden="true"></i>
                    <p>
                        Comes with two, <b class="text-white">3-meter cables</b> to match your preference. One straight, one coiled.
                    </p>
                </div>
                <div class="flex items-start mb-8">
                    <i class="fas fa-check mr-4 text-xs border-2 rounded-full mt-0.5" style="color:#E2393B; border-color: #E2393B; padding: 2px;" aria-hidden="true"></i>
                    <p class="mx-0">
                        <b class="text-white">4-year warranty</b> so you don’t have to worry.
                    </p>
                </div>
                <a class="join w-full smaller" data-open="specsModal">CLICK HERE FOR THE FULL SPECS</a>
            </div>
        </div>
    </section>

    <section class="py-12 md:py-20">
        <div class="max-w-4xl mx-auto text-center px-4 lg:px-0">
            <h3 class="font-extrabold mb-2">What's in the box, Lisa?</h3>
            <p class="font-bold italic mb-6" style="color:#AC2134;">Scroll down to see everything that’s included.</p>
            <img class="rounded-xl mb-2 cursor-pointer lazyload autoplay-video" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-04.png" alt="montage 4" data-open="unbox">
            <div class="flex flex-wrap mb-2">
                <img class="w-full md:w-2/3 rounded-xl md:pr-1 mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-01.jpg" alt="montage 1">
                <img class="w-1/2 md:w-1/3 rounded-xl md:pl-1 mb-2 pr-1 md:pr-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-05.jpg" alt="montage 5">
                <img class="w-1/2 md:w-1/3 rounded-xl md:pr-1 mb-2 md:mb-0 pl-1 md:pl-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-06.jpg" alt="montage 6">
                <img class="w-full md:w-2/3 rounded-xl md:pl-1 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-02.jpg" alt="montage 2">
            </div>
            <div class="relative">
                <img class="rounded-xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/montage-03.png" alt="montage 3">
                <div class="hidden md:block">
                    <div class="tooltip cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 18%;left: 34%; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" tip="Padded headband for extra comfort">
                        <span class="text-2xl">+</span>
                    </div>
                    <div class="tooltip cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 24%;left: 68%; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" tip="3-meter coiled cable">
                        <span class="text-2xl">+</span>
                    </div>
                    <div class="tooltip cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 56%;left: 62%; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" tip="3-meter straight cable">
                        <span class="text-2xl">+</span>
                    </div>
                    <div class="tooltip cursor-pointer bg-white rounded-full w-7 h-7 flex items-center justify-center" style="top: 68%;left: 78%; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" tip="¼” Adapter">
                        <span class="text-2xl">+</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f6f7f9 calc(50% + 1px));"></div>
    <section class="py-6 md:py-8" style="background-color:#f6f7f9;">
        <div class="max-w-xl mx-auto text-center px-4 lg:px-0">
            <h3 class="leading-tight font-extrabold">“Do people know how good these <br class="hidden sm:inline"> Pianote headphones are?”</h3>
            <img class="w-full rounded-xl my-3 sm:my-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/estyschmitz.jpg" alt="Testimonial">
            <p class="">“They're incredible. The sound is MUCH richer and clearer on the Pianote headphones compared to the built-in keyboard speakers (Yamaha P515). The Pianote headphones are much closer to sounding like my acoustic Yamaha and make me want to play more. They're SO comfortable too: loose but secure, perfect for wearing for a long time without discomfort. Do people know how good these Pianote headphones are?”
                <br><strong  style="color:#AC2134;">E. SCHMITZ, MARYLAND USA</strong></p>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="py-12 md:py-20 text-center" style="background: linear-gradient(180deg, #010101 0%, #330606 43.19%)">
        <img class="h-16 md:h-20 mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/logo-promo.png" alt="headphone logo">
        <p class="text-yellow mb-4 italic font-bold">Enhance your playing experience.</p>
        <p class="text-white">LIMITED EDITION.</p>
        <div class="flex flex-wrap justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-7 mx-auto text-center">
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['pianote-headphones' => 1], 'redirect' => '/order', 'locked' => 'false']) }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl font-extrabold uppercase" style="background: linear-gradient(180deg, #F51A30 0%, #9A1120 64.29%);">
                        LAUNCH SPECIAL
                    </p>
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h6 class="leading-none mb-3 md:mb-8">Concert Series Headphones</h6>
                        <h1 class="inline-block leading-none">
                            @if((floatval($productPrices['pianote-headphones']->price) -floatval($productPrices['pianote-headphones']->discounted_price)) > 0)
                                <s style="color:#BBBBBF;">${{ floatval($productPrices['pianote-headphones']->price) }}</s>
                                <strong>${{ floatval($productPrices['pianote-headphones']->discounted_price) }}</strong>
                                <p class="text-sm my-4"><em>Save {{ round(100 - (100 * (floatval($productPrices['pianote-headphones']->discounted_price) / floatval($productPrices['pianote-headphones']->price)))) }}% for a limited time.</em></p>
                            @else
                                <strong>${{ floatval($productPrices['pianote-headphones']->price) }}</strong>
                                <br/><br/>
                            @endif
                        </h1>

                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Grab your pair</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1">Pianote Concert Series Heaphones</p>
                        <p class="mb-1">Two, 3-Meter Detachable Cables</p>
                        <p class="mb-1">3.5mm Plug with ¼” Adapter</p>
                        <p>&nbsp;</p>
                    </div>
                </a>
            </div>
{{--            <div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}

{{--                <a href="/lifetime" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
{{--                    <p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl font-extrabold uppercase" style="background: linear-gradient(180deg, #F51A30 0%, #9A1120 64.29%);">--}}
{{--                        LIMITED TIME PIANOTE DEAL--}}
{{--                    </p>--}}
{{--                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
{{--                        <h6 class="leading-none mb-3">Get a LIFETIME Pianote membership <br class="hidden lg:inline">& Get Your Headphones FREE</h6>--}}
{{--                        <h1 class="inline-block leading-none">--}}
{{--                            <strong>${{  }}</strong>--}}
{{--                        </h1>--}}
{{--                        <p class="text-sm my-4"><em>LIMITED EDITION.</em></p>--}}
{{--                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Learn more</div>--}}
{{--                    </div>--}}
{{--                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
{{--                        <p class="mb-1 text-pianote"><strong>Lifetime Pianote Membership</strong></p>--}}
{{--                        <p class="mb-1">Pianote Concert Series Headphones</p>--}}
{{--                        <p class="mb-1">Two, 3-Meter Detachable Cables</p>--}}
{{--                        <p class="mb-1">3.5mm Plug with ¼” Adapter</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
{{--        <a href="/new-year#customize-anchor" class="text-pianote"><h6><strong><u>OR FREE WITH A PIANOTE MEMBERSHIP</u></strong></h6></a>--}}
    </section>
    <section class="content-section text-center" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
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

    @include('pianote.lead-gen.partials.video-player',[
        "name" => "trailer",
        "vimeoId" => "774404220",
    ])
    @include('pianote.lead-gen.partials.video-player',[
        "name" => "unbox",
        "vimeoId" => "774408046",
    ])

    <div class="reveal large relative coach-wrap rounded-xl select-none max-w-xs md:max-w-md" id="specsModal" data-reveal data-reset-on-close="false" style="max-width:510px">
        <div class="relative rounded-t-lg pb-56 md:pb-96 bg-top md:bg-center bg-cover bg-black lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1100,q_auto:best/https://pianote.s3.amazonaws.com/products/concert-headphones/specs_image.jpg"></div>
        <div class="p-4 md:p-5 text-left">
            <p class="text-pianote mx-auto mb-3">The Pianote Concert Series headphones with its 50mm neodymium transducers offer you an <strong>unrivaled frequency response and total comfort that allows you to have an optimal listening experience.</strong></p>
            <ul class="leading-normal list-disc ml-7">
                <li>Professional Hi-End Closed-back Circumaural Headphones.</li>
                <li>50 mm size Driver Dynamic Neodymium magnet.</li>
                <li>Single-side detached cable design.</li>
                <li>Two 3 meters cable types included.</li>
                <li>Comfortable fit due to rugged, adjustable, soft padded headband construction.</li>
                <li>3.5 + 6.3 mm stereo jack.</li>
                <li>Rated impedance: 32 Ω</li>
                <li>Sensitivity: 100 ±3 dB</li>
                <li>Audio frequency bandwidth: 10 Hz-30 Khz</li>
                <li>Max power: 1800 mW</li>
                <li>Cable length: 300 cm</li>
                <li>Net weight: 305 g with cable</li>
            </ul>
        </div>
    </div>

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).foundation();
        })
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>
@endsection
