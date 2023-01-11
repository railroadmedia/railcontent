<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N2HMTTQ');</script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <meta name="facebook-domain-verification" content="bclyyfgkbrovmw1kme6r18m1a16abf" />

    {!! \App\Analytics\Tracker::trackPageView() !!}

    <script src="https://www.googleoptimize.com/optimize.js?id=OPT-NV2LHJP"></script>

    @include('_partials.layout.favicons.singeo-favicons')
    @include('_partials.layout._fonts')

    {!! \App\Analytics\Tracker::headBottom() !!}

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('global-head')

</head>

<body class="@yield('body-class')" @yield('body-data')>

    {!! \App\Analytics\Tracker::bodyTop() !!}

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N2HMTTQ"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @yield('global-body')
    <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
    <script type="text/javascript">
        window.Beacon('init', '82b3c165-0840-4f45-aaeb-4775857c4b91')
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
