<template>
    <div>
        <PageHeaderCta
            v-bind="$attrs"
            text="Unlock"
            showAllAlways
            @click="handleOpen"
        />
        <ChallengeActionModal v-if="modalOpen" modal-type="unlock" @close-modal="handleClose" :content-id="contentId" :challenge="lessonData" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import PageHeaderCta from '@collections/PageHeader/PageHeaderCta';
import ChallengeActionModal from '@collections/Modal/ChallengeActionModal';

const props = defineProps({
    text: String,
    contentId: {
        type: [String, Number],
        default: null,
    },
    lessonData: {
        type: Object,
        default: () => {},
    },
});

const modalOpen = ref(false);

const handleOpen = () => {
    modalOpen.value = true;
};

const handleClose = () => {
    modalOpen.value = false;
};
</script>
