<template>
    <div class="referral-sections tw-h-full">
        <section class="tw-text-center tw-text-[#00101D] dark:tw-text-white tw-transition-colors tw-py-6 md:tw-py-10 lg:tw-pt-12 lg:tw-pb-16">
            <div class="tw-max-w-7xl tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
                <h1 class="lg:tw-mb-14 tw-text-2xl sm:tw-text-3xl xl:tw-text-5xl">
                    <strong>Share 30 days of free<br class="tw-hidden sm:tw-inline"> lessons with a friend!</strong>
                </h1>
                <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center tw-px-4" :class="canRefer ? '' : ''">
                    <div class="tw-flex-shrink-0 tw-w-full tw-max-w-xs sm:tw-max-w-md md:tw-max-w-lg lg:tw-max-w-xl tw-my-5 md:tw-my-6 lg:tw-my-0">
                        <div class="tw-flex tw-w-full tw-relative">
                            <div class="tw-w-full">
                                <div class="relative">
                                    <img class="inline-block w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl" :src="cardImg" :alt="`${brand} guest card`">
                                </div>
                                <div class="tw-text-sm tw-italic justify-center tw-mt-2">Starting at $20/month thereafter (billed annually). Cancel anytime.</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="canRefer"
                        class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-xl 2xl:tw-max-w-none tw-mx-auto"
                    >
                        <form id="MusoraEngagementTriggerReferWebForm" accept-charset="UTF-8" method="POST"
                            action="/customer-io/submit-email-form-rc" class="ajax-form clearfix mx-auto">
                            <!-- Hidden Fields -->
                            <input type="hidden" name="form_name" value="Musora Referral">
                            <input type="hidden" name="inf_form_xid" value="MusoraEngagementTriggerReferWebForm">
                            <input type="hidden" name="success_redirect" value="TODO">
                            <input type="hidden" name="timestamp" value="{{ Carbon\Carbon::now() }}">
                            <input type="hidden" name="brand" value="{{$brand}}">
                            <!-- Form Inputs -->
                            <label for="email" class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6">
                                <strong>Invite via email</strong>
                            </label>
                            <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input id="sign-up-email" 
                                    class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border" 
                                    name="email" 
                                    type="email" 
                                    placeholder="Email address..." 
                                    required=""
                                />
                                <button class="submit g-recaptcha tw-btn-primary tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-text-white tw-flex-none tw-w-full sm:tw-w-52" 
                                    :class="`tw-bg-${brand} hover:tw-bg-${brand}-600`"
                                    type="submit"
                                    data-sitekey="{{$recaptchaKey}}"
                                    data-callback='recaptchaSubmitMusoraEngagementTriggerReferWebForm'
                                    data-action='submit'>
                                    Send Invite
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <ModalRenderer v-if="isModalOpen">
        <div class="tw-flex tw-justify-center tw-items-center" style="background:transparent!important;">
            <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-5 sm:tw-px-8 tw-py-6 sm:tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
                <div class="tw-text-2xl tw-font-bold">Thanks for sharing your love of music!</div>
                <p class="tw-mt-3 tw-mb-5 tw-max-w-md tw-mx-auto">
                    You've successfully sent <span id="modalEmail"></span>
                    <br class="tw-hidden sm:tw-inline-block"> a 30-Day {{ capitalize(brand) }} Trial to {{ invitee }}.
                </p>
                <div>
                    <button @click="closeModal" class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Close</button>
                </div>
            </div>
        </div>
    </ModalRenderer>
</template>
<script setup>
import { computed, inject, ref } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import ModalRenderer from "@collections/Modal/ModalRenderer";
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const token = inject('csrf_token');
const props = defineProps({
    canRefer: {
        type: Boolean,
        default: false,
    },
    inviteUrl: {
        type: String,
        default: '',
    },
})
const emailError = ref(false);
const invitee = ref('');
const isModalOpen = ref(false);
const cardImg = computed(() => {
    const imgs = {
        drumeo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-30-day-free-trial.png',
        pianote: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-30-day-free-trial.png',
        guitareo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-30-day-free-trial.png',
        singeo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-30-day-free-trial.png',
    }
    return imgs[brand.value];
})
const capitalize = (string) => {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
const sendPass = (event) => {
    emailError.value = false;
    const form = event.target;
    let token = form._token.value;
    let brand = form.brand.value;
    let email = form.email.value;
    const emailFormat = /^\w+([\.-^+]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let data = {
        _token: token,
        brand,
        email,
    };
    if(email.match(emailFormat)){
        fetch(props.inviteUrl, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((res) => {
            isModalOpen.value = true;
        })
    }
    else {
        emailError.value = true;
    }
}
const closeModal = () => {
    isModalOpen.value = false;
    invitee.value = '';
}
</script>
