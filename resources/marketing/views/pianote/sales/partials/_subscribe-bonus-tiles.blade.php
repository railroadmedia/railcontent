@php $annualLink = '/ecommerce/add-to-cart?products%5BPIANOTE-MEMBERSHIP-1-YEAR%5D=1&products%5Bthe-power-of-chords%5D=1&products%5B500-songs-in-5-days%5D=1&products%5Bpiano-chords-and-scales-guide%5D=1&redirect=%2Forder&locked=true' @endphp


<section class="content-section px-3 sm:px-0 text-center customize relative z-50 overflow-hidden" style="background: linear-gradient(to bottom, #01050f 40%, #021022);">
    <div class="container max-w-6xl mx-auto relative z-50">
        <div class="flex flex-wrap items-center">
            <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5">
                <img class="h-14 md:h-16 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
                <h4 class="leading-tight mt-2 md:mt-3"><strong>Start playing beautiful music <br> for just <span class="text-pianote">${{ round((Prices::$pianoteMembershipAnnualRegular / 12), 2) }}</span> a month.</strong></h4>
                <p class="leading-tight mx-auto inline-block my-4 md:my-5"><em>Billed at ${{ Prices::$pianoteMembershipAnnualRegular }} per year.</em></p>
                <div class="w-full mx-auto sm:mx-0">
                    <p class="text-sm leading-relaxed">Get a full annual Pianote membership PLUS:<br>
                        <i class="fas fa-check text-pianote"></i> <span class="text-pianote">*NEW*</span> <strong>The Power Of Chords Course</strong> <em>(LIFETIME ACCESS)</em><br>
                        <i class="fas fa-check text-pianote"></i> <strong>Pianote Chords & Scales Book</strong> <em>(FREE SHIPPING)</em><br>
                        <i class="fas fa-check text-pianote"></i> <strong>500 Songs in 5 Days</strong> <em>(LIFETIME ACCESS)</em></p>
                    <a class="join w-full my-3 sm:my-5" style="background:#F61A30;" href="{{ $annualLink }}">Get Started</a>
                    <p class="text-center text-sm text-gray-300">
                        <em><a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder">Or start a monthly membership <br class="inline sm:hidden"> for ${{ Prices::$pianoteMembershipMonthlyRegular }}/month.</a></em>
                    </p>
                </div>
            </div>
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0">
                <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/august/order_collage.png">
            </div>
        </div>
    </div>
</section>

<section class="content-section text-center" style="background: #0c1429;">
    <div class="container mx-auto relative z-50">
        <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Pianote+Membership/79348450" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Pianote+Membership/79348450', 'newwindow', 'width=750, height=550'); return false;">
            <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <p class="mx-auto mt-2 md:mt-3 text-light-navy">Pianote is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
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
