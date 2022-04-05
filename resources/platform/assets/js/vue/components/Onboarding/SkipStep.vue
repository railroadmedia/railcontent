<script setup>
const props = defineProps({
    title: {
        type: String,
        default: 'SKIP ACCOUNT SET UP'
    }
})
const emit = defineEmits(['onSkip'])
</script>

<template>
    <button
        class="tw-mt-[12px] tw-text-[18px] tw-text-white tw-underline"
        style="font-family: Bebas Neue"
        v-on:click="() => emit('onSkip')"
    >
        {{ title }}
    </button>
</template>
