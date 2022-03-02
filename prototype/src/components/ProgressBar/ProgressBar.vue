<script setup>
import Step from './Step.vue'
const props = defineProps({
    brand: {
        type: String
    },
    currentStep: {
        type: Number
    },
    steps: {
        type: Array,
        default: []
    }
})

const getStepType = (stepIndex, checked) => {
    if (stepIndex === props.currentStep) {
        return 'number'
    }
    if (!checked) {
        return 'white'
    }
    if (checked) {
        return 'tick'
    }
}
</script>

<template>
    <div class="tw-flex">
        <Step
            v-for="(step, index) in steps"
            :label="step.label"
            v-bind:key="`${step.label}-step`"
            :currentStep="currentStep"
            :brand="brand"
            :stepType="getStepType(index, step.checked)"
            :isLast="steps.length - 1 === index"
        />
    </div>
</template>
