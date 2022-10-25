@extends('singeo._partials.global-layout')

@section('global-head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}" >
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}">

    @yield('styles')

    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav")

    @yield('body')

    @include("singeo.sales.partials._footer")
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/marketing/js/singeo/modal.js"></script>
    <script type="text/javascript" src="/marketing/parcel/singeo/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    @yield('scripts')
@stop
