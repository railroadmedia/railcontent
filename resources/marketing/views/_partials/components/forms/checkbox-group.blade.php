<div class="w-full {{ (!empty($stacked) && $stacked) ? 'px-2 sm:px-3' : '' }} mb-2 lg:mb-0">
    <input name="preferred_instrument" id="preferred_instrument" type="hidden" required>

    <p class="{{ (!empty($stacked) && $stacked) ? 'my-2 pl-3' : '' }} text-center lg:text-left pl-3 font-black">
        {{ $checkboxTitle ?? 'Choose your preferred option:' }}
    </p>

    <div class="gap-x-4 flex justify-center lg:justify-start flex-wrap lg:space-x-5 pl-3">
        @foreach ($checkboxItems as $index => $label)
            @php
                $uniqueId = $cleanFormId . $index;
            @endphp
            <div class="relative flex items-start justify-center lg:items-center lg:justify-start">
                <div class="flex h-6 items-center">
                    <input id="{{ $uniqueId }}" aria-describedby="{{ $uniqueId }}-description" type="checkbox" class="instrument-checkbox cursor-pointer h-4 w-4 rounded border-gray-300 text-{{ $theme }} focus:ring-{{ $theme }} focus:ring-offset-0 focus:ring-2 focus:ring-opacity-0 bg-{{ $theme }}-100 checked:bg-{{ $theme }}-500 checked:border-{{ $theme }} focus:outline-none" value="{{ $label }}" />
                </div>
                <div class="text-sm leading-6 text-center lg:text-left">
                    <label for="{{ $uniqueId }}" class="font-medium pl-2 cursor-pointer select-none">{{ $label }}</label>
                </div>
            </div>
        @endforeach
    </div>

    <p id="checkbox-tooltip" class="opacity-0 text-center transition-opacity duration-500 ease-in-out text-red-600 z-10 text-xs m-0 leading-none py-0.5">
        Please select at least one option.
    </p>
</div>