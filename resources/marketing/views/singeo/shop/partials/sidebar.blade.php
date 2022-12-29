{{--@php--}}
{{--    if(!empty($sku) && !empty($productStock[$sku]) && ($category !== 'lessons' && $category !== 'bundles')){--}}
{{--        $soldOut = $productStock[$sku]->isProductSoldOut();--}}
{{--    }--}}
{{--@endphp--}}

<div class="side-bar sliding-function px-3 md:px-4 lg:px-4 lg:w-1/3 lg:mt-5 lg:h-0 mb-4 lg:mb-0">
    <div id="order" class="anchor"></div>
    <div class="side-slide md:border md:border-solid md:rounded-md" style="border-color: #CCD3D3;">
        @include('_partials.layout.holiday.shop-sidebar-banner')

        <div class="active pt-2 px-5 pb-6 text-center md:py-6 md:px-4">
            @if(!empty($instructor))
                <p class="text-center text-sm uppercase mx-auto mb-1 hidden lg:inline"><em>{{ $instructor }}</em></p>
            @endif
            @if(!empty($logo))
                <img class="hidden lg:inline max-h-20 w-full mx-auto mb-4 object-contain lg:block" src="{{ $logo }}">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                <p class="text-singeo text-center font-bold text-sm leading-none mb-1 md:text-base">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
                <h1 class="text-center text-4xl no-leading uppercase md:text-3xl"><s class="opacity-40 text-2xl">${{ floatVal($fullPrice) }}</s>
                    @if(number_format($price, 2) == intval($price))
                        <strong class="font-black text-singeo">$<span class="text-singeo chosen-variant-price-float">{{  floatVal($price)  }}</span></strong>
                    @else
                        <strong class="font-black text-singeo">$<span class="text-singeo chosen-variant-price-float">{{  floatVal(number_format($price, 2))  }}</span></strong>
                    @endif
                </h1>
            @elseif(isset($price))
                <h1 class="text-center text-4xl no-leading uppercase md:text-3xl"><strong class="font-black text-singeo">Only $<span class="text-singeo chosen-variant-price-float">{{ floatVal($price) }}</span></strong></h1>
            @endif

            @if(!empty($specialText))
                <p class="text-center text-sm leading-none mb-1 md:text-base italic" style="color: #F71B26;">{!! $specialText  !!}</p>
            @endif

            @if(!empty($soldOut) && $soldOut)
                <button class="border-none join sold-out">
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
                    <a class="online-atc" href="/ecommerce/add-to-cart?redirect=/order&{!! $sku !!}"
                       data-base-url="/ecommerce/add-to-cart?redirect=/order&{!! $sku !!}">
                        <button class="border-none join"><i class="fas fa-cart-plus"></i> Order Now</button>
                    </a>
                @endif

                @if(!empty($sizes) && count($sizes) > 0)
                    <select class="pack-pick uppercase border-2 border-solid rounded-full font-bold text-xl w-full  h-auto py-2 pl-7 pr-5 bg-white md:py-2 lg:py-4" title="Shirt Size" required style="border-color: #717D80; color: #717D80; font-family: Roboto Condensed, sans-serif;">
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($sizes as $size)
                            <option
                                @if($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStockAvailability() === 0) disabled @endif
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
                        <button class="border-none join">
                            <i class="fas fa-cart-plus"></i> Add To Cart
                        </button>
                    </a>
                @endif
            @endif
            <p class="italic text-xs leading-normal text-center mx-auto">
                @if(!empty($freeShipping))
                    <i class="fas fa-truck"></i> <strong>FREE SHIPPING!</strong><br>
                @endif
                You can also order by phone toll-free at<br class="hidden sm:inline">
                <a class="text-singeo" href="tel:+18004398921">1-800-439-8921</a> or directly at
                <a class="text-singeo" href="tel:+16048557605">1-604-855-7605</a>.
            </p>
        </div>
        @if(!empty($guaranteeBadge))
            <div class="flex justify-center items-center px-5 pb-5 text-center md:pt-2 md:pt-4 md:pb-6 lg:p-5 lg:-mt-1 lg:mx-auto lg:mb-0 border-t-0 lg:border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="w-24 my-0 pr-6" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/guarantee.png">
                <p class="text-xs font-bold text-left my-0 text-singeo">Your entire order is backed by<br /> our 90-Day Money Back <br /> Guarantee.</p>
            </div>
        @endif
    </div>
</div>
