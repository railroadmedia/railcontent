<template>
    <a v-if="url && text" :href="url"
        :class="`tw-btn-primary tw-bg-[#000C17] tw-text-white dark:tw-bg-white dark:tw-text-[#000C17] tw-text-center tw-m-0 md:tw-px-10 lg:tw-px-[30px] tw-line-clamp-1 md:tw-inline-block tw-px-6`">
        <i v-if="icon" :class="`mr-1 fas ${icon}`"></i>
        {{ text }}
    </a>
</template>
<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    icon: String,
    text: String,
    url: String,
})
</script>