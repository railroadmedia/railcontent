<template>
    <!-- Large Desktop -->
    <div class="tw-hidden xl:tw-flex tw-gap-2 3xl:tw-gap-0 tw-justify-between tw-border tw-border-[#E0E0E1] dark:tw-border-[#081825] tw-rounded-[10px] tw-bg-white dark:tw-bg-[linear-gradient(90deg,_#131A27_0%,_#182132_100%)] tw-px-4 2xl:tw-px-12 tw-pb-5 tw-relative dark:tw-text-white tw-overflow-hidden tw-h-[295px] 4xl:tw-h-[330px]">
        <!-- Ellipsis -->
        <div class="tw-absolute tw-top-1.5 2xl:tw-top-[10px] tw-right-1.5 2xl:tw-right-[10px] 3xl:tw-right-6">
            <div class="tw-relative">
                <button class="tw-border tw-border-primary-6 tw-w-[33px] tw-h-[33px] tw-flex tw-justify-center tw-items-center tw-rounded-full" @click="desktopShowDropdown = !desktopShowDropdown" v-click-outside="closeDesktopDropdown">
                    <i class="fa-solid fa-ellipsis tw-mt-0.5"></i>
                </button>
                <!-- Dropdown -->
                <ul v-if="desktopShowDropdown" class="tw-absolute tw-top-[100%+8px] tw-right-0 tw-bg-white dark:tw-bg-[#081825] dark:tw-text-white tw-z-10 tw-rounded-[5px] tw-shrink-0 tw-text-sm tw-whitespace-nowrap tw-drop-shadow-lg tw-py-2">
                    <li><a :href="challenge.web_url_path" class="tw-text-black dark:tw-text-white tw-text-sm tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-block tw-w-full tw-text-left">View Details</a></li>
                    <li v-if="isSoloChallenge && progressPercent === 0"><button @click="openNotificationModal" class="tw-text-sm tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-w-full tw-text-left">Change Start Date</button></li>
                    <li><button class="tw-text-sm tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]" @click="openLeaveModal">Leave {{ challengeTitle }}</button></li>
                </ul>
            </div>
        </div>

        <!-- Left -->
        <div class="2xl:tw-flex-1 tw-flex tw-flex-col tw-justify-center tw-items-start">
            <!-- Challenge Logo -->
            <img class="lg:tw-max-w-[180px] 4xl:tw-max-w-[300px] lg:tw-max-h-[80px] 4xl:tw-max-h-[110px] tw-mb-3 dark:tw-hidden" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${challenge.light_mode_logo_url}`" :alt="`${challengeTitle} light mode logo`" />
            <img class="lg:tw-max-w-[180px] 4xl:tw-max-w-[300px] lg:tw-max-h-[80px] 4xl:tw-max-h-[110px] tw-mb-3 tw-hidden dark:tw-block" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${challenge.dark_mode_logo_url}`" :alt="`${challengeTitle} dark mode logo`" />
            <div v-if="actionText" class="tw-font-bold tw-text-xs 2xl:tw-text-sm tw-mb-5" :class="hasMissedLessons ? 'tw-text-[#F61A30]' : ''">{{ actionText }}</div>
            <MuButton :is-link="ctaObj?.url !== undefined" :href="ctaObj?.url" class="tw-shrink-0 tw-text-sm 2xl:tw-text-base">
                <i :class="`${ctaObj?.icon} ${ctaObj.iconLocation === 'left' ? 'tw-mr-2' : 'tw-order-1 tw-ml-2'}`"></i>
                {{ ctaObj?.text }}
            </MuButton>
        </div>
        <!-- Right -->
        <div class="2xl:tw-flex-1 tw-relative tw-flex tw-items-center tw-justify-center 3xl:tw-justify-end tw-mr-5 3xl:tw-mr-5 4xl:tw-mr-8">
            <!-- Musora Logo -->
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" />
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" />
            <div class="tw-relative">
                <div class="tw-rounded-[10px] tw-overflow-hidden tw-mb-5 tw-relative tw-aspect-video tw-w-[220px] 2xl:tw-w-[270px] 3xl:tw-w-[300px] 4xl:tw-w-[360px]">
                    <!-- Thumbnail (Video ratio) -->
                    <img class="tw-object-cover tw-object-top" :src="`https://www.musora.com/cdn-cgi/image/width=500,quality=95/${challengeThumbnail}`" />
                    <!-- Thumbnail (Square ratio) -->
                    <!-- Lock Overlay -->
                    <div v-if="hasChallengeStarted && isNextLessonLocked" class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-black/60 tw-flex tw-flex-col tw-justify-center tw-items-center">
                        <i class="fa-solid fa-lock tw-mb-2 tw-text-3xl tw-text-white"></i>
                    </div>
                </div>
                <div class="tw-flex tw-gap-2 tw-text-[11px] 3xl:tw-text-[13px] tw-relative tw-z-20 tw-shrink-0">
                    <!-- Streak -->
                    <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-px-1.5 2xl:tw-px-2 3xl:tw-px-2.5 tw-flex tw-items-center tw-relative" @click="updateInfoModalType('streak')">
                        <div v-if="streak === 0" class="tw-text-[16px] 2xl:tw-text-[18px] 3xl:tw-text-[20px] 3xl:tw-my-[5px] tw-mr-1">🔥</div>
                        <Vue3Lottie v-else class="tw-w-[32px] 3xl:tw-w-[36px] -tw-ml-1.5 " animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                        <div class="tw-flex-grow">
                            <div class="tw-font-extrabold">{{ streak }}</div>
                            <div class="tw-flex tw-items-center tw-justify-between">
                                Day Streak
                                <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#9EC0DC] tw-hidden 2xl:tw-block"></musora-icon>
                            </div>
                        </div>
                    </div>
                    <!-- Rest Days -->
                    <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-px-1.5 2xl:tw-px-2 3xl:tw-px-2.5 tw-flex tw-items-center tw-relative" @click="updateInfoModalType('rest')">
                        <img class="tw-mr-2 2xl:tw-mr-3 tw-w-[13px] 2xl:tw-w-[14px] 3xl:tw-w-4 tw-hidden dark:tw-block" src="https://www.musora.com/cdn-cgi/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" />
                        <img class="tw-mr-2 2xl:tw-mr-3 tw-w-[13px] 2xl:tw-w-[14px] 3xl:tw-w-4 dark:tw-hidden" src="https://www.musora.com/cdn-cgi/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon_light.svg" />
                        <div class="tw-flex-grow">
                            <div class="tw-font-extrabold">{{ restDays }}</div>
                            <div class="tw-flex tw-items-center tw-justify-between">
                                Rest Days
                                <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#9EC0DC] tw-hidden 2xl:tw-block"></musora-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="tw-absolute tw-left-0 tw-bottom-0 tw-w-full tw-h-5 tw-bg-[#E0E0E1] dark:tw-bg-primary-6">
            <div class="tw-absolute tw-left-0 tw-top-0 tw-h-5 tw-flex tw-justify-end tw-items-center tw-text-[#E3E3E3] tw-text-[11px] tw-font-bold" :class="progressPercent > 0 ? `tw-bg-${brand}` : `tw-w-auto tw-pl-2`" :style="`width:${progressPercent}%`">{{ progressPercent }}%</div>
        </div>
    </div>

    <!-- SM Desktop / Tablet / Mobile -->
    <div class="xl:tw-hidden tw-rounded-[10px] tw-bg-white dark:tw-bg-[#182132] tw-w-[330px] tw-h-[430px] lg:tw-w-auto tw-shrink-0 tw-pt-4 tw-pb-5 tw-px-2 tw-relative tw-overflow-hidden dark:tw-text-white tw-border tw-border-primary-7">
        <div class="tw-absolute tw-top-3 tw-right-3 tw-z-10">
            <div class="tw-relative">
                <!-- Ellipsis -->
                <button class="tw-border-2 tw-border-primary-6 tw-w-[25px] tw-h-[25px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-z-[6]" @click="mobileShowDropdown = !mobileShowDropdown" v-click-outside="closeMobileDropdown">
                    <i class="fa-solid fa-ellipsis tw-mt-0.5"></i>
                </button>
                <!-- Dropdown -->
                <ul v-if="mobileShowDropdown" class="tw-absolute tw-top-[100%+8px] tw-right-0 tw-bg-white dark:tw-bg-[#081825] dark:tw-white tw-z-10 tw-rounded-[5px] tw-shrink-0 tw-text-sm tw-whitespace-nowrap tw-drop-shadow-lg">
                    <li v-if="isSoloChallenge" class="tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"><button @click="openNotificationModal">Change Start Date</button></li>
                    <li class="tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"><button @click="openLeaveModal">Leave {{ challengeTitle }}</button></li>
                </ul>
            </div>
        </div>

        <div class="tw-relative tw-w-full tw-mb-[18px]">
            <!-- Musora Logo -->
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" />
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/cdn-cgi/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" />
            <div class="tw-flex tw-justify-center tw-items-center tw-relative tw-z-[5]">
                <svg class="tw-transform -tw-rotate-90 tw-w-[260px] tw-h-[260px]">
                    <circle cx="129" cy="129" :r="radius" stroke="currentColor" stroke-width="20" fill="transparent"
                            class="tw-text-[#E0E0E1] dark:tw-text-[#112E4A] tw-drop-shadow-md" />
                    <circle cx="129" cy="129" :r="radius" stroke="currentColor" stroke-width="20" fill="transparent"
                            :stroke-dasharray="circumference"
                            :stroke-dashoffset="circumference - (progressPercent / 100) * circumference"
                            :class="`tw-text-${brand}`" />
                </svg>
                <div class="tw-absolute tw-text-center tw-flex tw-flex-col tw-items-center">
                    <!-- Challenge Logos -->
                    <img class="tw-h-14 tw-w-[155px] tw-object-contain tw-object-center tw-mb-1 tw-hidden dark:tw-block" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${challenge.dark_mode_logo_url}`" />
                    <img class="tw-h-14 tw-w-[155px] tw-object-contain tw-object-center tw-mb-1 dark:tw-hidden" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${challenge.light_mode_logo_url}`" />
                    <div class="tw-text-xs 2xl:tw-text-sm tw-font-bold tw-max-w-[160px] tw-mt-2" :class="hasMissedLessons ? 'tw-text-[#F61A30]' : ''">{{ actionText }}</div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-justify-center tw-gap-2 tw-text-sm lg:tw-text-[11px] tw-w-full tw-px-2 lg:tw-px-0 tw-relative tw-mb-[18px] tw-max-w-[320px] tw-mx-auto">
            <!-- Streak -->
            <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-px-2 tw-flex tw-items-center tw-relative" @click="updateInfoModalType('streak')">
                <div v-if="streak === 0" class="tw-text-[20px] tw-ml-1 tw-mr-2">🔥</div>
                <!-- Streak Lottie -->
                <Vue3Lottie v-else class="tw-w-[36px] tw-mr-1" animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                <!-- Streak Text -->
                <div class="tw-grow -tw-ml-1">
                    <div class="tw-font-extrabold">{{ streak }}</div>
                    <div class="tw-flex tw-items-center tw-justify-between tw-text-[11px]">
                        Day Streak
                        <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                    </div>
                </div>
            </div>
            <!-- Rest Days -->
            <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-px-2 tw-flex tw-items-center tw-relative" @click="updateInfoModalType('rest')">
                <!-- Rest Icon -->
                <img class="tw-mr-2 tw-w-4 tw-hidden dark:tw-block" src="https://www.musora.com/cdn-cgi/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" />
                <img class="tw-mr-2 tw-w-4 dark:tw-hidden" src="https://www.musora.com/cdn-cgi/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon_light.svg" />
                <!-- Rest Text -->
                <div class="tw-grow">
                    <div class="tw-font-extrabold">{{ restDays }}</div>
                    <div class="tw-flex tw-items-center tw-justify-between tw-text-[11px]">
                        Rest Days
                        <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-flex-col tw-w-full tw-px-2 tw-w-full tw-mx-auto">
            <MuButton :is-link="ctaObj?.url !== undefined" :href="ctaObj?.url" class="tw-text-sm">
                <i :class="`${ctaObj?.icon} ${ctaObj.iconLocation === 'left' ? 'tw-mr-2' : 'tw-order-1 tw-ml-2'}`"></i>
                {{ ctaObj?.text }}
            </MuButton>
        </div>
    </div>

    <ChallengeNotificationModal v-if="isNotificationModalOpen" challenge-type="solo" :default-step="2" @modal-close="closeNotificationModal" :challenge="challenge" :is-from-carousel="true" @on-re-fetch-data="reFetchData" />
    <ChallengeActionModal v-if="isLeaveModalOpen" modal-type="leave" @close-modal="closeLeaveModal" :challenge="challenge" @on-leave-challenge="id => emit('onRemoveChallenge', id)" />
    <ChallengeInfoModal v-if="infoModalType" :type="infoModalType" @close-modal="updateInfoModalType('')" />
</template>
<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { Vue3Lottie } from 'vue3-lottie';
import { countdown } from "@collections/ChallengeCarousel/countdown";
import { fetchCarouselCardData, fetchChallengeUserActiveChallenges } from 'musora-content-services';
import { getDateFromIso } from '../../../utils';

import MuButton from '@units/Button/MuButton';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";
import ChallengeNotificationModal from '@collections/Modal/ChallengeNotificationModal';
import ChallengeActionModal from '@collections/Modal/ChallengeActionModal';
import ChallengeInfoModal from '@collections/Modal/ChallengeInfoModal';

const props = defineProps({
    challenge: {
        type: Object,
        required: true
    },
    pageType: {
        type: String,
        default: '',
    },
})

const emit = defineEmits(['onRemoveChallenge', 'onReFetchCarousel'])

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const desktopShowDropdown = ref(false);
const mobileShowDropdown = ref(false);
const isNotificationModalOpen = ref(false);
const isLeaveModalOpen = ref(false);
const infoModalType = ref('');
const countdownString = ref('');

const radius = 118;
const circumference = 2 * Math.PI * radius;

const isSoloChallenge = computed(() => {
    return props.challenge.is_solo;
})

const hasChallengeStarted = computed(() => {
    const now = new Date();
    return new Date(props.challenge.start_date) <= now;
})

const challengeTitle = computed(() => {
    return props.challenge.title;
})

const startDate = computed(() => {
    return getDateFromIso(props.challenge.start_date);
})

const actionText = computed(() => {
    if(hasMissedLessons.value){
        return `You've missed ${missedLessons.value} lesson${missedLessons.value > 1 ? 's' : ''}.`;
    } else if(!hasChallengeStarted.value){
        return `You're enrolled! Lessons begin ${startDate.value}`;
    } else if(isNextLessonLocked.value){
        return `${nextLessonFullName.value} unlocks in ${countdownString.value}`;
    } else {
        return `${nextLessonFullName.value} Unlocked!`;
    }
})

const showSquareThumbnail = computed(() => {
    return !hasChallengeStarted.value && isNextLessonLocked.value;
})

const challengeThumbnail = computed(() => {
    if(!hasChallengeStarted.value && isNextLessonLocked.value){
        return props.challenge.wideImg;
    } else {
        return props.challenge.next_lesson.thumbnail;
    }
})

const isNextLessonLocked = computed(() => {
    return props.challenge.next_lesson.is_locked && countdownString.value !== '00:00';
})

const nextLessonFullName = computed(() => {
    return props.challenge.next_lesson.title;
})

const nextLessonShortName = computed(() => {
    return props.challenge.next_lesson.short_name;
})

const streak = computed(() => {
    return props.challenge.current_streak;
})

const restDays = computed(() => {
    return props.challenge.rest_days;
})

const progressPercent = computed(() => {
    return props.challenge.progress_percent;
})

const hasMissedLessons = computed(() => {
    return props.challenge.missed_lessons > 0;
})

const missedLessons = computed(() => {
    return props.challenge.missed_lessons;
})

const ctaObj = computed(() => {
    const obj = {};

    if(isNextLessonLocked.value){
        if(!hasChallengeStarted.value){
            obj.text = 'View Challenge';
            obj.url = props.challenge.web_url_path;
            obj.icon = 'fa-solid fa-arrow-right-long';
             obj.iconLocation = 'right';
        } else {
            obj.text = `Repeat ${props.challenge.previous_completed_lesson?.short_name}`;
            obj.url = props.challenge.previous_completed_lesson?.web_url_path;
            obj.icon = 'fas fas fa-redo-alt';
            obj.iconLocation = 'left';
        }
    } else {
        obj.text = `Start ${nextLessonShortName.value}`;
        obj.url = props.challenge.next_lesson.web_url_path;
        obj.icon = 'fas fa-play tw-mt-0.5';
        obj.iconLocation = 'left';
    }

    return obj;
})

const reFetchData = async () => {
    let data;

    if(props.pageType === 'home' || props.pageType === 'challenge-carousel'){
        data = await fetchCarouselCardData(brand.value);

        if(props.pageType === 'challenge-carousel') {
            data = data.filter(challenge => !challenge.show_everywhere);
        }
    } else if(props.pageType === 'dashboard') {
        data = await fetchChallengeUserActiveChallenges(brand.value)
    }

    emit('onReFetchCarousel', data);
    closeNotificationModal();
}

const openNotificationModal = () => {
    isNotificationModalOpen.value = true;
}

const closeNotificationModal = () => {
    isNotificationModalOpen.value = false;
}

const openLeaveModal = () => {
    isLeaveModalOpen.value = true;
}

const closeLeaveModal = () => {
    isLeaveModalOpen.value = false;
}

const updateInfoModalType = (type) => {
    infoModalType.value = type;
}

const closeDesktopDropdown = () => {
    desktopShowDropdown.value = false;
}

const closeMobileDropdown = () => {
    mobileShowDropdown.value = false;
}

const runCountDown = (stop = false) => {
    const intervalCountdown = setInterval(() => {
        // remove UTC iso part of the string. It's already in the users timezone from the BE
        const count = countdown(props.challenge.next_lesson?.unlock_date.substring(0, 19));
        countdownString.value = count;

        if(count === '00:00:00'){
            clearInterval(intervalCountdown);
        }
    }, 1000)

    if(stop){
        clearInterval(intervalCountdown);
    }
}

onMounted(() => {
    if(isNextLessonLocked.value){
        runCountDown();
    }
})

onUnmounted(() => {
    if(isNextLessonLocked.value){
        runCountDown(true);
    }
})

watch(
    () => isNextLessonLocked.value,
    (value) => {
        if(value){
            runCountDown();
        } else {
            runCountDown(true);
        }
    },
)
</script>
