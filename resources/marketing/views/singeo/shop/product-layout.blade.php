@extends('singeo._partials.layout')

@section('head-includes')
    @parent

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet"> --}}
    <link rel="preload" href="{{ mix('tailwindcss/tailwind.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}"></noscript>
    <link rel="stylesheet" href="{{ asset('/assets/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/assets/marketing/nav-footer.css') }}" rel="stylesheet">
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

@section('layout-body')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true,
    ])

    @yield('banner')

    <div class="clearfix container mx-auto max-w-6xl">
        <div class="lg:flex">
            @yield('top')
        </div>
    

        <div class="product-wrap px-3 md:px-4 lg:w-2/3">
            <div class="pack-details mb-7 pb-5 sm:pb-9 lg:pb-11">
                @yield('bottom')
            </div>
        </div>
    </div>

    @include("singeo.sales.partials._footer")

    <script src="{{ mix('marketing/js/manifest.js') }}"></script>
    <script src="{{ mix('marketing/js/vendor.js') }}"></script>
    <script src="{{ mix('marketing/js/cart-sidebar.js') }}"></script>
    <script src="{{ mix('marketing/js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/nav-footer.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script type="text/javascript" src="/assets/marketing/shop-product.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.countdown-2.js"></script>
    <script>
        $(document).ready(function () {
            // Countdown
            $('.tzcd-full').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M %-S Second%!S';
                    if (event.offset.totalHours > 0) {
                        format = '%-H Hour%!H ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-D Day%!D ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-small').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '%-MM %-SS';
                    if (event.offset.totalHours > 0) {
                        format = '%-HH ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '%-DD ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('a limited time');
                });
            $('.tzcd-big').countdown('2021/11/30')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
@endsection
