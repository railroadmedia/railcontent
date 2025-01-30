<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">

    @yield('meta')

    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">

    @yield('styles')
</head>

<body class="">
    <!-- Analytics scripts should live outside of #app -->
    <div id="app">
        @yield('breadcrumbs')

        @yield('content')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>

    @yield('scripts')

</body>
</html>
