@if($currentUserHasRecentOrder ?? false)
    <iframe src="{{ get_legacy_brand_base_url($brand) . '/railanalytics/blank-tracking-page?cache_key=' . $cacheKey }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>

{{--    @php--}}
{{--        cache()->store('redis')->put(auth()->id() . '_recent_order_analytics_data_pianote', \App\Analytics\Tracker::getQueueForBrand('pianote'), 60)--}}
{{--    @endphp--}}

{{--    <iframe src="{{ get_legacy_brand_base_url('pianote') . '/railanalytics/blank-tracking-page?cache_key=' . auth()->id() . '_recent_order_analytics_data_pianote' }}"--}}
{{--            loading="lazy"--}}
{{--            style="position: absolute; width:0; height:0; border:0;">--}}
{{--    </iframe>--}}

{{--    @php--}}
{{--        cache()->store('redis')->put(auth()->id() . '_recent_order_analytics_data_guitareo', \App\Analytics\Tracker::getQueueForBrand('guitareo'), 60)--}}
{{--    @endphp--}}

{{--    <iframe src="{{ get_legacy_brand_base_url('guitareo') . '/railanalytics/blank-tracking-page?cache_key=' . auth()->id() . '_recent_order_analytics_data_guitareo' }}"--}}
{{--            loading="lazy"--}}
{{--            style="position: absolute; width:0; height:0; border:0;">--}}
{{--    </iframe>--}}

{{--    @php--}}
{{--        cache()->store('redis')->put(auth()->id() . '_recent_order_analytics_data_singeo', \App\Analytics\Tracker::getQueueForBrand('singeo'), 60)--}}
{{--    @endphp--}}

{{--    <iframe src="{{ get_legacy_brand_base_url('singeo') . '/railanalytics/blank-tracking-page?cache_key=' . auth()->id() . '_recent_order_analytics_data_singeo' }}"--}}
{{--            loading="lazy"--}}
{{--            style="position: absolute; width:0; height:0; border:0;">--}}
{{--    </iframe>--}}
@endif
