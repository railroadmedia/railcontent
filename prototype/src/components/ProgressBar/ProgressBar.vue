<script setup>
import Step from './Step.vue'
const props = defineProps({
    brand: {
        type: String
    },
    step: {
        type: Number
    }
})

const stepLabels = [
    'ABOUT',
    'INSTRUMENT',
    'EXPERIENCE',
    'GENRES',
    'TOPICS',
    'COACHES'
]

const getStepType = (stepIndex, currentStep) => {
    if (stepIndex > currentStep) {
        return 'white'
    }
    if (stepIndex < currentStep) {
        return 'tick'
    }
    if (stepIndex === currentStep) {
        return 'number'
    }
}
</script>

<template>
    <div class="tw-flex">
        <Step
            v-for="(label, index) in stepLabels"
            :label="label"
            v-bind:key="`${label}-step`"
            :step="step"
            :brand="brand"
            :stepType="getStepType(index, step)"
            :isLast="stepLabels.length - 1 === index"
        />
    </div>
</template>
