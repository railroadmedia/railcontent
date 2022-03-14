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
const emit = defineEmits(['onChangeStep'])

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
    <div class="tw-flex tw-h-[52px]">
        <Step
            v-for="(step, index) in steps"
            :label="step.label"
            v-bind:key="`${step.label}-step`"
            :currentStep="currentStep"
            @navigateToStep="emit('onChangeStep', index)"
            :brand="brand"
            :isBarBranded="
                getStepType(index, step.checked) === 'tick' ||
                (!(steps.length - 1 === index) &&
                    getStepType(index + 1, steps[index + 1].checked) === 'tick')
            "
            :stepType="getStepType(index, step.checked)"
            :isLast="steps.length - 1 === index"
        />
    </div>
</template>
