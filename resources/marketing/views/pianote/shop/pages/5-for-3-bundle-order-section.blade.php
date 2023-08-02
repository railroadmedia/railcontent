<div>
    <section class="relative overflow-hidden text-white text-center customize px-4 lg:px-6">
        <div class="container mx-auto max-w-6xl relative z-50">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" {{--border-2 border-promo--}} front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-center bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/{{ $topImage }});"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div style="font-size:0px">
                @foreach($bonuses as $bonus)
                    <div
                        class="bonus-wrap relative inline-block align-top mx-auto mb-4 mt-6 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 @endif"
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
                                    <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover" style="background-image:url(https://www.musora.com/musora-cdn/image/width=460,quality=95/{{ $bonus['image'] }});"></div>
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
                            <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                    <s class="opacity-40">${{ $bonus['price'] }}</s>
                                @endif
                            <strong class="text-promo">FREE</strong></span><br>
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
            </div>
            {!! $saveText !!}
            <a class="join my-4 sold-out md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" {{--href="{{ $buttonLink }}"--}}>SOLD OUT</a>
            <br>
            <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #333;color: #ffac00;"></i>
                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #333;color: #ffac00;"></i>
                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #333;color: #ffac00;"></i>
                <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #333;color: #ffac00;"></i>
            </a>
            <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            <p class="mt-10"><b>Still have questions?</b> Call us toll-free at 1-800-439-8921 or directly at 1-604-855-7605.</p>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy mt-4">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover" aria-hidden="true"></i>
            </div>
        </div>
    </section>
</div>
