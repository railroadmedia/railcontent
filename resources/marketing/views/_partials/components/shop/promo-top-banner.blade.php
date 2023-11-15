<header class="text-white text-center relative z-10 overflow-hidden px-5 sm:px-6 py-10 sm:py-12 bg-cover bg-top"
    style="
    @if(Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
            background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/header-bg.jpg');
    @else
        background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg.jpg');
    @endif
">
    <div class="container mx-auto relative z-30 max-w-2xl">
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-8 sm:h-10 mx-auto'
                ])
            </a>
            <h1 class="uppercase leading-none sm:leading-none text-5xl sm:text-6xl mt-2">
                <strong>{{ $theme }} SHOP</strong>
            </h1>
            <h5 class="leading-tight my-4"><strong>{!! $text !!}</strong></h5>
            <div class="inline-flex flex-wrap mx-auto justify-center items-center text-musora">
                <h5 class="leading-none m-0"><strong>DEALS END IN:</strong></h5>
                <div class="h-12 mx-4 bg-musora" style="width:2px;"></div>
                <div class="flex"  x-data="timer()" x-init="countdown()">
                    <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day">
                        <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">00</div>
                        <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                    </div>
                    <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && hour > 0">
                        <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">00</div>
                        <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                    </div>
                    <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                        <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">00</div>
                        <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                    </div>
                    <div x-show="timeLeft > 0">
                        <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">00</div>
                        <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                    </div>
                    <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                </div>
            </div>
    </div>
</header>
