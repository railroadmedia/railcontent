<template>
    <PageHeaderCta v-bind="$attrs" v-if="showReset" :faIconClass="resetIcon" @click="resetWithConfirmation" :text="resetText" />
</template>

<script setup>

import { ref, computed } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { useResetProgress } from '@hooks/useResetProgress';
import { useAttrs } from 'vue'

const props = defineProps({
    progress: {
        type: [Number, String],
        default: null,
    },
    contentId: [Number, String],
    isChallenge: Boolean,
});

const { resetProgress } = useResetProgress();

const resetIcon = ref('fas fa-redo-alt fa-flip-horizontal');

const showReset = computed(() => {
    return props.progress > 0 && !props.isChallenge;
});

const resetWithConfirmation = () => {
    resetProgress(props.contentId, resetIcon, true);
};

const attrs = useAttrs()

const resetText = attrs.inDropdown ? 'Reset Progress' : null;
</script>
