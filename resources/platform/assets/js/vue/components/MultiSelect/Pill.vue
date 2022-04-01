<script setup>
const props = defineProps({
    value: {
        type: String
    },
    text: {
        type: String
    },
    active: {
        type: Boolean,
        default: false
    }
})
const emit = defineEmits(['onSelect'])
</script>

<template>
    <button
        :class="`tw-text-[14px] md:tw-text-[16px] tw-w-[42%] md:tw-w-auto tw-mx-[7px] tw-my-[7px] tw-rounded-[25px] tw-border tw-border-[#7E9AB1] tw-px-[25px] tw-py-[13px] tw-font-bold tw-text-white ${
            active ? 'tw-bg-[#7E9AB1]' : ''
        }`"
        v-on:click="emit('onSelect', value)"
    >
        {{ text }}
    </button>
</template>
