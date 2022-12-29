


<div style="background:linear-gradient(30deg, #0a3761, #0c1526);">
<section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"  style="background:url(https://drumeo-assets.s3.amazonaws.com/sales/2023/order-bg-tile-2.png) center center/160px;">
    <div class="container mx-auto max-w-6xl relative z-50">
        <div class="w-full">
            <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                    <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                        <div class=" {{--border-2 border-promo--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                            <div class="h-full w-full bg-top bg-cover" style="background-image:url(https://cdn.musora.com/image/fetch/w_850,q_auto:best/{{ $topImage }});"></div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <img class="hidden sm:inline-block h-7 lg:h-8 mt-5" alt="promo logo" src="{{ $promoLogo }}">
            <img class="inline-block sm:hidden h-12 mt-4" alt="mobile promo logo" src="{{ $promoLogoM }}">
            <h4 class="leading-tight my-2 uppercase">{!! $header !!}</h4>
            <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}" {{--data-open="orderModal"--}}>GET Started &raquo;</a>
            <p class="leading-tight text-sm"><em>First year discount: <s class="opacity-40">${{ $fullPrice }}</s> ${{ $price }}.<br class="inline sm:hidden"> Cancel anytime. 90-day guarantee.</em></p>
            <h3 class="leading-tight mt-8 mb-4 sm:my-8 uppercase">{!!  $subDescription  !!}</h3>
        </div>
        <div style="font-size:0px">
            @foreach($bonuses as $bonus)
                <div
                    class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4 lg:w-1/5"
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
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
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
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/drumeo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">DRUM LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'pianote')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/pianote-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/pianote-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">PIANO LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'guitareo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/guitareo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/guitareo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">GUITAR LESSONS INCLUDED</p>
                    </div>
                @endif
                @if($theme !== 'singeo')
                    <div class="relative mb-3 sm:mb-0 mx-1 sm:mx-2 lg:mx-3">
                        <img alt="brand tile" class="hidden sm:inline-block sm:h-24 md:h-28 lg:h-36 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/singeo-bonus.jpg">
                        <img alt="brand tile" class="sm:hidden inline-block h-44 rounded-xl"
                            src="https://drumeo-assets.s3.amazonaws.com/sales/2023/singeo-bonus-m.jpg">
                        <p class="absolute w-full text-sm lg:text-base uppercase font-bebas" style="bottom: 20%;">SINGING LESSONS INCLUDED</p>
                    </div>
                @endif
            </div>
        </div>
        {{-- <p class=" mt-4 md:mt-5" style="display:inline-block;background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>By joining today, we’ll donate 20% of your new membership<br class="hidden sm:inline"> towards the <a target="_blank" href="https://musicounts.ca/en/take-action/ways-of-giving/fundraise-on-musicounts-behalf/fundraisers-supporting-musicounts/give-the-gift-of-music-with-musora/"><u>MusiCounts Band Aid Program</u></a>.</strong></p> --}}
        {{--            <h4 class="leading-tight mt-4"><strong>Only $12.50/month <br class="inline sm:hidden">(billed annually at ${{ Prices::$drumeoEdgeAnnual }}).</strong></h4>--}}
        <a class="join {{ $theme }} my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true" {{--data-open="orderModal"--}}>GET Started &raquo;</a>
        {{-- <p class="leading-tight">Billed annually at <s class="opacity-40">${{ Prices::$drumeoEdgeAnnualFull }}</s>${{ Prices::$drumeoEdgeAnnual }} per year.</p> --}}
        <br>
        <a class="inline-block text-light-navy mt-2" href="{{ $altButtonLink }}"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ $altPrice }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>
</div>
