<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
        <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
        <textarea
            class="tw-no-scrollbar tw-resize-none tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-rounded-xl tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
            :class="[`${inputOverride ? inputOverride : ''}`]"
            :id="id"
            :placeholder="placeholder"
            v-model="textValue"
            @input="emitInput"
            :cols="cols"
            :rows="rows"
        ></textarea>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';

// Props
const props = defineProps({
    label: String,
    labelOverride: String,
    inputOverride: String,
    id: String,
    initialValue: String,
    placeholder: String,
    cols: Number,
    rows: Number
});

// Model for the textarea value
const textValue = ref(props.initialValue);

// Emit input event
const emit = defineEmits(['update:modelValue']);
const emitInput = () => {
    emit('update:modelValue', textValue.value);
};

// Watch for external changes in initialValue
watch(() => props.initialValue, (newVal) => {
    textValue.value = newVal;
});
</script>
