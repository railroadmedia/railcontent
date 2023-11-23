<!DOCTYPE html>
<html lang="en">
    <head>

        {!! \App\Analytics\Tracker::headTop() !!}

        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">

        @yield('meta')

        {!! \App\Analytics\Tracker::trackPageView() !!}

        @include('guitareo._partials.google-optimize')
        @include('guitareo._partials.inspectlet')

        @include('_partials.layout.favicons.guitareo-favicons')
        @include('_partials.layout._fonts')

        <!-- tailwind -->
        @include('_partials.layout._tailwindcdn')

        @yield('styles')
        <style>
            .big-promo-banner{z-index:98;}.big-promo-banner .text-right{flex-grow:1}.big-promo-banner h1.logo{color:#000;margin:0 auto;font-size:25px}@media (min-width:768px){.big-promo-banner h1.logo{font-size:28px}}@media (min-width:991px){.big-promo-banner h1.logo{font-size:35px}}.big-promo-banner p.text{font:400 17px/1.2em Open Sans,sans-serif;display:inline-block;}@media (min-width:768px){.big-promo-banner p.text{font-size:16px}}@media (min-width:991px){.big-promo-banner p.text{font-size:18px;white-space:nowrap}}.big-promo-banner p.text strong{display:inline-block}
            .promo-banner-shim{display:block;width:100%;height:40px}
            .promo-banner{transition:opacity .5s;overflow:hidden;position:relative;font:400 13px/1em Open Sans,sans-serif;box-shadow:0 0 10px rgba(0,0,0,.2);white-space:nowrap;z-index:1;margin:-40px auto 0}.promo-banner .noise-wrap{padding:6px 0}.promo-banner.fixed{top:40px;position:fixed;z-index:97;margin:0 auto}@media (min-width:768px){.promo-banner.fixed{top:56px}}.promo-banner:active,.promo-banner:focus,.promo-banner:hover{color:white;text-decoration:none}.promo-banner .row{position:relative;padding:0}.promo-banner .logo{display:inline-block;vertical-align:middle;width:auto;margin-right:10px;height:19px}@media (min-width:768px){.promo-banner .logo{height:28px}}.promo-banner h1{font-family:Oswald,sans-serif;display:inline-block;vertical-align:middle;margin-right:7px;font-size:19px}@media (min-width:768px){.promo-banner h1{margin-right:10px;font-size:25px}}.promo-banner .text,.promo-banner p{display:inline-block;vertical-align:middle}.promo-banner p{font:400 13px/1.1em Open Sans,sans-serif;margin:0 auto}.promo-banner p strong{font-weight:900}.promo-banner .join{outline:none;padding:6px 15px;font-size:12px;margin:3px 0 0}@media (min-width:768px){.promo-banner .join{font-size:13px;margin:0 0 0 7px}}
        </style>

        {!! \App\Analytics\Tracker::headBottom() !!}
    </head>

    <body x-data="{ 'levelMap': false, 'modalOpen': false, 'levelModalOpen':false }"
        x-on:keydown.escape="modalOpen = false; document.querySelector('#intro-video').src = 'https://player.vimeo.com/video/495874785?title=0&byline=0&portrait=0'"
        x-bind:class="{ 'overflow-hidden': modalOpen || levelModalOpen }"
    >

    {!! \App\Analytics\Tracker::bodyTop() !!}

        @yield('navigation')

        @yield('content')

    @if(Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        @include('_partials.components.countdown',[
            'countdownDate' => '2023-11-27 00:00:00',
            'promoVersion' => true
        ])
    @else
        @include('_partials.components.countdown',[
            'countdownDate' => '2023-11-28 00:00:00',
            'promoVersion' => true
        ])

    @endif
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
