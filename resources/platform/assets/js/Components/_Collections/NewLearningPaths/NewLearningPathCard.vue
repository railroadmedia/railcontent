<template>
    <!-- MOBILE -->
    <div :style="{ backgroundImage: `url(${calculatedBgImg})` }"
        class="tw-flex xl:tw-hidden tw-relative tw-text-white tw-justify-start tw-items-center tw-rounded-[10px] tw-w-[310px] tw-h-[430px] md:tw-w-1/2 tw-mr-[10px] md:tw-mr-0 tw-bg-cover tw-bg-center">
        <div class="tw-flex tw-flex-col tw-items-center tw-absolute tw-w-full tw-h-full tw-p-[20px] tw-rounded-[10px]" :class="contentType !== 'challenge' ? 'tw-backdrop-blur-sm' : ''"
            :style="{
        background: contentType === 'challenge' ?
            'linear-gradient(180deg, rgba(0, 0, 0, 0) 30%, rgba(0, 0, 0, 0.7) 45%, #000000 100%)'
            : 'linear-gradient(270deg, rgba(0, 0, 0, 0.3) 30%, rgba(0, 0, 0, 0.5) 45.09%, #000000 100%)'
    }">
            <div class="tw-self-start" v-if="contentType.length">
                <span
                    class="tw-font-bold tw-text-[12px] tw-leading-normal lg:tw-text-[11px] lg:tw-leading-[15px] 2xl:tw-text-[12px] 2xl:tw-leading-[16px] tw-p-[5px] tw-uppercase tw-text-white tw-rounded-[4px] tw-bg-black">
                    {{ contentType }}
                </span>
            </div>
            <div class="tw-flex tw-flex-col tw-h-full tw-w-full tw-items-center tw-justify-end">
                <div v-if="contentType === 'challenge'" class="tw-flex tw-w-[203px] tw-mt-[19px]">
                    <img :src="logo" :alt="`${title} Thumbnail`" />
                </div>
                <div v-if="contentType !== 'challenge'" class="tw-flex tw-w-[203px] tw-mt-[19px] tw-h-[203px]">
                    <img class="tw-rounded-[5px]" :src="squareImg" :alt="`${title} Thumbnail`" />
                </div>
            </div>
            <div
                class="tw-flex tw-flex-col tw-justify-between tw-grow">
                <div class="tw-w-auto tw-h-full">
                    <div class="tw-pt-[10px] tw-text-center">
                        <h1
                            class="tw-text-[18px] tw-leading-[27px] tw-font-bold tw-pb-[5px]">
                            {{ title }}
                        </h1>
                        <p v-if="description.length"
                            class="tw-text-[12px] tw-leading-[18px] tw-line-clamp-2">
                            {{ description }}
                        </p>
                    </div>
                </div>
                <div class="tw-flex tw-pt-[15px] tw-w-full tw-self-end">
                    <a @click="(e) => handleCtaClick(e, ctaUrl)" :href="ctaUrl"
                        class="tw-btn-primary tw-bg-white tw-text-black hover:tw-bg-[#627F97] hover:tw-text-white tw-py-[8px] tw-w-full">
                        <span>
                            START NOW
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- DESKTOP -->
    <div :style="{ backgroundImage: `url(${calculatedBgImg})` }"
        class="tw-hidden xl:tw-flex tw-relative tw-overflow-hidden tw-text-white tw-justify-start tw-items-center tw-rounded-[10px] lg:tw-w-1/2 xl:tw-h-[272px] 3xl:tw-h-[295px] tw-mr-[10px] lg:tw-mr-0 tw-bg-cover tw-bg-center">
        <div class="tw-flex tw-absolute tw-w-full tw-h-full tw-backdrop-blur-sm tw-p-[20px] lg:tw-p-[30px]"
            :style="{ background: 'linear-gradient(270deg, rgba(0, 0, 0, 0.3) 30%, rgba(0, 0, 0, 0.5) 45.09%, #000000 100%)' }">
            <div
                class="tw-flex tw-flex-col tw-justify-between tw-pr-[20px] xl:tw-pr-[30px] tw-grow tw-h-[212px] 3xl:tw-h-[235px] tw-overflow-hidden">
                <div class="tw-w-auto tw-h-full">
                    <div v-if="contentType.length">
                        <span
                            class="tw-font-bold tw-text-[12px] tw-leading-normal lg:tw-text-[11px] lg:tw-leading-[15px] 2xl:tw-text-[12px] 2xl:tw-leading-[16px] tw-p-[5px] tw-uppercase tw-text-white tw-rounded-[4px] tw-bg-black">
                            {{ contentType }}
                        </span>
                    </div>
                    <div class="tw-pt-[15px] 2xl:tw-pt-[25px] tw-overflow-hidden">
                        <h1
                            class="tw-text-[18px] tw-leading-[27px] 3xl:tw-text-[20px] 3xl:tw-leading-[30px] tw-font-bold tw-pb-[5px] tw-line-clamp-2">
                            {{ title }}
                        </h1>
                        <p v-if="description.length"
                            class="tw-text-[12px] tw-leading-[18px] 3xl:tw-text-[14px] 3xl:tw-leading-[21px] tw-line-clamp-2">
                            {{ description }}
                        </p>
                    </div>
                </div>
                <div class="tw-flex tw-pt-[15px] tw-w-full tw-self-end">
                    <a @click="(e) => handleCtaClick(e, ctaUrl)" :href="ctaUrl"
                        class="tw-btn-primary tw-bg-white tw-text-black hover:tw-bg-[#627F97] hover:tw-text-white tw-py-[8px] tw-w-full">
                        <span>
                            START NOW
                        </span>
                    </a>
                </div>
            </div>
            <div
                class="tw-flex tw-justify-end tw-items-center xl:tw-min-w-[212px] xl:tw-min-h-[212px] 3xl:tw-min-w-[418px] 3xl:tw-min-h-[235px] xl:tw-w-[212px] xl:tw-h-[212px] 3xl:tw-w-[418px] 3xl:tw-h-[235px]">
                <img class="tw-rounded-[5px] xl:tw-h-[212px] xl:tw-min-w-[212px]"
                    :class="hasSquareImg ? '3xl:tw-h-[235px] 3xl:tw-min-w-[235px]' : '3xl:tw-h-[235px] 3xl:tw-w-[418px]'"
                    :src="thumbnailImg" :alt="`${title} Thumbnail`" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { breakpointsTailwind, useBreakpoints } from '@vueuse/core';
import { useUserStore } from "@stores/user";
import userJourney from "@services/userJourney";

const userStore = useUserStore();

const breakpoints = useBreakpoints({ ...breakpointsTailwind, '3xl': 1815 });
const desktop = breakpoints.greaterOrEqual('lg');
const bigDesktop = breakpoints.greaterOrEqual('3xl');
const mobile = breakpoints.smaller('md');

const hasSquareImg = ref(false);

const props = defineProps({
    contentType: {
        type: String,
        default: ''
    },
    title: {
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
    wideImg: {
        type: String,
        default: ''
    },
    squareImg: {
        type: String,
        default: ''
    },
    trackingSection: {
        type: String,
        default: ''
    },
    logo: {
        type: String,
        default: ''
    }
});

const thumbnailImg = computed(() => {
    if (props.contentType === 'song') {
        hasSquareImg.value = true;
        return props.squareImg;
    }

    if (bigDesktop.value && props.wideImg) {
        hasSquareImg.value = false;
        return props.wideImg;
    }

    if (desktop.value && props.squareImg) {
        hasSquareImg.value = true;
        return props.squareImg;
    }

    if (mobile.value && props.squareImg) {
        hasSquareImg.value = true;
        return props.squareImg;
    }

    return '';
});

const calculatedBgImg = computed(() => {
    if (props.contentType === 'song') {
        return props.squareImg;
    }

    if (props.bgImg) {
        return props.bgImg;
    }

    return '';
});

const handleCtaClick = (event, url) => {
    if (props.trackingSection && props.trackingSection.length) {
        event.preventDefault();

        userJourney.trackHomeContentClick({
            token: userStore.token,
            payload: {
                contentId: null,
                brand: userStore.brand,
                section: props.trackingSection,
            }
        }).finally(() => {
            window.location.href = url;
        });
    } else {
        window.location.href = url;
    }
};
</script>
