<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { XIcon } from "@heroicons/vue/solid";
const isContainerCreated = ref(false);
const props = defineProps(["modalId", "title", "selfContained", "classOverride", "showOverlay", "containerStayOnClose"]);
const emit = defineEmits(["onClose"]);

const onClose = () => {
  emit("onClose", true);
};

const onOverlayClick = (event) => {
  if (event.target.id === `${props.modalId}-overlay`) {
    emit("onClose", true);
  }
};

onMounted(() => {
  if (props.selfContained) {
    const modalContainer = document.getElementById("modal-container");
    modalContainer.classList.remove("tw-hidden");
    modalContainer.classList.add("tw-fixed");
  }
});

onUnmounted(() => {
  if (props.selfContained && !props.containerStayOnClose) {
    const modalContainer = document.getElementById("modal-container");
    modalContainer.classList.add("tw-hidden");
    modalContainer.classList.remove("tw-fixed");
  }
});
</script>

<template>
  <teleport to="#modal-container">
    <div
      :id="`${modalId}-overlay`"
      class="
        tw-absolute tw-h-full tw-w-full tw-bg-[#000000] tw-bg-opacity-80 tw-z-20
      "
      @click="onOverlayClick"
    ></div>
    <div
      class="
        tw-absolute
        tw-flex
        tw-h-full
        tw-w-full
        tw-items-center
        tw-justify-center
      "
      :class="showOverlay && 'tw-bg-[rgba(0,0,0,0.8)] tw-z-30'"
    >
      <div
        class="
          tw-w-full
          tw-rounded-[8px]
          tw-z-30
          tw-p-5
          sm:tw-p-[30px]
          tw-flex
          tw-flex-col
          tw-relative
          tw-mx-[16px]
          md:tw-mx-[28px]
          tw-bg-white
          dark:tw-bg-[#081825]
          tw-border
          tw-border-[#445F74]
          dark:tw-border-[#445F74]
        "
        :class="classOverride"
      >
        <div
          class="
            tw-flex
            tw-flex-row
            tw-justify-between
            tw-items-start
            tw-text-white
            tw-mb-5
          "
        >
          <h3 class="tw-w-full tw-text-black dark:tw-text-white tw-font-bold tw-text-xl md:tw-text-2xl tw-mr-5" v-html="title"></h3>
          <button @click="onClose" class="tw-text-[#000C17] dark:tw-text-white tw-z-20">
            <XIcon class="tw-h-[28px] md:tw-h-[36px] tw-w-[28px] md:tw-w-[36px]" />
          </button>
        </div>
        <slot></slot>
      </div>
    </div>
  </teleport>
</template>
