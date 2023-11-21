<template>
  <section class="tw-flex tw-flex-row tw-mb-[30px]">
    <div class="tw-flex tw-flex-col tw-w-full">
      <!-- Section Title -->
      <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between tw-px-4 lg:tw-px-0">
        <a :href="newContentUrl"
          class="tw-text-[#00101D] dark:tw-text-white tw-pb-1 tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
          <h2 class="tw-font-bold tw-text-2xl tw-leading-none lg:tw-leading-none lg:tw-text-3xl">New Releases</h2>
        </a>
        <a :href="newContentUrl" aria-label="See All Lessons In Progress"
          class="tw-text-base xl:tw-text-lg xl:tw-leading-none tw-uppercase tw-leading-none tw-font-bebas-neue tw-text-[#00101D] dark:tw-text-white tw-border-b tw-border-transparent tw-transition-all hover:tw-border-current">
          See All
        </a>
      </div>
      <div>
        <transition appear name="fade">
          <CatalogueCardContainer :pre-loaded-content="newContent" :show-dropdown="true" />
        </transition>
      </div>
    </div>
  </section>
</template>

<script setup>
import CatalogueCardContainer from '../Catalogue/CatalogueCardContainer.vue';

const props = defineProps({
  newContentUrl: {
    type: String,
    default: ''
  },
  contentEndpoint: {
    type: String,
    default: '/railcontent/content'
  },
  newContent: {
    type: Object,
    default: ''
  }
});
</script>
