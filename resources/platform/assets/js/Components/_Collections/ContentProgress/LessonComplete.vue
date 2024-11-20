<template>
    <div id="lessonCompleteModal" class="modal">
      <div class="tw-flex tw-flex-col">
        <div v-if="contentData" class="tw-border-b tw-border-white tw-py-[30px]">
            <h1 class="display tw-uppercase tw-text-center tw-text-white tw-mb-[15px]">
              <i :class="`fas fa-check-circle tw-text-${userStore.brand} tw-mr-[10px]`"></i>
              Complete
            </h1>

            <p class="body tw-text-white tw-text-center tw-mb-[15px]">
              Congratulations you completed <strong>{{ contentData?.fields?.title }}</strong>!
            </p>

            <h2 class="heading tw-text-white tw-text-center tw-uppercase">
              You earned {{ contentData?.total_xp || contentData?.xp || 0 }} XP
            </h2>
        </div>

        <div v-if="lessonData" class="tw-flex tw-py-[30px] tw-flex-wrap">
          <div class="tw-w-full sm:tw-w-1/2 tw-px-2">
            <p class="body tw-text-center tw-text-white tw-mb-[15px]">
              Completed...
            </p>
            <CatalogueCard
                :item="lessonData"
                :content-type="lessonData?.type"
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
              :item="nextLessonData"
              :content-type="nextLessonData?.type"
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
    import { onBeforeMount, ref, nextTick } from "vue";
    import { useUserStore } from "@stores/user";
    import CatalogueCard from '@collections/Catalogue/CatalogueCard';
    import useUserCatalogueEvents from "@hooks/useUserCatalogueEvents";
    import { fetchByRailContentId } from "musora-content-services";

    const userStore = useUserStore();

    //Refs
    const contentData = ref(null);
    const lessonData = ref(null);
    const nextLessonData = ref(null)

    const props = defineProps({
        lessonContent: {
          type: Object,
        },
        thisLessonJson: {
          type: Object,
        },
        nextLessonJson: {
          type: [Object, null],
          default: null
        },
        contentId: {
          type: Number,
          default: null,
        },
        contentType: {
          type: String,
          default: null,
        }
    });

    const { addToList } = useUserCatalogueEvents({ ...props });

    onBeforeMount(() => {
      nextTick(() => {
        //Get contentData and lessonData
        if (props.contentId && props.contentType) {
          fetchByRailContentId(props.contentId, props.contentType)
            .then((value) => {
              contentData.value = value;
              lessonData.value = value;
            })
            .catch((error) => {
              console.log('error fetching lesson data for LessonComplete.vue', error);
            });
        } else {
          contentData.value = props.lessonContent;
          lessonData.value = props.thisLessonJson;
        }
        //Check nextLessonData format 
        nextLessonData.value = props.nextLessonJson?.data ? props.nextLessonJson.data[0] : props.nextLessonJson;
      });
    });
</script>
