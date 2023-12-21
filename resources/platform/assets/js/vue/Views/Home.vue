<template>
    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white">
        <!-- Onboarding banner -->
        <TriggerBanner v-if="showTriggerBanner" />
        <div class="tw-px-4 lg:tw-px-0">
            <!-- Header carousel -->
            <HeaderCarousel :preloadedCarousel="carousel" />
            <!-- Cohort banner -->
            <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" />
        </div>
        <!-- Continue section -->
        <MiniCatalogueSection v-if="hasStartedLessons && startedContent.data.length" title="Continue" seeAllAriaLabel="See All Lessons In Progress"
            :seeAllUrl="continueUrl" :preLoadedContent="startedContent" :isMiniView="true" :show-dropdown="true" />
        <!-- Workouts section -->
        <MiniCatalogueSection v-if="workoutsContent.data.length" title="Workouts" seeAllAriaLabel="See All Workouts" :seeAllUrl="workoutsContentUrl"
            :preLoadedContent="workoutsContent" />
        <!-- New section -->
        <MiniCatalogueSection title="New Releases" seeAllAriaLabel="See All New Releases" :seeAllUrl="newContentUrl"
            :preLoadedContent="newContent" />

        <!-- Playlist section -->
        <ListSection :newContentUrl="newContentUrl" :usersList="usersList" />

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
            :preLoadedContent="upcomingEvents" 
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

const showTriggerBanner = computed(() => {
    return !props.hasGear || !props.hasTopics || !props.hasGenres || !props.hasExperience || !props.hasGoals;
});

const props = defineProps({
    accountUrl: { type: String, default: '' },
    upcomingUrl: { type: String, default: '' },
    continueUrl: { type: String, default: '' },
    newContentUrl: { type: String, default: '' },
    workoutsContentUrl: { type: String, default: '' },
    hasGear: { type: Boolean, default: false },
    hasTopics: { type: Boolean, default: false },
    hasGenres: { type: Boolean, default: false },
    hasExperience: { type: Boolean, default: false },
    hasGoals: { type: Boolean, default: false },
    carousel: { type: Array, default: () => ([]) },
    existsCohortBanner: { type: Boolean, default: false },
    cohortBanner: { type: Array, default: () => ([]) },
    hasStartedLessons: { type: Boolean, default: false },
    startedContent: { type: Object, default: () => ({}) },
    newContent: { type: Object, default: () => ({}) },
    workoutsContent: { type: Object, default: () => ({}) },
    hotForumTopics: { type: Array, default: () => ([]) },
    usersList: { type: Object, default: () => ({}) },
    coachEvent: { type: Object, default: () => null },
    currentDate: { type: String, default: '' },
    calendarId: { type: [String, Number], default: '' },
    youtubeId: { type: String, default: '' },
    timeCutoffMinutes: { type: Number, default: 0 },
    eventCoachProfileUrl: { type: String, default: '' },
    hasUpcomingEvents: { type: Boolean, default: false },
    upcomingEvents: { type: Object, default: () => ({}) },
    nextLearningPathProgressPercent: { type: Number, default: 0 },
    nextLearningPathLevel: { type: String, default: '' },
    userMetrics: { type: Object, default: () => ({}) }
});

const openPlaylistModal = () => {
    window.openplaylistmodal({
        modalType: 'create',
        brand: '{{ $brand }}',
        data: {
            name: '',
            category: 'General',
            thumbnail_url: null,
            description: ''
        }
    });
};

onMounted(() => {
    console.log('continue section data ', startedContent.data);
    if (window.location.href.includes('create-playlist-window')) {
        openPlaylistModal();
    }
});
</script>
