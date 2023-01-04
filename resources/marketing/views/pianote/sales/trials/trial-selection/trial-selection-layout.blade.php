@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Pianote Trial</title>
    <meta property="og:title" content="Pianote Trial">
    <meta property="og:url" content="https://www.pianote.com/trial/">
    <meta name="description" content="Perfectly structured step by step lessons, with teachers that are fun to watch, and unlimited support - 100% guaranteed. Learn piano online the easy way.">
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">
    <meta property="og:description" content="Perfectly Structured Lessons, Insanely Engaging Teachers, and Unlimited Support - 100% Guaranteed.">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
@stop

@section('global-body')
    @include('pianote._partials._nav')

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

    <section class="content-section grey text-center customize trial" style="background-color:#000318;">
        <div class="row">
            <img class="logo" style="margin-bottom: 0;" src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
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
                                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['PIANOTE-MEMBERSHIP-TRIAL-30-DAY' => 1 ], 'redirect' => '/order', 'locked' => 'true']) }}"
                            @endif
                    >
                        <h2><strong>MONTHLY</strong></h2>
                        <h1 class="my-2 md:my-4"><strong>${{ Prices::$pianoteMembershipMonthlyFull }}</strong><sub>/month</sub></h1>
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
                    <p class="top-badge bg-drumeo absolute left-1/2 inline-block">
                        @hasSection('badge-text')
                            @yield('badge-text')
                        @else
                            Most Popular
                        @endif
                    </p>
                    <a class="card-wrap text-pred"
                            @hasSection('annual-url')
                                @yield('annual-url')
                            @else
                                href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['PIANOTE-MEMBERSHIP-TRIAL-30-DAY-ANNUAL' => 1 ], 'promo-code' => 'annual-trial', 'redirect' => '/order', 'locked' => 'true']) }}"
                            @endif
                    >
                        <h2><strong>ANNUAL</strong></h2>
                        @hasSection('extra-savings')
                            <h1 class="my-2 md:my-4"><strong>@yield('extra-savings-divided')</strong><sub>/month</sub></h1>
                            <p class="text-yellow"><em>Billed as @yield('extra-savings') per year. </em></p>
                        @else
                            <h1 class="my-2 md:my-4"><strong>${{ number_format(Prices::$pianoteMembershipAnnualFull / 12, 2) }}</strong><sub>/month</sub></h1>
                            <p class="text-yellow"><em>Billed as ${{ Prices::$pianoteMembershipAnnualFull }} per year. </em></p>
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
                                    $151
                                @endif
                                per year vs. monthly.</em></p>
                    </a>
                </div>
            </div>

            <p class="text-coaches md:mt-5 mb-2 uppercase"><strong>You will not be billed until <br class="inline md:hidden">
                    @if(!empty($weekly))
                        {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }}
                    @else
                        {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }}
                    @endif
                    (After your free trial.)</strong></p>


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


    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{--    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/nav-footer.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/nav-footer.js') }}"></script>
@stop
