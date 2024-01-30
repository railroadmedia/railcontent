<a class="product-wrap relative text-black pb-4 hover:opacity-90 transition-opacity" data-price="{{ floatVal($discounted_price) }}"
    @if(!empty($href)) href="{{ ($href === '/drumshop/' || $href === '/shop/') ? '/' : $href }}" @if(!empty($external)) target="_blank" @endif @endif
x-data="{ open: false }">
    @if(!empty($sizes) && count($sizes) > 0)
        <div x-cloak x-bind:class="open ? 'max-h-[1000px] p-3 pb-2' : 'max-h-0'" x-on:click.outside="open = false"
            class="transition-opacity transition-transform duration-200 overflow-hidden absolute top-0 left-0 right-0 z-40 rounded-lg"
            style="background:rgba(0, 0, 0, 0.8);">
            @foreach($sizes as $size)
                @if($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStockAvailability() !== 0)
                    <p class="online-atc vue-add-to-cart add-to-cart-button text-black bg-white rounded-full mb-1 z-20 px-2 py-1 text-sm shadow-md font-black hover:opacity-90"

                        value="?products[{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}]=1"
                        data-product-json='{ "{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1 }'
                        @if($theme !== 'musora') href="/ecommerce/add-to-cart?go-back-to-shop=true" @endif
                    @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                    @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                    >
                        {{ $size->name }}
                    </p>
                @endif
            @endforeach
        </div>
    @endif
    <div class="overflow-hidden rounded-lg relative bg-cover bg-top mb-3 border border-gray-300" style="padding-bottom: 100%;background-image:url('https://www.musora.com/musora-cdn/image/width=520,quality=95/{{ $thumbnail }}');">
        @if (!empty($badge))
            <p class="absolute top-0 left-0 rounded-br-md bg-musora text-black font-black leading-none uppercase py-1 px-2 w-auto inline-block text-xs">{!! $badge !!}</p>
        @endif
        @if(!$soldOut)
            @if(!empty($sizes) && count($sizes) > 0)
                <p class="online-atc vue-add-to-cart add-to-cart-button text-black bg-white rounded-full absolute top-0 right-0 m-2 z-20 px-1.5 py-1 text-sm shadow-md"
                    x-on:click="open = !open;"
                ><i class="fas fa-cart-plus"></i></p>
            @elseif(!empty($sku) && (empty($sizes) || count($sizes) === 0))
                <p
                    class="online-atc vue-add-to-cart add-to-cart-button text-black bg-white rounded-full absolute top-0 right-0 m-2 z-20 px-1.5 py-1 text-sm shadow-md"
                    href="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                    data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                    value="?products[{{ $sku }}]=1"
                    data-product-json='{ "{{$sku}}": 1 }'
                    @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                ><i class="fas fa-cart-plus"></i></p>
            @endif
        @endif

        @if(!empty($logo))
            <div class="z-20 absolute bottom-0 left-0 right-0 px-4 py-3 text-center">
                <img class="w-auto h-auto" style="max-height:55px;" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $logo }}"
                    alt="{{ $title }} logo" @if(!empty($fetch)) fetchpriority="high" @endif >
            </div>
            <div class="inset-0 absolute z-10" style="background:linear-gradient(to bottom, transparent 66%, rgba(0,0,0,0.75));"></div>
        @endif
    </div>
    <p class="leading-tight font-black mb-1">{!! $title !!}</p>
    @if(!empty($instructor))
        <p class="leading-tight text-sm mb-1">{{ $instructor }}</p>
    @endif
    <p class="leading-tight">
        @if(round(100 - (100 * ($discounted_price / $price))) > 1)
            <s class="opacity-60">${{ floatVal($price) }}</s>
        @endif
        <strong class="text-{{ $theme }} font-extrabold">
            @if(number_format($discounted_price, 2) == intval($discounted_price))
                ${{  floatVal($discounted_price)  }}
            @else
                ${{  number_format($discounted_price, 2)  }}
            @endif
        </strong>
        @if (round(100 - (100 * ($discounted_price / $price))) > 1)
            <span class="ml-1 text-xs bottom-0 font-black text-black rounded-md px-1.5 leading-none py-1 inline-block bg-musora align-bottom">Save {{ round(100 - (100 * ($discounted_price / $price))) }}%</span>
        @endif
    </p>
</a>
