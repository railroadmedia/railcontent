<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
        <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
        <textarea
            class="tw-no-scrollbar tw-resize-none tw-text-[#00101D] dark:tw-bg-[#00101D] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-rounded-xl tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-ring-0 focus:tw-outline-none"
            :class="[inputOverride, borderStyles, {'tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20' : disabled}]"
            :id="id"
            :placeholder="placeholder"
            :value="modelValue" 
            @input="onInput($event.target.value)" 
            :cols="cols"
            :rows="rows"
            :disabled="disabled"
        ></textarea>
    </div>
</template>

<script setup>
import { computed } from 'vue';

// Define props
const props = defineProps({
    modelValue: String, // Change this from initialValue to modelValue
    disabled: Boolean,
    label: String,
    error: Boolean,
    success: Boolean,
    labelOverride: String,
    inputOverride: String,
    id: String,
    placeholder: String,
    cols: Number,
    rows: Number
});

// Define emits
const emit = defineEmits(['update:modelValue']);

const borderStyles = computed( () => {
    if(props.error) {
      return 'tw-bg-transparent tw-border-red-500 dark:tw-border-red-500'
    } else if(props.success) {
       return 'tw-border-green-500 dark:tw-border-green-500'
    } else {
      return 'tw-border-[#D1D5DB] dark:tw-border-[#445F74] dark:focus:tw-border-drumeo focus:tw-border-drumeo';
    }
})

// Event handler to emit changes
const onInput = (newValue) => {
    emit('update:modelValue', newValue); // Emit the updated value to parent
};
</script>
