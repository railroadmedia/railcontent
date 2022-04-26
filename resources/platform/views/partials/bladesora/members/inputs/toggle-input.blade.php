<div class="tw-flex tw-flex-row form-group tw-items-center">
    <span class="toggle-input mr-1">
        <input type="hidden"
               class="hidden-input"
               name="{{ $inputName }}"
               value="{{ $checked ? 1 : 0 }}">

        <input id="{{ $inputID }}"
               {{ !empty($checked) && $checked === true ? 'checked' : '' }}
               type="checkbox">

        <span class="toggle">
            <span class="handle"></span>
        </span>
    </span>

    <label for="{{ $inputID }}" class="toggle-label">
        {{ $inputLabel }}
    </label>
</div>