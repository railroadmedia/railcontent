<template>
    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white">
        <TriggerBanner v-if="showTriggerBanner" />
        <div class="tw-px-4 lg:tw-px-0">
            <HeaderCarousel :preloadedCarousel="carousel" />
            <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" />
        </div>
        <ContinueSection v-if="hasStartedLessons" :continueUrl="continueUrl" :startedContent="startedContent" />
        <NewSection :newContentUrl="newContentUrl" :newContent="newContent" />
        <ListSection :newContentUrl="newContentUrl" :usersList="usersList" />
        <div v-if="coachEvent" class="tw-px-4 lg:tw-px-0">
            <CoachEvent class="tw-mb-6" :preloadedContent="coachEvent" :currentDateString="currentDate"
                :subscriptionCalendarId="calendarId" :youtubeEventId="youtubeId" :timeCutoffMinutes="timeCutoffMinutes"
                :eventCoachProfileUrl="eventCoachProfileUrl" />
        </div>
        <UpcomingSection v-if="hasUpcomingEvents" :upcomingUrl="upcomingUrl" :upcomingEvents="upcomingEvents" />
        <StatsSection :accountUrl="accountUrl"
            :nextLearningPathProgressPercent="nextLearningPathProgressPercent"
            :nextLearningPathLevel="nextLearningPathLevel"
            :userMetrics="userMetrics" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import TriggerBanner from '../components/Onboarding/TriggerBanner.vue';
import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel.vue';
import CohortBanner from '../components/CohortBanner/CohortBanner.vue';
import ContinueSection from '../components/ContinueSection/ContinueSection.vue';
import NewSection from '../components/NewSection/NewSection.vue';
import ListSection from '../components/ListSection/ListSection.vue';
import CoachEvent from '../vuesora/components/Coaches/CoachEvent.vue';
import UpcomingSection from '../components/UpcomingSection/UpcomingSection.vue';
import StatsSection from '../components/StatsSection/StatsSection.vue';

const showTriggerBanner = computed(() => {
    return !props.hasGear || !props.hasTopics || !props.hasGenres || !props.hasExperience || !props.hasGoals;
});

const props = defineProps({
    accountUrl: { type: String, default: '' },
    upcomingUrl: { type: String, default: '' },
    continueUrl: { type: String, default: '' },
    newContentUrl: { type: String, default: '' },
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
</script>
