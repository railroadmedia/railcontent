<!DOCTYPE html>
<html lang="en">
<head>

    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    @yield('meta')
    @yield('global-head')

    {!! \App\Analytics\Tracker::trackPageView() !!}

    @include('guitareo._partials.google-optimize')
    @include('guitareo._partials.inspectlet')

    @include('_partials.layout.favicons.guitareo-favicons')
    @include('_partials.layout._fonts')

    @yield('styles')
    @yield('page-styles')

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body class="@yield('body-class')" @yield('body-data')>

{!! \App\Analytics\Tracker::bodyTop() !!}

    @yield('global-body')

    @yield('navigation')

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @yield('scripts')

    <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
    <script type="text/javascript">
        window.Beacon('init', '157f182f-3d4d-4cb7-8f8d-805f0b3e4fa4')
        Beacon('on', 'ready', () => {
            document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
        })
    </script>
    {!! \App\Analytics\Tracker::bodyBottom() !!}
</body>
</html>
