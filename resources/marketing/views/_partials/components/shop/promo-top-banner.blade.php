<header class="text-white text-center relative z-10 overflow-hidden px-5 sm:px-6 py-6 sm:py-10 lg:py-14" style="background-color:#141535;">
    <div class="container mx-auto relative z-30 max-w-2xl">
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-8 sm:h-10 mx-auto'
                ])
            </a>
            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-6xl my-1.5">
                <strong>{{ $theme }} SHOP</strong>
            </h1>
            <h5 class="leading-tight mb-4"><strong>{!! $text !!}</strong></h5>
            <div x-data="timer()" x-init="countdown()" x-cloak x-show="day < 2">
                <div class="inline-flex flex-wrap mx-auto justify-center items-center text-musora">
                    <h5 class="leading-none m-0"><strong>DEALS END IN:</strong></h5>
                    <div class="h-12 mx-4 bg-musora" style="width:2px;"></div>
                    <div class="flex">
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day > 0">
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
    </div>
    @if(Carbon\Carbon::create(2023, 11, 28, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        <div class="inset-0 inline-block lg:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg-m2.jpg');"></div>
        <div class="inset-0 hidden lg:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg2.jpg');"></div>
    @else
        <div class="inset-0 inline-block lg:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg-m2.jpg');"></div>
        <div class="inset-0 hidden lg:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg2.jpg');"></div>
    @endif

</header>
