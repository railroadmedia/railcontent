@extends('guitareo._partials.global-layout')

@section('meta')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="preload" href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/css/guitareo/tailwind-helpers.css') }}"></noscript>
    <link rel="preload" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}"></noscript>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }
    </style>

    @yield('styles')
@stop

@section('navigation')
    @include("guitareo.sales.partials._nav")
@stop

@section('content')
    @yield('body')

    @include("guitareo.sales.partials._footer")
@stop

@section('scripts')
    <script src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/guitareo/nav-footer.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
