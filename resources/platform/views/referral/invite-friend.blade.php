@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha1/0.6.0/sha1.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style> .grecaptcha-badge {display:none; right:0!important;} </style>
@endsection

@section('layout-scripts')
    <script>
        function recaptchaSubmitMusoraEngagementTriggerReferWebForm(token) {
            const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            const userEmail = document.getElementById('MusoraEngagementTriggerReferWebForm').querySelector('input[type=email]');
                event.preventDefault();
            if (userEmail.value.match(emailFormat)) {
                console.log('Email format is valid:', userEmail.value);
                console.log('Submitting form...');
                document.getElementById("MusoraEngagementTriggerReferWebForm").submit();
                console.log('Form submitted');
                dataLayer.push({
                    "event": "gtm.formSubmit",
                    "formId": "MusoraEngagementTriggerReferWebForm",
                    "formSuccess": true
                });
                console.log('Data layer event pushed');
                emailSignUpConversionTrackerForImpactProvider();
                console.log('Conversion tracker called');
            } else {
                console.log('Email format is invalid:', userEmail.value);
                userEmail.classList.add('bg-red-200');
            }
        }

        function emailSignUpConversionTrackerForImpactProvider() {
            var email = document.getElementById('sign-up-email').value;
            console.log('Email:', email);
        
            var hashedEmail = sha1(email);
            console.log('Hashed Email (SHA-1):', hashedEmail);
        
            var hashedOrderId = md5('drumeo_'.concat(email));
            console.log('Hashed Order ID (MD5):', hashedOrderId);
        
            var actionTrackerId = getSignUpActionTrackerId('{{ config('app.env') }}');
            console.log('Action Tracker ID:', actionTrackerId);
        
            ire('trackConversion', actionTrackerId, {
                    orderId: hashedOrderId,
                    customerId: hashedOrderId,
                    customerEmail: hashedEmail
                },
                {
                    verifySiteDefinitionMatch: true
                }
            );
        
            console.log('Conversion tracking initiated with IRE.');
        }
        
        function getSignUpActionTrackerId(environment) {
            console.log('Environment:', environment);
            return (environment == 'production') ?
                "{{ config('railanalytics.drumeo.production.providers.impact.sign-up-action-tracker-id') }}" :
                "{{ config('railanalytics.drumeo.local.providers.impact.sign-up-action-tracker-id') }}";
        }
    </script>
@endsection

@section('content')
    @php
        $trackingInputsHtml = \Railroad\LeadTracker\Services\LeadTrackerService::getRequestTrackingInputsHtmlFromRequest(
            'Musora Referral',
            route('customer-io.submit-email-form', [], false),
            'post',
            null,
            null,
            null
        );
    @endphp

    <invite-friend
        :can-refer="{{ json_encode($canRefer) }}"
        invite-url="{{ url()->route('referral.email-invite') }}"
        recaptcha-key="{{ env('VUE_APP_RECAPTCHA_KEY') }}"
        tracking-inputs-html="{{ $trackingInputsHtml }}"
    ></invite-friend>
@endsection