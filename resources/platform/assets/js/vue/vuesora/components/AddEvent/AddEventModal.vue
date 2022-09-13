<template>
  <div :id="modalId" class="modal small">
    <div class="
          tw-flex tw-flex-col tw-bg-white
          shadow
          corners-10
          tw-mx-auto tw-p-4
          md:tw-p-7
          align-h-center
          tw-overflow-visible tw-max-w-lg
        ">
      <h1 class="tw-text-center tw-mb-2 tw-text-xl tw-font-bold md:tw-text-2xl tw-text-[#00101D]">
        Subscribe to Calendar
      </h1>

      <p class="tw-text-sm tw-leading-normal tw-text-center tw-mb-4 tw-text-[#00101D]">
        Here you can subscribe to {{ toCapitalCase(brand) }}'s Lesson Calendar -
        Apple Calendar, Google Calendar, Outlook, and Yahoo Calendar are all
        supported.
      </p>

      <div v-show="subscriptionCalendarId" class="tw-relative tw-text-center" style="width: 100%">
        <button class="btn tw-mb-2 tw-w-full" @click.stop="
          subscriptionCalendarDropdown = !subscriptionCalendarDropdown
        ">
          <div class="
                tw-text-white
                tw-max-w-full
                tw-text-lg
                tw-rounded-full
                tw-py-4
                tw-uppercase
                tw-font-bebas-neue
              " :class="'tw-' + themeBgClass">
            <i class="fas fa-calendar-plus tw-mr-1"></i>
            Subscribe to calendar
          </div>
        </button>

        <transition name="grow-fade">
          <add-event-dropdown :single-event="singleEvent" v-show="subscriptionCalendarDropdown" key="subscriptionCalendar"
            :subscription-calendar-id="subscriptionCalendarId" :is-subscription="true"></add-event-dropdown>
        </transition>
      </div>

      <p v-show="subscriptionCalendarId" class="tw-text-xs tw-italic tw-text-center tw-mb-2 tw-text-[#00101D]">
        Any upcoming releases will automatically show up in this calendar as
        they are scheduled by the {{ toCapitalCase(brand) }} Team.
      </p>

      <p v-show="hasSingleEvent" class="tw-text-sm tw-leading-normal tw-text-center tw-mb-2">
        Or you can subscribe to this event only by clicking the button below.
      </p>
      <div v-show="hasSingleEvent" class="tw-text-sm tw-leading-normal pointer tw-relative" style="width: 100%">
        <button class="btn tw-mb-1" @click.stop="singleEventDropdown = !singleEventDropdown">
          <span class="inverted" :class="[themeTextClass, themeBgClass]">
            <i class="fas fa-calendar-plus tw-mr-1"></i>
            Subscribe to this event only
          </span>
        </button>

        <transition name="grow-fade">
          <add-event-dropdown v-show="singleEventDropdown" :single-event="singleEvent">
          </add-event-dropdown>
        </transition>
      </div>

      <p v-show="hasSingleEvent" class="tw-text-xs tw-italic tw-text-center tw-mb-2">
        {{ singleEventDescription }}
      </p>
    </div>
  </div>
</template>
<script>
import UtilsHelpers from "../../assets/js/helper-functions/utils.js";
import AddEventDropdown from "./AddEventDropdown.vue";
import ThemeClasses from "../../mixins/ThemeClasses";
import InfoModal from "../../../components/Modal/InfoModal.vue";
import ModalRenderer from "../../../components/Modal/ModalRenderer.vue";

export default {
  name: "AddEventModal",
  components: {
    "add-event-dropdown": AddEventDropdown,
    InfoModal, ModalRenderer
  },
  mixins: [ThemeClasses],
  props: {
    modalId: {
      type: String,
      default: "addToCalendarModal",
    },
    brand: {
      type: String,
      default: () => "Musora",
    },
    singleEvent: {
      type: Object,
      default: () => ({
        title: null,
        date: null,
      })
    },
    subscriptionCalendarId: {
      type: String,
      default: "",
    },
    singleEventDescription: {
      type: String,
      default: () => "Only this event will be added to your calendar.",
    },
    toggleSubscribe: {
      type: Function,
      default: () => { },
    },
  },
  data() {
    return {
      singleEventDropdown: false,
      subscriptionCalendarDropdown: false,
    };
  },
  computed: {
    hasSingleEvent() {
      return (
        this.singleEvent.title != null && this.singleEvent.title.length > 0
      );
    },
  },
  watch: {
    singleEventDropdown(val) {
      if (val) {
        this.subscriptionCalendarDropdown = false;
      }
    },
    subscriptionCalendarDropdown(val) {
      if (val) {
        this.singleEventDropdown = false;
      }
    },
  },
  mounted() {
    document.body.addEventListener("click", () => {
      this.singleEventDropdown = false;
      this.subscriptionCalendarDropdown = false;
    });

    window.addEventListener("modalClose", () => {
      this.$emit("modalClose");
    });
  },
  methods: {
    toCapitalCase: (string) => UtilsHelpers.toCapitalCase(string),
    toggleModal() {
      this.toggleSubscribe();
    },
  },
};
</script>
