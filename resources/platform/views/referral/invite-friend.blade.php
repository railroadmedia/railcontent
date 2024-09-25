@extends('partials.layout')
@section('meta')
    <title>Musora | Invite A Friend</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"
        integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha1/0.6.0/sha1.min.js"></script>
    <style> .grecaptcha-badge {display:none;right:0!important;} </style>
@endsection

@section('content')
    <invite-friend
        :can-refer="{{ json_encode($canRefer) }}"
        invite-url="{{ url()->route('referral.email-invite') }}"
        timestamp="{{ Carbon\Carbon::now() }}"
        recaptcha-key="{{$recaptchaKey}}"
    ></invite-friend>
@endsection
