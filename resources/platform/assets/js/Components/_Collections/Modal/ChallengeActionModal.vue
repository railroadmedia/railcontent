<template>
    <InfoModal
        :selfContained="true"
        class-override="tw-max-w-[593px] tw-w-full"
        @onClose="() => $emit('closeModal')"
    >
        <div class="tw-flex tw-flex-col tw-justify-center -tw-mt-[50px] dark:tw-text-white">
            <img class="tw-h-20 tw-mb-5" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" alt="Challenge logo" />
            <h1 class="tw-text-2xl tw-font-bold tw-mb-[10px]">{{ headerText }}</h1>
            <p class="tw-mb-5">{{ descriptionText }}</p>
            <div class="tw-flex tw-justify-end">
                <MuButton>{{ buttonText }}</MuButton>
            </div>
        </div>
    </InfoModal>
</template>
<script setup>
import { computed } from "vue";
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
})

const isUnlockModal = computed(() => {
    return props.modalType === 'unlock'
})

const isRetakeModal = computed(() => {
    return props.modalType === 'retake'
})

const headerText = computed(() => {
    if(isUnlockModal.value){
        return `Are you sure you want to unlock ${props.title}?`
    } else if(isRetakeModal.value){
        return `Do you want to retake ${props.title}?`
    }
})

const descriptionText = computed(() => {
    if(isUnlockModal.value){
        return `Unlocking the ${props.title} will reset your current streak and rest days information. This action is irreversible.`
    } else if(isRetakeModal.value){
        return `You completed ${props.title} on August 23, 2024. You can retake the challenge to improve your streak and earn a new certificate. Your previously earned badges will remain unaffected.`
    }
})

const buttonText = computed(() => {
    if(isUnlockModal.value){
        return 'Unlock 30-Day Drummer'
    } else if(isRetakeModal.value){
        return 'Retake Challenge'
    }
})
</script>
