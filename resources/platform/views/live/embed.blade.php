@extends('partials.layout')

@section('content')

    <div class="" style="width: 440px; height: 820px;">
        <chat
            api-key="{{ $apiKey }}"
            token="{{ $token }}"
            user-id="{{ current_user()->getId() }}"
            chat-channel-name="{{ $chatChannelName }}"
            questions-channel-name="{{ $questionsChannelName }}"
            :is-administrator="{{ json_encode(boolval($isAdministrator)) }}"
            :user-data="{{ json_encode($userData) }}"
            embed-url="{{ $embedUrl }}"
        />
    </div>

@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>

    <script src="{{ mix('platform/js/manifest.js') }}"></script>
    <script src="{{ mix('platform/js/vendor.js') }}"></script>
    <script src="{{ mix('platform/js/app.js') }}"></script>
@endsection