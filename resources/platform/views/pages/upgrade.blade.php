@extends('partials.layout')

@section('meta')
    <title>Upgrade Membership | Musora</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-10 dark:tw-text-white">
        <static-header
            title="Restart Your membership"
            cta-text="Restart Your membership"
            description="Click here to restart your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
            cta-url="{{ get_legacy_brand_base_url() . '/#customize-anchor'  }}"
            img="https://www.musora.com/musora-cdn/image/width=720,quality=95/https://d1923uyy6spedc.cloudfront.net/coaches-2022/pianote/Lisa-Witt-Pianote-ACTION.jpg"
        />
    </div>
@endsection

