@extends('partials.layout')

@section('content')

    <div class="" style="width: 440px; height: 820px;">
        {{-- todo: fix --}}
{{--        <chat--}}
{{--            api-key="{{ $apiKey }}"--}}
{{--            token="{{ $token }}"--}}
{{--            user-id="{{ user()->id }}"--}}
{{--            chat-channel-name="{{ $chatChannelName }}"--}}
{{--            questions-channel-name="{{ $questionsChannelName }}"--}}
{{--            :is-administrator="{{ json_encode(boolval($isAdministrator)) }}"--}}
{{--            :user-data="{{ json_encode($userData) }}"--}}
{{--            embed-url="{{ $embedUrl }}"--}}
{{--        />--}}
    </div>

@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>
@endsection
