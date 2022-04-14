@foreach($fields as $key => $value)
    @if($value || !empty($showEmpty))
        <div class="tw-flex tw-flex-row text-field tw-flex-auto tw-mb-1">
            <div class="tw-flex tw-flex-col key">
                <p class="body font-bold">{{ ucwords($key) }}</p>
            </div>
            <div class="tw-flex tw-flex-col value tw-grow">
                <p class="body">{{ $value }}</p>
            </div>
        </div>
    @endif
@endforeach