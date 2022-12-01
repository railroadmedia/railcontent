@extends('global-layout')

@section('global-head')
    @parent
    @yield('meta')

    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link href="/assets/marketing/shop-product.css" rel="stylesheet">
    <link href="{{ mix('tailwindcss/tailwind.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind-helpers.css') }}">
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
    @include('sales.nav', [
        "cartVersion" => true
    ])

    @yield('nav')

    <div class="clearfix tw-container tw-mx-auto tw-max-w-6xl">
        <div class="lg:tw-flex">
            @yield('top')
        </div>

        <div class="product-wrap tw-px-3 md:tw-px-4 lg:tw-w-2/3">
            <div class="pack-details tw-mx-auto tw-mb-7 tw-pb-5 sm:tw-pb-9 lg:tw-pb-11">
                @yield('bottom')
            </div>
        </div>
    </div>
    

    @include('sales.footer')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/shop-product.js"></script>
    <script src="{{ mix('assets/members/js/manifest.js') }}"></script>
    <script src="{{ mix('assets/members/js/vendor.js') }}"></script>
    <script src="{{ mix('assets/members/js/cart-sidebar.js') }}"></script>
    <script src="{{ mix('assets/members/js/app.js') }}"></script>

    @yield('end-body-scripts')
@stop
