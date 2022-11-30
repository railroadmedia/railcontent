<section class="bundles">
    <div class="container mx-auto">
        <div class="grid md:grid-cols-{{array_count_values(array_column($bundles, 'visible'))[1]}}">
            @foreach(array_filter($bundles, function($val){if($val['visible'] === 1){ return 1; }}) as $key => $bundle)
                <div class="card-wrap">
                    <a href="{{ $bundle['slug'] }}" class="bundle-card">
                        <span class="top-left-badge text-white bg-promo"><i class="fas fa-star"></i> {{ $bundle['badgeText'] }}</span>
                        <div class="bg-center bg-cover pb-40 sm:pb-56 xl:pb-72" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/{{ $bundle['img'] }});"></div>
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
        <div class="float-left w-full px-2 md:px-3 card-wrap">
            <div class="px-2 sm:px-0 max-w-xs sm:max-w-full mx-auto">
                <a href="/drumshop/bundle-practice-anywhere/" class="flex flex-row-reverse text-white rounded-xl mx-auto mb-5 overflow-hidden relative w-full sm:text-left px-5 lg:px-12 pt-40 pb-5 sm:py-7 lg:py-8">
                    <div class="relative z-10 inline-block w-full sm:w-auto text-center mx-0">
                        <img class="h-14 lg:h-28" src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-logo-wide-white.png"><br>
                        <p class="leading-tight my-3">P4 Practice Pad + Drumsticks<br class="inline lg:hidden"> + Rudiment Poster</p>
                        <h4 class="inline-block leading-none"><strong>
                                <s class="opacity-60">$98.95</s>&nbsp; $79</strong></h4><br>
                        <div class="join white smaller mt-3 w-full">See The Deal &raquo;</div><br>
                    </div>
                    <p class="absolute z-20 top-0 left-0 text-white rounded-br-xl bg-promo uppercase py-1.5 px-2.5 leading-none text-xs font-roboto"><i class="fas fa-star"></i> <strong>SAVE 20%</strong></p>
                    <div class="hidden sm:block absolute inset-0 z-0 bg-cover bg-center" style="background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-shop.jpg);"></div>
                    <div class="block sm:hidden absolute inset-0 z-0 bg-cover bg-right" style="background-color:#0d1d3f;background-image:url(https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/practice-anywhere-m.jpg);"></div>
                </a>
            </div>
        </div>
    </div>
</section>
