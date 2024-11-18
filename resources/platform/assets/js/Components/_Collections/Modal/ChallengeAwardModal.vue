<template>
    <component v-if="!isCertificateOpen" :is="isModal ? compMap.ModalRenderer : 'div'" :black-background="true" :show-x-icon="true" >
        <div class="tw-max-w-[470px] tw-w-full tw-rounded-[10px] tw-px-4 sm:tw-px-14 tw-py-10 tw-relative tw-border dark:tw-border-[rgba(255,255,255,0.09)] tw-mx-4 sm:tw-mx-0">
            <!-- Animation -->
            <Vue3Lottie v-if="!hideAnimation" class="tw-w-[calc(100% + 200px)] sm:tw-w-[800px] tw-h-[800px] tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-[5]" :animation-link="animations[brand]" width="100%" height="100%" :loop="false" />

            <!-- BG image -->
            <img class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-hidden dark:tw-block tw-z-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenges/award-dark-bg.png" />
            <img class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 dark:tw-hidden tw-z-0" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenges/award-light-bg.png" />

            <div class="tw-z-[2] tw-relative dark:tw-text-white">
                <div class="tw-px-10 sm:tw-px-[70px] tw-mb-4 tw-z-[1] tw-relative">
                    <img :src="`https://www.musora.com/musora-cdn/image/width=300,quality=95/${challengeBadge}`" alt="Challenge Badge" />
                </div>
                <p class="tw-mb-6 tw-text-center tw-text-sm">
                    You practiced for a total of <span class="tw-font-bold">{{ minutesPracticed }} minutes</span> and achieved a <span class="tw-font-bold">{{ streak }}-day streak</span> during {{ challengeTitle }}, which earned you a {{ tier }} certificate.
                </p>

                <div v-if="openFromAwards" class="tw-text-center tw-text-[#888888] tw-mb-6">
                    Earned on {{ earnedDate }}
                </div>

                <div class="tw-flex-col sm:tw-flex-row tw-flex tw-justify-center tw-gap-[10px] tw-mb-16 sm:tw-mb-6 tw-z-[3] tw-relative">
                    <MuButton @click="openCertificate">View certificate</MuButton>
                    <MuButton @click="openShareModal"><musora-icon icon-name="share" class="tw-h-6 tw-mr-1 -tw-mt-1 " /> Share</MuButton>
                </div>
                <div v-if="!openFromAwards" class="tw-text-center">
                    <a :href="`/${brand}/challenges`" class="tw-uppercase tw-underline tw-font-bold tw-font-bebas-neue dark:tw-text-white tw-z-[3] tw-relative">Return to Challenges</a>
                </div>
            </div>
        </div>
    </component>

    <ShareModal v-if="isShareOpen" :container-stay-on-close="true" @close-modal="closeShareModal" />
    <ChallengeCertificateModal v-if="isCertificateOpen" :certificate-data="awardData" @closeModal="emit('closeModal')" />
</template>
<script setup>
import { ref, onMounted, computed } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { Vue3Lottie } from 'vue3-lottie';
import { fetchUserAward } from "musora-content-services";

import ModalRenderer from '@collections/Modal/ModalRenderer';
import MuButton from '@units/Button/MuButton';
import ShareModal from '@collections/Modal/ShareModal';
import ChallengeCertificateModal from '@collections/Modal/ChallengeCertificateModal';

const props = defineProps({
    isModal: {
        type: Boolean,
        default: true,
    },
    awardData: {
        type: Object,
        default: {},
    },
    openFromAwards: {
        type: Boolean,
        default: false,
    }
})

const emit = defineEmits(['closeModal']);

const compMap = {
    ModalRenderer,
}

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const hideAnimation = ref(false);
const isShareOpen = ref(false);
const isCertificateOpen = ref(false);

const challengeBadge = computed(() => {
    return props.awardData?.badge;
})

const minutesPracticed = computed(() => {
    return props.awardData?.minutes_practiced;
})

const streak = computed(() => {
    return props.awardData?.streak;
})

const tier = computed(() => {
    return props.awardData?.tier;
})

const challengeTitle = computed(() => {
    return props.awardData?.challenge_title;
})

const earnedDate = computed(() => {
    return props.awardData?.date_completed;
})

const openCertificate = () => {
    isCertificateOpen.value = true;
}

const openShareModal = () => {
    isShareOpen.value = true;
}

const closeShareModal = () => {
    isShareOpen.value = false;
}

onMounted(() => {
    setTimeout(() => {
        hideAnimation.value = true;
    },1200)
})

const animations = {
    drumeo: 'https://lottie.host/6b65abab-e596-499f-9826-35d7e8d65d94/iYfnMjtsYE.json',
    pianote: 'https://lottie.host/32fe8d09-da0d-4af2-9f22-692bfeef6d72/psU3fXB7nS.json',
    guitareo: 'https://lottie.host/542a95ca-67ba-4d7a-abc4-96706ffb0347/VOonB6crKf.json',
    singeo: 'https://lottie.host/c9db39ce-cee4-4a2c-a3bf-b6504cc173e7/f7ryuBuw5u.json',
}
</script>
