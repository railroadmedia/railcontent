<!DOCTYPE html>
<html lang="en">
<head>

    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @yield('meta')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    @include('guitareo._partials.includes.google-optimize')
    @include('guitareo._partials.inspectlet')

    @include('guitareo._partials._favicons')
    @include('guitareo._partials._fonts')

    @yield('styles')

    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body class="@yield('body-class')">

{!! \App\Analytics\Tracker::bodyTop() !!}

    @yield('navigation')

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="{{ asset('marketing/js/guitareo/manifest.js') }}"></script>
    <script src="{{ asset('marketing/js/guitareo/vendor.js') }}"></script>
    <script src="{{ asset('marketing/js/guitareo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('marketing/js/guitareo/app.js') }}"></script>

    @yield('scripts')

{{--    @include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null])--}}
    <script type="text/javascript">
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
{!! \App\Analytics\Tracker::bodyBottom() !!}

</body>
</html>
