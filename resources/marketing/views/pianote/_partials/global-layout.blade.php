<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    {!! \App\Analytics\Tracker::trackPageView() !!}

    <script src="https://www.googleoptimize.com/optimize.js?id=GTM-NJR7J6C"></script>

    @yield('global-head')

    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.pianote-favicons')

    {!! \App\Analytics\Tracker::headBottom() !!}

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body @yield('body-data')>

{!! \App\Analytics\Tracker::bodyTop() !!}

@yield('global-body')
<script type="text/javascript" src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>

<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
<script type="text/javascript">
    window.Beacon('init', '8c3ddef4-7a0e-42df-8200-a650c24932ea')
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom ="50px";
    })
</script>
{!! \App\Analytics\Tracker::bodyBottom() !!}

<script type="text/javascript" src={{ asset('/marketing/js/jquery.countdown-2.min.js') }}></script>
<script>
    $(document).ready(function () {
        $('.tzcd-big').countdown('2022/12/27')
            .on('update.countdown', function (event) {
                var format = '' + '<div class="inline-block mr-2"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%M</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">min%!M</p></div> ' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%S</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">sec%!S</p></div>';
                if (event.offset.totalHours > 0) {
                    format = '' + '<div class="inline-block mx-2"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%H</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">hr%!H</p></div> ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '' + '<div class="inline-block"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">%D</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">day%!D</p></div> ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('<div class="inline-block"><h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">LIMITED</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">TIME LEFT</p></div>');
            });

        @if(Carbon\Carbon::create(2023, 2, 24, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        $('.tzcd-nppsh').countdown('2023/02/27')
            .on('update.countdown', function (event) {
                $(this).html(event.strftime('%D day%!D'));
            });
        @else
        $('.tzcd-nppsh').countdown('2023/02/27')
            .on('update.countdown', function (event) {
                var format = '' + '%M minute%!M %S second%!S ';
                if (event.offset.totalHours > 0) {
                    format = '' + '%H hour%!H ' + format;
                }
                if (event.offset.totalDays > 0) {
                    format = '' + '%D day%!D ' + format;
                }
                $(this).html(event.strftime(format));
            })
            .on('finish.countdown', function (event) {
                $(this).html('<div class="inline-block"><h2 class="font-extrabold leading-none text-lg">LIMITED</h2> <p class="leading-none uppercase font-extrabold text-xs text-promo">TIME LEFT</p></div>');
            });

        @endif
    });
</script>

<script type="text/javascript" id="inspectletjs">
    window.__insp = window.__insp || [];
    __insp.push(['wid', 563774139]);
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

</body>
</html>
