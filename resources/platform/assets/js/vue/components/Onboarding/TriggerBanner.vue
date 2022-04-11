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
      tw-w-full
      tw-bg-[#002039B2]/70
      tw-border-[0.5px]
      tw-border-[#344858]
      tw-justify-between
      tw-h-[50px]
      tw-rounded-[10px]
      tw-h-[105px]
      tw-items-center
      tw-px-[26px]
      tw-relative
    "
  >
    <div class="tw-font-bebas-neue tw-font-bold md:tw-text-[20px] 2xl:tw-text-[24px] tw-uppercase">
      You haven’t set up your account for this instrument.
    </div>
    <Button
      @onButtonClick="toggleOnboarding"
      classOverride="tw-shrink-0 tw-h-[50px] tw-bg-transparent tw-border-white tw-border-[2px] md:tw-text-[18px] 2xl:tw-text-[20px] tw-px-[59px]"
      >COMPLETE YOUR ACCOUNT
    </Button>
    <Onboarding v-if="showOnboarding" />
    <button
      class="
        tw-absolute
        tw-text-white
        tw-border-white
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
      <XIcon class="tw-w-[9px] tw-h-[9px]" />
    </button>
  </div>
</template>