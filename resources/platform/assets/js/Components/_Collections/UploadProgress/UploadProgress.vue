<script setup>
import { XCircleIcon, CheckCircleIcon } from "@heroicons/vue/outline";
const props = defineProps({
  percentage: {
    type: Number,
    default: 0,
  },
});
</script>

<template>
  <div
    class="
      tw-flex tw-h-[52px] tw-w-full tw-bg-[#000C17] tw-rounded-[6px] tw-relative tw-overflow-hidden
    "
  >
    <div
      :class="`
        tw-bg-[#223F57]
        tw-pl-[27px]
        tw-h-full
        tw-flex
        tw-items-center
        ${percentage === 100 ? 'tw-text-[#77FF9D]' : 'tw-text-[#91ACC1]'}
        tw-text-bold
        tw-font-[16px]
        `"
      :style="{ width: `${percentage}%` }"
    >
      {{ percentage === 100 ? 'Success!' : 'Uploading...'  }}
    </div>
    <XCircleIcon
      v-if="percentage !== 100"
      class="tw-absolute tw-w-[26px] tw-h-[26px] tw-text-[#FF5A6B] tw-top-[12px] tw-right-[27px]"
    />
    <CheckCircleIcon
      v-if="percentage === 100"
      class="tw-absolute tw-w-[26px] tw-h-[26px] tw-text-[#77FF9D] tw-top-[12px] tw-right-[27px]"
    />
  </div>
</template>