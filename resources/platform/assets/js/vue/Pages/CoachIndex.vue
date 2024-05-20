<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <!-- Breadcrumb -->
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <!-- Page Header -->
        <PageHeader
            title="Coaches"
            icon-name="whistle"
            :description="headerDescription"
        />
        <!-- Coach Event -->
        <div v-if="hasCoachEvent" class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-4">
            <CoachEvent
                :preloaded-content="coachEvent"
                :current-date-string="currentDateString"
                :subscription-calendar-id="subscriptionCalendarId"
                :youtube-event-id="youtubeEventId"
                :time-cutoff-minutes="timeCutoffMinutes"
            />
        </div>
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <!-- Featured Coach -->
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import PageHeader from '../components/PageHeader/PageHeader';
import CoachEvent from "../vuesora/components/Coaches/CoachEvent";


const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    coachEvent: {
        type: Object,
        default: () => ({}),
    },
    currentDateString: {
        type: String,
        default: () => "",
    },
    headerDescription: {
        type: String,
        default: '',
    },
    subscriptionCalendarId: {
        type: String,
        default: () => "",
    },
    timeCutoffMinutes: {
        type: Number,
        default: () => 0,
    },
    trackingSection: {
        type: String,
        default: () => "",
    },
    youtubeEventId: {
        type: String,
        default: () => "",
    },
})

const hasCoachEvent = computed(() => {
    return Object.keys(props.coachEvent).length > 0;
})
</script>
