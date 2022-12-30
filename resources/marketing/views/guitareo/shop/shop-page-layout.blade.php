@extends('guitareo._partials.global-layout')

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{asset('/marketing/css/guitareo/tailwind-helpers.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/marketing/parcel/guitareo/shop-product.css') }}" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
        }
    </style>
@endsection

@section('scripts')
    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('/marketing/parcel/guitareo/nav-footer.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/guitareo/shop-product.js') }}"></script>
@endsection

@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])

    @yield('banner')

    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            @yield('top')
        </div>

        <div class="product-wrap px-3 md:px-4 lg:w-2/3">
            <div class="pack-details mb-7">
                @yield('bottom')
            </div>
        </div>
    </div>

    @yield('bottom-banner')

    @include("guitareo.sales.partials._footer")
@endsection
