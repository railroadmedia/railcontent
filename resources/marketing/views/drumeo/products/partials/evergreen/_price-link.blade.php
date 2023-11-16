@php
    $currentDate = now();
    $blackFridayDate = \Carbon\Carbon::create(2023, 11, 17); // need to change, just for checking 
    $cyberMondayDate = \Carbon\Carbon::create(2023, 11, 27);
    $christmasDate = \Carbon\Carbon::create(2023, 12, 25);
@endphp

<div class="w-full pt-4">
    @if (!empty($price) || !empty($enrollmentLink) || !empty($brandTitle))
        @if ($currentDate->isSameDay($blackFridayDate))
            <strong> Only <span class="line-through">{{ $price }}</span> $50 For Black Friday (Save 61%)</strong>
        @elseif ($currentDate->isSameDay($cyberMondayDate))
            <strong> Only <span class="line-through">{{ $price }}</span> $50 For Cyber Monday (Save 61%)</strong>
        @elseif ($currentDate->isSameDay($christmasDate))
            <strong> Only <span class="line-through">{{ $price }}</span> $50 For Christmas (Save 61%)</strong>
        @else
            <p class="mb-5 sm:mb-0 hover:text-{{ $brand }}">
              
                    <a href={{ $enrollmentLink }}>
                        <span class="text-black">
                           {{ $price }} or
                        </span>
                        <span class="opacity-50 underline"> get it free with a {{ $brandTitle }} Membership.</span>
                    </a>
              
            </p>
        @endif
    @endif
</div>
