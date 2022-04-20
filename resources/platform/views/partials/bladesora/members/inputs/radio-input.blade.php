<div class="tw-flex tw-flex-row form-group tw-items-center">
    <span class="radio-input tw-mr-1">
        <input id="{{ $inputID }}"
               name="{{ $inputName }}"
               {{ !empty($checked) && $checked === true ? 'checked' : '' }}
               value="{{ $inputValue ?? '' }}"
               type="radio">

        <span class="toggle"></span>
    </span>

    <label for="{{ $inputID }}" class="toggle-label">
        {!! $inputLabel !!}
    </label>
</div>