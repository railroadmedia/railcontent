{{--@php    --}}
{{--    $soldOut = false;--}}

{{--    if(!empty($sku) && !empty($productStock[$sku]) && ($category !== 'lessons' && $category !== 'bundles')){--}}
{{--        $soldOut = $productStock[$sku]->isProductSoldOut();--}}
{{--    }--}}
{{--@endphp--}}

<div class="side-bar sliding-function lg:px-4 lg:w-1/3 px-3 md:px-4 mt-2 mb-4 lg:mb-0">
    <div class="lg:h-0">
    <div id="order" class="anchor"></div>
    <div class="side-slide overflow-hidden rounded border border-solid" style="border-color: #CCD3D3;">
{{--        @include('_partials.layout.holiday.shop-sidebar-banner')--}}

        <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6" style="border-color: #CCD3D3;">
            @if(!empty($instructor))
                <p class="instructor hidden lg:inline"><em>{{ $instructor }} </em></p>
            @endif
            @if(!empty($logo))
                <img class="hidden max-h-20 w-full mx-auto mb-4 object-contain lg:block @if(!empty($invert)) filter invert @endif" src="{{ $logo }}" alt="Product logo">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                {{-- <p class="text-center mx-auto mb-1 font-bold text-sm md:text-base" style="color:#10D05F">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p> --}}
                <h1 class="text-center text-3xl uppercase md:text-4xl" style="color:#F71B26;"><s class="opacity-40 text-2xl">${{ floatVal($fullPrice) }}</s>
                    @if(number_format($price, 2) == intval($price))
                        <strong class="font-black text-{{ $theme }}">$<span class="chosen-variant-price-float">{{  floatVal($price)  }}</span></strong>
                    @else
                        <strong class="font-black text-{{ $theme }}">$<span class="chosen-variant-price-float">{{  floatVal(number_format($price, 2))  }}</span></strong>
                    @endif
                </h1>
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
                    <select class="pack-pick mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required>
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($sizes as $size)
                            <option
                                class="bg-white text-black"
                                @if(empty($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]) || $products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStockAvailability() === 0) disabled @endif
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
                <p>
                <span><strong>New students only. </strong></span>
                <br>Membership renews at $240/year. Cancel anytime.
                </p>
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
        {{-- @if (!empty($freeShipping))
            <i class="fas fa-truck text-{{ $theme }}"></i> <strong class="text-{{ $theme }}">FREE
                SHIPPING!</strong><br>
        @endif --}}
        <p class="italic text-center mx-auto my-0 text-xs" style="color:#858c93;"> You can also order by phone toll-free at 
            <br class="hidden sm:inline">
            <a href="tel:+18004398921" class="text-{{ $theme }}">1-800-439-8921</a> or directly at
            <a href="tel:+16048557605" class="text-{{ $theme }}">1-604-855-7605</a>.
        </p>
    </div>
    
    </div>
</div>
