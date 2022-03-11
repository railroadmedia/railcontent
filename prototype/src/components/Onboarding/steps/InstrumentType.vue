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
    { value: 'a', text: 'A' },
    { value: 'b', text: 'B' },
    { value: 'c', text: 'C' }
]
function handleMultiSelection(selection) {
    emit(
        'onCheckStep',
        2,
        Object.values(selection).find((val) => val)
    )
}
function skipStep() {
    alert('* the user skipped the step *')
}
</script>

<template>
    <StepWrapper :brand="brand" :showBgImg="true">
        <h2
            class="tw-mb-[5px] tw-w-full tw-text-center tw-font-bold tw-text-white"
        >
            What kind of gear will you be practicing with?
        </h2>
        <p class="tw-font-[16px] tw-mb-[40px] tw-max-w-[624px] tw-text-white">
            You selected {{ info.instrument }}! Now it’s time to tell us about
            your practice set-up. You can select multiple gear types and change
            your settings in your profile at anytime.
        </p>
        <MultiSelect
            :options="options"
            classOverride="tw-pb-[20px]"
            @onChangeSelection="handleMultiSelection"
        />
        <ProgressBar
            :brand="brand"
            :currentStep="2"
            :steps="steps"
            @onChangeStep="(s) => emit('onChangeStep', s)"
        />
        <Button
            @onButtonClick="
                () => {
                    emit('onChangeStep', 1)
                }
            "
            :isDisabled="!steps[2].checked"
            :brand="brand"
            classOverride="tw-w-[543px] tw-mt-[40px]"
            >Next</Button
        >
        <SkipStep @onSkip="skipStep" />
    </StepWrapper>
</template>
