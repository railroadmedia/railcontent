<template>
    <div class=" tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <!-- Breadcrumb -->
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <!-- Page Header -->
        <PageHeader
            :page-type="headerType"
            :title="fullName"
            :hero-img="headerHeroImg"
            :info-data="headerInfoData"
            :ctas="headerCtas"
            :description="headerDescription"
        />
    </div>

    <!-- Live Banner -->
    <div v-if="hasCoachEvent" class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-4">
        <CoachEvent
            :preloaded-content='coachEvent'
            :current-date-string="coachEventCurrentDateString"
            :subscription-calendar-id="coachEventSubscriptionCalendarId"
            :youtube-event-id="coachEventYoutubeEventId"
            :time-cutoff-minutes="coachEventTimeCutoffMinutes"
            :event-coach-profile-url="eventCoachProfileUrl"
        />
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mt-[30px] tw-mb-3">
        <collection-wrapper
            :limit="collectionLimit"
            :pre-loaded-content="collectionData"
            :required-fields="collectionRequiredFields"
            :statuses="collectionStatuses"
            :filterable-values="collectionFilterableValues"
            title="lessons"
        />
    </div>

    <!-- Coach Footer -->
    <CoachFooter
        :coach-data="coachData"
        :full-name="fullName"
    />
</template>
<script setup>
import {computed, onMounted} from "vue";
import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import PageHeader from '../components/PageHeader/PageHeader';
import CoachEvent from "../vuesora/components/Coaches/CoachEvent";
import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper';
import CoachFooter from '../components/CoachFooter/CoachFooter';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        default: () => []
    },
    coachData: {
        type: Object,
        default: () => {}
    },
    coachEvent:{
        type: Object,
        default: () => {}
    },
    coachEventCurrentDateString: {
        type: String,
        default: () => "",
    },
    coachEventSubscriptionCalendarId: {
        type: String,
        default: () => "",
    },
    coachEventTimeCutoffMinutes: {
        type: Number,
        default: () => 0,
    },
    coachEventYoutubeEventId: {
        type: String,
        default: () => "",
    },
    collectionData:{
        type: Object,
        default: () => ({}),
    },
    collectionFilterableValues: {
        type: Array,
        default: () => [],
    },
    collectionLimit:{
        type: [Number, Boolean],
        default: () => 10,
    },
    collectionRequiredFields: {
        type: Array,
        default: () => [],
    },
    collectionStatuses: {
        type: Array,
        default: () => ["published"],
    },
    eventCoachProfileUrl: {
        type: String,
        default: () => "",
    },
    headerCtas: {
        type: Array,
        default: () => []
    },
    headerDescription: {
        type: String,
        default: ''
    },
    headerInfoData: {
        type: Object,
        default: () => {}
    },
})

const hasCoachEvent = computed(() => {
    return props.coachEvent.data?.length > 0;
})

const headerType = computed(() => {
    return props.coachData?.type;
})

const headerHeroImg = computed(() => {
    return props.coachData.data.find(c => c.key === 'coach_top_banner_image')?.value;
})

const fullName = computed(() => {
    return props.coachData.name;
})

onMounted(() => {
    console.log('coach',props.coachData)
})
</script>
