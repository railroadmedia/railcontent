<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

        @yield('head-includes')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    </head>

    <body class="flex flex-col w-full min-h-screen" x-data="{ sidebarOpen: false, showOverlay: false }">

        @yield('layout-header')

        <main class="flex-1">
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

        <!-- Scripts -->
        @yield('layout-scripts')
        <script src="{{ mix('marketing/js/app.js') }}"></script>

    </body>
</html>
