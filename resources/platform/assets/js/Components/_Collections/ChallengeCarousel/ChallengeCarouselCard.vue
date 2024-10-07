<template>
    <!-- Large Desktop -->
    <div class="tw-hidden xl:tw-flex tw-justify-between tw-border tw-border-[#E0E0E1] dark:tw-border-[#081825] tw-rounded-[10px] tw-bg-white dark:tw-bg-[linear-gradient(90deg,_#131A27_0%,_#182132_100%)] tw-px-6 2xl:tw-px-12 tw-pb-5 tw-relative tw-my-5 dark:tw-text-white">
        <!-- Ellipsis -->
        <div class="tw-absolute tw-top-1.5 2xl:tw-top-[15px] tw-right-1.5 2xl:tw-right-[15px]">
            <div class="tw-relative">
                <button class="tw-border-2 tw-border-primary-6 tw-w-[33px] tw-h-[33px] tw-flex tw-justify-center tw-items-center tw-rounded-full" @click="showDropdown = !showDropdown" v-click-outside="closeDropdown">
                    <i class="fa-solid fa-ellipsis tw-mt-0.5"></i>
                </button>
                <!-- Dropdown -->
                <ul v-if="showDropdown" class="tw-absolute tw-top-[100%+8px] tw-right-0 tw-bg-white dark:tw-bg-[#081825] dark:tw-white tw-z-10 tw-rounded-[5px] tw-shrink-0 tw-text-sm tw-whitespace-nowrap tw-drop-shadow-lg">
                    <li class="tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"><button>Change Start Date</button></li>
                    <li class="tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"><button>Leave 30-Day Drummer</button></li>
                </ul>
            </div>
        </div>

        <!-- Left -->
        <div class="tw-shrink-0 tw-mr-4 2xl:tw-mr-0 2xl:tw-flex-1 tw-flex tw-flex-col tw-justify-center tw-items-start">
            <!-- Challenge Logo -->
            <img class="tw-h-[70px] 2xl:tw-h-24 tw-mb-2" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" />
            <div class="tw-font-bold tw-text-xs 2xl:tw-text-sm tw-mb-5">Day 2 Unlocks In 22:12</div>
            <MuButton class="tw-px-6"><musora-icon class="tw-w-[20px] tw-mr-2 -tw-scale-x-100" icon-name="reset" />Repeat day 25</MuButton>
        </div>
        <!-- Right -->
        <div class="tw-max-w-[300px] 2xl:tw-max-w-none tw-grow 2xl:tw-flex-1 tw-relative tw-pb-5">
            <!-- Musora Logo -->
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 tw-hidden dark:tw-block" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" />
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora-light.png" />
            <div class="3xl:tw-pl-6 tw-relative tw-pt-7">
                <div class="tw-mx-5 tw-rounded-[10px] tw-overflow-hidden tw-aspect-square 3xl:tw-aspect-video tw-mb-5 tw-relative">
                    <!-- Thumbnail (Video ratio) -->
                    <img class="tw-w-full tw-hidden 3xl:tw-block" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d1923uyy6spedc.cloudfront.net/s02-2-1675375801.jpg" />
                    <!-- Thumbnail (Square ratio) -->
                    <img class="tw-w-full 3xl:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/learning-paths/30DDSquare.png" />
                    <!-- Overlay -->
                    <div class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-black/60 tw-flex tw-flex-col tw-justify-center tw-items-center">
                        <i class="fa-solid fa-lock tw-mb-2 tw-text-3xl tw-text-white"></i>
                    </div>
                </div>
                <div class="tw-flex tw-gap-2 tw-text-[11px] 3xl:tw-text-[13px] tw-relative tw-z-20">
                    <!-- Streak -->
                    <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 4xl:tw-pl-3 tw-pr-1 4xl:tw-pr-4 tw-flex tw-items-center tw-relative">
                        <Vue3Lottie class="tw-w-10 3xl:tw-w-[46px] -tw-ml-1 -tw-mr-1 3xl:tw-mr-0" animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                        <div class="tw-flex-grow">
                            <div class="tw-font-extrabold">1</div>
                            <div class="tw-flex tw-items-center tw-justify-between">
                                Day Streak
                                <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#9EC0DC]"></musora-icon>
                            </div>
                        </div>
                    </div>
                    <!-- Rest Days -->
                    <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-1 tw-px-2 4xl:tw-px-4 tw-flex tw-items-center tw-relative">
                        <img class="tw-mr-3 tw-w-4 lg:tw-w-5 tw-hidden dark:tw-block" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" />
                        <img class="tw-mr-3 tw-w-4 lg:tw-w-5 dark:tw-hidden" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon_light.svg" />
                        <div class="tw-flex-grow">
                            <div class="tw-font-extrabold">2</div>
                            <div class="tw-flex tw-items-center tw-justify-between">
                                Rest Days
                                <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#9EC0DC]"></musora-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="tw-absolute tw-left-0 tw-bottom-0 tw-w-full tw-h-5 tw-bg-[#223F57]">
            <div :class="`tw-absolute tw-left-0 tw-top-0 tw-h-5 tw-transition-all tw-duration-700 tw-bg-${brand} tw-flex tw-justify-end tw-items-center tw-text-[#E3E3E3] tw-text-[11px] tw-font-bold`" :style="`width:40%`">40%</div>
        </div>
    </div>

    <!-- SM Desktop / Tablet /Mobile -->
    <div class="xl:tw-hidden tw-rounded-[10px] tw-bg-[#182132] tw-w-[270px] lg:tw-w-auto tw-shrink-0 tw-py-3 tw-px-2 tw-relative tw-overflow-hidden dark:tw-text-white">
        <div class="tw-absolute tw-top-3 tw-right-3 tw-z-10">
            <div class="tw-relative">
                <!-- Ellipsis -->
                <button class="tw-border-2 tw-border-primary-6 tw-w-[25px] tw-h-[25px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-z-[6]" @click="showDropdown = !showDropdown">
                    <i class="fa-solid fa-ellipsis tw-mt-0.5"></i>
                </button>
                <!-- Dropdown -->
                <ul v-if="showDropdown" class="tw-absolute tw-top-[100%+8px] tw-right-0 tw-bg-white dark:tw-bg-[#081825] dark:tw-white tw-z-10 tw-rounded-[5px] tw-shrink-0 tw-text-sm tw-whitespace-nowrap tw-drop-shadow-lg">
                    <li class="tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"><button>Change Start Date</button></li>
                    <li class="tw-py-2 tw-px-4 dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"><button>Leave 30-Day Drummer</button></li>
                </ul>
            </div>
        </div>

        <div class="tw-relative tw-w-full tw-mb-3">
            <!-- Musora Logo -->
            <img class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-z-0" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/musora.png" />
            <div class="tw-flex tw-justify-center tw-items-center tw-relative tw-z-[5]">
                <svg class="tw-transform -tw-rotate-90 tw-w-[216px] tw-h-[216px]">
                    <circle cx="108" cy="108" r="98" stroke="currentColor" stroke-width="20" fill="transparent"
                            class="tw-text-[#112E4A] tw-drop-shadow-md" />
                    <circle cx="108" cy="108" r="98" stroke="currentColor" stroke-width="20" fill="transparent"
                            :stroke-dasharray="circumference"
                            :stroke-dashoffset="circumference - 40 / 100 * circumference"
                            :class="`tw-text-${brand} tw-transition-all tw-duration-700`" />
                </svg>
                <div class="tw-absolute tw-text-center">
                    <img class="tw-h-14 tw-mb-1" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" />
                    <div class="tw-text-[11px] tw-font-bold">Day 2 Unlocked!</div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-justify-center tw-gap-2 tw-text-[11px] tw-w-full tw-px-2 tw-relative tw-mb-3">
            <!-- Streak -->
            <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-pr-1 -tw-pl-2 tw-flex tw-items-center tw-relative">
                <!-- Streak Lottie -->
                <Vue3Lottie animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" width="30px" />
                <!-- Streak Text -->
                <div class="tw-grow -tw-ml-1">
                    <div class="tw-font-extrabold">1</div>
                    <div class="tw-flex tw-items-center tw-justify-between">
                        Day Streak
                        <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                    </div>
                </div>
            </div>
            <!-- Rest Days -->
            <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-primary-6 tw-py-2 tw-px-1 tw-flex tw-items-center tw-relative">
                <!-- Rest Icon -->
                <img class="tw-mr-2 tw-w-3" src="https://www.musora.com/musora-cdn/image/width=30,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/challenge-completion-modal/rest_icon.svg" />
                <!-- Rest Text -->
                <div class="tw-grow">
                    <div class="tw-font-extrabold">2</div>
                    <div class="tw-flex tw-items-center tw-justify-between">
                        Rest Days
                        <musora-icon icon-name="info" class="tw-w-4 tw-h-4 tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-flex-col tw-w-full tw-px-2">
            <MuButton variant="custom" class="tw-bg-white tw-text-[#00101D] hover:tw-bg-[#223F57] hover:tw-text-white"><i class="fa-solid fa-play tw-mr-2 tw-mt-1"></i> Start Day 2</MuButton>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { Vue3Lottie } from 'vue3-lottie';
import MuButton from '@units/Button/MuButton';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const showDropdown = ref(false);

const circumference = 2 * 22 / 7 * 108;

const closeDropdown = () => {
    showDropdown.value = false;
}
</script>
