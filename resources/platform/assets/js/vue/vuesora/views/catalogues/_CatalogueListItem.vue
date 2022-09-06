<template>
  <a
    class="
      tw-flex 
      tw-flex-row
      tw-relative
      tw-text-[#3F3F46] 
      dark:tw-text-[#9EC0DC]
      tw-border-b 
      tw-border-[#E4E4E7]
      dark:tw-border-[#223457]
      tw-no-underline
      hover:tw-bg-[#E7EFF6]
      dark:hover:tw-bg-[#002039]
    "
    :class="[class_object, isBranchPath ? [branchPathBG, branchPathText]: 'hover-bg-grey-7 hover-text-black']"
    :href="renderLink ? item.url : false"
  >
    <!-- LESSON NUMBERS -->
    <div
      v-if="showNumbers"
      class="
        tw-flex 
        tw-flex-col
        tw-text-[#00101D]
        dark:tw-text-white
        align-left 
        tw-justify-center
        number-col
        title
        hide-xs-only
      "
    >
      {{ lesson_number }}
    </div>

    <!-- THUMBNAIL COLUMN -->
    <div
      v-if="!showStudentReviewThumbsAsAvatar"
      class="tw-flex tw-flex-col tw-justify-center"
      :class="[thumbnailColumnClass, themeColor]"
    >
      <div class="thumb-wrap corners-10">
        <div class="thumb-img corners-10 thumb-wrap corners-10 bg-grey-2 dark:tw-bg-[#081825]" :class="thumbnailType">
          <img
            :src="`https://musora.com/cdn-cgi/image/width=500/${mappedData.thumbnail}`"
            alt="Lesson Thumbnail"
            class="tw-transition-opacity tw-duration-500"
            loading="lazy"
            :class="mappedData.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0'"
            @load="mappedData.imageLoaded = true"
          />

          <div class="lesson-progress overflow">
            <span
              class="progress"
              :class="themeBgClass"
              :style="'width:' + progress_percent + '%'"
            ></span>
          </div>

          <div
            v-if="mappedData.thumb_title && overview"
            class="thumb-title flex-center text-center ph-1"
            :class="brand"
          >
            <img
              v-if="mappedData.thumb_logo"
              :src="mappedData.thumb_logo"
              alt="Item Logo"
              style="max-width: 150px"
            />
            <h5
              v-if="mappedData.thumb_title"
              class="large-display uppercase text-white"
            >
              {{ mappedData.thumb_title }}
            </h5>
          </div>

          <span class="thumb-hover flex-center">
            <i class="fas" :class="thumbnailIcon"></i>
            <p
              v-if="!isReleased"
              class="tw-text-white tw-font-bold"
              :class="overview ? 'tw-text-sm' : 'tw-text-xs'"
            >
              {{ releaseDate }}
            </p>
          </span>
        </div>
      </div>
    </div>

    <!-- AVATAR INSTEAD OF THUMBNAIL -->
    <div
      v-if="showStudentReviewThumbsAsAvatar"
      class="tw-flex tw-flex-col tw-justify-center avatar-col"
    >
      <div class="thumb-wrap rounded" style="border-radius: 50%">
        <div
          class="thumb-img corners-10 square rounded"
          :style="'background-image:url( ' + thumbnail + ' );'"
        >
          <span
            class="thumb-hover rounded flex-center"
            style="border-radius: 50%"
          >
            <i class="fas" :class="thumbnailIcon"></i>
            <p v-if="!isReleased" class="tw-text-xs tw-text-white tw-font-bold">
              {{ releaseDate }}
            </p>
          </span>
        </div>
      </div>
    </div>

    <!-- TITLES AND COLUMN DATA (on mobile) -->
    <div class="tw-flex tw-flex-col tw-justify-center tw-mr-auto title-column overflow">

      <!-- Is New -->
      <div v-if="isBranchPath" 
           class="tw-font-roboto-condensed tw-font-bold tw-leading-none tw-w-fit tw-mb-2 tw-text-sm tw-uppercase tw-text-white tw-bg-pianote tw-p-1 tw-rounded"
           style="width: fit-content;"
      >
           New Method Path
      </div>

      <p
        v-if="brand !== 'guitareo' && !isCoach"
        class="tw-text-xs font-compressed tw-uppercase text-truncate tw-text-[#3F3F46] dark:tw-text-[#9EC0DC]"
        :class="[
          overview ? 'dense font-bold' : 'font-compressed',
        ]"
      >
        {{ mappedData.color_title }}
      </p>

      <p
        class="tw-text-[#00101D] dark:tw-text-white tw-font-bold item-title"
        :class="overview ? 'heading' : 'tw-text-sm lg:tw-text-base'"
      >
        {{ mappedData.black_title }}
      </p>

      <p
        v-if="mappedData.grey_title && overview"
        class="tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] item-title body tw-mt-1 tw-mb-4"
      >
        {{ mappedData.grey_title }}
      </p>

      <p
        v-if="overview && mappedData.description"
        class="tw-text-base text-grey-6 dark:tw-text-white mb-1 m-xs-only"
        v-html="mappedData.description"
      >
      </p>

      <p
        v-if="!is_search"
        class="
          tw-text-xs
          font-compressed
          tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] text-truncate
          tw-uppercase
          xl:tw-hidden
          tw-flex
          tw-flex-wrap
          sm:tw-flex-nowrap
        "
        :class="`${this.overview ? 'tw-mt-4' : ''}`"
      >
        <span
          v-for="(column_data, i) in mappedData.column_data"
          :key="`${item.id}-mappedData-${i}`"
        >
          <span v-if="i > 0" class="bullet">-</span>

          {{ column_data }}
        </span>
      </p>
    </div>

    <!-- SHEET MUSIC IMAGE IF IT EXISTS -->
    <div
      v-if="mappedData.sheet_music && !is_search"
      class="flex tw-flex-col tw-justify-center sheet-music-col ph-1 hide-xs-only"
    >
      <img class="dark:tw-invert tw-transition-opacity tw-duration-500" 
           alt="Rudiment Image"
           :src="mappedData.sheet_music" 
           loading="lazy"
      />
    </div>

    <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
    <div
      v-for="(column_data, i) in mappedData.column_data"
      v-if="!is_search"
      :key="`${item.id}-mappedData-${i}`"
      class="
        tw-hidden
        xl:tw-flex 
        tw-uppercase
        tw-items-center
        tw-justify-center
        basic-col
        tw-text-center
        tw-text-xs
        font-compressed
      "
      :data-test="column_data"
    >
      {{ column_data }}
    </div>

    <!-- ONLY SHOW TYPE ON SEARCHES -->
    <div
      v-if="is_search"
      class="
        tw-hidden
        sm:tw-flex 
        tw-flex-col
        tw-uppercase
        tw-justify-center
        basic-col
        tw-text-center
        tw-text-xs
      "
    >
      {{ item.type.replace("bundle-", "").replace(/-/g, " ") }}
    </div>
    <div
      v-if="is_search"
      class="
        flex tw-flex-col
        uppercase
        tw-justify-center
        basic-col
        text-center
        tw-text-xs
        hide-sm-down
      "
    >
      {{ releaseDate }}
    </div>

    <!-- ADD TO LIST OR RESET PROGRESS BUTTONS -->
    <div
      v-if="displayUserInteractions && item.type !== 'learning-path'"
      class="flex tw-flex-col icon-col tw-justify-center"
      :class="is_search ? '' : 'hide-xs-only'"
    >
      <div v-if="resetProgress" class="body">
        <i
          class="fas fa-undo flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D] reset"
          :class="isBranchPath ? branchPathText: 'text-grey-2 hover-text-black'"
          title="Reset Progress"
          @click.stop.prevent="progressReset"
        ></i>
      </div>
      <div v-else class="body">
        <i
          class="add-to-list fas fa-plus flex-center dark:hover:tw-text-white hover:tw-text-[#00101D] tw-transform-g"
          :class="[is_added ? 'is-added tw-rotate-45' + themeTextClass : 'tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC]', 
                   isBranchPath ? branchPathText: 'text-grey-2 hover-text-black' 
                  ]"
          :title="is_added ? 'Remove from My List' : 'Add to My List'"
          @click.stop.prevent="addToList"
        ></i>
      </div>
    </div>

    <div
      v-if="is_search && item.type === 'learning-path'"
      class="flex tw-flex-col icon-col tw-justify-center"
    ></div>

    <!-- PROGRESS INDICATOR OR LOCK ICON -->
    <div
      class="flex tw-flex-col icon-col tw-justify-center"
      :class="is_search || overview ? 'hide-xs-only' : ''"
    >
    
      <!-- LOCK ICON OR ADD TO CALENDAR -->
      <div
        v-if="noAccess"
        class="body"
        :class="isBranchPath ? branchPathText: 'tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D]'"
        title="Add to Calendar"
        data-open-modal="addToCalendarModal"
        @click="addEvent"
      >
        <i
          class="fas flex-center rounded"
          :class="isReleased ? 'fa-lock' : 'fa-calendar-plus'"
        ></i>
      </div>

      <!-- STARTED OR COMPLETED -->
      <div v-else class="body">
        <i
          v-if="item.started || item.completed"
          class="fas flex-center rounded dark:hover:tw-text-white hover:tw-text-[#00101D]"
          :class="[
            item.completed ? completedIcon : 'fa-adjust',
            themeTextClass,
          ]"
        ></i>

        <i
          v-else
          class="fas flex-center rounded"
          :class="[
            ['course', 'learning-path', 'pack', 'pack-bundle'].indexOf(item.type) !== -1 ? 'fa-arrow-circle-right' : 'fa-play-circle',
              isBranchPath ? branchPathText: 'tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-[#00101D]'
            ]
          "
        ></i>
      </div>
    </div>
  </a>
</template>
<script>
import Mixin from "./_mixin";
import ThemeClasses from "../../mixins/ThemeClasses";

export default {
  name: "CatalogueListItem",
  mixins: [Mixin, ThemeClasses],
  props: {
    isCoach: {
      type: Boolean,
      default: () => false,
    },
    isBranchPath: {
      type: Boolean,
      default: () => false,
    }
  },
  computed: {
    mappedData() {
      return this.contentModel.list;
    },

    class_object() {
      return {
        active: this.active,
        completed: this.item.completed,
        "content-overview": this.overview,
        "pv-2": this.overview,
        "content-table-row": !this.overview,
        "pv-1": !this.overview,
        "no-access": this.noAccess,
        "wrap-on-mobile": false,
        compact: this.compactLayout,
        "start-learning-path":
          this.contentTypeOverride === "learning-path-part",
      };
    },

    showStudentReviewThumbsAsAvatar() {
      return (
        this.item.type === "student-review" && this.forceWideThumbs === false
      );
    },

    thumbnailColumnClass() {
      return {
        "large-thumbnail": this.overview,
        "thumbnail-col": !this.overview,
        active: this.active,
        "background-cards tw-mt-3":
          this.item.type === "learning-path" ||
          this.item.type === "learning-path-course",
      };
    },

    lesson_number() {
      if (this.item.type === "semester-pack-lesson") {
        return this.contentModel.getPostField("week");
      }

      return this.index;
    },
  },
  beforeDestroy() {
    this.contentModel = null;
  },
};
</script>
