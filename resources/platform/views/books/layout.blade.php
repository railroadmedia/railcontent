@extends('_partials.layout.global-layout')

@section('head-includes')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css">
    <!-- Favicons -->
    @include('_partials.layout.favicons.drumeo-favicons')
    {{-- Styles --}}
    <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">

    <style>
        .change-form.active {
            color: #0B76DB;
            padding-bottom:1px;
            border-bottom:1px solid #0B76DB;
        }

        .change-form > * {
            pointer-events: none;
        }
        .inverted{
            background-color: transparent !important;
        }
    </style>
@stop

<!-- Header -->
@section('layout-header')
    <header class="flex-none z-40">
        <nav id="nav" class="bg-[#020815] fixed w-full top-0 left-0 flex items-center h-10 md:h-14">
            <!-- Logo/Home Link -->
            <a href="/" class="h-full px-2 md:px-4 flex items-center">
                <img src="https://musora-ui.s3.amazonaws.com/logos/musora-white.svg" alt="Musora Logo" class="w-full max-w-[77px] md:max-w-[144px] max-h-9">
            </a>

            <!-- link-wrapper -->
            <div>
            <!-- Nav CTA buttons -->
                <div class="ml-auto flex items-center">
                    <a href="/members" class="btn-primary btn-small text-base leading-none bg-musora border-0 py-1.5 px-3 md:py-3 md:px-8 mr-1.5 mb-0 h-auto md:h-initial">Log In</a>
                </div>

            </div>
        </nav>
    </header>
@stop

<!-- Global Wrapper -->
@section('global-layout-body')
    <!-- Brand Specific Content -->
    @yield('content')

@stop

@yield('layout-scripts')
<script src="{{ mix('platform/js/manifest.js') }}"></script>
<script src="{{ mix('platform/js/vendor.js') }}"></script>
<script src="{{ mix('platform/js/app.js') }}"></script>
@yield('inject-components')

{{--<!-- Footer -->--}}
{{--@section('layout-footer')--}}
{{--     @include('_partials.layout.global-footer', [--}}
{{--         "brand" => "musora",--}}
{{--         "logo" => "https://musora-ui.s3.amazonaws.com/logos/musora-white.svg"--}}
{{--     ])--}}
{{-- @stop--}}
