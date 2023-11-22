@php
    $currentDate = now()->timezone('America/Vancouver');
    $blackFridayDate = \Carbon\Carbon::create(2023, 11, 24, 0, 0, 0, 'America/Vancouver');
    $cyberMondayDate = \Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver');
    $christmasDate = \Carbon\Carbon::create(2023, 12, 25, 0, 0, 0, 'America/Vancouver');
@endphp


<div class="w-full pt-4">
    @if (!empty($price) || !empty($enrollmentLink) || !empty($brandTitle))
        @if ($currentDate->isSameDay($blackFridayDate))
            <strong> Only <span class="line-through">{{ $discountedPrice }}</span> {{ $discountedPrice }} For Black Friday (Save {{ round(100 - ($discountedPrice / $price) * 100) }}%)</strong>
        @elseif ($currentDate->isSameDay($cyberMondayDate))
            <strong> Only <span class="line-through">{{ $discountedPrice }}</span> {{$discountedPrice}} For Cyber Monday (Save {{ round(100 - ($discountedPrice / $price) * 100) }}%)</strong>
        @elseif ($currentDate->isSameDay($christmasDate))
            <strong> Only <span class="line-through">{{ $discountedPrice }}</span>{{$discountedPrice}} For Christmas (Save {{ round(100 - ($discountedPrice / $price) * 100) }}%)</strong>
        @else
            <p class="pb-5 sm:mb-0 hover:text-{{ $brand }}">

                    <a href={{ $enrollmentLink }}>
                        <span class="text-black">
                         $  {{ $discountedPrice }} or
                        </span>
                        <span class="opacity-50 underline"> get it free with a {{ $brandTitle }} Membership.</span>
                    </a>

            </p>
        @endif
    @endif
</div>

