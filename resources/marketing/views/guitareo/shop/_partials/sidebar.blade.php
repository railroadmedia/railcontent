{{--@php    --}}
{{--    $soldOut = false;--}}

{{--    if(!empty($sku) && !empty($productStock[$sku]) && ($category !== 'lessons' && $category !== 'bundles')){--}}
{{--        $soldOut = $productStock[$sku]->isProductSoldOut();--}}
{{--    }--}}
{{--@endphp--}}

<div class="side-bar sliding-function px-3 md:px-4 lg:px-4 lg:w-1/3 lg:mt-5 mb-4 lg:mb-0">
    <div class="lg:h-0">
    <div id="order" class="anchor"></div>
    <div class="side-slide overflow-hidden md:rounded border border-solid" style="border-color: #CCD3D3;">
        @include('_partials.layout.holiday.shop-sidebar-banner')
        <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">
            @if(!empty($instructor))
                <p class="text-center text-sm uppercase mx-auto mb-1 hidden lg:block"><em>{{ $instructor }}</em></p>
            @endif
            @if(!empty($logo))
                    <img class="@if(!empty($logoStyles)) {{ $logoStyles }} @endif hidden max-h-20 w-full mx-auto mb-4 object-contain lg:block" src="@if(str_contains($logo, 'amazonaws') || str_contains($logo, 'cloudfront')){{$logo}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$logo}}@endif" alt="logo">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                <p class="text-guitareo text-center font-bold text-sm leading-none mx-auto mb-1 md:text-base">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
                <div class="text-center leading-none text-3xl uppercase md:text-4xl"><s class="opacity-40 text-2xl">${{ floatVal($fullPrice) }}</s>
                    @if(number_format($price, 2) == intval($price))
                        <strong class="text-guitareo">$<span class="chosen-variant-price-float">{{  floatVal($price)  }}</span></strong>
                    @else
                        <strong class="text-guitareo">$<span class="chosen-variant-price-float">{{  floatVal(number_format($price, 2))  }}</span></strong>
                    @endif
                </div>
            @elseif(isset($price))
                <div class="text-center leading-none text-3xl uppercase md:text-4xl"><strong class="text-guitareo">$<span class="chosen-variant-price-float">{{ floatVal($price) }}</span></strong></div>
            @endif

            @if(!empty($specialText))
                <p class="text-center text-sm leading-none mx-auto mb-1 md:text-base italic" style="color:#F71B26;">{!! $specialText  !!}</p>
            @endif

            @if(!empty($soldOut) && $soldOut)
                <button class="border-none join w-full sm:w-1/2 lg:w-full sold-out">
                    SOLD OUT
                </button>
            @else
                @if($category !== 'bundles' && count($sizes) === 0 && !$bundle)
                    <a
                        class="online-atc vue-add-to-cart"
                        href="/ecommerce/add-to-cart?redirect=/shop&products[{!! $sku !!}]=1"
                        data-base-url="/ecommerce/add-to-cart?redirect=/shop&products[{!! $sku !!}]=1"
                        data-product-json='{"{!! $sku !!}": 1}'
                    >
                        <button class="border-none join"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                    </a>
                @elseif($bundle)
                    <a class="online-atc" href="/ecommerce/add-to-cart?redirect=/order&{{ $product->sku }}"
                       data-base-url="/ecommerce/add-to-cart?redirect=/order&{{ $product->sku }}">
                        <button class="border-none join w-full sm:w-1/2 lg:w-full"><i class="fas fa-cart-plus"></i> Order Now</button>
                    </a>
                @endif

                @if(!empty($sizes) && count($sizes) > 0)
                    <select class="pack-pick uppercase mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required>
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($sizes as $size)
                            <option
                                class="bg-white text-black"
                                @if($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStock() === 0) disabled @endif
                                value="@if(!empty($sku)){{$sku}}-@endif{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}"
                                data-price="{{!empty($size->price) ? $size->price : $price}}"
                                data-product-json='{"@if(!empty($sku)){{$sku}}-@endif{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1}'
                            >
                                {{ $size->name }}
                            </option>
                        @endforeach
                    </select>

                    <a
                        class="online-atc merch vue-add-to-cart selected-pack"
                        href="#"
                        @if(!empty($promoCode))
                        data-base-url="/ecommerce/add-to-cart?redirect=/order&promo-code={{$promoCode}}"
                        data-promocode="{{ $promoCode }}"
                        @else
                        data-base-url="/ecommerce/add-to-cart?redirect=/shop"
                        @endif
                        @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                    >
                        <button class="border-none join w-full sm:w-1/2 lg:w-full">
                            <i class="fas fa-cart-plus"></i> Add To Cart
                        </button>
                    </a>
                @endif
            @endif
            <p class="italic text-xs leading-normal text-center mx-auto">
                @if($freeShipping)
                    <i class="fas fa-truck"></i> <strong>FREE SHIPPING!</strong><br>
                @endif
                You can also order by phone toll-free at<br class="hidden sm:inline">
                <a class="text-guitareo" href="tel:+18004398921">1-800-439-8921</a> or directly at
                <a class="text-guitareo" href="tel:+16048557605">1-604-855-7605</a>. </p>
        </div>
        @if($guaranteeBadge)
            <div class="flex justify-center items-center px-5 py-2 text-center md:pt-2 md:pt-4 md:pb-6 lg:p-5 lg:-mt-1 lg:mx-auto border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="w-24 my-0 pr-6" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/guarantee-badge.png">
                <p class="text-xs font-bold text-left my-0 text-guitareo">Your entire order is backed by<br class="lg:hidden" /> our 90-Day Money Back <br class="lg:hidden" /> Guarantee.</p>
            </div>
        @endif
    </div>
    </div>
</div>
