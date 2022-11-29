@if(current_user_has_recent_order())
    @if(brand() == 'drumeo')
        {{-- fix --}}
        <iframe src="{{ get_legacy_brand_base_url() . '/laravel/public/railanalytics/blank-tracking-page' }}"
                loading="lazy"
                style="position: absolute; width:0; height:0; border:0;">
        </iframe>
    @else
        <iframe src="{{ get_legacy_brand_base_url() . '/railanalytics/blank-tracking-page' }}"
                loading="lazy"
                style="position: absolute; width:0; height:0; border:0;">
        </iframe>
    @endif
@endif
