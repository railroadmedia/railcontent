<div class="side-bar sliding-function tw-px-3 md:tw-px-4 lg:tw-px-4 lg:tw-w-1/3 lg:tw-mt-5">
    <div class="lg:tw-h-0">
    <div id="order" class="anchor"></div>
    <div class="side-slide tw-overflow-hidden md:tw-rounded tw-border tw-border-solid" style="border-color: #CCD3D3;">
        {{--<div class="promo-tab hidden tw-hidden lg:block lg:tw-block text-center tw-text-center py-2 px-3 tw-py-2 tw-px-3" style="position:relative;background: linear-gradient(to bottom, #dfeef2, #f9e4d3);">--}}
            {{--<img class="w-auto max-h-12 tw-max-h-12" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/july/guitareo-summer-sale-dark.png">--}}
        {{--</div>--}}
        <div class="buy-section active tw-px-5 tw-pt-2 tw-pb-6 tw-text-center lg:tw-py-6">
            @if(!empty($instructor))
                <p class="tw-text-center tw-text-sm tw-uppercase tw-mx-auto tw-mb-1 tw-hidden lg:tw-block"><em>{{ $instructor }}</em></p>
            @endif
            @if(!empty($logo))
                <img class="tw-mx-auto tw-w-auto tw-max-h-28 tw-hidden lg:tw-inline" src="{{ $logo }}">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                <p class="tw-text-guitareo tw-text-center tw-font-bold tw-text-sm tw-leading-none tw-mx-auto tw-mb-1 md:tw-text-base">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
                <div class="tw-text-center tw-leading-none tw-text-3xl tw-uppercase md:tw-text-4xl"><s class="tw-opacity-40 tw-text-2xl">${{ $fullPrice }}</s>
                    @if(number_format($price, 2) == intval($price))
                        <strong class="tw-text-guitareo">$<span class="chosen-variant-price-float">{{  $price  }}</span></strong>
                    @else
                        <strong class="tw-text-guitareo">$<span class="chosen-variant-price-float">{{  number_format($price, 2)  }}</span></strong>
                    @endif
                </div>
            @elseif(isset($price))
                <div class="tw-text-center tw-leading-none tw-text-3xl tw-uppercase md:tw-text-4xl"><strong class="tw-text-guitareo">Only $<span class="chosen-variant-price-float">{{ $price }}</span></strong></div>
            @endif

            @if(!empty($specialText))
                <p class="tw-text-center tw-text-sm tw-leading-none tw-mx-auto tw-mb-1 md:tw-text-base tw-italic" style="color:#F71B26;">{!! $specialText  !!}</p>
            @endif

            @if(empty($soldOut))
                @if(empty($bundle) && empty($options))
                    <a
                        class="online-atc vue-add-to-cart"
                        href="/ecommerce/add-to-cart?redirect=/shop&products[{{ $sku }}]=1"
                        data-base-url="/ecommerce/add-to-cart?redirect=/shop&products[{{ $sku }}]=1"
                        data-product-json='{"{{ $sku }}": 1}'
                    >
                        <button class="tw-border-none join"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                    </a>
                @endif

                @if(!empty($options))
                    <select class="pack-pick tw-uppercase tw-mx-auto tw-mt-4 tw-border-2 tw-rounded-full tw-font-bold tw-text-xl tw-uppercase tw-w-full tw-h-auto tw-py-2 tw-pr-7 tw-pl-5 tw-bg-white md:tw-py-2 lg:tw-py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required>
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($variations as $variant)
                            <option
                                class="tw-bg-white tw-text-black"
                                @if(isset($variant->soldOut) && $variant->soldOut) disabled @endif
                                value="{{$variant->sku}}"
                                data-price="{{$variant->price ?? 0}}"
                                data-product-json='{"{{$variant->sku}}": 1}'
                            >{{ $variant->name }}</option>
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
                        <button class="tw-border-none join tw-w-full sm:tw-w-1/2 lg:tw-w-full">
                            <i class="fas fa-cart-plus"></i> Add To Cart
                        </button>
                    </a>
                @endif

                @if(!empty($bundle))
                    <a class="online-atc" href="/ecommerce/add-to-cart?redirect=/order&{{ $sku }}"
                            data-base-url="/ecommerce/add-to-cart?redirect=/order&{{ $sku }}">
                        <button class="tw-border-none join tw-w-full sm:tw-w-1/2 lg:tw-w-full"><i class="fas fa-cart-plus"></i> Order Now</button>
                    </a>
                @endif
            @else
                <button class="tw-border-none join tw-w-full sm:tw-w-1/2 lg:tw-w-full sold-out">
                    SOLD OUT
                </button>
            @endif
            <p class="tw-italic tw-text-xs tw-leading-normal tw-text-center tw-mx-auto">
                @if(!empty($freeShipping))
                    <i class="fas fa-truck"></i> <strong>FREE SHIPPING!</strong><br>
                @endif
                You can also order by phone toll-free at<br class="tw-hidden sm:tw-inline">
                <a class="tw-text-guitareo" href="tel:1-800-439-8921">1-800-439-8921</a> or directly at
                <a class="tw-text-guitareo" href="tel:1-604-855-7605">1-604-855-7605</a>. </p>
        </div>
        @if(!empty($guaranteeBadge))
            <div class="tw-flex tw-justify-center tw-items-center tw-px-5 tw-py-2 tw-text-center md:tw-pt-2 md:tw-pt-4 md:tw-pb-6 lg:tw-p-5 lg:tw--mt-1 lg:tw-mx-auto lg:tw-mb-0 tw-border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="tw-w-24 tw-my-0 tw-pr-6" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2021/guarantee-badge.png">
                <p class="tw-text-xs tw-font-bold tw-text-left tw-my-0 tw-text-guitareo">Your entire order is backed by<br class="lg:tw-hidden" /> our 90-Day Money Back <br class="lg:tw-hidden" /> Guarantee.</p>
            </div>
        @endif
    </div>
    </div>
</div>