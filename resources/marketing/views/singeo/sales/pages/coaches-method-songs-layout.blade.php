@extends('_partials.layout.coaches-method-songs-layout')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
@endsection

@section('page-nav')
    @if(!empty($trialVersion))
        @if(!empty($joinUrl))
            @include("pianote._partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "joinUrl" => $joinUrl
            ])
        @else
            @include("pianote._partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "scrollToJoin" => true,
            ])
        @endif
    @else
        @include("pianote._partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true,
            "homepage" => true
        ])
    @endif
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
        'header' => 'Unlimited piano lessons.<br> Direct access to real teachers.<br> Personalized feedback from real teachers.',
        'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Trusted by 30,000 happy students.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Online piano lessons on every topic.</li>
                    <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-drumeo"></i> Personalized feedback from real teachers.</li>
                    <li class="leading-tight text-coaches"><i class="fa-li fas fa-check"></i> <strong>*BONUS*</strong> voice, guitar, and drums lessons with full access to all Musora communities.</li>',
        'buttonLink' => '',
        'price' => '',
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/pianote-spread.png',
    ])

    @include('musora.sales.components.app-section', [
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://pianote.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @include('pianote._partials.faq')

    @include('pianote._partials._footer')
@endsection
