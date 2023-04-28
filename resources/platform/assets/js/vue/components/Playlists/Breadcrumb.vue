<template>
    <div class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9]  tw-flex tw-justify-center tw-items-center tw-w-full tw-h-[40px] dark:tw-bg-black tw-bg-[#e5e7eb] tw-text-center tw-uppercase tw-text-sm">
      <a :href="homeLink" class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] ">
        <HomeIcon class="tw-w-[12px] tw-h-[12px]" />
      </a>
      &nbsp;/&nbsp;
      <a class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9]  tw-font-normal tw-text-sm" :href="playlistsLink">PLAYLISTS</a>
      &nbsp;/&nbsp;
      <a class="tw-font-bold tw-text-[#3F3F46] dark:tw-text-[#A1A1A9]  tw-text-sm" :href="playlistLink">{{ playlistName }}</a>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  import { HomeIcon } from '@heroicons/vue/solid';
  
  const props = defineProps({
    brand: String,
    playlistId: String,
    playlistName: String,
  });
  
  const homeLink = computed(() => `/${props.brand}`);
  const playlistsLink = computed(() => `/${props.brand}/playlists`);
  const playlistLink = computed(() => `/${props.brand}/playlist/${props.playlistId}`);
  </script>
  