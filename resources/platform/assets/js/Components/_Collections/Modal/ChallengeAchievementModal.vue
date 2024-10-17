<template>
    <div class="tw-text-white tw-max-w-[440px] sm:tw-max-w-none tw-w-full sm:tw-w-auto tw-mx-2 sm:tw-mx-0">
        <h1 class="tw-mb-5 tw-text-2xl tw-font-bold tw-text-center">You've earned a special achievement!</h1>
        <div class="tw-rounded-[10px] tw-bg-[linear-gradient(90deg,_#131A27_0%,_#182132_100%)] tw-max-w-[440px] tw-w-full tw-px-2 sm:tw-px-12 tw-pt-[30px] tw-pb-5 tw-border tw-border-[#081825] tw-mb-5">
            <div class="tw-px-3 sm:tw-px-5 tw-mb-4">
                <div class="tw-w-full tw-aspect-square tw-rounded-full tw-overflow-hidden">
                    <Vue3Lottie animation-link="https://lottie.host/4ef1a405-db20-4e7c-b185-7800035f75af/kx4RO1kh30.json" width="100%" height="100%" speed="1.5" />
                </div>
            </div>
            <div class="tw-flex tw-gap-2 tw-text-xs sm:tw-text-sm tw-relative tw-z-20">
                <!-- Streak -->
                <div class="tw-flex-1 tw-rounded-[10px] tw-border tw-border-[#223F57] tw-py-1 tw-pr-1 tw-flex tw-items-center tw-relative">
                    <!-- Bubble speech -->
                    <div class="tw-absolute tw-right-0 tw-bg-[#E1EFFE] tw-rounded-[6px] tw-text-[#1E429F] tw-text-sm tw-px-2 tw-py-0.5 tw-font-semibold tw-transition-all tw-duration-700 -tw-top-3">Best!</div>
                    <Vue3Lottie class="tw-w-11 lg:tw-w-[46px] tw-ml-0 sm:tw-ml-1 tw-mr-0" animation-link="https://lottie.host/1503ac2e-09ae-4d87-a05f-957100264a9a/DQZRjOcsRN.json" />
                    <div class="tw-flex-grow">
                        <div class="tw-font-extrabold tw-text-base">1</div>
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
                        <div class="tw-font-extrabold tw-text-base">123 mins</div>
                        <div class="tw-flex tw-items-center tw-justify-between -tw-mt-0.5">
                            Practiced
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-justify-center">
            <MuButton @click="$emit('openAwardModal')">
                <svg class="tw-mr-2 -tw-mt-1" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 7.83333V19.75M11 7.83333C11 7.83333 11 6.46495 11 6C11 4.98748 11.8208 4.16667 12.8333 4.16667C13.8459 4.16667 14.6667 4.98748 14.6667 6C14.6667 7.01252 13.8459 7.83333 12.8333 7.83333C12.2858 7.83333 11 7.83333 11 7.83333ZM11 7.83333C11 7.83333 11 6.05767 11 5.54167C11 4.27601 9.97399 3.25 8.70833 3.25C7.44268 3.25 6.41667 4.27601 6.41667 5.54167C6.41667 6.80732 7.44268 7.83333 8.70833 7.83333C9.45798 7.83333 11 7.83333 11 7.83333ZM4.58333 11.5H17.4167M4.58333 11.5C3.57081 11.5 2.75 10.6792 2.75 9.66667C2.75 8.65414 3.57081 7.83333 4.58333 7.83333H17.4167C18.4292 7.83333 19.25 8.65414 19.25 9.66667C19.25 10.6792 18.4292 11.5 17.4167 11.5M4.58333 11.5L4.58333 17.9167C4.58333 18.9292 5.40414 19.75 6.41667 19.75H15.5833C16.5959 19.75 17.4167 18.9292 17.4167 17.9167V11.5" stroke="#00101D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Claim award
            </MuButton>
        </div>
    </div>
</template>
<script setup>
import { Vue3Lottie } from 'vue3-lottie';
import MuButton from '@units/Button/MuButton';
</script>
