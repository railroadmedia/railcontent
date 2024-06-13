@extends('_partials.layout.features-layout')

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .splide__arrow svg {
            fill: #0B76DB !important;
        }
    </style>
@endsection

@section('page-nav')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "fullSubscriptionVersion" => true,
        "trialVersion" => true,
        "joinUrl" => '/choose-plan',
    ])
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'logo' => 'marketing/drumeo/membership/homepage/2024/logo-blue.webp',
        'header' => 'Unlimited drum lessons<br> The world’s best teachers<br> 6000+ popular songs',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and singing lessons with full access to all Musora communities.</li>',
        'image' => '/marketing/drumeo/membership/homepage/2023/drumeo-collage.png',
    ])

    @include('musora.sales.components.app-section', [
        'image' => 'marketing/drumeo/membership/homepage/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.drumeo',
    ])

    @include('drumeo._partials.faq')

    @include("drumeo.sales.partials._footer")
@endsection
