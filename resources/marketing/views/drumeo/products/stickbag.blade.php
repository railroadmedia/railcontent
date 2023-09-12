@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>StickBag | Drumeo</title>
    <meta property="og:title" content="StickBag | Drumeo">

    <meta name="description" content="Pack like a pro.">
    <meta property="og:description" content="Pack like a pro.">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/fb-share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/stickbag/">

    @include('_partials.layout._fonts')
    <?php \App\Analytics\Tracker::trackProductImpression('quietkick'); ?>

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>

    </style>

    @php $memberPrice = floatval($productPrices['quietkick']->discounted_price) @endphp
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "StickBag",
                "fullPrice" => floatval($productPrices['quietkick']->price),
                "price" => $memberPrice,
                "noBreadcrumb" => true
            ])
    <header class="text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-10 sm:h-14" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/drumeo-quietkick.png"><br>
                <h1 class="leading-tight"><strong>Pack like a pro.</strong></h1>
                <h3 class="my-4 sm:my-6">
                    @if(floatval($productPrices['quietkick']->price) > floatval($productPrices['quietkick']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['quietkick']->price) }}.</s>
                        <strong>${{ floatval($productPrices['quietkick']->discounted_price) }}</strong>
                        (Save {{ round(100 - (100 * (floatval($productPrices['quietkick']->discounted_price) / floatval($productPrices['quietkick']->price)))) }}%).
                    @else
                        <strong>Only ${{ floatval($productPrices['quietkick']->discounted_price) }}</strong>
                    @endif
                </h3>
                <div class="my-3 sm:my-6">
                <a class="join outline blue" >Watch Video</a>
                    @if( $products['quietkick']->getStockAvailability() > 1 && !empty($products['quietkick']->getStockAvailability()))
                        <a class="join blue" href="#customize-anchor">Order Now</a>
                    @else
                        <a class="join sold-out">SOLD OUT</a>
                    @endif
                </div>
                <h6 class="leading-tight">or get it free with an Annual Drumeo Membership.</h6>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>
        <video class="object-cover w-full h-full relative z-0" poster="" src="https://player.vimeo.com/progressive_redirect/playback/696274730/rendition/1080p?loc=external&signature=a2e19f58b044993d2561fbeaabcd4855ec9d1f577a7bba332fc5a7e7221cb23a" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
    </header>

    <section class="text-center px-3 sm:px-5 py-8 sm:py-16 lg:py-20 relative">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h3 class="leading-tight"><strong>A StickBag you’ll want to show your friends.</strong></h3>
            <p class="leading-normal mt-2 mb-5">Crafted with input from gigging pros, the Drumeo StickBag features thoughtful<br class="sm:inline"> details that will help you organize your tools and even save you mid-song.</p>
            <div class="flex">
                <div class="w-1/4">
                    <div>
                        <img src="">
                        <h5><strong>Premium Metal Tom Hooks</strong></h5>
                        <p>No more tying your bag up with string. Your Drumeo StickBag includes sturdy metal loops that easily attach to any tom lugs.</p>
                    </div>
                    <div>
                        <img src="">
                        <h5><strong>One in the holster.</strong></h5>
                        <p>A strategic easy-access sleeve lets your “rescue stick” poke just out of your stick bag so you can make that quick grab mid-song.</p>
                    </div>
                    <div>
                        <img src="">
                        <h5><strong>Zippers as tough as you are.</strong></h5>
                        <p>Top-quality reinforced zippers make for a long-lasting stick bag – even when it’s jammed to the teeth with sticks, brushes, and mallets.</p>
                    </div>
                </div>
                <div class="w-1/2"></div>
                <div class="w-1/4">
                    <div>
                        <img src="">
                        <h5><strong>Sweat, water and beer-proof.</strong></h5>
                        <p>Your StickBag is made from waxed canvas – rugged cotton soaked in wax for extra strength and water resistance.</p>
                    </div>
                    <div>
                        <img src="">
                        <h5><strong>Flexible suede pockets for all your goodies.</strong></h5>
                        <p>Drum keys, tuning gels, a Snickers bar? Suede pockets let you jam all your goodies into your pockets without losing their shape.</p>
                    </div>
                    <div>
                        <img src="">
                        <h5><strong>Drum keychain (key included!)</strong></h5>
                        <p>Finally - a drum key you won’t lose. Your StickBag includes a brushed pewter drum key that has its own little key ring to live inside your bag.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 mt-10 md:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F6F8FC calc(50% + 1px));"></div>
    <section class="text-center px-3 sm:px-5 py-8 sm:py-16 lg:py-20 relative" style="background-color:#F6F8FC;">
        <div class="container mx-auto z-10 relative max-w-4xl">

            <img class="my-5 h-64 inline sm:hidden"
                src="https://www.musora.com/musora-cdn/image/width=620,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/september/musicounts/drumeo-musicounts-collage.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center mb-5">
                <p class="leading-normal max-w-xl pr-5 lg:pr-8 mx-0">
                    Brushes take the worst beating in conventional stick bags – and at $30+ a pop, it hurts even more.
                    <br><br>
                    The Drumeo StickBag features a custom brushes sleeve that keeps your brush wires straight and true. And when you’re at your kit, toss your brush sleeve under your hi-hat for easy access in any song.
                    <br><br>
                    It’s an all-new innovation on one of drumming’s oldest tools.</p>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/september/musicounts/drumeo-musicounts-collage.png"
                    alt="learn playing image"
                >
            </div>

        </div>
    </section>

    <section class="content-section text-center comparison px-1 lg:px-3" style="background:#00101D;">
        <div class="container mx-auto max-w-5xl">
            <h3 class="mb-16 md:mb-12 "><strong>Your new favorite piece of gear. </strong></h3>
            <div class="relative">
                <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
                <table class="w-full mx-auto border-separate comparison eardrums earbuds">
                    <tbody style="background-color:transparent!important;">
                    <tr style="background-color:transparent!important;">
                        <td></td>
                        <td class="rounded-t-xl">
                            <img class="h-5 md:h-12 lazyload"  data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png" alt="logo-white">
                        </td>
                        <td class="rounded-t-xl">
                            <img class="h-5 md:h-12 lazyload"  data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png" alt="logo-white">
                        </td>
                        <td class="rounded-t-xl">
                            <img class="h-5 md:h-12 lazyload"  data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/eardrums/Logo.png" alt="logo-white">
                        </td>
                    </tr>
                    <tr>
                        <td>Material</td>
                        <td>Waxed Canvas & Suede</td>
                        <td>Canvas</td>
                        <td>Leather</td>
                    </tr>
                    <tr>
                        <td>Capacity</td>
                        <td>18 Pairs</td>
                        <td>24 Pairs</td>
                        <td>6 Pairs</td>
                    </tr>
                    <tr>
                        <td>Protective Brush Sleeve</td>
                        <td>YES</td>
                        <td>NO</td>
                        <td>NO</td>
                    </tr>
                    <tr>
                        <td>Dimensions</td>
                        <td>17.5” H x 16” W</td>
                        <td>20” H x 22” W</td>
                        <td>18” H x 16” W</td>
                    </tr>
                    <tr>
                        <td>Drum Key Included</td>
                        <td>YES</td>
                        <td>NO</td>
                        <td>NO</td>
                    </tr>
                    <tr style="background-color:transparent!important;">
                        <td class="rounded-b-xl">Total</td>
                        <td class="rounded-b-xl">$147 $97</td>
                        <td class="rounded-b-xl">$104</td>
                        <td class="rounded-b-xl">$220</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="text-center px-5 py-10 md:py-20 lg:py-24">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>The last StickBag you’ll ever need.</strong></h2>
            <h6 class="mt-2 mb-5 sm:mb-10">A bag built to take everything from garage to stage. </h6>
            <div class="flex flex-wrap">
                <div class="p-1 w-full sm:w-4/12"><div class="h-44 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/Quietkick-gallery-03.jpg"></div></div>
                <div class="p-1 w-full sm:w-8/12"><div class="h-32 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/Quietkick-gallery-04.jpg"></div></div>
                <div class="p-1 w-full sm:w-8/12"><div class="h-36 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/Quietkick-gallery-02.jpg"></div></div>
                <div class="p-1 w-full sm:w-4/12"><div class="h-44 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/Quietkick-gallery-01.jpg"></div></div>
            </div>
            <p class="mt-2 mb-5 sm:mb-10 text-sm"><em>Disclaimer: Sticks/Brushes are not included.</em></p>
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <p class="sm:max-w-md m-0 sm:pr-5 lg:pr-10 text-left mb-5 sm:mb-0">Your Drumeo StickBag is built with premium components to ensure a long-lasting home for your sticks wherever your drumming takes you.</p>
                <table class="border border-black border-collapse rounded-xl">
                    <tr class="rounded-xl">
                        <td class="px-3 py-1 text-left border border-black border-collapse">Durable construction</td>
                        <td class="px-5 py-1 border border-black border-collapse"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-black border-collapse">Premium zippers</td>
                        <td class="px-5 py-1 border border-black border-collapse"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-black border-collapse">Quick-stick slot</td>
                        <td class="px-5 py-1 border border-black border-collapse"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-black border-collapse">Drum key</td>
                        <td class="px-5 py-1 border border-black border-collapse"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-black border-collapse">Cost</td>
                        <td class="px-5 py-1 border border-black border-collapse">$97</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="content-section text-center customize px-4 lg:px-6 bg-cover lazyload" style="background-color:#193d5b;">
        <div class="container mx-auto">
            <img alt="quietkick logo" class="h-14 sm:h-20 lg:h-28" src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/quietkick/drumeo-quietkick.png"><br>

            @if( $products['quietkick']->getStockAvailability() > 1 && !empty($products['quietkick']->getStockAvailability()))

                <div id="plusOptions"
                    class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto"
                >
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        <p class="inline-block relative -bottom-4 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black" >Save 34%</p>
                        <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                            <div class="bg-white px-3 py-5 md:py-7">
                                <h3 class="mb-2 sm:mb-3"><strong>StickBag Only</strong></h3>
                                <h4 class="inline-block leading-tight"><s>$149</s> <strong>$97</strong></h4>
                                <p class="text-sm"><em>Save 34%. One-time payment.</em></p>
                                <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Select</div>
                                <p class="text-sm mb-1.5">1 Drumeo StickBag<sup>NEW</sup></p>
                                <p class="text-sm mb-1.5">1 Brushes Sleeve</p>
                                <p class="text-sm">1 Premium Drum Key</p>
                            </div>
                        </a>
                    </div>
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        <p class="inline-block relative -bottom-4 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-drumeo" >LAUNCH SPECIAL</p>
                        <a href="todo" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-drumeo">
                            <div class="bg-white px-3 py-6 md:py-9">
                                <h3 class="mb-2 sm:mb-3"><strong>StickBag + Lessons</strong></h3>
                                <h4 class="inline-block leading-tight"><strong>Free StickBag</strong></h4>
                                <p class="text-sm"><em>with annual Drumeo Membership</em></p>
                                <div class="join my-5 drumeo smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">learn more</div>
                                <p class="text-sm mb-1.5 text-drumeo"><strong>Annual Drumeo Membership</strong></p>
                                <p class="text-sm mb-1.5">Step-By-Step Lessons</p>
                                <p class="text-sm mb-1.5">5000+ Songs</p>
                                <p class="text-sm mb-1.5">Unlimited Personal Support</p>
                                <p class="text-sm mb-1.5">1 Drumeo StickBag<sup>NEW</sup></p>
                                <p class="text-sm mb-1.5">1 Brushes Sleeve</p>
                                <p class="text-sm mb-1.5">1 Premium Drum Key</p>
                                <p class="text-sm">6 Pairs Of 5A Drumsticks</p>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif
        </div>
    </section>

    <section class="content-section text-center" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
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


    @include("drumeo.sales.partials._footer")
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}" defer></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" defer></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js" defer></script>
@stop
