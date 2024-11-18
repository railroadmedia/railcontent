<template>
    <div class="tw-shrink-0 tw-w-[150px] lg:tw-w-auto tw-flex tw-flex-col tw-items-center dark:tw-text-white tw-cursor-pointer" @click="openModal">
        <img class="tw-w-full" :src="`https://www.musora.com/musora-cdn/image/width=500,quality=95/${award.badge}`" :alt="`${award.challenge_title} Award`" />
        <p class="tw-font-bold">{{ award.challenge_title }}</p>
        <p>{{ completedDate }}</p>
    </div>

    <ChallengeAwardModal v-if="isModalOpen" @close-modal="closeModal" :award-data="award" :open-from-awards="true" />
</template>
<script setup>
import { computed, ref } from "vue";
import ChallengeAwardModal from '@collections/Modal/ChallengeAwardModal';

const props = defineProps({
    award: {
        type: Object,
        default: () => {},
    },
})

const isModalOpen = ref(false);

const completedDate = computed(() => {
    const date = new Date(props.award.date_completed)
    return `${months[date.getMonth()]} ${date.getFullYear()}`
})

const closeModal = () => {
    isModalOpen.value = false;
}

const openModal = () => {
    isModalOpen.value = true;
}

const months = [
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
]
</script>
