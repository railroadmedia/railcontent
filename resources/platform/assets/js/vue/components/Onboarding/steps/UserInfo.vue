<script setup>
import AvatarUpload from '../../AvatarUpload/AvatarUpload.vue'
import InputLabel from '../../InputLabel/InputLabel.vue'
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

function onInputChange(value) {
    emit('onChangeInfo', {
        ...props.info,
        user: { ...props.info.user, name: value }
    })
}
</script>

<template>
    <StepWrapper :brand="brand" :showBgImg="false">
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
            :initialValue="info.user.name"
            labelValue="Display Name"
            placeholder="Enter your display name..."
            classOverride="tw-mb-[56px]  lg:tw-w-[471px]"
            @onChange="onInputChange"
        />
        <ProgressBar
            :brand="brand"
            :currentStep="0"
            :steps="steps"
            @onChangeStep="(s) => emit('onChangeStep', s)"
        />
        <Button
            :brand="brand"
            @onButtonClick="
                () => {
                    emit('onChangeStep', 1)
                }
            "
            :isDisabled="!steps[0].checked"
            classOverride="tw-w-[543px] tw-mt-[40px]"
            >Next</Button
        >
    </StepWrapper>
</template>
