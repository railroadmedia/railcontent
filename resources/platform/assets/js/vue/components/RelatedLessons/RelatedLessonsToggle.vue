<template>
    <div
         class="xl:tw-ml-[10px] xl:tw-pt-6 xl:tw-pr-4 tw-transition-all tw-overflow-hidden tw-shrink-0 tw-hidden"
         :class="{ 'xl:tw-inline-block': !isRelatedSectionOpen }">
      <button @click="toggleRelatedSection"
              class="tw-text-black dark:tw-text-white tw-group">
        <!-- Expand Icon outlined -->
        <svg v-show="!isRelatedSectionOpen"
             class="tw-border tw-border-black dark:tw-border-white tw-rounded-full tw-rotate-180 group-hover:tw-hidden"
             width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M24.7125 20.2017C25.0958 19.8124 25.0958 19.1876 24.7125 18.7983L19.2958 13.2983C18.9083 12.9048 18.2751 12.9 17.8816 13.2875C17.4882 13.675 17.4833 14.3082 17.8709 14.7017L21.6116 18.5L11 18.5C10.4477 18.5 10 18.9477 10 19.5C10 20.0523 10.4477 20.5 11 20.5L21.6116 20.5L17.8708 24.2983C17.4833 24.6918 17.4882 25.325 17.8816 25.7125C18.2751 26.1 18.9083 26.0952 19.2958 25.7017L24.7125 20.2017Z"
                fill="currentColor" />
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M27.5498 11C27.1356 11 26.7998 11.3358 26.7998 11.75L26.7998 26.75C26.7998 27.1642 27.1356 27.5 27.5498 27.5C27.964 27.5 28.2998 27.1642 28.2998 26.75L28.2998 11.75C28.2998 11.3358 27.964 11 27.5498 11Z"
                fill="currentColor" />
        </svg>
        <!-- Expand Icon filled -->
        <svg v-show="isRelatedSectionOpen"
             class="tw-hidden tw-rotate-180 group-hover:tw-block" width="38" height="38"
             viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M38 19C38 8.50659 29.4934 0 19 0C8.50659 0 0 8.50659 0 19C0 29.4934 8.50659 38 19 38C29.4934 38 38 29.4934 38 19ZM24.7125 18.7983L19.2958 13.2983C18.9083 12.9048 18.2751 12.9 17.8816 13.2875C17.4882 13.675 17.4833 14.3082 17.8708 14.7017L21.6116 18.5H11C10.4477 18.5 10 18.9477 10 19.5C10 20.0523 10.4477 20.5 11 20.5H21.6116L17.8708 24.2983C17.4833 24.6918 17.4882 25.325 17.8816 25.7125C18.2751 26.1 18.9083 26.0952 19.2958 25.7017L24.7125 20.2017C25.0958 19.8124 25.0958 19.1876 24.7125 18.7983ZM26.8 11.75C26.8 11.3358 27.1358 11 27.55 11C27.9643 11 28.3 11.3358 28.3 11.75V26.75C28.3 27.1642 27.9643 27.5 27.55 27.5C27.1358 27.5 26.8 27.1642 26.8 26.75V11.75Z"
                fill="currentColor" />
        </svg>
      </button>
    </div>
  </template>
  
  <script setup>
  const props = defineProps({
    relatedLessons: Object,
    isRelatedSectionOpen: Boolean
  });
  
  const emit = defineEmits(['update:isRelatedSectionOpen']);
  
  const toggleRelatedSection = () => {
    emit('update:isRelatedSectionOpen', !props.isRelatedSectionOpen);
  };
  </script>
