@extends('guitareo._partials.global-layout')

@section('meta')

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"></noscript>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link rel="preload" href="{{ asset('/marketing/parcel/guitareo/tailwind-helpers.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/tailwind-helpers.css') }}"></noscript>
    <link rel="preload" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}"></noscript>
    <link rel="preload" href="{{ asset('/marketing/parcel/guitareo/lead-gen.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/lead-gen.css') }}"></noscript>

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
    <script src="/marketing/js/modal.js"></script>
    <script src="/marketing/parcel/guitareo/nav-footer.js"></script>
@stop
