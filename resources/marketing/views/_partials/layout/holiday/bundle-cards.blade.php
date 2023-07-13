<section class="bundles" x-show="filter === 'all'">
    <div class="container mx-auto">
        <h4 class="text-left px-[7px] md:px-[10px] mb-4 md:mb-6 lg:mb-10"><i class="fa-solid fa-square-star text-xl md:text-2xl lg:text-3xl text-{{$theme}} mr-2"></i> <span class="font-semibold">Deals</span></h4>
        <div class="grid md:grid-cols-{{array_count_values(array_column($bundles, 'visible'))[1]}}">
            @foreach(array_filter($bundles, function($val){if($val['visible'] === 1){ return 1; }}) as $key => $bundle)
                <div class="card-wrap">
                    <a href="{{ $bundle['slug'] }}" class="bundle-card">
                        <span class="top-left-badge text-black bg-[#FFD600]"><i class="fas fa-star"></i> {{ $bundle['badgeText'] }}</span>
                        <div class="bg-center bg-cover pb-40 sm:pb-56 lg:pb-72" style="background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=85/{{ $bundle['img'] }});"></div>
                        <div class="float-left w-full px-2 md:px-3">
                            <p>
                                <strong>{!! $bundle['title'] !!}</strong><br>
                                <em>{!!$bundle['desc'] !!}<br></em>
                                <strong class="price">@if(!empty($bundle['discountedPrice']))<span class="opacity-30">Was <s>${{ $bundle['price'] }}</s></span>&nbsp;@endif <span style="background:{{$bundle['priceColor']}};-webkit-background-clip: text; -webkit-text-fill-color: transparent;">@if(!empty($bundle['discountedPrice']))Now ${{$bundle['discountedPrice']}} @else ${{$bundle['price']}} @endif</span></strong>
                            </p>
                            <span class="join max-w-md" style="background:{{$bundle['buttonColor']}};">See The Deal &raquo;</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
