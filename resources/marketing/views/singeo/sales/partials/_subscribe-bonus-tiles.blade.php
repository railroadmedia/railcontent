@php $annualLink = '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&products[singing-starter-kit]=1&products[the-essential-guide-to-beautiful-harmonies]=1&products[vowel-sounds-poster]=1&bonuses[PIANOTE-MEMBERSHIP-1-YEAR]=1&bonuses[GUITAREO-1-YEAR-MEMBERSHIP]=1&locked=true&redirect=/order' @endphp

<div style="background:linear-gradient(to bottom, #02010f, #010522);">
<section class="content-section text-center customize relative z-50 overflow-hidden" style="background-color:#000;">
    <div class="container mx-auto relative z-50">
        <img class="h-36 sm:h-72 lg:h-96" src="https://singeo.s3.amazonaws.com/sales/promos/august/homepage_chart.png" alt="singeo annual membership">
        <h3 class="leading-tight my-3">
            <strong>
                Join Singeo for just ${{  round(SingeoPrices::$singeoMembershipAnnual / 12, 2) }}/month</strong> <br class="hidden sm:inline">
            <strong class="text-promo">PLUS</strong> get 5 free bonuses worth $538.
        </h3>
        <a href="{{ $annualLink }}" class="join promo my-3 md:my-4 w-full max-w-xs md:max-w-lg lg:max-w-xl">GET Started &raquo;</a>
        <p class="leading-tight text-sm"><em>Billed at ${{ SingeoPrices::$singeoMembershipAnnual }} per year.<br class="inline sm:hidden">  Cancel anytime. 90-day guarantee.</em></p>
        <h4 class="leading-tight my-6 sm:my-8">
            <strong>5 FREE BONUSES.</strong> <em>ONLY<br class="inline sm:hidden"> AVAILABLE UNTIL DECEMBER 26</em></h4>


        <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-xl lg:max-w-4xl mb-5 sm:mb-7" style="font-size: 0;">
            @php
                $bonuses = [
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',
                        'title' => 'Singing<br> Starter Kit',
                        'description' => 'Get everything you need to start singing now. In just 7 hands-on lessons, you’ll overcome the challenges most beginner singers face and will instantly sound better.',
                        'price' => SingeoPrices::$singingStarterKitFull,
                        'online-ship' => "Lifetime Access"
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/promos/october/Beautiful_harmonies_card.jpg',
                        'title' => 'Harmony',
                        'description' => 'In just 8, short, sing-a-long lessons, you’ll learn how to elevate any vocal performance with incredible harmonies. Even if you’re a total beginner, you’ll be singing your first harmony within the first 10 minutes of this course.',
                        'price' => SingeoPrices::$beautifulHarmoniesFull,
                        'online-ship' => "Lifetime Access"
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',
                        'title' => 'Vowel Practice<br> Poster',
                        'badge' => 'Vowel Practice Poster',
                        'description' => 'Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.',
                        'price' => SingeoPrices::$posterFull,
                        'online-ship' => "Free Shipping",
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/lifetime/1-year-of-guitar-card.jpg',
                        'title' => '1 Year of Guitareo Lessons',
                        'badge' => '1 Year of Guitareo Lessons',
                        'description' => '1 year of online video-based guitar lessons and personal support.',
                        'price' => 240,
                        'online-ship' => "Online Access",
                    ],
                    [
                        'image' => 'https://singeo.s3.amazonaws.com/sales/lifetime/1-year-of-piano-card.jpg',
                        'title' => '1 Year of Pianote Lessons',
                        'badge' => '1 Year of Pianote Lessons',
                        'description' => '1 year of online video-based piano lessons and personal support.',
                        'price' => 240,
                        'online-ship' => "Online Access",
                    ],
                ]
            @endphp
            @foreach($bonuses as $key => $bonus)
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3 lg:w-1/5">
                    <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif">
                        <div class="flip-inner">
                            <div class="front border-promo @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">
                                <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
                            </div>
                            <div class="back">
                                <div class="text-wrap">
                                    <p class="text-xs">{!!  $bonus['description']  !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="uppercase">
                        <span class="text-promo inline-block" ><strong><s style="color:#5F5F5F;">${{ $bonus['price'] }}</s> FREE</strong></span><br>
                        {{ $bonus['online-ship'] }}
                    </p>
                </div>
                @if($key === 2)<br class="hidden sm:inline">@endif
            @endforeach
        </div>
        <a class="join promo my-3 md:my-4 w-full max-w-xs md:max-w-lg lg:max-w-xl" href="{{ $annualLink }}">GET Started &raquo;</a>
        <br>
        <a class="memcta monthly-alt text-light-navy" href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true" dusk="order-monthly"><p><u><em>Or start a monthly membership for <br class="inline sm:hidden">${{ App\Prices::$singeoMembershipMonthly }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>
</div>

<section class="content-section text-center" style="background: #0c1429;">
    <div class="container mx-auto relative z-50">
        <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Singeo+Membership/79348458" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Singeo+Membership/79348458', 'newwindow', 'width=750, height=550'); return false;">
            <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <p class="mx-auto mt-2 md:mt-3 text-light-navy">Singeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
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
