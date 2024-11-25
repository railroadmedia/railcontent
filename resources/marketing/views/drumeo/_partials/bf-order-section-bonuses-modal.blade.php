@php
    switch ($bundle) {
        case 'kit':
            $borderColor = 'border-[#5FB2FF]';
            $textColor = 'text-[#5FB2FF]';
            $bundlePrice = '<s class="opacity-50"> $1474</s><strong> $599</strong> <span class="text-[#5FB2FF] text-xl md:text-3xl">(Save 59%)</span>';
            break;
        case 'ultimate':
            $borderColor = 'border-[#FF6F00]';
            $textColor = 'text-[#FF6F00]';
            $bundlePrice = '<s class="opacity-50"> $1747.90</s><strong> $799</strong> <span class="text-[#FF6F00] text-xl md:text-3xl">(Save 54%)</span>';
            break;
        case 'practice':
            $borderColor = 'border-[#FF0055]';
            $textColor = 'text-[#FF0055]';
            $bundlePrice = '<s class="opacity-50"> $1227.87</s><strong> $399</strong> <span class="text-[#FF0055] text-xl md:text-3xl">(Save 68%)</span>';
            break;
        case 'gift':
            $borderColor = 'border-[#41F70F]';
            $textColor = 'text-[#41F70F]';
            $bundlePrice = '<s class="opacity-50"> $349</s><strong> $240</strong> <span class="text-[#41F70F] text-xl md:text-3xl">(Save 31%)</span>';
            break;
        case 'challenge':
            $borderColor = 'border-[#CF03DA]';
            $textColor = 'text-[#CF03DA]';
            $bundlePrice = '<s class="opacity-50"> $381</s><strong> $127</strong> <span class="text-[#CF03DA] text-xl md:text-3xl">(Save 67%)</span><br><p class="text-sm">No recurring payments.</p>';
            break;
        case 'deal':
            $borderColor = 'border-[#FFAC00]';
            $textColor = 'text-[#FFAC00]';
            $bundlePrice = '<s class="opacity-50"> $240</s><strong> $140</strong> <span class="text-[#FFAC00] text-xl md:text-3xl">(Save 42%)</span><br><p class="text-sm">For your first year, then $240/yr.</p>';
            break;
        case 'challenges-pianote':
            $borderColor = 'border-[#CF03DA]';
            $textColor = 'text-[#CF03DA]';
            $bundlePrice = '<s class="opacity-50"> $381</s><strong> $127</strong> <span class="text-[#CF03DA] text-xl md:text-3xl">(Save 67%)</span><br><p class="text-sm">No recurring payments.</p>';
            break;
        case 'book':
            $borderColor = 'border-[#7E56FF]';
            $textColor = 'text-[#7E56FF]';
            $bundlePrice = '<s class="opacity-50"> $1321</s><strong> $399</strong> <span class="text-[#7E56FF] text-xl md:text-3xl">(Save 70%)</span>';
            break;
        default:
            $borderColor = 'border-none';
            $textColor = 'text-white';
            $bundlePrice = '<s class="opacity-50"> $240</s><strong> $200</strong> <span class="text-white text-xl md:text-3xl">(Save 17%)</span><br><p class="text-sm">For your first year, then $240/yr.</p>';
            break;
    }

        $filteredBonuses = collect($bonuses)
        ->filter(function ($bonuse) use ($targetSkus) {
            return in_array($bonuse['sku'], $targetSkus, true);
        })
        ->sortBy(function ($bonuse) use ($targetSkus) {
            return array_search($bonuse['sku'], $targetSkus);
        })
        ->values();
@endphp

    <div
        @if(!empty($bgColor))
            style="{{ $bgColor }}"
        @else
            style="background:linear-gradient(30deg, #0a3761, #0c1526);"
        @endif
    >
        <section class="py-14 sm:py-16 md::py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
                @if(empty($bgColor))
                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                :style="`background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/pianote/membership/homepage/2024/order-bg-tile-2.webp') center center/160px;`" @endif
                x-intersect.once="lazyLoad = true">
            <div class="container mx-auto relative z-50 @if(!empty($maxWidth)) {{ $maxWidth }} @else max-w-6xl @endif">
                <div class="w-full">
                    @if(!empty($promoLogo))
                        <div class="text-center">
                            <img
                                    class="{{$logoHeight}} mb-6 transition-opacity opacity-0"
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

                    <div class="mx-auto px-1 md:px-3 w-full @if(!empty($secondImage)) md:max-w-3xl @else md:max-w-sm @endif">
                        <div class="inline-block w-full group">
                            <div class="text-center flex flex-col md:flex-row md:justify-center space-y-4 md:space-y-0 md:space-x-4">
                                @if(!empty($topImage))
                                <div class="flex-1 relative overflow-hidden rounded-xl">
                                    <div class="aspect-[18/10] relative">
                                        <div class="absolute inset-0">
                                            <div class="w-full h-full rounded-xl shadow-lg overflow-hidden">
                                                <picture class="block w-full h-full"
                                                        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                        x-intersect.once="lazyLoad = true">
                                                    <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $topImage }}"
                                                            media="(min-width: 640px)">
                                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $topImage }}"
                                                        alt="Top Image"
                                                        class="w-full h-full object-cover transition-opacity duration-300"
                                                        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                        loading="lazy">
                                                </picture>
                                            </div>
                                        </div>
                                    </div>
                                    @if($bundle == 'deal')
                                        <p class="w-full leading-normal mt-2 uppercase text-xl"> <span><s class="opacity-60">$240</s></span><strong> $140</strong></p>
                                    @else
                                    <p class="opacity-60 w-full leading-normal mt-2 uppercase"> $240 Value</p>
                                    @endif
                                </div>
                                @endif

                                @if(!empty($secondImage))
                                <div class="flex-1 relative overflow-hidden rounded-xl">
                                    <div class="aspect-[18/10] relative cursor-pointer" style="perspective: 1000px;">
                                        <div class="absolute inset-0" style="transform-style: preserve-3d;">
                                            <div x-ref="secondFront"
                                                class="absolute w-full h-full transition-transform duration-700"
                                                style="backface-visibility: hidden;">
                                                <div class="w-full h-full rounded-xl border-2 shadow-lg overflow-hidden {{ $borderColor }}">
                                                    <picture class="block w-full h-full"
                                                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                            x-intersect.once="lazyLoad = true">
                                                        <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $secondImage }}"
                                                                media="(min-width: 640px)">
                                                        <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $secondImage }}"
                                                            alt="Second Image"
                                                            class="w-full h-full object-cover transition-opacity duration-300"
                                                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                            loading="lazy">
                                                    </picture>
                                                </div>
                                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                                    <i class="fas fa-play play-button autoplay-video hover:opacity-80 border-4 border-solid border-white rounded-full cursor-pointer mt-24 mb-12 text-3xl py-4 px-5 md:py-6 md:px-7 md:mt-40 md:mb-24 md:text-4xl duration-300" style="background:rgba(0, 0, 0, 0.6);"></i><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="opacity-70 w-full leading-normal mt-2 uppercase">@if($theme == 'drumeo') $599 Value @elseif($theme == 'pianote') $259 Value @endif</p>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                     <div class="@if($bundle == 'challenge' || $bundle == 'challenges-pianote') hidden @endif">
                        <h2 class="leading-tight mt-6 mb-1 md:hidden">
                        {!!$bundlePrice!!}
                        </h2>
                            <a class="join md:hidden @if(!empty($buttonColor)) {{ $buttonColor }} @else {{ $theme }} @endif my-4 md:my-6 w-full sm:max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}" aria-label="Get Started">
                                @if(!empty($CTA))
                                    {{ $CTA }}
                                @else
                                    GET the deal <i class="fas fa-arrow-right"></i>
                                @endif
                            </a>


                        </div>
                    </div>
                    <br>
                    @if(!empty($header))<h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>{!! $header !!}</strong></h3>@endif
                    @if(!empty($subHeader))<h4 class="leading-tight mt-4 sm:mt-5 mb-2">{!! $subHeader !!}</h4>@endif

                <div style="font-size:0px" class="mb-4 md:mb-8">
                    @foreach($filteredBonuses as $bonus)
                        <div
                            class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
                        >
                            <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div
                                        x-ref="front"
                                        class="border-2 front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700  {{ $borderColor }}"
                                        style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                        @if(!empty($bonus['badge']))
                                            <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        @endif
                                        <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                            x-intersect.once="lazyLoad = true">
                                            <picture class="absolute inset-0 w-full h-full object-cover">
                                                @if(!empty($bonus['imageFull']))
                                                    <source srcset="{{ $bonus['image'] }}" media="(min-width: 640px)">
                                                    <img src="{{ $bonus['image'] }}"
                                                        alt="Bonus Image"
                                                        class="w-full h-full object-cover opacity-0 transition-opacity"
                                                        loading="lazy"
                                                        onload="this.classList.remove('opacity-0')">
                                                @else
                                                    <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}" media="(min-width: 640px)">
                                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                        alt="Bonus Image"
                                                        class="w-full h-full object-cover opacity-0 transition-opacity"
                                                        loading="lazy"
                                                        onload="this.classList.remove('opacity-0')">
                                                @endif
                                            </picture>
                                        </div>
                                        @if(!empty($bonus['vimeoId']))
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible" @click="modal{{ $bonus['vimeoId'] }} = true">
                                            <i class="fas fa-play play-button autoplay-video hover:opacity-80 border-4 border-solid border-white rounded-full cursor-pointer mt-24 mb-12 text-3xl py-4 px-5 md:py-6 md:px-7 md:mt-40 md:mb-24 md:text-2xl duration-300" style="background:rgba(0, 0, 0, 0.6);"></i><br>
                                             
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($bundle == 'deal')
                            <p class="w-full leading-normal mt-2">
                                {{-- @if(!empty($bonus['title']))
                                    <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                @endif --}}
                                <span style="display:inline-block;">
                                @if(!empty($bonus['price']))
                                        ${{ $bonus['price'] }}
                                @endif
                                <strong class="{{ $textColor }}">FREE</strong>
                                <span class="text-white italic block">Lifetime Access</span>


    {{--                                @if(!empty($bonus['customText']))--}}
    {{--                                    <strong class="{{ $textColor }}">{{ $bonus['customText'] }}</strong>--}}
    {{--                                @else--}}
    {{--                                    <strong class="{{ $textColor }}">FREE</strong>--}}
    {{--                                @endif--}}
    {{--                                <br>--}}
    {{--                                <em>--}}
    {{--                                    @if(!empty($bonus['physical']))--}}
    {{--                                        Physical Bonus--}}
    {{--                                    @else--}}
    {{--                                        Lifetime Access--}}
    {{--                                    @endif--}}
    {{--                                </em>--}}
                                </span>
                            </p>
                            @else
                            <p class="w-full leading-normal mt-2">
                                {{-- @if(!empty($bonus['title']))
                                    <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                @endif --}}
                                <span style="display:inline-block;" class="opacity-70 uppercase">
                                @if(!empty($bonus['price']) && $bundle != 'challenge' && $bundle != 'challenges-pianote')
                                    ${{ $bonus['price'] }} Value
                                @endif
    {{--                                @if(!empty($bonus['customText']))--}}
    {{--                                    <strong class="{{ $textColor }}">{{ $bonus['customText'] }}</strong>--}}
    {{--                                @else--}}
    {{--                                    <strong class="{{ $textColor }}">FREE</strong>--}}
    {{--                                @endif--}}
    {{--                                <br>--}}
    {{--                                <em>--}}
    {{--                                    @if(!empty($bonus['physical']))--}}
    {{--                                        Physical Bonus--}}
    {{--                                    @else--}}
    {{--                                        Lifetime Access--}}
    {{--                                    @endif--}}
    {{--                                </em>--}}
                                </span>
                            </p>
                            @endif
                        </div>
                    @endforeach
                </div>
                <h2 class="leading-tight mt-4 mb-4">
                {!!$bundlePrice!!}
                </h2>
                {{-- <p class="text-sm mb-4 sm:mb-6">For your first year, then ${{ Prices::$plusSubscriptionAnnualFull }}/yr.</p> --}}
                <a role="link" aria-label=" GET the deal" class="join @if(!empty($buttonColor)) {{ $buttonColor }} @else {{ $theme }} @endif mb-4 md:mb-5 w-full sm:max-w-xs md:max-w-lg lg:max-w-3xl uppercase" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                    @if(!empty($CTA))
                        {{ $CTA }}
                    @else
                    GET the deal <i class="fas fa-arrow-right"></i>
                @endif
                </a>
                <br>
                    @if($bundle == 'deal') <p class="inline-block opacity-90 text-white text-sm md:text-base @if($bundle == 'challenge' || $bundle == 'challenges-pianote') hidden @endif">
                    <em>New annual students only. Renews at $240/year. Cancel anytime.</em></p>
                    <a role="link" class="block opacity-90 text-white" aria-label="Start membership" href="https://www.musora.com/extend" target="_blank">
                        <p class="text-xs sm:text-sm md:text-base"><em>Annual members, <span class="underline cursor-pointer">click here for your extension deal.</span></em></p>
                    </a>
                    @else <p class=" @if($bundle == 'challenge' || $bundle == 'challenges-pianote') hidden @endif"><em>Renews at $240/year. Cancel anytime.</em></p>
                    @endif
                </div>
        </section>
    </div>

