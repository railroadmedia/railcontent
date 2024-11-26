@include($theme.'._partials.holiday-logo', [
    'styles' => 'w-auto h-10 sm:h-14',
    'isProductPage' => true,
    'productPageStyles' => 'w-auto h-10 sm:h-14 p-1'
])

<div x-data="timer()" x-init="countdown()">
    <div class="inline-flex flex-wrap mx-auto justify-center items-center">
        <div class="flex text-center border-l-2 border-white pl-4 ml-2 sm:ml-2">
            <div class="mr-2 sm:mr-3" x-show="timeLeft > 0 && day > 0">
                <div class="text-base leading-none font-extrabold" x-text="day">00</div>
                <div class="text-xs font-semibold text-{{ $theme }}" x-text="dayText">DAYS</div>
            </div>
            <div class="mr-2 sm:mr-3" x-show="timeLeft > 0">
                <div class="text-base leading-none font-extrabold" x-text="hour">00</div>
                <div class="text-xs font-semibold text-{{ $theme }}" x-text="hourText">HRS</div>
            </div>
            <div class="mr-2 sm:mr-3" x-show="timeLeft > 0">
                <div class="text-base leading-none font-extrabold" x-text="minute">00</div>
                <div class="text-xs font-semibold text-{{ $theme }}" x-text="minuteText">MIN</div>
            </div>
            <div x-show="timeLeft > 0">
                <div class="text-base leading-none font-extrabold" x-text="second">00</div>
                <div class="text-xs font-semibold text-{{ $theme }}" x-text="secondText">SEC</div>
            </div>
            <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
        </div>
    </div>
</div>