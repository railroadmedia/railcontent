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

const handleChange = (e) => {
    e.preventDefault();
    emit('onChange', e.target.value);
};
</script>
<template>
    <select :id="dropdownId" @change="handleChange"
        class="tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-border-[#445F74] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none dark:tw-text-white tw-w-full tw-bg-[#eeeeef] dark:tw-bg-[#002039]/90 tw-px-[14px] tw-box-border" @keydown.prevent>
        <option selected disabled :value="null">
            {{ placeholderLabel }}
        </option>
        <option v-for="option in sortedOptions" :key="option.value" :value="selectedValue">
            {{ option.value }}
        </option>
    </select>
</template>