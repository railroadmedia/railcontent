<template>
    <div class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 lg:tw-px-8 dark:tw-text-white">
        <template v-if="!isLoading">
            <!-- Learning Paths -->
            <LearningPathContainer v-if="learningPaths.length" :learning-paths="learningPaths" trackingSection="banner" />

            <!-- Onboarding banner -->
            <TriggerBanner v-if="showTriggerBanner" />

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
            <HeaderCarousel :preloadedCarousel="carousel" trackingSection="banner" />
            <!-- Cohort banner -->
            <CohortBanner v-if="existsCohortBanner" :preloadedBanner="cohortBanner" trackingSection="banner" />

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
                <template #icon>
                    <button class="tw-mr-[15px]" @click="shuffleRecommends" title="Shuffle. New content will be available twice a week.">
                        <musora-icon icon-name="random" class="tw-w-5 tw-h-5" />
                    </button>
                </template>
            </MiniCatalogueSection>

            <!-- Workouts section -->
            <MiniCatalogueSection
                v-if="data.workouts.length"
                title="Workouts"
                seeAllAriaLabel="See All Workouts"
                :seeAllUrl="`${brand}/workouts`"
                :preLoadedContent="data.workouts"
                trackingSection="workouts"
            />

            <!-- New Releases -->
            <MiniCatalogueSection
                v-if="data.newReleases.length"
                title="New Releases"
                seeAllAriaLabel="See All New Releases"
                :seeAllUrl="`${brand}/lessons/all`"
                :preLoadedContent="data.newReleases"
                trackingSection="new"
            />

            <!-- Playlist section -->
            <ListSection
                v-if="usersList.length"
                :usersList="usersList"
                :my-list-url="`/${brand}/playlists`"
            />

            <!-- Live section -->
            <CoachEvent v-if="coachEvent" class="tw-mb-6" :preloadedContent="coachEvent" :currentDateString="currentDate"
                :subscriptionCalendarId="calendarId" :youtubeEventId="youtubeId" :timeCutoffMinutes="timeCutoffMinutes"
                :eventCoachProfileUrl="eventCoachProfileUrl" trackingSection="live" />

            <!-- Upcoming section -->
            <MiniCatalogueSection
                v-if="data.upcomingEvents.length"
                title="Upcoming Events"
                seeAllAriaLabel="See All Upcoming Events"
                :seeAllUrl="`${brand}/live`"
                :force-no-links="true"
                :preLoadedContent="data.upcomingEvents"
                trackingSection="upcoming-events"
            />

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

            <!-- Stats section -->
            <StatsSection
                v-if="!isPackOnlyBoolean"
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
    import CohortBanner from '@collections/CohortBanner/CohortBanner.vue';
    import CoachEvent from '@vuesora/Components/Coaches/CoachEvent.vue';
    import HeaderCarousel from '@collections/HeaderCarousel/HeaderCarousel.vue';
    import HomepageCatalog from '@collections/HomepageCatalog/HomepageCatalog.vue';
    import LearningPathContainer from '@collections/LearningPaths/LearningPathContainer.vue';
    import ListSection from '@collections/ListSection/ListSection.vue';
    import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';
    import MusoraIcon from '@units/MusoraIcons/MusoraIcon.vue';
    import PopularConversations from '@collections/PopularConversations/PopularConversations.vue';
    import StaticHeader from  '@collections/HeaderCarousel/StaticHeader.vue';
    import StatsSection from '@collections/StatsSection/StatsSection.vue';
    import TriggerBanner from '@collections/Onboarding/TriggerBanner.vue';
    import { useUserStore } from "@stores/user";
    import { usePlatformStore } from '@stores/platform';
    import {storeToRefs} from "pinia/dist/pinia";
    import HomePageSkeleton from "./HomePageSkeleton";
    import { useHomePageData } from '@hooks/pages/useHomePageData';

    //Pinia Stores
    const userStore = useUserStore();
    const { brand, userId, token, userCompletedAccount } = storeToRefs(userStore);
    const platformStore = usePlatformStore();
    const { isLoading } = storeToRefs(platformStore)

    //Props
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
        isPackOnly: { type: [Number, Boolean], default: 0 },
        learningPaths: { type: Array, default: () => ([]) },
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
        upgradeMembershipUrl: { type: String, default: '' },
        usersList: { type: Object, default: () => ({}) },
        userMetrics: { type: Object, default: () => ({}) },
        youtubeId: { type: String, default: '' },
    });

    //Computed
    const showTriggerBanner = computed(() => {
        if(!props.isPackOnlyBoolean) return false; //hide for packs only
        return userCompletedAccount.value;
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

    //Refs
    const recommends = ref(props.recommendedContent.data ? props.recommendedContent.data.slice(0,5) : []);
    const recSysPage = ref(1);
    const data = ref(null);
    const error = ref(null);

    //Constant
    const recommendationLinks = {
        drumeo: 'https://www.musora.com/drumeo/forums/drumeo-website-feedback/6/16436/16436?page=1&sortby_val=published_on#post349083',
        pianote: 'https://www.musora.com/pianote/forums/platform-update-feedback-discussion/5/5348/5348?page=1&sortby_val=published_on#post127612',
        guitareo: 'https://www.musora.com/guitareo/forums/website-update-and-feedback-discussion/6/3185/3185?page=1&sortby_val=published_on#post45772',
        singeo:'https://www.musora.com/singeo/forums/platform-update-feedback-discussion/5/919/919?page=1&sortby_val=published_on#post48436',
    }

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

    const shuffleRecommends = () => {
        if(Math.ceil(props.recommendedContent.data.length / 5) === recSysPage.value){
            recSysPage.value = 1;
        } else {
            recSysPage.value = recSysPage.value + 1;
        }
        recommends.value = props.recommendedContent.data.slice((recSysPage.value - 1) * 5, recSysPage.value * 5);
    }

    //Lifecycles
    onMounted(() => {
        if (window.location.href.includes('create-playlist-window')) {
            openPlaylistModal();
        }
    });

    onBeforeMount( async () => {
        const { data: homeData, error: homeError, isLoading: homeLoading } = await useHomePageData(brand.value, userId.value, token.value);
        data.value = homeData.value;
        console.log('DATA', data.value)
        platformStore.setLoadingState(homeLoading.value);
    });
</script>
