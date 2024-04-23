
    <div class="w-full md:w-1/2 lg:w-full md:order-1 max-w-sm lg:px-1 px-1 relative mx-2">
        @if(!empty($badgeText))
            <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-{{$badgeColor}} @if(!empty($whiteBadge)) text-white @endif tracking-widest">{{$badgeText}}</p>
        @endif
        <a href="{{$cardLink}}" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-{{$badgeColor}} @if(empty($badgeText)) sm:mt-7 @endif">
            <div class="bg-white px-3 py-6 md:py-7">
                <h4 class="leading-tight mb-2"><strong>{!! $cardTitle !!}</strong></h4>
                <p class="text-sm mb-5"><em>{!! $cardSubtitle !!}</em></p>
                <img
                    class="{{$imageHeight}} rounded-md transition-opacity opacity-0"
                    src="{{ $cardImage }}"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    alt="card image"
                >
                <h3 class="leading-tight mt-2">
                    @if(!empty($cardDiscount))
                        <span class="line-through" style="color: #879097; margin-right: 5px;">${{$cardDiscount}}</span>
                    @endif
                    @if(!empty($cardPrice))
                    <strong>
                        <span class="text-black">${{$cardPrice}}</span>
                    </strong>
                    @endif
                </h3>
                <p class="text-sm mb-5"><em>{!! $cardExtraInfo !!}</em></p>

                <span class="join {{$badgeColor}} smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]" role="button" tabindex="0" aria-label="{{ $buttonText }}"> {{$buttonText}} </span>
            </div>
            @if(!empty($extraBonuses))
                <div class="px-4 lg:px-6 pb-7 bg-white">
                    @foreach($extraBonuses as $bonus)
                        <p class="text-center text-sm mb-1.5">{!! $bonus !!}</p>
                    @endforeach
                </div>
            @endif
        </a>
    </div>
