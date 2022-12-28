@extends('_partials.layout.coaches-method-songs-layout')

@section('page-styles')
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <style>
        .splide__arrow svg {
            fill: #8300E9 !important;
        }
    </style>
@endsection

@section('page-nav')
    @if(!empty($trialVersion))
        @if(!empty($joinUrl))
            @include("singeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "joinUrl" => $joinUrl
            ])
        @else
            @include("singeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "scrollToJoin" => true,
            ])
        @endif
    @else
        @include("singeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true,
            "homepage" => true
        ])
    @endif
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> Personalized feedback from real teachers.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Trusted by #,### happy students. </li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Online singing lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-singeo"></i> Personalized feedback from vocal coaches.</li>
                    <li class="leading-tight text-coaches"><i class="fa-li fas fa-check"></i> <strong>*BONUS*</strong> piano, guitar, and drum lessons with full access to all Musora communities.</li>',
        'buttonLink' => '',
        'price' => '',
        'image' => 'https://singeo.s3.amazonaws.com/sales/2023/singeo-spread.png',
    ])

    @include('musora.sales.components.app-section', [
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://singeo.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @include('singeo._partials.faq')

    @include('singeo.sales.partials._footer')
@endsection
