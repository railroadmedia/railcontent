<template>
    <InfoModal
        :selfContained="true"
        :title="modalTitle"
        class-override="tw-max-w-[593px] tw-w-full"
        @onClose="() => emit('closeModal')"
    >
        <div class="tw-flex tw-flex-col tw-justify-center dark:tw-text-white">
            <img v-if="showLogo" class="tw-h-20 tw-mb-5 -tw-mt-[50px]" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" alt="Challenge logo" />
            <h1 class="tw-text-2xl tw-font-bold tw-mb-[10px]">{{ headerText }}</h1>
            <p class="tw-mb-5">{{ descriptionText }}</p>
            <div class="tw-flex tw-justify-end">
                <MuButton @click="buttonAction">{{ buttonText }}</MuButton>
            </div>
        </div>
    </InfoModal>
</template>
<script setup>
import { computed } from "vue";
import { postChallengesLeave, postChallengesUnlock } from 'musora-content-services';
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    modalType: {
        type: String,
        default: 'unlock',
    },
    title: {
        type: String,
        default: '30-Day Drummer',
    },
    contentId: {
        type: Number,
        default: 0,
    },
})

const emit = defineEmits(['closeModal']);

const isUnlockModal = computed(() => {
    return props.modalType === 'unlock';
})

const isRetakeModal = computed(() => {
    return props.modalType === 'retake';
})

const isLeaveModal = computed(() => {
    return props.modalType === 'leave';
})

const showLogo = computed(() => {
    return isUnlockModal.value || isRetakeModal.value;
})

const modalTitle = computed(() => {
    if(isLeaveModal.value){
        return `Are you sure you want to leave ${props.title}?`;
    }
})

const headerText = computed(() => {
    if(isUnlockModal.value){
        return `Are you sure you want to unlock ${props.title}?`;
    } else if(isRetakeModal.value){
        return `Do you want to retake ${props.title}?`;
    }
})

const descriptionText = computed(() => {
    if(isUnlockModal.value){
        return `Unlocking the ${props.title} will reset your current streak and rest days information. This action is irreversible.`;
    } else if(isRetakeModal.value){
        return `You completed ${props.title} on August 23, 2024. You can retake the challenge to improve your streak and earn a new certificate. Your previously earned badges will remain unaffected.`;
    } else if(isLeaveModal.value){
        return `Leaving the ${props.title} will delete your progress`;
    }
})

const buttonText = computed(() => {
    if(isUnlockModal.value){
        return 'Unlock 30-Day Drummer';
    } else if(isRetakeModal.value){
        return 'Retake Challenge';
    } else if(isLeaveModal.value){
        return 'Leave Challenge';
    }
})

const buttonAction = async () => {
    try {
        if(isUnlockModal.value){
            const unlock = await postChallengesUnlock(props.contentId);

        } else if(isRetakeModal.value){

        } else if(isLeaveModal.value){
            const leave = await postChallengesLeave(props.contentId);
        }

        emit('closeModal');
    } catch(e) {
        window.shownotification({
            icon: 'error',
            text: 'Woops! Something wrong happened, please try again later.'
        })
    }
}
</script>
