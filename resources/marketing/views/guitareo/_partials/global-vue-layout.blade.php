<!DOCTYPE html>
<html lang="en">
<head>

    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @yield('meta')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    @include('guitareo._partials.google-optimize')
    @include('guitareo._partials.inspectlet')

    @include('_partials.layout.favicons.guitareo-favicons')
    @include('_partials.layout._fonts')

    @yield('styles')
    <style>
        .big-promo-banner{z-index:98;}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p.text{font:400 17px/1.2em Open Sans,sans-serif;display:inline-block;}@media (min-width:768px){.big-promo-banner p.text{font-size:16px}}@media (min-width:991px){.big-promo-banner p.text{font-size:18px;white-space:nowrap}}.big-promo-banner p.text strong{display:inline-block}
        .promo-banner-shim{display:block;width:100%;height:40px}
        .promo-banner{transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Open Sans,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:white;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
    </style>

    {!! \App\Analytics\Tracker::headBottom() !!}

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
</head>

<body>

{!! \App\Analytics\Tracker::bodyTop() !!}

    @yield('navigation')

    <div id="app">
        <input id="currentUserId" type="hidden" value="{{ auth()->id() }}">

        @yield('content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>

    <script src="{{ asset('/marketing/js/guitareo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/guitareo/app.js') }}"></script>

    {{-- Platform --}}
    <script src="{{ mix('/platform/js/manifest.js') }}"></script>
    <script src="{{ mix('/platform/js/vendor.js') }}"></script>
    <script src="{{ mix('/platform/js/app.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    @yield('scripts')

    @include('helpscout::helpscout-tracking-beacon-script', ['email' => !is_null(user()) ? user()->getEmail() : null])
    <script type="text/javascript">
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
{!! \App\Analytics\Tracker::bodyBottom() !!}
<script src={{ asset('/marketing/js/jquery.countdown-2.min.js') }}></script>
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
