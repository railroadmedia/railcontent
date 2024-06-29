<section x-show="filter === 'all'">
    <div class="container mx-auto">
        <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-bookmark text-{{ $brand }} mr-1"></i>
                {!! $header !!}</strong></h5>
        <div class="flex flex-wrap mb-5 sm:mb-10">
            @foreach (array_filter($bundles, function ($val) {if ($val['visible'] === 1) {return 1;}}) as $key => $bundle)
                <a href="{{ $bundle['slug'] }}"
                    class="w-full @if (!empty($bundle['specialW'])) lg:w-2/3 @elseif(!empty($bundle['specialW2'])) lg:w-1/3 @elseif(!empty($bundle['full'])) @else sm:w-1/2 @endif mx-auto p-1 sm:p-2">
                    <div class="flex flex-col h-full overflow-hidden rounded-xl border border-gray-200 shadow-lg">
                        <!-- Image section -->
                        <div class="w-full flex-shrink-0 relative">
                            @if (!empty($bundle['img']))
                                <img class="w-full object-cover" src="{{ $bundle['img'] }}" alt="{{ $bundle['title'] }}">
                            @else
                                <div class="w-full"
                                    style="background:linear-gradient(to bottom, {{ $bundle['bgColor'] }});"></div>
                            @endif
                            <div class="absolute top-0 left-0 text-black">
                                <div class="rounded py-1 px-2" style="background: #FFD600;">
                                      <p class="text-xs lg:text-base"><i class="fas fa-star"></i> {!! $bundle['badgeText'] !!} </p>
                                </div>
                              
                            </div>
                        </div>

                        <div class="flex-grow p-5 lg:px-7">
                            <div class="flex flex-col justify-between h-full">
                                @if (isset($bundle['title']))
                                <h4 class="font-bold text-center mb-1 text-black">{{ $bundle['title'] }}</h4>
                                @endif
                                <p class="text-sm italic text-center mb-2 text-black">{!! $bundle['desc'] !!}</p>
                                @if (!empty($bundle['price']))
                                    
                                        <div class="flex flex-row items-center py-2">
                                      
                                                @if ($bundle['discountedPrice'] < $bundle['price'])
                                                <h5 class="line-through text-black opacity-40">Was ${{ $bundle['price'] }}</h5>
                                                @endif
                                                <h5 style="color: {{ $bundle['discountedPriceColor'] }};"><strong>Now ${{ $bundle['discountedPrice'] }}</strong></h5>                                           
                                        </div>
                                   
                                @endif
                                <div class="join smaller py-3 px-4" style="{!! $bundle['buttonStyle'] !!};">
                                    @if (!empty($bundle['buttonText']))
                                        {{ $bundle['buttonText'] }}
                                    @elseif(!empty($bundle['soldOut']))
                                        JOIN THE WAITLIST
                                    @else
                                        SEE DETAILS
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
