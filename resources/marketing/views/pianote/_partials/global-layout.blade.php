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
    @include('pianote._partials._favicons')

    {!! \App\Analytics\Tracker::headBottom() !!}

{{--    @include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null])--}}
</head>

<body>

{!! \App\Analytics\Tracker::bodyTop() !!}

@yield('global-body')
<script type="text/javascript" src="{{ url()->asset('marketing/parcel/pianote/pre-form-submit-facebook-lead.js') }}"></script>

{{--@include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null])--}}
<script type="text/javascript">
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>
{!! \App\Analytics\Tracker::bodyBottom() !!}

</body>
</html>
