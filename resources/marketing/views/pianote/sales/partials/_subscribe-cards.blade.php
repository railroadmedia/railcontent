@php $annualLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&locked=true&redirect=/order' @endphp
{{--&products[piano-chords-and-scales-guide]=1&products[100-days-of-practice-poster]=1&products[poster-chords]=1&products[poster-scales]=1&products[pianote-practice-planner]=1--}}
<div id="customize-anchor" class="anchor"></div>
<section class="content-section text-center customize relative z-50 overflow-hidden" style="background: linear-gradient(to bottom, #01050f 40%, #02152a);">
    <div class="container mx-auto">
        <img class="h-10 md:h-16 mx-auto" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">

        <h2 class="my-3 md:my-5 leading-normal"><strong>Start learning piano <br>for just <span class="text-pianote">${{ round((Prices::$plusSubscriptionAnnual / 12), 2) }}</span> a month.</strong></h2>



        {{--<h6 class="mt-3 uppercase text-coaches">Pianote Annual Membership</h6>--}}

        {{--<div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-7 mx-auto">--}}
        {{--<div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}
        {{--<a href="{{ url()->route('shopping-cart.add-to-cart', [ 'products' => ['PIANOTE-MEMBERSHIP-1-MONTH' => 1], 'redirect' => '/order', 'locked' => 'true']) }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
        {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
        {{--<h5 class="leading-none mb-3"><strong>MONTHLY</strong></h5>--}}
        {{--<h1 class="inline-block leading-none">--}}
        {{--@if(Prices::$plusSubscriptionMonthlyFull > Prices::$plusSubscriptionMonthly)--}}
        {{--<s class="opacity-60">${{ Prices::$plusSubscriptionMonthlyFull }}</s>--}}
        {{--@endif--}}
        {{--<strong>${{ Prices::$plusSubscriptionMonthly }}</strong></h1> <p class="inline-block -mr-16">per month</p>--}}
        {{--<p class="text-pianote text-sm my-4"><em>Recurring Payment</em></p>--}}
        {{--<div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>--}}
        {{--</div>--}}
        {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
        {{--<p class="mb-1"><strong>Recurring monthly plan.</strong></p>--}}
        {{--<p class="mb-1">Unlimited access to every lesson.</p>--}}
        {{--<p class="mb-1">Easy to use progress-tracking.</p>--}}
        {{--<p class="mb-1">Weekly live Q&A sessions.</p>--}}
        {{--<p>90 day money-back guarantee.</p>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}
        {{--<a href="{{ $annualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
        {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
        {{--<h5 class="leading-none mb-3"><strong>ANNUAL</strong></h5>--}}
        {{--<h1 class="inline-block leading-none">--}}
        {{--@if(Prices::$plusSubscriptionAnnualFull > Prices::$plusSubscriptionAnnual)--}}
        {{--<s class="opacity-60">${{ Prices::$plusSubscriptionAnnualFull }}</s>--}}
        {{--@endif--}}
        {{--<strong>${{ Prices::$plusSubscriptionAnnual }}</strong></h1><p class="inline-block -mr-5">per year</p>--}}
        {{--<p class="text-pianote text-sm my-4"><em>Save {{ round(100 - (100 * (Prices::$plusSubscriptionAnnual / Prices::$plusSubscriptionAnnualFull))) }}%</em></p>--}}
        {{--<div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>--}}
        {{--</div>--}}
        {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
        {{--<p class="mb-1"><strong>Recurring annual plan.</strong></p>--}}
        {{--<p class="mb-1">Unlimited access to every lesson.</p>--}}
        {{--<p class="mb-1">Easy to use progress-tracking.</p>--}}
        {{--<p class="mb-1">Weekly live Q&A sessions.</p>--}}
        {{--<p>90 day money-back guarantee.</p>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}
        {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 --}}{{----}}{{----}}{{----}}{{--bg-guitareo--}}{{----}}{{----}}{{----}}{{-- text-black rounded-t-2xl" style="background: linear-gradient(to bottom, #feab01, #fd7a00);"><strong>ONLY <s class="opacity-60">50</s> {{ $products['PIANOTE-MEMBERSHIP-LIFETIME']->getStockAvailability() }} SPOTS LEFT!</strong></p>--}}
        {{--<a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-LIFETIME]=1&products[piano-chords-and-scales-guide]=1&products[100-days-of-practice-poster]=1&products[poster-chords]=1&products[poster-scales]=1&products[pianote-practice-planner]=1&locked=true&redirect=/order" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
        {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
        {{--<h5 class="leading-none mb-3"><strong>LIFETIME</strong></h5>--}}
        {{--<h1 class="inline-block leading-none">--}}
        {{--@if(Prices::$lifetimeMembership > Prices::$lifetimeMembership)--}}
        {{--<s class="opacity-60">${{ Prices::$lifetimeMembership }}</s>--}}
        {{--@endif--}}
        {{--<strong>${{ Prices::$lifetimeMembership }}</strong></h1>--}}
        {{--<p class="text-coaches text-sm my-4"><em>Or choose a payment plan on checkout.</em></p>--}}
        {{--<div class="join smaller coaches w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>--}}
        {{--</div>--}}
        {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
        {{--<p class="mb-1"><strong>* LIFETIME PIANOTE ACCESS *</strong></p>--}}
        {{--<p class="mb-1">Unlimited access to every lesson.</p>--}}
        {{--<p class="mb-1">Easy to use progress-tracking.</p>--}}
        {{--<p class="mb-1">Weekly live Q&A sessions.</p>--}}
        {{--<p>90 day money-back guarantee.</p>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        <h4 class="leading-tight mt-5 md:mt-7 lg:mt-10"><strong>Billed annually at ${{ Prices::$plusSubscriptionAnnual }} per year.</strong></h4>
        <a class="join bigger" href="{{ $annualLink }}">Get Started &raquo;</a>
        <br><br class="inline-block md:hidden">
        <a class="text-drumeo monthly-alt" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month.</em></u></p></a>
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
