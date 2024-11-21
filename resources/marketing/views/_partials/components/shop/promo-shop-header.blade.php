<header class="text-white text-center relative z-10 overflow-hidden  sm:px-6
@if($theme === 'drumeo' || $theme === 'pianote')
    py-6 sm:pb-12
@else
    py-6 sm:py-12 lg:py-16
@endif
" {{--style="background-color:#141535;"--}}>
    <div class="container mx-auto relative z-30 max-w-md md:max-w-lg">
        @if($theme === 'drumeo' || $theme === 'pianote')
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-16 sm:h-24 lg:h-28 mx-auto'
                ])
            </a>
            <h5 class="leading-tight my-4 sm:my-5">{!! $text !!}</h5>

            <div x-data="timer()" x-init="countdown()" {{--x-cloak x-show="day < 8"--}}>
                <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                                        <h5 class="leading-none m-0"><strong>DEALS END IN:</strong></h5>
                                        <div class="h-12 mx-4 bg-[#00101D]" style="width:2px;"></div>
                    <div class="flex">
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">0</div>
                            <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                        </div>
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && hour > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">0</div>
                            <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                        </div>
                        <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">0</div>
                            <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                        </div>
                        <div x-show="timeLeft > 0">
                            <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">0</div>
                            <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                        </div>
                        <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                    </div>
                </div>
            </div>
        @else
            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-7xl mb-2">
                <strong>
                    @if(!empty($logo))
                        <img src="{{ $logo }}" alt="Drumeo" class=" @if(!empty($logoStyles)) {{ $logoStyles }} @endif mx-auto">
                    @else
                        <span class="text-{{ $theme }}">{{ $theme }}</span>
                    @endif
                    SHOP</strong>
            </h1>
            <h5 class="leading-tight mb-4 uppercase">{!! $text !!}</h5>
        @endif
        @if(!empty($badge))
            <img class="h-14 sm:h-24 lg:h-28 -mr-2 sm:mr-0 -mt-4 sm:-mt-8 absolute top-0 right-0 z-10 transform sm:translate-x-full" src="{{ $badge }}">
        @endif
    </div>
    <div class="inset-0 inline-block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $bg }}');"></div>
    <div class="inset-0 hidden sm:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/{{ $bg }}');"></div>
    {{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</header>
