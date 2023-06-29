@extends('partials.layout')

@section('meta')
    <title>Paused access | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-10 dark:tw-text-white">
        <static-header
            title="Continue your membership"
            cta-text="Continue your membership"
            description="Click here to continue your membership and  back access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
            cta-url="{{ url()->route('platform.profile.settings.account') }}"
            img="https://musora.com/cdn-cgi/image/width=720/https://cdn.musora.com/image/fetch/c_fill,w_1920,h_1080,q_auto:good/https://d1923uyy6spedc.cloudfront.net/coaches-2022/pianote/Lisa-Witt-Pianote-ACTION.jpg"
        />
    </div>
@endsection
