@php
     $filteredBonusVideos = collect($bonusVideos)
        ->filter(function ($bonusVideo) use ($videoTargetSkus) {
            return in_array($bonusVideo['sku'], $videoTargetSkus, true);
        })
        ->sortBy(function ($bonusVideo) use ($videoTargetSkus) {
            return array_search($bonusVideo['sku'], $videoTargetSkus);
        })
        ->values();
@endphp


@if(!empty($freeShipping))
    <div class="text-center ">
        <p class="leading-tight border border-gray-300 px-5 lg:px-7 py-2 rounded-lg inline-block w-auto my-7 mx-auto" style="background:linear-gradient(to right, #C3FFD7, #C3E4FF, #B2FFFB);">
            <i class="fas fa-sparkle mr-3"></i>
            <strong class="font-black">All Black Friday Bundles =</strong> <i class="fas fa-sparkle lg:hidden ml-3"></i><br class="lg:hidden"> FREE SHIPPING to USA/CANADA and Discounted Shipping Worldwide.
            <i class="fas fa-sparkle hidden lg:inline lg:ml-3"></i>
        </p>
    </div>
@endif
<div class="space-y-4 md:space-y-8 lg:space-y-14 md:pb-1 pt-4 lg:pt-0">
    @foreach($filteredBonusVideos as $index => $bonusVideo)
        @if(in_array($bonusVideo['sku'], $videoTargetSkus))
            <div class="rounded-xl overflow-hidden">
                <div class="flex flex-col md:flex-row h-full">
                    <div class="relative w-full md:w-5/12 lg:w-1/2 rounded-2xl">
                        <div class="aspect-video relative cursor-pointer">
                            <img
                                src="https://d21q7xesnoiieh.cloudfront.net/900x0/filters:quality(95)/{{ $bonusVideo['image'] }}"
                                alt="{{ $bonusVideo['header'] }}"
                                class="w-full h-full object-cover rounded-2xl"
                                @if(!empty($bonusVideo['vimeoId'])) @click="modal{{ $bonusVideo['vimeoId'] }} = true" @endif
                            />
                        </div>
                    </div>

                    <div class="py-4 md:px-4 md:py-0 md:w-7/12 lg:w-1/2 flex flex-col justify-center lg:px-10">
                        @if(!empty($bonusVideo['header']))
                            <h5 class="m-0"><strong>{!! $bonusVideo['header'] !!}</strong></h5>
                        @endif
                        @if(!empty($case) && $case === 'deal')
                         <div class="flex items-center flex-wrap space-x-2 my-3">
                            @if(!empty($bonusVideo['price']))
                                <span class="text-lg line-through opacity-30"><strong>${{ $bonusVideo['price'] }}</strong></span>
                            @endif
                            @if(!empty($bonusVideo['offerPrice']))
                                <span class="text-lg">{!! $bonusVideo['offerPrice'] !!}</span>
                            @endif
                                @if($index > 0)
                                    <span class="px-2 py-1 bg-musora text-black text-base font-black rounded">
                                        FREE BONUS
                                    </span>
                                @endif
                            @if(!empty($bonusVideo['extraBadge']))
                                <span class="text-base italic">
                                    {{ $bonusVideo['extraBadge'] }}
                                </span>
                            @endif
                        </div>

                        @else
                        <div class="flex items-center flex-wrap space-x-2 my-3">
                            @if(!empty($bonusVideo['price']))
                                <span class="text-lg opacity-30"><strong>${{ $bonusVideo['price'] }}</strong> @if(!empty($case) && $case == 'challenges') @else Value @endif</span>
                            @endif
                            @if(!empty($bonusVideo['offerPrice']))
                                <span class="text-lg">{!! $bonusVideo['offerPrice'] !!}</span>
                            @endif

                            @if(!empty($bonusVideo['badge']))
                                <span class="px-2 py-1 bg-musora text-black text-base font-black rounded">
                                    {{ $bonusVideo['badge'] }}
                                </span>
                            @endif
                            @if(!empty($bonusVideo['extraBadge']))
                                <span class="text-base italic">
                                    {{ $bonusVideo['extraBadge'] }}
                                </span>
                            @endif
                        </div>
                        @endif

                        @if(!empty($bonusVideo['description']))
                            <div>
                                {!! $bonusVideo['description'] !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="container mx-auto text-center pt-6 md:pt-16 @if(!empty($noButton)) hidden @endif">
    <a href="#customize-anchor" class="join @if($theme === 'drumeo') blue @else pianote @endif smaller w-full md:max-w-[350px] text-xl anchor-slide"> GET THE DEAL</a>
</div>
