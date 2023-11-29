
<div class="big-promo-banner text-white text-center lg:text-left relative py-4" style="background: #000;">
    <div class="row container mx-auto px-3 sm:flex items-center justify-between">
        <a href="/shop/">
            @include($theme.'._partials.holiday-logo',[
                'styles' => 'w-auto h-8 sm:h-10'
            ])
        </a>
        <span class="text-center sm:text-right flex flex-wrap items-center sm:justify-end">
                <p class="text mx-auto sm:ml-0 sm:mr-3 my-2 sm:my-0 w-full sm:w-auto">
                    @if(!empty($price))
                        @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                            <strong>Save <span class="text-promo">{{ round(100 - (100 * ($price / $fullPrice))) }}%</span> on {{ $name }}</strong>
                        @elseif(!empty($specialText))
                            {!!  $specialText  !!}
                        @endif
                    @endif
                </p>
{{--                @if(empty($noCountdown))--}}

{{--                <div class="mx-auto" x-data="timer()" x-init="countdown()" x-cloak x-show="day < 2">--}}
{{--                <div class="flex text-center mx-auto sm:mx-0">--}}
{{--                        <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && day > 0">--}}
{{--                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">00</div>--}}
{{--                            <div class="text-xs font-bold text-promo" x-text="dayText">DAYS</div>--}}
{{--                        </div>--}}
{{--                        <div class="mr-3 sm:mr-4" x-show="timeLeft > 0 && hour > 0">--}}
{{--                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">00</div>--}}
{{--                            <div class="text-xs font-bold text-promo" x-text="hourText">HRS</div>--}}
{{--                        </div>--}}
{{--                        <div class="mr-3 sm:mr-4" x-show="timeLeft > 0">--}}
{{--                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">00</div>--}}
{{--                            <div class="text-xs font-bold text-promo" x-text="minuteText">MIN</div>--}}
{{--                        </div>--}}
{{--                        <div x-show="timeLeft > 0">--}}
{{--                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">00</div>--}}
{{--                            <div class="text-xs font-bold text-promo" x-text="secondText">SEC</div>--}}
{{--                        </div>--}}
{{--                        <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>--}}
{{--                    </div>--}}
{{--                    </div>--}}
{{--            @endif--}}
        </span>
    </div>
</div>

@if(!empty($noBreadcrumb))
    <div class="promo-banner text-center text-white w-full block fixed" style="background: #000;">
        <div class="noise-wrap">
            <div class="row container mx-auto">
                <div class="text text-left">
                    @include($theme.'._partials.holiday-logo',[
                        'styles' => 'logo'
                    ])
                    <p>
                        @if(!empty($price))
                            @if(round(100 - (100 * ($price / $fullPrice))) > 1)
                                <strong>Save <span class="text-promo">{{ round(100 - (100 * ($price / $fullPrice))) }}%</span> on<br> {{ $name }}</strong>
                            @elseif(!empty($specialText))
                                {!! $specialText !!}
                            @endif
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
