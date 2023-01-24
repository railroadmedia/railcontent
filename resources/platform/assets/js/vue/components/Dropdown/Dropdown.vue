<script setup>
const props = defineProps({
    selectedValue: {
        type: String,
        default: null,
    },
    dropdownId: {
        type: String,
        default: 'default-dropdown-id'
    },
    isDisabled: {
        type: Boolean,
        default: false,
    },
    sortedOptions: {
        type: Array,
        default: [],
    },
    placeholderLabel: {
        type: String,
        default: '',
    }
});
const emit = defineEmits(['onChange']);

const handleChange = (val) => {
    emit('onChange', val);
};
</script>
<template>
    <select :id="dropdownId" @change="handleChange"
        class="tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none tw-text-white tw-w-full tw-bg-[#002039]/90 tw-px-[14px] tw-box-border tw-border-[#445F74]" :disabled="valueInterface" @keydown.prevent>
        <option selected disabled :value="null">
            {{ placeholderLabel }}
        </option>
        <option v-for="filter in sortedOptions" :key="filter.key" :value="selectedValue">
            {{ filter.key }}
        </option>
    </select>
</template>