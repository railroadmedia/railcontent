<template>
    <div :class="`tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 bg-${brand} tw-rounded-[10px] tw-mt-3`">
      <div class="content-progress flex flex-row flex-wrap tw-py-6">
        <div v-if="labelText" class="flex flex-column left-column align-v-center">
          <h3 :class="`display ${brandTextColor} nowrap`">{{ labelText }}</h3>
        </div>
        <div class="flex flex-column">
          <div :class="`flex flex-row trophy-progress-bar mr-2 bg-${brand} bg-darken ${isCompleted ? 'complete' : ''}`">
            <div :class="`flex flex-column trophy-progress-cutoff bg-${brand} inverted relative`">
              <span :class="`progress-border ba-${brand}-5 border-darken absolute-fill`"></span>
              <span
                :data-current-progress="progress"
                class="trophy-progress relative bg-white"
                :style="{ transform: `translateX(${progress - 100}%)` }"
              >
                <span :class="`progress-percent body tw-font-bold ${brandTextColor} ${progress > 50 ? '' : 'right'}`">
                  {{ Math.round(progress) }}%
                </span>
              </span>
            </div>
            <div class="flex flex-column align-center trophy ph-2 title">
              <div :class="`reward flex flex-row ${brandTextColor} align-v-center dense tw-text-xs font-bold nowrap`">
                <i :class="`fas fa-trophy ${brandTextColor}`"></i>
                <span v-if="xpAmount">&nbsp;&nbsp;{{ xpAmount }} XP</span>
              </div>
              <div :class="`white-underlay ba-${brand}-5 ${progress === 100 ? 'visible' : ''} border-darken`"></div>
            </div>
          </div>
        </div>
        <div class="tw-flex tw-flex-col tw-text-white tw-w-full sm:tw-w-auto tw-justify-center">
          <a v-if="!showCompleteButton"
             :href="isCompleted ? backButton.url : nextLessonUrl"
             class="tw-btn-secondary tw-text-lg tw-mb-0 tw-leading-[0] tw-border-[3px] tw-text-white"
          >
            <span v-if="!isCompleted">
              <span v-if="isStarted">Next Lesson &raquo;</span>
              <span v-else>Start First Lesson</span>
            </span>
            <span v-else v-html="backButton.text"></span>
          </a>
          <div v-else class="tw-flex">
            <button class="btn resetProgress"
                    :data-brand="brand"
                    :data-content-id="contentId"
                    title="Reset Progress"
                    @click="resetProgress"
            >
              <span class="bg-white inverted tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                <i class="fas fa-undo tw-text-white reset tw-mb-0.5 tw-text-lg" aria-hidden="true"></i> Reset
              </span>
            </button>
            <button class="btn completeButton tw-text-base"
                    :class="isCompleted ? 'is-complete' : ''"
                    dusk="master-complete-button"
                    title="Mark Lesson as Complete"
                    :data-brand="brand"
                    :data-content-id="contentId"
                    @click="toggleComplete"
            >
              <span class="incompleted bg-white inverted tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                <div class="tw-border-2 tw-border-white tw-rounded-full tw-px-1 tw-mb-1.5">
                  <i class="fas fa-check tw-text-[10px] tw-mb-1"></i>
                </div> Complete
              </span>
              <span class="completed tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                <div class="tw-border-2 tw-border-white tw-bg-white tw-rounded-full tw-px-1 tw-mb-1.5">
                  <i :class="`fas fa-check tw-text-[10px] tw-mb-1 ${brandTextColor}`"></i>
                </div> Completed
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  // TODO: We might need to test corner cases if this is implemented in templates different than the LessonPlayback
  import { ref, computed } from 'vue';
  import { textColor } from '../../../constants/brands';
  
  const props = defineProps({
    labelText: String,
    brand: String,
    isCompleted: Boolean,
    progress: Number,
    xpAmount: String,
    isStarted: Boolean,
    backButton: Object,
    nextLessonUrl: String,
    showCompleteButton: Boolean,
    contentId: Number
  });
  
  const brandTextColor = computed(() => {
    return textColor[props.brand];
  });
  
  const resetProgress = () => {
    // Add logic for resetting progress
    console.log('Reset progress');
  }
  
  const toggleComplete = () => {
    // Add logic for marking lesson as complete/incomplete
    console.log('Toggle complete');
  }
  </script>
  
  <style scoped>
  .complete {
    /* Add styles for completed state */
  }
  .is-complete {
    /* Add styles for complete button */
  }
  </style>
  