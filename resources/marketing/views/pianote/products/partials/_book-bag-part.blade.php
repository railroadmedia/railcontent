<header class="text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl">
                <img alt="pianote logo" class="h-12 sm:h-14"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/280x0/filters:quality(95)/marketing/pianote/products/book-bag/pianote-logo.svg"><br>
                <h1 class="leading-tight mt-2 mb-3 text-4xl sm:text-5xl lg:text-6xl playfair"><strong>The Pianote Book
                        Bag</strong></h1>
                <h4 class="py-4 sm:py-6">A handcrafted premium leather satchel for your music books, laptop, and life.
                    </p>
                    <h3 class="leading-tight">
                        @if (floatval($productPrices['book-bag']->price) > floatval($productPrices['book-bag']->discounted_price))
                            <s class="opacity-50">${{ floatval($productPrices['book-bag']->price) }}</s>
                            <strong>${{ floatval($productPrices['book-bag']->discounted_price) }}</strong>
                            <span class="text-xl">(Save
                                {{ round(100 - 100 * (floatval($productPrices['book-bag']->discounted_price) / floatval($productPrices['book-bag']->price))) }}%)</span>
                        @else
                            <strong>Only ${{ floatval($productPrices['book-bag']->discounted_price) }}</strong>
                        @endif
                    </h3>
                    <div class="mt-5 sm:mt-7 mb-2 w-full max-w-xl mx-auto">
                        <div class="sm:w-5/12 join smaller outline hidden sm:inline-block text-pianote hover:bg-pianote hover:text-white"
                            x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false"
                            @click="trailer = true;">
                            <i class="fas fa-play" :class="{ 'translate-x-2': move }"></i> &nbsp;Watch Video
                        </div>
                        <div class="sm:w-5/12 join smaller outline sm:hidden inline-block text-pianote hover:bg-pianote hover:text-white"
                            x-data="{ move: false }" @mouseover="move = true" @mouseout="move = false"
                            @click="trailerM = true;">
                            <i class="fas fa-play" :class="{ 'translate-x-2': move }"></i> &nbsp;Watch Video
                        </div>
                        @if ($products['book-bag']->getStockAvailability() > 1 && !empty($products['book-bag']->getStockAvailability()))
                            <a class="w-5/12 join smaller text-white bg-pianote m-2 hover:bg-red-500"
                                href="#customize-anchor" x-data="{ move: false }" @mouseover="move = true"
                                @mouseout="move = false">Order Now</a>
                        @else
                            <a class="join smaller sold-out">SOLD OUT</a>
                        @endif
                    </div>
                    {{--                <h6 class="text-sm leading-tight"><em>or get it free with an Annual Pianote Membership.</em></h6> --}}
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(0, 0, 0, 0.5)"></div>
        <!-- <img class="object-cover w-full relative z-0" style="height: 700px;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/hero-image.webp"> -->
        <video class="object-cover w-full relative z-0" style="height: 700px;" type="video/mp4" autoplay loop
            playsinline muted
            src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/book-bag/book-bag-hero-reel-wide-to-loop-1.mp4"></video>
</header>


<!--description section-->

<section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative">
    <div class="container mx-auto z-10 relative max-w-5xl lg:max-w-6xl pb-10 lg:pb-16">
        <h2 class="leading-tight playfair pb-2 sm:pb-4 lg:pb-6"><strong>The beauty is in the <br class="sm:hidden">
                details.</strong></h2>
        <!--Desktop view-->
        <div class="hidden lg:flex items-center justify-center">
            <div class="text-left">
                <p class="text-lg"><strong>Single leather handle</strong> <br /> provide easy carrying options<br /> and
                    minimalistic styling.</p>
            </div>
            <div class="text-left pl-12">
                <p class="text-lg"><strong>External side and back</strong> pockets <br />for easy access and extra
                    security</p>
            </div>
        </div>
        <div class="hidden lg:flex justify-center items-center">
            <div class="w-1/3">
                <div class="text-left pl-8 pb-10">
                    <p class="text-lg"><strong>Premium-grade, oil-tanned leather</strong> ensures a classic look that
                        only gets better with age.</p>
                </div>
                <div class="text-left pl-4 pt-10">
                    <p class="text-lg"><strong>16-inch laptop sleeve </strong> <br />keeps your computer safe.</p>
                </div>
            </div>
            <div class="w-2/3">
                <img
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-graph.webp">
            </div>
            <div class="w-1/3 flex items-center jusify-center">
                <div class="text-left">
                    <p class="text-lg"><strong>Custom Pianote embossing</strong> <br />provides a subtle yet distinctive
                        <br /> look. This bag is for piano players.</p>
                </div>
            </div>
        </div>
        <div class="hidden lg:flex justify-center items-center">
            <div class="text-left text-lg">
                <p class="text-lg"><strong>Magnetic clasps</strong> give you <br />modern access while keeping <br /> a
                    vintage buckle look.</p>
            </div>
            <div class="text-left pl-8">
                <p class="text-lg"><strong>Removable shoulder strap</strong> <br />for convenience and comfort.</p>
            </div>
        </div>
    </div>
    <!--mobile view-->
    <div class="lg:hidden mb-5" x-data="{
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
                drag: 'free',
                snap: false,
                breakpoints: {
                    767: {
                        perPage: 1.5,
                    },
                },
            }).mount()
        },
    }">
        <div x-ref="splide" class="splide text-left">
            <div class="splide__track pb-8">
                <ul class="splide__list items-start">
                    @php
                        $gridItems = [
                            [
                                'img' => 'marketing/pianote/products/book-bag/tanned.webp',
                                'desc' => '<strong>Single leather handle</strong> provide easy carrying options and minimalistic styling.',
                            ],
                            [
                                'img' => 'marketing/pianote/products/book-bag/back-pockets.webp',
                                'desc' => '<strong>External side and back</strong> pockets <br/>for easy access and extra security',
                            ],
                            [
                                'img' => 'marketing/pianote/products/book-bag/handle.webp',
                                'desc' => '<strong>Premium-grade, oil-tanned leather</strong> ensures a classic look that only gets better with age.',
                            ],
                            [
                                'img' => 'marketing/pianote/products/book-bag/sleeve.webp',
                                'desc' => '<strong>16-inch laptop sleeve </strong> <br/>keeps your computer safe.',
                            ],
                            [
                                'img' => 'marketing/pianote/products/book-bag/emobssed.webp',
                                'desc' => '<strong>Custom Pianote embossing</strong> provides a subtle yet distinctive look. This bag is for piano players.',
                            ],
                            [
                                'img' => 'marketing/pianote/products/book-bag/magnetic-clasps.webp',
                                'desc' => '<strong>Magnetic clasps</strong> give you modern access while keeping  a vintage buckle look.',
                            ],
                            [
                                'img' => 'marketing/pianote/products/book-bag/removable.webp',
                                'desc' => '<strong>Removable shoulder strap</strong> for convenience and comfort.',
                            ],
                        ];
                    @endphp
                    @foreach ($gridItems as $gridItem)
                        <li class="splide__slide px-1">
                            <div class="rounded-xl overflow-hidden shadow-md" style="background-color:#F1EFED;">
                                <div class="relative" style="padding-bottom:71%;">
                                    <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                        loading="lazy" onload="this.classList.remove('opacity-0')" alt="Pianote Book Bag Details"
                                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                </div>
                                <div class="flex items-start justify-start h-28">
                                    <p class="text-base leading-wide playfair-light m-0 px-6 py-4">
                                        {!! $gridItem['desc'] !!}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>
</section>


<!--features section-->

<div class="relative z-10 h-5 sm:h-10 -mt-5 md:-mt-10" 
     style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F1EFED calc(50% + 1px));"></div>

     <section class="text-center px-6 sm:px-6 pb-8 sm:pb-16 lg:pb-20 relative" style="background-color:#F1EFED">
    <div class="container mx-auto z-10 relative max-w-4xl">
        <h2 class="leading-tight playfair pt-4 sm:pt-6 lg:pt-8"><strong>From concert halls to city streets.</strong></h2>
        <h5 class="leading-tight px-2 sm:px-10 py-2 italic">The Pianote Book Bag oozes style. This beautiful leather satchel will look at home in Carnegie Hall and next to your Casio.</h5>

        @php
            $items = [
                [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-01.webp',
                    'desc' => '<strong> Designed to be used, </strong> the Pianote Book Bag combines fashion and function to ensure you never have to leave the important things behind.',
                    'alt'=> 'A woman carrying The Pianote Book Bag, showcasing its fashionable and functional design.'
                ],
                [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-03.webp',
                    'desc' => '<strong>Five separate internal compartments </strong> give you enough space for your music books, sheet music, notebooks, and a laptop. This messenger bag is your everyday carry for the things that matter most.',
                    'alt'=> 'Stack of music sheets neatly organized inside The Pianote Book Bag.'
                ],
                [
                    'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/features-02.webp',
                    'desc' => '<strong>The premium leather </strong> will only look better with age. This is truly a luxury bag that doesn’t come with the pretense. <br/><br/>But don’t worry… <br/><br/> You’ll still get compliments every time you leave the house.',
                    'alt'=> 'Front view of The Pianote Book Bag, highlighting its premium leather construction that ages beautifully.'
                ]
            ];
        @endphp

        @foreach ($items as $index => $item)
            <img class="my-4 w-full rounded-xl overflow-hidden inline sm:hidden transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="{{ $item['img'] }}"
                    alt="{{ $item['alt'] }}">
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center sm:py-10">
                @if ($index % 2 == 0)
                    <img class="flex-shrink-0 w-full sm:w-2/3 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="{{ $item['img'] }}"
                        alt="{{ $item['alt'] }}"
                    >
                    <h6 class="flex-grow-0 leading-normal max-w-xl sm:pl-5 lg:pl-8 mx-0">
                        {!! $item['desc'] !!}
                    </h6>
                @else
                    <h6 class="flex-grow-0 leading-normal max-w-xl sm:pr-5 lg:pr-8 mx-0">
                        {!! $item['desc'] !!}
                    </h6>
                    <img class="flex-shrink-0 w-full sm:w-2/3 rounded-xl overflow-hidden hidden sm:inline-block transition-opacity opacity-0"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                        src="{{ $item['img'] }}"
                        alt="{{ $item['alt'] }}"
                    >
                @endif
            </div>
        @endforeach
    </div>
</section>


<section class="relative overflow-hidden">
    <!-- Desktop view -->
    <div class="hidden sm:block relative leading-tight">
        <img class="object-cover w-full h-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/book-bag/made-with-love.webp" alt="Background image">
        <div class="absolute top-1/2 transform -translate-y-1/2 left-0 z-10 md:right-auto w-1/2 md:pl-10 lg:pl-32">
            <div class="p-8 rounded-lg text-left" style="background: rgba(18, 18, 16, 0.85);">
                <h2 class="text-white playfair pb-4">Made with love. And priced that way too.</h2>
                <p class="text-white text-xs lg:text-base">The Pianote Book Bag is custom-designed by leather artisans in the USA. Each bag is handmade with a level of craftsmanship and quality comparable to bags in the $300 - $600 price range. <br><br> But we’re not here for the mark-up. <br><br>We love our students and genuinely think this bag will make your life better. So we’re committed to keeping the price affordable, without compromising on quality.</p>
            </div>
        </div>
    </div>

    <!-- Mobile view -->
    <div class="block sm:hidden relative leading-tight">
        <img class="object-cover w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/made-with-love-m.webp" alt="Background image">
        <div class="absolute bottom-3 z-10">
            <div class="p-8 rounded-lg text-left">
                <h2 class="text-white playfair pb-2">Made with love. And priced that way too.</h2>
                <p class="text-white text-base">The Pianote Book Bag is custom-designed by leather artisans in the USA. Each bag is handmade with a level of craftsmanship and quality comparable to bags in the $300 - $600 price range. <br><br> But we’re not here for the mark-up. <br><br>We love our students and genuinely think this bag will make your life better. So we’re committed to keeping the price affordable, without compromising on quality.</p>
            </div>
        </div>
    </div>
</section>





<!--table section-->

<section class="content-section text-center comparison px-1 lg:px-3 py-10 md:py-16" style="background:#F5F5F5;" x-data="{ tableClass: 'earbuds' }">
    <div class="container mx-auto max-w-5xl">
        <h2 class="mb-16 md:mb-12 text-black playfair"><strong>See how the Pianote Book Bag <br class="sm:hidden">  compares. </strong></h2>
        <div class="relative">
            <p class="inline md:hidden leading-tight text-xs absolute top-0 right-0 -mt-9 w-1/3 animated infinite bounce slower"><strong>TAP TO SEE<br> EXAMPLES <i class="fas fa-level-down"></i></strong></p>
            <table :class="{'earbuds': tableClass === 'earbuds', 'headphones': tableClass === 'headphones'}"  class="w-full mx-auto border-separate comparison eardrums earbuds">
                <tbody style="background-color:transparent!important;">
                <tr style="background-color:transparent!important;">
                    <td></td>
                    <td class="rounded-t-xl">
                        <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-comparison-03.webp" alt="The Pianote Book Bag">
                    </td>
                    <td class="rounded-t-xl" @click="tableClass = 'headphones'">
                        <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-comparison-01.webp" alt="Brand Name Messenger Bag">
                    </td>
                    <td class="rounded-t-xl" @click="tableClass = 'earbuds'">
                        <img class="h-20 md:h-40 transition-opacity opacity-0"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/bag-comparison-02.webp" alt="Brand Name Satchel Bag">
                    </td>
                </tr>
                <tr>
                    <td>Leather</td>
                    <td>Premium Oil-Tanned Leather</td>
                    <td>Full-Grain Leather</td>
                    <td>Vintage Tribe Leather</td>
                </tr>
                <tr>
                    <td>Laptop Sleeve</td>
                    <td>16” Laptop Sleeve</td>
                    <td>16” Laptop Sleeve</td>
                    <td>13” Laptop Sleeve</td>
                </tr>
                <tr>
                    <td>External Pockets</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
                <tr style="background-color:transparent!important;">
                    <td class="rounded-b-xl">Total</td>
                    <td class="rounded-b-xl text-black">
                        @if(floatval($productPrices['book-bag']->price) > floatval($productPrices['book-bag']->discounted_price))
                            <s>${{ floatval($productPrices['book-bag']->price) }}</s>
                        @endif
                        <strong>${{ floatval($productPrices['book-bag']->discounted_price) }}</strong>
                    </td>
                    <td class="rounded-b-xl"><strong>$349</strong></td>
                    <td class="rounded-b-xl"><strong>$448</strong></td>
                    @php 
                    floatval($productPrices['book-bag']->price)
                    @endphp
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


<!--cards section-->
<section class="text-center py-10 md:py-16" style="background: #F1EFED;">

    <img alt="pianote logo block center" class="h-8 sm:h-10"
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/280x0/filters:quality(95)/marketing/pianote/products/book-bag/pianote-logo.svg">
    <h2 class="text-center playfair">The Pianote Book Bag</h2>

    <div class="container mx-auto max-w-5xl">
        <div id="customize-anchor" class="anchor"></div>
        <div
            class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mb-5 sm:mb-10 mx-auto">

            @include('pianote.products.partials._promo-card', [
                'topBadgeText' => 'Save ' . round(100 - 100 * (floatval($productPrices['book-bag']->discounted_price) / floatval($productPrices['book-bag']->price))) . '%',
                'productTheme' => 'black',
                'cardTitle' => 'Book Bag Only',
                'cardImageHeight' => 'h-40',
                'cardImageUrl' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/order-bag-01.webp',
                'cardPrice' => floatval($productPrices['book-bag']->discounted_price),
                'cardDiscount' => floatval($productPrices['book-bag']->price),
                'cardSubtitle' => 'One-time payment. Free shipping.',
                'cardButtons' => [['link' => '/', 'text' => 'Select']],
                'cardBonuses' => ['Premium Oil-Tanned Leather', '16” Laptop Sleeve', 'Custom Embossed'],
                'sku' => 'book-bag',
            ])

            @include('pianote.products.partials._promo-card', [
                'topBadgeText' => 'LAUNCH SPECIAL',
                'productTheme' => 'pianote',
                'cardTitle' => 'The Book Bag Bundle',
                'cardImageHeight' => 'h-40',
                'cardImageUrl' =>
                    'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/products/book-bag/order-bag-02.webp',
                'cardPrice' => '249',
                'cardSubtitle' => 'One-time payment. Free shipping.',
                'cardButtons' => [['link' => '/', 'text' => 'Select']],
                'cardBonuses' => [
                    'Pianote Book Bag',
                    'Chords & Scales Book',
                    'Practice Planner',
                    'The Most Beautiful Classical Piano Pieces',
                ],
                'sku' => 'book-bag',
            ])
            <a href="/" class="text-center text-xs italic pt-4">Or get your back FREE with a Pianote
                Membership</a>
        </div>

        <div class="text-center pt-10">
            <div class="container mx-auto relative z-50">
                <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0; color: #ABB5C2;">
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                    <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
                </div>
                <div class="inline-block w-full px-3 md:px-4 mb-5">
                    <p class="text-black text-xs py-2">Any questions? Call us toll-free at
                        <a href="tel:+18004398921" class="underline">1-800-439-8921</a> <br
                            class="inline-block md:hidden"> or directly at
                        <a href="tel:+16048557605" class="underline">1-604-855-7605</a>.<br> All prices listed in USD.
                    </p>
                </div>
            </div>
        </div>
    </div>

</section>





@include('_partials.components.video-modal',[
    'name' => 'trailer',
    'video' => '913081651',
    'vimeo' => true,
])
@include('_partials.components.video-modal',[
    'name' => 'trailerM',
    'video' => '913081651',
    'vimeo' => true,
        'styles' => 'pb-[177%] bg-white',
])
