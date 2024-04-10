<template>
    <PageHeaderCta v-bind="$attrs" v-if="progressMoreThanZero" :faIconClass="resetIcon" @click="resetWithConfirmation" :text="resetText" />
</template>

<script setup>

import { defineProps, ref, computed } from 'vue';
import PageHeaderCta from '../PageHeaderCta.vue';
import { useResetProgress } from '../../../hooks/useResetProgress';
import { useAttrs } from 'vue'

const props = defineProps({
    progress: {
        type: [Number, String],
        default: null,
    },
    contentId: [Number, String],
});

const { resetProgress } = useResetProgress();

const resetIcon = ref('fas fa-redo-alt fa-flip-horizontal');

const progressMoreThanZero = computed(() => props.progress > 0);

const resetWithConfirmation = () => {
    resetProgress(props.contentId, resetIcon, true);
};

const attrs = useAttrs()

const resetText = attrs.inDropdown ? 'Reset Progress' : null;

</script>