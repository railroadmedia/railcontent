<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <Breadcrumb :breadcrumbs="breadcrumbs"/>
        <PageHeader
            :page-type="headerPageType"
            :icon-name="headerIconName"
            :title="headerTitle"
            :ctas="headerCtas"
            :description="`Practice sessions, Q&A, celebrations, and more are available during ${brand} live lessons. Subscribe to an event or the whole calendar, so you don't miss out!`"
        />

        <div class="tw-flex tw-flex-col mv-3">
            <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl md:tw-text-2xl">
                        Upcoming Live Events
                    </h1>
                </div>
                <div class="tw-flex tw-flex-col">
                    <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white" data-open-modal="scheduleAddToCalendarModal">
                        <i class="fas fa-calendar-plus mr-1"></i>
                        Subscribe to Calendar
                    </button>
                </div>
            </div>
            <div class="tw-flex tw-flex-row">
                <ContentSchedule
                    v-if="hasScheduleEvents"
                    :preloaded-content="scheduleEvents"
                    :timezone="timezone"
                    :subscription-calendar-id="subscriptionCalendarId"
                />
                <span v-else class="dark:tw-text-white">No upcoming live events</span>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader';
import ContentSchedule from '@vuesora/views/schedule/Schedule';
import { computed } from "vue";

const props = defineProps({
    headerPageType: {
        type: String,
        default: '',
    },
    headerIconName: {
        type: String,
        default: '',
    },
    headerTitle: {
        type: String,
        default: '',
    },
    headerCtas: {
        type: Array,
        default: () => [],
    },
    scheduleEvents: {
        type: Array,
        default: [],
    },
    subscriptionCalendarId: {
        type: String,
        default: '',
    },
    timezone: {
        type: String,
        default: '',
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const breadcrumbs = [
    {
        title: 'Live',
    }
];

const hasScheduleEvents = computed(() =>{
    return props.scheduleEvents.length > 0;
});
</script>
