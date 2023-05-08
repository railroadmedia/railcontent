<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
        {!! \App\Analytics\Tracker::trackPageView() !!}
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
        {!! \App\Analytics\Tracker::headBottom() !!}
    </head>

    <body id="app-body" class="tw-flex tw-flex-col tw-w-full tw-min-h-screen tw-relative" @yield('body-data')>
        {!! \App\Analytics\Tracker::bodyTop() !!}
        {{-- Notifications Container --}}
        <div id="notifications-container"></div>

        {{-- Modal Container --}}
        <div id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

        <!-- Confirmation Modal Container -->
        <div id="confirmation-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

        {{-- App Container --}}
        <div id="app" class="flex-1">
            <app-container
                :vue-router="false"
                brand="{{ $brand }}"
            >
                <page-container
                    csrf_token="{{ csrf_token() }}"
                    brand="{{ $brand }}"
                    :is-live="{{ isLive() ? 'true':'false' }}"
                    search-url=""
                    :playlists="{{ json_encode($pinnedPlaylists) }}" {{-- Preloaded Content --}}mostRecentPlaylists
                    :most-recent-playlists="{{ json_encode($mostRecentPlaylists) }}" {{-- Preloaded Content --}}
                    @if(!empty( user() ))
                        user-name="{{ user()->display_name }}"
                        user-avatar="{{ user()->profile_picture_url }}"
                        user-id="{{ user()->id }}"
                        account-url="{{ user()->getDashboardUrl() }}"
                        :can-refer-new-students="{{ user()->isAMember() ? 'true' : 'false' }}"
                    @endif
                    @if(!empty( $hasUnreadNotifications ))
                        :has-notifications="{{ $hasUnreadNotifications ? 'true' : 'false' }}"
                    @endif
                    @if(isset($adminMessage))
                        admin-message="{{ $adminMessage }}"
                    @endif
                    {{-- @if(isset($forceHideSidebar))
                        :force-sidebar-hidden="{{$forceHideSidebar ? 'true' : 'false'}}"
                    @endif --}}
                >
                    <template v-cloak v-slot="slotProps">

                        @yield('content')

                    </template>
                </page-container>
                {{-- Review Modals Code Loads Here --}}
                @yield('review-modal-section')
            </app-container>
        </div>

        @include('partials._brand-set-authentication-cookies-iframe')

        {{-- Scripts --}}
        <script type="application/javascript">
            window.sidebarNavigationLinks = {!! $sidebarNavigationSectionsJson ?? '' !!};
            window.userNavigationDropdownLinks = {!! $userNavigationDropdownLinksJson ?? '' !!};
        </script>

        @yield('layout-scripts')
            <script src="{{ mix('platform/js/manifest.js') }}"></script>
            <script src="{{ mix('platform/js/vendor.js') }}"></script>
            <script src="{{ mix('platform/js/app.js') }}"></script>
        @yield('inject-components')

        {{-- Helpscout Beacon --}}
        @include('partials.third-party.helpscout-tracking-beacon-script', [
            'email' => !empty(user()) ? user()->email : null,
            'brand' => $brand,
        ])

         {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
