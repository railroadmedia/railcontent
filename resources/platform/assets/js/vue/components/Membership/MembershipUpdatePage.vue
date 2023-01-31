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

const handleModalClose = () => {
    history.back();
};

</script>
<template>
    <MembershipSelectModal @onCloseModal="handleModalClose" :upgradeCost="upgradeCost" :currentTier="currentTier"
        :isLifetimeMember="isLifetimeMember" />
</template>
