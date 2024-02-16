    <div class="w-full md:w-1/2 lg:px-3 px-1 relative" id="cardBookBagbag">
        <div class="text-center">
            @isset($topBadgeText)
                <p class="inline-block relative top-1 px-5 py-1 z-10 leading-wide text-xs rounded-full bg-{{ $productTheme }} text-white uppercase">{{ $topBadgeText }}</p>
            @endisset
        </div>
        <div class="bg-white text-black overflow-hidden rounded-2xl block mx-auto mb-4 lg:mb-0 group border-2 border-{{ $productTheme }}">
            <div class="px-3 py-6 md:pt-12 pb-6 text-center">
                <h3 class="leading-tight text-2xl md:text-3xl mb-2"><strong>{{ $cardTitle ?? '' }}</strong></h3>
                <img class="{{ $cardImageHeight ?? '' }} rounded-md transition-opacity opacity-0" src="{{ $cardImageUrl ?? '' }}" loading="lazy" onload="this.classList.remove('opacity-0')" alt="{{ $cardTitle ?? 'Card image' }}">
                <h3 class="leading-tight mt-2">
                    @isset($cardDiscount)
                        <span class="line-through" style="color: #879097; margin-right: 5px;">${{ $cardDiscount }}</span>
                    @endisset
                    <strong>${{ $cardPrice ?? '' }}</strong>
                </h3>
                <p class="text-sm mb-5"><em>{!! $cardSubtitle ?? '' !!}</em></p>
                <div class="flex items-center justify-center">
                    @foreach($cardButtons as $button)
                        @if ($products[$sku]->getStockAvailability() > 1 && !empty($products[$sku]->getStockAvailability()))
                            <a href="{{ $button['link'] ?? '#' }}" aria-label="{{ $button['text'] ?? '' }}" class="mx-1 join bg-{{ $productTheme }} text-xl smaller w-2/3 transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">{{ $button['text'] ?? '' }}</a>
                        @else
                        <button class="mx-1 font-bebas text-xl bg-zinc-300 rounded-2xl h-10 text-white smaller w-2/3 max-w-[230px]">Sold Out</button>
                        @endif
                    @endforeach
                </div>
            </div>
            @isset($cardBonuses)
                <div class="px-4 lg:px-6 pb-7">
                    @foreach($cardBonuses as $bonus)
                        <p class="text-center text-sm mb-1">{!! $bonus !!}</p>
                    @endforeach
                </div>
            @endisset
        </div>
    </div>