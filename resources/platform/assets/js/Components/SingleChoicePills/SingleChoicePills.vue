<script setup>
import SingleChoicePill from './SingleChoicePill.vue';
const { options, selectedOption } = defineProps(['options', 'selectedOption']);
const emit = defineEmits(['onSelect']);
</script>

<template>
    <div class="tw-flex tw-flex-col tw-w-full tw-max-w-[500px]">
        <SingleChoicePill
            v-for="option in options"
            :key="option"
            :label="option.text"
            :value="option.value"
            :selectedOption="selectedOption"
            @onSelect="emit('onSelect', option.value)"
        >
        </SingleChoicePill>
    </div>
</template>
