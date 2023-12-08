
<template>
    <div class="tw-flex tw-flex-col tw-gap-4">
      <div class="tw-text-lg tw-font-bold">Chapters:</div>
      <div v-for="(chapter, index) in chapters" :key="index" class="tw-flex tw-items-center tw-gap-2">
        <img :src="chapter.thumbnail" alt="Chapter thumbnail" class="tw-h-20 tw-w-32 tw-object-cover">
        <div class="tw-flex tw-flex-col">
          <span>{{ chapter.title }}</span>
          <span>{{ formatTime(chapter.time) }}</span>
        </div>
        <button class="tw-btn" @click="onIconClick('left', chapter)">Icon 1</button>
        <button class="tw-btn" @click="onIconClick('right', chapter)">Icon 2</button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';

  const props = defineProps({
    chapters: {
      type: Array,
      default: () => [],
    },
  });
  
  const formatTime = (seconds) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  };
  
  const onIconClick = (icon, chapter) => {
    // Icon click handler - to be implemented
    console.log(`Icon ${icon} clicked for chapter`, chapter);
  };
  </script>
  