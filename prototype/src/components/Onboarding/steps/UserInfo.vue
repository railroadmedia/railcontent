<script setup>
import { defineEmits, defineProps } from 'vue'
const props = defineProps({
    brand: {
        type: String
    },
    changeStep: {
        type: Function
    }
})
const emit = defineEmits(['onChangeStep'])
</script>

<template>
    <div
        class="tw-h-full tw-w-full tw-items-center tw-justify-center tw-bg-[#000C17]"
    >
        <button class="tw-text-white" @click="emit('changeStep', 1)">
            CHANGE STEP
        </button>
    </div>
</template>
