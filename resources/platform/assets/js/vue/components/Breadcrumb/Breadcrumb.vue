<template>
  <div class="tw-flex tw-w-full tw-items-center tw-justify-center">
    <!-- Mobile -->
    <div v-if="penultimateBreadcrumb && penultimateBreadcrumb.url" class="tw-flex lg:tw-hidden tw-whitespace-nowrap tw-text-ellipsis tw-w-full tw-overflow-hidden tw-px-3 tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-justify-center tw-items-center tw-w-full tw-h-[40px] dark:tw-bg-black tw-bg-[#e5e7eb] tw-text-center tw-uppercase tw-text-sm">
      <a class="tw-flex tw-items-center tw-justify-center tw-text-sm tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-no-underline tw-font-bold"
        :href="penultimateBreadcrumb.url">
        <ArrowLeftIcon class="tw-w-[14px] tw-h-[14px] tw-inline-block tw-mr-[3px]" />
        <span class="tw-font-bold">{{ penultimateBreadcrumb.title }}</span>
      </a>
    </div>
    <!-- Desktop -->
    <div class="tw-hidden lg:tw-flex tw-whitespace-nowrap tw-text-ellipsis tw-w-full tw-overflow-hidden tw-px-3 tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-justify-center tw-items-center tw-w-full tw-h-[40px] dark:tw-bg-black tw-bg-[#e5e7eb] tw-text-center tw-uppercase tw-text-sm">
      <a :href="`/${brand}`" class="tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] dark:hover:tw-text-white hover:tw-text-black">
        <HomeIcon class="tw-w-[14px] tw-h-[14px]" />
      </a>
      <template v-for="(breadcrumb, index) in breadcrumbs" :key="index">
        <span class="tw-font-bold">&nbsp;/&nbsp;</span>
        <a v-if="index < breadcrumbs.length - 1 && breadcrumb.url" :href="breadcrumb.url" class="tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] dark:hover:tw-text-white hover:tw-text-black">
          <span class="tw-text-sm">{{ breadcrumb.title }}</span>
        </a>
        <span v-else class="tw-font-bold tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-text-sm">
          {{ breadcrumb.title }}
        </span>
      </template>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { ArrowLeftIcon, HomeIcon } from '@heroicons/vue/solid';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
  breadcrumbs: {
    type: Array,
    default: () => [],
  }
});

const penultimateBreadcrumb = computed(() => {
  if (props.breadcrumbs.length < 2) {
    return { title: 'HOME', url: '/' };
  }

  const penultimateIndex = props.breadcrumbs.length - 2;
  const breadcrumb = props.breadcrumbs[penultimateIndex];

  if (!breadcrumb || typeof breadcrumb.title !== 'string' || !breadcrumb.url) {
    return { title: 'HOME', url: '/' };
  }

  return {
    title: breadcrumb.title,
    url: breadcrumb.url
  };
});
</script>
