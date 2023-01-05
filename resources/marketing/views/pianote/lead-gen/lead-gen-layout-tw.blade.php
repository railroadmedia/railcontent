@extends('pianote._partials.global-layout')

@section('global-head')
    @yield('meta')
    <meta property="fb:app_id" content="1772693566314871" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link rel="preload" href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}"></noscript>
    <link rel="preload" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}"></noscript>
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/lead-gen.css') }}">

    @yield('head')
@stop

@section('global-body')
    @include('pianote._partials._nav')

    @yield('page-body')

    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
