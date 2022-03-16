<script setup>
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
import Button from '../../Button/Button.vue'
import StepWrapper from '../StepWrapper.vue'
import SkipStep from '../SkipStep.vue'
import MultiSelect from '../../MultiSelect/MultiSelect.vue'
import { defineEmits, defineProps, ref } from 'vue'
const props = defineProps({
    brand: {
        type: String
    },
    steps: {
        type: Array
    },
    info: {
        type: Object
    }
})
const emit = defineEmits(['onChangeStep', 'onCheckStep', 'onChangeInfo'])
const options = [
    { value: 'g', text: 'G' },
    { value: 'h', text: 'H' },
    { value: 'i', text: 'I' }
]
function handleMultiSelection(selection) {
    emit(
        'onCheckStep',
        5,
        Object.values(selection).find((val) => val)
    )
    emit('onChangeInfo', { ...props.info, topics: selection })
}
function skipStep() {
    alert('* the user skipped the step *')
}
</script>

<template>
    <StepWrapper :brand="brand" :showBgImg="true">
        <h2
            class="tw-mb-[40px] tw-w-full tw-text-center tw-font-bold tw-text-white"
        >
            Okay, and what topics would you like to study?
        </h2>
        <MultiSelect
            :options="options"
            :initialSelection="info.topics"
            classOverride="tw-mb-[52px]"
            @onChangeSelection="handleMultiSelection"
        />
        <ProgressBar
            :brand="brand"
            :currentStep="5"
            :steps="steps"
            @onChangeStep="(s) => emit('onChangeStep', s)"
        />
        <Button
            @onButtonClick="
                () => {
                    emit('onChangeStep', 6)
                }
            "
            :isDisabled="!steps[5].checked"
            :brand="brand"
            classOverride="tw-w-[543px] tw-mt-[40px]"
            >Next</Button
        >
        <SkipStep @onSkip="skipStep" />
    </StepWrapper>
</template>
