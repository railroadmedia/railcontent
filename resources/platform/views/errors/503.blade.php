<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
        {!! \App\Analytics\Tracker::trackPageView() !!}
        <title>Down For Maintenance | Musora</title>

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

    @if( !empty(user()->id) ) {{-- Is User Logged In? --}}
        <body id="app-body" class="tw-flex tw-flex-col tw-w-full tw-min-h-screen tw-relative">
            {!! \App\Analytics\Tracker::bodyTop() !!}
            {{-- Notifications Container --}}
            <div id="notifications-container"></div>

            {{-- Modal Container --}}
            <div role="dialog" aria-labelledby="dialog-modal" aria-describedby="dialog-modal-container" id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full" tabindex="0"></div>

            <!-- Confirmation Modal Container -->
            <div id="confirmation-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

            {{-- App Container --}}
            <div id="app" class="flex-1">
                <app-container
                    :vue-router="false"
                    brand="{{ $brand }}"
                >
                    <page-container
                        brand="{{ $brand }}"
                        :is-live="{{ isLive() ? 'true':'false' }}"
                        search-url=""
                        :playlists="{{ json_encode($pinnedPlaylists) }}" {{-- Preloaded Content --}}
                        @if(!empty( user() ))
                            user-name="{{ user()->display_name }}"
                            user-avatar="{{ user()->profile_picture_url }}"
                            user-id="{{ user()->id }}"
                            account-url="{{ user()->getDashboardUrl() }}"
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

                            <div class="tw-relative tw-flex tw-flex-col tw-h-[calc(100%+1.75rem)] tw-justify-center tw-items-center">
                                <img src="https://cdn.musora.com/image/fetch/c_thumb,w_1200,q_auto:best/https://d3fzm1tzeyr5n3.cloudfront.net/Rehearsal+Studio_deSaturated.png"
                                    alt="Image of Musical instrument on a stage"
                                    class="tw-absolute tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
                                    onload="this.classList.remove('tw-opacity-0')"
                                >
                                <div class="tw-absolute tw-h-full tw-w-full tw-top-0 tw-left-0 tw-bg-[#E5E5E5]/90 dark:tw-bg-[#00101D]/90"></div>

                                {{-- Content --}}
                                <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-my-3 tw-z-50 tw-items-center tw-justify-center">
                                    <div class="tw-text-[#0D0D0D] dark:tw-text-white tw-text-center">
                                        <h1 class="tw-text-5xl lg:tw-text-6xl tw-font-bold tw-mb-4 lg:tw-mb-6">Temporarily down for maintenance</h1>
                                        <h2 class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-text-2xl lg:tw-text-3xl tw-font-bold tw-mb-4">503 ERROR</h1>
                                        <p class="tw-mb-8">We are performing scheduled maintenance. We will be back online shortly.</p>

                                        <a href="{{ $brand }}/" class="tw-btn-primary tw-bg-[#081825] tw-text-white dark:tw-bg-white dark:tw-text-[#00101D] tw-mb-4">Go Back</a>
                                        <p class="tw-mb-4">Go back or <a href="/{{ $brand }}/support" class="tw-text-[#081825] dark:tw-text-white tw-underline tw-font-bold">contact support</a></p>
                                    </div>
                                </div>
                            </div>

                        </template>
                    </page-container>
                    {{-- Review Modals Code Loads Here --}}
                    @yield('review-modal-section')
                </app-container>
            </div>

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

            {{-- Customer.io --}}
            <script type="text/javascript">
                var _cio = _cio || [];
                (function() {
                    var a,b,c;a=function(f){return function(){_cio.push([f].
                    concat(Array.prototype.slice.call(arguments,0)))}};b=["load","identify",
                    "sidentify","track","page","on","off"];for(c=0;c<b.length;c++){_cio[b[c]]=a(b[c])};
                    var t = document.createElement('script'),
                        s = document.getElementsByTagName('script')[0];
                    t.async = true;
                    t.id    = 'cio-tracker';
                    t.setAttribute('data-site-id', {{ config('customer-io.accounts.musora.site_id') }});
                    t.setAttribute('data-use-array-params', 'true');
                    t.setAttribute('data-use-in-app', 'true');
                    t.src = 'https://assets.customer.io/assets/track.js';
                    s.parentNode.insertBefore(t, s);
                })();
                _cio.identify({
                    id: {{ user()->id }},
                    created_at: "{{ user()->created_at }}",   
                    email: "{{ user()->email }}",
                    first_name: "{{ user()->first_name }}",
                    last_name: "{{ user()->last_name }}",
                    plan_name: "{{ user()->access_level }}"
                });
            </script>

            {{-- Helpscout Beacon --}}
            @include('partials.third-party.helpscout-tracking-beacon-script', [
                'email' => !empty(user()) ? user()->email : null,
                'brand' => $brand,
            ])

            {!! \App\Analytics\Tracker::bodyBottom() !!}
        </body>

    @else

        <body class="tw-bg-[#000C17] tw-text-white tw-flex">
            <div class="tw-flex-1 tw-flex tw-flex-col tw-items-center tw-justify-center">
                <div class="tw-text-center tw-max-w-md tw-px-6 md:tw-px-0 md:tw-max-w-full">
                    <img class="md:tw-h-60 lg:tw-h-72 tw-mx-auto" src="https://dmmior4id2ysr.cloudfront.net/logos/404_musora_logo.png" alt="404 logo" />
                    <div class="tw-mb-2 tw-text-xl md:tw-text-2xl lg:tw-text-3xl">Sorry, We are performing scheduled maintenance. We will be back online shortly.</div>
                    <div class="tw-font-normal tw-mb-3 md:tw-mb-6 tw-text-sm md:tw-text- tw-text-[#E4E4E7]">The page you're looking for doesn't exist.</div>
                    <button onclick="history.back()" class="tw-btn-primary tw-bg-white tw-text-black tw-mb-3 md:tw-mb-4">Go Back</button>
                    <p class="tw-text-sm md:tw-text-base tw-text-[#E4E4E7]">
                        Go back or contact <u class="tw-text-sm md:tw-text-base">support@musora.com</u>
                    </p>
                </div>
            </div>
        </body>

    @endif
</html>
