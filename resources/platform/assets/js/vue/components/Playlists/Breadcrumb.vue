<template>
  <div
    class="tw-whitespace-nowrap tw-text-ellipsis tw-w-full tw-overflow-hidden tw-px-3 tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-flex tw-justify-center tw-items-center tw-w-full tw-h-[40px] dark:tw-bg-black tw-bg-[#e5e7eb] tw-text-center tw-uppercase tw-text-sm ">
    <a :href="`/${brand}`"
      class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] dark:hover:tw-text-white hover:tw-text-black">
      <HomeIcon class="tw-w-[14px] tw-h-[14px]" />
    </a>
    <template v-if="firstLevelTitle">
      &nbsp;/&nbsp;
      <a class="tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-font-normal tw-text-sm dark:hover:tw-text-white hover:tw-text-black"
        :href="firstLevelUrl">{{ firstLevelTitle }}</a>
    </template>
    <template v-if="secondLevelTitle">
      &nbsp;/&nbsp;
      <a class="tw-w-auto tw-overflow-hidden tw-text-ellipsis tw-text-black tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-font-normal tw-text-sm dark:hover:tw-text-white hover:tw-text-black tw-font-bold lg:tw-font-normal"
        :href="secondLevelUrl">{{ secondLevelTitle }}</a>
    </template>
    <span v-if="lastLevelTitle" class="tw-w-auto tw-overflow-hidden tw-text-ellipsis tw-hidden lg:tw-inline">
      &nbsp;/&nbsp;
      <span class="tw-font-bold tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-text-sm">
        {{ lastLevelTitle }}
      </span>
    </span>
  </div>
</template>

<script setup>
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "../../../stores/user";
import { HomeIcon } from '@heroicons/vue/solid';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
  brand: String,
  firstLevelUrl: String,
  firstLevelTitle: String,
  secondLevelUrl: String,
  secondLevelTitle: String,
  lastLevelTitle: String,
});
</script>
