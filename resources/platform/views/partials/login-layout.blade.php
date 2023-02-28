<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
        @yield('meta')

        @include('partials.third-party.inspectlet-tracking-script')

        {{-- Icons --}}
        <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
        <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">

        {{-- Fonts --}}
        @include('partials._fonts')

        {{-- Favicons --}}
        @include('partials._favicons')

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">

        @yield('styles')
        {!! \App\Analytics\Tracker::trackPageView() !!}
        {!! \App\Analytics\Tracker::headBottom() !!}

    </head>

    <body id="app-body" class="tw-flex tw-flex-col tw-w-full tw-min-h-screen tw-relative">
        {!! \App\Analytics\Tracker::bodyTop() !!}

        <!-- Modal Container -->
        <div id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

        <!-- Confirmation Modal Container -->
        <div id="confirmation-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

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
        <script src="{{ mix('platform/js/manifest.js') }}"></script>
        <script src="{{ mix('platform/js/vendor.js') }}"></script>
        <script src="{{ mix('platform/js/app.js') }}"></script>
        @yield('inject-components')

        {{-- Helpscout Beacon --}}
        @include('partials.third-party.helpscout-tracking-beacon-script', ['email' => !empty(user()) ? user()->email : null])

         {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
