<template>
    <ModalRenderer :black-background="true">
        <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-flex tw-justify-center tw-items-center tw-transition-all tw-duration-200" :class="!showAchievement && !showAward ? 'tw-opacity-1 tw-z-10' : 'tw-opacity-0 tw-z-0'">
            <!-- Completion Animation -->
            <Vue3Lottie v-if="!hideAnimation" class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10" :class="completionAnimations.completed.styles" :animation-link="completionAnimations.completed.drumeo" width="100%" height="100%" :loop="false" />
            <!-- Desktop/Tablet -->
            <div class="tw-hidden md:tw-flex tw-flex-col tw-justify-center tw-items-center dark:tw-text-white">
                <h1 class="tw-text-2xl tw-font-bold tw-mb-2 tw-text-white">You're done for the day!</h1>
                <p class="tw-text-white">Return tomorrow to maintain your streak!</p>

                <div class="tw-border tw-border-[#081825] tw-rounded-[10px] tw-bg-white dark:tw-bg-[linear-gradient(90deg,_#131A27_0%,_#182132_100%)] tw-max-w-[700px] lg:tw-max-w-[758px] tw-w-full tw-flex tw-px-8 lg:tw-px-12 tw-pb-5 tw-relative tw-overflow-hidden tw-my-5">
                    <!-- Streak Animation -->
<!--                    <Vue3Lottie v-if="!hideAnimation" class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10 tw-object-cover" :class="completionAnimations[15].styles" :animation-link="completionAnimations[15].drumeo" width="100%" height="100%" :loop="false" />-->
                    <!-- Left -->
                    <div class="tw-flex-1 tw-flex tw-flex-col tw-justify-center tw-items-start">
                        <!-- Challenge Logo -->
                        <img class="tw-h-24 tw-mb-2" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" />
                        <div class="tw-font-bold tw-text-sm">Day 2 Unlocks In 22:12</div>
                    </div>
                    <!-- Right -->
                    <div class="tw-flex-1 tw-relative tw-pb-5">
                        <!-- Musora Logo -->
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" />
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" />
                        <div class="tw-pl-6 tw-relative tw-pt-7">
                            <div class="tw-mx-5 tw-rounded-[10px] tw-overflow-hidden tw-aspect-video tw-mb-5 tw-relative">
                                <!-- Thumbnail -->
                                <img class="tw-w-full" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/s02-2-1675375801.jpg" />
                                <!-- Overlay -->
                                <div class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-black/60 tw-flex tw-flex-col tw-justify-center tw-items-center">
                                    <i class="fa-solid fa-lock tw-mb-2 tw-text-3xl tw-text-white"></i>
                                    <div class="tw-font-bold tw-text-sm tw-text-white">Unlocks in 22:12</div>
                                </div>
                            </div>
                            <div class="tw-flex tw-gap-2 tw-text-[13px] tw-relative tw-z-20">
                                <!-- Streak -->
                                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-pr-1 tw-flex tw-items-center tw-relative">
                                    <!-- Bubble speech -->
                                    <div class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showLabelAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">Nice!</div>
                                    <Vue3Lottie class="tw-w-11 lg:tw-w-[46px] -tw-ml-1 tw-mr-0" animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                                    <div>
                                        <div class="tw-font-extrabold">1</div>
                                        <div class="tw-flex tw-items-center">
                                            Day Streak
                                            <musora-icon icon-name="info" class="tw-ml-2 tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]" @click="updateInfoModalType('streak')"></musora-icon>
                                        </div>
                                    </div>
                                </div>
                                <!-- Rest Days -->
                                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-pl-2 tw-pr-1 tw-flex tw-items-center tw-relative">
                                    <!-- Bubble speech -->
                                    <div class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showLabelAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">+1</div>
                                    <img class="tw-mr-3 tw-w-4 lg:tw-w-5 tw-hidden dark:tw-block" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" />
                                    <img class="tw-mr-3 tw-w-4 lg:tw-w-5 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon_light.svg" />
                                    <div class="tw-flex-grow">
                                        <div class="tw-font-extrabold">2</div>
                                        <div class="tw-flex tw-items-center tw-justify-between">
                                            Rest Days
                                            <musora-icon icon-name="info" class="tw-ml-4 tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]" @click="updateInfoModalType('rest')"></musora-icon>
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
                <div class="tw-flex tw-justify-center tw-w-full">
                    <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white tw-px-20">Finish Day 1</MuButton>
                </div>
            </div>

            <!-- Mobile -->
            <div class="tw-flex tw-flex-col tw-items-center tw-h-full tw-pt-11 md:tw-hidden dark:tw-text-white tw-px-4">
                <img class="tw-h-20 tw-mb-8" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" />
                <h1 class="tw-text-2xl tw-font-bold tw-mb-1 tw-text-center tw-text-white">You're done for the day!</h1>
                <p class="tw-text-center tw-text-white">Return tomorrow to maintain your streak!</p>
                <div class="tw-rounded-[10px] tw-bg-white dark:tw-bg-[#182132] tw-max-w-[330px] tw-mx-2 tw-w-full tw-flex tw-flex-col tw-pb-6 tw-px-2 tw-relative tw-my-4 tw-overflow-hidden">
                    <!-- Streak Animation -->
                    <Vue3Lottie class="tw-absolute tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10" :class="completionAnimations[15].styles" :animation-link="completionAnimations[15].drumeo" />
                    <div class="tw-relative tw-w-full tw-mb-5 tw-pt-6">
                        <!-- Musora Logo -->
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" />
                        <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" />
                        <div class="tw-flex tw-justify-center tw-items-center tw-relative tw-z-10">
                            <svg class="tw-transform -tw-rotate-90 tw-w-[300px] tw-h-[284px]">
                                <circle cx="150" cy="142" r="120" stroke="currentColor" stroke-width="20" fill="transparent"
                                        class="tw-text-[#112E4A] tw-drop-shadow-md" />
                                <circle cx="150" cy="142" r="120" stroke="currentColor" stroke-width="20" fill="transparent"
                                        :stroke-dasharray="circumference"
                                        :stroke-dashoffset="circumference - progress / 100 * circumference"
                                        :class="`tw-text-${brand} tw-transition-all tw-duration-700`" />
                            </svg>
                            <div class="tw-absolute tw-text-center">
                                <img class="tw-h-14" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" />
                                <div class="tw-text-[13px] tw-font-bold">Day 2 Unlocks In</div>
                                <div class="tw-font-bond tw-font-bebas-neue tw-text-6xl">22:12</div>
                            </div>
                        </div>
                    </div>
                    <div class="tw-flex tw-justify-center tw-gap-2 tw-text-[13px] tw-w-full tw-px-3 tw-relative tw-z-20">
                        <!-- Streak -->
                        <div class="tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-pr-2 -tw-pl-2 tw-flex tw-items-center tw-relative">
                            <!-- Bubble speech -->
                            <div class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showLabelAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">Nice!</div>
                            <!-- Streak Lottie -->
                            <Vue3Lottie animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" width="40px" />
                            <!-- Streak Text -->
                            <div>
                                <div class="tw-font-extrabold">1</div>
                                <div class="tw-flex tw-items-center">
                                    Day Streak
                                    <musora-icon icon-name="info" class="tw-ml-2 tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]" @click="updateInfoModalType('streak')"></musora-icon>
                                </div>
                            </div>
                        </div>
                        <!-- Rest Days -->
                        <div class="tw-rounded-[10px] tw-border tw-border-primary-6 tw-p-2 tw-flex tw-items-center tw-relative">
                            <!-- Bubble speech -->
                            <div class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700" :class="showLabelAnimation ? '-tw-top-3' : 'tw-opacity-0 tw-top-2'">+1</div>
                            <!-- Rest Icon -->
                            <img class="tw-mr-3 tw-w-4 tw-hidden dark:tw-block" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" />
                            <img class="tw-mr-3 tw-w-4 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon_light.svg" />
                            <!-- Rest Text -->
                            <div>
                                <div class="tw-font-extrabold">2</div>
                                <div class="tw-flex tw-items-center">
                                    Rest Days
                                    <musora-icon icon-name="info" class="tw-ml-2 tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]" @click="updateInfoModalType('rest')"></musora-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-flex tw-justify-center tw-w-full">
                    <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white tw-px-10">Finish Day 1</MuButton>
                </div>
            </div>

            <Vue3Lottie v-if="showFinishAnimation" class="tw-absolute tw-w-full tw-h-full tw-top-1/2 tw-left-1/2 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-z-10 tw-object-cover tw-bg-cover" animation-link="https://lottie.host/c0f917ca-73c4-4b4c-8d2e-53a415d7ae09/jrNUPzGgwb.json" width="100%" height="100%" />
        </div>

        <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-flex tw-justify-center tw-items-center tw-transition-all tw-duration-700" :class="showAchievement ? 'tw-opacity-1 tw-z-10' : 'tw-opacity-0 tw-z-0'">
            <ChallengeAchievementModal @open-streak-info="updateInfoModalType('streak')" @open-award-modal="openAwardModal"  />
        </div>

        <div class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-flex tw-justify-center tw-items-center tw-transition-all tw-duration-700" :class="showAward ? 'tw-opacity-1 tw-z-10' : 'tw-opacity-0 tw-z-0'">
            <ChallengeAwardModal v-if="showAward" :is-modal="false" />
        </div>
    </ModalRenderer>

    <!-- Info Modal -->
    <ChallengeInfoModal v-if="infoModalType" :type="infoModalType" :container-stay-on-close="true" @close-modal="updateInfoModalType('')" />

</template>
<script setup>
import { computed, onMounted, ref } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { Vue3Lottie } from 'vue3-lottie';
import { completionAnimations } from '@pages/Challenges/completionAnimations';

import ModalRenderer from '@collections/Modal/ModalRenderer';
import MuButton from '@units/Button/MuButton';
import ChallengeInfoModal from '@collections/Modal/ChallengeInfoModal';
import ChallengeAchievementModal from '@collections/Modal/ChallengeAchievementModal';
import ChallengeAwardModal from '@collections/Modal/ChallengeAwardModal';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const progress = ref(0);
const infoModalType = ref('');
const showFinishAnimation = ref(false);
const showLabelAnimation = ref(false);
const showAchievement = ref(false);
const showAward = ref(false);
const hideAnimation = ref(false);

const hasProgress = computed(() => {
    return progress.value > 0;
});

const circumference = 2 * 22 / 7 * 120;

const updateInfoModalType = (type) => {
    infoModalType.value = type;
}

const openAwardModal = () => {
    showAchievement.value = false;
    showAward.value = true;
}

onMounted(() => {
    setTimeout(() => {
        progress.value = 40;
        showLabelAnimation.value = true;
    }, 2000)

    setTimeout(() => {
        showAchievement.value = true;
    }, 7000)

    // setTimeout(() => {
    //     hideAnimation.value = true;
    // }, completionAnimations[15].duration)

    setTimeout(() => {
        hideAnimation.value = true;
    }, 7000)
})
</script>
