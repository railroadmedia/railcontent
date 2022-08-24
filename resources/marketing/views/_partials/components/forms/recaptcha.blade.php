{{-- Reacaptcha Componetn --}}

<div class="g-recaptcha" data-sitekey="{{ $siteKey }}"></div>
<input type="hidden" name="{{$tokenName}}" x-ref="{{$tokenName}}">

{{-- 
<script>
import { VueRecaptcha } from 'vue-recaptcha';

export default {
    components: {
        VueRecaptcha
    },
    props: {
        siteKey: {
            type: String,
            required: true,
        }
    },
    methods: {
        onVerify: function (response) {
            if (response) {
                this.$emit('update:verified', response);
            }
        },
    },


}
</script> --}}