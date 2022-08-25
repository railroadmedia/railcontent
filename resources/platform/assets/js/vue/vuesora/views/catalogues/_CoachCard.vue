<template>
  <a
    :href="item.url"
    class="tw-relative tw-flex tw-bg-cover tw-bg-toptw-bg-gray-200 tw-overflow-hidden tw-rounded-lg lg:tw-rounded-xl tw-no-underline tw-text-white"
  >
    <img :src="`https://musora.com/cdn-cgi/image/width=300/${coachImage}`" 
         :alt="coachName" 
         class="tw-w-full tw-transition-opacity tw-duration-500"
         :class="[ 
            item.imageLoaded ? 'tw-opacity-1' : 'tw-opacity-0',
            item.type === 'song' ? 'tw-blur-sm' : ''
         ]"
         loading="lazy"
         :onload="item.imageLoaded = true"
    />
    <!-- Coach Details -->
    <div
      class="tw-flex tw-flex-col tw-mt-auto tw-w-full tw-items-center tw-justify-center tw-h-3/4 tw-px-2 tw-text-center tw-absolute tw-w-full tw-bottom-0 tw-left-0"
      style="background: linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050F 100%);"
    >
      <h3
        class="tw-uppercase tw-font-bebas-neue tw-text-white tw-text-2xl xl:tw-text-3xl xl:tw-leading-none tw-break-all tw-leading-tight md:tw-leading-none tw-mt-auto tw-mb-2 tw-text-center"
      >
        <span>{{ coachFirstName }}</span
        ><br />
        <span v-if="hasLastName">{{ coachLastName }}</span>
      </h3>
      <p class="tw-text-yellow-400 tw-text-xs tw-h-8 tw-leading-snug tw-mb-4 tw-uppercase">{{ coachFocus }}</p>
      <div v-if="item.is_house_coach" class="tw-text-white tw-items-center tw-leading-none tw-text-xs tw-font-bebas-neue tw-absolute tw-bottom-0 tw-w-full tw-flex tw-mb-2 tw-justify-center">
        <musora-icon 
            icon-name="whistle-filled"
            height="12" 
            class="tw-text-white tw-mr-0.5 tw-w-[16px] tw-leading-none"
        ></musora-icon>
        <span class="tw-mt-1">HOUSE</span>
      </div>
    </div>

    <!-- hover -->
    <div
      class="tw-absolute tw-flex tw-h-full tw-w-full tw-top-0 tw-left-0 tw-bg-black tw-transition"
      :class="
        item.current_user_is_subscribed
          ? 'tw-bg-opacity-0 hover:tw-bg-opacity-30'
          : 'tw-bg-opacity-30 tw-opacity-0 hover:tw-opacity-100'
      "
    >
      <!-- Subscribe -->
      <button
        class="tw-btn-primary tw-btn-small tw-h-6 tw-w-6 tw-p-0 tw-ml-auto tw-mt-1 tw-mr-1"
        :class="
          item.current_user_is_subscribed
            ? 'tw-bg-white ' + themeTextClass
            : themeBgClass
        "
        @click.prevent="updateCoachSubscription(item.id)"
      >
        <i class="fas fa-bell tw-text-base"></i>
        <span class="tw-sr-only">
          <template v-if="item.current_user_is_subscribed"
            >Unsubscribe From Coach</template
          >
          <template v-else>Subscribe to Coach</template>
        </span>
      </button>
    </div>
  </a>
</template>
<script>
import Mixin from "./_mixin";
import ThemeClasses from "../../mixins/ThemeClasses";
import ContentService from "../../assets/js/services/content";

export default {
  name: "CoachCatalogueCard",
  mixins: [Mixin, ThemeClasses],
  data() {
    return {
      coachName: "",
      coachFocus: "",
      coachImage: "",
    };
  },
  props: {
    showMyListAction: {
      type: Boolean,
      default: () => true,
    },
    brand: {
      type: String,
      default: () => "drumeo",
    },
  },
  computed: {
    coachFirstName() {
      return this.coachName.split(" ")[0];
    },
    hasLastName() {
      return this.coachName.split(" ").length > 1;
    },
    coachLastName() {
      return this.coachName.substr(this.coachName.indexOf(" ") + 1);
    },
    themeBgClass() {
      return "tw-bg-" + this.brand;
    },
    themeTextClass() {
      return "tw-text-" + this.brand;
    },
  },
  //Get name before mounting
  beforeMount() {
    this.item["fields"].forEach((field) => {
      if (field.key === "name") {
        this.coachName = field.value;
      }
    });

    this.item["data"].forEach((obj) => {
      if (obj.key === "focus_text") {
        this.coachFocus = obj.value;
      }
      if (obj.key === "coach_card_image") {
        this.coachImage = obj.value;
      }
    })
  },
  //Get new name when updated
  beforeUpdate() {
    this.item["fields"].forEach((field) => {
      if (field.key === "name") {
        this.coachName = field.value;
      }
    });

    this.item["data"].forEach((obj) => {
      if (obj.key === "focus_text") {
        this.coachFocus = obj.value;
      }
      if (obj.key === "coach_card_image") {
        this.coachImage = obj.value;
      }
    })
  },
  methods: {
    updateCoachSubscription(id) {
      if (!this.item.current_user_is_subscribed) {
        this.item.current_user_is_subscribed = true;
        ContentService.followCoach({ coachId: id })
          .then(() => {
            const text = `You will now receive updates when ${this.coachFirstName} releases new content!`;
            this.$emit("onShowNotification", {
              text,
              icon: "fa-envelope",
            });
            // console.log("Subscribed to: " + this.coachName);
          })
          .catch(() => {
            this.item.current_user_is_subscribed = false;
            this.$emit("onShowNotification", {
              error: true,
            });
            // console.log("Subscribed did not work");
          });
      } else {
        this.item.current_user_is_subscribed = false;
        ContentService.unfollowCoach({ coachId: id })
          .then(() => {
            const text = `You will no longer receive updates when ${this.coachFirstName} releases new content!`;
            this.$emit("onShowNotification", {
              text,
              icon: "fa-bell-slash",
            });
            // console.log("Unsubscribed to: " + this.coachName);
          })
          .catch(() => {
            this.item.current_user_is_subscribed = true;
            this.$emit("onShowNotification", {
              error: true,
            });
            // console.log("Unubscribed did not work");
          });
      }
    },
  },
};
</script>
