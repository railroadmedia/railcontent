<script setup>
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
import Button from '../../Button/Button.vue'
import StepWrapper from '../StepWrapper.vue'
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

        <ProgressBar
            :brand="brand"
            :currentStep="2"
            :steps="steps"
            @changeStep="(s) => emit('changeStep', s)"
        />
        <Button
            @buttonClick="
                () => {
                    emit('changeStep', 1)
                }
            "
            :isDisabled="!steps[0].checked"
            :brand="brand"
            classOverride="tw-w-[543px] tw-mt-[40px]"
            >Next</Button
        >
        <button>SKIP</button>
    </StepWrapper>
</template>
