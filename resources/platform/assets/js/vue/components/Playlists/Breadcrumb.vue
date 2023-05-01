<template>
    <div class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9]  tw-flex tw-justify-center tw-items-center tw-w-full tw-h-[40px] dark:tw-bg-black tw-bg-[#e5e7eb] tw-text-center tw-uppercase tw-text-sm">
      <a :href="homeUrl" class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] dark:hover:tw-text-white hover:tw-text-black">
        <HomeIcon class="tw-w-[14px] tw-h-[14px]" />
      </a>
      &nbsp;/&nbsp;
      <a class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-font-normal tw-text-sm dark:hover:tw-text-white hover:tw-text-black" :href="secondLevelUrl">{{ secondLevelTitle }}</a>
      &nbsp;/&nbsp;
      <span class="tw-font-bold tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-text-sm">{{ lastLevelTitle }}</span>
    </div>
  </template>
  
  <script setup>
  import { HomeIcon } from '@heroicons/vue/solid';
  
  const props = defineProps({
    homeUrl: String,
    secondLevelUrl: String,
    secondLevelTitle: String,
    lastLevelTitle: String,
  });
  </script>
  