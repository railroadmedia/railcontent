<template>
    <div id="lessonCompleteModal" class="modal">
      <div class="tw-flex tw-flex-col">
        <div class="tw-border-b tw-border-white tw-py-[30px]">
            <h1 class="display tw-uppercase tw-text-center tw-text-white tw-mb-[15px]">
              <i :class="`fas fa-check-circle tw-text-${userStore.brand} tw-mr-[10px]`"></i>
              Complete
            </h1>

            <p class="body tw-text-white tw-text-center tw-mb-[15px]">
              Congratulations you completed <strong>{{ lessonContent.fields.title }}</strong>!
            </p>

            <h2 class="heading tw-text-white tw-text-center tw-uppercase">
              You earned {{ lessonContent.total_xp || lessonContent.xp || 0 }} XP
            </h2>
        </div>

        <div class="tw-flex tw-py-[30px] tw-flex-wrap">
          <div class="tw-w-full sm:tw-w-1/2 tw-px-2">
            <p class="body tw-text-center tw-text-white tw-mb-[15px]">
              Completed...
            </p>
            <CatalogueCard
                v-for="item in thisLessonJson.data"
                :key="'coach-grid' + item.id"
                :item="item"
                :content-type="item.type"
                :show-my-list-action="true"
                wrapperClassOverride="tw-w-full"
                @addToList="addToList"
            />
          </div>

          <div v-if="nextLessonJson" class="tw-w-full sm:tw-w-1/2 tw-px-2">
            <p class="body tw-text-center tw-text-white tw-mb-[15px]">
              Up Next...
            </p>
            <CatalogueCard
              v-for="item in nextLessonJson.data"
              :key="'coach-grid' + item.id"
              :item="item"
              :content-type="item.type"
              :show-my-list-action="true"
              wrapperClassOverride="tw-w-full"
              @addToList="addToList"
            />
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { onBeforeMount } from "vue";
  import { useUserStore } from "@stores/user";
  import CatalogueCard from '@collections/Catalogue/CatalogueCard';
  import useUserCatalogueEvents from "@hooks/useUserCatalogueEvents";

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

  const { addToList } = useUserCatalogueEvents({ ...props });

  onBeforeMount( ()=> {
    console.log('props.thisLessonJson', props.thisLessonJson );
  })
  </script>
