@extends('partials.layout', [ 'noContainer' => true ])

@section('content')
        <chat
            api-key="{{ $apiKey }}"
            token="{{ $token }}"
            user-id="{{ user()->id }}"
            chat-channel-name="{{ $chatChannelName }}"
            questions-channel-name="{{ $questionsChannelName }}"
            :is-administrator="{{ json_encode(boolval($isAdministrator)) }}"
            :user-data="{{ json_encode($userData) }}"
            embed-url="{{ $embedUrl }}"
        />
@endsection

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.2.5/polyfill.js"></script>
    <script>
        const isDarkMode = JSON.parse(localStorage.getItem("darkMode"));
        const body = document.getElementById("app-body");
        if(isDarkMode){
            body.classList.add("tw-dark");
        }
        else {
            body.classList.remove("tw-dark");
        }
    </script>
@endsection
