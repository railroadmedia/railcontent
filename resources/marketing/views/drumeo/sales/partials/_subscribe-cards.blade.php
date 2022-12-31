@php
    $annualLink = '/ecommerce/add-to-cart?products[DLM]=1,year,1&locked=true';
    $lifetimeLink = '/ecommerce/add-to-cart?products[DLM-Lifetime]=1&products[practicepad]=1&products[quietpad]=1&products[Drumeo-VaterSticks]=6&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[drum-technique-made-easy-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[four-weeks-to-better-drum-fills]=1&products[learn-songs-faster-pack]=1&products[TLOD-DIGI]=1&products[MAM-DIGI]=1&products[GHFAL-DIGI]=1&products[HGAF-DIGI]=1&products[AOADS-DIGI]=1&products[ICM-DIGI]=1&products[BTC-DIGI]=1&products[CC-DIGI]=1&products[TG-DIGI]=1&locked=true&redirect=/order';
@endphp
<section class="content-section text-center customize px-4 lg:px-6" style="background:#000;">
    <div class="container mx-auto">
        <img class="h-10 md:h-12 lg:h-16 mb-3" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
        <h2 class="mt-3 mb-10"><strong>Choose the plan <br class="inline md:hidden">that's right for you.</strong></h2>
        <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-7 mx-auto">
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <a href="/ecommerce/add-to-cart?products[DLM]=1,month,1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>Monthly</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(Prices::$drumeoEdgeFull > Prices::$drumeoEdgeRegular)
                                <s class="opacity-60">${{ Prices::$drumeoEdgeFull }}</s>
                            @endif
                            <strong>${{ Prices::$drumeoEdgeRegular }}</strong></h1><p class="inline-block -mr-5">per month</p>
                        <p class="text-drumeo text-sm my-4"><em>Only ${{ number_format((Prices::$drumeoEdgeRegular * 12) / 52, 2) }} per week.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>Recurring monthly plan.</strong></p>
                        <p class="mb-1">Unlimited access to every lesson.</p>
                        <p class="mb-1">Easy to use progress-tracking.</p>
                        <p class="mb-1">Weekly live Q&A sessions.</p>
                        <p>90 day money-back guarantee.</p>
                    </div>
                </a>
            </div>
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                <p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl bg-drumeo"><strong>BEST DEAL</strong></p>
                <a href="{{ $annualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>ANNUAL</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(Prices::$drumeoEdgeAnnualFull > Prices::$drumeoEdgeAnnual)
                                <s class="opacity-60">${{ Prices::$drumeoEdgeAnnualFull }}</s>
                            @endif
                            <strong>${{ Prices::$drumeoEdgeAnnual }}</strong></h1><p class="inline-block -mr-5">per year</p>
                        <p class="text-drumeo text-sm my-4"><em>Save {{ round(100 - (100 * (Prices::$drumeoEdgeAnnual / (Prices::$drumeoEdgeRegular * 12)))) }}% vs monthly.</em></p>
                        <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>
                    </div>
                    <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                        <p class="mb-1"><strong>Recurring annual plan.</strong></p>
                        <p class="mb-1">Unlimited access to every lesson.</p>
                        <p class="mb-1">Easy to use progress-tracking.</p>
                        <p class="mb-1">Weekly live Q&A sessions.</p>
                        <p>90 day money-back guarantee.</p>
                    </div>
                </a>
            </div>
            {{--<div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}
                {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 --}}{{----}}{{--bg-guitareo--}}{{----}}{{-- text-black rounded-t-2xl" style="background: linear-gradient(to bottom, #feab01, #fd7a00);"><strong>ONLY <s class="opacity-60">100</s> {{ $products['DLM-Lifetime']->getStockAvailability() }} SPOTS LEFT!</strong></p>--}}
                {{--<a href="{{ $lifetimeLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
                    {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
                        {{--<h5 class="leading-none mb-3"><strong>LIFETIME</strong></h5>--}}
                        {{--<h1 class="inline-block leading-none">--}}
                            {{--<strong>${{ Prices::$drumeoEdgeLifetime }}</strong></h1>--}}
                        {{--<p class="text-coaches text-sm my-4"><em>Or choose a payment plan on checkout.</em></p>--}}
                        {{--<div class="join smaller coaches w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>--}}
                    {{--</div>--}}
                    {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
                        {{--<p class="mb-1"><strong>* LIFETIME DRUMEO ACCESS *</strong></p>--}}
                        {{--<p class="mb-1">Unlimited access to every lesson.</p>--}}
                        {{--<p class="mb-1">Easy to use progress-tracking.</p>--}}
                        {{--<p class="mb-1">Weekly live Q&A sessions.</p>--}}
                        {{--<p>90 day money-back guarantee.</p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
    </div>
</section>

<section class="content-section text-center" style="background: #0c1429;">
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
