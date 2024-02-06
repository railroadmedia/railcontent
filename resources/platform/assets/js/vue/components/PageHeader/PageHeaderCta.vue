<template>
    <a v-if="href" :href="href" class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0"
        :class="[text ? 'tw-px-6' : 'tw-w-[40px] tw-h-[40px] tw-p-0']">
        <i v-if="icon" :class="[icon, text ? 'mr-1' : '']"></i>
        {{ text }}
    </a>
    <button v-else-if="event" @click="handleClick"
        class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white ml-1 tw-mb-0"
        :class="[text ? 'tw-px-6' : 'tw-w-[40px] tw-h-[40px] tw-p-0']">
        <i v-if="icon" :class="[icon, text ? 'mr-1' : '']"></i>
        {{ text }}
    </button>
</template>
  
<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    text: String,
    icon: String,
    href: String,
    event: String
});

const emit = defineEmits();

const handleClick = () => {
    if (props.event) {
        emit(props.event);
    }
};
</script>
