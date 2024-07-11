<header class="text-white text-center relative z-10 overflow-hidden  sm:px-6
@if($theme === 'drumeo' || $theme === 'pianote')
    py-6 sm:pb-12
@else
    py-6 sm:py-12 lg:py-16
@endif
" {{--style="background-color:#141535;"--}}>
    <div class="container mx-auto relative z-30 max-w-lg">
        @if($theme === 'drumeo' || $theme === 'pianote')

@if($theme === 'drumeo')
    <img class="w-auto h-16 sm:h-24 lg:h-28 mb-3 sm:mb-6" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-logo-text-only.webp">
    <img class="h-80 absolute right-0 top-0 hidden sm:block translate-x-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-hand-icon.webp">
@elseif($theme === 'pianote')
    <img class="w-auto h-16 sm:h-24 lg:h-28 mb-3 sm:mb-6" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-summer-logo-text-only.webp">
    <img class="h-80 absolute right-0 top-0 hidden sm:block translate-x-full" 
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-summer-sun-icon.webp" 
        alt="Sun Icon">
@endif


            {{--            <div class="flex items-center justify-center">--}}
{{--                <img class="{{ $shopStyles }}"--}}
{{--                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-summer-logo-text-only.webp">--}}
{{--                <img class="{{ $shopStyles }}"--}}
{{--                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-summer-sun-icon.webp">--}}
{{--            </div>--}}

{{--            @if(!empty($logo))--}}
{{--                <img src="{{ $logo }}" alt="Drumeo" class=" @if(!empty($logoStyles)) {{ $logoStyles }} @endif mx-auto">--}}
{{--            @endif--}}
{{--            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-6xl mb-1">--}}
{{--                <strong>DRUM SHOP</strong>--}}
{{--            </h1>--}}
            <h5 class="leading-tight mb-4 uppercase">{!! $text !!}</h5>

            <div x-data="timer()" x-init="countdown()">
                <div class="inline-flex flex-wrap mx-auto justify-center items-center text-[#00101D] bg-[#FFD600] rounded-xl p-4">
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
    </div>
    <div class="inset-0 inline-block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $bg }}');"></div>
    <div class="inset-0 hidden sm:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/{{ $bg }}');"></div>
{{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</header>
