@php
use Illuminate\Support\Str;
$isOnboarding = str_contains(request()->url(), '/onboarding');
$userData = assembleUserAttributes(user());
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
        <meta name="robots" content="noindex">
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

        {{-- Dropdowns Container --}}
        <div id="dropdowns-container"></div>

        {{-- Modal Container --}}
        <div role="dialog" aria-labelledby="dialog-modal" aria-describedby="dialog-modal-container" id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full" tabindex="0"></div>

        <!-- Confirmation Modal Container -->
        <div id="confirmation-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

        {{-- App Container --}}
        <div id="app" class="flex-1">
            
            @if(empty($noContainer) || !$noContainer)
                <app-container
                    :vue-router="false"
                    brand="{{ $brand }}"
                    :user="{{ json_encode($userData) }}"
                    csrf_token="{{ csrf_token() }}"
                >
                    <page-container
                        :is-live="{{ json_encode(isLive()) }}"
                        :is-onboarding="{{ json_encode($isOnboarding) }}"
                        search-url=""
                        :playlists="{{ json_encode($pinnedPlaylists) }}" {{-- Preloaded Content --}}mostRecentPlaylists
                        :most-recent-playlists="{{ json_encode($mostRecentPlaylists) }}" {{-- Preloaded Content --}}
                        @if(!empty( $hasUnreadNotifications ))
                            :has-notifications="{{ json_encode($hasUnreadNotifications) }}"
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
            @else
                @yield('content')
            @endif
        </div>

        @include('partials._brand-set-authentication-cookies-iframe')

        {{-- Scripts --}}
        <script type="application/javascript">
            window.sidebarNavigationLinks = {!! $sidebarNavigationSectionsJson ?? '' !!};
            window.userNavigationDropdownLinks = {!! $userNavigationDropdownLinksJson ?? '' !!};
        </script>

        {{-- Customer.io --}}
        @include('partials._customer-io')

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

        {{-- Pendo Script --}}
        <script>     
            console.log('pendo script')       
            (function(apiKey){
                (function(p,e,n,d,o){var v,w,x,y,z;o=p[d]=p[d]||{};o._q=o._q||[];
                    v=['initialize','identify','updateOptions','pageLoad','track'];for(w=0,x=v.length;w<x;++w)(function(m){
                        o[m]=o[m]||function(){o._q[m===v[0]?'unshift':'push']([m].concat([].slice.call(arguments,0)));};})(v[w]);
                        y=e.createElement(n);y.async=!0;y.src='https://cdn.pendo.io/agent/static/'+apiKey+'/pendo.js';
                        z=e.getElementsByTagName(n)[0];z.parentNode.insertBefore(y,z);})(window,document,'script','pendo');
                        pendo.initialize({
                            visitor: {
                                id: "{{ user()->email }}",
                            },
                            account: {
                                id: {{ user()->id }},
                            }   
                        });
                })('d376ea71-ab19-48c3-6a31-cbff42c1e64d');
        </script>

        
        
        {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
