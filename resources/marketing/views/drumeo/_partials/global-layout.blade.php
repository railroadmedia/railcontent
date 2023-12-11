<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    {!! \App\Analytics\Tracker::trackPageView() !!}

    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-WP9MPV8"></script>

    @yield('global-head')

    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.drumeo-favicons')

    <script type="text/javascript" id="inspectletjs">
        window.__insp = window.__insp || [];
        __insp.push(['wid', 1103167167]);
        (function() {
            function ldinsp(){
                if(typeof window.__inspld != 'undefined') return;
                window.__inspld = 1;
                var insp = document.createElement('script');
                insp.type = 'text/javascript';
                insp.async = true;
                insp.id = 'inspsync';
                insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js';
                var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
            setTimeout(ldinsp, 500); document.readyState != 'complete' ? (window.attachEvent ? window.attachEvent('onload', ldinsp) : window.addEventListener('load', ldinsp, false)) : ldinsp();
        })();

        @if(!is_null(user()))
        __insp.push(['identify', '{{user()->getEmail()}}']);
        __insp.push(['tagSession', {email: '{{user()->getEmail()}}', userid: '{{user()->getId()}}'}])
        @endif
    </script>
    <script type="module">
        try {
            const response = await fetch("https://shopify-gtm-suite.getelevar.com/configs/b2934fc67ad5f4d4708f129db537a4679accfc78/config.json");
            const config = await response.json();
            const scriptUrl = config.script_src_custom_pages;

            if (scriptUrl) {
                const { handler } = await import(scriptUrl);
                await handler(config);
            }
        } catch (error) {
            console.error("Elevar Error:", error);
        }
    </script>
    {!! \App\Analytics\Tracker::headBottom() !!}
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
</head>

<body @hasSection('body-class') class="@yield('body-class')" @endif @yield('body-data')>
{!! \App\Analytics\Tracker::bodyTop() !!}

@yield('global-body')

    @include('_partials.components.countdown',[
        'countdownDate' => '2023-11-28 00:00:00',
        'promoVersion' => true
    ])

{!! \App\Analytics\Tracker::bodyBottom() !!}

<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
<script type="text/javascript">
    window.Beacon('init', '14d9d94c-d89d-42e7-93ad-15ff13964974')
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>
</body>
</html>
