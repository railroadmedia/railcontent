<section class="bg-blue-50">
    <div class="container max-w-6xl mx-auto px-4 flex flex-col items-center py-10 md:py-28">
    <h2 class="text-2xl md:text-5xl leading-10 pb-12"><strong>{{ $content['title'] }}</strong></h2>
    <div class="grid grid-cols-2 gap-6 md:gap-10 lg:gap-16">
        <div class="text-left">
            <ul>
                @php
                $items = $content['items'];
                $totalItems = count($items);
                $itemsInColumn = ceil($totalItems / 2);
                @endphp
                @for ($i = 0; $i < $itemsInColumn; $i++)
                <li class="text-base md:text-3xl font-normal capitalize leading-tight md:leading-loose my-4 md:my-8">
                    <img src="{{ $content['icon'] }}" alt="{{ $content['title'] }}" class="w-3 md:w-7 h-3 md:h-7">
                    {{ $items[$i] }}
                </li>
                @endfor
            </ul>
        </div>
        <div class="text-left">
            <ul>
                @for ($i = $itemsInColumn; $i < $totalItems; $i++)
                <li class="text-base md:text-3xl font-normal capitalize leading-tight md:leading-loose my-4 md:my-8">
                    <img src="{{ $content['icon'] }}" alt="{{ $content['title'] }}" class="w-3 md:w-7 h-3 md:h-7">
                    {{ $items[$i] }}
                </li>
                @endfor
            </ul>
        </div>
    </div>
</div>
</section>
