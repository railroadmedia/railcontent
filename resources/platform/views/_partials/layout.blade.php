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

        @yield('layout-body')

        <!-- Modal Container -->
        <div id="modal-container" class="tw-z-10 tw-hidden tw-h-full tw-w-full"></div>

        <!-- Scripts -->
        @yield('layout-scripts')
        <script src="{{ mix('platform/js/app.js') }}"></script>
    </body>
</html>
