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
          class="tw-overflow-hidden tw-flex tw-items-center tw-justify-center tw-relative tw-transition-colors dark:tw-bg-[#081825] tw-bg-[#EDEDED] tw-rounded-lg tw-mr-[10px]"
          :title="`Go To '${chapter.title}'`"
          @click="handleSeekToChapter(chapter.time)"
        >
          <img v-if="chapter.thumbnail"
              :src="chapter.thumbnail"
              :alt="`Chapter ${ index } thumbnail`"
              class="tw-rounded-[5px] tw-h-[62px] tw-object-cover"
          >
          <!-- Fallback -->
          <p v-else class="tw-font-bold tw-text-black tw-text-xl dark:tw-text-white">Chapter {{ index + 1 }}</p>
          <!-- Hover State -->
          <div class="tw-cursor-pointer tw-bg-black/50 tw-z-10 tw-absolute tw-transition-opacity tw-opacity-0 hover:tw-opacity-100 tw-w-full tw-h-full tw-flex tw-items-center tw-justify-center">
            <i class="fas fa-arrow-right tw-text-white tw-text-2xl"></i>
          </div>
        </button>
        <!-- Chapter Info Wrapper -->
        <div class="tw-w-full tw-flex tw-justify-between">
          <div class="tw-w-[calc(100%-46px)] tw-flex tw-flex-col">
            <div class="tw-text-sm dark:tw-text-white">{{ formatTime(chapter.time) }}</div>
            <div class="tw-w-full tw-pr-2">
                <p class="tw-truncate tw-font-bold dark:tw-text-white">{{ chapter.title }}</p>
            </div>
          </div>
          <div class="tw-flex tw-flex-shrink-0">
            <!-- Practice Button -->
            <button id="video-chapter-song"
                    class="tw-btn-primary tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 tw-mr-2 tw-flex tw-justify-center tw-items-center tw-group"
                    @click="handleOpenSoundslice(chapter.title, index, chapter.time, false)"
                    title="Practice"
            >
              <!-- Outlined -->
              <svg width="19" height="24" viewBox="0 0 19 24" class="tw-mr-[10px]" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M7.14135 8.1582C6.89929 8.1582 6.70306 8.35445 6.70306 8.59649V14.4656C6.44005 14.3541 6.13877 14.2942 5.8265 14.2942C5.38895 14.2942 4.973 14.4117 4.65364 14.6246C4.33734 14.8354 4.07336 15.1748 4.07336 15.609C4.07336 16.0432 4.33734 16.3827 4.65364 16.5934C4.973 16.8064 5.38895 16.9239 5.8265 16.9239C6.26405 16.9239 6.67999 16.8064 6.99936 16.5934C7.31565 16.3827 7.57963 16.0432 7.57963 15.609V10.7879H11.9625V14.4656C11.6995 14.3541 11.3982 14.2942 11.0859 14.2942C10.6484 14.2942 10.2324 14.4117 9.91304 14.6246C9.59674 14.8354 9.33276 15.1748 9.33276 15.609C9.33276 16.0432 9.59674 16.3827 9.91304 16.5934C10.2324 16.8064 10.6484 16.9239 11.0859 16.9239C11.5234 16.9239 11.9394 16.8064 12.2588 16.5934C12.575 16.3827 12.839 16.0432 12.839 15.609V8.59649C12.839 8.35445 12.6428 8.1582 12.4007 8.1582H7.14135ZM11.9625 9.91134V9.03477H7.57963V9.91134H11.9625ZM6.51312 15.3539C6.6727 15.4603 6.70306 15.5592 6.70306 15.609C6.70306 15.6589 6.6727 15.7578 6.51312 15.8641C6.3566 15.9685 6.11512 16.0473 5.8265 16.0473C5.53787 16.0473 5.29639 15.9685 5.13987 15.8641C4.98029 15.7578 4.94993 15.6589 4.94993 15.609C4.94993 15.5592 4.98029 15.4603 5.13987 15.3539C5.29639 15.2495 5.53787 15.1707 5.8265 15.1707C6.11512 15.1707 6.3566 15.2495 6.51312 15.3539ZM11.7725 15.3539C11.9321 15.4603 11.9625 15.5592 11.9625 15.609C11.9625 15.6589 11.9321 15.7578 11.7725 15.8641C11.616 15.9685 11.3745 16.0473 11.0859 16.0473C10.7973 16.0473 10.5558 15.9685 10.3993 15.8641C10.2397 15.7578 10.2093 15.6589 10.2093 15.609C10.2093 15.5592 10.2397 15.4603 10.3993 15.3539C10.5558 15.2495 10.7973 15.1707 11.0859 15.1707C11.3745 15.1707 11.616 15.2495 11.7725 15.3539Z"
                  fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1.5 3.47547C1.5 2.55704 2.24454 1.8125 3.16297 1.8125H9.90213C10.0232 1.8125 10.1393 1.86059 10.2249 1.9462L16.7571 8.47837C16.8427 8.56397 16.8908 8.68008 16.8908 8.80115V20.3662C16.8908 21.2847 16.1462 22.0292 15.2278 22.0292H3.16297C2.24454 22.0292 1.5 21.2847 1.5 20.3662V3.47547ZM3.16297 0.3125C1.41611 0.3125 0 1.72861 0 3.47547V20.3662C0 22.1131 1.41611 23.5292 3.16297 23.5292H15.2278C16.9747 23.5292 18.3908 22.1131 18.3908 20.3662V8.80115C18.3908 8.28226 18.1847 7.78462 17.8177 7.41771L11.2856 0.885541C10.9187 0.518629 10.421 0.3125 9.90213 0.3125H3.16297Z"
                  fill="currentColor" />
              </svg>
              Practice
            </button>
            <!-- Loop Button -->
            <button id="video-chapter-loop"
                  class="tw-flex tw-justify-center tw-items-center tw-btn-primary tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]"
                  @click="handleOpenSoundslice(chapter.title, index, chapter.time, true)"
                  title="Loop"
            >
              <!-- Outlined -->
              <svg width="19" height="24" viewBox="0 0 19 24" fill="none" class="tw-mr-[10px]" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.99995 10.1491H5.66661C5.14063 10.1491 4.71423 10.4952 4.71423 10.922V15.5591C4.71423 15.9859 5.14063 16.3319 5.66661 16.3319H12.3333C12.8593 16.3319 13.2857 15.9859 13.2857 15.5591V10.922C13.2857 10.5356 12.857 10.1665 12.3333 10.1492C11.8096 10.1319 10.6666 10.1492 10.6666 10.1492M7.57138 8.71289L8.99995 10.1415L7.57138 11.57"
                  stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1.5 3.47547C1.5 2.55704 2.24454 1.8125 3.16297 1.8125H9.90213C10.0232 1.8125 10.1393 1.86059 10.2249 1.9462L16.7571 8.47837C16.8427 8.56397 16.8908 8.68008 16.8908 8.80115V20.3662C16.8908 21.2847 16.1462 22.0292 15.2278 22.0292H3.16297C2.24454 22.0292 1.5 21.2847 1.5 20.3662V3.47547ZM3.16297 0.3125C1.41611 0.3125 0 1.72861 0 3.47547V20.3662C0 22.1131 1.41611 23.5292 3.16297 23.5292H15.2278C16.9747 23.5292 18.3908 22.1131 18.3908 20.3662V8.80115C18.3908 8.28226 18.1847 7.78462 17.8177 7.41771L11.2856 0.885541C10.9187 0.518629 10.421 0.3125 9.90213 0.3125H3.16297Z"
                  fill="currentColor" />
              </svg>
              Loop
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
  import {  ref, onBeforeMount } from "vue";

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

</script>
