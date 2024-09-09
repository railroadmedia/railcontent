<template>
    <div class=" tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <!-- Breadcrumb -->
        <Breadcrumb :breadcrumbs="breadcrumbs" />
        <!-- Page Header -->
        <PageHeader
            page-type="instructor"
            :title="fullName"
            :hero-img="coachData?.coach_top_banner_image"
            :info-data="[coachData?.focus_text]"
            :ctas="headerCtas"
            :description="coachData?.short_bio"
        />
    </div>

    <!-- Need to integrate with MCS -->
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
        <CollectionWrapper
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
import { computed, onBeforeMount, ref } from "vue";
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader';
import CoachEvent from "@vuesora/Components/Coaches/CoachEvent";
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';
import CoachFooter from '@collections/CoachFooter/CoachFooter';
import { useCoachShowPageData } from '@hooks/pages/useCoachShowPageData';
import {useCollectionStore} from "@stores/collection";

const props = defineProps({
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

const collectionStore = useCollectionStore();

const coachData = ref({});
const breadcrumbs = ref([]);

const hasCoachEvent = computed(() => {
    return props.coachEvent.data?.length > 0;
})

const headerHeroImg = computed(() => {
    return coachData.value?.coach_top_banner_image || '';
})

const fullName = computed(() => {
    return coachData.value?.name || '';
})

const tabData = [
    {
        value: 'All Lessons',
        groupByView: false,
        key: '',
    },
];

onBeforeMount(async() => {
    //Needs to be updated when BE figures out the subscribed feature
    const { data, breadcrumbData } = await useCoachShowPageData();
    coachData.value = data;
    breadcrumbs.value = breadcrumbData;

    collectionStore.setDefaults({
        tabOptions: tabData,
        filter: {
            sort: '-published_on'
        },
        fetchType: 'coachLessons',
    });
})
</script>
