<script setup>
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
        class="tw-h-full tw-w-full tw-items-center tw-justify-center tw-bg-[#000C17]"
    >
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
