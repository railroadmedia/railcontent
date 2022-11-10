@extends('partials.layout')

@section('meta')
    <title>Upgrade Membership | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <static-header
            title="Restart Your membership"
            cta-text="Restart Your membership"
            description="Click here to restart your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
            cta-url="{{ get_legacy_brand_base_url() . '/shop'  }}"
            img="https://musora.com/cdn-cgi/image/width=720/https://cdn.musora.com/image/fetch/c_fill,w_1920,h_1080,q_auto:good/https://d1923uyy6spedc.cloudfront.net/coaches-2022/pianote/Lisa-Witt-Pianote-ACTION.jpg"
        />
    </div>
@endsection

