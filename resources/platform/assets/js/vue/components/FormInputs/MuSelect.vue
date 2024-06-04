<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
        <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
        <select 
            class="tw-full tw-h-[50px] tw-text-[#00101D] tw-border-[#D1D5DB] dark:tw-bg-[#00101D] dark:tw-border-[#445F74] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-border-none focus:tw-outline-none"
            :class="inputOverride"
            :id="id" 
            :value="modelValue"
            @change="onChange($event)"
        >
            <option disabled value="">{{ placeholder }}</option>
            <option v-for="option in options" :key="option" :value="option">
                {{ option }}
            </option>
        </select>
    </div>
</template>
  
<script setup>
    import { defineProps, defineEmits } from 'vue';

    const props = defineProps({
        options: Array,
        label: String,
        labelOverride: String,
        inputOverride: String,
        id: String,
        modelValue: [String, Number],
        placeholder: String,
    });

    const emit = defineEmits(['update:modelValue']);

    const onChange = (event) => {
        emit('update:modelValue', event.target.value);
    };
</script>
