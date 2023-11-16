<section x-show="filter === 'all'">
    <div class="container mx-auto">
        <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-badge-percent text-{{ $brand }} mr-1"></i> {!!  $header  !!}</strong></h5>
        <div class="flex flex-wrap mb-5 sm:mb-10">
            @foreach(array_filter($bundles, function($val){if($val['visible'] === 1){ return 1; }}) as $key => $bundle)
                <a href="{{ $bundle['slug'] }}" class="w-full @if(!empty($bundle['specialW'])) lg:w-2/3 @elseif(!empty($bundle['specialW2'])) lg:w-1/3 @elseif(!empty($bundle['full'])) @else sm:w-1/2 @endif mx-auto p-1 sm:p-2">
                    <div class="flex items-center @if(empty($bundle['full']) && empty($bundle['specialW'])) justify-center @else lg:pl-16 xl:pl-20 @endif w-full overflow-hidden relative text-white rounded-xl px-5 lg:px-10 py-5 sm:py-7 lg:py-8"
                        @if(empty($bundle['img'])) style="background:linear-gradient(to bottom, {{ $bundle['bgColor'] }});" @endif >
                        <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                            <img class="h-16 sm:h-24 sm:h-28" src="{{ $bundle['logo'] }}"><br>
                            <p class="leading-tight my-2 sm:my-3 text-sm italic">{!!$bundle['desc'] !!}</p>
                            <h4 class="inline-block leading-none">
                                @if($bundle['discountedPrice'] < $bundle['price'])<span class="opacity-60"><s>${{ $bundle['price'] }}</s></span>&nbsp;@endif
                                <strong>${{$bundle['discountedPrice']}}</strong>
                            </h4><br>
                            <div class="join smaller mt-3 w-full text-white p-3 sm:max-w-md w-full" style="background:{{$bundle['buttonColor']}};">See The Deal &raquo;</div><br>
                        </div>
                        @if(!empty($bundle['img']))
                            <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-image:url('{{ $bundle['img'] }}');"></div>
                            <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('{{ $bundle['imgM'] }}');"></div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
