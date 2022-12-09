<div class="tw-flex tw-flex-row tw-items-center">

    {{-- Custon Toggle --}}
    <div class="tw-inline-flex tw-relative tw-w-[48px] mr-1">
        {{-- Hidden Input --}}
        <input type="hidden" class="hidden-input" name="{{ $inputName }}" value="{{ $checked ? 1 : 0 }}">
        {{-- Checkbox Input --}}
        <input type="checkbox" name="{{ $inputName }}" id="{{ $inputID }}" class="tw-peer tw-hidden" {{ !empty($checked) && $checked === true ? 'checked' : '' }}>
        <label for="{{ $inputID }}" class="tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-all tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74] peer-checked:tw-bg-{{ !empty($selectedBrand) ? $selectedBrand : $brand }} tw-relative"></label>
        {{-- Handle --}}
        <div class="tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px]"></div>
    </div>
    {{-- Toggle Text --}}
    <p class="tw-text-[#00101D] dark:tw-text-white tw-text-xs">{{ $inputLabel }}</p>

</div>