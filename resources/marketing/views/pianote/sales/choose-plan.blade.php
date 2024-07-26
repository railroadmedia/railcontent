@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

        <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <style>
        .option-buttons.active {
            border-color:#f61a30!important;
            background-color:#4a0c12 !important;
        }
        .option-buttons.active .radio-check {
            border-color:#f61a30!important;
            background-color:#f61a30!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
    </style>
@stop

@section('global-body')
    @include("pianote.sales.partials._nav", [
            "hideJoin" => true,
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
        ])


    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @if(empty($month))
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-plus-logo-light.svg",
            "logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-white.png",
            "songs" => "500+ popular songs.",
            "firstPoint" => "Unlimited piano lessons.",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, guitar, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[pianote-base-annual-recurring-7-day-trial-membership]=1&promo-code=annual-trial&redirect=/order&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[pianote-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])

        @include('musora.sales.components.plans-different-section', [
            "plusLogo" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-plus-logo.svg",
            "logo" => "https://dmmior4id2ysr.cloudfront.net/logos/pianote-logo.png",
            "secondPoint" => "Artist courses and exclusive events with special guests.",
            "thirdPoint" => "Go beyond piano with lessons for singing, guitar, and drums.",
            "fifthPoint" => "Songs transcribed w/ playback tools for all instruments.",
        ])
    @else
        @include('musora.sales.components.card-selection-section', [
            "plusLogo" => "https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/pianote-plus-logo-light.svg",
            "logo" => "https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-white.png",
            "songs" => "500+ popular songs.",
            "firstPoint" => "Unlimited piano lessons.",
            "thirdPoint" => "Direct access to real teachers.",
            "fifthPoint" => "Lesson access for singing, guitar, and drums.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-30-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true&referralCode=" . $referralCode,
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-30-DAY]=1&redirect=/order&locked=true&referralCode=" . $referralCode,
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'piano',
        ])
    @endif

    @include('pianote._partials.faq')

    @include("pianote.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
