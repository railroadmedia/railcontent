<template>
    <SkeletonVideoButtons v-if="isLoading" />

    <div v-else class="flex flex-row">
      <div class="flex flex-column next-prev-button-col mr-1" dusk="previous-lesson">
        <a v-if="prevLessonUrl" :href="prevLessonUrl" data-tooltip="Previous Lesson" class="tw-btn-secondary" :class="hasBrandedColor ? brandTextColor : 'tw-text-[#00101D] dark:tw-text-white'">
          <i class="fas fa-chevron-left"></i>
          <span class="hide-xs-only ml-1">{{ prevLabel || 'Previous Lesson' }}</span>
        </a>
        <a v-else class="tw-btn-secondary tw-text-[#d1d1d1] dark:tw-text-[#081825] no-events">
          <i class="fas fa-chevron-left"></i>
          <span class="hide-xs-only ml-1">{{ prevLabel || 'Previous Lesson' }}</span>
        </a>
      </div>

      <div class="flex flex-column">
        <div class="flex flex-row">
          <div v-if="hasQAVideo" class="flex flex-column ph-1">
            <button id="playQAVideo" data-tooltip="Play QnA Video" class="btn">
              <span :class="['qa', brand, ' inverted text-', brand]">
                <i class="fas fa-question-circle"></i>
                <span class="hide-xs-only ml-1">Watch Q&A</span>
              </span>
              <span :class="['lesson bg-', brand, ' inverted text-', brand]">
                <i class="fas fa-play"></i>
                <span class="hide-xs-only ml-1">Watch Lesson</span>
              </span>
            </button>
          </div>
        </div>
      </div>

      <div class="flex flex-column next-prev-button-col ml-1" dusk="next-lesson">
        <a v-if="nextLessonUrl" :href="nextLessonUrl" class="tw-btn-secondary" data-tooltip="Next Lesson" :class="hasBrandedColor ? brandTextColor : 'tw-text-[#00101D] dark:tw-text-white'">
          <span class="hide-xs-only mr-1">{{ nextLabel || 'Next Lesson' }}</span>
          <i class="fas fa-chevron-right"></i>
        </a>
        <a v-else class="tw-btn-secondary tw-text-[#d1d1d1] dark:tw-text-[#081825] no-events">
          <span class="hide-xs-only mr-1">{{ nextLabel || 'Next Lesson' }}</span>
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
    </div>
  </template>

<script setup>
import { computed } from 'vue';
import { usePlatformStore } from "@stores/platform";
import { storeToRefs } from "pinia/dist/pinia";
import { textColor } from '@constants/brands';
import SkeletonVideoButtons from '@collections/SkeletonLoader/SkeletonVideoButtons';

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const brandTextColor = computed(() => {
      return textColor[props.brand];
});

const props = defineProps({
  prevLessonUrl: String,
  nextLessonUrl: String,
  brand: String,
  prevLabel: String,
  nextLabel: String,
  hasQAVideo: Boolean,
  hasBrandedColor: Boolean,
})
</script>
