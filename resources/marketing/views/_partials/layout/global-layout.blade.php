<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {!! \App\Analytics\Tracker::headTop() !!}


        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        <!-- Icons -->
        <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">
        <link rel="stylesheet" href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css">
        <!-- Favicons -->
        @include('_partials.layout.favicons.musora-favicons')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">

        @yield('head-includes')
        {!! \App\Analytics\Tracker::trackPageView() !!}

        {!! \App\Analytics\Tracker::headBottom() !!}
    </head>

    <body class="flex flex-col w-full min-h-screen lg:pt-[56px] @yield('body-class')" 
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

        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

         @yield('layout-scripts')
        {!! \App\Analytics\Tracker::bodyBottom() !!}
    </body>
</html>
