@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    @yield('meta')

    <link href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link href="{{ asset('/marketing/parcel/pianote/shop-product.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
        }
    </style>
    @yield('head')
@stop

@section('global-body')
    @include('pianote._partials._nav', [
        "cartVersion" => true
    ])

    @yield('nav')

    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            @yield('top')
        </div>

        <div class="product-wrap px-3 md:px-4 lg:w-2/3">
            <div class="pack-details mx-auto mb-7 pb-5 sm:pb-9 lg:pb-11">
                @yield('bottom')
            </div>
        </div>
    </div>


    @include('pianote._partials._footer')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/shop-product.js') }}"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    @yield('end-body-scripts')
@stop
