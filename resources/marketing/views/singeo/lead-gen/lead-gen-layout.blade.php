@extends('singeo._partials.layout')

@section('head-includes')
    @parent

    @include('partials.google-optimize')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind-helpers.css') }}" >
    <link rel="stylesheet" href="{{ asset('/assets/marketing/nav-footer.css') }}">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>

    @yield('styles')
@stop

@section('layout-body')
    @include("singeo.sales.partials._nav")

    @yield('body')

    @include("singeo.sales.partials._footer")
@stop

@section('layout-scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="/assets/js/modal.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

    @yield('scripts')
@endsection