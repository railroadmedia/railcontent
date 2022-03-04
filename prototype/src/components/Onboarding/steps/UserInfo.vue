<script setup>
import AvatarUpload from '../../AvatarUpload/AvatarUpload.vue'
import InputLabel from '../../InputLabel/InputLabel.vue'
import { defineEmits, defineProps } from 'vue'
const props = defineProps({
    brand: {
        type: String
    },
    changeStep: {
        type: Function
    },
    checkStep: {
        type: Function
    }
})
const emit = defineEmits(['onChangeStep', 'onCheckStep'])
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
        <br />
        <InputLabel />
        <button
            class="tw-text-white"
            @click="
                () => {
                    emit('checkStep', 0)
                    emit('changeStep', 1)
                }
            "
        >
            CHANGE STEP
        </button>
    </div>
</template>
