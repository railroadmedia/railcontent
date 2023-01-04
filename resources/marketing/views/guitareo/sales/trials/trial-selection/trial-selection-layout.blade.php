@extends('guitareo._partials.global-layout')

@section('meta')

    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>

    <meta name="description" content="Say goodbye to “do it yourself” guitar lessons." />
    <meta property="og:description" content="Say goodbye to “do it yourself” guitar lessons."/>

    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/sales/2023/share-image-guitareo.jpg"/>

@stop
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
    <style>
        .text-yellow {
            color: #f6bd03;
        }
    </style>
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
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@endsection

@section('content')
    @include("guitareo.sales.partials._nav", [
        "subscriptionVersion" => true
    ])


    <section class="content-section relative overflow-hidden text-white grey text-center customize trial" style="background-color:#000318;">
        <div class="container mx-auto">
            <img class="logo" style="margin-bottom: 0;" src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">
            <br>
            <h1><strong>Your first
                    @if(!empty($weekly))
                        week
                    @else
                        month
                    @endif
                    <br class="inline sm:hidden"> is free.</strong></h1>
            <h5 class="text-navy mt-2 md:mt-4 mb-10 md:mb-20 leading-normal"><em>
                    You will not be billed until
                    @if(!empty($weekly))
                        {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }}
                    @else
                        {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }}
                    @endif
                    (After your free trial).
                </em></h5>


            <div class="outline-cards flex flex-wrap mx-auto">
                <div class="flex flex-auto px-2 w-full md:w-1/2">
                    <a class="card-wrap"
                            @hasSection('month-url')
                                @yield('month-url')
                            @else
                                href="/ecommerce/add-to-cart?products[guitareo-monthly-recurring-30-day-trial-membership]=1&redirect=/order&locked=true"
                            @endif
                    >
                        <h2><strong>MONTHLY</strong></h2>
                        <h1 class="my-2 md:my-4"><strong>${{ GuitareoPrices::$guitareoMembershipMonthlyFull }}</strong><sub>/month</sub></h1>
                        <p class="text-navy"><em>Pay each month, with no commitment.</em></p>
                        <ul class="fa-ul text-left my-4 md:my-6">
                            <li><i class="fa-li fal fa-check"></i> Unlimited access to every lesson.</li>
                            <li><i class="fa-li fal fa-check"></i> Easy-to-use progress tracking.</li>
                            <li><i class="fa-li fal fa-check"></i> Weekly live Q&A sessions.</li>
                            <li><i class="fa-li fal fa-check"></i> 90-day money-back guarantee.</li>
                        </ul>
                        <div class="join outline white">Start My Free Trial &raquo;</div>
                    </a>
                </div>
                <div class="flex flex-auto px-2 w-full md:w-1/2 relative">
                    <p class="top-badge bg-guitareo text-black absolute left-1/2 inline-block">
                        <strong>
                            @hasSection('badge-text')
                                @yield('badge-text')
                            @else
                                BEST DEAL
                            @endif
                        </strong>
                    </p>
                    <a class="card-wrap text-guitareo"
                            @hasSection('annual-url')
                                @yield('annual-url')
                            @else
                                href="/ecommerce/add-to-cart?products[guitareo-annual-recurring-30-day-trial-membership]=1&redirect=/order&locked=true"
                            @endif
                    >
                        <h2><strong>ANNUAL</strong></h2>
                        @hasSection('extra-savings')
                            <h1 class="my-2 md:my-4"><strong>@yield('extra-savings-divided')</strong><sub>/month</sub></h1>
                            <p class="text-yellow"><em>Billed as @yield('extra-savings') per year. </em></p>
                        @else
                            <h1 class="my-2 md:my-4"><strong>${{ number_format(GuitareoPrices::$guitareoMembershipAnnualFull / 12, 2) }}</strong><sub>/month</sub></h1>
                            <p class="text-yellow">
                                <em>
                                    {{-- Billed as ${{ GuitareoPrices::$guitareoMembershipAnnualFull }} per year.  --}}
                                    Pay annually + save {{ round(100 - (100 * (GuitareoPrices::$guitareoMembershipAnnualFull / (GuitareoPrices::$guitareoMembershipMonthlyFull * 12)))) }}% on your membership
                                </em>
                            </p>
                        @endif
                        <ul class="fa-ul text-left my-4 md:my-6">
                            <li><i class="fa-li fal fa-check"></i> Unlimited access to every lesson.</li>
                            <li><i class="fa-li fal fa-check"></i> Easy-to-use progress tracking.</li>
                            <li><i class="fa-li fal fa-check"></i> Weekly live Q&A sessions.</li>
                            <li><i class="fa-li fal fa-check"></i> 90-day money-back guarantee.</li>
                        </ul>
                        <div class="join blue">Start My Free Trial &raquo;</div>
                        <p class="text-navy" style="margin: 5px auto -26px;">
                            <em>
                                Save
                                @hasSection('extra-savings-amount')
                                    @yield('extra-savings-amount')
                                @else
                                    $53
                                @endif
                                per year vs. monthly.
                            </em>
                        </p>
                    </a>
                </div>
            </div>

            <p class="text-yellow mt-7 sm:mt-10 mb-3 sm:mb-5"><strong>1 trial per person.</strong></p>
            <a class="join smaller" href="/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&redirect=/order">Skip the trial and join now &raquo;</a>
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


    @include("guitareo.sales.partials._footer")

@stop
