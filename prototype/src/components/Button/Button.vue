<script setup>
const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    id: {
        type: String,
        default: 'text-input'
    },
    classOverride: {
        type: String,
        default: ''
    }
})
const emit = defineEmits(['onChange'])
</script>

<template>
    <div class="tw-flex tw-flex-col">
        <label :for="id">{{ label }}</label>
        <input
            :placeholder="placeholder"
            :id="id"
            :class="`tw-h-[42px] tw-rounded-[63px] tw-border-[#D1D5DB] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none lg:tw-w-[471px] ${
                classOverride ? classOverride : ''
            }`"
            v-model="text"
        />
    </div>
</template>
