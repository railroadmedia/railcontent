@foreach($fields as $key => $value)
    @if($value || !empty($showEmpty))
        <div class="tw-flex tw-flex-row text-field tw-flex-auto tw-mb-2">
            <div class="tw-flex tw-flex-col key">
                <p class="tw-font-bold">{{ ucwords($key) }}</p>
            </div>
            <div class="tw-flex tw-flex-col value">
                <p class="body">{{ $value }}</p>
            </div>
        </div>
    @endif
@endforeach