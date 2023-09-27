@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Terms Of Use | Pianote</title>
    <meta property="og:title" content="Terms Of Use">
    <meta name="description" content="Please read this agreement carefully before accessing or using this web site.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/terms/">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "subscriptionVersion" => true
    ])

    @include('musora._partials._terms', [
        'headerBg' => 'background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/sales/customize-bg.jpg);'
    ])

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
