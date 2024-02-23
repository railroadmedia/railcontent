<template>
    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white">
        <!-- Learning Paths -->
        <LearningPathContainer v-if="learningPaths.length" :learning-paths="learningPaths" />
        <!-- Onboarding banner -->
        <TriggerBanner v-if="showTriggerBanner" />
        <div class="tw-px-4 lg:tw-px-0">
            <!-- Header carousel -->
            <HeaderCarousel :preloadedCarousel="carousel" />
            <!-- Cohort banner -->
            <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" />
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
        />
        <!-- Recommended section -->
        <MiniCatalogueSection title="Recommended For You" seeAllAriaLabel="See All Content" :seeAllUrl="recommendedContentUrl"
                              :preLoadedContent="recommendedContent.data" v-if="hasRecommendations" />
        <!-- Workouts section -->
        <MiniCatalogueSection v-if="workoutsContent.data.length" title="Workouts" seeAllAriaLabel="See All Workouts" :seeAllUrl="workoutsContentUrl"
            :preLoadedContent="workoutsContent.data" />
        <!-- New section -->
        <MiniCatalogueSection title="New Releases" seeAllAriaLabel="See All New Releases" :seeAllUrl="newContentUrl"
            :preLoadedContent="newContent.data" />
        <!-- Playlist section -->
        <ListSection :newContentUrl="newContentUrl" :usersList="usersList" :my-list-url="`/${brand}/playlists`" />
        <div v-if="coachEvent" class="tw-px-4 lg:tw-px-0">
            <!-- Live section -->
            <CoachEvent class="tw-mb-6" :preloadedContent="coachEvent" :currentDateString="currentDate"
                :subscriptionCalendarId="calendarId" :youtubeEventId="youtubeId" :timeCutoffMinutes="timeCutoffMinutes"
                :eventCoachProfileUrl="eventCoachProfileUrl" />
        </div>
        <!-- Upcoming section -->
        <MiniCatalogueSection
            v-if="hasUpcomingEvents"
            title="Upcoming Events"
            seeAllAriaLabel="See All Upcoming Events"
            :seeAllUrl="upcomingUrl"
            :force-no-links="true"
            :preLoadedContent="upcomingEvents.data"
        />

        <!-- Stats section -->
        <StatsSection :accountUrl="accountUrl" :nextLearningPathProgressPercent="nextLearningPathProgressPercent"
            :nextLearningPathLevel="nextLearningPathLevel" :userMetrics="userMetrics" />
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
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

const showTriggerBanner = computed(() => {
    return !props.hasGear || !props.hasTopics || !props.hasGenres || !props.hasExperience || !props.hasGoals;
});

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
    hasRecommendations: { type: Boolean, default: false },
    hasStartedLessons: { type: Boolean, default: false },
    hasTopics: { type: Boolean, default: false },
    hasUpcomingEvents: { type: Boolean, default: false },
    hotForumTopics: { type: Array, default: () => ([]) },
    learningPaths: { type: Array, default: () => ([]) },
    newContent: { type: Object, default: () => ({}) },
    newContentUrl: { type: String, default: '' },
    nextLearningPathLevel: { type: String, default: '' },
    nextLearningPathProgressPercent: { type: Number, default: 0 },
    recommendedContent: { type: Object, default: () => ({}) },
    recommendedContentUrl: { type: String, default: '' },
    startedContent: { type: Object, default: () => ({}) },
    timeCutoffMinutes: { type: Number, default: 0 },
    upcomingEvents: { type: Object, default: () => ({}) },
    upcomingUrl: { type: String, default: '' },
    usersList: { type: Object, default: () => ({}) },
    userMetrics: { type: Object, default: () => ({}) },
    usersList: { type: Object, default: () => ({}) },
    workoutsContent: { type: Object, default: () => ({}) },
    workoutsContentUrl: { type: String, default: '' },
    youtubeId: { type: String, default: '' },
});

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

onMounted(() => {
    if (window.location.href.includes('create-playlist-window')) {
        openPlaylistModal();
    }
});
</script>
