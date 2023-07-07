<li class="scalable-card {{ !empty($cardType) ? $cardType : '' }} {{ !empty($soldOut) ? 'sold-out' : '' }}" data-price="{{ floatVal($price) }}" data-category="{{ $category }}">
    <div class="flip-card-inner">
        <div class="flip-card-front card-inside">
            <section class="drum-shop">
                <div class="top-image @if(!empty($packLogo)) with-logo @endif">
                    <picture>
                        <source media="(min-width: 640px)" srcset="{{ 'https://www.musora.com/musora-cdn/image/width=600,quality=85/'.$thumbnail }}">
                        <img class="absolute w-full h-full top-0 left-0 object-top object-cover" src="{{ 'https://www.musora.com/musora-cdn/image/width=400,quality=85/'.$thumbnail }}" alt="{{ $title }} thumbnail" @if(!empty($FCP)) fetchpriority="high" @endif />
                    </picture>

                    @if (!empty($badgeText))
                        <span class="top-left-badge bg-promo">
                            {!! $badgeText !!}
                        </span>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <span class="top-left-badge bg-promo">
                            Save {{ round(100 - (100 * ($price / $fullPrice))) }}%
                        </span>
                    @endif
                    @if(!empty($packLogo))
                        <div class="logo">
                            <picture>
                                <source media="(min-width: 640px)" srcset="{{ 'https://www.musora.com/musora-cdn/image/width=600,quality=85/'.$packLogo }}">
                                <img @if($sku === '30-day-drummer-2') class="max-h-full h-24" @endif src="{{ 'https://www.musora.com/musora-cdn/image/width=300,quality=85/'.$packLogo }}" alt="{{ $title }} logo" @if(!empty($FCP)) fetchpriority="high" @endif >
                            </picture>

                        </div>
                    @endif
                    <i class="fas fa-arrow-right hover-icon"></i>
                </div>
                <div class="bottom-section">
                    <h6>{!! $title !!}</h6>
                    @if(!empty($packAuthor))
                        <p><em>{{ $packAuthor }}</em></p>
                    @endif
                    @if(!empty($specialPrice))
                        <p><strong class="text-{{ $theme }}">{{ $specialPrice }}</strong></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p><s>WAS ${{ floatVal($fullPrice) }}</s>
                            <strong class="text-{{ $theme }}"> NOW
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatVal($price)  }}
                                @else
                                    ${{  floatVal(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p><strong class="text-{{ $theme }}">${{  floatVal($price)  }}</strong></p>
                    @endif
                </div>
            </section>
        </div>
        @if(empty($isBundle))
            <div class="flip-card-back">
                <div class="card-center">
                    <h6 class="font-black">{!! $title !!}</h6>
                    @if(!empty($packAuthor))
                        <p><em>{{ $packAuthor }}</em></p>
                    @endif
                    @if(!empty($cardDescription))
                        <p class="description leading-normal my-2">{!! $cardDescription  !!}</p>
                    @endif
                    @if(!empty($specialPrice))
                        <p class="text-promo mb-4"><strong class="font-black">{{  $specialPrice  }}</strong></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p class="leading-tight mb-2 price"><s>${{ floatVal($fullPrice) }}</s> <strong class="font-black text-promo">
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatVal($price)  }}
                                @else
                                    ${{  floatVal(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p class="leading-tight mb-2 price"><strong class="font-black text-promo"> ${{  floatVal($price)  }}</strong></p>
                    @endif
                    @if(!empty($includedEdge))
                        <p class="description relative -mt-2 mb-1"><em class="text-red">Or free with {{ ucfirst($theme) }}</em></p>
                    @endif
                    @if(!$soldOut)
                        @if(!empty($sizes) && count($sizes) > 0)
                            <select class="pack-pick" title="Shirt Size" required>
                                <option hidden value="">Choose Size</option>
                                @foreach($sizes as $size)
                                    <option
                                        @if(empty($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]) || $products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStockAvailability() === 0) disabled @endif
                                        value="?products[{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}]=1"
                                        data-product-json='{ "{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1 }'
                                    >
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>

                            <a
                                class="online-atc selected-pack vue-add-to-cart"
                                @if($theme !== 'musora') href="/ecommerce/add-to-cart?go-back-to-shop=true" @endif
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    <span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span>
                                </button>
                            </a>
                        @elseif(!empty($sku) && (empty($sizes) || count($sizes) === 0))
                            <a
                                class="online-atc vue-add-to-cart add-to-cart-button" @if($theme !== 'musora')href="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1" @else @click="orderModal = true" @endif   data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1" value="?products[{{ $sku }}]=1"
                                data-product-json='{ "{{$sku}}": 1 }'
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join {{ ($theme !== 'drumeo' && $theme !== 'musora') ? 'bg-'.$theme : '' }}">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    <span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span>
                                </button>
                            </a>
                        @endif
                    @else
                        <span class="online-atc">
                            <button class="join sold-out">Sold Out</button>
                        </span>
                    @endif
                    @if(!empty($amazonLink))
                        <a href="{{ $amazonLink }}">
                            <button class="join amazon">Buy Through Amazon</button>
                        </a>
                    @endif
                    @if(!empty($itemURL))
                        <a href="{{ ($itemURL === '/drumshop/' || $itemURL === '/shop/') ? '/' : $itemURL }}" class="join mb-0 bg-{{ $theme !== 'drumeo' ? 'black' : $theme}} transition duration-100" @if(!empty($externalURL)) target="_blank" @endif>
                            @if(!empty($buttonText)) {!!  $buttonText  !!} @elseif($itemURL === '/drumshop/') See the deal  @else View Product
                            <i class="fas fa-arrow-right"></i> @endif</a>
                    @endif
                    <p class="disclaimer"><em>@if($category !== 'lessons') Worldwide shipping. @endif All prices in USD. <br> <span style="color:red;"> @if(!empty($specialText)) {!!  $specialText  !!} @endif </span></em></p>
                </div>
            </div>
        @endif
    </div>
</li>
