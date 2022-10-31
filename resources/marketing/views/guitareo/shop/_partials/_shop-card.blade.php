{{--@php    --}}
{{--    $soldOut = false;--}}

{{--    if(!empty($sku) && !empty($productStock[$sku]) && ($category !== 'lessons' && $category !== 'bundles')){--}}
{{--        $soldOut = $productStock[$sku]->isProductSoldOut();--}}
{{--    }--}}
{{--@endphp--}}

<li class="scalable-card {{ !empty($cardType) ? $cardType : '' }} {{ $soldOut ? 'sold-out' : '' }}" data-price="{{ $price }}" data-category="{{ $category }}">
    <div class="flip-card-inner">
        <div class="flip-card-front card-inside">
            <section class="drum-shop">
                <div class="top-image @if(!empty($packLogo)) with-logo @endif" style="background-image:url(https://cdn.musora.com/image/fetch/w_600,q_auto:best/{{ $thumbnail }});">
                    @if (!empty($badgeText))
                        <span class="top-left-badge">
                            {!! $badgeText !!}
                        </span>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <span class="top-left-badge">
                            Save {{ round(100 - (100 * ($price / $fullPrice))) }}%
                        </span>
                    @endif
                    @if(!empty($packLogo))
                        <div class="logo">
                            <img src="{{ $packLogo }}" alt="{{ $title }} logo">
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
                        <p><strong>{{ $specialPrice }}</strong></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p><s>WAS ${{ floatval($fullPrice) }}</s>
                            <strong> NOW
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatval($price)  }}
                                @else
                                    ${{  floatval(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p><strong>${{  floatval($price)  }}</strong></p>
                    @endif
                </div>
            </section>
        </div>
        @if($category !== 'bundles')
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
                        <p><strong>{{  $specialPrice  }}</strong><br><br></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p class="price"><s>${{ floatval($fullPrice) }}</s> <strong>
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatval($price)  }}
                                @else
                                    ${{  floatval(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p class="price"><strong> ${{  floatval($price ) }}</strong></p>
                    @endif
                    @if(!empty($includedEdge))
                        <p class="description" style="top: -13px;position: relative;margin: 0;"><em class="text-red">Or free with Guitareo</em></p>
                    @endif
                    @if(!$soldOut)
                        @if(!empty($sizes) && count($sizes) > 0)
                            <select class="pack-pick" title="Shirt Size" required>
                                <option hidden value="">Choose Size</option>
                                @foreach($sizes as $size)
                                    <option
                                        @if(isset($size->soldOut) && $size->soldOut) disabled @endif
                                    {{-- @if($productStock[$sku.'-'.$size->code]->isProductSoldOut()) disabled @endif --}}
                                        value="&products[{{$sku}}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}]=1"
                                        data-product-json='{ "{{$sku}}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1 }'
                                    >
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                            <a
                                class="online-atc selected-pack vue-add-to-cart"
                                href="/ecommerce/add-to-cart?redirect=/shop"
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    {{-- <span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span> --}}
                                </button>
                            </a>
                        @elseif(!empty($sku) && empty($sizes))
                            <a
                                class="online-atc vue-add-to-cart"
                                href="/ecommerce/add-to-cart?redirect=/shop&products[{{ $sku }}]=1&redirect={{ $redirectUrl ?? '/shop' }}"
                                data-base-url="/ecommerce/add-to-cart?redirect=/shop&products[{{ $sku }}]=1&redirect={{ $redirectUrl ?? '/shop' }}"
                                data-product-json='{ "{{ $sku }}": 1}'
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    {{--<span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span>--}}
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
                        <a href="{{ ($itemURL === '/shop/guitareo') ? '/' : $itemURL }}" class="join outline" @if(!empty($externalURL)) target="_blank" @endif>
                            @if(!empty($buttonText)) {!!  $buttonText  !!} @else View Product
                            <i class="fas fa-arrow-right"></i> @endif</a>
                    @endif
                    <p class="disclaimer"><em>@if($category !== 'lessons') Worldwide shipping. @endif All prices in USD. <br> <span style="color:red;"> @if(!empty($specialText)) {!!  $specialText  !!} @endif </span></em></p>
                </div>
            </div>
        @endif
    </div>
</li>
