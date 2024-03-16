@extends('musora._partials.layout', [
    'whiteNav' => true,
    'fullSubscriptionVersion' => true,
])

@section('head-includes')
    <title>Musora | Musicians start here. </title>
    <meta property="og:title" content="Musora | Musicians start here. ">

    <meta name="description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">
    <meta property="og:description" content="Learn your favorite instruments with step-by-step lessons, thousands of songs, and unlimited personal support. ">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .option-buttons.active {
            border-color:#FFAE00!important;
            background-color:#0c1524!important;
        }
        .option-buttons.active .radio-check {
            border-color:#FFAE00!important;
            background-color:#FFAE00!important;
        }
        .option-buttons.active .radio-check i {
            display:block!important;
        }
        .join.musora {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora:hover, .join.musora:focus {
            background:#FFAE00;
            color:#000;
        }
        .join.musora-black {
            background-color:#0c1524;
        }

        .join.musora-black:hover,
        .join.musora-black:focus {
            background:#0c1524;
        }
    </style>
@stop

@section('layout-body')

    <div id="customize-anchor" class="anchor anchor-slide"></div>

    @if(empty($month))
        @include('musora.sales.components.card-selection-section', [
            "whiteBg" => true,
            "plusLogo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_plus_logo.png",
            "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
            "songs" => "Thousands of popular songs.",
            "firstPoint" => "Learn piano, guitar, drums, & singing.",
            "thirdPoint" => "Unlimited personal support.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[musora-annual-recurring-7-day-trial-membership]=1&locked=true",
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[musora-monthly-recurring-7-day-trial-membership]=1&locked=true",
            "annualLink" => "/ecommerce/add-to-cart?products[musora-base-annual-recurring-7-day-trial-membership]=1&locked=true",
            "monthlyLink" => "/ecommerce/add-to-cart?products[musora-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
        ])

        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'musical',
        ])
    @else
        @include('musora.sales.components.card-selection-section', [
        "plusLogo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_plus_logo.png",
        "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
        "songs" => "Thousands of popular songs.",
        "firstPoint" => "Learn piano, guitar, drums, & singing.",
        "thirdPoint" => "Unlimited personal support.",
            "plusAnnualLink" => "/ecommerce/add-to-cart?products[musora-annual-recurring-30-day-trial-membership]=1&locked=true&referralCode=" . $referralCode,
            "plusMonthlyLink" => "/ecommerce/add-to-cart?products[musora-monthly-recurring-30-day-trial-membership]=1&locked=true&referralCode=" . $referralCode,
        ])
        @include('musora.sales.components.trial-explanation', [
            'instrument' => 'musical',
        ])
    @endif

    @include('musora._partials._faq')

@stop
