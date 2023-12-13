
<template>
  <div class="tw-flex tw-flex-col tw-mb-10">
    <h3 class="tw-text-[20px] tw-leading-[30px] tw-font-bold tw-mb-2 dark:tw-text-white">Chapters:</h3>
    <section class="tw-flex tw-overflow-hidden tw-flex-wrap tw-gap-4">
      <div v-for="(chapter, index) in chapters" 
          :key="index"
          class="tw-flex tw-flex-col tw-justify-center tw-w-full tw-max-w-[237px]"
      > 
        <!-- Chapter Thumbnail -->
        <div class="tw-w-full tw-flex tw-items-center tw-justify-center tw-relative dark:tw-bg-[#081825] tw-bg-[#EDEDED] tw-aspect-video tw-rounded-lg tw-mb-2">
          <img v-if="chapter.thumbnail" 
              :src="chapter.thumbnail" 
              :alt="`Chapter ${ index } thumbnail`"
              class="tw-transition-opacity tw-rounded-[5px] tw-w-[237px] tw-h-[133px] tw-object-cover tw-opacity-0"
              onload="this.classList.remove('tw-opacity-0')"
              loading="lazy"
            >
          <!-- Fallback -->
          <p v-else class="tw-font-bold tw-text-black tw-text-xl dark:tw-text-white">Chapter {{ index + 1 }}</p>
        </div>
        <!-- Chapter Info Wrapper -->
        <div class="tw-flex tw-justify-between">
          <div class="tw-flex tw-flex-col">
            <div class="tw-text-[12px] tw-leading-[18px] tw-font-bold dark:tw-text-white">{{ formatTime(chapter.time) }}</div>
            <div class="tw-flex tw-flex-col tw-text-[12px] tw-leading-[18px] tw-font-bold tw-truncate dark:tw-text-white">
                {{ chapter.title }}
            </div>
          </div>
          <div class="tw-flex">
            <button id="video-chapter-song" class="tw-text-black dark:tw-text-white tw-mr-[14px] tw-flex tw-flex-col tw-justify-start"
              @click="handleOpenSoundslice(chapter.title, chapter.time, false)">
              <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M7.14135 8.1582C6.89929 8.1582 6.70306 8.35445 6.70306 8.59649V14.4656C6.44005 14.3541 6.13877 14.2942 5.8265 14.2942C5.38895 14.2942 4.973 14.4117 4.65364 14.6246C4.33734 14.8354 4.07336 15.1748 4.07336 15.609C4.07336 16.0432 4.33734 16.3827 4.65364 16.5934C4.973 16.8064 5.38895 16.9239 5.8265 16.9239C6.26405 16.9239 6.67999 16.8064 6.99936 16.5934C7.31565 16.3827 7.57963 16.0432 7.57963 15.609V10.7879H11.9625V14.4656C11.6995 14.3541 11.3982 14.2942 11.0859 14.2942C10.6484 14.2942 10.2324 14.4117 9.91304 14.6246C9.59674 14.8354 9.33276 15.1748 9.33276 15.609C9.33276 16.0432 9.59674 16.3827 9.91304 16.5934C10.2324 16.8064 10.6484 16.9239 11.0859 16.9239C11.5234 16.9239 11.9394 16.8064 12.2588 16.5934C12.575 16.3827 12.839 16.0432 12.839 15.609V8.59649C12.839 8.35445 12.6428 8.1582 12.4007 8.1582H7.14135ZM11.9625 9.91134V9.03477H7.57963V9.91134H11.9625ZM6.51312 15.3539C6.6727 15.4603 6.70306 15.5592 6.70306 15.609C6.70306 15.6589 6.6727 15.7578 6.51312 15.8641C6.3566 15.9685 6.11512 16.0473 5.8265 16.0473C5.53787 16.0473 5.29639 15.9685 5.13987 15.8641C4.98029 15.7578 4.94993 15.6589 4.94993 15.609C4.94993 15.5592 4.98029 15.4603 5.13987 15.3539C5.29639 15.2495 5.53787 15.1707 5.8265 15.1707C6.11512 15.1707 6.3566 15.2495 6.51312 15.3539ZM11.7725 15.3539C11.9321 15.4603 11.9625 15.5592 11.9625 15.609C11.9625 15.6589 11.9321 15.7578 11.7725 15.8641C11.616 15.9685 11.3745 16.0473 11.0859 16.0473C10.7973 16.0473 10.5558 15.9685 10.3993 15.8641C10.2397 15.7578 10.2093 15.6589 10.2093 15.609C10.2093 15.5592 10.2397 15.4603 10.3993 15.3539C10.5558 15.2495 10.7973 15.1707 11.0859 15.1707C11.3745 15.1707 11.616 15.2495 11.7725 15.3539Z"
                  fill="currentColor" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1.5 3.47547C1.5 2.55704 2.24454 1.8125 3.16297 1.8125H9.90213C10.0232 1.8125 10.1393 1.86059 10.2249 1.9462L16.7571 8.47837C16.8427 8.56397 16.8908 8.68008 16.8908 8.80115V20.3662C16.8908 21.2847 16.1462 22.0292 15.2278 22.0292H3.16297C2.24454 22.0292 1.5 21.2847 1.5 20.3662V3.47547ZM3.16297 0.3125C1.41611 0.3125 0 1.72861 0 3.47547V20.3662C0 22.1131 1.41611 23.5292 3.16297 23.5292H15.2278C16.9747 23.5292 18.3908 22.1131 18.3908 20.3662V8.80115C18.3908 8.28226 18.1847 7.78462 17.8177 7.41771L11.2856 0.885541C10.9187 0.518629 10.421 0.3125 9.90213 0.3125H3.16297Z"
                  fill="currentColor" />
              </svg>
            </button>
            <button id="video-chapter-loop" class="tw-text-black dark:tw-text-white tw-flex tw-flex-col tw-justify-start"
              @click="handleOpenSoundslice(chapter.title, chapter.time, true)">
              <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.99995 10.1491H5.66661C5.14063 10.1491 4.71423 10.4952 4.71423 10.922V15.5591C4.71423 15.9859 5.14063 16.3319 5.66661 16.3319H12.3333C12.8593 16.3319 13.2857 15.9859 13.2857 15.5591V10.922C13.2857 10.5356 12.857 10.1665 12.3333 10.1492C11.8096 10.1319 10.6666 10.1492 10.6666 10.1492M7.57138 8.71289L8.99995 10.1415L7.57138 11.57"
                  stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M1.5 3.47547C1.5 2.55704 2.24454 1.8125 3.16297 1.8125H9.90213C10.0232 1.8125 10.1393 1.86059 10.2249 1.9462L16.7571 8.47837C16.8427 8.56397 16.8908 8.68008 16.8908 8.80115V20.3662C16.8908 21.2847 16.1462 22.0292 15.2278 22.0292H3.16297C2.24454 22.0292 1.5 21.2847 1.5 20.3662V3.47547ZM3.16297 0.3125C1.41611 0.3125 0 1.72861 0 3.47547V20.3662C0 22.1131 1.41611 23.5292 3.16297 23.5292H15.2278C16.9747 23.5292 18.3908 22.1131 18.3908 20.3662V8.80115C18.3908 8.28226 18.1847 7.78462 17.8177 7.41771L11.2856 0.885541C10.9187 0.518629 10.421 0.3125 9.90213 0.3125H3.16297Z"
                  fill="currentColor" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
  
<script setup>
  import { onBeforeMount } from "vue";

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
  ]);

  const formatTime = (seconds) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  };

  const handleOpenSoundslice = (title, chapter, loop) => {
    console.log('loop', loop)
    emit('openSlice', title, chapter, loop);
  };
</script>
  