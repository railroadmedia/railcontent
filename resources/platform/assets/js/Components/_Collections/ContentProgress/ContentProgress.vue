<template>
    <SkeletonContentProgress v-if="isLoading" />

    <div v-else :class="`tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-[6px] sm:tw-px-4 md:tw-px-8 bg-${brand} tw-rounded-[10px] tw-mt-3`">
      <div class="content-progress flex flex-row flex-wrap tw-py-3 sm:tw-py-6">
        <div v-if="labelText" class="flex flex-column left-column align-v-center">
          <h3 :class="`display ${brandTextColor} nowrap`">{{ labelText }}</h3>
        </div>
        <div class="flex flex-column">
          <div :class="`flex flex-row trophy-progress-bar tw-h-[18px] sm:tw-h-[50px] mr-2 bg-${brand} bg-darken ${isCompleted ? 'complete' : ''}`">
            <div :class="`flex flex-column trophy-progress-cutoff tw-h-[38px] sm:tw-h-[70px] bg-${brand} inverted relative`">
              <span :class="`progress-border ba-${brand}-5 border-darken absolute-fill`"></span>
              <span
                class="trophy-progress relative bg-white"
                :style="{ transform: `translateX(${contentProgress - 100}%)` }"
              >
                <span :class="`progress-percent body tw-font-bold tw-text-[10px] sm:tw-text-base ${brandTextColor} ${contentProgress > 50 ? '' : 'right'}`">
                  {{ Math.round(contentProgress) }}%
                </span>
              </span>
            </div>
            <div class="flex flex-column align-center trophy ph-2 title">
              <div :class="`reward flex flex-row ${brandTextColor} align-v-center dense tw-text-xs font-bold nowrap`">
                <i :class="`fas fa-trophy ${brandTextColor}`"></i>
                <span v-if="xpAmount">&nbsp;&nbsp;{{ xpAmount }} XP</span>
              </div>
              <div :class="`white-underlay ba-${brand}-5 ${contentProgress === 100 ? 'visible' : ''} border-darken`"></div>
            </div>
          </div>
        </div>
        <div class="tw-flex tw-flex-col tw-text-white tw-w-full sm:tw-w-auto tw-justify-center">
          <a v-if="!showCompleteButton"
             :href="isCompleted ? backButton.url : nextLessonUrl"
             class="tw-btn-secondary tw-text-lg tw-mb-0 tw-leading-[0] tw-border-[3px] tw-text-white"
          >
            <span v-if="!isCompleted">
              <span v-if="isStarted">Next Lesson &raquo;</span>
              <span v-else>Start First Lesson</span>
            </span>
            <span v-else v-html="backButton.text"></span>
          </a>
          <div v-else class="tw-flex tw-justify-center">
            <button class="btn tw-hidden sm:tw-block"
                    :data-brand="brand"
                    :data-content-id="contentId"
                    title="Reset Progress"
                    @click="resetProgress"
            >
              <span class="bg-white inverted tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                <i class="fas fa-undo tw-text-white reset tw-mb-0.5 tw-text-lg" aria-hidden="true"></i> Reset
              </span>
            </button>
            <button class="btn tw-text-base tw-max-w-[250px] sm:tw-max-w-none"
                    :class="isCompleted ? 'is-complete' : ''"
                    dusk="master-complete-button"
                    title="Mark Lesson as Complete"
                    :data-brand="brand"
                    :data-content-id="contentId"
                    @click="completeContent"
            >
              <span class="incompleted bg-white inverted tw-text-white tw-px-6 tw-items-center tw-border tw-border-white sm:tw-border-none tw-shadow-none" :class="!isCompleted ? 'tw-flex sm:tw-flex-col tw-h-[35px] sm:tw-h-auto' : 'tw-hidden'">
                <div class="tw-border-2 tw-border-white tw-rounded-full tw-px-1 tw-mr-1 sm:tw-mr-0 sm:tw-mb-1.5">
                  <i class="fas fa-check tw-text-[10px] tw-mb-1"></i>
                </div> Complete
              </span>
              <span class="completed tw-text-white tw-px-6 tw-items-center tw-border tw-border-white sm:tw-border-none tw-shadow-none" :class="isCompleted ? 'tw-flex sm:tw-flex-col tw-h-[35px] sm:tw-h-auto' : 'tw-hidden'">
                <div class="tw-border-2 tw-border-white tw-bg-white tw-rounded-full tw-px-1 tw-mr-1 sm:tw-mr-0 sm:tw-mb-1.5">
                  <i :class="`fas fa-check tw-text-[10px] tw-mb-1 ${brandTextColor}`"></i>
                </div> Completed
              </span>
            </button>
          </div>
        </div>
      </div>
    </div>

  </template>

  <script setup>
  // TODO: We might need to test corner cases if this is implemented in templates different than the LessonPlayback
  import { ref, computed } from 'vue';
  import { textColor } from '@constants/brands';
  import ContentService from "@vuesora/assets/js/Services/content";
  import Utils from "@vuesora/assets/js/classes/utils";
  import ChallengeCompletionModal from '@collections/Modal/ChallengeCompletionModal';
  import { usePlatformStore } from "@stores/platform";
  import { storeToRefs } from "pinia/dist/pinia";
  import SkeletonContentProgress from '@collections/SkeletonLoader/SkeletonContentProgress';

  const props = defineProps({
    labelText: String,
    brand: String,
    isCompleted: Boolean,
    progress: Number,
    xpAmount: [String, Number],
    isStarted: Boolean,
    backButton: Object,
    nextLessonUrl: String,
    showCompleteButton: Boolean,
    contentId: Number,
    isChallenge: {
        type: Boolean,
        default: true,
    }
  });

  const platformStore = usePlatformStore();
  const { isLoading } = storeToRefs(platformStore);

  const emit = defineEmits(['toggleCompleteContent', 'openChallengeCompletionModal']);

  const contentProgress = ref(props.progress);

  const brandTextColor = computed(() => {
    return textColor[props.brand];
  });

  const resetProgress = () => {
      window.showconfirmationmodal({
          title: 'Hold your horses… This will reset all of your progress, are you sure about this?',
          subtitle: 'This cannot be undone.',
          callbacks: {
              submit: () => {
                  ContentService.resetContentProgress(props.contentId)
                  .then((resolved) => {
                      if (resolved) {
                          window.shownotification({
                              icon: 'check',
                              text: 'Ready to start again? Your progress has been reset.'
                          });

                          contentProgress.value = 0;
                          emit('toggleCompleteContent');
                      }
                  });
              },
          }
      });
  }

  const completeContent = async() => {
      if(!props.isCompleted){
          try {
              if(props.isChallenge) {
                  const complete =  await axios.post(`/challenges/complete_lesson/${props.contentId}?brand=${props.brand}`);
                  console.log(complete)

                  emit('toggleCompleteContent');

                  if(complete.data?.show_modal){
                      emit('openChallengeCompletionModal', complete.data);
                  }

                  contentProgress.value = 100;
              } else {
                  const complete = await ContentService.markContentAsComplete(props.contentId);

                  emit('toggleCompleteContent');
                  contentProgress.value = 100;

                  Utils.triggerEvent(window, 'lesson-complete', { complete: true });
              }
          } catch(e) {
              window.shownotification({
                  icon: 'error',
                  text: 'Woops! Something wrong happened, please try again later.'
              })
          }
      }
  }
  </script>
