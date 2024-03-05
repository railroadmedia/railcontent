<section class="text-center text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20"
        style="background:linear-gradient(to bottom, #0C1524, #062746);"
    x-data="{ plusMembershipSelected: true }"
>
    <div class="container max-w-5xl mx-auto">
        <img class="sm:hidden inline-block h-24 " src="https://d21q7xesnoiieh.cloudfront.net/fit-in/390x0/filters:quality(95)/marketing/{{ $logoM }}" alt="30 day drummer logo" />
        <img class="hidden sm:inline-block sm:h-20 lg:h-28" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1120x0/filters:quality(95)/marketing/{{ $logo }}" alt="30 day drummer logo" />
        <p class="leading-tight mt-4 mb-3 sm:mb-5">
            {!! $promoText !!}
        </p>

        <div id="plusOptions"
            class="flex flex-wrap lg:flex-nowrap items-start justify-center 2-full mb-5 sm:mb-10 mx-auto"
            x-bind:class="{ 'hidden': !plusMembershipSelected }"
        >
            <div class="w-full md:w-1/2 lg:w-full md:order-1 max-w-sm lg:px-1 px-1 relative">
                @if(!empty($topBadge))
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-musora text-black font-black tracking-widest">{{$topBadge}}</p>
                @endif
                <a href="{{$secondDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-musora">
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
                        <span class="join musora smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0" aria-label="{{ $buttonText }}"> {{$buttonText}} </span>
                    </div>
                    @if(!empty($secondExtraBonuses))
                        <div class="px-4 sm:px-4 lg:px-6 py-7 lg:whitespace-nowrap" style="background:#F6F8FC">
                            @foreach($secondExtraBonuses as $bonus)
                                <p class="text-left text-sm mb-1.5">{!! $bonus !!}</p>
                            @endforeach
                        </div>
                    @endif
                </a>
            </div>
            <div class="w-full md:w-1/2 lg:w-full max-w-sm lg:px-1 px-1 relative">
                <a href="{{$firstDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif @if(!empty($topBadge)) md:mt-7 @endif">
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
            @if(!empty($thirdDealLink))
                <div class="w-full md:order-2 lg:px-1 px-1 relative max-w-sm">
                    <a href="{{$thirdDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif @if(!empty($topBadge)) md:mt-7 @endif">
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
            @endif
        </div>
    </div>
</section>
