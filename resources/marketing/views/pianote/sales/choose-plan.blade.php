@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Learn the piano anytime with real teachers. | Pianote</title>
    <meta property="og:title" content="Pianote - Learn the piano anytime with real teachers.">
    <meta property="og:url" content="https://www.pianote.com/">

    <meta name="description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the piano anytime with step-by-step video lessons, world-class teachers, and unlimited personal support. 90-Day Guarantee.">

        <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">

    @include('pianote._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/sales.css') }}">
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
    @include("pianote._partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
        ])


    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://pianote.s3.amazonaws.com/sales/2023/pianote-plus-logo-light.svg",
        "logo" => "https://pianote.s3.amazonaws.com/logo/pianote-logo-white.png",
        "instrument" => "piano",
        "songs" => "1000",
        "firstPoint" => "Unlimited piano lessons",
        "thirdPoint" => "Direct access to real teachers.",
        "fifthPoint" => "Lesson access for singing, guitar, and drums.",
        "plusAnnualLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&promo-code=annual-trial&redirect=/order&locked=true",
        "plusMonthlyLink" => "/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL]=1&redirect=/order&locked=true",
        "annualLink" => "/ecommerce/add-to-cart?products[pianote-base-annual-recurring-7-day-trial-membership]=1&promo-code=annual-trial&redirect=/order&locked=true",
        "monthlyLink" => "/ecommerce/add-to-cart?products[pianote-base-monthly-recurring-7-day-trial-membership]=1&redirect=/order&locked=true",
    ])

    @include('musora.sales.components.plans-different-section', [
        "plusLogo" => "https://pianote.s3.amazonaws.com/sales/2023/pianote-plus-logo.svg",
        "logo" => "https://musora-center.s3.amazonaws.com/logos/pianote-logo.png",
        "secondPoint" => "Artist courses and exclusive events with special guests.",
        "thirdPoint" => "Go beyond piano with lessons for singing, guitar, and drums.",
        "fifthPoint" => "1000+ songs transcribed w/ playback tools for all instruments.",
    ])
    @include('pianote._partials.faq')

    @include("pianote._partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
