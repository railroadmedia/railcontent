@extends('singeo._partials.global-layout')

@section('global-head')

    <title>Your start-to-finish guide to confident singing | Singeo.com</title>
    <meta property="og:title" content="Singeo.com: Your start-to-finish guide to confident singing"/>
    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. " />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. "/>
    <meta property="og:url" content="https://www.singeo.com/trial"/>
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2022/og-image.jpg"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/sales-page.css') }}" rel="stylesheet">
    <style>
        .text-yellow {
            color: #f6bd03;
        }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "joinVersion" => true
    ])

    <style>
        .content-section.customize .logo {
            max-width: 140px;
        }
        @media (min-width: 40em) {
            .content-section.customize .logo {
                max-width: 200px;
            }
        }
    </style>

    <section class="content-section relative overflow-hidden text-white grey text-center customize trial" style="background-color:#000318;">
        <div class="container mx-auto">
            <img class="logo" style="margin-bottom: 0;" src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png">
            <br>
            <h1><strong>Your first
                    @if(!empty($weekly))
                        week
                    @else
                        month
                    @endif
                    <br class="inline sm:hidden"> is free.</strong></h1>
            <h5 class="text-navy mt-2 md:mt-4 mb-10 md:mb-20 leading-normal"><em>Choose the plan that will continue on <br class="inline lg:hidden">
                    @if(!empty($weekly))
                        {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }}
                    @else
                        {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }}
                    @endif

                    (after your free trial). Cancel anytime.</em></h5>


            <div class="outline-cards">
                <div class="float-left px-2 w-full md:w-1/2">
                    <a class="card-wrap"
                            @hasSection('month-url')
                                @yield('month-url')
                            @else
                                href="/ecommerce/add-to-cart?products[singeo-monthly-recurring-30-day-trial-membership]=1&redirect=/order&locked=true"
                            @endif
                    >
                        <h2><strong>MONTHLY</strong></h2>
                        <h1 class="my-2 md:my-4"><strong>${{ Prices::$plusSubscriptionMonthlyFull }}</strong><sub>/month</sub></h1>
                        <p class="text-navy"><em>If you're just giving it a test-drive.</em></p>
                        <ul class="fa-ul text-left my-4 md:my-6">
                            <li><i class="fa-li fal fa-check"></i> Unlimited access to every lesson.</li>
                            <li><i class="fa-li fal fa-check"></i> Easy-to-use progress tracking.</li>
                            <li><i class="fa-li fal fa-check"></i> Weekly live Q&A sessions.</li>
                            <li><i class="fa-li fal fa-check"></i> 90-day money-back guarantee.</li>
                        </ul>
                        <div class="join outline white">Start My Free Trial &raquo;</div>
                    </a>
                </div>
                <div class="float-left px-2 w-full md:w-1/2 relative">
                    <p class="top-badge bg-singeo absolute left-1/2 inline-block">
                        <strong>
                            @hasSection('badge-text')
                                @yield('badge-text')
                            @else
                                Most Popular
                            @endif
                        </strong>
                    </p>
                    <a class="card-wrap text-singeo"
                            @hasSection('annual-url')
                                @yield('annual-url')
                            @else
                                href="/ecommerce/add-to-cart?products[singeo-annual-recurring-30-day-trial-membership]=1&redirect=/order&locked=true"
                            @endif
                    >
                        <h2><strong>ANNUAL</strong></h2>
                        @hasSection('extra-savings')
                            <h1 class="my-2 md:my-4"><strong>@yield('extra-savings-divided')</strong><sub>/month</sub></h1>
                            <p class="text-yellow"><em>Billed as @yield('extra-savings') per year. </em></p>
                        @else
                            <h1 class="my-2 md:my-4"><strong>${{ number_format(Prices::$plusSubscriptionAnnualFull / 12, 2) }}</strong><sub>/month</sub></h1>
                            <p class="text-yellow"><em>Billed as ${{ Prices::$plusSubscriptionAnnualFull }} per year. </em></p>
                        @endif
                        <ul class="fa-ul text-left my-4 md:my-6">
                            <li><i class="fa-li fal fa-check"></i> Unlimited access to every lesson.</li>
                            <li><i class="fa-li fal fa-check"></i> Easy-to-use progress tracking.</li>
                            <li><i class="fa-li fal fa-check"></i> Weekly live Q&A sessions.</li>
                            <li><i class="fa-li fal fa-check"></i> 90-day money-back guarantee.</li>
                        </ul>
                        <div class="join blue">Start My Free Trial &raquo;</div>
                        <p class="text-navy" style="margin: 5px auto -26px;"><em>Save
                                @hasSection('extra-savings-amount')
                                    @yield('extra-savings-amount')
                                @else
                                    $53
                                @endif
                                per year vs. monthly.</em></p>
                    </a>
                </div>
            </div>

            <p class="text-yellow md:mt-5 mb-2 uppercase"><strong>You will not be billed until <br class="inline md:hidden">
                    @if(!empty($weekly))
                        {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }}
                    @else
                        {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }}
                    @endif
                    (After your free trial.)</strong></p>


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


    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
