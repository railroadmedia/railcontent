@foreach ($product->bundles as $key => $bundle)
    <div class="bonus-pic mb-7 md:flex md:items-start md:mb-10 lg:items-center">
        <div class="image-wrap relative overflow-hidden mb-4 md:mb-0 md:mr-5 mx-auto @if($bundle['bundle_free_shipping']) shipping @endif">
            <img class="w-full rounded-lg" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/@if(str_contains($bundle['bundle_img'], 'amazonaws') || str_contains($bundle['bundle_img'], 'cloudfront')){{ $bundle['bundle_img'] }} @else https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $bundle['bundle_img']  }}@endif" alt="product thumbnail{{$key}}">
        </div>
        <div>
            <strong>{{ $bundle['name'] }} - <span @if($bundle['priceColor'] == 'orange') class="orange" @endif>Normally ${{ floatVal($bundle['price'])}}</span>
                    <br @if(!$bundle['bundle_free_shipping'] && !$bundle['lifetime_access'] && !$bundle['free_bonus']) class="hidden" @endif>

                    @if($bundle['free_bonus'])
                        <span class="text-{{$theme}}">*FREE BONUS*</span>
                    @endif

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
