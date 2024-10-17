<template>
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <a @click="handleSeeAllClick" :href="seeAllUrl"
                       class="tw-flex tw-items-center tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                        <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">{{ title }}</h2>
                        <ChevronRightIcon v-if="seeAllUrl" class="tw-w-5" />
                    </a>
                    <slot name="label"></slot>
                </div>
                <div v-if="showPagination" class="tw-flex tw-items-center">
                    <div class="tw-hidden lg:tw-flex">
                        <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57] tw-mr-[10px]" :disabled="isFirstPage" @click="prevPage"><ChevronLeftIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
                        <button class="tw-w-[30px] tw-h-[30px] tw-flex tw-justify-center tw-items-center tw-rounded-full tw-border tw-border-[#B2B2B5] dark:tw-border-[#223F57] tw-bg-white dark:tw-bg-[#081825] tw-text-[#000C17] dark:tw-text-white hover:tw-bg-[#000C17] hover:tw-border-[#000C17] hover:tw-text-white dark:hover:tw-bg-[#223F57] disabled:tw-bg-[#F4F4F5] disabled:hover:tw-border-[#B2B2B5] disabled:hover:tw-bg-white dark:disabled:hover:tw-bg-[#081825] disabled:tw-text-[#B2B2B5] dark:disabled:tw-text-[#223F57] dark:disabled:tw-border-[#223F57]" :disabled="isLastPage" @click="nextPage"><ChevronRightIcon class="tw-w-[20px] tw-h-[20px]"  /></button>
                    </div>
                </div>
            </div>
            <div>
                <transition appear name="fade">
                    <ChallengeCarousel v-if="isChallenge" />
                    <ChallengeAwardContainer v-else-if="isChallengeAward" />
                    <CatalogueCardContainer
                        v-else
                        :force-no-links="forceNoLinks"
                        :is-mini-view="isMiniView"
                        :pre-loaded-content="data"
                        :show-dropdown="showDropdown"
                        :tracking-section="trackingSection"
                        :page="page"
                        :is-mini-catalogue="true"
                        @on-progress-reset="resetProgress"
                    />
                </transition>
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';
import CatalogueCardContainer from '@collections/Catalogue/CatalogueCardContainer';
import ChallengeCarousel from '@collections/ChallengeCarousel/ChallengeCarousel';
import { useUserStore } from '@stores/user';
import userJourney from '@services/userJourney';
import useCarouselEvents from "@hooks/useCarouselEvents";
import { getCardNum } from '@collections/MiniCatalogueSection/getCardNum';
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import ChallengeAwardContainer from '@collections/ChallengeAwardContainer/ChallengeAwardContainer';

const props = defineProps({
  seeAllUrl: {
    type: String,
    default: ''
  },
  contentEndpoint: {
    type: String,
    default: '/railcontent/content'
  },
  preLoadedContent: {
    type: Object,
    default: ''
  },
  title: {
    type: String,
    default: ''
  },
  isMiniView: {
    type: Boolean,
    default: false
  },
  forceNoLinks: {
    type: Boolean,
    default: false
  },
  seeAllAriaLabel: {
    type: String,
    default: ''
  },
  showDropdown: {
    type: Boolean,
    default: () => false,
  },
  useRefData: {
    type: Boolean,
    default: () => false,
  },
  trackCardClick: {
    type: Boolean,
    default: () => false,
  },
  trackingSection: {
    type: String,
    default: ''
  },
  catalogueType: {
    type: String,
    default: ''
  },
});

const userStore = useUserStore();

const data = ref([]);
const page = ref(1);
const cardNum = ref(5);

const isChallenge = computed(() => {
    return props.catalogueType === 'challenge';
})

const isChallengeAward = computed(() => {
    return props.catalogueType === 'challengeAward';
})

const handleSeeAllClick = (event) => {
  if (props.seeAllUrl && props.trackingSection) {
    event.preventDefault();

    userJourney.trackHomeSeeAll({
      payload: {
        brand: userStore.brand,
        section: props.trackingSection,
      }
    }).finally(() => {
      window.location.href = props.seeAllUrl;
    });
  }
};

const watchResize = () => {
    getCardNum(props, cardNum);

    getPageData();
}

onMounted(() => {
    watchResize();
    window.addEventListener('resize', watchResize);
})

onUnmounted(() => {
    window.removeEventListener('resize', watchResize);
})

//in case preLoadedContent is an empty array on rendering and it gets updated after
watch(
    () => props.preLoadedContent,
    (newData) => {
        setOriginal(newData);
    },
)

const { showPagination, isFirstPage, isLastPage, getPageData, resetProgress, nextPage, prevPage, setOriginal, } = useCarouselEvents(props.preLoadedContent, data, page, cardNum);
</script>
