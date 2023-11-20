<template>
    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white">
        <TriggerBanner v-if="showTriggerBanner" />
        <div class="tw-px-4 lg:tw-px-0">
            <HeaderCarousel :preloaded-carousel="carousel"/>
            <CohortBanner v-if="existsCohortBanner" :preloaded-banner="cohortBanner"/>
        </div>
        <ContinueSection />
    </div>
</template>

<script setup>
    import { computed } from 'vue';
    import TriggerBanner from '../components/Onboarding/TriggerBanner.vue';
    import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel.vue';
    import CohortBanner from '../components/CohortBanner/CohortBanner.vue';
    import ContinueSection from '../components/ContinueSection/ContinueSection.vue';

    const showTriggerBanner = computed(() => {
        return !hasGear || !hasTopics || !hasGenres || !hasExperience || !hasGoals;
    });

    const props = defineProps({
    startedLessons: { type: Object, default: () => ({}) },
    brand: { type: String, default: '' },
    hasGear: { type: Boolean, default: false },
    hasTopics: { type: Boolean, default: false },
    hasGenres: { type: Boolean, default: false },
    hasExperience: { type: Boolean, default: false },
    hasGoals: { type: Boolean, default: false },
    carousel: { type: Array, default: () => ([]) },
    existsCohortBanner: { type: Boolean, default: false },
    cohortBanner: { type: Object, default: () => ({}) },
    hasStartedLessons: { type: Boolean, default: false },
    startedContent: { type: Object, default: () => ({}) },
    newContent: { type: Object, default: () => ({}) },
    hotForumTopics: { type: Array, default: () => ([]) },
    usersList: { type: Array, default: () => ([]) },
    coachEvent: { type: Object, default: () => ({}) },
    currentDate: { type: String, default: '' },
    calendarId: { type: [String, Number], default: '' },
    youtubeId: { type: String, default: '' },
    timeCutoffMinutes: { type: Number, default: 0 },
    eventCoachProfileUrl: { type: String, default: '' },
    hasUpcomingEvents: { type: Boolean, default: false },
    upcomingEvents: { type: Array, default: () => ([]) },
    nextLearningPathProgressPercent: { type: Number, default: 0 },
    userMetrics: { type: Object, default: () => ({}) }
    });
</script>
