@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Privacy Policy | Singeo</title>
    <meta property="og:title" content="Privacy Policy">
    <meta name="description" content="Below is a list of the standard policies we use on this website.">
    <meta property="og:image" content="https://d21xeg6s76swyd.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/privacy/">

    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-singeo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-singeo.css') }}">
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "joinVersion" => true,
    ])

    @include('musora._partials._privacy', [
        'headerBg' => 'background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d21xeg6s76swyd.cloudfront.net/sales/2021/background-order.jpg);'
    ])

    @include("singeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
