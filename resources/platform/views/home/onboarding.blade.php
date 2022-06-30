@php
    //dd(json_encode(config('onboarding.options.pianote')));
@endphp


@extends('partials.layout')

@section('meta')
    <title>Onboarding | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <onboarding :config-options="{{ json_encode(config('onboarding.options')) }}"></onboarding>
    </div>
@endsection
