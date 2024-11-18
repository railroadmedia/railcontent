<div class="space-y-4 md:space-y-8">
                @foreach($bonuses as $bonus)
                    @if(in_array($bonus['sku'], $targetSkus))
                        <div class="rounded-xl overflow-hidden">
                            <div class="flex flex-col md:flex-row h-full">
                                <div class="relative w-full md:w-5/12 lg:w-1/2 rounded-2xl">
                                    <div class="aspect-video relative cursor-pointer">
                                        <img
                                            src="https://d21q7xesnoiieh.cloudfront.net/700x0/filters:quality(95)/{{ $bonus['image'] }}"
                                            alt="{{ $bonus['header'] }}"
                                            class="w-full h-full object-cover rounded-2xl"
                                            @if(!empty($bonus['vimeoId'])) @click="modal{{ $bonus['vimeoId'] }} = true" @endif
                                        />
                                    </div>
                                </div>

                                <div class="py-4 md:px-4 md:py-0 md:w-7/12 lg:w-1/2 flex flex-col justify-center lg:px-10">
                                    @if(!empty($bonus['header']))
                                        <h5 class="pb-2 m-0"><strong>{!! $bonus['header'] !!}</strong></h5>
                                    @endif
                                
                                    <div class="flex items-center space-x-2 mb-4">
                                        @if(!empty($bonus['price']))
                                            <span class="text-lg line-through opacity-30"><strong>${{ $bonus['price'] }}</strong></span>
                                        @endif
                                
                                        @if(!empty($bonus['badge']))
                                            <span class="px-2 py-1 bg-musora text-black text-base font-bold rounded">
                                                {{ $bonus['badge'] }}
                                            </span>
                                        @endif
                                
                                        @if(!empty($bonus['extraBadge']))
                                            <span class="text-base italic">
                                                {{ $bonus['extraBadge'] }}
                                            </span>
                                        @endif
                                    </div>
                                
                                    @if(!empty($bonus['description']))
                                        <div>
                                            {!! $bonus['description'] !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>