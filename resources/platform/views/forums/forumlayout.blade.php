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
            >
                @if(!empty(current_user()))
                    <input id="currentUserId" type="hidden" value="{{ current_user()->getId() }}">
                @endif

                <page-container 
                    csrf_token="{{ csrf_token() }}"
                    brand="{{ $brand }}" 
                    :is-live="{{ !empty($coachEvent) }}"
                    :playlists="{{ json_encode($pinnedPlaylists) }}" {{-- Preloaded Content --}}
                    user-name="{{ user()->display_name }}"
                    user-avatar="{{ user()->profile_picture_url }}"
                    user-id="{{ user()->id }}"
                    account-url="{{ user()->getDashboardUrl() }}"
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
                t.setAttribute('data-site-id', 'fa24b9733327116040c7');
                t.setAttribute('data-use-array-params', 'true');
                t.setAttribute('data-use-in-app', 'true');
                t.src = 'https://assets.customer.io/assets/track.js';
                //If your account is in the EU, use:
                //t.src = 'https://assets.customer.io/assets/track-eu.js'
                s.parentNode.insertBefore(t, s);
            })();
        </script>

        {{-- Helpscout Beacon --}}
        @include('partials.third-party.helpscout-tracking-beacon-script', ['email' => !empty(user()) ? user()->email : null])
        
        {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
