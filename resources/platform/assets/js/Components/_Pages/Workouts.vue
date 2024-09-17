<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 ">
        <Breadcrumb :breadcrumbs="[{ title: 'Workouts' }]"/>
    </div>

    <div class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-6">

        <section v-if="carouselData.length">
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-start">
                    <a :href="`/${brand}/workouts/challenges`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-2">Featured Challenges</a>
                    <div class="tw-hidden lg:tw-block">
                        <Tooltip position="right">
                            <template v-slot:trigger>
                                <musora-icon icon-name="info" class="tw-w-[27px] tw-h-[27px] tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                            </template>
                            <template v-slot:content>
                                <div class="tw-max-w-[350px]">
                                    <h1 class="tw-text-lg tw-font-extrabold tw-mb-2">What is a Challenge?</h1>
                                    <div>{{ infoText['challenge']['content'] }}</div>
                                </div>
                            </template>
                        </Tooltip>
                    </div>
                    <div class="tw-relative lg:tw-hidden">
                        <musora-icon @click="openModal('challenge')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px]"></musora-icon>
                    </div>
                </div>
                <a :href="`/${brand}/workouts/challenges`" class="tw-text-sm lg:tw-text-base xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    See All <span class="tw-hidden sm:tw-inline">Challenges</span>
                </a>
            </div>
            <hr class="tw-border-[#65656b40] dark:tw-border-[#223F57]" />
            <HeaderCarousel :preloaded-carousel="carouselData"/>
        </section>

        <br>

        <section id="workouts">
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-start">
                    <div class="tw-text-[#00101D] dark:tw-text-white tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-2">Workouts</div>
                    <div class="tw-hidden lg:tw-block">
                        <Tooltip position="right">
                            <template v-slot:trigger>
                                <musora-icon icon-name="info" class="tw-w-[27px] tw-h-[27px] tw-cursor-pointer tw-text-[#65656B] dark:tw-text-[#80A0B9]"></musora-icon>
                            </template>
                            <template v-slot:content>
                                <div class="tw-max-w-[350px]">
                                    <h1 class="tw-text-lg tw-font-extrabold tw-mb-2">What is a Workout?</h1>
                                    <div>{{ infoText['workout']['content'] }}</div>
                                </div>
                            </template>
                        </Tooltip>
                    </div>
                    <div class="tw-relative lg:tw-hidden">
                        <musora-icon @click="openModal('workout')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
                    </div>
                </div>
            </div>
            <hr class="tw-border-[#65656b40] dark:tw-border-[#223F57]" />
            
            <!-- Continue section -->
            <div v-if="continueSection.length">
                <MiniCatalogueSection
                    title="Continue"
                    seeAllAriaLabel="See All Workouts In Progress"
                    :seeAllUrl="`/${brand}/lesson-history/in-progress?sort=-published_on&included_fields%5B%5D=type%2CSong&tabs%5B%5D=inProgress&included_user_states%5B%5D=started`"
                    :preLoadedContent="continueSection"
                    :isMiniView="true"
                    :show-dropdown="true"
                    :use-ref-data="true"
                    trackingSection="continue"
                />
            </div>
        </section>
        
        <br>
        
        <CollectionWrapper
            :collection-type="collectionType"
            :filterable-values="filterableValues"
            :include-future-scheduled-content-only="includeFutureScheduledContentOnly"
            :pre-loaded-content="workoutData"
            :statuses="statuses"
            :tab-options="tabData"
            :is-admin="isAdmin"
        />
    </div>

    <InfoModal v-if="modalType" :self-contained="true" :title="infoText[modalType].title" @onClose="closeModal" class-override="tw-max-w-[600px] tw-w-full">
        <p class="tw-mb-4 dark:tw-text-white">{{ infoText[modalType].content }}</p>
        <div class="tw-flex tw-justify-end">
            <MuButton @click="closeModal" variant="secondary">Close</MuButton>
        </div>
    </InfoModal>
</template>

<script setup>
import { onBeforeMount, ref } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "@stores/user";
import { useCollectionStore } from "@stores/collection";
import { fetchContentInProgress, fetchByRailContentIds } from 'musora-content-services';

import Tooltip from '@collections/Tooltip/Tooltip';
import Breadcrumb from '@collections/Breadcrumb/Breadcrumb.vue';
import HeaderCarousel from '@collections/HeaderCarousel/HeaderCarousel';
import MiniCatalogueSection from '@collections/MiniCatalogueSection/MiniCatalogueSection.vue';
import CollectionWrapper from '@collections/CollectionWrapper/CollectionWrapper';
import InfoModal from "@collections/Modal/InfoModal";
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    breadcrumbLastLevelUrl: {
        type: String,
        default: ''
    },
    breadcrumbLevelTitle: {
        type: String,
        default: ''
    },
    carouselData: {
        type: Array,
        default: () => []
    },
    continueData: {
        type: [Array, Object],
        default: () => []
    },
    workoutData: {
        type: [Array, Object],
        default: () => [],
    },
    collectionType: {
        type: String,
        default: ''
    },
    filterableValues: {
        type: Array,
        default: () => [],
    },
    includeFutureScheduledContentOnly: {
        type: Boolean,
        default: () => false,
    },
    statuses: {
        type: Array,
        default: () => ["published"],
    },
    isAdmin: {
        type: Boolean,
        default: () => false,
    },
});

const collectionStore = useCollectionStore();
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const modalType = ref(false);
const isLoading = ref(true); // Loading state ref
const continueSection = ref([]); // Ref for storing started lessons

const openModal = (type) => {
    modalType.value = type;
}

const closeModal = () => {
    modalType.value = false;
}

const infoText = {
    challenge: {
        title: 'What is a Challenge?',
        content: 'Challenges are a collection of Workout-style videos that build your skills one step at a time. They help you develop broader musical skills at a manageable pace — usually over a few days.',
    },
    workout: {
        title: 'What is a Workout?',
        content: 'Workouts are fun play-along lessons that help hone your musical skills. They cover various topics, and have multiple difficulty and duration options — so there’s always a perfect Workout for you. Just pick one, press start, and play along!',
    },
}

const tabData = [
    {
        value : "All",
        groupByView: false,
        key: ""
    },
    {
        value : "5 Minutes",
        groupByView: false,
        key: ["length_in_seconds < 450"]
    },
    {
        value : "10 Minutes",
        groupByView: false,
        key: [
            "length_in_seconds > 451",
            "length_in_seconds < 751"
        ]
    },
    {
        value : "15+ Minutes",
        groupByView: false,
        key: ["length_in_seconds > 750"]
    },
    {
        value: "Instructors",
        groupByView: true,
        key: ["instructor"]
    }
]

onBeforeMount(async () => {
    isLoading.value = true;
    try {
        // Fetch started content (in-progress workouts)
        const startedIds = await fetchContentInProgress('workout', brand.value);
        const lessons = await fetchByRailContentIds(startedIds.started);
        const startedLessons = lessons.filter(lesson => startedIds.started.includes(lesson.id));

        // Set the continue section with started workouts
        continueSection.value = startedLessons;

        // Set default collection store values
        collectionStore.setDefaults({
            tabOptions: tabData,
            filter: {
                sort: '-published_on'
            },
            queryType: 'workout',
        });
    } catch (error) {
        console.error('Error fetching continue section data:', error);
    } finally {
        isLoading.value = false;
    }
});
</script>
