@php $annualLink = '/ecommerce/add-to-cart?products[singeo-annual-recurring-membership]=1&locked=true&redirect=/order' @endphp

<section class="content-section text-center customize relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #01050f, #0c1429);">
    <div class="container mx-auto relative z-50 max-w-5xl">
        <div class="flex flex-wrap items-center">
            <div class="text-center sm:text-left w-full sm:w-7/12 lg:w-6/12 sm:pl-5">
                <img class="h-14 md:h-24 lg:h-32 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/september/order_sticky_logo.png">
                <h2 class="leading-tight mt-2 md:mt-3"><strong>Get a full year of singing <br class="inline sm:hidden">lessons for just <s>${{ Prices::$plusSubscriptionAnnualFull }}</s> <span class="text-singeo">${{ Prices::$plusSubscriptionAnnual }}</span>.</strong></h2>
                <p class="leading-tight mx-auto inline-block my-4 md:my-5 uppercase text-coaches"><strong>THE BACK-TO-SCHOOL DISCOUNT<br class="inline sm:hidden"> ENDS SEPTEMBER 30.</strong></p>
                <p>Save $30. Billed annually, cancel anytime.</p>
                <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                    <a class="join w-full mt-3 sm:mt-5" href="{{ $annualLink }}">Get Started</a>
                </div>
            </div>
            <div class="flex w-full justify-center sm:justify-start sm:w-5/12 lg:w-6/12 sm:order-1 sm:pl-5 lg:pl-10 mt-7 sm:mt-0">
                <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/july/footer_collage.png">
            </div>
        </div>
        <a class="inline-block text-light-navy mt-2" href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>

<section class="content-section text-center" style="background: #020814;">
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
