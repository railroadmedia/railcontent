<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
        <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
        <select 
            class="tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-h-[42px] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
            :class="[`${inputOverride ? inputOverride : ''}`]"
            :id="id" 
            v-model="selectedOption" 
            @change="emitChange"
        >
            <option class="tw-bg-white tw-text-[#00101D]" disabled value="">{{ placeholder }}</option>
            <option class="tw-bg-white tw-text-[#00101D]" 
                v-for="option in options" 
                :key="option" 
                :value="option"
            >
                {{ option }}
            </option>
        </select>
    </div>
</template>
  
  <script setup>
    import { ref, watch } from 'vue';
    
    // Props
    const props = defineProps({
        options: Array,
        label: String,
        labelOverride: String,
        inputOverride: String,
        id: String,
        initialValue: String,
        placeholder: String,
    });
    
    // Model for the selected option
    const selectedOption = ref(props.initialValue);
    
    // Emit change event
    const emit = defineEmits(['update:modelValue']);
    const emitChange = () => {
        emit('update:modelValue', selectedOption.value);
    };
    
    // Watch for external changes in initialValue
    watch(() => props.initialValue, (newVal) => {
        selectedOption.value = newVal;
    });
  </script>
  