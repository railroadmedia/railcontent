<template>
  <div>
    <div class="tw-flex tw-items-start tw-justify-between tw-mb-3 tw-flex-wrap">

      <div class="tw-text-[#00101D] dark:tw-text-white lg:tw-flex-1">
        <h1 class="heading tw-py-2 tw-pr-4 xl:tw-pr-0">
          {{ title }}
        </h1>
      </div>
      <!-- Video CTAs -->
      <div class="tw-flex tw-items-start tw-pt-3 tw-overflow-auto sm:tw-overflow-visible tw-no-scrollbar lg:tw-ml-4 tw-pb-40 -tw-mb-36 lg:-tw-mb-40">
        <!-- Info Button -->
        <div v-if="showInfoButton" class="flex flex-column resource-button tw-pr-2">
           <button
               class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full"
               :class="openInfo ? 'tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white' : 'tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40'"
               id="toggleInstructorInfo"
               title="More Info"
               @click="toggleInfo"
           >
            <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
              <musora-icon icon-name="info" class="tw-w-6 tw-h-6 tw-mr-1" />
              Info
            </div>
          </button>
        </div>

        <!-- Like Button -->
        <div class="flex flex-column resource-button tw-pr-2">
          <button
              class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full"
              :class="hasLiked ? 'tw-text-white dark:tw-text-[#000C17] tw-bg-[#000C17] dark:tw-bg-white' : 'tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40'"
              :title="hasLiked ? 'Unlike' : 'Like'"
              @click="likeContent"
          >
              <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                <musora-icon :icon-name="hasLiked ? 'thumb-like-filled' : 'thumb-like'" class="tw-w-6 tw-h-6 tw-mr-1" />
              {{ totalLikes }}
              </div>
          </button>
        </div>

        <!-- Share Button -->
        <div class="flex flex-column resource-button tw-pr-2">
          <button
              class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
              title="Share"
              @click="handleOpenModal"
          >
            <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
              <musora-icon icon-name="share" class="tw-w-6 tw-h-6 tw-mr-1" />
              Share
            </div>
          </button>
        </div>

        <!-- Add Button -->
        <div v-if="showAddToList" class="flex flex-column resource-button tw-pr-2">
          <button
              class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
              title="Add to Playlist"
              @click="addToList"
          >
            <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
              <musora-icon icon-name="plus" class="tw-w-6 tw-h-6 tw-mr-1 tw-transition-all" />
                Add
            </div>
          </button>
        </div>

        <!-- Completed Button -->
        <div v-if="showCompleteButton" class="flex flex-column resource-button tw-pr-2">
          <button
              class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
              @click="handleCompleteLesson"
          >
            <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
              <musora-icon :icon-name="completed ? 'circle-check-filled' : 'circle-check'" class="tw-w-6 tw-h-6 tw-mr-1 tw-transition-all" :class="completed ? 'tw-text-[#16A34A]' : ''" />
              <span>
                {{ completed ? "Completed" : "Complete" }}
              </span>
            </div>
          </button>
        </div>

        <!-- Resources Button -->
        <div v-if="resources.length > 0 && showResourceButton()" class="flex flex-column resource-button tw-pr-2 tw-relative">
          <button
              class="open-resources tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-2 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
              title="Download Resources"
              @click="toggleResourceDropdown"
          >
            <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
              <musora-icon icon-name="file" class="tw-w-6 tw-h-6 tw-mr-1" />
              Resources
            </div>
          </button>

          <transition name="grow-fade">
              <ul v-show="resourceDropdown" class="tw-absolute tw-top-10 tw-right-2 tw-overflow-hidden tw-rounded tw-bg-white dark:tw-bg-[#081825] tw-z-50 tw-drop-shadow-lg">
                  <li v-for="resource in resources" :key="resource.resource_name">
                      <a
                          class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm tw-whitespace-nowrap tw-text-black dark:tw-text-white"
                          :key="resource.resource_name"
                          :href="resource.resource_url"
                          :aria-label="`Download ${resource.resource_name}`"
                      >
                          <i class="fas tw-mr-1" :class="getResourceIcon(resource.resource_url)"></i>
                          {{ resource.resource_name }}
                      </a>
                  </li>
              </ul>
          </transition>
        </div>

        <!-- More Button -->
        <div class="flex flex-column resource-button tw-relative">
          <button
              class="tw-font-bebas-neue tw-uppercase tw-py-1 tw-px-1 tw-text-sm tw-rounded-full tw-text-[#000C17] dark:tw-text-white tw-bg-[#EDEDED] dark:tw-bg-[#0E2031] hover:tw-bg-[#00000026] hover:dark:tw-bg-[#223F57]/90 dark:tw-border dark:tw-border-[#223F57]/40"
              title="More"
              @click="toggleMore"
          >
              <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                  <musora-icon icon-name="ellipsis" class="tw-w-6 tw-h-6 tw-transition-all" />
              </div>
          </button>

          <!-- Dropdown -->
          <ul
              v-if="showMore"
              class="tw-absolute tw-top-10 tw-right-0 tw-drop-shadow-lg tw-rounded tw-text-black dark:tw-text-white tw-bg-white dark:tw-bg-[#081825] tw-z-50"
              v-click-outside="clickOutSideDropdown"
          >
            <!-- Resources -->
            <li v-if="resources.length > 0 && !showResourceButton()" class="tw-group tw-relative">
                <button
                    class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
                >
                    <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                        <musora-icon icon-name="file" class="tw-w-6 tw-h-6 tw-transition-all tw-mr-1" />
                        Resources
                    </div>
                </button>

                <!-- Resource Dropdown -->
                <ul class="tw-hidden group-hover:tw-block tw-absolute tw-top-0 tw-right-full tw-overflow-hidden tw-rounded tw-bg-white dark:tw-bg-[#081825] tw-z-50">
                    <li v-for="resource in resources">
                        <a
                            class="tw-flex tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm tw-whitespace-nowrap tw-text-black dark:tw-text-white"
                            :key="resource.resource_name"
                            :href="resource.resource_url"
                            :aria-label="`Download ${resource.resource_name}`"
                        >
                            <i class="fas tw-mr-1" :class="getResourceIcon(resource.resource_url)"></i>
                            {{ resource.resource_name }}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Report -->
            <li class="tw-group tw-relative">
              <button
                  class="tw-flex tw-w-full tw-items-center tw-px-4 tw-py-2 tw-z-30 tw-transition-colors dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-sm"
              >
                  <div class="tw-flex tw-items-center tw-relative tw-pointer-events-none">
                      <div class="tw-h-6 tw-w-6 tw-flex tw-items-center tw-justify-center tw-mr-1">
                          <FlagIcon class="tw-w-5 tw-h-5" />
                      </div>
                      Report
                  </div>
              </button>
            </li>
          </ul>
        </div>
      </div>

      <ModalRenderer v-if="showModalContent" @onClose="handleOpenModal"
        key="ModalRendererOnVideoResource">
        <div class="tw-relative tw-container tw-w-full tw-h-full tw-flex tw-justify-center tw-items-center">
          <button @click="handleOpenModal" aria-label="Close share modal"
            class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
          </button>
          <div class="tw-flex tw-flex-col tw-bg-white tw-rounded-[9px] shadow tw-w-full tw-mx-[45px] pa-3 tw-max-w-[768px]">
            <h1 class="heading mb-2">Share Video Link</h1>
            <div class="form-group mb-2">
              <input id="shareableUrlInput" class="no-label mb-2" type="text" :value="shareUrl" />

              <button id="copyUrlButton" class="btn" @click="copyTimecodeToClipboard">
                <span class="text-white bg-grey-3"> Copy </span>
              </button>
            </div>

            <div class="form-group mb-2">
              <div class="flex flex-row form-group align-v-center">
                <span class="toggle-input mr-1">
                  <input id="includeTimecode" v-model="useTimecode" type="checkbox" readonly />

                  <span class="toggle">
                    <span class="handle"></span>
                  </span>
                </span>

                <label for="includeTimecode" class="toggle-label pointer dense uppercase font-bold tiny">
                  Start at Current Time
                </label>
              </div>
            </div>

            <p class="tiny font-italic tw-text-[#3F3F46]">
              This link is only accessible by {{ toCapitalCase(brand) }} Members.
            </p>
          </div>
        </div>
      </ModalRenderer>
    </div>

    <CoachesInLesson v-if="instructors.length > 0" :instructors="instructors" :brand="brand"></CoachesInLesson>
  </div>
</template>

<script>
// TODO: REFACTOR THE MODAL OF THIS COMPONENT!
import Utils from '../../assets/js/helper-functions/utils.js';
import ThemeClasses from "../../mixins/ThemeClasses";
import Toasts from "../../assets/js/classes/toasts";
import ContentService from "../../assets/js/services/content";
import CoachesInLesson from "./CoachesInLesson.vue";
import ModalRenderer from "../../../components/Modal/ModalRenderer.vue";
import { XIcon } from "@heroicons/vue/solid";
import { FlagIcon } from "@heroicons/vue/outline";

export default {
  name: "VideoResources",
  components: {
    CoachesInLesson,
    ModalRenderer,
    XIcon,
    FlagIcon,
  },
  mixins: [ThemeClasses],
  props: {
    brand: {
      type: String,
      default: () => "drumeo",
    },

    title: {
      type: String,
      default: () => "",
    },

    description: {
      type: String,
      default: () => "",
    },

    lessonType: {
      type: String,
      default: () => "",
    },

    thumbnailUrl: {
      type: String,
      default: () => "",
    },

    parentTitle: {
      type: String,
      default: () => null,
    },

    instructors: {
      type: Array,
      default: () => [],
    },

    isLiked: {
      type: Boolean,
      default: () => false,
    },

    isAdded: {
      type: Boolean,
      default: () => false,
    },

    showAddToList: {
      type: Boolean,
      default: () => true,
    },

    showCompleteButton: {
      type: Boolean,
      default: () => false,
    },

    showInfoButton: {
      type: Boolean,
      default: () => false,
    },

    likeCount: {
      type: [Number, String],
      default: () => 0,
    },

    userId: {
      type: [String, Number],
      default: () => null,
    },

    contentId: {
      type: [String, Number],
      default: () => null,
    },

    resources: {
      type: Array,
      default: () => [],
    },

    relatedLesson: {
      type: Object,
      default: {},
    },

    lesson: {
      type: Object,
      default: {},
    }
  },

  data() {
    return {
      resourceDropdown: false,
      hasLiked: this.isLiked,
      totalLikes: this.likeCount,
      hasAdded: this.isAdded,
      useTimecode: true,
      showModalContent: false,
      completed: this.lesson.completed,
      openInfo: false,
      showMore: false,
    };
  },

  computed: {
    shareUrl() {
      if (this.useTimecode) {
        return `${location.protocol}//${location.host}${location.pathname
          }?time=${Math.floor(this.getCurrentTime())}`;
      }

      return `${location.protocol}//${location.host}${location.pathname}`;
    },
  },
  mounted() {
    document.addEventListener("click", (event) => {
      if (!event.target.matches(".open-resources")) {
        this.resourceDropdown = false;
      }
    });
  },
  methods: {
    getCurrentTime() {
      if (this.$root.$refs?.mediaElementVueInstance) {
        return this.$root.$refs.mediaElementVueInstance.currentTime;
      }

      return 0;
    },
    handleOpenModal() {
      this.showModalContent = !this.showModalContent;
    },
    likeContent() {
      this.hasLiked = !this.hasLiked;

      if (this.hasLiked) {
        this.totalLikes += 1;
      } else {
        this.totalLikes -= 1;
      }

      ContentService.likeContentById({
        is_liked: this.hasLiked,
        content_id: this.contentId,
        user_id: this.userId,
      });
    },

    toCapitalCase: (string) => Utils.toCapitalCase(string),

    addToList() {
      const data = {
        content_id: this.contentId,
        name: this.title,
        thumbnail_url: this.thumbnailUrl,
        description: this.description,
        type: this.lessonType
      }
      window.openplaylistmodal({ modalType: 'addItem', content: data });
    },

    handleCompleteLesson() {
      //Send Request
      if (this.completed) {
        ContentService.resetContentProgress(this.contentId)
          .then((resolved) => {
            if (resolved) {
              window.shownotification({
                icon: 'check',
                text: `Your progress has been reset.`
              })
            }
          }).catch(() => {
            window.shownotification({
              icon: 'error',
              text: 'Woops! Something wrong happened, please try again later.'
            })
          });
      } else {
        ContentService.markContentAsComplete(this.contentId).then(() => {
          if (this.completed) {
            window.shownotification({
              icon: 'check',
              text: `You've completed this lesson!`
            })
          }
        }).catch(() => {
          window.shownotification({
            icon: 'error',
            text: 'Woops! Something wrong happened, please try again later.'
          })
        })

      }

      this.completed = !this.completed;
    },

    getResourceIcon(resource) {
      const urlParts = resource.split(".");
      const fileExtension = urlParts[urlParts.length - 1];
      const iconMap = {
        pdf: "fa-file-pdf",
        mp3: "fa-file-music",
        zip: "fa-file-archive",
      };

      return iconMap[fileExtension] || "fa-file-download";
    },

    copyTimecodeToClipboard() {
      const timecode = document.getElementById("shareableUrlInput");

      if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
        const editable = timecode.contentEditable;
        const { readOnly } = timecode;
        const range = document.createRange();
        const selection = window.getSelection();

        timecode.contentEditable = true;
        timecode.readOnly = false;
        range.selectNodeContents(timecode);
        selection.removeAllRanges();
        selection.addRange(range);
        timecode.setSelectionRange(0, 999999);
        timecode.contentEditable = editable;
        timecode.readOnly = readOnly;
      } else {
        timecode.select();
      }
      document.execCommand("copy");
      timecode.blur();
      this.handleOpenModal();

      Toasts.push({
        icon: "happy",
        title: "SHARE THE LOVE!",
        message: "This URL has been copied, and is ready to share!",
      });
    },
    toggleInfo() {
      this.openInfo = !this.openInfo;

        const instructorInfo = document.getElementById('instructorInfo');
        instructorInfo.classList.toggle('active');

        if (this.openInfo) {
            instructorInfo.style.maxHeight = `${instructorInfo.scrollHeight}px`;
            instructorInfo.classList.add('tw-mb-4');
        } else {
            instructorInfo.style.maxHeight = '0';
            instructorInfo.classList.remove('tw-mb-4');
        }
    },
    toggleMore() {
      this.showMore = !this.showMore;
    },
    toggleResourceDropdown(){
      this.resourceDropdown = !this.resourceDropdown;
    },
    clickOutSideDropdown(){
        this.showMore = false;
    },
    showResourceButton(){
       if(!this.showInfoButton || !this.showCompleteButton){
           return true;
       }

       return false;
    },
  },
};
</script>
