<template>
    <span class="tw-flex tw-text-[#00101D] dark:tw-text-white tw-text-[18px] md:tw-text-[24px] lg:tw-text-[28px] tw-font-bold"
        :class="{ 'sm:tw-hidden lg:tw-flex': !alwaysShow }">
        <span :class="{ 'tw-hidden lg:tw-block': !alwaysShow }">
            <slot name="progress-text">Your Progress -&nbsp;</slot>
        </span>
        {{ progress }}%
    </span>
</template>

<script setup>
import { defineProps } from 'vue'
const props = defineProps({
    progress: {
        type: [String, Number],
        required: true
    },
    alwaysShow: {
        type: Boolean,
        default: false
    }
})
</script>
