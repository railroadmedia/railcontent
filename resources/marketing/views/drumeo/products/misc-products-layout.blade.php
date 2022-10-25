@extends('drumeo._partials.layout-template')

@section('global-head')
    @yield('meta')

    @include('drumeo._partials._fonts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="/marketing/css/drumeo/tailwind-helpers.css" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    @yield('head')
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    @yield('content')

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.3/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/ba-bbq.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/misc.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="/marketing/js/jquery.countdown-2.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
            // Countdown
            $('.tzcd-full').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '%-M Minute%!M';
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
            $('.tzcd-small').countdown('2022/08/01')
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
            $('.tzcd-big').countdown('2022/08/01')
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
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>

    <script src="{{ asset('marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('marketing/js/drumeo/app.js') }}"></script>
    @yield('scripts')
@stop
