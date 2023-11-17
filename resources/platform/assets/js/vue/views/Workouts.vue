<template>
    <Breadcrumb
        :last-level-url="breadcrumbLastLevelUrl"
        :last-level-title="breadcrumbLevelTitle"
    />

    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white tw-pt-6">
        <section>
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <div class="tw-flex tw-items-start">
                    <a :href="`/${brand}/workouts/challenges`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mr-2">Featured Challenges</a>
                    <musora-icon icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
                </div>
                <a :href="`/${brand}/workouts/challenges`" class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    See All Challenges
                </a>
            </div>
            <hr class="tw-border-[#65656b40] dark:tw-border-[#223F57]" />
            <HeaderCarousel :preloaded-carousel="carouselData" />
        </section>
        <br>
        <section>
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <div class="tw-flex tw-items-start">
                    <a href="TODO" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl tw-mr-2">Workouts</a>
                    <musora-icon icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
                </div>
            </div>
            <hr class="tw-border-[#65656b40] dark:tw-border-[#223F57]" />
            <template v-if="continueData">
                <section class="tw-container tw-mx-auto dark:tw-text-white lg:tw-px-4">
                    <!-- Section Title -->
                    <div class="tw-flex tw-items-center tw-mt-5 tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                        <a :href="`/${brand}/lesson-history/in-progress`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            <h3 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">Continue</h3>
                        </a>
                        <a :href="`/${brand}/lesson-history/in-progress`"
                           aria-label="See All Subscribed Lessons"
                           class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                        >
                            See All
                        </a>
                    </div>
                    <div>
                        <transition appear name="fade">
                            <CatalogueCardContainer
                                catalogue-type="grid"
                                no-results-message="Looks like you haven't started any lessons.
                Once you watch a video, it will show up here for you to access later."
                                :six-wide="true"
                                :show-filter="false"
                                :pre-loaded-content="continueData"
                            />

                        </transition>
                    </div>
                </section>
            </template>
        </section>
        <br>
        <section>
            <collection-wrapper
                :collection-type="collectionType"
                :filterable-values="filterableValues"
                :include-future-scheduled-content-only = "
                includeFutureScheduledContentOnly"
                :pre-loaded-content="workoutData"
                :statuses="statuses"
            />
        </section>
    </div>
</template>

<script setup>
import { storeToRefs } from 'pinia';
import {useUserStore} from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel';
import CatalogueCardContainer from '../components/Catalogue/CatalogueCardContainer';
import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper';

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
        type: Array,
        default: () => []
    },
    workoutData: {
        type: Array,
        default: () => []
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
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>
