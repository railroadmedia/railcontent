<script setup>
import { ref, onBeforeMount, onMounted } from 'vue';
import { XIcon } from "@heroicons/vue/solid";
import Button from "../Button/Button.vue";
import userJourney from '../../../services/userJourney';
import { useUserStore } from '../../../stores/user';
import {getCookie, setCookie} from "../../vuesora/assets/js/functions/cookies";

const userStore = useUserStore();

const props = defineProps({
    preloadedBanner: {
        type: Object,
        default: {},
    },
    trackingSection: {
        type: String,
        default: '',
    },
});

const showBanner = ref(false);

const hideBanner = () => {
    // setCookie(props.brand + "hideCohortBanner", "true", 10);
    showBanner.value = false;
};

onBeforeMount(() => {
    // const cohortBannerCookie = !!getCookie(props.brand + "hideCohortBanner");
    if(Object.keys(props.preloadedBanner).length !== 0){
        showBanner.value = true;
    }
});

const handleClick = (event, url) => {
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
    }
};
</script>

<template>
    <div
        class="
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
          tw-mb-[30px]
        "
        v-if="showBanner"
    >
        <div class="tw-flex tw-items-center tw-mb-4 md:tw-mb-0 md:tw-mr-4">
            <img class="tw-h-24 tw-rounded-xl tw-mr-3" :src="'https://www.musora.com/musora-cdn/image/width=300,quality=95/'+preloadedBanner.thumbnail" alt="cohort thumbnail" />
            <div>
                <img class="tw-h-[54px] tw-hidden xl:tw-inline-block dark:xl:tw-hidden" :src="'https://www.musora.com/musora-cdn/image/width=200,quality=95/'+preloadedBanner.light_mode_logo" alt="cohort logo" />
                <img class="tw-h-[54px] tw-hidden dark:xl:tw-inline-block" :src="'https://www.musora.com/musora-cdn/image/width=200,quality=95/'+preloadedBanner.dark_mode_logo" alt="cohort logo" />
                <div class="tw-font-bold tw-text-xl xl:tw-text-2xl"><span v-if="!preloadedBanner.continue_visible">Next Lesson: </span>{{ preloadedBanner.title }}</div>
            </div>
        </div>
        <div class="tw-flex tw-gap-4 md:tw-block">
            <a @click="(e) => handleClick(e, preloadedBanner.course_url)" :href="preloadedBanner.course_url" class="tw-btn-primary tw-text-[#000C17] tw-border-[#000C17] hover:tw-bg-[#000C17] hover:tw-text-white dark:tw-text-white dark:tw-border-white dark:tw-bg-[#000C17] dark:hover:tw-text-[#000C17] dark:hover:tw-bg-white tw-px-8 md:tw-mr-2 xl:tw-mr-4 tw-text-lg xl:tw-text-xl tw-flex-1 tw-inline-block tw-text-center">Go to Course</a>
            <a v-if="preloadedBanner.continue_visible" @click="(e) => handleClick(e, preloadedBanner.lesson_url)" :href="preloadedBanner.lesson_url" class="tw-btn-primary tw-bg-[#00101D] tw-text-white hover:tw-bg-[#3F3F46] dark:tw-text-[#00101D] dark:tw-bg-white dark:hover:tw-text-white dark:hover:tw-bg-[#627F97] tw-px-8 tw-text-lg xl:tw-text-xl tw-flex-1 tw-inline-block tw-text-center">Continue</a>
        </div>
        <button
            v-if="preloadedBanner.close_visible"
            class="
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
              "
            @click="hideBanner"
        >
            <XIcon class="tw-w-[12px] tw-h-[12px]" />
        </button>
    </div>
</template>
