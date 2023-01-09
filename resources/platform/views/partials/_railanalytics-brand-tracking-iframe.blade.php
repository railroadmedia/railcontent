@if(current_user_has_recent_order())
    <iframe src="{{ get_legacy_brand_base_url('drumeo') . '/railanalytics/blank-tracking-page' }}?{{ http_build_query(\App\Analytics\Tracker::getQueueForBrand('drumeo')) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
@endif
