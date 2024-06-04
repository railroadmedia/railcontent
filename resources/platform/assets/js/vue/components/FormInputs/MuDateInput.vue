<template>
  <div class="tw-flex tw-w-full tw-flex-col tw-relative">
    <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
    <input
      type="date"
      :id="id"
      :value="modelValue"
      @input="onInput($event.target.value)" 
      class="tw-w-full tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[50px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
      :placeholder="placeholder"
    />
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

// Define props
const props = defineProps({
  modelValue: String,
  label: String,
  labelOverride: String,
  inputOverride: String,
  id: String,
  placeholder: String,
});

// Define emit function for v-model update
const emit = defineEmits(['update:modelValue']);

// Emit update:modelValue when the input changes
const onInput = (newValue) => {
  emit('update:modelValue', newValue);
};
</script>

<style scoped>
body.tw-dark input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
}
input[type="date"]::-webkit-calendar-picker-indicator {
    font-size: 20px;
    cursor: pointer;
}
</style>
