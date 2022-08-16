<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

        @yield('head-includes')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    </head>

    <body class="flex flex-col w-full min-h-screen lg:pt-[56px]" x-data="{ sidebarOpen: false, showOverlay: false }">

        @yield('layout-header')

        <main class="flex-1" @yield('body-data')>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-304523-137"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-304523-137');
        </script>
        <script src="{{ mix('marketing/js/app.js') }}"></script>
         @yield('layout-scripts')
    </body>
</html>
