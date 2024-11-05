<template>
    <div class="tw-w-full tw-my-[30px]">
        <p class="tw-h-[27px] tw-font-bold tw-text-[18px] tw-leading-[27px] tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]">{{ welcomeMessage }}</p>
        <p class="tw-h-[36px] tw-font-bold tw-text-[24px] tw-leading-[36px] tw-text-[#00101D] dark:tw-text-white">{{ practiceMessage }}</p>
    </div>
</template>

<script setup>
const props = defineProps({
    welcomeMessage: {
        type: String,
        required: true
    },
    practiceMessage: {
        type: String,
        required: true
    }
});
</script>