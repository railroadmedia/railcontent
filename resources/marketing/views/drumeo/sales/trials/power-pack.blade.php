@extends('drumeo.sales.subscription')

@section('global-head')
    <title>Drumeo Power Pack</title>
    <meta property="og:title" content="Drumeo Power Pack">
    <meta property="og:url" content="https://www.drumeo.com/power-pack/">
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('promo-banner')
    <div class="text-white px-4 py-8 md:py-16 relative z-10" style="background-color:#000318;">
        <div class="container mx-auto">
            <div class="sm:flex mx-auto items-start text-center" style="max-width: 1050px;">
                <div class="md:text-left px-2 md:pl-7 lg:pl-10">
                    <h2 class="uppercase"><strong><strong>SPECIAL OFFER:</strong> YOUR FIRST<br class="inline sm:hidden"> MONTH IS FREE!</strong></h2>
                    <h6 class="leading-normal my-3 md:my-5">
                        <strong>Power Pack 2020:</strong> You’re eligible for a FREE 30-day membership to Drumeo. Browse
                        around this page for all the details and then claim your gift.
                    </h6>
                    <a href="/choose-your-trial-month/" class="join smaller">START MY FREE TRIAL</a>
                </div>
            </div>
        </div>
    </div>
@endsection
