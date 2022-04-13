<script setup>
import { ArrowSmLeftIcon } from "@heroicons/vue/solid";

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
  }
});

const emit = defineEmits(['onGoBack'])
</script>

<template>
  <div class="tw-flex tw-flex-col tw-w-[90vw] md:tw-w-full tw-relative md:tw-static tw-items-center tw-justify-center">
    <button @click="() => emit('onGoBack')" v-if="!hideBackButton" class="tw-text-white tw-absolute tw-left-0 tw-top-[10px] md:tw-top-[32px] md:tw-left-[32px]"><ArrowSmLeftIcon class="tw-w-[32px] tw-h-[32px] md:tw-w-[54px] md:tw-h-[54px]" /></button>
    <h2
      class="
        md:tw-mb-[5px]
        tw-w-[250px]
        md:tw-w-full
        tw-text-center
        tw-font-bold
        tw-text-white
        tw-text-[20px]
        tw-baseline-[24px]
        tw-mb-[36px]
      "
    >
      {{ title }}
    </h2>
    <p
      class="tw-mb-[40px] tw-max-w-[624px] tw-text-white tw-text-center tw-hidden md:tw-block"
    >
      {{ subtitle }}
    </p>
  </div>
</template>