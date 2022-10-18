@extends('drumeo._partials.layout-template')

@section('global-head')
    @yield('meta')

    @include('partials.fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/assets/members-area/css/gulp/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/members-area/css/gulp/lead-gen.css') }}" rel="stylesheet">

    @yield('styles')
@stop

@section('global-body')
    @include("sales.partials._nav")

    @yield('content')

    @include("sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/assets/members-area/js/gulp/modal-autoplay.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('/assets/members-area/js/gulp/navigation-sales.js') }}"></script>
    <script src="{{ asset('/assets/js/pre-form-submit-facebook-lead.js') }}"></script>

    <script src="{{ asset('/assets/members-area/js/gulp/compiled/infusionsoft-tracking.js') }}"></script>
@stop
