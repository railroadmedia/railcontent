<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
      <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
      <input
        type="date"
        :id="id"
        v-model="selectedDate"
        class="tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[50px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
        :placeholder="placeholder"
        @input="emitInput"
      />
    </div>
</template>
  
<script setup>
  import { ref, defineProps, defineEmits } from 'vue';
  
  // Define props
  const props = defineProps({
    label: String,
    labelOverride: String,
    inputOverride: String,
    id: String,
    initialValue: String,
    placeholder: String,
  });
  
  // Reactive state for the selected date
  const selectedDate = ref(props.initialValue);
  
  // Define emit function for v-model update
  const emit = defineEmits(['update:modelValue']);
  const emitInput = () => {
    emit('update:modelValue', selectedDate.value);
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
