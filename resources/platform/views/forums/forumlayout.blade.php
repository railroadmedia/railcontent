<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}
        {{-- Meta --}}
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
        @include('partials._svg-icons')

        {{-- Styles --}}
        {{-- <link rel="stylesheet" href="{{ mix('assets/members/css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
        @yield('styles')

        @include('partials._favicons')

        {{-- Header Analytics --}}
        {!! \App\Analytics\Tracker::trackPageView() !!}
        {!! \App\Analytics\Tracker::headBottom() !!}
        {!! inspectlet_embed_script() !!}
    </head>

    <body class="singeo {{ isLive() ? 'live' : '' }} {{ $bodyClass ?? '' }} {{ !empty($_COOKIE['collapsed']) ? 'sidebar-collapsed' : '' }} {{ !empty($_COOKIE['darkmode']) ? 'dark-mode' : '' }}">
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
                    :is-live="true" 
                    :has-notifications="true"
                    user-name=""
                    user-avatar=""
                    account-url=""
                    search-url=""
                >   
                    @yield('breadcrumbs')
                    @yield('content')
                    
                </page-container>
                
            </app-container>
        </div>

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
