<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <!-- Breadcrumb -->
        <Breadcrumb :breadcrumbs="breadcrumbs" />

        <!-- Page Header -->
        <PageHeader
            title="Coaches"
            icon-name="whistle"
            class="tw-mb-[30px]"
            :description="headerDescriptions[brand]"
        />

        <!-- Need to integrate with MCS -->
        <!-- Coach Event -->
        <CoachEvent
            v-if="hasCoachEvent"
            :preloaded-content="coachEvent"
            :current-date-string="coachEventCurrentDateString"
            :subscription-calendar-id="coachEventSubscriptionCalendarId"
            :youtube-event-id="coachEventYoutubeEventId"
            :time-cutoff-minutes="coachEventTimeCutoffMinutes"
        />

        <!-- Featured Coach -->
        <div class="tw-mb-[30px]" v-if="featuredCoachLength.length || formattedFeaturedCoaches.length">
            <div class="tw-flex tw-flex-row">
                <div class="tw-flex tw-flex-col tw-flex-grow">
                    <div class="tw-text-[#00101D] dark:tw-text-white tw-pb-1">
                        <h2 class="tw-font-bold tw-text-xl md:tw-text-2xl tw-mb-[15px]">
                            Featured Coach
                        </h2>
                    </div>
                    <HeaderCarousel
                        v-if="featuredCoachLength > 1"
                        :preloaded-carousel="formattedFeaturedCoaches"
                    />
                    <template v-if="formattedFeaturedCoaches.length">
                        <StaticHeader
                            v-for="(formattedCoach,i) in formattedFeaturedCoaches"
                            :key="i"
                            :top-subtitle="formattedCoach.subtitle"
                            title-classes="tw-text-[#FAA300]"
                            :title="formattedCoach.title"
                            :cta-text="formattedCoach.primary_cta_text"
                            :description="formattedCoach.description"
                            :cta-url="formattedCoach.primary_cta_url"
                            :img="formattedCoach.img"
                        />
                    </template>
                </div>
            </div>
        </div>

        <!-- Latest Featured Lessons -->
        <div class="tw-mb-[30px]">
            <MiniCatalogueSection
                title="Latest Featured Lessons"
                :pre-loaded-content="featuredLessons"
            />
        </div>

        <!-- Need to integrate with MCS -->
        <!-- Upcoming Coaches -->
        <UpcomingCoach v-if="hasUpcomingCoaches" :upcoming-coaches="upcomingCoaches" />

        <ActiveCoach :active-coaches="activeCoaches"/>

        <CollectionWrapper collection-type="coach" :tab-options="tabData" />
    </div>
</template>
<script setup>
import {computed, onBeforeMount, ref} from "vue";
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import { useCollectionStore } from "@stores/collection";
import { getActiveCoaches } from "@hooks/pages/useCoachIndexPageData";
import { fetchByReference } from 'musora-content-services';

import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import PageHeader from '@collections/PageHeader/PageHeader';
import CoachEvent from "@vuesora/Components/Coaches/CoachEvent";
import StaticHeader from '@collections/HeaderCarousel/StaticHeader';
import HeaderCarousel from '@collections/HeaderCarousel/HeaderCarousel';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection';
import UpcomingCoach from '@collections/UpcomingCoach/UpcomingCoach';
import ActiveCoach from '@collections/ActiveCoach/ActiveCoach';
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';
import {usePlatformStore} from "@stores/platform";

const props = defineProps({
    coachEvent: {
        type: Object,
        default: () => ({}),
    },
    coachEventCurrentDateString: {
        type: String,
        default: () => "",
    },
    featuredCoaches: {
        type: [Object, Array],
        default: () => [],
    },
    followedLessons: {
        type: Object,
        default: {},
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
    coachEventSubscriptionCalendarId: {
        type: String,
        default: () => "",
    },
    coachEventTimeCutoffMinutes: {
        type: Number,
        default: () => 0,
    },
    trackingSection: {
        type: String,
        default: () => "",
    },
    coachEventYoutubeEventId: {
        type: String,
        default: () => "",
    },
    upcomingCoaches: {
        type: Array,
        default: () => [],
    },
})

const collectionStore = useCollectionStore();
const userStore = useUserStore();
const platformStore = usePlatformStore();

const { brand } = storeToRefs(userStore);
const { isLoading } = storeToRefs(platformStore);

const activeCoaches = ref([]);
const featuredLessons = ref([]);

const hasCoachEvent = computed(() => {
    return Object.keys(props.coachEvent.data).length > 0;
})

const featuredCoachLength = computed(() => {
    return props.featuredCoaches?.results?.length;
})

const formattedFeaturedCoaches = computed(() => {
    return props.featuredCoaches?.results?.map((coach) => {
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

const breadcrumbs = [
    {
        title: 'Coaches'
    }
];

const tabData = [
    {
        value: 'All Coaches',
        groupByView: false,
        key: '',
    },
];

const headerDescriptions = {
    drumeo: 'Your drumming journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best drummers in the world!',
    pianote: 'Your piano journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best pianists in the world!',
    guitareo: 'Tackle your next guitar goal with bite-sized courses from many of the world\'s best guitarists.',
    singeo: 'Your singing journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best singers and vocal coaches in the world!',
}

onBeforeMount(async() => {
    const featured = await fetchByReference(brand.value, { includedFields: ['is_featured']});
    featuredLessons.value = featured.entity;

    //Needs to be updated when BE figures out the subscribed feature
    const coaches = await getActiveCoaches();
    activeCoaches.value = coaches;

    //Needs to be updated when BE figures out the subscribed feature
    collectionStore.setDefaults({
        tabOptions: tabData,
        filter: {
            sort: 'slug'
        },
        queryType: 'instructor',
    });
})
</script>
