<script setup>
import { ref, onBeforeMount } from 'vue';
import { getCookie, setCookie } from '../../vuesora/assets/js/functions/cookies';
import { XIcon } from "@heroicons/vue/solid";
import Button from "../Button/Button.vue";

const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    },
    preloadedBanner: {
        type: Object,
    },
});

</script>

<template>
    <div class="
      tw-flex
      tw-flex-col
      md:tw-flex-row
      tw-w-full
      tw-bg-[#E4E4E7]
      dark:tw-bg-[#002039B2]/70
      tw-border
      tw-border-[#A1A1A9]
      dark:tw-border-[#344858]
      tw-min-h-[105px]
      tw-rounded-[10px]
      md:tw-items-center
      md:tw-justify-between
      tw-relative
      tw-p-5
      tw-mb-5
    ">
        <div class="tw-flex tw-items-center tw-mb-4 md:tw-mb-0 md:tw-mr-4">
            <img class="tw-h-24 tw-rounded-xl tw-mr-3" :src="preloadedBanner.thumbnail" alt="cohort thumbnail" />
            <div>
                <img class="tw-h-[54px] tw-hidden xl:tw-inline-block" :src="preloadedBanner.light_mode_logo" alt="cohort logo" />
                <div class="tw-font-bold tw-text-xl xl:tw-text-2xl">Next Lesson: {{ preloadedBanner.title }}</div>
            </div>
        </div>
        <div class="tw-flex tw-gap-4 md:tw-block">
            <a :href="preloadedBanner.course_url" class="tw-btn-secondary dark:tw-text-white dark:tw-bg-[#000C17] dark:hover:tw-text-[#000C17] dark:hover:tw-bg-white tw-px-8 md:tw-mr-2 xl:tw-mr-4 tw-text-lg xl:tw-text-2xl tw-flex-1 tw-inline-block tw-text-center">Go to Course</a>
            <a v-if="preloadedBanner.completed !== true" :href="preloadedBanner.lesson_url" class="tw-btn-primary dark:tw-text-[#00101D] dark:tw-bg-white dark:hover:tw-text-white dark:hover:tw-bg-[#00101D] tw-px-8 tw-text-lg xl:tw-text-2xl tw-flex-1 tw-inline-block tw-text-center">Continue</a>
        </div>
        <button class="
        tw-absolute
        dark:tw-text-white
        dark:tw-border-white
        tw-text-[#00101D]
        tw-border-black
        tw-border-[2px]
        tw-rounded-full
        tw-h-[20px]
        tw-w-[20px]
        tw-flex
        tw-justify-center
        tw-items-center
        tw-top-[5px]
        tw-right-[5px]
        md:tw-top-[9px]
        md:tw-right-[9px]
        hover:tw-bg-black/10
        dark:hover:tw-bg-white/10
      " @click="hideOnboardingBanner">
            <XIcon class="tw-w-[12px] tw-h-[12px]" />
        </button>
    </div>
</template>
