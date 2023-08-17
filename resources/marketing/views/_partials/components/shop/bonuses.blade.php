@foreach ($product->bundles as $key => $bundle)
    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center">
        <div class="image-wrap relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-0 {{-- @if($bundle['bundle_free_shipping']) shipping @endif--}}">
            <img class="w-full rounded-lg" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/{{ $bundle['bundle_img'] }}" alt="product thumbnail{{$key+1}}">
        </div>
        <div>
            <strong>
                {{ $bundle['name'] }} - <span @if(!empty($bundle['priceColor']) && $bundle['priceColor'] == 'orange') class="orange" @endif>Normally ${{ floatVal($bundle['price'])}}</span>
                @if(!empty($bundle['special_text']))<span class="text-{{ $theme }}">{{ $bundle['special_text'] }}</span> @endif
                @if($bundle['free_bonus']) <span class="text-{{$theme}}">FREE BONUS</span> @endif

                <br @if(!$bundle['bundle_free_shipping'] && !$bundle['lifetime_access']) class="hidden" @endif>
                    @if($bundle['lifetime_access'])
                        <span style="color:#E69500;">LIFETIME ACCESS</span>
                    @endif

                    @if($bundle['bundle_free_shipping'])
                        <span style="color:#E69500;">FREE SHIPPING</span>
                    @endif
            </strong><br>
            {{ $bundle['bundle_desc'] }}
            <br>
        </div>
    </div>
@endforeach
