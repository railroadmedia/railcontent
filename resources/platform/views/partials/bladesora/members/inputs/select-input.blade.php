<div class="form-group">
    <select id="{{ $inputId }}"
            name="{{ $inputName }}"
            class="{{ !empty($inputErrors) && count($inputErrors) > 0 ? 'has-error' : '' }}
            {{ !empty($borderless) && $borderless === true ? 'borderless' : '' }} {{ $customClasses ?? '' }}"
            {{ !empty($validateRequired) && $validateRequired === true ? 'required' : '' }}
            {{ !empty($disabled) && $disabled === true ? 'disabled' : '' }}>
        @foreach($inputOptions as $optionIndex => $option)
            @if($option == "") 
                <option value=""></option>
            @else
                <option value="{{ $inputValues[$optionIndex] ?? (string)$option }}"
                        {{ $inputValue == $option ? 'selected' : '' }}>
                    {{ ucwords((string)$option) }}
                </option>
            @endif
        @endforeach
    </select>
    <label for="{{ $inputId }}"
           class="{{ $brand }}">
        {{ $inputLabel }}
    </label>

    @include('partials.bladesora.members.inputs.partials._errors', [
        "inputErrors" => $inputErrors
    ])
</div>

