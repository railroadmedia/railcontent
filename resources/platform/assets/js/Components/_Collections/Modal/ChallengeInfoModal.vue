<template>
    <InfoModal
        v-if="info[type]"
        :selfContained="true"
        class-override="tw-max-w-[600px] tw-w-full"
        :container-stay-on-close="containerStayOnClose"
        @onClose="() => emit('closeModal')"
    >
        <div v-if="type === 'streak'" class="-tw-mt-[52px]">
            <h3 class="tw-w-full tw-text-black dark:tw-text-white tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-5 tw-mb-5">🔥 Introducing Streaks!</h3>
            <p class="dark:tw-text-white tw-mb-5">Streaks make it easy to track how many days in a row you've completed a lesson for a specific Challenge. Bonus days won't affect your streak. Higher streaks will unlock special achievements!</p>
        </div>
        <div v-else class="-tw-mt-[55px]">
            <h3 class="tw-flex tw-w-full tw-text-black dark:tw-text-white tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-5">
                <template v-if="isSaverActive">
                    <musora-icon icon-name="streak-saver-active-dark" class="tw-mr-2 tw-hidden dark:tw-block"></musora-icon>
                    <musora-icon icon-name="streak-saver-active-light" class="tw-mr-2 dark:tw-hidden"></musora-icon>
                </template>
                <template v-else>
                    <musora-icon icon-name="streak-saver-dark" class="tw-mr-2 tw-hidden dark:tw-block"></musora-icon>
                    <musora-icon icon-name="streak-saver-light" class="tw-mr-2 dark:tw-hidden"></musora-icon>
                </template>
                Introducing Streak Savers!
            </h3>
            <p class="dark:tw-text-white tw-mb-5">Streak Savers allow you to miss a few days of a Challenge without restarting your streak. You have a limited number of Streak Savers, and can gain more as you progress through a Challenge. A Streak Saver is used automatically when you miss a day.</p>
        </div>
        <div class="tw-flex tw-justify-end">
            <MuButton @click="emit('closeModal')">Okay!</MuButton>
        </div>
    </InfoModal>
</template>
<script setup>
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";

const props = defineProps({
    type: {
        type: String,
        default: 'streak',
    },
    isSaverActive: {
        type: Boolean,
        default: false,
    },
    containerStayOnClose: {
        type: Boolean,
        default: false,
    },
})

const emit = defineEmits(['closeModal']);

const info = {
    streak: {
        title: '🔥 Introducing Streaks!',
        description: `Streaks make it easy to track how many days in a row you've completed a lesson for a specific Challenge. Bonus days won't affect your streak. Higher streaks will unlock special achievements!`
    },
    rest: {
        title: '',
        description: '<musora-icon icon-name="streak-saver-active-dark"></musora-icon> '
    }
}
</script>
