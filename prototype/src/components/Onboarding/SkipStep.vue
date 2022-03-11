<script setup>
const props = defineEmits(['onSkip'])
</script>

<template>
    <button
        class="tw-mt-[12px] tw-text-[18px] tw-text-white tw-underline"
        style="font-family: Bebas Neue"
        v-on:click="() => emit('onSkip')"
    >
        SKIP ACCOUNT SET UP
    </button>
</template>
