<script setup>
import { onMounted, onUnmounted, ref, watchEffect } from "vue";
import { XIcon } from "@heroicons/vue/solid";
const props = defineProps({
  modalId: {
    type: String
  },
  title: {
    type: String
  },
  subtitle: {
    type: String
  },
  brand: {
    type: String,
    default: 'drumeo'
  },
  submitLabel: {
    type: String,
    default: 'Yes'
  },
  hideCancel: {
    type: Boolean,
    default: false,
  }
});
const emit = defineEmits(["onClose", "onCancel", "onSubmit"]);

const slideClass = ref('slide-in-right');
const nextEmit = ref(null)

const onClose = () => {
  slideClass.value = 'slide-out-left';
  nextEmit.value = 'onClose';
};

const onSubmit = () => {
  slideClass.value = 'slide-out-left';
  nextEmit.value = 'onSubmit';
};

const onCancel = () => {
  slideClass.value = 'slide-out-left';
  nextEmit.value = 'onCancel';
};

const onOverlayClick = (event) => {
  if (event.target.id === `${props.modalId}-overlay`) {
    slideClass.value = 'slide-out-left';
    nextEmit.value = 'onClose';
  }
};

watchEffect(
  () => {
    if(slideClass.value === 'slide-out-left' && nextEmit.value) {
      setTimeout(() => {
        emit(nextEmit.value);
      }, 300)
    }
  }
);

onMounted(() => {
  const modalContainer = document.getElementById("confirmation-container");
  modalContainer.classList.remove("tw-hidden");
  modalContainer.classList.add("tw-fixed");
  modalContainer.classList.add("tw-h-full");
  modalContainer.classList.add("tw-w-full");
  modalContainer.classList.add("tw-z-40");
});

onUnmounted(() => {
  const modalContainer = document.getElementById("confirmation-container");
  modalContainer.classList.add("tw-hidden");
  modalContainer.classList.remove("tw-fixed");
});
</script>

<template>
  <teleport to="#confirmation-container">
    <div :id="`${modalId}-overlay`" class="
            tw-absolute tw-h-full tw-w-full tw-bg-[#000000] tw-bg-opacity-80 tw-z-30
          " @click="onOverlayClick">
    </div>
    <div class="
            tw-absolute
            tw-flex
            tw-h-full
            tw-w-full
            tw-items-center
            tw-justify-center
            tw-px-[16px]
            md:tw-px-[28px]
          ">
      <div class="
              tw-rounded-[8px]
              tw-z-40
              tw-pt-[24px]
              tw-pb-[42px]
              tw-flex
              tw-flex-col
              tw-border-[#223F57]
              tw-border-[1px]
              tw-bg-white
              dark:tw-bg-[#081825]
              tw-text-black
              dark:tw-text-white
              tw-w-[606px]
              tw-relative
            "
          :class="slideClass"
        >
        <div class="
                tw-flex
                tw-flex-row
                tw-justify-between
                tw-text-white
                tw-px-[64px]
              ">
          <h3 class="tw-w-full tw-text-center tw-text-[20px] tw-text-black dark:tw-text-white">{{ title }}</h3>
        </div>
        <div
          class="tw-text-center tw-text-[#000C17] dark:tw-text-white tw-flex tw-justify-center tw-items-center tw-text-black tw-py-[32px]">
          {{ subtitle }}
        </div>
        <div class="tw-flex tw-justify-end tw-px-[32px]">
          <button v-if="!hideCancel" @click="onCancel" class="tw-grow tw-btn-secondary tw-text-[#00101D] dark:tw-text-white tw-border-2 tw-border-[#000C17] dark:tw-border-white tw-bg-white dark:tw-bg-[#00101D] hover:tw-bg-[#00101D] hover:tw-text-white dark:hover:tw-bg-white dark:hover:tw-text-[#00101D]">No</button>
          <button @click="onSubmit" :class="`tw-grow tw-btn-primary tw-ml-[16px] tw-text-white dark:tw-text-[#00101D] tw-bg-[#00101D] dark:tw-bg-white hover:tw-bg-[#3F3F46] dark:hover:tw-bg-[#223F57]`">{{ submitLabel }}</button>
        </div>
        <!-- X Icon -->
        <button @click="onClose" class="tw-absolute tw-top-3 tw-right-3">
          <XIcon class="tw-text-[#000C17] dark:tw-text-white tw-h-[30px] tw-w-[30px]" />
        </button>
      </div>
    </div>
  </teleport>
</template>

<style>
.slide-out-left {
  -webkit-animation: slide-out-left 0.3s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
  animation: slide-out-left 0.3s cubic-bezier(0.550, 0.085, 0.680, 0.530) both;
}

.slide-in-right {
  -webkit-animation: slide-in-right 0.3s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
  animation: slide-in-right 0.3s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}

@-webkit-keyframes slide-out-left {
  0% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }

  100% {
    -webkit-transform: translateX(-1000px);
    transform: translateX(-1000px);
    opacity: 0;
  }
}

@keyframes slide-out-left {
  0% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }

  100% {
    -webkit-transform: translateX(-1000px);
    transform: translateX(-1000px);
    opacity: 0;
  }
}

@-webkit-keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(1000px);
    transform: translateX(1000px);
    opacity: 0;
  }

  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slide-in-right {
  0% {
    -webkit-transform: translateX(1000px);
    transform: translateX(1000px);
    opacity: 0;
  }

  100% {
    -webkit-transform: translateX(0);
    transform: translateX(0);
    opacity: 1;
  }
}
</style>
