<script setup>
const props = defineProps({
    title: {
        type: String,
        default: 'SKIP ACCOUNT SETUP'
    }
})
const handleSkip = () => {
    window.location.href = '/members'
};
</script>

<template>
    <button
        class="tw-mt-[12px] tw-text-[18px] tw-text-white tw-underline tw-font-bebas-neue"
        v-on:click="handleSkip"
    >
        {{ title }}
    </button>
</template>
