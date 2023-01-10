{<li class="scalable-card {{ !empty($cardType) ? $cardType : '' }} {{ !empty($soldOut) ? 'sold-out' : '' }}" data-price="{{ floatVal($price) }}" data-category="{{ $category }}">
    <div class="flip-card-inner">
        <div class="flip-card-front card-inside">
            <section class="drum-shop">
                <div class="top-image @if(!empty($packLogo)) with-logo @endif" style="background-image:url('https://cdn.musora.com/image/fetch/w_600,q_auto:best/@if(str_contains($thumbnail, 'amazonaws') || str_contains($thumbnail, 'cloudfront')){{$thumbnail}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$thumbnail}}@endif')">
                    @if (!empty($badgeText))
                        <span class="top-left-badge text-white bg-promo">
                            {!! $badgeText !!}
                        </span>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <span class="top-left-badge text-white bg-promo">
                            Save {{ round(100 - (100 * ($price / $fullPrice))) }}%
                        </span>
                    @endif
                    @if(!empty($packLogo))
                        <div class="logo">
                            <img src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/@if(str_contains($packLogo, 'amazonaws') || str_contains($packLogo, 'cloudfront')){{$packLogo}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$packLogo}}@endif" alt="{{ $title }} logo">
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
                        <p><strong class="text-promo">{{ $specialPrice }}</strong></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p><s>WAS ${{ floatVal($fullPrice) }}</s>
                            <strong class="text-promo"> NOW
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatVal($price)  }}
                                @else
                                    ${{  floatVal(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p><strong class="text-promo">${{  floatVal($price)  }}</strong></p>
                    @endif
                </div>
            </section>
        </div>
        @if(empty($isBundle))
            <div class="flip-card-back">
                <div class="card-center">
                    <h6>{!! $title !!}</h6>
                    @if(!empty($packAuthor))
                        <p><em>{{ $packAuthor }}</em></p>
                    @endif
                    @if(!empty($cardDescription))
                        <p class="description">{!! $cardDescription  !!}</p>
                    @endif
                    @if(!empty($specialPrice))
                        <p><strong>{{  floatVal($specialPrice)  }}</strong><br><br></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p class="price"><s>${{ floatVal($fullPrice) }}</s> <strong class="text-promo">
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatVal($price)  }}
                                @else
                                    ${{  floatVal(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p class="price"><strong class="text-promo"> ${{  floatVal($price)  }}</strong></p>
                    @endif
                    @if(!empty($includedEdge))
                        <p class="description" style="top: -13px;position: relative;margin: 0;"><em class="text-red">Or free with {{ ucfirst($brand) }}</em></p>
                    @endif
                    @if(!$soldOut)
                        @if(!empty($sizes) && count($sizes) > 0)
                            <select class="pack-pick" title="Shirt Size" required>
                                <option hidden value="">Choose Size</option>
                                @foreach($sizes as $size)
                                    <option
                                        @if($products[$sku.'-'.($size_case_sensitive ? strtolower($size->code) : $size->code)]->getStockAvailability() === 0) disabled @endif
                                        value="?products[{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}]=1"
                                        data-product-json='{ "{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1 }'
                                    >
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>

                            <a
                                class="online-atc selected-pack vue-add-to-cart"
                                href="/ecommerce/add-to-cart?go-back-to-shop=true"
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
                                class="online-atc vue-add-to-cart" href="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"   data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                                data-product-json='{ "{{$sku}}": 1 }'
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join {{ $brand !== 'drumeo' ? 'bg-'.$brand : '' }}">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    <span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span>
                                </button>
                            </a>
                        @endif
                    @else
                        <a class="online-atc">
                            <button class="join sold-out">Sold Out</button>
                        </a>
                    @endif
                    @if(!empty($amazonLink))
                        <a href="{{ $amazonLink }}">
                            <button class="join amazon">Buy Through Amazon</button>
                        </a>
                    @endif
                    @if(!empty($itemURL))
                        <a href="{{ ($itemURL === '/drumshop/' || $itemURL === '/shop/') ? '/' : $itemURL }}" class="join outline bg-{{ $brand !== 'drumeo' ? 'black' : $brand}} transition duration-100" @if(!empty($externalURL)) target="_blank" @endif>
                            @if(!empty($buttonText)) {!!  $buttonText  !!} @elseif($itemURL === '/drumshop/') See the deal  @else View Product
                            <i class="fas fa-arrow-right"></i> @endif</a>
                    @endif
                    <p class="disclaimer"><em>@if($category !== 'lessons') Worldwide shipping. @endif All prices in USD. <br> <span style="color:red;"> @if(!empty($specialText)) {!!  $specialText  !!} @endif </span></em></p>
                </div>
            </div>
        @endif
    </div>
</li>
