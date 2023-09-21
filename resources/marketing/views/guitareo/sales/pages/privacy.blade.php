@extends('guitareo._partials.global-layout')

@section('meta')
    <title>Privacy Policy | Guitareo</title>
    <meta name="description" content="Below is a list of the standard policies we use on this website.">

    <meta property="og:title" content="Privacy Policy">
    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/sales/2023/share-image-guitareo.jpg"/>
    <meta property="og:url" content="https://www.guitareo.com/privacy/">

@endsection

@section('styles')
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}">

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@endsection

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    @include('musora._partials._privacy', [
        'headerBg' => 'background-image:url(https://dmmior4id2ysr.cloudfront.net/assets/images/guitareo-header.jpg);'
    ])
    @include("guitareo.sales.partials._footer")
@endsection
