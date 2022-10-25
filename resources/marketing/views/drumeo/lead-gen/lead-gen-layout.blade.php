@extends('drumeo._partials.layout-template')

@section('global-head')
    @yield('meta')

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen.css') }}" rel="stylesheet">

    @yield('styles')
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    @yield('content')

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/assets/js/pre-form-submit-facebook-lead.js') }}"></script>

    <script src="{{ asset('/marketing/parcel/drumeo/compiled/infusionsoft-tracking.js') }}"></script>
@stop
