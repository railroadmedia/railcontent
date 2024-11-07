<template>
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <a :href="accountUrl"
                        class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        <h2 class="tw-font-bold tw-text-[20px] tw-leading-[30px] lg:tw-leading-[36px] lg:tw-text-[24px]">Dashboard
                        </h2>
                        <ChevronRightIcon class="tw-w-5" />
                    </a>
                </div>
            </div>
            <div class="tw-flex tw-gap-[10px]">
                <DashboardCard :topText="`${xpEarned} XP`" :bottomText="userLevelTitle" variant="trophy"
                    :brand="brand" />
                <DashboardCard :topText="`${minutesPracticed} MIN`" bottomText="Practiced" variant="timer"
                    :brand="brand" />
            </div>
        </div>
    </section>
</template>

<script setup>
import DashboardCard from "./DashboardCard.vue";
import { ChevronRightIcon } from "@heroicons/vue/outline";

const props = defineProps({
    xpEarned: {
        type: Number,
        required: true
    },
    minutesPracticed: {
        type: Number,
        required: true
    },
    userLevelTitle: {
        type: String,
        required: true
    },
    accountUrl: {
        type: String,
        required: true
    },
});
</script>