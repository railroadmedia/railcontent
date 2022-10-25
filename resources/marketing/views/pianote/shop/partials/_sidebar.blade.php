<div class="shop-sidebar sliding-function tw-px-3 md:tw-px-4 lg:tw-px-4 lg:tw-w-1/3 lg:tw-mt-5">
    <div class="lg:tw-h-0">
    <div id="order" class="anchor"></div>
    <div class="side-slide md:tw-border md:tw-border-solid md:tw-rounded-md" style="border-color: #CCD3D3;">
        {{--<div class="promo-tab hidden tw-hidden lg:block lg:tw-block text-center tw-text-center py-2 px-3 tw-py-2 tw-px-3" style="position:relative;background: linear-gradient(to bottom, #dfeef2, #f9e4d3);">--}}
            {{--<img class="w-auto max-h-12 tw-max-h-12" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/july/pianote-summer-sale-dark.png">--}}
        {{--</div>--}}
        <div class="tw-pt-2 tw-px-5 tw-pb-6 tw-text-center md:tw-py-6 md:tw-px-4">
            @if(!empty($instructor))
                <p class="tw-text-center tw-text-sm tw-uppercase tw-mx-auto tw-mb-1 tw-hidden lg:tw-inline"><em>{{ $instructor }}</em></p>
            @endif
            @if(!empty($logo))
                <img class="tw-hidden lg:tw-inline tw-max-h-24 tw-w-full tw-mx-auto tw-object-contain lg:tw-block" src="{{ $logo }}">
            @endif
            @if(($fullPrice - $price) > 0)
                <p class="tw-text-center tw-font-bold tw-text-sm tw-leading-none tw-mb-1 md:tw-text-base" style="color:#10D05F;">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
                <h1 class="tw-text-center tw-text-4xl tw-no-leading tw-uppercase md:tw-text-3xl"><s style="color:#8C9698;">${{ $fullPrice }}</s> <strong class="text-pianote">${{ $price }}</strong></h1>
            @else
                <h1 class="tw-text-center tw-text-4xl tw-no-leading tw-uppercase md:tw-text-3xl"><strong class="text-pianote">Only ${{ $price }}</strong></h1>
            @endif
            @if(!empty($specialText))
                <p class="tw-text-center tw-text-sm tw-leading-none tw-mb-1 md:tw-text-base text-pianote tw-italic">{!! $specialText  !!}</p>
            @endif
            @if(empty($soldOut))
                @if(empty($bundle) && empty($options))
                    <a
                        class="online-atc vue-add-to-cart"
                        href="/ecommerce/add-to-cart?redirect=%2Fshop&products[{{ $sku }}]=1"
                        data-base-url="/ecommerce/add-to-cart?redirect=%2Fshop&products[{{ $sku }}]=1"
                        data-product-json='{"{{ $sku }}": 1}'
                    >
                        <button class="join tw-text-xl tw-leading-none tw-uppercase tw-text-white tw-w-full tw-py-4 tw-px-2 tw-rounded-full tw-border-0 tw-mx-auto tw-my-2 md:tw-py-5 md:tw-py-2 md:tw-my-4 md:tw-mx-auto hover:tw-opacity-90"><i class="fas fa-cart-plus tw-text-2xl tw-mr-1"></i> Add To Cart</button>
                    </a>
                @endif
                @if(!empty($options))
                    <select class="pack-pick tw-mx-auto tw-mt-4 tw-border-2 tw-rounded-full tw-font-bold tw-text-xl tw-uppercase tw-w-full tw-h-auto tw-py-2 tw-pr-7 tw-pl-5 tw-bg-white md:tw-py-2 lg:tw-py-4" style="border-color: #717D80; color:#717D80;" title="Shirt Size" required>
                        <option hidden value="">Choose Size</option>
                        @foreach($variations as $variant)
                            <option
                                    @if(isset($variant->soldOut) && $variant->soldOut) disabled @endif
                            value="{{$variant->sku}}"
                                    data-product-json='{"{{$variant->sku}}": 1}'
                            >{{ $variant->name }}</option>
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
                        <button class="join tw-text-xl tw-leading-none tw-uppercase tw-text-white tw-w-full tw-py-4 tw-px-2 tw-rounded-full tw-border-0 tw-mx-auto tw-my-2 md:tw-py-5 md:tw-py-2 md:tw-my-4 md:tw-mx-auto hover:tw-opacity-90">
                            <i class="fas fa-cart-plus tw-text-2xl tw-mr-1"></i> Add To Cart
                        </button>
                    </a>
                @endif
                @if(!empty($bundle))
                    <a class="online-atc" href="/ecommerce/add-to-cart?redirect=%2Forder&{{ $sku }}"
                            data-base-url="/ecommerce/add-to-cart?redirect=%2Forder&{{ $sku }}">
                        <button class="join green tw-text-xl tw-leading-none tw-uppercase tw-text-white tw-w-full tw-py-4 tw-px-2 tw-rounded-full tw-border-0 tw-mx-auto tw-my-2 md:tw-py-5 md:tw-py-2 md:tw-my-4 md:tw-mx-auto hover:tw-opacity-90"><i class="fas fa-cart-plus tw-text-2xl tw-mr-1"></i> Order Now</button>
                    </a>
                @endif
            @else
                <button class="join sold-out tw-text-xl tw-leading-none tw-uppercase tw-text-white tw-w-full tw-py-4 tw-px-2 tw-rounded-full tw-border-0 tw-mx-auto tw-my-2 md:tw-py-5 md:tw-py-2 md:tw-my-4 md:tw-mx-auto hover:tw-opacity-90" {{--style="background: #777;"--}}>
                    Sold Out
                </button>
            @endif
            @if(!empty($shippingdelay))
                <p class="tw-mt-0 tw-text-xs">{!! $shippingdelay !!}</p>
            @endif
            <p class="tw-text-black tw-italic tw-text-xs tw-leading-normal tw-text-center tw-mx-auto">You can also order by phone toll-free at<br class="tw-hidden sm:tw-inline">
                    <a class="text-pianote" href="tel:1-800-439-8921">1-800-439-8921</a> or directly at
                    <a class="text-pianote" href="tel:1-604-855-7605">1-604-855-7605</a>. </p>
        </div>
        @if(!empty($guaranteeBadge))
            <div class="tw-flex tw-justify-center tw-items-center tw-px-5 tw-pb-5 tw-text-center md:tw-pt-2 md:tw-pt-4 md:tw-pb-6 lg:tw-p-5 lg:tw--mt-1 lg:tw-mx-auto lg:tw-mb-0 tw-border-t-0 lg:tw-border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="tw-w-36 tw-my-0 tw-pr-6" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/90-day.png">
                <p class="tw-text-xs tw-font-bold tw-text-left tw-my-0 text-pianote">Your entire order is backed by<br class="lg:tw-hidden" /> our 90-Day Money Back <br class="lg:tw-hidden" /> Guarantee.</p>
            </div>
        @endif
    </div>
</div>
</div>