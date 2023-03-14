@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    <meta property="og:url" content="https://www.singeo.com"/>

    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee." />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee."/>

        <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2023/share-image-singeo.jpg"/>

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/sales-page.css') }}" rel="stylesheet">
    <style>
        .option-buttons.active {
            border-color:#8300E9!important;
            background-color:#2f0c4a !important;
        }
        .option-buttons.active .radio-check {
            border-color:#8300E9!important;
            background-color:#8300E9!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
            "hideJoin" => true,
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
        ])


    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @if(empty($month))
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://d21xeg6s76swyd.cloudfront.net/sales/2023/singeo-plus-logo-light.svg",
            "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/singeo-white.svg",
            "songs" => "1000",
            "firstPoint" => "Unlimited singing lessons",
            "thirdPoint" => "Direct access to vocal coaches.",
            "fifthPoint" => "Lesson access for guitar, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[singeo-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[singeo-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[singeo-base-annual-recurring-7-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "monthlyLink" => "/ecommerce/add-to-cart?products[singeo-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.plans-different-section', [
            "plusLogo" => "https://d21xeg6s76swyd.cloudfront.net/sales/2023/singeo-plus-logo.svg",
            "logo" => "https://dmmior4id2ysr.cloudfront.net/logos/singeo-logo-black.png",
            "secondPoint" => "Artist courses and exclusive events with special guests.",
            "thirdPoint" => "Go beyond singing with lessons for guitar, piano, and drums.",
            "fifthPoint" => "1000+ songs transcribed w/ playback tools for all instruments.",
        ])
    @else
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://d21xeg6s76swyd.cloudfront.net/sales/2023/singeo-plus-logo-light.svg",
            "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/singeo-white.svg",
            "songs" => "1000",
            "firstPoint" => "Unlimited singing lessons",
            "thirdPoint" => "Direct access to vocal coaches.",
            "fifthPoint" => "Lesson access for guitar, piano, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[singeo-annual-recurring-30-day-trial-membership]=1&redirect=/order&locked=true&promo-code=annual-trial",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[singeo-monthly-recurring-30-day-trial-membership]=1&redirect=/order&locked=true",
        ])
    @endif

    @include('singeo._partials.faq')

    @include("singeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
