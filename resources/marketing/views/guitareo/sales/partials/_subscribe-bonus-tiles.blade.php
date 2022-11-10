@php $annualLink = '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[guitar-quest]=1&products[rhythm-and-groove]=1&products[GUITAR-SYSTEM]=1&redirect=/order&locked=true' @endphp

<section id="orderNow" class="content-section px-4 lg:px-6 text-center customize relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #01050f 40%, #021225);">
    <div class="container mx-auto relative z-50">
        <div class="horizontal-bonuses mx-auto" style="font-size: 0;">
            <img class="h-10 md:h-16 mb-3 md:mb-4" src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
            {{-- <img class="h-16 sm:h-20" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/july/guitareo-summer-sale-light.png" alt="play-better-solos"> --}}
            <h2 class="my-3 md:my-5 leading-tight">
                <strong>
                    Get scary good guitar lessons <br>for just <span class="text-guitareo">$10.58</span> a month.
                    {{-- Join Guitareo for just <span class="text-guitareo">${{ round((GuitareoPrices::$guitareoMembershipAnnual / 12), 2) }}/month</span> <br class="hidden sm:inline"> and get 6 free bonuses worth $904. --}}
                </strong>
            </h2>
            {{-- <h6><strong class="text-coaches uppercase">ONLY <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span> LEFT!</strong><br></h6> --}}
            <h6 class="uppercase text-coaches">Join Guitareo + Get 3 Trick-Free <br class="md:hidden">Treats Worth $441</h6>

            <div class="max-w-2xl mx-auto my-5 sm:my-7">
                {{-- <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3" style="width: 100%;"> --}}
                    {{-- <div class="flip-div special"> --}}
                        {{-- <div class="flip-inner"> --}}
                            {{-- <div class="front "> --}}
                                {{-- <div class="absolute top-0 right-0 border-2 bg-black text-promo rounded-full py-4 px-3 -m-5" style="border-color:#de0031"><p style="line-height: 1em;">SAVE</p><br><h5 class="leading-none" style="margin-bottom: 0;"><strong>24%</strong></h5></div> --}}
                                {{-- <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/annual.jpg);"></div> --}}
                            {{-- </div> --}}
                            {{-- <div class="back"> --}}
                                {{-- <div class="text-wrap"> --}}
                                    {{-- <p><strong class="font-black inline-block mb-1">Guitareo Annual Membership</strong><br> Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.</p> --}}
                                {{-- </div> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <p><span class="text-promo" style="text-transform:uppercase; display:inline-block;margin-top: 7px;"><s>${{ GuitareoPrices::$guitareoMembershipAnnualFull }}</s> <strong>${{ GuitareoPrices::$guitareoMembershipAnnual }}</strong></span><br> --}}
                        {{-- INSTANT ACCESS --}}
                    {{-- </p> --}}
                {{-- </div> --}}
                @php
                    $bonuses = [
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gq.jpg',
                        'title' => 'GuitarQuest',
                        'description' => 'Skip the boring stuff and start having fun! Your journey starts here.',
                        'price' => GuitareoPrices::$guitarQuestFull,
                        'online-ship' => "Lifetime Access"
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/rhythm_groove_cart.jpg',
                        'title' => 'Rhythm & Groove',
                        'description' => 'Go beyond simple strumming on the guitar.',
                        'price' => GuitareoPrices::$rhythmAndGrooveFull,
                        'online-ship' => "Lifetime Access"
                        ],
                        // [
                        // 'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/500s.jpg',
                        // 'title' => '500 Songs In 5 Days',
                        // 'description' => 'Build the skills and knowledge to play 500 songs on the guitar. Comes with downloadable chord charts.',
                        // 'price' => GuitareoPrices::$songs500Full,
                        // 'online-ship' => "Lifetime Access"
                        // ],
                        // [
                        // 'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/agme.jpg',
                        // 'title' => 'Acoustic Guitar Made Easy',
                        // 'description' => 'Build a rock-solid foundation and get started on the acoustic guitar the right way.',
                        // 'price' => GuitareoPrices::$AGMEFull,
                        // 'online-ship' => "Lifetime Access"
                        // ],
                        // [
                        // 'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',
                        // 'title' => 'Guitar Technique Made Easy',
                        // 'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',
                        // 'price' => GuitareoPrices::$GTMEFull,
                        // 'online-ship' => "Instant Access"
                        // ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',
                        'title' => 'The Guitar System',
                        'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',
                        'price' => GuitareoPrices::$guitarSystemFull,
                        'online-ship' => "Lifetime Access"
                        ],
                        // [
                        // 'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/july/survival_guide.jpg',
                        // 'title' => 'Survival Guide',
                        // 'description' => 'A handy 37-page book with all the essential chords, strumming patterns, scales, and riffs. ',
                        // 'price' => GuitareoPrices::$survivalGuideFull,
                        // 'online-ship' => "Free Shipping"
                        // ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3">
                        <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 130%;">
                            <div class="flip-inner">
                                <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">
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
        <h4 class="leading-tight"><strong>Billed annually at {{--<s class="opacity-60">${{ GuitareoPrices::$guitareoMembershipAnnualFull }}</s>--}} ${{ GuitareoPrices::$guitareoMembershipAnnual }} per year.</strong>{{--<br class="inline sm:hidden"> <em class="text-coaches">(Save {{ round(100 - (100 * (GuitareoPrices::$guitareoMembershipAnnual / GuitareoPrices::$guitareoMembershipAnnualFull))) }}%.)</em>--}}</h4>
        <a class="join bigger" href="{{ $annualLink }}" style="color:black;">Get Started</a>
        <br>
        <a class="monthly-alt" href="/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true" style="color:#ABB5C2;"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ GuitareoPrices::$guitareoMembershipMonthly }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>

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
