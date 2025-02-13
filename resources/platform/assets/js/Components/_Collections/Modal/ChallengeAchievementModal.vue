<template>
    <div class="tw-text-white tw-max-w-[440px] sm:tw-max-w-none tw-w-full sm:tw-w-auto tw-mx-2 sm:tw-mx-0">
        <h1 class="tw-mb-5 tw-text-2xl tw-font-bold tw-text-center">You've earned a special achievement!</h1>
        <div class="tw-rounded-[10px] tw-bg-[linear-gradient(90deg,_#131A27_0%,_#182132_100%)] tw-max-w-[440px] tw-w-full tw-px-2 sm:tw-px-12 tw-pt-[30px] tw-pb-5 tw-border tw-border-[#081825] tw-mb-5">
            <div class="tw-px-3 sm:tw-px-5 tw-mb-4">
                <div class="tw-w-full tw-aspect-square tw-rounded-full tw-overflow-hidden">
                    <Vue3Lottie animation-link="https://lottie.host/4ef1a405-db20-4e7c-b185-7800035f75af/kx4RO1kh30.json" width="100%" height="100%" :speed="1.5" />
                </div>
            </div>
            <div class="tw-flex tw-gap-2 tw-text-xs sm:tw-text-sm tw-relative tw-z-20">
                <!-- Streak -->
                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-[#223F57] tw-py-1 tw-pr-1 tw-flex tw-items-center tw-relative">
                    <!-- Bubble speech -->
                    <div class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700 -tw-top-3">Best!</div>
                    <Vue3Lottie class="tw-w-11 lg:tw-w-[46px] tw-ml-0 sm:tw-ml-1 tw-mr-0" animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                    <div class="tw-flex-grow">
                        <div class="tw-font-extrabold tw-text-base">{{ completionData?.user_data?.current_best_streak }}</div>
                        <div class="tw-flex tw-items-center tw-justify-between -tw-mt-0.5">
                            Day Streak
                            <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]" @click="$emit('openStreakInfo')"></musora-icon>
                        </div>
                    </div>
                </div>
                <!-- Rest Days -->
                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-[#223F57] tw-py-1 tw-pl-2 sm:tw-pl-3 tw-flex tw-items-center tw-relative">
                    <i class="fa-regular fa-clock tw-text-2xl tw-mr-2 sm:tw-mr-3"></i>
                    <div class="tw-flex-grow">
                        <div class="tw-font-extrabold tw-text-base">{{ completionData?.user_data?.minutes_practiced }} mins</div>
                        <div class="tw-flex tw-items-center tw-justify-between -tw-mt-0.5">
                            Practiced
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-justify-center">
            <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white" @click="$emit('openAwardModal')">
                <svg class="tw-mr-2 -tw-mt-1 group-hover:tw-fill-white" width="22" height="23" viewBox="0 0 91 91" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M67.8852 11.9207V6.32422H23.1139V11.9207H6.32422V23.1139C6.32422 33.7529 13.7676 42.6238 23.7178 44.8952C25.5764 53.0273 31.8554 59.4126 39.9034 61.5003V67.8855C39.9034 70.9751 37.3964 73.482 34.3069 73.482H28.7104V84.6752H62.2897V73.482H56.6933C53.6037 73.482 51.0967 70.9751 51.0967 67.8855V61.4995C59.1447 59.4174 65.4237 53.0321 67.2816 44.9C77.2319 42.6229 84.6752 33.7527 84.6752 23.1134V11.9202L67.8852 11.9207ZM11.9202 23.1139V17.5174H23.1134V38.874C16.6156 36.551 11.9202 30.4003 11.9202 23.1139ZM79.0789 23.1139C79.0789 30.4003 74.3835 36.551 67.8857 38.874V17.5174H79.0789V23.1139Z"/>
                </svg>
                Claim award
            </MuButton>
        </div>
    </div>
</template>
<script setup>
import { Vue3Lottie } from 'vue3-lottie';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    completionData: {
        type: Object,
        default: {},
    }
})
</script>
