<script setup>
import StepHeader from './StepHeader.vue';
import Branding from './Branding.vue';
import { bgImg } from "../../../constants/brands";

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
  hideBranding: {
    type: Boolean,
    default: false,
  },
  topPaddingClasses: {
    type: String,
    default: 'tw-pt-[24px] md:tw-pt-[40px]',
  },
});
const emit = defineEmits(['onHeaderGoBack']);
</script>

<template>
  <div class="tw-relative tw-w-full tw-bg-cover dark:tw-text-white tw-h-screen lg:tw-h-full lg:tw-min-h-screen tw-overflow-x-hidden lg:tw-flex lg:tw-items-center" :style="showBgImg ? { backgroundImage: `url('${bgImg[brand]}')` } : {}">
    <div :class="`tw-flex tw-w-full tw-h-full tw-flex-col tw-items-center tw-justify-between ${topPaddingClasses} ${showBgImg ? 'tw-bg-transparent' : 'tw-bg-[#000c17]'
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
      <Branding v-if="!hideBranding" :brand="brand" :show-instrument-brand="showInstrumentBrand" :hide-branding="hideBranding" />
    </div>
  </div>
</template>
