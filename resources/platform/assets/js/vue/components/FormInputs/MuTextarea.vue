<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
        <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
        <textarea
            class="tw-no-scrollbar tw-resize-none tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-rounded-xl tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
            :class="inputOverride"
            :id="id"
            :placeholder="placeholder"
            :value="modelValue" 
            @input="onInput($event.target.value)" 
            :cols="cols"
            :rows="rows"
        ></textarea>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props
const props = defineProps({
    modelValue: String, // Change this from initialValue to modelValue
    label: String,
    labelOverride: String,
    inputOverride: String,
    id: String,
    placeholder: String,
    cols: Number,
    rows: Number
});

// Define emits
const emit = defineEmits(['update:modelValue']);

// Event handler to emit changes
const onInput = (newValue) => {
    emit('update:modelValue', newValue); // Emit the updated value to parent
};
</script>
