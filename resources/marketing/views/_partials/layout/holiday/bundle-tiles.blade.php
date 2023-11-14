<section class="bundles" x-show="filter === 'all'">
    <div class="container mx-auto">
        <h4 class="text-left px-[7px] md:px-[10px] mb-4 md:mb-7"><i class="fa-solid fa-square-star text-xl md:text-2xl lg:text-3xl text-{{$theme}} mr-2"></i> <span class="font-bold" style="font-size:20px;line-heigh:1.2em;">{!!  $header  !!}</span></h4>
        <div class="grid md:grid-cols-{{array_count_values(array_column($bundles, 'visible'))[1]}}">
            @foreach(array_filter($bundles, function($val){if($val['visible'] === 1){ return 1; }}) as $key => $bundle)
                <a href="{{ $bundle['slug'] }}" class="flex flex-row text-white rounded-xl mx-auto mb-5 sm:mb-10 overflow-hidden relative w-full sm:text-left px-3 md:px-5 lg:px-[13%] pt-40 pb-5 sm:py-7 lg:py-8">
                    <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                        <img class="h-20 sm:h-24 md:h-28 lg:h-32" src="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/july/drumeo-5-for-3-logo-stacked.png"><br>
                        <p class="leading-tight my-3 text-xs italic">{!!$bundle['desc'] !!}</p>
                        <h4 class="inline-block leading-none">
                            @if(!empty($bundle['discountedPrice']))<span class="opacity-60"><s>${{ $bundle['price'] }}</s></span>&nbsp;@endif
                            <strong>${{$bundle['price']}}</strong>
                        </h4><br>
                        <div class="join white smaller mt-3 w-full bg-[#24CE7C] text-white p-[10px] md:max-w-md w-full text-[15px] lg:text-[17px]" style="background:{{$bundle['buttonColor']}};">See The Deal &raquo;</div><br>
                    </div>
                    <p class="absolute z-20 top-0 left-0 text-black rounded-br-xl bg-promo uppercase py-1.5 px-2.5 leading-none text-xs font-roboto"><i class="fas fa-star"></i> <strong>SAVE 20%</strong></p>
                    <div class="hidden lg:block absolute inset-0 z-0 bg-cover bg-center" style="background-color:#05b4d7;background-image:url('{{ $bundle['img'] }}');"></div>
                    <div class="hidden sm:block lg:hidden absolute inset-0 z-0 bg-cover bg-center" style="background-color:#05b4d7;background-image:url('{{ $bundle['img'] }}');"></div>
                    <div class="block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-color:#05b4d7;background-image:url('{{ $bundle['img'] }}');"></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
