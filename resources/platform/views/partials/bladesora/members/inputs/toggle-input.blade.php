{{-- TOGGLE INPUT --}}
<fieldset class="tw-flex tw-flex-row tw-items-center">

    {{-- Custon Toggle --}}
    <div class="tw-inline-flex tw-relative tw-w-[48px] mr-1 tw-rounded-full tw-ring-offset-2 focus-within:tw-ring-1 @if(!empty($disabledOption)) original-toggle tw-hidden @endif">
        {{-- Hidden Input --}}
        <input type="hidden" class="hidden-input" name="{{ $inputName }}" value="{{ $checked ? 1 : 0 }}">
        {{-- Checkbox Input --}}
        <input tabindex="0" type="checkbox" name="{{ $inputName }}" id="{{ $inputID }}" class="tw-peer tw-absolute tw-h-0 tw-w-0 tw-top-[10px] tw-left-[10px]" {{ !empty($checked) && $checked === true ? 'checked' : '' }} @if(!empty($submitOnChange)) onchange="saveLegacyPlayerOption(this)" @endif>
        <label tabindex="-1" for="{{ $inputID }}" class="tw-cursor-pointer tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-colors tw-transform-gpu tw-duration-75 tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74] peer-checked:tw-bg-{{ !empty($selectedBrand) ? $selectedBrand : $brand }}"></label>
        {{-- Handle --}}
        <label tabindex="-1" for="{{ $inputID }}" class="tw-cursor-pointer tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all transform-gpu tw-duration-75 tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px]"></label>
    </div>

    @if(!empty($disabledOption))
        <div class="tw-inline-flex tw-relative tw-w-[48px] mr-1 tw-rounded-full tw-ring-offset-2 focus-within:tw-ring-1 tw-hidden disabled-toggle">
            <input tabindex="0" type="checkbox" name="disabled {{ $inputName }}" class="tw-peer tw-absolute tw-h-0 tw-w-0 tw-top-[10px] tw-left-[10px]">
            <label tabindex="-1" for="{{ $inputID }}" class="tw-cursor-pointer tw-inline-flex tw-w-full tw-h-[24px] tw-p-[2px] tw-transition-colors tw-transform-gpu tw-duration-75 tw-shadow tw-rounded-full tw-bg-gray-400 dark:tw-bg-[#445F74]"></label>
            <label tabindex="-1" for="{{ $inputID }}" class="tw-cursor-pointer tw-w-[20px] tw-h-[20px] tw-bg-white tw-rounded-full tw-transition-all transform-gpu tw-duration-75 tw-absolute tw-top-[2px] tw-right-[calc(100%-22px)] peer-checked:tw-right-[2px]"></label>
        </div>
    @endif
    {{-- Toggle Text --}}
    <label tabindex="-1" for="{{ $inputID }}" class="tw-cursor-pointer tw-text-[#00101D] dark:tw-text-white tw-text-sm">{{ $inputLabel }}</label>

</fieldset>
