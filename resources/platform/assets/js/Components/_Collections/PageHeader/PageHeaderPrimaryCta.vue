<template>
    <a v-if="url && text" :href="url"
        :class="`tw-btn-primary tw-bg-[#000C17] tw-text-white dark:tw-bg-white dark:tw-text-[#000C17] tw-text-center tw-m-0 md:tw-px-10 lg:tw-px-[30px] tw-px-6 hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-h-[35px] md:tw-h-[40px]`">
        <i v-if="faIconClass" :class="`mr-1 fas ${faIconClass}`"></i>
        {{ text }}
    </a>
</template>
<script setup>

const props = defineProps({
    faIconClass: String,
    text: String,
    url: String,
})
</script>
