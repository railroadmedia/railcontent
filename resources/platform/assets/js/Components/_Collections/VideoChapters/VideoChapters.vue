<template>
  <SkeletonChapters v-if="isLoading" />

  <div v-else-if="chapters.length" class="tw-flex tw-flex-col">
      <div class="tw-flex tw-justify-between tw-items-center tw-mb-[30px]">
          <h3 class="tw-text-2xl tw-leading-[30px] tw-font-bold dark:tw-text-white">Chapters:</h3>
          <button class="btn collapse-square"
                  @click="isCollapsed = !isCollapsed">
              <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[35px] sm:tw-h-[50px] tw-w-[35px] sm:tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center" :class="!isCollapsed && 'tw-rotate-180'">
                  <i class="fas fa-chevron-down tw-text-lg"></i>
              </div>
          </button>
      </div>
    <section v-if="!isCollapsed" class="tw-pb-5 tw-mb-5 tw-flex tw-w-full tw-no-scrollbar tw-flex-wrap tw-gap-4">
      <div v-for="(chapter, index) in chapters"
          :key="index"
          class="tw-flex tw-items-center tw-w-full"
      >
        <!-- Chapter Thumbnail -->
        <button
          class="tw-overflow-hidden tw-flex tw-items-center tw-justify-center tw-relative tw-transition-colors dark:tw-bg-[#081825] tw-bg-[#EDEDED] tw-rounded-lg tw-mr-[10px] tw-shrink-0"
          :title="`Go To '${chapter.chapter_description}'`"
          @click="handleSeekToChapter(chapter.chapter_timecode)"
        >
          <img v-if="chapter.chapter_thumbnail_url"
              :src="chapter.chapter_thumbnail_url"
              :alt="`Chapter ${ index } thumbnail`"
              class="tw-rounded-[5px] tw-w-[115px] tw-object-cover"
          >
          <!-- Fallback -->
          <p v-else class="tw-font-bold tw-text-black tw-text-xl dark:tw-text-white tw-w-[115px]">Chapter {{ index + 1 }}</p>
          <!-- Hover State -->
          <div class="tw-cursor-pointer tw-bg-black/50 tw-z-10 tw-absolute tw-transition-opacity tw-opacity-0 hover:tw-opacity-100 tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center">
            <i class="fas fa-arrow-right tw-text-white tw-text-2xl"></i>
          </div>
        </button>
        <!-- Chapter Info Wrapper -->
        <div class="tw-w-full tw-flex tw-justify-between tw-items-center">
          <div class="tw-flex-grow tw-flex tw-flex-col">
            <div class="tw-text-sm dark:tw-text-white">{{ formatTime(chapter.chapter_timecode) }}</div>
            <div class="tw-w-full tw-pr-2">
                <p class="tw-font-bold dark:tw-text-white">{{ chapter.chapter_description }}</p>
            </div>
          </div>
          <div class="tw-hidden md:tw-flex tw-flex-shrink-0">
            <!-- Practice Button -->
            <button id="video-chapter-song"
                    class="tw-btn-primary tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-mr-2 tw-flex tw-justify-center tw-items-center tw-group tw-px-[25px] tw-h-[40px]"
                    @click="handleOpenSoundslice(chapter.chapter_description, index, chapter.chapter_timecode, false)"
                    title="Practice"
            >
              <musora-icon icon-name="practice-slice" class="tw-mr-[10px] tw-w-6" />
              Practice
            </button>
            <!-- Loop Button -->
            <button id="video-chapter-loop"
                  class="tw-flex tw-justify-center tw-items-center tw-btn-primary tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D] tw-px-[25px] tw-h-[40px]"
                  @click="handleOpenSoundslice(chapter.chapter_description, index, chapter.chapter_timecode, true)"
                  title="Loop"
            >
              <musora-icon icon-name="loop-slice" class="tw-mr-[10px] tw-w-6" />
              Loop
            </button>
          </div>
          <div class="tw-shrink-0 md:tw-hidden">
              <DropdownAlt :options="dropdownOptions" @practice="handleOpenSoundslice(chapter.chapter_description, index, chapter.chapter_timecode, false)" @loop="handleOpenSoundslice(chapter.chapter_description, index, chapter.chapter_timecode, true)" />
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { usePlatformStore } from "@stores/platform";
import { storeToRefs } from "pinia/dist/pinia";
import DropdownAlt from '@collections/Dropdown/DropdownAlt';
import MusoraIcon from "@units/MusoraIcons/MusoraIcon";
import SkeletonChapters from '@collections/SkeletonLoader/SkeletonChapters';

const props = defineProps({
chapters: {
  type: Array,
  default: () => [],
},
});

const emit = defineEmits([
'openSlice',
'seekToChapter'
]);

const platformStore = usePlatformStore();
const { isLoading } = storeToRefs(platformStore);

const isCollapsed = ref(false);

const formatTime = (seconds) => {
const mins = Math.floor(seconds / 60);
const secs = seconds % 60;
return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
};

const handleOpenSoundslice = (title, index, startTime, loop) => {
emit('openSlice', title, index + 1, startTime, loop);
};

const handleSeekToChapter = (startTime) => {
emit('seekToChapter', startTime);
}

const dropdownOptions = [
    {
        name: 'Practice',
        action: 'practice',
        icon: 'practice-slice',
        class: 'tw-w-5',
    },
    {
        name: 'Loop',
        action: 'loop',
        icon: 'loop-slice',
        class: 'tw-w-5',
    },
];

</script>
