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

const emit = defineEmits(['onBackClick'])
</script>

<template>
  <div class="tw-flex tw-flex-col tw-w-full tw-relative tw-items-center tw-justify-center">
    <button v-if="!hideBackButton" @click="emit('onBackClick')" class="tw-text-white tw-absolute tw-left-[20%] tw-top-0"><ArrowSmLeftIcon class="tw-w-[19px] tw-h-[18px] md:tw-w-[39px] md:tw-h-[37px]" /></button>
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
      class="tw-mb-[40px] tw-max-w-[624px] tw-text-white tw-hidden md:tw-block"
    >
      {{ subtitle }}
    </p>
  </div>
</template>