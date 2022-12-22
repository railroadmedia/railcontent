<!DOCTYPE html>
<html lang="en">
    <head>

        {!! \App\Analytics\Tracker::headTop() !!}

        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">

        @yield('meta')

        {!! \App\Analytics\Tracker::trackPageView() !!}

        @include('guitareo._partials.includes.google-optimize')
        @include('guitareo._partials.inspectlet')

        @include('_partials.layout.favicons.guitareo-favicons')
        @include('guitareo._partials._fonts')

        <!-- tailwind -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

        @yield('styles')

        {!! \App\Analytics\Tracker::headBottom() !!}
    </head>

    <body x-data="{ 'levelMap': false, 'modalOpen': false, 'levelModalOpen':false }"
        x-on:keydown.escape="modalOpen = false; document.querySelector('#intro-video').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'"
        x-bind:class="{ 'overflow-hidden': modalOpen || levelModalOpen }"
    >

    {!! \App\Analytics\Tracker::bodyTop() !!}

        @yield('navigation')

        @yield('content')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

        @yield('scripts')

        @include('helpscout::helpscout-tracking-beacon-script', ['email' => !is_null(user()) ? user()->getEmail() : null])
        <script type="text/javascript">
            Beacon('on', 'ready', () => {
                document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
            })
        </script>
        {!! \App\Analytics\Tracker::bodyBottom() !!}

    </body>
</html>
