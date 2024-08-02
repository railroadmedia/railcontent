@extends('drumeo._partials.global-layout')

@section('global-head')
    @parent
    <title>30-Day Double Bass With 66Samus | Drumeo</title>
    <meta property="og:title" content="30-Day Double Bass With 66Samus | Drumeo">
    <meta name="description" content="Improve your coordination with daily guided workouts.">
    <meta property="og:description" content="Unlock your creativity and speed around the drums.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/drumeo/products/30-day-double-bass/share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <style>
        .timeline-container::after {
            top: 30px;
        }
        @media (min-width: 768px) {
            .timeline-container .timeline:after {
                left: 50% !important;
            }
        }
    </style>
@stop()

@section('body-data')
    x-data ="{
    trailer : false,
    trailerM: false,
    }"
@endsection

@section('global-body')

    @include('drumeo.sales.partials._nav', [
        'cartVersion' => true,
    ])
    @include('_partials.components.shop.promo-banner', [
        'name' => '30-Day Double Bass With 66Samus',
        'fullPrice' => floatval($productPrices['30-day-independence']->price),
        'price' => floatval($productPrices['30-day-independence']->discounted_price),
        'noBreadcrumb' => true,
    ])

    @include('drumeo.products._30D-double-bass')


    @include('drumeo.sales.partials._footer')

    @include('_partials.components.countdown', [
        'countdownDate' => '2024-09-02 00:00:00',
        'promoVersion' => false,
    ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
