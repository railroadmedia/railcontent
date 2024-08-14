<template>
  <div :id="modalId" class="modal small">
    <div class="
          tw-flex tw-flex-col tw-bg-white dark:tw-bg-[#081825]
          shadow
          corners-10
          tw-mx-auto
          align-h-center
          tw-overflow-visible tw-max-w-lg
          tw-border dark:tw-border-[#445F74]
          tw-text-[#000C17] dark:tw-text-white
        ">
        <div class="tw-relative tw-p-4 md:tw-p-7 modal-container">
          <h1 class="tw-text-center tw-mb-2 tw-text-xl tw-font-bold md:tw-text-2xl">
            Subscribe to Calendar
          </h1>

          <p class="tw-text-sm tw-leading-normal tw-text-center tw-mb-4">
            Here you can subscribe to {{ toCapitalCase(brand) }}'s Lesson Calendar -
            Apple Calendar, Google Calendar, Outlook, and Yahoo Calendar are all
            supported.
          </p>


          <div v-if="subscriptionCalendarId" class="tw-relative tw-text-center" style="width: 100%">
            <button class="btn tw-mb-2 tw-w-full" @click.stop="
              subscriptionCalendarDropdown = !subscriptionCalendarDropdown
            ">
              <div class="
                    tw-max-w-full
                    tw-text-lg
                    tw-rounded-full
                    tw-py-2
                    tw-uppercase
                    tw-font-bebas-neue
                    tw-mb-2
                    tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white
                  ">
                <i class="fas fa-calendar-plus tw-mr-1"></i>
                Subscribe to calendar
              </div>
            </button>

            <transition name="grow-fade">
              <add-event-dropdown :single-event="singleEvent" v-if="subscriptionCalendarDropdown" key="subscriptionCalendar"
                :subscription-calendar-id="subscriptionCalendarId" :is-subscription="true"></add-event-dropdown>
            </transition>
          </div>

          <p v-if="subscriptionCalendarId" class="tw-text-xs tw-italic tw-text-center tw-mb-2">
            Any upcoming releases will automatically show up in this calendar as
            they are scheduled by the {{ toCapitalCase(brand) }} Team.
          </p>

          <p v-if="hasSingleEvent" class="tw-text-sm tw-leading-normal tw-text-center tw-mb-2">
            Or you can subscribe to this event only by clicking the button below.
          </p>

          <div v-if="hasSingleEvent" class="tw-text-sm tw-leading-normal pointer tw-relative tw-w-full">
            <button class="tw-btn-primary tw-mb-1 tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57] dark:hover:tw-text-white tw-w-full" @click.stop="singleEventDropdown = !singleEventDropdown">
                <i class="fas fa-calendar-plus tw-mr-1"></i>
                Subscribe to this event only
            </button>

            <transition name="grow-fade">
              <add-event-dropdown v-if="singleEventDropdown" :single-event="singleEvent">
              </add-event-dropdown>
            </transition>
          </div>

          <p v-if="hasSingleEvent" class="tw-text-xs tw-italic tw-text-center tw-mb-2">
            {{ singleEventDescription }}
          </p>
        </div>
    </div>
  </div>
</template>
<script>
import UtilsHelpers from "../../assets/js/helper-functions/utils.js";
import AddEventDropdown from "./AddEventDropdown.vue";
import ThemeClasses from "../../mixins/ThemeClasses";
import InfoModal from "@collections/Modal/InfoModal.vue";
import ModalRenderer from "@collections/Modal/ModalRenderer.vue";

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