<template>
    <div class="tw-flex tw-w-full tw-flex-col tw-relative">
        <label :for="id" :class="`tw-text-sm tw-px-[13px] tw-pb-[5px] ${labelOverride ? labelOverride : 'dark:tw-text-[#9EC0DC]'}`">{{ label }}</label>
        <select 
            class="tw-full tw-h-[50px] tw-text-[#00101D] dark:tw-bg-[#00101D] dark:tw-text-white dark:placeholder:tw-text-[#9EC0DC] tw-rounded-[63px] tw-py-[9px] tw-px-[13px] tw-text-[14px] focus:tw-ring-0 focus:tw-outline-none"
            :class="[inputOverride, borderStyles, {'tw-bg-[#D3D3D3] dark:tw-bg-transparent dark:tw-opacity-20' : disabled}]"
            :id="id" 
            :value="modelValue"
            :disabled="disabled"
            @change="onChange($event)"
        >
            <option class="tw-bg-white tw-text-[#00101D]" disabled value="">{{ placeholder }}</option>
            <option class="tw-bg-white tw-text-[#00101D]" v-for="option in options" :key="option" :value="option">
                {{ option }}
            </option>
        </select>
    </div>
</template>
  
<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        disabled: Boolean,
        options: Array,
        error: Boolean, 
        success: Boolean,
        label: String,
        labelOverride: String,
        inputOverride: String,
        id: String,
        modelValue: [String, Number],
        placeholder: String,
    });

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

    const onChange = (event) => {
        emit('update:modelValue', event.target.value);
    };
</script>
