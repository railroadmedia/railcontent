<template>
    <aside
      class="tw-w-full tw-col-span-3 xl:tw-row-span-4 tw-flex tw-flex-col xl:tw-mb-4 xl:tw-mt-0 xl:tw-col-span-1"
      :class="{ 'xl:tw-hidden': !isRelatedSectionOpen }">

      <SkeletonRelatedLessons v-if="isLoading" />

      <div v-else class="tw-flex tw-w-full">
        <div
          class="tw-w-full tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-overflow-hidden tw-transition-all">
          <header class="tw-flex tw-flex-col">
            <div
              class="tw-bg-white dark:tw-bg-[#081825] tw-pt-[24px] tw-pb-[16px] tw-flex tw-justify-between tw-px-[18px]">
              <h3 class="tw-text-xl tw-font-bold tw-font-open-sans dark:tw-text-white">Related Lessons</h3>
              <button @click="toggleRelatedSection"
                class="tw-text-black dark:tw-text-white tw-hidden xl:tw-inline-block">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M27.55 11.5L27.55 26.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M17.1334 24.5L22.55 19M22.55 19L17.1334 13.5M22.55 19L9.55005 19"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
              <button class="tw-z-10 lg:tw-hidden" @click="isCollapsed = !isCollapsed">
                <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[35px] tw-w-[35px] tw-rounded-full tw-flex tw-justify-center tw-items-center"
                     :class="!isCollapsed && 'tw-rotate-180'">
                    <i class="fas fa-chevron-down"></i>
                </div>
              </button>
            </div>
          </header>
          <!-- Cards -->
          <section
            class="tw-w-full tw-flex-col tw-max-h-[1000px] tw-relative tw-overflow-y-auto lg:tw-block"
            :class="isCollapsed ? 'tw-hidden' : 'tw-flex'"
          >
            <div v-for="(item, i) in relatedLessons" :key="i"
              class="tw-group tw-flex tw-w-full tw-items-center tw-transition-colors hover:tw-bg-[#E0E0E1] dark:hover:tw-bg-[#102230] even:tw-bg-white dark:even:tw-bg-[#081825] tw-px-2">
              <CatalogueListElement :item="item" :content-type="item.type" :show-my-list-action="true" :is-challenge="isChallenge" />
            </div>
          </section>
        </div>
      </div>
    </aside>
  </template>

<script setup>
import { ref } from 'vue';
import { usePlatformStore } from "@stores/platform";
import { storeToRefs } from "pinia/dist/pinia";
import CatalogueListElement from '@collections/Catalogue/CatalogueListElement.vue';
import SkeletonRelatedLessons from '@collections/SkeletonLoader/SkeletonRelatedLessons';

const props = defineProps({
  isRelatedSectionOpen: {
    type: Boolean,
    required: true
  },
  relatedLessons: {
    type: [Object, Array],
    required: true
  },
  isChallenge: {
    type: Boolean,
    default: false
  }
});

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const isCollapsed = ref(false);

const emit = defineEmits(['update:isRelatedSectionOpen']);

const toggleRelatedSection = () => {
emit('update:isRelatedSectionOpen', !props.isRelatedSectionOpen);
};
</script>
