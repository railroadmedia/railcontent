<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
        @yield('meta')

        {{-- Google Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        
        {{-- Icons --}}
        <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
        <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
        @yield('layout-styles')

        @include('partials._favicons')
    </head>

    <body id="app-body" class="tw-flex tw-flex-col tw-w-full tw-min-h-screen tw-relative">
        <!-- Modal Container -->
        <div id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>
        
        <!-- App Container -->
        <div id="app" class="flex-1">
            <app-container
                :vue-router="false"
                brand="{{ $brand }}"
            >

                @yield('content')

            </app-container>
        </div>

        <!-- Scripts -->
        @yield('layout-scripts')
        <script src="{{ mix('platform/js/app.js') }}"></script>
        @yield('inject-components')

        {{-- @include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null]) --}}
        <script type="text/javascript">
            Beacon('on', 'ready', () => {
                document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
            })
        </script>
        {{-- {!! \App\Analytics\Tracker::bodyBottom() !!} --}}
    </body>
</html>
