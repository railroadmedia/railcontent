<template>
    <PageHeaderCta
        v-bind="$attrs"
        :text="`Leave ${lessonData?.challenge.title}`"
        showAllAlways
        @click="handleOpen"
    />

    <ChallengeActionModal v-if="modalOpen" modal-type="leave" :challenge="lessonData.challenge" @close-modal="handleClose" @on-leave-challenge="leaveChallenge" />
</template>
<script setup>
import { ref } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";

import PageHeaderCta from '@collections/PageHeader/PageHeaderCta';
import ChallengeActionModal from '@collections/Modal/ChallengeActionModal';

const props = defineProps({
    lessonData: {
        type: Object,
        default: () => {},
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};

const leaveChallenge = () => {
    window.location.href = `/${brand.value}`;
}
</script>
