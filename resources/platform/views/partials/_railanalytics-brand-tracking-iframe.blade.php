@if($currentUserHasRecentOrder ?? false)
    <iframe src="{{ get_legacy_brand_base_url('drumeo') . '/railanalytics/blank-tracking-page?cache_key=' . $drumeoCacheKey }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>

    <iframe src="{{ get_legacy_brand_base_url('pianote') . '/railanalytics/blank-tracking-page?cache_key=' . $pianoteCacheKey }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>

    <iframe src="{{ get_legacy_brand_base_url('guitareo') . '/railanalytics/blank-tracking-page?cache_key=' . $guitareoCacheKey }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>

    <iframe src="{{ get_legacy_brand_base_url('singeo') . '/railanalytics/blank-tracking-page?cache_key=' . $singeoCacheKey }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
@endif
