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
                                <div class="tw-text-sm tw-italic justify-center tw-mt-2">
                                    Starting at $20/month thereafter (billed annually). Cancel anytime.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="canRefer" class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-xl 2xl:tw-max-w-none tw-mx-auto">
                        <form id="MusoraEngagementTriggerReferWebForm" @submit.prevent="handleSubmit" class="mx-auto">
                            <!-- Tracking Inputs -->
                            <div v-html="trackingInputsHtml"></div>
                            <input type="hidden" name="form_name" value="Musora Referral">
                            <input type="hidden" name="inf_form_xid" value="MusoraEngagementTriggerReferWebForm">
                            <input type="hidden" name="success_redirect" value="https://www.pianote.com/chord-hacks/lessons">

                            <label for="email" class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6">
                                <strong>Invite via email</strong>
                            </label>
                            <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input id="sign-up-email"
                                       class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                       name="email" type="email" placeholder="Email address..." required="">
                                <button class="submit tw-btn-primary tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                        :class="`tw-bg-${brand} hover:tw-bg-${brand}-600`" type="submit">
                                    Send Invite
                                </button>
                            </div>
                        </form>
                        <div v-if="formSubmitted" class="tw-mt-4 tw-text-green-500">
                            Form has been successfully submitted!
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';
import axios from 'axios';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
const props = defineProps({
    canRefer: {
        type: Boolean,
        default: false,
    },
    inviteUrl: {
        type: String,
        default: '',
    },
    trackingInputsHtml: {
        type: String,
        required: true,
    },
});

const cardImg = computed(() => {
    const imgs = {
        drumeo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-30-day-free-trial.png',
        pianote: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-30-day-free-trial.png',
        guitareo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-30-day-free-trial.png',
        singeo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-30-day-free-trial.png',
    };
    return imgs[brand.value];
});

const formSubmitted = ref(false);

onMounted(() => {
    console.log('Tracking Inputs HTML:', props.trackingInputsHtml);
});

async function handleSubmit(event) {
    const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const userEmail = document.getElementById('sign-up-email');
    if (userEmail.value.match(emailFormat)) {
        try {
            console.log('Submitting form with data:', {
                email: userEmail.value,
                form_name: 'Musora Referral',
                inf_form_xid: 'MusoraEngagementTriggerReferWebForm',
            });
            console.log('Tracking Inputs HTML on submit:', props.trackingInputsHtml);

            const response = await axios.post("/customer-io/submit-email-form", {
                email: userEmail.value,
                form_name: 'Musora Referral',
                inf_form_xid: 'MusoraEngagementTriggerReferWebForm',
                tracking_inputs: props.trackingInputsHtml,
            });

            /*
            *  TODO: check if response.status is 201
            *  if it is 422, the form validation failed
            */
            console.log('Form submitted', response);
            formSubmitted.value = true;
            window.location.href = document.querySelector('input[name="success_redirect"]').value;
        } catch (error) {
            console.error('Error submitting form', error);
        }
    } else {
        console.log('Email format is invalid:', userEmail.value);
        userEmail.classList.add('bg-red-200');
    }
}
</script>
