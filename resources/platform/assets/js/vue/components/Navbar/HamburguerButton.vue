<script>
export default {
  name: 'HamburguerButton',
  props: ['onclick'],
  emits: ['onclick']
}
</script>

<template>
  <button
    v-on:click="$emit('onclick')"
    class="tw-btn-primary tw-btn-small tw-btn-circle tw-bg-transparent hover:tw-bg-[#3f3f46]/10 dark:hover:tw-bg-[#445F74]/20 tw-p-0 tw-mb-0 tw-mr-3"
  >
    <div
      class="tw-flex tw-h-[12px] tw-w-[18px] tw-flex-col tw-justify-between"
    >
      <div class="tw-h-0.5 tw-w-full tw-bg-black dark:tw-bg-white"></div>
      <div class="tw-h-0.5 tw-w-full tw-bg-black dark:tw-bg-white"></div>
      <div class="tw-h-0.5 tw-w-full tw-bg-black dark:tw-bg-white"></div>
    </div>
  </button>
</template>
