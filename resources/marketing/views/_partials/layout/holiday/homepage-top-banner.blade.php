<section class="big-promo-banner text-white text-center relative z-10 overflow-hidden px-5 sm:px-3 lg:px-5 sm:px-8 py-6 sm:py-12 bg-cover bg-top"

{{--    style="background-image:@if(!empty($bg)) {{ $bg }} @else url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/header-bg.webp') @endif ";--}}
    style="background:linear-gradient(to bottom, #010305, #042b50);"
>
    <div class="container mx-auto relative z-30 max-w-lg">

            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-12 sm:h-14 lg:h-24 mx-auto'
                ])
            </a>
            <h5 class="leading-tight my-4">{!! $text !!}</h5>

            <div x-data="timer()" x-init="countdown()"
{{--                x-cloak x-show="day < 2"--}}
            >
                <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                    <h5 class="leading-none m-0"><strong>DEALS END IN:</strong></h5>
                    <div class="h-12 mx-2 sm:mx-4 bg-white" style="width:2px;"></div>
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

            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs sm:max-w-none mt-4">
                <a class="w-full sm:w-1/2 join musora smaller outline sm:order-2 border-musora" href="@if($theme === 'drumeo') /drumshop @else /shop @endif">SHOP ALL DEALS &raquo;</a>

                <div class="w-full sm:w-1/2 sm:pr-2 mt-3 sm:mt-0 relative">
                    <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN {{ strtoupper($theme) }} &raquo;</a>
                </div>
            </div>

        @if(session()->has('error'))
            <h5 class="leading-tight my-2"><strong class="text-musora">{{ session()->get('error') }}</strong></h5>
        @endif

    </div>
{{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</section>
