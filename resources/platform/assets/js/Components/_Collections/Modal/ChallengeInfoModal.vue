<template>
    <InfoModal
        v-if="info[type]"
        :selfContained="true"
        :title="info[type].title"
        class-override="tw-max-w-[600px] tw-w-full"
        :container-stay-on-close="containerStayOnClose"
        @onClose="() => $emit('closeModal')"
    >
        <p class="tw-text-white tw-mb-5">{{ info[type].description }}</p>
        <div class="tw-flex tw-justify-end">
            <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white" @click="$emit('closeModal')">Okay!</MuButton>
        </div>
    </InfoModal>
</template>
<script setup>
import InfoModal from '@collections/Modal/InfoModal.vue';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    type: {
        type: String,
        default: 'streak',
    },
    containerStayOnClose: {
        type: Boolean,
        default: false,
    },
})

const info = {
    streak: {
        title: '🔥 Introducing Streaks!',
        description: 'Streaks make it easy to track how many days in a row you’ve completed a lesson for a specific Challenge. Higher streaks will unlock special achievements!'
    },
    rest: {
        title: '<img class="tw-mr-2 tw-w-6 tw-hidden dark:tw-inline-block" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" /> <img class="tw-mr-2 tw-w-6 tw-inline-block dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon_light.svg" /> Introducing Rest Days!',
        description: 'Rest Days allow you to miss a few days of a Challenge without restarting your streak. You have a limited number of Rest Day tokens, and can gain more tokens as you progress through a Challenge.'
    }
}
</script>
