@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta name="description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:description" content="Learn the drums faster with organized video lessons, legendary teachers, and better practice tools. 90-Day Guarantee.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
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
            "hideJoin" => true,
            "subscriptionVersion" => true,
        ])
    <section class="text-center text-white px-4 sm:px-6 py-2 sm:py-6 lg:py-8 bg-cover bg-center" style="background-color: #0f4783;background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/header-banner.jpg);">
        <div class="container max-w-6xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-48" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/VDF-logo.png">
        </div>
    </section>
    <section class="text-center px-6 sm:px-8 py-10 sm:py-16 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12">
                    <div class="bg-cover rounded-xl aspect-1:1 overflow-hidden relative bg-top cursor-pointer" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/intro-side.png);"></div>
                </div>
                <div class="w-full sm:w-7/12 sm:pl-5 lg:pl-10 mt-5 sm:mt-0 text-center lg:text-left">
                    <div class="px-5 sm:px-0">
                        <p style="letter-spacing: 0.35em;">DOWNLOAD RESOURCES</p>
                        <h3 class="leading-tight sm:mt-2 mb-4"><strong>Want to check out what I played today? </strong></h3>
                        <p class="leading-relaxed">Simply click below to download the three sheet music scores played at the Victoria Drum Fest. Also get access to the full audio track by Kaz Rodriguez. Happy playing and listening!</p>
                        <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10">
                            <div class="w-full sm:w-1/2 sm:mx-auto px-1 mb-2"><a target="_blank" class="w-full join bg-drumeo smaller" href="https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/Victoria+Drum+Fest+Clinic.pdf">PDF <i class="far fa-arrow-down-to-bracket" style="line-height: 0;" aria-hidden="true"></i></a></div>
                            <div class="w-full sm:w-1/2 sm:mx-auto px-1 mb-2"><a target="_blank" class="w-full join bg-drumeo smaller" href="https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/Brandon-Toews-VDF-Track.mp3">MP3 <i class="far fa-arrow-down-to-bracket" style="line-height: 0;" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <audio class="w-full my-7" controls src="https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/Brandon-Toews-VDF-Track.mp3"></audio>
            <object class="rounded-xl w-full hidden lg:inline-block" height="810px" data="https://dpwjbsxqtam5n.cloudfront.net/festival/vdf/Victoria+Drum+Fest+Clinic.pdf" type="application/pdf"></object>
        </div>
    </section>

    @include('musora.sales.components.card-selection-section', [
        "headline" => "Try Drumeo. Your first week is free.",
        "plusLogo" => "https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeoplus_logo.svg",
        "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
        "songs" => "popular songs.",
        "firstPoint" => "The world’s best drum lessons.",
        "thirdPoint" => "Unlimited personal support.",
        "fifthPoint" => "Lesson access for piano, guitar, and singing.",
        "plusAnnualLink" => "/ecommerce/add-to-cart?products[DLM-Trial-Annual-7-Day]=1&locked=true",
        "plusMonthlyLink" => "/ecommerce/add-to-cart?products[DLM-Trial-1-month]=1&locked=true",
        "annualLink" => "/ecommerce/add-to-cart?products[drumeo-base-annual-recurring-7-day-trial-membership]=1&locked=true",
        "monthlyLink" => "/ecommerce/add-to-cart?products[drumeo-base-monthly-recurring-7-day-trial-membership]=1&locked=true",
    ])

    @include("drumeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
