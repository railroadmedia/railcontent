<div class="tw-flex tw-flex-row tw-flex-auto pa-3 tw-text-black dark:tw-text-white tw-py-3" >
    @foreach($allBrands as $brand)
        <span class="tw-inline-flex tw-flex-row form-group tw-items-center mr-2">
            <span class="radio-input tw-mr-2">
                <input id="notifications-brand-drumeo"
                       name="brand"
                       {{ brand() === $brand ? 'checked' : '' }}
                       value="{{ $brand }}"
                       type="radio">
                <span class="toggle"></span>
            </span>

            <label for="notifications-brand-drumeo" class="toggle-label tw-text-black dark:tw-text-white capitalize">
                {{ $brand }}
            </label>
        </span>
    @endforeach
</div>
