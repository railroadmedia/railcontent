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
                    brand="{{ $brand }}" 
                    :is-live="false" 
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
        </div>

        {{-- Review Modals Must Be Global --}}
        @if($brand === 'singeo')
            @include('partials._review-modal-singeo')
        @endif
        @if($brand === 'guitareo')
            @include('partials._review-modal-guitareo')
        @endif
        @if($brand === 'drumeo' || $brand === 'pianote')
            @include('partials._review-modal')
        @endif

        {{-- Scripts --}}
        <script src="{{ mix('platform/js/app.js') }}"></script>
        @yield('scripts')
        @yield('inject-components')

        {{-- @include('helpscout::helpscout-tracking-beacon-script', ['email' => !empty(current_user()) ? current_user()->getEmail() : null]) --}}
        <script type="text/javascript">
            Beacon('on', 'ready', () => {
                document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
            })
        </script>
        {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
