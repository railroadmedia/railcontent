<script setup>
const props = defineProps({
    value: {
        type: String,
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: ''
    },
    id: {
        type: String,
        default: 'text-input'
    }
})
</script>

<template>
    <div class="tw-flex tw-flex-col">
        <label :for="id">{{ label }}</label>
        <input :placeholder="placeholder" :value="value" :id="id" />
    </div>
</template>
