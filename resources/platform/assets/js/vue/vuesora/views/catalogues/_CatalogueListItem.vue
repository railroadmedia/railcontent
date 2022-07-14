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
    :class="class_object"
    :href="renderLink ? item.url : false"
  >

    <!-- LESSON NUMBERS -->
    <div
      v-if="showNumbers"
      class="
        tw-flex 
        tw-flex-col
        tw-text-black
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
        <div class="thumb-img corners-10" :class="thumbnailType">
          <img
            src="https://dmmior4id2ysr.cloudfront.net/assets/images/image-loader.svg"
            :data-ix-src="mappedData.thumbnail"
            data-ix-fade
            alt="Lesson Thumbnail"
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
              :class="overview ? 'tiny' : 'x-tiny'"
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
            <p v-if="!isReleased" class="x-tiny text-white font-bold">
              {{ releaseDate }}
            </p>
          </span>
        </div>
      </div>
    </div>

    <!-- TITLES AND COLUMN DATA (on mobile) -->
    <div class="tw-flex tw-flex-col tw-justify-center tw-mr-auto title-column overflow">
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
        class="tw-text-[#00101D] dark:tw-text-white tw-font-bold item-title tw-mb-1"
        :class="overview ? 'heading' : 'tiny font-compressed'"
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
          hide-md-up
        "
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
      class="flex tw-flex-col sheet-music-col ph-1 hide-xs-only"
    >
      <img class="dark:tw-invert" :src="mappedData.sheet_music" />
    </div>

    <!-- SHOW ALL OF THE DATA COLUMNS FROM THE DATA MAPPER -->
    <div
      v-for="(column_data, i) in mappedData.column_data"
      v-if="!is_search"
      :key="`${item.id}-mappedData-${i}`"
      class="
        tw-flex 
        tw-flex-col
        tw-uppercase
        tw-justify-center
        basic-col
        tw-text-center
        tw-text-xs
        font-compressed
        hide-sm-down
      "
      :data-test="column_data"
    >
      {{ column_data }}
    </div>

    <!-- ONLY SHOW TYPE ON SEARCHES -->
    <div
      v-if="is_search"
      class="
        tw-flex tw-flex-col
        tw-uppercase
        tw-justify-center
        basic-col
        tw-text-center
        tw-text-xs
        hide-sm-down
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
        x-tiny
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
          class="fas fa-undo flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-black reset"
          title="Reset Progress"
          @click.stop.prevent="progressReset"
        ></i>
      </div>
      <div v-else class="body">
        <i
          class="add-to-list fas fa-plus flex-center dark:hover:tw-text-white hover:tw-text-black tw-transform-g"
          :class="is_added ? 'is-added tw-rotate-45 ' + themeTextClass : 'tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC]'"
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
        class="body tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-black"
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
          class="fas flex-center rounded dark:hover:tw-text-white hover:tw-text-black"
          :class="[
            item.completed ? completedIcon : 'fa-adjust',
            themeTextClass,
          ]"
        ></i>

        <i
          v-else
          class="fas flex-center tw-text-[#D4D4D8] dark:tw-text-[#9EC0DC] dark:hover:tw-text-white hover:tw-text-black rounded"
          :class="
            ['course', 'learning-path', 'pack', 'pack-bundle'].indexOf(
              item.type
            ) !== -1
              ? 'fa-arrow-circle-right'
              : 'fa-play-circle'
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
          this.item.type === "learning-path-course" || this.item.type === "learning-path-lesson",
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
