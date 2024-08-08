<script setup>
import MusicIcon from "./MusicIcon.vue";
defineProps(["title", "subtitle", "level"]);
</script>

<template>
  <div
    :class="`tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-px-[8px] md:tw-px-[15px] tw-text-white`"
  >
    <div class="tw-flex tw-flex-row md:tw-flex-col tw-items-center tw-justify-center tw-p-[4px] md:tw-p-0">
      <MusicIcon :level="level" class="tw-w-[18px] tw-h-[18px] md:tw-w-[30px] md:tw-h-[30px] tw-mr-[10px] md:tw-mr-0" />
      <div
        class="tw-text-[18px] md:tw-text-[24px] tw-leading-[27px] md:tw-leading-[36px] tw-font-bebas-neue tw-tracking-[1px] tw-mt-0 md:tw-mt-[20px]"
      >
        {{ title }}
      </div>
    </div>
    <div
      class="tw-mt-[5px] tw-flex tw-flex-row tw-items-center tw-justify-center"
      style="
        font-family: Open Sans;
        font-weight: 400;
        line-height: 21px;
        font-size: 14px;
      "
    >
      {{ subtitle }}
    </div>
  </div>
</template>
