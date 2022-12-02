@extends('layouts.global-layout')

@section('styles')
    @parent
    <link rel="preload" href="{{ mix('tailwindcss/tailwind.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}"></noscript>
    <link href="{{ asset('/assets/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/marketing/nav-footer.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link href="{{ asset('/assets/marketing/shop-product.css') }}" rel="stylesheet">
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
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/shop-product.js"></script>
@endsection

@section('content')
    @include("sales.partials._nav", [
        "cartVersion" => true
    ])

    @yield('banner')

    <div class="clearfix tw-container tw-mx-auto tw-max-w-6xl">
        <div class="lg:tw-flex">
            @yield('top')
        </div>

        <div class="product-wrap tw-px-3 md:tw-px-4 lg:tw-w-2/3">
            <div class="pack-details tw-mb-7">
                @yield('bottom')
            </div>
        </div>
    </div>

    @yield('bottom-banner')

    @include("sales.partials._footer")
@endsection
