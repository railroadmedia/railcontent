<template>
    <!-- Header -->
    <div class="tw-w-full fluid collapsed-h tw-py-8 md:tw-py-11 relative tw-bg-black">
    <!-- Background Image -->
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
            <img :src="`https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/headers/${brand}-header.jpg`"
                 class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
                 onload="this.classList.remove('tw-opacity-0')"
            >
        </div>
        <!-- Background Gradient -->
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
        <div :class="`header-gradient-overlay absolute-fill ${brand}`"></div>
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-relative">
            <div class="tw-flex tw-flex-row">
                <div class="tw-flex tw-flex-col tw-pr-1">
                    <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                        <musora-icon icon-name="calendar-filled" :class="`tw-w-[36px] tw-mr-2 tw-text-${brand}`"></musora-icon>
                        <span class="tw-text-32 tw-font-bold tw-capitalize">{{ brand }} Schedule</span>
                    </h1>

                    <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                        Practice sessions, Q&A, celebrations, and more are available during <span class="tw-capitalize">{{ brand }}</span> live lessons. Subscribe to an event or the whole calendar, so you don’t miss out!
                    </p>

                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex tw-flex-col xs-12 sm-4">
                            <label id="timezoneLabel" for="timezoneSelector" class="flex-auto body tw-cursor-pointer tw-w-fit">
                                <button class="tw-btn-secondary tw-text-white">
                                    <i class="fas fa-globe mr-1"></i>
                                    Change Your Timezone
                                </button>
                                <select name="timezone" id="timezoneSelector">
                                    <option v-for="timezone in timezones" class="tw-text-[#00101D]" :selected="isSelectedTimezone(timezone)">
                                        {{ timezone }}
                                    </option>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col mv-3">
            <div id="scheduleHeader" class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2">
                        Scheduled Releases
                    </h1>
                </div>
                <div class="tw-flex tw-flex-col">
                    <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white"
                            data-open-modal="scheduleAddToCalendarModal"
                    >
                        <i class="fas fa-calendar-plus tw-mr-2"></i>
                        Subscribe to Calendar
                    </button>
                </div>
            </div>
            <div class="tw-flex tw-flex-row">
                <ContentSchedule
                    v-if="scheduleData"
                    :preloaded-content="scheduleData"
                    :subscription-calendar-id="subscriptionCalendarId"
                    :theme-color="brand"
                />
                <span v-else>No scheduled releases</span>
            </div>
        </div>

        <div id="printSchedule" class="flex-center tw-mb-6">
            <button class="btn collapse-200" onclick="window.print();">
                <span :class="`tw-bg-${brand} short tw-text-white`">
                    <i class="fas fa-print tw-mr-1"></i>
                    Print Schedule
                </span>
            </button>
        </div>
    </div>
</template>

<script setup>
import {storeToRefs} from "pinia/dist/pinia";
import { useUserStore } from "../../stores/user";
import ContentSchedule from '../vuesora/views/schedule/Schedule';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    timezones: {
        type: Array,
        default: () => [],
    },
    selectedTimezone: {
        type: String,
        default: () => '',
    },
    scheduleData: {
        type: Array,
        default: () => [],
    },
    subscriptionCalendarId: {
        type: String,
        default: () => '',
    },
})

const isSelectedTimezone = (timezone) => {
    const area = timezone.split(' - ')[0];
    return area === props.selectedTimezone;
}
</script>
