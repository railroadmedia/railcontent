<a class="product-wrap text-black pb-2 md:pb-3 hover:opacity-90 transition-opacity" data-price="{{ floatVal($price) }}" data-category="{{ $category }}"
        @if(!empty($itemURL)) href="{{ ($itemURL === '/drumshop/' || $itemURL === '/shop/') ? '/' : $itemURL }}" @if(!empty($externalURL)) target="_blank" @endif @endif>
    <div class="overflow-hidden rounded-lg relative bg-cover bg-top mb-3 border border-gray-300" style="padding-bottom: 100%;background-image:url('https://www.musora.com/musora-cdn/image/width=520,quality=95/{{ $thumbnail }}');">
        @if (!empty($badgeText))
            <span class="top-left-badge bg-promo">
                                {!! $badgeText !!}
                            </span>
        @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
            <span class="top-left-badge bg-promo">
                                Save {{ round(100 - (100 * ($price / $fullPrice))) }}%
                            </span>
        @endif

        @if(!empty($sku) && (empty($sizes) || count($sizes) === 0))
        <p
                class="online-atc vue-add-to-cart add-to-cart-button text-black bg-white rounded-full absolute top-0 right-0 m-2 z-20 px-1.5 py-1 text-sm shadow-md"
                @if($theme !== 'musora')href="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1" @else @click="orderModal = true" @endif
                data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1" value="?products[{{ $sku }}]=1"
                data-product-json='{ "{{$sku}}": 1 }'
                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
        @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
        >
            <i class="fas fa-cart-plus"></i>
        </p>
        @endif

        @if(!empty($packLogo))
            <div class="z-20 absolute bottom-0 left-0 right-0 px-4 py-3">
                <img class="w-auto h-auto" style="max-height:55px;" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $packLogo }}"
                        alt="{{ $title }} logo" @if(!empty($FCP)) fetchpriority="high" @endif >
            </div>
            <div class="inset-0 absolute z-10" style="background:linear-gradient(to bottom, transparent 66%, rgba(0,0,0,0.75));"></div>
        @endif
    </div>
    <p class="leading-tight font-black mb-1">{!! $title !!}</p>
    @if(!empty($packAuthor))
        <p class="leading-tight text-sm mb-1">{{ $packAuthor }}</p>
    @endif
    @if(round(100 - (100 * ($price / $fullPrice))) > 1)
        <p class="leading-tight"><s>WAS ${{ floatVal($fullPrice) }}</s>
            <strong class="text-{{ $theme }} font-extrabold"> NOW
                @if(number_format($price, 2) == intval($price))
                    ${{  floatVal($price)  }}
                @else
                    ${{  number_format($price, 2)  }}
                @endif
            </strong></p>
    @else
        <p><strong class="leading-tight text-{{ $theme }} font-black">${{  floatVal($price)  }}</strong></p>
    @endif
</a>
