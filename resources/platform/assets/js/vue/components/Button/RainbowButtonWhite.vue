<script setup>
const props = defineProps({
  url: {
    type: String
  }
});
</script>


<template>
  <a :type="type" class="
      tw-text-[14px]
      tw-rounded-[25px]
      xl:tw-px-[48px]
      xl:tw-py-[12px]
      tw-px-[12px]
      tw-py-[9px]
      tw-mb-[20px]
      tw-h-[50px]
      tw-text-white
      tw-relative
      tw-font-bebas-neue
      tw-uppercase
    " :href="url"
    style="background: linear-gradient(45.69deg,#00c9ac 1.54%,#0b76db 30.83%,#9a00ee 72.12%,#f61a30 95.24%)">
    <slot></slot>
  </a>
</template>
