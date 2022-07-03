<li class="scalable-card {{ !empty($cardType) ? $cardType : '' }} {{ !empty($soldOut) ? 'sold-out' : '' }}" data-price="{{ $price }}">
    <div class="flip-card-inner">
        <div class="flip-card-front card-inside">
            <section class="drum-shop h-full flex flex-col">
                <div class="top-image @if(!empty($packLogo)) with-logo @endif" style="flex: 1; background-image:url(https://cdn.musora.com/image/fetch/w_600,q_auto:best/@if(str_contains($thumbnail, 'amazonaws') || str_contains($thumbnail, 'cloudfront')){{$thumbnail}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$thumbnail}}@endif";>
                    @if (!empty($badgeText))
                        <span class="bg-{{ $theme }} text-white rounded-br-md py-1 px-2 font-roboto absolute top-0 left-0 uppercase font-bold text-[11px]">
                            {!! $badgeText !!}
                        </span>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <span class="bg-{{ $theme }} text-white rounded-br-md py-1 px-2 font-roboto absolute top-0 left-0 uppercase font-bold text-[11px]">
                            Save {{ round(100 - (100 * ($price / $fullPrice))) }}%
                        </span>
                    @endif
                    @if(!empty($packLogo))
                        <div class="logo">
                            <img src="@if(str_contains($packLogo, 'amazonaws') || str_contains($packLogo, 'cloudfront')){{$packLogo}}@else{{'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$packLogo}}@endif" alt="packLogo">
                        </div>
                    @endif
                    <i class="fas fa-arrow-right hover-icon"></i>
                </div>
                <div class="p-2 px-2 pb-4 md:py-4 border-t border-[#ddd]">
                    <h6>{!! $title !!}</h6>
                    @if(!empty($packAuthor))
                        <p><em>{{ $packAuthor }}</em></p>
                    @endif
                    @if(!empty($specialPrice))
                        <p><strong>{{ floatval($specialPrice) }}</strong></p>
                    @elseif (round(100 - (100 * ($price / $fullPrice))) > 1)
                        <p><s class="text-[#9da6a8]">WAS ${{ $fullPrice }}</s>
                            <strong class="text-{{$theme}}"> NOW
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatval($price)  }}
                                @else
                                    ${{  floatval(number_format($price, 2))  }}
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
                        <p class="text-[22px] md:text-[26px] lg:text-3xl mb-3"><s class="text-[#9da6a8]">${{ floatval($fullPrice) }}</s> <strong class="text-{{ $theme }}">
                                @if(number_format($price, 2) == intval($price))
                                    ${{  floatVal($price)  }}
                                @else
                                    ${{  floatVal(number_format($price, 2))  }}
                                @endif
                            </strong></p>
                    @else
                        <p class="text-{{ $theme }} text-[22px] md:text-[26px] lg:text-3xl mb-3"><strong> ${{  $price  }}</strong></p>
                    @endif
                    @if(!empty($includedEdge))
                        <p class="description relative m-0" style="top: -13px;"><em class="text-red">Or free with {{ ucfirst($theme) }}</em></p>
                    @endif
                    @if(empty($soldOut))
                        @if(!empty($sizes))
                            <select class="pack-pick" title="Shirt Size" required>
                                <option hidden value="">Choose Size</option>
                                @foreach($sizes as $size)
                                    <option
                                        @if($size->sold_out) disabled @endif
                                    value="{{ "&products[".$sku."-".$size->code."]=1" }}"data-product-json='{{'{"'.$sku.'-'.$size->code.'": 1}'}}'
                                    >
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>

                            <a
                                class="online-atc selected-pack vue-add-to-cart" href="/laravel/public/shopping-cart/api/query?go-back-to-shop=true"
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join">
                                    <span class="initial"><i class="fas fa-cart-plus"></i> Add To Cart</span>
                                    <span class="loading"><i class="fad fa-spinner-third fa-spin"></i> Adding to cart...</span>
                                </button>
                            </a>
                        @else
                            <a
                                class="online-atc vue-add-to-cart" href="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&products[{{ $sku }}]=1"
                                data-base-url="/laravel/public/shopping-cart/api/query?go-back-to-shop=true&products[{{ $sku }}]=1"
                                @isset($productJson) data-product-json='{{ $productJson }}' @endisset
                                @if(!empty($promoCode)) data-promocode="{{ $promoCode }}" @endif
                                @if(!empty($lockedCart)) data-locked-cart="{{ $lockedCart }}" @endif
                            >
                                <button class="join">
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
                        <a target="_blank" href="{{ $itemURL }}" class="lg:text-lg font-bebas-neue tracking-widest block w-full py-2 rounded-full text-white bg-{{ $theme }} hover:bg-opacity-80" @if(!empty($externalURL)) target="_blank" @endif>
                            @if(!empty($buttonText)) {!!  $buttonText  !!} @else View Product
                            <i class="fas fa-arrow-right"></i> @endif</a>
                    @endif
                    <p class="mt-2 text-xs"><em>@if(!empty($physical)) Worldwide shipping. @endif All prices in USD. <br> <span style="color:red;"> @if(!empty($specialText)) {!!  $specialText  !!} @endif </span></em></p>
                </div>
            </div>
        @endif
    </div>
</li>
