<script setup>
import MusicIcon from "./MusicIcon.vue";
defineProps(["title", "subtitle", "level"]);
</script>

<template>
  <div
    :class="`tw-flex tw-h-full tw-w-full tw-flex-col tw-items-center tw-justify-center tw-px-[8px] md:tw-px-[19px] tw-text-white`"
  >
    <div class="tw-flex tw-flex-row md:tw-flex-col tw-items-center">
      <MusicIcon :level="level" />
      <div
        class="tw-text-[24px] md:tw-text-[32px] tw-leading-[20px] md:tw-leading-[40px] tw-font-bebas-neue tw-tracking-[1px]"
      >
        {{ title }}
      </div>
    </div>
    <div
      class="tw-mt-[10px] tw-flex tw-flex-row tw-items-center tw-justify-center"
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
