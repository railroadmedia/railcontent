<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { XIcon } from "@heroicons/vue/solid";
const isContainerCreated = ref(false);
const props = defineProps(["modalId", "title", "selfContained", "classOverride"]);
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
  if (props.selfContained) {
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
    >
      <div
        class="
          tw-w-full
          tw-rounded-[8px]
          tw-z-30
          tw-py-[30px]
          tw-flex
          tw-flex-col
          tw-mx-[16px]
          md:tw-mx-[28px]
        "
        :class="classOverride ? classOverride : 'tw-border-[#223F57] tw-border-[1px] tw-bg-white dark:tw-bg-[#081825]'"
      >
        <div
          class="
            tw-flex
            tw-flex-row
            tw-justify-between
            tw-text-white
            tw-mb-[24px]
            tw-px-[40px]
          "
        >
          <h3 class="tw-text-center tw-w-full tw-text-black dark:tw-text-white tw-font-bold">{{ title }}</h3>
          <button @click="onClose" class="tw-absolute tw-right-[2px] tw-top-[12px] lg:tw-top-[24px] lg:tw-right-[24px] tw-text-[#E5E5E5] hover:tw-text-black dark:hover:tw-text-white">
            <XIcon class="tw-h-[30px] tw-w-[30px]" />
          </button>
        </div>
        <slot></slot>
      </div>
    </div>
  </teleport>
</template>
