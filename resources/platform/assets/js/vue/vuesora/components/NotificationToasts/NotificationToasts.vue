<template>
  <div
    v-if="showNotification"
    style="position: fixed; left: 0; width: 100vw; z-index: 2000; bottom: 40px;"
  >
    <div class="tw-text-center tw-pb-6">
      <div
        :class="`
          tw-px-[16px]
          tw-py-[20px]
          tw-w-4/6
          tw-justify-self-center
          tw-mx-auto
          tw-rounded-md
          tw-drop-shadow-md
          dark:tw-text-black
          tw-text-white
          dark:tw-bg-white
          tw-bg-[#081825]
          ${slideClass}`
        "
      >
        <div class="tw-flex tw-justify-between tw-items-center tw-text-small">
          <div>
            <i class="fas tw-mr-2 tw-text-[22px]" :class="notificationIcon ? notificationIcon : 'fa-bell'"></i>
            {{ notificationText }}
          </div>
          <button
            class="dark:tw-bg-[#E4E4E7] tw-bg-[#223F57] tw-w-[40px] tw-h-[40px] tw-border-none tw-rounded-full"
            v-on:click="handleOnClose"
          >
            <i class="far fa-times dark:tw-text-black tw-text-white"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
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
    icon: {
      type: String,
      default: () => "",
    },
    isError: {
      type: Boolean,
      default: () => false,
    },
  },
  emits: ['onClose'],
  methods: {
    handleOnClose() {
      this.slideClass = 'slide-out-bottom';
      setTimeout(() => {
        this.$emit('onClose');
        this.slideClass = 'slide-in-bottom';
      }, 500);
    }
  },
  data() {
    return {
      showNotification: false,
      notificationIcon: this.icon,
      notificationText: this.text,
      slideClass: this.slideClass,
    };
  },
  watch: {
    slideClass(val) {
      this.slideClass = val;
    },
    icon(val) {
      if (val === 'error') {
        this.notificationIcon = 'fa-exclamation-circle tw-text-[#ef4444]';
      } else if (val === 'warning') {
        this.notificationIcon = 'fa-exclamation-circle tw-text-[#facb15]';
      } else if (val === 'check') {
        this.notificationIcon = 'fa-check-circle tw-text-[#22c55d]';
      } else if (val === 'xp') {
        this.notificationIcon = 'fa-child dark:tw-text-black tw-text-white';
      }  else {
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
      this.notificationText = val;
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