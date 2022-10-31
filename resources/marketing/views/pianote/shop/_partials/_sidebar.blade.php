{{--@php    --}}
{{--    $soldOut = false;--}}

{{--    if(!empty($sku) && !empty($productStock[$sku]) && ($category !== 'lessons' && $category !== 'bundles')){--}}
{{--        $soldOut = $productStock[$sku]->isProductSoldOut();--}}
{{--    }--}}
{{--@endphp--}}

<div class="shop-sidebar sliding-function px-3 md:px-4 lg:px-4 lg:w-1/3 lg:mt-5">
    <div class="lg:h-0">
    <div id="order" class="anchor"></div>
    <div class="side-slide md:border md:border-solid md:rounded-md" style="border-color: #CCD3D3;">
        {{--<div class="promo-tab hidden hidden lg:block lg:block text-center text-center py-2 px-3 py-2 px-3" style="position:relative;background: linear-gradient(to bottom, #dfeef2, #f9e4d3);">--}}
            {{--<img class="w-auto max-h-12 max-h-12" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/july/pianote-summer-sale-dark.png">--}}
        {{--</div>--}}
        <div class="pt-2 px-5 pb-6 text-center md:py-6 md:px-4">
            @if(!empty($instructor))
                <p class="text-center text-sm uppercase mx-auto mb-1 hidden lg:inline"><em>{{ $instructor }}</em></p>
            @endif
            @if(!empty($logo))
                <img class="hidden lg:inline max-h-24 w-full mx-auto object-contain lg:block" src="@if(str_contains($logo, 'amazonaws') || str_contains($logo, 'cloudfront')){{$logo}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$logo}}@endif" alt="product logo">
            @endif
            @if(($fullPrice - $price) > 0)
                <p class="text-center font-bold text-sm leading-none mb-1 md:text-base" style="color:#10D05F;">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
                <h1 class="text-center text-4xl no-leading uppercase md:text-3xl"><s style="color:#8C9698;">${{ floatVal($fullPrice) }}</s> <strong class="text-pianote">${{ floatVal($price) }}</strong></h1>
            @else
                <h1 class="text-center text-4xl no-leading uppercase md:text-3xl"><strong class="text-pianote">Only ${{ floatVal($price) }}</strong></h1>
            @endif
            @if(!empty($specialText))
                <p class="text-center text-sm leading-none mb-1 md:text-base text-pianote italic">{!! $specialText  !!}</p>
            @endif
            @if(!$soldOut)
                @if($category !== 'bundles' && count($sizes) === 0)
                    <a
                        class="online-atc vue-add-to-cart"
                        href="/ecommerce/add-to-cart?redirect=%2Fshop&products[{{ $sku }}]=1"
                        data-base-url="/ecommerce/add-to-cart?redirect=%2Fshop&products[{{ $sku }}]=1"
                        data-product-json='{"{{ $sku }}": 1}'
                    >
                        <button class="join text-xl leading-none uppercase text-white w-full py-4 px-2 rounded-full border-0 mx-auto my-2 md:py-5 md:py-2 md:my-4 md:mx-auto hover:opacity-90"><i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart</button>
                    </a>
                @endif
                @if(count($sizes) > 0)
                    <select class="pack-pick mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80;" title="Shirt Size" required>
                        <option hidden value="">Choose Size</option>
                        @foreach($sizes as $size)
                            <option
                                    @if(isset($size->soldOut) && $size->soldOut) disabled @endif
                            {{-- @if($productStock[$sku.'-'.$size->code]->isProductSoldOut()) disabled @endif --}}
                                    value="{{$product->sku}}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}"
                                    data-price="{{floatVal($product->price) ?? 0}}"
                                    data-product-json='{"{{$product->sku}}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1}'
                            >
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>

                    <a
                            class="online-atc merch vue-add-to-cart selected-pack"
                            href="#"
                            @if(!empty($promoCode))
                            data-base-url="/ecommerce/add-to-cart?redirect=%2Fshop&promo-code={{$promoCode}}"
                            data-promocode="{{ $promoCode }}"
                            @else
                            data-base-url="/ecommerce/add-to-cart?redirect=%2Fshop"
                            @endif
                            @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                    >
                        <button class="join text-xl leading-none uppercase text-white w-full py-4 px-2 rounded-full border-0 mx-auto my-2 md:py-5 md:py-2 md:my-4 md:mx-auto hover:opacity-90">
                            <i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart
                        </button>
                    </a>
                @endif
                @if($category === 'bundles')
                    <a class="online-atc" href="/ecommerce/add-to-cart?redirect=%2Forder&{{ $sku }}"
                            data-base-url="/ecommerce/add-to-cart?redirect=%2Forder&{{ $sku }}">
                        <button class="join green text-xl leading-none uppercase text-white w-full py-4 px-2 rounded-full border-0 mx-auto my-2 md:py-5 md:py-2 md:my-4 md:mx-auto hover:opacity-90"><i class="fas fa-cart-plus text-2xl mr-1"></i> Order Now</button>
                    </a>
                @endif
            @else
                <button class="join sold-out text-xl leading-none uppercase text-white w-full py-4 px-2 rounded-full border-0 mx-auto my-2 md:py-5 md:py-2 md:my-4 md:mx-auto hover:opacity-90" {{--style="background: #777;"--}}>
                    Sold Out
                </button>
            @endif
            @if(!empty($shippingdelay))
                <p class="mt-0 text-xs">{!! $shippingdelay !!}</p>
            @endif
            <p class="text-black italic text-xs leading-normal text-center mx-auto">You can also order by phone toll-free at<br class="hidden sm:inline">
                    <a class="text-pianote" href="tel:1-800-439-8921">1-800-439-8921</a> or directly at
                    <a class="text-pianote" href="tel:1-604-855-7605">1-604-855-7605</a>. </p>
        </div>
        @if(!empty($guaranteeBadge))
            <div class="flex justify-center items-center px-5 pb-5 text-center md:pt-2 md:pt-4 md:pb-6 lg:p-5 lg:-mt-1 lg:mx-auto lg:mb-0 border-t-0 lg:border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="w-36 my-0 pr-6" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png">
                <p class="text-xs font-bold text-left my-0 text-pianote">Your entire order is backed by<br class="lg:hidden" /> our 90-Day Money Back <br class="lg:hidden" /> Guarantee.</p>
            </div>
        @endif
    </div>
</div>
</div>
