<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="border: none !important;">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

        @include('_partials.layout._fonts')
        <!-- Favicons -->
        @include('_partials.layout.favicons.musora-favicons')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
        <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">

        @yield('head-includes')

        {!! \App\Analytics\Tracker::trackPageView() !!}

        {!! \App\Analytics\Tracker::headBottom() !!}
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>

        <script>
            window.Laravel = {
                sanityProjectId: @json(config('app.sanity_project_id')),
                sanityApiToken: @json(config('app.sanity_api_token')),
                sanityDataset: @json(config('app.sanity_dataset')),
                mcsDebug: @json(config('app.mcs_debug'))
            };
        </script>

        @if(!empty($hotjar))
            @include('_partials.layout._hotjar', [
                "hjid" => "musora"
            ])
        @endif
    </head>

    <body class="flex flex-col w-full min-h-screen pt-[40px] md:pt-[56px] @yield('body-class')"
        x-data="{ sidebarOpen: false, showOverlay: false }"
        @yield('body-data')
    >
        {!! \App\Analytics\Tracker::bodyTop() !!}

        {{-- Notifications Container --}}
        <div id="notifications-container"></div>

        {{-- Dropdowns Container --}}
        <div id="dropdowns-container"></div>

        {{-- Modal Container --}}
        <div role="dialog" aria-labelledby="dialog-modal" aria-describedby="dialog-modal-container" id="modal-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full" tabindex="0"></div>

        <!-- Confirmation Modal Container -->
        <div id="confirmation-container" class="tw-z-[150] tw-hidden tw-h-full tw-w-full"></div>

        @yield('layout-header')

        <main id="app" class="flex-1" @yield('body-data')>
            @yield('global-layout-body')
        </main>

        @yield('layout-footer')

        <!-- Overlay -->
        <div id="page-overlay"
             x-cloak
             x-transition.opacity.duration.200ms
             x-show="showOverlay"
             x-on:click="showOverlay = !showOverlay, sidebarOpen = !sidebarOpen"
             x-bind:class="{ 'fixed h-screen w-screen z-30 bg-black bg-opacity-20': showOverlay }"
        ></div>

         @yield('layout-scripts')
        {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
     @stack('player-scripts')
</html>
