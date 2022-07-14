<script setup>
const props = defineProps({
    title: {
        type: String,
        default: 'SKIP ACCOUNT SETUP'
    },
    brand: {
        type: String,
        default: 'drumeo'
    }
})
const handleSkip = () => {
    window.location.href = '/' + props.brand
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
