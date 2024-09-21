@extends('partials.layout')
@section('meta')
    <title>Musora | Invite A Friend</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <style> .grecaptcha-badge {display:none;right:0!important;} </style>
@endsection
@section('layout-scripts')
    <script>
        function recaptchaSubmitMusoraEngagementTriggerReferWebForm(token) {
            const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            const userEmail = document.getElementById('MusoraEngagementTriggerReferWebForm').querySelector('input[type=email]');

            if(userEmail.value.match(emailFormat)){
                document.getElementById("MusoraEngagementTriggerReferWebForm").submit();
                dataLayer.push({
                    "event": "gtm.formSubmit",
                    "formId": "MusoraEngagementTriggerReferWebForm",
                    "formSuccess": true
                });
                emailSignUpConversionTrackerForImpactProvider();
            } else {
                userEmail.classList.add('bg-red-200');
            }
        }
    </script>

    @endsection
@section('content')
    <invite-friend
        :can-refer="{{ json_encode($canRefer) }}"
        invite-url="{{ url()->route('referral.email-invite') }}"
    ></invite-friend>
@endsection
