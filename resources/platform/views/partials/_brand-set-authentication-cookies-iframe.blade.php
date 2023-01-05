@if((session()->has('logged_in_recently') && !empty(user())) ||
(!session()->has('last_set_auth_time') && !empty(user())) ||
(time() - session()->get('last_set_auth_time') > 1000) && !empty(user()))

    @php
        session()->put('last_set_auth_time', time());
    @endphp

    <iframe src="{{ get_legacy_brand_base_url('drumeo') . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
    <iframe src="{{ get_legacy_brand_base_url('pianote') . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
    <iframe src="{{ get_legacy_brand_base_url('guitareo') . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
    <iframe src="{{ get_legacy_brand_base_url('singeo') . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
@endif
