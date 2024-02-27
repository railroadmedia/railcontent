<section class="text-center text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background:linear-gradient(to bottom, #0C1524, #062746);"
    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-5xl mx-auto">
        <img class="sm:hidden inline-block h-24 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-logo-white-m.webp" alt="30 day drummer logo" />
        <img class="hidden sm:inline-block sm:h-20 lg:h-24" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/960x0/filters:quality(95)/marketing/pianote/promos/march/8-anniversary-logo-white.webp" alt="30 day drummer logo" />
        <p class="leading-tight my-5 lg:my-7">Get legacy pricing on your first year <strong>OR</strong> 8 free bonuses with your membership <em class="text-pianote">(worth $987)</em></p>

        <div id="plusOptions"
            class="flex flex-wrap items-start justify-center 2-full mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >

            <div class="w-full md:w-1/3 lg:px-1 px-1 relative">
                <a href="{{$firstDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif"
                    @if(!empty($topBadge)) style="margin-top: 30px" @endif>
                    <div class="bg-white px-3 py-6 md:py-7" style="border-bottom: 1px solid white">
                        <h4 class="leading-tight mb-2"><strong>{{$firstDeal}}</strong></h4>
                        <img
                            class="{{$firstImageHeight}} rounded-md transition-opacity opacity-0"
                            src={{ $firstDealImage }}
                                        loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            alt="card image"
                        >
                        <h3 class="leading-tight mt-2">
                            @if(!empty($firstDealDiscount))
                                <span class="line-through" style="color: #879097; margin-right: 5px;"> ${{$firstDealDiscount}} </span>
                            @endif
                            <strong>${{$firstDealPrice}}</strong>
                        </h3>
                        <p class="text-sm mb-5"><em>{!! $firstDealSub !!}</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] {{ $theme }}" role="button" tabindex="0" aria-label="{{ $buttonText }}">{{$buttonText}}</div>
                    </div>
                    @if(!empty($firstExtraBonuses))
                        <div class="px-4 sm:px-4 lg:px-6 py-7" style="background:#F6F8FC">
                            @foreach($firstExtraBonuses as $bonus)
                                <p class="text-left text-sm mb-1.5 leading-tight">{!! $bonus !!}</p>
                            @endforeach
                        </div>
                    @endif
                </a>
            </div>
            <div class="w-full md:w-1/3 lg:px-1 px-1 relative">
                @if(!empty($topBadge))
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-musora text-black font-black tracking-widest">{{$topBadge}}</p>
                @endif
                <div  class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-musora">
                    <div class="bg-white px-3 py-6 md:py-7">
                        <h4 class="leading-tight mb-2"><strong>{{$secondDeal}}</strong></h4>
                        <img
                            class="{{$secondImageHeight}} rounded-md transition-opacity opacity-0"
                            src="{{ $secondDealImage }}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            alt="card image"
                        >
                        <h3 class="leading-tight mt-2">
                            <span class="line-through" style="color: #879097; margin-right: 5px;">${{$secondDealDiscount}}</span>
                            <strong>${{$secondDealPrice}}</strong>
                        </h3>
                        <p class="text-sm mb-5"><em>{!! $secondDealSub !!}</em></p>

                            <a href="{{$secondDealLink}}" class="join musora smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0" aria-label="{{ $buttonText }}"> {{$buttonText}} </a>

                    </div>
                    @if(!empty($secondExtraBonuses))
                        <div class="px-4 sm:px-4 lg:px-6 py-7" style="background:#F6F8FC">
                            @foreach($secondExtraBonuses as $bonus)
                                <p class="text-left text-sm mb-1.5">{!! $bonus !!}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:px-1 px-1 relative">
                <a href="{{$thirdDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif"
                    @if(!empty($topBadge)) style="margin-top: 30px" @endif>
                    <div class="bg-white px-3 py-6 md:py-7" style="border-bottom: 1px solid white">
                        <h4 class="leading-tight mb-2"><strong>{{$thirdDeal}}</strong></h4>
                        <img
                                        class="{{$thirdImageHeight}} rounded-md transition-opacity opacity-0"
                                        src={{ $thirdDealImage }}
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        alt="card image"
                                    >
                        <h3 class="leading-tight mt-2">
                            @if(!empty($thirdDealDiscount))
                                <span class="line-through" style="color: #879097; margin-right: 5px;"> ${{$thirdDealDiscount}} </span>
                            @endif
                            <strong>${{$thirdDealPrice}}</strong>
                        </h3>
                        <p class="text-sm mb-5"><em>{!! $thirdDealSub !!}</em></p>
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] musora-black" role="button" tabindex="0" aria-label="{{ $buttonText }}">{{$buttonText}}</div>
                    </div>
                        @if(!empty($thirdExtraBonuses))
                            <div class="px-4 sm:px-4 lg:px-6 py-7" style="background:#F6F8FC">
                            @foreach($thirdExtraBonuses as $bonus)
                            <p class="text-left text-sm mb-1.5 leading-tight">{!! $bonus !!}</p>
                            @endforeach
                            </div>
                        @endif
                </a>
            </div>
        </div>
    </div>
</section>
