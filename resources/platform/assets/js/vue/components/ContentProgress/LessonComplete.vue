<template>
    <div id="lessonCompleteModal" class="modal">
      <div class="flex flex-column">
        <div class="flex flex-row tw-border-b tw-border-white pv-3">
          <div class="flex flex-column">
            <h1 class="display uppercase text-center text-white mb-2">
              <i :class="`fas fa-check-circle text-${userStore.brand} mr-1`"></i>
              Complete
            </h1>
  
            <p class="body text-white text-center mb-2">
              Congratulations you completed <strong>{{ lessonContent.fields.title }}</strong>!
            </p>
  
            <h2 class="heading text-white text-center uppercase">
              You earned {{ lessonContent.total_xp || lessonContent.xp || 0 }} XP
            </h2>
          </div>
        </div>
  
        <div class="flex flex-row pv-3 flex-wrap single-col dark-mode align-h-center">
          <div class="flex flex-column xs-12 sm-6">
            <p class="body text-center tw-text-white mb-2">
              Completed...
            </p>
  
            <content-catalogue
              catalogue-type="grid"
              :is-single-item="true"
              :theme-color="userStore.brand"
              :use-theme-color="true"
              :pre-loaded-content="thisLessonJson"
              :user-id="userStore.userId"
            ></content-catalogue>
          </div>
  
          <div v-if="nextLessonJson" class="flex flex-column xs-12 sm-6">
            <p class="body text-center tw-text-white mb-2">
              Up Next...
            </p>
  
            <content-catalogue
              catalogue-type="grid"
              :is-single-item="true"
              :theme-color="userStore.brand"
              :use-theme-color="true"
              :pre-loaded-content="nextLessonJson"
              :user-id="userStore.userId"
            ></content-catalogue>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useUserStore } from "../../../stores/user";

  const userStore = useUserStore();

  const props = defineProps({
      lessonContent: {
        type: Object,
        required: true
      },
      thisLessonJson: {
        type: Object,
        required: true
      },
      nextLessonJson: {
        type: [Object, null],
        default: null
      },
    });
  </script>
  