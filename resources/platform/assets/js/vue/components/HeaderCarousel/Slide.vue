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
  titleClasses: {
    type: String,
    default: ""
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
  },
  textContentOverride: {
    type: String,
    default: ''
  },
  animateDirection: {
    type: String,
    default: ''
  },
  isPrevSlide: {
    type: Boolean,
    default: false,
  }
});
const goToUrl = (url) => {
  if (url) {
    window.location.href = url;
  }
}
</script>

<template>
  <div v-if="showSlide || isPrevSlide" 
      :class="`tw-bg-white tw-overflow-hidden tw-rounded-[10px] tw-bg-no-repeat tw-bg-right tw-bg-cover md:tw-bg-top 3xl:tw-bg-right-top 3xl:tw-bg-[length:70%]
      ${showSlide
        ? `tw-absolute tw-w-full tw-h-full tw-z-20 ${showSlide ? `slide-in-${animateDirection}` : ''}`
        : 'tw-absolute tw-w-full tw-h-full tw-z-0'
      }
      ${ctaUrl
        ? 'tw-cursor-pointer'
        : ''
      }
      `" :style="{
        backgroundImage: `url('${img}')`,
      }" 
      @click="goToUrl(ctaUrl)"
  >
    <div class="tw-w-full tw-h-full tw-rounded-[10px] header-carousel-slide-bg">
      <div :class="`
          tw-flex
          tw-flex-col
          tw-text-white
          tw-text-uppercase
          tw-h-full
          tw-justify-end
          lg:tw-mb-0
          lg:tw-justify-center
          tw-px-[26px]
          tw-font-open-sans
          lg:tw-w-1/2
          ${textContentOverride}
        `">
        <h4 class="tw-font-bold tw-text-[16px] tw-uppercase tw-leading-none tw-mb-3">{{ topSubtitle }}</h4>
        <h2 class="
            tw-font-bebas-neue
            tw-text-[60px]
            tw-mb-1
            tw-uppercase
            tw-leading-none
          "
          :class="titleClasses"
          >
          {{ title }}
        </h2>

        <p class="tw-text-[16px] tw-mb-3 tw-hidden xl:tw-block" v-html="description"></p>

        <span class="
            tw-text-white
            tw-font-bebas-neue
            tw-text-[20px]
            tw-hidden
            xl:tw-block
          ">{{ ctaText }}
          <ArrowSmRightIcon class="tw-inline tw-w-[20px] tw-h-[18px]" />
        </span>
      </div>
    </div>
  </div>
</template>

<style type="text/css">
.header-carousel-slide-bg {
  transition: all 1s;
  background: linear-gradient(0deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 70.78%), linear-gradient(180deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(0deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
}

.header-carousel-slide-bg:hover {
  background: linear-gradient(0deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 99.78%), linear-gradient(180deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(0deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
}

/* Same as .md */
@media (min-width: 768px) {
  .header-carousel-slide-bg {
    background: linear-gradient(89.96deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 70.78%), linear-gradient(182.34deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(89.96deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
  }
  .header-carousel-slide-bg:hover {
    background: linear-gradient(89.96deg, #000C17 1.16%, #000C17 38.86%, rgba(0, 12, 23, 0) 99.78%), linear-gradient(182.34deg, rgba(0, 0, 0, 0) 75.35%, #000000 98.04%), linear-gradient(89.96deg, #000C17 1.16%, #000C17 28.86%, rgba(0, 12, 23, 0) 50.78%);
  }
}
</style>