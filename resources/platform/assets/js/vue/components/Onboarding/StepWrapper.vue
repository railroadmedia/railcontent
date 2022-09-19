<script setup>
import { bgImg, whiteLogos } from "../../../constants/brands";
const props = defineProps({
  brand: {
    type: String,
    default: "drumeo",
  },
  showBgImg: {
    type: Boolean,
  },
  showInstrumentBrand: {
    type: Boolean,
    default: true,
  },
});
</script>

<template>
  <div class="" :class="`StepWrapper StepWrapper--${brand}`"
    :style="showBgImg ? { backgroundImage: `url('${bgImg[brand]}')` } : {}">
    <div :class="`tw-flex tw-absolute tw-w-full tw-h-full tw-flex-col tw-items-center tw-justify-between ${
      showBgImg ? 'tw-bg-transparent' : 'tw-bg-[#000c17]'
    }`">
      <div class="tw-flex tw-flex-col tw-items-center tw-h-full tw-w-full tw-pt-[24px] md:tw-pt-[40px] tw-overflow-y-scroll tw-pb-[24px] md:tw-pb-[40px] tw-justify-between lg:tw-justify-start xl:tw-justify-center">
        <slot />
      </div>
      <div class="tw-flex tw-justify-center tw-items-center tw-w-full tw-self-end tw-pb-[40px] tw-hidden xl:tw-flex">
        <div v-if="showInstrumentBrand">
          <div class="tw-h-[32px]">
            <img :src="whiteLogos[brand]" class="tw-h-full tw-w-auto" :alt="`${brand} logo`" />
          </div>
          <div class="tw-flex tw-justify-center tw-items-center tw-text-white tw-text-[10px] tw-w-full tw-mt-[10px]">
            BY&nbsp;
            <img class="tw-h-[10px] tw-w-auto" :src="whiteLogos.musora" alt="Musora Logo" />
          </div>
        </div>
        <div v-if="!showInstrumentBrand" class="tw-h-[21px]">
          <img :src="whiteLogos.musora" alt="Musora Logo" class="tw-h-full tw-w-auto">
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.StepWrapper {
  position: relative;
  width: 100%;
  height: 100%;
  background-size: cover;
}
</style>
