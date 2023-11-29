<a href="#orderNow"
   class="anchor-slide promo-banner bg-musora text-black block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap shadow-md py-1 z-40 mx-auto -mt-12 text-xs">
    <div class="container mx-auto relative">
        <div class="inline-block align-middle text-center">
            <div class="inline-block align-middle mr-2">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-5 sm:h-8 mx-auto'
                ])
            </div>
            <p class="inline-block leading-tight align-middle text-left"><strong class="font-black">{!! $text !!}</strong></p>
            <div x-data="timer()" x-init="countdown()" x-cloak x-show="day < 2">
            <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                <h6 class="leading-none m-0"><strong class="font-black">DEALS END IN:</strong></h6>
                <div class="h-8 mx-2 sm:mx-4 bg-black" style="width:2px;"></div>
                <div class="flex">
                    <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && day > 0">
                        <div class="leading-none sm:leading-none text-xl sm:text-2xl font-extrabold" x-text="day">00</div>
                        <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                    </div>
                    <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && hour > 0">
                        <div class="leading-none sm:leading-none text-xl sm:text-2xl font-extrabold" x-text="hour">00</div>
                        <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                    </div>
                    <div class="mr-3 sm:mr-4" x-show="timeLeft > 0">
                        <div class="leading-none sm:leading-none text-xl sm:text-2xl font-extrabold" x-text="minute">00</div>
                        <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                    </div>
                    <div x-show="timeLeft > 0">
                        <div class="leading-none sm:leading-none text-xl sm:text-2xl font-extrabold" x-text="second">00</div>
                        <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                    </div>
                    <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                </div>
            </div>
            </div>
        </div>
    </div>
</a>
