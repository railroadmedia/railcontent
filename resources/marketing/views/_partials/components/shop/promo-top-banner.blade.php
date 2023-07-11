<header class="drum-shop-header relative overflow-hidden">
    <picture>
        <source media="(min-width: 640px)" srcset="https://www.musora.com/musora-cdn/image/width=2000,quality=85/{{ $bg }}">
        <img class="absolute w-full h-full left-0 top-0 object-cover object-center" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/{{ $bg }}" alt="header background" fetchpriority="high" />
    </picture>

    <div class="container mx-auto relative z-10">
        <div>
            <img class="sm:h-32 md:h-40 lg:h-48 -mt-16 {{ $logoStyles }}" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/{{ $logo }}" alt="{{ $theme }} summer sale logo" fetchpriority="high">
            <p class="uppercase">{{ $title }}</p>
            <p class="font-extrabold text-[#FFD600] mb-4 md:mb-6">{{ $promoText }}</p>
            <div class="flex justify-center">
                <div class="rounded-xl bg-[#FFD600] inline-block" style="filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.25));" x-data="timer()" x-init="countdown()">
                    <div class="flex text-black px-4 md:px-6 py-2 md:py-3">
                        <div class="mr-6 md:mr-8" x-show="timeLeft > 0 && day">
                            <div class="text-2xl md:text-3xl font-extrabold" x-text="day">00</div>
                            <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                        </div>
                        <div class="mr-6 md:mr-8" x-show="timeLeft > 0 && hour > 0">
                            <div class="text-2xl md:text-3xl font-extrabold" x-text="hour">00</div>
                            <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                        </div>
                        <div class="mr-6 md:mr-8" x-show="timeLeft > 0">
                            <div class="text-2xl md:text-3xl font-extrabold" x-text="minute">00</div>
                            <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                        </div>
                        <div x-show="timeLeft > 0">
                            <div class="text-2xl md:text-3xl font-extrabold" x-text="second">00</div>
                            <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                        </div>
                        <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
