<script setup>
import { ref, onBeforeMount, computed } from 'vue';
import { storeToRefs } from 'pinia';
import { getCookie, setCookie } from '@vuesora/assets/js/functions/cookies';

import { useUserStore } from '@stores/user';

const shouldShowBanner = ref(true);
const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

onBeforeMount(() => {
  const hideOnboardingBanner = !!getCookie(`hideOnboardingBanner_${brand.value}`);
  if (hideOnboardingBanner) {
    shouldShowBanner.value = false;
  }
});

const hideOnboardingBanner = () => {
  setCookie(`hideOnboardingBanner_${brand.value}`, "true", 365);
  shouldShowBanner.value = false;
};

const brandedMessage = computed(() => {
  return {
    drumeo: 'Complete your drum profile and unlock your recommended lessons!',
    singeo: 'Complete your singing profile and unlock your recommended lessons!',
    pianote: 'Complete your piano profile and unlock your recommended lessons!',
    guitareo: 'Complete your guitar profile and unlock your recommended lessons!',
  }[brand.value];
});
</script>

<template>
  <div class="
      tw-flex
      tw-flex-col
      lg:tw-flex-row
      dark:tw-bg-[#002039B2]/70
      tw-justify-between
      tw-min-h-[90px]
      tw-rounded-[10px]
      tw-items-center
      tw-p-[15px]
      lg:tw-px-[20px]
      tw-relative
      lg:tw-py-[25px]
      tw-my-4
      tw-border-[1px]
      tw-border-[#E0E0E1]
      dark:tw-border-none
    " v-if="shouldShowBanner">
    <div class="tw-flex tw-justify-center tw-items-center tw-self-start">
      <NewMusoraIcon :brand="brand" variant="profile" svgClass="tw-w-[50px] tw-h-[50px]" />
      <div
        class="tw-ml-[15px] xl:tw-ml-[30px] tw-text-[#00101D] dark:tw-text-white tw-text-[12px] tw-leading-[18px] lg:tw-text-[18px] lg:tw-leading-[27px]">
        {{ brandedMessage }}
      </div>
    </div>
    <div class="tw-flex tw-items-end lg:tw-justify-center lg:tw-items-center tw-self-end">
      <button class="hover:tw-text-white tw-uppercase tw-font-bebas-neue tw-text-[16px] tw-leading-[24px] tw-text-[#3F3F46] dark:tw-text-[#9EC0DC] tw-mr-[30px]" @click="hideOnboardingBanner">
        DISMISS
      </button>
      <a :href="`/onboarding?brand=${userStore.brand}`" class="tw-hidden lg:tw-block tw-btn-secondary tw-text-[#00101D] tw-border-3 tw-leading-none dark:tw-text-white 
        hover:tw-bg-black/10 dark:hover:tw-bg-white/10">COMPLETE PROFILE
      </a>
      <a :href="`/onboarding?brand=${userStore.brand}`" class="lg:tw-hidden hover:tw-text-white tw-uppercase tw-font-bebas-neue tw-text-[16px] tw-leading-[24px] tw-text-black dark:tw-text-white">
        COMPLETE PROFILE
      </a>
    </div>
  </div>
</template>