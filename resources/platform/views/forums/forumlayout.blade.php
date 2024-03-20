@php
$userData = assembleUserAttributes(user());
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        {{-- Meta --}}
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">
        @yield('meta')

        {{-- Icons --}}
        <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
        <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">
        @include('partials._svg-icons')

        {{-- Fonts --}}
        @include('partials._fonts')

        {{-- Favicons --}}
        @include('partials._favicons')

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">

        @yield('styles')

        {{-- Header Analytics --}}
        {!! \App\Analytics\Tracker::trackPageView() !!}
        {!! \App\Analytics\Tracker::headBottom() !!}
        {!! inspectlet_embed_script() !!}
    </head>

    <body class="{{ $brand }} {{ isLive() ? 'live' : '' }} {{ $bodyClass ?? '' }} {{ !empty($_COOKIE['collapsed']) ? 'sidebar-collapsed' : '' }} {{ !empty($_COOKIE['darkmode']) ? 'dark-mode' : '' }}">
        {{-- Body Analytics --}}
        {!! \Railroad\Usora\Services\ClientRelayService::getBodyTop() !!}
        {!! \App\Analytics\Tracker::bodyTop() !!}

        {{-- Content --}}
        <div id="app">
            <app-container
                :vue-router="false"
                brand="{{ $brand }}"
                :user="{{ json_encode($userData) }}"
                csrf_token="{{ csrf_token() }}"
            >
                @if(!empty(current_user()))
                    <input id="currentUserId" type="hidden" value="{{ current_user()->getId() }}">
                @endif

                <page-container
                    :is-live="{{ !empty($coachEvent) }}"
                    :playlists="{{ json_encode($pinnedPlaylists) }}" {{-- Preloaded Content --}}
                    search-url=""
                    @if(!empty( $hasUnreadNotifications ))
                        :has-notifications="{{ $hasUnreadNotifications ? 'true' : 'false' }}"
                    @endif
                >
                    <template v-cloak v-slot="slotProps">

                        @yield('breadcrumbs')
                        @yield('content')

                    </template>
                </page-container>

            </app-container>

            {{-- Review Modals Must Be Global --}}
            @include('partials._review-modal')
        </div>

        {{-- Scripts --}}
        <script src="{{ mix('platform/js/manifest.js') }}"></script>
        <script src="{{ mix('platform/js/vendor.js') }}"></script>
        <script src="{{ mix('platform/js/app.js') }}"></script>
        @yield('scripts')
        @yield('inject-components')

        {{-- Customer.io --}}
        @include('partials._customer-io')

        {{-- Helpscout Beacon --}}
        @include('partials.third-party.helpscout-tracking-beacon-script', ['email' => !empty(user()) ? user()->email : null])

        {{-- Pendo Script --}}
        <script>
            (function(apiKey){
                (p,e,n,d,o){var v,w,x,y,z;o=p[d]=p[d]||{};o._q=o._q||[];
                v=['initialize','identify','updateOptions','pageLoad','track'];for(w=0,x=v.length;w<x;++w)(function(m){
                o[m]=o[m]||function(){o._q[m===v[0]?'unshift':'push']([m].concat([].slice.call(arguments,0)));};})(v[w]);
                y=e.createElement(n);y.async=!0;y.src='https://cdn.pendo.io/agent/static/'+apiKey+'/pendo.js';
                z=e.getElementsByTagName(n)[0];z.parentNode.insertBefore(y,z);})(window,document,'script','pendo');
                pendo.initialize({
                    visitor: {
                        id: {{ user()->id }},
                    },
                    account: {
                        id: "{{ user()->email }}",
                    }
                });
            })('d376ea71-ab19-48c3-6a31-cbff42c1e64d');

        </script>

        {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
