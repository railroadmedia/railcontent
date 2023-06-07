<script setup>
import { ArrowSmLeftIcon, XIcon } from "@heroicons/vue/solid";

const props = defineProps({
  title: {
    type: String,
    default: "",
  },
  subtitle: {
    type: String,
    default: "",
  },
  hideBackButton: {
      type: Boolean,
      default: false,
  },
  hideCloseButton: {
      type: Boolean,
      default: false,
  },
});

const emit = defineEmits(['onGoBack'])

const goToPrevPage = () => {
  if (history.back) {
    history.back();
  } else {
    window.location.href = '/members'
  }
}
</script>

<template>
  <div class="tw-flex tw-flex-col tw-w-full tw-items-center tw-relative xl:tw-static tw-justify-center">
    <button @click="() => emit('onGoBack')" v-if="!hideBackButton" class="tw-text-white tw-absolute tw-left-[12px] lg:tw-top-[32px] tw-top-0 md:tw-left-[32px]"><ArrowSmLeftIcon class="tw-w-[32px] tw-h-[32px] md:tw-w-[54px] md:tw-h-[54px]" /></button>
    <button v-if="!hideCloseButton" @click="goToPrevPage" class="tw-text-white tw-absolute lg:tw-top-[32px] tw-top-0 tw-right-[12px]  md:tw-right-[32px]"><XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" /></button> 
    <h2
      class="
        md:tw-mb-[5px]
        tw-px-[48px]
        tw-w-full
        tw-font-open-sans
        tw-text-center
        tw-font-extrabold
        tw-text-white
        tw-text-[20px]
        lg:tw-text-[24px]
        xl:tw-text-[30px]
        tw-baseline-[24px]
        tw-mb-[36px]
      "
    >
      {{ title }}
    </h2>
    <p
      class="tw-font-open-sans tw-font-normal tw-text-[14px] xl:tw-text-[16px] tw-mb-[40px] tw-max-w-[624px] tw-text-white tw-text-center tw-hidden md:tw-block"
      v-html="subtitle"
    ></p>
  </div>
</template>