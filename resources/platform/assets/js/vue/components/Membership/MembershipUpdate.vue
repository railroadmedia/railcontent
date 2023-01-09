<script setup>
import { ref } from 'vue';
import MembershipSelectModal from './MembershipSelectModal.vue';

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    upgradeCost: {
        type: String,
        default: null,
    },
    currentTier: {
        type: String,
        default: 'plus'
    },
    isLifetimeMember: {
        type: Boolean,
        default: false,
    },
});

const isModalOpen = ref(false);
const hasSongAccess = ref(false);

const toggleModal = () => {
    isModalOpen.value = !isModalOpen.value;
};

</script>
<template>
    <div
        class="tw-mt-[30px] tw-relative tw-flex tw-flex-col xl:tw-flex-row tw-justify-between tw-w-full tw-min-h-[137px] tw-px-[30px] tw-py-[32px] tw-bg-[#002039] tw-border-1 tw-border-[#223F57] tw-rounded-[8px]">
        <div class="tw-flex tw-flex-col tw-text-center xl:tw-text-left tw-text-white">
            <div class="tw-flex tw-justify-center xl:tw-justify-start">
                <svg width="106" height="25" viewBox="0 0 106 25" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="tw-w-[106px] tw-h-[25px]">
                    <path
                        d="M5.69617 17.32H0.000692379C-0.13124 27.5441 18.6355 27.3779 18.6355 17.6187C18.6355 11.8097 14.1573 11.1127 9.58198 10.6148C7.5084 10.3824 5.79575 10.0172 5.92768 8.25805C6.12434 5.50277 12.3152 5.23723 12.3152 8.32431H17.9111C18.0431 -1.70043 0.132614 -1.70043 0.331757 8.32431C0.396479 13.3698 3.68981 15.0961 8.69328 15.4612C10.9984 15.594 12.9077 15.9592 12.9077 17.5856C12.9077 20.3075 5.69617 20.2743 5.69617 17.32ZM92.5476 17.32H86.8521C86.7202 27.5441 105.487 27.3779 105.487 17.6187C105.487 11.8097 101.009 11.1127 96.4334 10.6148C94.3598 10.3824 92.6472 10.0172 92.7791 8.25805C92.9758 5.50277 99.1667 5.23723 99.1667 8.32431H104.763C104.895 -1.70043 86.9841 -1.70043 87.1807 8.32431C87.2479 13.3698 90.5388 15.0961 95.5447 15.4612C97.8498 15.594 99.7591 15.9592 99.7591 17.5856C99.7591 20.3075 92.5476 20.2743 92.5476 17.32ZM42.5377 12.8387C42.5377 4.80579 36.6281 0.789062 30.7185 0.789062C24.809 0.789062 18.8994 4.80579 18.8994 12.8387C18.8994 28.9383 42.5377 28.9383 42.5377 12.8387ZM64.0029 12.8056C64.0378 20.7392 69.9623 24.6891 75.8221 24.6891C80.0713 24.6891 84.45 22.8304 86.0954 17.9839C86.8845 15.7268 86.8845 13.5026 86.755 11.179H75.8569V16.3241H80.7608C79.7078 18.5483 78.1944 19.179 75.8221 19.179C72.3321 19.179 70.0942 16.6562 70.0942 12.8056C70.0942 9.2537 72.1031 6.33277 75.8221 6.33277C78.162 6.33277 79.6755 7.12938 80.6289 9.12093H86.424C85.3063 3.34507 80.4646 0.921833 75.8221 0.888703C69.9623 0.888703 64.0378 4.87204 64.0029 12.8056ZM61.073 24.457H63.1814V1.18737H57.1549V12.5732L45.5025 1.08799H43.3617V24.4236H49.453V13.0049L61.073 24.457ZM24.9583 12.8387C24.9583 8.65636 27.8459 6.56492 30.736 6.56492C33.6236 6.56492 36.5136 8.65636 36.5136 12.8387C36.5136 21.2702 24.9583 21.2702 24.9583 12.8387Z"
                        fill="currentColor" />
                </svg>
            </div>
            <div class="tw-pt-[12px] xl:tw-pt-[5px] xl:tw-pr-[30px]">
                <p v-if="!hasSongAccess">
                    Your current Membership does not include access to Songs.
                </p>
                <p v-if="hasSongAccess">
                    You have Musora Plus Membership until the end of your billing cycle.
                </p>
            </div>
        </div>
        <div class="tw-flex tw-justify-center tw-items-center xl:tw-mt-auto tw-mt-[24px]">
            <button @click="toggleModal" class="tw-btn-secondary">
                {{ hasSongAccess ? 'Update' : 'Upgrade' }}
            </button>
            <MembershipSelectModal
                v-if="isModalOpen" @onCloseModal="toggleModal"
                :upgradeCost="upgradeCost"
                :currentTier="currentTier"
                :isLifetimeMember="false"
            />
        </div>
    </div>
</template>
