@extends('layout-template')

@section('global-head')
    @yield('meta')

    @include('partials.fonts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="/laravel/public/css/tailwind-helpers.css" rel="stylesheet">
    <link rel="preload" href="{{ _mix('tailwindcss/tailwind.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ _mix('tailwindcss/tailwind.css') }}"></noscript>
    <link href="{{ asset('/assets/members-area/css/gulp/navigation-sales.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/assets/members-area/css/gulp/drum-shop-product.css') }}" rel="stylesheet">
    @yield('head')
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
        }
    </style>
@stop

@section('global-body')
    @include("sales.partials._nav", [
        "cartVersion" => true
    ])

    @yield('banner')

    <div class="clearfix tw-container tw-mx-auto tw-max-w-6xl">
        <div class="lg:tw-flex">
            @yield('top')
        </div>
        <div class="product-wrap lg:tw-w-2/3 tw-px-3 md:tw-px-4">
            <div class="pack-details tw-mx-auto tw-mb-7 tw-pb-5 sm:tw-pb-9 lg:tw-pb-11">
                @yield('bottom')
            </div>
        </div>
    </div>

    @include("sales.partials._footer")


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('/assets/members-area/js/gulp/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/members-area/js/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/members-area/js/gulp/pack-drumshop.js') }}"></script>
    <script src="{{ _mix('js/manifest.js') }}"></script>
    <script src="{{ _mix('js/vendor.js') }}"></script>
    <script src="{{ _mix('js/cart-sidebar.js') }}"></script>
    <script src="{{ _mix('js/app.js') }}"></script>
    @yield('scripts')
@stop
