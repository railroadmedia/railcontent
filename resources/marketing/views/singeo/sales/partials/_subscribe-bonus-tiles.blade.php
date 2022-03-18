@php $annualLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[chords-and-scales-book]=1&products[poster-100-days]=1&products[poster-chords]=1&products[poster-scales]=1&products[pianote-practice-planner]=1&locked=true&redirect=/order' @endphp

<section class="content-section text-center customize relative z-50 overflow-hidden" style="background: #01050f;">
    <div class="container mx-auto relative z-50">
        <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-xl lg:max-w-4xl" style="font-size: 0;">
            <img class="h-10 md:h-16" src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
            <h2 class="my-2 md:my-3 leading-normal"><strong>Find <span class="text-singeo">(And Love)</span> Your True Voice</strong></h2>
            {{--<h4><em>Discover and fall in love with the full potential of your voice.</em></h4>--}}
            <h4 class="text-coaches mb-5 md:mb-7 lg:mb-8" style="line-height: 1.4em;">SAVE {{ round(100 - (100 * (\App\Prices::$singeoMembershipAnnual / \App\Prices::$singeoMembershipAnnualFull))) }}%  + GET A <br class="inline md:hidden">FREE VOWEL POSTER</h4>

            {{--@php--}}
                {{--$bonuses = [--}}
                    {{--[--}}
                    {{--'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/singing-starter-kit.jpg',--}}
                    {{--'title' => 'Singing<br> Starter Kit',--}}
                    {{--'description' => 'The “must-know” singing basics that every singer needs to keep their voice strong and healthy.',--}}
                    {{--'price' => \App\Prices::$singingStarterKitFull,--}}
                    {{--'online-ship' => "Lifetime Access"--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/tumbler2.png',--}}
                    {{--'title' => 'Do-Re-Mi<br> Tumbler',--}}
                    {{--'badge' => 'Do-Re-Mi Tumbler',--}}
                    {{--'description' => 'Stay hydrated while practicing your scales both at home or on the go with the Singeo insulated tumbler.',--}}
                    {{--'price' => \App\Prices::$tumblerFull,--}}
                    {{--'online-ship' => "Free Shipping",--}}
                    {{--],--}}
                    {{--[--}}
                    {{--'image' => 'https://singeo.s3.amazonaws.com/sales/promos/november/poster2.png',--}}
                    {{--'title' => 'Vowel Practice<br> Poster',--}}
                    {{--'badge' => 'Vowel Practice Poster',--}}
                    {{--'description' => 'Your new favorite practice tool - and your ticket hitting higher notes with ease and confidence.',--}}
                    {{--'price' => \App\Prices::$posterFull,--}}
                    {{--'online-ship' => "Free Shipping",--}}
                    {{--],--}}
                {{--]--}}
            {{--@endphp--}}
            {{--@foreach($bonuses as $bonus)--}}
                {{--<div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3 lg:w-1/5">--}}
                    {{--<div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif">--}}
                        {{--<div class="flip-inner">--}}
                            {{--<div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">--}}
                                {{--<div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>--}}
                                {{--<div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>--}}
                            {{--</div>--}}
                            {{--<div class="back">--}}
                                {{--<div class="text-wrap">--}}
                                    {{--<p class="text-xs">{!!  $bonus['description']  !!}</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<p class="uppercase">--}}
                        {{--<strong class="font-black leading-tight inline-block mt-2 mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                        {{--<span class="text-promo" style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong>FREE</strong></span><br>--}}
                        {{--{{ $bonus['online-ship'] }}--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        </div>

        <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl {{--mt-8 mb-3 md:my-10 lg:my-12 px-3 md:px-0 mt-4 md:mb-10--}} mx-auto">
            <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 bg-singeo rounded-t-2xl">MOST POPULAR</p>--}}
                <a href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>MONTHLY</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(App\Prices::$singeoMembershipMonthlyFull > App\Prices::$singeoMembershipMonthly)
                                <s class="opacity-60">${{ App\Prices::$singeoMembershipMonthlyFull }}</s>
                            @endif
                            <strong>${{ App\Prices::$singeoMembershipMonthly }}</strong></h1> <p class="inline-block {{---mr-16--}}">per month</p>
                        <p class="text-singeo text-sm my-4"><em>Recurring Payment</em></p>
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
                <a href="{{ App\Prices::$singeoMembershipAnnualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                    <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                        <h5 class="leading-none mb-3"><strong>ANNUAL</strong></h5>
                        <h1 class="inline-block leading-none">
                            @if(App\Prices::$singeoMembershipAnnualFull > App\Prices::$singeoMembershipAnnual)
                                <s class="opacity-60">${{ App\Prices::$singeoMembershipAnnualFull }}</s>
                            @endif
                                <strong>${{ App\Prices::$singeoMembershipAnnual }}</strong></h1> <p class="inline-block -mr-14">per year</p>
                        <p class="text-singeo text-sm my-4"><em>Or choose a payment plan on checkout.</em></p>
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
            {{--<div class="w-full md:w-1/2 px-2 md:px-3 relative">--}}
                {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 bg-singeo rounded-t-2xl">ONLY <s>100</s> @if(!empty($products['singeo-lifetime-membership-access']->getStock())) {{ $products['singeo-lifetime-membership-access']->getStock() }} @else LIMITED @endif SPOTS LEFT</p>--}}
                {{--<a href="/ecommerce/add-to-cart?products[singeo-lifetime-membership-access]=1&products[singing-starter-kit]=1&products[wallflower-tumbler]=1&products[vowel-sounds-poster]=1&redirect=/order&locked=true" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">--}}
                    {{--<div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">--}}
                        {{--<h5 class="leading-none mb-3"><strong>LIFETIME</strong></h5>--}}
                        {{--<h1 class="leading-none inline-block"><strong>${{ App\Prices::$singeoMembershipLifetime }}</strong></h1> <p class="inline-block">one-time</p>--}}
                        {{--<p class="text-singeo text-sm my-4"><em>Or choose a payment plan on checkout.</em></p>--}}
                        {{--<div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Get Started</div>--}}
                    {{--</div>--}}
                    {{--<div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">--}}
                        {{--<p class="leading-tight mb-3"><strong class="font-black">Full access to Singeo<br> Method, Songs, & Coaches.</strong></p>--}}
                        {{--<p class="mb-1">1-pay, 2-pay, or 5-pay options. </p>--}}
                        {{--<p class="mb-1">Gain access forever. </p>--}}
                        {{--<p>90 day guarantee. </p>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
        {{--<br>--}}
        {{--<a class="text-drumeo monthly-alt" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ \App\Prices::$singeoMembershipMonthly }}/month. (no bonuses)</em></u></p></a>--}}
    </div>
</section>

<section class="content-section text-center" style="background: #0c1429;">
    <div class="container mx-auto relative z-50">
        <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
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