<template>
  <div
    class="tw-whitespace-nowrap tw-text-ellipsis tw-w-full tw-overflow-hidden tw-px-3 tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-flex tw-justify-center tw-items-center tw-w-full tw-h-[40px] dark:tw-bg-black tw-bg-[#e5e7eb] tw-text-center tw-uppercase tw-text-sm ">
    <!-- Home -->
    <a :href="`/${brand}`"
      class="tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] dark:hover:tw-text-white hover:tw-text-black">
      <HomeIcon class="tw-w-[14px] tw-h-[14px]" />
    </a>

    <!-- Parent Pages -->
    <template v-if="firstLevelTitle">
      <span class="tw-font-bold">&nbsp;/&nbsp;</span>
      <a class=" tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-text-sm dark:hover:tw-text-white hover:tw-text-black"
        :href="firstLevelUrl">{{ firstLevelTitle }}</a>
    </template>
    <template v-if="secondLevelTitle">
      <span class="tw-font-bold">&nbsp;/&nbsp;</span>
      <a class=" tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-text-sm dark:hover:tw-text-white hover:tw-text-black"
        :href="secondLevelUrl">{{ secondLevelTitle }}
      </a>
    </template>

    <!-- Current Page -->
    <template v-if="lastLevelTitle">
      <span class="tw-font-bold">&nbsp;/&nbsp;</span>
      <p class="tw-font-bold tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-text-sm tw-w-auto tw-overflow-hidden tw-text-ellipsis">
        {{ lastLevelTitle }}
      </p>
    </template>

  </div>
</template>

<script setup>
import { HomeIcon } from '@heroicons/vue/solid';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

const props = defineProps({
  firstLevelUrl: String,
  firstLevelTitle: String,
  secondLevelUrl: String,
  secondLevelTitle: String,
  lastLevelTitle: String,
});

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);
</script>
