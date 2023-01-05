<!DOCTYPE html>
<html lang="en">
<head>

    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @yield('meta')
    @yield('global-head')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    @include('guitareo._partials.google-optimize')
    @include('guitareo._partials.inspectlet')

    @include('_partials.layout.favicons.guitareo-favicons')
    @include('_partials.layout._fonts')

    @yield('styles')
    @yield('page-styles')

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body class="@yield('body-class')" @yield('body-data')>

{!! \App\Analytics\Tracker::bodyTop() !!}

    @yield('global-body')

    @yield('navigation')

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @yield('scripts')

    @include('helpscout::helpscout-tracking-beacon-script', ['email' => !is_null(user()) ? user()->getEmail() : null])
    <script type="text/javascript">
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
    {!! \App\Analytics\Tracker::bodyBottom() !!}
    <script type="text/javascript" src="{{ asset('/marketing/js/jquery.countdown-2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.tzcd-bigtw').countdown('2022/12/27')
                .on('update.countdown', function (event) {
                    var format = '' + '<div class="tw-inline-block tw-mr-2"><h2 class="tw-font-extrabold tw-leading-none tw-text-2xl md:tw-text-3xl lg:tw-text-4xl">%M</h2> <p class="tw-leading-none tw-uppercase tw-font-extrabold tw-text-xs text-promo">min%!M</p></div> ' + '<div class="tw-inline-block"><h2 class="tw-font-extrabold tw-leading-none tw-text-2xl md:tw-text-3xl lg:tw-text-4xl">%S</h2> <p class="tw-leading-none tw-uppercase tw-font-extrabold tw-text-xs text-promo">sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div class="tw-inline-block tw-mx-2"><h2 class="tw-font-extrabold tw-leading-none tw-text-2xl md:tw-text-3xl lg:tw-text-4xl">%H</h2> <p class="tw-leading-none tw-uppercase tw-font-extrabold tw-text-xs text-promo">hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div class="tw-inline-block"><h2 class="tw-font-extrabold tw-leading-none tw-text-2xl md:tw-text-3xl lg:tw-text-4xl">%D</h2> <p class="tw-leading-none tw-uppercase tw-font-extrabold tw-text-xs text-promo">day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div class="tw-inline-block"><h2 class="tw-font-extrabold tw-leading-none tw-text-2xl md:tw-text-3xl lg:tw-text-4xl">LIMITED</h2> <p class="tw-leading-none tw-uppercase tw-font-extrabold tw-text-xs text-promo">TIME LEFT</p></div>');
                });
            $('.tzcd-big').countdown('2022/12/27')
                .on('update.countdown', function (event) {
                    var format = '' + '<div class="inline-block mr-2"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%M</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">min%!M</p></div> ' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%S</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div class="inline-block mx-2"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%H</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%D</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div class="inline-block"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">LIMITED</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">TIME LEFT</p></div>');
                });
            $('.tzcd-smaller').countdown('2022/12/27')
                .on('update.countdown', function (event) {
                    var format = '' + '<div class="inline-block mr-2"><h2 class="font-extrabold leading-none text-lg">%M</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">min%!M</p></div> ' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-lg">%S</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div class="inline-block mx-2"><h2 class="font-extrabold leading-none text-lg">%H</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-lg">%D</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div class="inline-block"><h2 class="font-extrabold leading-none text-lg">LIMITED</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">TIME LEFT</p></div>');
                });
        });
    </script>
</body>
</html>
