<template>
    <div class="flex flex-row">
      <div class="flex flex-column next-prev-button-col mr-1" dusk="previous-lesson">
        <a v-if="prevLessonUrl" :href="prevLessonUrl" data-tooltip="Previous Lesson" :class="['tw-btn-secondary', `tw-text-${brand}`]">
          <i class="fas fa-chevron-left"></i>
          <span class="hide-xs-only ml-1">{{ prevLabel || 'Previous Lesson' }}</span>
        </a>
        <a v-else class="tw-btn-secondary tw-text-gray-400 dark:tw-text-[#7E9AB1] no-events">
          <i class="fas fa-chevron-left"></i>
          <span class="hide-xs-only ml-1">{{ prevLabel || 'Previous Lesson' }}</span>
        </a>
      </div>
  
      <div class="flex flex-column">
        <div class="flex flex-row">
          <div v-if="hasQAVideo" class="flex flex-column ph-1">
            <button id="playQAVideo" data-tooltip="Play QnA Video" class="btn">
              <span :class="['qa bg-', brand, ' inverted text-', brand]">
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
        <a v-if="nextLessonUrl" :href="nextLessonUrl" class="tw-btn-secondary" :class="`tw-text-${brand}`" data-tooltip="Next Lesson">
          <span class="hide-xs-only mr-1">{{ nextLabel || 'Next Lesson' }}</span>
          <i class="fas fa-chevron-right"></i>
        </a>
        <a v-else class="tw-btn-secondary tw-text-gray-400 dark:tw-text-[#7E9AB1] no-events">
          <span class="hide-xs-only mr-1">{{ nextLabel || 'Next Lesson' }}</span>
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      prevLessonUrl: String,
      nextLessonUrl: String,
      brand: String,
      prevLabel: String,
      nextLabel: String,
      hasQAVideo: Boolean
    }
  };
  </script>
  