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
    <div class="tw-text-center tw-text-white">
        <MembershipSelect @onCloseModal="handleModalClose" :upgradeCost="upgradeCost" :currentTier="currentTier"
            :isLifetimeMember="isLifetimeMember" />
    </div>
</template>
