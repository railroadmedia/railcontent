<template>
  <div v-if="isVisible" class="tw-mb-[30px] tw-w-full tw-py-4 tw-px-4 tw-rounded-xl tw-bg-[#F3F4F6] tw-border tw-border-black/[0.15] dark:tw-bg-[#002039]/[0.7] dark:tw-border-white/[0.15]">
    <div class="tw-flex tw-flex-row tw-items-center">
      <!-- Live Event Image -->
      <a @click="(e) => handleClick(e, `${brand}/live`)" :href="`/${brand}/live`"
        class="tw-w-full md:tw-w-52 tw-cursor-pointer tw-flex-col tw-mb-2 md:tw-mb-0 tw-mr-4 tw-hidden md:tw-flex">
        <div class="tw-relative">
          <img class="tw-rounded-lg tw-w-full" :src="`https://www.musora.com/musora-cdn/image/fit=cover,width=320,height=180,quality=95/${content.image}`" />
        </div>
      </a>

      <div class="tw-flex tw-w-full tw-flex-col sm:tw-items-center sm:tw-flex-row">
        <!-- Event Details -->
        <div class="tw-flex tw-flex-col tw-justify-center tw-pr-4">
          <div class="tw-flex tw-items-center tw-mb-1">
            <!-- Live Badge -->
            <a @click="(e) => handleClick(e, `${brand}/live`)" :href="`/${brand}/live`" class="tw-flex tw-no-underline flex-row" v-if="eventIsLive">
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
            <a @click="(e) => handleClick(e, `${brand}/live`)" :href="`/${brand}/live`"
              class="tw-font-bold tw-no-underline tw-text-[#00101D] tw-capitalize tw-leading-tight tw-texl-xl md:tw-text-2xl dark:tw-text-white">
              {{ content.title }}
            </a>
          </div>

          <!-- Coaches -->
          <div class="tw-flex">
            <div class="tw-inline-flex" v-for="(coach, i) in content.instructors" :key="i">
              <a @click="(e) => handleClick(e, `${brand}/coaches/${coach.slug}`)" :href="`${brand}/coaches/${coach.slug}`" class="tw-no-underline tw-mr-1.5 tw-block">
                <h4 class="tw-leading-none tw-text-lg tw-uppercase tw-font-normal tw-text-[#00101D] dark:tw-text-white">
                  <span class="tw-mr-1">{{ coach.split(" ")[0] }}</span>
                  <span class="tw-font-bold tw-mr-1">{{ coach.split(" ")[1] }}</span>
                  <!-- Optional third name -->
                  <span class="tw-font-bold">{{ coach.split(" ")[2] }}</span>
                </h4>
              </a>
              <span v-if="i + 1 < content.instructors.length"
                class="tw-leading-none tw-font-bold dark:tw-text-white tw-text-lg tw-mr-1.5">&</span>
            </div>
          </div>

        </div>

        <!-- Buttons -->
        <div class="tw-flex tw-flex-col tw-justify-center tw-mt-3 sm:tw-mt-0 sm:tw-ml-auto">
          <div v-if="eventIsLive || showWatch">
            <div class="tw-flex-row tw-flex-wrap-md tw-hidden lg:tw-block">
              <div>
                <a @click="(e) => handleClick(e, `${brand}/live`)" :href="`${brand}/live`" class="tw-btn-primary tw-w-full" :class="[brandBGColor, brandHoverColor]">
                  watch now
                </a>
              </div>
            </div>
          </div>

          <div class="tw-flex tw-flex-nowrap" :class="{ 'tw-pt-3': showWatch }" v-if="!eventIsLive && !showWatch">
            <!-- Add to Playlist -->
            <button
              class="dark:tw-text-[#9EC0DC] dark:hover:tw-bg-[#000C17] hover:tw-bg-white tw-cursor-pointer tw-border-0 tw-bg-transparent tw-transition tw-text-3xl tw-mr-2 tw-inline-flex tw-items-center tw-justify-center tw-h-[61px] tw-w-[52px] tw-rounded"
              @click.stop.prevent="addToPlaylist">
              <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-7 tw-w-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
              </svg>
            </button>

            <!-- Subscribe to Calendar -->
            <button
              class="dark:tw-text-[#9EC0DC] dark:hover:tw-bg-[#000C17] hover:tw-bg-white tw-cursor-pointer tw-border-0 tw-bg-transparent tw-text-3xl tw-inline-flex tw-items-center tw-justify-center tw-h-[61px] tw-w-[52px] tw-rounded"
              data-open-modal="scheduleAddToCalendarModal" alt="Subscribe to Calendar" :class="[brandTextColor]">
              <i class="fas fa-calendar-plus" @click="toggleSubscribePopup"></i>
            </button>

            <content-schedule :subscription-calendar-id="content.event_coach_calendar_id" :theme-color="brand" :brand="brand"
              :toggleSubscribePopup="toggleSubscribePopup" v-if="showSubscribePopup"></content-schedule>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ContentSchedule from "../../views/schedule/Schedule.vue";
import { DateTime } from "luxon";
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import userJourney from '@services/userJourney';

export default {
  components: {
    "content-schedule": ContentSchedule,
  },
  name: "CoachEvent",
  props: {
    preloadedContent: {
      type: Object,
      default: () => ({}),
    },
    currentDateString: {
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
    trackingSection: {
      type: String,
      default: () => "",
    },
  },
  data() {
    return {
      content: null,
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
      counterInterval: null,
    };
  },
  mounted() {
    if (this.preloadedContent) {
      this.content = this.preloadedContent;
      this.startTime = DateTime.fromSQL(this.content.published_on, { zone: "UTC" });
      this.startDate = new Date(this.startTime);
      this.startWeekday = this.startDate.toLocaleString("en-US", { weekday: "long" });
      this.startMonth = this.startDate.toLocaleString("en-US", { month: "long" });
      this.startDay = this.startDate.getDate();
      this.formattedTime = this.startDate.toLocaleTimeString([], { timeStyle: "short" });

      this.checkIfLive();
    }
  },
  beforeDestroy() {
    clearInterval(this.counterInterval);
  },
  computed: {
    isVisible() {
      return this.content && this.counterValue > 0 && this.counterValue / 3600 <= 48;
    },
    $_hours() {
      return this.padTwoDigits(Math.max(0, Math.floor(this.counterValue / 3600)));
    },
    $_minutes() {
      const hours = Math.floor(this.counterValue / 3600);
      const secondsForMinutes = this.counterValue - hours * 3600;
      return this.padTwoDigits(Math.max(0, Math.floor(secondsForMinutes / 60)));
    },
    $_seconds() {
      const hours = Math.floor(this.counterValue / 3600);
      const secondsForMinutes = this.counterValue - hours * 3600;
      const minutes = Math.floor(secondsForMinutes / 60);
      return this.padTwoDigits(Math.max(0, secondsForMinutes - minutes * 60));
    },
    brand() {
      const userStore = useUserStore();
      const { brand } = storeToRefs(userStore);
      return brand.value;
    },
    token() {
      const userStore = useUserStore();
      const { token } = storeToRefs(userStore);
      return token.value;
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
        this.counterInterval = setInterval(() => {
          this.counterValue -= 1;
          if (this.counterValue <= 0) {
            this.setLiveState();
            clearInterval(this.counterInterval);
          }
        }, 1000);
      });
    },

    checkIfLive() {
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
    },

    handleClick(event, url) {
      event.preventDefault();

      if (this.trackingSection && this.trackingSection.length) {
        userJourney.trackHomeContentClick({
          token: this.token,
          payload: {
            contentId: null,
            brand: this.brand,
            section: this.trackingSection,
          }
        }).finally(() => {
          window.location.href = url;
        });
      } else {
        window.location.href = url;
      }
    },

    padTwoDigits(number) {
      return ("0" + number).slice(-2);
    },

    addToPlaylist() {
      const { title, id, description, image } = this.content;

      window.openplaylistmodal({
        modalType: 'addItem', brand: this.brand, content: {
          content_id: id,
          brand: this.brand,
          name: title,
          description,
          thumbnail_url: image
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
      window.shownotification({
        icon,
        text,
        isError: !!error
      });
    },
  },
  watch: {
    currentDateString(newVal) {
      this.currentDate = DateTime.fromSQL(newVal, { zone: "UTC" });
      this.checkIfLive();
    },
    preloadedContent(newContent) {
      if (newContent) {
        this.content = newContent;
        this.startTime = DateTime.fromSQL(this.content.published_on, { zone: "UTC" });
        this.checkIfLive();
      }
    }
  }
};
</script>
