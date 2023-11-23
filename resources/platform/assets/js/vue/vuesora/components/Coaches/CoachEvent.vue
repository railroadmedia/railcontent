<template>
  <div
    class="tw-mb-[30px] tw-w-full tw-py-4 tw-px-4 tw-rounded-xl tw-bg-[#F3F4F6] tw-border tw-border-black/[0.15] dark:tw-bg-[#002039]/[0.7] dark:tw-border-white/[0.15]"
    v-if="content && $_hours <= 48">
    <div class="tw-flex tw-flex-row tw-items-center">
      <!-- Live Event Image -->
      <a :href="`${brand}/live`"
        class="tw-w-full md:tw-w-52 tw-cursor-pointer tw-flex-col tw-mb-2 md:tw-mb-0 tw-mr-4 tw-hidden md:tw-flex">
        <div class="tw-relative">
          <img class="tw-rounded-lg tw-w-full" :src="'https://cdn.musora.com/image/fetch/c_thumb,w_320,h_180,z_0.75,q_auto:best/' +
            (content.thumbnail_url
              ? content.thumbnail_url
              : instructors[0].head_shot_picture_url)
            " />
        </div>
      </a>

      <div class="tw-flex tw-w-full tw-flex-col sm:tw-items-center sm:tw-flex-row">
        <!-- Event Details -->
        <div class="tw-flex tw-flex-col tw-justify-center tw-pr-4">
          <div class="tw-flex tw-items-center tw-mb-1">
            <!-- Live Badge -->
            <a :href="`${brand}/live`" class="tw-flex tw-no-underline flex-row" v-if="eventIsLive">
              <div
                class="flex-center tw-text-white tw-uppercase tw-rounded tw-bg-red-500 tw-text-sm tw-font-bold tw-leading-none tw-p-1">
                <span>live</span>
              </div>
            </a>

            <!-- Countdown -->
            <div
              class="tw-text-white tw-text-sm tw-font-bold tw-p-1.5 tw-leading-none tw-rounded tw-inline-flex tw-mr-2 tw-bg"
              :class="[brandBGColor]" v-if="!eventIsLive">
              <span class="tw-uppercase">Upcoming:&nbsp;</span>
              <span>{{ $_hours }}</span>
              <span>&nbsp;hrs&nbsp;-&nbsp;</span>
              <span>{{ $_minutes }}</span>
              <span>&nbsp;minutes</span>
            </div>

            <!-- Start Date -->
            <p class="tw-uppercase tw-leading-none tw-hidden xl:tw-block dark:tw-text-white" v-if="!eventIsLive">
              <span>{{ startWeekday }}</span>,
              <span class="tw-mr-1">{{ startMonth }}</span>
              <span> {{ startDay }}</span>
              @
              <span>{{ formattedTime }}</span>
            </p>
          </div>

          <!-- Event Title & Desc -->
          <div class="tw-mb-1.5">
            <a :href="`${brand}/live`"
              class="tw-font-bold tw-no-underline tw-text-[#00101D] tw-capitalize tw-leading-tight tw-texl-xl md:tw-text-2xl dark:tw-text-white">
              {{ content.title }}
            </a>
          </div>

          <!-- Coaches -->
          <div class="tw-flex">
            <div class="tw-inline-flex" v-for="(coach, i) in instructors" :key="i">
              <a :href="`${brand}/coaches/${coach.slug}`" class="tw-no-underline tw-mr-1.5 tw-block">
                <h4 class="tw-leading-none tw-text-lg tw-uppercase tw-font-normal tw-text-[#00101D] dark:tw-text-white">
                  <span class="tw-mr-1">{{ coach.name.split(" ")[0] }}</span>
                  <span class="tw-font-bold tw-mr-1">{{ coach.name.split(" ")[1] }}</span>
                  <!-- Optional third name -->
                  <span class="tw-font-bold">{{ coach.name.split(" ")[2] }}</span>
                </h4>
              </a>
              <span v-if="i + 1 < instructors.length"
                class="tw-leading-none tw-font-bold dark:tw-text-white tw-text-lg tw-mr-1.5">&</span>
            </div>
          </div>

        </div>

        <!-- Buttons -->
        <div class="
            tw-flex tw-flex-col tw-justify-center tw-mt-3
            sm:tw-mt-0 sm:tw-ml-auto 
          ">
          <div v-if="eventIsLive || showWatch">
            <div class="tw-flex-row tw-flex-wrap-md tw-hidden lg:tw-block">
              <div>
                <a :href="`${brand}/live`" class="tw-btn-primary tw-w-full" :class="[brandBGColor, brandHoverColor]">
                  watch now
                </a>
              </div>
            </div>
          </div>

          <div class="tw-flex tw-flex-nowrap" :class="{ 'tw-pt-3': showWatch }" v-if="!eventIsLive && !showWatch">
            <!-- Add to Playlist -->
            <button
              class="tw-cursor-pointer tw-border-0 tw-bg-transparent tw-transition tw-text-3xl tw-mr-6 tw-text-gray-400"
              @click.stop.prevent="addToPlaylist">
              <i class="fas fa-plus tw-transform tw-transition tw-origin-center">
              </i>
            </button>

            <!-- Subscribe to Calendar -->
            <button class="tw-cursor-pointer tw-border-0 tw-bg-transparent tw-text-3xl"
              data-open-modal="scheduleAddToCalendarModal" alt="Subscribe to Calendar" :class="[brandTextColor]">
              <i class="fas fa-calendar-plus" @click="toggleSubscribePopup"></i>
            </button>

            <content-schedule :subscription-calendar-id="subscriptionCalendarId" :theme-color="brand" :brand="brand"
              :toggleSubscribePopup="toggleSubscribePopup" v-if="showSubscribePopup"></content-schedule>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ContentHelpers from "../../assets/js/helper-functions/content.js";
import ContentSchedule from "../../views/schedule/Schedule.vue";
import ContentService from "../../assets/js/services/content";
import { DateTime } from "luxon";

export default {
  components: {
    "content-schedule": ContentSchedule,
  },
  name: "CoachEvent",
  props: {
    brand: {
      type: String,
      default: () => "drumeo",
    },
    preloadedContent: {
      type: Object,
      default: () => ({}),
    },
    currentDateString: {
      type: String,
      default: () => "",
    },
    subscriptionCalendarId: {
      type: String,
      default: () => "",
    },
    timeCutoffMinutes: {
      type: Number,
      default: () => 0,
    },
    youtubeEventId: {
      type: String,
      default: () => "",
    },
  },
  data() {
    return {
      content: null,
      instructors: null,
      currentDate: DateTime.fromSQL(this.currentDateString, { zone: "UTC" }),
      counterValue: 0,
      eventIsLive: false,
      showWatch: false,
      showWatchSecondsBeforeLive: 60 * 15,
      startTime: "",
      startDate: "",
      startDay: "",
      startWeekday: "",
      startMonth: "",
      formattedTime: "",
      showSubscribePopup: false,
    };
  },
  mounted() {
    if (this.preloadedContent?.data[0]) {
      this.content = ContentHelpers.flattenContentObject(
        this.preloadedContent.data[0],
        true
      );
      this.instructors = this.content.instructor;
      this.startTime = DateTime.fromSQL(this.content.live_event_start_time, {
        zone: "UTC",
      });
      this.startDate = new Date(this.startTime);
      this.startWeekday = this.startDate.toLocaleString("en-US", {
        weekday: "long",
      });
      this.startMonth = this.startDate.toLocaleString("en-US", {
        month: "long",
      });
      this.startDay = this.startDate.getDate();
      this.formattedTime =
        this.startDate.toLocaleTimeString([], { timeStyle: "short" }) + "";

      if (this.startTime < this.currentDate) {
        this.setLiveState();
      } else {
        this.eventIsLive = false;
        let secondsToStart = this.startTime
          .diff(this.currentDate, "seconds")
          .toObject().seconds;

        if (secondsToStart < this.showWatchSecondsBeforeLive) {
          this.showWatch = true;
        } else {
          setTimeout(() => {
            this.showWatch = true;
          }, (secondsToStart - this.showWatchSecondsBeforeLive) * 1000);
        }

        this.counterValue = secondsToStart;

        this.startCounter();
      }
    }
  },
  computed: {
    $_hours() {
      return this.padTwoDigits(Math.floor(this.counterValue / 3600));
    },
    $_minutes() {
      let hours = Math.floor(this.counterValue / 3600);
      let secondsForMinutes = this.counterValue - hours * 3600;

      return this.padTwoDigits(Math.floor(secondsForMinutes / 60));
    },
    $_seconds() {
      let hours = Math.floor(this.counterValue / 3600);
      let secondsForMinutes = this.counterValue - hours * 3600;
      let minutes = Math.floor(secondsForMinutes / 60);

      return this.padTwoDigits(secondsForMinutes - minutes * 60);
    },
    $_iframeSource() {
      return `https://www.youtube.com/embed/${this.youtubeEventId}?rel=0&autoplay=1&playsinline=1&modestthemeColoring=1`;
    },
    is_added: {
      cache: false,
      get() {
        return this.content.is_added_to_primary_playlist;
      },
    },
    brandBGColor() {
      return "tw-bg-" + this.brand;
    },
    brandHoverColor() {
      return "hover:tw-bg-" + this.brand + "-600";
    },
    brandBorderColor() {
      return "tw-border-" + this.brand;
    },
    brandTextColor() {
      return "tw-text-" + this.brand;
    },
  },
  methods: {
    startCounter() {
      this.$nextTick(() => {
        const interval = setInterval(
          function () {
            this.counterValue -= 1;
            if (this.counterValue <= 0) {
              this.setLiveState();
              clearInterval(interval);
            }
          }.bind(this),
          1000
        );
      });
    },

    padTwoDigits(number) {
      if (number < 100) {
        return ("0" + number).slice(-2);
      } else {
        return number;
      }
    },

    addToPlaylist() {
      const { title, id, description, thumbnail_url } = this.content;

      window.openplaylistmodal({
        modalType: 'addItem', brand: this.brand, content: {
          content_id: id,
          brand: this.brand,
          name: title,
          description,
          thumbnail_url
        }
      });
    },

    setLiveState() {
      this.eventIsLive = true;
      document.body.classList.add("live");
    },

    toggleSubscribePopup() {
      this.showSubscribePopup = !this.showSubscribePopup;
    },

    showNotificationToast({ icon, text, error }) {
      if (error) {
        window.shownotification({
          isError: true
        })
      } else {
        window.shownotification({
          icon,
          text
        });
      }
    },
  },
};
</script>
