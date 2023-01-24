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
        class="tw-pb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] no-label tw-bg-white dark:tw-bg-transparent dark:tw-border-[1px] dark:tw-border-[#445F74] tw-px-[12px] lg:tw-px-[18px] xl:tw-px-[25px] tw-text-[14px] lg:tw-text-[16px]" :disabled="valueInterface" @keydown.prevent>
        <option class="tw-text-[#00101D]" selected disabled :value="null">
            {{ placeholderLabel }}
        </option>
        <option class="tw-text-[#00101D]" v-for="filter in sortedOptions" :key="filter.key" :value="selectedValue">
            {{ filter.key }}
        </option>
    </select>
</template>