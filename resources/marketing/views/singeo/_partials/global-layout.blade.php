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

    @include('singeo._partials.includes.google-optimize')

    @include('_partials.layout.favicons.singeo-favicons')
    @include('singeo.sales.partials._fonts')

    {!! \App\Analytics\Tracker::headBottom() !!}

    @yield('global-head')
</head>

<body class="@yield('body-class')">

    {!! \App\Analytics\Tracker::bodyTop() !!}

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N2HMTTQ"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @yield('global-body')
    @include('helpscout::helpscout-tracking-beacon-script', ['email' => !is_null(user()) ? user()->getEmail() : null])
    <script type="text/javascript">
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
    {!! \App\Analytics\Tracker::bodyBottom() !!}

</body>
</html>
