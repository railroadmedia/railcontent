<template>
    <section class="tw-flex tw-flex-row" :class="isMiniView ? 'tw-mb-[18px]' : 'tw-mb-[14px] lg:tw-mb-[6px]'" >
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- Section Title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
                <a :href="seeAllUrl"
                    class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    <h2 class="tw-font-bold tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">{{ title }}</h2>
                </a>
                <a :href="seeAllUrl" :aria-label="seeAllAriaLabel"
                    class="tw-text-sm md:tw-text-base md:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
                    See All
                </a>
            </div>
            <div>
                <transition appear name="fade">
                    <CatalogueCardContainer
                        :force-no-links="forceNoLinks"
                        :is-mini-view="isMiniView"
                        :pre-loaded-content="preLoadedContent"
                        :show-dropdown="showDropdown"
                        :use-ref-data="useRefData"
                    />
                </transition>
            </div>
        </div>
    </section>
</template>

<script setup>
import CatalogueCardContainer from '../Catalogue/CatalogueCardContainer.vue';

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
});
</script>
