<script setup>
import StepHeader from './StepHeader.vue';
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
  headerProps: {
    type: Object,
    default: () => ({}),
  },
});
const emit = defineEmits(['onHeaderGoBack']);
</script>

<template>
  <div class="dark:tw-text-white tw-h-screen lg:tw-h-full lg:tw-min-h-screen tw-overflow-x-hidden lg:tw-flex lg:tw-items-center"
    :class="`StepWrapper StepWrapper--${brand}`" :style="showBgImg ? { backgroundImage: `url('${bgImg[brand]}')` } : {}">
    <div :class="`tw-flex tw-w-full tw-h-full tw-flex-col tw-items-center tw-justify-between tw-pt-[24px] md:tw-pt-[40px] ${showBgImg ? 'tw-bg-transparent' : 'tw-bg-[#000c17]'
      }`">
      <StepHeader @on-go-back="emit('onHeaderGoBack')" :title="headerProps.title" :subtitle="headerProps.subtitle"
        :hideBackButton="headerProps.hideBackButton" :hide-close-button="headerProps.hideCloseButton" />
      <div
        class="tw-flex tw-flex-col tw-items-center tw-h-full tw-w-full tw-overflow-y-scroll lg:tw-overflow-y-visible tw-pb-[24px] md:tw-pb-[40px] tw-justify-between lg:tw-justify-start xl:tw-justify-center">
        <slot name="content" />
      </div>
      <div class="
          tw-justify-self-end
          md:tw-justify-self-center
          tw-flex tw-flex-col
          tw-items-center
          tw-pb-[30px]
          tw-pt-[10px]
          xl:tw-pb-0
          xl:tw-pt-0 tw-sticky lg:tw-static
        ">
        <slot name="footer" />
      </div>
      <div class="tw-pt-[28px] tw-flex tw-justify-center tw-items-center tw-w-full tw-self-end tw-pb-[40px] tw-hidden xl:tw-flex">
        <div v-if="showInstrumentBrand">
          <div class="tw-h-[32px]">
            <img :src="whiteLogos[brand]" class="tw-h-full" :alt="`${brand} logo`" />
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
