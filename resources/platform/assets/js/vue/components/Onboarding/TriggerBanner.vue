<script setup>
import { ref, onBeforeMount } from 'vue';
import { getCookie, setCookie } from '../../vuesora/assets/js/functions/cookies';
import { XIcon } from "@heroicons/vue/solid";
import Button from "../Button/Button.vue";

const shouldShowBanner = ref(true);

onBeforeMount(() => {
    const hideOnboardingBanner = !!getCookie("hideOnboardingBanner");
    if (hideOnboardingBanner) {
      shouldShowBanner.value = false;
    }
});

const hideOnboardingBanner = () => {
    setCookie("hideOnboardingBanner", "true", 365);
    shouldShowBanner.value = false;
};
</script>

<template>
  <div class="
      tw-flex
      tw-flex-col
      lg:tw-flex-row
      tw-w-full
      tw-bg-[#E4E4E7]
      dark:tw-bg-[#002039B2]/70
      tw-border
      tw-border-[#A1A1A9]
      dark:tw-border-[#344858]
      tw-justify-between
      tw-min-h-[105px]
      tw-rounded-[10px]
      tw-items-center
      tw-px-[26px]
      tw-relative
      tw-py-[13px]
      tw-my-4
    " v-if="shouldShowBanner">
    <div
      class="tw-text-center tw-text-[#00101D] dark:tw-text-white tw-mb-[12px] lg:tw-mb-0 lg:tw-text-left tw-font-bebas-neue tw-text-[18px] lg:tw-text-[20px] 2xl:tw-text-[24px] tw-uppercase">
      You haven’t set up your account for this instrument.
    </div>
    <a href="onboarding" class="tw-btn-secondary tw-text-[#00101D] tw-border-3 tw-leading-none lg:tw-mr-6 dark:tw-text-white 
        hover:tw-bg-black/10 dark:hover:tw-bg-white/10">Complete Your Account
    </a>
    <button class="
        tw-absolute
        dark:tw-text-white
        dark:tw-border-white
        tw-text-[#00101D]
        tw-border-black
        tw-border-[2px]
        tw-rounded-full
        tw-h-[20px]
        tw-w-[20px]
        tw-flex
        tw-justify-center
        tw-items-center
        tw-top-[5px]
        tw-right-[5px]
        md:tw-top-[9px]
        md:tw-right-[9px]
        hover:tw-bg-black/10
        dark:hover:tw-bg-white/10
      " @click="hideOnboardingBanner">
      <XIcon class="tw-w-[12px] tw-h-[12px]" />
    </button>
  </div>
</template>