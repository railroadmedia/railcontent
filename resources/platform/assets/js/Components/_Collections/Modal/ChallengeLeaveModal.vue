<template>
    <InfoModal :selfContained="true" class-override="tw-max-w-[593px] tw-w-full dark:tw-text-white" title="Are you sure you want o leave 30-Day Drummer?" @onClose="emit('modalClose')">
        <p class="tw-mb-5">Leaving 30-Day drummer will delete your progress.</p>
        <div class="tw-flex tw-justify-end">
            <MuButton @click="leaveChallenge">Leave Challenge</MuButton>
        </div>
    </InfoModal>
</template>
<script setup>
import axios from 'axios';
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    challengeId: {
        type: Number,
        default: 0,
    },
})

const emit = defineEmits(['modalClose']);

const leaveChallenge = async () => {
    try {
        const leave = await axios.post(`/challenges/leave/${props.challengeId}`);
        emit('modalClose');
    }
    catch(e) {
            window.shownotification({
                icon: 'error',
                text: 'Woops! Something wrong happened, please try again later.'
            })
    }
}
</script>
