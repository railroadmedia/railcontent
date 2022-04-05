<script setup>
import { ArrowSmRightIcon } from "@heroicons/vue/solid";
const props = defineProps({
  topSubtitle: {
    type: String,
    default: "",
  },
  title: {
    type: String,
    default: "",
  },
  ctaText: {
    type: String,
    default: "",
  },
  description: {
    type: String,
    default: "",
  },
  ctaUrl: {
    type: String,
    default: "",
  },
  img: {
    type: String,
    default: "",
  },
  showSlide: {
    type: Boolean,
    default: false,
  }
});
</script>

<template>
  <div
    :class="`tw-transition-opacity tw-overflow-hidden tw-rounded-[10px] ${showSlide ? 'tw-opacity-100 tw-w-full tw-h-full tw-z-10 tw-relative' : 'tw-opacity-0 tw-h-0 tw-w-0 tw-absolute tw-z-0'}`"
    :style="{
      backgroundImage: `url('${img}')`,
      backgroundPosition: 'top center',
      backgroundSize: 'cover',
      backgroundRepeat: 'no-repeat',
    }"
  >
    <div
      class="tw-w-full tw-h-full tw-rounded-[10px]"
      :style="{
        background:
          'linear-gradient(89.96deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%), linear-gradient(182.34deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(89.96deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%)',
      }"
    >
      <div
        class="
          tw-flex
          tw-flex-col
          tw-text-white
          tw-text-uppercase
          tw-h-full
          tw-justify-center
          tw-px-[26px]
          tw-font-open-sans
        "
      >
        <h4 class="tw-font-bold tw-text-[16px]">{{ topSubtitle }}</h4>
        <h2
          class="
            tw-font-bold
            tw-font-bebas-neue
            tw-text-[60px]
            tw-leading-[40px]
            tw-mt-[15px]
            tw-mb-[5px]
          "
        >
          {{ title }}
        </h2>
        <p class="tw-text-[16px]">{{ description }}</p>
        <a
          class="
            tw-block
            tw-text-white
            tw-font-bold
            tw-font-bebas-neue
            tw-text-[20px]
          "
          :href="ctaUrl"
          >{{ ctaText }}
          <ArrowSmRightIcon class="tw-inline tw-w-[20px] tw-h-[18px]"
        /></a>
      </div>
    </div>
  </div>
</template>