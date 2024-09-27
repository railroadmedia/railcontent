@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"
    integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha1/0.6.0/sha1.min.js"></script>
@endsection

@section('layout-scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
       

                /*
        function emailSignUpConversionTrackerForImpactProvider() {
            var email = document.getElementById('sign-up-email').value;
            console.log('Email:', email);
        
            var hashedEmail = sha1(email);
            console.log('Hashed Email (SHA-1):', hashedEmail);
        
            var hashedOrderId = md5('drumeo_'.concat(email));
            console.log('Hashed Order ID (MD5):', hashedOrderId);
        
            var actionTrackerId = getSignUpActionTrackerId(document.getElementById('env').value);
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
        */
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

    {{-- <input type="hidden" id="env" value="{{ config('app.env') }}"> --}}

    <invite-friend
        :can-refer="{{ json_encode($canRefer) }}"
        invite-url="{{ url()->route('referral.email-invite') }}"
        tracking-inputs-html="{{ $trackingInputsHtml }}"
    ></invite-friend>
@endsection