<section class="big-promo-banner bg-black text-white text-center relative z-10 overflow-hidden px-5 sm:px-3 lg:px-5 sm:px-8 py-8 sm:py-8 bg-cover bg-top"
style="
    @if(Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
            background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/header-bg.jpg');
    @else
        background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/november/cm-header-bg.jpg');
    @endif
">
    <div class="container mx-auto relative z-30 @if(!empty($bfVersion)) max-w-3xl @else max-w-2xl @endif">

        @if(!empty($bfVersion))
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-8 sm:h-10 mx-auto'
                ])
            </a>
            <h3 class="leading-tight my-4"><strong>{!! $text2 !!}</strong></h3>
            <div class="w-full mx-auto my-8">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close bg-black" src="//player.vimeo.com/video/{{ $vimeo }}" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <h3 class="leading-tight mb-3"><s class="opacity-60">$240</s> <strong>$150</strong> <span class="text-promo">SAVE {{ round(100 - (100 * (150 / 240))) }}%</span> </h3>
            <a class="join promo" href="{{ $orderUrl }}">GET STARTED &raquo;</a>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <div class="inline-block">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #000;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #000;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #000;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #000;color: #ffac00;" aria-hidden="true"></i>
                </div>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        @else
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-14 sm:h-16 lg:h-20 mx-auto'
                ])
            </a>
            <h5 class="leading-tight my-4"><strong>{!! $text !!}</strong></h5>
            <div class="inline-flex flex-wrap mx-auto justify-center items-center text-musora">
                <h5 class="leading-none m-0"><strong>DEALS END IN:</strong></h5>
                <div class="h-12 mx-2 sm:mx-4 bg-musora" style="width:2px;"></div>
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
            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs sm:max-w-none mt-4">
                <a class="w-full sm:w-1/2 join smaller outline promo sm:order-2" href="@if($theme === 'drumeo') /drumshop @else /shop @endif">SHOP ALL DEALS &raquo;</a>

                <div class="w-full sm:w-1/2 sm:pr-2 mt-3 sm:mt-0 relative">
                    <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN {{ strtoupper($theme) }} &raquo;</a>
                </div>
            </div>
        @endif


        @if(session()->has('error'))
            <h5 class="leading-tight my-2"><strong class="text-musora">{{ session()->get('error') }}</strong></h5>
        @endif
    </div>
</section>
