<a href="#orderNow"
   class="anchor-slide promo-banner bg-musora text-black block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap shadow-md py-1 z-40 mx-auto -mt-12 text-xs">
    <div class="container mx-auto relative">
        <div class="inline-block align-middle text-center">
            <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                <h6 class="leading-none m-0"><strong class="font-black">DEALS END IN:</strong></h6>
                <div class="h-8 mx-2 sm:mx-4 bg-black" style="width:2px;"></div>
                <div class="flex"  x-data="timer()" x-init="countdown()">
                    <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && day">
                        <div class="leading-none text-2xl font-extrabold" x-text="day">00</div>
                        <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                    </div>
                    <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && hour > 0">
                        <div class="leading-none text-2xl font-extrabold" x-text="hour">00</div>
                        <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                    </div>
                    <div class="mr-3 sm:mr-4" x-show="timeLeft > 0">
                        <div class="leading-none text-2xl font-extrabold" x-text="minute">00</div>
                        <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                    </div>
                    <div x-show="timeLeft > 0">
                        <div class="leading-none text-2xl font-extrabold" x-text="second">00</div>
                        <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                    </div>
                    <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                </div>
            </div>
        </div>
    </div>
</a>
