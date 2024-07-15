<template>
    <div class="tw-pt-[28px] tw-flex tw-justify-center tw-items-center tw-w-full tw-self-end tw-pb-[40px] tw-hidden xl:tw-flex" :class="classOverride">
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
</template>

<script setup>
import { whiteLogos } from "../../Constants/brands";

const props = defineProps({
  brand: {
    type: String,
    default: "drumeo",
  },
  showInstrumentBrand: {
    type: Boolean,
    default: true,
  },
  classOverride: {
    type: String,
    default: "",
  },
});
</script>