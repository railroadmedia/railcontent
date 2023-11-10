<div
        @if(!empty($bgColor))
            style="{{ $bgColor }}"
        @else
            style="background:linear-gradient(to bottom, #121531 25%, #010101);"
        @endif
>
<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
{{--        @if(empty($bgColor)) style="background:url(https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/order-bg-tile-2.png) center center/160px;" @endif --}}
>
    <div class="container mx-auto relative z-50 @if(!empty($max5)) max-w-5xl @else max-w-6xl @endif">
        <div class="w-full">
            @if(!empty($promoLogo))
                <div class="text-center">
                    <img
                            class="h-14 sm:h-16 lg:h-20 mb-6 transition-opacity opacity-0"
                            src="{{ $promoLogo }}"
                            alt="Promo logo"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                    />
                </div>
            @endif
            @if(!empty($promoHeader))
                {!! $promoHeader !!}
            @endif
            <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                    <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                        <div class=" {{--border-2 border-musora--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                            <div class="h-full w-full bg-top bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=850,quality=95/{{ $topImage }}');"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if(!empty($header))<h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>{!! $header !!}</strong></h3>@endif
            @if(!empty($subHeader))<h4 class="leading-tight mt-4 sm:mt-5 mb-2">{!! $subHeader !!}</h4>@endif
            <a class="join @if(!empty($buttonColor)) {{ $buttonColor }} @else {{ $theme }} @endif my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                @if(!empty($CTA))
                    {{ $CTA }}
                @else
                    GET Started &raquo;
                @endif
            </a>
            <p class="leading-tight text-sm mb-6"><em>First year discount: <s class="opacity-40">${{ Prices::$plusSubscriptionAnnualFull }}</s>
                    <strong>@if(!empty($firstYearPrice)) ${{$firstYearPrice}} @else ${{ 200 }}@endif</strong>.
                    <br class="inline sm:hidden"> Cancel anytime. 90-day guarantee.</em></p>
        </div>
        <div style="font-size:0px">
            @foreach($bonuses as $bonus)
                <div
                    class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
                    x-data="{
                        flipped: false,
                    }"
                    x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                >
                    <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            <div
                                x-ref="front"
                                class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                @if(!empty($bonus['badge']))
                                    <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                @endif
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url('https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }}');"></div>
                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-arrow-right text-4xl"></i><br>
                                    <p class="text-sm"><strong>DETAILS</strong></p>
                                </div>
                            </div>
                            <div
                                x-ref="back"
                                class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                style="backface-visibility: hidden;"
                            >
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="w-full leading-normal mt-2">
                        @if(!empty($bonus['title']))
                            <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                        @endif
                        <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                            <s class="opacity-40">${{ $bonus['price'] }}</s>
                            @endif
                            <strong class="text-musora">FREE</strong></span><br>
                        <em>
                            @if(!empty($bonus['shipping']))
                                Free Shipping
                            @else
                                Online Access
                            @endif
                        </em>
                    </p>
                </div>
            @endforeach
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-start my-2 sm:my-4">
                @if($theme !== 'drumeo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/drumeo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/drumeo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">DRUM LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'pianote')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/pianote-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/pianote-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">PIANO LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'guitareo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/guitareo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/guitareo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">GUITAR LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'singeo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/assets/singeo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">SINGING LESSONS INCLUDED</p>
                    </div>
                @endif
            </div>
        </div>
        <h3 class="leading-tight mt-6 mb-1">
            <s class="opacity-50">${{ Prices::$plusSubscriptionAnnualFull }}</s>
            @if(!empty($firstYearPrice)) <strong>${{$firstYearPrice}}</strong> <span class="text-musora">(Save {{ round(100 - (100 * ($firstYearPrice / 240))) }}%)</span>  @else <strong>$200</strong> <span class="text-musora">(Save 20%)</span>  @endif

        </h3>
        <p class="text-sm mb-4 sm:mb-6">For your first year, then ${{ Prices::$plusSubscriptionAnnualFull }}/yr.</p>
        <a class="join @if(!empty($buttonColor)) {{ $buttonColor }} @else {{ $theme }} @endif mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
            @if(!empty($CTA))
                {{ $CTA }}
            @else
                GET Started &raquo;
            @endif
        </a>
        @if(!empty($altButtonLink))
            <br>
            <a class="inline-block opacity-70 mt-2" href="{{ $altButtonLink }}"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)</em></u></p></a>
        @endif
    </div>
</section>
</div>
