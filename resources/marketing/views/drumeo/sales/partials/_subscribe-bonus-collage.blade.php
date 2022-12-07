@php
    $annualLink = '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true';
@endphp

<section class="content-section text-center customize px-4 lg:px-6 relative z-50 overflow-hidden" style="background: linear-gradient(to bottom, #01050f 60%, #02152a);">
    <div class="container mx-auto relative z-50">

            <div class="flex flex-wrap items-center">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5">
                    <img class="h-10 md:h-12 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
                    <h3 class="pt-4 md:pt-5 leading-normal"><strong>Learn the drums faster with the <br class="inline sm:hidden"> best teachers in the world.</strong></h3>
                    <p class="my-3 sm:my-4"><em>Plus get $231 in FREE bonuses.</em></p>
                    <p class="text-left mb-4 sm:mb-5 mx-auto inline-block sm:leading-loose">
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> <span class="text-drumeo">FREE</span> <strong>30-Day Drummer</strong> <em>(LIFETIME ACCESS)</em><br>
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> <span class="text-drumeo">FREE</span> <strong>P4 Practice Pad</strong> <em>(FREE SHIPPING)</em><br>
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> <span class="text-drumeo">FREE</span> <strong>2x 5A Drumsticks</strong> <em>(FREE SHIPPING)</em><br>
                        <i class="text-drumeo fas fa-check sm:mr-2"></i> <span class="text-drumeo">FREE</span> <strong>Best Beginner Drum Book</strong> <em>(FREE SHIPPING)</em>
                    </p>
                    <div class="w-72 lg:w-96 mx-auto sm:mx-0">
                        <h3><strong>Only $20/month</strong></h3>
                        <a class="join blue w-full my-3" href="{{ $annualLink }}">Get Started</a>
                        <p class="text-center text-sm">Billed annually at $240/yr</p>
                    </div>
                </div>
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 lg:pl-10 mt-7 sm:mt-0">
                    <img class="max-w-xl sm:max-w-3xl lg:max-w-5xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/order_collage.png">
                </div>
            </div>
        </div>

        <a class="inline-block text-sm text-light-navy mt-7" href="/laravel/public/shopping-cart/api/query?products[DLM]=1,month,1&locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$drumeoEdgeRegular }}/month. (no bonuses)</em></u></p></a>
</section>

<section class="content-section text-center" style="background: #060c1b;">
    <div class="container mx-auto relative z-50">
        <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;">
            <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <p class="mx-auto mt-2 md:mt-3 text-light-navy">Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
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