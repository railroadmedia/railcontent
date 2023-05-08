<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"
    integrity="sha512-8pbzenDolL1l5OPSsoURCx9TEdMFTaeFipASVrMYKhuYtly+k3tcsQYliOEKTmuB1t7yuzAiVo+yd7SJz+ijFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha1/0.6.0/sha1.min.js"></script>
<script>
    function getSignUpActionTrackerId(environment) {
        return (environment == 'production') ?
            "{{ config('railanalytics.guitareo.production.providers.impact.sign-up-action-tracker-id') }}" :
            "{{ config('railanalytics.guitareo.local.providers.impact.sign-up-action-tracker-id') }}";
    }

    function emailSignUpConversionTrackerForImpactProvider() {
        var email = $('.infusion-field').find('input').val();
        var hashedEmail = sha1(email);
        var hashedOrderId = md5('guitareo_'.concat(email))

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
</script>
