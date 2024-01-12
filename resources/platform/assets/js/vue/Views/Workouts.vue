<template>
    <Breadcrumb
        :breadcrumbs="[{ title: 'Workouts' }]"
    />

    <div class="lg:tw-container tw-mx-auto lg:tw-px-8 dark:tw-text-white tw-pt-6">
        <section v-if="carouselData.length">
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <div class="tw-flex tw-items-start">
                    <a :href="`/${brand}/workouts/challenges`" class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-2">Featured Challenges</a>
<!--                    <musora-icon @click="openVideo('//player.vimeo.com/video/785314424?autoplay=1')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>-->
                    <musora-icon @click="openModal('challenge')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
                </div>
                <a :href="`/${brand}/workouts/challenges`" class="tw-text-sm lg:tw-text-base xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    See All <span class="tw-hidden sm:tw-inline">Challenges</span>
                </a>
            </div>
            <hr class="tw-border-[#65656b40] dark:tw-border-[#223F57]" />
            <div class="tw-px-4 lg:tw-px-0">
                <HeaderCarousel :preloaded-carousel="carouselData"/>
            </div>
        </section>

        <br>

        <section id="workouts">
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <div class="tw-flex tw-items-start">
                    <div class="tw-text-[#00101D] dark:tw-text-white tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-2">Workouts</div>
<!--                    <musora-icon @click="openVideo('//player.vimeo.com/video/785314388?autoplay=1')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>-->
                    <musora-icon @click="openModal('workout')" icon-name="info" class="tw-inline-block dark:tw-text-[#80A0B9] tw-w-[27px] tw-h-[27px] tw-cursor-pointer"></musora-icon>
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
                    <div>
                        <transition appear name="fade">
                            <CatalogueCardContainer
                                :is-mini-view="true"
                                :pre-loaded-content="continueData"
                                :show-dropdown="true"
                            />
                        </transition>
                    </div>
                </section>
            </template>
        </section>
        <br>
        <section>
            <CollectionWrapper
                :collection-type="collectionType"
                :filterable-values="filterableValues"
                :include-future-scheduled-content-only = "includeFutureScheduledContentOnly"
                :pre-loaded-content="workoutData"
                :statuses="statuses"
                :tab-options="tabOptions"
            />
        </section>
    </div>

    <!-- VIDEOS -->
<!--    <ModalRenderer v-if="videoModalOpen">-->
<!--        <button @click="closeVideo"-->
<!--                class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">-->
<!--            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />-->
<!--        </button>-->
<!--        <div class="tw-w-full tw-mx-6 lg:tw-mx-0 lg:tw-w-1/2 tw-relative" style="padding-bottom: 56.25%;">-->
<!--            <iframe class="tw-absolute tw-w-full tw-h-full reset-on-close" :src="videoSrc" frameborder="0" allowfullscreen allow="autoplay" title="Challenge Video"></iframe>-->
<!--        </div>-->
<!--    </ModalRenderer>-->
    <!-- Info Modal -->
    <ModalRenderer v-if="modalType">
        <button @click="closeModal"
                class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-rounded-lg dark:tw-border dark:tw-border-[#223F57] dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-text-center tw-p-6 sm:tw-p-[30px] tw-max-w-[600px] tw-mx-4 sm:tw-mx-0">
            <h1 class="tw-font-bold tw-text-2xl tw-mb-4">{{ infoText[modalType].title }}</h1>
            <p class="tw-mb-4">{{ infoText[modalType].content }}</p>
            <button @click="closeModal" class="tw-btn-primary tw-border-[#000C17] dark:tw-border-white tw-text-[#000C17] dark:tw-text-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">Close</button>
        </div>
    </ModalRenderer>
</template>

<script setup>
// TODO: Attach the new component for continue section, or fix this implementation if necessary (no href)
import {computed, onMounted, ref} from "vue";
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

const tabOptions = computed(() => {
    if (props.tabs?.length) {
        return props.tabs.map(({ name, value, is_required_field, is_group_by }) => {
            return {
                key: (is_group_by) ? 'group_by,' + value:value,
                value: name,
                groupByView: (is_group_by) ? true : false,
            }
        })
    }
    return [];
});

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
