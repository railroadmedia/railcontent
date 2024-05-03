<template>
    <div :style="{ backgroundImage: `url(${bgImg})` }"
        class="tw-flex tw-text-white tw-px-[25px] md:tw-px-[32px] tw-justify-start tw-items-center tw-rounded-[10px] tw-w-[307px] tw-h-[166px] sm:tw-w-[544px] sm:tw-h-[139px] lg:tw-w-1/2 lg:tw-h-[185px] tw-mr-[10px] lg:tw-mr-0 tw-bg-cover">
        <div class="tw-flex tw-flex-col tw-w-full">
            <div v-if="topPillText.length" class="tw-w-auto tw-grow-0 tw-pb-[6px]">
                <span
                    class="tw-font-bold tw-rounded-[4px] tw-bg-[#FFAE00] tw-text-[10px] tw-leading-[8px] lg:tw-leading-[14px] tw-py-[4px] tw-px-[3px]">
                    {{ topPillText }}
                </span>
            </div>
            <div v-if="topDescription.length" class="tw-text-[12px] tw-leading-[18px] tw-uppercase">
                {{ topDescription }}
            </div>
            <h1 class="tw-text-[14px] tw-leading-[19px] lg:tw-text-[20px] lg:tw-leading-[30px] tw-font-bold">{{ title }}
            </h1>
            <p v-if="description.length" class="tw-hidden lg:tw-block tw-text-[12px] tw-leading-[18px]">
                {{ description }}
            </p>
            <div class="tw-flex tw-pt-[15px]">
                <a :href="ctaUrl"
                    class="tw-btn-primary tw-bg-white tw-text-black hover:tw-bg-[#627F97] hover:tw-text-white">
                    <span >
                        {{ ctaText }}
                        <svg
                            v-if="computedCtaText === 'completed'"
                            class="tw-inline tw-ml-2" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M5.50032 8.56622L7.16699 10.2329L10.5003 6.89956M4.52927 2.48043C5.12721 2.43271 5.69487 2.19758 6.15142 1.80851C7.21682 0.90058 8.78382 0.90058 9.84922 1.80851C10.3058 2.19758 10.8734 2.43271 11.4714 2.48043C12.8667 2.59178 13.9748 3.69981 14.0861 5.09517C14.1338 5.69312 14.369 6.26077 14.758 6.71732C15.666 7.78273 15.666 9.34972 14.758 10.4151C14.369 10.8717 14.1338 11.4393 14.0861 12.0373C13.9748 13.4326 12.8667 14.5407 11.4714 14.652C10.8734 14.6997 10.3058 14.9349 9.84922 15.3239C8.78382 16.2319 7.21682 16.2319 6.15142 15.3239C5.69487 14.9349 5.12721 14.6997 4.52927 14.652C3.13391 14.5407 2.02588 13.4326 1.91453 12.0373C1.86681 11.4393 1.63168 10.8717 1.24261 10.4151C0.334678 9.34972 0.334678 7.78273 1.24261 6.71732C1.63168 6.26077 1.86681 5.69312 1.91453 5.09517C2.02588 3.69981 3.13391 2.59178 4.52927 2.48043Z"
                                stroke="currentColor" stroke-width="1.14286" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <button
                    v-if="videoUrl"
                    @click="handleVideoClick"
                    class="hover:tw-bg-white hover:tw-text-black tw-ml-[10px] tw-rounded-full tw-border-white tw-border-[2px] tw-w-[40px] tw-h-[40px] tw-text-white tw-border-box tw-flex tw-items-center tw-justify-center">
                    <VideoCameraIcon class="tw-w-[24px] tw-h-[24px]" />
                </button>
            </div>
        </div>
        <VideoModal v-if="showVideoModal" :videoUrl="videoUrl" @onCloseModal="handleCloseVideo" />
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { VideoCameraIcon } from "@heroicons/vue/outline"
import VideoModal from "../Modal/VideoModal.vue";

const props = defineProps({
    topPillText: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        default: ''
    },
    topDescription: {
        type: String,
        default: ''
    },
    description: {
        type: String,
        default: ''
    },
    ctaText: {
        type: String,
        default: ''
    },
    ctaUrl: {
        type: String,
        default: ''
    },
    videoUrl: {
        type: String,
        default: ''
    },
    bgImg: {
        type: String,
        default: ''
    },
});

const showVideoModal = ref(false);

const computedCtaText = computed(() => {
    return props.ctaText ? props.ctaText.replace(/\s+/g, '').toLowerCase() : '';
});

const handleVideoClick = () => {
    showVideoModal.value = true;
};

const handleCloseVideo = () => {
    showVideoModal.value = false;
};
</script>
