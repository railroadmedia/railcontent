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


<div class="space-y-4 md:space-y-8">
    @foreach($filteredBonusVideos as $bonusVideo)
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

                        <div class="flex items-center space-x-2 my-3">
                            @if(!empty($bonusVideo['price']))
                                <span class="text-lg line-through opacity-30"><strong>${{ $bonusVideo['price'] }}</strong></span>
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

                        @if(!empty($bonusVideo['description']))
                            <div>
                                {!! $bonusVideo['description'] !!}
                            </div>
                            @if(!empty($bonusVideo['extraDescription']))
                                <div>
                                    {!! $bonusVideo['extraDescription'] !!}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>