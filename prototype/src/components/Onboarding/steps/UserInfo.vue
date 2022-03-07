<script setup>
import AvatarUpload from '../../AvatarUpload/AvatarUpload.vue'
import InputLabel from '../../InputLabel/InputLabel.vue'
import ProgressBar from '../../ProgressBar/ProgressBar.vue'
import Button from '../../Button/Button.vue'
import { defineEmits, defineProps, ref } from 'vue'
const props = defineProps({
    brand: {
        type: String
    },
    changeStep: {
        type: Function
    },
    checkStep: {
        type: Function
    },
    steps: {
        type: Array
    }
})
const emit = defineEmits(['onChangeStep', 'onCheckStep'])
let inputValue = ref('')
let isNextStepEnabled = ref(false)

function onInputChange(e) {
    if (e.target) {
        inputValue.value = e.target.value

        if (e.target.value.length !== 0) {
            isNextStepEnabled.value = true
        } else if (isNextStepEnabled) {
            isNextStepEnabled.value = false
        }
    }
}

function changeIsNextStepEnabled(val) {
    isNextStepEnabled.value = val
}
</script>

<template>
    <div
        class="tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-bg-[#000C17]"
    >
        <h2
            class="tw-mb-[5px] tw-w-full tw-text-center tw-font-bold tw-text-white"
        >
            Just a few quick questions to set up your account
        </h2>
        <p class="tw-font-[16px] tw-mb-[40px] tw-max-w-[624px] tw-text-white">
            Your musical journey is personalized to you. Tell us a little bit
            about yourself so that we can get it right.
        </p>
        <AvatarUpload />
        <InputLabel
            labelValue="Display Name"
            placeholder="Enter your display name..."
            classOverride="tw-mb-[56px]  lg:tw-w-[471px]"
            @input="onInputChange"
        />
        <ProgressBar
            :brand="brand"
            :currentStep="0"
            :steps="steps"
            @changeStep="(s) => emit('changeStep', s)"
        />
        <Button
            @buttonClick="
                () => {
                    emit('checkStep', 0, true)
                    emit('changeStep', 1)
                }
            "
            :isDisabled="!isNextStepEnabled"
            classOverride="tw-w-[543px] tw-mt-[40px]"
            >Next</Button
        >
    </div>
</template>
