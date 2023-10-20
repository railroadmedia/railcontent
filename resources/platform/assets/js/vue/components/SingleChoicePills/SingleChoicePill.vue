<script setup>
import { CheckIcon } from '@heroicons/vue/outline';
const props = defineProps({
    selectedOption: {
        type: String,
        default: null,
    },
    label: {
        type: String,
        default: null,
    },
    value: {
        type: String,
        default: null,
    },
});
const emit = defineEmits(['onSelect']);
const buttonClass = () => {
    if (props.selectedOption === props.value) {
        return 'tw-border-[#0B76DB] tw-bg-[#0B76DB] tw-text-white';
    } else if (props.selectedOption && props.selectedOption.length) {
        return 'tw-border-[#627F97] tw-bg-[#002039] tw-text-[#627F97]';
    } else {
        return 'tw-border-[#627F97] tw-bg-[#002039] tw-text-white';
    }
};
</script>

<template>
    <button
        @click="emit('onSelect')"
        class="tw-w-full tw-rounded-[8px] tw-flex tw-justify-between tw-px-[20px] tw-py-[12px] tw-text-left tw-font-bold tw-font-bebas-neue tw-border tw-text-[16px] tw-mb-[12px]"
        :class="buttonClass()"
        >
        <div class="tw-grow">{{ label }}</div>
        <div class="tw-flex tw-justify-center tw-items-center tw-bg-black tw-w-[26px] tw-h-[26px] tw-rounded-full" v-if="selectedOption === value">
            <CheckIcon
                class="tw-w-[20px] tw-h-[20px] tw-text-white"
            />
        </div>
    </button>
</template>
