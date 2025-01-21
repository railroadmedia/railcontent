@php
    switch ($bundle) {
        case 'holiday-pianote':
            $borderColor = 'border-[#F61A30]';
            $textColor = 'text-[#FFAC00]';
            break;
        case 'holiday-drumeo':
            $borderColor = 'border-drumeo';
            $textColor = 'text-[#FFAC00]';
            break;
        default:
            $borderColor = 'border-none';
            $textColor = 'text-white';
            break;
    }

    $filteredBonuses = collect($bonuses)
        ->filter(function ($bonus) use ($targetSkus) {
            return in_array($bonus['sku'], $targetSkus, true);
        })
        ->sortBy(function ($bonus) use ($targetSkus) {
            return array_search($bonus['sku'], $targetSkus);
        })
        ->values();

    $images = array_filter([$secondImage ?? null, $thirdImage ?? null, $fourthImage ?? null]);
    $imageCount = count($images);
@endphp

@if(!empty($header))
    {!! $header !!}
@endif

<div class="relative overflow-hidden text-white text-center customize px-4 lg:px-6"
     x-intersect.once="lazyLoad = true">
    
    <div class="container mx-auto relative z-50 {{ $maxWidth ?? 'max-w-6xl' }}">
        @if(!empty($topImage))
            <div class="relative overflow-hidden {{ !empty($ispromo) ? 'max-w-lg' : 'rounded-xl max-w-sm' }} mx-auto pb-4">
                <div class="aspect-[18/10] relative">
                    <div class="absolute inset-0">
                        <div class="w-full h-full rounded-xl shadow-lg overflow-hidden">
                            <picture class="block w-full h-full"
                                    x-bind:class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                    x-intersect.once="lazyLoad = true">
                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $topImage }}" 
                                        media="(min-width: 640px)">
                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $topImage }}"
                                     alt="Featured Bonus"
                                     class="w-full h-full transition-opacity duration-300 {{ !empty($ispromo) ? 'object-contain' : 'object-cover' }}"
                                     x-bind:class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                     loading="lazy">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($imageCount > 0)
            <div class="text-center flex flex-col md:flex-row md:justify-center space-y-4 md:space-y-0 md:space-x-4 md:py-4 lg:pb-8 hidden md:flex {{ $imageCount == 2 ? 'lg:px-10' : '' }}">
                @foreach ($filteredBonuses as $index => $bonus)
                    @if ($index < $imageCount)
                        @include('_partials.components.image-card', [
                            'image' => $images[$index],
                            'alt' => ($bonus['title'] ?? '') . ' Image',
                            'borderColor' => $borderColor,
                            'description' => $bonus['description'],
                            'price' => '$' . $bonus['price'],
                            'imageCount' => $imageCount
                        ])
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Promo /lp page--}}
        @if(!empty($ispromo))
            <div class="promo-section">
                @if(!empty($promoHeader))
                    <h3 class="leading-tight mb-2"><strong>{!! $promoHeader !!}</strong></h3>
                @endif
                
                @if(!empty($subHeader))
                    <h4 class="leading-tight mt-4 sm:mt-5 mb-2">{!! $subHeader !!}</h4>
                @endif

                <a class="join {{ $buttonColor ?? $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" 
                   style="padding: 20px 10px;" 
                   href="{{ $buttonLink }}" 
                   aria-label="Get Started">
                    {{ $CTA ?? 'GET Started »' }}
                </a>

                <p class="leading-tight text-sm mb-6">
                    <em>First year discount: 
                        <s class="opacity-40">${{ Prices::$plusSubscriptionAnnualFull }}</s>
                        <strong>${{ $firstYearPrice ?? '200' }}</strong>.
                        <br class="inline sm:hidden"> 
                        Cancel anytime. 90-day guarantee.
                    </em>
                </p>
            </div>
        @endif
         {{-- End Promo /lp page--}}
        <div class=" {{ !empty($ispromo) ? '' : 'mb-4 md:mb-8' }}" style="font-size:0px">
            @foreach($filteredBonuses as $index => $bonus)
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 
                            {{ $bonusWidth ?? 'w-1/2 md:w-1/4 lg:w-1/5' }} 
                            {{ $index < $imageCount ? 'md:hidden' : '' }}"
                     x-data="{ flipped: false }"
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
                        }">
                    <div class="flip-div inline-block relative w-full group" 
                         style="{{ empty($bonus['bigCard']) ? 'padding-bottom: 133%;' : 'padding-bottom: 103%;' }} perspective: 1000px;">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            {{-- Card Front --}}
                            <div x-ref="front"
                                 class="border-2 front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 {{ $borderColor }}"
                                 style="{{ !empty($bonus['special']) ? 'overflow: visible;border-color: #cda880;' : '' }} backface-visibility: hidden;">
                                @if(!empty($bonus['badge']))
                                    <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">
                                        {{ $bonus['badge'] }}
                                    </h6>
                                @endif

                                <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                     x-bind:class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                     x-intersect.once="lazyLoad = true">
                                    <picture class="absolute inset-0 w-full h-full object-cover">
                                        @if(!empty($bonus['imageFull']))
                                            <source srcset="{{ $bonus['image'] }}" media="(min-width: 640px)">
                                            <img src="{{ $bonus['image'] }}"
                                                 alt="{{ $bonus['title'] ?? 'Bonus' }}"
                                                 class="w-full h-full object-cover opacity-0 transition-opacity"
                                                 loading="lazy"
                                                 onload="this.classList.remove('opacity-0')">
                                        @else
                                            <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}" 
                                                    media="(min-width: 640px)">
                                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                 alt="{{ $bonus['title'] ?? 'Bonus' }}"
                                                 class="w-full h-full object-cover opacity-0 transition-opacity"
                                                 loading="lazy"
                                                 onload="this.classList.remove('opacity-0')">
                                        @endif
                                    </picture>
                                </div>

                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 
                                            transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-arrow-right text-4xl"></i><br>
                                    <p class="text-sm"><strong>DETAILS</strong></p>
                                </div>
                            </div>

                            {{-- Card Back --}}
                            <div x-ref="back"
                                 class="back border-2 absolute z-40 overflow-hidden rounded-xl w-full h-full 
                                        transition-transform duration-700 -rotate-y-180 {{ $borderColor }}"
                                 style="backface-visibility: hidden;">
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" 
                                     style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($ispromo))
                    <p>
                        <strong>
                            @if(!empty($bonus['title']))
                                {{ $bonus['title'] }}
                            @endif
                        </strong>
                    </p>
                     <p class="w-full leading-normal">
                        <span style="display:inline-block;">
                            <strong class="{{ $textColor }}">FREE</strong>
                        </span>
                    </p>
                    @if(!empty($bonus['access']))
                       <p class="italic"> 
                                {{ $bonus['access'] }}
                           </p>
                    @endif
                    @else
                    <p class="w-full leading-normal mt-2">
                        <span style="display:inline-block;">
                            @if(!empty($bonus['price']))
                                <s class="opacity-60">${{ $bonus['price'] }}</s>
                            @endif
                            <strong class="{{ $textColor }} ml-0.5">FREE</strong>
                        </span>
                    </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Footer Section --}}
@if(!empty($footer))
    {!! $footer !!}
@endif

{{-- Promo /lp page --}}
@if(!empty($ispromo))
    <div class="promo-footer text-center">
        <h3 class="leading-tight mt-6 mb-1">
            <s class="opacity-50">${{ Prices::$plusSubscriptionAnnualFull }}</s>
            <strong>${{ $firstYearPrice ?? '200' }}</strong> 
            <span class="text-musora">
                (Save {{ round(100 - (100 * (($firstYearPrice ?? 200) / 240))) }}%)
            </span>
        </h3>

        <p class="text-sm mb-4 sm:mb-6">
            For your first year, then ${{ Prices::$plusSubscriptionAnnualFull }}/yr.
        </p>

        <a role="link" 
           aria-label="Get Started"
           class="join {{ $buttonColor ?? $theme }} mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" 
           style="padding: 20px 10px;"
           href="{{ $buttonLink }}">
            {{ $CTA ?? 'GET Started »' }}
        </a>

        @if(!empty($belowButton))
            <p class="text-sm"><em>New students only.</em></p>
        @endif

        @if(!empty($altButtonLink))
            <a role="link" 
               class="inline-block opacity-70 mt-2" 
               aria-label="Start a monthly membership"
               href="{{ $altButtonLink }}">
                <p>
                    <u><em>
                        Or start a monthly membership for 
                        <br class="inline-block md:hidden">
                        ${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)
                    </em></u>
                </p>
            </a>
        @endif
    </div>
@endif