<template>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 ">
        <Breadcrumb :breadcrumbs="[{ title: 'Workouts' }]"/>
    </div>
    <div class="lg:tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-6">
        <section v-if="carouselData.length">
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-start">
                    <a :href="`/${brand}/workouts/challenges`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-2">Featured Challenges</a>
<!--                    <musora-icon @click="openVideo('//player.vimeo.com/video/785314424?autoplay=1')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>-->
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
<!--                    <musora-icon @click="openVideo('//player.vimeo.com/video/785314388?autoplay=1')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>-->
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
            <template v-if="continueData.data.length">
                <section class="dark:tw-text-white tw-mb-4">
                    <!-- Section Title -->
                    <div class="tw-flex tw-items-center tw-mt-5 tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                        <a :href="`/${brand}/lesson-history/in-progress`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                            <h3 class="tw-font-bold tw-text-xl md:tw-text-2xl">Continue</h3>
                        </a>
                        <a :href="`/${brand}/lesson-history/in-progress`"
                           aria-label="See All Subscribed Lessons"
                           class="tw-text-sm lg:tw-text-base xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current"
                        >
                            See All
                        </a>
                    </div>
                    <div class="tw-px-4 lg:tw-px-0">
                        <transition appear name="fade">
                            <CatalogueCardContainer
                                :is-mini-view="true"
                                :pre-loaded-content="continueData.data"
                                :show-dropdown="true"
                                :no-skeleton="true"
                            />
                        </transition>
                    </div>
                </section>
            </template>
        </section>
        <br>
        <CollectionWrapper
            :collection-type="collectionType"
            :filterable-values="filterableValues"
            :include-future-scheduled-content-only = "includeFutureScheduledContentOnly"
            :pre-loaded-content="workoutData"
            :statuses="statuses"
            :tabs="tabs"
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
// TODO: Attach the new component for continue section, or fix this implementation if necessary (no href)
import { ref } from "vue";
import { storeToRefs } from 'pinia';
import { useUserStore } from "../../Stores/user";

import Tooltip from '../Tooltip/Tooltip';
import Breadcrumb from '../Breadcrumb/Breadcrumb';
import HeaderCarousel from '../HeaderCarousel/HeaderCarousel';
import CatalogueCardContainer from '../Catalogue/CatalogueCardContainer';
import CollectionWrapper from '../CollectionWrapper/CollectionWrapper';
import InfoModal from "../Modal/InfoModal";
import MuButton from '../Button/MuButton';

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
    tabs: {
        type: Array,
        default: () => [],
    },
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const modalType = ref(false);
// const videoModalOpen = ref(false);
// const videoSrc = ref('');
//
// const openVideo = (src) => {
//     videoSrc.value = src;
//     videoModalOpen.value = true;
// }
//
// const closeVideo = () => {
//     videoModalOpen.value = false;
// }
//
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
</script>
