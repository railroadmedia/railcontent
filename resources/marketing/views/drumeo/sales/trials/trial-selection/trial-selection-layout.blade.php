@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo Trial</title>
    <meta property="og:title" content="Drumeo Trial">
    <meta property="og:url" content="https://www.drumeo.com/trial/">
    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee. ">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:description" content="Reach your drumming goals with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    @if(empty($weekly))
        <meta name="robots" content="noindex">
    @endif

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true
        ])

    <style>
        .content-section.customize .logo {
            max-width: 200px;
        }
        @media (min-width: 40em) {
            .content-section.customize .logo {
                max-width: 240px;
            }
        }
    </style>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    <section class="content-section grey text-center customize trial" style="background-color:#000318;">
        <div class="container mx-auto">
            <img class="h-7 md:h-9 lg:h-14 mb-4" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
            <br>
            <h1><strong>Your first
                    @if(!empty($weekly))
                        week
                    @else
                        month
                    @endif
                    <br class="inline sm:hidden"> is free.</strong></h1>
            <h5 class="text-light-navy mt-2 md:mt-4 mb-10 md:mb-20"><em>Choose the plan that will continue on <br class="inline lg:hidden">
                    @if(!empty($weekly))
                        {{ Carbon\Carbon::now()->addDays(7)->format('F jS') }}
                    @else
                        {{ Carbon\Carbon::now()->addDays(30)->format('F jS') }}
                    @endif

                    (after your free trial). Cancel anytime.</em></h5>


            <div class="inline-block w-full px-2 md:px-0 max-w-xs md:max-w-3xl">
                <div class="float-left px-2 w-full md:w-1/2">
                    <a class="border-2 overflow-hidden rounded-2xl block mx-auto mb-10 md:mb-0 px-4 md:px-6 py-7 md:py-10"
                            @hasSection('month-url')
                                @yield('month-url')
                            @else
                                href="/ecommerce/add-to-cart?products[DLM-Trial-30-Day]=1&promo-code=melodics-special-offer&locked=true"
                            @endif
                    >
                        <h2><strong>MONTHLY</strong></h2>
                        <h1 class="my-2 md:my-4"><strong>$30</strong><sub class="bottom-0 text-xs -mr-10" st>/month</sub></h1>
                        <p class="mb-3 text-light-navy"><em>If you're just giving it a test-drive.</em></p>
                        <ul class="fa-ul text-left my-4 md:my-6">
                            <li><i class="fa-li fal fa-check"></i> DrumeoMETHOD</li>
                            <li><i class="fa-li fal fa-check"></i> DrumeoSONGS</li>
                            <li><i class="fa-li fal fa-check"></i> DrumeoCOACHES</li>
                            <li><i class="fa-li fal fa-check"></i> 90-day money back guarantee.</li>
                            <li><i class="fa-li fal fa-check"></i> Unlimited personal support.</li>
                            <li><i class="fa-li fal fa-check"></i> Billed Monthly</li>
                        </ul>
                        <div class="join smaller outline white">Start My Free Trial &raquo;</div>
                    </a>
                </div>
                <div class="float-left px-2 w-full md:w-1/2 relative">
                    <p class="bg-drumeo rounded-t-2xl absolute left-1/2 inline-block w-4/5 transform -translate-x-1/2" style="top: -23px;">
                        @hasSection('badge-text')
                            @yield('badge-text')
                        @else
                            Most Popular
                        @endif
                    </p>
                    <a class="border-2 overflow-hidden rounded-2xl block mx-auto mb-10 md:mb-0 px-4 md:px-6 py-7 md:py-10 border-drumeo text-drumeo"
                            @hasSection('annual-url')
                                @yield('annual-url')
                            @else
                                href="/ecommerce/add-to-cart?products[DLM-Trial-Annual-30-Day]=1&locked=true"
                            @endif
                    >
                        <h2><strong>ANNUAL</strong></h2>
                        @hasSection('extra-savings')
                            <h1 class="my-2 md:my-4"><strong>@yield('extra-savings-divided')</strong><sub class="bottom-0 text-xs -mr-10" st>/month</sub></h1>
                            <p class="mb-3 text-coaches"><em>Billed as @yield('extra-savings') per year. </em></p>
                        @else
                            <h1 class="my-2 md:my-4"><strong>$20</strong><sub class="bottom-0 text-xs -mr-10" st>/month</sub></h1>
                            <p class="mb-3 text-coaches"><em>Billed as $240 per year. </em></p>
                        @endif
                        <ul class="fa-ul text-left my-4 md:my-6">
                            <li><i class="fa-li fal fa-check"></i> DrumeoMETHOD</li>
                            <li><i class="fa-li fal fa-check"></i> DrumeoSONGS</li>
                            <li><i class="fa-li fal fa-check"></i> DrumeoCOACHES</li>
                            <li><i class="fa-li fal fa-check"></i> 90-day money back guarantee.</li>
                            <li><i class="fa-li fal fa-check"></i> Unlimited personal support.</li>
                            <li><i class="fa-li fal fa-check"></i> Billed Annually</li>
                        </ul>
                        <div class="join smaller blue">Start My Free Trial &raquo;</div>
                        <p class="text-light-navy mt-1 -mb-7"><em>Save
                                @hasSection('extra-savings-amount')
                                    @yield('extra-savings-amount')
                                @else
                                    $108
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


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
