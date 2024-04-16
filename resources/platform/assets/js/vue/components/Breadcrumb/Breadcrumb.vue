<template>
  <div :class="`tw-flex tw-w-full tw-pt-4 ${classOverride}`">
    <!-- Mobile -->
    <div v-if="penultimateBreadcrumb && penultimateBreadcrumb.url" class="tw-flex  lg:tw-hidden tw-whitespace-nowrap tw-text-ellipsis tw-w-full tw-overflow-hidden tw-text-[#3F3F46] dark:tw-text-[#A1A1A9] tw-w-full tw-uppercase tw-text-[14px]">
      <a class="tw-flex tw-items-center tw-text-sm tw-uppercase tw-text-[#3F3F46] dark:tw-text-[#E7EFF6] tw-no-underline tw-font-bold"
        :href="penultimateBreadcrumb.url">
        <i class="fa-solid fa-chevron-left tw-text-[16px] tw-h-[16px] tw-w-[16px] tw-pr-[5px]"></i>
        <span class="tw-font-bold">{{ penultimateBreadcrumb.title }}</span>
      </a>
    </div>
    <!-- Desktop -->
    <div class="tw-text-[#3F3F46] dark:tw-text-[#E7EFF6] tw-hidden lg:tw-flex tw-whitespace-nowrap tw-text-ellipsis tw-w-full tw-overflow-hidden dark:tw-bg-[#000C17] tw-uppercase tw-text-[14px] tw-leading-[21px]">
      <a :href="`/${brand}`" class="dark:hover:tw-text-white hover:tw-text-black tw-font-normal tw-text-[14px] tw-leading-[21px]">
        HOME
      </a>
      <template v-for="(breadcrumb, index) in breadcrumbs" :key="index">
        <span class="tw-font-normal tw-text-[14px] tw-leading-[21px]">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
        <a v-if="index < breadcrumbs.length - 1 && breadcrumb.url" :href="breadcrumb.url" class="tw-font-normal tw-text-[14px] tw-leading-[21px] dark:hover:tw-text-white hover:tw-text-black">
          <span>{{ breadcrumb.title }}</span>
        </a>
        <span v-else class="tw-font-bold tw-text-[14px] tw-leading-[21px]">
          {{ breadcrumb.title }}
        </span>
      </template>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../stores/user';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
  breadcrumbs: {
    type: Array,
    default: () => [],
  },
  classOverride: {
    type: String,
    default: 'tw-px-4 md:tw-px-8',
  }
});

const penultimateBreadcrumb = computed(() => {
  if (props.breadcrumbs.length < 2) {
    return { title: 'HOME', url: `/${brand.value}` };
  }

  const penultimateIndex = props.breadcrumbs.length - 2;
  const breadcrumb = props.breadcrumbs[penultimateIndex];

  if (!breadcrumb || typeof breadcrumb.title !== 'string' || !breadcrumb.url) {
    return { title: 'HOME', url: `/${brand.value}` };
  }

  return {
    title: breadcrumb.title,
    url: breadcrumb.url
  };
});
</script>
