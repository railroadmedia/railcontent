<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    {!! \App\Analytics\Tracker::trackPageView() !!}

    @include('pianote._partials.google-optimize')

    @yield('global-head')

    @include('pianote._partials._fonts')
    @include('_partials.layout.favicons.pianote-favicons')

    {!! \App\Analytics\Tracker::headBottom() !!}

</head>

<body @yield('body-data')>

{!! \App\Analytics\Tracker::bodyTop() !!}

@yield('global-body')
<script type="text/javascript" src="{{ asset('marketing/js/pianote/pre-form-submit-facebook-lead.js') }}"></script>

@include('helpscout::helpscout-tracking-beacon-script', ['email' => !is_null(user()) ? user()->getEmail() : null])
<script type="text/javascript">
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>
{!! \App\Analytics\Tracker::bodyBottom() !!}

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script type="text/javascript" src={{ asset('/marketing/js/jquery.countdown-2.min.js') }}></script>
<script>
    $(document).ready(function () {
        $('.tzcd-smaller2').countdown('2022/12/27')
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
        $('.tzcd-label').countdown('2022/12/27')
            .on('update.countdown', function (event) {
                var format = '' + '<div class="inline-block mr-2"><h2 class="font-extrabold leading-none text-base">%M</h2> <p class="leading-none uppercase font-extrabold text-promo" style="font-size:10px;">min%!M</p></div> ' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-base">%S</h2> <p class="leading-none uppercase font-extrabold text-promo" style="font-size:10px;">sec%!S</p></div>';
                if (event.offset.totalHours > 0) {
                    format = '' + '<div class="inline-block mx-2"><h2 class="font-extrabold leading-none text-base">%H</h2> <p class="leading-none uppercase font-extrabold text-promo" style="font-size:10px;">hr%!H</p></div> ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-base">%D</h2> <p class="leading-none uppercase font-extrabold text-promo" style="font-size:10px;">day%!D</p></div> ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('<div class="inline-block"><h2 class="font-extrabold leading-none text-base">LIMITED</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">TIME LEFT</p></div>');
            });
    });
</script>
</body>
</html>
