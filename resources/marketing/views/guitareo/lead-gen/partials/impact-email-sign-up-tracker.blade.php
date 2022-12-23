<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"
    integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha1/0.6.0/sha1.min.js"></script>
<script>
    function getSignUpActionTrackerId(environment) {
        var signUpActionTrackerId =
            "{{ config('railanalytics.production.providers.impact.sign-up-action-tracker-id') }}"
        if (environment == "development") {
            signUpActionTrackerId =
                "{{ config('railanalytics.development.providers.impact.sign-up-action-tracker-id') }}"
        } else if (environment == "staging") {
            signUpActionTrackerId = "{{ config('railanalytics.staging.providers.impact.sign-up-action-tracker-id') }}"
        } else if (environment == "testing") {
            signUpActionTrackerId = "{{ config('railanalytics.testing.providers.impact.sign-up-action-tracker-id') }}"
        }
        return signUpActionTrackerId;
    }

    function emailSignUpConversionTrackerForImpactProvider() {
        var email = $('.infusion-field').find('input').val();
        var hashedEmail = sha1(email);
        var hashedOrderId = md5('guitareo_'.concat(email))
        /*
    TODO: Uncomment when impact provider is installed properly
    
        ire('trackConversion', getSignUpActionTrackerId('{{ config('app.env') }}'), {
                orderId: hashedOrderId,
                customerId: hashedOrderId,
                customerEmail: hashedEmail
            },
            {
                verifySiteDefinitionMatch:true
            }
        );
    }
    */
</script>
