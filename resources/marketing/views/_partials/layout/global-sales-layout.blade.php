<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    {!! \App\Analytics\Tracker::trackPageView() !!}

    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-WP9MPV8"></script>

    @yield('global-head')

    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body @hasSection('body-class') class="@yield('body-class')" @endif x-data="{ sidebarOpen: false, showOverlay: false }">

    {!! \App\Analytics\Tracker::bodyTop() !!}

    @yield('layout-header')

    <main class="flex flex-col w-full min-h-screen" @yield('body-data')>
        @yield('global-body')
    </main>

    @yield('layout-footer')

    {!! \App\Analytics\Tracker::bodyBottom() !!}

    <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>

    <script type="text/javascript">
        window.Beacon('init', '14d9d94c-d89d-42e7-93ad-15ff13964974')
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
        });
    </script>

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
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
</body>
</html>
