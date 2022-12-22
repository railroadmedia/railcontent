<section class="content-section px-4 lg:px-6 relative overflow-hidden text-center customize" style="background:linear-gradient(to bottom, #01050f 40%, #021225);">
    <div class="container mx-auto">
        <img class="h-7 md:h-10 lg:h-12 my-3 md:my-4 lazyload" data-src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
        {{--<img class="h-16 sm:h-28 lg:h-32 mb-3 md:mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/april/international+guitar_logo.png" alt="play-better-solos">--}}
        <h2 class="leading-tight mb-3 md:mb-6 px-3"><strong>Learn what YOU want, get inspired, and <br class="hidden md:inline"> stay motivated with personal support.</strong></h2>
        <h6 class="text-navy">
            <span class="text-coaches uppercase"> for only ${{ number_format((GuitareoPrices::$guitareoMembershipAnnual / 12), 2, '.', ',') }} a month</span>

            {{--<br><em>(Cancel anytime, 90-Day Money Back Guarantee)</em>--}}
        </h6>
        <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-7 mx-auto">
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true" class="text-black overflow-hidden rounded-2xl block mx-auto mb-5 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>MONTHLY</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(GuitareoPrices::$guitareoMembershipMonthlyFull > GuitareoPrices::$guitareoMembershipMonthly)
                                <s class="opacity-60">${{ GuitareoPrices::$guitareoMembershipMonthlyFull }}</s>
                            @endif
                            <strong>${{ GuitareoPrices::$guitareoMembershipMonthly }}</strong></h1> <p class="inline-block -mr-16">per month</p>
                        <p class="text-sm my-4"><em>Only ${{ number_format((GuitareoPrices::$guitareoMembershipMonthly * 12) / 52, 2) }} per week.</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>Recurring monthly plan.</strong></p>
                        <p class="mb-1">Full access to Guitareo Lessons</p>
                        <p class="mb-1">Full access to Guitareo Songs</p>
                        <p class="mb-1">Full access to Guitareo Teachers</p>
                        <p>90-day money back guarantee.</p>
                    </div>
                </a>
            </div>

            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="w-full px-4 pt-2 pb-4 -mb-3 bg-guitareo text-white rounded-t-2xl"><strong>BEST DEAL</strong></p>
                <a href="{{ GuitareoPrices::$guitareoMembershipAnnualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>ANNUAL</strong></h5>
                        @if(GuitareoPrices::$guitareoMembershipAnnualFull > GuitareoPrices::$guitareoMembershipAnnual)
                            <h3 class="inline-block"><s class="opacity-60">${{ GuitareoPrices::$guitareoMembershipAnnualFull }}</s></h3>
                        @endif
                        <h1 class="inline-block leading-none"><strong>${{ GuitareoPrices::$guitareoMembershipAnnual }}</strong></h1> <p class="inline-block mr-2">per year</p>
                        <p class="text-sm my-4"><em>Save {{ round(100 - (100 * (GuitareoPrices::$guitareoMembershipAnnual / (GuitareoPrices::$guitareoMembershipMonthly * 12)))) }}% vs monthly.</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>Recurring annual plan.</strong></p>
                        <p class="mb-1">Full access to Guitareo Lessons</p>
                        <p class="mb-1">Full access to Guitareo Songs</p>
                        <p class="mb-1">Full access to Guitareo Teachers</p>
                        <p>90-day money back guarantee.</p>
                    </div>
                </a>
                {{--<h4 class="bg-guitareo font-bebas rounded-full absolute top-0 right-0 -m-3 py-3 sm:py-3.5 px-4 sm:px-5 border-4 border-white">Save<br> {{ round(100 - (100 * (GuitareoPrices::$guitareoMembershipAnnual / GuitareoPrices::$guitareoMembershipAnnualFull))) }}%</h4>--}}
            </div>
            {{--<div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}
                {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 --}}{{--bg-guitareo--}}{{-- text-black rounded-t-2xl" style="background: linear-gradient(to bottom, #feab01, #fd7a00);"><strong>BEST DEAL</strong></p>--}}
                {{--<a href="/ecommerce/add-to-cart?products[GUITAREO-LIFETIME-MEMBERSHIP]=1&redirect=/order&locked=true" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
                    {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
                        {{--<h5 class="leading-none mb-3"><strong>LIFETIME</strong></h5>--}}
                        {{--<h1 class="inline-block leading-none">--}}
                            {{--<strong>${{ GuitareoPrices::$guitareoMembershipLifetime }}</strong></h1>--}}
                        {{--<p class="text-coaches text-sm my-4"><em>One Time Payment</em></p>--}}
                        {{--<div class="join smaller coaches w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>--}}
                    {{--</div>--}}
                    {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
                        {{--<p class="mb-1"><strong>* LIFETIME GUITAREO ACCESS *</strong></p>--}}
                        {{--<p class="mb-1">Full access to Guitareo Lessons</p>--}}
                        {{--<p class="mb-1">Full access to Guitareo Songs</p>--}}
                        {{--<p class="mb-1">Full access to Guitareo Teachers</p>--}}
                        {{--<p>90-day money back guarantee.</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
        {{--<br><br>--}}
        {{--<a class="join methodcta" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM]=1,year,1&products[Drumeo-Sticks]=1&locked=true">Click Here To Get Started &raquo;</a><br>--}}
        {{--<a class="methodcta monthly-alt" href="/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order"><p><u><em>Or click here to start a monthly membership for <br class="inline md:hidden">${{ GuitareoPrices::$guitareoMembershipMonthly }}/month.</em></u></p></a>--}}
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
