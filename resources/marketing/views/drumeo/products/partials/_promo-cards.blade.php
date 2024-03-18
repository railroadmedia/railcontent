<div class="text-center text-white  px-4 sm:px-6 py-10 sm:py-14 lg:py-20"
>
    <div class="container max-w-5xl mx-auto">

        <div id="plusOptions"
            class="flex flex-wrap lg:flex-nowrap items-start justify-center 2-full mb-5 sm:mb-10 mx-auto">
            <div class="w-full md:w-1/2 lg:w-full md:order-1 max-w-sm lg:px-1 px-1 relative mx-2">
                @if(!empty($topBadge))
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-drumeo text-black font-black tracking-widest">{{$topBadge}}</p>
                @endif
                <a href="{{$secondDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-drumeo">
                    <div class="bg-white px-3 py-6 md:py-7">
                        <h4 class="leading-tight mb-2"><strong>{{$secondDeal}}</strong></h4>
                        <p class="text-sm mb-5"><em>{!! $secondDealSub !!}</em></p>
                        <img
                            class="{{$secondImageHeight}} rounded-md transition-opacity opacity-0"
                            src="{{ $secondDealImage }}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                            alt="card image"
                        >
                        <h3 class="leading-tight mt-2">
                            @if(!empty($secondDealDiscount))
                                <span class="line-through" style="color: #879097; margin-right: 5px;">${{$secondDealDiscount}}</span>
                            @endif
                            <strong>${{$secondDealPrice}}</strong>
                        </h3>
                        <p class="text-sm mb-5"><em>{!! $secondDealExtra !!}</em></p>
                       
                        <span class="join drumeo smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0" aria-label="{{ $secondButtonText }}"> {{$secondButtonText}} </span>
                    </div>
                    @if(!empty($secondExtraBonuses))
                        <div class="px-4 lg:px-6 pb-7 bg-white">
                            @foreach($secondExtraBonuses as $bonus)
                                <p class="ttext-center text-sm mb-1.5">{!! $bonus !!}</p>
                            @endforeach
                        </div>
                    @endif
                </a>
            </div>
            <div class="w-full md:w-1/2 lg:w-full max-w-sm lg:px-1 px-1 relative mx-2">
                <a href="{{$firstDealLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 @if(!empty($whiteBg)) border-musora-black @else border-white @endif @if(!empty($topBadge)) md:mt-7 @endif">
                    <div class="bg-white px-3 py-6 md:py-7" style="border-bottom: 1px solid white">
                        <h4 class="leading-tight mb-2"><strong>{{$firstDeal}}</strong></h4>
                        <p class="text-sm mb-5"><em>{!! $firstDealSub !!}</em></p>
                        <img
                            class="{{$firstImageHeight}} rounded-md transition-opacity opacity-0"
                            src="{{ $firstDealImage }}"
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
                        <div class="join smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] {{ $theme }}" role="button" tabindex="0" aria-label="{{ $firstButtonText }}" style="background: #071D31">{{$firstButtonText}}</div>
                    </div>
                    @if(!empty($firstExtraBonuses))
                        <div class="px-4 lg:px-6 pb-7 text-center bg-white">
                            @foreach($firstExtraBonuses as $bonus)
                                <p class="text-center text-sm mb-1.5 leading-tight">{!! $bonus !!}</p>
                            @endforeach
                        </div>
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>
