<div style="background:linear-gradient(to bottom, #02010f, #010522);">
    <section class="content-section text-center customize px-4 lg:px-6 relative z-50 overflow-hidden bg-center bg-cover lazyload" style="background: url(https://dpwjbsxqtam5n.cloudfront.net/sales/2023/order-bg.jpg);">
        <div class="container mx-auto relative z-50">
            <div class="mx-auto max-w-4xl" style="font-size: 0;">
                <div class="w-full">
                    <h2 class="uppercase font-extrabold text-[#FFAC00] mb-8" style="font-family: 'Raleway', sans-serif;">New year. New songs.</h2>
                        <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-md">
                            <p class="absolute -top-[8px] right-0 z-10 bg-[#FFAC00] rounded-full text-black text-xs px-2 py-1">SAVE __%</p>
                            <div class=" inline-block relative w-full group" style="padding-bottom: 47%;perspective: 1000px;">
                                <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                                    <div class="front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                        <div class="h-full w-full bg-black bg-center bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=850,quality=95/{{ $logo }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <h3 class="leading-tight my-3">
                        {!! $joinText !!}
                    </h3>
                    <a class="join bg-{{$theme}} bigger mb-2 mt-4 md:mt-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $annualLink }}" {{--data-open="orderModal"--}}>GET Started <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    <p class="leading-tight text-sm"><em>Billed at ${{ Prices::$plusSubscriptionAnnual }} per year.<br class="inline sm:hidden">  Cancel anytime. 90-day guarantee.</em></p>
                    <h4 class="leading-tight my-6 sm:my-8 uppercase">
                        + get {{ $bonusNum }} free bonuses worth ${{ $worth ?? '' }}.
                    </h4>
                </div>

                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 {{ $tileWidth }}">
                        <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                            <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                <div class="border-2 border-[#FFAC00] front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-cover bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }}"></div>
                                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                        <i class="fas fa-arrow-right text-4xl"></i><br>
                                        <p class="text-sm"><strong>DETAILS</strong></p>
                                    </div>
                                </div>
                                <div class="back border-2 border-[#FFAC00] absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                        <p class="leading-snug mx-auto text-xs">{!! $bonus['description'] !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="w-full leading-normal mt-2">
                            {{--<strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                            <span style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong class="text-[#FFAC00]">FREE</strong></span><br>
                            <em>
                                @if(!empty($bonus['shipping']))
                                    Free Bonus
                                @else
                                    Online Access
                                @endif
                            </em>
                        </p>
                    </div>
                    @if(!empty($bonus['br'])) {!! $bonus['br'] !!} @endif
                @endforeach
                @if($theme === 'drumeo')
                    <div class="grid md:grid-cols-3 lg:px-16 gap-4">
                        <img class="rounded-xl" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/pianote-included.jpg" alt="pianote included" />
                        <img class="rounded-xl" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/guitareo-included.jpg" alt="guitareo included" />
                        <img class="rounded-xl" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/singeo-included.jpg" alt="singeo included" />
                    </div>
                @endif
                {{-- <p class=" mt-4 md:mt-5" style="display:inline-block;background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>By joining today, we’ll donate 20% of your new membership<br class="hidden sm:inline"> towards the <a target="_blank" href="https://musicounts.ca/en/take-action/ways-of-giving/fundraise-on-musicounts-behalf/fundraisers-supporting-musicounts/give-the-gift-of-music-with-musora/"><u>MusiCounts Band Aid Program</u></a>.</strong></p> --}}
                {{--            <h4 class="leading-tight mt-4"><strong>Only $12.50/month <br class="inline sm:hidden">(billed annually at ${{ Prices::$plusSubscriptionAnnual }}).</strong></h4>--}}
                <a class="join bg-{{$theme}} bigger my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $annualLink }}" {{--data-open="orderModal"--}}>GET Started <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                {{-- <p class="leading-tight">Billed annually at <s class="opacity-60">${{ Prices::$plusSubscriptionAnnualFull }}</s>${{ Prices::$plusSubscriptionAnnual }} per year.</p> --}}
                <br>
                <a class="inline-block text-light-navy mt-2" href="{{ $monthlyLink }}"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$plusSubscriptionMonthly }}/month. (no bonuses)</em></u></p></a>

            </div>
        </div>
    </section>
</div>
<section class="content-section text-center" style="background: #0c1429;">
    <div class="container mx-auto relative z-50">
        <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <p class="mx-auto mt-2 md:mt-3 text-light-navy">Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
        </a>
        <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
            <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
        </div>
        <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
            <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
            <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
            <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
            <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
            <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
        </div>
    </div>
</section>
