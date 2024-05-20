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
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl">
            <!-- Featured Coach -->
            <div class="tw-mb-[30px]">
                <div class="tw-flex tw-flex-row">
                    <div class="tw-flex tw-flex-col tw-flex-grow">
                        <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
                            <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-[15px]">
                                Featured Coach
                            </h2>
                        </div>
                        <StaticHeader
                            v-if="featuredCoachLength === 1"
                            v-for="formattedCoach in formattedFeaturedCoaches"
                            :top-subtitle="formattedCoach.subtitle"
                            title-classes="tw-text-[#FAA300]"
                            :title="formattedCoach.title"
                            :cta-text="formattedCoach.primary_cta_text"
                            :description="formattedCoach.description"
                            :cta-url="formattedCoach.primary_cta_url"
                            :img="formattedCoach.img"
                        />
                        <HeaderCarousel v-else-if="featuredCoachLength > 1" :preloaded-carousel="formattedFeaturedCoaches" />
                    </div>
                </div>
            </div>
            <!-- Latest Featured Lessons -->
            <div class="tw-mb-[30px]">
                <MiniCatalogueSection
                    title="Latest Featured Lessons"
                    :pre-loaded-content="latestLessons"
                />
            </div>
            <!-- From Subscribed Coaches -->
            <div class="tw-mb-[30px]">
                <MiniCatalogueSection
                    title="From Subscribed Coaches"
                    :see-all-url="`/${brand}/lessons/subscribed`"
                    seeAllAriaLabel="See All From Subscribed Coaches"
                    :pre-loaded-content="followedLessons"
                />
            </div>
            <!-- Upcoming Coaches -->
            <UpcomingCoach v-if="hasUpcomingCoaches" :upcoming-coaches="upcomingCoaches" />
            <!-- Active Coaches -->
            <ActiveCoach v-if="hasActiveCoaches" :active-coaches="activeCoaches"  />

            <CollectionWrapper
                :collection-type="collectionType"
                :filterable-values="collectionFilterableValues"
                :included-types="collectionIncludedTypes"
                :limit="collectionLimit"
                :pre-loaded-content="collectionData"
                :required-fields="collectionRequiredFields"
                :statuses="collectionStatuses"
                :tab-options="collectionTabOptions"
                :default-sort="collectionDefaultSort"
                :show-reset-progress="collectionShowResetProgress"
            />
        </div>
    </div>
</template>
<script setup>
import { computed, onMounted } from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "../../stores/user";
import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import PageHeader from '../components/PageHeader/PageHeader';
import CoachEvent from "../vuesora/components/Coaches/CoachEvent";
import StaticHeader from '../components/HeaderCarousel/StaticHeader';
import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel';
import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection';
import UpcomingCoach from '../components/UpcomingCoach/UpcomingCoach';
import ActiveCoach from '../components/ActiveCoach/ActiveCoach';
import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper';

const props = defineProps({
    activeCoaches: {
        type: Array,
        default: () => [],
    },
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
    coachEvent: {
        type: Object,
        default: () => ({}),
    },
    collectionData:{
        type: Object,
        default: () => ({}),
    },
    collectionDefaultSort: {
        type: String,
        default: '-published_on',
    },
    collectionFilterableValues: {
        type: Array,
        default: () => [],
    },
    collectionIncludedTypes: {
        default: '',
    },
    collectionLimit:{
        type: [Number, Boolean],
        default: () => 10,
    },
    collectionRequiredFields: {
        type: Array,
        default: () => [],
    },
    collectionShowResetProgress: {
        type: Boolean,
        default: () => false,
    },
    collectionStatuses: {
        type: Array,
        default: () => ["published"],
    },
    collectionTabOptions: {
        type: Array,
        default: () => [],
    },
    collectionType: {
        default: '',
    },
    currentDateString: {
        type: String,
        default: () => "",
    },
    featuredCoaches: {
        type: Array,
        default: () => [],
    },
    followedLessons: {
        type: Object,
        default: {},
    },
    hasActiveCoaches: {
        type: Boolean,
        default: () => false,
    },
    hasFeaturedCoaches: {
        type: Boolean,
        default: () => false,
    },
    hasFollowedCoaches: {
        type: Boolean,
        default: () => false,
    },
    hasUpcomingCoaches:{
        type: Boolean,
        default: () => false,
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
    latestLessons: {
        type: Array,
        default: () => [],
    },
    youtubeEventId: {
        type: String,
        default: () => "",
    },
    upcomingCoaches: {
        type: Array,
        default: () => [],
    },
})

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const hasCoachEvent = computed(() => {
    return Object.keys(props.coachEvent.data).length > 0;
})

const featuredCoachLength = computed(() => {
    return props.featuredCoaches.results?.length;
})

const formattedFeaturedCoaches = computed(() => {
    return props.featuredCoaches.results?.map((coach) => {
        return {
            ...coach,
            title: coach.fields.find(c=>c.key === 'name').value,
            subtitle: coach.data.find(c=>c.key === 'focus_text').value,
            description: coach.data.find(c=>c.key === 'short_bio').value,
            primary_cta_text: `Visit ${coach.fields.find(c=>c.key === 'name').value.split(' ')[0]}'s Coach Page`,
            primary_cta_url: coach.url,
            img: `https://www.musora.com/musora-cdn/image/width=720,quality=95/${coach.data.find(c=>c.key === 'coach_featured_image').value}`
        }
    })
})

onMounted(() => {
})
</script>
