@extends('_partials.layout.coaches-method-songs-layout')

@section('page-styles')
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
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
            "scrollToJoin" => true,
        ])
@endsection

@section('page-footer')
    @include('musora.sales.components.order-section-collage', [
    'header' => 'Unlimited guitar lessons<br> Direct access to real teachers<br> 1000+ popular songs',
    'list' => '<li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Trusted by ##,### happy students.</li>
                <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Online guitar lessons on every topic.</li>
                <li class="leading-tight mb-3"><i class="fa-li fas fa-check text-guitareo"></i> Personalized feedback from real teachers.</li>
                <li class="leading-tight text-coaches max-w-xs mx-0"><i class="fa-li fas fa-check"></i> <strong>PLUS</strong> voice, piano, and drum lessons with full access to all Musora communities.</li>',
    'buttonLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[30-day-drummer]=1&products[practicepad]=1&products[Drumeo-VaterSticks]=2&products[BeginnerBook]=1&locked=true',
    'price' => '20',
    'image' => 'https://guitareo.s3.amazonaws.com/sales/2023/guitareo-spread.png',
    ])

    @include('musora.sales.components.app-section', [
        'appleLink' => 'https://itunes.apple.com/us/app/musora/id1619053766?ls=1',
        'googleLink' => 'https://play.google.com/store/apps/details?id=com.musoraapp',
        'image' => 'https://guitareo.s3.amazonaws.com/sales/2023/devices.png',
    ])

    @include('guitareo._partials.faq')

    @include("guitareo.sales.partials._footer")
@endsection
