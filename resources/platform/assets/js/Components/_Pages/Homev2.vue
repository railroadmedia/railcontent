<template>
    <div
        class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8 dark:tw-text-white">
        <!-- Onboarding banner -->
        <TriggerBanner v-if="showTriggerBanner" />

        <!-- Welcome Message -->
        <WelcomeMessage v-if="isV2User" v-bind="welcomeMessageProps" />

        <!-- Learning Paths -->
        <LearningPathContainer :isV2User v-if="learningPaths.length && !trialSectionRedesign" :learning-paths="learningPaths"
            trackingSection="banner" />
        <NewLearningPathContainer :isV2User v-if="learningPaths.length && trialSectionRedesign" :learning-paths="learningPaths"
            trackingSection="banner" />

        <!-- Join Header: Pack Only -->
        <StaticHeader v-if="isPackOnlyBoolean" title="JOIN THE COMMUNITY" cta-text="UPGRADE YOUR MEMBERSHIP"
            description="Click here to upgrade your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
            :cta-url="upgradeMembershipUrl"
            img="https://www.musora.com/musora-cdn/image/width=720,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/carousel/pre-launch-header-image-jpg.jpg"
            class="tw-mt-4 tw-mb-8" />

        <!-- Header carousel -->
        <HeaderCarousel v-if="!isV2User" :preloadedCarousel="carousel" trackingSection="banner" />
        <!-- Cohort banner -->
        <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" trackingSection="banner" />

        <!-- Continue section -->
        <MiniCatalogueSection v-if="startedContent.data.length" title="Continue"
            seeAllAriaLabel="See All Lessons In Progress" :seeAllUrl="continueUrl"
            :preLoadedContent="startedContent.data" :isMiniView="true" :show-dropdown="true"
            trackingSection="continue" />

        <!-- Explore section -->
        <ExploreSection v-if="exploreTasks.length" :exploreTasks="exploreTasks" />

        <!-- Recommended section -->
        <MiniCatalogueSection v-if="recommendedContent.data.length" title="Inspired By Your Activity"
            seeAllAriaLabel="See All Content" :seeAllUrl="recommendedContentUrl"
            :preLoadedContent="recommendedContent.data" trackingSection="recommended" />

        <!-- Workouts section -->
        <MiniCatalogueSection v-if="!isV2User && workoutsContent.data.length" title="Workouts" seeAllAriaLabel="See All Workouts"
            :seeAllUrl="workoutsContentUrl" :preLoadedContent="workoutsContent.data" trackingSection="workouts" />

        <!-- New Releases section -->
        <MiniCatalogueSection v-if="(!isV2User && newContent.data?.length) || (isV2User && userHas30Days)" title="New Releases" seeAllAriaLabel="See All New Releases"
            :seeAllUrl="newContentUrl" :preLoadedContent="newContent.data" trackingSection="new" />

        <!-- Playlist section add arrows -->
        <ListSection v-if="usersList.length" :newContentUrl="newContentUrl" :usersList="playlistsStore.playlists"
            :my-list-url="`/${brand}/playlists`" />

        <!-- Live section -->
        <CoachEvent v-if="coachEvent  && brand !== 'drumeo'" class="tw-mb-6" :preloadedContent="coachEvent" :currentDateString="currentDate"
            :subscriptionCalendarId="calendarId" :youtubeEventId="youtubeId" :timeCutoffMinutes="timeCutoffMinutes"
            :eventCoachProfileUrl="eventCoachProfileUrl" trackingSection="live" />

        <!-- Upcoming section -->
        <MiniCatalogueSection v-if="!isV2User && hasUpcomingEvents && brand !== 'drumeo'" title="Upcoming Events" seeAllAriaLabel="See All Upcoming Events"
            :seeAllUrl="upcomingUrl" :force-no-links="true" :preLoadedContent="upcomingEvents.data"
            trackingSection="upcoming-events" />


        <template v-if="isPackOnlyBoolean">
            <!-- Your Courses section : Packs Only -->
            <HomepageCatalog v-if="courseDataObject.data.length" collection-type="course" title="Your Courses"
                see-all-label="See All Courses" :see-all-url="`${brand}/courses`"
                :pre-loaded-content="courseDataObject" />

            <!-- Your Packs section : Packs Only -->
            <HomepageCatalog v-if="packData.length" collection-type="pack" title="Your Training Packs"
                see-all-label="See All Packs" :see-all-url="`${brand}/packs`" :pre-loaded-content="packDataObject" />
        </template>

        <!-- Popular Conversation : Packs Only -->
        <PopularConversations v-if="isPackOnlyBoolean && conversationData.length" :posts="conversationData"
            class="tw-mb-8" />

        <!-- Dashboard section -->
        <DashboardSection :accountUrl="accountUrl" :xp-earned="userMetrics.xp.value" :minutes-practiced="userMetrics.practiced.value"
            :user-level-title="userMetrics.xp.label" />
    </div>
</template>

<script setup>
import { computed, onMounted, onBeforeMount } from 'vue';
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { usePlaylistsStore } from "@stores/playlists";

import CohortBanner from '@collections/CohortBanner/CohortBanner.vue';
import CoachEvent from '@vuesora/Components/Coaches/CoachEvent.vue';
import HeaderCarousel from '@collections/HeaderCarousel/HeaderCarousel.vue';
import HomepageCatalog from '@collections/HomepageCatalog/HomepageCatalog.vue';
import LearningPathContainer from '@collections/LearningPaths/LearningPathContainer.vue';
import NewLearningPathContainer from '@collections/NewLearningPaths/NewLearningPathContainer.vue';
import ListSection from '@collections/ListSection/ListSection.vue';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';
import PopularConversations from '@collections/PopularConversations/PopularConversations.vue';
import StaticHeader from '@collections/HeaderCarousel/StaticHeader.vue';
import TriggerBanner from '@collections/Onboarding/TriggerBanner.vue';
import WelcomeMessage from '@collections/WelcomeMessage/WelcomeMessage.vue';
import ExploreSection from '../_Collections/ExploreSection/ExploreSection.vue';
import DashboardSection from '../_Collections/DashboardCard/DashboardSection.vue';

const props = defineProps({
    accountUrl: { type: String, default: '' },
    calendarId: { type: [String, Number], default: '' },
    carousel: { type: Array, default: () => ([]) },
    coachEvent: { type: Object, default: () => null },
    cohortBanner: { type: Array, default: () => ([]) },
    courseData: { type: Object, default: () => ({}) },
    continueUrl: { type: String, default: '' },
    conversationData: { type: Array, default: () => ([]) },
    currentDate: { type: String, default: '' },
    eventCoachProfileUrl: { type: String, default: '' },
    existsCohortBanner: { type: Boolean, default: false },
    hasStartedLessons: { type: Boolean, default: false },
    hasUpcomingEvents: { type: Boolean, default: false },
    isPackOnly: { type: [Number, Boolean], default: 0 },
    learningPaths: { type: Array, default: () => ([]) },
    newContent: { type: Object, default: () => ({}) },
    newContentUrl: { type: String, default: '' },
    nextLearningPathLevel: { type: String, default: '' },
    nextLearningPathProgressPercent: { type: Number, default: 0 },
    packData: { type: Array, default: () => ([]) },
    recommendedContent: { type: Object, default: () => ({ data: [] }) },
    recommendedContentUrl: { type: String, default: '' },
    startedContent: {
        type: Object,
        default: () => ({
            data: []
        })
    },
    timeCutoffMinutes: { type: Number, default: 0 },
    upcomingEvents: { type: Object, default: () => ({}) },
    upcomingUrl: { type: String, default: '' },
    upgradeMembershipUrl: { type: String, default: '' },
    usersList: { type: Object, default: () => ({}) },
    userMetrics: { type: Object, default: () => ({}) },
    workoutsContent: {
        type: Object,
        default: () => ({
            data: []
        })
    },
    workoutsContentUrl: { type: String, default: '' },
    youtubeId: { type: String, default: '' },
    trialSectionRedesign: { type: Boolean, default: false },
    isFirstAccess: { type: Boolean, default: false },
    isV2User: { type: Boolean, default: false },
    exploreTasks: { type: Array, default: () => [] },
});

//Pinia Stores
const playlistsStore = usePlaylistsStore();
const userStore = useUserStore();
const { brand, showOnboardingBanner, userHas30Days } = storeToRefs(userStore);

const hasCompleteYourAccountTask = computed(() => {
    return props.exploreTasks.find(task => task.hook === 'complete-your-account');
});

const showTriggerBanner = computed(() => {
    if (props.isPackOnlyBoolean || hasCompleteYourAccountTask.value) return false; //hide for packs only
    return showOnboardingBanner.value;
});

const isPackOnlyBoolean = computed(() => {
    return Boolean(props.isPackOnly);
});

const courseDataObject = computed(() => {
    if (!JSON.parse(props.courseData)) return;
    return JSON.parse(props.courseData);
})

const packDataObject = computed(() => {
    return { data: [...props.packData] };
})

const welcomeMessageProps = computed(() => {
    if (props.isFirstAccess) {
        return {
            welcomeMessage: `Welcome, ${userStore.user.first_name || userStore.user.display_name}`,
            practiceMessage: `Start Here`
        }
    } else {
        return {
            welcomeMessage: `Welcome back, ${userStore.user.first_name || userStore.user.display_name}`,
            practiceMessage: `Let's get practicing!`
        }
    }
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

onBeforeMount(() => {
    playlistsStore.playlists = props.usersList;
})

onMounted(() => {
    if (window.location.href.includes('create-playlist-window')) {
        openPlaylistModal();
    }
});
</script>
