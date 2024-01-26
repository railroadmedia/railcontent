{{--@php    --}}
{{--    $soldOut = false;--}}

{{--    if(!empty($sku) && !empty($productStock[$sku]) && ($category !== 'lessons' && $category !== 'bundles')){--}}
{{--        $soldOut = $productStock[$sku]->isProductSoldOut();--}}
{{--    }--}}
{{--@endphp--}}

<div class="lg:px-4 lg:w-1/3 px-3 md:px-4 mb-4 lg:mb-0">
    <div class="lg:h-0">
    <div id="order" class="anchor"></div>
    <div id="sticky-slide" class="overflow-hidden rounded border border-solid border-gray-300">
        <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">
            @if(!empty($instructor))
                <p class="instructor hidden lg:inline"><em>{{ $instructor }} </em></p>
            @endif
            @if(!empty($logo))
                <img class="hidden max-h-20 w-full mx-auto mb-4 object-contain lg:block @if(!empty($invert)) filter invert @endif" src="{{ $logo }}" alt="Product logo">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                <h1 class="text-center text-3xl uppercase md:text-4xl">
                    <s class="opacity-40 text-2xl">${{ floatVal($fullPrice) }}</s>
                    <strong class="font-black text-{{ $theme }}">
                        @if(number_format($price, 2) == intval($price))
                            $<span class="chosen-variant-price-float">{{  floatVal($price)  }}</span>
                        @else
                            $<span class="chosen-variant-price-float">{{  number_format($price, 2)  }}</span>
                        @endif
                    </strong>
                </h1>
                <p class="text-sm font-black text-black rounded-lg px-2 leading-none py-1 inline-block bg-musora">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
            @elseif(isset($price))
                <h1 class="text-center text-3xl uppercase md:text-4xl"><strong class="font-black text-{{ $theme }}">Only $<span class="chosen-variant-price-float">{{ floatVal($price) }}</span></strong></h1>
            @endif

            @if(!empty($specialText))
                <p class="text-center mx-auto mb-1 text-sm italic md:text-base" style="color:#858c93;">{!! $specialText  !!}</p>
            @endif

            @if(!empty($soldOut) && $soldOut)
                <button class="join sold-out border-none">
                    SOLD OUT
                </button>
            @else
                @if($category !== 'bundles' && count($sizes) === 0 && !$bundle)
                    <a
                        class="online-atc @if(!$product->is_seasonal) vue-add-to-cart @endif"
                        href="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                        data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                        data-product-json='{"{!! $sku !!}": 1}'
                    >
                        <button class="join border-none {{ $theme !== 'drumeo' ? 'bg-'.$theme : '' }}"><i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart</button>
                    </a>
                @elseif(!empty($bundle))
                    <a class="online-atc" href="/ecommerce/add-to-cart?{!! $sku !!}"
                       data-base-url="/ecommerce/add-to-cart?{!! $sku !!}">
                        <button class="join border-none"><i class="fas fa-cart-plus text-2xl mr-1"></i> Order Now</button>
                    </a>
                @endif

                @if(count($sizes) > 0)
                    <select
                        class="pack-pick mx-auto mt-4 border-2 rounded-full font-black text-lg w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4"
                        style="border-color: #717D80; color:#717D80;"
                        title="Shirt Size" required>
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($sizes as $size)
                            <option
                                class="bg-white text-black font-black"
                                @if(empty($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)])
 || $products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStockAvailability() === 0) disabled style="color: #DDD!important;" @endif
                                value="@if(!empty($sku)){{$sku}}-@endif{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}"
                                data-price="{{!empty($size->price) ? $size->price : $price}}"
                                data-product-json='{"@if(!empty($sku)){{$sku}}-@endif{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1}'
                            >{{ $size->name }}</option>
                        @endforeach
                    </select>

                    <a
                        x-ref="addButton"
                        class="online-atc merch @if(!$product->is_seasonal) vue-add-to-cart @endif selected-pack"
                        @if(!$product->is_seasonal) href="#" @else @click=" $refs.addButton.classList.contains('active') ? orderModal = true : null" @endif
                        @if(!empty($promoCode))
                        data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&promo-code={{$promoCode}}"
                        data-promocode="{{ $promoCode }}"
                        @else
                        data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true"
                        @endif
                        @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                    >
                        <button class="join border-none">
                            <i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart
                        </button>
                    </a>
                @endif
            @endif
                <p class="italic text-center mx-auto my-0 text-xs" style="color:#858c93;">
                    @if(!empty($freeShipping))
                        <i class="fas fa-truck text-{{ $theme }}"></i> <strong class="text-{{ $theme }}">FREE SHIPPING!</strong><br>
                    @endif
                    You can also order by phone toll-free at<br class="hidden sm:inline">
                    <a href="tel:+18004398921" class="text-{{ $theme }}">1-800-439-8921</a> or directly at
                    <a href="tel:+16048557605" class="text-{{ $theme }}">1-604-855-7605</a>. </p>
        </div>
        @if(!empty($guaranteeBadge))
            <div class="hidden lg:flex justify-center items-center px-5 pb-5 text-center md:pt-2 md:pt-4 md:pb-6 lg:p-5 lg:-mt-1 lg:mx-auto lg:mb-0 border-t-0 lg:border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="w-24 my-0 pr-6" src="https://www.musora.com/musora-cdn/image/width=170,quality=95/@php
                    if($theme === 'drumeo'){
                        echo 'https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png';
                    }
                    elseif($theme === 'pianote'){
                        echo 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png';
                    }
                    elseif($theme === 'guitareo'){
                        echo 'https://d122ay5chh2hr5.cloudfront.net/sales/2021/guarantee-badge.png';
                    }
                    elseif($theme === 'singeo'){
                        echo 'https://d21xeg6s76swyd.cloudfront.net/sales/2021/guarantee.png';
                    }
                @endphp" alt="guarantee badge">
                <p class="text-sm text-left my-0 text-{{ $theme }}"><em>Your entire order is backed by<br class="lg:hidden" /> our 90-Day Money-Back <br class="lg:hidden" /> Guarantee.</em></p>
            </div>
        @endif
    </div>
    </div>
</div>
