<template>
    <div class="lg:tw-container tw-mx-auto tw-px-4 lg:tw-px-8 dark:tw-text-white">
        <!-- Learning Paths -->
        <LearningPathContainer v-if="learningPaths.length" :learning-paths="learningPaths" trackingSection="banner" />
        <!-- Onboarding banner -->
        <TriggerBanner v-if="showTriggerBanner" />
        <div class="tw-px-4 lg:tw-px-0">
            <!-- Header carousel -->
            <HeaderCarousel :preloadedCarousel="carousel" trackingSection="banner" />
            <!-- Cohort banner -->
            <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" trackingSection="banner" />
        </div>
        <!-- Continue section -->
        <MiniCatalogueSection
            v-if="startedContent.data.length"
            title="Continue"
            seeAllAriaLabel="See All Lessons In Progress"
            :seeAllUrl="continueUrl"
            :preLoadedContent="startedContent.data"
            :isMiniView="true"
            :show-dropdown="true"
            :use-ref-data="true"
            trackingSection="continue"
        />
        <!-- Recommended section -->
        <MiniCatalogueSection
            v-if="recommends.length > 0"
            title="Inspired By Your Activity"
            seeAllAriaLabel="See All Content"
            :seeAllUrl="recommendedContentUrl"
            :preLoadedContent="recommends"
            trackingSection="recommended"
        >
            <!-- <template #label>
                <a :href="recommendationLinks[brand]" class="tw-flex tw-ml-2 tw-text-[#FFAE00] md:tw-text-[#00101D] tw-text-xs md:tw-border md:tw-border-[#FFAE00] md:tw-rounded-md md:tw-px-[5px] md:tw-py-0.5 tw-font-semibold md:tw-bg-[#FFAE00] hover:md:tw-border-[#DC9600] hover:md:tw-bg-[#DC9600] md:tw-flex tw-items-center" title="Learn More">
                    <musora-icon icon-name="info" class="tw-w-5 tw-h-5 tw-mr-1" /> <span class="tw-hidden md:tw-inline">Experimental Feature</span>
                </a>
            </template> -->
            <template #icon>
                <button class="tw-mr-[15px]" @click="shuffleRecommends" title="Shuffle. New content will be available twice a week.">
                    <i class="fas fa-random"></i>
                </button>
            </template>
        </MiniCatalogueSection>
        <!-- Workouts section -->
        <MiniCatalogueSection
            v-if="workoutsContent.data.length"
            title="Workouts"
            seeAllAriaLabel="See All Workouts"
            :seeAllUrl="workoutsContentUrl"
            :preLoadedContent="workoutsContent.data"
            trackingSection="workouts"
        />
        <!-- New section -->
        <MiniCatalogueSection
            title="New Releases"
            seeAllAriaLabel="See All New Releases"
            :seeAllUrl="newContentUrl"
            :preLoadedContent="newContent.data"
            trackingSection="new"
        />
        <!-- Playlist section -->
        <ListSection :newContentUrl="newContentUrl" :usersList="usersList" :my-list-url="`/${brand}/playlists`" />
        <div v-if="coachEvent" class="tw-px-4 lg:tw-px-0">
            <!-- Live section -->
            <CoachEvent class="tw-mb-6" :preloadedContent="coachEvent" :currentDateString="currentDate"
                :subscriptionCalendarId="calendarId" :youtubeEventId="youtubeId" :timeCutoffMinutes="timeCutoffMinutes"
                :eventCoachProfileUrl="eventCoachProfileUrl" trackingSection="live" />
        </div>
        <!-- Upcoming section -->
        <MiniCatalogueSection
            v-if="hasUpcomingEvents"
            title="Upcoming Events"
            seeAllAriaLabel="See All Upcoming Events"
            :seeAllUrl="upcomingUrl"
            :force-no-links="true"
            :preLoadedContent="upcomingEvents.data"
            trackingSection="upcoming-events"
        />

        <!-- Stats section -->
        <StatsSection :accountUrl="accountUrl" :nextLearningPathProgressPercent="nextLearningPathProgressPercent"
            :nextLearningPathLevel="nextLearningPathLevel" :userMetrics="userMetrics" />
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import TriggerBanner from '../components/Onboarding/TriggerBanner.vue';
import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel.vue';
import CohortBanner from '../components/CohortBanner/CohortBanner.vue';
import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection.vue';
import ListSection from '../components/ListSection/ListSection.vue';
import CoachEvent from '../vuesora/components/Coaches/CoachEvent.vue';
import StatsSection from '../components/StatsSection/StatsSection.vue';
import LearningPathContainer from '../components/LearningPaths/LearningPathContainer.vue';
import { useUserStore } from "../../stores/user";
import {storeToRefs} from "pinia/dist/pinia";

//Pinia Stores
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    accountUrl: { type: String, default: '' },
    calendarId: { type: [String, Number], default: '' },
    carousel: { type: Array, default: () => ([]) },
    coachEvent: { type: Object, default: () => null },
    cohortBanner: { type: Array, default: () => ([]) },
    continueUrl: { type: String, default: '' },
    currentDate: { type: String, default: '' },
    eventCoachProfileUrl: { type: String, default: '' },
    existsCohortBanner: { type: Boolean, default: false },
    hasExperience: { type: Boolean, default: false },
    hasGear: { type: Boolean, default: false },
    hasGenres: { type: Boolean, default: false },
    hasGoals: { type: Boolean, default: false },
    hasStartedLessons: { type: Boolean, default: false },
    hasTopics: { type: Boolean, default: false },
    hasUpcomingEvents: { type: Boolean, default: false },
    hotForumTopics: { type: Array, default: () => ([]) },
    learningPaths: { type: Array, default: () => ([]) },
    newContent: { type: Object, default: () => ({}) },
    newContentUrl: { type: String, default: '' },
    nextLearningPathLevel: { type: String, default: '' },
    nextLearningPathProgressPercent: { type: Number, default: 0 },
    recommendedContent: { type: Object, default: () => ({ data: [] }) },
    recommendedContentUrl: { type: String, default: '' },
    startedContent: { type: Object, default: () => ({}) },
    timeCutoffMinutes: { type: Number, default: 0 },
    upcomingEvents: { type: Object, default: () => ({}) },
    upcomingUrl: { type: String, default: '' },
    usersList: { type: Object, default: () => ({}) },
    userMetrics: { type: Object, default: () => ({}) },
    workoutsContent: { type: Object, default: () => ({}) },
    workoutsContentUrl: { type: String, default: '' },
    youtubeId: { type: String, default: '' },
});

const showTriggerBanner = computed(() => {
    return !props.hasGear || !props.hasTopics || !props.hasGenres || !props.hasExperience || !props.hasGoals;
});

const recommends = ref(props.recommendedContent.data ? props.recommendedContent.data.slice(0,5) : []);
const recSysPage = ref(1);

const openPlaylistModal = () => {
    window.openplaylistmodal({
        modalType: 'create',
        brand: brand,
        data: {
            name: '',
            category: 'General',
            thumbnail_url: null,
            description: ''
        }
    });
};

const shuffleRecommends = () => {
    if(Math.ceil(props.recommendedContent.data.length / 5) === recSysPage.value){
        recSysPage.value = 1;
    } else {
        recSysPage.value = recSysPage.value + 1;
    }

    recommends.value = props.recommendedContent.data.slice((recSysPage.value - 1) * 5, recSysPage.value * 5);
}

onMounted(() => {
    if (window.location.href.includes('create-playlist-window')) {
        openPlaylistModal();
    }
});

const recommendationLinks = {
    drumeo: 'https://www.musora.com/drumeo/forums/drumeo-website-feedback/6/16436/16436?page=1&sortby_val=published_on#post349083',
    pianote: 'https://www.musora.com/pianote/forums/platform-update-feedback-discussion/5/5348/5348?page=1&sortby_val=published_on#post127612',
    guitareo: 'https://www.musora.com/guitareo/forums/website-update-and-feedback-discussion/6/3185/3185?page=1&sortby_val=published_on#post45772',
    singeo:'https://www.musora.com/singeo/forums/platform-update-feedback-discussion/5/919/919?page=1&sortby_val=published_on#post48436',
}
</script>
