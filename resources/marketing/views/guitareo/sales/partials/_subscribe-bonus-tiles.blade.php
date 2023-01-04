@php $annualLink = '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true' @endphp

<div style="background:linear-gradient(to bottom, #02010f, #010522);">
<section id="orderNow" class="content-section px-4 lg:px-6 text-center customize relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #01050f 40%, #021225);">
    <div class="container mx-auto relative z-50">
        <div class="horizontal-bonuses mx-auto" style="font-size: 0;">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-md">
                    <img class="h-20 absolute top-0 right-0 z-10 -mt-8 -mr-2" src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/december/santa-hat.png">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 47%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class="border-2 border-promo front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                {{--                                <h6 class="absolute text-black top-0 left-0 w-full py-0.5 bg-promo rounded-t-xl font-bebas uppercase">SAVE 38%</h6>--}}
                                <div class="h-full w-full bg-black bg-center bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/annual.jpg"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="leading-tight my-3">
                    <strong>
                        Join Guitareo for just ${{  round(Prices::$plusSubscriptionAnnual / 12, 2) }}/month</strong> <br class="hidden sm:inline">
                    <strong class="text-promo">PLUS</strong> get 6 free bonuses worth $924.
                </h3>
                <a class="join promo bigger my-3 md:my-4 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $annualLink }}" {{--data-open="orderModal"--}}>GET Started &raquo;</a>
                <p class="leading-tight text-sm"><em>Billed at ${{ Prices::$plusSubscriptionAnnual }} per year.<br class="inline sm:hidden">  Cancel anytime. 90-day guarantee.</em></p>
                <h4 class="leading-tight my-6 sm:my-8">
                    <strong>6 FREE BONUSES.</strong> <em>ONLY<br class="inline sm:hidden"> AVAILABLE UNTIL DECEMBER 26</em></h4>

            </div>
            <div class="max-w-2xl mx-auto my-5 sm:my-7">
                @php
                    $bonuses = [
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/november/survival-kit-narrow-card-sale-site.jpg',
                            'title' => 'Survival Kit',
                            'description' => 'Electric Strings, Acoustic Strings, String Pro-Winder, 10 Assorted Picks, Tuner, Chord & Scales Book, and more!',
                            'price' => floatval($productPrices['guitarists-survival-kit']->price),
                            'online-ship' => "Free Shipping"
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gq.jpg',
                        'title' => 'GuitarQuest',
                        'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',
                        'price' => floatval($productPrices['guitar-quest']->price),
                        'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',
                            'title' => 'The Guitar System',
                            'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',
                            'price' => floatval($productPrices['GUITAR-SYSTEM']->price),
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',
                            'title' => 'Guitar Technique Made Easy',
                            'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',
                            'price' => floatval($productPrices['GTME-OCT-2018-SEMESTER']->price),
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                            'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/agme.jpg',
                            'title' => 'Acoustic Guitar Made Easy',
                            'description' => 'Build a rock-solid foundation and get started on the acoustic guitar the right way.',
                            'price' => floatval($productPrices['AGME-JAN-2019-SEMESTER']->price),
                            'online-ship' => "Lifetime Access"
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/rhythm_groove_cart.jpg',
                        'title' => 'Rhythm & Groove',
                        'description' => 'Go beyond simple strumming on the guitar.',
                        'price' => floatval($productPrices['rhythm-and-groove']->price),
                        'online-ship' => "Lifetime Access"
                        ],
                        // [
                        // 'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/500s.jpg',
                        // 'title' => '500 Songs In 5 Days',
                        // 'description' => 'Build the skills and knowledge to play 500 songs on the guitar. Comes with downloadable chord charts.',
                        // 'price' => floatval($productPrices['500-songs-in-5-days-guitareo']->price),
                        // 'online-ship' => "Lifetime Access"
                        // ],
                        // [
                        // 'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg',
                        // 'title' => 'Survival Guide',
                        // 'description' => 'A handy 37-page book with all the essential chords, strumming patterns, scales, and riffs. ',
                        // 'price' => 5,
                        // 'online-ship' => "Free Shipping"
                        // ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3">
                        <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 130%;">
                            <div class="flip-inner">
                                <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif" style="border-color: #df0032;">
                                    <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                    <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
                                </div>
                                <div class="back">
                                    <div class="text-wrap">
                                        <p class="text-sm">
                                            <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                            {!!  $bonus['description']  !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="uppercase mt-2" style="line-height: 1.25;">
                            {{--<strong class="font-black leading-tight inline-block  mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                            <span class="inline-block">
                                @if(empty($bonus['included']))
                                    <s>${{ $bonus['price'] }}</s> <strong class="text-promo">FREE</strong>
                                @else
                                    <strong class="text-promo">Included</strong>
                                @endif
                            </span><br>
                            {{ $bonus['online-ship'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- <h4 class="leading-tight"><strong>Billed annually at <s class="opacity-60">${{ Prices::$plusSubscriptionAnnualFull }}</s> ${{ Prices::$plusSubscriptionAnnual }} per year.</strong><br class="inline sm:hidden"> <em class="text-coaches">(Save {{ round(100 - (100 * (Prices::$plusSubscriptionAnnual / Prices::$plusSubscriptionAnnualFull))) }}%.)</em></h4> --}}
        <a class="join bigger" href="/ecommerce/add-to-cart?redirect=/order&products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitarists-survival-kit]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&products[AGME-JAN-2019-SEMESTER]=1&products[GTME-OCT-2018-SEMESTER]=1&locked=true" style="background:#df0032;">Get Started &raquo;</a>
        <br>
        <a class="monthly-alt" href="/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true" style="color:#ABB5C2;"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>
</div>
<section class="content-section text-center" style="background: #020814;">
    <div class="container mx-auto relative z-50">
        <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Guitareo+Membership/79348454" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Guitareo+Membership/79348454', 'newwindow', 'width=750, height=550'); return false;">
            <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <p class="mx-auto mt-2 md:mt-3 text-light-navy">Guitareo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
        </a>
        <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
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
