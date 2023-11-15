
@if(!empty($blackBag))
    <header class="text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick logo" class="h-20 sm:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/680x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-stickbag-logo.svg"><br>
                <h5 class="leading-tight text-gold"><strong><em>Only <s class="opacity-50">250</s>
                            @if( $products['stickbag-ltd']->getStockAvailability() > 1 && !empty($products['stickbag-ltd']->getStockAvailability()))
                                {{ $products['stickbag-ltd']->getStockAvailability() }}
                            @endif
                            Available</em></strong></h5>
                <h2 class="leading-tight mt-5 mb-1"><strong>Pack like a pro.</strong></h2>
                <h4 class="leading-tight"><strong class="text-gold">$197</strong></h4>
                @if( $products['stickbag-ltd']->getStockAvailability() > 1 && !empty($products['stickbag-ltd']->getStockAvailability()))
                    <a class="join smaller gold mt-6 w-full max-w-xs"
                            href="/ecommerce/add-to-cart?locked=true&products[stickbag-ltd]=1"
                    >Order Now</a>
                @else
                    <span class="join smaller sold-out mt-6 w-full max-w-xs">Order Now</span>
                @endif
            </div>
        </div>
        {{--    <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>--}}
        <img class="object-cover w-full relative z-0 transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                style="height: 600px;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/header-image.jpg"></img>
    </header>
    <section class="text-center px-5 sm:px-6 pb-12 sm:pb-14 lg:pb-20 text-white" style="background-color:#09090a;">
        <div class="flex justify-center items-end -mt-10 relative z-10">
            <img class="h-8 sm:h-14" style="transform: scaleX(-1);" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/shop/stickbag/arrow.svg" alt="learn playing image" fetchpriority="high">
            <div class="relative">
                @if( $products['stickbag-ltd']->getStockAvailability() > 1 && !empty($products['stickbag-ltd']->getStockAvailability()))
                    <p class="absolute text-black font-black" style="top: 57.5%;left: 41%;font-family: serif;font-size:17px;">{{ $products['stickbag-ltd']->getStockAvailability() }}</p>
                @endif

                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/370x0/filters:quality(95)/marketing/drumeo/shop/stickbag/limited-edition-patch.png"
                        class="h-28 mx-3 transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        alt="learn playing image" fetchpriority="high">
            </div>
            <img class="h-8 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/100x0/filters:quality(95)/marketing/drumeo/shop/stickbag/arrow.svg" alt="learn playing image" fetchpriority="high">
        </div>
        <div class="container max-w-5xl mx-auto">
            <h1 class="my-5 sm:my-10"><strong><span class="text-gold">You’re invited</span> to the<br> black & gold club. </strong></h1>
            <img class="mb-5 h-64 inline sm:hidden transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/450x0/filters:quality(95)/marketing/drumeo/shop/stickbag/jared-profile.png"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    alt="learn playing image" fetchpriority="high">
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start">
                <div class="max-w-xl sm:pl-7 lg:pl-8 mx-0 sm:order-1">
                <p class="leading-normal">
                    Twelve years ago, I started the most exciting and terrifying adventure of my life.
                    <br><br>
                    And there are only two reasons Drumeo is still here today:
                    <br><br>
                    1. To solve problems for you on the drums.<br>
                    2. And to make sure our students always GET more than they give.
                    <br><br>
                    So when it came to creating a stick bag, it had to meet both those requirements.
                    <br><br>
                    Drumeo’s product genius, Kyle Radomsky, worked with a brilliant designer to create what I think is the coolest stick bag ever (scroll down to see why) – but that wasn’t enough.
                    <br><br>
                    <strong>I wanted to do something special for the Lifetime Members who’ve helped build Drumeo.</strong>
                    <br><br>
                    So we’ve made a limited run of 250 hand numbered black leather StickBags. You won’t find these anywhere else – and once they’re gone, they’re gone.
                    <br><br>
                    They come with rugged leather pockets and a unique hand-written number. Plus, you'll get a personal "Thank You" note from Drumeo's geeky founder (that's me).
                    <br><br>
                    If you’re the collector type, you’re on the right page.
                    <br><br>
                    Scroll down to check out the Limited Edition StickBag. For launch, we’ve ONLY made these available to you and your fellow Lifetime Members.
                    <br><br>
                    I hope it helps you pack like a pro.
                </p>
                    <br>
                <img class="h-16 float-right transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/140x0/filters:quality(95)/marketing/drumeo/shop/stickbag/signature-jared.png"
                        alt="learn playing image"
                >
                </div>
                <img class="h-64 lg:h-80 hidden sm:inline  transition-opacity opacity-0" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/570x0/filters:quality(95)/marketing/drumeo/shop/stickbag/jared-profile.png" alt="learn playing image">
            </div>
        </div>
    </section>
@else
    <header class="text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="quietkick" class="h-14 sm:h-16" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/280x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stickbag-logo2.svg"><br>
                <h1 class="leading-tight mt-2 mb-3 text-4xl sm:text-5xl lg:text-6xl"><strong>Pack like a pro.</strong></h1>
                <h3 class="leading-tight">
                    @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                        <s class="opacity-50">${{ floatval($productPrices['stickbag']->price) }}</s>
                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                        (Save {{ round(100 - (100 * (floatval($productPrices['stickbag']->discounted_price) / floatval($productPrices['stickbag']->price)))) }}%)
                    @else
                        <strong>Only ${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                    @endif
                </h3>
                <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                    <div class="sm:w-5/12 join smaller outline hidden sm:inline-block"  @click="trailer = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    <div class="sm:w-5/12 join smaller outline sm:hidden inline-block"   @click="trailerM = true;" ><i class="fas fa-play"></i> &nbsp;Watch Video</div>
                    @if( $products['stickbag']->getStockAvailability() > 1 && !empty($products['stickbag']->getStockAvailability()))
                        <a class="w-5/12 join smaller blue" href="#customize-anchor">Order Now</a>
                    @else
                        <a class="join smaller sold-out">SOLD OUT</a>
                    @endif
                </div>
                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Drumeo Membership.</em></h6>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>
        <video class="object-cover w-full relative z-0" style="height: 600px;" type="video/mp4" autoplay loop playsinline muted
                src="https://d21q7xesnoiieh.cloudfront.net/marketing/drumeo/shop/stickbag/header-vid.mp4"></video>
    </header>
@endif

<section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative" @if(!empty($blackBag)) style="background-color:#010b1a;color:#fff;" @endif>
    <div class="container mx-auto z-10 relative max-w-5xl pb-16">
        <h2 class="leading-tight"><strong>A StickBag you’ll want<br class="sm:hidden"> to show your friends.</strong></h2>
        <p class="leading-normal mt-2 mb-5">Crafted with input from gigging pros, the Drumeo StickBag features thoughtful<br class="hidden sm:inline"> details that will help you organize your tools and even save you mid-song.</p>
        <div class="hidden lg:flex">
            <div class="w-1/4 pr-3">
                <div>
                    <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                        @if(!empty($blackBag))
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-tom-hooks-icon.svg"
                        @else
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/tom-hooks-icon.svg"
                        @endif
                    >
                    <h6 class="my-2"><strong>Premium Metal<br> Tom Hooks</strong></h6>
                    <p class="text-sm">No more tying your bag up with string. Your Drumeo StickBag includes sturdy metal loops that easily attach to any tom lugs.</p>
                </div>
                <div class="my-7">
                    <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            @if(!empty($blackBag))
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-holster-icon.svg"
                            @else
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/holster-icon.svg"
                            @endif
                    >
                    <h6 class="my-2"><strong>One in the<br> chamber.</strong></h6>
                    <p class="text-sm">An easy-access sleeve lets your “rescue stick” poke just out of your stick bag so you can make that quick grab mid-song. </p>
                </div>
                <div>
                    <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            @if(!empty($blackBag))
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-zipper-icon.svg"
                            @else
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/zipper-icon.svg"
                            @endif
                    >
                    <h6 class="my-2"><strong>Zippers as tough<br> as you are.</strong></h6>
                    <p class="text-sm">Top-quality reinforced zippers make for a long-lasting stick bag – even when it’s jammed to the teeth with sticks, brushes, and mallets.</p>
                </div>
            </div>
            <div class="w-1/2">
                <img class="transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                        @if(!empty($blackBag))
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-bag-features.png"
                        @else
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/bag-features.png"
                        @endif
                >
            </div>
            <div class="w-1/4 pl-3">
                <div>
                    <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            @if(!empty($blackBag))
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-waterproof-icon.svg"
                            @else
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/waterproof-icon.svg"
                            @endif
                    >
                    <h6 class="my-2"><strong>Sweat, water<br> and beer-proof.</strong></h6>
                    <p class="text-sm">Your StickBag is made from waxed canvas – rugged cotton soaked in wax for extra strength and water resistance. </p>
                </div>
                <div class="my-7">
                    <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            @if(!empty($blackBag))
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-suede-icon.svg"
                            @else
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/suede-icon.svg"
                            @endif
                    >
                    <h6 class="my-2"><strong>Flexible pockets for<br>  all your goodies.</strong></h6>
                    <p class="text-sm">Drum keys, tuning gels, a Snickers bar? Flexible pockets let you jam all your goodies inside without losing its shape. </p>
                </div>
                <div>
                    <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            @if(!empty($blackBag))
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-keychain-icon.svg"
                            @else
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/marketing/drumeo/shop/stickbag/keychain-icon.svg"
                            @endif
                    >
                    <h6 class="my-2"><strong>Drum keychain<br> (key included!)</strong></h6>
                    <p class="text-sm">Finally, a drum key you won’t lose. Your StickBag includes a brushed pewter drum key that has its own little key ring to live inside your bag. </p>
                </div>
            </div>
        </div>
        <div class="lg:hidden mb-5"
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'hidden',
                                    prev: 'hidden',
                                    next: 'hidden',
                                    pagination: 'splide__pagination bottom-0',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            drag   : 'free',
                            snap   : false,
                            breakpoints: {
                                767: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount()
                    },
                }"
        >
            <div x-ref="splide" class="splide text-left">
                <div class="splide__track pb-8">
                    <ul class="splide__list items-start">
                        @if(!empty($blackBag))
                            @php
                                $gridItems = [
                                    [
                                         'img' => 'marketing/drumeo/shop/stickbag/black-suede-m.jpg',
                                    'title' => 'Sweat, water and beer-proof.',
                                    'desc' => 'Your StickBag is made from waxed canvas – rugged cotton soaked in wax for extra strength and water resistance.',
                                    ],
                                    [
                                         'img' => 'marketing/drumeo/shop/stickbag/black-waterproof-m.jpg',
                                    'title' => 'Flexible pockets for all your goodies.',
                                    'desc' => 'Drum keys, tuning gels, a Snickers bar? Flexible pockets let you jam all your goodies inside without losing its shape. ',
                                    ],
                                    [
                                         'img' => 'marketing/drumeo/shop/stickbag/black-zipper-m.jpg',
                                    'title' => 'Zippers as tough as you are.',
                                    'desc' => 'Top-quality reinforced zippers make for a long-lasting stick bag – even when it’s jammed to the teeth with sticks, brushes, and mallets.',
                                    ],
                                    [
                                         'img' => 'marketing/drumeo/shop/stickbag/black-holster-m.jpg',
                                    'title' => 'One in the chamber.',
                                    'desc' => 'An easy-access sleeve lets your “rescue stick” poke just out of your stick bag so you can make that quick grab mid-song. ',
                                    ],
                                    [
                                         'img' => 'marketing/drumeo/shop/stickbag/black-drum-key-m.jpg',
                                    'title' => 'Drum keychain (key included!)',
                                    'desc' => 'Finally, a drum key you won’t lose. Your StickBag includes a brushed pewter drum key that has its own little key ring to live inside your bag. ',
                                    ],
                                    [
                                         'img' => 'marketing/drumeo/shop/stickbag/black-premium-hooks-m.jpg',
                                    'title' => 'Premium Metal Tom Hooks',
                                    'desc' => 'No more tying your bag up with string. Your Drumeo StickBag includes sturdy metal loops that easily attach to any tom lugs.',
                                    ],
                                ];
                            @endphp
                        @else
                            @php
                                $gridItems = [
                                [
                                 'img' => 'marketing/drumeo/shop/stickbag/waterproof-m2.jpg',
                                'title' => 'Sweat, water and beer-proof.',
                                'desc' => 'Your StickBag is made from waxed canvas – rugged cotton soaked in wax for extra strength and water resistance.',
                                ],
                                [
                                 'img' => 'marketing/drumeo/shop/stickbag/suede-m2.jpg',
                                'title' => 'Flexible pockets for all your goodies.',
                                'desc' => 'Drum keys, tuning gels, a Snickers bar? Flexible pockets let you jam all your goodies inside without losing its shape. ',
                                ],
                                [
                                 'img' => 'marketing/drumeo/shop/stickbag/zipper-m2.jpg',
                                'title' => 'Zippers as tough as you are.',
                                'desc' => 'Top-quality reinforced zippers make for a long-lasting stick bag – even when it’s jammed to the teeth with sticks, brushes, and mallets.',
                                ],
                                [
                                 'img' => 'marketing/drumeo/shop/stickbag/holster-m2.jpg',
                                'title' => 'One in the chamber.',
                                'desc' => 'An easy-access sleeve lets your “rescue stick” poke just out of your stick bag so you can make that quick grab mid-song. ',
                                ],
                                [
                                 'img' => 'marketing/drumeo/shop/stickbag/drum-key-m2.jpg',
                                'title' => 'Drum keychain (key included!)',
                                'desc' => 'Finally, a drum key you won’t lose. Your StickBag includes a brushed pewter drum key that has its own little key ring to live inside your bag. ',
                                ],
                                [
                                 'img' => 'marketing/drumeo/shop/stickbag/premium-hooks-m2.jpg',
                                'title' => 'Premium Metal Tom Hooks',
                                'desc' => 'No more tying your bag up with string. Your Drumeo StickBag includes sturdy metal loops that easily attach to any tom lugs.',
                                ]
                                ];
                            @endphp
                        @endif
                        @foreach ($gridItems as $gridItem)
                            <li class="splide__slide px-1">
                                <div class="rounded-xl overflow-hidden shadow-md" @if(!empty($blackBag)) style="color:#fff;background-color:#000;" @else style="color:#000;background-color:#F6F8FC;" @endif>
                                    <div class="relative" style="padding-bottom:71%;">
                                        <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="drumeo stickbag"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                    </div>
                                    <p class="mt-4 mb-1 px-4 font-black leading-tight"><strong>{{ $gridItem['title'] }}</strong></p>
                                    <p class="px-4 pb-6 text-sm leading-tight">{{ $gridItem['desc'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="relative z-10 h-5 sm:h-10 -mt-5 md:-mt-10"
        @if(!empty($blackBag))
            style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #000 calc(50% + 1px));"
        @else
            style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F6F8FC calc(50% + 1px));"
        @endif
></div>
<section class="text-center px-6 sm:px-6 pb-8 sm:pb-16 lg:pb-20 relative"
        @if(!empty($blackBag))
            style="background-color:#000;color:#fff;"
        @else
            style="background-color:#F6F8FC;"
        @endif
>
    <div class="container mx-auto z-10 relative max-w-3xl">
        <img class="h-28 sm:h-36 sm:mb-10 -mt-14 sm:-mt-24 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
            @if(!empty($blackBag))
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/820x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-thank-you-text.png"
            @else
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/820x0/filters:quality(95)/marketing/drumeo/shop/stickbag/thank-you-text.png"
            @endif
        >
        <img class="my-6 h-56 rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                @if(!empty($blackBag))
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-stick-sleeve.jpg"
                @else
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stick-sleeve.jpg"
                @endif
            alt="learn playing image"
            fetchpriority="high"
        >
        <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center">
            <p class="flex-grow-0 leading-normal max-w-xl pr-5 lg:pr-8 mx-0">
                Brushes take the worst beating in conventional stick bags – and at $30+ a pop, it hurts even more.
                <br><br>
                The Drumeo StickBag features a custom brushes sleeve that keeps your brush wires straight and true. And when you’re at your kit, toss your brush sleeve under your hi-hat for easy access in any song.
                <br><br>
                It’s an all-new innovation on one of drumming’s oldest tools.</p>
            <img class="flex-shrink-0 w-60 lg:w-68 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                    @if(!empty($blackBag))
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-stick-sleeve.jpg"
                    @else
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/520x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stick-sleeve.jpg"
                    @endif
                alt="learn playing image"
            >
        </div>

    </div>
</section>
@if(empty($blackBag))
<section class="content-section text-center comparison px-1 lg:px-3" style="background:#00101D;">
    <div class="container mx-auto max-w-4xl">
        <h2 class="mb-16 md:mb-12 "><strong>Your new favorite<br class="sm:hidden"> piece of gear. </strong></h2>
        <div class="relative">
            <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
            <table class="w-full mx-auto border-separate comparison eardrums earbuds">
                <tbody style="background-color:transparent!important;">
                <tr style="background-color:transparent!important;">
                    <td></td>
                    <td class="rounded-t-xl">
                        <img class="h-12 md:h-20 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/shop/stickbag/comparison2.png" alt="logo-white">
                    </td>
                    <td class="rounded-t-xl">
                        <img class="h-12 md:h-20 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/shop/stickbag/vic-firth-comparison.png" alt="logo-white">
                    </td>
                    <td class="rounded-t-xl">
                        <img class="h-12 md:h-20 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/160x0/filters:quality(95)/marketing/drumeo/shop/stickbag/tackle-comparison.png" alt="logo-white">
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
                    <td>12 Pairs</td>
                </tr>
                <tr>
                    <td>Protective<br> Brush Sleeve</td>
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
                    <td>Drum Key<br> Included</td>
                    <td>YES</td>
                    <td>NO</td>
                    <td>YES</td>
                </tr>
                <tr style="background-color:transparent!important;">
                    <td class="rounded-b-xl">Total</td>
                    <td class="rounded-b-xl">
                        @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                            <s class="opacity-50">${{ floatval($productPrices['stickbag']->price) }}</s>
                        @endif
                        <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong>
                    </td>
                    <td class="rounded-b-xl"><strong>$104</strong></td>
                    <td class="rounded-b-xl"><strong>$200</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif
<section class="text-center px-5 py-10 md:py-20 lg:py-24" @if(!empty($blackBag)) style="background-color:#020d24;color:#fff;" @else style="background-color:#f6f8fc;" @endif>
    <div class="container mx-auto relative z-10 max-w-5xl">
        <h2><strong>The last StickBag<br class="sm:hidden"> you’ll ever need.</strong></h2>
        <h6 class="leading-tight mt-2 mb-5 sm:mb-10">A bag built to take everything<br class="sm:hidden"> from garage to stage. </h6>

        @if(!empty($blackBag))
            @php
                $slides = [
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/black-gallery2.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/black-gallery-l1.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/black-gallery-l2.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/black-gallery-r1.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/black-gallery-r2.jpg',
                 ],
             ];
            @endphp
        @else
            @php
                $slides = [
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/gallery2.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/gallery-l1.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/gallery-l2.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/gallery-r1.jpg',
                 ],
                 [
                     'img' => 'marketing/drumeo/shop/stickbag/gallery-r2.jpg',
                 ],
             ];
            @endphp
        @endif
        @foreach($slides as $slide)
            @component('_partials.components.modal', ['name' => 'imageModal'])
                @slot('content')
                    <div class="relative overflow-y-visible max-w-3xl px-4 md:px-5 lg:px-7 py-5 md:py-7 lg:py-10 text-black bg-white mx-auto rounded-xl shadow-lg text-center">
                        <img class="logo h-7 md:h-12 lg:h-14 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/{{$slide['img']}}">
                    </div>
                @endslot
            @endcomponent
        @endforeach

        <div class="flex flex-wrap items-center">
            <div class="w-full sm:w-1/2 sm:order-1">
                <div class="p-2 w-full"><div data-open="image1" class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')"></div></div>
            </div>
            <div class="w-1/2 sm:w-1/4">
                <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')"></div></div>
                <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')"></div></div>
            </div>
            <div class="w-1/2 sm:w-1/4 sm:order-2">
                <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')"></div></div>
                <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')"></div></div>
            </div>
        </div>
        <p class="mt-2 mb-5 sm:mb-10 text-sm"><em>Disclaimer: Sticks/Brushes are not included.</em></p>
        <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
            <p class="sm:max-w-md m-0 sm:pr-5 lg:pr-10 text-left mb-5 sm:mb-0">Your Drumeo StickBag is built with premium components to ensure a long-lasting home for your sticks wherever your drumming takes you.</p>
            <div class="overflow-hidden rounded-xl border @if(!empty($blackBag)) border-white @else border-black @endif">
                <table>
                    @if(!empty($blackBag))
                    <tr>
                        <td class="px-3 py-1 text-left border-b border-collapse text-gold @if(!empty($blackBag)) border-white @else border-black @endif">Limited Edition Bag</td>
                        <td class="px-5 py-1 border-b border-collapse text-gold @if(!empty($blackBag)) border-white @else border-black @endif"><i class="fas fa-check"></i></td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-3 py-1 text-left border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif">Durable construction</td>
                        <td class="px-5 py-1 border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif">Premium zippers</td>
                        <td class="px-5 py-1 border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif">Quick-stick slot</td>
                        <td class="px-5 py-1 border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif">Drum key</td>
                        <td class="px-5 py-1 border-b border-collapse @if(!empty($blackBag)) border-white @else border-black @endif"><i class="fas fa-check"></i></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left  border-collapse @if(!empty($blackBag)) border-white @else border-black @endif">Cost</td>
                        <td class="px-5 py-1  border-collapse @if(!empty($blackBag)) border-white @else border-black @endif">@if(!empty($blackBag)) $197 @else ${{ floatval($productPrices['stickbag']->discounted_price) }} @endif</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

<div id="customize-anchor" class="anchor"></div>
@if(!empty($blackBag))
    <section class="py-16 sm:py-24 lg:py-28 relative overflow-hidden text-white text-center customize px-4 lg:px-6" style="background:#000 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-order-bg.jpg') center center/cover;">
        <div class="container mx-auto max-w-6xl relative z-50">
            <img alt="quietkick logo" class="h-20 sm:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/680x0/filters:quality(95)/marketing/drumeo/shop/stickbag/black-stickbag-logo.svg"><br>
            <h5 class="leading-tight text-gold"><strong><em>Only <s class="opacity-50">250</s>
                        @if( $products['stickbag-ltd']->getStockAvailability() > 1 && !empty($products['stickbag-ltd']->getStockAvailability()))
                            {{ $products['stickbag-ltd']->getStockAvailability() }}
                        @endif
                        Available</em></strong></h5>
            <h2 class="leading-tight mt-5 mb-1"><strong>Pack like a pro.</strong></h2>
            <h4 class="leading-tight"> <strong class="text-gold">$197</strong></h4>
            @if( $products['stickbag-ltd']->getStockAvailability() > 1 && !empty($products['stickbag-ltd']->getStockAvailability()))
                <a class="join smaller gold mt-6 w-full max-w-xs"
                        href="/ecommerce/add-to-cart?locked=true&products[stickbag-ltd]=1"
                >Order Now</a>
            @else
                <span class="join smaller sold-out mt-6 w-full max-w-xs">Sold Out</span>
            @endif
        </div>
    </section>
@else
    <section class="content-section text-center customize px-4 lg:px-6" style="background:#173c59 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/order-bg.jpg') center center/cover;">
        <div class="container mx-auto">
            <img alt="quietkick logo" class="h-14 sm:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stickbag-logo2.svg"><br>

            @if( $products['stickbag']->getStockAvailability() > 1 && !empty($products['stickbag']->getStockAvailability()))

                <div class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl mx-auto">
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                            <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black uppercase" >Save 34%</p>
                        @endif
                        <a href="/ecommerce/add-to-cart?locked=true&products[stickbag]=1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                            <div class="bg-white px-3 py-5 md:py-7">
                                <h4 class="mb-2 sm:mb-3"><strong>StickBag Only</strong></h4>
                                <img class="h-24 transition-opacity opacity-0"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/200x0/filters:quality(95)/marketing/drumeo/shop/stickbag/stickbag-option.png"
                                        alt="learn playing image"
                                >
                                <br>
                                <h4 class="inline-block leading-tight">
                                    @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                                        <s>${{ floatval($productPrices['stickbag']->price) }}</s>
                                    @endif
                                    <strong>${{ floatval($productPrices['stickbag']->discounted_price) }}</strong></h4>
                                <p class="text-sm"><em>
                                        @if(floatval($productPrices['stickbag']->price) > floatval($productPrices['stickbag']->discounted_price))
                                            Save 34%.
                                        @endif
                                        One-time payment.</em></p>
                                <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Select</div>
                                <p class="text-sm mb-1.5">1 Drumeo StickBag<sup>NEW</sup></p>
                                <p class="text-sm mb-1.5">1 Brushes Sleeve</p>
                                <p class="text-sm">1 Premium Drum Key</p>
                            </div>
                        </a>
                    </div>

                    @if( Carbon\Carbon::now() && Carbon\Carbon::create(2023, 10, 3, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now() )
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        <img class="h-16 absolute top-0 right-0 z-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/drumeo/shop/stickbag/free-shipping-icon.svg">
                        <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-drumeo uppercase" >LAUNCH SPECIAL</p>
                        <a
                                @if(!empty($memberVersion))
                                    href="/ecommerce/add-to-cart?locked=true&products[DLM-1-year]=1&products[stickbag]=1&products[Drumeo-VaterSticks]=6"
                                @else
                                    href="/promo-bag"
                                @endif
                                class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-drumeo">
                            <div class="bg-white px-3 py-6 md:py-9">
                                <h4 class="mb-2 sm:mb-3"><strong>StickBag + Lessons</strong></h4>
                                <img class="h-24 transition-opacity opacity-0"
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/drumeo/shop/stickbag/lessons-stickbag-option.png"
                                        alt="learn playing image"
                                >
                                <br>
                                <h4 class="inline-block leading-tight"><strong>Free StickBag</strong></h4>
                                <p class="text-sm"><em>
                                        @if(!empty($memberVersion))
                                            with annual Membership renewal
                                        @else
                                            with annual Drumeo Membership
                                        @endif
                                    </em></p>
                                <div class="join my-5 drumeo smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">
                                    @if(!empty($memberVersion))
                                        renew membership
                                    @else
                                        learn more
                                    @endif
                                </div>
                                <p class="text-sm mb-1.5 text-drumeo"><strong>Annual Drumeo Membership</strong> ($240/yr)</p>
                                <p class="text-sm mb-1.5"><strong>The world's best drum lessons.</strong></p>
                                <p class="text-sm mb-1.5"><strong>5000+ popular songs</strong></p>
                                <p class="text-sm mb-1.5"><strong>Unlimited Personal Support</strong></p>
                                <p class="text-sm mb-1.5">1 Drumeo StickBag<sup>NEW</sup></p>
                                <p class="text-sm mb-1.5">1 Brushes Sleeve</p>
                                <p class="text-sm mb-1.5">1 Premium Drum Key</p>
                                <p class="text-sm">6 Pairs Of 5A Drumsticks</p>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif
            <br>
            <a style="color: #00bc75;" class="inline-block cursor-pointer" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[stickbag]=1&locked=true"><h4><strong><u>Or get it FREE when you join Drumeo.</u></strong></h4></a>
        </div>
    </section>
@endif

<section class="text-center py-10" style="background: #00101D;">
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

@include('_partials.components.video-modal',[
    'name' => 'trailer',
    'video' => '864032205',
    'vimeo' => true,
])
@include('_partials.components.video-modal',[
    'name' => 'trailerM',
    'video' => '864032414',
    'vimeo' => true,
        'styles' => 'pb-[177%] bg-white',
])
