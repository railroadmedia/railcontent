@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Groove Coordination | Drumeo</title>
    <meta property="og:title" content="Groove Coordination | Drumeo">

    <meta name="description" content="Groove Coordination">
    <meta property="og:description" content="Groove Coordination">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/lead-gen/better-doubles/BetterDoubles.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
@stop
<style>

input#sign-up-email {
    border: 1px solid  rgba(0, 0, 0, 0.3);
}
</style>
@section('body-data')
    x-data="{
    trailer: false,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="py-12 sm:py-20 text-white relative overflow-hidden object-cover no-repet object-center" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/products/100-grooves/order-bg.webp')">
        <div class="max-w-6xl relative z-10 mx-auto sm:flex items-center container px-4 text-center sm:text-left">
            <div class="w-full sm:w-1/2 max-w-xl mx-auto sm:max-w-full">
                <div class="px-2 sm:pl-6 sm:pr-4 lg:pr-6 xl:pr-10 text-center lg:text-left">
                    <img
                        class="mb-6 sm:mb-0 h-28 sm:h-20 lg:h-28"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/drumeo/lead-gen/groove-coordination/GrooveCoordination.svg"
                        alt="Groove Coordination Logo"
                        fetchpriority="high"
                    />
                    <div class="max-w-xs px-4 mx-auto sm:hidden mb-5">
                        <img
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/drumeo/lead-gen/groove-coordination/header-1.png"
                            alt="Groove Coordination Teacher"
                            fetchpriority="high"
                        />
                    </div>
                    <p class="mb-4 mt-8"><strong>Enter your email address to enroll in the Challenge!</strong></p>
                </div>
                <div class="lg:pr-6 xl:pr-10">
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - Groove Coordination - Web Form",
                    "formName" => 'Groove Coordination',
                    "buttonText" => "SIGN ME UP",
                    'stacked' => true,
                    "redirectURL" => "/thankyou",
                    "recaptchaKey" => $recaptchaKey,
                    "minimalForm" => true,
                    
                ])
                </div>
            </div>
            <div class="w-full sm:w-1/2 hidden sm:block">
                <img
                    class="transition-opacity opacity-0"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/drumeo/lead-gen/groove-coordination/header-1.png"
                    alt="header hero image"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </header>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/drumeo/form-tracking.js') }}"></script>
@stop
