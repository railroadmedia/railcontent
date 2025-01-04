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
@endphp

    <div class="relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        x-intersect.once="lazyLoad = true"
    >
        <div class="container mx-auto relative z-50 @if(!empty($maxWidth)) {{ $maxWidth }} @else max-w-6xl @endif">
            <div class="w-full">
                <div class="mx-auto px-1 md:px-3 w-full">
                    <div class="inline-block w-full group">
                        @if(!empty($topImage))
                            <div class="flex-1 relative overflow-hidden rounded-xl max-w-sm mx-auto pb-4">
                                <div class="aspect-[18/10] relative">
                                    <div class="absolute inset-0">
                                        <div class="w-full h-full rounded-xl shadow-lg overflow-hidden">
                                            <picture class="block w-full h-full"
                                                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                x-intersect.once="lazyLoad = true"
                                            >
                                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $topImage }}" media="(min-width: 640px)">
                                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $topImage }}"
                                                    alt="Top Image"
                                                    class="w-full h-full object-cover transition-opacity duration-300"
                                                    :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                                    loading="lazy"
                                                >
                                            </picture>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            @php
                                $images = array_filter([$secondImage ?? null, $thirdImage ?? null, $fourthImage ?? null]);
                                $imageCount = count($images);
                            @endphp
                            
                            <div class="text-center flex flex-col md:flex-row md:justify-center space-y-4 md:space-y-0 md:space-x-4 md:py-4 lg:pb-8 hidden md:flex @if($imageCount == 2) lg:px-10 @endif">
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
                        </div>
                    </div>
                </div>
            </div>

            <div style="font-size:0px" class="mb-4 md:mb-8">
            @foreach($filteredBonuses as $index => $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif @if($index < $imageCount) md:hidden @endif"
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
                            }
                        "
                    >
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div
                                    x-ref="front"
                                    class="border-2 front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 {{ $borderColor }}"
                                    style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;"
                                >
                                    @if(!empty($bonus['badge']))
                                        <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    @endif
                                    <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                        :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                        x-intersect.once="lazyLoad = true"
                                    >
                                        <picture class="absolute inset-0 w-full h-full object-cover">
                                            @if(!empty($bonus['imageFull']))
                                                <source srcset="{{ $bonus['image'] }}" media="(min-width: 640px)">
                                                <img src="{{ $bonus['image'] }}"
                                                    alt="Bonus Image"
                                                    class="w-full h-full object-cover opacity-0 transition-opacity"
                                                    loading="lazy"
                                                    onload="this.classList.remove('opacity-0')"
                                                >
                                            @else
                                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}" media="(min-width: 640px)">
                                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    alt="Bonus Image"
                                                    class="w-full h-full object-cover opacity-0 transition-opacity"
                                                    loading="lazy"
                                                    onload="this.classList.remove('opacity-0')"
                                                >
                                            @endif
                                        </picture>
                                    </div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div
                                    x-ref="back"
                                    class="back border-2 absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180 {{ $borderColor }}"
                                    style="backface-visibility: hidden;"
                                >
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="w-full leading-normal mt-2">
                            <span style="display:inline-block;">
                                @if(!empty($bonus['price']))
                                    <s class="opacity-60">${{ $bonus['price'] }}</s>
                                @endif
                                <strong class="{{ $textColor }} ml-0.5">FREE</strong>
                            </span>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
