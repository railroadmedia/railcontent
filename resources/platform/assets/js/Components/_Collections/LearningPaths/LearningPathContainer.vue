<template>
    <div v-if="showLearningPaths" class="tw-flex tw-flex-col tw-w-full tw-mt-[30px]">
        <div
            class="tw-flex tw-border-t-[1px] tw-border-[#223F57] tw-py-[22px] tw-items-center tw-justify-between tw-grow tw-mx-4 lg:tw-mx-0">
            <h2 class="tw-font-bold tw-text-[30px] tw-leading-[22px]">
                Where to start?
            </h2>
            <button @click="handleDismiss"
                class="tw-hidden lg:tw-flex tw-items-center tw-justify-start tw-h-[36px] tw-px-[10px] tw-text-white tw-rounded-[18px] tw-bg-[#0E2031] dark:hover:tw-bg-white hover:tw-bg-black dark:hover:tw-text-black hover:tw-text-white">
                <span class="tw-uppercase tw-font-bebas-neue">DISMISS</span>
                <span>
                    <XIcon class="tw-w-[15px] tw-h-[15px]" />
                </span>
            </button>
            <button @click="handleDismiss" class="tw-block lg:tw-hidden">
                <XIcon class="tw-w-[35px] tw-h-[35px]" />
            </button>
        </div>
        <div class="tw-flex tw-w-full tw-overflow-x-auto tw-no-scrollbar">
            <div class="tw-flex lg:tw-w-full lg:tw-gap-[14px] tw-px-4 lg:tw-px-0">
                <LearningPathCard v-for="path in learningPaths" :key="path.id" :topPillText="path.tagline ?? ''"
                    :title="path.title" :topDescription="path.subtitle" :description="path.description"
                    :ctaText="path.ctaText" :ctaUrl="path.ctaUrl" :videoUrl="path.trailer" :desktopBg="path.desktop_img" :tabletBg="path.tablet_img" :mobileBg="path.mobile_img" :trackingSection="trackingSection" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios'
import { storeToRefs } from 'pinia';
import { XIcon } from '@heroicons/vue/outline';
import LearningPathCard from './LearningPathCard.vue';
import { useUserStore } from '@stores/user';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const showLearningPaths = ref(true);

const props = defineProps({
    learningPaths: {
        type: Array,
        default: () => []
    },
    trackingSection: {
        type: String,
        default: ''
    }
});

const handleDismiss = () => {
    axios.post('/musora-api/v1/trial-section-dismiss', { brand: brand.value }).then(() => {
        showLearningPaths.value = false;

        window.shownotification({
            icon: 'check',
            text: `You won't see this promotion in your home page again.`
        });
    }).catch(() => {
        window.shownotification({
            icon: 'error',
            text: `There was an error performing this action, if the error persists please contact support.`
        });
    });
};
</script>
