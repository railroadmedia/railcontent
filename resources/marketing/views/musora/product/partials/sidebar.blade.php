<?php
    $badge = '';

    if($theme === 'drumeo') {
        $badge = 'https://dpwjbsxqtam5n.cloudfront.net/sales/guarantee-badge.png';
    }
    elseif($theme === 'pianote') {
        $badge = 'https://pianote.s3.amazonaws.com/sales/guarantee-badge.png';
    }
    elseif($theme === 'singeo') {
        $badge = 'https://singeo.s3.amazonaws.com/sales/2021/guarantee.png';
    }
    elseif($theme === 'guitareo') {
        $badge = 'https://guitareo.s3.amazonaws.com/sales/guitareo-guarantee.png';
    }
?>

<div class="side-bar sliding-function lg:px-4 lg:w-1/3 px-3 md:px-4 lg:mt-10">
    <div id="order" class="anchor"></div>
    <div class="side-slide overflow-hidden md:rounded md:border md:border-solid" style="border-color: #CCD3D3;">
        {{--<div class="promo-tab hidden lg:block text-center py-2 px-3" style="position:relative;background:#000 center center/450px;">--}}
            {{--<img class="w-auto max-h-12" src="https://cdn.musora.com/image/fetch/w_200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/black-friday/xm-logo2021.png">--}}
        {{--</div>--}}
        <div class="buy-section active px-5 pt-2 pb-6 text-center lg:py-6">
            @if(!empty($instructor))
                <p class="instructor hidden lg:inline"><em>{{ $instructor }} </em></p>
            @endif
            @if(!empty($logo))
                <img class="hidden max-h-20 w-full mx-auto mb-4 object-contain lg:block" src="@if(str_contains($logo, 'amazonaws') || str_contains($logo, 'cloudfront')){{$logo}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$logo}}@endif">
            @endif

            @if(isset($fullPrice) && isset($price) && ($fullPrice - $price) > 0)
                <p class="text-center mx-auto mb-1 font-bold text-sm md:text-base" style="color:#10D05F">Save {{ round(100 - (100 * ($price / $fullPrice))) }}%</p>
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
                <p class="text-center mx-auto mb-1 text-sm italic md:text-base" style="color:#F71B26;">{!! $specialText  !!}</p>
            @endif

            @if(!$soldOut)
                @if(empty($bundle) && count($sizes) === 0)
                    <a
                        class="online-atc vue-add-to-cart"
                        href="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&products[{{ $sku }}]=1"
                        data-base-url="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&products[{{ $sku }}]=1"
                        data-product-json='{"{{ $sku }}": 1}'
                    >
                        <button class="join border-none"><i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart</button>
                    </a>
                @endif

                @if(!empty($sizes) && count($sizes) !== 0)
                    <select class="pack-pick mx-auto mt-4 border-2 rounded-full font-bold text-xl uppercase w-full h-auto py-2 pr-7 pl-5 bg-white md:py-2 lg:py-4" style="border-color: #717D80; color:#717D80; font-family: Roboto Condensed, sans-serif" title="Shirt Size" required>
                        <option hidden value="">@if(!empty($optionText)) {{ $optionText }} @else Choose Size @endif</option>
                        @foreach($sizes as $size)
                            <option
                                class="bg-white @if($size->sold_out) text-gray @else text-black @endif"
                                @if($size->sold_out) disabled @endif
                                value="{{$product->sku . '-' . $size->code}}"
                                data-price="{{floatVal($product->price) ?? 0}}"
                                data-product-json='{"{{$product->sku . '-' . $size->code}}": 1}'
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
                        <button class="join border-none w-full">
                            <i class="fas fa-cart-plus text-2xl mr-1"></i> Add To Cart
                        </button>
                    </a>
                @endif

                @if(!empty($bundle))
                    <a class="online-atc" href="/laravel/public/shopping-cart/api/query?{{ $sku }}"
                            data-base-url="/laravel/public/shopping-cart/api/query?{{ $sku }}">
                        <button class="join border-none"><i class="fas fa-cart-plus text-2xl mr-1"></i> Order Now</button>
                    </a>
                @endif
            @else
                <button class="join sold-out border-none">
                    SOLD OUT
                </button>
            @endif
            <p class="italic text-center mx-auto my-0 text-xs">
                @if($freeShipping)
                    <i class="fas fa-truck"></i> <strong>FREE SHIPPING!</strong><br>
                @endif
                You can also order by phone toll-free at<br class="hidden sm:inline">
                <a class="text-{{ $theme }} text-xs" href="tel:1-800-439-8921">1-800-439-8921</a> or directly at
                <a class="text-{{ $theme }} text-xs" href="tel:1-604-855-7605">1-604-855-7605</a>. </p>
        </div>
        @if($guaranteeBadge)
            <div class="flex justify-center items-center px-5 pb-5 text-center md:pt-2 md:pt-4 md:pb-6 lg:p-5 lg:-mt-1 lg:mx-auto lg:mb-0 border-t-0 lg:border-t" style="border-color: #CCD3D3; border-top-style: solid;">
                <img class="w-24 my-0 pr-6" src="https://cdn.musora.com/image/fetch/w_170,q_auto:best/{{ $badge }}">
                <p class="text-xs font-bold text-left my-0 text-{{ $theme }}">Your entire order is backed by<br class="lg:hidden" /> our 90-Day Money Back <br class="lg:hidden" /> Guarantee.</p>
            </div>
        @endif
    </div>
</div>
