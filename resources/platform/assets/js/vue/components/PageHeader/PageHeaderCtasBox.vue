<template>
    <div class="tw-flex tw-items-center tw-flex-grow"
        :class="[progress ? 'tw-justify-between sm:tw-justify-end' : 'tw-justify-end']">
        <ProgressText v-if="progress" :progress="progress" :alwaysShow="alwaysShowProgress">
            <template #progress-text v-if="progressText">{{ progressText }} -&nbsp;</template>
        </ProgressText>
        <div class="ctas-container">
            <CtaResolver :ctas="secondaryCtas" />
        </div>
    </div>
</template>

<script setup>
import { computed, defineProps } from 'vue';
import ProgressText from './ProgressBar/ProgressText.vue';
import CtaResolver from './Ctas/CtaResolver.vue';

const props = defineProps({
    progressBarData: {
        type: Object,
        default: null,
    },
    secondaryCtas: {
        type: Array,
        default: () => [],
    },
});

const progress = computed(() => props.progressBarData?.progress);
const progressText = computed(() => props.progressBarData?.labelText);
const alwaysShowProgress = computed(() => props.progressBarData?.alwaysShow);
</script>
<style lang="scss" scoped>
.ctas-container {
    ::v-deep > * {
    margin-left: 0.5rem;
  }
}
</style>