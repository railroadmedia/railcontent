<template>
  <teleport v-if="showNotification" to="#notifications-container">
    <div style="position: fixed; left: 0; width: 100vw; z-index: 10000; bottom: 40px;">
      <div class="tw-text-center tw-pb-6">
        <div class="lg:tw-flex">
          <div v-if="isMembersArea" class="tw-hidden lg:tw-block" :class="isSidebarCollapsed ? 'lg:tw-w-[68px]' : 'lg:tw-w-[256px]'"></div>
          <div class="lg:tw-flex-1 tw-flex tw-justify-center">
            <div class="lg:tw-max-w-[1280px] tw-w-full lg:tw-mx-auto" :class="isMembersArea ? 'lg:tw-pl-7 lg:tw-pr-9' : 'tw-px-9'">
              <div :class="`
                              tw-px-[16px]
                              tw-py-2
                              tw-w-4/6 lg:tw-w-full
                              tw-justify-self-center
                              tw-mx-auto
                              tw-rounded-md
                              tw-drop-shadow-md
                              dark:tw-text-black
                              tw-text-white
                              dark:tw-bg-white
                              tw-bg-[#081825]
                              ${slideClassData}`
                ">
                <div class="tw-flex tw-justify-between tw-items-center tw-text-sm">
                  <div class="tw-flex tw-items-center">
                    <musora-icon v-if="SVGIcon.length" :icon-name="SVGIcon"
                      class="tw-w-[24px] tw-h-[24px] tw-mr-2 tw-inline-flex" />
                    <i v-else class="fas tw-mr-2 tw-text-[22px]"
                      :class="notificationIcon ? notificationIcon : 'fa-bell'"></i>
                    <span class="tw-font-bold tw-text-sm" v-html="notificationText"></span>
                  </div>
                  <button
                    class="tw-ml-2 dark:tw-bg-[#E4E4E7] tw-bg-[#223F57] tw-w-[40px] tw-h-[40px] tw-flex-shrink-0 tw-border-none tw-rounded-full"
                    v-on:click="handleOnClose">
                    <i class="far fa-times dark:tw-text-black tw-text-white"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </teleport>
</template>

<script>
import MusoraIcon from '@units/MusoraIcons/MusoraIcon.vue'

const iconAllowList = {
  playlist: true,
  shuffle: true,
  repeat: true,
  report: true,
  trash: true,
};

export default {
  name: "NotificationToasts",
  props: {
    slideClass: {
      type: String,
      default: 'slide-in-bottom'
    },
    text: {
      type: String,
      default: () => "",
    },
    isSVGIcon: {
      type: Boolean,
      default: () => false,
    },
    icon: {
      type: String,
      default: () => "",
    },
    isMembersArea: {
      type: Boolean,
      default: () => true,
    },
    isError: {
      type: Boolean,
      default: () => false,
    },
    isSidebarCollapsed: {
      type: Boolean,
      default: () => false,
    },
    duration: {
      type: Number,
      default: 500
    },
  },
  emits: ['onClose'],
  updated() {
    // for debugging purposes
    //console.log('showNotification', this.showNotification);
  },
  methods: {
    handleOnClose() {
      this.slideClassData = 'slide-out-bottom';
      setTimeout(() => {
        this.$emit('onClose');
        this.slideClassData = 'slide-in-bottom';
      }, this.slideDuration);
    },

    //Capitalize Helper
    capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

  },
  data() {
    return {
      showNotification: false,
      SVGIcon: '',
      notificationIcon: this.icon,
      notificationText: this.text,
      slideClassData: this.slideClass,
    };
  },
  watch: {
    slideClass(val) {
      this.slideClassData = val;
    },
    icon(val) {
      //Check if it's a Musora Icon
      if (iconAllowList[val]) {
        this.SVGIcon = val;
      } else {
        this.SVGIcon = '';
      }
      //Check Fontawesome Icons
      if (val === 'error') {
        this.notificationIcon = 'fa-exclamation-circle tw-text-[#ef4444]';
      } else if (val === 'warning') {
        this.notificationIcon = 'fa-exclamation-circle tw-text-[#facb15]';
      } else if (val === 'check') {
        this.notificationIcon = 'fa-check-circle tw-text-[#22c55d]';
      } else if (val === 'edit') {
        this.notificationIcon = 'fa-edit dark:tw-text-black tw-text-white';
      } else if (val === 'xp') {
        this.notificationIcon = 'fa-child dark:tw-text-black tw-text-white';
      } else {
        this.notificationIcon = val;
      }
      if (val !== '') {
        this.showNotification = true;
      } else {
        this.showNotification = false;
      }
    },
    text(val) {
      if (val !== '') {
        this.showNotification = true;
      } else {
        this.showNotification = false;
      }
      this.notificationText = this.capitalizeFirstLetter(val);
    },
    isError(val) {
      if (val) {
        this.showNotification = true;
        this.notificationText = 'There has been an error, please try again later';
        this.notificationIcon = 'fa-exclamation-circle tw-text-[#ef4444]';
      } else {
        this.showNotification = false;
        this.notificationText = '';
        this.notificationIcon = '';
      }
    },
  },
};
</script>

<style>
.slide-in-bottom {
  -webkit-animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
  animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@-webkit-keyframes slide-in-bottom {
  0% {
    -webkit-transform: translateY(1000px);
    transform: translateY(1000px);
    opacity: 0;
  }

  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

@keyframes slide-in-bottom {
  0% {
    -webkit-transform: translateY(1000px);
    transform: translateY(1000px);
    opacity: 0;
  }

  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }
}

.slide-out-bottom {
  -webkit-animation: slide-out-bottom 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
  animation: slide-out-bottom 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
}

@-webkit-keyframes slide-out-bottom {
  0% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }

  100% {
    -webkit-transform: translateY(1000px);
    transform: translateY(1000px);
    opacity: 0;
  }
}

@keyframes slide-out-bottom {
  0% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
    opacity: 1;
  }

  100% {
    -webkit-transform: translateY(1000px);
    transform: translateY(1000px);
    opacity: 0;
  }
}
</style>
