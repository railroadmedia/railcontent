<section x-show="filter === 'all'">
    <div class="container mx-auto">
        <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-badge-percent text-{{ $brand }} mr-1"></i> {!!  $header  !!}</strong></h5>
        <div class="flex flex-wrap mb-5 sm:mb-10">
            @foreach(array_filter($bundles, function($val){if($val['visible'] === 1){ return 1; }}) as $key => $bundle)
                <a href="{{ $bundle['slug'] }}" class="w-full @if(!empty($bundle['specialW'])) lg:w-2/3 @elseif(!empty($bundle['specialW2'])) lg:w-1/3 @elseif(!empty($bundle['full'])) @else sm:w-1/2 @endif mx-auto p-1 sm:p-2">
                    <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl px-5 lg:px-7
                    @if(empty($bundle['full']) && empty($bundle['specialW']))
                        justify-center py-5 sm:py-6 lg:py-8
                    @elseif(!empty($bundle['specialW']))
                        lg:pl-16 xl:pl-20 py-5 sm:py-6 lg:py-8
                    @else
                        sm:pl-12 lg:pl-16 xl:pl-20 py-5 sm:py-10 lg:py-12
                     @endif "
                        @if(empty($bundle['img'])) style="{{ $bundle['bgColor'] }}" @endif >
                        <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                             @if(isset($bundle['logo']))
                                <img class="@if(isset($bundle['logoStyle'])) {{ $bundle['logoStyle'] }} @else h-7 sm:h-7 lg:h-10 @endif" src="{{ $bundle['logo'] }}">
                            @endif
                             @if(isset($bundle['spread']))
                                 <br>
                                <img class="@if(isset($bundle['imgStyle'])) {{ $bundle['imgStyle'] }} @endif  h-36 sm:h-32 lg:h-40 xl:h-48 mt-5" src="{{ $bundle['spread'] }}">
                            @endif
                            @if(isset($bundle['title']))
                                <h2 class="leading-none"><strong>{{ $bundle['title'] }}</strong></h2>
                            @endif
                            <p class="leading-tight mb-3 mt-1 sm:mt-3 text-sm italic">{!!$bundle['desc'] !!}</p>
                             @if(!empty($bundle['price']))
                                 <h3 class="inline-block leading-none mb-5">
                                    @if(!empty($bundle['soldOut']))
                                        <strong>{{$bundle['price']}}</strong>
                                    @else
                                        @if($bundle['discountedPrice'] < $bundle['price'])<strong class="opacity-60"><s>${{ $bundle['price'] }}</s></strong>&nbsp;@endif
                                        <strong>${{$bundle['discountedPrice']}}</strong>
                                    @endif
                                </h3>
                             @endif
                             <div class="join smaller white w-full p-3 sm:max-w-md w-full">
                                @if(!empty($bundle['buttonText']))
                                     {{ $bundle['buttonText'] }}
                                @elseif(!empty($bundle['soldOut']))
                                    JOIN THE WAITLIST
                                @else
                                    SEE DETAILS
                                @endif
                            </div><br>
                        </div>
                        @if(!empty($bundle['img']))
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('{{ $bundle['img'] }}');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('{{ $bundle['imgM'] }}');"></div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
