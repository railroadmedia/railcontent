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

</script>
<template>
    <MembershipSelectModal @onCloseModal="() => location.reload()" :upgradeCost="upgradeCost" :currentTier="currentTier"
        :isLifetimeMember="isLifetimeMember" />
</template>
