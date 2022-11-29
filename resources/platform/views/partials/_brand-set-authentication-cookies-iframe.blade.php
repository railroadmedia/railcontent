@if((session()->has('logged_in_recently') && !empty(user())) ||
(!session()->has('last_set_auth_time') || (time() - session()->get('last_set_auth_time') > 1000) ))

    @php
        session()->put('last_set_auth_time', time());
    @endphp

    <iframe src="{{ get_legacy_brand_base_url('drumeo', false) . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
    <iframe src="{{ get_legacy_brand_base_url('pianote', false) . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
    <iframe src="{{ get_legacy_brand_base_url('guitareo', false) . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
    <iframe src="{{ get_legacy_brand_base_url('singeo', false) . '?blank_response&user_id=' . user()->id .
            '&auth_key=' . generate_musora_cross_platform_login_key(user()->id, user()->password) }}"
            loading="lazy"
            style="position: absolute; width:0; height:0; border:0;">
    </iframe>
@endif
