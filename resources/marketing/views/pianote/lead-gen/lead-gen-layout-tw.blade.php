@extends('pianote._partials.global-layout')

@section('global-head')
    @yield('meta')
    <meta property="fb:app_id" content="1772693566314871" />

    @if(!empty($appTailwind))
        <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    @else
        @include('_partials.layout._tailwindcdn')
    @endif
    <link rel="preload" href="{{ asset('/marketing/css/tailwind-helpers.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}"></noscript>
    <link rel="preload" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}"></noscript>
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/lead-gen-pianote.css') }}">

    @yield('head')
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')

    @yield('page-body')

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
