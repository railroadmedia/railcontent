@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .option-buttons.active {
            border-color:#0b76db!important;
            background-color:#0c2949!important;
        }
        .option-buttons.active .radio-check {
            border-color:#0b76db!important;
            background-color:#0b76db!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true,
            "fullSubscriptionVersion" => true,
        ])


    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeoplus_logo.svg",
        "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
        "instrument" => "drum",
        "songs" => "5000",
        "firstPoint" => "The world’s best drum lessons.",
        "thirdPoint" => "Unlimited personal support",
        "fifthPoint" => "Lesson access for piano, guitar, and singing.",
        "plusAnnualLink" => "/laravel/public/shopping-cart/api/query?products[DLM-Trial-Annual-7-Day]=1&locked=true",
        "plusMonthlyLink" => "/laravel/public/shopping-cart/api/query?products[DLM-Trial]=1,month,1&locked=true",
        "annualLink" => "/laravel/public/shopping-cart/api/query?products[DLM-Trial-Annual-7-Day]=1&locked=true",
        "monthlyLink" => "/laravel/public/shopping-cart/api/query?products[DLM-Trial]=1,month,1&locked=true",
    ])


    @include('musora.sales.components.plans-different-section', [
        "plusLogo" => "https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeoplus_logo-dark.svg",
        "logo" => "https://musora-center.s3.amazonaws.com/logos/drumeo-logo.png",
        "secondPoint" => "200+ courses with legendary teachers",
        "thirdPoint" => "Go beyond drums with lessons for piano, guitar, and singing.",
        "fifthPoint" => "Thousands of songs transcribed w/ playback tools for all instruments.",

    ])
    @include('drumeo._partials.faq')

    @include("drumeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
