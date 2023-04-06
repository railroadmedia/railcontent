<div style="background:linear-gradient(30deg, #0a3761, #0c1526);">
<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"  style="background:url(https://dpwjbsxqtam5n.cloudfront.net/sales/2023/order-bg-tile-2.png) center center/160px;">
    <div class="container mx-auto max-w-6xl relative z-50">
        <div class="w-full">
            @if(!empty($promoLogo))
                <div class="text-center">
                    <img
                        class="h-24 md:h-28 lg:h-32 mb-6 transition-opacity opacity-0"
                        src="{{ $promoLogo }}"
                        alt="Promo logo"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                </div>
            @endif
            <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                    <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                        <div class=" {{--border-2 border-promo--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                            <div class="h-full w-full bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/{{ $topImage }});"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if(!empty($promoText)){!! $promoText !!}@endif
            @if(!empty($header))<h3 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>{!! $header !!}</strong></h3>@endif
            <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>
            <p class="leading-tight text-sm @if(empty($subDescription)) mb-6 @endif"><em>First year discount: <s class="opacity-40">${{ Prices::$plusSubscriptionAnnualFull }}</s> @if(!empty($firstYearPrice))
                ${{$firstYearPrice}} @else ${{ 240 }}@endif.<br class="inline sm:hidden"> Cancel anytime. 90-day guarantee.</em></p>
            @if(!empty($subDescription))<h4 class="leading-tight mt-8 mb-4 sm:my-8 uppercase text-coaches"><strong>{!!  $subDescription  !!}</strong></h4>@endif
            @if(!empty($countdown))
                <div class="rounded-xl px-4 sm:px-6 py-2 inline-flex flex-wrap mx-auto mb-4 sm:mb-8 justify-center items-center" style="background-color:#181515;">
                    <p class="leading-tight m-0"><strong>
                            <span class="inline sm:hidden">DEALS END IN:</span>
                            <span class="hidden sm:inline">{!! $countdown !!}</span>
                        </strong></p>
                    <div class="h-12 mx-5 bg-promo" style="width:2px;"></div>
                    <div class="tzcd-big">
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>
                        </div>
                        <div class="inline-block mx-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>
                        </div>
                        <div class="inline-block mr-2">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>
                        </div>
                        <div class="inline-block">
                            <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                            <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div style="font-size:0px">
            @foreach($bonuses as $bonus)
                <div
                    class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
                    x-data="{
                        flipped: false,
                    }"
                    x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                >
                    <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            <div
                                x-ref="front"
                                class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                @if(!empty($bonus['badge']))
                                    <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                @endif
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=85/{{ $bonus['image'] }});"></div>
                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-arrow-right text-4xl"></i><br>
                                    <p class="text-sm"><strong>DETAILS</strong></p>
                                </div>
                            </div>
                            <div
                                x-ref="back"
                                class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                style="backface-visibility: hidden;"
                            >
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="w-full leading-normal mt-2">
                        {{--<strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                        <span style="text-transform:uppercase; display:inline-block;"><s class="opacity-40">${{ $bonus['price'] }}</s> <strong class="text-promo">FREE</strong></span><br>
                        <em>
                            @if(!empty($bonus['shipping']))
                                Free Shipping
                            @else
                                Online Access
                            @endif
                        </em>
                    </p>
                </div>
            @endforeach
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-start my-2 sm:my-4">
                @if($theme !== 'drumeo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/drumeo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">DRUM LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'pianote')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/pianote-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/pianote-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">PIANO LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'guitareo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guitareo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guitareo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">GUITAR LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'singeo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">SINGING LESSONS INCLUDED</p>
                    </div>
                @endif
            </div>
        </div>
        <a class="join {{ $theme }} my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">GET Started &raquo;</a>
        <br>
        <a class="inline-block text-light-navy mt-2" href="{{ $altButtonLink }}"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>
</div>
