<template>
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <a :href="`/${brand}/challenges`"
                       class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Challenges</h2>
                        <ChevronRightIcon class="tw-w-5" />
                    </a>
                    <slot name="label"></slot>
                </div>
                <div class="tw-flex tw-items-center">
                    <div class="tw-hidden lg:tw-flex">
                        <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57] tw-mr-[10px]" ><ChevronLeftIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
                        <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57]"><ChevronRightIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
                    </div>
                </div>
            </div>
            <div class="tw-flex tw-flex-nowrap tw-overflow-x-scroll tw-no-scrollbar lg:tw-grid tw-grid-cols-3 xl:tw-grid-cols-2 tw-gap-[6px] 2xl:tw-gap-[10px]">
                <ChallengeCarouselCard />
                <ChallengeCarouselCard />
                <ChallengeCarouselCard />
                <ChallengeCarouselCard />
                <ChallengeCarouselCard />
<!--                <ChallengeCarouselCard />-->
            </div>
        </div>
    </section>
</template>
<script setup>
import { useUserStore } from '@stores/user';
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import { storeToRefs } from "pinia/dist/pinia";
import ChallengeCarouselCard from '@collections/ChallengeCarousel/ChallengeCarouselCard';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>
