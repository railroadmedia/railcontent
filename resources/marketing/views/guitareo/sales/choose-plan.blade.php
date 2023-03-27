@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Learn to play guitar anytime with real teachers. | Guitareo.com</title>
    <meta property="og:title" content="Guitareo.com: Learn to play guitar anytime with real teachers."/>
    <meta property="og:url" content="https://www.guitareo.com"/>

    <meta name="description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee." />
    <meta property="og:description" content="Play guitar like you've always wanted with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee."/>

        <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-guitareo.jpg"/>

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
    <style>
        .option-buttons.active {
            border-color:#00c9ac!important;
            background-color:#0c4a41 !important;
        }
        .option-buttons.active .radio-check {
            border-color:#00c9ac!important;
            background-color:#00c9ac!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
    </style>
@stop

@section('global-body')
    @include("guitareo.sales.partials._nav", [
            "hideJoin" => true,
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
        ])


    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @if(empty($month))
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitareo-plus-logo-light.svg",
            "logo" => "https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo.png",
            "songs" => "1000",
            "firstPoint" => "Unlimited guitar lessons",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[guitareo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[GUITAREO-7-DAY-TRIAL-ONE-TIME]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[guitareo-base-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "monthlyLink" => "/ecommerce/add-to-cart?products[guitareo-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.plans-different-section', [
            "plusLogo" => "https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitareo-plus-logo.svg",
            "logo" => "https://dmmior4id2ysr.cloudfront.net/logos/guitareo-logo.png",
            "secondPoint" => "Artist courses and exclusive events with special guests.",
            "thirdPoint" => "Go beyond guitar with lessons for singing, piano, and drums.",
            "fifthPoint" => "1000+ songs transcribed w/ playback tools for all instruments.",
        ])
    @else
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://d122ay5chh2hr5.cloudfront.net/sales/2023/guitareo-plus-logo-light.svg",
            "logo" => "https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo.png",
            "songs" => "1000",
            "firstPoint" => "Unlimited guitar lessons",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[guitareo-annual-recurring-30-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[guitareo-monthly-recurring-30-day-trial-membership]=1&redirect=/order&locked=true",
        ])
    @endif

    @include('guitareo._partials.faq')

    @include("guitareo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
