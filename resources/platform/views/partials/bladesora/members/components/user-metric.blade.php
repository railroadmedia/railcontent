{{-- User Metrics --}}
<div class="tw-inline-flex tw-w-full tw-min-h-[150px] tw-text-[#00101D] dark:tw-text-white tw-flex-col tw-rounded-full tw-border-[3px] dark:tw-border-[#445F74] tw-justify-center tw-items-center tw-justify-items-stretch tw-transition dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-center">
    <i class="{{ $icon }} tw-text-{{ $themeColor ?? $brand }} text-center nowrap tw-text-3xl" style="line-height:32px;"></i>
    <h4 class="tw-text-3xl md:tw-text-5xl tw-my-1 tw-font-bold">{{ $value }}</h4> 
    <h6 class="tw-text-xs md:tw-text-sm xl:tw-text-base tw-font-bebas-neue tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-uppercase tw-px-5">{{ $label }}</h6>
</div> 