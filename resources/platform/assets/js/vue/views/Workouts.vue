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
<!--                    <musora-icon @click="openVideo('//player.vimeo.com/video/785314424?autoplay=1')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>-->
                    <musora-icon @click="openVideo('TODO')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
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
<!--                    <musora-icon @click="openVideo('//player.vimeo.com/video/785314388?autoplay=1')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>-->
                    <musora-icon @click="openVideo('TODO')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
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
                                :is-mini-view="true"
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

    <!-- VIDEOS -->
    <ModalRenderer v-if="videoModalOpen">
        <button @click="closeVideo"
                class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-w-full tw-mx-6 lg:tw-mx-0 lg:tw-w-1/2 tw-relative" style="padding-bottom: 56.25%;">
            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" :src="videoSrc" frameborder="0" allowfullscreen allow="autoplay" title="Challenge Video"></iframe>
        </div>
    </ModalRenderer>
</template>

<script setup>
import {ref} from "vue";
import { storeToRefs } from 'pinia';
import {useUserStore} from "../../stores/user";

import Breadcrumb from '../components/Breadcrumb/Breadcrumb';
import HeaderCarousel from '../components/HeaderCarousel/HeaderCarousel';
import CatalogueCardContainer from '../components/Catalogue/CatalogueCardContainer';
import CollectionWrapper from '../components/CollectionWrapper/CollectionWrapper';
import ModalRenderer from "../components/Modal/ModalRenderer";
import { XIcon } from "@heroicons/vue/solid";

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

const videoModalOpen = ref(false);
const videoSrc = ref('');

const openVideo = (src) => {
    videoModalOpen.value = true;
    videoSrc.value = src;
}

const closeVideo = () => {
    videoModalOpen.value = false;
}
</script>
