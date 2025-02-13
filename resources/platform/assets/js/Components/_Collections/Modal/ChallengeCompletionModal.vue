<template>
    <ModalRenderer :black-background="true" :show-x-icon="true" @on-close="emit('closeModal')">
        <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-flex tw-justify-center tw-items-center tw-transition-all tw-duration-200" :class="!showAchievement && !showAward ? 'tw-opacity-1 tw-z-[5]' : 'tw-opacity-0 tw-z-0'">
            <!-- Final Animation -->
            <Vue3Lottie v-if="isChallengeCompleted && lottieUrl" class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10" :class="lottieStyles" :animation-link="lottieUrl" width="100%" height="100%" :loop="false" />
            <!-- Desktop/Tablet -->
            <div class="tw-hidden md:tw-flex tw-flex-col tw-justify-center tw-items-center dark:tw-text-white">
                <h1 class="tw-text-2xl tw-font-bold tw-mb-2 tw-text-white">{{ headerText }}</h1>
                <p class="tw-text-white">{{ subHeaderText }}</p>

                <div class="tw-border tw-border-[#081825] tw-rounded-[10px] tw-bg-white dark:tw-bg-[linear-gradient(90deg,_#131A27_0%,_#182132_100%)] tw-max-w-[700px] lg:tw-max-w-[758px] tw-w-full tw-flex tw-px-8 lg:tw-px-12 tw-pb-5 tw-relative tw-overflow-hidden tw-my-5">
                    <!-- Streak Animation -->
                    <Vue3Lottie v-if="!isChallengeCompleted && lottieUrl" class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10 tw-object-cover" :class="lottieStyles" :animation-link="lottieUrl" width="100%" height="100%" :loop="false" />
                    <!-- Left -->
                    <div class="tw-flex-1 tw-flex tw-flex-col tw-justify-center tw-items-start">
                        <!-- Challenge Logo -->
                        <img class="dark:tw-hidden tw-h-24" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${lightModeLogo}`" alt="Challenge light mode logo" />
                        <img class="tw-hidden dark:tw-block tw-h-24" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${darkModeLogo}`" alt="Challenge dark mode logo" />
                        <div v-if="isNextLessonLocked" class="tw-font-bold tw-text-sm tw-mt-[15px]">{{ nextLessonTitle }} Unlocks In {{ countdownString }}</div>
                    </div>
                    <!-- Right -->
                    <div class="tw-flex-1 tw-relative tw-pb-5">
                        <!-- Musora Logo -->
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" alt="Musora logo" />
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" alt="Musora logo" />
                        <div class="tw-pl-6 tw-relative tw-pt-7">
                            <div class="tw-mx-5 tw-rounded-[10px] tw-overflow-hidden tw-aspect-video tw-mb-5 tw-relative">
                                <!-- Milestone Icon -->
                                <div v-if="isMilestone" class="tw-bg-[rgba(0,12,23,0.70)] tw-rounded-full tw-py-[5px] tw-px-1 tw-absolute tw-top-[6px] tw-right-[4px] tw-flex tw-justify-center tw-items-center">
                                    <musora-icon icon-name="challenge-milestone" class="tw-text-white tw-w-[14px] 2xl:tw-w-[16px] tw-h-[13px] 2xl:tw-h-[15px]" ></musora-icon>
                                </div>
                                <!-- Thumbnail -->
                                <img class="tw-w-full" :src="`https://www.musora.com/cdn-cgi/image/width=500,quality=95/${lessonThumbnail}`" alt="Next lesson thumbnail" />
                                <!-- Overlay -->
                                <div v-if="isNextLessonLocked || isChallengeCompleted" class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-black/60 tw-flex tw-flex-col tw-justify-center tw-items-center">
                                    <template v-if="isNextLessonLocked">
                                        <i class="fa-solid fa-lock tw-mb-2 tw-text-3xl tw-text-white"></i>
                                        <div class="tw-font-bold tw-text-sm tw-text-white">Unlocks in {{ countdownString }}</div>
                                    </template>
                                    <musora-icon v-else icon-name="circle-check-filled" class="tw-text-white tw-w-9 tw-h-9" />
                                </div>
                            </div>
                            <div class="tw-flex tw-gap-2 tw-text-[13px] tw-relative tw-z-20">
                                <!-- Streak -->
                                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-px-1.5 2xl:tw-px-2 tw-flex tw-items-center tw-relative tw-cursor-pointer" @click="updateInfoModalType('streak')">
                                    <!-- Streak badge -->
                                    <div v-if="streakBadgeText" class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showBadgeAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">{{ streakBadgeText }}</div>
                                    <div v-if="streakDay === 0" class="tw-text-xl 2xl:tw-text-lg 3xl:tw-text-xl tw-mr-1">🔥</div>
                                    <Vue3Lottie v-else class="tw-w-[32px] 3xl:tw-w-[36px] -tw-ml-1.5" animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                                    <div class="tw-flex-grow">
                                        <div class="tw-font-extrabold">{{ streakDay }}</div>
                                        <div class="tw-flex tw-items-center tw-justify-between">
                                            Day Streak
                                            <musora-icon icon-name="info" class="tw-ml-2 tw-w-4 tw-h-4 tw-text-[#65656B] dark:tw-text-[#80A0B9] tw-hidden 2xl:tw-block"></musora-icon>
                                        </div>
                                    </div>
                                </div>
                                <!-- Rest Days -->
                                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-px-1.5 2xl:tw-px-2 tw-flex tw-items-center tw-relative tw-cursor-pointer" @click="updateInfoModalType('rest')">
                                    <!-- Rest badge -->
                                    <div v-if="isRestDayAdded" class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showBadgeAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">+1</div>
                                    <template v-if="showActiveStreakSaver">
                                        <musora-icon icon-name="streak-saver-active-dark" class="tw-w-7 2xl:tw-w-6 3xl:tw-w-7 tw-mr-2 tw-hidden dark:tw-block"></musora-icon>
                                        <musora-icon icon-name="streak-saver-active-light" class="tw-w-7 2xl:tw-w-6 3xl:tw-w-7 tw-mr-2 dark:tw-hidden"></musora-icon>
                                    </template>
                                    <template v-else>
                                        <musora-icon icon-name="streak-saver-dark" class="tw-w-7 2xl:tw-w-6 3xl:tw-w-7 tw-mr-2 tw-hidden dark:tw-block"></musora-icon>
                                        <musora-icon icon-name="streak-saver-light" class="tw-w-7 2xl:tw-w-6 3xl:tw-w-7 tw-mr-2 dark:tw-hidden"></musora-icon>
                                    </template>
                                    <div class="tw-flex-grow">
                                        <div class="tw-font-extrabold">{{ restDay }}</div>
                                        <div class="tw-flex tw-items-center tw-justify-between">
                                            Streak Saver
                                            <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-text-[#65656B] dark:tw-text-[#80A0B9] tw-hidden 2xl:tw-block"></musora-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Progress Bar -->
                    <div class="tw-absolute tw-left-0 tw-bottom-0 tw-w-full tw-h-5 tw-bg-[#223F57]">
                        <div :class="`tw-absolute tw-left-0 tw-top-0 tw-h-5 tw-transition-all tw-duration-700 tw-bg-${brand} tw-flex tw-justify-end tw-items-center tw-text-[#E3E3E3] tw-text-[11px] tw-font-bold`" :style="`width:${progress}%`">{{ progress }}%</div>
                    </div>
                </div>
                <div v-if="!isChallengeCompleted" class="tw-flex tw-justify-center tw-w-full">
                    <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white tw-px-20" :is-link="true" :href="`/${brand}`">Complete {{ currentLessonShortTitle }}</MuButton>
                    <MuButton v-if="!isNextLessonLocked" variant="custom" class="tw-bg-[#00101D] tw-border tw-border-white tw-text-white hover:tw-bg-white hover:tw-text-[#00101D] tw-px-20 tw-ml-5" :is-link="true" :href="completionData?.next_lesson?.url">Continue Next Lesson</MuButton>
                </div>
            </div>

            <!-- Mobile -->
            <div class="tw-flex tw-flex-col tw-items-center tw-h-full tw-pt-11 md:tw-hidden dark:tw-text-white tw-px-4">
                <img class="tw-h-20 tw-mb-8" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${darkModeLogo}`" alt="Challenge dark mode logo" />
                <h1 class="tw-text-2xl tw-font-bold tw-mb-1 tw-text-center tw-text-white">{{ headerText }}</h1>
                <p class="tw-text-center tw-text-white">{{ subHeaderText }}</p>
                <div class="tw-rounded-[10px] tw-bg-white dark:tw-bg-[#182132] tw-max-w-[330px] tw-mx-2 tw-w-full tw-flex tw-flex-col tw-pb-6 tw-px-2 tw-relative tw-my-4 tw-overflow-hidden">
                    <!-- Streak Animation -->
                    <Vue3Lottie v-if="!isChallengeCompleted && lottieUrl" class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10" :class="lottieStyles" :animation-link="lottieUrl" :loop="false" />
                    <div class="tw-relative tw-w-full tw-mb-5 tw-pt-6">
                        <!-- Musora Logo -->
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" alt="Musora logo" />
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" alt="Musora logo" />
                        <div class="tw-flex tw-justify-center tw-items-center tw-relative tw-z-10">
                            <svg class="tw-transform -tw-rotate-90 tw-w-[300px] tw-h-[284px]">
                                <circle cx="150" cy="142" r="120" stroke="currentColor" stroke-width="20" fill="transparent"
                                        class="tw-text-[#E0E0E1] dark:tw-text-[#112E4A] tw-drop-shadow-md" />
                                <circle cx="150" cy="142" r="120" stroke="currentColor" stroke-width="20" fill="transparent"
                                        :stroke-dasharray="circumference"
                                        :stroke-dashoffset="circumference - progress / 100 * circumference"
                                        :class="`tw-text-${brand} tw-transition-all tw-duration-700`" />
                            </svg>
                            <div class="tw-absolute tw-text-center tw-max-w-[200px]">
                                <img class="tw-h-14 tw-mx-auto dark:tw-hidden" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${lightModeLogo}`" alt="Challenge light mode logo" />
                                <img class="tw-h-14 tw-mx-auto tw-hidden dark:tw-block" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${darkModeLogo}`" alt="Challenge dark mode logo" />
                                <div v-if="isNextLessonLocked" class="tw-text-[13px] tw-font-bold tw-mt-[10px] -tw-mb-1 tw-mx-2">{{ nextLessonTitle }} Unlocks In {{ countdownString }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="tw-flex tw-justify-center tw-gap-2 tw-text-[13px] tw-w-full tw-px-3 tw-relative tw-z-20">
                        <!-- Streak -->
                        <div class="tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-pr-2 -tw-pl-2 tw-flex tw-items-center tw-relative" @click="updateInfoModalType('streak')">
                            <!-- Streak Badge -->
                            <div v-if="streakBadgeText" class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showBadgeAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">{{ streakBadgeText }}</div>
                            <!-- Streak Lottie -->
                            <div v-if="streakDay === 0" class="tw-text-[22px] tw-mx-0.5">🔥</div>
                            <Vue3Lottie v-else animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" width="32px" />
                            <!-- Streak Text -->
                            <div>
                                <div class="tw-font-extrabold">{{ streakDay }}</div>
                                <div class="tw-flex tw-items-center">
                                    Day Streak
                                    <musora-icon icon-name="info" class="tw-ml-2 tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                                </div>
                            </div>
                        </div>
                        <!-- Rest Days -->
                        <div class="tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-pr-2 -tw-pl-2 tw-flex tw-items-center tw-relative" @click="updateInfoModalType('rest')">
                            <!-- Rest badge -->
                            <div v-if="isRestDayAdded" class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showBadgeAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">+1</div>
                            <!-- Rest Icon -->
                            <template v-if="showActiveStreakSaver">
                                <musora-icon icon-name="streak-saver-active-dark" class="tw-w-7 tw-mx-1 tw-hidden dark:tw-block"></musora-icon>
                                <musora-icon icon-name="streak-saver-active-light" class="tw-w-7 tw-mx-1 dark:tw-hidden"></musora-icon>
                            </template>
                            <template v-else>
                                <musora-icon icon-name="streak-saver-dark" class="tw-w-7 tw-mx-1 tw-hidden dark:tw-block"></musora-icon>
                                <musora-icon icon-name="streak-saver-light" class="tw-w-7 tw-mx-1 dark:tw-hidden"></musora-icon>
                            </template>
                            <!-- Rest Text -->
                            <div>
                                <div class="tw-font-extrabold">{{ restDay }}</div>
                                <div class="tw-flex tw-items-center">
                                    Streak Saver
                                    <musora-icon icon-name="info" class="tw-ml-2 tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!isChallengeCompleted" class="tw-flex tw-flex-col tw-w-full tw-px-2">
                    <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white tw-px-10 tw-w-full" :is-link="true" :href="`/${brand}`">Complete {{ currentLessonShortTitle }}</MuButton>
                    <MuButton v-if="!isNextLessonLocked" variant="custom" class="tw-bg-[#00101D] tw-border tw-border-white tw-text-white hover:tw-bg-white hover:tw-text-[#00101D] tw-px-10 tw-mt-5 tw-w-full" :is-link="true" :href="completionData?.next_lesson?.url">Continue Next Lesson</MuButton>
                </div>
            </div>

            <!-- Final Animation -->
            <Vue3Lottie v-if="isChallengeCompleted && lottieUrl" class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10" :class="lottieStyles" :animation-link="lottieUrl" width="100%" height="100%" :loop="false" />
        </div>

        <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-flex tw-justify-center tw-items-center tw-transition-all tw-duration-700" :class="showAchievement ? 'tw-opacity-1 tw-z-10' : 'tw-opacity-0 tw-z-0'">
            <ChallengeAchievementModal @open-streak-info="updateInfoModalType('streak')" @open-award-modal="openAwardModal" :completion-data="completionData"  />
        </div>

        <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-flex tw-justify-center tw-items-center tw-transition-all tw-duration-700" :class="showAward ? 'tw-opacity-1 tw-z-10' : 'tw-opacity-0 tw-z-0'">
            <ChallengeAwardModal v-if="showAward" :is-modal="false" :open-from-awards="false" :award-data="awardData" @closeModal="emit('closeModal')" />
        </div>
    </ModalRenderer>

    <!-- Info Modal -->
    <ChallengeInfoModal v-if="infoModalType" :type="infoModalType" :container-stay-on-close="true" :is-saver-active="restDay > 0" @close-modal="updateInfoModalType('')" />

</template>
<script setup>
import { computed, onMounted, ref, onUnmounted } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { Vue3Lottie } from 'vue3-lottie';
import { countdown } from "@collections/ChallengeCarousel/countdown";

import ModalRenderer from '@collections/Modal/ModalRenderer';
import MuButton from '@units/Button/MuButton';
import ChallengeInfoModal from '@collections/Modal/ChallengeInfoModal';
import ChallengeAchievementModal from '@collections/Modal/ChallengeAchievementModal';
import ChallengeAwardModal from '@collections/Modal/ChallengeAwardModal';
import { fetchUserAward } from "musora-content-services";

const props = defineProps({
    completionData: {
        type: Object,
        default: {},
    },
})

const emit = defineEmits(['closeModal']);

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const progress = ref(0);
const infoModalType = ref('');
const showFinishAnimation = ref(false);
const showBadgeAnimation = ref(false);
const showAchievement = ref(false);
const showAward = ref(false);
const hideAnimation = ref(false);
const countdownString = ref('');
const awardData = ref({});

const isMilestone = computed(() => {
    return props.completionData?.next_lesson?.is_milestone
})

const hasProgress = computed(() => {
    return progress.value > 0;
});

const headerText = computed(() => {
    return props.completionData?.motivational_title;
})

const subHeaderText = computed(() => {
    return props.completionData?.motivational_subtext;
})

const lightModeLogo = computed(() => {
    return props.completionData?.challenge_light_mode_logo_url;
})

const darkModeLogo = computed(() => {
    return props.completionData?.challenge_dark_mode_logo_url;
})

const streakDay = computed(() => {
    return props.completionData?.user_data?.current_streak;
})

const streakBadgeText = computed(() => {
    return props.completionData?.badge_text;
})

const restDay = computed(() => {
    return props.completionData?.user_data?.rest_days;
})

const isRestDayAdded = computed(() => {
    return props.completionData?.is_milestone;
})

const currentLessonTitle = computed(() => {
    return props.completionData?.title;
})

const currentLessonShortTitle = computed(() => {
    return props.completionData?.short_name;
})

const lessonThumbnail = computed(() => {
    return isLastLesson.value ? props.completionData?.current_lesson_thumbnail : props.completionData?.next_lesson?.thumbnail;
})

const nextLessonTitle = computed(() => {
    return props.completionData?.next_lesson?.title;
})

const isNextLessonLocked = computed(() => {
    return props.completionData?.next_lesson?.is_locked ?? true;
})

const isLastLesson = computed(() => {
    return !props.completionData?.next_lesson;
})

const isChallengeCompleted = computed(() => {
    return props.completionData?.milestone === 'complete';
})

const lottieUrl = computed(() => {
    return props.completionData.lottie_url;
})

const lottieStyles = computed(() => {
    return props.completionData.styles;
})

const animationDuration = computed(() => {
    return props.completionData.duration;
})

const showActiveStreakSaver = computed(() => {
    return props.completionData?.show_active_streak_saver;
})

const runCountDown = (stop = false) => {
    const intervalCountdown = setInterval(() => {
        // remove UTC iso part of the string. It's already in the users timezone from the BE
        const count = countdown(props.completionData?.next_lesson?.unlock_date.substring(0, 19));
        countdownString.value = count;

        if(count === '00:00:00'){
            clearInterval(intervalCountdown);
        }
    }, 1000)

    if(stop){
        clearInterval(intervalCountdown);
    }
}

const circumference = 2 * 22 / 7 * 120;

const updateInfoModalType = (type) => {
    infoModalType.value = type;
}

const openAwardModal = async() => {
    const data = await fetchUserAward(props.completionData?.challenge_id);
    awardData.value = data;

    showAchievement.value = false;
    showAward.value = true;
}

onMounted(() => {
    setTimeout(() => {
        progress.value = props.completionData?.user_data?.completion_percent;
        if(streakBadgeText.value || isRestDayAdded.value){
            showBadgeAnimation.value = true;
        }
    }, 1000)

    if(isChallengeCompleted.value){
        setTimeout(() => {
            showAchievement.value = true;
        }, 6000)
    }

    if(isNextLessonLocked.value){
        runCountDown();
    }
})

onUnmounted(() => {
    if(isNextLessonLocked.value){
        runCountDown(true);
    }
})
</script>
