<div class="w-full max-w-md px-1 sm:px-1.5 relative @if(!empty($threeWide)) sm:w-1/2 lg:w-1/3 @else sm:w-1/2 @endif @if(!empty($firstOnMobile)) sm:order-1 @endif">
    @if(!empty($badge))
        <p class="uppercase absolute top-0 left-1/2 whitespace-nowrap -mt-3 translate -translate-x-1/2 px-5 py-1 z-10 leading-tight text-xs rounded-full @if(!empty($highlightBorder)) bg-{{ $theme }} @else bg-musora-black @endif text-white font-black">{!! $badge !!}</p>
    @endif
    <a href="{{$link}}" class="text-black overflow-hidden rounded-2xl inline-block w-full mx-auto mb-4 lg:mb-0 group border-2 @if(!empty($highlightBorder))  border-{{ $theme }} @else border-musora-black @endif">
        <div class="bg-white px-3 py-6 sm:py-7" style="border-bottom: 1px solid white">
            <h4 class="leading-tight mb-5"><strong>{!! $header !!}</strong></h4>
            @if(!empty($subheader))<p class="text-sm -mt-3 mb-5"><em>{!! $subheader !!}</em></p>@endif
            <img
                class="{{$imageHeight}} rounded-md transition-opacity opacity-0"
                src="{{ $image }}"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                alt="card image"
            >
            <h2 class="leading-tight mt-2">
                @if(!empty($fullPrice)) @if($fullPrice != $price) <s class="opacity-60 mr-1">{{$fullPrice}}</s> @endif @endif
                <strong>{!! $price !!}</strong>
            </h2>
            @if(!empty($specialText)) <p class="text-sm mb-5"><em>{!! $specialText !!}</em></p> @endif
            <span class="join @if(!empty($highlightBorder)) {{ $theme }} @else musora-black @endif smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]"
                role="button" tabindex="0" aria-label="{{ $cta }}"> {{$cta}} </span>
        </div>
        @if(!empty($bonuses))
            <div class="px-4 lg:px-6 pb-7 bg-white">
                <div class="text-center inline-block mx-auto">
                    @foreach($bonuses as $bonus)
                        <p class="text-left w-auto leading-tight text-sm mb-1.5">{!! $bonus !!}</p>
                    @endforeach

                </div>
            </div>
        @endif
    </a>
</div>
