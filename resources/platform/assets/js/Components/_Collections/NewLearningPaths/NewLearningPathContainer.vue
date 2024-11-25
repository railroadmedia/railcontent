<template>
    <div v-if="showLearningPaths" class="tw-flex tw-flex-col tw-w-full tw-mb-[30px]">
        <div v-if="!isV2User"
            class="tw-flex tw-py-[22px] tw-items-center tw-justify-between tw-grow tw-mx-4 lg:tw-mx-0">
            <h2 class="tw-font-bold tw-text-[24px] tw-leading-[22px]">
                Where to start?
            </h2>
        </div>
        <div class="tw-flex tw-w-full tw-overflow-x-auto tw-no-scrollbar">
            <div class="tw-flex md:tw-w-full md:tw-gap-[14px] tw-px-4 lg:tw-px-0">
                <NewLearningPathCard v-for="path in learningPaths" :key="path.id" :contentType="path.content_type ?? ''"
                    :title="path.header" :description="path.subheader" :logo="path.logo"
                    :ctaText="path.ctaText" :ctaUrl="path.button?.content_url" :bgImg="path.bgImg" :wideImg="path.wideImg" :squareImg="path.squareImg" :trackingSection="trackingSection" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import NewLearningPathCard from './NewLearningPathCard.vue';
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
    },
    isV2User: {
        type: Boolean,
        default: false
    }
});
</script>
