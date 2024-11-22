<template>
    <div class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8 dark:tw-text-white tw-pt-10">
        <template v-if="!isLoading">
            <!-- Onboarding banner -->
            <TriggerBanner v-if="showTriggerBanner" />

            <!-- Welcome Message -->
            <WelcomeMessage v-if="isV2User" v-bind="welcomeMessageProps" />

            <!-- Challenge Carousel -->
            <MiniCatalogueSection
                title="Challenges"
                :see-all-url="`/${brand}/challenges`"
                seeAllAriaLabel="See All Challenges"
                catalogue-type="challenge"
            />

            <!-- Learning Paths -->
            <LearningPathContainer :isV2User v-if="learningPaths.length && !trialSectionRedesign" :learning-paths="learningPaths"
                trackingSection="banner" />
            <NewLearningPathContainer :isV2User v-if="learningPaths.length && trialSectionRedesign" :learning-paths="learningPaths"
                trackingSection="banner" />

            <!-- Join Header: Pack Only -->
            <StaticHeader
                v-if="isPackOnlyBoolean"
                title="JOIN THE COMMUNITY"
                cta-text="UPGRADE YOUR MEMBERSHIP"
                description="Click here to upgrade your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
                :cta-url="upgradeMembershipUrl"
                img="https://www.musora.com/musora-cdn/image/width=720,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/carousel/pre-launch-header-image-jpg.jpg"
                class="tw-mt-4 tw-mb-8"
            />

            <!-- Header carousel -->
            <HeaderCarousel v-if="!isV2User" :preloadedCarousel="carousel" trackingSection="banner" />

            <!-- Cohort banner -->
            <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" trackingSection="banner" />

            <!-- Continue section -->
            <MiniCatalogueSection
                v-if="data?.continueSection.length"
                title="Continue"
                seeAllAriaLabel="See All Lessons In Progress"
                :seeAllUrl="`/${brand}/lesson-history/in-progress`"
                :preLoadedContent="data?.continueSection"
                :isMiniView="true"
                :show-dropdown="true"
                :use-ref-data="true"
                trackingSection="continue"
            />

            <!-- Explore section -->
            <ExploreSection v-if="exploreTasks.length" :exploreTasks="exploreTasks" />

            <!-- Recommended section -->
            <MiniCatalogueSection v-if="recommendedContent.data.length" title="Inspired By Your Activity"
                seeAllAriaLabel="See All Content" :seeAllUrl="recommendedContentUrl"
                :preLoadedContent="recommendedContent.data" trackingSection="recommended" />

            <!-- Workouts section - REMOVING -->
            <!-- <MiniCatalogueSection
                v-if="data?.workouts?.length"
                title="Workouts"
                seeAllAriaLabel="See All Workouts"
                :seeAllUrl="`${brand}/workouts`"
                :preLoadedContent="data.workouts"
                trackingSection="workouts"
            /> -->

            <!-- New Releases -->
            <MiniCatalogueSection
                 v-if="(!isV2User && data?.newReleases.length) || (isV2User && userHas30Days)"
                title="New Releases"
                seeAllAriaLabel="See All New Releases"
                :seeAllUrl="`${brand}/lessons/all`"
                :preLoadedContent="data.newReleases"
                trackingSection="new"
            />

            <!-- Live section -->
            <CoachEvent
                v-if="coachEvent  && !isV2User"
                class="tw-mb-6"
                :preloadedContent="coachEvent"
                :currentDateString="currentDate"
                :youtubeEventId="youtubeId"
                :timeCutoffMinutes="timeCutoffMinutes"
                trackingSection="live"
            />

            <!-- Upcoming section - REMOVING why????? -->
            <!-- <MiniCatalogueSection
                v-if="!isV2User && data?.upcomingEvents.length"
                title="Upcoming Events"
                seeAllAriaLabel="See All Upcoming Events"
                :seeAllUrl="`${brand}/live`"
                :force-no-links="true"
                :preLoadedContent="data.upcomingEvents"
                trackingSection="upcoming-events"
            /> -->

            <template v-if="isPackOnlyBoolean">
                <!-- Your Courses section : Packs Only -->
                <HomepageCatalog
                    v-if="courseDataObject.data.length"
                    collection-type="course"
                    title="Your Courses"
                    see-all-label="See All Courses"
                    :see-all-url="`${brand}/courses`"
                    :pre-loaded-content="courseDataObject"
                />

                <!-- Your Packs section : Packs Only -->
                <HomepageCatalog
                    v-if="packData.length"
                    collection-type="pack"
                    title="Your Training Packs"
                    see-all-label="See All Packs"
                    :see-all-url="`${brand}/packs`"
                    :pre-loaded-content="packDataObject"
                />
            </template>

            <!-- Popular Conversation : Packs Only -->
            <PopularConversations
                v-if="isPackOnlyBoolean && conversationData.length"
                :posts="conversationData"
                class="tw-mb-8"
            />

            <!-- Dashboard section -->
            <DashboardSection v-if="isV2User" :accountUrl="accountUrl" :xp-earned="userMetrics.xp.value" :minutes-practiced="userMetrics.practiced.value"
                :user-level-title="userMetrics.xp.label" />

            <!-- Stats section -->
            <StatsSection
                v-if="!isPackOnlyBoolean && !isV2User"
                :accountUrl="accountUrl"
                :nextLearningPathProgressPercent="nextLearningPathProgressPercent"
                :nextLearningPathLevel="nextLearningPathLevel"
                :userMetrics="userMetrics"
            />
        </template>
        <HomePageSkeleton v-else />
    </div>
</template>

<script setup>
    import { computed, onBeforeMount, onMounted, ref } from 'vue';
    import { usePlatformStore } from '@stores/platform';
    import { useHomePageData } from '@hooks/pages/useHomePageData';
    import { useUserStore } from "@stores/user";
    import {storeToRefs} from "pinia/dist/pinia";
    import { usePlaylistsStore } from "@stores/playlists";

    import CohortBanner from '@collections/CohortBanner/CohortBanner.vue';
    import CoachEvent from '@vuesora/Components/Coaches/CoachEvent.vue';
    import HeaderCarousel from '@collections/HeaderCarousel/HeaderCarousel.vue';
    import HomepageCatalog from '@collections/HomepageCatalog/HomepageCatalog.vue';
    import LearningPathContainer from '@collections/LearningPaths/LearningPathContainer.vue';
    import NewLearningPathContainer from '@collections/NewLearningPaths/NewLearningPathContainer.vue';
    import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';
    import PopularConversations from '@collections/PopularConversations/PopularConversations.vue';
    import StaticHeader from  '@collections/HeaderCarousel/StaticHeader.vue';
    import TriggerBanner from '@collections/Onboarding/TriggerBanner.vue';
    import HomePageSkeleton from "./HomePageSkeleton";
    import ExploreSection from '@collections/ExploreSection/ExploreSection.vue';
    import WelcomeMessage from '@collections/WelcomeMessage/WelcomeMessage.vue';
    import DashboardSection from '@collections/DashboardCard/DashboardSection.vue';
    import StatsSection from '@collections/StatsSection/StatsSection.vue';

    //Pinia Stores
    const playlistsStore = usePlaylistsStore();
    const userStore = useUserStore();
    const platformStore = usePlatformStore();
    const { brand, userId, token, showOnboardingBanner, userHas30Days } = storeToRefs(userStore);
    const { isLoading } = storeToRefs(platformStore);

    const props = defineProps({
        // String props
        accountUrl: { type: String, default: '' },
        calendarId: { type: [String, Number], default: '' },
        continueUrl: { type: String, default: '' },
        currentDate: { type: String, default: '' },
        eventCoachProfileUrl: { type: String, default: '' },
        newContentUrl: { type: String, default: '' },
        recommendedContentUrl: { type: String, default: '' },
        upgradeMembershipUrl: { type: String, default: '' },
        youtubeId: { type: String, default: '' },
        nextLearningPathLevel: { type: String, default: '' },
        
        // Boolean props
        existsCohortBanner: { type: Boolean, default: false },
        isPackOnly: { type: [Number, Boolean], default: 0 },
        trialSectionRedesign: { type: Boolean, default: false },
        isFirstAccess: { type: Boolean, default: false },
        isV2User: { type: Boolean, default: false },

        // Number props
        timeCutoffMinutes: { type: Number, default: 0 },
        nextLearningPathProgressPercent: { type: Number, default: 0 },

        // Array props
        carousel: { type: Array, default: () => ([]) },
        cohortBanner: { type: Array, default: () => ([]) },
        conversationData: { type: Array, default: () => ([]) },
        learningPaths: { type: Array, default: () => ([]) },
        packData: { type: Array, default: () => ([]) },
        exploreTasks: { type: Array, default: () => ([]) },

        // Object props
        coachEvent: { type: Object, default: () => null },
        courseData: { type: Object, default: () => ({}) },
        newContent: { type: Object, default: () => ({}) },
        recommendedContent: { type: Object, default: () => ({ data: [] }) },
        startedContent: { 
            type: Object, 
            default: () => ({ data: [] }) 
        },
        usersList: { type: Object, default: () => ({}) },
        userMetrics: { type: Object, default: () => ({}) }
    });

    //Computed
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
        if(!JSON.parse(props.courseData)) return;
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

    //Refs
    const data = ref(null);

    //Methods
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

    //Lifecycles
    onBeforeMount( async () => {
        playlistsStore.playlists = props.usersList;

        const { data: homeData, error: homeError, isLoading: homeLoading } = await useHomePageData(brand.value, userId.value, token.value);
        data.value = homeData.value;
        platformStore.setLoadingState(homeLoading.value);
    });

    onMounted(() => {
        if (window.location.href.includes('create-playlist-window')) {
            openPlaylistModal();
        }
    });
</script>
