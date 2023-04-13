<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
    </head>

    <body class="flex flex-col w-full min-h-screen pt-[40px] lg:pt-[56px] @yield('body-class')"
          x-data="{ sidebarOpen: false, showOverlay: false }"
    >
        {!! \App\Analytics\Tracker::bodyTop() !!}

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
</html>
