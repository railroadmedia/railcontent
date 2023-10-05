@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Privacy Policy | Drumeo</title>
    <meta property="og:title" content="Privacy Policy">
    <meta name="description" content="Below is a list of the standard policies we use on this website.">

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


    @include('musora._partials._privacy', [
        'headerBg' => 'background-image:url(https://dpwjbsxqtam5n.cloudfront.net/sales/sub-options-bg.jpg);'
    ])
    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
