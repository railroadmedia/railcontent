<li class="scalable-card {{ !empty($cardType) ? $cardType : '' }} {{ !empty($soldOut) ? 'sold-out' : '' }}"
    data-price="{{ $price }}">
    <div class="flip-card-inner">
        <div class="flip-card-front card-inside">
            <section class="drum-shop h-full flex flex-col">
                <div class="top-image @if(!empty($thumbnail_logo)) with-logo @endif"
                     style="flex: 1; background-image:url(https://www.musora.com/musora-cdn/image/width=600,quality=95/{{$thumbnail}}"
                     ;>
                    @if (!empty($badgeText))
                        <span
                            class="bg-{{ $theme }} text-white rounded-br-md py-1 px-2 font-roboto absolute top-0 left-0 uppercase font-bold text-[11px]">
                            {!! $badgeText !!}
                        </span>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <span
                            class="bg-[#FFAC00] rounded-br-md py-1 px-2 font-roboto absolute top-0 left-0 uppercase font-bold text-[11px]">
                            Save {{ round(100 - (100 * ($price / $fullPrice))) }}%
                        </span>
                    @endif
                    @if (!empty($soldOut) && $soldOut)
                        <span
                            class="bg-{{ $theme }} text-white rounded-br-md py-1 px-2 font-roboto absolute top-0 left-0 uppercase font-bold text-[11px]">
                                sold out
                        </span>
                    @endif
                    @if(!empty($thumbnail_logo))
                        <div class="logo">
                            <img class="mx-auto"
                                 src="{{$thumbnail_logo}}"
                                 alt="packLogo">
                        </div>
                    @endif
                    <i class="fas fa-arrow-right hover-icon"></i>
                </div>
                <div class="p-2 px-2 pb-4 md:py-4 border-t border-[#ddd]">
                    <h6 class="lg:text-base font-bold">{!! $title !!}</h6>
                    @if(!empty($packAuthor))
                        <p><em>{{ $packAuthor }}</em></p>
                    @endif
                    @if(!empty($specialPrice))
                        <p class="text-{{$theme}}"><strong>{{ $specialPrice }}</strong></p>
                    @elseif(!empty($soldOut) && $soldOut)
                        <p class="text-{{$theme}}"><strong>SOLD OUT</strong></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p><s class="text-[#9da6a8]">WAS ${{ floatval($fullPrice) }}</s>
                            <strong class="text-{{$theme}}"> NOW
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatval($price)  }}
                                @else
                                    ${{  number_format($price, 2)  }}
                                @endif
                            </strong></p>
                    @else
                        <p><strong class="text-{{$theme}}">${{  floatval($price)  }}</strong></p>
                    @endif
                </div>
            </section>
        </div>
        @if(empty($isBundle))
            <div class="flip-card-back">
                <div class="card-center p-4 lg:p-5">
                    <h6>{!! $title !!}</h6>
                    @if(!empty($packAuthor))
                        <p><em>{{ $packAuthor }}</em></p>
                    @endif
                    @if(!empty($cardDescription))
                        <p class="text-xs my-2 mx-auto">{!! $cardDescription  !!}</p>
                    @endif
                    @if(!empty($specialPrice))
                        <p><strong>{{  $specialPrice  }}</strong><br><br></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p class="text-[22px] md:text-[26px] lg:text-3xl mb-3"><s
                                class="text-[#9da6a8]">${{ floatval($fullPrice) }}</s> <strong
                                class="text-{{ $theme }}">
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatVal($price)  }}
                                @else
                                    ${{  number_format($price, 2)  }}
                                @endif
                            </strong></p>
                    @else
                        <p class="text-{{ $theme }} text-[22px] md:text-[26px] lg:text-3xl mb-3"><strong>
                                ${{  floatVal($price)  }}</strong></p>
                    @endif
                    @if(!empty($includedEdge))
                        <p class="description relative m-0" style="top: -13px;"><em class="text-red">Or free
                                with {{ ucfirst($theme) }}</em></p>
                    @endif
                    @if(empty($soldOut))
                        @if(!empty($sizes) && count($sizes) > 0)
                            <select class="pack-pick text-center" title="Shirt Size" required
                                    style="text-align-last: center;">
                                <option hidden value="">Choose Size</option>
                                @foreach($sizes as $size)
                                    <option
                                        class="text-left"
                                        @if($size->sold_out) disabled @endif
                                        value="?products[{!! $sku !!}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}]=1"
                                        data-product-json='{"{{$sku}}-{{(!empty($size_case_sensitive) && $size_case_sensitive) ? strtolower($size->code) : $size->code}}": 1}'
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
                                <button class="btn-primary bg-[#10d05f] hover:bg-opacity-80">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    <span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span>
                                </button>
                            </a>
                        @elseif(!empty($sku))
                            <a
                                class="online-atc vue-add-to-cart"
                                href="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                                data-base-url="/ecommerce/add-to-cart?go-back-to-shop=true&products[{!! $sku !!}]=1"
                                @isset($productJson) data-product-json='{{ $productJson }}' @endisset
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="btn-primary bg-[#10d05f] hover:bg-opacity-80">
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
                        <a href="{{ $itemURL }}"
                           class="btn-primary hover:bg-opacity-80 bg-{{$theme}}"
                           @if(!empty($externalURL)) target="_blank" @endif>
                            @if(!empty($buttonText)) {!!  $buttonText  !!} @else View Product
                            <i class="fas fa-arrow-right"></i> @endif</a>
                    @endif
                    <p class="mt-2 text-xs"><em>@if($category !== 'lessons') Worldwide shipping. @endif All prices in USD.
                            <br> <span
                                style="color:red;"> @if(!empty($specialText)) {!!  $specialText  !!} @endif </span></em>
                    </p>
                </div>
            </div>
        @endif
    </div>
</li>
