<script setup>
import MembershipSelect from './MembershipSelect.vue';

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

const handleModalClose = () => {
    history.back();
};
</script>

<template>
    <div class="tw-text-center tw-text-black dark:tw-text-white tw-flex tw-flex-col tw-py-[40px] tw-justify-center tw-items-center">
        <div class="tw-w-full tw-pb-[36px] tw-max-w-[754px]">
            <h1 class="tw-font-bold tw-text-[24px]">We're sorry, but your Membership level does not include Songs.</h1>
            <p class="tw-font-regular tw-text-[16px] tw-mt-[5px]">Please upgrade your membership to a Musora+ level membership to
                access our songs library.
                You can manage your subscription from your Account Details.</p>
        </div>
        <MembershipSelect @onCloseModal="handleModalClose" :upgradeCost="upgradeCost" :currentTier="currentTier"
            :hideHeaders="true" :isLifetimeMember="isLifetimeMember" />
    </div>
</template>
