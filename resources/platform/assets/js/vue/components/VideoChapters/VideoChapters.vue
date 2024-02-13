<template>
  <div class="tw-flex tw-flex-col">
      <div class="tw-flex tw-justify-between tw-items-center tw-mb-10">
          <h3 class="tw-text-2xl tw-leading-[30px] tw-font-bold dark:tw-text-white">Chapters:</h3>
          <button class="btn collapse-square"
                  @click="isCollapsed = !isCollapsed">
              <div class="tw-border-2 tw-text-[#000C17] tw-border-[#000C17] dark:tw-text-white dark:tw-border-white tw-h-[50px] tw-w-[50px] tw-rounded-full tw-flex tw-justify-center tw-items-center" :class="isCollapsed && 'tw-rotate-180'">
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
          :title="`Go To '${chapter.title}'`"
          @click="handleSeekToChapter(chapter.time)"
        >
          <img v-if="chapter.thumbnail"
              :src="chapter.thumbnail"
              :alt="`Chapter ${ index } thumbnail`"
              class="tw-rounded-[5px] tw-w-[115px] tw-object-cover"
          >
          <!-- Fallback -->
          <p v-else class="tw-font-bold tw-text-black tw-text-xl dark:tw-text-white">Chapter {{ index + 1 }}</p>
          <!-- Hover State -->
          <div class="tw-cursor-pointer tw-bg-black/50 tw-z-10 tw-absolute tw-transition-opacity tw-opacity-0 hover:tw-opacity-100 tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center">
            <i class="fas fa-arrow-right tw-text-white tw-text-2xl"></i>
          </div>
        </button>
        <!-- Chapter Info Wrapper -->
        <div class="tw-w-full tw-flex tw-justify-between tw-items-center">
          <div class="tw-w-[calc(100%-46px)] tw-flex tw-flex-col">
            <div class="tw-text-sm dark:tw-text-white">{{ formatTime(chapter.time) }}</div>
            <div class="tw-w-full tw-pr-2">
                <p class="tw-truncate tw-font-bold dark:tw-text-white">{{ chapter.title }}</p>
            </div>
          </div>
          <div class="tw-hidden md:tw-flex tw-flex-shrink-0">
            <!-- Practice Button -->
            <button id="video-chapter-song"
                    class="tw-btn-primary tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 tw-mr-2 tw-flex tw-justify-center tw-items-center tw-group tw-px-10 lg:tw-px-14 xl:tw-px-[70px]"
                    @click="handleOpenSoundslice(chapter.title, index, chapter.time, false)"
                    title="Practice"
            >
              <musora-icon icon-name="practice-slice" class="tw-mr-[10px] tw-w-6" />
              Practice
            </button>
            <!-- Loop Button -->
            <button id="video-chapter-loop"
                  class="tw-flex tw-justify-center tw-items-center tw-btn-primary tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D] tw-px-10 lg:tw-px-14 xl:tw-px-[70px]"
                  @click="handleOpenSoundslice(chapter.title, index, chapter.time, true)"
                  title="Loop"
            >
              <musora-icon icon-name="loop-slice" class="tw-mr-[10px] tw-w-6" />
              Loop
            </button>
          </div>
          <div class="md:tw-hidden">
              <DropdownAlt :options="dropdownOptions" @practice="handleOpenSoundslice(chapter.title, index, chapter.time, false)" @loop="handleOpenSoundslice(chapter.title, index, chapter.time, true)" />
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import {  ref, onBeforeMount } from "vue";
import DropdownAlt from '../Dropdown/DropdownAlt';
import MusoraIcon from "../MusoraIcons/MusoraIcon";

onBeforeMount(()=> {
//console.log('video chapters', props.chapters)
})

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
