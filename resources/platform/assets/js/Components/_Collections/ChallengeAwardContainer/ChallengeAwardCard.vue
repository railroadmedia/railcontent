<template>
    <div class="tw-shrink-0 tw-w-[150px] lg:tw-w-auto tw-flex tw-flex-col tw-items-center dark:tw-text-white">
        <img class="tw-w-full" :src="`https://www.musora.com/musora-cdn/image/width=500,quality=95/${award.badge}`" :alt="`${award.challenge_title} Award`" />
        <p class="tw-font-bold">{{ award.challenge_title }}</p>
        <p>{{ completedDate }}</p>
    </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
    award: {
        type: Object,
        default: () => {},
    },
})

const completedDate = computed(() => {
    const date = new Date(props.award.date_completed)
    return `${months[date.getMonth()]} ${date.getFullYear()}`
})

const months = [
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
]
</script>
