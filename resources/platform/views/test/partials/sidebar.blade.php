<div class="side-bar sliding-function lg:tw-px-4 lg:tw-w-1/3 tw-px-3 md:tw-px-4">
    <div id="order" class="anchor"></div>
    <div class="side-slide tw-overflow-hidden md:tw-rounded md:tw-border md:tw-border-solid" style="border-color: #CCD3D3;">
        {{--<div class="promo-tab hidden lg:block text-center py-2 px-3" style="position:relative;background:#000 center center/450px;">--}}
            {{--<img class="w-auto max-h-12" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/xm-logo2021.png">--}}
        {{--</div>--}}

        <div class="buy-section active tw-px-5 tw-pt-2 tw-pb-6 tw-text-center lg:tw-py-6">
            @if(!empty($instructor))
                <p class="instructor tw-hidden lg:tw-inline"><em>{{ $instructor }} </em></p>
            @endif
            @if(!empty($logo))
                <img class="tw-hidden tw-max-h-20 tw-w-full tw-mx-auto tw-mb-4 tw-object-contain lg:tw-block" src="https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $logo }}">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                <p class="tw-text-center tw-mx-auto tw-mb-1 tw-font-bold tw-text-sm md:tw-text-base" style="color:#10D05F">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
                <h1 class="tw-text-center tw-text-3xl tw-uppercase md:tw-text-4xl" style="color:#F71B26;"><s class="tw-opacity-40 tw-text-2xl">${{ $fullPrice }}</s>
                    @if(number_format($price, 2) == intval($price))
                        <strong class="tw-font-black text-drumeo">$<span class="chosen-variant-price-float">{{  $price  }}</span></strong>
                    @else
                        <strong class="tw-font-black text-drumeo">$<span class="chosen-variant-price-float">{{  number_format($price, 2)  }}</span></strong>
                    @endif
                </h1>
            @elseif(isset($price))
                <h1 class="tw-text-center tw-text-3xl tw-uppercase md:tw-text-4xl"><strong class="tw-font-black text-drumeo">Only $<span class="chosen-variant-price-float">{{ $price }}</span></strong></h1>
            @endif

            @if(!empty($specialText))
                <p class="tw-text-center tw-mx-auto tw-mb-1 tw-text-sm tw-italic md:tw-text-base" style="color:#F71B26;">{!! $specialText  !!}</p>
            @endif

            @if(!$soldOut)
                @if(empty($bundle) && count($sizes) === 0)
                    <a
                        class="online-atc vue-add-to-cart"
                        href="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&products[{{ $sku }}]=1"
                        data-base-url="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&products[{{ $sku }}]=1"
                        data-product-json='{"{{ $sku }}": 1}'
                    >
                        <button class="join tw-border-none"><i class="fas fa-cart-plus tw-text-2xl tw-mr-1"></i> Add To Cart</button>
                    </a>
                @endif

                @if(!empty($sizes) && count($sizes) !== 0)
                    <select class="pack-pick tw-mx-auto tw-mt-4 tw-border-2 tw-rounded-full tw-font-bold tw-text-xl tw-uppercase tw-w-full tw-h-auto tw-py-2 tw-pr-7 tw-pl-5 tw-bg-white md:tw-py-2 lg:tw-py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required>
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($sizes as $size)
                            <option
                                class="tw-bg-white @if($size->sold_out) tw-text-gray @else tw-text-black @endif"
                                @if($size->sold_out) disabled @endif
                                value="{{$product->sku . '-' . $size}}"
                                data-price="{{$product->price ?? 0}}"
                                data-product-json='{"{{$product->sku . '-' . $size}}": 1}'
                            >{{ $size->name }}</option>
                        @endforeach
                    </select>

                    <a
                            class="online-atc merch vue-add-to-cart selected-pack"
                            href="#"
                            @if(!empty($promoCode))
                            data-base-url="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&promo-code={{$promoCode}}"
                            data-promocode="{{ $promoCode }}"
                            @else
                            data-base-url="/laravel/public/shopping-cart/api/query?go-back-to-shop=true"
                            @endif
                            @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                    >
                        <button class="join tw-border-none">
                            <i class="fas fa-cart-plus tw-text-2xl tw-mr-1"></i> Add To Cart
                        </button>
                    </a>
                @endif

                @if(!empty($bundle))
                    <a class="online-atc" href="/laravel/public/shopping-cart/api/query?{{ $sku }}"
                            data-base-url="/laravel/public/shopping-cart/api/query?{{ $sku }}">
                        <button class="join tw-border-none"><i class="fas fa-cart-plus tw-text-2xl tw-mr-1"></i> Order Now</button>
                    </a>
                @endif
            @else
                <button class="join sold-out tw-border-none">
                    SOLD OUT
                </button>
            @endif
            <p class="tw-italic tw-text-center tw-mx-auto tw-my-0 tw-text-xs">
                @if(!empty($freeShipping))
                    <i class="fas fa-truck"></i> <strong>FREE SHIPPING!</strong><br>
                @endif
                You can also order by phone toll-free at<br class="tw-hidden sm:tw-inline">
                <a class="text-drumeo" href="tel:1-800-439-8921">1-800-439-8921</a> or directly at
                <a class="text-drumeo" href="tel:1-604-855-7605">1-604-855-7605</a>. </p>
        </div>
        @if(!empty($guaranteeBadge))
            <div class="tw-flex tw-justify-center tw-items-center tw-px-5 tw-pb-5 tw-text-center md:tw-pt-2 md:tw-pt-4 md:tw-pb-6 lg:tw-p-5 lg:tw--mt-1 lg:tw-mx-auto lg:tw-mb-0 tw-border-t-0 lg:tw-border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="tw-w-24 tw-my-0 tw-pr-6" src="https://cdn.musora.com/image/fetch/w_170,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png">
                <p class="tw-text-xs tw-font-bold tw-text-left tw-my-0 text-drumeo">Your entire order is backed by<br class="lg:tw-hidden" /> our 90-Day Money Back <br class="lg:tw-hidden" /> Guarantee.</p>
            </div>
        @endif
    </div>
</div>
