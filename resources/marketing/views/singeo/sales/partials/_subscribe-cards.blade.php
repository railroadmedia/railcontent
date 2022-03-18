<section class="content-section relative overflow-hidden text-white grey text-center customize lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/background-order.jpg">
        <div class="container mx-auto">
            <img class="h-9 md:h-12 lg:h-14 lazyload" data-src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
            <h2 class="leading-tight mt-2 mb-3 md:mb-5 px-3"><strong>Online singing lessons with real teachers<br class="hidden md:inline">
                    to support you every step of the way.</strong></h2>
            <p class="text-navy"><em>(Cancel anytime, 90-Day Money Back Guarantee)</em></p>

            <div class="cards flex flex-wrap items-start justify-center mt-8 mb-3 md:my-10 lg:my-12 px-3 md:px-0 mx-auto">
                <div class="w-full md:w-1/2 px-2 md:px-3 md:mt-10 relative">
                    <a class="card-wrap" href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-membership]=1&redirect=/order&locked=true">
                        <div class="bg-white">
                            <h4><strong>MONTHLY</strong></h4>
                            <h1 class="leading-none my-2">
                                @if(App\Prices::$singeoMembershipMonthlyFull > App\Prices::$singeoMembershipMonthly)
                                    <s class="opacity-60">${{ App\Prices::$singeoMembershipMonthlyFull }}</s>
                                @endif
                                <strong>${{ App\Prices::$singeoMembershipMonthly }}</strong> <sub>per month</sub></h1>
                            <div class="join">Click Here &raquo;</div>
                            {{--<p><em>&nbsp;--}}
                                    {{--Only ${{ number_format((App\Prices::$singeoMembershipMonthly * 12) / 52, 2) }} per week.--}}
                                {{--</em></p>--}}
                        </div>
                        <div class="bg-blue">
                            <p><strong>Recurring monthly plan. </strong></p>
                            <p>Full access to Singeo Lessons</p>
                            <p>Full access to Singeo Songs</p>
                            <p>Full access to Singeo Teachers</p>
                            <p>90-day money back guarantee.</p>
                        </div>
                    </a>
                </div>
                <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                    <h6 class="w-full px-4 pt-3 pb-5 -mb-3" style="border-radius:15px 15px 0 0;background: linear-gradient(to bottom, #602877, #e97677)"><strong>BEST DEAL</strong></h6>
                    <a href="{{ App\Prices::$singeoMembershipAnnualLink }}" class="card-wrap">
                        <div class="bg-white">
                            <h4 class="leading-none"><strong>ANNUAL</strong></h4>
                            <h1 class="leading-none my-2">{{--<s class="opacity-60">${{ App\Prices::$singeoMembershipAnnualFull }}</s>--}} <strong>${{ App\Prices::$singeoMembershipAnnual }}</strong><sub>per year</sub></h1>
                            <div class="join transition-opacity duration-300">Get Started &raquo;</div>
                            {{--<p><em>Only ${{ number_format(App\Prices::$singeoMembershipAnnual / 12, 2) }}/month!</em></p>--}}
                        </div>
                        <div class="bg-blue">
                            <p><strong>Recurring annual plan. </strong></p>
                            <p>Full access to Singeo Lessons</p>
                            <p>Full access to Singeo Songs</p>
                            <p>Full access to Singeo Teachers</p>
                            <p>90-day money back guarantee.</p>
                        </div>
                    </a>
                </div>
                {{--<div class="float-left px-2 w-full md:w-1/2 relative">--}}
                    {{--<a href="/ecommerce/add-to-cart?products[singeo-lifetime-membership-access]=1&redirect=/order&locked=true" class="card-wrap">--}}
                        {{--<div class="bg-white">--}}
                            {{--<h1><img src="https://cdn.musora.com/image/fetch/w_400,q_60,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/august/lifetime-access.png"></h1>--}}
                            {{--<h2><strong>${{ App\Prices::$singeoMembershipLifetime }}</strong><sub>for life</sub></h2>--}}
                            {{--<div class="join transition-opacity duration-300">Lessons For Life &raquo;</div>--}}
                            {{--<p><em>This will be the lowest price ever offered<br>--}}
                                    {{--for lifetime memberships!</em></p>--}}
                        {{--</div>--}}
                        {{--<div class="bg-blue">--}}
                            {{--<p><strong>* LIFETIME SINGEO ACCESS *</strong></p>--}}
                            {{--<p>Full access to Singeo Lessons</p>--}}
                            {{--<p>Full access to Singeo Songs</p>--}}
                            {{--<p>Full access to Singeo Teachers</p>--}}
                            {{--<p>90-day money back guarantee.</p>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}
            </div>
            {{--<br><br>--}}
            {{--<a class="join methodcta" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM]=1,year,1&products[Drumeo-Sticks]=1&locked=true">Click Here To Get Started &raquo;</a><br>--}}
            {{--<a class="methodcta monthly-alt" href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[DLM]=1,month,1"><p><u><em>Or click here to start a monthly membership for <br class="inline md:hidden">${{ Prices::$drumeoEdgeRegular }}/month.</em></u></p></a>--}}
{{--<p class="mb-4 md:mb-7"><span class="uppercase text-promo">ONLY <span class="inline md:hidden tzcd-small">A LIMITED TIME</span> <span class="hidden md:inline tzcd-full">A LIMITED TIME</span> LEFT!</span></p>--}}
            <div class="inline-block w-full px-3 md:px-4 credit-cards text-navy">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="inline-block w-full px-3 md:px-4 questions text-navy">
                <p class="leading-tight"><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
</section>
