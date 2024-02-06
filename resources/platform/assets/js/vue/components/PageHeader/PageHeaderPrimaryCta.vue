<template>
    <a v-if="url && text" :href="url"
        :class="`tw-btn-primary tw-text-center tw-m-0 md:tw-px-10 lg:tw-px-[30px] tw-line-clamp-1 md:tw-inline-block tw-bg-white tw-text-[#000C17] hover:tw-bg-[#627F97] hover:tw-text-white tw-border-[#B2B2B5] dark:tw-border-white tw-px-6`">
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