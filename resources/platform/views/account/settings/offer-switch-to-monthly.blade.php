
@php
    /*
     * Make price pretty
     * ------------------------------
     *
     * This does two things. In cases where there is only one decimal place, it forces the trailing zero to be
     * shown, as is standard for pricing. For example where a price might initially be formatted as double `29.9`,
     * we ensure at appears as a string "29.90". But in cases where the decimal numbers are two zeros
     * (ex: "$29.00") it doesn't enforce that two-decimal-place rule, but rather transforms it to a much cleaner
     * "$29".
     */

     /** @var int|string $switchToMonthlyPrice */

    $isDecimal = floor($switchToMonthlyPrice) != $switchToMonthlyPrice;

    /** @var string $switchToMonthlyPriceFormatted */
    if($isDecimal) {
        $switchToMonthlyPriceFormatted = number_format((float) $switchToMonthlyPrice, 2, '.', ''); // returns a string
    } else {
        $switchToMonthlyPriceFormatted = (string) $switchToMonthlyPrice;
    }


@endphp

<div class="tw-border tw-border-[#445F74] tw-rounded-md">
    {{-- Card Header --}}
    <div class="tw-bg-[#102230] tw-p-6 tw-flex tw-flex-col tw-items-center">
        <svg width="36" height="35" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-mb-1">
            <path d="M12.1715 10.2083V4.375M23.8382 10.2083V4.375M10.7132 16.0417H25.2966M7.79655 30.625H28.2132C29.824 30.625 31.1299 29.3192 31.1299 27.7083V10.2083C31.1299 8.5975 29.824 7.29167 28.2132 7.29167H7.79655C6.18572 7.29167 4.87988 8.5975 4.87988 10.2083V27.7083C4.87988 29.3192 6.18572 30.625 7.79655 30.625Z" stroke="#E7EFF6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> 
        <h3 class="tw-font-bold tw-text-xl">Switch to monthly payments</h3>
    </div>

    {{-- Card Body --}}
    <div class="tw-p-6 tw-flex tw-flex-col">
        
        <p class="tw-mt-6 tw-mb-3 tw-font-semibold">Switch to monthly payments:</p>
        <p class="tw-font-semibold tw-text-2xl tw-mb-6 tw-font-semibold">${{ $switchToMonthlyPriceFormatted }}/mo</p>
        <p class="tw-text-sm tw-mb-12 tw-font-semibold">First payment on {{ \Carbon\Carbon::parse($subscriptionExpiryDate)->format('F j, Y') }}, when annual access expires.</p>
        
        <form method="post"
              action="{{ url()->route('platform.profile.settings.switch-to-monthly') }}"
              id="cancel-reason-form"
              class="tw-flex tw-flex-col tw-flex-grow">
            
              {{ csrf_field() }}
            
            <button
                type="submit"
                class="tw-btn-primary tw-bg-white tw-text-[#000C17] tw-mx-auto tw-px-8"
                style="cursor: pointer">
                Switch to Monthly Payments
            </button>
        </form>
    </div>
</div>