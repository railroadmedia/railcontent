<template>
    <div class="referral-sections tw-h-full">
        <section class="tw-text-center tw-text-[#00101D] dark:tw-text-white tw-transition-colors tw-py-6 md:tw-py-10 lg:tw-pt-12 lg:tw-pb-16">
            <div class="tw-max-w-7xl tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
                <h1 class="lg:tw-mb-14 tw-text-2xl sm:tw-text-3xl xl:tw-text-5xl">
                    <strong>Share 30 days of free<br class="tw-hidden sm:tw-inline"> lessons with a friend!</strong>
                </h1>
                <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center tw-px-4">
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
                    <div class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-xl 2xl:tw-max-w-none tw-mx-auto">
                        <form id="MusoraEngagementTriggerReferWebForm" @submit.prevent="handleSubmitPass" class="mx-auto">
                            <!-- Tracking Inputs -->
                            <input type="hidden" name="form_name" value="Musora Referral">
                            <input type="hidden" name="inf_form_xid" value="MusoraEngagementTriggerReferWebForm">
                            <input type="hidden" name="brand" :value="brand">
                            
                            <label for="email" class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6">
                                <strong>Invite via email</strong>
                            </label>
                            <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input id="sign-up-email"
                                       class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border focus:tw-outline-none"
                                       :class="`focus:tw-border-${brand}`"
                                       name="email" type="email" placeholder="Email address..." required="">
                                <button class="submit tw-btn-primary tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                        :class="`tw-bg-${brand} hover:tw-bg-${brand}-600`" type="submit">
                                    Send Invite
                                </button>
                            </div>
                        </form>
                        <div v-if="isModalOpen">
                            <ModalRenderer>
                                <div class="tw-flex tw-justify-center tw-items-center" style="background:transparent!important;">
                                <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-5 sm:tw-px-8 tw-py-6 sm:tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
                                    <div class="tw-text-2xl tw-font-bold tw-mb-5">{{ modalMessage }}</div>
                                    <div>
                                    <button @click="closeModal" class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Close</button>
                                    </div>
                                </div>
                                </div>
                            </ModalRenderer>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@stores/user';
import ModalRenderer from "@collections/Modal/ModalRenderer";
import axios from 'axios';

const userStore = useUserStore();
const { brand, userEmail } = storeToRefs(userStore);

const cardImg = computed(() => {
    const imgs = {
        drumeo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-30-day-free-trial.png',
        pianote: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-30-day-free-trial.png',
        guitareo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-30-day-free-trial.png',
        singeo: 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-30-day-free-trial.png',
    };
    return imgs[brand.value];
});

const isModalOpen = ref(false);
const modalMessage = ref('');

async function handleSubmitPass(event) {
    const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const userEmailInput = document.getElementById('sign-up-email').value;
    const referrer = userEmail.value;
    const formName = document.querySelector('input[name="form_name"]').value;
    const brand = document.querySelector('input[name="brand"]').value;

    if (userEmailInput.match(emailFormat)) {
        try {
            const validationResponse = await axios.post(`/${brand}/referral/validate-email`, { email: userEmailInput });

            if (validationResponse.data.exists && validationResponse.data.active) {
                showModal('An account with this email address already exists. You can only gift access to new Musora students.');
                return;
            }

            const response = await axios.post("/customer-io/submit-email-form", {
                email: userEmailInput,
                referrer,
                form_name: formName,
                brand,
            });

            if (response.status === 201) {
                showModal("Congrats! You've just shared free music lessons with your friend.");
                document.getElementById('MusoraEngagementTriggerReferWebForm').reset();
            } else {
                showModal("Please try again later.");
            }
        } catch (error) {
            console.error('Error:', error);
            showModal("Please try again later.");
        }
    } else {
        document.getElementById('sign-up-email').classList.add('bg-red-200');
    }
}

function showModal(message) {
    modalMessage.value = message;
    isModalOpen.value = true;
}

function closeModal() {
    isModalOpen.value = false;
}
</script>