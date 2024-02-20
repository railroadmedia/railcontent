<template>
    <PageHeaderCta v-if="progressMoreThanZero" :faIconClass="resetIcon" @click="resetWithConfirmation" />
</template>

<script setup>

import { defineProps, ref, computed } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { useResetProgress } from '../../../hooks/useResetProgress';

const props = defineProps({
    progress: {
        type: [Number, String],
        default: null,
    },
    contentId: String,
});

const { resetProgress } = useResetProgress();

const resetIcon = ref('fas fa-redo-alt fa-flip-horizontal');

const progressMoreThanZero = computed(() => props.progress > 0);

const resetWithConfirmation = () => {
    resetProgress(props.contentId, resetIcon, true);
};
</script>