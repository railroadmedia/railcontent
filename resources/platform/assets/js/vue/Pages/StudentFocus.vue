<template>
    <div>
      <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb :breadcrumbs="breadcrumbs"></breadcrumb>
        <page-header
          page-type="student-focus"
          title="Student Focus"
          icon-name="person-plus"
          :description="headerDescription"
        ></page-header>
      </div>
      <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col mv-3">
          <div class="tw-grid tw-gap-2 xl:tw-gap-4 tw-grid-cols-2 md:tw-grid-cols-3 xl:tw-grid-cols-4 2xl:tw-grid-cols-5 3xl:tw-grid-cols-6">
            <a
              v-for="lessonType in lessonTypes"
              :key="lessonType.type"
              :href="`${baseUrl}${lessonType.type}`"
              class="tw-flex tw-flex-col tw-w-full pa-1"
              :dusk="lessonType.type"
            >
              <div class="show-index-card square corners-10 bg-grey-2 dark:tw-bg-[#081825] relative">
                <img
                  :src="`https://www.musora.com/musora-cdn/image/width=650,height=650,quality=95/${lessonType.thumbnail}`"
                  class="corners-10 tw-transition-opacity tw-opacity-0"
                  :alt="`${lessonType.type} Show Card`"
                  loading="lazy"
                  @load="removeOpacity"
                >
                <span class="box-hover heading corners-10">
                  <i class="fas fa-arrow-right"></i>
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, computed } from 'vue';
  import { useUserStore } from "../../stores/user";
  
  const props = defineProps({
    lessonTypes: {
      type: Array,
      required: true
    }
  });
  
  const userStore = useUserStore();
  
  const baseUrl = computed(() => {
    return `${window.location.origin}/${userStore.brand}/platform/content-type-catalog/`;
  });
  
  const removeOpacity = (event) => {
    event.target.classList.remove('tw-opacity-0');
  };
  
  const headerDescription = computed(() => {
    if (userStore.brand === 'pianote' || userStore.brand === 'guitareo') {
      return "Submit your playing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.";
    } else if (userStore.brand === 'singeo') {
      return "Submit your singing for personalized and direct feedback, or look at the archive to see what challenges our instructors have already addressed.";
    }
    return '';
  });
  
  const breadcrumbs = [
    {
      title: 'Student Focus',
    },
  ];
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  