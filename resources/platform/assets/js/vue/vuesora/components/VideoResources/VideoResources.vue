<template>
  <div>
    <div class="flex flex-row flex-wrap align-v-center tw-mb-2">
      <div class="flex flex-column tw-text-[#00101D] dark:tw-text-white">
        <h1 class="heading tw-py-2">
          {{ title }}
        </h1>
      </div>

      <div class="flex flex-column pv-2">
        <div class="flex flex-row nmh-1 flex-wrap resource-buttons">
          
          <!-- Like Button -->
          <div class="flex flex-column resource-button ph-1">
            <button class="btn stacked" @click="likeContent">
              <span
                class="tw-shadow-none tw-text-lg"
                style="padding: 0 8px"
                :class="hasLiked ? themeTextClass : 'tw-text-[#3F3F46] dark:tw-text-white'"
              >
                <musora-icon :icon-name="hasLiked ? 'thumb-like-filled' : 'thumb-like'"  class="tw-w-6 tw-h-6 tw-mb-1" />
                {{ totalLikes }}
              </span>
            </button>
          </div>
          
          <!-- Share Button -->
          <div class="flex flex-column resource-button ph-1">
            <button @click="handleOpenModal" class="btn stacked" data-open-modal="shareVideoModal">
              <span class="tw-shadow-none tw-text-[#3F3F46] dark:tw-text-white tw-text-lg" style="padding: 0 8px">
                <musora-icon icon-name="share"  class="tw-w-6 tw-h-6 tw-mb-1" />
                Share
              </span>
            </button>
          </div>

          <div
            v-if="resources.length > 0"
            class="flex flex-column resource-button ph-1 relative"
          >
            <button
              class="btn open-resources stacked"
              @click="resourceDropdown = !resourceDropdown"
            >
              <span
                class="tw-shadow-none"
                :class="resourceDropdown ? themeTextClass : 'tw-text-[#3F3F46] dark:tw-text-white tw-text-lg'"
                style="padding: 0 8px"
              >
                <musora-icon icon-name="download"  class="tw-w-6 tw-h-6 tw-mb-1" />
                Downloads
              </span>
            </button>

            <transition name="grow-fade">
              <div v-show="resourceDropdown" class="download-dropdown">
                <div class="flex flex-column bg-white corners-10 shadow">
                  <a
                    v-for="resource in resources"
                    :key="resource.resource_name"
                    :href="resource.resource_url"
                    :aria-label="`Download ${resource.resource_name}`"
                    class="
                      flex flex-row
                      pa-1
                      tiny
                      no-decoration
                      text-black
                      hover-bg-grey-1
                      align-v-center
                      nowrap
                    "
                    target="_blank"
                    download
                  >
                    <i
                      class="fas mr-1"
                      style="font-size: 16px"
                      :class="getResourceIcon(resource.resource_url)"
                    ></i>
                    {{ resource.resource_name }}
                  </a>
                </div>
              </div>
            </transition>
          </div>

          <div
            class="flex flex-column resource-button ph-1"
            v-if="showAddToList"
          >
            <button class="btn stacked" @click="addToList">
              <span
                class="tw-shadow-none tw-text-lg"
                style="padding: 0 8px"
                :class="hasAdded ? themeTextClass : 'tw-text-[#3F3F46] dark:tw-text-white'"
              >
                <musora-icon icon-name="plus" class="tw-w-6 tw-h-6 tw-mb-1 tw-transition-all" :class="hasAdded ? 'tw-rotate-45' : 'tw-rotate-0'" />
                <span class="hide-xs-only">
                  {{ hasAdded ? "Added" : "Add to List" }}
                </span>
                <span class="hide-sm-up">
                  {{ hasAdded ? "Added" : "Add" }}
                </span>
              </span>
            </button>
          </div>
          
          <!-- Completed Button -->
          <div
            class="flex flex-column resource-button ph-1"
            v-if="showCompleteButton"
          >
            <button class="btn stacked" @click="handleCompleteLesson">
              <span
                class="tw-shadow-none tw-text-lg"
                style="padding: 0 8px"
                :class="hasAdded ? themeTextClass : 'tw-text-[#3F3F46] dark:tw-text-white'"
              >
                <musora-icon v-if="completed" icon-name="circle-check-filled" class="tw-w-6 tw-h-6 tw-mb-1 tw-transition-all"/>
                <musora-icon v-else icon-name="circle-check" class="tw-w-6 tw-h-6 tw-mb-1 tw-transition-all"/>

                <span>
                  {{ completed ? "Completed" : "Complete" }}
                </span>
              </span>
            </button>
          </div>
          
        </div>
      </div>

      <div id="shareVideoModal" class="modal">
        <div v-if="showModalContent" class="flex flex-column bg-white corners-10 shadow pa-3">
          <h1 class="heading mb-2">Share Video Link</h1>

          <div class="form-group mb-2">
            <input
              id="shareableUrlInput"
              class="no-label mb-2"
              type="text"
              :value="shareUrl"
            />

            <button
              id="copyUrlButton"
              class="btn"
              @click="copyTimecodeToClipboard"
            >
              <span class="text-white bg-grey-3"> Copy </span>
            </button>
          </div>

          <div class="form-group mb-2">
            <div class="flex flex-row form-group align-v-center">
              <span class="toggle-input mr-1">
                <input
                  id="includeTimecode"
                  v-model="useTimecode"
                  type="checkbox"
                  readonly
                />

                <span class="toggle">
                  <span class="handle"></span>
                </span>
              </span>

              <label
                for="includeTimecode"
                class="toggle-label pointer dense uppercase font-bold tiny"
              >
                Start at Current Time
              </label>
            </div>
          </div>

          <p class="tiny font-italic tw-text-[#3F3F46]">
            This link is only accessible by {{ toCapitalCase(brand) }} Members.
          </p>
        </div>
      </div>
    </div>
    <CoachesInLesson
      v-if="instructors.length > 0"
      :instructors="instructors"
      :brand="brand"
    ></CoachesInLesson>
  </div>
</template>

<script>
// TODO: REFACTOR THE MODAL OF THIS COMPONENT!
import Utils from '../../assets/js/helper-functions/utils.js';
import ThemeClasses from "../../mixins/ThemeClasses";
import Toasts from "../../assets/js/classes/toasts";
import ContentService from "../../assets/js/services/content";
import CoachesInLesson from "./CoachesInLesson.vue";

export default {
  name: "VideoResources",
  components: {
    CoachesInLesson,
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
      completed: false,
    };
  },

  computed: {
    shareUrl() {
      if (this.useTimecode) {
        return `${location.protocol}//${location.host}${
          location.pathname
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
      this.completed = !this.completed;
        //Send Request
        ContentService.markContentAsComplete(this.contentId).then(() => {
            window.shownotification({
                icon: 'check',
                text: `You completed this lesson!`
            })
        }).catch(() => {
            window.shownotification({
                icon: 'error',
                text: 'Woops! Something wrong happened, please try again later.'
            })
        })

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
      window.closeAllModals();

      Toasts.push({
        icon: "happy",
        title: "SHARE THE LOVE!",
        message: "This URL has been copied, and is ready to share!",
      });
    },
  },
};
</script>
