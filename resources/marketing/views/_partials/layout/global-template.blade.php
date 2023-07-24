<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @yield('meta')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-WP9MPV8"></script>

    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.'.$theme.'-favicons')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">

    @yield('layout-styles')

<!-- Begin Inspectlet Embed Code -->
    <script type="text/javascript" id="inspectletjs">
        (function() {
            window.__insp = window.__insp || [];
            __insp.push(['wid', 1103167167]);
            var ldinsp = function(){ if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js?wid=1103167167&r=' + Math.floor(new Date().getTime()/3600000); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
            setTimeout(ldinsp, 0);
        })();
    </script>
    <!-- End Inspectlet Embed Code -->

    {!! \App\Analytics\Tracker::headBottom() !!}

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
</head>

<body @hasSection('body-class') class="@yield('body-class')" @endif x-data="{ sidebarOpen: false, showOverlay: false }">

{!! \App\Analytics\Tracker::bodyTop() !!}

@yield('layout-header')

<main class="flex flex-col w-full @yield('main-class')" @yield('body-data')>

    @yield('layout-body')
</main>

@yield('layout-footer')

{!! \App\Analytics\Tracker::bodyBottom() !!}

<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>

<script type="text/javascript">
    window.Beacon('init', '@php
        if($theme === 'drumeo'){ echo '14d9d94c-d89d-42e7-93ad-15ff13964974'; }
        elseif($theme === 'pianote'){ echo '8c3ddef4-7a0e-42df-8200-a650c24932ea'; }
        elseif($theme === 'guitareo'){ echo '157f182f-3d4d-4cb7-8f8d-805f0b3e4fa4'; }
        elseif($theme === 'singeo'){ echo '82b3c165-0840-4f45-aaeb-4775857c4b91'; }
    @endphp')
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>

@yield('layout-scripts')

<!-- Overlay -->
<div id="page-overlay"
     class="top-0 left-0"
     x-cloak
     x-transition.opacity.duration.200ms
     x-show="showOverlay"
     x-on:click="showOverlay = !showOverlay, sidebarOpen = !sidebarOpen"
     x-bind:class="{ 'fixed h-screen w-screen z-30 bg-black bg-opacity-20': showOverlay }"
></div>
<!-- Alpine -->
</body>
</html>
