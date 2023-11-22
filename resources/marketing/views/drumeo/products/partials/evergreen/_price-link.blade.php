@php
    $currentDate = now()->timezone('America/Vancouver');
    $blackFridayDate = \Carbon\Carbon::create(2023, 11, 24)->timezone('America/Vancouver');
    $cyberMondayDate = \Carbon\Carbon::create(2023, 11, 27)->timezone('America/Vancouver');
    $christmasDate = \Carbon\Carbon::create(2023, 12, 25)->timezone('America/Vancouver');
@endphp

<div class="w-full pt-4">
    @if (!empty($price) || !empty($enrollmentLink) || !empty($brandTitle))
        <h5 class="leading-tight">
            <strong class="font-black">Only
            @if($price > $discountedPrice)
                    <s class="opacity-60">${{ $price }}</s> ${{ $discountedPrice }} (SAVE {{ round(100 - (100 * ($discountedPrice / $price))) }}%)
            @else
                ${{ $discountedPrice }}
            @endif
            </strong>
        </h5>
    @endif
</div>
