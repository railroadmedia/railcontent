<script setup>
import { computed } from 'vue'
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
    },
})
const emit = defineEmits(['onChangeStep'])

const getStepType = (stepIndex, checked) => {
    if (stepIndex === props.currentStep) {
        return 'number'
    }
    if (!checked) {
        return 'unchecked'
    }
    if (checked) {
        return 'tick'
    }
}

const displayedIndex = computed(() => {
  const visibleSteps = Array.from({ length: props.currentStep + 1 }, (_, i) => i);
return visibleSteps.length;
});
</script>

<template>
    <div class="tw-flex tw-h-[10px] md:tw-h-[52px]">
        <Step
            v-for="(step, index) in steps"
            :currentStepDisplayNumber="displayedIndex"
            :label="step.label"
            v-bind:key="`${step.label}-step`"
            :currentStep="currentStep"
            @navigateToStep="emit('onChangeStep', index)"
            :brand="brand"
            :isBarBranded="
                index === 0 ||
                getStepType(index, step.checked) === 'tick' ||
                (!(steps.length - 1 === index) &&
                    getStepType(index + 1, steps[index + 1].checked) === 'tick')
            "
            :stepType="getStepType(index, step.checked)"
            :isLast="steps.length - 1 === index"
        />
    </div>
</template>
