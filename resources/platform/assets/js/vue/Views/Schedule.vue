<template>
    <div class="tw-w-full tw-relative">
        <PageHeader pageType="schedule" :title="`${brand} Schedule`" iconName="calendar"
            :description="description" :ctas="ctaConfig" />

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
            <div class="tw-flex tw-flex-col tw-py-[30px]">
                <div id="scheduleHeader"
                    class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                    <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                        <h1
                            class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl md:tw-text-2xl">
                            Scheduled Releases
                        </h1>
                    </div>
                    <div class="tw-flex tw-flex-col">
                        <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white"
                            data-open-modal="scheduleAddToCalendarModal">
                            <i class="fas fa-calendar-plus tw-mr-2"></i>
                            Subscribe to Calendar
                        </button>
                    </div>
                </div>
                <div class="tw-flex tw-flex-row">
                    <ContentSchedule v-if="scheduleData" :preloaded-content="scheduleData"
                        :subscription-calendar-id="subscriptionCalendarId" :theme-color="brand" />
                    <span v-else>No scheduled releases</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { storeToRefs } from "pinia";
import { useUserStore } from "../../stores/user";
import ContentSchedule from '../vuesora/views/schedule/Schedule';
import PageHeader from '../components/PageHeader/PageHeader.vue';

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

// const isSelectedTimezone = (timezone) => {
//     const area = timezone.split(' - ')[0];
//     return area === props.selectedTimezone;
// }

const description = computed(() => {
    return `Practice sessions, Q&A, celebrations, and more are available during <span class="tw-capitalize">${brand.value}</span> live lessons. Subscribe to an event or the whole calendar, so you don't miss out!`
})

const ctaConfig = computed(() => {
    return [
        {
            type: 'TimezoneSelectCta',
            props: {
                'timezones': props.timezones,
                'fullTimezoneString': props.selectedTimezone
            }
        },
    ];
});
</script>

<style scoped media="print">
#nav,
#subNav {
    display: none;
}

#pageHeader {
    display: none;
}

#scheduleHeader {
    display: none;
    border: none;
}

#printSchedule {
    display: none;
}

footer {
    display: none !important;
}

.shadow {
    box-shadow: none !important;
    border: 1px solid #e5e8e8;
}

.content-table-row.scheduled .month-col {
    flex: 0 0 100%;
    max-width: 100%;
}

.content-table-row.scheduled .icon-col {
    display: none;
}

.content-table-row.scheduled .title-column p {
    color: #000 !important;
}

.content-table-row.scheduled .title-column .hide-md-up {
    display: none;
}

.header-gradient-overlay {
    background: linear-gradient(180deg, rgba(0, 16, 29, 0.01) 68.57%, #00101D 100%);
}

.header-gradient-overlay.drumeo {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(9, 92, 170, 0.7) 100%);
}

.header-gradient-overlay.pianote {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(213, 8, 29, 0.7) 100%);
}

.header-gradient-overlay.guitareo {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(0, 150, 128, 0.7) 100%);
}

.header-gradient-overlay.singeo {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 45%, rgba(102, 0, 182, 0.7) 100%);
}
</style>
