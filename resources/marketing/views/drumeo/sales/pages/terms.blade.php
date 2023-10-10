@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Terms Of Use | Drumeo</title>
    <meta property="og:title" content="Terms Of Use">
    <meta name="description" content="Please read this agreement carefully before accessing or using this web site.">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
            "subscriptionVersion" => true
        ])


    @include('musora._partials._terms', [
        'headerBg' => 'background-image:url(https://dpwjbsxqtam5n.cloudfront.net/sales/sub-options-bg.jpg);'
    ])


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
