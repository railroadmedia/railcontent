@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Giveaway | Drumeo</title>
    <meta property="og:title" content="Giveaway | Drumeo">

    <meta name="description" content="Enter your email for your chance to win!">
    <meta property="og:description" content="Enter your email for your chance to win!">

    <meta property="og:url" content="https://www.drumeo.com/giveaway/">
     <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">

@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="text-center text-white py-32 sm:py-64 px-4 sm:px-6" style="background:linear-gradient(to bottom, #000 50%, #06488F);">
        <div class="container mx-auto max-w-lg">
            <img class="inline-block h-16 sm:h-20" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png">
{{--            <h1 class="sm:tracking-widest -mt-4 sm:-mt-8 lg:-mt-12">The Drumeo Awards LIVE Show</h1>--}}
            <h6 class="leading-normal my-3 sm:my-5 lg:my-8">
                Enter your email for your chance to win a prize.</h6>
            @include("drumeo.lead-gen.partials.sign-up-form", [
                "recaptchaKey" => $recaptchaKey,
                "formName" => 'Drumeo Giveaway',
                "formId" => "Drumeo - Engagement - Trigger - Drumeo Giveaway - Web Form",
                "buttonText" => "Enter",
                "stacked" => true
            ])
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
@stop
