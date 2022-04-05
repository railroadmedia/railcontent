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
  <div
    :class="`StepWrapper StepWrapper--${brand}`"
    :style="showBgImg ? { backgroundImage: `url('${bgImg[brand]}')` } : {}"
  >
    <div
      :class="`StepWrapper__overlay ${
        showBgImg ? 'StepWrapper__overlay--gradient' : ''
      }`"
    >
      <div class="tw-flex tw-flex-col tw-items-center md:tw-justify-center tw-h-full tw-w-full">
        <slot />
      </div>
      <div class="tw-flex tw-justify-center tw-items-center tw-w-full tw-self-end tw-pb-[40px] tw-hidden md:tw-flex">
      <div v-if="showInstrumentBrand">
        <div class="tw-h-[32px]">
          <img
            :src="whiteLogos[brand]"
            class="tw-h-full tw-w-auto"
            :alt="`${brand} logo`"
          />
        </div>
        <div class="tw-flex tw-justify-center tw-items-center tw-text-white tw-text-[10px] tw-w-full tw-mt-[10px]">
          BY&nbsp;
          <img
            class="tw-h-[10px] tw-w-auto"
            :src="whiteLogos.musora"
            alt="Musora Logo"
          />
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

.StepWrapper__overlay {
  display: flex;
  position: absolute;
  width: 100%;
  height: 100%;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  background: #000c17;
}

.StepWrapper--drumeo .StepWrapper__overlay--gradient {
  background: linear-gradient(
      0deg,
      rgba(0, 32, 57, 0.55),
      rgba(0, 32, 57, 0.55)
    ),
    linear-gradient(0deg, rgba(11, 118, 219, 0.4), rgba(11, 118, 219, 0.4));
}

.StepWrapper--pianote .StepWrapper__overlay--gradient {
  background: linear-gradient(
      0deg,
      rgba(0, 32, 57, 0.46),
      rgba(0, 32, 57, 0.46)
    ),
    linear-gradient(0deg, rgba(246, 26, 48, 0.4), rgba(246, 26, 48, 0.4));
}

.StepWrapper--guitareo .StepWrapper__overlay--gradient {
  background: linear-gradient(
      0deg,
      rgba(0, 32, 57, 0.45),
      rgba(0, 32, 57, 0.45)
    ),
    linear-gradient(0deg, rgba(0, 201, 172, 0.2), rgba(0, 201, 172, 0.2));
}

.StepWrapper--singeo .StepWrapper__overlay--gradient {
  background: linear-gradient(
      0deg,
      rgba(131, 0, 233, 0.1),
      rgba(131, 0, 233, 0.1)
    ),
    linear-gradient(0deg, rgba(0, 32, 57, 0.45), rgba(0, 32, 57, 0.45));
}
</style>
