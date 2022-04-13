<script setup>
import { ref } from "vue";
import { XIcon } from "@heroicons/vue/solid";
import Onboarding from "./Onboarding.vue";
import Button from "../Button/Button.vue";
const emit = defineEmits(["onClose"]);

const showOnboarding = ref(false);
function toggleOnboarding() {
  showOnboarding.value = !showOnboarding.value;
}
</script>

<template>
  <div
    class="
      tw-flex
      tw-flex-col
      lg:tw-flex-row
      tw-w-full
      tw-bg-[#F3F4F6]
      dark:tw-bg-[#002039B2]/70
      tw-border
      tw-border-[0,0,0]/[.15]
      dark:tw-border-[#344858]
      tw-justify-between
      tw-min-h-[105px]
      tw-rounded-[10px]
      tw-items-center
      tw-px-[26px]
      tw-relative
      tw-py-[13px]
      tw-my-4
    "
  >
    <div class="tw-text-center tw-mb-[12px] lg:tw-mb-0 lg:tw-text-left tw-font-bebas-neue tw-font-bold tw-text-[18px] lg:tw-text-[20px] 2xl:tw-text-[24px] tw-uppercase">
      You haven’t set up your account for this instrument.
    </div>
    <Button
      @onButtonClick="toggleOnboarding"
      classOverride="tw-shrink-0 tw-h-[50px] tw-bg-transparent tw-border-black tw-text-black dark:tw-text-white dark:tw-border-white tw-border-[2px] lg:tw-mr-6 tw-text-[16px] lg:tw-text-[18px] 2xl:tw-text-[20px] tw-px-[59px]"
      >COMPLETE YOUR ACCOUNT
    </Button>
    <Onboarding v-if="showOnboarding" />
    <button
      class="
        tw-absolute
        dark:tw-text-white
        dark:tw-border-white
        tw-text-black
        tw-border-black
        tw-border-[2px]
        tw-rounded-full
        tw-h-[20px]
        tw-w-[20px]
        tw-flex
        tw-justify-center
        tw-items-center
        tw-top-[9px]
        tw-right-[14px]
      "
      @click="() => emit('onClose')"
    >
      <XIcon class="tw-w-[12px] tw-h-[12px]" />
    </button>
  </div>
</template>