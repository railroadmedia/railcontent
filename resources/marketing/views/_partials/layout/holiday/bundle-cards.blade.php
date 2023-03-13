<section class="bundles">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-{{array_count_values(array_column($bundles, 'visible'))[1]}}">
            @foreach(array_filter($bundles, function($val){if($val['visible'] === 1){ return 1; }}) as $key => $bundle)
                <div class="card-wrap">
                    <a href="{{ $bundle['slug'] }}" class="bundle-card">
                        <span class="top-left-badge text-white bg-promo"><i class="fas fa-star"></i> {{ $bundle['badgeText'] }}</span>
                        <div class="bg-center bg-cover pb-40 sm:pb-56 lg:pb-72" style="background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=85/{{ $bundle['img'] }});"></div>
                        <div class="float-left w-full px-2 md:px-3">
                            <p>
                                <strong>{!! $bundle['title'] !!}</strong><br>
                                <em>{!!$bundle['desc'] !!}<br></em>
                                <strong class="price">@if(!empty($bundle['discountedPrice']))<s class="opacity-30">${{ $bundle['price'] }}</s>&nbsp;@endif <span style="background:{{$bundle['priceColor']}};-webkit-background-clip: text; -webkit-text-fill-color: transparent;">$@if(!empty($bundle['discountedPrice'])){{$bundle['discountedPrice']}} @else{{$bundle['price']}} @endif</span></strong>
                            </p>
                            <span class="join max-w-md" style="background:{{$bundle['buttonColor']}};">See The Deal &raquo;</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
