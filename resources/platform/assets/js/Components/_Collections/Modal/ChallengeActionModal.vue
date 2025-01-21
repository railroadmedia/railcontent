<template>
    <InfoModal
        :selfContained="true"
        :title="modalTitle"
        class-override="tw-max-w-[593px] tw-w-full"
        @onClose="() => emit('closeModal')"
    >
        <div class="tw-flex tw-flex-col tw-justify-center dark:tw-text-white">
            <div class="tw-px-8">
                <img v-if="showLogo" class="tw-max-h-[80px] tw-mb-5 -tw-mt-[50px] tw-mx-auto" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${logo}`" alt="Challenge logo" />
            </div>
            <h1 class="tw-text-2xl tw-font-bold tw-mb-[10px]">{{ headerText }}</h1>
            <p class="tw-mb-5">{{ descriptionText }}</p>
            <div class="tw-flex tw-justify-end">
                <MuButton @click="buttonAction">{{ buttonText }}</MuButton>
            </div>
        </div>
    </InfoModal>
</template>
<script setup>
import { computed, ref } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { usePlatformStore } from "@stores/platform";
import { postChallengesLeave, postChallengesUnlock, postChallengesEnroll } from 'musora-content-services';
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    modalType: {
        type: String,
        default: 'unlock',
    },
    challenge: {
        type: Object,
        default: () => {},
    },
})

const emit = defineEmits(['closeModal', 'onLeaveChallenge', 'postRetake']);

const platformStore = usePlatformStore();
const { isDarkMode } = storeToRefs(platformStore);

const isUnlockModal = computed(() => {
    return props.modalType === 'unlock';
})

const isRetakeModal = computed(() => {
    return props.modalType === 'retake';
})

const isLeaveModal = computed(() => {
    return props.modalType === 'leave';
})

const logo = computed(() => {
    if(isDarkMode.value){
         return props.challenge?.dark_mode_logo_url
    } else {
        return props.challenge?.light_mode_logo_url
    }
})

const showLogo = computed(() => {
    return isUnlockModal.value || isRetakeModal.value;
})

const modalTitle = computed(() => {
    if(isLeaveModal.value){
        return `Are you sure you want to leave ${props.challenge?.title}?`;
    }
})

const headerText = computed(() => {
    if(isUnlockModal.value){
        return `Are you sure you want to unlock ${props.challenge?.title}?`;
    } else if(isRetakeModal.value){
        return `Do you want to retake ${props.challenge?.title}?`;
    }
})

const lastCompletionDate = computed(() => {
    return new Date(props.challenge?.last_completion_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
})

const descriptionText = computed(() => {
    if(isUnlockModal.value){
        return `Unlocking the ${props.challenge?.title} will reset your current streak and streak saver information. This action is irreversible.`;
    } else if(isRetakeModal.value){
        return `You completed ${props.challenge?.title} on ${lastCompletionDate.value}. You can retake the challenge to improve your streak and earn a new certificate. Your previously earned badges will remain unaffected.`;
    } else if(isLeaveModal.value){
        return `Leaving ${props.challenge?.title} will delete your progress`;
    }
})

const buttonText = computed(() => {
    if(isUnlockModal.value){
        return `Unlock ${props.challenge?.title}`;
    } else if(isRetakeModal.value){
        return `Retake ${props.challenge?.title}`;
    } else if(isLeaveModal.value){
        return `Leave ${props.challenge?.title}`;
    }
})

const buttonAction = async () => {
    try {
        if(isUnlockModal.value){
            const unlock = await postChallengesUnlock(props.challenge?.id);
            window.location.href = props.challenge.web_url_path;
        } else if(isRetakeModal.value){
            const retake = await postChallengesEnroll(props.challenge?.id);
            emit('postRetake');
        } else if(isLeaveModal.value){
            const leave = await postChallengesLeave(props.challenge?.id);
            emit('onLeaveChallenge', props.challenge?.id);
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
