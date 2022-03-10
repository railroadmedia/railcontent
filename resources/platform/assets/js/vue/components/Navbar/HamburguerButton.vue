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
    class="tw-flex tw-h-full tw-flex-row tw-items-center tw-px-[12px]"
  >
    <div
      class="tw-mr-[12px] tw-flex tw-h-[12px] tw-w-[18px] tw-flex-col tw-justify-between"
    >
      <div class="tw-h-0.5 tw-w-full tw-bg-black dark:tw-bg-white"></div>
      <div class="tw-h-0.5 tw-w-full tw-bg-black dark:tw-bg-white"></div>
      <div class="tw-h-0.5 tw-w-full tw-bg-black dark:tw-bg-white"></div>
    </div>
    <div class="tw-hidden tw-w-[140px] lg:tw-flex">
      <img
        alt="Musora Logo"
        class="tw-hidden dark:tw-block"
        src="https://musora-ui.s3.amazonaws.com/logos/musora-white.svg"
      />
      <img
        alt="Musora Logo"
        class="tw-block dark:tw-hidden"
        src="https://musora-ui.s3.amazonaws.com/logos/musora-black.svg"
      />
    </div>
  </button>
</template>
