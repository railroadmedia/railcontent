<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @yield('meta')

    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">

    <link rel="stylesheet" href="{{ mix('assets/members/css/app.css') }}">
    <!-- Tailwind -->
    <link rel="stylesheet" href="{{ mix('tailwindcss/tailwind.css') }}">

    @include('members.partials._favicons')
    @include('members.partials._svg-icons')

    @yield('styles')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    {!! \App\Analytics\Tracker::headBottom() !!}

    {!! inspectlet_embed_script() !!}
</head>

<body class="singeo {{ isLive() ? 'live' : '' }} {{ $bodyClass ?? '' }} {{ !empty($_COOKIE['collapsed']) ? 'sidebar-collapsed' : '' }} {{ !empty($_COOKIE['darkmode']) ? 'dark-mode' : '' }}">
    <div id="app">
        <app-container
            :vue-router="false"
            brand="{{ $brand }}"
        >
            @if(!empty(current_user()))
                <input id="currentUserId" type="hidden" value="{{ current_user()->getId() }}">
            @endif

            {!! \Railroad\Usora\Services\ClientRelayService::getBodyTop() !!}

            {!! \App\Analytics\Tracker::bodyTop() !!}

            @yield('breadcrumbs')

            @yield('content')
        </app-container>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>

    <script src="{{ mix('assets/members/js/manifest.js') }}"></script>
    <script src="{{ mix('assets/members/js/vendor.js') }}"></script>
    @yield('inject-components')
    <script src="{{ mix('assets/members/js/app.js') }}"></script>

    @yield('scripts')

    @include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null])
    <script type="text/javascript">
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
    {!! \App\Analytics\Tracker::bodyBottom() !!}

</body>
</html>
