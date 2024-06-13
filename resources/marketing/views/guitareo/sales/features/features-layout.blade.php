@extends('_partials.layout.features-layout')

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}" rel="stylesheet">
    <style>
        .splide__arrow svg {
            fill: #00C9AC !important;
        }
    </style>
@endsection

@section('page-nav')
    @include("guitareo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "fullSubscriptionVersion" => true,
        "trialVersion" => true,
        "joinUrl" => '/choose-plan',
    ])
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'logo' => 'marketing/guitareo/membership/homepage/2024/guitareo-logo-green.webp',
        'header' => 'Unlimited guitar lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'marketing/guitareo/membership/homepage/2023/guitareo-collage.png',
    ])

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/guitareo/membership/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('guitareo._partials.faq')

    @include("guitareo.sales.partials._footer")
@endsection
