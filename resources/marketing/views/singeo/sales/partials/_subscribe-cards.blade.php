@php $annualLink = '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&locked=true&redirect=/order' @endphp

{{--@include('_partials.layout.holiday.homepage-bottom-banner',[--}}
{{--    'text' => '<strong class="text-promo">Save up to 81%</strong> on lessons,<br class="inline md:hidden"> accessories, and merch.'--}}
{{--])--}}

<section class="content-section text-center customize relative z-50 overflow-hidden" style="background: #01050f;">
    <div class="container mx-auto relative z-50">
        <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-xl lg:max-w-4xl" style="font-size: 0;">
            <img class="h-10 md:h-16" src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
            <h2 class="my-2 md:my-3 leading-normal"><strong>Learn to sing for just <span class="text-singeo">${{ number_format(Prices::$plusSubscriptionAnnual/ 12, 2) }}</span> per month!</strong></h2>
            <h4><em>Discover and fall in love with the full potential of your voice.</em></h4>
        </div>

        <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl mt-8 md:mt-10 lg:mt-12 {{--px-3 md:px-0 mt-4 md:mb-10--}} mx-auto">
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 bg-singeo rounded-t-2xl">MOST POPULAR</p>--}}
                <a href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>MONTHLY</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(Prices::$plusSubscriptionMonthlyFull > Prices::$plusSubscriptionMonthly)
                                <s class="opacity-60">${{ Prices::$plusSubscriptionMonthlyFull }}</s>
                            @endif
                            <strong>${{ Prices::$plusSubscriptionMonthly }}</strong></h1> <p class="inline-block {{---mr-16--}}">per month</p>
                        <p class="text-sm my-4"><em>Only ${{ number_format((Prices::$plusSubscriptionMonthly * 12) / 52, 2) }} per week.</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>Recurring monthly plan. </strong></p>
                        <p class="mb-1">Full access to Singeo Lessons</p>
                        <p class="mb-1">Full access to Singeo Songs</p>
                        <p class="mb-1">Full access to Singeo Teachers</p>
                        <p>90-day money back guarantee.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="w-full px-4 pt-2 pb-4 -mb-3 bg-singeo rounded-t-2xl"><strong>BEST DEAL</strong></p>
                <a href="{{ $annualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>ANNUAL</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(Prices::$plusSubscriptionAnnualFull > Prices::$plusSubscriptionAnnual)
                                <s class="opacity-60">${{ Prices::$plusSubscriptionAnnualFull }}</s>
                            @endif
                            <strong>${{ Prices::$plusSubscriptionAnnual }}</strong></h1> <p class="inline-block -mr-14">per year</p>
                        <p class="text-singeo text-sm my-4"><em>Save {{ round(100 - (100 * (Prices::$plusSubscriptionAnnual / (Prices::$plusSubscriptionMonthly * 12)))) }}% vs monthly.</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>Recurring annual plan. </strong></p>
                        <p class="mb-1">Full access to Singeo Lessons</p>
                        <p class="mb-1">Full access to Singeo Songs</p>
                        <p class="mb-1">Full access to Singeo Teachers</p>
                        <p>90-day money back guarantee.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

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
