<header class="text-white text-center relative z-10 overflow-hidden px-5 sm:px-6 py-6 sm:py-10 lg:py-14" style="background-color:#141535;">
    <div class="container mx-auto relative z-30 max-w-2xl">
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-10 sm:h-14 mx-auto'
                ])
            </a>
            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-6xl my-1.5">
                <strong>{{ $theme }} SHOP</strong>
            </h1>
            <h5 class="leading-tight mb-4"><strong>{!! $text !!}</strong></h5>

    </div>
    @if(Carbon\Carbon::create(2023, 11, 28, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        <div class="inset-0 inline-block lg:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg-m2.jpg');"></div>
        <div class="inset-0 hidden lg:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg2.jpg');"></div>
    @else
        <div class="inset-0 inline-block lg:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg-m2.jpg');"></div>
        <div class="inset-0 hidden lg:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg2.jpg');"></div>
    @endif

</header>
