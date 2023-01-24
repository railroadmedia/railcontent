@extends('_partials.layout.features-layout')

@section('page-styles')
    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/pianote/sales.css') }}" rel="stylesheet">
    <style>
        .splide__arrow svg {
            fill: #F61A30 !important;
        }
    </style>
@endsection

@section('page-nav')
    @include("pianote._partials._nav", [
        "subscriptionVersion" => true,
        "fullSubscriptionVersion" => true,
        "trialVersion" => true,
        "joinUrl" => '/choose-plan',
    ])
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> 1000+ popular songs.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Trusted by ' . number_format(Prices::$students) . ' students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Online piano lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-pianote"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/pianote-spread.png',
        ])

    @include('musora.sales.components.app-section', [
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/devices.png',
        'appleUrl' => 'https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af',
        'googleUrl' => 'https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews',
    ])

    @include('pianote._partials.faq')

    @include('pianote._partials._footer')
@endsection
