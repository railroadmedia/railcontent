<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
        @yield('meta')

        {{-- Icons --}}
        <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
        <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
        @yield('layout-styles')

        @include('partials._fonts')

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
                <page-container
                    brand="{{ $brand }}"
                    :is-live="true"
                    :has-notifications="true"
                    user-name="{{ user()->display_name }}"
                    user-avatar="{{ user()->profile_picture_url }}"
                    account-url="{{ user()->getDashboardUrl() }}"
                    search-url=""
                >
                    @yield('content')
                </page-container>
            </app-container>
        </div>

        <!-- Scripts -->
        <script type="application/javascript">
            window.sidebarNavigationLinks = {!! $sidebarNavigationSectionsJson ?? '' !!};
            window.userNavigationDropdownLinks = {!! $userNavigationDropdownLinksJson ?? '' !!};
        </script>

        @yield('layout-scripts')
        <script src="{{ mix('platform/js/app.js') }}"></script>
        @yield('inject-components')

        {{-- @include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null]) --}}
        <script type="text/javascript">
            //Beacon('on', 'ready', () => {
                //document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
            //})
        </script>
        {{-- {!! \App\Analytics\Tracker::bodyBottom() !!} --}}
    </body>
</html>
