@extends('_partials.layout.features-layout')

@section('page-styles')
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/sales-page.css') }}" rel="stylesheet">
    <style>
        .splide__arrow svg {
            fill: #8300E9 !important;
        }
    </style>
@endsection

@section('page-nav')
    @include("singeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "fullSubscriptionVersion" => true,
        "trialVersion" => true,
        "joinUrl" => '/choose-plan',
    ])
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited singing lessons.<br> Vocal coaches and support.<br>1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
        'image' => 'https://singeo.s3.amazonaws.com/sales/2023/singeo-spread.png',
    ])

    @include('musora.sales.components.app-section', [
        'image' => 'https://singeo.s3.amazonaws.com/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=101a6930-1058-4aae-9584-1a25cec367a0',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=singeo_previews',
    ])

    @include('singeo._partials.faq')

    @include('singeo.sales.partials._footer')
@endsection
