<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

        @yield('head-includes')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">

        @include('_partials.snippets.favicons')
    </head>

    <body class="flex flex-col w-full min-h-screen">

        <main id="app" class="flex-1">

            @yield('layout-body')

        </main>

        <!-- Scripts -->
        @yield('layout-scripts')
        <script src="{{ mix('platform/js/app.js') }}"></script>
    </body>
</html>
