<template>
    <div class="lg:tw-container tw-mx-auto tw-px-4 lg:tw-px-8 dark:tw-text-white">
        <!-- Learning Paths -->
        <LearningPathContainer v-if="learningPaths.length" :learning-paths="learningPaths" trackingSection="banner" />
        
        <!-- Onboarding banner -->
        <TriggerBanner v-if="showTriggerBanner" />

        <div>
            <!-- Join Header: Pack Only -->
            <StaticHeader
                v-if="isPackOnlyBoolean"
                title="JOIN THE COMMUNITY"
                cta-text="UPGRADE YOUR MEMBERSHIP"
                description="Click here to upgrade your membership and gain access to the Drumeo, Pianote, Guitareo, and Singeo communities!"
                :cta-url="upgradeMembershipUrl"
                img="https://www.musora.com/musora-cdn/image/width=720,quality=95/https://cdn.musora.com/image/fetch/c_fill,w_1920,h_1080,q_auto:good/https://d3fzm1tzeyr5n3.cloudfront.net/carousel/pre-launch-header-image-jpg.jpg"
                class="tw-mt-4 tw-mb-8"
            />
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
            <template #icon>
                <button class="tw-mr-[15px]" @click="shuffleRecommends" title="Shuffle. New content will be available twice a week.">
                    <musora-icon icon-name="random" class="tw-w-5 tw-h-5" />
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
            v-if="newContent.data"
            title="New Releases"
            seeAllAriaLabel="See All New Releases"
            :seeAllUrl="newContentUrl"
            :preLoadedContent="newContent.data"
            trackingSection="new"
        />

        <!-- Playlist section -->
        <ListSection 
            v-if="usersList.length"
            :newContentUrl="newContentUrl" 
            :usersList="usersList" 
            :my-list-url="`/${brand}/playlists`" 
        />

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

        
        <template v-if="isPackOnlyBoolean">

            <!-- Your Courses section : Packs Only -->
            <div v-if="courseDataObject.data.length">
                <div class="tw-flex tw-flex-col tw-w-full">
                    <!-- Section Header -->
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        <div class="tw-flex tw-items-center">
                            <a :href="`${brand}/courses`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                                <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Your Courses</h2>
                            </a>
                        </div>
                        <div class="tw-flex tw-items-center">
                            <a :href="`${brand}/courses`" aria-label="See All Lessons In Progress" class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-mt-1"> 
                                See All 
                            </a>
                        </div>
                    </div>
                </div>
                <!-- @if (!empty($courses) && brand() == 'singeo')
                    @include(
                        'partials.bladesora.members.components.home._courses-section',
                        [
                            'brand' => brand(),
                            'contentEndpoint' => '/railcontent/content',
                            'courseContentJson' => $courses,
                            'allCoursesUrl' => '/'.$brand.'/courses',
                        ]
                    )
                @endif -->
            </div>

            <!-- Your Packs section : Packs Only -->
            <div v-if="packData.length">
                <div class="tw-flex tw-flex-col tw-w-full">
                    <!-- Section Header -->
                    <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                        <div class="tw-flex tw-items-center">
                            <a :href="`${brand}/courses`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                                <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Your Training Packs</h2>
                            </a>
                        </div>
                        <div class="tw-flex tw-items-center">
                            <a :href="`${brand}/packs`" aria-label="See All Lessons In Progress" class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-mt-1"> 
                                See All 
                            </a>
                        </div>
                    </div>
                </div>
                <collection-wrapper
                    collection-type="pack"
                    default-sorts="-progress"
                    :hide-controls-section="true"
                    :infinite-scroll="false"
                    :limit="-1"
                    :pre-loaded-content="packDataObject"
                    :without-enrollment="true"
                ></collection-wrapper>
            </div>

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
    </div>
</template>

<script setup>
    import { computed, onMounted, ref } from 'vue';
    import TriggerBanner from '../components/Onboarding/TriggerBanner.vue';
    import StaticHeader from  '../components/HeaderCarousel/StaticHeader.vue';
    import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel.vue';
    import CohortBanner from '../components/CohortBanner/CohortBanner.vue';
    import MiniCatalogueSection from '../components/MiniCatalogueSection/MiniCatalogueSection.vue';
    import ListSection from '../components/ListSection/ListSection.vue';
    import CoachEvent from '../vuesora/components/Coaches/CoachEvent.vue';
    import StatsSection from '../components/StatsSection/StatsSection.vue';
    import LearningPathContainer from '../components/LearningPaths/LearningPathContainer.vue';
    import { useUserStore } from "../../stores/user";
    import {storeToRefs} from "pinia/dist/pinia";
    import MusoraIcon from '../components/MusoraIcons/MusoraIcon.vue';
    import PopularConversations from '../components/PopularConversations/PopularConversations.vue';

    //Pinia Stores
    const userStore = useUserStore();
    const { brand } = storeToRefs(userStore);

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
        hasExperience: { type: Boolean, default: false },
        hasGear: { type: Boolean, default: false },
        hasGenres: { type: Boolean, default: false },
        hasGoals: { type: Boolean, default: false },
        hasStartedLessons: { type: Boolean, default: false },
        hasTopics: { type: Boolean, default: false },
        hasUpcomingEvents: { type: Boolean, default: false },
        isPackOnly: { type: Number, default: 0 },
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
    });

    const showTriggerBanner = computed(() => {
        if(!props.isPackOnlyBoolean) return false; //hide for packs only
        return !props.hasGear || !props.hasTopics || !props.hasGenres || !props.hasExperience || !props.hasGoals;
    });

    const isPackOnlyBoolean = computed(() => {
      return Boolean(props.isPackOnly);
    });

    const courseDataObject = computed(() => {
        return JSON.parse(props.courseData);
    })

    const packDataObject = computed(() => {
        return { data: [...props.packData] };
    })

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
